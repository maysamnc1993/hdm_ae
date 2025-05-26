<?php
/**
 * FAQ Component Shortcode
 *
 * Provides shortcode functionality for the FAQ component.
 *
 * @package JThem
 * @subpackage Components
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Make sure the component class is loaded
if (!function_exists('jthem_faq')) {
    require_once get_template_directory() . '/components/faq/faq.php';
}

/**
 * Register FAQ shortcode
 */
function jthem_register_faq_shortcode() {
    add_shortcode('jthem_faq', 'jthem_faq_shortcode_callback');
}
add_action('init', 'jthem_register_faq_shortcode');

/**
 * FAQ Shortcode callback
 * 
 * Usage:
 * [jthem_faq id="custom_id" title="سوالات متداول" subtitle="پاسخ به سوالات رایج" category="general,shipping" accordion_type="multiple"]
 * 
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function jthem_faq_shortcode_callback($atts) {
    $atts = shortcode_atts(array(
        'items' => '',         // Comma-separated IDs (backwards compatibility)
        'ids' => '',           // Comma-separated IDs (new attribute)
        'category' => '',      // Comma-separated category slugs
        'exclude_category' => '', // Comma-separated category slugs to exclude
        'limit' => -1,         // Number of items to show
        'orderby' => 'date',   // Order by field
        'order' => 'DESC',     // Order direction
        'title' => 'سوالات متداول',  // Section title
        'subtitle' => '',      // Section subtitle
        'accordion_type' => 'single', // single or multiple
        'icon_open' => 'plus', // Icon type for open state
        'icon_close' => 'minus', // Icon type for closed state
        'show_category_title' => false, // Whether to show category title for each group
    ), $atts, 'jthem_faq');
    
    // Support both 'items' (old) and 'ids' (new) attributes for backward compatibility
    if (empty($atts['ids']) && !empty($atts['items'])) {
        $atts['ids'] = $atts['items'];
    }
    
    // Check if we're using the new CPT implementation
    if (class_exists('JThem_FAQ_Post_Type')) {
        // Delegate to the CPT implementation
        return JThem_FAQ_Post_Type::get_instance()->shortcode_callback($atts);
    }
    
    // Fallback to old implementation
    return jthem_legacy_faq_shortcode_callback($atts);
}

/**
 * Legacy FAQ shortcode callback (for backwards compatibility)
 *
 * @param array $atts Shortcode attributes
 * @return string Rendered HTML
 */
function jthem_legacy_faq_shortcode_callback($atts) {
    // Get all FAQ items from options
    $all_faq_items = get_option('jthem_faq_items', array());
    
    if (empty($all_faq_items)) {
        return '';
    }
    
    // Build FAQ items array based on provided IDs
    $faq_items = array();
    
    // If specific items are requested
    if (!empty($atts['ids'])) {
        $item_ids = explode(',', $atts['ids']);
        
        foreach ($item_ids as $id) {
            $id = trim($id);
            if (isset($all_faq_items[$id])) {
                $faq_items[] = $all_faq_items[$id];
            }
        }
    } else {
        // Use all items if no specific IDs provided
        foreach ($all_faq_items as $item) {
            $faq_items[] = $item;
        }
        
        // Limit if specified
        if ($atts['limit'] > 0 && count($faq_items) > $atts['limit']) {
            $faq_items = array_slice($faq_items, 0, (int) $atts['limit']);
        }
    }
    
    // If no items found, return empty
    if (empty($faq_items)) {
        return '';
    }
    
    // Create FAQ component with selected items
    $faq = new JThem_FAQ(array(
        'title' => $atts['title'],
        'subtitle' => $atts['subtitle'],
        'items' => $faq_items,
        'accordion_type' => $atts['accordion_type'],
        'icon_open' => $atts['icon_open'],
        'icon_close' => $atts['icon_close'],
    ));
    
    // Return rendered HTML
    return $faq->render();
}

/**
 * Get demo FAQ items when no items are provided
 * 
 * @return array Array of demo FAQ items
 */
function jthem_get_demo_faq_items() {
    return array(
        array(
            'question' => 'چگونه می‌توانم سفارش خود را پیگیری کنم؟',
            'answer' => 'شما می‌توانید با وارد شدن به حساب کاربری خود در بخش "سفارش‌های من" وضعیت سفارش خود را مشاهده کنید.',
            'is_open' => true
        ),
        array(
            'question' => 'زمان تحویل سفارش‌ها چقدر است؟',
            'answer' => 'زمان تحویل سفارش‌ها بسته به موقعیت جغرافیایی شما متفاوت است. معمولاً سفارش‌ها در تهران ۱ تا ۲ روز کاری و در سایر شهرها ۲ تا ۵ روز کاری زمان می‌برد.',
        ),
        array(
            'question' => 'روش‌های پرداخت چیست؟',
            'answer' => 'ما روش‌های پرداخت متنوعی از جمله پرداخت آنلاین با کارت بانکی، پرداخت درب منزل و پرداخت از طریق کیف پول را پشتیبانی می‌کنیم.',
        ),
    );
} 