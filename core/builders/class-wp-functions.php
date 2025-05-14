<?php
/**
 * WordPress Functions Trait
 * 
 * Provides access to WordPress core functions
 */
namespace JTheme\Core;

trait WP_Functions {
    /**
     * Check if WordPress functions are available
     */
    protected function check_wp_functions() {
        if (!function_exists('add_action')) {
            throw new \RuntimeException('WordPress core functions are not available.');
        }
    }

    /**
     * Sanitize a title
     */
    protected function sanitize_title($title) {
        return \sanitize_title($title);
    }

    /**
     * Add an action hook
     */
    protected function add_action($hook, $callback, $priority = 10, $accepted_args = 1) {
        \add_action($hook, $callback, $priority, $accepted_args);
    }

    /**
     * Register a post type
     */
    protected function register_post_type($post_type, $args) {
        return \register_post_type($post_type, $args);
    }

    /**
     * Register a taxonomy
     */
    protected function register_taxonomy($taxonomy, $object_type, $args) {
        return \register_taxonomy($taxonomy, $object_type, $args);
    }

    /**
     * Add a meta box
     */
    protected function add_meta_box($id, $title, $callback, $screen = null, $context = 'advanced', $priority = 'default', $callback_args = null) {
        \add_meta_box($id, $title, $callback, $screen, $context, $priority, $callback_args);
    }

    /**
     * WordPress escaping functions
     */
    protected function esc_attr($text) {
        return \esc_attr($text);
    }

    protected function esc_html($text) {
        return \esc_html($text);
    }

    protected function esc_url($url) {
        return \esc_url($url);
    }

    protected function esc_textarea($text) {
        return \esc_textarea($text);
    }

    /**
     * WordPress meta functions
     */
    protected function get_post_meta($post_id, $key, $single = true) {
        return \get_post_meta($post_id, $key, $single);
    }

    protected function update_post_meta($post_id, $meta_key, $meta_value, $prev_value = '') {
        return \update_post_meta($post_id, $meta_key, $meta_value, $prev_value);
    }

    protected function delete_post_meta($post_id, $meta_key, $meta_value = '') {
        return \delete_post_meta($post_id, $meta_key, $meta_value);
    }

    /**
     * WordPress capability functions
     */
    protected function current_user_can($capability) {
        return \current_user_can($capability);
    }

    /**
     * WordPress nonce functions
     */
    protected function wp_nonce_field($action, $name, $referer = true, $echo = true) {
        return \wp_nonce_field($action, $name, $referer, $echo);
    }

    protected function wp_verify_nonce($nonce, $action = -1) {
        return \wp_verify_nonce($nonce, $action);
    }

    /**
     * WordPress media functions
     */
    protected function wp_enqueue_media() {
        \wp_enqueue_media();
    }

    protected function wp_enqueue_script($handle, $src = '', $deps = array(), $ver = false, $in_footer = false) {
        \wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);
    }

    protected function wp_get_attachment_url($attachment_id) {
        return \wp_get_attachment_url($attachment_id);
    }

    /**
     * WordPress sanitization functions
     */
    protected function sanitize_text_field($str) {
        return \sanitize_text_field($str);
    }

    protected function wp_kses_post($str) {
        return \wp_kses_post($str);
    }

    protected function absint($number) {
        return \absint($number);
    }
}