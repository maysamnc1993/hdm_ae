
<?php
/**
 * ACF Field Definitions: Case Study Section
 * Description: Defines ACF fields for the Case Study section used in the app Install page template.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Ensure ACF is active
if (function_exists('acf_add_local_field_group')) :

    acf_add_local_field_group([
        'key' => 'group_case_study_section',
        'title' => 'Case Study Section',
        'fields' => [
            [
                'key' => 'field_case_study_sub_title',
                'label' => 'Case Study Sub Title',
                'name' => 'case_study_sub_title',
                'type' => 'text',
                'instructions' => 'Enter the subtitle for the Case Study section.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => 'Case Study Subtitle',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_case_study_title',
                'label' => 'Case Study Title',
                'name' => 'case_study_title',
                'type' => 'text',
                'instructions' => 'Enter the main title for the Case Study section.',
                'required' => 1,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => 'Case Studies',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_case_study_list',
                'label' => 'Case Study Items',
                'name' => 'case_study_list',
                'type' => 'repeater',
                'instructions' => 'Add case study items with subtitle, title, and description.',
                'required' => 1,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'collapsed' => 'field_case_study_item_title',
                'min' => 1,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'Add Case Study Item',
                'sub_fields' => [
                    [
                        'key' => 'field_case_study_item_sub_title',
                        'label' => 'Item Subtitle',
                        'name' => 'sub_title',
                        'type' => 'text',
                        'instructions' => 'Enter the subtitle for this case study item.',
                        'required' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => 'Enter subtitle here',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ],
                    [
                        'key' => 'field_case_study_item_title',
                        'label' => 'Item Title',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => 'Enter the title for this case study item.',
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
                        'key' => 'field_case_study_item_description',
                        'label' => 'Item Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'instructions' => 'Enter the description for this case study item.',
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
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-seo.php',
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
        'description' => 'Fields for the Case Study section in the app Install page template.',
    ]);

endif;
