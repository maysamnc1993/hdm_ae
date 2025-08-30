<?php
if (function_exists('acf_add_local_field_group')):
    acf_add_local_field_group([
        'key' => 'group_hero_section_homepage',
        'title' => 'Hero Section',
        'fields' => [
            [
                'key' => 'field_hero_video',
                'label' => 'Hero video',
                'name' => 'hero_video',
                'type' => 'file',
                'instructions' => 'Upload the first hero image.',
                'required' => 0,
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => 0,
                'min_height' => 0,
                'max_width' => 0,
                'max_height' => 0,
                'mime_types' => 'mp4',
            ],
            
            [
                'key' => 'field_hero_title',
                'label' => 'Hero Title',
                'name' => 'hero_title',
                'type' => 'text',
                'instructions' => 'Enter the title for the hero section.',
                'required' => 0,
                'default_value' => 'Unleash Your Potential',
                'placeholder' => 'Enter hero title',
                'maxlength' => '',
            ],
            [
                'key' => 'field_hero_description',
                'label' => 'Hero Description',
                'name' => 'hero_description',
                'type' => 'textarea',
                'instructions' => 'Enter the description for the hero section.',
                'required' => 0,
                'default_value' => 'Join our innovative platform to explore cutting-edge solutions designed to inspire and empower you.',
                'placeholder' => 'Enter hero description',
                'rows' => 4,
                'new_lines' => 'wpautop',
            ],
            [
                'key' => 'field_hero_cta_text',
                'label' => 'CTA Button Text',
                'name' => 'hero_cta_text',
                'type' => 'text',
                'instructions' => 'Enter the text for the CTA button.',
                'required' => 0,
                'default_value' => 'Get Started',
                'placeholder' => 'Enter button text',
                'maxlength' => '',
            ],
            [
                'key' => 'field_hero_cta_link',
                'label' => 'CTA Button Link',
                'name' => 'hero_cta_link',
                'type' => 'url',
                'instructions' => 'Enter the URL for the CTA button.',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'https://example.com',
            ],
            // In app-hero-section-fields.php, add:
            [
                'key' => 'field_hero_cta_text_2',
                'label' => 'Second CTA Button Text',
                'name' => 'hero_cta_text_2',
                'type' => 'text',
                'default_value' => 'Learn More',
            ],
            [
                'key' => 'field_hero_cta_link_2',
                'label' => 'Second CTA Button Link',
                'name' => 'hero_cta_link_2',
                'type' => 'url',
            ],
        ],
        'location' => [
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
        'description' => 'Fields for the hero section on the app page.',
    ]);
endif;



if (function_exists('acf_add_local_field_group')):
    acf_add_local_field_group([
        'key' => 'Customer_hero_section_homepage',
        'title' => 'Customer Section',
        'fields' => [
                [
                    'key'               => 'field_customer_gallery',
                    'label'             => 'customers gallery',
                    'name'              => 'customer_gallery',
                    'type'              => 'gallery',
                    'instructions'      => '',
                    'required'          => 0,
                    'return_format'     => 'array', // 'array' | 'id' | 'url'
                    'preview_size'      => 'medium',
                    'library'           => 'all',   // یا 'uploadedTo'
                    'insert'            => 'append',// یا 'prepend'
                    'min'               => 0,       // حداقل تعداد تصاویر
                    'max'               => 0,       // 0 یعنی نامحدود
                    'min_width'         => 0,
                    'min_height'        => 0,
                    'max_width'         => 0,
                    'max_height'        => 0,
                    'mime_types'        => 'jpg,jpeg,png,webp', // فقط تصاویر
                ],
            
            [
                'key' => 'field_customer_description',
                'label' => 'customer Description',
                'name' => 'customer_description',
                'type' => 'textarea',
                'instructions' => 'Enter the description for the hero section.',
                'required' => 0,
                'default_value' => 'Join our innovative platform to explore cutting-edge solutions designed to inspire and empower you.',
                'placeholder' => 'Enter hero description',
                'rows' => 4,
                'new_lines' => 'wpautop',
            ],
         
        ],
        'location' => [
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
        'description' => 'Fields for the hero section on the app page.',
    ]);
endif;
