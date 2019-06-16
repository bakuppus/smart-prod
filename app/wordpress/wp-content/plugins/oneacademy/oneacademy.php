<?php

/**
 * Plugin Name: OneAcademy
 * Plugin URI: http://eruditiontec.com
 * Description: An WooCommerce toolkit which sync with Moodle.
 * Version: 1.0.0
 * Author: EruditionTec
 * Author URI: http://eruditiontec.com
 * Text Domain: oneacademy
 * Domain Path: /languages/
 *
 * @package MooCommerce
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Define OA_PLUGIN_FILE.
if (!defined('OA_PLUGIN_FILE')) {
    define('OA_PLUGIN_FILE', __FILE__);
}

// Include the main OneAcademy class.
if (!class_exists('OneAcademy')) {
    include_once dirname(__FILE__) . '/includes/class-oneacademy-dependencies.php';
    include_once dirname(__FILE__) . '/includes/class-oneacademy.php';
}

/**
 * Main instance of MooCommerce.
 *
 * Returns the main instance of MC to prevent the need to use globals.
 *
 * @since  2.1
 * @return OneAcademy
 */
function oa() {
    return OneAcademy::instance();
}

// Global for backwards compatibility.
$GLOBALS['oneacademy'] = oa();

if (!function_exists('deactivate_oa')) {

    function deactivate_oa() {
        delete_option('_mdl_access_token');
        delete_option('_mdl_site_url');
    }

}

register_deactivation_hook(__FILE__, 'deactivate_oa');
