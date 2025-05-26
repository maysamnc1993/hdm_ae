<?php


function jthem_scripts()
{
    // Core assets - loaded on every page
    vite_enqueue_asset('src/js/core/main.js', 'js');
    vite_enqueue_asset('src/js/core/wp-ajax', 'js');
    // vite_enqueue_asset('src/js/lib/gsap.min.js', 'js');
    // vite_enqueue_asset('src/js/lib/Draggable.min.js', 'js');

    // No need to separately load the swiper module as it's imported in component files
    // vite_enqueue_asset('src/js/module/swiper.js', 'js');
    // vite_enqueue_asset('src/css/module/swiper.css', 'css');

    vite_enqueue_asset('src/scss/style.scss', 'css');


    if (theme_is_production()) {
        // Enqueue styles only if in production
        if (file_exists(get_template_directory() . '/assets/css/navigation.css')) {
            wp_enqueue_style(
                'vite-navigation', // Corrected the typo in the handle name
                get_template_directory_uri() . '/assets/css/navigation.css',
                [],
                null
            );
        }

        if (file_exists(get_template_directory() . '/assets/css/free-mode.css')) {
            wp_enqueue_style(
                'vite-free-mode', // Corrected the typo in the handle name
                get_template_directory_uri() . '/assets/css/free-mode.css',
                [],
                null
            );
        }
    }

    // Persian Font from Google Fonts
    //wp_enqueue_style('jthem-persian-fonts', 'https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap', [], null);

    // RTL stylesheet
    // if (is_rtl()) {
    //     vite_enqueue_asset('src/scss/rtl.scss', 'css');
    // }

    // Page-specific assets
    if (is_front_page() || is_home()) {
        vite_enqueue_asset('src/js/pages/home.js', 'js');
        vite_enqueue_asset('src/scss/pages/home.scss', 'css');
    }

    // WordPress core scripts
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'jthem_scripts',1);



// Load admin JS and Css only in the WordPress admin area
function load_admin_styles()
{
    if (is_admin()) {
        vite_enqueue_asset('src/js/admin/admin.js', 'js');
        vite_enqueue_asset('src/css/admin/admin.scss', 'css');

    }
}

add_action('admin_enqueue_scripts', 'load_admin_styles');

