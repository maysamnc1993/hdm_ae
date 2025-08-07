<?php
// Template Name: SEO Page

theme_scripts('seo');
get_header();

// Retrieve ACF fields for the page
$fields = [
    'hero' => [
        'title' => get_field('seo_hero_title', get_the_ID()) ?: 'Mastering SEO Success',
        'description' => get_field('seo_hero_description', get_the_ID()) ?: 'Boost your online presence with proven SEO strategies to rank higher and attract more traffic.',
        'image_1' => ($image = get_field('seo_hero_image_1', get_the_ID())) ? $image['url'] : '',
        'image_2' => ($image = get_field('seo_hero_image_2', get_the_ID())) ? $image['url'] : '',
        'image_3' => ($image = get_field('seo_hero_image_3', get_the_ID())) ? $image['url'] : '',
        'cta_text_1' => get_field('seo_hero_cta_text_1', get_the_ID()) ?: 'Get Started',
        'cta_link_1' => get_field('seo_hero_cta_link_1', get_the_ID()) ?: '#',
        'cta_text_2' => get_field('seo_hero_cta_text_2', get_the_ID()) ?: 'Learn More',
        'cta_link_2' => get_field('seo_hero_cta_link_2', get_the_ID()) ?: '#',
    ],
    'faq' => [
        'title' => get_field('faq_title', get_the_ID()) ?: '',
        'description' => get_field('faq_description', get_the_ID()) ?: '',
        'image' => ($image = get_field('faq_image', get_the_ID())) ? $image['url'] : '',
        'faq_list' => get_field('faq_list', get_the_ID()) ?: [],
    ],
    'case_study' => [
        'sub_title' => get_field('case_study_sub_title', get_the_ID()) ?: '',
        'title' => get_field('case_study_title', get_the_ID()) ?: '',
        'case_study_list' => get_field('case_study_list', get_the_ID()) ?: [],
    ],
    'teams' => [
        'title' => get_field('teams_title', get_the_ID()) ?: '',
        'description' => get_field('teams_description', get_the_ID()) ?: '',
        'team_member' => get_field('team_member', get_the_ID()) ?: [],
    ],
];

// Include section-specific template parts with visibility checks
if (!empty($fields['hero']['title'])) {
    get_template_part('template-parts/seo/section', 'hero', ['hero' => $fields['hero']]);
}
if (!empty($fields['teams']['title']) || !empty($fields['teams']['team_member'])) {
    get_template_part('template-parts/webdesign/section', 'teams', ['teams' => $fields['teams']]);
}
get_template_part('template-parts/seo/section', 'stat');
get_template_part('template-parts/seo/section', 'seo-process');
if (!empty($fields['case_study']['title']) || !empty($fields['case_study']['case_study_list'])) {
    get_template_part('template-parts/global/section', 'case-study-item', ['case_study' => $fields['case_study']]);
}
if (!empty($fields['faq']['title']) || !empty($fields['faq']['faq_list'])) {
    get_template_part('template-parts/global/section', 'faq', ['faq' => $fields['faq']]);
}
?>

<?php get_footer(); ?>