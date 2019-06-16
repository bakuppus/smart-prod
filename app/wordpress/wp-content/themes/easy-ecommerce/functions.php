<?php

/**
 * [easy_ecommerce_enqueue_style description]
 * @return [type] [description]
 */
function easy_ecommerce_enqueue_style() {
	// Parent theme CSS.
    wp_enqueue_style( 'di-responsive-style-default', get_template_directory_uri() . '/style.css' );

    // Easy eCommerce css files.
    wp_enqueue_style( 'easy-ecommerce-style',  get_stylesheet_directory_uri() . '/style.css', array( 'bootstrap', 'font-awesome', 'di-responsive-style-default', 'di-responsive-style-core' ), wp_get_theme()->get('Version'), 'all' );
}
add_action( 'wp_enqueue_scripts', 'easy_ecommerce_enqueue_style' );


/**
 * [easy_ecommerce_plugins description]
 * @return [type] [description]
 */
function easy_ecommerce_plugins() {

	$plugins = array(
		array(
			'name'      => __( 'WooCommerce PDF Invoices & Packing Slips', 'easy-ecommerce'),
			'slug'      => 'woocommerce-pdf-invoices-packing-slips',
			'required'  => false,
		),
	);

	tgmpa( $plugins );
}
add_action( 'tgmpa_register', 'easy_ecommerce_plugins' );

/**
 * [easy_ecommerce_woo_options description]
 * @return [type] [description]
 */
function easy_ecommerce_woo_options() {
	Kirki::add_field( 'di_responsive_config', array(
		'type'			 => 'select',
		'settings'		=> 'woo_product_img_effect',
		'label'			=> __( 'Product Image Effect', 'easy-ecommerce' ),
		'description'	=> __( 'Product image effect on shop page', 'easy-ecommerce' ),
		'section'		=> 'woocommerce_options',
		'default'		=> 'zoomin',
		'priority'		=> 10,
		'choices'		=> array(
			'none'			=> esc_attr__( 'None', 'easy-ecommerce' ),
			'zoomin'		=> esc_attr__( 'Zoom In', 'easy-ecommerce' ),
			'zoomout'		=> esc_attr__( 'Zoom Out', 'easy-ecommerce' ),
			'rotate'		=> esc_attr__( 'Rotate', 'easy-ecommerce' ),
			'blur'			=> esc_attr__( 'Blur', 'easy-ecommerce' ),
			'grayscale'		=> esc_attr__( 'Gray Scale', 'easy-ecommerce' ),
			'sepia'			=> esc_attr__( 'Sepia', 'easy-ecommerce' ),
			'opacity'		=> esc_attr__( 'Opacity', 'easy-ecommerce' ),
			'flash'			=> esc_attr__( 'Flash', 'easy-ecommerce' ),
			'shine'			=> esc_attr__( 'Shine', 'easy-ecommerce' ),
		),
	) );
}
add_action( 'di_responsive_woo_options', 'easy_ecommerce_woo_options' );

/**
 * [easy_commerce_product_img_effec_css description]
 * @return [type] [description]
 */
function easy_commerce_product_img_effec_css() {
	$custom_css = "";
	$effect = get_theme_mod( 'woo_product_img_effect', 'zoomin' );
	if( $effect == 'zoomin' ) {
		$custom_css .= "
		.woocommerce ul.products li.product a img {
			-webkit-transition: opacity 0.5s ease, transform 0.5s ease;
			transition: opacity 0.5s ease, transform 0.5s ease;
		}

		.woocommerce ul.products li.product:hover a img {
			opacity: 0.9;
			transform: scale(1.1);
		}
		";
	} elseif( $effect == 'zoomout' ) {
		$custom_css .= "
		.woocommerce ul.products li.product a img {
			-webkit-transition: opacity 0.5s ease, transform 0.5s ease;
			transition: opacity 0.5s ease, transform 0.5s ease;
		}

		.woocommerce ul.products li.product a img {
			opacity: 0.9;
			transform: scale(1.1);
		}

		.woocommerce ul.products li.product:hover a img {
			opacity: 0.9;
			transform: scale(1);
		}
		";
	} elseif( $effect == 'rotate' ) {
		$custom_css .= "
		.woocommerce ul.products li.product a img {
			-webkit-transition: transform 0s ease;
			transition: transform 0s ease;
		}
		.woocommerce ul.products li.product:hover a img {
			-webkit-transition: transform 0.7s ease;
			transition: transform 0.7s ease;
		}
		.woocommerce ul.products li.product:hover img {
			-ms-transform: rotate(360deg);
			-webkit-transform: rotate(360deg);
			transform: rotate(360deg);
		}
		";
	} elseif( $effect == 'blur' ) {
		$custom_css .= "
		.woocommerce ul.products li.product img {
			-webkit-filter: blur(3px);
			filter: blur(3px);
			-webkit-transition: .3s ease-in-out;
			transition: .3s ease-in-out;
		}

		.woocommerce ul.products li.product:hover img {
			-webkit-filter: blur(0px);
			filter: blur(0px);
		}
		";
	} elseif( $effect == 'grayscale' ) {
		$custom_css .= "
		.woocommerce ul.products li.product img {
			-webkit-filter: grayscale(100%);
			filter: grayscale(100%);
			-webkit-transition: .3s ease-in-out;
			transition: .3s ease-in-out;
		}

		.woocommerce ul.products li.product:hover img {
			-webkit-filter: grayscale(0%);
			filter: grayscale(0%);
		}
		";
	} elseif( $effect == 'sepia' ) {
		$custom_css .= "
		.woocommerce ul.products li.product img {
			-webkit-filter: sepia(100%);
			filter: sepia(100%);
			-webkit-transition: .3s ease-in-out;
			transition: .3s ease-in-out;
		}

		.woocommerce ul.products li.product:hover img {
			-webkit-filter: sepia(0%);
			filter: sepia(0%);
		}
		";
	} elseif( $effect == 'opacity' ) {
		$custom_css .= "
		.woocommerce ul.products li.product a img {
			-webkit-transition: opacity 0.5s ease;
			transition: opacity 0.5s ease;
		}

		.woocommerce ul.products li.product:hover a img {
			opacity: 0.7;
		}
		";
	} elseif( $effect == 'flash' ) {
		$custom_css .= "
		.woocommerce ul.products li.product:hover a img {
			opacity: 1;
			-webkit-animation: recflash 1.5s;
			animation: recflash 1.5s;
		}
		@-webkit-keyframes recflash {
			0% {
				opacity: .4;
			}
			100% {
				opacity: 1;
			}
		}
		@keyframes recflash {
			0% {
				opacity: .4;
			}
			100% {
				opacity: 1;
			}
		}
		";
	} elseif( $effect == 'shine' ) {
		$custom_css .= "
		.woocommerce ul.products li.product::before {
			position: absolute;
			top: 0;
			left: -83%;
			z-index: 2;
			display: block;
			content: '';
			width: 50%;
			height: 100%;
			background: -webkit-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,.3) 100%);
			background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,.3) 100%);
			-webkit-transform: skewX(-25deg);
			transform: skewX(-25deg);
		}
		.woocommerce ul.products li.product:hover::before {
			-webkit-animation: recshine .75s;
			animation: recshine .75s;
		}
		@-webkit-keyframes recshine {
			100% {
				left: 125%;
			}
		}
		@keyframes recshine {
			100% {
				left: 125%;
			}
		}
		";
	} else {
		// Nothing to do.
	}
	wp_add_inline_style( 'easy-ecommerce-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'easy_commerce_product_img_effec_css' );
