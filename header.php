<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script>
			FontAwesomeConfig = { searchPseudoElements: true };
		</script>
		<?php $stylesheetdirectory = get_stylesheet_directory_uri(); ?>
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<?php wp_head(); ?>
		<!-- Android Styling -->
		<meta name="theme-color" content="#ec1f27">
		<link rel="manifest" href="<?= $stylesheetdirectory; ?>/img/manifest.json">
		<!-- /Device-specific Styling -->
		<?php if ( get_theme_mod('ganalytics_id', false) ) : ?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo get_theme_mod('ganalytics_id'); ?>"></script>
		<script>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', '<?php echo get_theme_mod('ganalytics_id'); ?>');</script>
		<?php endif; ?>
		<?php if ( get_theme_mod('gsearch_key', false) ) : ?>
		<meta name="google-site-verification" content="<?php echo get_theme_mod('gsearch_key', false); ?>" />
		<?php endif; ?>
	</head>
	<body <?php body_class(); ?>>
    <div class="bg-white">
		<header id="pageheader" class="container" role="banner">
			<div class="row py-3 align-items-center">
				<div class="col-6 col-sm-5">
					<div class="row justify-content-center justify-content-sm-start px-0">
						<a class="navbar-brand ml-sm-4" href="<?php echo home_url(); ?>">
							<div class="row">
									<img class="header-logo" src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>">
									<div style="padding-top: 2px">
									    <span class="header-logo-text">Democratic <br/>Socialists of<br/> America</span>
								    </div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-6 col-sm-7">
					<div class="row align-items-center justify-content-center justify-content-sm-end pl-0 pr-sm-3">
						<div class="p-0">
							<a class="btn btn-red header-cta-btn" href="https://dsausa.org/join">
								Join Us
							</a>
						</div>
						<div class="p-0 mx-3 d-none d-sm-block">
							<a class="btn btn-outline-dark" href="https://dsausa.org/donate">
								Donate
							</a>
						</div>
						<div class="ml-3 mr-md-4 d-none d-sm-block">
							<div class="row">
								<a href="https://www.facebook.com/DemSocialists" target="_blank">
									<img class="social-icon" src="<?php echo svg_url("facebook") ?>" />
								</a>
							</div>
							<div class="row mt-1">
								<a href="https://www.twitter.com/DemSocialists" target="_blank">
									<img class="social-icon" src="<?php echo svg_url("twitter") ?>" />
								</a>
							</div>
						</div>
						<div class="ml-2 ml-xs-3 d-md-none navbar-light">
							<button class="navbar-toggler" id="mobile-navbar-toggler" type="button" data-target="#mobile-navbar" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
						</div>
					</div>
				</div>
			</div>
    </header>
  </div>
  <div class="bg-dsalitegrey">
    <header class="container headercontent">
				<nav class="mt-0 collapse d-sm-none collapse col-10 position-fixed h-100" id="mobile-navbar" style="top: 0; right: -100%; padding: 0.5rem; z-index: 1000; background-color: white">
					<div class="container-fluid d-flex flex-column h-100">
						<div class="row">
							<div class="col p-0">
								<button  type="button" class="btn btn-red">
									Join Us
								</button>
							</div>
							<div class="col p-0 ml-3">
								<button type="button" class="btn btn-outline-dark">
									Donate
								</button>
							</div>
							<div class="col p-0 mx-3">
								<button type="button" class="close" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
						<div class="row justify-content-start pl-3">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'header-menu', // Defined when registering the menu
								'menu_id'        => 'mobile-menu',
								'container'      => false,
								'depth'          => 2,
								'menu_class'     => 'navbar-nav',
								'walker'         => new Bootstrap_NavWalker(), // This controls the display of the Bootstrap Navbar
								'fallback_cb'    => 'Bootstrap_NavWalker::fallback', // For menu fallback
							) );
						?>
						</div>
						<div class="row mt-2">
							<div class="col flex-grow-0">
								<a href="https://www.facebook.com/DemSocialists" target="_blank">
									<img class="social-icon-2x" src="<?php echo svg_url("facebook") ?>" />
								</a>
							</div>
							<div class="col flex-grow-0">
								<a href="https://www.twitter.com/DemSocialists" target="_blank">
									<img class="social-icon-2x" src="<?php echo svg_url("twitter") ?>" />
								</a>
							</div>
						</div>
					</div>
				</nav>
      <div class="row">
        <div class="col px-0">
  				<nav class="navbar navbar-expand-md d-none d-md-block">
  					<div class="navbar-light text-center">
  						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
  					    <span class="navbar-toggler-icon"></span>
  					  </button>
  					</div>

  				  <div class="collapse navbar-collapse m-0" id="navbarTogglerDemo01">
  							<?php
  			        wp_nav_menu( array(
  			            'theme_location' => 'header-menu', // Defined when registering the menu
  			            'menu_id'        => 'primary-menu',
  			            'container'      => false,
  			            'depth'          => 2,
  			            'menu_class'     => 'navbar-nav mx-auto',
  			            'walker'         => new Bootstrap_NavWalker(), // This controls the display of the Bootstrap Navbar
  			            'fallback_cb'    => 'Bootstrap_NavWalker::fallback', // For menu fallback
  			        ) );
  			        ?>
  				  </div>
  				</nav><!-- /nav -->
        </div>
      </div>
		</header><!-- /header -->
  </div>
