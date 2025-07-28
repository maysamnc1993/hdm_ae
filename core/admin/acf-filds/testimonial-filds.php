<?php
/**
 * ACF Field Definitions: Testimonial Section
 * Description: Defines ACF fields for the Testimonial section used in the app Install page template.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Ensure ACF is active
if (function_exists('acf_add_local_field_group')) :

    acf_add_local_field_group([
        'key' => 'group_testimonial_section',
        'title' => 'Testimonial Section',
        'fields' => [
            [
                'key' => 'field_testimonial_title',
                'label' => 'Testimonial Title',
                'name' => 'testimonial_title',
                'type' => 'text',
                'instructions' => 'Enter the title for the Testimonial section.',
                'required' => 1,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => 'Client Testimonials',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_testimonial_description',
                'label' => 'Testimonial Description',
                'name' => 'testimonial_description',
                'type' => 'textarea',
                'instructions' => 'Enter the description for the Testimonial section.',
                'required' => 0,
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
            [
                'key' => 'field_testimonial_list',
                'label' => 'Testimonial Items',
                'name' => 'testimonial_list',
                'type' => 'repeater',
                'instructions' => 'Add testimonial items with image, name, message, and job position.',
                'required' => 1,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'collapsed' => 'field_testimonial_item_full_name',
                'min' => 1,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'Add Testimonial Item',
                'sub_fields' => [
                    [
                        'key' => 'field_testimonial_item_image',
                        'label' => 'Client Image',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => 'Upload or select an image for the testimonial.',
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
                        'key' => 'field_testimonial_item_full_name',
                        'label' => 'Full Name',
                        'name' => 'full_name',
                        'type' => 'text',
                        'instructions' => 'Enter the full name of the client.',
                        'required' => 1,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => 'Enter full name here',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ],
                    [
                        'key' => 'field_testimonial_item_message',
                        'label' => 'Message',
                        'name' => 'message',
                        'type' => 'textarea',
                        'instructions' => 'Enter the testimonial message.',
                        'required' => 1,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => 'Enter message here',
                        'maxlength' => '',
                        'rows' => 4,
                        'new_lines' => 'wpautop',
                    ],
                    [
                        'key' => 'field_testimonial_item_job_position',
                        'label' => 'Job Position',
                        'name' => 'job_position',
                        'type' => 'text',
                        'instructions' => 'Enter the job position of the client.',
                        'required' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => 'Enter job position here',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
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
        'description' => 'Fields for the Testimonial section in the app Install page template.',
    ]);

endif;
