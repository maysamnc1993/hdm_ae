<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!isset($option_filds)) {
    return;
}

// Get current options
$arv_options = get_option('jtheme_options', array());

// Get current tab
$current_tab = isset($_GET['tab']) && in_array($_GET['tab'], array_keys($option_filds)) ? sanitize_text_field($_GET['tab']) : 'general';

// Handle form submission
if (isset($_POST['submit']) && check_admin_referer('jtheme_options_update')) {
    
    // Allow plugins to hook into the save process
    do_action('jtheme_before_save_options', $option_filds, $current_tab);
    
    // Update options for current tab
    if (isset($option_filds[$current_tab])) {
        foreach ($option_filds[$current_tab]['options'] as $option) {
            if (isset($_POST[$option['key']])) {
                $arv_options[$current_tab][$option['key']] = sanitize_text_field($_POST[$option['key']]);
            }
        }
    }
    
    // Save options
    update_option('jtheme_options', $arv_options);
    
    // Hook for after save
    do_action('jtheme_after_save_options', $option_filds, $current_tab);
    
    // Add success message
    add_settings_error('jtheme_options', 'settings_updated', __('Settings saved.', 'jtheme'), 'updated');
}
