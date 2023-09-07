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
	$portBtntxt = 'See Our Portfolio';
	$portBtn = '/our-portfolio';

	$tempBtntxt = get_field('universal_portoflio_button_text','options');
	$tempBtn = get_field('universal_portfolio_page_link','options');

	if($tempBtntxt != '' && $tempBtntxt != NULL){
		$portBtntxt = $tempBtntxt;
	}

	if($tempBtn != '' && $tempBtn != NULL){
		$portBtn = $tempBtn;
	}

?>

<?php if(have_rows('portfolio_layout')){?>

	<div id="pmWrapper" class="sngleWrappers">
		
		<?php 
			$i = 1;
			$galTruth = 0;
			while(have_rows('portfolio_layout')){ 
				the_row();
				$ploType = get_sub_field('layout_type'); 
		?>

			
			<?php if($ploType == 'parallaxImage'){ //PARALLAX IMAGE ?>

				<?php
					$paraImg = get_sub_field('parallax_photo');
					$pImgwidth = '40%';
					$pImgheight = 'auto';

					$logoTempWidth = get_sub_field('parallax_logo_width_size');
					$logoTempHeight = get_sub_field('parallax_logo_height_size');

					if($logoTempWidth != '' && $logoTempWidth != NULL){
						$pImgwidth = $logoTempWidth.'%';
					}

					if($logoTempHeight != '' && $logoTempHeight != NULL){
						$pImgheight = $logoTempHeight.'%';
					}

					$paraAdd = get_sub_field('parallax_addition');
					$paraLogo = get_sub_field('parallax_logo');
					$paraText = get_sub_field('parallax_overlay_text');

					$paraTxtbkg = '#ff8300';
					$tempBkgclr = get_sub_field('parallax_overlay_color');
					if($tempBkgclr != '' && $tempBkgclr != NULL){
						$paraTxtbkg = $tempBkgclr;
					}

					$paraTxtClr = '#fff';
					$tempCrlr = get_sub_field('parallax_text_color');
					if($tempCrlr != '' && $tempCrlr != NULL){
						$paraTxtClr = $tempCrlr;
					}


					$paraHeight;
					$tempHeight = get_sub_field('parallax_photo_height');
					if($tempHeight != '' && $tempHeight != 0 && $tempHeight != NULL){
						$paraHeight = 'height:'.$tempHeight.'px;min-height:auto;';
					}
					$paraAlt = $paraImg['alt'];
					$paraImg = $paraImg['url'];

					$toPrcent = 60;
					$tmpPrcent = get_sub_field('parallax_logo_position_percentage');

					if($tmpPrcent != NULL && $tmpPrcent != ''){
						$toPrcent = $tmpPrcent;
					}

					$paraLogotp = round($toPrcent / ($tempHeight / 100),2);


				?>

				<style type="text/css">

					@media(min-width: 768px){
						/*#ploSect<?php echo $i;?> .paraLogos{
							top:<?php echo $paraLogotp.'vw';?>;
						}*/
					}

				</style>

				<div id="ploSect<?php echo $i;?>" class="ploParallax" style="<?php echo $paraHeight;?>background-image: url('<?php echo $paraImg;?>');">
					
					<div class="rel">

						<!--<img class="placement" src="<?php echo get_template_directory_uri();?>/images/galPlacement.png" alt="<?php echo $defaultAlt;?>" />-->
						<img class="imageAbove" src="<?php echo $paraImg;?>" alt="<?php echo $paraAlt;?>" />

						<?php if($paraAdd == 'logo'){ ?>
							<?php if($paraLogo != '' && $paraLogo != NULL){ ?>
								<div class="paraLogos">
									<div class="rel">
										<img src="<?php echo $paraLogo['url'];?>" alt="<?php echo $paraLogo['alt'];?>" />
									</div>
								</div>
							<?php }?>
						<?php }?>

						<?php if($paraAdd == 'text'){ ?>
							<?php if($paraText != '' && $paraText != NULL){ ?>
								<div class="paraTxts" style="color:<?php echo $paraTxtClr;?>; background-color:<?php echo $tempBkgclr;?>;">
									<div class="rel">
										<?php echo $paraText;?>
									</div>
								</div>
							<?php }?>
						<?php }?>

					</div>

				</div><!-- END OF PLOPARALLAX -->

			<?php }?>
			

			<?php if($ploType == 'fullwidthtxt'){ //FULL WIDTH TEXT ?>

				<?php
					$txtColor = get_sub_field('full_width_text_color');
					if($txtColor == ''){
						$txtColor = '#4c4c4c';
					}
					$bckgColor = get_sub_field('full_width_textarea_background_color');
					if($bckgColor == ''){
						$bckgColor = '#ffffff';
					}

					$fwTxt = get_sub_field('full_width_textarea');
				?>

				<?php if($fwTxt != ''){?>

					<div id="ploSect<?php echo $i;?>" class="fwtWrappers" style="color:<?php echo $txtColor;?>;background-color:<?php echo $bckgColor;?>;">
						
						<?php echo $fwTxt;?>

					</div><!-- END OF FULL WIDTH TEXT -->

				<?php }?>

			<?php }?>

			
			<?php if($ploType == 'gallery'){ //GALLERY ?>

				<?php
					$portGallery = get_sub_field('gallery_photos');
				?>

				<?php if($galTruth != 1){?>
					<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/shuffle.js"></script>
				<?php }?>

				<div id="ploSect<?php echo $i;?>" class="galWrappers">

					<div class="giWrappers grid">

						<?php foreach ($portGallery as $galItems) { ?>

							<div class="pfgItems">
								<a href="<?php echo $galItems['url'];?>" data-fancybox="images">
									<img src="<?php echo $galItems['url'];?>" alt="$galItems['alt']" />
									<div class="galPlus effect2">
										<i class="line1"></i>
										<i class="line2 effect2"></i>
									</div>
								</a>
							</div>


						<?php }?>


						<div class="clear"></div>

					</div>

				</div><!-- END OF GALLERY -->

				<?php $galTruth == 1; ?>

			<?php }?>
			

			<?php if($ploType == 'fullwidthImg'){ //FULL WIDTH IMAGE ?>

				<?php
					$fwiAlt = $defaultAlt;
					$fwImg = get_sub_field('full_width_image');

					if($fwImg != ''){
						$fwiAlt = $fwImg['alt'];
						$fwImg = $fwImg['url'];
					} 
				?>

				<div id="ploSect<?php echo $i;?>" class="fwdthImgs" style="background-image: url('<?php echo $fwImg;?>');">
					<img class="phntImg" src="<?php echo $fwImg;?>" alt="<?php echo $fwiAlt;?>" />
				</div><!-- END OF FULL WIDTH IMAGE -->

			<?php }?>


			<?php if($ploType == 'textImage'){?>

				<?php if(have_rows('image_text_area')){ ?>

					<div id="ploSect<?php echo $i;?>" class="txtImgWrapper">
						
						<?php while(have_rows('image_text_area')): the_row(); ?>

							<?php
								$blockType = get_sub_field('block_types');
								$leftStyle;
								$rightStyle;
								
								if($blockType == 'txtleft'){

									$leftClass = 'imgTxtBlock imgtxtLeft';

									$rightClass = 'imgtxtImage imgtxtRight';
									
								}else{

									$rightClass = 'imgTxtBlock imgtxtRight';

									$leftClass = 'imgtxtImage imgtxtLeft';

								}

								if(have_rows('imgtxt_left')){
									while(have_rows('imgtxt_left')){
										the_row();
										$imgBlklft = get_sub_field('left_image_block');
										$imgBlklftype = get_sub_field('image_block_type');

										if($imgBlklftype == '' || $imgBlklftype == NULL){
											$imgBlklftype = 'cover';
										}

										$imgBlklftAlt = $imgBlklft['alt'];
										$imgBlklft = $imgBlklft['url'];
										$txtBlklft = get_sub_field('left_text_block');

										if(have_rows('left_text_block')){
											while(have_rows('left_text_block')){
												the_row();

												$leftTxtColor = "#4c4c4c";
												$lftBckColor = "#ffffff";

												if($blockType == 'txtleft'){

													$tempBkg = get_sub_field('text_background_color_left');
													$tempColor = get_sub_field('text_color_left');

													if($tempColor != ''){
														$leftTxtColor = $tempColor;
													}

													if($tempBkg != ''){
														$lftBckColor = $tempBkg;
													}
												}
												$leftText = get_sub_field('left_text_area');
											}
										}
									}
								}

								if(have_rows('imgtxt_right')){
									while(have_rows('imgtxt_right')){
										the_row();
										$imgBlkrght = get_sub_field('right_image_block');
										$imgBlkrghtype = get_sub_field('image_block_type');

										if($imgBlkrghtype == '' || $imgBlkrghtype == NULL){
											$imgBlkrghtype = 'cover';
										}


										$imgBlkrghtAlt = $imgBlkrght['alt'];
										$imgBlkrght = $imgBlkrght['url'];
										$txtBlkrght = get_sub_field('right_text_block');

										if(have_rows('right_text_block')){
											while(have_rows('right_text_block')){
												the_row();

												$rightTxtColor = "#4c4c4c";
												$rghtBckColor = "#ffffff";

												if($blockType == 'txtright'){

													$tempBkg = get_sub_field('text_background_color_right');
													$tempColor = get_sub_field('right_text_color');

													if($tempColor != ''){
														$rightTxtColor = $tempColor;
													}

													if($tempBkg != ''){
														$rghtBckColor = $tempBkg;
													}
												}
												$rightText = get_sub_field('right_text_area');
											}
										}
									}
								}

							?>

							<?php if($blockType == 'txtleft'){ ?>

								<div class="<?php echo $rightClass;?>" style="background-color:<?php echo $rghtBckColor;?>; color:<?php echo $rightTxtColor;?>;">
									
									<?php
										echo '<div class="flexCenter">';

											echo '<div class="bgImage" style="background-image: url(\''.$imgBlkrght.'\'); background-size:'.$imgBlkrghtype.';"></div>';
											echo '<img data-src="'.$imgBlkrght.'" alt="'.$imgBlkrghtAlt.'" class="imageAbove" />';

										echo '</div>';
									?>

								</div>

								<div class="<?php echo $leftClass;?>" style="background-color:<?php echo $lftBckColor;?>; color:<?php echo $leftTxtColor;?>;">
									
									<?php echo $leftText;?>

								</div>

							<?php }else{ ?>

								<div class="<?php echo $leftClass;?>" style="background-color:<?php echo $lftBckColor;?>; color:<?php echo $leftTxtColor;?>;">
									
									<?php
										echo '<div class="flexCenter">';

											echo '<div class="bgImage" style="background-image: url(\''.$imgBlklft.'\'); background-size:'.$imgBlklftype.';"></div>';
											echo '<img data-src="'.$imgBlklft.'" alt="'.$imgBlklftAlt.'" class="imageAbove" />';

										echo '</div>';
									?>

								</div>

								<div class="<?php echo $rightClass;?>" style="background-color:<?php echo $rghtBckColor;?>; color:<?php echo $rightTxtColor;?>;">
									<?php echo $rightText; ?>
								</div>


							<?php }?>

							<div class="clear"></div>

						<?php endwhile; ?>

					</div><!-- END OF TEXT AND IMAGE -->

				<?php }?>

			<?php } //TEXT AND IMAGES ?>
			

			<?php if($ploType == 'video'){?>

				<?php if(have_rows('video_area')){ ?>
					
					<?php 
						$vidHeight = '500px';
						while(have_rows('video_area')){
							the_row();
							$vidLink;
							$tvHeight = get_sub_field('video_height');
							$vidType = get_sub_field('video_type');

							if($vidType == 'youtube'){ 
								$vidLink = get_sub_field('youtube_link');
							}

							if($vidType == 'vimeo'){ 
								$vidLink = get_sub_field('vimeo_link').'?byline=0&title=0';
							}

						}

						if($tvHeight != '' && $tvHeight != NULL){
							$vidHeight = $tvHeight.'px';
						}

						
					?>

					<?php if($vidLink != '' && $vidLink != NULL){ ?>

						<div id="ploSect<?php echo $i;?>" class="vidWrappers">

							<?php if($vidType == 'youtube'){?>

								<div class="folioYtvids">
									<div class="viWrappers" style="height:<?php echo $vidHeight;?>;">
										<iframe style="position:absolute;top:0;left:0;width:100%;height:100%;" src="<?php echo $vidLink;?>" title="<?php echo $blogTitle;?>" frameborder="0" allow="autoplay; fullscreen" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
									</div>
								</div>

							<?php }?>

							<?php if($vidType == 'vimeo'){?>
						
								<div class='folioVimvids'>
									<iframe src='<?php echo $vidLink;?>' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
								</div>

							<?php }?>

						</div>

					<?php }?>

				<?php }?>

			<?php }// VIDEO?>



			<?php if($ploType == 'metrics'){?>

				<?php if(have_rows('metrics_data')){ ?>

					<?php
						$totalMtr = 0;
						$mtriCount = 0;
						$portMetrics = array(array());
						$mtricBckg = '#ff8200';
						$mtricColor = '#ffffff';

						$mtriClass = 'mtrSingle';

						$tempColor2;
						$tempBkgclr2;

						if(have_rows('metrics_styles')){
							while(have_rows('metrics_styles')){
								the_row();
								$tempColor2 = get_sub_field('metrics_text_color');
								$tempBkgclr2 = get_sub_field('metrics_background_color');
							}
						}

						if($tempColor2 != '' && $tempColor2 != NULL){
							$mtricColor = $tempColor2;
						}

						if($tempBkgclr2 != '' && $tempBkgclr2 != NULL){
							$mtricBckg = $mtricBckg;
						}

					?>

					<div id="ploSect<?php echo $i;?>" class="mtrWrappers" style="color:<?php echo $mtricColor;?>;background-color:<?php echo $mtricBckg;?>;">
						
						<?php 
							while(have_rows('metrics_data')){
								the_row();
								$portMetrics[$mtriCount]['label'] = get_sub_field('metrics_label');
								$portMetrics[$mtriCount]['number'] = get_sub_field('metrics_number');
								$mtriCount++;
							}
							$totalMtr = $mtriCount;

							if($totalMtr == 2){
								$mtriClass = 'mtrDuo';
							}elseif ($totalMtr == 3) {
								$mtriClass = 'mtrTriple';
							}

						?>

						<?php
							foreach ($portMetrics as $metrics) {
								echo '<div class="mtrContainer '.$mtriClass.'">';
									echo '<div class="rel">';
										echo '<span class="mtrTitles">'.$metrics['label'].'</span>';
										echo '<div class="counter" data-count="'.$metrics['number'].'">0</div>';
									echo '</div>';
								echo '</div>';
							}
						?>

						<div class="clear"></div>

					</div>

					<script type="text/javascript">

				        $('#ploSect<?php echo $i;?> .counter').each(function() {
						  var $this = $(this),
						      countTo = $this.attr('data-count');
						  
						  $({ countNum: $this.text()}).animate({
						    countNum: countTo
						  },

						  {

						    duration: 8000,
						    easing:'linear',
						    step: function() {
						      $this.text(Math.floor(this.countNum));
						    },
						    complete: function() {
						      $this.text(this.countNum);
						      //alert('finished');
						    }

						  });  
						  
						  

						});

					</script>

				<?php }?>

			<?php }//METRICS?>



			<?php if($ploType == 'halfTxt'){?>

				<?php if(have_rows('divided_text_area')){ ?>

					<div id="ploSect<?php echo $i;?>" class="hlftxtWrappers">
						
						<?php while(have_rows('divided_text_area')){ the_row(); ?>

							<?php
								$divLeftTxt;
								$divRghtTxt;

								$bkgrdLeft = '#ff8300';
								$bkgrdRight = '#ff8300';

								$dvdLeftxt = '#ffffff';
								$dvdRghtxt = '#ffffff';

								if(have_rows('divided_left')){
									while(have_rows('divided_left')){
										the_row();
										$tempLeftbkg = get_sub_field('divided_left_bckg_color');
										if($tempLeftbkg != '' && $tempLeftbkg != NULL){
											$bkgrdLeft = $tempLeftbkg;
										}

										$tempLeftClr = get_sub_field('divided_left_text_color');
										if($tempLeftClr != '' && $tempLeftClr != NULL){
											$dvdLeftxt = $tempLeftClr;
										}

										$divLeftTxt = get_sub_field('divided_left_text');
									}
								}

								if(have_rows('divided_right')){
									while(have_rows('divided_right')){
										the_row();
										$tempRghtbkg = get_sub_field('divided_right_bckg_color');
										if($tempRghtbkg != '' && $tempRghtbkg != NULL){
											$bkgrdRight = $tempRghtbkg;
										}

										$tempRghtClr = get_sub_field('divided_right_text_color');
										if($tempRghtClr != '' && $tempRghtClr != NULL){
											$dvdRghtxt = $tempRghtClr;
										}

										$divRghtTxt = get_sub_field('divided_right_text');
									}
								}

							?>

							<div class="hlftxtLeft" style="color:<?php echo $dvdLeftxt;?>; background-color:<?php echo $bkgrdLeft;?>;">
								<div class="rel">
									<?php echo $divLeftTxt;?>
								</div>
								<div class="hlfWrappers" style="color:<?php echo $dvdLeftxt;?>; background-color:<?php echo $bkgrdLeft;?>;"></div>
							</div>

							<div class="hlftxtRight" style="color:<?php echo $dvdRghtxt;?>; background-color:<?php echo $bkgrdRight;?>;">
								<div class="rel">
									<?php echo $divRghtTxt;?>
								</div>
								<div class="hlfWrappers" style="color:<?php echo $dvdRghtxt;?>; background-color:<?php echo $bkgrdRight;?>;"></div>
							</div>

						<?php }?>

						<div class="clear"></div>	

					</div>

				<?php }?>

			<?php }// HALF AND HALF TEXT?>

		<?php
			  $i++; 
			}//END OF PORTFOLIO LAYOUT 
		?>

		<a class="pbButtons" href="<?php echo $portBtn;?>">
			<?php echo $portBtntxt; ?>		
		</a>


	</div><!-- END OF PMWRAPPER -->

<?php }?>

<script type="text/javascript">
  AOS.init();
</script>

<?php get_footer(); ?>
