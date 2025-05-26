<?php

/**
 * Admin Notices Manager
 *
 * A class to handle admin notices without AJAX, with individual dismissal, deletion, and disable features
 *
 * @package JThem
 * @subpackage Core\Admin
 */

namespace JThem\Core\Admin;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Admin_Notices_Manager Class
 * 
 * Provides methods for displaying consistent admin notices in WordPress
 */
class Notices_Manager
{

    /**
     * Notice types and their corresponding CSS classes
     */
    private static $notice_types = [
        'info'    => 'notice-info',
        'success' => 'notice-success',
        'warning' => 'notice-warning',
        'error'   => 'notice-error',
    ];

    /**
     * Store of notices to be displayed
     */
    private static $notices = [];

    /**
     * Initialize the admin notices
     */
    public static function init()
    {
        add_action('admin_notices', [__CLASS__, 'display_notices']);
        add_action('admin_init', [__CLASS__, 'handle_notice_actions']);
    }

    /**
     * Add a notice to be displayed
     *
     * @param string $message The notice message
     * @param string $type The notice type (info, success, warning, error)
     * @param bool $dismissible Whether the notice can be dismissed
     * @param string $id Unique ID for the notice (for dismissible notices)
     * @param array $actions Array of action buttons ['text' => 'Button Text', 'url' => 'https://...', 'class' => 'button-primary']
     * @param int $timeout Seconds after which the notice auto-expires (0 for no timeout)
     */
    public static function add_notice($message, $type = 'info', $dismissible = false, $id = '', $actions = [], $timeout = 0)
    {
        // Validate notice type
        if (!isset(self::$notice_types[$type])) {
            $type = 'info';
        }

        // Create a unique ID if one wasn't provided
        if ($dismissible && empty($id)) {
            $id = 'theme_notice_' . wp_generate_password(8, false);
        }

        // Store the notice
        self::$notices[] = [
            'message'     => $message,
            'type'        => $type,
            'dismissible' => $dismissible,
            'id'          => $id,
            'actions'     => $actions,
            'timeout'     => (int) $timeout,
        ];

        // If this is called after admin_notices has fired, display immediately
        if (did_action('admin_notices')) {
            self::display_notices();
        }
    }

    /**
     * Add a persistent notice that will be stored in options
     *
     * @param string $message The notice message
     * @param string $type The notice type (info, success, warning, error)
     * @param bool $dismissible Whether the notice can be dismissed
     * @param string $id Unique ID for the notice
     * @param array $actions Array of action buttons
     * @param int $timeout Seconds after which the notice auto-expires (0 for no timeout)
     * @return bool Whether the notice was added
     */
    public static function add_persistent_notice($message, $type = 'info', $dismissible = true, $id = '', $actions = [], $timeout = 0)
    {
        // Check if notices are disabled
        if (get_option('theme_notices_disabled', false)) {
            return false;
        }

        // Require an ID for persistent notices
        if (empty($id)) {
            $id = 'theme_persistent_' . wp_generate_password(8, false);
        }

        // Get existing persistent notices
        $persistent_notices = get_option('theme_admin_notices', []);

        // Add or update the notice
        $persistent_notices[$id] = [
            'message'     => $message,
            'type'        => $type,
            'dismissible' => $dismissible,
            'actions'     => $actions,
            'timeout'     => (int) $timeout,
            'created'     => time(),
        ];

        return update_option('theme_admin_notices', $persistent_notices);
    }

    /**
     * Remove a persistent notice by ID
     *
     * @param string $id The notice ID to remove
     * @return bool True if notice was removed, false otherwise
     */
    public static function remove_persistent_notice($id)
    {
        if (empty($id)) {
            return false;
        }

        $persistent_notices = get_option('theme_admin_notices', []);

        if (isset($persistent_notices[$id])) {
            unset($persistent_notices[$id]);
            return update_option('theme_admin_notices', $persistent_notices);
        }

        return false;
    }

    /**
     * Load persistent notices into the current notices array
     */
    private static function load_persistent_notices()
    {
        // Skip if notices are disabled
        if (get_option('theme_notices_disabled', false)) {
            return;
        }

        $persistent_notices = get_option('theme_admin_notices', []);
        $user_id = get_current_user_id();

        // Get dismissed notices for this user
        $dismissed_notices = get_user_meta($user_id, 'dismissed_admin_notices', true);
        if (!is_array($dismissed_notices)) {
            $dismissed_notices = [];
        }

        foreach ($persistent_notices as $id => $notice) {
            // Skip if this notice has been dismissed by the user
            if (isset($dismissed_notices[$id])) {
                continue;
            }

            // Check if notice has timed out
            $timeout = isset($notice['timeout']) ? (int) $notice['timeout'] : 0;
            if ($timeout > 0 && isset($notice['created'])) {
                $created_time = (int) $notice['created'];
                if ((time() - $created_time) > $timeout) {
                    // Notice has expired, remove it
                    unset($persistent_notices[$id]);
                    update_option('theme_admin_notices', $persistent_notices);
                    continue;
                }
            }

            // Add to current notices
            self::$notices[] = array_merge($notice, ['id' => $id]);
        }
    }

    /**
     * Display all queued notices
     */
    public static function display_notices()
    {
        // Load persistent notices
        self::load_persistent_notices();

        // Display each notice
        foreach (self::$notices as $notice) {
            self::render_notice($notice);
        }

        // Clear transient notices after display
        self::$notices = [];
    }

    /**
     * Render a single notice
     *
     * @param array $notice The notice configuration
     */
    private static function render_notice($notice)
    {
        $css_class = 'notice ' . self::$notice_types[$notice['type']];

        if ($notice['dismissible']) {
            $css_class .= ' is-dismissible';
        }

        echo '<div class="' . esc_attr($css_class) . '">';
        echo '<p>' . wp_kses_post($notice['message']) . '</p>';

        // Display action buttons if present
        if (!empty($notice['actions'])) {
            echo '<p class="notice-actions">';
            foreach ($notice['actions'] as $action) {
                $button_class = !empty($action['class']) ? $action['class'] : 'button button-secondary';
                echo '<a href="' . esc_url($action['url']) . '" class="' . esc_attr($button_class) . '">' . esc_html($action['text']) . '</a> ';
            }
            echo '</p>';
        }

        // Add management links for dismissible notices
        if ($notice['dismissible'] && !empty($notice['id'])) {
            $current_url = add_query_arg([], $_SERVER['REQUEST_URI']);

            echo '<p class="notice-actions notice-manage-actions">';

            // Dismiss link
            $dismiss_url = add_query_arg([
                'dismiss_notice' => $notice['id'],
                '_wpnonce'       => wp_create_nonce('dismiss_notice_' . $notice['id']),
                'redirect_to'    => urlencode($current_url)
            ]);
            echo '<a href="' . esc_url($dismiss_url) . '" class="button button-secondary">' . esc_html__('Dismiss', 'JTheme') . '</a> ';

            // Delete link for persistent notices
            if (self::is_persistent_notice($notice['id'])) {
                $delete_url = add_query_arg([
                    'delete_notice' => $notice['id'],
                    '_wpnonce'      => wp_create_nonce('delete_notice_' . $notice['id']),
                    'redirect_to'   => urlencode($current_url)
                ]);
                echo '<a href="' . esc_url($delete_url) . '" class="button button-secondary">' . esc_html__('Delete Permanently', 'JTheme') . '</a> ';
            }

            // Disable all notices link
            $disable_url = add_query_arg([
                'disable_all_notices' => '1',
                '_wpnonce'            => wp_create_nonce('disable_notices'),
                'redirect_to'         => urlencode($current_url)
            ]);
            echo '<a href="' . esc_url($disable_url) . '" class="button button-secondary">' . esc_html__('Disable All Notices', 'JTheme') . '</a> ';

            echo '</p>';
        }

        echo '</div>';
    }

    /**
     * Check if a notice is persistent
     *
     * @param string $id The notice ID
     * @return bool True if persistent, false otherwise
     */
    private static function is_persistent_notice($id)
    {
        if (empty($id)) {
            return false;
        }

        $persistent_notices = get_option('theme_admin_notices', []);
        return isset($persistent_notices[$id]);
    }

    /**
     * Handle notice dismissal, deletion, and disabling
     */
    public static function handle_notice_actions()
    {
        if (!is_admin()) {
            return;
        }

        $user_id = get_current_user_id();
        $redirect_to = isset($_GET['redirect_to']) ? urldecode($_GET['redirect_to']) : '';

        // Handle dismissal
        if (!empty($_GET['dismiss_notice'])) {
            $notice_id = sanitize_text_field($_GET['dismiss_notice']);
            $nonce = isset($_GET['_wpnonce']) ? sanitize_text_field($_GET['_wpnonce']) : '';

            if (wp_verify_nonce($nonce, 'dismiss_notice_' . $notice_id)) {
                $dismissed_notices = get_user_meta($user_id, 'dismissed_admin_notices', true);
                if (!is_array($dismissed_notices)) {
                    $dismissed_notices = [];
                }

                // Add this notice to dismissed list
                $dismissed_notices[$notice_id] = true;
                update_user_meta($user_id, 'dismissed_admin_notices', $dismissed_notices);

                // Redirect to clean URL
                if (!empty($redirect_to)) {
                    wp_safe_redirect($redirect_to);
                } else {
                    wp_safe_redirect(remove_query_arg(['dismiss_notice', '_wpnonce', 'redirect_to']));
                }
                exit;
            }
        }

        // Handle deletion
        if (!empty($_GET['delete_notice']) && current_user_can('manage_options')) {
            $notice_id = sanitize_text_field($_GET['delete_notice']);
            $nonce = isset($_GET['_wpnonce']) ? sanitize_text_field($_GET['_wpnonce']) : '';

            if (wp_verify_nonce($nonce, 'delete_notice_' . $notice_id)) {
                // Remove from persistent notices
                self::remove_persistent_notice($notice_id);

                // Clear for all users
                global $wpdb;
                $meta_key = 'dismissed_admin_notices';
                $users_with_meta = $wpdb->get_results(
                    $wpdb->prepare(
                        "SELECT user_id, meta_value FROM {$wpdb->usermeta} WHERE meta_key = %s",
                        $meta_key
                    )
                );

                foreach ($users_with_meta as $user_meta) {
                    $dismissed = maybe_unserialize($user_meta->meta_value);
                    if (is_array($dismissed) && isset($dismissed[$notice_id])) {
                        unset($dismissed[$notice_id]);
                        update_user_meta($user_meta->user_id, $meta_key, $dismissed);
                    }
                }

                // Redirect to clean URL
                if (!empty($redirect_to)) {
                    wp_safe_redirect($redirect_to);
                } else {
                    wp_safe_redirect(remove_query_arg(['delete_notice', '_wpnonce', 'redirect_to']));
                }
                exit;
            }
        }

        // Handle disabling all notices
        if (isset($_GET['disable_all_notices']) && $_GET['disable_all_notices'] == '1' && current_user_can('manage_options')) {
            $nonce = isset($_GET['_wpnonce']) ? sanitize_text_field($_GET['_wpnonce']) : '';

            if (wp_verify_nonce($nonce, 'disable_notices')) {
                // Disable all notices
                update_option('theme_notices_disabled', true);

                // Delete all persistent notices
                update_option('theme_admin_notices', []);

                // Clear all user dismissals
                global $wpdb;
                $wpdb->delete($wpdb->usermeta, ['meta_key' => 'dismissed_admin_notices']);

                // Redirect to clean URL
                if (!empty($redirect_to)) {
                    wp_safe_redirect($redirect_to);
                } else {
                    wp_safe_redirect(remove_query_arg(['disable_all_notices', '_wpnonce', 'redirect_to']));
                }
                exit;
            }
        }
    }

    /**
     * Create a success notice
     *
     * @param string $message The notice message
     * @param bool $dismissible Whether the notice can be dismissed
     * @param string $id Unique ID for the notice
     * @param array $actions Array of action buttons
     * @param int $timeout Seconds for auto-expiry (0 for none)
     */
    public static function success($message, $dismissible = false, $id = '', $actions = [], $timeout = 0)
    {
        self::add_notice($message, 'success', $dismissible, $id, $actions, $timeout);
    }

    /**
     * Create an info notice
     *
     * @param string $message The notice message
     * @param bool $dismissible Whether the notice can be dismissed
     * @param string $id Unique ID for the notice
     * @param array $actions Array of action buttons
     * @param int $timeout Seconds for auto-expiry (0 for none)
     */
    public static function info($message, $dismissible = false, $id = '', $actions = [], $timeout = 0)
    {
        self::add_notice($message, 'info', $dismissible, $id, $actions, $timeout);
    }

    /**
     * Create a warning notice
     *
     * @param string $message The notice message
     * @param bool $dismissible Whether the notice can be dismissed
     * @param string $id Unique ID for the notice
     * @param array $actions Array of action buttons
     * @param int $timeout Seconds for auto-expiry (0 for none)
     */
    public static function warning($message, $dismissible = false, $id = '', $actions = [], $timeout = 0)
    {
        self::add_notice($message, 'warning', $dismissible, $id, $actions, $timeout);
    }

    /**
     * Create an error notice
     *
     * @param string $message The notice message
     * @param bool $dismissible Whether the notice can be dismissed
     * @param string $id Unique ID for the notice
     * @param array $actions Array of action buttons
     * @param int $timeout Seconds for auto-expiry (0 for none)
     */
    public static function error($message, $dismissible = false, $id = '', $actions = [], $timeout = 0)
    {
        self::add_notice($message, 'error', $dismissible, $id, $actions, $timeout);
    }
}

Notices_Manager::init();
