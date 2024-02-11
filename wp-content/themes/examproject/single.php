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
						<h1>Single Post</h1>
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
							<div class="single-artcile-bg"></div>
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
									$current_date = date_i18n( 'j F Y' ); // Retrieves the current date in the format Month Day, Year
									echo $current_date;
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
								<li><a href="single-news.html">You will vainly look for fruit on it in autumn.</a></li>
								<li><a href="single-news.html">A man's worth has its season, like tomato.</a></li>
								<li><a href="single-news.html">Good thoughts bear good fresh juicy fruit.</a></li>
								<li><a href="single-news.html">Fall in love with the fresh orange</a></li>
								<li><a href="single-news.html">Why the berries always look delecious</a></li>
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