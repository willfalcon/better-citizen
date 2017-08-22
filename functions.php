<?php


add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );
add_theme_support( 'custom-logo' );

function gc_theme_styles() {
  wp_enqueue_style( 'boostrap_css', get_template_directory_uri() . '/css/bootstrap.css' );
  wp_enqueue_style( 'google_fonts', 'https://fonts.googleapis.com/css?family=Oxygen' );
  wp_enqueue_style( 'main_styles', get_template_directory_uri() . '/style.css' );
}

function gc_theme_scripts() {
  wp_enqueue_script( 'popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js', '', '', false );
  wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/js/bootstrap.js', array(jquery, popper), '', true );
  wp_enqueue_script( 'fontawesome', 'https://use.fontawesome.com/47a6454e70.js' );
  wp_enqueue_script( 'gc_js', get_template_directory_uri() . '/js/gc.js', array(jquery), '', true );
}

add_action( 'wp_enqueue_scripts', 'gc_theme_styles' );
add_action( 'wp_enqueue_scripts', 'gc_theme_scripts' );



function register_theme_menus() {

	register_nav_menus(
		array(
			'primary-menu' 	=> __( 'Primary Menu', 'goodcitizen-main' ),
      'secondary-menu' => __( 'Secondary Menu', 'goodcitizen-secondary' )
		)
	);

}
add_action( 'init', 'register_theme_menus' );


function gc_nav_class($classes, $item){
    $classes[] = 'nav-item';
    return $classes;
}
add_filter('nav_menu_css_class' , 'gc_nav_class' , 10 , 2);


//remove breadcrumbs on shop page
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
//remove catalog ording option on shop page
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

//adjust product title output on shop page. (add .gc-product-title)
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
function gc_template_loop_product_title() {
  echo '<h4 class="woocommerce-loop-product__title gc-product-title">' . get_the_title() . '</h4>';
}
add_action( 'woocommerce_shop_loop_item_title', 'gc_template_loop_product_title', 10 );

//adjust add to cart button output
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
if ( ! function_exists( 'gc_template_loop_add_to_cart' ) ) {

	/**
	 * Get the add to cart template for the loop.
	 *
	 * @subpackage    Loop
	 *
	 * @param array $args
	 */
	function gc_template_loop_add_to_cart( $args = array() ) {
		global $product;

		if ( $product ) {
			$defaults = array(
				'quantity' => 1,
				'class'    => implode( ' ', array_filter( array(
						'btn btn-outline-secondary gc-add-to-cart',
						'product_type_' . $product->get_type(),
						$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
						$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
				) ) ),
			);

			$args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

			wc_get_template( 'loop/add-to-cart.php', $args );
		}
	}
}
add_action( 'woocommerce_after_shop_loop_item', 'gc_template_loop_add_to_cart', 10 );
 ?>
