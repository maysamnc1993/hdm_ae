<?php
/**
 * RTL Support Functions
 *
 * @package JThem
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Add RTL body class if needed
 *
 * @param array $classes Array of body classes.
 * @return array Modified array of body classes.
 */
function theme_rtl_body_class( $classes ) {
    if ( is_rtl() ) {
        $classes[] = 'rtl';
    }
    
    return $classes;
}
add_filter( 'body_class', 'theme_rtl_body_class' );


/**
 * Set locale attributes in HTML tag
 *
 * @param string $output HTML output.
 * @return string Modified HTML output.
 */
function theme_add_html_lang_dir( $output ) {
    $lang = get_bloginfo( 'language' );
    $dir = is_rtl() ? 'rtl' : 'ltr';
    
    $output = preg_replace( '/^(<html\s[^>]*?)(?:lang=["\'][^"\']*["\'])?/', '$1 lang="' . $lang . '"', $output );
    $output = preg_replace( '/^(<html\s[^>]*?)(?:dir=["\'][^"\']*["\'])?/', '$1 dir="' . $dir . '"', $output );
    
    return $output;
}
add_filter( 'language_attributes', 'theme_add_html_lang_dir' );

/**
 * Persian specific date and number formatting
 *
 * @param string $j Date format.
 * @return string Modified date format.
 */
function theme_persian_date( $j ) {
    if ( get_locale() !== 'fa_IR' ) {
        return $j;
    }
    
    $j = str_replace( array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' ), 
                      array( '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹' ), $j );
    
    return $j;
}
add_filter( 'the_date', 'theme_persian_date' );
add_filter( 'get_the_date', 'theme_persian_date' );
add_filter( 'get_the_time', 'theme_persian_date' );
add_filter( 'get_the_modified_date', 'theme_persian_date' );
add_filter( 'get_comment_date', 'theme_persian_date' );

/**
 * Persian number formatting
 *
 * @param string $number Number to format.
 * @return string Formatted number.
 */
function theme_persian_number( $number ) {
    if ( get_locale() !== 'fa_IR' ) {
        return $number;
    }
    
    $number = str_replace( array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' ), 
                           array( '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹' ), $number );
    
    return $number;
}
add_filter( 'the_content', 'theme_persian_content_numbers' );

/**
 * Persian content number formatting
 *
 * @param string $content Post content.
 * @return string Modified post content.
 */
function theme_persian_content_numbers( $content ) {
    if ( get_locale() !== 'fa_IR' ) {
        return $content;
    }
    
    // Don't convert numbers in code blocks
    $content = preg_replace_callback( '/<pre.*?>.*?<\/pre>/s', function( $matches ) {
        return $matches[0];
    }, $content );
    
    // Don't convert numbers in code tags
    $content = preg_replace_callback( '/<code.*?>.*?<\/code>/s', function( $matches ) {
        return $matches[0];
    }, $content );
    
    // Convert numbers in the rest of the content
    $content = preg_replace_callback( '/\d+/', function( $matches ) {
        return theme_persian_number( $matches[0] );
    }, $content );
    
    return $content;
}