<?php
// Template Name: google ads

theme_scripts('googleAds');
get_header();

// Retrieve ACF fields for the page
$fields = [
    'why_app' => [
        'title' => get_field('why_app_title', get_the_ID()) ?: '',
        'text' => get_field('why_app_text', get_the_ID()) ?: '',
        'text_color' => get_field('why_app_text_color', get_the_ID()) ?: '',
        'section_color' => get_field('why_app_section_color', get_the_ID()) ?: '',
        'class' => 'seo_page'
    ],
    'services' => [
        'header_brand' => get_field('services_header_brand', get_the_ID()) ?: 'hdm marketing',
        'header_title' => get_field('services_header_title', get_the_ID()) ?: 'services',
        'text_color' => get_field('services_text_color', get_the_ID()) ?: '#1F2937',
        'background_color' => get_field('services_background_color', get_the_ID()) ?: '#FFFFFF',
        'hover_text_color' => get_field('services_hover_text_color', get_the_ID()) ?: '#1F2937',
        'border_color' => get_field('services_border_color', get_the_ID()) ?: '#F9452D',
        'items' => get_field('services', get_the_ID()) ?: [],
    ],

];


get_template_part('template-parts/page-google-ads/section', 'hero');
get_template_part('template-parts/seo/section', 'stat');
get_template_part('template-parts/app-install/section', 'why-app', ['why_app' => $fields['why_app']]);
get_template_part('template-parts/page-google-ads/section-feature-benefit');
get_template_part('template-parts/app-install/section', 'grow-app', ['services' => $fields['services']]);

get_footer();
