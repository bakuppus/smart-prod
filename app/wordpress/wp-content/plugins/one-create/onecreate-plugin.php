<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


final class OneCreate{

    public $plugin;
    public $lms_prefix;
    public $CrateDomainMap;

	  protected $process_single;

    //public $proSiteInstance;
     /**
     * The single instance of the class.
     *
     * @var OneCreate
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



    public function __construct() {
        require_once plugin_dir_path( __FILE__ ) . 'incl/wp-async-request.php';
        require_once plugin_dir_path( __FILE__ ) . 'class/class-build-lms.php';
        require_once plugin_dir_path( __FILE__ ) . 'incl/class-filter-network-users.php';
        require_once plugin_dir_path( __FILE__ ) . '../oneacademy/includes/class-oneacademy-sso.php';
        $this->OneAcademySSO = new OneAcademySSO();
        $this->process_single = new OA_Build_LMS();

        $this->lms_prefix="lms";

        $this->plugin = plugin_basename(__FILE__);
        /*
        *  Create filter network users menu item
        *  @author: MouMohsen
        */
        add_action( 'network_admin_menu', array($this,"filter_network_user_page"), 10, 0 );


        /*
        *  Create network menu item
        *  @author: Agarhy
        */
        add_action("network_admin_menu",array($this,"addNetworkMenu"));


        /*
        *  Modify sites table, add LMS column
        *  @author: Agarhy
        */
        add_action( 'wpmu_blogs_columns', array( $this, 'add_new_mdl_column_field' ), 12, 3 );
        add_action( 'manage_sites_custom_column', array( $this, 'add_mdle_column_field' ), 12, 3 );


        //list sites
        //...Logic Here

        //get pro-sites levels array
        //...Logic Here

        /*
        *  Create new site from submited custom page "tenant-new"
        *  @author: Akafrawy
        */
        add_action( 'admin_post_submit_new_site_action', array($this,"addNetworkNewSite"));
        //add_action( 'network_admin_notices', array($this,'admin_notices'));

        /*
         * add action to load pro Site Class
         * */
        add_action('plugins_loaded', array($this,'my_plugins_load'));
        //update pro-sites options for new blog
        //...Logic Here

        //add new mapping domain
        //...Logic Here

        //clone default blog, call cloner
        //...Logic Here

        /*
        *  Build site LMS component (Moodle DB & dataroot folder)
        *  @author: Agarhy
        */
        add_action('admin_post_oc_build_lms',array($this, 'build_lms_function'));
        add_action('admin_bar_menu', array($this,'lms_admin_bar_menu'), 210);

        /*
         *  check if the site exists Action From the Blod ID
         * */
        add_action( 'rest_api_init', function () {
            // match this Route /wp-json/one-create/v1/check-site/{id}
            register_rest_route( 'one-create/v1', '/check-site/(?P<id>\d+)', array(
                'methods' => 'GET',
                'callback' => array($this, 'check_site_exist'),
            ) );

            // match this Route /wp-json/one-create/v1/check-domain/{url}
//            register_rest_route( 'one-create/v1', '/check-domain/(?P<domain>[a-zA-Z0-9-]+)', array(
//                'methods' => 'GET',
//                'callback' => array($this, 'check_domain_exist'),
//            ) );


            register_rest_route( 'one-create/v1', '/check-domain/(?P<domain>.+)', array(
                'methods' => 'GET',
                'callback' => array($this, 'check_domain_exist'),
            ) );
        });

    }

    public function activate(){

        if ( ! is_plugin_active( 'cloner/cloner.php' ) || ! is_plugin_active( 'domain-mapping/domain-mapping.php' )  ||! is_plugin_active( 'pro-sites/pro-sites.php' )) {

            wp_die('Sorry, but this plugin requires Three Plugin to be installed and active [ Pro-Sites, Cloner and Domain mapping ]. <br><a href="' . network_admin_url( 'plugins.php' ) . '">&laquo; Return to Plugins</a>');
        }
        flush_rewrite_rules();
    }

    public function deactivate(){
        // ...
        flush_rewrite_rules();
    }

    public function lms_admin_bar_menu() {

        global $wp_admin_bar;

        $blog_id = get_current_blog_id();

        if(!get_blog_option($blog_id,'lms_built') && $blog_id !=1 ){

            //LMS NOT BUILT


        }else{

            $details = get_site( $blog_id );

            $menus[] = array(
                'id' => 'lms_site',
                'title' => '<span class="ab-icon dashicons dashicons dashicons-welcome-learn-more"></span>' . _('LMS'),
                'href' => $this->OneAcademySSO->get_mdl_login_url(get_current_user_id(),'/my'),
                'meta' => array(
                   'target' => 'blank',
                   'class'    => 'wpse--item'
                )
             );

            $menus[] = array(
                'id' => 'lms_home',
                'parent' => 'lms_site',
                'title' => 'Visit LMS',
                'href' => $this->OneAcademySSO->get_mdl_login_url(get_current_user_id(),'/my'),
                'meta' => array(
                    'target' => 'blank'
                )
            );
            $menus[] = array(
                'id' => 'lms_dashboard',
                'parent' => 'lms_site',
                'title' => 'LMS Dashboard',
                'href' => $this->OneAcademySSO->get_mdl_login_url(get_current_user_id(),'/admin'),
                'meta' => array(
                    'target' => 'blank'
                )
            );
            $menus[] = array(
                'id' => 'lms_courses',
                'parent' => 'lms_site',
                'title' => 'Manage Courses',
                'href' => $this->OneAcademySSO->get_mdl_login_url(get_current_user_id(),'/course/management.php'),
                'meta' => array(
                    'target' => 'blank'
                )
            );

        }


        foreach ( apply_filters( 'render_webmaster_menu', $menus ) as $menu )
        $wp_admin_bar->add_menu( $menu );

    }

    public function addNetworkMenu(){

        add_menu_page("OneAcademy Clients", "Clients", '', "one_clients",array($this,"tenantsList"),'dashicons-store','4');
        /*
        *  Crate new page for custom add site form
        *  @author: Agarhy
        */
        add_submenu_page("one_clients","Add New Client", "New Client","", "one_new_client",array($this,"tenantsCreate"));


    }

    public function tenantsList(){
        echo DB_HOST;
        require_once plugin_dir_path(__FILE__).'/templates/tenant-list.php';
    }
    public function tenantsCreate(){
        require_once plugin_dir_path(__FILE__).'/templates/tenant-new.php';
    }

    /*
     * load pro Site Function Callback
     * */
    public function my_plugins_load(){
        if ( class_exists('ProSites') ) {
            /**
             * load pro sites Classes
             */
            require_once plugin_dir_path(__FILE__).'/../pro-sites/pro-sites.php';
            /*
             * Load Cloner Plugin Classes
             * */
            require_once plugin_dir_path(__FILE__).'/../cloner/admin/cloner-admin-clone-site.php';

            // domain mapping
            require_once plugin_dir_path(__FILE__).'/class/domain-map/create-domain-map.php';


        } else {
            add_action('admin_notices', 'core_plugins_not_loaded');
        }
    }

    /*
    *  Create new site function
    *  @author: Akafrawy
    */
    public function addNetworkNewSite(){

        if( isset( $_POST['nds_add_user_meta_nonce'] ) && wp_verify_nonce( $_POST['nds_add_user_meta_nonce'], 'nds_add_user_meta_form_nonce') ) {

            $this->CrateDomainMap = new Create_Domain_map();
            // sanitize the input
            $nds_user_meta_key = sanitize_key( $_POST['nds']['user_meta_key'] );
            $nds_user_meta_value = sanitize_text_field( $_POST['nds']['user_meta_value'] );
            $nds_user =  get_user_by( 'login',  $_POST['nds']['user_select'] );
            $nds_user_id = absint( $nds_user->ID ) ;

            if ( ! is_array( $_POST['blog'] ) )
                wp_die( __( 'Can&#8217;t create an empty site.' ) );

            $blog = $_POST['blog'];
            $domain = '';
            if ( preg_match( '|^([a-zA-Z0-9-])+$|', $blog['domain'] ) )
                $domain = strtolower( $blog['domain'] );

            // If not a subdomain installation, make sure the domain isn't a reserved word
            if ( ! is_subdomain_install() ) {
                $subdirectory_reserved_names = get_subdirectory_reserved_names();

                if ( in_array( $domain, $subdirectory_reserved_names ) ) {
                    wp_die(
                    /* translators: %s: reserved names list */
                        sprintf( __( 'The following words are reserved for use by WordPress functions and cannot be used as blog names: %s' ),
                            '<code>' . implode( '</code>, <code>', $subdirectory_reserved_names ) . '</code>'
                        )
                    );
                }
            }

            $title = $blog['title'];

            $meta = array(
                'public' => 1
            );

            // Handle translation installation for the new site.
            if ( isset( $_POST['WPLANG'] ) ) {
                if ( '' === $_POST['WPLANG'] ) {
                    $meta['WPLANG'] = ''; // en_US
                } elseif ( in_array( $_POST['WPLANG'], get_available_languages() ) ) {
                    $meta['WPLANG'] = $_POST['WPLANG'];
                } elseif ( current_user_can( 'install_languages' ) && wp_can_install_language_pack() ) {
                    $language = wp_download_language_pack( wp_unslash( $_POST['WPLANG'] ) );
                    if ( $language ) {
                        $meta['WPLANG'] = $language;
                    }
                }
            }

            if ( empty( $domain ) )
                wp_die( __( 'Missing or invalid site address.' ) );

            if ( isset( $blog['email'] ) && '' === trim( $blog['email'] ) ) {
                wp_die( __( 'Missing email address.' ) );
            }

            $email = sanitize_email( $blog['email'] );
            if ( ! is_email( $email ) ) {
                wp_die( __( 'Invalid email address.' ) );
            }

            if ( is_subdomain_install() ) {
                $newdomain = $domain . '.' . preg_replace( '|^www\.|', '', get_network()->domain );
                $path      = get_network()->path;
            } else {
                $newdomain = get_network()->domain;
                $path      = get_network()->path . $domain . '/';
            }

            // validate Domain mapping Domain
            $customDomain = $blog['custom-domain'] ;
            $is_valid = $this->CrateDomainMap->validate_domain($customDomain);



            if(!empty($customDomain)){
                if(!$is_valid){

                    if( $is_valid == false ){
                        wp_die(__( 'Custom Domain name is invalid.') );
                    }else{
                        wp_die(__( 'Custom Domain name is prohibited.') );
                    }

                }
                $is_mapped_before = $this->CrateDomainMap->check_domain_count($customDomain);
                if(!$is_mapped_before){
                    wp_die( __( 'Multiple domains are not allowed.' ) );
                }

                $is_access = $this->CrateDomainMap->check_domain_access($customDomain);
                if(!$is_access){
                    wp_die('We can’t access your new domain. Mapping a new domains can take as little as 15 minutes to resolve but in some cases can take up to 72 hours, so please wait if you just bought it. If it is an existing domain and has already been fully propagated, check your DNS records are configured correctly.');
                }
            }

            $password = 'N/A';
            $user_id = email_exists($email);
            if ( !$user_id ) { // Create a new user with a random password
                /**
                 * Fires immediately before a new user is created via the network site-new.php page.
                 *
                 * @since 4.5.0
                 *
                 * @param string $email Email of the non-existent user.
                 */
                do_action( 'pre_network_site_new_created_user', $email );

                $user_id = username_exists( $domain );
                if ( $user_id ) {
                    wp_die( __( 'The domain or path entered conflicts with an existing username.' ) );
                }
                $password = wp_generate_password( 12, false );
                $user_id = wpmu_create_user( $domain, $password, $email );
                if ( false === $user_id ) {
                    wp_die( __( 'There was an error creating the user.' ) );
                }

                /**
                 * Fires after a new user has been created via the network site-new.php page.
                 *
                 * @since 4.4.0
                 *
                 * @param int $user_id ID of the newly created user.
                 */
                do_action( 'network_site_new_created_user', $user_id );
            }


            $id = wpmu_create_blog( $newdomain, $path, $title, $user_id, $meta, get_current_network_id() );

            //update pro-sites level by call/extend plugin functions
            $proSiteInstance = new ProSites();
            $proSiteInstance->extend($id,$_POST['period'] , false ,$_POST['level'] ,false, false, true,false);

            //update mapped-domain for site
            if(!empty($customDomain)){
                $map = $this->CrateDomainMap->custom_map_domain($id, $customDomain);
                if($map != true){
                    wp_die($map);
                }
            }
            // build lms domain
            //$_REQUEST['bid'] = $id;

            // $this->build_lms_function($id);
            $this->process_single->data( array( 'id' => $id, 'lms_prefix'=>$this->lms_prefix ) )->dispatch();

            // clone the content of the main Site into this new Blog
            $clonerInstnace  = WPMUDEV_Cloner_Admin_Clone_Site::get_instance();

            // declare Global Variables used inside cloner functions
            $_REQUEST['clone-site-submit'] = "true";

            /*
             * The Variable $REQUEST['blog_id'] is the blog id that we need to clone the content from
             * This will refer to static Site That Contain Our Basic Content
             * Or We Can Define this as a field inside one-create pluign setting page
             */

            $current_site = get_current_site();
            $_REQUEST['blog_id'] = "2";
            $_REQUEST['cloner-clone-selection'] = "replace";
            $_REQUEST['cloner_blog_title'] = "keep";
            $_REQUEST['replace_blog_title'] = $title;

            /*
             * this blog replace id refer to the blog id that will overwrite it's content
             * in our case will be the created Blog id
             * */
            $_REQUEST['blog_replace'] = $id;

            $_REQUEST['confirm'] = "Continue";

            $_REQUEST['action'] = "clone";

            // get the nonce field
            $nonce = wp_create_nonce( 'clone-site-2' );

            $_REQUEST['_wpnonce_clone-site'] = $nonce;
            $_REQUEST['_wp_http_referer'] = "/wp-admin/network/index.php?page=clone_site&amp;blog_id=2&amp;action=clone";

            $data = $clonerInstnace->sanitize_clone_form();


            wp_redirect( add_query_arg( array( 'id' => '1' ), 'network/sites.php' ) );
            exit;

        }
        else {
            wp_die( __( 'Invalid nonce specified', $this->plugin_name ), __( 'Error', $this->plugin_name ), array(
                'response' 	=> 403,
                'back_link' => 'admin.php?page=' . $this->plugin_name,
            ) );
        }

    }

    // public function admin_notices()
    // {
    //     if ($_GET['id'] == "1") {
    //         echo "<div class='notice notice-success is-dismissible'><p>This is the success message</p></div>";
    //     } elseif ($_GET['id'] == "0") {
    //         echo "<div class='notice notice-error is-dismissible'><p>Error in Form Fields</p></div>";
    //     }


    // }

    /*
    *  Sites Table custom column label
    *  @author: Agarhy
    */

    public function add_new_mdl_column_field($columns ) {

        $first_array = array_splice( $columns, 0, 56 );
		$columns     = array_merge( $first_array, array( 'lms' => __( 'LMS', 'lms' ) ), $columns );

		return $columns;
    }

    /*
    *  Sites Table custom column cell value
    *  @author: Agarhy
    */
	function add_mdle_column_field( $column, $blog_id ) {
		//$this->column_field_cache( $blog_id );

		if ( $column == 'lms' ) {
            if(!get_blog_option($blog_id,'lms_built') && $blog_id !=1 ){


                if ( isset( $this->column_fields[ $blog_id ] ) ) {
                    echo "<a class='button action' title='" . __( 'Build LMS', 'lms' ) . "' href='" . admin_url( 'admin-post.php?action=oc_build_lms&bid=' . $blog_id ) . "'>" . $this->column_fields[ $blog_id ] . "</a>";
                } else {
                    echo "<a class='button action' title='" . __( 'Build LMS', 'lms' ) . "' href='" . admin_url( 'admin-post.php?action=oc_build_lms&bid=' . $blog_id ) . "'>" . __( 'Build LMS', 'psts' ) . "</a>";
                }

            }else{
                $details = get_site( $blog_id );
                if(get_blog_option($blog_id,'lms_built')==1){
                    echo "<a class='' target='_blank' title='" . __( 'Go To LMS', 'go_to_lms' ) . "' href='http://". $this->lms_prefix .".". $details->domain. "'>". $this->lms_prefix ."." . $details->domain. "</a>";
                }else if(get_blog_option($blog_id,'lms_built')==2){
                    echo "Build On-Progress...";
                }
            }
		}
    }


    /*
    *  Build LMS component function
    *  @author: Agarhy
    */
    public function build_lms_function($blog_id){

        if(isset($blog_id) && $blog_id!=null){
            $id = $blog_id;
        }else if( isset( $_REQUEST['bid'] ) ){
            $id =  intval( $_REQUEST['bid'] );
        }
        if ( ! $id )
            wp_die( __('Invalid site ID.') );

        $this->process_single->data( array( 'id' => $id, 'lms_prefix'=>$this->lms_prefix ) )->dispatch();
        wp_redirect(network_admin_url('sites.php'));

    }

    public function check_site_exist(WP_REST_Request $request){

        $check = get_blog_details($request['id']);

        return $this->check_site_response($check);

    }
    public function check_domain_exist(WP_REST_Request $request){

        $domain = sanitize_text_field($request['domain']);

        if(preg_match("@^https?://@", $domain)){
            $parse = parse_url($domain);
            $domain =  $parse['host'];
        }else{
            $parse = parse_url("http://" . $domain);
            $domain =  $parse['host'];
        }

        //$domain = (strpos($domain, 'www') !== false) ? substr($domain, 4) : $domain;

        $domain = (substr($domain, 0, 3) == "lms") ? substr($domain, 4) : $domain;


        $sites = get_sites();

        $check = false;

        // check if the domain is mapped
        $check = ($this->CrateDomainMap->check_domain_exist($domain) != "0") ? true : false;

        // check if the domain exists in the sites Subdomain
        if(!$check) {
            foreach ($sites as $site) {
                if ($site->domain == $domain) {
                    $check = true;
                    break;
                }
            }
        }

        return $this->check_site_response($check);
    }
    public function check_site_response($check){
        $status = ($check) ? true : false;

        $code = ($check) ? 'site_exist' : 'site_not_exist';

        $message = ($check) ? 'This site is exist' : 'No site was found matching this Blog id';

        $data = array('status' => $status, 'code' => $code, 'message' => $message);

        // Create the response object
        $response = new WP_REST_Response( $data );

        // Add a custom status code
        $response->set_status( 200 );

        return $response;
    }

    /*
    *  Filter Network Users
    *  @author: MouMohsen
    */
    public function filter_network_user_page() {
      add_submenu_page(
        'users.php',
        __( 'Filter Network Users'), //page title
        __( 'Network Users' ), //
        'manage_options', //caps
        'filter_ms_users', //page slug
        array($this,'filter_network_users_page_callback')
      );
    }

    public function filter_network_users_page_callback() {
      ?>
      <h1><?php _e( 'Filter Network Admins'); ?></h1>

      <div class="wrap">
        <?php
        $wp_list_table = new Filter_Network_Users();
        ?>
        <form method="POST" action="users.php?page=filter_ms_users" >
          <div class="alignleft actions">
            <?php
            $wp_list_table->prepare_items();
            $wp_list_table->display();
            ?>
          </form>
        </div>
        <?php
      }

}
