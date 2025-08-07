<?php
// Template Name: app Install

theme_scripts('appInstall');
get_header();

// Retrieve ACF fields for the page
$fields = [
    'hero' => [
        'title' => get_field('hero_title', get_the_ID()) ?: 'Unleash Your Potential',
        'description' => get_field('hero_description', get_the_ID()) ?: 'Join our innovative platform to explore cutting-edge solutions designed to inspire and empower you.',
        'image_1' => ($image = get_field('hero_image_1', get_the_ID())) ? $image['url'] : '',
        'image_2' => ($image = get_field('hero_image_2', get_the_ID())) ? $image['url'] : '',
        'image_3' => ($image = get_field('hero_image_3', get_the_ID())) ? $image['url'] : '',
        'cta_text' => get_field('hero_cta_text', get_the_ID()) ?: 'Get Started',
        'cta_link' => get_field('hero_cta_link', get_the_ID()) ?: '#',
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
    'ads_applications' => [
        'background_image' => ($image = get_field('ads_background_image', get_the_ID())) ? $image : get_template_directory_uri() . '/svg/bg-app-ads.svg',
        'about_me' => get_field('ads_about_me', get_the_ID()) ?: 'Our App Install Ads Services',
        'main_title' => get_field('ads_main_title', get_the_ID()) ?: 'An Imaginative Brain Behind the Displays',
        'main_description' => get_field('ads_main_description', get_the_ID()) ?: 'Designing websites that feel as good as they look.',
        'cards' => get_field('ads_cards', get_the_ID()) ?: [],
    ],
    'faq' => [
        'title' => get_field('faq_title', get_the_ID()) ?: '',
        'description' => get_field('faq_description', get_the_ID()) ?: '',
        'image' => ($image = get_field('faq_image', get_the_ID())) ? $image['url'] : '',
        'faq_list' => get_field('faq_list', get_the_ID()) ?: [],
    ],
    'csat' => get_field('csat', get_the_ID()),
    'case_study' => [
        'sub_title' => get_field('case_study_sub_title', get_the_ID()) ?: '',
        'title' => get_field('case_study_title', get_the_ID()) ?: '',
        'case_study_list' => get_field('case_study_list', get_the_ID()) ?: [],
    ],
    'why_choose_us' => [
        'background_image' => ($image = get_field('why_choose_us_background_image', get_the_ID())) ? wp_get_attachment_image_url($image, 'full') : wp_get_attachment_image_url(129, 'full'),
        'values' => get_field('values', get_the_ID()) ?: [],
    ],
    'why_app' => [
        'text' => get_field('why_app_text', get_the_ID()) ?: '',
        'text_color' => get_field('why_app_text_color', get_the_ID()) ?: '',
        'section_color' => get_field('why_app_section_color', get_the_ID()) ?: '',
    ],
    'ad_services' => get_field('ad_service_items', get_the_ID()) ?: [],
];

// Include section-specific template parts
get_template_part('template-parts/app-install/section', 'hero', ['hero' => $fields['hero']]);
get_template_part('template-parts/app-install/section', 'grow-app', ['services' => $fields['services']]);
get_template_part('template-parts/app-install/section', 'ads-application', ['ads_applications' => $fields['ads_applications']]);
get_template_part('template-parts/app-install/section', 'additional-ad-services', ['ad_services' => $fields['ad_services']]);
get_template_part('template-parts/global/section', 'case-study-item', ['case_study' => $fields['case_study']]);
get_template_part('template-parts/global/section', 'why-choose-us', ['why_choose_us' => $fields['why_choose_us']]);
get_template_part('template-parts/global/section', 'faq', ['faq' => $fields['faq']]);
?>

<?php get_footer(); ?>