<?php get_header(); ?>

<?php
$fruitkha_archive_args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 9,
    'paged' 		 => get_query_var('paged')
);

$fruitkha_archive_query = new WP_Query ( $fruitkha_archive_args );
?>
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>
						<?php
							$post_author_id = get_the_author_meta('ID'); // Get the author's ID
							$author_name = get_the_author_meta('display_name', $post_author_id); // Get the author's display name
							echo $author_name; // Display the author's name
						?>
						</p>
						<h1>Posts</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

<?php if ( $fruitkha_archive_query->have_posts() ) : ?>
	<!-- latest news -->
	<div class="latest-news mt-150 mb-150">
		<div class="container">
			<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">  
					<?php $post_author_id = get_the_author_meta('ID'); 

						// Output the user's bio
						$author_bio = get_the_author_meta('description', $post_author_id);
						if (!empty($author_bio)) {
							echo '<h4>' . $author_bio . '</h4>';
						} 
					?>
                </div>
            </div>
			  <?php while( $fruitkha_archive_query->have_posts() ) : $fruitkha_archive_query->the_post(); ?>
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
			</div>

<?php endif; ?>

			<div class="row">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-center">
							<div class="pagination-wrap">
								<ul>
									<li><?php previous_posts_link( 'Previous' ); ?></li>
									<?php if ( get_next_posts_link() ) : ?>
										<li><?php next_posts_link( 'Next' ); ?></li>
									<?php endif; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end latest news -->

<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>