<?php
/**
 * Custom Post Type Creator
 * 
 * A simple class to easily create WordPress custom post types
 */
namespace JTheme\CustomPostTypes;

use JTheme\Core\WP_Functions;

class CPT_Creator {
    use WP_Functions;
    
    /**
     * The post type name/key
     * @var string
     */
    private $post_type;
    
    /**
     * Post type arguments
     * @var array
     */
    private $args = [];
    
    /**
     * Constructor
     * 
     * @param string $post_type The post type key
     * @param string $singular Singular name
     * @param string $plural Plural name
     */
    public function __construct($post_type, $singular, $plural) {
        $this->check_wp_functions();
        $this->post_type = $post_type;
        
        // Set default labels
        $this->args['labels'] = [
            'name'               => $plural,
            'singular_name'      => $singular,
            'add_new'            => 'افزودن جدید',
            'add_new_item'       => 'افزودن ' . $singular . ' جدید',
            'edit_item'          => 'ویرایش ' . $singular,
            'new_item'           => $singular . ' جدید',
            'view_item'          => 'مشاهده ' . $singular,
            'search_items'       => 'جستجوی ' . $plural,
            'not_found'          => 'هیچ ' . $plural . ' یافت نشد',
            'not_found_in_trash' => 'هیچ ' . $plural . ' در سطل زباله یافت نشد',
            'parent_item_colon'  => $singular . ' والد:',
            'menu_name'          => $plural,
        ];
        
        // Set default arguments
        $this->args['public'] = true;
        $this->args['has_archive'] = true;
        $this->args['publicly_queryable'] = true;
        $this->args['show_ui'] = true;
        $this->args['show_in_menu'] = true;
        $this->args['query_var'] = true;
        $this->args['rewrite'] = ['slug' => $this->sanitize_title($plural)];
        $this->args['capability_type'] = 'post';
        $this->args['hierarchical'] = true;
        $this->args['menu_position'] = 5;
        $this->args['supports'] = ['title', 'editor', 'thumbnail', 'excerpt'];
        
        // Register the post type on init
        $this->add_action('init', [$this, 'register']);
    }
    
    /**
     * Set menu icon
     * 
     * @param string $icon Dashicon name or URL to icon
     * @return $this
     */
    public function icon($icon) {
        $this->args['menu_icon'] = $icon;
        return $this;
    }
    
    /**
     * Set hierarchical status
     * 
     * @param bool $hierarchical Whether the post type is hierarchical
     * @return $this
     */
    public function hierarchical($hierarchical = true) {
        $this->args['hierarchical'] = $hierarchical;
        return $this;
    }
    
    /**
     * Set the slug
     * 
     * @param string $slug Custom slug for post type
     * @return $this
     */
    public function slug($slug) {
        $this->args['rewrite'] = ['slug' => $slug];
        return $this;
    }
    
    /**
     * Set supports
     * 
     * @param array $supports Features this post type supports
     * @return $this
     */
    public function supports($supports = []) {
        $this->args['supports'] = $supports;
        return $this;
    }
    
    /**
     * Set taxonomies
     * 
     * @param array $taxonomies Taxonomies for this post type
     * @return $this
     */
    public function taxonomies($taxonomies = []) {
        $this->args['taxonomies'] = $taxonomies;
        return $this;
    }
    
    /**
     * Set REST API visibility
     * 
     * @param bool $show_in_rest Whether to show in REST API
     * @return $this
     */
    public function rest_api($show_in_rest = true) {
        $this->args['show_in_rest'] = $show_in_rest;
        return $this;
    }
    
    /**
     * Set archive status
     * 
     * @param bool $has_archive Whether post type has archive
     * @return $this
     */
    public function archive($has_archive = true) {
        $this->args['has_archive'] = $has_archive;
        return $this;
    }
    
    /**
     * Add custom argument
     * 
     * @param string $key Argument key
     * @param mixed $value Argument value
     * @return $this
     */
    public function set($key, $value) {
        $this->args[$key] = $value;
        return $this;
    }
    
    /**
     * Register the post type
     */
    public function register() {
        $this->register_post_type($this->post_type, $this->args);
    }
}