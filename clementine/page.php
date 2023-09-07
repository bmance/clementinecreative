<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Clementine Creative Agency
 * @since Clementine Showcase 1.0
 */

get_header(); ?>

<?php
	$pageTitle = get_the_title();
?>

<div id="defaultContainer">
	
	<h1><?php echo $pageTitle;?></h1>

	<?php
		if(have_posts()){
			while(have_posts()):
				the_post();
				the_content();
			endwhile;
		}
	?>

</div><!-- END OF DEFAULT CONTAINER -->


<?php get_footer();?>
