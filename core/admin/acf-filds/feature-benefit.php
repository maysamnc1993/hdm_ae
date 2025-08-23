<?php

/**
 * ACF Field Definitions: Feature benefit
 * Description: Defines ACF fields for the FAQ section used in WordPress templates.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Ensure ACF is active
if (function_exists('acf_add_local_field_group')) :

    acf_add_local_field_group([
        'key' => 'group_feature_benefit_section',
        'title' => 'Feature Benefit Section',
        'fields' => [
            [
                'key' => 'field_f_b_title',
                'label' => 'Feature Benefit Title',
                'name' => 'feature_benefit_title',
                'type' => 'text',
                'instructions' => 'Enter the main title for the FAQ section.',
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
                'key' => 'field_feature_benefit_description',
                'label' => 'Feature_benefit Description',
                'name' => 'feature_benefit_description',
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
                'key' => 'field_feature_benefit_list',
                'label' => 'Feature Benefit Items',
                'name' => 'feature_benefit_list',
                'type' => 'repeater',
                'instructions' => 'Add feature items with questions and answers.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'collapsed' => 'field_feature_benefit_item',
                'min' => 1,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'Add Feature Item',
                'sub_fields' => [
                    [
                        'key' => 'field_feature_benefit_item_title',
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
                        'key' => 'field_feature_benefit_item_description',
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
                        'key' => 'field_feature_benefit_item_image',
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
