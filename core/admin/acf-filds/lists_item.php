<?php

/**
 * ACF Field Definitions: Lists Item
 * Description: Defines ACF fields for the FAQ section used in WordPress templates.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Ensure ACF is active
if (function_exists('acf_add_local_field_group')) :

    acf_add_local_field_group([
        'key' => 'group_lists_item_section',
        'title' => 'Feature Lists Item',
        'fields' => [
            [
                'key' => 'field_lists_item_title',
                'label' => 'Title',
                'name' => 'lists_item_title',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_lists_item_description',
                'label' => 'Description',
                'name' => 'lists_item_description',
                'type' => 'textarea',
                'instructions' => 'Enter a brief description for the FAQ section.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => 4,
                'new_lines' => 'wpautop',
            ],
            [
                'key' => 'field_lists_item_list',
                'label' => 'Items',
                'name' => 'lists_item_list',
                'type' => 'repeater',
                'instructions' => 'Add feature items with questions and answers.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'collapsed' => 'field_lists_item_item',
                'min' => 1,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'Add Feature Item',
                'sub_fields' => [
                    [
                        'key' => 'field_lists_item_item_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => 'Enter the title.',
                        'required' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => 'Enter your title here',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ],
                    [
                        'key' => 'field_lists_item_item_description',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'wysiwyg',
                        'instructions' => 'Enter the Description',
                        'required' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'tabs' => 'all',
                        'toolbar' => 'basic',
                        'media_upload' => 0,
                        'delay' => 1,
                    ],
                    [
                        'key' => 'field_lists_item_item_image',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'tabs' => 'all',
                        'toolbar' => 'basic',
                        'media_upload' => 0,
                        'delay' => 1,
                    ],
                ],
            ],
        ],
        'location' => [
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
        'description' => 'Fields for the FAQ section in pages and posts.',
    ]);

endif;
