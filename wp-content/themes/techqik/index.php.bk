<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techqik
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header(); ?>

	<div id="primary" <?php astra_primary_class(); ?>>
		<?php
		// astra_primary_content_top();
		get_sidebar();
		// astra_content_loop();
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				the_title( '<h1>', '</h1>' );
				the_content();
			endwhile;
		else :
			_e( 'Sorry, no posts matched your criteria.', 'devhub' );
		endif;
		// astra_pagination();

		// astra_primary_content_bottom();
		?>
	</div><!-- #primary -->

<?php

get_footer();