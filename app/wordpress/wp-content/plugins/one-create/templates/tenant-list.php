<?php

if ( ! current_user_can( 'manage_sites' ) )
	wp_die( __( 'Sorry, you are not allowed to access this page.' ), 403 );

    $blogs = get_blogs_of_user( $current_user->ID );
     $screen = get_current_screen();
$wp_list_table = _get_list_table( 'WP_MS_Sites_List_Table' );

//var_dump($wp_list_table);die;
$pagenum = $wp_list_table->get_pagenum();

$id = isset( $_REQUEST['bid'] ) ? intval( $_REQUEST['bid'] ) : 0;

if ( ! $id )
	wp_die( __('Invalid site ID.') );


//echo psts_levels_select("Level" , 1);die;
//echo get_prosite_meta($id);
//update_blog_option( $id, 'lms_built', 1 );

$details = get_site( $id );
if ( ! $details ) {
	wp_die( __( 'The requested site does not exist.' ) );
}
var_dump($details);die;

add_screen_option( 'per_page' );

get_current_screen()->add_help_tab( array(
	'id'      => 'overview',
	'title'   => __('Overview'),
	'content' =>
		'<p>' . __('Add New takes you to the Add New Site screen. You can search for a site by Name, ID number, or IP address. Screen Options allows you to choose how many sites to display on one page.') . '</p>' .
		'<p>' . __('This is the main table of all sites on this network. Switch between list and excerpt views by using the icons above the right side of the table.') . '</p>' .
		'<p>' . __('Hovering over each site reveals seven options (three for the primary site):') . '</p>' .
		'<ul><li>' . __('An Edit link to a separate Edit Site screen.') . '</li>' .
		'<li>' . __('Dashboard leads to the Dashboard for that site.') . '</li>' .
		'<li>' . __('Deactivate, Archive, and Spam which lead to confirmation screens. These actions can be reversed later.') . '</li>' .
		'<li>' . __('Delete which is a permanent action after the confirmation screens.') . '</li>' .
		'<li>' . __('Visit to go to the front-end site live.') . '</li></ul>' .
		'<p>' . __('The site ID is used internally, and is not shown on the front end of the site or to users/viewers.') . '</p>' .
		'<p>' . __('Clicking on bold headings can re-sort this table.') . '</p>'
) );

get_current_screen()->set_help_sidebar(
	'<p><strong>' . __('For more information:') . '</strong></p>' .
	'<p>' . __('<a href="https://codex.wordpress.org/Network_Admin_Sites_Screen">Documentation on Site Management</a>') . '</p>' .
	'<p>' . __('<a href="https://wordpress.org/support/forum/multisite/">Support Forums</a>') . '</p>'
);

get_current_screen()->set_screen_reader_content( array(
	'heading_pagination' => __( 'Sites list navigation' ),
	'heading_list'       => __( 'Sites list' ),
) );


$wp_list_table->prepare_items();

require_once( ABSPATH . 'wp-admin/admin-header.php' );

?>

<div class="wrap">
<h1 class="wp-heading-inline"><?php _e( 'Clients' ); ?></h1>

<?php if ( current_user_can( 'create_sites') ) : ?>
	<a href="<?php echo network_admin_url('admin.php?page=one_new_client'); ?>" class="page-title-action"><?php echo esc_html_x( 'Add New', 'site' ); ?></a>
<?php endif; ?>


<hr class="wp-header-end">

<?php echo $msg; ?>


<form id="form-site-list"  method="post">
    <?php $wp_list_table->display(); ?> 
</form>
</div>
<?php

require_once( ABSPATH . 'wp-admin/admin-footer.php' ); ?>
