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


