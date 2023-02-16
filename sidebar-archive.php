<aside id="sidebar" role="complementary">
<?php
	global $cpt;
	if ( is_active_sidebar( $cpt . '_archive' ) ) :
		dynamic_sidebar( $cpt . '_archive' );
	endif;
?>
</aside><!-- /sidebar -->
