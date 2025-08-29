
<?php
/**
 * ACF Field Definitions: Top Case Study Section
 * Description: Defines ACF fields for the Top Case Study section used in the app Install page template.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Ensure ACF is active
if (function_exists('acf_add_local_field_group')) :

    acf_add_local_field_group([
        'key' => 'group_top_case_study_section',
        'title' => 'Top Case Study Section',
        'fields' => [
            [
                'key' => 'field_top_case_study_image',
                'label' => 'Top Case Study Image',
                'name' => 'top_case_study_image',
                'type' => 'image',
                'instructions' => 'Upload or select an image for the Top Case Study section.',
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
                'key' => 'field_top_case_study_count',
                'label' => 'Top Case Study Count',
                'name' => 'top_case_study_count',
                'type' => 'number',
                'instructions' => 'Enter the count number for the Top Case Study section.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => 'Enter a number',
                'prepend' => '',
                'append' => '',
                'min' => 0,
                'max' => '',
                'step' => 1,
            ],
            [
                'key' => 'field_top_case_study_title',
                'label' => 'Top Case Study Title',
                'name' => 'top_case_study_title',
                'type' => 'text',
                'instructions' => 'Enter the title for the Top Case Study section.',
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
                'key' => 'field_top_case_study_text',
                'label' => 'Top Case Study Text',
                'name' => 'top_case_study_text',
                'type' => 'text',
                'instructions' => 'Enter the text or subtitle for the Top Case Study section.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => 'Enter text here',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_top_case_study_link_txt',
                'label' => 'Link Text',
                'name' => 'top_case_study_link_text',
                'type' => 'text',
                'instructions' => 'Enter the text or subtitle for the Top Case Study section.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => 'Enter text here',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_top_case_study_link_anchor',
                'label' => 'Link Anchor',
                'name' => 'top_case_study_link_anchor',
                'type' => 'text',
                'instructions' => 'Enter the text or subtitle for the Top Case Study section.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => 'Enter text here',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
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
                    'value' => 'page-homepage.php',
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
        'description' => 'Fields for the Top Case Study section in the app Install page template.',
    ]);

endif;
