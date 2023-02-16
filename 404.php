<?php get_header(); ?>
	<main id="maincontent" class="container">
    <div class="row">
      <div class="col-12 text-center mt-5 mb-4">
				<img class="header-icon" src="<?php echo svg_url('megaphone') ?>" />
      </div>
      <div class="col-12 text-center mb-4">
        <h1 class="m-0">Oops!</h1>
      </div>
			<hr class="fullwidth"/>
    </div>
		<div class="row">
			<div class="col">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2>Hmm, we couldn't find that.</h2>
          <p>The address appears to be invalid.</p>
          <p>If you followed a link to this page, please let us know by emailing webmaster [at] dsausa.org.</p>
          <p>Otherwise, try searching for what you're looking for.</p>
				</article>
			</div>
    </div>
</main>

<?php get_footer(); ?>
