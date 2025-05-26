<?php

/**
 * Plugin Name: Custom Banner Manager
 * Description: Allows admins to upload and display custom banners on specific pages with responsive design
 * Version: 1.0.0
 * Author: Claude
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class Custom_Banner_Manager
{
    private $post_type = 'custom_banner';
    private $meta_key_pages = 'banner_display_pages';
    private $meta_key_mobile = 'banner_mobile_image';

    public function __construct()
    {
        // Register custom post type for banners
        add_action('init', array($this, 'register_banner_post_type'));

        // Add meta boxes
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));

        // Save meta data
        add_action('save_post', array($this, 'save_meta_data'));

        // Enqueue admin styles and scripts
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));

        // Enqueue frontend styles
        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_styles'));

        // Display banner on frontend
        // add_action('wp_head', array($this, 'setup_banner_display'));
    }

    /**
     * Register custom post type for banners
     */
    public function register_banner_post_type()
    {
        $labels = array(
            'name'                  => 'بنرها',
            'singular_name'         => 'بنر',
            'menu_name'             => 'بنرها',
            'add_new'               => 'افزودن جدید',
            'add_new_item'          => 'افزودن بنر جدید',
            'edit_item'             => 'ویرایش بنر',
            'new_item'              => 'بنر جدید',
            'view_item'             => 'مشاهده بنر',
            'search_items'          => 'جستجوی بنرها',
            'not_found'             => 'هیچ بنری یافت نشد',
            'not_found_in_trash'    => 'هیچ بنری در سطل زباله یافت نشد',
        );

        $args = array(
            'labels'                => $labels,
            'public'                => false,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_icon'             => 'dashicons-format-gallery',
            'capability_type'       => 'post',
            'hierarchical'          => false,
            'supports'              => array('title', 'thumbnail'),
            'menu_position'         => 20,
        );

        register_post_type($this->post_type, $args);
    }

    /**
     * Add meta boxes for banner settings
     */
    public function add_meta_boxes()
    {
        add_meta_box(
            'banner_display_pages',
            'Display Settings',
            array($this, 'render_pages_meta_box'),
            $this->post_type,
            'normal',
            'high'
        );

        add_meta_box(
            'banner_mobile_image',
            'Mobile Banner Image',
            array($this, 'render_mobile_image_meta_box'),
            $this->post_type,
            'normal',
            'high'
        );
    }

    /**
     * Render meta box for selecting pages
     */
    public function render_pages_meta_box($post)
    {
        wp_nonce_field('banner_meta_box', 'banner_meta_box_nonce');

        // Get saved pages
        $saved_pages = get_post_meta($post->ID, $this->meta_key_pages, true);
        if (!is_array($saved_pages)) {
            $saved_pages = array();
        }

        // Get all pages
        $pages = get_pages(array('sort_column' => 'post_title', 'sort_order' => 'ASC'));

        // Get all public custom post types
        $custom_post_types = get_post_types(array('public' => true, '_builtin' => false), 'objects');

        echo '<p>Select the pages where this banner should be displayed:</p>';
        echo '<div class="banner-pages-container" style="max-height: 300px; overflow-y: auto; padding: 10px; border: 1px solid #ddd;">';

        // Add option for front page
        echo '<label style="display: block; margin-bottom: 5px;">';
        echo '<input type="checkbox" name="banner_pages[]" value="front_page" ' . (in_array('front_page', $saved_pages) ? 'checked' : '') . '>';
        echo ' Front Page</label>';

        // List all pages
        echo '<h4>Pages</h4>';
        foreach ($pages as $page) {
            echo '<label style="display: block; margin-bottom: 5px;">';
            echo '<input type="checkbox" name="banner_pages[]" value="page_' . esc_attr($page->ID) . '" ' . (in_array('page_' . $page->ID, $saved_pages) ? 'checked' : '') . '>';
            echo ' ' . esc_html($page->post_title) . '</label>';
        }

        // List all public custom post types
        foreach ($custom_post_types as $post_type) {
            echo '<h4>' . esc_html($post_type->labels->name) . '</h4>';

            // Get all posts of this custom post type
            $custom_posts = get_posts(array(
                'post_type' => $post_type->name,
                'numberposts' => -1,
                'orderby' => 'title',
                'order' => 'ASC'
            ));

            foreach ($custom_posts as $custom_post) {
                echo '<label style="display: block; margin-bottom: 5px;">';
                echo '<input type="checkbox" name="banner_pages[]" value="' . esc_attr($post_type->name) . '_' . esc_attr($custom_post->ID) . '" ' . (in_array($post_type->name . '_' . $custom_post->ID, $saved_pages) ? 'checked' : '') . '>';
                echo ' ' . esc_html($custom_post->post_title) . '</label>';
            }

            // Option to display on all posts of this type
            echo '<label style="display: block; margin-bottom: 5px; font-weight: bold;">';
            echo '<input type="checkbox" name="banner_pages[]" value="all_' . esc_attr($post_type->name) . '" ' . (in_array('all_' . $post_type->name, $saved_pages) ? 'checked' : '') . '>';
            echo ' All ' . esc_html($post_type->labels->name) . '</label>';
        }

        echo '</div>';
    }

    /**
     * Render meta box for mobile banner image
     */
    public function render_mobile_image_meta_box($post)
    {
        $mobile_image_id = get_post_meta($post->ID, $this->meta_key_mobile, true);
        $mobile_image = wp_get_attachment_image_src($mobile_image_id, 'medium');
?>
        <p>Upload a separate image optimized for mobile devices:</p>
        <div class="mobile-image-container">
            <div class="mobile-image-preview" style="margin-bottom: 10px;">
                <?php if ($mobile_image) : ?>
                    <img src="<?php echo esc_url($mobile_image[0]); ?>" style="max-width: 100%; height: auto;">
                <?php endif; ?>
            </div>
            <input type="hidden" name="mobile_banner_image_id" id="mobile_banner_image_id" value="<?php echo esc_attr($mobile_image_id); ?>">
            <button type="button" class="button mobile-image-upload" id="mobile_image_upload">
                <?php echo $mobile_image ? 'Change Mobile Banner' : 'Upload Mobile Banner'; ?>
            </button>
            <?php if ($mobile_image) : ?>
                <button type="button" class="button mobile-image-remove" id="mobile_image_remove">Remove Mobile Banner</button>
            <?php endif; ?>
        </div>
        <p class="description">Recommended mobile banner size: 768px × 300px</p>
        <p class="description">Main featured image will be used for desktop (recommended size: 1920px × 500px)</p>
<?php
    }

    /**
     * Save meta data when post is saved
     */
    public function save_meta_data($post_id)
    {
        // Check if nonce is set
        if (!isset($_POST['banner_meta_box_nonce'])) {
            return;
        }

        // Verify nonce
        if (!wp_verify_nonce($_POST['banner_meta_box_nonce'], 'banner_meta_box')) {
            return;
        }

        // Check if autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Check permissions
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Save selected pages
        if (isset($_POST['banner_pages'])) {
            update_post_meta($post_id, $this->meta_key_pages, $_POST['banner_pages']);
        } else {
            update_post_meta($post_id, $this->meta_key_pages, array());
        }

        // Save mobile image
        if (isset($_POST['mobile_banner_image_id'])) {
            update_post_meta($post_id, $this->meta_key_mobile, sanitize_text_field($_POST['mobile_banner_image_id']));
        }
    }

    /**
     * Enqueue admin scripts and styles
     */
    public function enqueue_admin_scripts($hook) {}

    /**
     * Enqueue frontend styles
     */
    public function enqueue_frontend_styles() {}

    /**
     * Set up banner display on frontend
     */
    // public function setup_banner_display() {
    //     // Check if we're on a page where a banner should be displayed
    //     $current_banner_id = $this->get_current_page_banner();

    //     if ($current_banner_id) {
    //         // Add content hook at appropriate position
    //         add_action('your_theme_after_header', array($this, 'display_banner'));

    //         // If the theme doesn't have a hook after the header, use wp_body_open as fallback
    //         add_action('wp_body_open', array($this, 'display_banner'));
    //     }
    // }

    /**
     * Get appropriate banner for current page
     */
    public function get_current_page_banner()
    {
        $page_identifier = $this->get_current_page_identifier();

        if (!$page_identifier) {
            return false;
        }

        // Find banner that should be displayed on this page
        $args = array(
            'post_type' => $this->post_type,
            'posts_per_page' => 1,
            'meta_query' => array(
                array(
                    'key' => $this->meta_key_pages,
                    'value' => $page_identifier,
                    'compare' => 'LIKE'
                )
            )
        );

        $banners = get_posts($args);

        if (!empty($banners)) {
            return $banners[0]->ID;
        }

        // Check for "all posts of this type" setting
        $post_type = get_post_type();
        if ($post_type) {
            $args = array(
                'post_type' => $this->post_type,
                'posts_per_page' => 1,
                'meta_query' => array(
                    array(
                        'key' => $this->meta_key_pages,
                        'value' => 'all_' . $post_type,
                        'compare' => 'LIKE'
                    )
                )
            );

            $banners = get_posts($args);

            if (!empty($banners)) {
                return $banners[0]->ID;
            }
        }

        return false;
    }

    /**
     * Get identifier for current page
     */
    public function get_current_page_identifier()
    {
        if (is_front_page()) {
            return 'front_page';
        } elseif (is_page()) {
            return 'page_' . get_the_ID();
        } elseif (is_singular()) {
            return get_post_type() . '_' . get_the_ID();
        }

        return false;
    }

    /**
     * Display banner on frontend
     */
    public function display_banner()
    {
        $current_banner_id = $this->get_current_page_banner();

        if (!$current_banner_id) {
            return;
        }

        // Get banner images
        $desktop_image_id = get_post_thumbnail_id($current_banner_id);
        $mobile_image_id = get_post_meta($current_banner_id, $this->meta_key_mobile, true);

        if (!$desktop_image_id) {
            return;
        }

        $desktop_image = wp_get_attachment_image_src($desktop_image_id, 'full');
        $mobile_image = $mobile_image_id ? wp_get_attachment_image_src($mobile_image_id, 'full') : null;

        if (!$desktop_image) {
            return;
        }

        // Get banner title for alt text
        $banner_title = get_the_title($current_banner_id);

        echo '<div class="custom-banner-container">';

        if ($mobile_image) {
            // If we have both desktop and mobile images, use picture element for responsive switching
            echo '<picture>';
            echo '<source media="(max-width: 768px)" srcset="' . esc_url($mobile_image[0]) . '">';
            echo '<img src="' . esc_url($desktop_image[0]) . '" alt="' . esc_attr($banner_title) . '" class="custom-banner">';
            echo '</picture>';
        } else {
            // If we only have desktop image, use it with responsive CSS
            echo '<img src="' . esc_url($desktop_image[0]) . '" alt="' . esc_attr($banner_title) . '" class="custom-banner">';
        }

        echo '</div>';
    }
}

// Initialize the plugin
$custom_banner_manager = new Custom_Banner_Manager();

/**
 * Function to display banner in your theme
 * Use this function in your theme where you want to display the banner
 */
// function display_custom_banner() {
//     do_action('your_theme_after_header');
// }