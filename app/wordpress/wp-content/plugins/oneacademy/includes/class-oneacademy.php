<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

final class OneAcademy {

    /**
     * The single instance of the class.
     *
     * @var MooCommerce
     * @since 1.0.0
     */
    protected static $_instance = null;

    /**
     * Setting API instance
     * @var OneAcademy_Settings_API 
     */
    public $settings_api = null;

    /**
     * Curl helper class
     * @var OA_Curl 
     */
    public $curl = null;

    /**
     * Moodle site url
     * @var String 
     */
    public $mdl_site_url = null;

    /**
     * Moodle access token
     * @var string 
     */
    public $mdl_access_token = null;
    /**
     * Flag is connected with moodle.
     * @var bool 
     */
    public $is_connected = false;

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

    /**
     * Class constructor
     */
    public function __construct() {
        if (OA_Dependencies::is_woocommerce_active()) {
            $this->define_constants();
            $this->includes();
            $this->set_globals();
            $this->init_hooks();
            
            do_action('oa_loaded');
        } else {
            add_action('admin_notices', array($this, 'admin_notices'), 15);
        }
    }

    private function set_globals() {
        $this->mdl_site_url = $this->settings_api->get_option('mdl_site_url', 'connection_settings', null); //get_option('_mdl_site_url', null);
        $this->mdl_access_token = $this->settings_api->get_option('mdl_access_token', 'connection_settings', null); //get_option('_mdl_access_token', null);
        $this->is_connected = get_option('_is_connected_with_moodle');
    }

    /**
     * Constants define
     */
    private function define_constants() {
        $this->define('OA_ABSPATH', dirname(OA_PLUGIN_FILE) . '/');
        $this->define('OA_PLUGIN_FILE', plugin_basename(OA_PLUGIN_FILE));
        $this->define('OA_PLUGIN_VERSION', '1.0.0');
        $this->define('OA_REST_FORMAT', 'json');
        $this->define('OA_MOODLE_SERVICE_NAME', 'oneacademy');
    }

    /**
     * 
     * @param string $name
     * @param mixed $value
     */
    private function define($name, $value) {
        if (!defined($name)) {
            define($name, $value);
        }
    }

    /**
     * Check request
     * @param string $type
     * @return bool
     */
    private function is_request($type) {
        switch ($type) {
            case 'admin' :
                return is_admin();
            case 'ajax' :
                return defined('DOING_AJAX');
            case 'cron' :
                return defined('DOING_CRON');
            case 'frontend' :
                return (!is_admin() || defined('DOING_AJAX') ) && !defined('DOING_CRON');
        }
    }

    /**
     * load plugin files
     */
    public function includes() {
        include_once( OA_ABSPATH . 'includes/helper/curl.php' );
        include_once( OA_ABSPATH . 'includes/helper/admin-notice.php' );
        include_once( OA_ABSPATH . 'includes/class-oneacademy-settings-api.php' );
        include_once( OA_ABSPATH . 'includes/class-oneacademy-util.php' );
        include_once( OA_ABSPATH . 'includes/class-oneacademy-sso.php' );
        $this->settings_api = new OneAcademy_Settings_API();
        $this->curl = new OA_Curl();
        if ($this->is_request('admin')) {
            include_once( OA_ABSPATH . 'includes/class-oneacademy-admin.php' );
            include_once( OA_ABSPATH . 'includes/class-oneacademy-settings.php' );
            include_once( OA_ABSPATH . 'includes/class-oneacademy-network-admin.php' );
        }
        if ($this->is_request('frontend')) {
            include_once( OA_ABSPATH . 'includes/class-oneacademy-frontend.php' );
            include_once( OA_ABSPATH . 'includes/class-oneacademy-shortcodes.php' );
        }
        if($this->is_request('ajax')){
            include_once( OA_ABSPATH . 'includes/class-oneacademy-ajax.php' );
        }
    }

    /**
     * Plugin url
     * @return string path
     */
    public function plugin_url() {
        return untrailingslashit(plugins_url('/', OA_PLUGIN_FILE));
    }

    /**
     * Plugin init
     */
    private function init_hooks() {
        add_action('init', array($this, 'init'));
    }

    /**
     * Plugin init
     */
    public function init() {
        $this->load_plugin_textdomain();
        $this->register_course_product_type();
        foreach (apply_filters('oneacademy_enroll_student_order_status', array('processing', 'completed')) as $status) {
            add_action('woocommerce_order_status_' . $status, array($this, 'oneacademy_enroll_student'));
        }
        add_action('created_product_cat', array($this, 'create_mdl_course_category'), 10);
        add_action('pre_delete_term', array($this, 'delete_mdl_course_category'), 10, 2);
        add_filter('woocommerce_product_class', array($this, 'woocommerce_product_class'), 10, 2);
        add_action( 'user_register', array( $this, 'connect_with_moodle' ) );
        add_filter( 'woocommerce_locate_template', array($this, 'oa_woocommerce_locate_template'), 10, 3 );
    }

    public function oa_woocommerce_locate_template( $template, $template_name, $template_path ) {
      global $woocommerce;

      $_template = $template;

      if ( ! $template_path ) $template_path = $woocommerce->template_url;

      $plugin_path  = untrailingslashit( plugin_dir_path( OA_PLUGIN_FILE ) ) . '/woocommerce/';

      // Look within passed path within the theme - this is priority
      $template = locate_template(

        array(
          $template_path . $template_name,
          $template_name
        )
      );

      // Modification: Get the template from this plugin, if it exists
      if ( ! $template && file_exists( $plugin_path . $template_name ) )
        $template = $plugin_path . $template_name;

      // Use default template
      if ( ! $template )
        $template = $_template;

      // Return what we found
      return $template;
    }
    
    public function connect_with_moodle($user_id){
        $wp_user = new WP_User($user_id);
        $args = array(
            'username' => $wp_user->user_login,
            'password' => $wp_user->user_pass,
            'email' => $wp_user->user_email,
            'firstname' => $wp_user->first_name,
            'lastname' => $wp_user->last_name
        );

        $mdl_user_id = OneAcademyUtil::create_mdl_user($user_id, $args);

        if ($mdl_user_id) {
            update_user_meta($user_id, '_mdl_user_id', $mdl_user_id);
        }
    }

    public function register_course_product_type() {
        include_once( OA_ABSPATH . 'includes/class-wc-product-oneacademy-cource.php' );
    }

    public function woocommerce_product_class($classname, $product_type) {
        if ($product_type == 'mdl_course') {
            $classname = 'WC_Product_Mdl_Course';
        }
        return $classname;
    }

    public function create_mdl_course_category($term_id) {
        $term = get_term($term_id);
        $mdl_term = new stdClass();
        $mdl_term->name = $term->name;
        $mdl_term->idnumber = $term->slug;
        $mdl_term->description = $term->description;
        $mdl_term->descriptionformat = 1;
        $mdl_term->parent = 0;
        if ($term->parent) {
            $mdl_course_category_id = get_term_meta($term->parent, '_mdl_course_category', true);
            if ($mdl_course_category_id) {
                $mdl_term->parent = OneAcademyUtil::mdl_get_course_category($mdl_course_category_id);
            }
        }

        OneAcademyUtil::mdl_create_course_category($term_id, $mdl_term);
    }

    public function delete_mdl_course_category($term_id, $taxonomy) {
        if ($taxonomy != 'product_cat') {
            return;
        }
        $mdl_course_cat_id = get_term_meta($term_id, '_mdl_course_category', true);
        if ($mdl_course_cat_id) {
            $mdl_course_cat_id = OneAcademyUtil::mdl_get_course_category($mdl_course_cat_id);
            if ($mdl_course_cat_id) {
                OneAcademyUtil::mdl_delete_course_category($mdl_course_cat_id);
            }
        }
    }

    public function oneacademy_enroll_student($order_id) {
        if (get_post_meta($order_id, '_mdl_order_enrolment_synced', true)) {
            return;
        }
        $order = wc_get_order($order_id);
        $line_items = $order->get_items();
        foreach ($line_items as $item_id => $item) {
            $product = $item->get_product();
            $product_id = $product->get_id();
            $courseid = get_post_meta($product_id, '_mdl_course_id', true);
            $userid = get_user_meta($order->get_customer_id(), '_mdl_user_id', true);
            if ($courseid && $userid) {
                $this->enrol_manual_enrol_users($userid, $courseid);
            }
        }
        update_post_meta($order_id, '_mdl_order_enrolment_synced', true);
    }

    private function enrol_manual_enrol_users($userid, $courseid) {
        if (is_null(oa()->mdl_site_url) || is_null(oa()->mdl_access_token)) {
            return;
        }
        $serverurl = oa()->mdl_site_url . '/webservice/rest/server.php' . '?wstoken=' . oa()->mdl_access_token . '&wsfunction=enrol_manual_enrol_users&moodlewsrestformat=' . OA_REST_FORMAT;
        $enrol_user = new stdClass();
        $enrol_user->roleid = 5;
        $enrol_user->userid = $userid;
        $enrol_user->courseid = $courseid;
        $params = array('enrolments' => array($enrol_user));
        oa()->curl->post($serverurl, $params);
    }

    /**
     * Text Domain loader
     */
    public function load_plugin_textdomain() {
        $locale = is_admin() && function_exists('get_user_locale') ? get_user_locale() : get_locale();
        $locale = apply_filters('plugin_locale', $locale, 'oneacademy');

        unload_textdomain('moocommerce');
        load_textdomain('moocommerce', WP_LANG_DIR . '/oneacademy/oneacademy-' . $locale . '.mo');
        load_plugin_textdomain('oneacademy', false, plugin_basename(dirname(OA_PLUGIN_FILE)) . '/languages');
    }

    /**
     * Load template
     * @param string $template_name
     * @param array $args
     * @param string $template_path
     * @param string $default_path
     */
    public function get_template($template_name, $args = array(), $template_path = '', $default_path = '') {
        if ($args && is_array($args)) {
            extract($args);
        }
        $located = $this->locate_template($template_name, $template_path, $default_path);
        include ($located);
    }

    /**
     * Locate template file
     * @param string $template_name
     * @param string $template_path
     * @param string $default_path
     * @return string
     */
    public function locate_template($template_name, $template_path = '', $default_path = '') {
        $default_path = apply_filters('oa_template_path', $default_path);
        if (!$template_path) {
            $template_path = 'oneacademy';
        }
        if (!$default_path) {
            $default_path = OA_ABSPATH . 'templates/';
        }
        // Look within passed path within the theme - this is priority
        $template = locate_template(array(trailingslashit($template_path) . $template_name, $template_name));
        // Add support of third perty plugin
        $template = apply_filters('oa_locate_template', $template, $template_name, $template_path, $default_path);
        // Get default template
        if (!$template) {
            $template = $default_path . $template_name;
        }
        return $template;
    }

    /**
     * Display admin notice
     */
    public function admin_notices() {
        echo '<div class="error"><p>';
        _e('OneAcademy plugin requires <a href="https://wordpress.org/plugins/woocommerce/">WooCommerce</a> plugins to be active!', 'oneacademy');
        echo '</p></div>';
    }

}
