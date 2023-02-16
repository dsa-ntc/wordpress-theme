<?php get_header(); ?>

	<main id="maincontent" class="container">
<?php if (have_posts()): while (have_posts()) : the_post();
			$eventdate = ept_get_the_event_date('array');
			$location = ept_get_the_event_location();
			$moreinfo = get_post_meta($post->ID, '_ept_moreinfo', true);
			$rsvplink = get_post_meta($post->ID, '_ept_rsvplink', true);
			$confnum = get_post_meta($post->ID, '_ept_confnum', true);
			$conflink = get_post_meta($post->ID, '_ept_conflink', true);
			if ($moreinfo) :
				$moreinfoname = format_url( $moreinfo, 'host' );
			endif;
			if ($conflink) :
				$conflinkname = format_url( $conflink, 'host' );
			endif;
			if ($rsvplink) :
				$rsvplinkname = "RSVP Here";
			endif;
			if ( $confnum || $conflink || $rsvplink ) { $conf = true; } else { $conf = false; };
?>
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
      <div class="col-12 col-md-4 order-last order-md-first">
      	<?php get_sidebar('single-event'); ?>
      </div>
      <div class="col">
  			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    			<!-- post thumbnail -->
    			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
    					<?php the_post_thumbnail(); // Fullsize image for the single post ?>
    			<?php endif; ?>
    			<!-- /post thumbnail -->

    			<header class="mt-2">
      			<h1><?php echo get_queried_object()->post_title; ?><h1>
      			<h2><?php echo $eventdate['date_span']; ?></h2>
      			<h3><?php echo $eventdate['start_us_tzs']; ?></h3>
      			<?php if ( $location ): ?><div class="location"><?php echo $location; ?></div><?php endif; ?>
      			<?php if ( $moreinfo ): ?>
              <div class="infolink"><a href="<?php echo $moreinfo; ?>" target="_blank"><?php echo $moreinfoname; ?></a></div>
            <?php endif; ?>
    			</header>
          <div class="row">
            <div class="col">
        			<?php if ($conf): ?>
        				<div class="conf">
        					<h3>Call / Meeting Info</h3>
        					<?php if ( $confnum ) echo '<span>Dial-In Info: ' . $confnum . '</span>'; ?>
        					<?php if ( $conflink ) echo '<span>Join Link: <a href="' . $conflink . '" target="_blank">' . $conflinkname . '</a></span>'; ?>
        					<?php if ( $rsvplink ) echo '<span>RSVP: <a href="' . $rsvplink . '" target="_blank">' . $rsvplinkname . '</a></span>'; ?>
        				</div>
        			<?php endif; ?>
            </div>
          </div>
          <div class="row">
            <div class="col">
    				<h3>Event Information</h3>
    				<?php echo get_queried_object()->post_content ?>
            </div>
          </div>
  			</article>
    </div>
  </div>
<?php endwhile; ?>

<?php else: ?>
			<article>
				<h1>Sorry, we can't find that event right now.</h1>
			</article>
<?php endif; ?>
	</main>
<?php get_footer(); ?>
