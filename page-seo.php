<?php

// Template Name: SEO Page

theme_scripts('seo');
get_header();
$fields = [
    'section_1' => get_field('section_1', get_the_ID()),
    'faq' => [
        'title' => get_field('faq_title', get_the_ID()),
        'description' => get_field('faq_description', get_the_ID()),
        'image' => ($image = get_field('faq_image', get_the_ID())) ? $image['url'] : '',
        'faq_list' => get_field('faq_list', get_the_ID()) ?: [],
    ],
    'case_study' => [
        'sub_title' => get_field('case_study_sub_title', get_the_ID()),
        'title' => get_field('case_study_title', get_the_ID()),
        'case_study_list' => get_field('case_study_list', get_the_ID()) ?: [],
    ],
];


get_template_part('template-parts/seo/section', 'hero', ['section_1' => $fields['section_1']]);
get_template_part('template-parts/seo/section', 'stat');
get_template_part('template-parts/seo/section', 'seo-process');
get_template_part('template-parts/global/section', 'case-study-item', ['case_study' => $fields['case_study']]);
get_template_part('template-parts/global/section', 'faq', ['faq' => $fields['faq']]);
?>

<?php

get_footer();
?>