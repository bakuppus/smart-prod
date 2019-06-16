<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class OneAcademyNetworkAdmin {

    /**
     * The single instance of the class.
     *
     * @var Woo_Wallet_Admin
     * @since 1.1.10
     */
    protected static $_instance = null;
    private $updated = false;
    private $settings_api;
    private $sites = null;

    /**
     * Main instance
     * @return class object
     */
    public static function instance($settings_api) {
        if (is_null(self::$_instance)) {
            self::$_instance = new self($settings_api);
        }
        return self::$_instance;
    }

    public function __construct($settings_api) {
        $this->settings_api = $settings_api;
        add_action('admin_init', array($this, 'admin_init'));
        // register page
        add_action('network_admin_menu', array($this, 'setupTabs'));
    }

    function admin_init() {
        $this->sites = get_sites();
        $current_blog = isset($_GET['blog_id']) ? $_GET['blog_id'] : current($this->sites)->blog_id;
        if (isset($_GET['page']) && 'oneacademy' === $_GET['page']) {
            switch_to_blog($current_blog);
        }
        //set the settings
        $this->settings_api->set_sections($this->get_settings_sections());
        foreach ($this->get_settings_sections() as $section) {
            if (method_exists($this, "update_option_{$section['id']}_callback")) {
                add_action("update_option_{$section['id']}", array($this, "update_option_{$section['id']}_callback"), 100, 3);
            }
        }
        $this->settings_api->set_fields($this->get_settings_fields());

        //initialize settings
        $this->settings_api->admin_init();
        //$this->handel_api_settings();
    }

    /**
     * Setting sections
     * @return array
     */
    public function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'connection_settings',
                'title' => __('Connection Settings', 'oneacademy')
            ),
            array(
                'id' => 'sync',
                'title' => __('Synchronization', 'oneacademy')
            ),
            array(
                'id' => 'redirection',
                'title' => __('Redirection', 'oneacademy')
            ),
            array(
                'id' => 'settings',
                'title' => __('Site settings', 'oneacademy')
            ),
        );
        return apply_filters('oneacademy_settings_network_sections', $sections);
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    public function get_settings_fields() {
        $settings_fields = array(
            'connection_settings' => array(
                array(
                    'name' => 'site_connection_hidden',
                    'type' => 'hidden'
                ),
                array(
                    'name' => 'mdl_site_url',
                    'label' => __('Moodle URL', 'oneacademy'),
                    'desc' => __('Moodle URL', 'oneacademy'),
                    'placeholder' => '',
                    'type' => 'url',
                    'default' => '',
                    'sanitize_callback' => 'sanitize_text_field'
                ),
                array(
                    'name' => 'mdl_access_token',
                    'label' => __('Moodle Access Token', 'oneacademy'),
                    'desc' => __('Moodle Access Token', 'oneacademy'),
                    'placeholder' => '',
                    'type' => 'text',
                    'default' => '',
                    'sanitize_callback' => 'sanitize_text_field'
                ),
            ),
            'redirection' => array_merge(array(
                array(
                    'name' => 'redirect_url',
                    'label' => __('Login Redirect URL', 'oneacademy'),
                    'desc' => __('Login Redirect URL', 'oneacademy'),
                    'placeholder' => site_url(),
                    'type' => 'url',
                    'default' => '',
                    'sanitize_callback' => 'sanitize_text_field'
                ),
                array(
                    'name' => 'user_role_based_redirect',
                    'label' => __('User role based redirect', 'oneacademy'),
                    'desc' => __('Enable user role based redirect', 'oneacademy'),
                    'type' => 'checkbox',
                )
                    ), self::get_role_wise_redirect_settings()),
            'settings' => array(
                array(
                    'name' => 'is_disable_connection_settings',
                    'label' => __('Disable connection settings', 'oneacademy'),
                    'desc' => __('If checked the connection settings tab will be removed from site plugin settings.', 'oneacademy'),
                    'type' => 'checkbox',
                ),
                array(
                    'name' => 'is_disable_sync',
                    'label' => __('Disable synchronization settings', 'oneacademy'),
                    'desc' => __('If checked the synchronization settings tab will be removed from site plugin settings.', 'oneacademy'),
                    'type' => 'checkbox',
                ),
                array(
                    'name' => 'is_disable_redirection',
                    'label' => __('Disable redirect settings', 'oneacademy'),
                    'desc' => __('If checked the redirect settings tab will be removed from site plugin settings.', 'oneacademy'),
                    'type' => 'checkbox',
                )
            )
        );
        return $settings_fields;
    }

    private static function get_role_wise_redirect_settings() {
        $settings = array();
        $editable_roles = array_reverse(get_editable_roles());
        foreach ($editable_roles as $role => $details) {
            $settings[] = array(
                'name' => $role . '_redirect_url',
                'label' => translate_user_role($details['name']),
                'desc' => __('Login Redirect URL', 'oneacademy'),
                'placeholder' => site_url(),
                'type' => 'url',
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field'
            );
        }
        return $settings;
    }

    /**
     * This method will be used to register
     * our custom settings admin page
     */
    public function setupTabs() {
        add_menu_page(__('Oneacademy Settings', 'oneacademy'), __('Oneacademy', 'oneacademy'), 'manage_options', 'oneacademy', array($this, 'screen'), 'dashicons-welcome-learn-more', 30);
    }

    /**
     * This method will parse the contents of
     * our custom settings age
     */
    public function screen() {
        $sites = get_sites();
        $current_blog = isset($_GET['blog_id']) ? $_GET['blog_id'] : current($sites)->blog_id;
        ?>

        <div class="wrap">

            <h2><?php _e('Oneacademy Settings', 'oneacademy'); ?></h2>
            <?php if ($this->updated) : ?>
                <div class="updated notice is-dismissible">
                    <p><?php _e('Settings updated successfully!', 'my-plugin-domain'); ?></p>
                </div>
            <?php endif; ?>

            <?php
            $setting_transiant = get_transient('oneacademy_setting_page_save_status');
            if ($setting_transiant) {
                if (isset($setting_transiant['status'])) {
                    ?>
                    <div class="<?php echo 'updated' === $setting_transiant['status'] ? 'updated' : 'error settings-error'; ?> notice is-dismissible">
                        <p><?php echo $setting_transiant['message']; ?></p>
                    </div>
                    <?php
                }

                delete_transient('oneacademy_setting_page_save_status');
            }
            ?>

            <form method="get" id="select_multi_site_form">
                <input type="hidden" name="page" value="<?php echo isset($_GET['page']) ? $_GET['page'] : ''; ?>" />
                <p>
                    <label for="blog_id">
                        <?php _e('Select site', 'my-plugin-domain'); ?>
                        <select class="regular-input" name="blog_id" id="blog_id">
                            <?php foreach ($sites as $site) : ?>
                                <option value="<?php echo $site->blog_id; ?>" <?php selected($site->blog_id, $current_blog, true) ?>><?php echo $site->domain . $site->path; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </p>

            </form>
            <?php
            $this->settings_api->show_navigation();
            $this->settings_api->show_forms();
            ?>
        </div>
        <script type="text/javascript">
            jQuery(function ($) {
                $('#blog_id').on('change', function () {
                    $('#select_multi_site_form').submit();
                });
            });
        </script>

        <?php
    }

    public function update_option_connection_settings_callback($old_value, $value, $option) {
        echo 'dsad';
        die;
        $success = 'updated';
        $response_message = 'Connection successful';

        //function to check if webservice token is properly set.
        $webservice_function = 'core_course_get_courses';

        $request_url = $value['mdl_site_url'] . '/webservice/rest/server.php?wstoken=';
        $request_url .= $value['mdl_access_token'] . '&wsfunction=';
        $request_url .= $webservice_function . '&moodlewsrestformat=json';
        // $response = wp_remote_post( $request_url, $request_args );
        $request_args = array("timeout" => 100);
        $response = wp_remote_post($request_url, $request_args);
        if (is_wp_error($response)) {
            $success = 'error';
            $response_message = $response->get_error_message();
        } elseif (wp_remote_retrieve_response_code($response) == 200 ||
                wp_remote_retrieve_response_code($response) == 303) {
            $body = json_decode(wp_remote_retrieve_body($response));
            if (!empty($body->exception)) {
                $success = 'error';
                $response_message = $body->message;
            }
        } else {
            $success = 'error';
            $response_message = __('Please check Moodle URL !', 'oneacademy');
        }

        add_settings_error('', '200', $response_message, $success);
    }

}

if (is_network_admin()) {
    OneAcademyNetworkAdmin::instance(oa()->settings_api);
}
