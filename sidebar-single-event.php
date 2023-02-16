<?php global $location; ?>
<aside id="sidebar" role="complementary">
		<?php if ($location): ?>
			<div class="location">
				<h1>Event Location</h1>
				<div class="space-vert-2x text-xl text-bold"><?php echo $location; ?></div>
				<div class="smallnote space-bottom-1x"><a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($location); ?>" target="_blank">View in Google Maps <i class="fal fa-external-link-square"></i></a></div>
				<iframe width="100%" height="300" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?= urlencode($location); ?>&key=AIzaSyDkJ4wbDlZ_gCm1qeAwErUHbMmx7W2otbM"></iframe>
			</div>
		<?php endif; ?>
	<?php include('inc/sharelinks.php'); ?>
	<section class="sidebar-calendar">
		<h1>More Events</h1>
<?php
	$date = new DateTime(); // Used across queries in this section

	// START RELATED Query
	$args = array(
		'post_type' => 'event',
		'posts_per_page' => 5,
		'meta_key' => '_ept_start_timestamp',
		'orderby' => 'meta_value_num',
		'order' => 'ASC',
		'meta_query' => array(
			array( 'key' => '_ept_end_timestamp', 'value' => time() , 'compare' => '>=' )
		)
	);
	$qryrelated = new WP_Query( $args );

	if ( $qryrelated->have_posts() ) :
		// START Related Loop
		while ( $qryrelated->have_posts() ):
			$qryrelated->the_post();

			$eventtime = ept_get_the_event_date( "array" );
			$allday = get_post_meta($post->ID, '_ept_allday', true);
?>
				<div class="item">
					<div class="event-date">
						<span class="date"><?php echo $eventtime["start_date_us"]; ?></span>
						<span class="dayandtime"><?php echo $eventtime["start_l"] . ( $allday ? '' : '<br />' . $eventtime["start_time_tz"] ); ?></span>
					</div>
					<div class="event-name"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
					<div class="event-desc"><?php ept_the_event_location('short'); ?></div>
				</div><!-- .item -->
<?php
		endwhile;
?>
				<p class="text-2xl text-center space-top-1x"><a href="/calendar"><i class="far fa-calendar"></i> View Calendar</a></p>
				<div class="clear"></div>
<?php
	else :
?>
			<strong>There are no upcoming events.</strong>
<?php
	endif;
	// END Events Loop
?>
	</section><!-- .sidebar-related -->
</aside><!-- /sidebar -->
