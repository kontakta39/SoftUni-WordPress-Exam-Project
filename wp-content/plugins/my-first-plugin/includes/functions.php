<?php
function fruitkha_plugin_enqueue_assets() {
    $args = array();
    wp_enqueue_script(
        'robots-assets-plugin',
        FRUITKHA_PLUGIN_ASSETS_DIR . '/js/custom.js',
        array( 'jquery' ), 
        '1.1', 
        $args
    );
}

add_action( 'wp_enqueue_scripts', 'fruitkha_plugin_enqueue_assets' );

//AJAX
function cxc_theme_enqueue_script_style() {

	wp_enqueue_script( 'custom-script', get_template_directory_uri(). '/js/custom.js', array('jquery') );
	// Localize the script with new data
	wp_localize_script( 'custom-script', 'ajax_posts', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'noposts' => __( 'No older posts found', 'cxc-codexcoach' ),
	));

}

add_action( 'wp_enqueue_scripts', 'cxc_theme_enqueue_script_style' );

function codex_load_more_post_ajax_call_back(){

	$posts_per_page = ( isset( $_POST["posts_per_page"] ) ) ? $_POST["posts_per_page"] : 3;
	$page = ( isset( $_POST['pageNumber'] ) ) ? $_POST['pageNumber'] : 1;

	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => $posts_per_page,
		'post_status'    => 'publish',
		'paged'          => $page,
		'date_query'     => array(
			array(
				'year' => 2024,
			),
		),
	);

	$the_query = new WP_Query( $args );

	$html = '';
	ob_start();

    if ( $the_query->have_posts() ) :
        echo '<div class="row">';
        while( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="col-lg-4 col-md-6">
                <div class="single-latest-news">
                    <?php $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>
                    <div class="latest-news-bg" style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');"></div>
                        <div class="news-text-box">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p class="blog-meta">
                                <span class="author"><i class="fas fa-user"></i>
                                    <?php
                                        global $wpdb;
                                        $admin_user_id = $wpdb->get_var( "SELECT user_id FROM {$wpdb->usermeta} WHERE meta_key='wp_capabilities' AND meta_value LIKE '%administrator%' LIMIT 1" );
                                        
                                        // Get admin user data
                                        $admin_user = get_userdata($admin_user_id);
                                        
                                        if($admin_user) {
                                            // Admin username
                                            $admin_username = $admin_user->user_login;
                                            echo $admin_username;
                                        } else {
                                            echo "Admin user not found!";
                                        }
                                    ?>
                                </span>
                                <span class="date"><i class="fas fa-calendar"></i>
                                    <?php
                                        $post_id = get_the_ID();
                                        $post_date = get_the_date('j F Y', $post_id);
                                        echo $post_date;
                                    ?>
                                </span>
                            </p>
                            <p class="excerpt">
                                <?php
                                    // Call the function to get the first sentence of the current post
                                    $first_sentence_with_dot = get_first_sentence_of_post();

                                    // Output the first sentence
                                    echo $first_sentence_with_dot;
                                ?>
                            </p>
                            <a href="<?php the_permalink(); ?>" class="read-more-btn">Read More <i class="fas fa-angle-right"></i></a>
                        </div>
                    </div>
            </div>
        <?php endwhile;
        echo '</div>';
    endif;

	wp_reset_postdata();
	$html .= ob_get_clean();

	wp_send_json( array( 'html' => $html ) );
}

add_action( 'wp_ajax_nopriv_codex_load_more_post_ajax', 'codex_load_more_post_ajax_call_back' );
add_action( 'wp_ajax_codex_load_more_post_ajax', 'codex_load_more_post_ajax_call_back' );