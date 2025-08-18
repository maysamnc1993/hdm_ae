<?php
/**
 * ACF Field Definitions: Additional Ad Services Section
 * Description: Defines ACF fields for the Additional Ad Services section used in the app Install page template.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Ensure ACF is active
if (function_exists('acf_add_local_field_group')) :

    acf_add_local_field_group([
        'key' => 'group_additional_ad_services_section',
        'title' => 'Additional Ad Services Section',
        'fields' => [
             [
                'key' => 'field_additional_ad_services_title',
                'label' => 'Additional Ad Services Title',
                'name' => 'additional_ad_services_title',
                'type' => 'text',
                'instructions' => 'Enter the title for the Additional Ad Services section.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Additional ad Services',
                'placeholder' => 'Case Study Subtitle',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_additional_ad_services_text',
                'label' => 'Additional Ad Services Text',
                'name' => 'additional_ad_services_text',
                'type' => 'textarea',
                'instructions' => 'Enter the title for the Additional Ad Services section.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Additional ad Services',
                'placeholder' => 'Case Study Subtitle',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_additional_ad_services_items',
                'label' => 'Ad Service Items',
                'name' => 'ad_service_items',
                'type' => 'repeater',
                'instructions' => 'Add ad service items with image, title, caption, and link.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'collapsed' => 'field_ad_service_item_title',
                'min' => 1,
                'max' => 6, // Limit to 6 items for design consistency
                'layout' => 'block',
                'button_label' => 'Add Ad Service Item',
                'sub_fields' => [
                    [
                        'key' => 'field_ad_service_item_image',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => 'Upload or select an image for the ad service item.',
                        'required' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'return_format' => 'url', // Returns URL directly for template
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
                        'key' => 'field_ad_service_item_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => 'Enter the title for the ad service item.',
                        'required' => 0,
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
                        'key' => 'field_ad_service_item_caption',
                        'label' => 'Caption',
                        'name' => 'caption',
                        'type' => 'textarea',
                        'instructions' => 'Enter the caption for the ad service item.',
                        'required' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => 'Enter caption here',
                        'maxlength' => '',
                        'rows' => 3,
                        'new_lines' => 'wpautop',
                    ],
                    [
                        'key' => 'field_ad_service_item_link',
                        'label' => 'Link',
                        'name' => 'link',
                        'type' => 'link',
                        'instructions' => 'Add a link for the ad service item.',
                        'required' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'return_format' => 'array',
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
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-metaAds.php',
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
        'description' => 'Fields for the Additional Ad Services section in the app Install page template.',
    ]);

endif;