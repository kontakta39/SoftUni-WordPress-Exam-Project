<?php

//enqueue styles and scripts
if ( ! defined( 'FRUITKHA_ASSETS_VERSION' ) ) {
    define( 'FRUITKHA_ASSETS_VERSION', '0.1' );
}

if ( ! defined( 'FRUITKHA_ASSETS_URL' ) ) {
    define( 'FRUITKHA_ASSETS_URL', get_template_directory_uri() . '/assets/' );
}

add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );

 /* Function that enqueue all of our assets
 *
 * @return void
 */
function fruitkha_enqueue_assets() {

    //Theme Styles
    //<!-- fontawesome -->
    wp_enqueue_style( 'all.min', FRUITKHA_ASSETS_URL . '/css/all.min.css', array(), FRUITKHA_ASSETS_VERSION );
	//<!-- bootstrap -->
    wp_enqueue_style( 'bootstrap.min', FRUITKHA_ASSETS_URL . 'bootstrap/css/bootstrap.min.css', array(), FRUITKHA_ASSETS_VERSION );
	//<!-- owl carousel -->
    wp_enqueue_style( 'owl.carousel', FRUITKHA_ASSETS_URL . '/css/owl.carousel.css', array(), FRUITKHA_ASSETS_VERSION );
	//<!-- magnific popup -->
    wp_enqueue_style( 'magnific-popup', FRUITKHA_ASSETS_URL . '/css/magnific-popup.css', array(), FRUITKHA_ASSETS_VERSION );
	//<!-- animate css -->
    wp_enqueue_style( 'animate', FRUITKHA_ASSETS_URL . '/css/animate.css', array(), FRUITKHA_ASSETS_VERSION );
	//<!-- mean menu css -->
    wp_enqueue_style( 'meanmenu.min', FRUITKHA_ASSETS_URL . '/css/meanmenu.min.css', array(), FRUITKHA_ASSETS_VERSION );
	//<!-- main style -->
    wp_enqueue_style( 'main', FRUITKHA_ASSETS_URL . '/css/main.css', array(), FRUITKHA_ASSETS_VERSION );
	//<!-- responsive -->
    wp_enqueue_style( 'responsive', FRUITKHA_ASSETS_URL . '/css/responsive.css', array(), FRUITKHA_ASSETS_VERSION );
	
    //Theme Scripts
    //<!-- jquery -->
    wp_enqueue_script( 'jquery-1.11.3.min', FRUITKHA_ASSETS_URL . '/js/jquery-1.11.3.min.js', array( 'jquery' ), FRUITKHA_ASSETS_VERSION, array() );
	//<!-- bootstrap -->
    wp_enqueue_script( 'bootstrap.min', FRUITKHA_ASSETS_URL . '/bootstrap/js/bootstrap.min.js"', array( 'jquery' ), FRUITKHA_ASSETS_VERSION, array() );
	//<!-- count down -->
    wp_enqueue_script( 'jquery.countdown', FRUITKHA_ASSETS_URL . '/js/jquery.countdown.js"', array( 'jquery' ), FRUITKHA_ASSETS_VERSION, array() );
	//<!-- isotope -->
    wp_enqueue_script( 'jquery.isotope-3.0.6.min', FRUITKHA_ASSETS_URL . '/js/jquery.isotope-3.0.6.min.js"', array( 'jquery' ), FRUITKHA_ASSETS_VERSION, array() );
	//<!-- waypoints -->
    wp_enqueue_script( 'waypoints', FRUITKHA_ASSETS_URL . '/js/waypoints.js"', array( 'jquery' ), FRUITKHA_ASSETS_VERSION, array() );
	//<!-- owl carousel -->
    wp_enqueue_script( 'owl.carousel.min', FRUITKHA_ASSETS_URL . '/js/owl.carousel.min.js"', array( 'jquery' ), FRUITKHA_ASSETS_VERSION, array() );
	//<!-- magnific popup -->
    wp_enqueue_script( 'jquery.magnific-popup.min', FRUITKHA_ASSETS_URL . '/js/jquery.magnific-popup.min.js"', array( 'jquery' ), FRUITKHA_ASSETS_VERSION, array() );
	//<!-- mean menu -->
    wp_enqueue_script( 'jquery.meanmenu.min', FRUITKHA_ASSETS_URL . '/js/jquery.meanmenu.min.js"', array( 'jquery' ), FRUITKHA_ASSETS_VERSION, array() );
	//<!-- sticker js -->
    wp_enqueue_script( 'sticker', FRUITKHA_ASSETS_URL . '/js/sticker.js"', array( 'jquery' ), FRUITKHA_ASSETS_VERSION, array() );
	//<!-- main js -->
    wp_enqueue_script( 'main', FRUITKHA_ASSETS_URL . '/js/main.js"', array( 'jquery' ), FRUITKHA_ASSETS_VERSION, array() );
}
add_action( 'wp_enqueue_scripts', 'fruitkha_enqueue_assets' );

 /* Register menus
 *
 * @return void
 */
function fruitkha_my_menus() {
    register_nav_menus(
      array(
        'header-menu' => __( 'Header Menu' ),
       )
     );
   }
   add_action( 'init', 'fruitkha_my_menus' );

// Hook to redirect from the archive page to current post
add_action( 'template_redirect', 'redirect_to_single_post' );
function redirect_to_single_post() {
    // Check if we're on an archive page
    if ( is_archive() ) {
        // Get the queried object
        $queried_object = get_queried_object();
        
        // Check if the queried object is a post object
        if ( $queried_object instanceof WP_Post ) {
            // Get the current post object
            $post = $queried_object;
            
            // Get the permalink of the current post
            $permalink = get_permalink( $post );
            
            // Redirect to the current post permalink
            wp_redirect( $permalink, 301 );
            exit;
        }
    }
}   

//Display the first sentence of a post in the archive page
function get_first_sentence_of_post($post_id = null) {
    if (!$post_id) {
        global $post;
        $post_id = $post->ID;
    }
    $content = get_post_field('post_content', $post_id);
    $first_sentence = strtok($content, '.');
    $first_sentence_with_dot = wp_strip_all_tags($first_sentence) . '.';
    return $first_sentence_with_dot;
}
