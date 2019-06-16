<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class OneAcademyUtil {

    public static function get_mdl_user_by_field($user_id, $field = 'email') {
        $wp_user = new WP_User($user_id);
        if (is_null(oa()->mdl_site_url) || is_null(oa()->mdl_access_token) || !$wp_user || !oa()->is_connected) {
            return array();
        }
        $serverurl = oa()->mdl_site_url . '/webservice/rest/server.php' . '?wstoken=' . oa()->mdl_access_token . '&wsfunction=core_user_get_users_by_field&moodlewsrestformat=' . OA_REST_FORMAT;
        $params = array('field' => $field, 'values' => array($wp_user->user_email));
        $response = oa()->curl->post($serverurl, $params);
        $response = json_decode($response, true);
        if ($response && isset($response[0])) {
            return $response[0];
        } else {
            self::log(print_r($response, true));
        }
    }

    public static function get_all_mdl_users() {
        if (is_null(oa()->mdl_site_url) || is_null(oa()->mdl_access_token) || !oa()->is_connected) {
            return false;
        }
        $params = array('criteria' => array(array('key' => 'auth', 'value' => 'manual')));
        $serverurl = oa()->mdl_site_url . '/webservice/rest/server.php' . '?wstoken=' . oa()->mdl_access_token . '&wsfunction=core_user_get_users&moodlewsrestformat=' . OA_REST_FORMAT;
        $response = oa()->curl->post($serverurl, $params);
        $response = json_decode($response, true);
        return $response['users'];
    }

    public static function create_mdl_user($wp_user_id, $args = array()) {
        if (is_null(oa()->mdl_site_url) || is_null(oa()->mdl_access_token) || !oa()->is_connected) {
            return false;
        }
        $exist_user = self::get_mdl_user_by_field($wp_user_id);
        if (!empty($exist_user)) {
            self::update_mdl_user($wp_user_id);
            update_user_meta($wp_user_id, '_mdl_user_id', $exist_user['id']);
            return $exist_user['id'];
        }
        $moodle_user = new stdClass();
        $moodle_user->username = $args['username'];
        $moodle_user->password = $args['password'];
        $moodle_user->email = $args['email'];
        $moodle_user->firstname = !empty($args['firstname']) ? $args['firstname'] : $args['username'];
        $moodle_user->lastname = !empty($args['lastname']) ? $args['lastname'] : 'lastname';
        $params = array('users' => array($moodle_user));
        $serverurl = oa()->mdl_site_url . '/webservice/rest/server.php' . '?wstoken=' . oa()->mdl_access_token . '&wsfunction=core_user_create_users&moodlewsrestformat=' . OA_REST_FORMAT;
        $response = oa()->curl->post($serverurl, $params);
        $response = json_decode($response, true);
        if (isset($response[0]['id'])) {
            update_user_meta($wp_user_id, '_mdl_user_id', $response[0]['id']);
            return $response[0]['id'];
        } else {
            self::log(print_r($response, true));
        }
        return false;
    }

    public static function update_mdl_user($wp_user_id, $args=array()) {
        if (is_null(oa()->mdl_site_url) || is_null(oa()->mdl_access_token) || !oa()->is_connected) {
            return;
        }
        $exist_user = self::get_mdl_user_by_field($wp_user_id);
        if (!empty($exist_user)) {
            $wp_user = new WP_User($wp_user_id);
            $moodle_user = new stdClass();
            $moodle_user->id = $exist_user['id'];
            if(!empty($args)){
                $moodle_user->firstname = $args['first_name'];
                $moodle_user->lastname = $args['last_name'];
            } else{
                $moodle_user->firstname = $wp_user->first_name ? $wp_user->first_name : $wp_user->user_email;
                $moodle_user->lastname = $wp_user->last_name ? $wp_user->last_name : 'lastname';
            }
            $params = array('users' => array($moodle_user));
            $serverurl = oa()->mdl_site_url . '/webservice/rest/server.php' . '?wstoken=' . oa()->mdl_access_token . '&wsfunction=core_user_update_users&moodlewsrestformat=' . OA_REST_FORMAT;
            oa()->curl->post($serverurl, $params);
            update_user_meta($wp_user_id, '_mdl_user_id', $exist_user['id']);
        }
    }

    public static function delete_mdl_user($wp_user_id) {
        if (is_null(oa()->mdl_site_url) || is_null(oa()->mdl_access_token) || !oa()->is_connected) {
            return false;
        }
        $exist_user = self::get_mdl_user_by_field($wp_user_id);
        if (empty($exist_user)) {
            return false;
        }
        $serverurl = oa()->mdl_site_url . '/webservice/rest/server.php' . '?wstoken=' . oa()->mdl_access_token . '&wsfunction=core_user_delete_users&moodlewsrestformat=' . OA_REST_FORMAT;
        $params = array('userids' => array($exist_user['id']));
        $response = oa()->curl->post($serverurl, $params);
        return json_decode($response, true);
    }

    public static function delete_mdl_course($course_id) {
        if (is_null(oa()->mdl_site_url) || is_null(oa()->mdl_access_token) || !oa()->is_connected) {
            return false;
        }
        $serverurl = oa()->mdl_site_url . '/webservice/rest/server.php' . '?wstoken=' . oa()->mdl_access_token . '&wsfunction=core_course_delete_courses&moodlewsrestformat=' . OA_REST_FORMAT;
        $params = array('courseids' => array($course_id));
        oa()->curl->post($serverurl, $params);
    }

    public static function mdl_get_course_category($id) {
        if (is_null(oa()->mdl_site_url) || is_null(oa()->mdl_access_token) || !oa()->is_connected) {
            return 0;
        }
        $serverurl = oa()->mdl_site_url . '/webservice/rest/server.php' . '?wstoken=' . oa()->mdl_access_token . '&wsfunction=core_course_get_categories&moodlewsrestformat=' . OA_REST_FORMAT;
        $args = new stdClass();
        $args->key = 'id';
        $args->value = $id;
        $params = array('criteria' => array($args));
        $response = oa()->curl->post($serverurl, $params);
        $response = json_decode($response, true);
        if (isset($response[0]['id'])) {
            return $response[0]['id'];
        } else {
            self::log(print_r($response, true));
        }
        return 0;
    }

    public static function mdl_create_course_category($term_id, $args) {
        if (is_null(oa()->mdl_site_url) || is_null(oa()->mdl_access_token) || !oa()->is_connected) {
            return false;
        }
        $serverurl = oa()->mdl_site_url . '/webservice/rest/server.php' . '?wstoken=' . oa()->mdl_access_token . '&wsfunction=core_course_create_categories&moodlewsrestformat=' . OA_REST_FORMAT;
        $params = array('categories' => array($args));
        $response = oa()->curl->post($serverurl, $params);
        $response = json_decode($response, true);
        if (isset($response[0]['id'])) {
            update_term_meta($term_id, '_mdl_course_category', $response[0]['id']);
            return $response[0]['id'];
        } else {
            self::log(print_r($response, true));
        }
        return false;
    }

    public static function mdl_delete_course_category($id, $newparent = 1) {
        if (is_null(oa()->mdl_site_url) || is_null(oa()->mdl_access_token) || !oa()->is_connected) {
            return false;
        }
        $serverurl = oa()->mdl_site_url . '/webservice/rest/server.php' . '?wstoken=' . oa()->mdl_access_token . '&wsfunction=core_course_delete_categories&moodlewsrestformat=' . OA_REST_FORMAT;
        $args = new stdClass();
        $args->id = $id;
        $args->newparent = $newparent;
        $args->recursive = 0;
        $params = array('categories' => array($args));
        oa()->curl->post($serverurl, $params);
        return true;
    }

    public static function update_moodle_course($post_id) {
        $moodle_course_id = get_post_meta($post_id, '_mdl_course_id', true);
        if (!$moodle_course_id) {
            self::create_moodle_course($post_id);
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

    public static function create_moodle_course($post_id) {
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
            } else {
                self::log(print_r($response, true));
            }
        }
    }

    public static function get_all_moodle_courses() {
        if (is_null(oa()->mdl_site_url) || is_null(oa()->mdl_access_token) || !oa()->is_connected) {
            return array();
        }
        $serverurl = oa()->mdl_site_url . '/webservice/rest/server.php' . '?wstoken=' . oa()->mdl_access_token . '&wsfunction=core_course_get_courses&moodlewsrestformat=' . OA_REST_FORMAT;
        $response = oa()->curl->post($serverurl);
        return json_decode($response, true);
    }

    public static function create_wp_course($mdl_args) {
        $product = new WC_Product();
        $product->set_sku($mdl_args['shortname']);
        $product->set_name($mdl_args['fullname']);
        $product->set_description($mdl_args['summary']);
        $product->set_category_ids(array(self::get_wp_term_id_my_mdl_category_id($mdl_args['categoryid'])));
        $product_id = $product->save();
        wp_set_object_terms($product_id, 'mdl_course', 'product_type');
        update_post_meta($product_id, '_mdl_course_id', $mdl_args['id']);
    }

    public static function update_wp_course($mdl_args, $product_id) {
        $product = wc_get_product($product_id);
        if ($product) {
            $product->set_sku($mdl_args['shortname']);
            $product->set_name($mdl_args['fullname']);
            $product->set_description($mdl_args['summary']);
            $product->set_category_ids(array(self::get_wp_term_id_my_mdl_category_id($mdl_args['categoryid'])));
            $product->save();
        } else {
            self::create_wp_course($mdl_args);
        }
    }

    public static function sync_mdl_course_category() {
        if (is_null(oa()->mdl_site_url) || is_null(oa()->mdl_access_token) || !oa()->is_connected) {
            return false;
        }

        $serverurl = oa()->mdl_site_url . '/webservice/rest/server.php' . '?wstoken=' . oa()->mdl_access_token . '&wsfunction=core_course_get_categories&moodlewsrestformat=' . OA_REST_FORMAT;
        $response = oa()->curl->post($serverurl);
        $categories = json_decode($response, true);
        if ($categories) {
            foreach ($categories as $categorie) {
//                if ($categorie['id'] == 1) {
//                    continue;
//                }
                $term_id = self::get_wp_term_id_my_mdl_category_id($categorie['id']);
                if ($term_id == null) {
                    $term = wp_insert_term($categorie['name'], 'product_cat');
                    if (!is_wp_error($term)) {
                        update_term_meta($term->get_error_data(), '_mdl_course_category', $categorie['id']);
                    } else {
                        wp_update_term($term->get_error_data(), 'product_cat', array('name' => $categorie['name'], 'parent' => self::get_wp_term_id_my_mdl_category_id($categorie['parent'])));
                        update_term_meta($term->get_error_data(), '_mdl_course_category', $categorie['id']);
                    }
                } else {
                    wp_update_term($term_id, 'product_cat', array('name' => $categorie['name'], 'parent' => self::get_wp_term_id_my_mdl_category_id($categorie['parent'])));
                    update_term_meta($term_id, '_mdl_course_category', $categorie['id']);
                }
            }
        }
    }

    public static function get_wp_term_id_my_mdl_category_id($category_id) {
        global $wpdb;
        $term_id = $wpdb->get_var("SELECT MAX(wp_terms.term_id) FROM {$wpdb->prefix}terms AS wp_terms INNER JOIN {$wpdb->prefix}termmeta AS wp_termmeta on wp_terms.term_id = wp_termmeta.term_id WHERE wp_termmeta.meta_key = '_mdl_course_category' AND wp_termmeta.meta_value = {$category_id}");
        return $term_id;
    }

    public static function mdl_get_all_course() {
        if (is_null(oa()->mdl_site_url) || is_null(oa()->mdl_access_token) || !oa()->is_connected) {
            return false;
        }
        $serverurl = oa()->mdl_site_url . '/webservice/rest/server.php' . '?wstoken=' . oa()->mdl_access_token . '&wsfunction=core_course_get_courses&moodlewsrestformat=' . OA_REST_FORMAT;
        $response = oa()->curl->post($serverurl);
        return json_decode($response, true);
    }

    public static function mdl_get_enrolled_course($user_id) {
        if (is_null(oa()->mdl_site_url) || is_null(oa()->mdl_access_token) || !get_user_meta($user_id, '_mdl_user_id', true) || !oa()->is_connected) {
            return false;
        }
        $serverurl = oa()->mdl_site_url . '/webservice/rest/server.php' . '?wstoken=' . oa()->mdl_access_token . '&wsfunction=core_enrol_get_users_courses&moodlewsrestformat=' . OA_REST_FORMAT;
        $params = array('userid' => get_user_meta($user_id, '_mdl_user_id', true));
        $response = oa()->curl->post($serverurl, $params);
        return json_decode($response, true);
    }

    public static function enrol_manual_enrol_users($userid, $courseid) {
        if (is_null(oa()->mdl_site_url) || is_null(oa()->mdl_access_token) || !oa()->is_connected) {
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

    public static function enrol_manual_unenrol_users($userid, $courseid) {
        if (is_null(oa()->mdl_site_url) || is_null(oa()->mdl_access_token) || !oa()->is_connected) {
            return;
        }
        $serverurl = oa()->mdl_site_url . '/webservice/rest/server.php' . '?wstoken=' . oa()->mdl_access_token . '&wsfunction=enrol_manual_unenrol_users&moodlewsrestformat=' . OA_REST_FORMAT;
        $enrol_user = new stdClass();
        $enrol_user->roleid = 5;
        $enrol_user->userid = $userid;
        $enrol_user->courseid = $courseid;
        $params = array('enrolments' => array($enrol_user));
        oa()->curl->post($serverurl, $params);
    }

    public static function log($message, $level = 'debug') {
        $logger = wc_get_logger();
        $context = array('source' => 'oneacademy');
        return $logger->log($level, $message, $context);
    }

}
