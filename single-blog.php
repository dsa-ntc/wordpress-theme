<?php get_header(); ?>
  <div class="bg-dsaweekly">
    <div class="row justify-content-center mx-auto py-4">
      <img class="header-icon-dsaweekly" src="<?php echo svg_url("DemocraticLeftLogo") ?>" />
    </div>
  </div>
	<main id="maincontent" class="container">
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
      <div class="row">
          <?php
          $cpt = get_post_type_object( get_post_type() );

          if ( get_theme_mod ("show_sidebar_{$cpt->name}", true) ) :
          ?>
          <div class="col-12 col-md-4 order-last order-md-first">
            <?php get_sidebar("single"); ?>
          </div>
          <div class="col-12 col-md-8">
          <?php
          else:
          ?>
          <div class="col">
          <?php
          endif;
          ?>
    			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    				<header class="mt-3">
    					<h1><?php the_title(); ?></h1>
    					<div class="byline"><?php the_date(); ?><?php echo ( get_post_meta($post->ID, '_content_author', true) ? ' <span class="lowercase pad-sides-1x">by</span> ' . get_post_meta($post->ID, '_content_author', true) : ''); ?></div>
    				</header>
      			<?php the_content(); // Dynamic Content ?>
      		</article>
        </div>
      </div>
    <?php endwhile; ?>
    <?php else: ?>
      <h1>Sorry, nothing to display.</h1>
    <?php endif; ?>
	</main>
<?php get_footer(); ?>
