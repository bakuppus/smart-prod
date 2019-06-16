<?php

class OA_Build_LMS extends WP_Async_Request {

	// use WP_Example_Logger;

	/**
	* @var string
	*/
	protected $action = 'build_lms';

	/**
	* Handle
	*
	* Override this method to perform any actions required
	* during the async request.
	*/
	protected function handle() {
		$this->build_lms_function( $_POST['lms_prefix'], $_POST['id'] );
	}

	/*
	*  Build LMS component function
	*  @author: Agarhy
	*/
	public function build_lms_function($lms_prefix, $blog_id){
		update_blog_option( $id, 'lms_built', 2 ); //Build on-progress
	    if(isset($blog_id) && $blog_id!=null){
	        $id = $blog_id;
	    }
	    if ( ! $id )
	        wp_die( __('Invalid site ID.') );
		
	    $blog_details = get_blog_details( $id );
	    $blog_admin_email = get_blog_option($id , 'admin_email');

	    $str_=" -c";
	    $str_.=" ". DB_HOST ." ".DB_USER." '".DB_PASSWORD."'";
	    $str_.=" ".$lms_prefix."_".str_replace('.','_',$blog_details->domain);
	    $str_.=" ".$blog_admin_email;
	    $str_.=" '".$blog_details->blogname." LMS'";
	    $str_.=" 'https://".$blog_details->domain." '";
	    update_blog_option( $id, 'lms_built_str', $str_ ); //Build paramaters

	    //echo escapeshellarg(ABSPATH);
	    $old_path = getcwd();

	    $bin_dir = ABSPATH."../bin";
	    chdir($bin_dir);
	    $output = shell_exec('./cloner.sh '.$str_);
	    chdir($old_path);
		update_blog_option( $id, 'lms_built_output', $output ); //Build ouput

	    update_blog_option( $id, 'lms_built', 1 ); //Build finish
	    //wp_redirect(network_admin_url('sites.php'));

	}

}
