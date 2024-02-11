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

	<!-- search area -->
	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<h3>Search For:</h3>
							<input type="text" placeholder="Keywords">
							<button type="submit">Search <i class="fas fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end search arewa -->
	
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

<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>