<?php get_header(); ?>

<!--  @TODO: remove inline styles -->
<!--  @TODO: conditional icons and header image for select post types -->
<!--  @TODO: probably rework html... currently based on static page markup -->

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
			<div class="row mt-2">
        <?php
          $cpt = get_queried_object()->name;
          if ( get_theme_mod( "show_sidebar_{$cpt}_archive", true) ) :
            ?>
            <div class="col-12 col-md-4" style="padding-right:4em;">
              <?php get_sidebar('archive'); ?>
            </div>
            <div class="col-12 col-md-8 px-30 mt-4 mt-md-0" >
          <?php
          else:
          ?>
          <div class="col px-30 mt-4 mt-md-0" >
          <?php
          endif;
          ?>
					<?php get_template_part('loop'); ?>
				</div>
			</div>
	</main>

<?php get_footer(); ?>
