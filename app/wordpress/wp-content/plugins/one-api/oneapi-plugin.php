<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


final class OneApi{

    public $plugin;


   
    //public $proSiteInstance;
     /**
     * The single instance of the class.
     *
     * @var OneApi
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
  
        
        $this->plugin = plugin_basename(__FILE__);

        add_filter( 'rest_authentication_errors',array($this, 'mytheme_only_allow_logged_in_rest_access' ));
        add_action( 'rest_api_init', function () {
            // match this Route /wp-json/one-create/v1/check-site/{id}
            register_rest_route( 'api/v1', '/app-health', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_health'),
            ) );

            register_rest_route( 'api/v1', '/site-health/(?P<id>\d+)', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_site_health'),
            ) );

            register_rest_route( 'api/v1', '/get_users', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_users'),
            ) );

            register_rest_route( 'api/v1', '/get_posts', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_posts'),
            ) );
            // match this Route /wp-json/one-create/v1/check-domain/{url}
//            register_rest_route( 'one-create/v1', '/check-domain/(?P<domain>[a-zA-Z0-9-]+)', array(
//                'methods' => 'GET',
//                'callback' => array($this, 'check_domain_exist'),
//            ) );


            // register_rest_route( 'one-create/v1', '/check-domain/(?P<domain>.+)', array(
            //     'methods' => 'GET',
            //     'callback' => array($this, 'check_domain_exist'),
            // ) );
        });

    }
    public function mytheme_only_allow_logged_in_rest_access( $access ) {
        // if( ! is_user_logged_in() || ! current_user_can( 'manage_options' ) ) {
        //     return new WP_Error( 'rest_cannot_access', __( 'Only authenticated users can access the REST API.', 'disable-json-api' ), array( 'status' => rest_authorization_required_code() ) );
        // }
        return $access;
    }

    public function activate(){

        // if ( ! is_plugin_active( 'cloner/cloner.php' ) || ! is_plugin_active( 'domain-mapping/domain-mapping.php' )  ||! is_plugin_active( 'pro-sites/pro-sites.php' )) {

        //     wp_die('Sorry, but this plugin requires Three Plugin to be installed and active [ Pro-Sites, Cloner and Domain mapping ]. <br><a href="' . network_admin_url( 'plugins.php' ) . '">&laquo; Return to Plugins</a>');
        // }
        flush_rewrite_rules();
    }

    public function deactivate(){
        // ...
        flush_rewrite_rules();
    }

    public function get_posts(WP_REST_Request $request){
        
        $lastposts = get_posts(  );

        $data=array();
        // Array of WP_User objects.
        foreach ( $lastposts as $post ) :
            setup_postdata( $post ); 
            $data[]="<h2><a href=".the_permalink().">".the_title()."</a></h2>";        
        endforeach; 
        wp_reset_postdata();
        // Create the response object
        $response = new WP_REST_Response( $data );

        // Add a custom status code
        $response->set_status( 200 );

        return $response;

    }
  

    public function get_users(WP_REST_Request $request){
        
        $blogusers = get_users( );
        
        $data=array();
        // Array of WP_User objects.
        foreach ( $blogusers as $user ) {
            $data[]='<span>' . esc_html( $user->display_name ) . '</span>';
        }

        // Create the response object
        $response = new WP_REST_Response( $blogusers );

        // Add a custom status code
        $response->set_status( 200 );

        return $response;

    }
  
  

    public function get_health(WP_REST_Request $request){
        //3 stats of [ok-attention-problem]
        $data=array(
            '_id'=>'3vXEB7w_k3',
            'services'=>array(
                'mysql'=> 1,
                'smtp'=>rand(0,1),
                'redis'=>1,
            ),
            'disk'=>array(
                'I/O'=> 1,
                'usage'=>rand(45,95)
            ),
            'memory'=>array(
                'free'=> rand(5,35),                
            ),
            'cpu'=>array(
                'load'=> rand(45,95),                
            ),
            'network'=>array(
                'http'=> 1,
                'https'=>1,
                'websocket'=>rand(0,1),
            ),

        );

        // Create the response object
        $response = new WP_REST_Response( $data );

        // Add a custom status code
        $response->set_status( 200 );

        return $response;

    }
    public function get_site_health(WP_REST_Request $request){
        //3 stats of [ok-attention-problem]
        $data=array(
            '_id'=>$request['id'],
            'services'=>array(
                'mysql'=> 1,
                'smtp'=>rand(0,1),
                'redis'=>1,
            ),
            'disk'=>array(
                'I/O'=> 1,
                'usage'=>rand(45,95)
            ),
            'memory'=>array(
                'free'=> rand(5,35),                
            ),
            'cpu'=>array(
                'load'=> rand(45,95),                
            ),
            'network'=>array(
                'http'=> 1,
                'https'=>1,
                'websocket'=>1,
            ),

        );

        // Create the response object
        $response = new WP_REST_Response( $data );

        // Add a custom status code
        $response->set_status( 200 );

        return $response;

    }
}