<?php
	get_header();
?>
<main id="maincontent" class="container">
  <div class="row">
<?php
	// START Banner Query
	if ( get_theme_mod('show_banner', false) ):
		switch ( get_theme_mod('banner_posts', 'latest' ) ) :
			case 'featured' : // Build the query if using the "featured" tag
				$args = [
					'order' => 'rand',
					'post_type' => 'post',
					'posts_per_page' => -1,
					'tag' => 'featured'
				];
				break;
			case 'latest' : // Build the query if using the latest posts
				$args = [
					'orderby' => 'date',
					'post_type' => 'post',
					'posts_per_page' => get_theme_mod('banner_posts_latest_count', 5),
				];
				break;
			case 'cpt' :
				$args = [
					'post_type' => 'banner',
					'posts_per_page' => -1
				];
				break;
		endswitch;

		$qrybanner = new WP_Query( $args );

		if ( $qrybanner->have_posts() ) :
			$carousel = $qrybanner->post_count > 1;
?>
<section id="carouselwrap" <?php echo ( $carousel ? 'class="row swiper-container"' : '' ); ?>>
	<div id="carousel" <?php echo ( $carousel ? 'class="swiper-wrapper"' : '' ); ?>>
<?php
			while ( $qrybanner->have_posts() ) :
				$qrybanner->the_post();
				$bgimageposition = get_post_meta($post->ID, '_banner_bgimage_position', true);
				$overlayposition = get_post_meta($post->ID, '_banner_overlay_position', true);
?>
		<div class="fpbanner<?php echo ( $carousel ? ' swiper-slide' : '' );?><?php echo ( has_post_thumbnail() ? ' fpbannerbg' : '');?>" style="background-color:<?php echo get_post_meta($post->ID, '_banner_bgcolor', true); ?>;<?php echo ( has_post_thumbnail() ? 'background-image:url(' . get_the_post_thumbnail_url($post->ID, 'full') . ');background-size:' . $bgimageposition . ';' : '');?>">
<?php
				if ( get_post_meta($post->ID, '_banner_linkurl', true) ) :
?>
		<a href="<?php echo esc_url( get_post_meta($post->ID, '_banner_linkurl', true) ); ?>" class="bannerfulllink"></a>
<?php
				else :
?>
		<div class="<?php echo (has_post_format('video') ? 'bannervideo' : 'bannercontent ' . $overlayposition);?>">
			<?php
				if ( has_post_format('video') ) :
					echo strip_tags(get_the_content(), '<iframe>');
				else :
					the_content();
				endif;
			?>
		</div>
<?php
				endif;
?>
		</div><!-- .fpbanner -->
<?php
			endwhile;
?>
	</div><!-- #carousel -->
		<?php if ( $carousel ): ?>
	<div class="swiper-pagination"></div>
	<script type="text/javascript">
		$(document).ready( function() {
			var swiperCarousel = new Swiper ('.swiper-container', {
				speed: 500,
				loop: true,
				slidesPerView: 1,
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
				},
				autoplay: {
					delay: 5000,
					disableOnInteraction: true,
				},
			}
			);

			$('#carouselwrap').hover(
				function() {
					swiperCarousel.autoplay.stop();
				},
				function() {
					swiperCarousel.autoplay.start();
				}
			);

			$('#carouselwrap').click(
				function() {
					swiperCarousel.autoplay.stop();
					$(this).unbind('hover');
				}
			);
		});
	</script>
		<?php endif; ?>
</section><!-- #carouselwrap -->
</div>
<?php
		endif;
	endif; // END BANNER QUERY

	// Sub-Banner Widget Area
	if ( is_active_sidebar( 'frontpage_subbanner' ) ) :
		dynamic_sidebar( 'frontpage_subbanner' );
	endif;
	// END Sub-Banner Widget Area
?>
<?php
	$date = new DateTime(); // Used across queries in this section

	// START Announcements Query
	$args = array(
		'post_type' => 'news', // Pull posts of type "announcement"
		'posts_per_page' => 3, // Only the 3 closest to expiration will be listed
		'orderby' => 'date', // We want to organize the announcements by date
		'meta_key' => '_news_ann_expiration', // Grab the announcements' expiration date
		'order' => 'DESC',
		'meta_query' => array(
			array(
				'key' => '_news_posttype',
				'value' => 'announcement',
				'compare' => '='
			),
			array(
				'key' => '_news_ann_expiration', // Check the expiration date field
				'value' => $date->getTimestamp(),
				'compare' => '>=', // Return the ones after today's date
			)
		)
	);
	$qryannouncements = new WP_Query( $args );

	if ( $qryannouncements->have_posts() ) :
?>
			<div id="announcements">
				<h1>Announcements</h1>
<?php
		// START Announcements Loop
		while ( $qryannouncements->have_posts() ):
			$qryannouncements->the_post();
			$urgent = ( get_post_meta( $post->ID, '_news_ann_urgent', true) ? true : false );
?>
				<article class="announcement<?= $urgent ? ' urgent' : null; ?>">
					<?php if ( $urgent ) : ?>
					<div class="urgenticon">
						<i class="far fa-exclamation-circle"></i>
					</div>
					<?php endif; ?>
					<div class="announcementcontent">
						<a href="<?php the_permalink(); ?>"></a>
						<h2><?php the_title(); ?></h2>
						<div class="text-em"><?php the_date(); ?></div>
						<div><?php
							if ( get_post_meta( $post->ID, '_news_ann_showfullonfp', true ) ) :
								the_content();
							else :
								the_excerpt();
							endif; ?>
						</div>
					</div><!-- .announcementcontent -->
				</article><!-- .announcement -->
<?php
		endwhile; // END Announcements Loop
?>
			</div><!-- #announcements -->
<?php
	endif; // END Announcements Query

	// START Front Page Content Query
	$args = array(
		'post_type' => 'frontpage', // Pull posts of type "frontpage"
		'posts_per_page' => -1, // All posts will be returned
		'orderby' => 'meta_value_num', // We want to organize the content by its title (posts should be titled "1 - Actual Title" to signify the order in which to display on the home page)
		'meta_key' => "_fp_order",
		'order' => 'ASC',
	);

	$qryfpcontent = new WP_Query( $args );
	if ( $qryfpcontent->have_posts() ) :
		while ( $qryfpcontent->have_posts() ) : // START Front Page Content Loop
			$qryfpcontent->the_post();
?>
			<article class="fppost">
				<?php if (! get_post_meta( $post->ID, '_fp_hidetitle', true ) ) : ?>
				<h1><?php the_title(); ?></h1>
				<?php endif; ?>
				<?php the_content(); ?>
				<div class="clearfix"></div> <!-- stupid fix for floated images that exceed the length of the text -->
			</article><!-- .fpppost -->
			<hr class="space-vert-3x" />
<?php
		endwhile; // END Front Page Content Loop
	endif; // END Front Page Content Query

  	// START Statements Query
  	if ( get_theme_mod('show_statements', false) ) :
		// Get theme settings to see if we show statements and news or just statements
		get_theme_mod('statements_also_show_news') ? $statements_posttypes = array( 'statement', 'news' ) : $statements_posttypes = array( 'statement' );
  		$args = array(
  			'post_type' => $statements_posttypes, // Pull post type
  			'posts_per_page' => 3, // Only the 8 closest to expiration will be listed
  			'orderby' => 'date', // We want to organize the posts by date
  			'order' => 'DESC'
  		);
  		$qrystatements = new WP_Query( $args );

  		if ( $qrystatements->have_posts() ) :
  	?>
  		<section id="statements">
  		<?php if (get_theme_mod('statements_name', false)) : ?>
  			<h1 class="blogtitle"><?php echo get_theme_mod('statements_name'); ?></h1>
			<?php if (get_theme_mod('statements_subtitle', false)) : ?>
			  <p class="blogsubtitle"><?php echo get_theme_mod('statements_subtitle'); ?></p>
			<?php endif; ?>
  		<?php endif; ?>
  	<?php
  			// START Statements Loop
  			while ( $qrystatements->have_posts() ):
  				$qrystatements->the_post();
  	?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="margin-bottom:2em;">
      <div style="line-height: 16px;font-size: 12px;color: #241F20;"><?php the_time('F j, Y'); ?></div>
      <h2 style="margin-top:.25em;">
        <a style="line-height: 28px;font-size: 20px;text-decoration-line: underline;color: #241F20;" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
      </h2>

      <div class="row">
        <div class="content col" style="line-height: 22px;font-size: 16px;">
          <?php the_excerpt() ?>
        </div>
      </div>
      <br>
      <hr class="fullwidth"/>
    </article>
  	<?php
  			endwhile; // END Statements Loop

  			if ( $qrystatements->found_posts > 3 ) :
  	?>
  			<div class="text-2xl text-center space-top-1x uppercase mb-4">
  				<a href="<?php echo get_post_type_archive_link('statement'); ?>">More <?php echo get_theme_mod('statements_name', 'statements'); ?> <i class="far fa-arrow-circle-right"></i></a>
  			</div>
  <?php
  			endif;
  ?>
  		</section><!-- #blog -->
  	<?php
  		endif;
  	endif; // END Statements Query

  	// START Blog Query
  	if ( get_theme_mod('show_blog', false) ) :
  		$args = array(
  			'post_type' => array('blog'), // Pull post type
  			'posts_per_page' => 3, // Only the 8 closest to expiration will be listed
  			'orderby' => 'date', // We want to organize the posts by date
  			'order' => 'DESC'
  		);
  		$qryblog = new WP_Query( $args );

  		if ( $qryblog->have_posts() ) :
  	?>
  		<section id="blog">
  		<?php if (get_theme_mod('blog_name', false)) : ?>
  			<h1 class="blogtitle"><?php echo get_theme_mod('blog_name'); ?></h1>
			<?php if (get_theme_mod('blog_subtitle', false)) : ?>
			  <p class="blogsubtitle"><?php echo get_theme_mod('blog_subtitle'); ?></p>
			<?php endif; ?>
  		<?php endif; ?>
  	<?php
  			// START Blog Loop
  			while ( $qryblog->have_posts() ):
  				$qryblog->the_post();
  	?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="margin-bottom:2em;">
      <div style="line-height: 16px;font-size: 12px;color: #241F20;"><?php the_time('F j, Y'); ?></div>
      <h2 style="margin-top:.25em;">
        <a style="line-height: 28px;font-size: 20px;text-decoration-line: underline;color: #241F20;" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
      </h2>

      <div class="row">
        <div class="content col" style="line-height: 22px;font-size: 16px;">
          <?php the_excerpt() ?>
        </div>
      </div>
      <br>
      <hr class="fullwidth"/>
    </article>
  	<?php
  			endwhile; // END Blog Loop

  			if ( $qryblog->found_posts > 3 ) :
  	?>
  			<div class="text-2xl text-center space-top-1x uppercase mb-4">
  				<a href="<?php echo get_post_type_archive_link('blog'); ?>">More <?php echo get_theme_mod('blog_name', 'blog entries'); ?> <i class="far fa-arrow-circle-right"></i></a>
  			</div>
  <?php
  			endif;
  ?>
  		</section><!-- #blog -->
  	<?php
  		endif;
  	endif; // END Blog Query
?>
	<!-- <?php //get_sidebar(); ?> -->
</main>

<?php get_footer(); ?>
