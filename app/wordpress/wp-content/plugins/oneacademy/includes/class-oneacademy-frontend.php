<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class OneAcademyFrontend {

    /**
     * The single instance of the class.
     *
     * @var OneAcademyFrontend
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
        add_action('woocommerce_created_customer', array($this, 'woocommerce_created_customer'), 10, 3);
        add_action('woocommerce_order_item_meta_end', array($this, 'woocommerce_order_item_meta_end'), 10, 3);
        add_action('woocommerce_account_dashboard', array($this, 'woocommerce_account_dashboard'));

        add_filter('woocommerce_get_query_vars', array($this, 'add_woocommerce_query_vars'));
        add_filter('woocommerce_endpoint_mdl-courses_title', array($this, 'woocommerce_endpoint_title'), 10, 2);

        add_filter('woocommerce_account_menu_items', array($this, 'woocommerce_account_menu_items'), 10, 1);
        add_action('woocommerce_account_mdl-courses_endpoint', array($this, 'mdl_courses_endpoint_content'));

        add_action('woocommerce_mdl_course_add_to_cart', 'woocommerce_simple_add_to_cart', 30);

        add_filter('woocommerce_quantity_input_min', array($this, 'mdl_course_purchase_quantity'), 10, 2);
        add_filter('woocommerce_quantity_input_max', array($this, 'mdl_course_purchase_quantity'), 10, 2);
        if (class_exists('NextendSocialLogin')) {
            add_action('woocommerce_register_form_end', 'NextendSocialLogin::addLoginFormButtons', 200);
        }
        add_shortcode('moodle-dashboard', __CLASS__ . '::moodle_dashboard_shortcode');
        add_filter('woocommerce_loop_add_to_cart_link', array($this, 'woocommerce_loop_add_to_cart_link'), 100, 2);
    }
    
    public function woocommerce_loop_add_to_cart_link($link, $product) {
        $enrolled_courses = OneAcademyUtil::mdl_get_enrolled_course(get_current_user_id());
        $enrolled_courses_ids = wp_list_pluck($enrolled_courses, 'id');
        $_mdl_course_id = get_post_meta($product->get_id(), '_mdl_course_id', true);
        if (is_array($enrolled_courses_ids) && in_array($_mdl_course_id, $enrolled_courses_ids)) {
            $link = sprintf('<a target="__blank" class="button" href="%s">Go To Course</a>', OneAcademySSO::get_mdl_login_url(get_current_user_id(), oa()->mdl_site_url . '/course/view.php?id=' . $_mdl_course_id));
        }
        return $link;
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

    public static function moodle_dashboard_shortcode($atts) {
        return self::shortcode_wrapper(array('OneAcademyFrontend', 'moodle_dashboard_shortcode_output'), $atts);
    }

    public static function moodle_dashboard_shortcode_output() {
        if(oa()->is_connected){
            printf('<a class="button" href="%1$s" target="__blank">Go to Moodle</a>', OneAcademySSO::get_mdl_login_url(get_current_user_id()));
        } else{
            printf('<button type="button" disabled class="button">Go to Moodle</button>');
        }
    }

    public function mdl_course_purchase_quantity($qty, $product) {
        if ($product->get_type() == 'mdl_course') {
            $qty = 1;
        }
        return $qty;
    }

    public function woocommerce_created_customer($customer_id, $new_customer_data = array(), $password_generated = false) {
        $user_pass = !empty($new_customer_data['user_pass']) ? $new_customer_data['user_pass'] : '';
        $wp_user = new WP_User($customer_id);
        $args = array(
            'username' => $wp_user->user_login,
            'password' => $user_pass,
            'email' => $wp_user->user_email,
            'firstname' => isset($_POST['billing_first_name']) ? $_POST['billing_first_name'] : $wp_user->first_name,
            'lastname' => isset($_POST['billing_last_name']) ? $_POST['billing_last_name'] : $wp_user->last_name
        );

        $mdl_user_id = OneAcademyUtil::create_mdl_user($customer_id, $args);

        if ($mdl_user_id) {
            update_user_meta($customer_id, '_mdl_user_id', $mdl_user_id);
        }
    }

    public function woocommerce_order_item_meta_end($item_id, $item, $order) {
        $product = $item->get_product();
        $product_id = $product->get_id();
        $courseid = get_post_meta($product_id, '_mdl_course_id', true);
        $userid = get_user_meta($order->get_customer_id(), '_mdl_user_id', true);
        if ($courseid && $userid) {
            $mdl_course_link = oa()->mdl_site_url . '/course/view.php?id=' . $courseid;
            $mdl_course_link_with_login = OneAcademySSO::get_mdl_login_url($order->get_customer_id(), $mdl_course_link);
            echo sprintf('<p>Moodle Course: <a href="%s" target="__blank">%s</a></p>', $mdl_course_link_with_login, $product->get_title());
        }
    }

    public function woocommerce_account_dashboard() {
        if(oa()->is_connected){
            printf('<a class="button" href="%1$s" target="__blank">Go to Moodle</a>', OneAcademySSO::get_mdl_login_url(get_current_user_id()));
        } else{
            printf('<button type="button" disabled class="button">Go to Moodle</button>');
        }
    }

    public function add_woocommerce_query_vars($query_vars) {
        $query_vars['mdl-courses'] = 'mdl-courses';
        return $query_vars;
    }

    public function woocommerce_endpoint_title($title, $endpoint) {
        if ('mdl-courses' === $endpoint) {
            $title = __('My Courses', 'oneacademy');
        }
        return $title;
    }

    public function woocommerce_account_menu_items($items) {
        unset($items['customer-logout']);
        $items['mdl-courses'] = __('My Courses', 'woo-wallet');
        $items['customer-logout'] = __('Logout', 'woocommerce');
        return $items;
    }

    public function mdl_courses_endpoint_content() {
        $args = array(
            'posts_per_page' => -1,
            'meta_key' => '_customer_user',
            'meta_value' => get_current_user_id(),
            'post_type' => 'shop_order',
            'post_status' => array_keys(wc_get_order_statuses()),
            'suppress_filters' => true,
        );
        $orders = get_posts($args);
        $i = 1;
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Product</th>
                    <th>Course</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $index => $order) : ?>
                    <?php
                    $wc_order = wc_get_order($order->ID);
                    $line_items = $wc_order->get_items('line_item');
                    $products = array();
                    foreach ($line_items as $line_item) {
                        $product_id = $line_item['product_id'];
                        $product = wc_get_product($product_id);
                        if ($product->get_type() == 'mdl_course') {
                            $products[$product->get_id()] = array(
                                'id' => $product->get_id(),
                                'product_url' => '<a href="' . $product->get_permalink() . '">' . $product->get_title() . '</a>',
                                'permalink' => $product->get_permalink(),
                                'mdl_course_id' => get_post_meta($product->get_id(), '_mdl_course_id', true),
                                'mdl_course_url' => ''
                            );
                            $mdl_course_link = oa()->mdl_site_url . '/course/view.php?id=' . get_post_meta($product->get_id(), '_mdl_course_id', true);
                            $mdl_course_link = OneAcademySSO::get_mdl_login_url(get_current_user_id(), $mdl_course_link);
                            if(oa()->is_connected){
                                $products[$product->get_id()]['mdl_course_url'] = '<a title="Go To Course" class="button button-primary" href="' . $mdl_course_link . '">Go To Course</a>';
                            } else{
                                $products[$product->get_id()]['mdl_course_url'] = '<button type="button" title="Go To Course" class="button button-primary" disabled>Go To Course</a>';
                            }
                        }
                    }
                    if (count(wp_list_pluck($products, 'id')) > 0) :
                        ?>

                        <tr>
                            <td><?php echo $i;
                $i++;
                        ?></td>
                            <td><?php echo implode(', ', wp_list_pluck($products, 'product_url')); ?></td>
                            <td><?php echo implode(', ', wp_list_pluck($products, 'mdl_course_url')); ?></td>
                        </tr>
                    <?php endif; ?>
        <?php endforeach; ?>
            </tbody>
        </table>
        <?php
    }

}

OneAcademyFrontend::instance();
