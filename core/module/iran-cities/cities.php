<?php
/**
 * Iran Cities Module
 *
 * A reusable module that provides access to Iran's provinces and cities data.
 * This module can be easily included in any project that needs Iran's geographical data.
 *
 * @package CRM
 * @subpackage Modules
 */

// Don't load directly
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Iran_Cities {
    /**
     * Get all Iran provinces
     *
     * @return array Associative array of province ID => province name
     */
    public static function get_provinces() {
        return array(
            '1' => 'آذربایجان شرقی',
            '2' => 'آذربایجان غربی',
            '3' => 'اردبیل',
            '4' => 'اصفهان',
            '5' => 'البرز',
            '6' => 'ایلام',
            '7' => 'بوشهر',
            '8' => 'تهران',
            '9' => 'چهارمحال و بختیاری',
            '10' => 'خراسان جنوبی',
            '11' => 'خراسان رضوی',
            '12' => 'خراسان شمالی',
            '13' => 'خوزستان',
            '14' => 'زنجان',
            '15' => 'سمنان',
            '16' => 'سیستان و بلوچستان',
            '17' => 'فارس',
            '18' => 'قزوین',
            '19' => 'قم',
            '20' => 'کردستان',
            '21' => 'کرمان',
            '22' => 'کرمانشاه',
            '23' => 'کهگیلویه و بویراحمد',
            '24' => 'گلستان',
            '25' => 'گیلان',
            '26' => 'لرستان',
            '27' => 'مازندران',
            '28' => 'مرکزی',
            '29' => 'هرمزگان',
            '30' => 'همدان',
            '31' => 'یزد'
        );
    }

    /**
     * Get cities for a specific province
     *
     * @param string $province_id The ID of the province
     * @return array Array of cities for the given province
     */
    public static function get_cities($province_id) {
        $cities = self::get_all_cities();
        return isset($cities[$province_id]) ? $cities[$province_id] : array();
    }

    /**
     * Get all cities organized by province
     *
     * @return array Multi-dimensional array of cities organized by province ID
     */
    public static function get_all_cities() {
        return array(
            '1' => array('تبریز', 'مراغه', 'میانه', 'اهر', 'سراب', 'مرند', 'بناب', 'شبستر', 'آذرشهر', 'هریس', 'جلفا', 'ملکان', 'بستان‌آباد', 'ورزقان', 'هشترود', 'چاراویماق', 'کلیبر', 'خداآفرین'),
            '2' => array('ارومیه', 'خوی', 'میاندوآب', 'سلماس', 'ماکو', 'بوکان', 'مهاباد', 'تکاب', 'نقده', 'پیرانشهر', 'سردشت', 'چالدران', 'شوط', 'پلدشت', 'اشنویه'),
            '3' => array('اردبیل', 'پارس‌آباد', 'مشگین‌شهر', 'خلخال', 'گرمی', 'نمین', 'نیر', 'کوثر', 'بیله‌سوار'),
            '4' => array('اصفهان', 'کاشان', 'نجف‌آباد', 'شاهین‌شهر', 'خمینی‌شهر', 'فلاورجان', 'گلپایگان', 'مبارکه', 'اردستان', 'شهرضا', 'خوانسار', 'نطنز', 'آران و بیدگل', 'نایین', 'تیران', 'فریدون‌شهر', 'سمیرم', 'دهاقان', 'چادگان', 'بویین و میاندشت', 'خور و بیابانک', 'لنجان', 'فریدن'),
            '5' => array('کرج', 'فردیس', 'ساوجبلاغ', 'نظرآباد', 'اشتهارد', 'طالقان'),
            '6' => array('ایلام', 'مهران', 'دهلران', 'ایوان', 'آبدانان', 'دره‌شهر', 'شیروان و چرداول', 'ملکشاهی', 'بدره', 'سیروان'),
            '7' => array('بوشهر', 'گناوه', 'دشتستان', 'کنگان', 'دشتی', 'جم', 'تنگستان', 'دیر', 'دیلم'),
            '8' => array('تهران', 'دماوند', 'شمیرانات', 'ری', 'شهریار', 'اسلامشهر', 'رباط‌کریم', 'پاکدشت', 'ورامین', 'فیروزکوه', 'قدس', 'ملارد', 'پیشوا', 'بهارستان', 'پردیس', 'قرچک'),
            '9' => array('شهرکرد', 'بروجن', 'لردگان', 'فارسان', 'کیار', 'اردل', 'کوهرنگ', 'سامان', 'بن'),
            '10' => array('بیرجند', 'قائنات', 'نهبندان', 'سربیشه', 'درمیان', 'فردوس', 'طبس', 'خوسف', 'سرایان', 'زیرکوه', 'بشرویه'),
            '11' => array('مشهد', 'نیشابور', 'سبزوار', 'تربت حیدریه', 'کاشمر', 'قوچان', 'تربت جام', 'تایباد', 'گناباد', 'درگز', 'خواف', 'سرخس', 'بردسکن', 'فریمان', 'چناران', 'مه ولات', 'جوین', 'بجستان', 'زاوه', 'جغتای', 'خلیل‌آباد', 'باخرز', 'ششتمد', 'صالح‌آباد', 'فیروزه', 'کلات', 'خوشاب', 'رشتخوار', 'داورزن'),
            '12' => array('بجنورد', 'شیروان', 'اسفراین', 'جاجرم', 'مانه و سملقان', 'گرمه', 'راز و جرگلان', 'فاروج'),
            '13' => array('اهواز', 'دزفول', 'آبادان', 'خرمشهر', 'بندر ماهشهر', 'بهبهان', 'اندیمشک', 'شوشتر', 'مسجد سلیمان', 'شوش', 'ایذه', 'رامهرمز', 'باغ‌ملک', 'امیدیه', 'هندیجان', 'لالی', 'رامشیر', 'گتوند', 'اندیکا', 'شادگان', 'هفتکل', 'هویزه', 'آغاجاری', 'کارون', 'حمیدیه', 'باوی'),
            '14' => array('زنجان', 'ابهر', 'خدابنده', 'خرمدره', 'ماه‌نشان', 'طارم', 'ایجرود', 'سلطانیه'),
            '15' => array('سمنان', 'شاهرود', 'دامغان', 'گرمسار', 'مهدی‌شهر', 'میامی', 'آرادان', 'سرخه'),
            '16' => array('زاهدان', 'چابهار', 'ایرانشهر', 'زابل', 'سراوان', 'نیک‌شهر', 'خاش', 'کنارک', 'زهک', 'سرباز', 'قصرقند', 'مهرستان', 'دلگان', 'فنوج', 'میرجاوه', 'هامون', 'نیمروز', 'هیرمند'),
            '17' => array('شیراز', 'مرودشت', 'کازرون', 'فسا', 'داراب', 'جهرم', 'لارستان', 'فیروزآباد', 'نی‌ریز', 'آباده', 'لامرد', 'کوار', 'سپیدان', 'استهبان', 'ممسنی', 'اقلید', 'پاسارگاد', 'خرم‌بید', 'گراش', 'خنج', 'زرین‌دشت', 'قیر و کارزین', 'رستم', 'مهر', 'خرامه', 'فراشبند', 'سروستان', 'ارسنجان', 'بوانات'),
            '18' => array('قزوین', 'تاکستان', 'البرز', 'آبیک', 'بوئین‌زهرا', 'آوج'),
            '19' => array('قم'),
            '20' => array('سنندج', 'سقز', 'مریوان', 'بانه', 'قروه', 'کامیاران', 'بیجار', 'دیواندره', 'دهگلان', 'سروآباد'),
            '21' => array('کرمان', 'سیرجان', 'جیرفت', 'رفسنجان', 'بم', 'کهنوج', 'زرند', 'بافت', 'راور', 'عنبرآباد', 'بردسیر', 'ریگان', 'منوجان', 'شهربابک', 'رودبار جنوب', 'ارزوئیه', 'قلعه گنج', 'فهرج', 'انار', 'نرماشیر', 'رابر', 'فاریاب'),
            '22' => array('کرمانشاه', 'اسلام‌آباد غرب', 'سرپل ذهاب', 'کنگاور', 'سنقر', 'قصر شیرین', 'گیلانغرب', 'پاوه', 'جوانرود', 'دالاهو', 'روانسر', 'هرسین', 'صحنه', 'ثلاث باباجانی'),
            '23' => array('یاسوج', 'گچساران', 'کهگیلویه', 'بهمئی', 'دنا', 'بویراحمد', 'چرام', 'لنده', 'باشت'),
            '24' => array('گرگان', 'گنبد کاووس', 'آق‌قلا', 'کردکوی', 'بندر گز', 'کلاله', 'آزادشهر', 'علی‌آباد', 'مینودشت', 'ترکمن', 'رامیان', 'مراوه‌تپه', 'گالیکش', 'گمیشان'),
            '25' => array('رشت', 'انزلی', 'لاهیجان', 'لنگرود', 'رودسر', 'تالش', 'آستارا', 'صومعه‌سرا', 'بندر انزلی', 'رودبار', 'فومن', 'شفت', 'ماسال', 'آستانه اشرفیه', 'سیاهکل', 'رضوانشهر', 'املش'),
            '26' => array('خرم‌آباد', 'بروجرد', 'دورود', 'کوهدشت', 'الیگودرز', 'ازنا', 'پلدختر', 'سلسله', 'دلفان', 'رومشکان', 'چگنی'),
            '27' => array('ساری', 'بابل', 'آمل', 'قائم‌شهر', 'بهشهر', 'تنکابن', 'نوشهر', 'چالوس', 'نکا', 'بابلسر', 'محمودآباد', 'نور', 'رامسر', 'جویبار', 'گلوگاه', 'فریدونکنار', 'میاندورود', 'سوادکوه', 'سیمرغ', 'کلاردشت', 'عباس‌آباد', 'سوادکوه شمالی'),
            '28' => array('اراک', 'ساوه', 'خمین', 'محلات', 'دلیجان', 'شازند', 'آشتیان', 'تفرش', 'فراهان', 'خنداب', 'کمیجان', 'زرندیه'),
            '29' => array('بندرعباس', 'میناب', 'بندر لنگه', 'رودان', 'قشم', 'حاجی‌آباد', 'جاسک', 'پارسیان', 'بستک', 'سیریک', 'خمیر', 'ابوموسی', 'بشاگرد'),
            '30' => array('همدان', 'ملایر', 'نهاوند', 'اسدآباد', 'تویسرکان', 'کبودرآهنگ', 'بهار', 'رزن', 'فامنین'),
            '31' => array('یزد', 'میبد', 'اردکان', 'بافق', 'ابرکوه', 'مهریز', 'تفت', 'خاتم', 'اشکذر', 'بهاباد')
        );
    }

    /**
     * Get a flat array of all cities
     *
     * @return array Flat array of all cities
     */
    public static function get_all_cities_flat() {
        $cities = self::get_all_cities();
        $flat_cities = array();
        
        foreach ($cities as $province_cities) {
            $flat_cities = array_merge($flat_cities, $province_cities);
        }
        
        return $flat_cities;
    }

    /**
     * Get province name by its ID
     *
     * @param string $province_id The ID of the province
     * @return string|null The province name or null if not found
     */
    public static function get_province_name($province_id) {
        $provinces = self::get_provinces();
        return isset($provinces[$province_id]) ? $provinces[$province_id] : null;
    }

    /**
     * Check if a city exists in a province
     *
     * @param string $city_name The name of the city
     * @param string $province_id The ID of the province
     * @return bool True if the city exists in the province, false otherwise
     */
    public static function city_exists_in_province($city_name, $province_id) {
        $cities = self::get_cities($province_id);
        return in_array($city_name, $cities);
    }
    
    /**
     * Initialize the module
     */
    public static function init() {
        // Only proceed if we're in a WordPress environment
        if (!function_exists('add_action')) {
            return;
        }
        
        // Register AJAX handlers
        add_action('wp_ajax_get_iran_cities', array('Iran_Cities', 'ajax_handler'));
        add_action('wp_ajax_nopriv_get_iran_cities', array('Iran_Cities', 'ajax_handler'));
        
        // Enqueue scripts and styles
        add_action('wp_enqueue_scripts', array('Iran_Cities', 'enqueue_assets'));
        add_action('admin_enqueue_scripts', array('Iran_Cities', 'enqueue_assets'));
        
        // Define a constant to know that the module is loaded
        if (!defined('IRAN_CITIES_MODULE_LOADED')) {
            define('IRAN_CITIES_MODULE_LOADED', true);
        }
    }
    
    /**
     * AJAX handler for retrieving cities by province ID
     */
    public static function ajax_handler() {
        // Verify nonce
        if (!function_exists('check_ajax_referer') || !function_exists('wp_send_json_error') || !function_exists('wp_send_json_success')) {
            echo json_encode(array('success' => false, 'message' => 'WordPress functions not available'));
            exit;
        }
        
        if (!check_ajax_referer('crm_nonce', 'nonce', false)) {
            wp_send_json_error(array('message' => 'Security check failed'));
            return;
        }
        
        $province_id = isset($_POST['province_id']) ? sanitize_text_field($_POST['province_id']) : '';
        
        if (empty($province_id)) {
            wp_send_json_error(array('message' => 'Province ID is required'));
            return;
        }
        
        // Convert to string to ensure consistent type with data array keys
        $province_id = (string)$province_id;
        
        $cities = self::get_cities($province_id);
        
        if (empty($cities)) {
            wp_send_json_error(array(
                'message' => 'No cities found for this province',
                'province_id' => $province_id
            ));
            return;
        }
        
        wp_send_json_success($cities);
    }
    
    /**
     * Enqueue Iran Cities scripts and styles
     */
    public static function enqueue_assets() {
        if (!function_exists('wp_register_script') || !function_exists('wp_enqueue_script') || !function_exists('wp_localize_script')) {
            return;
        }
        
        // Get the template directory URL
        $theme_dir = get_template_directory_uri();
        
        // Register and enqueue the script
        wp_register_script(
            'iran-cities', 
            $theme_dir . '/assets/plugins/custom/iran-cities/cities.js', 
            array('jquery'), 
            '1.0.3', 
            true
        );
        
        // Localize script with cities data and AJAX URL
        wp_localize_script('iran-cities', 'iranCitiesData', array(
            'provinces' => self::get_provinces(),
            'cities' => self::get_all_cities(),
            'ajaxurl' => function_exists('admin_url') ? admin_url('admin-ajax.php') : ''
        ));
        
        wp_enqueue_script('iran-cities');
    }
    
    /**
     * Output province and city select fields with proper markup
     * 
     * @param array $args Optional arguments for customizing the output
     */
    public static function output_fields($args = array()) {
        $defaults = array(
            'province_id' => '',
            'city_name' => '',
            'province_label' => 'استان',
            'city_label' => 'شهر',
            'province_name' => 'province',
            'city_name' => 'city',
            'province_id' => 'province_select',
            'city_id' => 'city_select',
            'province_class' => 'form-select province-select',
            'city_class' => 'form-select city-select',
            'container_class' => 'row mb-6',
            'echo' => true
        );
        
        $args = wp_parse_args($args, $defaults);
        
        $provinces = self::get_provinces();
        
        $output = '<div class="' . esc_attr($args['container_class']) . '">';
        
        // Province Field
        $output .= '<div class="col-lg-6 mb-3 mb-lg-0">';
        $output .= '<label class="form-label fw-bold">' . esc_html($args['province_label']) . '</label>';
        $output .= '<select name="' . esc_attr($args['province_name']) . '" id="' . esc_attr($args['province_id']) . '" class="' . esc_attr($args['province_class']) . '">';
        $output .= '<option value="">انتخاب استان</option>';
        
        foreach ($provinces as $id => $name) {
            $selected = ($args['province_id'] == $id) ? ' selected' : '';
            $output .= '<option value="' . esc_attr($id) . '"' . $selected . '>' . esc_html($name) . '</option>';
        }
        
        $output .= '</select>';
        $output .= '</div>';
        
        // City Field
        $output .= '<div class="col-lg-6">';
        $output .= '<label class="form-label fw-bold">' . esc_html($args['city_label']) . '</label>';
        $output .= '<select name="' . esc_attr($args['city_name']) . '" id="' . esc_attr($args['city_id']) . '" class="' . esc_attr($args['city_class']) . '" disabled>';
        $output .= '<option value="">انتخاب شهر</option>';
        $output .= '</select>';
        $output .= '</div>';
        
        $output .= '</div>';
        
        if ($args['echo']) {
            echo $output;
        }
        
        return $output;
    }
}

/**
 * Helper function to get all provinces
 *
 * @return array Associative array of province ID => province name
 */
function get_iran_provinces() {
    return Iran_Cities::get_provinces();
}

/**
 * Helper function to get cities for a specific province
 *
 * @param string $province_id The ID of the province
 * @return array Array of cities for the given province
 */
function get_iran_cities($province_id) {
    return Iran_Cities::get_cities($province_id);
}

/**
 * Helper function to output province and city fields
 * 
 * @param array $args Optional arguments
 * @return string HTML output
 */
function iran_cities_fields($args = array()) {
    return Iran_Cities::output_fields($args);
}

// Initialize the module
if (function_exists('add_action')) {
    add_action('init', array('Iran_Cities', 'init'), 10);
}
