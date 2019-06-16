<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class OneAcademyAdmin {

    /**
     * The single instance of the class.
     *
     * @var Woo_Wallet_Admin
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
        add_action('save_post_product', array($this, 'sync_with_moodle'), 100, 3);
        add_action('post_submitbox_misc_actions', array($this, 'post_submitbox_misc_actions'), 15);
        add_action('admin_init', array($this, 'admin_init'));
        add_action('delete_user', array($this, 'delete_mdl_user'));
        add_action('before_delete_post', array($this, 'delete_mdl_course'));

        add_filter('manage_users_columns', array($this, 'manage_users_columns'), 20);
        add_filter('manage_users_custom_column', array($this, 'manage_users_custom_column'), 10, 3);
        add_filter('product_type_selector', array($this, 'add_course_product'));

        add_action('admin_footer', array($this, 'simple_course_custom_js'));
        add_action('admin_menu', array($this, 'admin_menu_pages'), 5);
//        add_filter('woocommerce_product_data_tabs', array($this, 'woocommerce_product_data_tabs'));

//        add_action('show_user_profile', array($this, 'add_customer_meta_fields'));
//        add_action('edit_user_profile', array($this, 'add_customer_meta_fields'));

        add_action('personal_options_update', array($this, 'save_customer_meta_fields'));
        add_action('edit_user_profile_update', array($this, 'save_customer_meta_fields'));



        add_action('add_meta_boxes', array($this, 'remove_meta_boxes_for_course'), 100);

        add_filter('post_row_actions', array($this, 'dupe_link'), 50, 2);

        add_action('admin_enqueue_scripts', array($this, 'admin_scripts'), 10);

        add_action('wp_loaded', array($this, 'wp_admin_loaded'));
        
        add_action('admin_notices', array($this, 'connection_problem_notice'), 15);
    }
    
    public function connection_problem_notice(){
        if(!oa()->is_connected){
            echo '<div class="error"><p>';
            _e( 'This site is not connected with moodle', 'woo-wallet' );
            echo '</p></div>';
        }
    }

    public function wp_admin_loaded() {
        if (isset($_POST['oneacademy_duplicate_course']) && isset($_POST['product_id'])) {
            $course_name = isset($_POST['oneacademy_course_name']) ? $_POST['oneacademy_course_name'] : '';
            $course_price = isset($_POST['oneacademy_course_price']) ? $_POST['oneacademy_course_price'] : 0;
            $oneacademy_course_is_publish = isset($_POST['oneacademy_course_is_publish']) ? $_POST['oneacademy_course_is_publish'] : false;
            $product_id = $_POST['product_id'];
            $product = wc_get_product($product_id);
            if (false === $product) {
                /* translators: %s: product id */
                wp_die(sprintf(__('Product creation failed, could not find original product: %s', 'woocommerce'), $product_id));
            }
            $duplicate = $this->product_duplicate($product);
            $duplicate->set_name($course_name);
            $duplicate->set_regular_price($course_price);
            if ($oneacademy_course_is_publish) {
                $duplicate->set_status('publish');
            }
            $duplicate->save();
            // Redirect to the edit screen for the new draft page
            wp_redirect(admin_url('post.php?action=edit&post=' . $duplicate->get_id()));
            exit;
        }
    }

    /**
     * Function to create the duplicate of the product.
     *
     * @param WC_Product $product
     * @return WC_Product
     */
    public function product_duplicate($product) {
        // Filter to allow us to unset/remove data we don't want to copy to the duplicate. @since 2.6
        $meta_to_exclude = array_filter(apply_filters('woocommerce_duplicate_product_exclude_meta', array('_mdl_course_id')));

        $duplicate = clone $product;
        $duplicate->set_id(0);
        $duplicate->set_name(sprintf(__('%s (Copy)', 'woocommerce'), $duplicate->get_name()));
        $duplicate->set_total_sales(0);
        if ('' !== $product->get_sku('edit')) {
            $duplicate->set_sku(wc_product_generate_unique_sku(0, $product->get_sku('edit')));
        }
        $duplicate->set_status('draft');
        $duplicate->set_date_created(null);
        $duplicate->set_slug('');
        $duplicate->set_rating_counts(0);
        $duplicate->set_average_rating(0);
        $duplicate->set_review_count(0);

        foreach ($meta_to_exclude as $meta_key) {
            $duplicate->delete_meta_data($meta_key);
        }

        // This action can be used to modify the object further before it is created - it will be passed by reference. @since 3.0
        do_action('woocommerce_product_duplicate_before_save', $duplicate, $product);

        // Save parent product.
        $duplicate->save();

        // Duplicate children of a variable product.
        if (!apply_filters('woocommerce_duplicate_product_exclude_children', false, $product) && $product->is_type('variable')) {
            foreach ($product->get_children() as $child_id) {
                $child = wc_get_product($child_id);
                $child_duplicate = clone $child;
                $child_duplicate->set_parent_id($duplicate->get_id());
                $child_duplicate->set_id(0);
                $child_duplicate->set_date_created(null);

                if ('' !== $child->get_sku('edit')) {
                    $child_duplicate->set_sku(wc_product_generate_unique_sku(0, $child->get_sku('edit')));
                }

                foreach ($meta_to_exclude as $meta_key) {
                    $child_duplicate->delete_meta_data($meta_key);
                }

                // This action can be used to modify the object further before it is created - it will be passed by reference. @since 3.0
                do_action('woocommerce_product_duplicate_before_save', $child_duplicate, $child);

                $child_duplicate->save();
            }

            // Get new object to reflect new children.
            $duplicate = wc_get_product($duplicate->get_id());
        }

        return $duplicate;
    }

    public function admin_scripts() {
        $screen = get_current_screen();
        $screen_id = $screen ? $screen->id : '';
        if (in_array($screen_id, array('edit-product'))) {
            add_thickbox();
        }
    }

    public function dupe_link($actions, $post) {
        global $the_product;
        if (!current_user_can(apply_filters('woocommerce_duplicate_product_capability', 'manage_woocommerce'))) {
            return $actions;
        }

        if ('product' !== $post->post_type) {
            return $actions;
        }

        // Add Class to Delete Permanently link in row actions.
        if (empty($the_product) || $the_product->get_id() !== $post->ID) {
            $the_product = wc_get_product($post);
        }
        if ($the_product->get_type() == 'mdl_course') {

            $thikbox_url = add_query_arg(
                    array(
                'action' => 'get_oneacademy_product_duplicator_form',
                'security' => wp_create_nonce('oneacademy-product-duplicator'),
                'product_id' => $the_product->get_id(),
                'TB_iframe' => false,
                'width' => 500,
                'height' => 260,
                    ), admin_url('admin-ajax.php')
            );

            $actions['duplicate'] = '<a class="thickbox" title="' . __('Duplicate course', 'woocommerce') . '" href="' . $thikbox_url . '" rel="permalink">' . __('Duplicate', 'woocommerce') . '</a>';
        }

        return $actions;
    }

    public function admin_menu_pages() {
//        add_submenu_page('oneacademy', 'Oneacademy Courses', 'Oneacademy Courses', 'manage_woocommerce', 'edit.php?post_status=all&post_type=product&product_type=mdl_course');
//        add_submenu_page('oneacademy', 'Oneacademy Courses', 'Oneacademy Courses', 'manage_woocommerce', 'oneacademy-courses', array($this, 'oneacademy_courses'));
        add_submenu_page('oneacademy', 'Add Oneacademy Course', 'Add Oneacademy Course', 'manage_woocommerce', 'post-new.php?post_type=product&product-type=mdl_course');
    }

    public function remove_meta_boxes_for_course() {
        global $post;
        $product = wc_get_product($post->ID);
        if (isset($_GET['product-type']) && $_GET['product-type'] == 'mdl_course') {
            remove_meta_box('postimagediv', 'product', 'side');
            remove_meta_box('woocommerce-product-images', 'product', 'side');
        }
        if ($product && $product->get_type() == 'mdl_course') {
            remove_meta_box('postimagediv', 'product', 'side');
            remove_meta_box('woocommerce-product-images', 'product', 'side');
        }
    }

    public function add_course_product($types) {
        $types['mdl_course'] = __('Oneacademy Course');
        return $types;
    }

    public function simple_course_custom_js() {
        if ('product' != get_post_type()) :
            return;
        endif;
        ?>
        <script type='text/javascript'>
            jQuery(document).ready(function () {
                jQuery('.options_group.pricing').addClass('show_if_mdl_course').show();

        <?php if (isset($_GET['product-type']) && $_GET['product-type'] == 'mdl_course') : ?>
                    $('#product-type').val('mdl_course');
        <?php endif; ?>

                jQuery('#product-type').change();
                jQuery('#product_catchecklist .selectit input').on('click',function(){
                    $('#product_catchecklist .selectit input').not(this).prop('checked',false);
                });
            });
        </script>
        <?php
    }

    public function woocommerce_product_data_tabs($tabs) {
        $tabs['shipping']['class'][] = 'hide_if_mdl_course';
        return $tabs;
    }

    public function manage_users_columns($columns) {
        if (current_user_can('manage_woocommerce')) {
            $columns['mdl_account'] = __('Moodle Account', 'woo-wallet');
        }
        return $columns;
    }

    public function manage_users_custom_column($value, $column_name, $user_id) {
        if ($column_name === 'mdl_account') {
            if (!get_user_meta($user_id, '_mdl_user_id', true)) {
                $url = wp_nonce_url(get_edit_user_link($user_id), 'do_create_mdl_user', 'do_create_mdl_user');
                $value = '<a href="' . $url . '" class="button">' . __("Connect") . '</a>';
            } else {
                $url = wp_nonce_url(get_edit_user_link($user_id), 'do_create_mdl_user', 'do_create_mdl_user');
                $value = '<a href="' . $url . '" class="button">' . __('Re-connect') . '</a>';
            }
        }
        return $value;
    }

    public function sync_with_moodle($post_id, $post, $updated) {
        // Check to see if we are autosaving
        if ($post->post_status != 'publish') {
            return;
        }
        $product = wc_get_product($post_id);

        if ((isset($_POST['product-type']) && $_POST['product-type'] == 'mdl_course') || $product->get_type() == 'mdl_course') {
            if (is_null(oa()->mdl_site_url) || is_null(oa()->mdl_access_token)) {
                return;
            }
            if ($updated) {
                OneAcademyUtil::update_moodle_course($post_id);
            } else {
                OneAcademyUtil::create_moodle_course($post_id);
            }
        }
    }

    /**
     * Remove this
     * @param INT $post_id
     */
    private function update_moodle_course($post_id) {
        $moodle_course_id = get_post_meta($post_id, '_mdl_course_id', true);
        if (!$moodle_course_id) {
            $this->create_moodle_course($post_id);
        } else {
            $product = wc_get_product($post_id);
            if ($product) {
                $course = new stdClass();
                $course->id = $moodle_course_id;
                $course->fullname = $product->get_title('edit');
                $course->shortname = $product->get_title('edit');
                $course->categoryid = 1;
                $course->idnumber = $product->get_slug('edit');
                $course->summary = $product->get_description('edit');

                $product_cats = $product->get_category_ids('edit');
                foreach ($product_cats as $term_id) {
                    $mdl_course_cat_id = get_term_meta($term_id, '_mdl_course_category', true);
                    if ($mdl_course_cat_id) {
                        $course->categoryid = OneAcademyUtil::mdl_get_course_category($mdl_course_cat_id);
                    }
                }
                if (!$course->categoryid) {
                    $course->categoryid = 1;
                }

                $params = array('courses' => array($course));
                $serverurl = oa()->mdl_site_url . '/webservice/rest/server.php' . '?wstoken=' . oa()->mdl_access_token . '&wsfunction=core_course_update_courses&moodlewsrestformat=' . OA_REST_FORMAT;
                $response = oa()->curl->post($serverurl, $params);
                $response = json_decode($response, true);
            }
        }
    }

    /**
     * Remove this
     * @param INT $post_id
     */
    private function create_moodle_course($post_id) {
        $product = wc_get_product($post_id);
        if ($product) {
            $course = new stdClass();
            $course->fullname = $product->get_title('edit');
            $course->shortname = $product->get_title('edit');
            $course->categoryid = 1;
            $course->idnumber = $product->get_slug('edit');
            $course->summary = $product->get_description('edit');
            $params = array('courses' => array($course));
            $serverurl = oa()->mdl_site_url . '/webservice/rest/server.php' . '?wstoken=' . oa()->mdl_access_token . '&wsfunction=core_course_create_courses&moodlewsrestformat=' . OA_REST_FORMAT;
            $response = oa()->curl->post($serverurl, $params);
            $response = json_decode($response, true);
            if (isset($response[0]['id'])) {
                update_post_meta($post_id, '_mdl_course_id', $response[0]['id']);
            }
        }
    }

    public function post_submitbox_misc_actions() {
        global $post, $thepostid, $product_object;
        if ('product' !== $post->post_type || !get_post_meta($post->ID, '_mdl_course_id', true)) {
            return;
        }
        $thepostid = $post->ID;
        $product_object = $thepostid ? wc_get_product($thepostid) : new WC_Product();
        ?>
        <div id="moodle_course_url" class="moodle_course_url misc-pub-section">
            <?php if(oa()->is_connected) { ?>
            <a class="button button-primary" target="__blank" href="<?php echo OneAcademySSO::get_mdl_login_url(get_current_user_id(), oa()->mdl_site_url . '/course/edit.php?id=' . get_post_meta($post->ID, '_mdl_course_id', true)); ?>"><?php echo __('Edit Course'); ?></a>
            <?php } else { ?>
            <button type="button" disabled class="button button-primary"><?php echo __('Edit Course'); ?></button>
            <?php } ?>
        </div>
        <?php
    }

    public function admin_init() {
        if (isset($_GET['do_create_mdl_user']) && wp_verify_nonce($_GET['do_create_mdl_user'], 'do_create_mdl_user')) {
            if (isset($_GET['user_id'])) {
                $user_id = $_GET['user_id'];
            } else {
                $user_id = get_current_user_id();
            }
            $wp_user = new WP_User($user_id);
            $args = array(
                'username' => $wp_user->user_login,
                'password' => wp_generate_password(),
                'email' => $wp_user->user_email,
                'firstname' => $wp_user->first_name ? $wp_user->first_name : $wp_user->user_email,
                'lastname' => $wp_user->last_name
            );

            $mdl_user_id = OneAcademyUtil::create_mdl_user($user_id, $args);

            if ($mdl_user_id) {
                update_user_meta($user_id, '_mdl_user_id', $mdl_user_id);
            }
            wp_safe_redirect(admin_url('users.php'));
            exit();
        }
    }

    public function delete_mdl_user($user_id) {
        OneAcademyUtil::delete_mdl_user($user_id);
    }

    public function delete_mdl_course($id) {
        if (!current_user_can('delete_posts') || !$id) {
            return;
        }

        $post_type = get_post_type($id);
        if ('product' === $post_type) {
            $mdl_course_id = get_post_meta($id, '_mdl_course_id', true);
            if ($mdl_course_id) {
                OneAcademyUtil::delete_mdl_course($mdl_course_id);
            }
        }
    }

    public function add_customer_meta_fields($user) {
        if (!current_user_can('manage_woocommerce')) {
            return;
        }
        $all_mdl_course = OneAcademyUtil::mdl_get_all_course();
        $enrolled_courses = OneAcademyUtil::mdl_get_enrolled_course($user->ID);
        $enrolled_courses_ids = wp_list_pluck($enrolled_courses, 'id');
        ?>
        <h2>Enrolled Courses</h2>
        <table class="form-table">
            <?php if ($enrolled_courses) : ?>
                <tr>
                    <th></th>
                    <td>
                        <ol>
                            <?php foreach ($enrolled_courses as $course) : ?>
                                <li><?php echo $course['fullname']; ?></li>
                            <?php endforeach; ?>
                        </ol>
                    </td>
                </tr>
            <?php endif; ?>
            <tr>
                <th><label>Enroll a Course</label></th>
                <td>
                    <select name="mdl_user_manual_enroll[]" multiple="" style="width: 25em;">
                        <option value="">-- Select a Course --</option>
                        <?php foreach ($all_mdl_course as $course) : ?>
                            <?php if (is_array($enrolled_courses_ids) && !in_array($course['id'], $enrolled_courses_ids) && $course['id'] != 1): ?>
                                <option value="<?php echo $course['id']; ?>"><?php echo $course['fullname']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label>Unenroll a Course</label></th>
                <td>
                    <select name="mdl_user_manual_unenroll[]" multiple="" style="width: 25em;">
                        <option value="">-- Select a Course --</option>
                        <?php foreach ($enrolled_courses as $course) : ?>
                            <option value="<?php echo $course['id']; ?>"><?php echo $course['fullname']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
        </table>
        <?php
    }

    public function save_customer_meta_fields($user_id) {
        $userid = get_user_meta($user_id, '_mdl_user_id', true);
        $wp_user = new WP_User($userid);
        $args = array(
            'first_name' => isset($_POST['first_name']) && !empty($_POST['first_name']) ? $_POST['first_name'] : $wp_user->user_login,
            'last_name' => isset($_POST['last_name']) && !empty($_POST['last_name']) ? $_POST['last_name'] : 'lastname'
        );
        OneAcademyUtil::update_mdl_user($user_id, $args);
        if (isset($_POST['mdl_user_manual_enroll']) && !empty($_POST['mdl_user_manual_enroll'])) {
            $courseids = $_POST['mdl_user_manual_enroll'];
            foreach ($courseids as $courseid) {
                if (!empty($courseid)) {
                    OneAcademyUtil::enrol_manual_enrol_users($userid, $courseid);
                }
            }
        }
        if (isset($_POST['mdl_user_manual_unenroll']) && !empty($_POST['mdl_user_manual_unenroll'])) {
            $courseids = $_POST['mdl_user_manual_unenroll'];
            foreach ($courseids as $courseid) {
                if (!empty($courseid)) {
                    OneAcademyUtil::enrol_manual_unenrol_users($userid, $courseid);
                }
            }
        }
    }

}

OneAcademyAdmin::instance();
