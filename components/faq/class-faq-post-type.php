<?php

/**
 * FAQ Custom Post Type
 *
 * Registers the FAQ custom post type and related taxonomy using the builder classes.
 *
 * @package JThem
 * @subpackage Components
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

use JTheme\CustomPostTypes\CPT_Creator;
use JTheme\CustomPostTypes\Taxonomy_Creator;
use JTheme\Admin\Metabox;

/**
 * FAQ_Post_Type Class
 * 
 * Handles the registration of the FAQ custom post type, taxonomy, and metaboxes.
 */
class JThem_FAQ_Post_Type
{

    /**
     * Singleton instance
     *
     * @var JThem_FAQ_Post_Type
     */
    private static $instance = null;

    /**
     * Post type name
     *
     * @var string
     */
    private $post_type = 'jthem_faq';

    /**
     * Taxonomy name
     *
     * @var string
     */
    private $taxonomy = 'jthem_faq_category';

    /**
     * Get the singleton instance
     *
     * @return JThem_FAQ_Post_Type
     */
    public static function get_instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    private function __construct()
    {
        // Register post type and taxonomy
        add_action('init', array($this, 'register_post_type_and_taxonomy'));

        // Register metabox for additional FAQ settings
        add_action('add_meta_boxes', array($this, 'register_metabox'));

        // Save metabox data
        add_action('save_post', array($this, 'save_metabox_data'));

        // Add shortcode support
        add_action('init', array($this, 'register_shortcode'));

        // Add admin menu items
        add_action('admin_menu', array($this, 'admin_menu'));

        // Add FAQ categories to the appearance > menus screen
        add_action('admin_init', array($this, 'add_faq_categories_to_menu'));

        // Create default categories if needed
        add_action('init', array($this, 'create_default_categories'));
    }

    /**
     * Register the FAQ post type and taxonomy
     */
    public function register_post_type_and_taxonomy()
    {
        // Try to use the builder classes first
        if (class_exists('JTheme\CustomPostTypes\CPT_Creator') && class_exists('JTheme\CustomPostTypes\Taxonomy_Creator')) {
            $this->register_with_builders();
        } else {
            // Fallback to direct registration
            $this->register_direct();
        }

        // Schedule a one-time rewrite flush
        add_action('shutdown', function () {
            update_option('jthem_faq_flush_needed', true);
        });
    }

    /**
     * Register using the builder classes
     */
    private function register_with_builders()
    {
        // Create the FAQ post type
        $faq_post_type = new CPT_Creator(
            $this->post_type,
            'FAQ Item',
            'سوالات متدوال'
        );

        // Configure the post type
        $faq_post_type->icon('dashicons-format-chat')
            ->supports(['title', 'editor', 'excerpt', 'thumbnail'])
            ->rest_api(true)
            ->set('menu_position', 20)
            ->set('show_in_menu', true)
            ->set('show_ui', true)
            ->set('publicly_queryable', true)
            ->set('public', true)
            ->set('has_archive', true)
            ->set('show_in_admin_bar', true)
            ->slug('faqs');

        // Create the FAQ category taxonomy
        $faq_taxonomy = new Taxonomy_Creator(
            $this->taxonomy,
            'FAQ Category',
            'دسته بندی سوالات',
            $this->post_type
        );

        // Configure the taxonomy
        $faq_taxonomy->hierarchical(true)
            ->rest_api(true)
            ->admin_column(true)
            ->slug('faq-categories')
            ->set('show_in_nav_menus', true)
            ->set('show_in_menu', true)
            ->set('show_admin_column', true)
            ->set('query_var', true)
            ->set('public', true)
            ->set('show_in_rest', true);

        // Force create the post type and taxonomy immediately
        global $wp_rewrite;
        $faq_post_type->register();
        $faq_taxonomy->register();
    }

    /**
     * Direct registration of post type and taxonomy without builder classes
     */
    private function register_direct()
    {
        // Register FAQ post type
        register_post_type($this->post_type, [
            'labels' => [
                'name' => __('سوالات متداول', 'JTheme'),
                'singular_name' => __('سوال متداول', 'JTheme'),
                'add_new' => __('افزودن جدید', 'JTheme'),
                'add_new_item' => __('افزودن سوال متداول جدید', 'JTheme'),
                'edit_item' => __('ویرایش سوال متداول', 'JTheme'),
                'new_item' => __('سوال متداول جدید', 'JTheme'),
                'view_item' => __('مشاهده سوال متداول', 'JTheme'),
                'search_items' => __('جستجوی سوالات متداول', 'JTheme'),
                'not_found' => __('هیچ سوال متداولی یافت نشد', 'JTheme'),
                'not_found_in_trash' => __('هیچ سوال متداولی در سطل زباله یافت نشد', 'JTheme'),
                'menu_name' => __('سوالات متداول', 'JTheme'),
            ],
            'public' => true,
            'has_archive' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 20,
            'menu_icon' => 'dashicons-format-chat',
            'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
            'rewrite' => ['slug' => 'faqs'],
            'show_in_rest' => true,
            'show_in_admin_bar' => true,
            'publicly_queryable' => true,
        ]);

        // Register FAQ category taxonomy
        register_taxonomy($this->taxonomy, $this->post_type, [
            'labels' => [
                'name' => __('دسته بندی سوالات متداول', 'JTheme'),
                'singular_name' => __('دسته بندی سوال متداول', 'JTheme'),
                'search_items' => __('جستجوی دسته بندی های سوالات متداول', 'JTheme'),
                'popular_items' => __('دسته بندی های محبوب سوالات متداول', 'JTheme'),
                'all_items' => __('همه دسته بندی های سوالات متداول', 'JTheme'),
                'edit_item' => __('ویرایش دسته بندی سوال متداول', 'JTheme'),
                'update_item' => __('به روز رسانی دسته بندی سوال متداول', 'JTheme'),
                'add_new_item' => __('افزودن دسته بندی سوال متداول جدید', 'JTheme'),
                'new_item_name' => __('نام دسته بندی سوال متداول جدید', 'JTheme'),
                'menu_name' => __('دسته بندی ها', 'JTheme'),
            ],
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => ['slug' => 'faq-categories'],
            'show_in_rest' => true,
            'show_in_nav_menus' => true,
            'public' => true,
        ]);
    }

    /**
     * Register FAQ metabox
     */
    public function register_metabox()
    {
        if (class_exists('JTheme\Admin\Metabox')) {
            $metabox = new Metabox(
                'jthem_faq_settings',
                'تنظیمات',
                $this->post_type
            );

            // Add fields to the metabox
            $metabox->add_checkbox('is_open', 'Show as open by default')
                ->add_select('icon_type', 'Icon Type', [
                    'plus' => 'Plus/Minus',
                    'chevron' => 'Chevron Up/Down'
                ]);
        } else {
            // Fallback if Metabox class is not available
            add_meta_box(
                'jthem_faq_settings',
                'تنظیمات سوالات متدوال',
                [$this, 'render_metabox'],
                $this->post_type,
                'side',
                'default'
            );
        }
    }

    /**
     * Fallback metabox rendering
     *
     * @param WP_Post $post The post object
     */
    public function render_metabox($post)
    {
        // Retrieve current values
        $is_open = get_post_meta($post->ID, '_jthem_faq_is_open', true);
        $icon_type = get_post_meta($post->ID, '_jthem_faq_icon_type', true) ?: 'plus';

        // Add nonce for security
        wp_nonce_field('jthem_faq_settings_nonce', 'jthem_faq_settings_nonce');
?>
        <p>
            <label>
                <input type="checkbox" name="jthem_faq_is_open" value="1" <?php checked($is_open, '1'); ?>>
                <?php esc_html_e('Show as open by default', 'JTheme'); ?>
            </label>
        </p>
        <p>
            <label for="jthem_faq_icon_type"><?php esc_html_e('Icon Type', 'JTheme'); ?></label>
            <select name="jthem_faq_icon_type" id="jthem_faq_icon_type" class="widefat">
                <option value="plus" <?php selected($icon_type, 'plus'); ?>><?php esc_html_e('Plus/Minus', 'JTheme'); ?></option>
                <option value="chevron" <?php selected($icon_type, 'chevron'); ?>><?php esc_html_e('Chevron Up/Down', 'JTheme'); ?></option>
            </select>
        </p>
    <?php
    }

    /**
     * Save metabox data
     *
     * @param int $post_id The post ID
     */
    public function save_metabox_data($post_id)
    {
        // Check if our nonce is set
        if (!isset($_POST['jthem_faq_settings_nonce'])) {
            return;
        }

        // Verify the nonce
        if (!wp_verify_nonce($_POST['jthem_faq_settings_nonce'], 'jthem_faq_settings_nonce')) {
            return;
        }

        // If this is an autosave, we don't want to do anything
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Check the user's permissions
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Save the is_open setting
        $is_open = isset($_POST['jthem_faq_is_open']) ? '1' : '0';
        update_post_meta($post_id, '_jthem_faq_is_open', $is_open);

        // Save the icon type
        if (isset($_POST['jthem_faq_icon_type'])) {
            $icon_type = sanitize_text_field($_POST['jthem_faq_icon_type']);
            update_post_meta($post_id, '_jthem_faq_icon_type', $icon_type);
        }
    }

    /**
     * Register the FAQ shortcode
     */
    public function register_shortcode()
    {
        add_shortcode('jthem_faq', array($this, 'shortcode_callback'));
    }

    /**
     * Handle the FAQ shortcode
     *
     * @param array $atts Shortcode attributes
     * @return string Shortcode output
     */
    public function shortcode_callback($atts)
    {
        $atts = shortcode_atts(array(
            'category' => '',        // Comma-separated category slugs
            'exclude_category' => '', // Comma-separated category slugs to exclude
            'limit' => -1,           // Number of items to show
            'orderby' => 'date',     // Order by field
            'order' => 'DESC',       // Order direction
            'title' => 'سوالات متداول', // Section title
            'subtitle' => '',        // Section subtitle
            'accordion_type' => 'single', // single or multiple
            'icon_open' => 'plus',   // Icon type for open state
            'icon_close' => 'minus', // Icon type for closed state
            'ids' => '',             // Comma-separated IDs
            'show_category_title' => false, // Whether to show category title for each group
        ), $atts, 'jthem_faq');

        // Check if we should show by categories
        $by_category = filter_var($atts['show_category_title'], FILTER_VALIDATE_BOOLEAN);

        // If we're showing by category and no specific category is selected
        if ($by_category && empty($atts['category']) && empty($atts['ids'])) {
            return $this->render_faq_by_categories($atts);
        }

        // Build query args
        $args = array(
            'post_type' => $this->post_type,
            'posts_per_page' => $atts['limit'],
            'orderby' => $atts['orderby'],
            'order' => $atts['order'],
        );

        // Filter by category if specified
        if (!empty($atts['category'])) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $this->taxonomy,
                    'field' => 'slug',
                    'terms' => explode(',', $atts['category']),
                ),
            );
        }

        // Exclude categories if specified
        if (!empty($atts['exclude_category'])) {
            if (!isset($args['tax_query'])) {
                $args['tax_query'] = array();
            }

            $args['tax_query'][] = array(
                'taxonomy' => $this->taxonomy,
                'field' => 'slug',
                'terms' => explode(',', $atts['exclude_category']),
                'operator' => 'NOT IN',
            );
        }

        // Filter by specific IDs if specified
        if (!empty($atts['ids'])) {
            $args['post__in'] = explode(',', $atts['ids']);
            $args['orderby'] = 'post__in';
        }

        // Run the query
        $faq_query = new WP_Query($args);

        // If no FAQs found, return empty
        if (!$faq_query->have_posts()) {
            return '';
        }

        // Prepare items for the FAQ component
        $faq_items = array();
        while ($faq_query->have_posts()) {
            $faq_query->the_post();
            $post_id = get_the_ID();

            $faq_items[] = array(
                'question' => get_the_title(),
                'answer' => get_the_content(),
                'is_open' => get_post_meta($post_id, '_jthem_faq_is_open', true) == '1',
            );
        }

        // Reset post data
        wp_reset_postdata();

        // Create FAQ component args
        $faq_args = array(
            'title' => $atts['title'],
            'subtitle' => $atts['subtitle'],
            'items' => $faq_items,
            'accordion_type' => $atts['accordion_type'],
            'icon_open' => $atts['icon_open'],
            'icon_close' => $atts['icon_close'],
        );

        // Instantiate FAQ class and render
        $faq = new JThem_FAQ($faq_args);
        return $faq->render();
    }

    /**
     * Render FAQs grouped by categories
     *
     * @param array $atts Shortcode attributes
     * @return string Rendered HTML
     */
    protected function render_faq_by_categories($atts)
    {
        // Get all categories
        $categories = get_terms(array(
            'taxonomy' => $this->taxonomy,
            'hide_empty' => true,
        ));

        if (empty($categories)) {
            return '';
        }

        // Start output buffer
        ob_start();

        // Main title and subtitle
        if (!empty($atts['title'])) {
            echo '<div class="faq-main-title">';
            echo '<h2 class="text-3xl font-bold text-gray-800 mb-3">' . esc_html($atts['title']) . '</h2>';

            if (!empty($atts['subtitle'])) {
                echo '<p class="text-gray-600">' . esc_html($atts['subtitle']) . '</p>';
            }

            echo '</div>';
        }

        // Loop through each category
        foreach ($categories as $category) {
            // Skip excluded categories
            if (!empty($atts['exclude_category'])) {
                $excluded = explode(',', $atts['exclude_category']);
                if (in_array($category->slug, $excluded)) {
                    continue;
                }
            }

            // Category specific attributes
            $cat_atts = $atts;
            $cat_atts['category'] = $category->slug;
            $cat_atts['title'] = $category->name;
            $cat_atts['subtitle'] = '';
            $cat_atts['show_category_title'] = false; // Prevent infinite recursion

            // Get FAQs for this category
            echo '<div class="faq-category mb-10">';
            echo '<h3 class="text-2xl font-semibold text-gray-700 mb-4">' . esc_html($category->name) . '</h3>';

            // Get FAQs for this category
            echo $this->shortcode_callback($cat_atts);

            echo '</div>';
        }

        return ob_get_clean();
    }

    /**
     * Add admin submenu
     */
    public function admin_menu()
    {
        // Add submenu under the existing post type menu
        add_submenu_page(
            'edit.php?post_type=' . $this->post_type,
            __('تنظیمات سوالات متدوال', 'JTheme'),
            __('Settings', 'JTheme'),
            'manage_options',
            'jthem-faq-settings',
            array($this, 'render_settings_page')
        );
    }

    /**
     * Render settings page
     */
    public function render_settings_page()
    {
    ?>
        <div class="wrap">
            <h1><?php echo esc_html__('FAQ Settings', 'JTheme'); ?></h1>

            <div class="notice notice-info">
                <p><?php echo esc_html__('Use the shortcode below to display FAQs on your site:', 'JTheme'); ?></p>
                <code>[jthem_faq category="category-slug" limit="5" title="سوالات متداول" subtitle="پاسخ به سوالات رایج"]</code>
                <p><?php echo esc_html__('Or specify FAQ item IDs:', 'JTheme'); ?></p>
                <code>[jthem_faq ids="1,2,3" title="سوالات متداول" subtitle="پاسخ به سوالات رایج"]</code>
            </div>

            <h2><?php echo esc_html__('Available Parameters', 'JTheme'); ?></h2>
            <table class="widefat">
                <thead>
                    <tr>
                        <th><?php echo esc_html__('Parameter', 'JTheme'); ?></th>
                        <th><?php echo esc_html__('Description', 'JTheme'); ?></th>
                        <th><?php echo esc_html__('Default', 'JTheme'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>category</code></td>
                        <td><?php echo esc_html__('Comma-separated list of category slugs', 'JTheme'); ?></td>
                        <td><em><?php echo esc_html__('Empty (all categories)', 'JTheme'); ?></em></td>
                    </tr>
                    <tr>
                        <td><code>exclude_category</code></td>
                        <td><?php echo esc_html__('Comma-separated list of category slugs to exclude', 'JTheme'); ?></td>
                        <td><em><?php echo esc_html__('Empty (no exclusion)', 'JTheme'); ?></em></td>
                    </tr>
                    <tr>
                        <td><code>ids</code></td>
                        <td><?php echo esc_html__('Comma-separated list of FAQ IDs', 'JTheme'); ?></td>
                        <td><em><?php echo esc_html__('Empty (all FAQs)', 'JTheme'); ?></em></td>
                    </tr>
                    <tr>
                        <td><code>limit</code></td>
                        <td><?php echo esc_html__('Number of FAQs to display', 'JTheme'); ?></td>
                        <td><code>-1</code> (<?php echo esc_html__('all', 'JTheme'); ?>)</td>
                    </tr>
                    <tr>
                        <td><code>orderby</code></td>
                        <td><?php echo esc_html__('Sort by field (date, title, menu_order)', 'JTheme'); ?></td>
                        <td><code>date</code></td>
                    </tr>
                    <tr>
                        <td><code>order</code></td>
                        <td><?php echo esc_html__('Sort order (ASC or DESC)', 'JTheme'); ?></td>
                        <td><code>DESC</code></td>
                    </tr>
                    <tr>
                        <td><code>title</code></td>
                        <td><?php echo esc_html__('FAQ section title', 'JTheme'); ?></td>
                        <td><code>سوالات متداول</code></td>
                    </tr>
                    <tr>
                        <td><code>subtitle</code></td>
                        <td><?php echo esc_html__('FAQ section subtitle', 'JTheme'); ?></td>
                        <td><em><?php echo esc_html__('Empty', 'JTheme'); ?></em></td>
                    </tr>
                    <tr>
                        <td><code>accordion_type</code></td>
                        <td><?php echo esc_html__('Whether multiple items can be open (single or multiple)', 'JTheme'); ?></td>
                        <td><code>single</code></td>
                    </tr>
                    <tr>
                        <td><code>show_category_title</code></td>
                        <td><?php echo esc_html__('Show FAQs grouped by category with category titles', 'JTheme'); ?></td>
                        <td><code>false</code></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php
    }

    /**
     * Migration function to convert old FAQ items to CPT
     * 
     * @return int|WP_Error Number of items migrated or error
     */
    public function migrate_from_options()
    {
        // Get old FAQ items
        $old_faq_items = get_option('jthem_faq_items', array());

        if (empty($old_faq_items)) {
            return 0;
        }

        $migrated = 0;

        // Loop through old items and create posts
        foreach ($old_faq_items as $id => $item) {
            // Create post
            $post_id = wp_insert_post(array(
                'post_title'   => $item['question'],
                'post_content' => $item['answer'],
                'post_status'  => 'publish',
                'post_type'    => $this->post_type,
            ));

            if (!is_wp_error($post_id)) {
                // Set is_open meta
                update_post_meta($post_id, '_jthem_faq_is_open', isset($item['is_open']) && $item['is_open'] ? '1' : '0');

                // Set default icon type
                update_post_meta($post_id, '_jthem_faq_icon_type', 'plus');

                $migrated++;
            }
        }

        return $migrated;
    }

    /**
     * Add FAQ categories to the nav menu admin interface
     */
    public function add_faq_categories_to_menu()
    {
        // Make the taxonomy available in the menu editor
        add_filter('register_taxonomy_args', function ($args, $taxonomy) {
            if ($taxonomy === $this->taxonomy) {
                $args['show_in_nav_menus'] = true;
            }
            return $args;
        }, 10, 2);

        // Add meta box for FAQ categories in the menu editor
        add_action('admin_head-nav-menus.php', function () {
            add_meta_box(
                'faq-category-nav-menu-metabox',
                __('FAQ Categories', 'JTheme'),
                array($this, 'display_faq_categories_menu_metabox'),
                'nav-menus',
                'side',
                'default'
            );
        });
    }

    /**
     * Display FAQ categories in the menu editor
     */
    public function display_faq_categories_menu_metabox()
    {
        $terms = get_terms([
            'taxonomy' => $this->taxonomy,
            'hide_empty' => false,
        ]);

        if (empty($terms)) {
            echo '<p>' . __('No FAQ categories found.', 'JTheme') . '</p>';
            echo '<p><a href="' . admin_url('edit-tags.php?taxonomy=' . $this->taxonomy . '&post_type=' . $this->post_type) . '">' . __('Create some FAQ categories', 'JTheme') . '</a></p>';
            return;
        }

        $walker = new Walker_Nav_Menu_Checklist([]);

        echo '<div id="taxonomy-' . $this->taxonomy . '" class="taxonomydiv">';
        echo '<div id="tabs-panel-' . $this->taxonomy . '" class="tabs-panel tabs-panel-active">';
        echo '<ul id="' . $this->taxonomy . '-checklist" class="categorychecklist form-no-clear">';

        echo walk_nav_menu_tree(
            array_map(
                function ($term) {
                    $term->object_id = $term->term_id;
                    $term->title = $term->name;
                    $term->object = $this->taxonomy;
                    $term->type = 'taxonomy';
                    $term->menu_item_parent = 0;
                    $term->url = get_term_link($term, $this->taxonomy);
                    $term->db_id = 0;
                    $term->target = '';
                    $term->classes = array();
                    $term->xfn = '';
                    $term->description = '';

                    return $term;
                },
                $terms
            ),
            0,
            (object) array('walker' => $walker)
        );

        echo '</ul>';
        echo '</div>';
        echo '</div>';

        echo '<p class="button-controls wp-clearfix">';
        echo '<span class="add-to-menu">';
        echo '<input type="submit" name="add-taxonomy-menu-item" id="submit-taxonomy-' . $this->taxonomy . '" class="button-secondary submit-add-to-menu right" value="' . __('Add to Menu', 'JTheme') . '" />';
        echo '<span class="spinner"></span>';
        echo '</span>';
        echo '</p>';
    }

    /**
     * Create default FAQ categories if none exist
     */
    public function create_default_categories()
    {
        // Only run this once when the plugin is first activated
        if (get_option('jthem_faq_defaults_created') === 'yes') {
            return;
        }

        // Default categories
        $default_categories = array(
            'general' => __('General', 'JTheme'),
            'products' => __('Products', 'JTheme'),
            'shipping' => __('Shipping & Delivery', 'JTheme'),
            'returns' => __('Returns & Refunds', 'JTheme'),
            'account' => __('Account & Orders', 'JTheme')
        );

        // Create each category if it doesn't exist
        foreach ($default_categories as $slug => $name) {
            if (!term_exists($slug, $this->taxonomy)) {
                wp_insert_term(
                    $name,
                    $this->taxonomy,
                    array(
                        'slug' => $slug,
                        'description' => sprintf(__('FAQ questions about %s', 'JTheme'), strtolower($name))
                    )
                );
            }
        }

        // Mark as completed so we don't run this again
        update_option('jthem_faq_defaults_created', 'yes');
    }
}

// Initialize the FAQ post type
function jthem_init_faq_post_type()
{
    JThem_FAQ_Post_Type::get_instance();
}
// Use 'init' with priority 5 to ensure it runs early, before any other code that might need these post types
add_action('init', 'jthem_init_faq_post_type', 5);

// Add migration tool to convert old FAQ items to CPT format
function jthem_faq_migrate_tool()
{
    // Only show to admins
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_POST['jthem_migrate_faq']) && isset($_POST['jthem_migrate_faq_nonce'])) {
        if (wp_verify_nonce($_POST['jthem_migrate_faq_nonce'], 'jthem_migrate_faq')) {
            $migrated = JThem_FAQ_Post_Type::get_instance()->migrate_from_options();

            if (is_wp_error($migrated)) {
                add_settings_error(
                    'jthem_faq_migrate',
                    'migration_failed',
                    $migrated->get_error_message(),
                    'error'
                );
            } else {
                add_settings_error(
                    'jthem_faq_migrate',
                    'migration_success',
                    sprintf(
                        __('%d FAQ items migrated successfully.', 'JTheme'),
                        $migrated
                    ),
                    'updated'
                );
            }
        }
    }

    // Get count of old FAQ items
    $old_faq_items = get_option('jthem_faq_items', array());
    $count = count($old_faq_items);

    if ($count > 0) {
    ?>
        <div class="card">
            <h2><?php esc_html_e('Migrate FAQ Items', 'JTheme'); ?></h2>
            <p>
                <?php printf(
                    esc_html__('Found %d FAQ items in the old format. Would you like to migrate them to the new custom post type format?', 'JTheme'),
                    $count
                ); ?>
            </p>
            <form method="post">
                <?php wp_nonce_field('jthem_migrate_faq', 'jthem_migrate_faq_nonce'); ?>
                <p>
                    <input type="submit" name="jthem_migrate_faq" class="button button-primary" value="<?php esc_attr_e('Migrate FAQ Items', 'JTheme'); ?>">
                </p>
                <p class="description">
                    <?php esc_html_e('Note: This will not delete your existing FAQ items. It will create new custom post type entries for each item.', 'JTheme'); ?>
                </p>
            </form>
        </div>
<?php
    }
}
add_action('jthem-faq-settings', 'jthem_faq_migrate_tool');
