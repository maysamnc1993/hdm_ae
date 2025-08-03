<?php
// Check if Redux exists and is activated
if (!class_exists('Redux')) {
    return;
}

// Define the option name for Redux
$opt_name = "jtheme_options";

// Add initialization hook
add_action('after_setup_theme', function () use ($opt_name) {
    Redux::set_args($opt_name, [
        'opt_name' => $opt_name,
        'display_name' => __('تنظیمات سایت', 'jtheme'),
        'display_version' => '1.0.0',
        'menu_type' => 'menu',
        'allow_sub_menu' => true,
        'menu_title' => __('تنظیمات سایت', 'jtheme'),
        'page_title' => __('تنظیمات سایت', 'jtheme'),
        'admin_bar' => true,
        'admin_bar_icon' => 'dashicons-admin-generic',
        'menu_icon' => 'dashicons-admin-generic',
        'page_priority' => 2,
        'page_permissions' => 'manage_options',
        'save_defaults' => true,
        'show_import_export' => true,
    ]);

});
