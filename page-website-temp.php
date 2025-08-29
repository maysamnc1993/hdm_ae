<?php

echo 1;

theme_scripts('webdesign');
get_header();

// Retrieve ACF fields for the page
$fields = [
    'section_1' => get_field('section_1', get_the_ID()),
    'video_section' => get_field('video_section', get_the_ID()),
    'portfolio' => get_field('portfolio', get_the_ID()),
    'why_choose_us' => [
        'background_image' => ($image = get_field('why_choose_us_background_image', get_the_ID())) ? wp_get_attachment_image_url($image, 'full') : wp_get_attachment_image_url(129, 'full'),
        'values' => get_field('values', get_the_ID()) ?: [],
    ],
    'teams' => get_field('teams', get_the_ID()),
    'testimonial' => get_field('testimonial', get_the_ID()),
    'faq' => get_field('faq', get_the_ID()),
    'book_request' => get_field('book_request', get_the_ID()),
    'dribbble' => get_field('dribbble', get_the_ID()),
    'csat' => get_field('csat', get_the_ID()),
    'case_study' => get_field('case_study', get_the_ID()),
    'top_case_study' => get_field('top_case_study', get_the_ID()),
];

// Include section-specific template parts
get_template_part('template-parts/webdesign/section', 'creative', ['section_1' => $fields['section_1'], 'video_section' => $fields['video_section']]);
get_template_part('template-parts/webdesign/section', 'marquee', ['portfolio' => $fields['portfolio']]);
get_template_part('template-parts/global/section', 'why-choose-us', ['why_choose_us' => $fields['why_choose_us']]);
get_template_part('template-parts/global/section', 'case-study', ['top_case_study' => $fields['top_case_study']]);
get_template_part('template-parts/global/section', 'case-study-item', ['case_study' => $fields['case_study']]);
get_template_part('template-parts/webdesign/section', 'teams', ['teams' => $fields['teams']]);
get_template_part('template-parts/global/section', 'testimonial', ['testimonial' => $fields['testimonial']]);
get_template_part('template-parts/global/section', 'faq', ['faq' => $fields['faq']]);
get_template_part('template-parts/webdesign/section', 'csat', ['book_request' => $fields['book_request']]);
//get_template_part('template-parts/webdesign/section', 'book-request', ['book_request' => $fields['book_request']]);
get_template_part('template-parts/webdesign/section', 'floatimg', ['dribbble' => $fields['dribbble']]);
get_template_part('template-parts/webdesign/section', 'whatsapp-call');

?>



<?php
get_footer();
?>