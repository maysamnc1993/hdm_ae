<?php

/**
 * Theme functions and definitions
 *
 * @package JThem
 * @since 1.0.0
 */

if (!defined('ABSPATH')) exit;

if (!defined('THEME_URI')) {
    define('THEME_URI', get_template_directory());
}
if (!defined('THEME_URL')) {
    define('THEME_URL', get_template_directory_uri());
}


// auto loader
require_once __DIR__ . '/vendor/autoload.php';


// Load the bootstrap file that includes all core builder classes
require_once THEME_URI . '/core/bootstrap.php';


//use helpers
use JThem\Core\Helpers\Options;

/**
 * Include Config System
 * 
 * Load and initialize theme configuration from .env file
 */
require_once THEME_URI . '/core/config/theme-config.php';

/**
 * Theme setup
 */
require_once THEME_URI . '/core/config/theme-setup.php';


JThem\Config\ThemeConfig::init();

//===== core functions =====//

/**
 * RTL Support
 */
//require_once THEME_URI . '/core/functions/rtl-support.php';

/**
 * Enqueue scripts and styles
 */
require_once THEME_URI . '/core/functions/enqueue-scripts.php';



//===== core helpers =====//
/**
 * Include helper files
 */
require_once THEME_URI . '/core/helpers/vite.php';
require_once THEME_URI . '/core/helpers/language-switcher.php';
//require_once THEME_URI . '/core/helpers/ajax-handler.php';
require_once THEME_URI . '/core/helpers/page-specific-assets.php';
require_once THEME_URI . '/core/helpers/svg-icons.php';
require_once THEME_URI . '/core/helpers/iconfont.php';
require_once THEME_URI . '/core/helpers/get-banner.php';


require_once THEME_URI . '/inc/template-tags.php';



require_once THEME_URI . '/core/helpers/general-helpers.php';
require_once THEME_URI . '/core/helpers/acf.php';

/**
 * Load modular components
 */
$components_loader = THEME_URI . '/components/loader.php';
if (file_exists($components_loader)) {
    require_once $components_loader;
}








// ======== views functions ======== ////
require_once THEME_URI . '/inc/header.php';




// ======== admin functions ======== ////


// $pg_options = new Options();
function fn_options()
{
    global $pg_options;
    return $pg_options;
}
require_once THEME_URI . '/core/admin/admin-redux.php';
require_once THEME_URI . '/core/admin/admin-acf.php';
require_once THEME_URI . '/core/admin/dependencies-check.php';
require_once THEME_URI . '/core/admin/theme-optoins.php';

require_once THEME_URI . '/core/helpers/get-options.php';





// ======== modules functions ======== //
require_once THEME_URI . '/core/module/modules.php';




// ======== ajax functions ======== //

require_once THEME_URI. '/core/ajaxs/ajax.php';



// ======== hooks functions ======== //
require_once THEME_URI. '/core/hooks/rewrite-rule.php';



function lead_form_request($attributes){
    $field = $attributes['field'];
    $title = $attributes['title'];
    $tag = $attributes['tag'];
    $field = explode(',',$field);
//    if(in_array('name',$field)){
//        $name_show = 'block;';
//    }else{
//        $name_show = 'none;';
//    }
    $class_name = 'form_'.rand(1000,100000);
    $return = '
        
        <div class="lead_form_request_div" >
            <span class="title">'.$title.'</span>
            <form  method="post" class="lead_form_request_ajax" id="'.$class_name.'">
            <div class="AlertForm" style="display: none"></div>
            
            <input type="hidden" id="tag" value="'.$tag.'" name="tag">
            <div class="form-group half" style="display: '.((in_array('name',$field)) ? '' : 'none').'">
                
                <input type="text" class="form-control '.((in_array('name',$field)) ? 'validate' : '').'" data-validate="empty" id="name" name="name" placeholder="Full Name">
            </div>
             
            <div class="form-group half" style="display: '.((in_array('mobile',$field)) ? '' : 'none').'">
              
                <input type="text" class="form-control isNumberic '.((in_array('mobile',$field)) ? 'validate' : '').'" data-validate="mobile" maxlength="12" id="mobile" name="mobile" placeholder="Phone">
            </div>
            
             <div class="form-group half" style="display: '.((in_array('email',$field)) ? '' : 'none').'">
      
                <input type="email" class="form-control '.((in_array('email',$field)) ? 'validate' : '').'" data-validate="email"  id="email" name="email" placeholder="Email">
            </div>
            <div class="form-group half" style="display: '.((in_array('website',$field)) ? '' : 'none').'">
             
                <input type="text" class="form-control '.((in_array('website',$field)) ? 'validate' : '').'" data-validate="empty"  id="website" name="website" placeholder="Business Name">
            </div>
               <div class="form-group" style="display: '.((in_array('description',$field)) ? '' : 'none').'">
             
                <input type="text" class="form-control '.((in_array('description',$field)) ? 'validate' : '').'" data-validate="empty"  id="description" name="description"
                    placeholder="Your message">
            </div>
            
            <input type="submit" class="btn" value="Send">
            
            </form>
        </div>
    ';
    return $return;
}

add_shortcode('lead_form_request','lead_form_request');

add_action('rest_api_init', function () {
    register_rest_route('api/v1', '/lead_form_request/', array(
        'methods' => 'POST',
        'callback' => 'handle_lead_form_request',
        'permission_callback' => '__return_true',
    ));
});

function handle_lead_form_request($data) {
    // دریافت اطلاعات از درخواست
    $params = $data->get_params();
    
    // داده‌ها را هندل کنید و پاسخ دهید
    return rest_ensure_response(array(
        'status' => 'success',
        'message' => 'Your form has been submitted successfully.',
    ));
}
/**
 * ACF Fields Configuration for Web Analytics Page - UPDATED VERSION
 * این کد را در functions.php قرار دهید
 */

 add_action('acf/init', function() {
    if( !function_exists('acf_add_local_field_group') ) return;

    // ===== HERO SECTION =====
    acf_add_local_field_group(array(
        'key' => 'group_wa_hero_premium_v2',
        'title' => '🚀 WA Hero Section',
        'fields' => array(
            array(
                'key' => 'field_hero_media',
                'label' => 'Hero Media (Video or Image)',
                'name' => 'hero_media',
                'type' => 'file',
                'instructions' => 'آپلود ویدیو یا عکس Hero - فایل‌های قابل قبول: MP4, WebM, JPG, PNG, WebP',
                'return_format' => 'array',
                'mime_types' => 'mp4,webm,jpg,jpeg,png,webp',
            ),
            array(
                'key' => 'field_hero_title',
                'label' => 'Hero Title',
                'name' => 'hero_title',
                'type' => 'text',
                'instructions' => 'عنوان اصلی Hero (حداکثر 60 کاراکتر)',
                'maxlength' => 60,
                'default_value' => 'Know Exactly What Drives Revenue',
            ),
            array(
                'key' => 'field_hero_description',
                'label' => 'Hero Description',
                'name' => 'hero_description',
                'type' => 'textarea',
                'instructions' => 'توضیحات Hero (150-200 کاراکتر)',
                'rows' => 3,
                'maxlength' => 200,
                'default_value' => 'HDM builds measurement systems that make your marketing data reliable, actionable, and scalable.',
            ),
            array(
                'key' => 'field_hero_cta_text',
                'label' => 'CTA Button Text',
                'name' => 'hero_cta_text',
                'type' => 'text',
                'default_value' => 'Book a Call',
            ),
            array(
                'key' => 'field_hero_cta_link',
                'label' => 'CTA Button Link',
                'name' => 'hero_cta_link',
                'type' => 'url',
                'default_value' => '#contact',
            ),
            array(
                'key' => 'field_clutch_image',
                'label' => 'Clutch Badge Image',
                'name' => 'clutch_image',
                'type' => 'image',
                'instructions' => 'تصویر Clutch (200x200px)',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
            ),
            array(
                'key' => 'field_clutch_point',
                'label' => 'Clutch Review Text',
                'name' => 'hero_clutch_point',
                'type' => 'text',
                'default_value' => '5.0 on Clutch',
            ),
            array(
                'key' => 'field_clutch_url',
                'label' => 'Clutch Profile URL',
                'name' => 'hero_clutch_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_google_image',
                'label' => 'Google Review Badge Image',
                'name' => 'google_review_image',
                'type' => 'image',
                'instructions' => 'تصویر Google Reviews (200x200px)',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
            ),
            array(
                'key' => 'field_google_point',
                'label' => 'Google Review Text',
                'name' => 'hero_google_review_point',
                'type' => 'text',
                'default_value' => '4.9 on Google',
            ),
            array(
                'key' => 'field_google_url',
                'label' => 'Google Review URL',
                'name' => 'hero_google_review_url',
                'type' => 'url',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-web-analytics.php',
                ),
            ),
        ),
        'menu_order' => 1,
        'position' => 'acf_after_title',
        'style' => 'seamless',
    ));

    // ===== PROBLEM SECTION =====
    acf_add_local_field_group(array(
        'key' => 'group_wa_problem',
        'title' => '🎯 Problem Section',
        'fields' => array(
            array(
                'key' => 'field_problem_title',
                'label' => 'Problem Title',
                'name' => 'problem_title',
                'type' => 'text',
                'default_value' => 'What problem does this service solve?',
            ),
            array(
                'key' => 'field_problem_description',
                'label' => 'Problem Description',
                'name' => 'problem_description',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => 'It helps you clearly understand what is happening across your marketing system...',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-web-analytics.php',
                ),
            ),
        ),
        'menu_order' => 2,
    ));

    // ===== DELIVERABLES SECTION =====
    acf_add_local_field_group(array(
        'key' => 'group_wa_deliverables_v2',
        'title' => '📦 Deliverables Section',
        'fields' => array(
            array(
                'key' => 'field_deliverables_v2',
                'label' => 'Deliverables List',
                'name' => 'deliverables',
                'type' => 'repeater',
                'instructions' => 'اضافه کردن آیتم‌های Deliverable (توصیه: 4-6 آیتم)',
                'layout' => 'block',
                'button_label' => 'Add Deliverable',
                'sub_fields' => array(
                    array(
                        'key' => 'field_deliverable_icon',
                        'label' => 'Icon (Image or Font Awesome Class)',
                        'name' => 'icon',
                        'type' => 'image',
                        'instructions' => 'آپلود آیکون (64x64px) یا در فیلد متنی نام کلاس Font Awesome وارد کنید (مثال: fa-solid fa-chart-line)',
                        'return_format' => 'array',
                        'wrapper' => array(
                            'width' => '30',
                        ),
                    ),
                    array(
                        'key' => 'field_deliverable_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                        'required' => 1,
                        'placeholder' => 'مثال: Complete Analytics Setup',
                        'wrapper' => array(
                            'width' => '70',
                        ),
                    ),
                    array(
                        'key' => 'field_deliverable_description',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'required' => 1,
                        'rows' => 3,
                        'placeholder' => 'توضیحات کامل این deliverable...',
                    ),
                ),
                'min' => 1,
                'max' => 8,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-web-analytics.php',
                ),
            ),
        ),
        'menu_order' => 3,
    ));

    // ===== WHY HDM SECTION =====
    acf_add_local_field_group(array(
        'key' => 'group_wa_why_hdm_v2',
        'title' => '⭐ Why HDM Section',
        'fields' => array(
            array(
                'key' => 'field_why_hdm_title',
                'label' => 'Section Title',
                'name' => 'why_hdm_title',
                'type' => 'text',
                'default_value' => 'Why HDM (Dubai Market Fit)',
            ),
            array(
                'key' => 'field_why_hdm_image',
                'label' => 'Why HDM Image (Optional)',
                'name' => 'why_hdm_image',
                'type' => 'image',
                'instructions' => 'تصویر برای قسمت Why HDM - اختیاری (اگر خالی بگذارید، متریک‌های پیشفرض نمایش داده می‌شود)',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_why_hdm_points',
                'label' => 'Why HDM Points',
                'name' => 'why_hdm_points',
                'type' => 'repeater',
                'instructions' => 'نکات کلیدی (توصیه: 5-8 نکته)',
                'layout' => 'table',
                'button_label' => 'Add Point',
                'sub_fields' => array(
                    array(
                        'key' => 'field_point_text',
                        'label' => 'Point Text',
                        'name' => 'text',
                        'type' => 'text',
                        'required' => 1,
                        'placeholder' => 'مثال: Based in Dubai with regional expertise',
                    ),
                ),
                'min' => 1,
                'max' => 10,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-web-analytics.php',
                ),
            ),
        ),
        'menu_order' => 4,
    ));

    // ===== CTA SECTION =====
    acf_add_local_field_group(array(
        'key' => 'group_wa_cta',
        'title' => '📞 CTA Section',
        'fields' => array(
            array(
                'key' => 'field_cta_title',
                'label' => 'CTA Title',
                'name' => 'cta_title',
                'type' => 'text',
                'default_value' => 'Book a 15-Minute Measurement Call',
            ),
            array(
                'key' => 'field_cta_description',
                'label' => 'CTA Description',
                'name' => 'cta_description',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'Tell us what youre struggling with, and well clearly explain what you actually need and what to fix first.',
            ),
            array(
                'key' => 'field_cta_button_text',
                'label' => 'Button Text',
                'name' => 'cta_button_text',
                'type' => 'text',
                'default_value' => 'Book a Call',
            ),
            array(
                'key' => 'field_cta_button_link',
                'label' => 'Button Link',
                'name' => 'cta_button_link',
                'type' => 'url',
                'default_value' => '#contact',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-web-analytics.php',
                ),
            ),
        ),
        'menu_order' => 5,
    ));
});

/**
 * توضیحات فیلدها:
 * 
 * 1. HERO MEDIA: حالا ویدیو و عکس رو قبول می‌کنه
 * 2. DELIVERABLES ICON: می‌تونید عکس آپلود کنید یا اسم کلاس Font Awesome بنویسید
 * 3. WHY HDM IMAGE: یه فیلد تصویر اختیاری اضافه شده - اگر خالی باشه، متریک‌ها نمایش داده میشن
 */


add_action('wp_enqueue_scripts', function () {

    if (is_page_template('page-web-analytics.php')) {

        wp_enqueue_style(
            'wa-style',
            get_template_directory_uri() . '/assets/css/pages/wa.css',
            [],
            filemtime(get_template_directory() . '/assets/css/pageswa.css')
        );

    } 

});
