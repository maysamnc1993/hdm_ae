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
endif;

