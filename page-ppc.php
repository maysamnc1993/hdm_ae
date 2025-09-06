<?php

// Template Name: PPC Page

theme_scripts('ppc');
get_header();

$fields = [
    'hero' => [
        'video' => get_field('hero_video', get_the_ID()) ?: 'Maximize Results with Expert',
        'title' => get_field('hero_title', get_the_ID()) ?: 'Meta',
        'description' => (get_field('hero_description', get_the_ID())) ?: 'Management',
        'hero_cta_text' => (get_field('hero_cta_text', get_the_ID())) ?: 'Ads',
        'hero_cta_link' => (get_field('hero_cta_link', get_the_ID())),
    ],
    'case_study' => [
        'sub_title' => get_field('case_study_sub_title', get_the_ID()) ?: '',
        'title' => get_field('case_study_title', get_the_ID()) ?: '',
        'case_study_list' => get_field('case_study_list', get_the_ID()) ?: [],
    ],
    'ad_services' => get_field('ad_service_items', get_the_ID()) ?: [],
        'feature_benefit' => [
        'title' => get_field('feature_benefit_title', get_the_ID()) ?: '',
        'description' => get_field('feature_benefit_description', get_the_ID()) ?: '',
        'list' => get_field('feature_benefit_list', get_the_ID()) ?: '',
    ],
    'ads_applications' => [
        'background_image' => ($image = get_field('ads_background_image', get_the_ID())),
        'about_me' => get_field('ads_about_me', get_the_ID()) ?: '',
        'main_title' => get_field('ads_main_title', get_the_ID()) ?: '',
        'main_description' => get_field('ads_main_description', get_the_ID()) ?: '',
        'cards' => get_field('ads_cards', get_the_ID()) ?: [],
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
    'testimonial' => [
        'title' => get_field('testimonial_title', get_the_ID()) ?: '',
        'description' => get_field('testimonial_description', get_the_ID()) ?: '',
        'testimonial_list' => get_field('testimonial_list', get_the_ID()) ?: '',
        
    ],
    'faq' => [
        'title' => get_field('faq_title', get_the_ID()) ?: '',
        'description' => get_field('faq_description', get_the_ID()) ?: '',
        'image' => ($image = get_field('faq_image', get_the_ID())) ? $image['url'] : '',
        'faq_list' => get_field('faq_list', get_the_ID()) ?: [],
    ],
];

get_template_part('template-parts/ppc/section', 'intro', ['hero' => $fields['hero']]);
get_template_part('template-parts/seo/section', 'seo-process');
get_template_part('template-parts/global/section', 'case-study-item', ['case_study' => $fields['case_study']]);
get_template_part('template-parts/app-install/section', 'additional-ad-services', ['ad_services' => $fields['ad_services']]);
get_template_part('template-parts/app-install/section', 'ads-application', ['ads_applications' => $fields['ads_applications']]);
get_template_part('template-parts/app-install/section', 'grow-app', ['services' => $fields['services']]);
get_template_part('template-parts/global/section', 'testimonial', ['testimonial' => $fields['testimonial']]);
get_template_part('template-parts/global/section', 'faq', ['faq' => $fields['faq']]);
get_footer();
?>