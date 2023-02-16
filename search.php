<?php get_header(); ?>
	<main role="main">
		<section id="maincontent">
			<h1><?php echo sprintf('%s Search Results for ', $wp_query->found_posts ); echo get_search_query(); ?></h1>
			<?php get_template_part('loop'); ?>
			<?php get_template_part('pagination'); ?>
		</section><!-- .maincontent -->
		<?php get_sidebar(); ?>
	</main>
<?php get_footer(); ?>
