<section class="sharelinks">
	<h2>Share This</h2>
	<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-text="<?php the_title(); ?>" data-url="<?php the_permalink();?>" data-dnt="true" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
	<div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-layout="button" data-size="large" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php urlencode(get_the_permalink());?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share on Facebook</a></div>
	<div class="sharebutton"><a href="mailto:?subject=<?php the_title(); ?>&body=%0D%0A<?php the_permalink(); ?>%0D%0A"><span class="content"><i class="fas fa-envelope"></i> Email</a></span></div>
</section>
