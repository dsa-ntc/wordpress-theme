<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<!--  @TODO: remove inline styles!!! -->
	<!--  @TODO: thumbnails ==>left -->

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="margin-bottom:2em;">
		<div style="line-height: 16px;font-size: 12px;color: #241F20;"><?php the_time('F j, Y'); ?></div>
		<h2 style="margin-top:.25em;">
			<a style="line-height: 28px;font-size: 20px;text-decoration-line: underline;color: #241F20;" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</h2>

		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
			<div class="row">
				<div class="thumbnail d-none d-md-block col-12 col-md-4">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( [150, 150] ); // Declare pixel size you need inside the array ?></a>
				</div>
				<div class="content col-12 col-md-8" style="line-height: 22px;font-size: 16px;">
					<?php the_excerpt() ?>
				</div>
			</div>
		<?php else : ?>
			<div class="row">
				<div class="content col" style="line-height: 22px;font-size: 16px;">
					<?php the_excerpt() ?>
				</div>
			</div>
		<?php endif ?>
		<hr class="fullwidth"/>
	</article>

<?php endwhile; ?>

	<div class="pagination text-center text-2xl space-top-2x">
	<?php posts_nav_link( ' ', '<span class="space-sides-3x"><i class="far fa-arrow-circle-left"></i> Previous<span>', '<span class="space-sides-3x">Next <i class="far fa-arrow-circle-right"></i><span>' ); ?>
		<!--<div class="nav-previous alignleft"><?php next_posts_link( 'Older content' ); ?></div>
		<div class="nav-next alignright"><?php previous_posts_link( 'Newer content' ); ?></div>-->
	</div>

<?php else: ?>
	<article>
		<h2>Sorry, nothing to display.</h2>
	</article>
<?php endif; ?>
