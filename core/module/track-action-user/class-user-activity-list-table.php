<?php
/**
 * User Activity List Table Class
 *
 * Handles the display of user activities in WordPress admin using WP_List_Table
 *
 * @package     RefactorCRM
 * @subpackage  Modules/UserActivityTracking
 * @version     1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Load WP_List_Table if not loaded
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class User_Activity_List_Table extends WP_List_Table {
    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct([
            'singular' => 'activity',
            'plural'   => 'activities',
            'ajax'     => false,
            'screen'   => isset($args['screen']) ? $args['screen'] : null,
        ]);
    }

    /**
     * Get table columns
     *
     * @return array
     */
    public function get_columns() {
        return [
            'cb'          => '<input type="checkbox" />', // For bulk actions
            'action_time' => __('تاریخ', 'hdm-crm'),
            'user'        => __('کاربر', 'hdm-crm'),
            'action'      => __('فعالیت', 'hdm-crm'),
            'context'     => __('بخش', 'hdm-crm'),
            'details'     => __('جزئیات', 'hdm-crm')
        ];
    }

    /**
     * Get sortable columns
     *
     * @return array
     */
    public function get_sortable_columns() {
        return [
            'action_time' => ['action_time', true],
            'user'        => ['user_id', false],
            'action'      => ['action', false],
            'context'     => ['context', false]
        ];
    }

    /**
     * Column checkbox
     *
     * @param object $item
     * @return string
     */
    public function column_cb($item) {
        return sprintf(
            '<input type="checkbox" name="activity[]" value="%s" />',
            $item->id
        );
    }

    /**
     * Prepare items for table
     */
    public function prepare_items() {
        global $wpdb;

        // Column headers
        $columns = $this->get_columns();
        $hidden = [];
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = [$columns, $hidden, $sortable];

        $table_name = $wpdb->prefix . USER_ACTIVITY_TABLE;
        $per_page = 20;
        $current_page = $this->get_pagenum();

        // Get filters
        $user_id = isset($_REQUEST['user_id']) ? absint($_REQUEST['user_id']) : 0;
        $context = isset($_REQUEST['context']) ? sanitize_text_field($_REQUEST['context']) : '';
        $action = isset($_REQUEST['action']) ? sanitize_text_field($_REQUEST['action']) : '';

        // Build query
        $where = [];
        $args = [];

        if ($user_id) {
            $where[] = "a.user_id = %d";
            $args[] = $user_id;
        }

        if ($context) {
            $where[] = "a.context = %s";
            $args[] = $context;
        }

        if ($action) {
            $where[] = "a.action = %s";
            $args[] = $action;
        }

        $where_clause = !empty($where) ? "WHERE " . implode(" AND ", $where) : "";

        // Count total items
        $sql_count = "SELECT COUNT(*) FROM {$table_name} a {$where_clause}";
        $total_items = $wpdb->get_var($wpdb->prepare($sql_count, $args));

        // Handle ordering
        $orderby = isset($_REQUEST['orderby']) ? sanitize_text_field($_REQUEST['orderby']) : 'action_time';
        $order = isset($_REQUEST['order']) && in_array(strtoupper($_REQUEST['order']), ['ASC', 'DESC']) 
            ? strtoupper($_REQUEST['order']) 
            : 'DESC';

        // Get items
        $sql = "SELECT a.*, u.display_name 
                FROM {$table_name} a 
                LEFT JOIN {$wpdb->users} u ON a.user_id = u.ID 
                {$where_clause}
                ORDER BY a.{$orderby} {$order}
                LIMIT %d OFFSET %d";

        $args[] = $per_page;
        $args[] = ($current_page - 1) * $per_page;

        $items = $wpdb->get_results($wpdb->prepare($sql, $args));

        // Process items
        foreach ($items as &$item) {
            if (!empty($item->details)) {
                $item->details = json_decode($item->details, true);
            } else {
                $item->details = [];
            }
        }

        $this->items = $items;

        // Configure pagination
        $this->set_pagination_args([
            'total_items' => $total_items,
            'per_page'    => $per_page,
            'total_pages' => ceil($total_items / $per_page)
        ]);
    }

    /**
     * Default column rendering
     *
     * @param object $item
     * @param string $column_name
     * @return string
     */
    public function column_default($item, $column_name) {
        switch ($column_name) {
            case 'action_time':
                if (function_exists('jdate')) {
                    return jdate(get_option('date_format') . ' ' . get_option('time_format'), strtotime($item->action_time));
                }
                return date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($item->action_time));

            case 'user':
                if (!$item->display_name) {
                    return __('کاربر حذف شده', 'hdm-crm');
                }
                return sprintf(
                    '<a href="%s">%s</a>',
                    esc_url(add_query_arg(['user_id' => $item->user_id])),
                    esc_html($item->display_name)
                );

            case 'action':
                return get_action_display_name($item->action);

            case 'context':
                return get_context_display_name($item->context);

            case 'details':
                return format_activity_details($item->details);

            default:
                return print_r($item, true);
        }
    }

    /**
     * Process bulk actions
     */
    public function process_bulk_action() {
        // Security check
        if (isset($_POST['_wpnonce']) && !empty($_POST['_wpnonce'])) {
            $nonce  = filter_input(INPUT_POST, '_wpnonce', FILTER_SANITIZE_STRING);
            $action = 'bulk-' . $this->_args['plural'];

            if (!wp_verify_nonce($nonce, $action)) {
                wp_die('Security check failed!');
            }
        }

        $action = $this->current_action();

        switch($action) {
            case 'delete':
                // Handle delete action
                if (isset($_POST['activity']) && is_array($_POST['activity'])) {
                    global $wpdb;
                    $table_name = $wpdb->prefix . USER_ACTIVITY_TABLE;
                    $ids = array_map('absint', $_POST['activity']);
                    $ids_string = implode(',', $ids);
                    
                    $wpdb->query("DELETE FROM $table_name WHERE id IN ($ids_string)");
                    
                    wp_redirect(add_query_arg(['message' => 'deleted'], wp_get_referer()));
                    exit;
                }
                break;
            
            default:
                // Do nothing
                break;
        }

        return;
    }

    /**
     * Get bulk actions
     *
     * @return array
     */
    public function get_bulk_actions() {
        $actions = [
            'delete' => __('حذف', 'hdm-crm')
        ];
        
        return $actions;
    }

    /**
     * Extra table navigation
     *
     * @param string $which
     */
    public function extra_tablenav($which) {
        if ($which !== 'top') {
            return;
        }

        $user_id = isset($_REQUEST['user_id']) ? absint($_REQUEST['user_id']) : 0;
        $context = isset($_REQUEST['context']) ? sanitize_text_field($_REQUEST['context']) : '';
        ?>
        <div class="alignleft actions">
            <?php
            // User dropdown
            wp_dropdown_users([
                'name' => 'user_id',
                'selected' => $user_id,
                'show_option_all' => __('همه کاربران', 'hdm-crm'),
                'class' => 'activity-user-filter'
            ]);

            // Context dropdown
            $contexts = [
                'authentication' => __('احراز هویت', 'hdm-crm'),
                'customer' => __('مشتری', 'hdm-crm'),
                'post' => __('نوشته', 'hdm-crm'),
                'page' => __('صفحه', 'hdm-crm'),
                'user' => __('کاربر', 'hdm-crm'),
                'comment' => __('دیدگاه', 'hdm-crm'),
                'media' => __('رسانه', 'hdm-crm'),
                'settings' => __('تنظیمات', 'hdm-crm'),
                'product' => __('محصول', 'hdm-crm'),
                'order' => __('سفارش', 'hdm-crm'),
            ];
            ?>
            <select name="context" id="context">
                <option value=""><?php _e('همه بخش‌ها', 'hdm-crm'); ?></option>
                <?php foreach ($contexts as $key => $label) : ?>
                    <option value="<?php echo esc_attr($key); ?>" <?php selected($context, $key); ?>>
                        <?php echo esc_html($label); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <?php submit_button(__('فیلتر', 'hdm-crm'), '', 'filter_action', false); ?>
        </div>
        <?php
    }
} 