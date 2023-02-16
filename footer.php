    <div class="bg-dsalitegrey">
      <div id="pre-footer" class="pb-3 container">
        <div class="row py-3">
          <div class="col">
            <ul class="footer-menu">
              <?php
              wp_nav_menu( array(
    						'walker' => new Fury_Nav_Walker(),
    						'container' => 'nav',
    						'container_id' => 'sitemap',
    						'theme_location' => 'footer-menu',
    						'items_wrap' => '%3$s',
    						'fallback_cb' => false
    						)
    					);
              ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-dsared">
      <div id="pre-footer" class="container">
        <div class="row py-2">
          <div class="col-12 col-md-8 py-2">
            <p>The Democratic Socialists of America is the largest socialist organization in the United States, with over 90,000 members. We believe that working people should run both the economy and society democratically to meet human needs, not to make profits for a few.</p>
          </div>
          <div class="col-12 col-md-4 py-2 d-flex align-items-center justify-content-center">
            <a class="mx-3 btn btn-light red-text" href="https://dsausa.org/join">
              Join Us
            </a>
            <a class="mx-3 btn btn-outline-light" href="https://dsausa.org/donate">
              Donate
            </a>
          </div>
        </div>
      </div>
    </div>
    <footer id="footer" role="contentinfo">
			<div class="row mx-0 px-3 py-0">
				<div class="col-12 col-md-6">
					<div class="row justify-content-center justify-content-md-start">
						<span class="text-s" style="margin-top:3px">🌹</span> DSA
						</a>
						<span class="vr"></span>
					<!-- </div>
					<div class="row mt-1 justify-content-center justify-content-md-start"> -->
						<!-- <a href="/join">Join Us</a> -->
						<!-- <span class="vr"></span> -->
						<a href="/privacy-policy">
							Privacy Policy
						</a>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="row justify-content-center justify-content-md-end mt-3 mt-md-0">
						<a href="https://www.facebook.com/DemSocialists" target="_blank" style="text-decoration:none">
							<img class="footer-icon" src="<?php echo svg_url("facebook") ?>" />
						</a>
            <span class="vr"></span>
						<a href="https://www.twitter.com/DemSocialists" target="_blank" style="text-decoration:none">
							<img class="footer-icon" src="<?php echo svg_url("twitter") ?>" />
						</a><span class="vr"></span>
						<a href="https://www.instagram.com/demsocialists/" target="_blank" style="text-decoration:none">
							<img class="footer-icon" src="<?php echo svg_url("instagram") ?>" />
						</a>
						<span class="vr"></span>
						<img class="footer-icon" style="margin-top:-1px" src="<?php echo svg_url("globe") ?>" />
						&nbsp;&nbsp;<a href="/contact-us">Contact</a>
					</div>
				</div>
			</div>

		</footer><!-- /footer -->

		<?php wp_footer(); ?>

		<!-- analytics -->
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-124001150-1"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-124001150-1');
		</script>

		<!-- Facebook garbage -->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0';
			fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
	</body>
</html>
