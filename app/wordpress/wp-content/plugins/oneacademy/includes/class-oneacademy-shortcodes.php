<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class OneAcademyShortcodes {

    /**
     * The single instance of the class.
     *
     * @var OneAcademyShortcodes
     * @since 1.1.10
     */
    protected static $_instance = null;

    /**
     * Main instance
     * @return class object
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        add_shortcode('oneacademy-social-login', __CLASS__ . '::oneacademy_social_login_callback');
    }

    /**
     * Shortcode Wrapper.
     *
     * @param string[] $function Callback function.
     * @param array    $atts     Attributes. Default to empty array.
     *
     * @return string
     */
    public static function shortcode_wrapper($function, $atts = array()) {
        ob_start();
        call_user_func($function, $atts);
        return ob_get_clean();
    }

    public static function oneacademy_social_login_callback($atts) {
        if (class_exists('NextendSocialLogin') && !is_user_logged_in()) {
            return self::shortcode_wrapper('NextendSocialLogin::addLoginFormButtons', $atts);
        }
        if(is_user_logged_in()){
            echo 'You are already logged in.';
        }
        return;
    }

}

OneAcademyShortcodes::instance();
