<?php
// Template Name: app Install

theme_scripts('appInstall');
get_header();

// Retrieve ACF fields for the page
$fields = [
    'faq' => [
        'title' => get_field('faq_title', get_the_ID()),
        'description' => get_field('faq_description', get_the_ID()),
        'image' => ($image = get_field('faq_image', get_the_ID())) ? $image['url'] : '',
        'faq_list' => get_field('faq_list', get_the_ID()) ?: [],
    ],
    'csat' => get_field('csat', get_the_ID()),
    'case_study' => [
        'sub_title' => get_field('case_study_sub_title', get_the_ID()),
        'title' => get_field('case_study_title', get_the_ID()),
        'case_study_list' => get_field('case_study_list', get_the_ID()) ?: [],
    ],
    'top_case_study' => [
        'image' => ($image = get_field('top_case_study_image', get_the_ID())) ? $image['url'] : '',
        'count' => get_field('top_case_study_count', get_the_ID()),
        'title' => get_field('top_case_study_title', get_the_ID()),
        'text' => get_field('top_case_study_text', get_the_ID()),
    ],
    'testimonial' => [
        'title' => get_field('testimonial_title', get_the_ID()),
        'description' => get_field('testimonial_description', get_the_ID()),
        'testimonial_list' => get_field('testimonial_list', get_the_ID()) ?: [],
    ],
    'why_choose_us' => [
        'background_image' => ($image = get_field('why_choose_us_background_image', get_the_ID())) ? wp_get_attachment_image_url($image, 'full') : wp_get_attachment_image_url(129, 'full'),
        'values' => get_field('values', get_the_ID()) ?: [],
    ],
    'why_app' => [
        'text' => get_field('why_app_text', get_the_ID()),
        'text_color' => get_field('why_app_text_color', get_the_ID()),
        'section_color' => get_field('why_app_section_color', get_the_ID()),
    ],
];

// Include section-specific template parts

get_template_part('template-parts/app-install/section', 'why-app', ['why_app' => $fields['why_app']]);
get_template_part('template-parts/global/section', 'case-study', ['top_case_study' => $fields['top_case_study']]);
get_template_part('template-parts/global/section', 'case-study-item', ['case_study' => $fields['case_study']]);
get_template_part('template-parts/app-install/section', 'additional-ad-services');
get_template_part('template-parts/global/section', 'why-choose-us', ['why_choose_us' => $fields['why_choose_us']]);
get_template_part('template-parts/global/section', 'faq', ['faq' => $fields['faq']]);
?>





<?php get_footer(); ?>