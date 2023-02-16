<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<script>
		FontAwesomeConfig = { searchPseudoElements: true };
	</script>
	<?php $stylesheetdirectory = get_stylesheet_directory_uri(); ?>
	<link href="//www.google-analytics.com" rel="dns-prefetch">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php bloginfo('description'); ?>">

	<?php wp_head(); ?>
	
	<!-- Android Styling -->
	<meta name="theme-color" content="#ea2127">
	<link rel="manifest" href="<?= $stylesheetdirectory; ?>/img/manifest.json">
	<!-- /Device-specific Styling -->
</head>
<body <?php body_class(); ?>>
<div id="pagewrap">
<header id="campaignheader" role="banner">
	<div>
		<a href="/"><i class="fas fa-arrow-circle-left"></i>Return to dsausa.org</a>
	</div>
</header>