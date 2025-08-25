<?php


// Add ACF options page (if needed)
// if (function_exists('acf_add_options_page')) {
//     acf_add_options_page(array(
//         'page_title' => 'Theme General Settings',
//         'menu_title' => 'Theme Settings',
//         'menu_slug' => 'theme-general-settings',
//         'capability' => 'edit_posts',
//         'redirect' => false
//     ));
// }

if (function_exists('acf_add_local_field_group')) :

    require_once(THEME_URI . "/core/admin/acf-filds/faq-filds.php");
    require_once(THEME_URI . "/core/admin/acf-filds/case-study-item-filds.php");
    require_once(THEME_URI . "/core/admin/acf-filds/top-case-study-filds.php");
    require_once(THEME_URI . "/core/admin/acf-filds/testimonial-filds.php");
    require_once(THEME_URI . "/core/admin/acf-filds/why-choose-us-filds.php");
    require_once(THEME_URI . "/core/admin/acf-filds/why-app-filds.php");
    require_once(THEME_URI . "/core/admin/acf-filds/additional-ad-services-filds.php");
    require_once(THEME_URI . "/core/admin/acf-filds/app-hero-section-filds.php");
    require_once(THEME_URI . "/core/admin/acf-filds/services-field.php");
    require_once(THEME_URI . "/core/admin/acf-filds/ads-applications-field.php");
    require_once(THEME_URI . "/core/admin/acf-filds/seo-hero-section-fields.php");
    require_once(THEME_URI . "/core/admin/acf-filds/seo-stats-section-field.php");
    require_once(THEME_URI . "/core/admin/acf-filds/seo-process-field.php");
    require_once(THEME_URI . "/core/admin/acf-filds/acf-teams-section-fild.php");
    require_once(THEME_URI . "/core/admin/acf-filds/metaAds-fields.php");
    require_once(THEME_URI . "/core/admin/acf-filds/feature-benefit.php");
    require_once(THEME_URI . "/core/admin/acf-filds/lists_item.php");

    // archive blog
    require_once(THEME_URI . "/core/admin/acf-filds/archvie-blog-fileds.php");


    // google ads
    require_once(THEME_URI . "/core/admin/acf-filds/acf-feature-benefit-fileds.php");
    require_once(THEME_URI . "/core/admin/acf-filds/acf-hero-section-google-ads-filds.php");


endif;

