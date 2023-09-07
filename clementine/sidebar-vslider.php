<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Clementine
 * @since Clementine 1.0
 */

$blogTitle = get_bloginfo('name');
$slideAlt = $blogTitle;
?>

<?php
	$defaultImg = get_template_directory_uri().'/images/clementine-placeholder.jpg';
	$defaultAlt = $blogTitle;

	$tempDefault = get_field('default_top_image','options');
	if($tempDefault != '' || $tempDefault != NULL){
		$defaultImg = $tempDefault['url'];
		if(wp_is_mobile()){
			$defaultImg = $tempDefault['sizes']['medium_large'];
			//$defaultImg = $tempDefault['url'];
		}
		$slideAlt = $tempDefault['alt'];
	}

	$headerType = get_field('header_type');
?>

<?php if($headerType == 'video'){ ?>

	<?php
		$topVid = get_field('header_video');
	?>

	<?php if($topVid != ''){ ?>

		<div id="topVideo" style="background-image: url('<?php echo $defaultImg;?>');">
			<div id="tvWrapper">
				<iframe src="<?php echo $topVid;?>?autoplay=1&loop=1&background=1&title=0&byline=0&portrait=0&muted=1" title="<?php echo $blogTitle;?>" frameborder="0" allow="autoplay; fullscreen" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			</div>
			<?php if(is_front_page()){ ?>
				<div id="arrowContainer">
					<div class="rel">
						<a id="scrollBtn" href="javascript:scrollDwn();">
							<i class="icon-down-arrow glow"></i>
						</a>
					</div>
				</div>
				<script type="text/javascript">
					function scrollDwn(){
						$('html, body').animate({'scrollTop': $(window).height() - 50}, 1400);
					}
				</script>
			<?php }?>
		</div><!-- END OF TOPVIDEO -->

	<?php }else{ ?>

		<div id="topSlider">
			
			<div class="bgImage" style="background-image:url('<?php echo $defaultImg;?>');"></div>
			<img src="<?php echo get_template_directory_uri();?>/images/slidePlacement.png"  class="topPlacement" />
			<img data-src="<?php echo $defaultImg;?>" alt="<?php echo $defaultAlt;?>" class="imageAbove" />

			<?php if(is_front_page()){ ?>
				<div id="arrowContainer">
					<div class="rel">
						<a id="scrollBtn" href="javascript:scrollDwn();">
							<i class="icon-down-arrow glow"></i>
						</a>
					</div>
				</div>
				<script type="text/javascript">
					function scrollDwn(){
						$('html, body').animate({scrollTop:$('#sbContainer').position().top}, 'slow');
						//$('html, body').animate({'scrollTop': $(window).height() - 50}, 1400);
					}
				</script>
			<?php }?>

		</div>

	<?php }?>

<?php }?>

<?php if($headerType == 'slider'){ ?>

	<div id="topSlider">
		
		<div class="swiper-container">
			
			<div class="swiper-wrapper">
				
				<?php
					$i = 0;
					$totalSlides = 0;
					$imageArray = array();
					$imageAlts = array();
					$slides = array();

					if(have_rows('top_slider')){
						while(have_rows('top_slider')):
							the_row();
							$imageArray[$i] = get_sub_field('slider_image');
							$imageAlts[$i] = $imageArray[$i]['alt'];
							$slides[$i] = $imageArray[$i]['url'];

							if(wp_is_mobile()){
								$slides[$i] = $imageArray[$i]['sizes']['medium_large'];
							}

							echo '<div class="swiper-slide">';
							if($i == 0){
								echo '<div class="bgImage" style="background-image: url(\''.$slides[$i].'\')" ></div>';
							} else {
								//echo '<div class="bgImage" data-src="'.$slides[$i].'"></div>';
								echo '<div class="bgImage" style="background-image: url(\''.$slides[$i].'\')" ></div>';
							}
							echo '<img src="'.get_template_directory_uri().'/images/slidePlacement.png" alt="'.get_bloginfo('name').'" class="topPlacement" />';
							echo '<img data-src="'.$slides[$i].'" alt="'.get_bloginfo('name').' '.$imageAlts[$i].'" class="imageAbove" />';
							echo '</div>';
							$i++;

						endwhile;
					}

					$totalSlides = $i;

					if($totalSlides == 0) { 

						$slideDefault = get_template_directory_uri().'/images/clementine-placeholder.jpg';
						$topAlt = $slideAlt.' ';
						if($defaultImg != '') {
							$slideDefault = $defaultImg;
							$topAlt .= $slideAlt;
							if(wp_is_mobile()) {
								$slideDefault = $defaultImg;
							}
						}
						echo '<div class="swiper-slide">';
						echo '<div class="bgImage" style="background-image: url(\''.$slideDefault.'\')"></div>';
						echo '<img src="'.get_template_directory_uri().'/images/slidePlacement.png"  class="topPlacement" />';
						echo '<img data-src="'.$slideDefault.'" alt="'.$topAlt.'" class="imageAbove" />';
						echo '</div>';
						$topTotal = 1;

					}


				?>

				<?php if(is_front_page()){ ?>
					<div id="arrowContainer">
						<div class="rel">
							<a id="scrollBtn" href="javascript:scrollDwn();">
								<i class="icon-down-arrow glow"></i>
							</a>
						</div>
					</div>
					<script type="text/javascript">
						function scrollDwn(){
							$('html, body').animate({'scrollTop': $(window).height() - 50}, 1400);
						}
					</script>
				<?php }?>

			</div><!-- END OF SWIPER WRAPPER -->

		</div><!-- END OF SWIPER CONTAINER -->

	</div><!-- END OF TOPSLIDER -->

	<?php if($totalSlides > 1) {?>

		<script type="text/javascript">

			var topSlider;

		    $(document).ready(function(){

		    	topSlider = new Swiper('#topSlider .swiper-container',{
					speed: 1100,
					autoplay: {
						delay: 4000,
						disableOnInteraction: false,
					},
					preloadImages: true,
					lazy: false,
					effect: 'fade',
					autoHeight: true,
					roundLengths: true,
					loop: true
				});

		    });

		    $(window).on('load', function(){ // WAITS TILL THE WHOLE PAGE LOADS
				topSlider.update();
			});

			$(window).resize(function() {
				topSlider.update();
			});

		</script>

	<?php }?>

<?php }?>


