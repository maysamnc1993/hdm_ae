<?php
if (function_exists('acf_add_local_field_group')) :

    acf_add_local_field_group([
        'key' => 'group_feature_benefit_section_google-ads',
        'title' => 'Feature Benefit Section',
        'fields' => array(
            // Header Section Fields
            array(
                'key' => 'field_feature_benefit_header_tag',
                'label' => 'Header Tag Text',
                'name' => 'feature_benefit_header_tag',
                'type' => 'text',
                'default_value' => '{02} — Tools & Skills',
                'required' => 0,
            ),
            array(
                'key' => 'field_feature_benefit_header_title',
                'label' => 'Header Title',
                'name' => 'feature_benefit_header_title',
                'type' => 'text',
                'default_value' => 'My creative toolbox',
                'required' => 0,
            ),
            array(
                'key' => 'field_feature_benefit_header_description',
                'label' => 'Header Description',
                'name' => 'feature_benefit_header_description',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => 'A comprehensive collection of modern tools and technologies that power my creative workflow and development process.',
                'required' => 0,
            ),
            array(
                'key' => 'field_feature_benefit_header_tag_color',
                'label' => 'Header Tag Color',
                'name' => 'feature_benefit_header_tag_color',
                'type' => 'color_picker',
                'default_value' => '#6B7280', // text-gray-500
                'required' => 0,
            ),
            array(
                'key' => 'field_feature_benefit_header_title_color',
                'label' => 'Header Title Color',
                'name' => 'feature_benefit_header_title_color',
                'type' => 'color_picker',
                'default_value' => '#1F2937', // text-gray-900
                'required' => 0,
            ),
            array(
                'key' => 'field_feature_benefit_header_description_color',
                'label' => 'Header Description Color',
                'name' => 'feature_benefit_header_description_color',
                'type' => 'color_picker',
                'default_value' => '#4B5563', // text-gray-600
                'required' => 0,
            ),
            // Stats Section Fields
            array(
                'key' => 'field_feature_benefit_stats_repeater',
                'label' => 'Stats',
                'name' => 'feature_benefit_stats',
                'type' => 'repeater',
                'required' => 0,
                'min' => 0,
                'layout' => 'block',
                'button_label' => 'Add Stat',
                'sub_fields' => array(
                    array(
                        'key' => 'field_stat_value',
                        'label' => 'Stat Value',
                        'name' => 'stat_value',
                        'type' => 'text',
                        'default_value' => '50+',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_stat_label',
                        'label' => 'Stat Label',
                        'name' => 'stat_label',
                        'type' => 'text',
                        'default_value' => 'Projects Completed',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_stat_value_color',
                        'label' => 'Stat Value Color',
                        'name' => 'stat_value_color',
                        'type' => 'color_picker',
                        'default_value' => '#1F2937', // text-gray-900
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_stat_label_color',
                        'label' => 'Stat Label Color',
                        'name' => 'stat_label_color',
                        'type' => 'color_picker',
                        'default_value' => '#6B7280', // text-gray-500
                        'required' => 0,
                    ),
                ),
            ),
            array(
                'key' => 'field_feature_benefit_stats_border_color',
                'label' => 'Stats Border Color',
                'name' => 'feature_benefit_stats_border_color',
                'type' => 'color_picker',
                'default_value' => '#E5E7EB', // border-gray-200
                'required' => 0,
            ),
            // Skills Section Fields
            array(
                'key' => 'field_feature_benefit_skills_repeater',
                'label' => 'Skills',
                'name' => 'feature_benefit_skills',
                'type' => 'repeater',
                'required' => 0,
                'min' => 0,
                'layout' => 'block',
                'button_label' => 'Add Skill',
                'sub_fields' => array(
                    array(
                        'key' => 'field_skill_title',
                        'label' => 'Skill Title',
                        'name' => 'skill_title',
                        'type' => 'text',
                        'default_value' => '',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_skill_description',
                        'label' => 'Skill Description',
                        'name' => 'skill_description',
                        'type' => 'text',
                        'default_value' => '',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_skill_icon',
                        'label' => 'Skill Icon',
                        'name' => 'skill_icon',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_skill_progress',
                        'label' => 'Skill Progress (%)',
                        'name' => 'skill_progress',
                        'type' => 'number',
                        'default_value' => 0,
                        'min' => 0,
                        'max' => 100,
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_skill_title_color',
                        'label' => 'Skill Title Color',
                        'name' => 'skill_title_color',
                        'type' => 'color_picker',
                        'default_value' => '#1F2937', // text-gray-900
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_skill_description_color',
                        'label' => 'Skill Description Color',
                        'name' => 'skill_description_color',
                        'type' => 'color_picker',
                        'default_value' => '#6B7280', // text-gray-500
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_skill_icon_background_color',
                        'label' => 'Skill Icon Background Color (Gradient Start)',
                        'name' => 'skill_icon_background_color',
                        'type' => 'color_picker',
                        'default_value' => '#3B82F6', // from-blue-500
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_skill_icon_background_color_end',
                        'label' => 'Skill Icon Background Color (Gradient End)',
                        'name' => 'skill_icon_background_color_end',
                        'type' => 'color_picker',
                        'default_value' => '#1D4ED8', // to-blue-700
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_skill_progress_bar_color',
                        'label' => 'Skill Progress Bar Color',
                        'name' => 'skill_progress_bar_color',
                        'type' => 'color_picker',
                        'default_value' => '#2563EB', // bg-blue-600
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_skill_progress_badge_color',
                        'label' => 'Skill Progress Badge Color',
                        'name' => 'skill_progress_badge_color',
                        'type' => 'color_picker',
                        'default_value' => '#2563EB', // bg-blue-600
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_skill_progress_badge_text_color',
                        'label' => 'Skill Progress Badge Text Color',
                        'name' => 'skill_progress_badge_text_color',
                        'type' => 'color_picker',
                        'default_value' => '#FFFFFF', // text-white
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_skill_card_background_color',
                        'label' => 'Skill Card Background Color',
                        'name' => 'skill_card_background_color',
                        'type' => 'color_picker',
                        'default_value' => '#FFFFFF', // bg-white
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_skill_card_border_color',
                        'label' => 'Skill Card Border Color',
                        'name' => 'skill_card_border_color',
                        'type' => 'color_picker',
                        'default_value' => '#F3F4F6', // border-gray-100
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_skill_card_border_color_hover',
                        'label' => 'Skill Card Border Color (Hover)',
                        'name' => 'skill_card_border_color_hover',
                        'type' => 'color_picker',
                        'default_value' => '#E5E7EB', // border-gray-200
                        'required' => 0,
                    ),
                ),
            ),
            // Section Background Color
            array(
                'key' => 'field_feature_benefit_background_color',
                'label' => 'Section Background Color',
                'name' => 'feature_benefit_background_color',
                'type' => 'color_picker',
                'default_value' => '#F9FAFB', // bg-gray-50
                'required' => 0,
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
