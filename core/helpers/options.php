<?php

namespace JThem\Core\Helpers;

use Redux;

class Options
{
    private $options = [];

    public function __construct()
    {
        if (!class_exists('Redux')) {
            return;
        }
        $this->options = get_option('jtheme_options');
    }

    /**
     * Get a value from Redux options
     * 
     * @param string $key The option key to retrieve
     * @return mixed The option value
     */
    public function get(string $key)
    {
        if (!class_exists('Redux')) {
            return '';
        }
        
        if (isset($this->options[$key])) {
            return $this->options[$key];
        }
        
        return '';
    }

    /**
     * Get a value from legacy options
     * 
     * @param string $group Option group
     * @param string $key Option key
     * @param bool $show_edit_btn Whether to show edit button
     * @return mixed The option value
     */
    public function get_old($group, $key, $show_edit_btn = false)
    {
        if (!isset($this->options[$group])) {
            return false;
        }
        
        if (!isset($this->options[$group][$key])) {
            return false;
        }

        $option = $this->options[$group][$key];
        
        if ($show_edit_btn && current_user_can('manage_options') && !is_admin()) {
            if (!wp_http_validate_url($option) && !is_numeric($option)) {
                return $option . "<a target='_blank' href='" . admin_url("admin.php?page=arv-options-page&tab={$group}#{$key}") . "'><i class='pg-edit'></i></a>";
            }
        }
        
        return $option;
    }

    /**
     * Print an option value
     */
    public function print(string $key)
    {
        echo $this->get($key);
    }

    /**
     * Print a legacy option value
     */
    public function print_old($group, $key, $show_edit_btn = false)
    {
        echo $this->get_old($group, $key, $show_edit_btn);
    }
}