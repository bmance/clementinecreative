<?php
/**
 * Template Name: Contact
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage CCA
 * @since 1.0
 */

get_header(); ?>


<?php
	$pageTitle = get_the_title();
	$defaultAlt = get_bloginfo('name');
	$contactFrm = '[contact-form-7 id="4430" title="Contact form 1"]';
	$tempForm = get_field('contact_form_short_code');

	if($tempForm != '' && $tempForm != NULL){
		$contactFrm = $tempForm;
	}

	if(have_posts()){
		while(have_posts()):
			the_post();
			$content = get_the_content();
		endwhile; 
	} 

?>

<div id="contactTop">
	
	<h1><?php echo $pageTitle;?></h1>

	<?php if($content != '' && $content != NULL){ ?>
		<div id="contacTxt"><?php echo $content;?></div>
	<?php }?>

</div>

<div id="clemContact">
	
	<div id="contactLft">
		<div class="rel">
			<?php echo do_shortcode(''.$contactFrm.'');?>
		</div>
	</div><!-- END OF CONTACTLFT -->

	<div id="contactRght">
		<div class="rel">
			<?php 
				if(have_rows('contact_callouts')){
					while(have_rows('contact_callouts')):
						the_row();

						$coImage;
						$tempImage = get_sub_field('contact_image');

						if($tempImage != '' && $tempImage != NULL){
							$coImage = 'style="background-image: url(\''.$tempImage['url'].'\');"';
						}

						$coTitle = get_sub_field('contact_title');
						$coLink = get_sub_field('contact_link');
						$coExternal = get_sub_field('contact_external_link');
						$coText = get_sub_field('contact_text');

			?>
					<?php if($coLink != '' && $coLink != NULL){ ?>
						<a id="coRight<?php echo $i;?>" <?php echo $coImage;?> class="corBoxes effect2" href="<?php echo $coLink;?>" <?php if($coExternal == 'yes'){?>target="_blank"<?php }?>>
					<?php }else{ ?>
						<div id="coRight<?php echo $i;?>" class="corBoxes effect2" <?php echo $coImage;?>>
					<?php }?>
						<?php if($tempImage != '' && $tempImage != NULL){?>
							<div class="tealOverlay"></div>
						<?php }?>
						<div class="coiWrappers">
							<?php if($coTitle != '' && $coTitle != NULL){ ?>
								<span class="coTitles"><?php echo $coTitle;?></span>
							<?php }?>
							<?php if($coText != '' && $coText != NULL){ ?>
								<div><?php echo $coText;?></div>
							<?php }?>
						</div>
					<?php if($coLink != '' && $coLink != NULL){ ?>
						</a>
					<?php }else{ ?>	
						</div>
					<?php }?>

			<?php
						$i++;
					endwhile;
				}
			?>
		</div>
	</div><!-- END OF CONTACTRGHT -->

	<div class="clear"></div>

</div><!-- END OF CLEM CONTACT -->


<?php get_footer(); ?>