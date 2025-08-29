<?php
// Ensure ACF is active
if (function_exists('acf_add_local_field_group')) :

    acf_add_local_field_group([
        'key' => 'group_stat_section',
        'title' => 'Stats Section',
        'fields' => array(
            array(
                'key' => 'field_stat_background_image',
                'label' => 'Background Image',
                'name' => 'stat_background_image',
                'type' => 'image',
                'return_format' => 'url', // Return the image URL
                'mime_types' => 'jpg,jpeg,png,avif,webp', // Allow common image formats
                'required' => 0,
                'default_value' => get_template_directory_uri() . '/assets/images/seo/back-stat.avif', // Default to current image
            ),
            array(
                'key' => 'field_stat_items',
                'label' => 'Stat Items',
                'name' => 'stat_items',
                'type' => 'repeater',
                'required' => 0,
                'min' => 1,
                'max' => 5, // Match current number of items
                'layout' => 'block',
                'button_label' => 'Add Stat Item',
                'sub_fields' => array(
                    array(
                        'key' => 'field_stat_title',
                        'label' => 'Stat Title',
                        'name' => 'stat_title',
                        'type' => 'text',
                        'required' => 0,
                        'default_value' => '',
                    ),
                    array(
                        'key' => 'field_stat_count',
                        'label' => 'Stat Count',
                        'name' => 'stat_count',
                        'type' => 'number',
                        'required' => 0,
                        'default_value' => 0,
                        'min' => 0,
                    ),
                ),
            ),
        ),
        'location' => array(
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
                    'value' => 'page-homepage.php',
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
