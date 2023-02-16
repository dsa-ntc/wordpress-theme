<?php get_header();
/*
Template Name: Default Template (wide post)
*/

the_post();
?>
	<main id="maincontent" class="container">
    <div class="row">
      <div class="col-12 text-center mt-5 mb-4">
				<?php
					$icon = get_post_meta(get_the_ID(), 'icon')[0];
					if (empty($icon)){
						$icon = 'rose';
					}
				?>
				<img class="header-icon" src="<?php echo svg_url($icon) ?>" />
      </div>
      <div class="col-12 text-center mb-4">
        <h1 class="header-title m-0"><?php the_title(); ?></h1>
      </div>
			<hr class="fullwidth"/>
    </div>
		<div class="row">
			<div class="col">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php the_content(); ?>
				</article>
			</div>
    </div>
</main>

<?php get_footer(); ?>
