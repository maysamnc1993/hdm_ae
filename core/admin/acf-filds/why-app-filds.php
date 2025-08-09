<?php
/**
 * ACF Field Definitions: Why App Section
 * Description: Defines ACF fields for the Why App section used in the app Install page template.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Ensure ACF is active
if (function_exists('acf_add_local_field_group')) :

    acf_add_local_field_group([
        'key' => 'group_why_app_section',
        'title' => 'Why App Section',
        'fields' => [
            [
                'key' => 'field_why_app_text',
                'label' => 'Why App Text',
                'name' => 'why_app_text',
                'type' => 'textarea',
                'instructions' => 'Enter the text content for the Why App section. This will be animated letter by letter.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => 'Enter your text here',
                'maxlength' => '',
                'rows' => 4,
                'new_lines' => 'wpautop',
            ],
            [
                'key' => 'field_why_app_text_color',
                'label' => 'Text Color',
                'name' => 'why_app_text_color',
                'type' => 'color_picker',
                'instructions' => 'Select the color for the animated text.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '#ff3c3c', // Default to a vibrant red
                'enable_opacity' => true,
                'return_format' => 'string',
            ],
            [
                'key' => 'field_why_app_section_color',
                'label' => 'Section Color',
                'name' => 'why_app_section_color',
                'type' => 'color_picker',
                'instructions' => 'Select the color for the animated section.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '#e0e0e0', // Default to a vibrant red
                'enable_opacity' => true,
                'return_format' => 'string',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-app.php',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => 'Fields for the Why App section in the app Install page template.',
    ]);

endif;