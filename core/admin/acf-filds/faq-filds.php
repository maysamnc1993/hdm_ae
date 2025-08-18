<?php

/**
 * ACF Field Definitions: FAQ Section
 * Description: Defines ACF fields for the FAQ section used in WordPress templates.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Ensure ACF is active
if (function_exists('acf_add_local_field_group')) :

    acf_add_local_field_group([
        'key' => 'group_faq_section',
        'title' => 'FAQ Section',
        'fields' => [
            [
                'key' => 'field_faq_title',
                'label' => 'FAQ Title',
                'name' => 'faq_title',
                'type' => 'text',
                'instructions' => 'Enter the main title for the FAQ section.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => 'Frequently Asked Questions',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_faq_description',
                'label' => 'FAQ Description',
                'name' => 'faq_description',
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
                'key' => 'field_faq_image',
                'label' => 'FAQ Image',
                'name' => 'faq_image',
                'type' => 'image',
                'instructions' => 'Upload or select an image to display in the FAQ section.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'return_format' => 'array',
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
                'key' => 'field_faq_list',
                'label' => 'FAQ Items',
                'name' => 'faq_list',
                'type' => 'repeater',
                'instructions' => 'Add FAQ items with questions and answers.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'collapsed' => 'field_faq_item_question',
                'min' => 1,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'Add FAQ Item',
                'sub_fields' => [
                    [
                        'key' => 'field_faq_item_question',
                        'label' => 'Question',
                        'name' => 'question',
                        'type' => 'text',
                        'instructions' => 'Enter the FAQ question.',
                        'required' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => 'Enter your question here',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ],
                    [
                        'key' => 'field_faq_item_answer',
                        'label' => 'Answer',
                        'name' => 'answer',
                        'type' => 'wysiwyg',
                        'instructions' => 'Enter the answer to the FAQ question.',
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
                    'value' => 'page-app.php',
                ],

            ],
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-seo.php',
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
        'description' => 'Fields for the FAQ section in pages and posts.',
    ]);

endif;
