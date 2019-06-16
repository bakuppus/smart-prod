<?php

/**
 * Plugin Name: One Create
 * Plugin URI: http://1acad.me
 * Description: Academy Create Automation plugin
 * Version: 0.1
 * Author: Smartella
 * Author URI: http://smartella.co.uk
 * Text Domain: onecreate
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Include the main oneCreate class.
if (!class_exists('OneCreate')) {    
    include_once dirname(__FILE__) . '/onecreate-plugin.php';
}

/**
 * Main instance of OneCreate.
 *
 * Returns the main instance of WC to prevent the need to use globals.
 *
 * @since  2.1
 * @return OneCreate
 */
function oc() {
	return OneCreate::instance();
}

// Global for backwards compatibility.
$GLOBALS['onecreate'] = oc();

// activation
register_activation_hook(__FILE__,array(oc(),'activate'));

// deactivation
register_deactivation_hook(__FILE__,array(oc(),'deactivate'));

// uninstall