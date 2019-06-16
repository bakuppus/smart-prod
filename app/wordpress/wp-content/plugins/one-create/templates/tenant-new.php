<?php

/**
 * Add Site Administration Screen
 *
 * @package WordPress
 * @subpackage Multisite
 * @since 3.1.0
 */

/** Load WordPress Administration Bootstrap */
require_once( ABSPATH . 'wp-admin/network/admin.php' );

/** WordPress Translation Installation API */
require_once( ABSPATH . 'wp-admin/includes/translation-install.php' );

/** Load ProSites CheckOut Class */
//require_once ("../../pro-sites/pro-sites-files/lib/ProSites/View/Front/Checkout.php");

if ( ! current_user_can( 'create_sites' ) ) {
	wp_die( __( 'Sorry, you are not allowed to add sites to this network.' ) );
}

$title = __('Add New Site');
$parent_file = 'sites.php';


add_action('plugins_loaded', 'my_plugins_init');

function my_plugins_init() {
    if ( class_exists('ProSites') ) {
        /**
         * load pro sites Classes
         */
        require_once ("../../pro-sites/pro-sites.php");
        require_once ("../../pro-sites/pro-sites-files/lib/ProSites/View/Front/Checkout.php");


    } else {
        add_action('admin_notices', 'core_plugins_not_loaded');
    }
}

function core_plugins_not_loaded() {
    printf(
        '<div class="error"><p>%s</p></div>',
        __('Sorry cannot create new site because Pro Sites is not loaded')
    );
}

/**
 * init the variables
 */
$pro = new ProSites_View_Front_Checkout();
$ProSitesdomain = new ProSites();
$nds_add_meta_nonce = wp_create_nonce( 'nds_add_user_meta_form_nonce' );
wp_enqueue_script( 'user-suggest' );
?>

<div class="wrap">
<h1 id="add-new-site"><?php _e( 'Create New Academy' ); ?></h1>

<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="POST" novalidate="novalidate">

    <input type="hidden" name="action" value="submit_new_site_action">
    <input type="hidden" name="nds_add_user_meta_nonce" value="<?php echo $nds_add_meta_nonce ?>" />

	<table class="form-table">
		<tr class="form-field form-required">
			<th scope="row"><label for="site-address"><?php _e( 'Academy subdomain' ) ?></label></th>
			<td>
			<?php if ( is_subdomain_install() ) { ?>
				<input name="blog[domain]" type="text" class="regular-text" id="site-address" aria-describedby="site-address-desc" autocapitalize="none" autocorrect="off"/><span class="no-break">.<?php echo preg_replace( '|^www\.|', '', get_network()->domain ); ?></span>
			<?php } else {
				echo get_network()->domain . get_network()->path ?><input name="blog[domain]" type="text" class="regular-text" id="site-address" aria-describedby="site-address-desc"  autocapitalize="none" autocorrect="off" />
			<?php }
			echo '<p class="description" id="site-address-desc">' . __( 'Only lowercase letters (a-z), numbers, and hyphens are allowed.' ) . '</p>';
			?>
			</td>
		</tr>
		<tr class="form-field form-required">
			<th scope="row"><label for="site-title"><?php _e( 'Academy Title' ) ?></label></th>
			<td><input name="blog[title]" type="text" class="regular-text" id="site-title" /></td>
		</tr>
		<?php
		$languages    = get_available_languages();
		$translations = wp_get_available_translations();
		if ( ! empty( $languages ) || ! empty( $translations ) ) :
			?>
			<tr class="form-field form-required">
				<th scope="row"><label for="site-language"><?php _e( 'Academy Language' ); ?></label></th>
				<td>
					<?php
					// Network default.
					$lang = get_site_option( 'WPLANG' );

					// Use English if the default isn't available.
					if ( ! in_array( $lang, $languages ) ) {
						$lang = '';
					}

					wp_dropdown_languages(
						array(
							'name'                        => 'WPLANG',
							'id'                          => 'site-language',
							'selected'                    => $lang,
							'languages'                   => $languages,
							'translations'                => $translations,
							'show_available_translations' => current_user_can( 'install_languages' ) && wp_can_install_language_pack(),
						)
					);
					?>
				</td>
			</tr>
        <?php endif; // Languages. ?>
        <tr class="form-field form-required">
            <th scope="row"><label for="payment-period"><?php _e( 'Payment Period' ); ?></label></th>
            <td>
                <?php

                    $active_periods = (array) $ProSitesdomain->get_setting( 'enabled_periods' );
                    $period  = str_replace( 'price_', '', ProSites_View_Front_Checkout::$default_period );

                    $payment_type = array(
                        'price_1'  => __( 'Monthly', 'psts' ),
                        'price_3'  => __( 'Quarterly', 'psts' ),
                        'price_12' => __( 'Annually', 'psts' ),
                    );

                    $content = '<select name="period" class="chosen" id="payment-period">';
                    if ( in_array( 1, $active_periods ) ) {
                        $content .= '<option value="1" data-period="'. $period .'"' . selected( ProSites_View_Front_Checkout::$default_period, 'price_1', false ) . '>' . esc_html( $payment_type['price_1'] ) . '</option>';
                    }
                    if ( in_array( 3, $active_periods ) ) {
                        $content .= '<option value="3" ' . selected( ProSites_View_Front_Checkout::$default_period, 'price_3', false ) . '>' . esc_html( $payment_type['price_3'] ) . '</option>';
                    }
                    if ( in_array( 12, $active_periods ) ) {
                        $content .= '<option value="12" ' . selected( ProSites_View_Front_Checkout::$default_period, 'price_12', false ) . '>' . esc_html( $payment_type['price_12'] ) . '</option>';
                    }
                    $content .= '</select>';
                    echo $content;
                ?>

            </td>
        </tr>
        <tr class="form-field form-required">
				<th scope="row"><label for="levels"><?php _e( 'Academy Plan (Pro-sites Pacakage)' ); ?></label></th>
				<td>
                    <?php
                        $features_table_enabled = $ProSitesdomain->get_setting( 'comparison_table_enabled' );
                        $columns  = ProSites_View_Front_Checkout::get_pricing_columns( true, $features_table_enabled );
                        $level    = ProSites_View_Front_Checkout::$selected_level;
                        $bodyContent  = '<select name="level" id="levels" data-level="'. $level .'">';
                        //$bodyContent .= '<option class="title">Pro-sites Pacakage</option>';
                        foreach ($columns as $column){
                            if(!empty($column['title']))
                            $bodyContent .= '<option value="'. $column['level_id'] .'" id="'. $column['level_id'] .'" class="title">' . ProSites::filter_html( $column['title'] ) . '</option>';
                        }
                        $bodyContent .= '</select>';
                        echo $bodyContent;
                    ?>
				</td>
         </tr>

        <tr class="form-field form-required">
			<th scope="row"><label for="blog-domain"><?php _e( 'Custom Domain' ) ?></label></th>
			<td><input name="blog[custom-domain]" type="text" class="regular-text" id="blog-domain" /></td>
		</tr>
		<tr class="form-field form-required">
			<th scope="row"><label for="admin-email"><?php _e( 'Admin Email' ) ?></label></th>
			<td>
                <input name="blog[email]" type="email" class="regular-text wp-suggest-user" id="admin-email" data-autocomplete-type="search" data-autocomplete-field="user_email" />
            </td>
		</tr>
		<tr class="form-field">
			<td colspan="2"><?php _e( 'A new user will be created if the above email address is not in the database.' ) ?><br /><?php _e( 'The username and a link to set the password will be mailed to this email address.' ) ?></td>
		</tr>


	</table>
    <?php
        submit_button( __( 'Add Site' ), 'primary', 'add-site' );
        do_action( 'network_site_new_form');
    ?>

	</form>
    <?php

    function my_network_admin_notices() {
        echo '<div class="notice notice-success is-dismissible"><p>This is the Success Message</p></div>';
    }
    ?>
</div>
<?php

//require( ABSPATH . 'wp-admin/admin-footer.php' );

