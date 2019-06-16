<?php
/**
 * Woo Wallet settings
 *
 * @author Subrata Mal
 */
if (!class_exists('OneAcademy_Settings')):

    class OneAcademy_Settings {
        /* setting api object */

        private $settings_api;
        
        public $list_table;

        /**
         * Class constructor
         * @param object $settings_api
         */
        public function __construct($settings_api) {
            $this->settings_api = $settings_api;
            add_action('admin_init', array($this, 'admin_init'));
            add_action('admin_menu', array($this, 'admin_menu'));
            add_action('wsa_form_bottom_sync', array($this, 'wsa_form_bottom_sync'));
            add_action('wsa_form_bottom_sync_enrol', array($this, 'wsa_form_bottom_sync_enrol'));
        }

        function admin_init() {

            //set the settings
            $this->settings_api->set_sections($this->get_settings_sections());
            foreach ($this->get_settings_sections() as $section) {
                if (method_exists($this, "update_option_{$section['id']}_callback")) {
                    add_action("update_option_{$section['id']}", array($this, "update_option_{$section['id']}_callback"), 10, 3);
                }
            }
            $this->settings_api->set_fields($this->get_settings_fields());

            //initialize settings
            $this->settings_api->admin_init();
            $this->handel_api_settings();
        }

        public function update_option_connection_settings_callback($old_value, $value, $option) {
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

            if ($success == 'updated') {
                update_option('_is_connected_with_moodle', true);
            } else {
                update_option('_is_connected_with_moodle', false);
            }
            set_transient('oneacademy_setting_page_save_status', array('status' => $success, 'message' => $response_message), MINUTE_IN_SECONDS);
            add_settings_error('', '200', $response_message, $success);
        }

        function admin_menu() {
            add_menu_page('Oneacademy', 'Oneacademy', 'manage_woocommerce', 'oneacademy', '__return_false', 'dashicons-welcome-learn-more', 58);
            $page_hook = add_submenu_page('oneacademy', 'Oneacademy Courses', 'Oneacademy Courses', 'manage_woocommerce', 'oneacademy-courses', array($this, 'oneacademy_courses'));
            add_action( "load-$page_hook", array( $this, 'product_list_page_option' ) );
            //add_submenu_page('oneacademy', 'Moodle API', 'Moodle API', 'manage_woocommerce', 'moodle-api', array($this, 'api_connect_page'));

            $menu = add_submenu_page('oneacademy', 'Social Login', 'Social Login', 'manage_options', 'social-login', array(
                'NextendSocialLoginAdmin',
                'display_admin'
            ));
            add_action('admin_print_styles-' . $menu, 'NextendSocialLoginAdmin::admin_css');
            add_submenu_page('oneacademy', 'Settings', 'Settings', 'manage_options', 'oneacademy-settings', array($this, 'plugin_page'));
            
        }
        
        public function product_list_page_option(){
            include_once( OA_ABSPATH . 'includes/class-oneacademy-list-table.php' );
            $this->list_table = new Oneacademy_List_Table();
            $this->list_table->prepare_items();
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
                    'id' => 'sync_enrol',
                    'title' => __('Sync enrollment', 'oneacademy')
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
            return apply_filters('oneacademy_settings_sections', $sections);
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

        public function handel_api_settings() {
            if (isset($_POST['connect_moodle_site'])) {
                if (isset($_POST['connect_moodle_site_nonce']) && wp_verify_nonce($_POST['connect_moodle_site_nonce'], 'connect_moodle_site_nonce')) {
                    $site_url = untrailingslashit($_POST['mdl_site_url']);
                    $url = $site_url . '/login/token.php';
                    $response = wp_remote_post($url);
                    $response_body = json_decode(wp_remote_retrieve_body($response), true);
                    if ($response_body) {
                        update_option('_mdl_site_url', $site_url);
                    } else {
                        add_action('admin_notices', 'invalid_moodle_url');
                    }
                }
            }

            if (isset($_POST['mdl_get_access_token'])) {
                if (isset($_POST['mdl_get_access_token_nonce']) && wp_verify_nonce($_POST['mdl_get_access_token_nonce'], 'mdl_get_access_token_nonce')) {
                    $site_url = get_option('_mdl_site_url', false);
                    $username = isset($_POST['mdl_username']) ? $_POST['mdl_username'] : '';
                    $password = isset($_POST['mdl_password']) ? $_POST['mdl_password'] : '';
                    $url = $site_url . '/login/token.php';
                    $paramters = array(
                        'username' => $username,
                        'password' => $password,
                        'service' => OA_MOODLE_SERVICE_NAME
                    );
                    $param = '?' . http_build_query($paramters);
                    $response = wp_remote_post($url . $param);
                    $response_body = json_decode(wp_remote_retrieve_body($response), true);
                    if ($response_body && isset($response_body['token'])) {
                        update_option('_mdl_access_token', $response_body['token']);
                    } else {
                        add_action('admin_notices', 'invalid_moodle_credential');
                    }
                }
            }
            if (isset($_POST['mdl_disconnect_site'])) {
                delete_option('_mdl_access_token');
                delete_option('_mdl_site_url');
            }
        }

        /**
         * display plugin settings page
         */
        public function api_connect_page() {
            echo '<div class="wrap">';
            echo '<h2 style="margin-bottom: 15px;">' . __('Connect to Moodle', 'oneacademy') . '</h2>';
            echo '<div class="welcome-panel moodle-api-settings">';
            ?>
            <div class="welcome-panel-content" style="margin-left:0px;text-align: center;">
                <img style="max-width: 300px;" src="<?php echo oa()->plugin_url() . '/assets/img/login_logo.png' ?>" alt="logo" />
                <?php if (!get_option('_mdl_site_url', false)) : ?>
                    <p>Please enter the URL of your Moodle site.</p>
                    <form method="post" action="" name="moodle_url">
                        <input type="url" name="mdl_site_url" required="" placeholder="Site address" class="regular-text" />
                        <?php
                        wp_nonce_field('connect_moodle_site_nonce', 'connect_moodle_site_nonce');
                        submit_button('CONNECT!', 'primary', 'connect_moodle_site');
                        ?>
                    </form>
                <?php endif; ?>
                <?php if (get_option('_mdl_site_url', false) && !get_option('_mdl_access_token')) : ?>
                    <p><?php echo get_option('_mdl_site_url', false); ?></p>
                    <form method="post" action="">
                        <p><input type="text" name="mdl_username" class="regular-text" placeholder="Username" /></p>
                        <p><input type="password" name="mdl_password" class="regular-text" placeholder="Password" /></p>
                        <?php
                        wp_nonce_field('mdl_get_access_token_nonce', 'mdl_get_access_token_nonce');
                        echo '<div class="oa-button-container">';
                        submit_button('PREVIOUS', 'primary', 'mdl_disconnect_site', false);
                        submit_button('LOG IN', 'primary', 'mdl_get_access_token', false);
                        echo '</div>';
                        ?>
                    </form>
                <?php endif; ?>
                <?php if (get_option('_mdl_access_token')) : ?>
                    <p><?php echo get_option('_mdl_site_url', false); ?></p>
                    <p style="color: #008EBE;"><span class="dashicons dashicons-yes"></span>Connected</p>
                    <form method="post" action="">
                        <?php submit_button('DISCONNECT!', 'primary', 'mdl_disconnect_site'); ?>
                    </form>
                <?php endif; ?>
            </div>
            <style type="text/css">
                .moodle-api-settings p.submit{
                    text-align: center !important;
                }
                .oa-button-container{
                    margin-bottom: 10px;
                }
                .oa-button-container .button-primary{
                    margin: 5px;
                }
            </style>
            <?php
            echo '</div>';
            echo '</div>';
        }

        public function plugin_page() {
            echo '<div class="wrap">';
            echo '<h2 style="margin-bottom: 15px;">' . __('Settings', 'oneacademy') . '</h2>';
            settings_errors();
            echo '<div class="wallet-settings-wrap">';
            $this->settings_api->show_navigation();
            $this->settings_api->show_forms();
            echo '</div>';
            echo '</div>';
        }
        public function oneacademy_courses(){
            echo '<div class="wrap">';
            echo '<h2 style="margin-bottom: 15px;">' . __('Oneacademy Courses', 'oneacademy') . '</h2>';
            $this->list_table->display();
            echo '</div>';
            echo '</div>';
        }
        public function wsa_form_bottom_sync_enrol() {
            echo '<h2>' . __('Sync Enrollment') . '</h2>';
            ?>
            <style type="text/css">
                .oneacademy-response-box {
                    display: none;
                    text-shadow: none;
                    margin-left: 20px;
                    position: absolute;
                }
                .oneacademy-alert-success {
                    color: green;
                    background-image: url('<?php echo oa()->plugin_url() . '/assets/img/success.png'; ?>');
                }
                .oneacademy-alert {
                    line-height: 28px;
                    margin-bottom: 10px;
                    padding-left: 25px;
                    background-repeat: no-repeat;
                    background-size: 18px 18px;
                    background-position: left center;
                }
                .load-response{
                    display: none;
                }
            </style>
            <?php
            $all_mdl_course = OneAcademyUtil::mdl_get_all_course();
            $args = array(
                'blog_id' => $GLOBALS['blog_id'],
            );
            $users = get_users($args);
            ?>
            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row" class="titledesc">Select course</th>
                        <td class="forminp forminp-text">
                            <select class="regular-text" name="sync_enrol_course" id="sync_enrol_course">
                                <?php foreach ($all_mdl_course as $course) : ?>
                                    <?php if ($course['id'] != 1): ?>
                                        <option value="<?php echo $course['id']; ?>"><?php echo $course['fullname']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">Select course</th>
                        <td class="forminp forminp-text">
                            <select class="regular-text" multiple="" name="sync_enrol_users" id="sync_enrol_users">
                                <?php foreach ($users as $user) : ?>
                                    <option value="<?php echo $user->data->ID; ?>"><?php echo $user->data->display_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc"></th>
                        <td class="forminp forminp-text">
                            <?php submit_button('Start Synchronization', 'primary', 'btn_sync_enrol', false); ?>
                            <span class="load-response">
                                <img src="<?php echo oa()->plugin_url() . '/assets/img/loader.gif'; ?>" height="20" width="20" />
                            </span>
                            <div class="oneacademy-response-box"><div class="oneacademy-alert oneacademy-alert-success">Synchronized successfully.</div></div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <script type="text/javascript">
                jQuery(function ($) {

                    $('#btn_sync_enrol').on('click', function (event) {
                        event.preventDefault();
                        var self = $(this);
                        $(this).parent('td').find('.load-response').show();
                        $(this).parent('td').find('.oneacademy-response-box').css('display', 'inline-block');
                        var sync_course_id = $('#sync_enrol_course').val();
                        var sync_user_ids = $('#sync_enrol_users').val();
                        var data = {
                            action: 'oneacademy_sync_enrol',
                            sync_course_id: sync_course_id,
                            sync_user_ids : sync_user_ids
                        };
                        $.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function (response) {
                            if (response.success) {
                                self.parent('td').find('.load-response').hide();
                                self.parent('td').find('.oneacademy-response-box').css('display', 'inline-block');
                            }
                        });
                    });

                    $('.oneacademy-response-box').on('click', function () {
                        $(this).hide('slow');
                    });
                });
            </script>
            <?php
        }

        public function wsa_form_bottom_sync() {
            echo '<h2>' . __('Synchronize Courses') . '</h2>';
            ?>
            <style type="text/css">
                .oneacademy-response-box {
                    display: none;
                    text-shadow: none;
                    margin-left: 20px;
                    position: absolute;
                }
                .oneacademy-alert-success {
                    color: green;
                    background-image: url('<?php echo oa()->plugin_url() . '/assets/img/success.png'; ?>');
                }
                .oneacademy-alert {
                    line-height: 28px;
                    margin-bottom: 10px;
                    padding-left: 25px;
                    background-repeat: no-repeat;
                    background-size: 18px 18px;
                    background-position: left center;
                }
                .load-response{
                    display: none;
                }
            </style>
            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row" class="titledesc">Select platform</th>
                        <td class="forminp forminp-text">
                            <select class="regular-text" name="sync_course_platform" id="sync_course_platform">
                                <option value="wp_to_mdl">WP to Moodle</option>
                                <option value="mdl_to_wp">Moodle to WP</option>
                            </select>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row" class="titledesc">Synchronization Options</th>
                        <td class="forminp forminp-text">
                            <input type="checkbox" name="sync_course_category" id="sync_course_category" /> Synchronize course categories
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row" class="titledesc"></th>
                        <td class="forminp forminp-text">
                            <input type="checkbox" name="sync_course_update" id="sync_course_update" />  Update previously synchronized courses
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row" class="titledesc"></th>
                        <td class="forminp forminp-text">
                            <?php submit_button('Start Synchronization', 'primary', 'sync_course', false); ?>
                            <span class="load-response">
                                <img src="<?php echo oa()->plugin_url() . '/assets/img/loader.gif'; ?>" height="20" width="20" />
                            </span>
                            <div class="oneacademy-response-box"><div class="oneacademy-alert oneacademy-alert-success">Synchronized successfully.</div></div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php
            echo '<h2>' . __('Synchronize Users') . '</h2>';
            ?>
            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row" class="titledesc">Select platform</th>
                        <td class="forminp forminp-text">
                            <select class="regular-text" name="sync_users_platform" id="sync_users_platform">
                                <option value="wp_to_mdl">WP to Moodle</option>
                                <option value="mdl_to_wp">Moodle to WP</option>
                            </select>
                        </td>
                    </tr>
            <!--                    <tr valign="top">
                        <th scope="row" class="titledesc">Synchronization Options</th>
                        <td class="forminp forminp-text">
                            <input type="checkbox" name="sync_users_enrollment_status" id="sync_users_enrollment_status" /> Update user's course enrollment status
                        </td>
                    </tr>-->
                    <tr valign="top">
                        <th scope="row" class="titledesc"></th>
                        <td class="forminp forminp-text">
                            <?php submit_button('Start Synchronization', 'primary', 'sync_users', false); ?>
                            <span class="load-response">
                                <img src="<?php echo oa()->plugin_url() . '/assets/img/loader.gif'; ?>" height="20" width="20" />
                            </span>
                            <div class="oneacademy-response-box"><div class="oneacademy-alert oneacademy-alert-success">Synchronized successfully.</div></div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <script type="text/javascript">
                jQuery(function ($) {
                    $('#sync_course').on('click', function (event) {
                        event.preventDefault();
                        var self = $(this);
                        $(this).parent('td').find('.load-response').show();
                        var sync_course_platform = $('#sync_course_platform').val();
                        var sync_course_category = $('#sync_course_category').is(':checked');
                        var sync_course_update = $('#sync_course_update').is(':checked');
                        var data = {
                            action: 'oneacademy_sync_course',
                            sync_course_platform: sync_course_platform,
                            sync_course_category: sync_course_category,
                            sync_course_update: sync_course_update
                        };
                        $.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function (response) {
                            if (response.success) {
                                self.parent('td').find('.load-response').hide();
                                self.parent('td').find('.oneacademy-response-box').css('display', 'inline-block');
                            }
                        });
                    });

                    $('#sync_users').on('click', function (event) {
                        event.preventDefault();
                        var self = $(this);
                        $(this).parent('td').find('.load-response').show();
                        $(this).parent('td').find('.oneacademy-response-box').css('display', 'inline-block');
                        var sync_user_platform = $('#sync_users_platform').val();
                        var data = {
                            action: 'oneacademy_sync_user',
                            sync_user_platform: sync_user_platform,
                        };
                        $.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function (response) {
                            if (response.success) {
                                self.parent('td').find('.load-response').hide();
                                self.parent('td').find('.oneacademy-response-box').css('display', 'inline-block');
                            }
                        });
                    });

                    $('.oneacademy-response-box').on('click', function () {
                        $(this).hide('slow');
                    });
                });
            </script>
            <?php
        }

    }

    endif;

new OneAcademy_Settings(oa()->settings_api);
