
<?php
/**
 * ACF Field Definitions: Why Choose Us Section
 * Description: Defines ACF fields for the Why Choose Us section used in the app Install page template.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Ensure ACF is active
if (function_exists('acf_add_local_field_group')) :

    acf_add_local_field_group([
        'key' => 'group_why_choose_us_section',
        'title' => 'Why Choose Us Section',
        'fields' => [
            [
                'key' => 'field_why_choose_us_background_image',
                'label' => 'Background Image',
                'name' => 'why_choose_us_background_image',
                'type' => 'image',
                'instructions' => 'Upload or select a background image for the Why Choose Us section text.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ],
            [
                'key' => 'field_why_choose_us_values',
                'label' => 'Values',
                'name' => 'values',
                'type' => 'repeater',
                'instructions' => 'Add value items with image, title, and description.',
                'required' => 1,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'collapsed' => 'field_why_choose_us_item_title',
                'min' => 1,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'Add Value Item',
                'sub_fields' => [
                    [
                        'key' => 'field_why_choose_us_item_image',
                        'label' => 'Icon Image',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => 'Upload or select an icon image for the value item.',
                        'required' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'return_format' => 'url',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ],
                    [
                        'key' => 'field_why_choose_us_item_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => 'Enter the title for the value item.',
                        'required' => 1,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => 'Enter title here',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ],
                    [
                        'key' => 'field_why_choose_us_item_description',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'instructions' => 'Enter the description for the value item.',
                        'required' => 1,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => 'Enter description here',
                        'maxlength' => '',
                        'rows' => 4,
                        'new_lines' => 'wpautop',
                    ],
                ],
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
        'description' => 'Fields for the Why Choose Us section in the app Install page template.',
    ]);

endif;
