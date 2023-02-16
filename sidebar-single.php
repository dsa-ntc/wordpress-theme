<aside id="sidebar" role="complementary">
<?php
	if ( has_post_thumbnail()) : // Check if Featured Image (i.e. Thumbnail) exists
?>
	<section class="featuredimage">
		<a class="fLightbox" href="<?php the_post_thumbnail_url('full'); ?>">
			<figure>
				<?php the_post_thumbnail( [330, 600] ); ?>
				<?php if ( $caption = get_post( get_post_thumbnail_id() )->post_excerpt ) : ?>
				<figcaption><?php echo $caption; ?></figcaption>
				<?php endif; ?>
			</figure>
		</a>
	</section>
<?php
	endif;

	$childposts = get_children( [
		'post_parent' => $post->ID
	]);
	if ( ($childposts) ) :
		if ( count($childposts) >= 2 || ( count($childposts) == 1 && (!has_post_thumbnail()) ) ) :
?>
	<section class="attachments">
		<h1>Attachments and Resources</h1>
		<ul class="ul-discs">
<?php
			foreach ( $childposts as $childpost ) :
				if ( wp_get_attachment_url( $childpost->ID ) == get_the_post_thumbnail_url() ) :
					continue;
				endif;
?>
			<li><a href="<?php echo wp_get_attachment_url($childpost->ID); ?>" target="_blank"><?php echo $childpost->post_title . ' (' . strtoupper(explode('/',$childpost->post_mime_type)[1]) . ')';?></a></li>
<?php
			endforeach;
?>
		</ul>
	</section>
<?php
		endif;
	endif;


// START AUTHOR BIO Query
	if ( get_post_meta($post->ID, '_content_author', true) && get_post_meta($post->ID, '_content_author_bio', true) ) :
?>
	<section class="sidebar-authorinfo">
		<h2>About <?php echo get_post_meta($post->ID, '_content_author', true); ?></h2>
		<?php echo wpautop( get_post_meta($post->ID, '_content_author_bio', true) ); ?>
	</section><!-- .sidebar-authorinfo -->
<?php
	endif;
// END AUTHOR BIO QUERY

include('inc/sharelinks.php');

// START DYNAMIC SIDEBAR
$cpt = get_post_type_object( get_post_type() );

if ( is_active_sidebar( $cpt->name ) ) :
	dynamic_sidebar( $cpt->name );
endif;

// END DYNAMIC SIDEBAR
?>
</aside><!-- /sidebar -->
