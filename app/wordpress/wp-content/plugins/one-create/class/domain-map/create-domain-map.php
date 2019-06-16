<?php


@ob_start();
session_start();
class Create_Domain_map extends Domainmap_Module_Ajax_Map {

    // init the Domain Mapping Required Variables
    public $domian_mapping_plugin;
    public $domainMapping;

    public function __construct() {
        parent::__construct(Domainmap_Plugin::instance());

        add_action('plugins_loaded', array($this,'my_plugins_load'));

    }

    public function my_plugins_load(){
        require_once plugin_dir_path(__FILE__).'/../../../domain-mapping/classes/Domainmap/Module/Ajax/Map.php';
        require_once plugin_dir_path(__FILE__).'/../../../domain-mapping/classes/Domainmap/Plugin.php';
        $this->domian_mapping_plugin = Domainmap_Plugin::instance();
        $this->domainMapping = new Domainmap_Module_Ajax_Map($this->domian_mapping_plugin);
    }

    public function validate_domain($domain){
        return $this->_validate_domain_name($domain, true);
    }

    public function check_domain_exist($domain){
        $map = $this->_wpdb->get_row( $this->_wpdb->prepare( "SELECT COUNT(*) AS count FROM " . DOMAINMAP_TABLE_MAP . " WHERE domain = %s", $domain ) );
        return $map->count;
    }

    public function check_domain_count($domain){

        // check if mapped domains are 0 or multi domains are enabled
        $count = $this->check_domain_exist($domain);
        $allowmulti = domain_map::allow_multiple();
        if ( $count == 0 || $allowmulti ) {
            return true;
        }else{
            return false;
        }
    }
    public function check_domain_access($domain){
        if ( $this->domainMapping->_plugin->get_option( 'map_verifydomain', true ) == false || $this->domainMapping->_validate_health_status( $domain ) ){
            // map domain
            return true;
        }else{
            // error
            return false;
        }
    }
    public function custom_map_domain($blog_id, $domain, $scheme = "1"){

        $message = $hide_form = false;
        $domain = Domainmap_Punycode::encode( $domain );

        $added = $this->domainMapping->_wpdb->insert( DOMAINMAP_TABLE_MAP, array(
            'blog_id' => $blog_id,
            'domain'  => $domain,
            'active'  => 1,
            "scheme" => $scheme,
        ), array( '%d', '%s', '%d', '%d') );

        if( !$added ){
            $message = $this->domainMapping->_wpdb->last_error;
        }else{
            // fire the action when a new domain is added
            do_action( 'domainmapping_added_domain', $domain, $blog_id );
            // send success response
            ob_start();
            $row = array( 'domain' => $domain, 'is_primary' => 0 );
            Domainmap_Render_Site_Map::render_mapping_row( (object)$row );
            return true;
        }

        // Set transient for scheme
        set_transient( domain_map::FORCE_SSL_KEY_PREFIX . $domain, (int) $scheme );

        // Send response json
        wp_send_json_error( array(
            'message'   => $message,
            'hide_form' => $hide_form,
        ) );
    }

    private function custom_get_domains_count() {
        return $this->_wpdb->get_var( 'SELECT COUNT(*) FROM ' . DOMAINMAP_TABLE_MAP . ' WHERE blog_id = ' . intval( $this->_wpdb->blogid ) );
    }
}
