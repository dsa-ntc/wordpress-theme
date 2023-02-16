<?php get_header(); ?>

<!--  @TODO: remove inline styles -->
<!--  @TODO: conditional icons and header image for select post types -->
<!--  @TODO: probably rework html... currently based on static page markup -->

  <div class="bg-dsaweekly">
    <div class="row justify-content-center mx-auto py-4">
      <img class="header-icon-dsaweekly" src="<?php echo svg_url("DemocraticLeftLogo") ?>" />
    </div>
  </div>
	<main id="maincontent" class="container">
    <div class="row px-2 pt-3">
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
