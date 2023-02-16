<?php
/*
Template Name: Blank / Campaign Page
*/
get_header("blank");

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		the_content();

	endwhile;
endif;

get_footer("blank");
?>