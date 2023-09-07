<?php
/**
 * The template for displaying the 404 template in the Twenty Twenty theme.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header(); ?>

<div id="errContainer">
	
	<div id="errInner">
		
		<img src="<?php echo get_home_url().'/wp-content/themes/clementine/images/SadClem.png';?>" alt="Sad Clementine Clementin Creative Agency" />

		<h1><?php _e( 'Page Not Found', 'twentytwenty' ); ?></h1>

		<div class="intro-text"><p><?php _e( 'Sorry. The page you were looking for could not be found. It might have been removed, renamed, or did not exist in the first place.', 'twentytwenty' ); ?></p></div>

	</div><!-- END OF ERRINNER -->

</div><!-- END OF ERRCONTAINER -->


<?php get_footer(); ?>
