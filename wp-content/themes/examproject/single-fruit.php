<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

	<?php while( have_posts() ) : the_post(); ?>
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Read the Details</p>
						<h1>Single Fruit</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->
	
	<!-- single article section -->
	<div class="mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="single-article-section">
						<div class="single-article-text">
						<?php
							// Get the post thumbnail URL
							$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
						?>
							<div class="single-artcile-bg" style="background-image: url('<?php echo esc_url($thumbnail_url); ?>'); height: 450px;"></div>
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
										$page_id = get_the_ID(); // Get the current page ID
										$page_date = get_the_date('j F Y', $page_id);
										echo $page_date;
									?>
								</span>
							</p></br>
							<h2><?php the_title(); ?></h2></br>
							<div><?php the_content(); ?></div>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="sidebar-section">
						<div class="recent-posts">
							<h4>Recent Posts</h4>
							<ul>
								<?php
								$recent_posts = wp_get_recent_posts(array(
									'numberposts' => 5, // Number of posts to display
									'orderby' => 'post_date', // Order by date
									'order' => 'DESC', // Show latest posts first
								));

								foreach ($recent_posts as $post) : ?>
									<li><a href="<?php echo get_permalink($post['ID']); ?>"><?php echo $post['post_title']; ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="archive-posts">
							<h4>Archive Posts</h4>
							<ul>
								<li>
								<?php
									$args = array(
										'type' => 'yearly',
										'format' => 'html',
										'show_post_count' => true, // Set to false if you don't want to display post count
									);
									wp_get_archives($args);
									?>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end single article section -->
	<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>