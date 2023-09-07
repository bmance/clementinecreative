<?php
/**
 * Template Name: Homepage
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Clementine Creative Agency
 * @since 1.0
 */

get_header(); ?>

<?php
	$uri = $_SERVER['REQUEST_URI'];
	//echo $uri; // Outputs: URI

	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

	$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	//echo $url; // Outputs: Full URL

	$query = $_SERVER['QUERY_STRING'];
	//echo $query; // Outputs: Query String

	$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
                "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
                $_SERVER['REQUEST_URI'];

?>

<?php
	if(have_posts()){
		while(have_posts()):
			the_post();
			$content = get_the_content();
		endwhile;
	}

?>

<?php if($content != '' && $content != NULL){ ?>

	<div id="hmContainer">

		<?php
			while(have_posts()):
				the_post();
				the_content();
			endwhile;
		?>

	</div><!-- END OF HMCONTAINER -->

<?php }else{ ?>

	<?php
		$invisHead = 'Clementine Creative Agency : An Award-Winning Advertising Agency';
		$invisTemp = get_field('invisible_heading_1_title');
		if($invisTemp != '' && $invisTemp != NULL){
			$invisHead = $invisTemp;
		}
	?>

	<div class="invisiContainer">
		<h1><?php echo $invisHead;?></h1>
		<?php echo $link;?>
	</div>

<?php }?>

<div id="sbContainer">

	<div id="serviceBox1" class="srvBoxes">

		<?php
			$srvTitle1 = 'branding';
			$titleTemp1 = get_field('service_title_1');
			if($titleTemp1 != ''){
				$srvTitle1 = $titleTemp1;
			}
			$srvStitle1 = get_field('service_subtitle_1');

			$srvImage1 = get_template_directory_uri().'/images/hsrvBox1.jpg';
			$tempImg1 = get_field('service_right_photo_1');
			if($tempImg1 != ''){
				$srvImage1 = $tempImg1['url'];
			}

			$srvDetail1 = get_field('service_detail_text_1');

			$srvPostDisplay1 = get_field('service_post_display_1');
			$srvPost1 = get_field('service_post_choice_1');

			//SEE MORE LINK
			$lnkTxt1 = 'See More';
			$srvLinktxt1 = get_field('service_link_text_1');
			if($srvLinktxt1 != '' || $srvLinktxt1 != NULL){
				$lnkTxt1 = $srvLinktxt1;
			}
			$srvLink = get_field('service_link_1');
		?>

		<div id="srvbRight1" class="srvbRight">
			<div class="skbgImages" style="background-image: url('<?php echo $srvImage1;?>');"></div>
		</div>

		<div id="srvbLeft1" class="srvbLeft">
			<div class="srvlWrapper">
				<span class="srvTitles"><?php echo $srvTitle1;?></span>
				<?php if($srvStitle1 != ''){ ?>
					<span class="svSubtles"><?php echo $srvStitle1;?></span>
				<?php }?>
			</div>
			<a href="javascript:srvReveal('1');" id="detailArrow1" class="srvdArrows">
				<i class="icon-arrow-down-filled"></i>
			</a>
		</div>

		<div class="clear"></div>

		<!--<div id="srvDetail1" class="srvDetails effect2"></div>-->

	</div><!-- END OF SERVICEBOX1 -->

	<div id="srvDetail1" class="srvDetails effect2">
		<?php if($srvDetail1){?>
			<div><?php echo $srvDetail1;?></div>
		<?php }?>

		<?php if($srvPost1){?>
			<div>
				<!--<br/><br/>
				<div><?php var_dump($srvPost1);?></div>
				<br/><br/>-->
				<ul class="sdpLists">
					<?php foreach( $srvPost1 as $post ):

				        // Setup this post for WP functions (variable must be named $post).
				        setup_postdata($post);

				        $tmpImg = get_template_directory_uri().'/images/postDefault.png';
				        $tmpAlt = get_the_title( $post->ID );

				        if(has_post_thumbnail()){
				        	$tmpImg = get_the_post_thumbnail_url();
				        	$tmpAlt = esc_html ( get_the_post_thumbnail_caption() );
				        	if($tmpImg == '' || $tmpImg == NULL){
				        		$tmpImg = get_template_directory_uri().'/images/postDefault.png';
				        		$tmpAlt = get_the_title( $post->ID );
				        	}
				        }
				    ?>
				        <li class="sdpItems">
				        	<div class="rel">
				            	<a href="<?php the_permalink(); ?>" target="_blank">
				            		<div class="spdfImgs">
					            		<div class="bgImage" style="background-image:url('<?php echo $tmpImg;?>');"></div>
					            		<img class="imageAbove" src="<?php echo $tmpImg;?>" alt="<?php echo $tmpAlt;?>" />
					            	</div>
					            	<span class="spdTitles"><?php echo get_the_title( $post->ID ); ?></span>
				            	</a>
				        	</div>
				        </li>
			    	<?php endforeach; ?>
			    	<div class="clear"></div>
			    </ul>
			    <?php
			    // Reset the global post object so that the rest of the page works correctly.
			    wp_reset_postdata(); ?>
			    <?php if($srvLink != ''){ ?>
			    	<a class="srvdLinks clemmyBtns" href="<?php echo $srvLink;?>"><?php echo $lnkTxt1;?></a>
			    <?php }?>
			</div>
		<?php }?>
	</div><!-- END OF SRVDETAIL1 -->

	<div id="serviceBox2" class="srvBoxes">

		<?php
			$srvTitle2 = 'visual';
			$titleTemp2 = get_field('service_title_2');
			if($titleTemp2 != ''){
				$srvTitle2 = $titleTemp2;
			}
			$srvStitle2 = get_field('service_subtitle_2');

			$srvImage2 = get_template_directory_uri().'/images/hsrvBox2.jpg';
			$tempImg2 = get_field('service_right_photo_2');
			if($tempImg1 != ''){
				$srvImage2 = $tempImg2['url'];
			}

			$srvDetail2 = get_field('service_detail_text_2');

			$srvPostDisplay2 = get_field('service_post_display_2');
			$srvPost2 = get_field('service_post_choice_2');

			//SEE MORE LINK
			$lnkTxt2 = 'See More';
			$srvLinktxt2 = get_field('service_link_text_2');
			if($srvLinktxt2 != '' || $srvLinktxt2 != NULL){
				$lnkTxt2 = $srvLinktxt2;
			}
			$srvLink = get_field('service_link_2');
		?>

		<div id="srvbRight2" class="srvbRight">
			<div class="skbgImages" style="background-image: url('<?php echo $srvImage2;?>');"></div>
		</div>

		<div id="srvbLeft2" class="srvbLeft">
			<div class="srvlWrapper">
				<span class="srvTitles"><?php echo $srvTitle2;?></span>
				<?php if($srvStitle2 != ''){ ?>
					<span class="svSubtles"><?php echo $srvStitle2;?></span>
				<?php }?>
			</div>
			<a href="javascript:srvReveal('2');" id="detailArrow2" class="srvdArrows">
				<i class="icon-arrow-down-filled"></i>
			</a>
		</div>

		<div class="clear"></div>

		<!--<div id="srvDetail1" class="srvDetails effect2"></div>-->

	</div><!-- END OF SERVICEBOX2 -->

	<div id="srvDetail2" class="srvDetails effect2">
		<?php if($srvDetail2){?>
			<div><?php echo $srvDetail2;?></div>
		<?php }?>

		<?php if($srvPost2){?>
			<div>
				<!--<br/><br/>
				<div><?php var_dump($srvPost2);?></div>
				<br/><br/>-->
				<ul class="sdpLists">
					<?php foreach( $srvPost2 as $post ):

				        // Setup this post for WP functions (variable must be named $post).
				        setup_postdata($post);

				        $tmpImg = get_template_directory_uri().'/images/postDefault.png';
				        $tmpAlt = get_the_title( $post->ID );

				        if(has_post_thumbnail()){
				        	$tmpImg = get_the_post_thumbnail_url();
				        	$tmpAlt = esc_html ( get_the_post_thumbnail_caption() );
				        	if($tmpImg == '' || $tmpImg == NULL){
				        		$tmpImg = get_template_directory_uri().'/images/postDefault.png';
				        		$tmpAlt = get_the_title( $post->ID );
				        	}
				        }
				    ?>
				        <li class="sdpItems">
				        	<div class="rel">
				            	<a href="<?php the_permalink(); ?>" target="_blank">
					            	<div class="spdfImgs">
					            		<div class="bgImage" style="background-image:url('<?php echo $tmpImg;?>');"></div>
					            		<img class="imageAbove" src="<?php echo $tmpImg;?>" alt="<?php echo $tmpAlt;?>" />
					            	</div>
					            	<span class="spdTitles"><?php echo get_the_title( $post->ID ); ?></span>
				            	</a>
				        	</div>
				        </li>
			    	<?php endforeach; ?>
			    	<div class="clear"></div>
			    </ul>
			    <?php
			    // Reset the global post object so that the rest of the page works correctly.
			    wp_reset_postdata(); ?>
			    <?php if($srvLink != ''){ ?>
			    	<a class="srvdLinks clemmyBtns" href="<?php echo $srvLink;?>"><?php echo $lnkTxt2;?></a>
			    <?php }?>
			</div>
		<?php }?>
	</div><!-- END OF SRVDETAIL2 -->

	<div id="serviceBox3" class="srvBoxes">

		<?php
			$srvTitle3 = 'social';
			$titleTemp3 = get_field('service_title_3');
			if($titleTemp3 != ''){
				$srvTitle3 = $titleTemp3;
			}
			$srvStitle3 = get_field('service_subtitle_3');

			$srvImage3 = get_template_directory_uri().'/images/hsrvBox3.jpg';
			$tempImg3 = get_field('service_right_photo_3');
			if($tempImg3 != ''){
				$srvImage3 = $tempImg3['url'];
			}

			$srvDetail3 = get_field('service_detail_text_3');

			$srvPostDisplay3 = get_field('service_post_display_3');
			$srvPost3 = get_field('service_post_choice_3');

			//SEE MORE LINK
			$lnkTxt3 = 'See More';
			$srvLinktxt3 = get_field('service_link_text_3');
			if($srvLinktxt3 != '' || $srvLinktxt3 != NULL){
				$lnkTxt3 = $srvLinktxt3;
			}
			$srvLink = get_field('service_link_3');
		?>

		<div id="srvbRight3" class="srvbRight">
			<div class="skbgImages" style="background-image: url('<?php echo $srvImage3;?>');"></div>
		</div>

		<div id="srvbLeft3" class="srvbLeft">
			<div class="srvlWrapper">
				<span class="srvTitles"><?php echo $srvTitle3;?></span>
				<?php if($srvStitle3 != ''){ ?>
					<span class="svSubtles"><?php echo $srvStitle3;?></span>
				<?php }?>
			</div>
			<a href="javascript:srvReveal('3');" id="detailArrow3" class="srvdArrows">
				<i class="icon-arrow-down-filled"></i>
			</a>
		</div>

		<div class="clear"></div>

		<!--<div id="srvDetail1" class="srvDetails effect2"></div>-->

	</div><!-- END OF SERVICEBOX3 -->

	<div id="srvDetail3" class="srvDetails effect3">
		<?php if($srvDetail3){?>
			<div><?php echo $srvDetail3;?></div>
		<?php }?>

		<?php if($srvPost3){?>
			<div>
				<!--<br/><br/>
				<div><?php var_dump($srvPost3);?></div>
				<br/><br/>-->
				<ul class="sdpLists">
					<?php foreach( $srvPost3 as $post ):

				        // Setup this post for WP functions (variable must be named $post).
				        setup_postdata($post);

				        $tmpImg = get_template_directory_uri().'/images/postDefault.png';
				        $tmpAlt = get_the_title( $post->ID );

				        if(has_post_thumbnail()){
				        	$tmpImg = get_the_post_thumbnail_url();
				        	$tmpAlt = esc_html ( get_the_post_thumbnail_caption() );
				        	if($tmpImg == '' || $tmpImg == NULL){
				        		$tmpImg = get_template_directory_uri().'/images/postDefault.png';
				        		$tmpAlt = get_the_title( $post->ID );
				        	}
				        }
				    ?>
				        <li class="sdpItems">
				        	<div class="rel">
				            	<a href="<?php the_permalink(); ?>" target="_blank">
					            	<div class="spdfImgs">
					            		<div class="bgImage" style="background-image:url('<?php echo $tmpImg;?>');"></div>
					            		<img class="imageAbove" src="<?php echo $tmpImg;?>" alt="<?php echo $tmpAlt;?>" />
					            	</div>
					            	<span class="spdTitles"><?php echo get_the_title( $post->ID ); ?></span>
				            	</a>
				        	</div>
				        </li>
			    	<?php endforeach; ?>
			    	<div class="clear"></div>
			    </ul>
			    <?php
			    // Reset the global post object so that the rest of the page works correctly.
			    wp_reset_postdata(); ?>
			    <?php if($srvLink != ''){ ?>
			    	<a class="srvdLinks clemmyBtns" href="<?php echo $srvLink;?>"><?php echo $lnkTxt3;?></a>
			    <?php }?>
			</div>
		<?php }?>
	</div><!-- END OF SRVDETAIL3 -->

	<div id="serviceBox4" class="srvBoxes">

		<?php
			$srvTitle4 = 'web';
			$titleTemp4 = get_field('service_title_4');
			if($titleTemp4 != ''){
				$srvTitle4 = $titleTemp4;
			}
			$srvStitle4 = get_field('service_subtitle_4');

			$srvImage4 = get_template_directory_uri().'/images/hsrvBox4.jpg';
			$tempImg4 = get_field('service_right_photo_4');
			if($tempImg4 != ''){
				$srvImage4 = $tempImg4['url'];
			}

			$srvDetail4 = get_field('service_detail_text_4');

			$srvPostDisplay4 = get_field('service_post_display_4');
			$srvPost4 = get_field('service_post_choice_4');

			//SEE MORE LINK
			$lnkTxt4 = 'See More';
			$srvLinktxt4 = get_field('service_link_text_4');
			if($srvLinktxt4 != '' || $srvLinktxt4 != NULL){
				$lnkTxt4 = $srvLinktxt4;
			}
			$srvLink = get_field('service_link_4');
		?>

		<div id="srvbRight4" class="srvbRight">
			<div class="skbgImages" style="background-image: url('<?php echo $srvImage4;?>');"></div>
		</div>

		<div id="srvbLeft4" class="srvbLeft">
			<div class="srvlWrapper">
				<span class="srvTitles"><?php echo $srvTitle4;?></span>
				<?php if($srvStitle4 != ''){ ?>
					<span class="svSubtles"><?php echo $srvStitle4;?></span>
				<?php }?>
			</div>
			<a href="javascript:srvReveal('4');" id="detailArrow4" class="srvdArrows">
				<i class="icon-arrow-down-filled"></i>
			</a>
		</div>

		<div class="clear"></div>

		<!--<div id="srvDetail1" class="srvDetails effect2"></div>-->

	</div><!-- END OF SERVICEBOX4 -->

	<div id="srvDetail4" class="srvDetails effect4">
		<?php if($srvDetail4){?>
			<div><?php echo $srvDetail4;?></div>
		<?php }?>

		<?php if($srvPost4){?>
			<div>
				<!--<br/><br/>
				<div><?php var_dump($srvPost4);?></div>
				<br/><br/>-->
				<ul class="sdpLists">
					<?php foreach( $srvPost4 as $post ):

				        // Setup this post for WP functions (variable must be named $post).
				        setup_postdata($post);

				        $tmpImg = get_template_directory_uri().'/images/postDefault.png';
				        $tmpAlt = get_the_title( $post->ID );

				        if(has_post_thumbnail()){
				        	$tmpImg = get_the_post_thumbnail_url();
				        	$tmpAlt = esc_html ( get_the_post_thumbnail_caption() );
				        	if($tmpImg == '' || $tmpImg == NULL){
				        		$tmpImg = get_template_directory_uri().'/images/postDefault.png';
				        		$tmpAlt = get_the_title( $post->ID );
				        	}
				        }
				    ?>
				        <li class="sdpItems">
				        	<div class="rel">
				            	<a href="<?php the_permalink(); ?>" target="_blank">
					            	<div class="spdfImgs">
					            		<div class="bgImage" style="background-image:url('<?php echo $tmpImg;?>');"></div>
					            		<img class="imageAbove" src="<?php echo $tmpImg;?>" alt="<?php echo $tmpAlt;?>" />
					            	</div>
					            	<span class="spdTitles"><?php echo get_the_title( $post->ID ); ?></span>
				            	</a>
				        	</div>
				        </li>
			    	<?php endforeach; ?>
			    	<div class="clear"></div>
			    </ul>
			    <?php
			    // Reset the global post object so that the rest of the page works correctly.
			    wp_reset_postdata(); ?>
			    <?php if($srvLink != ''){ ?>
			    	<a class="srvdLinks clemmyBtns" href="<?php echo $srvLink;?>"><?php echo $lnkTxt4;?></a>
			    <?php }?>
			</div>
		<?php }?>
	</div><!-- END OF SRVDETAIL4 -->

</div><!-- END OF SBCONTAINER -->

<?php
	$defaultAlt = get_bloginfo('name');
	$blogDisplay = get_field('home_blog_display');
	$hbTitle = get_field('home_blog_section_title');
	if($hbTitle == ''){
		$hbTitle = 'Fresh In';
	}

	$awardDisplay = get_field('home_award_display');
	$hawTitle = get_field('home_award_section_title');
	if($hawTitle == ''){
		$hawTitle = '100% Pure Creative';
	}

	$clientDisplay = get_field('home_client_logo_display');
	$hclTitle = get_field('home_client_section_title');
	if($hclTitle == ''){
		$hclTitle = 'We\'ve told their Stories!';
	}
?>

<?php if($blogDisplay == 'yes'){ ?>

	<div id="blghContainer" class="hbContainers">

		<h2 class="hbSectitles"><?php echo $hbTitle;?></h2>

		<?php
			$i = 0;
			$newsList = array(array());
			$homeCount = '';

			$args = array('posts_per_page' => 3, 'orderby'=>'date', 'order'=>'DESC');

			$list_of_posts = new WP_Query($args);
			//sort($list_of_posts);
			while ( $list_of_posts->have_posts() ) :

				$list_of_posts->the_post();
				$newsList[$i]['link'] = get_post_permalink();
				if(get_field('blog_custom_title')){
					$newsList[$i]['title'] = get_field('blog_custom_title');
				}else{
					$newsList[$i]['title'] = get_the_title();
				}

				$newsList[$i]['content'] = substr(get_the_content(), 0, 120).'...<span class="hmblgMore">Read More</span>';
				//$newsList[$i]['content'] = substr(get_the_content(), 0, 400).'...<span class="hmblgMore">Read More</span>';

				/*if($_GET['dev'] == 'true'){
					$newsList[$i]['content'] = substr(get_the_content(), 0, 400).'...<span class="hmblgMore">Read More</span>';
					$newsList[$i]['content'] = substr(get_the_content(), 0, 320).'...<span class="hmblgMore">Read More</span>';
					$newsList[$i]['strlength'] = strlen(get_the_content());
				}*/

				$newsList[$i]['postImg'] = get_template_directory_uri().'/images/postDefault.png';

				if(has_post_thumbnail()){

					$newsList[$i]['postImg'] = get_the_post_thumbnail_url();
					$newsList[$i]['imgAlt'] = esc_html ( get_the_post_thumbnail_caption() );

					if($newsList[$i]['postImg'] == ''){
						$newsList[$i]['postImg'] = get_template_directory_uri().'/images/postDefault.png';
						$newsList[$i]['imgAlt'] = $newsList[$i]['title'];
					}

				}

				$i++;

			endwhile;

			$total = $i;

			//$newsList = array_reverse($newsList);
			$i = 1;
			wp_reset_postdata();

			$blogLink = '/blog';
			$blogTxt = 'See More';
			$tbLink = get_field('home_blog_page_link');
			$tbTxt = get_field('');

		?>

		<?php foreach($newsList as $listItem){ ?>
			<div id="hbItem<?php echo $i;?>" class="hbItems">
				<a href="<?php echo $listItem['link'];?>">
					<div class="rel">
						<div class="hbImgs">
							<div class="flexCenter">
								<div class="bgImage effect2" data-src="<?php echo $listItem['postImg'];?>"></div>
								<img src="" data-src="<?php echo $listItem['postImg'];?>" class="imageAbove" alt="<?php echo $listItem['imgAlt'];?>" title="<?php echo $listItem['imgAlt'];?>" />
							</div>
						</div>
						<div class="blgTxts">
							<span class="blgTitles"><?php echo $listItem['title'];?></span>
							<span class="blgSubtxt"><?php echo $listItem['content'];?></span>
						</div>
					</div>
				</a>
			</div>
			<?php $i++; ?>
		<?php }?>

		<div class="clear"></div>

		<a id="blgmBtn" href="<?php echo $blogLink;?>">
			<?php echo $blogTxt;?>
		</a>

	</div><!-- END OF HBCONTAINER -->

<?php }?>


<?php if($awardDisplay == 'yes'){ ?>

	<?php
		$awardLogos = get_field('award_logos','options');
	?>

	<div id="hawContainer" class="hbContainers">

		<h3 class="hbSectitles"><?php echo $hawTitle;?></h3>

		<div id="hawSwiper">

			<div class="swiper-container">

				<div class="swiper-wrapper">

					<?php foreach ($awardLogos as $logos) { ?>

						<div class="swiper-slide">

							<?php
								if($logos['alt'] == ''){
									$logos['alt'] = $defaultAlt;
								}
								if(wp_is_mobile()){
									$logos['url'] = $logos['sizes']['medium_large'];
								}
							?>

							<div class="bgImage" style="background-image: url('<?php echo esc_url($logos['url']);?>');" title="<?php echo esc_attr($logos['alt']);?>" aria-label="<?php echo esc_attr($logos['alt']);?>"></div>

							<img src="<?php echo get_template_directory_uri();?>/images/logoPlacement.png" alt="<?php echo $defaultAlt;?>" class="placement" />

							<img src="<?php echo esc_url($logos['url']);?>" alt="<?php echo esc_attr($logos['alt']);?>" title="<?php echo esc_attr($logos['alt']);?>" class="imageAbove" aria-label="<?php echo esc_attr($logos['alt']);?>" class="imageAbove" />

						</div>

					<?php }?>

				</div>

			</div>

		</div>

	</div><!-- END OF HCLCONTAINER -->

	<script type="text/javascript">

		var clientSwiper;
		var width = $(window).width();

		$(document).ready(function(){

			width = $(window).width();

			clientSwiper = new Swiper('#hawSwiper .swiper-container',{
				speed: 1100,
				//centeredSlides: true,
				autoplay: {
					delay: 4000,
					disableOnInteraction: false,
					reverseDirection: true,
				},
				breakpoints: {
				    // when window width is >= 320px
				    533: {
				      slidesPerView: 1,
				      //spaceBetween: 40
				    },
				    // when window width is >= 480px
				    768: {
				      slidesPerView: 2,
				      //spaceBetween: 70
				    },
				    // when window width is >= 640px
				    980: {
				      slidesPerView: 3,
				      //spaceBetween: 70
				    },
				    1024: {
				      slidesPerView: 4,
				      //spaceBetween: 80
				    }
				},
				autoHeight: true,
				roundLengths: true,
				// Disable preloading of all images
			    preloadImages: false,
			    // Enable lazy loading
			    lazy: true,
				loop: true
			});

		});

		$(window).on('load', function(){ // WAITS TILL THE WHOLE PAGE LOADS
			//clientSwiper.update();
		});

		$(window).resize(function() {
			width = $(window).width();

			clientSwiper.update();
		});


	</script>

<?php }?>


<?php if($clientDisplay == 'yes'){ ?>

	<?php
		$clientLogos = get_field('client_logos','options');
	?>

	<div id="hclContainer" class="hbContainers">

		<h4 class="hbSectitles"><?php echo $hclTitle;?></h4>

		<div id="hclSwiper">

			<div class="swiper-container">

				<div class="swiper-wrapper">

					<?php foreach ($clientLogos as $logos) { ?>

						<div class="swiper-slide">

							<?php
								if($logos['alt'] == ''){
									$logos['alt'] = $defaultAlt;
								}
								if(wp_is_mobile()){
									$logos['url'] = $logos['sizes']['medium_large'];
								}
							?>

							<div class="bgImage" style="background-image: url('<?php echo esc_url($logos['url']);?>');" title="<?php echo esc_attr($logos['alt']);?>" aria-label="<?php echo esc_attr($logos['alt']);?>"></div>

							<img src="<?php echo get_template_directory_uri();?>/images/logoPlacement.png" alt="<?php echo $defaultAlt;?>" class="placement" />

							<img src="<?php echo esc_url($logos['url']);?>" alt="<?php echo esc_attr($logos['alt']);?>" title="<?php echo esc_attr($logos['alt']);?>" class="imageAbove" aria-label="<?php echo esc_attr($logos['alt']);?>" class="imageAbove" />

						</div>

					<?php }?>

				</div>

			</div>

		</div>

	</div><!-- END OF HCLCONTAINER -->

	<script type="text/javascript">

		var clientSwiper;
		var width = $(window).width();

		$(document).ready(function(){

			width = $(window).width();

			clientSwiper = new Swiper('#hclSwiper .swiper-container',{
				speed: 1100,
				//centeredSlides: true,
				autoplay: {
					delay: 4000,
					disableOnInteraction: false,
					reverseDirection: true,
				},
				breakpoints: {
				    // when window width is >= 320px
				    533: {
				      slidesPerView: 1,
				      //spaceBetween: 40
				    },
				    // when window width is >= 480px
				    768: {
				      slidesPerView: 2,
				      //spaceBetween: 70
				    },
				    // when window width is >= 640px
				    980: {
				      slidesPerView: 3,
				      //spaceBetween: 70
				    },
				    1024: {
				      slidesPerView: 4,
				      //spaceBetween: 80
				    }
				},
				autoHeight: true,
				roundLengths: true,
				// Disable preloading of all images
			    preloadImages: false,
			    // Enable lazy loading
			    lazy: true,
				loop: true
			});

		});

		$(window).on('load', function(){ // WAITS TILL THE WHOLE PAGE LOADS
			//clientSwiper.update();
		});

		$(window).resize(function() {
			width = $(window).width();

			clientSwiper.update();
		});


	</script>

<?php }?>

<?php if(have_rows('home_contact_group')):?>

	<div id="hcntContainer">

		<?php while(have_rows('home_contact_group')){ the_row();?>

			<div id="hcntRight">

				<?php
					$hcImgRght = get_template_directory_uri().'/images/homeContact.jpg';
					$hcImgAlt = $defaultAlt;
					if(have_rows('home_contact_right')){
						while(have_rows('home_contact_right')){
							the_row();
							$imgRght = get_sub_field('home_contact_photo');
							if($imgRght != ''){
								$hcImgRght = $imgRght['url'];
								$hcImgAlt = $imgRght['alt'];
							}
						}
					}
				?>

				<div class="bgImage" style="background-image: url('<?php echo $hcImgRght;?>');"></div>
				<img data-src="<?php echo $hcImgRght;?>" alt="<?php echo $hcImgAlt;?>" class="imageAbove" />

			</div><!-- END OF HCNTRIGHT -->

			<div id="hcntLeft">

				<div id="hcntWrapper">
					<?php
						$hcntTitle = 'We\'d love to tell your story';
						if(have_rows('home_contact_left')){
							while(have_rows('home_contact_left')){
								the_row();
								$tempTitle = get_sub_field('home_contact_title');
								if($tempTitle != ''){
									$hcntTitle = $tempTitle;
								}
								$hcntTxt = get_sub_field('home_contact_text');
								$tempForm = get_sub_field('home_contact_form');
							}
						}
					?>

					<span id="clftTitle"><?php echo $hcntTitle;?></span>

					<?php if($hcntTxt != ''){ ?>
						<div id="clftTxt"><?php echo $hcntTxt;?></div>
					<?php }?>

					<?php if($tempForm != ''){?>
						<div id="clftfContainer">

							<?php echo do_shortcode(''.$tempForm.'');?>

							<?php //echo do_shortcode( '[contact-form-7 id="4368" title="Home Mini Form"]' );?>

						</div>
					<?php }?>

				</div>

			</div><!-- END OF HCNTLEFT -->

			<div class="clear"></div>

		<?php }?>

	</div><!-- END OF HCNTCONTAINER -->

<?php endif;?>

<script type="text/javascript">

	var winWidth = $(window).width();
	var paraPos;

	paraPos = '18vw';

	//DEFAULT SCROLL TRIGGER SETTINGS
	ScrollTrigger.defaults({
		toggleActions:"restart none none reset",
		//markers: true,
		scrub: 1
	});

	if(winWidth >= 768 && winWidth < 980){
		paraPos = '5vw';
	}


	if(winWidth >= 980){
		paraPos = '3vw';
	}

	//SCROLL TRIGGER SERVBOX 1
	var srbTrigger1 = gsap.timeline({
		ease: "none",
	    scrollTrigger: {
	      trigger: "#serviceBox1",
	      scrub: true,
	      start: "top 30%",
	      end: "center top"
	    }
	})
	.fromTo("#serviceBox1 .srvTitles", {y: paraPos}, {y: 0})
	//.fromTo("#serviceBox1 .svSubtles", {y: 0, opacity: 1}, {y: 100, opacity: 0})
	//.fromTo("#serviceBox1 .srvTitles", {opacity: 0}, {opacity: 1})


	//SCROLL TRIGGER SERVBOX 2
	var srbTrigger2 = gsap.timeline({
		ease: "none",
	    scrollTrigger: {
	      trigger: "#serviceBox2",
	      scrub: true,
	      start: "top 30%",
	      end: "center top"
	    }
	})
	.fromTo("#serviceBox2 .srvTitles", {y: paraPos}, {y: 0})
	//.fromTo("#serviceBox2 .svSubtles", {y: 0, opacity: 1}, {y: 100, opacity: 0})
	//.fromTo("#serviceBox2 .srvTitles", {opacity: 0}, {opacity: 1})



	//SCROLL TRIGGER SERVBOX 3
	var srbTrigger3 = gsap.timeline({
		ease: "none",
	    scrollTrigger: {
	      trigger: "#serviceBox3",
	      scrub: true,
	      start: "top 30%",
	      end: "center top"
	    }
	})
	.fromTo("#serviceBox3 .srvTitles", {y: paraPos}, {y: 0})
	//.fromTo("#serviceBox3 .svSubtles", {y: 0, opacity: 1}, {y: 100, opacity: 0})
	//.fromTo("#serviceBox3 .srvTitles", {opacity: 0}, {opacity: 1})


	//SCROLL TRIGGER SERVBOX 4
	var srbTrigger4 = gsap.timeline({
		ease: "none",
	    scrollTrigger: {
	      trigger: "#serviceBox4",
	      scrub: true,
	      start: "top 30%",
	      end: "center top"
	    }
	})
	.fromTo("#serviceBox4 .srvTitles", {y: paraPos}, {y: 0})
	//.fromTo("#serviceBox4 .svSubtles", {y: 0, opacity: 1}, {y: 100, opacity: 0})
	//.fromTo("#serviceBox4 .srvTitles", {opacity: 0}, {opacity: 1})


	$(document).ready(function() { // will be executed immediately

		winWidth = $(window).width();

		//alert('<?php echo $link;?>');

		<?php if($link == 'https://clementinecreativeagency.com/?services'){ ?>

			$('html, body').animate({
		        scrollTop: $('#sbContainer').offset().top
		    }, 'slow');

		<?php }?>

		<?php if($link == 'https://clementinecreativeagency.com/?branding'){ ?>

			$('html, body').animate({
		        scrollTop: $('#serviceBox1').offset().top
		    }, 'slow');
			srvReveal('1');

		<?php }?>

		<?php if($link == 'https://clementinecreativeagency.com/?visuals'){ ?>

			$('html, body').animate({
		        scrollTop: $('#serviceBox2').offset().top
		    }, 'slow');
			srvReveal('2');

		<?php }?>

		<?php if($link == 'https://clementinecreativeagency.com/?social'){ ?>

			$('html, body').animate({
		        scrollTop: $('#serviceBox3').offset().top
		    }, 'slow');
			srvReveal('3');

		<?php }?>

		<?php if($link == 'https://clementinecreativeagency.com/?web'){ ?>

			$('html, body').animate({
		        scrollTop: $('#serviceBox4').offset().top
		    }, 'slow');
			srvReveal('4');

		<?php }?>

	});

	function srvReveal(number){
		/*if($('#serviceBox'+number+' .srvDetails').is(':hidden')){
			$('#serviceBox'+number+' .srvDetails').slideDown();
			$('#serviceBox'+number+' i').addClass('arrowDown');
		}else{
			$('#serviceBox'+number+' .srvDetails').slideUp();
			$('#serviceBox'+number+' i').removeClass('arrowDown');
		}*/
		if($('#srvDetail'+number).is(':hidden')){
			$('#serviceBox'+number+' .svSubtles').css('opacity',1);
			$('#srvDetail'+number).slideDown();
			$('#serviceBox'+number+' i').addClass('arrowDown');
		}else{
			$('#serviceBox'+number+' .svSubtles').css('opacity',0);
			$('#srvDetail'+number).slideUp();
			$('#serviceBox'+number+' i').removeClass('arrowDown');
		}
	}

	$(window).load(function(){
		winWidth = $(window).width();
	});

	$(window).resize(function(){
		winWidth = $(window).width();

		paraPos = '18vw';

		if(winWidth >= 768 && winWidth < 980){
			paraPos = '10vw';
		}


		if(winWidth >= 980){
			paraPos = '9vw';
		}
	});

</script>

<?php get_footer(); ?>
