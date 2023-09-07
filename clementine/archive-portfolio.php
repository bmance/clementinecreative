<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

if(is_date()) {
	$homepg=get_bloginfo('url').'/our-portfolio';
	header("Location: $homepg",TRUE,301);
}

 ?>

<?php get_header(); ?>


<?php get_footer(); ?>
