<?php

/**
 * Plugin Name: One API
 * Plugin URI: http://1acad.me
 * Description: One API plugin
 * Version: 0.1
 * Author: Smartella
 * Author URI: http://smartella.co.uk
 * Text Domain: oneapi
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Include the main oneCreate class.
if (!class_exists('OneApi')) {    
    include_once dirname(__FILE__) . '/oneapi-plugin.php';
}

/**
 * Main instance of OneCreate.
 *
 * Returns the main instance of WC to prevent the need to use globals.
 *
 * @since  2.1
 * @return OneApi
 */
function oapi() {
	return OneApi::instance();
}

// Global for backwards compatibility.
$GLOBALS['oneapi'] = oapi();

// activation
register_activation_hook(__FILE__,array(oapi(),'activate'));

// deactivation
register_deactivation_hook(__FILE__,array(oapi(),'deactivate'));

// uninstall