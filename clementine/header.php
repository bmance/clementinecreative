<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
		<link rel="profile" href="https://gmpg.org/xfn/11">

		<!-- FAVICON -->
		<!--<link rel="shortcut icon" href="<?php echo get_home_url();?>/favicon.ico" type="image/x-icon" />-->
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_home_url();?>/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_home_url();?>/favicon-16x16.png">

		<!-- APPLE TOUCH ICON -->
		<link rel="apple-touch-icon" href="<?php echo get_home_url();?>/apple-touch-icon.png" />
		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_home_url();?>/apple-touch-icon-57x57.png" />
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_home_url();?>/apple-touch-icon-72x72.png" />
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_home_url();?>/apple-touch-icon-76x76.png" />
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_home_url();?>/apple-touch-icon-114x114.png" />
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_home_url();?>/apple-touch-icon-120x120.png" />
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_home_url();?>/apple-touch-icon-144x144.png" />
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_home_url();?>/apple-touch-icon-152x152.png" />
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_home_url();?>/apple-touch-icon-180x180.png" />

		<link rel="manifest" href="<?php echo get_home_url();?>/site.webmanifest">

		<!-- PINNED TAB ICON -->
		<link rel="mask-icon" href="<?php echo get_home_url();?>/safari-pinned-tab.svg" color="#fd8204">
		<meta name="msapplication-TileColor" content="#00aba9">
		<meta name="theme-color" content="#ffffff">

		<?php if(is_single()){?>

		<?php }else{ ?>

			<?php
				$defaultSMP = get_field('default_custom_social_media_image','options');
				$postImage;
				if(get_the_post_thumbnail_url()){
					$postImage = get_the_post_thumbnail_url();
				}else if($defaultSMP != '' && $defaultSMP != NULL){
					$postImage = $defaultSMP;
				}else{
					$postImage = get_template_directory_uri().'/screenshot.png';
				}

			?>

			<!-- RICH PREVIEW: thumbnail for when site is shared on social media -->
			<!--<meta property="og:image" content="<?php echo $postImage;?>" />-->

		<?php }?>

		<!-- JAVASCRIPT -->
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-3.5.1.js"></script>
		<script async type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
		<script async type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.cookie.js"></script>
		<script async type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/parallax.js"></script>

		<!-- ANIMATE ON SCROLL -->
		<script async type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/aos/aos.js"></script>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/aos/aos.css">


		<!--<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>-->
		<!-- COUNT UP -->
		<script src="<?php echo get_template_directory_uri();?>/js/counterup/jquery.counterup.min.js"></script>


		<!-- GREEN SOCK -->
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/gsap/gsap.min.js"></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/gsap/ScrollTrigger.min.js"></script>

		<!-- TWEEN MAX -->
		<!--<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/gsap/animation.gsap.min.js"></script>-->
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/gsap/TweenMax.min.js"></script>

		<!-- IDANGEROUS SWIPER SLIDE -->
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/swiper-slider/swiper-slide.css">
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/swiper-slider/swiper-slide.js"></script>

		<!-- FANCYBOX -->
		<script async type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/fancybox/jquery.fancybox.js"></script>
		<link href="<?php echo get_template_directory_uri(); ?>/js/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css">

		<!-- FONT ICONS -->
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/fonts/font-icons/cca-icons.css">

		<!-- CUSTOM HEADER CODE -->
		<?php
			if(get_field('custom_header_code','options')){
				echo '<div class="invisiContainer">'.get_field('custom_header_code','options').'</div>';
			}
		?>


		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<?php wp_body_open(); ?>

		<?php

			$defaultAlt = get_bloginfo('name');
			$homeUrl = get_home_url();

			//LOGO
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$ccaLogo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			$ccaLogo = $ccaLogo[0];
			if($ccaLogo == '' || $ccaLogo == NULL){
				$ccaLogo = get_template_directory_uri().'/images/cca-logo.png';
			}
		?>

		<div id="topContainer">
			<div id="topWrapper">
				<div class="rel">
					<a id="logoContainer" href="<?php echo $homeUrl;?>">
						<img src="<?php echo $ccaLogo;?>" alt="<?php echo $defaultAlt;?> Home Logo" title="<?php echo $defaultAlt;?> Home Logo" aria-label="<?php echo $defaultAlt;?> Logo" />
					</a>
					<a id="menuButton" href="javascript:mobileMenu();">
						<span class="menuLines"></span>
						<span class="menuLines"></span>
						<span class="menuLines"></span>
						<span class="clear"></span>
						<span id="menuTxt" class="effect2"></span>
					</a>
					<div id="menuContainer">
						<?php
							wp_nav_menu(array('menu' => 'Main Menu'));
						?>
					</div>
				</div>
			</div><!-- END OF TOPWRAPPER -->
		</div>

		<!--<div id="dsktopMenu"></div>-->

		<?php if(!(is_singular('post'))){ ?>

			<?php if(is_page_template('templates/pgm.php') || is_page_template('templates/instagram.php') || is_page_template('templates/pgm-seasons.php')){ ?>

			<?php }else{ ?>

				<?php get_sidebar( 'vslider' ); ?>

			<?php }?>

		<?php }?>

		<main id="clemmyWrapper" role="main">

			<?php if(get_field('custom_body_code','options')){?>

				<!-- CUSTOM BODY CODE -->
				<?php echo '<div class="invisiContainer">'.get_field('custom_body_code','options').'</div>';?>

			<?php }?>
