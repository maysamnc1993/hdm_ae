<?php
/**
 * ACF Field Group: Teams Section
 * Description: Defines fields for the Teams Section template.
 */

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key' => 'group_teams_section',
        'title' => 'Teams Section',
        'fields' => [
            [
                'key' => 'field_teams_title',
                'label' => 'Title',
                'name' => 'teams_title',
                'type' => 'text',
                'instructions' => 'Enter the title for the Teams section.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
            ],
            [
                'key' => 'field_teams_description',
                'label' => 'Description',
                'name' => 'teams_description',
                'type' => 'textarea',
                'instructions' => 'Enter a brief description for the Teams section.',
                'required' => 0,
                'rows' => 4,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
            ],
            [
                'key' => 'field_teams_team_member',
                'label' => 'Team Members',
                'name' => 'team_member',
                'type' => 'repeater',
                'instructions' => 'Add team members with their details.',
                'required' => 0,
                'min' => 1,
                'max' => 0, // 0 means unlimited
                'layout' => 'block',
                'button_label' => 'Add Team Member',
                'sub_fields' => [
                    [
                        'key' => 'field_team_member_image',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => 'Upload the team member\'s image.',
                        'required' => 0,
                        'return_format' => 'url', // Returns the image URL for use in background-image
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                        'wrapper' => [
                            'width' => '33',
                            'class' => '',
                            'id' => '',
                        ],
                    ],
                    [
                        'key' => 'field_team_member_full_name',
                        'label' => 'Full Name',
                        'name' => 'full_name',
                        'type' => 'text',
                        'instructions' => 'Enter the team member\'s full name.',
                        'required' => 0,
                        'wrapper' => [
                            'width' => '33',
                            'class' => '',
                            'id' => '',
                        ],
                    ],
                    [
                        'key' => 'field_team_member_job_position',
                        'label' => 'Job Position',
                        'name' => 'job_position',
                        'type' => 'text',
                        'instructions' => 'Enter the team member\'s job position.',
                        'required' => 0,
                        'wrapper' => [
                            'width' => '33',
                            'class' => '',
                            'id' => '',
                        ],
                    ],
                ],
            ],
        ],
        'location' => [
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
        'description' => 'Fields for the Teams Section template.',
    ]);
}
?>