<?php

// Template Name: Home Page

theme_scripts('HomePage');
get_header();

$fields = [
    'hero' => [
        'video' => get_field('hero_video', get_the_ID()) ?: 'Maximize Results with Expert',
        'title' => get_field('hero_title', get_the_ID()) ?: 'Meta',
        'description' => (get_field('hero_description', get_the_ID())) ?: 'Management',
        'hero_cta_text' => (get_field('hero_cta_text', get_the_ID())) ?: 'Ads',
        'hero_cta_link' => (get_field('hero_cta_link', get_the_ID())),
        'hero_cta_text_2' => (get_field('hero_cta_text_2', get_the_ID())) ?: 'Ads',
        'hero_cta_link_2' => (get_field('hero_cta_link_2', get_the_ID())),
    ],
    'customer' => [
      'gallery' => get_field('customer_gallery', get_the_ID()) ?: 'Meta',
      'description' => (get_field('customer_description', get_the_ID())) ?: 'Management',
      
  ],
  'top_case_study' => [
        'image' => get_field('top_case_study_image', get_the_ID()) ?: '',
        'count' => get_field('top_case_study_count', get_the_ID()) ?: '',
        'title' => get_field('top_case_study_title', get_the_ID()) ?: [],
        'text' => get_field('top_case_study_text', get_the_ID()) ?: [],
        'link_text' => get_field('top_case_study_link_text', get_the_ID()) ?: [],
        'link_anchor' => get_field('top_case_study_link_anchor', get_the_ID()) ?: [],
        
        
    ],

    'ads_applications' => [
      'background_image' => ($image = get_field('ads_background_image', get_the_ID())) ? $image : get_template_directory_uri() . '/svg/bg-app-ads.svg',
      'about_me' => get_field('ads_about_me', get_the_ID()) ?: 'Our App Install Ads Services',
      'main_title' => get_field('ads_main_title', get_the_ID()) ?: 'An Imaginative Brain Behind the Displays',
      'main_description' => get_field('ads_main_description', get_the_ID()) ?: 'Designing websites that feel as good as they look.',
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
    'teams' => [
      'title' => get_field('teams_title', get_the_ID()) ?: '',
      'description' => get_field('teams_description', get_the_ID()) ?: '',
      'team_member' => get_field('team_member', get_the_ID()) ?: [],
  ],
  'testimonial' => [
    'title' => get_field('testimonial_title', get_the_ID()) ?: '',
    'description' => get_field('testimonial_description', get_the_ID()) ?: '',
    'testimonial_list' => get_field('testimonial_list', get_the_ID()) ?: '',
    
    ],
  ];

get_template_part('template-parts/home/section', 'hero', ['hero' => $fields["hero"]]);
get_template_part('template-parts/home/section', 'Customer', ['customer' => $fields["customer"]]);
get_template_part('template-parts/global/section', 'case-study', ['top_case_study' => $fields['top_case_study']]);
get_template_part('template-parts/app-install/section', 'ads-application', ['ads_applications' => $fields['ads_applications']]);
get_template_part('template-parts/app-install/section', 'grow-app', ['services' => $fields['services']]);
get_template_part('template-parts/seo/section', 'stat');
get_template_part('template-parts/webdesign/section', 'teams', ['teams' => $fields['teams']]);
get_template_part('template-parts/global/section', 'testimonial', ['testimonial' => $fields['testimonial']]);
?>
<?php
get_footer();
?>