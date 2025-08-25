<?php
if (function_exists('acf_add_local_field_group')) :

    acf_add_local_field_group([
        'key' => 'hero-section-google-ads-filds',
        'title' => 'Hero Section',
        'fields' => array(
            // Header Section Fields
            array(
                'key' => 'field_hero_header_text',
                'label' => 'Header Text',
                'name' => 'hero_header_text',
                'type' => 'text',
                'default_value' => '10,000+ users with improved mental health',
                'required' => 0,
            ),
            // Header Images (Repeater for up to 3 images)
            array(
                'key' => 'field_hero_header_images',
                'label' => 'Header Images',
                'name' => 'hero_header_images',
                'type' => 'repeater',
                'required' => 0,
                'min' => 0,
                'max' => 3,
                'layout' => 'block',
                'button_label' => 'Add Image',
                'sub_fields' => array(
                    array(
                        'key' => 'field_header_image',
                        'label' => 'Image',
                        'name' => 'header_image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                        'required' => 0,
                    ),
                ),
            ),
            // Title Section Fields
            array(
                'key' => 'field_hero_title',
                'label' => 'Title',
                'name' => 'hero_title',
                'type' => 'text',
                'default_value' => 'Ride your mind’s waves, don’t drown in them.',
                'required' => 0,
            ),
            // Paragraph Section Fields
            array(
                'key' => 'field_hero_paragraph',
                'label' => 'Paragraph',
                'name' => 'hero_paragraph',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => 'Join thousands who\'ve reduced anxiety by 67% and improved daily mood by 58% with our science-backed approach to mental wellness.',
                'required' => 0,
            ),
            // Button Section Fields
            array(
                'key' => 'field_hero_button_text',
                'label' => 'Button Text',
                'name' => 'hero_button_text',
                'type' => 'text',
                'default_value' => 'Start Your Journey',
                'required' => 0,
            ),
            array(
                'key' => 'field_hero_button_url',
                'label' => 'Button URL',
                'name' => 'hero_button_url',
                'type' => 'url',
                'default_value' => 'https://framer.link/madebythanh',
                'required' => 0,
            ),
            // Gradient Colors
            array(
                'key' => 'field_hero_gradient_start',
                'label' => 'Gradient Start Color',
                'name' => 'hero_gradient_start',
                'type' => 'color_picker',
                'default_value' => '#020024', // rgba(2, 0, 36, 1)
                'required' => 0,
            ),
            array(
                'key' => 'field_hero_gradient_middle',
                'label' => 'Gradient Middle Color',
                'name' => 'hero_gradient_middle',
                'type' => 'color_picker',
                'default_value' => '#090979', // rgba(9, 9, 121, 1)
                'required' => 0,
            ),
            array(
                'key' => 'field_hero_gradient_end',
                'label' => 'Gradient End Color',
                'name' => 'hero_gradient_end',
                'type' => 'color_picker',
                'default_value' => '#00D4FF', // rgba(0, 212, 255, 1)
                'required' => 0,
            ),
            // Background Images
            array(
                'key' => 'field_hero_background_image',
                'label' => 'Background Image',
                'name' => 'hero_background_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'required' => 0,
            ),
            array(
                'key' => 'field_hero_decorative_images',
                'label' => 'Decorative Images',
                'name' => 'hero_decorative_images',
                'type' => 'repeater',
                'required' => 0,
                'min' => 0,
                'max' => 4,
                'layout' => 'block',
                'button_label' => 'Add Decorative Image',
                'sub_fields' => array(
                    array(
                        'key' => 'field_decorative_image',
                        'label' => 'Image',
                        'name' => 'decorative_image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_decorative_image_position',
                        'label' => 'Image Position',
                        'name' => 'decorative_image_position',
                        'type' => 'select',
                        'choices' => array(
                            'top-40 left-20' => 'Top Left',
                            'top-40 right-20' => 'Top Right',
                            'bottom-40 left-20' => 'Bottom Left',
                            'bottom-40 right-20' => 'Bottom Right',
                        ),
                        'default_value' => 'top-40 left-20',
                        'required' => 0,
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-google-ads.php',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
    ]);

endif;
