<?php

/**
 * Theme Helper Functions
 *
 * @package JTheme
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Get asset URL
 *
 * @param string $filename File name with extension.
 * @param string $type Asset type (css|js|images|fonts).
 * @return string Full URL to the asset.
 */
function theme_asset_url($filename, $type = 'css')
{
    return THEME_URI . '/assets/' . $type . '/' . $filename;
}

/**
 * RTL-aware stylesheets including
 *
 * @param string $handle Name of the stylesheet.
 * @param string $filename Filename without extension (will append -rtl if needed).
 * @param array  $deps Array of dependencies.
 * @param string $version Version string.
 * @param string $media Media type.
 */
function theme_enqueue_rtl_aware_style($handle, $filename, $deps = array(), $version = THEME_VERSION, $media = 'all')
{
    $rtl_suffix = is_rtl() ? '-rtl' : '';
    $file = $filename . $rtl_suffix . '.css';

    wp_enqueue_style($handle, theme_asset_url($file), $deps, $version, $media);
}

/**
 * Get theme option
 *
 * @param string $option_name The option name.
 * @param mixed  $default Default value if option doesn't exist.
 * @return mixed Option value or default.
 */
function theme_get_option($option_name, $default = false)
{
    $options = get_option('theme_options');

    if (isset($options[$option_name])) {
        return $options[$option_name];
    }

    return $default;
}

/**
 * Get social media links
 *
 * @return array Array of social media links.
 */
function theme_get_social_links()
{
    $social_links = array(
        'facebook'  => theme_get_option('social_facebook'),
        'twitter'   => theme_get_option('social_twitter'),
        'instagram' => theme_get_option('social_instagram'),
        'linkedin'  => theme_get_option('social_linkedin'),
        'telegram'  => theme_get_option('social_telegram'),
    );

    return array_filter($social_links);
}

/**
 * Get image URL by attachment ID
 *
 * @param int    $attachment_id Attachment ID.
 * @param string $size Image size.
 * @return string|false Image URL or false if not found.
 */
function theme_get_image_url($attachment_id, $size = 'full')
{
    if (! $attachment_id) {
        return false;
    }

    $image = wp_get_attachment_image_src($attachment_id, $size);

    if ($image) {
        return $image[0];
    }

    return false;
}

/**
 * Get featured image URL
 *
 * @param int    $post_id Post ID.
 * @param string $size Image size.
 * @return string|false Featured image URL or false if not found.
 */
function theme_get_featured_image_url($post_id = null, $size = 'full')
{
    if (! $post_id) {
        $post_id = get_the_ID();
    }

    if (has_post_thumbnail($post_id)) {
        return theme_get_image_url(get_post_thumbnail_id($post_id), $size);
    }

    return false;
}

/**
 * Get post excerpt with custom length
 *
 * @param int $post_id Post ID.
 * @param int $length Excerpt length.
 * @return string Post excerpt.
 */
function theme_get_excerpt($post_id = null, $length = 55)
{
    if (! $post_id) {
        $post_id = get_the_ID();
    }

    $post = get_post($post_id);
    $text = $post->post_excerpt;

    if (empty($text)) {
        $text = $post->post_content;
        $text = strip_shortcodes($text);
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]&gt;', $text);
    }

    $text = wp_trim_words($text, $length, '...');

    return $text;
}

/**
 * Check if WooCommerce is active
 *
 * @return bool True if WooCommerce is active.
 */
function theme_is_woocommerce_active()
{
    return class_exists('WooCommerce');
}

/**
 * Check if current page is RTL
 *
 * @return bool True if page is RTL.
 */
function theme_is_rtl()
{
    return is_rtl();
}

/**
 * Get pagination HTML
 *
 * @param array $args Pagination arguments.
 * @return string Pagination HTML.
 */
function theme_pagination($args = array())
{
    $defaults = array(
        'range'           => 4,
        'custom_query'    => false,
        'previous_string' => __('Previous', 'jheme'),
        'next_string'     => __('Next', 'jheme'),
        'before_output'   => '<nav aria-label="' . __('Page Navigation', 'jheme') . '"><ul class="pagination justify-content-center">',
        'after_output'    => '</ul></nav>',
    );

    $args = wp_parse_args($args, $defaults);

    $args['range'] = (int) $args['range'] - 1;

    if (! $args['custom_query']) {
        $args['custom_query'] = @$GLOBALS['wp_query'];
    }

    $count = (int) $args['custom_query']->max_num_pages;
    $page  = intval(get_query_var('paged'));
    $ceil  = ceil($args['range'] / 2);

    if ($count <= 1) {
        return '';
    }

    if (! $page) {
        $page = 1;
    }

    if ($count > $args['range']) {
        if ($page <= $args['range']) {
            $min = 1;
            $max = $args['range'] + 1;
        } elseif ($page >= ($count - $ceil)) {
            $min = $count - $args['range'];
            $max = $count;
        } elseif ($page >= $args['range'] && $page < ($count - $ceil)) {
            $min = $page - $ceil;
            $max = $page + $ceil;
        }
    } else {
        $min = 1;
        $max = $count;
    }

    $output = '';

    $previous = intval($page) - 1;
    $previous = esc_url(get_pagenum_link($previous));

    $first_url = esc_url(get_pagenum_link(1));

    if ($first_url && (1 != $page)) {
        $output .= '<li class="page-item"><a class="page-link" href="' . $first_url . '">' . __('First', 'jheme') . '</a></li>';
    }

    if ($previous && (1 != $page)) {
        $output .= '<li class="page-item"><a class="page-link" href="' . $previous . '" aria-label="' . $args['previous_string'] . '"><span aria-hidden="true">&laquo;</span></a></li>';
    }

    for ($i = $min; $i <= $max; $i++) {
        $current_url = esc_url(get_pagenum_link($i));

        if ($page == $i) {
            $output .= '<li class="page-item active"><a class="page-link" href="' . $current_url . '">' . (int) $i . '</a></li>';
        } else {
            $output .= '<li class="page-item"><a class="page-link" href="' . $current_url . '">' . (int) $i . '</a></li>';
        }
    }

    $next = intval($page) + 1;
    $next = esc_url(get_pagenum_link($next));

    if ($next && ($count != $page)) {
        $output .= '<li class="page-item"><a class="page-link" href="' . $next . '" aria-label="' . $args['next_string'] . '"><span aria-hidden="true">&raquo;</span></a></li>';
    }

    $last_url = esc_url(get_pagenum_link($count));

    if ($last_url && ($count != $page)) {
        $output .= '<li class="page-item"><a class="page-link" href="' . $last_url . '">' . __('Last', 'jheme') . '</a></li>';
    }

    if ($output) {
        return $args['before_output'] . $output . $args['after_output'];
    }

    return '';
}

/**
 * Get formatted phone number link
 *
 * @param string $phone Phone number.
 * @return string Formatted phone number link.
 */
function theme_phone_link($phone)
{
    $phone_clean = preg_replace('/[^0-9+]/', '', $phone);

    return '<a href="tel:' . $phone_clean . '">' . $phone . '</a>';
}

/**
 * Get formatted email link
 *
 * @param string $email Email address.
 * @param string $text Text to display (defaults to email address).
 * @return string Formatted email link.
 */
function theme_email_link($email, $text = '')
{
    if (empty($text)) {
        $text = $email;
    }

    return '<a href="mailto:' . antispambot($email) . '">' . $text . '</a>';
}

/**
 * Get related posts
 *
 * @param int   $post_id Post ID.
 * @param int   $number_posts Number of posts to retrieve.
 * @param array $taxonomies Taxonomies to use for relation.
 * @return WP_Query Query with related posts.
 */
function theme_get_related_posts($post_id = null, $number_posts = 3, $taxonomies = array('category'))
{
    if (! $post_id) {
        $post_id = get_the_ID();
    }

    $args = array(
        'post_type'      => get_post_type($post_id),
        'posts_per_page' => $number_posts,
        'post_status'    => 'publish',
        'post__not_in'   => array($post_id),
        'orderby'        => 'rand',
    );

    $tax_query = array();

    foreach ($taxonomies as $taxonomy) {
        $terms = get_the_terms($post_id, $taxonomy);

        if ($terms && ! is_wp_error($terms)) {
            $term_ids = wp_list_pluck($terms, 'term_id');

            $tax_query[] = array(
                'taxonomy' => $taxonomy,
                'field'    => 'term_id',
                'terms'    => $term_ids,
            );
        }
    }

    if (! empty($tax_query)) {
        $args['tax_query'] = array(
            'relation' => 'OR',
            $tax_query,
        );
    }

    return new WP_Query($args);
}


/**
 * Generate SEO-friendly breadcrumbs with structured data
 * 
 * @return string HTML breadcrumbs output
 */
function theme_breadcrumbs()
{
    if (is_front_page()) return '';

    $breadcrumbs = [];
    $separator = '<span class="separator" aria-hidden="true">/</span>';

    // Home link
    $breadcrumbs[] = sprintf(
        '<a href="%s" itemprop="item">%s</a>',
        esc_url(home_url('/')),
        '<span itemprop="name">' . esc_html__('صفحه ی اصلی', 'jheme') . '</span>'
    );

    // Single post/pages
    if (is_singular()) {
        $post = get_queried_object();

        // Handle hierarchical post types
        if (is_post_type_hierarchical($post->post_type)) {
            $ancestors = array_reverse(get_post_ancestors($post));
            foreach ($ancestors as $ancestor_id) {
                $breadcrumbs[] = sprintf(
                    '<a href="%s" itemprop="item">%s</a>',
                    esc_url(get_permalink($ancestor_id)),
                    '<span itemprop="name">' . esc_html(get_the_title($ancestor_id)) . '</span>'
                );
            }
        } else {
            // Show taxonomy/archive for non-hierarchical
            $post_type = get_post_type_object($post->post_type);
            if ($post_type->has_archive) {
                $breadcrumbs[] = sprintf(
                    '<a href="%s" itemprop="item">%s</a>',
                    esc_url(get_post_type_archive_link($post->post_type)),
                    '<span itemprop="name">' . esc_html($post_type->labels->name) . '</span>'
                );
            }
        }

        // Handle custom post types
        if ('insurance' === $post->post_type) {
            $breadcrumbs[] = sprintf(
                '<a href="%s" itemprop="item">%s</a>',
                esc_url(home_url('/insurances')), // Customize this based on the base URL of your custom taxonomy or post type
                '<span itemprop="name">' . esc_html__('بیمه‌ها', 'jheme') . '</span>'
            );
        }

        if (is_singular('your_custom_post_type')) {
            // Replace 'your_custom_post_type' with your actual custom post type name
            $post_type = get_post_type_object('your_custom_post_type');
            if ($post_type && $post_type->has_archive) {
                $breadcrumbs[] = sprintf(
                    '<a href="%s" itemprop="item">%s</a>',
                    esc_url(get_post_type_archive_link('your_custom_post_type')),
                    '<span itemprop="name">' . esc_html($post_type->labels->name) . '</span>'
                );
            }
        }

        // Current item
        $breadcrumbs[] = sprintf(
            '<span class="current" itemprop="name">%s</span>',
            esc_html(get_the_title())
        );
    }
    // Taxonomy archives
    elseif (is_tax() || is_category() || is_tag()) {
        $term = get_queried_object();
        $taxonomy = get_taxonomy($term->taxonomy);

        // Taxonomy archive link
        if ($taxonomy->publicly_queryable && $taxonomy->show_ui) {
            $breadcrumbs[] = sprintf(
                '<a href="%s" itemprop="item">%s</a>',
                esc_url(get_post_type_archive_link($taxonomy->object_type[0])),
                '<span itemprop="name">' . esc_html($taxonomy->labels->name) . '</span>'
            );
        }

        // Term hierarchy
        $ancestors = get_ancestors($term->term_id, $term->taxonomy);
        foreach (array_reverse($ancestors) as $ancestor_id) {
            $ancestor = get_term($ancestor_id, $term->taxonomy);
            $breadcrumbs[] = sprintf(
                '<a href="%s" itemprop="item">%s</a>',
                esc_url(get_term_link($ancestor)),
                '<span itemprop="name">' . esc_html($ancestor->name) . '</span>'
            );
        }

        // Current term
        $breadcrumbs[] = sprintf(
            '<span class="current" itemprop="name">%s</span>',
            esc_html($term->name)
        );
    }
    // Post type archives
    elseif (is_post_type_archive()) {
        $post_type = get_queried_object();
        $breadcrumbs[] = sprintf(
            '<span class="current" itemprop="name">%s</span>',
            esc_html($post_type->labels->name)
        );
    }
    // Date archives
    elseif (is_date()) {
        $breadcrumbs[] = sprintf(
            '<span class="current" itemprop="name">%s</span>',
            esc_html(get_the_date(_x('F Y', 'monthly archives date format', 'jheme')))
        );
    }
    // Author archives
    elseif (is_author()) {
        $breadcrumbs[] = sprintf(
            '<span class="current" itemprop="name">%s</span>',
            esc_html(get_the_author())
        );
    }
    // Search results
    elseif (is_search()) {
        $breadcrumbs[] = sprintf(
            '<span class="current" itemprop="name">%s</span>',
            esc_html__('Search results for: ', 'jheme') . get_search_query()
        );
    }
    // 404 error
    elseif (is_404()) {
        $breadcrumbs[] = sprintf(
            '<span class="current" itemprop="name">%s</span>',
            esc_html__('Error 404', 'jheme')
        );
    }

    // Build output
    $output = '<nav class="breadcrumb" aria-label="' . esc_attr__('Breadcrumbs', 'jheme') . '" itemscope itemtype="https://schema.org/BreadcrumbList">';
    $output .= '<div class="breadcrumb-list">';

    foreach ($breadcrumbs as $index => $crumb) {
        $output .= sprintf(
            '<div class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">%s%s</div>',
            $crumb,
            ($index < count($breadcrumbs) - 1) ? $separator : ''
        );
    }

    $output .= '</div></nav>';

    return $output;
}


/**
 * Check if current url is home page
 *
 * @return bool True if current url is home page.
 */
function theme_is_home()
{
    return (is_front_page() && is_home());
}

/**
 * Get custom logo with fallback to site title
 *
 * @param string $class Additional CSS class.
 * @return string Logo HTML.
 */
function theme_get_logo($class = '')
{
    $class_attr = $class ? ' class="' . esc_attr($class) . '"' : '';
    $output = '';

    if (has_custom_logo()) {
        $output = get_custom_logo();
    } else {
        $output = '<a href="' . esc_url(home_url('/')) . '" rel="home"' . $class_attr . '>' . get_bloginfo('name') . '</a>';
    }

    return $output;
}

/**
 * Check if page has sidebar enabled
 *
 * @return bool True if sidebar is enabled.
 */
function theme_has_sidebar()
{
    // Global option for all pages
    $global_sidebar = theme_get_option('global_sidebar', true);

    if (! $global_sidebar) {
        return false;
    }

    // For specific page/post
    $sidebar = get_post_meta(get_the_ID(), '_theme_sidebar', true);

    if ($sidebar === 'disabled') {
        return false;
    }

    if (is_active_sidebar('sidebar-1')) {
        return true;
    }

    return false;
}

/**
 * Get main content classes based on layout
 *
 * @return string CSS classes.
 */
function theme_main_content_classes()
{
    $classes = 'col-12';

    if (theme_has_sidebar()) {
        $classes = is_rtl() ? 'col-lg-8 order-lg-2' : 'col-lg-8';
    }

    return $classes;
}

/**
 * Get sidebar content classes based on layout
 *
 * @return string CSS classes.
 */
function theme_sidebar_classes()
{
    return is_rtl() ? 'col-lg-4 order-lg-1' : 'col-lg-4';
}

/**
 * Split and filter array by separator
 *
 * @param string $string String to split.
 * @param string $separator Separator.
 * @return array Filtered array.
 */
function theme_split_array($string, $separator = ',')
{
    $array = explode($separator, $string);

    return array_filter(array_map('trim', $array));
}

/**
 * Get template part from the theme.
 *
 * This function retrieves a specified template part from the theme's template-parts directory.
 * It includes error handling to ensure the template exists before attempting to include it.
 *
 * @param string $name The name of the template part (without the .php extension).
 * @param array  $args Optional. An array of arguments to pass to the template part.
 */
function theme_part($name = null, $args = array())
{
    if (!empty($name) && is_string($name)) {
        // Extract arguments for use in the template part
        if (!empty($args) && is_array($args)) {
            extract($args);
        }

        // Get the template directory path
        $theme_dir = defined('TEMPLATEPATH') ? TEMPLATEPATH : get_template_directory();

        // Construct the path to the template part
        $template_path = $theme_dir . '/template-parts/' . $name . '.php';

        // Debug information
        // error_log("Attempting to load template part: " . $template_path);
        // error_log("File exists: " . (file_exists($template_path) ? 'true' : 'false'));

        // Check if the template part exists before including it
        if (file_exists($template_path)) {
            require $template_path;
        } else {
            // Handle the case where the template part does not exist
            //error_log("Template part '{$name}' not found in '{$template_path}'.");
            // Try to list directory contents for debugging
            if (is_dir(dirname($template_path))) {
                error_log("Directory contents of " . dirname($template_path) . ":");
                foreach (scandir(dirname($template_path)) as $file) {
                    error_log(" - " . $file);
                }
            }
        }
    }
}

/**
 * Convert hex color to rgb/rgba
 *
 * @param string $color Hex color.
 * @param float  $opacity Opacity.
 * @return string RGB/RGBA color.
 */
function theme_hex2rgba($color, $opacity = false)
{
    $default = 'rgb(0,0,0)';

    if (empty($color)) {
        return $default;
    }

    if ($color[0] == '#') {
        $color = substr($color, 1);
    }

    if (strlen($color) == 6) {
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return $default;
    }

    $rgb = array_map('hexdec', $hex);

    if ($opacity) {
        return 'rgba(' . implode(',', $rgb) . ',' . $opacity . ')';
    } else {
        return 'rgb(' . implode(',', $rgb) . ')';
    }
}


/**
 * Get environment
 *
 * @return string Environment.
 */
function theme_get_env()
{
    return getenv('JTHEM_DEV_MODE');
}


/**
 * Check if current environment is production
 *
 * @return bool True if current environment is production.
 */
function theme_is_production()
{
    return theme_get_env() == 'production';
}

/**
 * Get HTML for a static theme image.
 *
 * @param string $image   Image filename or path (e.g., 'home/category.avif').
 * @param string $class   Additional CSS classes.
 * @param string $alt     Alt text.
 * @param array  $attrs   Additional HTML attributes (e.g., ['id' => 'logo']).
 * @return string         Image HTML or empty string if invalid.
 */
function theme_get_static_image($image, $class = '', $alt = '', $attrs = [])
{
    if (empty($image)) {
        return '';
    }

    // Sanitize inputs
    $class = esc_attr(trim($class));
    $alt = esc_attr($alt);

    // Determine image path based on environment
    $base_path = 'src/images'; // پایه مسیر تصاویر
    $image_path = trailingslashit(get_template_directory()) . $base_path . '/' . $image;
    $image_url = trailingslashit(get_template_directory_uri()) . $base_path . '/' . $image;



    // Verify image exists
    if (!file_exists($image_path)) {

        return '';
    }

    // Build attributes
    $attr_string = '';
    $default_attrs = [
        'src' => esc_url($image_url),
        'class' => $class ? "theme-image $class" : 'theme-image',
        'alt' => $alt ? $alt : 'theme-image',
        'loading' => 'lazy',
    ];

    // Merge custom attributes
    foreach (array_merge($default_attrs, $attrs) as $key => $value) {
        if ($value !== '') {
            $attr_string .= ' ' . esc_attr($key) . '="' . esc_attr($value) . '"';
        }
    }

    $html = '<img' . $attr_string . '>';


    return $html;
}

function display_img($image, $class = '', $alt = '', $attrs = [])
{
    echo theme_get_static_image($image, $class, $alt, $attrs);
}


function inline_display_img($img, $class = '', $alt = '')
{
    if (theme_is_production()) {
        echo '<img src="' . THEME_URL . '/assets/images/' . $img . '" class="' . $class . '" alt="' . $alt . '">';
    } else {
        echo '<img src="' . THEME_URL . '/src/images/' . $img . '" class="' . $class . '" alt="' . $alt . '">';
    }
}




/**
 * Display an image from the WordPress media library.
 *
 * @param int    $attachment_id The attachment ID.
 * @param string $size         Image size (e.g., 'thumbnail', 'medium', 'full').
 * @param string $class        Additional CSS classes.
 * @param string $alt          Alt text (falls back to attachment alt).
 * @return string              HTML for the image.
 * @example :
 * Example: Display a specific attachment
 * $attachment_id = 123; // Replace with actual ID
 * echo theme_get_media_image($attachment_id, 'full', 'custom-image', 'Custom Image');
 */
function theme_get_media_image($attachment_id, $size = 'full', $class = '', $alt = '')
{
    if (!is_numeric($attachment_id) || $attachment_id <= 0) {
        return '';
    }

    // Get image HTML with WordPress function
    $image = wp_get_attachment_image(
        $attachment_id,
        $size,
        false,
        [
            'class' => esc_attr(trim('theme-image ' . $class)),
            'alt'   => !empty($alt) ? esc_attr($alt) : wp_get_attachment_caption($attachment_id),
            'loading' => 'lazy', // Enable lazy loading
        ]
    );

    return $image;
}

function get_image_path($image_name)
{

    if (theme_is_production()) {
        $base_path = 'assets/images/';
    } else {
        $base_path = 'src/images/';
    }

    return THEME_URL . "/" . $base_path . $image_name;
}



function helepre_time_elapsed_string($datetime, $full = false)
{
    if (!is_numeric($datetime)) {
        $datetime = strtotime($datetime);
    }
    $now = current_time('timestamp');
    $diff = $now - $datetime;

    if ($diff < 60) {
        return __('لحظاتی پیش', 'helepre'); // 'just now' in Persian
    }

    $tokens = array(
        31536000 => 'سال',
        2592000 => 'ماه',
        604800 => 'هفته',
        86400 => 'روز',
        3600 => 'ساعت',
        60 => 'دقیقه',
        1 => 'ثانیه'
    );

    foreach ($tokens as $unit => $text) {
        if ($diff >= $unit) {
            $numberOfUnits = floor($diff / $unit);
            return sprintf(_n('%d %s پیش', '%d %s پیش', $numberOfUnits, 'helepre'), $numberOfUnits, $text);
        }
    }

    return __('لحظاتی پیش', 'helepre'); // 'just now' in Persian
}

function helepre_post_date($echo = true)
{
    $post_timestamp = get_post_time('U', false);
    $jalali_date = jdate('Y/m/d', $post_timestamp, '', 'Asia/Tehran', 'fa'); // 'fa' for Persian
    $elapsed_time = helepre_time_elapsed_string($post_timestamp);
    $display_text = sprintf('%s (%s)', $jalali_date, $elapsed_time);

    $output = sprintf(
        '<time datetime="%s" title="%s">%s</time>',
        esc_attr(get_the_date('c')),
        esc_attr($jalali_date),
        esc_html($display_text)
    );

    if ($echo) {
        echo $output;
    } else {
        return $output;
    }
}


function helepre_post_date_with_options($show_date = true, $show_elapsed_time = true, $echo = true)
{
    $post_timestamp = get_post_time('U', false);
    $jalali_date = jdate('Y/m/d', $post_timestamp, '', 'Asia/Tehran', 'fa'); // 'fa' for Persian
    $elapsed_time = helepre_time_elapsed_string($post_timestamp);

    // If both date and elapsed time should be shown
    $display_text = '';
    if ($show_date && $show_elapsed_time) {
        $display_text = sprintf('%s (%s)', $jalali_date, $elapsed_time);
    }
    // If only date should be shown
    elseif ($show_date) {
        $display_text = $jalali_date;
    }
    // If only elapsed time should be shown
    elseif ($show_elapsed_time) {
        $display_text = $elapsed_time;
    }

    $output = sprintf(
        '<time datetime="%s" title="%s">%s</time>',
        esc_attr(get_the_date('c')),
        esc_attr($jalali_date),
        esc_html($display_text)
    );

    if ($echo) {
        echo $output;
    } else {
        return $output;
    }
}





/**
 * Helper function to get a category icon URL
 *
 * @param int $term_id Category/term ID (optional, uses current term if not provided)
 * @param string $size Image size (default: thumbnail)
 * @param string $field_id The meta field ID (default: category_icon)
 * @return string Icon URL or empty string if no icon
 */
function get_category_icon($term_id = 0, $size = 'thumbnail', $field_id = 'category_icon')
{
    if (!$term_id) {
        if (is_category() || is_tax()) {
            $term_id = get_queried_object_id();
        }
    }

    if (!$term_id) {
        return '';
    }

    $icon_id = get_term_meta($term_id, $field_id, true);
    if (!$icon_id) {
        return '';
    }

    return wp_get_attachment_image_url($icon_id, $size);
}

/**
 * Helper function to display a category icon
 *
 * @param int $term_id Category/term ID (optional, uses current term if not provided)
 * @param string $size Image size (default: thumbnail)
 * @param string $field_id The meta field ID (default: category_icon)
 * @param array $attr Image attributes
 * @return string HTML img tag or empty string
 */
function display_category_icon($term_id = 0, $size = 'thumbnail', $field_id = 'category_icon', $attr = [])
{
    if (!$term_id) {
        if (is_category() || is_tax()) {
            $term_id = get_queried_object_id();
        }
    }

    if (!$term_id) {
        return '';
    }

    $icon_id = get_term_meta($term_id, $field_id, true);
    if (!$icon_id) {
        return '';
    }

    $attr = array_merge([
        'class' => 'category-icon',
        'alt' => get_term($term_id)->name . ' icon'
    ], $attr);

    return wp_get_attachment_image($icon_id, $size, false, $attr);
}


/**
 * Usage examples in templates:
 *
 * 1. Display a category icon in a category template:
 *
 * <?php if (function_exists('display_category_icon')): ?>
 *     <?php echo display_category_icon(); ?>
 * <?php endif; ?>
 *
 * 2. Display a specific category's icon:
 *
 * <?php if (function_exists('display_category_icon')): ?>
 *     <?php echo display_category_icon(5); ?> <!-- where 5 is the category ID -->
 * <?php endif; ?>
 *
 * 3. Get the URL of a category icon:
 *
 * <?php if (function_exists('get_category_icon')): ?>
 *     <img src="<?php echo get_category_icon(5, 'medium'); ?>" alt="Category icon">
 * <?php endif; ?>
 *
 * 4. Use a shortcode in post content:
 *
 * [category_icon id="5" size="thumbnail"]
 * [category_icon slug="news" size="medium"]
 */


function display_insurance_category_icon($term_id)
{
    $icon_url = get_term_meta($term_id, 'insurance_icon', true);
    if ($icon_url) {
        echo '<img src="' . esc_url($icon_url) . '" alt="Category Icon" class="category-icon" />';
    }
}

/**
 * Get the count of liked products for a user with caching
 *
 * @param int $user_id
 * @return int
 */
function get_user_liked_products_count($user_id)
{
    if (!$user_id) {
        return 0;
    }

    // Check cache
    $cache_key = 'liked_products_count_' . $user_id;
    $count = get_transient($cache_key);

    if (false === $count) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'product_likes';
        $count = (int) $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name WHERE user_id = %d",
            $user_id
        ));

        // Cache for 1 hour
        set_transient($cache_key, $count, HOUR_IN_SECONDS);
    }

    return $count;
}

/**
 * Clear liked products count cache
 *
 * @param int $user_id
 */
function clear_liked_products_count_cache($user_id)
{
    if ($user_id) {
        $cache_key = 'liked_products_count_' . $user_id;
        delete_transient($cache_key);
    }
}


/**
 * Check if category has an icon
 *
 * @param int $term_id Category/term ID
 * @param string $field_id The meta field ID (default: category_icon)
 * @return bool
 */
function has_category_icon($term_id = 0, $field_id = 'category_icon')
{
    if (!$term_id) {
        if (is_category() || is_tax()) {
            $term_id = get_queried_object_id();
        }
    }

    if (!$term_id) {
        return false;
    }

    $icon_id = get_term_meta($term_id, $field_id, true);
    return !empty($icon_id);
}