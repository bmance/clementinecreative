<?php
/**
 * Template Name: Peel Good Marketing
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage CCA
 * @since 1.0
 */

get_header(); ?>

<?php
	$defaultImg = get_template_directory_uri().'/images/clementine-placeholder.png';

	//SEASON BUTTON
	$seasonBtn = get_field('display_season_button');

	//BACKGROUND TOP TEXT COLOR
	$pgmlBckg = '#fff';
	$lgBckgrd = get_field('peel_good_top_background_color');
	if($lgBckgrd != '' && $lgBckgrd != NULL){
		$pgmlBckg = $lgBckgrd;
	}

	//TOP TEXT COPY COLOR
	$pgmlTxt = '#000';
	$lgTxt = get_field('peel_good_top_text_color');
	if($lgTxt != '' && $lgTxt != NULL){
		$pgmlTxt = $lgTxt;
	}


	$i = 0;
	$total;
	$pgEpisodes = array(array());
	if(have_rows('episode_list')){
		while(have_rows('episode_list')):

			the_row();

			if(have_rows('peel_good_info')){
				while(have_rows('peel_good_info')){

					the_row();

					$pgEpisodes[$i]['title'] = get_sub_field('episode_title');
					$pgEpisodes[$i]['excerpt'] = get_sub_field('episode_excerpt');

					if(have_rows('episode_social_media')){
						$k = 0;
						while(have_rows('episode_social_media')){
							the_row();
							$pgEpisodes[$i]['social'][$k]['smType'] = get_sub_field('social_type');
							$pgEpisodes[$i]['social'][$k]['smIcon'] = get_sub_field('social_custom_icon');
							$pgEpisodes[$i]['social'][$k]['smLink'] = get_sub_field('social_link');
							$k++;
						}
					}


				}
			}

			$pgEpisodes[$i]['embed'] = get_sub_field('peel_good_embed');

			$i++;

		endwhile;
		$total = $i;
	}
?>

<style type="text/css">
	
	#pgmTop h1, #pgmTop h2,
	#pgmTop h3, #pgmTop h4,
	#pgmTop h5, #pgmTop h6,
	#pgmTop hr{
	  color: <?php echo $pgmlTxt;?>;
	}

	#pgmTop a, #pgmTop a:hover{
		color: <?php echo $pgmlTxt;?>; 
	}

</style>

<div id="pgmWrapper" style="background-color:<?php echo $pgmlBckg;?>;color:<?php echo $pgmlTxt;?>;">
	
	<div id="pgmTop">
		
		<div id="pgmtVideo" style="background-image: url('<?php echo $defaultImg;?>');">
			<div class="pgmvidWrappers">
				<div class="viWrappers">
					<iframe style="position:absolute;top:0;left:0;width:100%;height:100%;" src="<?php echo $pgEpisodes[0]['embed'];?>" title="<?php echo $blogTitle;?>" frameborder="0" allow="autoplay; fullscreen" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				</div>
			</div>
		</div>

		<div id="pgmtInfo" class="pgmInfos">
			
			<?php 

				$tempText;
				$tempLogo;
				$pageTitle = get_the_title();
				$invisHead = $pageTitle;

				$logoType = get_field('peel_good_logo_type');
				$logoText = 'Peel Good Marketing';
				$logoImg = get_template_directory_uri().'/images/pgm-logo.png';
				$logoAlt = 'Clementine Creative Agency Peel Good Marketing';

				$tempText = get_field('peel_good_logo_text');
				if($tempText != '' && $tempText != NULL){
					$logoText = $tempText;
				}

				$tempLogo = get_field('peel_good_logo');
				if($tempLogo != '' && $tempLogo != NULL){
					$logoImg = $tempLogo['url'];
					$logoAlt = $tempLogo['alt'];
				}
			?>

			<?php if($logoType == 'logo'){ ?>

				<div id="pgmlWrapper">

					<div id="pgmLogo">
						<img src="<?php echo $logoImg;?>" alt="<?php echo $logoAlt;?>" />
					</div>

					<div class="invisiContainer">
						<h1><?php echo $invisHead;?></h1>
					</div>

				</div>

			<?php }else{ ?>

				<h1><?php echo $logoText;?></h1>

			<?php }?>

			<div id="pgmtpTxt">
				<?php 
					while(have_posts()):
						the_post();
						the_content();
					endwhile; 
				?>
			</div>

		</div>

	</div><!-- END OF PGMTOP -->

	<div id="pgmBottom">
		
		<?php 
			for($i=0;$i < $total; $i++){
		?>

		<div id="pgmbItem<?php $i;?>" class="pgmbItems">

			<?php if($i % 2 != 0){  ?>

				<div class="pgmLeft pgmVids">
					
					<div>
					  <div style="position:relative;padding-top:56.25%;">
					    <iframe src="<?php echo $pgEpisodes[$i]['embed'];?>" frameborder="0" allowfullscreen
					      style="position:absolute;top:0;left:0;width:100% !important;height:100%;"></iframe>
					  </div>
					</div>

					
				</div>

				<div class="pgmRight pgmText pgmtRight">
					<div class="rel">
						<span class="pgmTitles"><?php echo $pgEpisodes[$i]['title'];?></span>
						<?php if($pgEpisodes[$i]['excerpt'] != '' || $pgEpisodes[$i]['excerpt'] != NULL){ ?>
							<div class="pgmDetails"><?php echo $pgEpisodes[$i]['excerpt'];?></div>
						<?php }?>
						<div id="pgmtShare" class="pgmShares">
							<?php foreach($pgEpisodes[$i]['social'] as $social){ ?>
								<a href="<?php echo $social['smLink'];?>" target="_blank"><i class="icon-<?php echo $social['smType'];?>"></i></a>
							<?php }?>
						</div>
					</div>
				</div>

			<?php }else{ ?>


				<div class="pgmRight pgmVids">
					
					<div>
					  <div style="position:relative;padding-top:56.25%;">
					    <iframe src="<?php echo $pgEpisodes[$i]['embed'];?>" frameborder="0" allowfullscreen
					      style="position:absolute;top:0;left:0;width:100% !important;height:100%;"></iframe>
					  </div>
					</div>

					
				</div>

				<div class="pgmLeft pgmText pgmtLeft">
					<div class="rel">
						<span class="pgmTitles"><?php echo $pgEpisodes[$i]['title'];?></span>
						<?php if($pgEpisodes[$i]['excerpt'] != '' || $pgEpisodes[$i]['excerpt'] != NULL){ ?>
							<div class="pgmDetails"><?php echo $pgEpisodes[$i]['excerpt'];?></div>
						<?php }?>
						<div id="pgmtShare" class="pgmShares">
							<?php foreach($pgEpisodes[$i]['social'] as $social){ ?>
								<a href="<?php echo $social['smLink'];?>" target="_blank"><i class="icon-<?php echo $social['smType'];?>"></i></a>
							<?php }?>
						</div>
					</div>
				</div>

			<?php }?>

			<div class="clear"></div>

		</div>

		<?php
			} 
		?>

		<div class="clear"></div>

		<?php if($seasonBtn == 'yes'){ ?>

			<?php
				if(have_rows('season_button_colors')){
					while(have_rows('season_button_colors')){
						the_row();

						$btnTextClr = get_sub_field('normal_button_text_color');
						$btnBckgClr = get_sub_field('normal_button_background_color');

						$btnTextHvr = get_sub_field('hover_button_text_color');
						$btnBckgHvr = get_sub_field('hover_button_background_color');

					}
				}
			?>

			<style type="text/css">
				.pgsBtns{
					color: <?php echo $btnTextClr;?>;
					background: <?php echo $btnBckgClr;?>;
					border: 2px solid <?php echo $btnBckgClr;?>;
				}
				.pgsBtns:hover{
					color: <?php echo $btnTextHvr;?>;
					background: <?php echo $btnBckgHvr;?>;
					border: 2px solid <?php echo $btnBckgHvr;?>;
				}
			</style>

			<?php if(have_rows('season_buttons')){ ?>

				<div id="sbtnContainer">
					
					<?php 
						while(have_rows('season_buttons')):
							the_row();
							$sbTxt = get_sub_field('season_button_text');
							$sbLnk = get_sub_field('season_button_link'); 
					?>

						<a href="<?php echo $sbLnk;?>" class="pgsBtns">
							<?php echo $sbTxt;?>
						</a>

					<?php 
						endwhile;
					?>

				</div>

			<?php }?>


		<?php }?>


	</div><!-- END OF PGMBOTTOM -->

</div><!-- END OF PGMWRAPPER -->


<?php get_footer(); ?>
