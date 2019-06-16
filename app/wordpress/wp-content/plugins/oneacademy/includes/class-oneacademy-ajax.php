<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
if (!class_exists('OneAcademy_Ajax')) {

    class OneAcademy_Ajax {

        /**
         * The single instance of the class.
         *
         * @var OneAcademy_Ajax
         * @since 1.0.0
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

        /**
         * Class constructor
         */
        public function __construct() {
            add_action('wp_ajax_oneacademy_sync_course', array($this, 'oneacademy_sync_course'));
            add_action('wp_ajax_oneacademy_sync_user', array($this, 'oneacademy_sync_user'));
            add_action('wp_ajax_oneacademy_sync_enrol', array($this, 'oneacademy_sync_enrol'));
            add_action('wp_ajax_get_oneacademy_product_duplicator_form', array($this, 'get_oneacademy_product_duplicator_form'));
        }

        public function oneacademy_sync_enrol() {
            $sync_course_id = $_POST['sync_course_id'];
            $sync_user_ids = $_POST['sync_user_ids'];
            if ($sync_course_id && $sync_user_ids) {
                foreach ($sync_user_ids as $userid) {
                    OneAcademyUtil::enrol_manual_enrol_users($userid, $sync_course_id);
                }
            }
            wp_send_json(array('success' => true));
        }

        public function oneacademy_sync_course() {
            $sync_course_platform = $_POST['sync_course_platform'];
            $sync_course_category = $_POST['sync_course_category'];
            $sync_course_update = $_POST['sync_course_update'];
            $query = new WC_Product_Query(array(
                'limit' => -1,
                'type' => 'mdl_course',
                'return' => 'ids',
            ));
            $wp_products = $query->get_products();
            if ($sync_course_platform == 'wp_to_mdl') {
                if ($sync_course_category == 'true') {
                    $categories = get_terms('product_cat', 'orderby=term_order&hide_empty=0');
                    foreach ($categories as $categorie) {
                        oa()->create_mdl_course_category($categorie->term_id);
                    }
                }
                $query = new WC_Product_Query(array(
                    'limit' => -1,
                    'type' => 'mdl_course',
                    'return' => 'ids',
                ));
                $wp_products = $query->get_products();
                foreach ($wp_products as $product_id) {
                    if (!get_post_meta($product_id, '_mdl_course_id', true)) {
                        OneAcademyUtil::create_moodle_course($product_id);
                    } else if ($sync_course_update == 'true') {
                        OneAcademyUtil::update_moodle_course($product_id);
                    }
                }
            } else if ($sync_course_platform == 'mdl_to_wp') {
                if ($sync_course_category == 'true') {
                    OneAcademyUtil::sync_mdl_course_category();
                }

                $mdl_courses = OneAcademyUtil::get_all_moodle_courses();
                foreach ($mdl_courses as $mdl_course) {
                    $course_id = $mdl_course['id'];
                    if ($course_id == 1) {
                        continue;
                    }
                    $args = array(
                        'posts_per_page' => -1,
                        'meta_key' => '_mdl_course_id',
                        'meta_value' => $course_id,
                        'post_type' => 'product',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_type',
                                'field' => 'slug',
                                'terms' => array('mdl_course'),
                                'operator' => 'IN'
                            )
                        )
                    );
                    $posts_array = get_posts($args);
                    if (count($posts_array) == 0) {
                        OneAcademyUtil::create_wp_course($mdl_course);
                    } else if ($sync_course_update == 'true') {
                        OneAcademyUtil::update_wp_course($mdl_course, $posts_array[0]->ID);
                    }
                }
            }
            wp_send_json(array('success' => true));
        }

        public function oneacademy_sync_user() {
            $sync_user_platform = $_POST['sync_user_platform'];
            if ($sync_user_platform == 'wp_to_mdl') {
                $args = array(
                    'blog_id' => $GLOBALS['blog_id']
                );
                $users = get_users($args);
                if ($users) {
                    foreach ($users as $user) {
                        if (!get_user_meta($user->ID, '_mdl_user_id', true)) {
                            $wp_user = new WP_User($user->ID);
                            $user_args = array(
                                'username' => $wp_user->user_login,
                                'password' => wp_generate_password(),
                                'email' => $wp_user->user_email,
                                'firstname' => $wp_user->first_name,
                                'lastname' => $wp_user->last_name
                            );
                            OneAcademyUtil::create_mdl_user($user->ID, $user_args);
                        }
                    }
                }
            } else if ($sync_user_platform == 'mdl_to_wp') {
                $mdl_users = OneAcademyUtil::get_all_mdl_users();
                if ($mdl_users) {
                    foreach ($mdl_users as $mdl_user) {
                        $args = array(
                            'blog_id' => $GLOBALS['blog_id'],
                            'meta_key' => '_mdl_user_id',
                            'meta_value' => $mdl_user['id'],
                            'meta_compare' => '=',
                        );
                        $users = get_users($args);
                        if (!$users) {
                            $new_wp_user = wp_create_user($mdl_user['username'], wp_generate_password(), $mdl_user['email']);
                            if (!is_wp_error($new_wp_user)) {
                                update_user_meta($new_wp_user, '_mdl_user_id', $mdl_user['id']);
                                update_user_meta($new_wp_user, 'first_name', $mdl_user['firstname']);
                                update_user_meta($new_wp_user, 'last_name', $mdl_user['lastname']);
                                wp_update_user(array('ID' => $new_wp_user, 'role' => 'customer'));
                            } else {
                                $new_wp_user = $new_wp_user->get_error_data();
                                update_user_meta($new_wp_user, '_mdl_user_id', $mdl_user['id']);
                                update_user_meta($new_wp_user, 'first_name', $mdl_user['firstname']);
                                update_user_meta($new_wp_user, 'last_name', $mdl_user['lastname']);
                                wp_update_user(array('ID' => $new_wp_user, 'role' => 'customer'));
                            }
                        }
                    }
                }
            }
            wp_send_json(array('success' => true));
        }

        public function get_oneacademy_product_duplicator_form() {
            check_ajax_referer('oneacademy-product-duplicator', 'security');
            $product_id = $_REQUEST['product_id'];
            $product = wc_get_product($product_id);
            ob_start();
            ?>
            <form method="post" action="">
                <input type="hidden" name="product_id" value="<?php echo $product->get_id(); ?>" />
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="oneacademy_course_name">Course name</label></th>
                            <td><input name="oneacademy_course_name" required="" type="text" id="oneacademy_course_name" value="" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="oneacademy_course_price">Price</label></th>
                            <td><input name="oneacademy_course_price" required="" type="number" id="oneacademy_course_price" value="" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="oneacademy_course_is_publish">Publish</label></th>
                            <td><input name="oneacademy_course_is_publish" type="checkbox" id="oneacademy_course_is_publish" value="1" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="2"><input type="submit" name="oneacademy_duplicate_course" class="button button-primary" value="<?php _e('Duplicate', 'woocommerce') ?>" /></th>
                        </tr>
                    </tbody>
                </table>
            </form>
            <?php
            echo ob_get_clean();
            wp_die();
        }

    }

}
OneAcademy_Ajax::instance();
