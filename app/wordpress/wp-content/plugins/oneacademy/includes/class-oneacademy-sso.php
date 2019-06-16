<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class OneAcademySSO {

    /**
     * WS Function name
     * @var string 
     */
    protected static $functionname = 'auth_userkey_request_login_url';

    public function __construct() {
        add_action('init', array($this, 'start_session'));
        add_action('template_redirect', array($this, 'wp_login_logout'));
        add_action('clear_auth_cookie', array($this, 'set_mdl_sso_session'));
        add_action('wp_login', array($this, 'mdl_user_login'), 10, 2);
        add_action('wp_logout', array($this, 'mdl_user_logout'), 15);
    }

    /**
     * Start session if not started.
     */
    public function start_session() {
        if (!session_id()) {
            session_start();
        }
    }

    public function wp_login_logout() {

        if (isset($_GET['oneacademyssoaction']) && isset($_GET['mdl_user_id'])) {
            $oneacademyssoaction = $_GET['oneacademyssoaction'];
            $mdl_user_id = $_GET['mdl_user_id'];
            $redirect_to = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : oa()->mdl_site_url;
            if (is_null(oa()->mdl_site_url) || is_null(oa()->mdl_access_token)) {
                wp_redirect($redirect_to);
            }
            if ('logout' === $oneacademyssoaction) {
                add_action(
                        'wp_logout', create_function(
                                '', 'wp_redirect("' . $redirect_to . '");exit();'
                        )
                );
                if (is_user_logged_in()) {
                    $wp_mdl_uid = get_user_meta(get_current_user_id(), '_mdl_user_id', true);
                    if ($wp_mdl_uid && $wp_mdl_uid == $mdl_user_id) {
                        wp_logout();
                    }
                }
            } else if ('login' === $oneacademyssoaction) {
                self::wp_login_user($mdl_user_id);
            }
            wp_redirect($redirect_to);
            exit();
        }
    }

    /**
     * Login user to wp by moodle user id
     * @param INT $mdl_user_id Moodle user ID.
     */
    public static function wp_login_user($mdl_user_id) {
        if (is_user_logged_in()) {
            return;
        }

        $wp_user_query = new WP_User_Query(array('meta_key' => '_mdl_user_id', 'meta_value' => $mdl_user_id, 'meta_compare' => '='));
        $results = $wp_user_query->get_results();
        if (!empty($results)) {
            foreach ($results as $user) {
                wp_clear_auth_cookie();
                wp_set_current_user($user->ID);
                wp_set_auth_cookie($user->ID);
            }
        }
    }

    /**
     * Set WP user ID to session.
     */
    public function set_mdl_sso_session() {
        $_SESSION['_wp_user_id'] = get_current_user_id();
    }

    /**
     * Get Moodle login URL
     */
    public static function get_mdl_login_url($user_id, $redirect_url = '') {
  
        $login_url = '';
        $wp_user = new WP_User($user_id);
        $mdl_user_id = get_user_meta($wp_user->ID, '_mdl_user_id', true);
        if (is_null(oa()->mdl_site_url) || is_null(oa()->mdl_access_token) || !$wp_user || !$mdl_user_id) {        
            return $login_url;
        }

        $serverurl = oa()->mdl_site_url . '/webservice/rest/server.php' . '?wstoken=' . oa()->mdl_access_token . '&wsfunction=' . self::$functionname . '&moodlewsrestformat=' . OA_REST_FORMAT;
        // var_dump("</br><b>Curl: serverurl</b> => ");
        // var_dump($serverurl,'<pre>---');    
        $auth_user = new stdClass();
        $auth_user->id = $mdl_user_id;
        $auth_user->email = $wp_user->user_email;
        $auth_user->username = strtolower($wp_user->user_login);
        $auth_user->firstname = $wp_user->first_name ? $wp_user->first_name : $wp_user->user_login;
        $auth_user->lastname = $wp_user->last_name ? $wp_user->last_name : $wp_user->user_login;
        $params = array('user' => $auth_user);

        // var_dump("</br><b>Curl: params</b> => ");
        // var_dump($params,'<pre>---');    
        $response = oa()->curl->post($serverurl, $params);
        $response = json_decode($response, true);

        // var_dump("</br><b>Curl: response</b> => ");
        // var_dump($response,'<pre>---');    
     
        if (isset($response['loginurl'])) {
            $login_url = $response['loginurl'];
            $login_url .= '&action=login';
            if (!empty($redirect_url)) {
                $login_url = $login_url . '&wantsurl=' . $redirect_url;
            }
        }
       
        return $login_url;
    }

    /**
     * Get Moodle logout URl
     * @param int $user_id
     * @param URL $redirect_url
     * @return string
     */
    public static function get_mdl_logout_url($user_id, $redirect_url = '') {
        $logout_url = '';
        $wp_user = new WP_User($user_id);
        $mdl_user_id = get_user_meta($wp_user->ID, '_mdl_user_id', true);
        if (is_null(oa()->mdl_site_url) || is_null(oa()->mdl_access_token) || !$wp_user || !$mdl_user_id) {
            return $logout_url;
        }
        $serverurl = oa()->mdl_site_url . '/webservice/rest/server.php' . '?wstoken=' . oa()->mdl_access_token . '&wsfunction=' . self::$functionname . '&moodlewsrestformat=' . OA_REST_FORMAT;
        $auth_user = new stdClass();
        $auth_user->id = $mdl_user_id;
        $params = array('user' => $auth_user);
        $response = oa()->curl->post($serverurl, $params);
        $response = json_decode($response, true);
        if (isset($response['loginurl'])) {
            $logout_url = $response['loginurl'];
            $logout_url .= '&action=logout';
            if (!empty($redirect_url)) {
                $logout_url = $logout_url . '&wantsurl=' . $redirect_url;
            }
        }
        return $logout_url;
    }

    /**
     * WP login hook
     * @param string $username
     * @param WP_User object $user
     */
    public function mdl_user_login($username, $user) {
        $mdl_login_url = self::get_mdl_login_url($user->ID, self::get_login_redirect_url($user->ID));
        if ($mdl_login_url) {
            wp_redirect($mdl_login_url);
            exit();
        }
    }

    /**
     * WP logout hook
     * @return NULL
     */
    public function mdl_user_logout() {
        if (isset($_SESSION['_wp_user_id']) && '' != $_SESSION['_wp_user_id']) {
            $user_id = $_SESSION['_wp_user_id'];
            unset($_SESSION['_wp_user_id']);
        } else {
            return;
        }
        $mdl_logout_url = self::get_mdl_logout_url($user_id, self::get_logout_redirect_url($user_id));
        if ($mdl_logout_url) {
            wp_redirect($mdl_logout_url);
            exit();
        }
    }

    /**
     * Moodle login redirect URL
     * @param INT $user_id
     * @return URL
     */
    public static function get_login_redirect_url($user_id) {
        $user = new WP_User($user_id);
        $url = oa()->settings_api->get_option('redirect_url', 'redirection', get_site_url());
        if ('on' === oa()->settings_api->get_option('user_role_based_redirect', 'redirection', 'off')) {
            $user_roles = $user->roles;
            foreach ($user_roles as $role) {
                $url = oa()->settings_api->get_option($role . '_redirect_url', 'redirection', $url);
            }
        }
        return $url;
    }

    /**
     * Moodle logout redirect URL
     * @param INT $user_id
     * @return URL
     */
    public static function get_logout_redirect_url($user_id) {
        $user = new WP_User($user_id);
        $url = oa()->settings_api->get_option('redirect_url', 'redirection', get_site_url());
        if ('on' === oa()->settings_api->get_option('user_role_based_redirect', 'redirection', 'off')) {
            $user_roles = $user->roles;
            foreach ($user_roles as $role) {
                $url = oa()->settings_api->get_option($role . '_redirect_url', 'redirection', $url);
            }
        }
        return $url;
    }

}

new OneAcademySSO();
