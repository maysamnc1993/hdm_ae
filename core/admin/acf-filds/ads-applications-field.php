<?php
if (function_exists('acf_add_local_field_group')) :

    acf_add_local_field_group([
        'key' => 'group_ads_applications',
        'title' => 'Ads Applications Section',
        'fields' => array(
            array(
                'key' => 'field_ads_background_image',
                'label' => 'Background Image',
                'name' => 'ads_background_image',
                'type' => 'image', // Changed from 'file' to 'image'
                'return_format' => 'url', // Return the image URL
                'preview_size' => 'medium',
                'library' => 'all',
                'mime_types' => 'jpg,jpeg,png,svg,webp',
                'required' => 0,
                'default_value' => '', // Remove default SVG, handle in template
            ),
            array(
                'key' => 'field_ads_about_me',
                'label' => 'About Me Text',
                'name' => 'ads_about_me',
                'type' => 'text',
                'default_value' => 'Our App Install Ads Services',
                'required' => 0,
            ),
            array(
                'key' => 'field_ads_main_title',
                'label' => 'Main Title',
                'name' => 'ads_main_title',
                'type' => 'text',
                'default_value' => 'An Imaginative Brain Behind the Displays',
                'required' => 0,
            ),
            array(
                'key' => 'field_ads_main_description',
                'label' => 'Main Description',
                'name' => 'ads_main_description',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => 'Designing websites that feel as good as they look.',
                'required' => 0,
            ),
            array(
                'key' => 'field_ads_cards',
                'label' => 'Cards',
                'name' => 'ads_cards',
                'type' => 'repeater',
                'required' => 0,
                'min' => 1,
                'max' => 20,
                'layout' => 'block',
                'button_label' => 'Add Card',
                'sub_fields' => array(
                    array(
                        'key' => 'field_card_title',
                        'label' => 'Card Title',
                        'name' => 'card_title',
                        'type' => 'text',
                        'required' => 0,
                        'default_value' => 'Design Philosophy',
                    ),
                    array(
                        'key' => 'field_card_subtitle',
                        'label' => 'Card Subtitle',
                        'name' => 'card_subtitle',
                        'type' => 'text',
                        'required' => 0,
                        'default_value' => 'Where Aesthetics Meet Functionality',
                    ),
                    array(
                        'key' => 'field_card_description',
                        'label' => 'Card Description',
                        'name' => 'card_description',
                        'type' => 'textarea',
                        'rows' => 4,
                        'required' => 0,
                        'default_value' => 'Great design isn’t just about looking good—it’s about creating seamless, intuitive experiences that resonate. I focus on blending beauty with usability to craft digital spaces that engage and inspire.',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-app.php',
                ),
            ),
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-seo.php',
                ),
            ),
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-metaAds.php',
                ),
            ),
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-homepage.php',
                ),
            ),
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-ppc.php',
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
