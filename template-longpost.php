<?php get_header();
/*
Template Name: Long Post (Shortcut Sidebar)
*/

the_post();
?>

<main id="maincontent" class="container">
    <div class="row">
      <div class="col-12 text-center mt-5 mb-4">
				<?php
					$icon = get_post_meta(get_the_ID(), 'icon')[0];
					if (empty($icon)){
						$icon = 'rose';
					}
				?>
				<img class="header-icon" src="<?php echo svg_url($icon) ?>" />
      </div>
      <div class="col-12 text-center mb-4">
        <h1 class="header-title m-0"><?php the_title(); ?></h1>
      </div>
      <hr class="fullwidth"/>
    </div>
		<div class="row">
			<div class="col-12 col-md-4">
				<h2 class="red-text">Jump To...</h2>
				<?php
					$doc = new DOMDocument();
					$html_data  = mb_convert_encoding(get_the_content() , 'HTML-ENTITIES', 'UTF-8');
					$doc->loadHTML($html_data);
					$selector = new DOMXPath($doc);

					$result = $selector->query('//a');

					// loop through all found items
					foreach($result as $node) {
						$name = $node->getAttribute("name");
						if (!empty($name)) {
						// 	echo "<a href='$name' class='jumpto-link-h1'>" . $node->textContent . "</a>";
						// } else {
							echo "<hr class='jumpto-hr'/><a href='#$name' class='jumpto-link'>" . $node->textContent . "</a>";
						}
						// $el = $doc->createElement("a", $node->textContent);
						// $el->setAttribute("name", "$i");
						// $node->textContent = "";
						// $node->appendChild($el);
					}
				 ?>
				 <hr class="jumpto-hr"/>
				<div class="d-none d-md-block" style="position:sticky; top:80%;">
					<a href="#">
						<button class="btn btn-outline-dark">
							<img class="scroll-button-icon" src="<?php echo svg_url("arrow") ?>" />
							Back to top
						</button>
					</a>
				</div>
			</div>
			<div class="col-12 col-md-8">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php the_content(); ?>
				</article>
			</div>
	</section><!-- #maincontent -->
</main>

<?php get_footer(); ?>
