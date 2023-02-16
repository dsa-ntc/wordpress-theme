<?php get_header(); ?>

	<main id="maincontent" class="container">
      <div class="row">
        <div class="col-12 text-center mt-5 mb-4">
          <?php $cpt = get_queried_object()->name; ?>
          <img class="header-icon" src="<?php echo svg_url("archive/".$cpt) ?>" />
        </div>
        <div class="col-12 text-center mb-4">
          <?php
            $post_type_obj = get_post_type_object( get_post_type() );
           //Get post type's label
           ?>
          <h1 class="header-title m-0"><?php post_type_archive_title(); ?></h1>
        </div>
  			<hr class="fullwidth"/>
      </div>
			<div class="row">
        <div class="col-md-4">
    		    <?php get_sidebar('calendar'); ?>
        </div>
        <div class="col-md-8">
<?php
	if (have_posts()):
		while (have_posts()) :
			the_post();

			$starttimestamp = get_post_meta($post->ID, '_ept_start_timestamp', true);
			$endtimestamp = get_post_meta($post->ID, '_ept_end_timestamp', true);
			$location = ept_get_the_event_location('short');
			$confnum = get_post_meta($post->ID, '_ept_confnum', true);
			$conflink = get_post_meta($post->ID, '_ept_conflink', true);
			$conf = ( $confnum || $conflink );
			$rsvplink = get_post_meta($post->ID, '_ept_rsvplink', true);
?>
			<article class="calevent">
			<?php $eventdate = ept_get_the_event_date("array"); ?>
        <div class="col">
          <div class="row">
            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
          </div>
  				<div class="row content my-2"><?php the_excerpt() ?></div>
  				<?php if($location) : ?><div class="row location"><i class="far fa-fw fa-map-marker-alt"></i><?php echo $location; ?></div><?php endif; ?>
  				<?php if($conf) : ?><div class="row conf"><i class="far fa-fw fa-phone"></i><?php ept_the_conf_info("full"); ?></div><?php endif; ?>

  				<div class="row date"><i class="far fa-calendar"></i><b><?php echo $eventdate['start_date_fs']; ?></b></div>
  				<div class="row time"><i class="far fa-clock"></i><?php echo $eventdate['start_time_tz']; ?></div>
          <?php if($rsvplink) : ?><div class="row conf"><a class="btn btn-red" href="<?php echo $rsvplink ?>">
            RSVP Here
          </a></div><?php endif; ?>
        </div>
			</article>
      <hr/>
<?php
		endwhile;
?>
			<div class="pagination">
				<div class="nav-previous alignleft"><?php next_posts_link( 'Later events' ); ?></div>
				<div class="nav-next alignright"><?php previous_posts_link( 'Earlier events' ); ?></div>
			</div>

<?php
	else:
?>
			<article>
				<?php if ( !empty($_GET['keywords']) || !empty( $_GET['dates']) ) : ?>
				<h2>There are currently no events matching your filters. Try clearing your filters to see all upcoming events.</h2>
				<?php else: ?>
				<h2>There are currently no events scheduled.</br></br>Please check back soon!</h2>
				<?php endif; ?>
			</article>
<?php
	endif;
?>
      </div>
    </div>
	</main>
<?php get_footer(); ?>
