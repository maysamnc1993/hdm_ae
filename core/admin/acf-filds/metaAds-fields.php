<?php
// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

// Register ACF field groups if ACF is available
if (function_exists('acf_add_local_field_group')) {
    // Existing Field Group: Meta Ads Header
    acf_add_local_field_group(array(
        'key' => 'group_meta_ads_header',
        'title' => 'Meta Ads Header',
        'fields' => array(
            array(
                'key' => 'field_small_title',
                'label' => 'Small Title',
                'name' => 'small_title',
                'type' => 'text',
                'instructions' => 'Enter the small title text (e.g., Maximize Results with Expert).',
                'required' => 1,
                'default_value' => 'Maximize Results with Expert',
                'placeholder' => 'Enter small title',
                'maxlength' => 100,
            ),
            array(
                'key' => 'field_meta_text',
                'label' => 'Meta Text',
                'name' => 'meta_text',
                'type' => 'text',
                'instructions' => 'Enter the text for Meta (used in both italic and bold).',
                'required' => 1,
                'default_value' => 'Meta',
                'placeholder' => 'Enter Meta text',
                'maxlength' => 100,
            ),
            array(
                'key' => 'field_management_text',
                'label' => 'Management Text',
                'name' => 'management_text',
                'type' => 'text',
                'instructions' => 'Enter the text for Management.',
                'required' => 1,
                'default_value' => 'Management',
                'placeholder' => 'Enter Management text',
                'maxlength' => 100,
            ),
            array(
                'key' => 'field_ads_text',
                'label' => 'Ads Text',
                'name' => 'ads_text',
                'type' => 'text',
                'instructions' => 'Enter the text for Ads (used in both italic and bold).',
                'required' => 1,
                'default_value' => 'Ads',
                'placeholder' => 'Enter Ads text',
                'maxlength' => 100,
            ),
        ),
        'location' => array(
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
                    'value' => 'page-seo.php',
                ),
            ),
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-services.php',
                ),
            ),
            array(
                array(
                    'param' => 'post_name',
                    'operator' => '==',
                    'value' => 'about',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => 'Fields for the Meta Ads Header section on specific page templates or slugs.',
    ));

    // Existing Field Group: Meta Ads Video Section
    acf_add_local_field_group(array(
        'key' => 'group_meta_ads_video',
        'title' => 'Meta Ads Video Section',
        'fields' => array(
            array(
                'key' => 'field_video_source',
                'label' => 'Video Source',
                'name' => 'video_source',
                'type' => 'url',
                'instructions' => 'Enter the URL for the video (e.g., MP4 file) or leave blank to upload a video file below.',
                'required' => 0,
                'default_value' => 'https://a.storyblok.com/f/325490/x/6ccfd466b9/2025_02_homerun_showreel_sanstexte.mp4',
                'placeholder' => 'https://example.com/video.mp4',
            ),
            array(
                'key' => 'field_video_upload',
                'label' => 'Video Upload',
                'name' => 'video_upload',
                'type' => 'file',
                'instructions' => 'Upload a video file (MP4 recommended, max 10MB). This will override the Video Source URL if provided.',
                'required' => 0,
                'return_format' => 'url',
                'library' => 'all',
                'mime_types' => 'mp4',
                'max_size' => 10,
            ),
            array(
                'key' => 'field_video_caption',
                'label' => 'Video Caption',
                'name' => 'video_caption',
                'type' => 'text',
                'instructions' => 'Enter the caption for the video.',
                'required' => 1,
                'default_value' => 'Premium Meta Ads Agency',
                'placeholder' => 'Enter video caption',
                'maxlength' => 100,
            ),
        ),
        'location' => array(
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
                    'value' => 'page-seo.php',
                ),
            ),
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-services.php',
                ),
            ),
            array(
                array(
                    'param' => 'post_name',
                    'operator' => '==',
                    'value' => 'about',
                ),
            ),
        ),
        'menu_order' => 1,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => 'Fields for the Meta Ads Video section on specific page templates or slugs.',
    ));

    // Updated Field Group: Meta Ads Business Model
    acf_add_local_field_group(array(
        'key' => 'group_meta_ads_business_model',
        'title' => 'Meta Ads Business Model',
        'fields' => array(
            // Column 1: Text
            array(
                'key' => 'field_column_1_title',
                'label' => 'Column 1 Title',
                'name' => 'column_1_title',
                'type' => 'text',
                'instructions' => 'Enter the title for Column 1 (e.g., Amazing Design).',
                'required' => 1,
                'default_value' => 'Amazing Design',
                'placeholder' => 'Enter title',
                'maxlength' => 100,
            ),
            array(
                'key' => 'field_column_1_description',
                'label' => 'Column 1 Description',
                'name' => 'column_1_description',
                'type' => 'textarea',
                'instructions' => 'Enter the description for Column 1.',
                'required' => 1,
                'default_value' => 'This is an incredible section that demonstrates smooth scroll-triggered animations. Watch as the content transforms seamlessly as you scroll down the page. The text scales and fades while new content slides into view.',
                'placeholder' => 'Enter description',
                'rows' => 4,
                'maxlength' => 500,
            ),
            // Column 2: Images
            array(
                'key' => 'field_column_2_current_image',
                'label' => 'Column 2 Current Image',
                'name' => 'column_2_current_image',
                'type' => 'image',
                'instructions' => 'Upload the current image for Column 2 (min 800x600px, max 5MB).',
                'required' => 1,
                'return_format' => 'url',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => 800,
                'min_height' => 600,
                'max_size' => 5,
            ),
            array(
                'key' => 'field_column_2_new_image',
                'label' => 'Column 2 New Image',
                'name' => 'column_2_new_image',
                'type' => 'image',
                'instructions' => 'Upload the new image for Column 2 (min 800x600px, max 5MB).',
                'required' => 1,
                'return_format' => 'url',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => 800,
                'min_height' => 600,
                'max_size' => 5,
            ),
            // Column 3: Fixed Content Items
            array(
                'key' => 'field_column_3_items',
                'label' => 'Column 3 Content Items',
                'name' => 'column_3_items',
                'type' => 'repeater',
                'instructions' => 'Enter exactly two content items for Column 3. Each item includes a title and description.',
                'required' => 1,
                'min' => 2,
                'max' => 2,
                'layout' => 'block',
                'button_label' => '', // Empty to hide "Add Content Item" button
                'sub_fields' => array(
                    array(
                        'key' => 'field_column_3_item_title',
                        'label' => 'Item Title',
                        'name' => 'item_title',
                        'type' => 'text',
                        'instructions' => 'Enter the title for this content item (e.g., Step 1: Discovery).',
                        'required' => 1,
                        'default_value' => '',
                        'placeholder' => 'Enter item title',
                        'maxlength' => 100,
                    ),
                    array(
                        'key' => 'field_column_3_item_description',
                        'label' => 'Item Description',
                        'name' => 'item_description',
                        'type' => 'textarea',
                        'instructions' => 'Enter the description for this content item.',
                        'required' => 1,
                        'default_value' => '',
                        'placeholder' => 'Enter item description',
                        'rows' => 4,
                        'maxlength' => 500,
                    ),
                ),
            ),
            // Column 4: Image
            array(
                'key' => 'field_column_4_image',
                'label' => 'Column 4 Image',
                'name' => 'column_4_image',
                'type' => 'image',
                'instructions' => 'Upload the image for Column 4 (min 800x600px, max 5MB).',
                'required' => 1,
                'return_format' => 'url',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => 800,
                'min_height' => 600,
                'max_size' => 5,
            ),
            // Column 5: Text
            array(
                'key' => 'field_column_5_title',
                'label' => 'Column 5 Title',
                'name' => 'column_5_title',
                'type' => 'text',
                'instructions' => 'Enter the title for Column 5 (e.g., Step 3: Discovery).',
                'required' => 1,
                'default_value' => 'Step 3: Discovery',
                'placeholder' => 'Enter title',
                'maxlength' => 100,
            ),
            array(
                'key' => 'field_column_5_description',
                'label' => 'Column 5 Description',
                'name' => 'column_5_description',
                'type' => 'textarea',
                'instructions' => 'Enter the description for Column 5.',
                'required' => 1,
                'default_value' => 'Now we move into the development phase where ideas become reality. This is where the magic happens!',
                'placeholder' => 'Enter description',
                'rows' => 4,
                'maxlength' => 500,
            ),
            // Column 6: Text
            array(
                'key' => 'field_column_6_title',
                'label' => 'Column 6 Title',
                'name' => 'column_6_title',
                'type' => 'text',
                'instructions' => 'Enter the title for Column 6 (e.g., Step 4: Discovery).',
                'required' => 1,
                'default_value' => 'Step 4: Discovery',
                'placeholder' => 'Enter title',
                'maxlength' => 100,
            ),
            array(
                'key' => 'field_column_6_description',
                'label' => 'Column 6 Description',
                'name' => 'column_6_description',
                'type' => 'textarea',
                'instructions' => 'Enter the description for Column 6.',
                'required' => 1,
                'default_value' => 'Quality assurance and testing ensure everything works perfectly. We refine and polish our creation.',
                'placeholder' => 'Enter description',
                'rows' => 4,
                'maxlength' => 500,
            ),
            // Column 7: Text
            array(
                'key' => 'field_column_7_title',
                'label' => 'Column 7 Title',
                'name' => 'column_7_title',
                'type' => 'text',
                'instructions' => 'Enter the title for Column 7 (e.g., Step 5: Launch).',
                'required' => 1,
                'default_value' => 'Step 5: Launch',
                'placeholder' => 'Enter title',
                'maxlength' => 100,
            ),
            array(
                'key' => 'field_column_7_description',
                'label' => 'Column 7 Description',
                'name' => 'column_7_description',
                'type' => 'textarea',
                'instructions' => 'Enter the description for Column 7.',
                'required' => 1,
                'default_value' => 'Finally, we launch and celebrate! The journey is complete, but new adventures await ahead.',
                'placeholder' => 'Enter description',
                'rows' => 4,
                'maxlength' => 500,
            ),
        ),
        'location' => array(
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
                    'value' => 'page-seo.php',
                ),
            ),
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-services.php',
                ),
            ),
            array(
                array(
                    'param' => 'post_name',
                    'operator' => '==',
                    'value' => 'about',
                ),
            ),
        ),
        'menu_order' => 2,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => 'Fields for the Meta Ads Business Model section on specific page templates or slugs.',
    ));

    // Existing Field Group: Meta Ads Scrolling Cards
    acf_add_local_field_group(array(
        'key' => 'group_meta_ads_scrolling_cards',
        'title' => 'Meta Ads Scrolling Cards',
        'fields' => array(
            array(
                'key' => 'field_scrolling_cards',
                'label' => 'Scrolling Cards',
                'name' => 'scrolling_cards',
                'type' => 'repeater',
                'instructions' => 'Add cards for the Scrolling Cards section. Each card includes a background color, number, title, description, and image.',
                'required' => 1,
                'min' => 1,
                'layout' => 'block',
                'button_label' => 'Add Card',
                'sub_fields' => array(
                    array(
                        'key' => 'field_card_background_color',
                        'label' => 'Background Color',
                        'name' => 'background_color',
                        'type' => 'color_picker',
                        'instructions' => 'Choose the background color for the card.',
                        'required' => 1,
                        'default_value' => '#003ea9',
                        'enable_opacity' => false,
                        'return_format' => 'string',
                    ),
                    array(
                        'key' => 'field_card_number',
                        'label' => 'Card Number',
                        'name' => 'card_number',
                        'type' => 'text',
                        'instructions' => 'Enter the card number (e.g., 001, 002).',
                        'required' => 1,
                        'default_value' => '',
                        'placeholder' => '001',
                        'maxlength' => 3,
                    ),
                    array(
                        'key' => 'field_card_title',
                        'label' => 'Card Title',
                        'name' => 'card_title',
                        'type' => 'text',
                        'instructions' => 'Enter the title for the card.',
                        'required' => 1,
                        'default_value' => '',
                        'placeholder' => 'Enter card title',
                        'maxlength' => 100,
                    ),
                    array(
                        'key' => 'field_card_description',
                        'label' => 'Card Description',
                        'name' => 'card_description',
                        'type' => 'textarea',
                        'instructions' => 'Enter the description for the card.',
                        'required' => 1,
                        'default_value' => '',
                        'placeholder' => 'Enter card description',
                        'rows' => 4,
                        'maxlength' => 500,
                    ),
                    array(
                        'key' => 'field_card_image',
                        'label' => 'Card Image',
                        'name' => 'card_image',
                        'type' => 'image',
                        'instructions' => 'Upload an image for the card (min 800x400px, max 5MB).',
                        'required' => 1,
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                        'library' => 'all',
                        'min_width' => 800,
                        'min_height' => 400,
                        'max_size' => 5,
                    ),
                ),
            ),
        ),
        'location' => array(
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
                    'value' => 'page-seo.php',
                ),
            ),
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-services.php',
                ),
            ),
            array(
                array(
                    'param' => 'post_name',
                    'operator' => '==',
                    'value' => 'about',
                ),
            ),
        ),
        'menu_order' => 3,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => 'Fields for the Meta Ads Scrolling Cards section on specific page templates or slugs.',
    ));
} else {
    error_log('ACF function acf_add_local_field_group not found in metaAds-fields.php');
}
?>