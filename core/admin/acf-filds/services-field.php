<?php
if (function_exists('acf_add_local_field_group')) :

    acf_add_local_field_group([
        'key' => 'group_services_section',
        'title' => 'Services Section',
        'fields' => array(
            array(
                'key' => 'field_services_header_brand',
                'label' => 'Header Brand Text',
                'name' => 'services_header_brand',
                'type' => 'text',
                'default_value' => 'hdm marketing',
                'required' => 0,
            ),
            array(
                'key' => 'field_services_header_title',
                'label' => 'Header Title',
                'name' => 'services_header_title',
                'type' => 'text',
                'default_value' => 'services',
                'required' => 0,
            ),
            array(
                'key' => 'field_services_text_color',
                'label' => 'Text Color',
                'name' => 'services_text_color',
                'type' => 'color_picker',
                'default_value' => '#1F2937',
                'required' => 0,
            ),
            array(
                'key' => 'field_services_background_color',
                'label' => 'Background Color',
                'name' => 'services_background_color',
                'type' => 'color_picker',
                'default_value' => '#FFFFFF',
                'required' => 0,
            ),
            array(
                'key' => 'field_services_hover_text_color',
                'label' => 'Hover Text Color',
                'name' => 'services_hover_text_color',
                'type' => 'color_picker',
                'default_value' => '#1F2937',
                'required' => 0,
            ),
            array(
                'key' => 'field_services_border_color',
                'label' => 'Border Color',
                'name' => 'services_border_color',
                'type' => 'color_picker',
                'default_value' => '#F9452D',
                'required' => 0,
            ),
            array(
                'key' => 'field_services_repeater',
                'label' => 'Services',
                'name' => 'services',
                'type' => 'repeater',
                'required' => 0,
                'min' => 1,
                'layout' => 'block',
                'button_label' => 'Add Service',
                'sub_fields' => array(
                    array(
                        'key' => 'field_service_title',
                        'label' => 'Service Title',
                        'name' => 'service_title',
                        'type' => 'text',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_service_description',
                        'label' => 'Service Description',
                        'name' => 'service_description',
                        'type' => 'textarea',
                        'rows' => 4,
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_service_image',
                        'label' => 'Service Image',
                        'name' => 'service_image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                        'library' => 'all',
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
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
    ]);

endif;
