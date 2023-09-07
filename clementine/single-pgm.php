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
	$pageTitle = get_the_title();
	$date = get_the_date( 'F j, Y' );
	$current_url = home_url( add_query_arg( array(), $wp->request ) );

	$defaultAlt = get_bloginfo('name');
	$pgmBtntxt = 'See All Episodes';
	$pgmBtn = '/peel-good-marketing-podcast';

	$tempBtntxt = get_field('universal_pgm_button_text','options');
	$tempBtn = get_field('universal_pgm_page_link','options');

	if($tempBtntxt != '' && $tempBtntxt != NULL){
		$pgmBtntxt = $tempBtntxt;
	}

	if($tempBtn != '' && $tempBtn != NULL){
		$pgmBtn = $tempBtn;
	}

	$rightExcerpt = get_field('episode_excerpt');

	$ytEmbed = get_field('peel_good_youtube_embed');
	$sptfyembed = get_field('peel_good_spotify_embed');

?>

<div id="pgpContainer" class="postWrappers">
	
	<div id="pgmpTop" class="postTop">
		
		<div id="pgmpLeft" class="ptLeft">
			<div class="plbWrapper">
				<div class="rel">
					<div class="ptlTitles">
						<h1><?php echo $pageTitle;?></h1>
					</div>
					<span class="ptlbDates">
						<?php echo $date;?>
					</span>

					<div class="iconContainers">

						<div id="pgmsLeft" class="pgmShare">
							<div class="rel">
								<?php
									if(have_rows('episode_social_media')){
										echo '<h2>View our Episode Here:</h2>';
										while(have_rows('episode_social_media')){
											the_row();
											$socialType = get_sub_field('social_type');
											$socialIcon = get_sub_field('social_custom_icon')['url'];
											$iconAlt = get_sub_field('social_custom_icon')['alt'];
											$socialLink = get_sub_field('social_link');
								?>

									<span class="pgmpIcons">
										<?php if($socialLink != '' && $socialLink != NULL){?>
											<a href="<?php echo $socialLink;?>" target="_blank">
										<?php }?>

											<?php if($socialIcon != '' && $socialIcon != NULL){?>
												<img src="<?php echo $socialIcon;?>" alt="<?php echo $socialType;?>" />
											<?php }else{?>
												<i class="icon-<?php echo $socialType;?>"></i>
											<?php }?>

										<?php if($socialLink != '' && $socialLink != NULL){?>
											</a>
										<?php }?>
									</span>

								<?php
										}
									}
								?>
							</div>
						</div>

						<div id="pgmsRght" class="pgmShare">
							<div class="rel">
								<h3>Share:</h3>
								<a href="https://twitter.com/intent/tweet?url=<?php echo $current_url;?>" target="_blank">
									<i class="icon-twitter"></i>
								</a>
								<a href="https://www.facebook.com/sharer.php?u=<?php echo $current_url;?>" target="_blank">
									<i class="icon-facebook"></i>
								</a>
							</div>
						</div>

						<div class="clear"></div>

					</div>

				</div>
			</div>
		</div><!-- END OF PTLEFT -->

		<div id="pgmpRght" class="ptRight">
			<!--<div class="bkgColor orngeBckgrd effect2"></div>-->
			<div class="rel">
				<?php echo $rightExcerpt;?>
			</div>
		</div><!-- END OF PTRIGHT -->

		<div class="clear"></div>

	</div>

	<div class="postMid">

		<div class="pgmAudio">
			<iframe loading="lazy" title="<?php echo $pageTitle;?>" allowtransparency="true" allow="encrypted-media" src="<?php echo $sptfyembed;?>" data-origwidth="100%" data-origheight="232" style="width: 316px;" width="100%" height="232" frameborder="0"></iframe>
		</div>

		<?php
			if(have_posts()){
				while(have_posts()):
					the_post();
					the_content();
				endwhile; 
			}
		?>

	</div><!-- END OF POSTMID -->

	<a class="pbButtons" href="<?php echo $pgmBtn;?>">
		<?php echo $pgmBtntxt; ?>		
	</a>


</div>



<?php get_footer(); ?>
