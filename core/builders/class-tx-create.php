<?php
/**
 * Taxonomy Creator
 * 
 * A simple class to easily create WordPress taxonomies
 */
namespace JTheme\CustomPostTypes;

use JTheme\Core\WP_Functions;

class Taxonomy_Creator {
    use WP_Functions;
    
    /**
     * The taxonomy name/key
     * @var string
     */
    private $taxonomy;
    
    /**
     * Post types to attach this taxonomy to
     * @var array
     */
    private $post_types = [];
    
    /**
     * Taxonomy arguments
     * @var array
     */
    private $args = [];
    
    /**
     * Constructor
     * 
     * @param string $taxonomy The taxonomy key
     * @param string $singular Singular name
     * @param string $plural Plural name
     * @param array|string $post_types Post type(s) to attach to
     */
    public function __construct($taxonomy, $singular, $plural, $post_types = []) {
        $this->check_wp_functions();
        $this->taxonomy = $taxonomy;
        $this->post_types = is_array($post_types) ? $post_types : [$post_types];
        
        // Set default labels
        $this->args['labels'] = [
            'name'                       => $plural,
            'singular_name'              => $singular,
            'search_items'               => 'Search ' . $plural,
            'popular_items'              => 'Popular ' . $plural,
            'all_items'                  => 'All ' . $plural,
            'parent_item'                => 'Parent ' . $singular,
            'parent_item_colon'          => 'Parent ' . $singular . ':',
            'edit_item'                  => 'Edit ' . $singular,
            'update_item'                => 'Update ' . $singular,
            'add_new_item'               => 'Add New ' . $singular,
            'new_item_name'              => 'New ' . $singular . ' Name',
            'separate_items_with_commas' => 'Separate ' . $plural . ' with commas',
            'add_or_remove_items'        => 'Add or remove ' . $plural,
            'choose_from_most_used'      => 'Choose from the most used ' . $plural,
            'menu_name'                  => $plural,
        ];
        
        // Set default arguments
        $this->args['public'] = true;
        $this->args['hierarchical'] = true; // Like categories by default
        $this->args['show_ui'] = true;
        $this->args['show_admin_column'] = true;
        $this->args['query_var'] = true;
        $this->args['rewrite'] = ['slug' => $this->sanitize_title($plural)];
        
        // Register the taxonomy on init
        $this->add_action('init', [$this, 'register']);
    }
    
    /**
     * Set hierarchical status
     * 
     * @param bool $hierarchical Whether the taxonomy is hierarchical (like categories)
     * @return $this
     */
    public function hierarchical($hierarchical = true) {
        $this->args['hierarchical'] = $hierarchical;
        return $this;
    }
    
    /**
     * Make taxonomy like tags (non-hierarchical)
     * 
     * @return $this
     */
    public function tags() {
        $this->args['hierarchical'] = false;
        return $this;
    }
    
    /**
     * Make taxonomy like categories (hierarchical)
     * 
     * @return $this
     */
    public function categories() {
        $this->args['hierarchical'] = true;
        return $this;
    }
    
    /**
     * Set the slug
     * 
     * @param string $slug Custom slug for taxonomy
     * @return $this
     */
    public function slug($slug) {
        $this->args['rewrite'] = ['slug' => $slug];
        return $this;
    }
    
    /**
     * Show in admin column
     * 
     * @param bool $show Whether to show in admin column
     * @return $this
     */
    public function admin_column($show = true) {
        $this->args['show_admin_column'] = $show;
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
     * Register the taxonomy
     */
    public function register() {
        $this->register_taxonomy($this->taxonomy, $this->post_types, $this->args);
    }
}