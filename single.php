<?php get_header(); ?>
	<main id="maincontent" class="container">
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
      <div class="row">
        <div class="col-12 text-center mt-5 mb-4">
          <?php $cpt = get_post_type_object( get_post_type())->name; ?>
  				<img class="header-icon" src="<?php echo svg_url("archive/".$cpt) ?>" />
        </div>
        <div class="col-12 text-center mb-4">
          <?php
            $post_type_obj = get_post_type_object( get_post_type() );
           //Get post type's label
           ?>
  				<h1 class="header-title m-0"><?php echo $post_type_obj->labels->name ?></h1>
        </div>
        <hr class="fullwidth"/>
			</div>
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
    				<header class="mt-2">
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
