<!DOCTYPE html>
<html lang= <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo ( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>

	<!-- title -->
	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="<?php echo FRUITKHA_ASSETS_URL; ?>/img/favicon.png">

	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">

</head>
<body <?php body_class(); ?>>
	
	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap" id ="nav-bar">
						<!-- logo -->
						<div class="site-logo">
							<a href="<?php echo home_url(); ?>">
								<img src="<?php echo FRUITKHA_ASSETS_URL; ?>/img/logo.png" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul class="ul-nav-bar">
								<li>
									<?php
										if ( has_nav_menu( 'header-menu' ) ) { 
											wp_nav_menu( $args = array(
												'menu'				=> "nav-bar", // (int|string|WP_Term) Desired menu. Accepts a menu ID, slug, name, or object.
												'menu_class'		=> "ul-nav-bar", // (string) CSS class to use for the ul element which forms the menu. Default 'menu'.
												'menu_id'			=> "nav-bar-id", // (string) The ID that is applied to the ul element which forms the menu. Default is the menu slug, incremented.
												'container'			=> "ul", // (string) Whether to wrap the ul, and what to wrap it with. Default 'div'.
												'container_class'	=> "main-menu-wrap", // (string) Class that is applied to the container. Default 'menu-{menu slug}-container'.
												'container_id'		=> "nav-bar", // (string) The ID that is applied to the container.
												'theme_location'	=> "header-menu", // (string) Theme location to be used. Must be registered with register_nav_menu() in order to be selectable by the user.
											) ); 
										}
									?>
								</li>
								<li>
									<div class="header-icons">
										<a class="mobile-hide search-bar-icon" href="#"></a>
									</div>
								</li>
							</ul>
						</nav>

						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->

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
<!-- end search area -->