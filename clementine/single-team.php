<?php
/**
 * The template for displaying single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header(); ?>

<?php
	$defaultAlt = get_bloginfo('name');
	$bioTitle = get_the_title();
	$jobTitle = get_field('team_title'); 

	$bioPhoto1 = get_template_directory_uri().'/images/clementine-placeholder.jpg';
	$bioAlt1 = $defaultAlt;
	$bioPhoto2 = get_template_directory_uri().'/images/clementine-placeholder.jpg';
	$bioAlt2 = $defaultAlt;

	$tmBtntxt = 'See The Bunch';
	$tmBtn = '/our-tea,';

	$tempBtntxt = get_field('universal_team_button_text','options');
	$tempBtn = get_field('universal_team_page_link','options');

	if($tempBtntxt != '' && $tempBtntxt != NULL){
		$tmBtntxt = $tempBtntxt;
	}

	if($tempBtn != '' && $tempBtn != NULL){
		$tmBtn = $tempBtn;
	}

	if(have_rows('team_photos')){
		while(have_rows('team_photos')):
			the_row();
			$bptemp1 = get_sub_field('team_first_photo');
			if($bptemp1 != '' && $bptemp1 != NULL){
				$bioPhoto1 = $bptemp1['url'];
				$bioAlt1 = $bptemp1['alt'];
			}
			$bptemp2 = get_sub_field('team_second_photo');
			if($bptemp2 != '' && $bptemp2 != NULL){
				$bioPhoto2 = $bptemp2['url'];
				$bioAlt2 = $bptemp2['alt'];
			}
		endwhile;
	}
?>

<div class="bioSingles">
	
	<div class="bsngleWrappers">
		
		<div class="bioImg">
			
			<div class="imgTop effect2">
				<div class="bgImage" style="background-image: url('<?php echo $bioPhoto1;?>');"></div>
				<img data-src="<?php echo $bioPhoto1;?>" alt="<?php echo $bioAlt1;?>" class="imageAbove" />
			</div>

			<div class="imgBottom effect2">
				<div class="bgImage" style="background-image: url('<?php echo $bioPhoto2;?>');"></div>
				<img data-src="<?php echo $bioPhoto2;?>" alt="<?php echo $bioAlt2;?>" class="imageAbove" />
			</div>

		</div><!-- END OF BIOIMG -->

		<div class="bioTxt">

			<div class="rel">

				<h1><?php echo $bioTitle;?></h1>

				<span class="bioSubtitles"><?php echo $jobTitle;?></span>

				<?php 
					if( have_posts() ) {
						while ( have_posts() ) {
							the_post(); 
							the_content();
						}
					}
				?>

				<div class="bioSocial">
					
					<?php
						if(have_rows('team_social')){
							while(have_rows('team_social')){
								the_row();
								$bsocType = get_sub_field('social_type');
								$bsocIcon = get_sub_field('social_custom_icon');
								$bsocLink = get_sub_field('social_link');
					?>

							<span class="bsocIcons">

								<?php if($bsocLink != '' && $bsocLink != NULL){ ?>
									<a href="<?php echo $bsocLink;?>" target="_blank">
								<?php }?>

									<?php if($bsocIcon != '' && $bsocIcon != NULL){ ?>

										<img src="<?php echo $bsocIcon['url'];?>" alt="<?php echo $bsocIcon['alt'];?>" />

									<?php }else{ ?>

										<i class="icon-<?php echo $bsocType;?>" title="<?php echo $bsocType;?>" aria-hidden="true"></i>

									<?php }?>

								<?php if($bsocLink != '' && $bsocLink != NULL){ ?>
									</a>
								<?php }?>

							</span>

					<?php
							}
						}
					?>

				</div><!-- END OF BIOSOCIAL -->

			</div>


			<a class="pbButtons" href="<?php echo $tmBtn;?>">
				<?php echo $tmBtntxt; ?>		
			</a>

		</div><!-- END OF BIOTXT -->

		<div class="clear"></div>

	</div><!-- END OF BSNGLEWRAPPERS -->

</div><!-- END OF BIO SINGLES -->

<?php get_footer(); ?>
