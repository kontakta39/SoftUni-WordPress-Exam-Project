<?php get_header(); ?>

<!-- hero area -->
<div class="hero-area hero-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 offset-lg-2 text-center">
                <div class="hero-text">
                    <div class="hero-text-tablecell">
                        <h1><?php bloginfo('name'); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->

<!-- latest news -->
<div class="latest-news pt-150 pb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">  
                    <h3><span class="orange-text">Our</span> Latest Posts</h3>
                </div>
            </div>
        </div>

        <div class="cxc-post-wrapper">
            <div id="cxc-posts" class="cxc-posts">
			<?php
                $args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => 3,
                    'post_status'    => 'publish',
                    'date_query'     => array(
                        array(
                            'year' => 2024,
                        ),
                    ),
                );

                $fruitkha_index_query = new WP_Query( $args );
            ?>
              
        <?php if ( $fruitkha_index_query->have_posts() ) : ?>
		    <div class="row">
			  <?php while( $fruitkha_index_query->have_posts() ) : $fruitkha_index_query->the_post(); ?>
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
											$post_id = $post->ID;
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
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	<?php endif; ?>

			<div class="row">
				<div class="col-lg-12 text-center">
                    </br> 
                    <button type="button" id="codex-load-more" class="codex-load-more" data-page="2" style="font-family: 'Poppins', sans-serif; display: inline-block; background-color: #F28123; color: #fff; padding: 10px 20px; border: none; border-radius: 50px; transition: background-color 0.3s, color 0.3s;" onmouseover="this.style.backgroundColor='#051922'; this.style.color='#F28123';" onmouseout="this.style.backgroundColor='#F28123'; this.style.color='#fff';">
                        Load More</button>
				</div>
			</div>
		</div>
	</div>
	<!-- end latest news -->
    </div>
</div>

<?php
// Retrieve all users except administrators
$users = get_users(array('role__not_in' => array('administrator')));

// Check if there are users
if (count($users) > 0) {
    echo "<div class='testimonial-section'>";
    echo "<div class='container'>";
    echo "<div class='row'>";
    echo "<div class='col-lg-10 offset-lg-1 text-center'>";
    echo "<div class='testimonial-sliders'>";
    
    // Display each user's information
    foreach ($users as $user) {
        // Get user roles
        $user_roles = $user->roles;
        
        echo "<div class='single-testimonial-slider'>";
        echo "<div class='client-avater'>";
        echo get_avatar($user->ID, 96); // Adjust the size as needed
        echo "</div>";
        echo "<div class='client-meta'>";
        echo "<h3>" . $user->display_name . "</h3>";
        echo "<span>" . implode(", ", $user_roles) . "</span>";
        echo "<p class='testimonial-body'>";
        echo "\"Sed ut perspiciatis unde omnis iste natus error veritatis et  quasi architecto beatae vitae dict eaque ipsa quae ab illo inventore Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium\"";
        echo "</p>";
        echo "<div class='last-icon'>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
    
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} else {
    echo "No users found.";
}
?>

<!-- logo carousel -->
<div class="logo-carousel-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="logo-carousel-inner">
                    <div class="single-logo-item">
                        <img src="<?php echo FRUITKHA_ASSETS_URL; ?>/img/company-logos/1.png" alt="">
                    </div>
                    <div class="single-logo-item">
                        <img src="<?php echo FRUITKHA_ASSETS_URL; ?>/img/company-logos/2.png" alt="">
                    </div>
                    <div class="single-logo-item">
                        <img src="<?php echo FRUITKHA_ASSETS_URL; ?>/img/company-logos/3.png" alt="">
                    </div>
                    <div class="single-logo-item">
                        <img src="<?php echo FRUITKHA_ASSETS_URL; ?>/img/company-logos/4.png" alt="">
                    </div>
                    <div class="single-logo-item">
                        <img src="<?php echo FRUITKHA_ASSETS_URL; ?>/img/company-logos/5.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end logo carousel -->

<?php get_footer(); ?>
