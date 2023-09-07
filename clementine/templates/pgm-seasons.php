<?php
/**
 * Template Name: Peel Good Seasons
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage CCA
 * @since 1.0
 */

get_header(); ?>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/shuffle.js"></script>

<?php
	$pageTitle = get_the_title();

	$defaultImg = get_template_directory_uri().'/images/pgmDefault.jpg';

	$cuName = htmlspecialchars($_GET["category"]);

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
	$j = 0;

	$portfolio = array(array());
	$catList = array();
	$catSlug = array();
	$catgList = array(array());
	$homeCount = '';

	$args = array( 'post_type' => 'pgm', 'posts_per_page' => -1, 'orderby'=>'date', 'order'=>'DESC');

	$cats = get_categories($args);

	$list_of_posts = new WP_Query( $args );
	//sort($list_of_posts);
	while ( $list_of_posts->have_posts() ) :
		$list_of_posts->the_post();

		//$portfolio[$i]['categories'] = 'all';
		$category = get_the_terms($post->ID, 'pgmseasons');
		foreach($category as $cat){ //CREATES THE CATEGORY LIST FOR POST
			if(in_array($cat->name, $catList)) {
				continue;
			}else{
				$catList[$j] .= $cat->name;

				$catgList[$j]['catNames'] .= $cat->name;
				$catgList[$j]['catSlug'] .= $cat->slug;
				$j++;
			}
			$portfolio[$i]['categories'] .= ''.$cat->slug;
			$portfolio[$i]['categoryNames'] .= $cat->name.' ';
		}


		//SORT CATEGORIES BY ASCENDING ORDER
		array_multisort($catgList, SORT_DESC);

		$portfolio[$i]['termList2'] = '"all"';
		$portfolio[$i]['tdList'] = 'all';
		$portfolio[$i]['termList'] = get_the_term_list( $post->ID, 'pgmseasons', 'People: ', ', ' );
		$termList = wp_get_object_terms( $post->ID,  'pgmseasons' );

		if ( ! empty( $termList ) ) {
		    if ( ! is_wp_error( $termList ) ) {	       
		    	foreach( $termList as $term ) {
		     		//$portfolio[$i]['termList2'] .= esc_html( $term->name );
		     		$portfolio[$i]['termList2'] .= ',"'.esc_html( $term->slug ).'"';
		     		$portfolio[$i]['tdList'] .= ' / '.esc_html( $term->name );
		        }
		        echo '</ul>';
		    }
		}

		//$portfolio[$i]['embed'] = get_field('peel_good_embed');
		$portfolio[$i]['ytembed'] = get_field('peel_good_youtube_embed');
		$portfolio[$i]['sptfyembed'] = get_field('peel_good_spotify_embed');

		$portfolio[$i]['postLink'] = get_post_permalink();
		$portfolio[$i]['title'] = get_the_title();
		
		if(get_field('episode_excerpt')){
			$portfolio[$i]['excerpt'] = get_field('episode_excerpt');
		}else{
			$portfolio[$i]['excerpt'] = get_the_content();
		}

		$portfolio[$i]['content'] = apply_filters( 'the_content', get_the_content() );

		if(have_rows('episode_social_media')){
			$k = 0;
			while(have_rows('episode_social_media')){
				the_row();
				$portfolio[$i]['sm'][$k]['socialType'] = get_sub_field('social_type');
				$portfolio[$i]['sm'][$k]['socialIcon'] = get_sub_field('social_custom_icon')['url'];
				$portfolio[$i]['sm'][$k]['iconAlt'] = get_sub_field('social_custom_icon')['alt'];
				$portfolio[$i]['sm'][$k]['socialLink'] = get_sub_field('social_link');
				$k++;
			}
		}


		$portfolio[$i]['postAlt'] = $pcthLogo_Alt;
		$portfolio[$i]['postImg'] = get_template_directory_uri().'/images/pgmDefault.jpg';

		if(has_post_thumbnail()){
			$portfolio[$i]['postImg'] = get_the_post_thumbnail_url();
			$thumbnail_id = get_post_thumbnail_id( $post->ID );
			$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
			if($portfolio[$i]['postImg'] == ''){
				$portfolio[$i]['postImg'] = get_template_directory_uri().'/images/pgmDefault.jpg';
			}
		}

		$i++;

	endwhile;

	$total = $i;

	wp_reset_postdata();

?>

<style type="text/css">
	
	#pgmTop h1, #pgmTop h2,
	#pgmTop h3, #pgmTop h4,
	#pgmTop h5, #pgmTop h6,
	#pgmTop hr{
	  color: <?php echo $pgmlTxt;?>;
	}

	#pgmTop a, #pgmTop a:hover,
	#pgmcWrapper .buttonAnimation a,
	#pgmcWrapper .buttonAnimation a:hover{
		color: <?php echo $pgmlTxt;?>; 
	}

	#pgmcWrapper .buttonAnimation .line,
	#pgmcWrapper .buttonAnimation a::after{
		background:<?php echo $pgmlTxt;?>; 
	}

	.pgmExcrpt a, .pgmExcrpt a:hover,
	.pgmitmBtm a, .pgmitmBtm a:hover{
		color: <?php echo $pgmlTxt;?>; 
	}

	.epsodLinks a{
	  color: <?php echo $pgmlTxt;?>;
	  border: 2px solid <?php echo $pgmlTxt;?>;
	}

	.epsodLinks a:hover{
	  color:<?php echo $pgmlBckg;?>;
	  background: <?php echo $pgmlTxt;?>;
	}

</style>

<div id="pgmWrapper" style="background-color:<?php echo $pgmlBckg;?>;color:<?php echo $pgmlTxt;?>;">

	<div id="pgmTop">
		
		<div id="pgmtVideo" style="background-image: url('<?php echo $defaultImg;?>');">
			
			<div class="pgmvidWrappers">
				
				<div class="viWrappers">
					
					<iframe style="position:absolute;top:0;left:0;width:100%;height:100%;" src="<?php echo $portfolio[0]['ytembed'];?>" title="<?php echo $blogTitle;?>" frameborder="0" allow="autoplay; fullscreen" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

				</div><!-- END OF VIWRAPPERS -->

			</div><!-- END OF PGMVIDWRAPPERS -->

		</div><!-- END OF PGMTVIDEO -->


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

				$seasonSlct = 'all';
				$pgmSeason = get_field('peel_good_season_select');

				if($pgmSeason){
					$seasonSlct = esc_html( $pgmSeason->slug );
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

				</div><!-- END OF PGMLWRAPPER -->

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
			</div><!-- END OF PGMTPTXT -->


		</div><!-- END OF PGMTINFO -->


	</div><!-- END OF PGMTOP -->

	<div id="pgmcWrapper">
		
		<div id="pcatContainer">
			
			<div id="catButtons" class="buttonAnimation">

				<?php
					$i = 1;
					foreach($catgList as $category){
						$catItem = $category['catSlug'];
				?>

					<div class="filterBtns">
						<a id="<?php echo $catItem;?>Btn" class="galCategories animBtns" data-group="<?php echo $catItem;?>" href="javascript:updatePGM('<?php echo $catItem;?>','<?php echo $catItem;?>Btn');">
							<span class="btnTxt"><?php echo $category['catNames'];?></span>
							<span class="line -right"></span>
							<span class="line -top"></span>
							<span class="line -left"></span>
							<span class="line -bottom"></span>		
						</a>
					</div>
				
				<?php
						$i++;
					}
				?>

				<div class="clear"></div>

			</div>

			<div style="position:relative;" class="gsContainer" id="gmcSelect">
				<select id="galmasSelect" class="galSelect" onChange="updatePGM(this.value);">
		            <?php foreach($catgList as $category){ ?>
		            <option value="<?php echo $category['catSlug'];?>"><?php echo $category['catNames'];?></option>
		            <?php }?>
		        </select>  
			</div>

		</div>

	</div><!-- END OF PGMCWRAPPER -->

	<div id="pgmContainer" class="grid">

		<?php
			$j = 1; 
			foreach($portfolio as $listItem){ 
		?>

			<!--<div id="portfolioItem<?php echo $j;?>" class="pgmItems cols2" data-groups='[<?php echo $listItem['termList2'];?>]'>
				<a href="<?php echo $listItem['postLink'];?>">
					<div class="bgImage effect2" style="background-image: url('<?php echo $listItem['postImg'];?>');"></div>
					<img class="portImgs" style="opacity:0;" src="<?php echo $listItem['postImg'];?>" alt="<?php echo $listItem['title'];?>" />
					<div class="folioInfos2 effect2"><div class="tealOverlay effect2"></div></div>
					<div class="folioInfos effect2">
						<div class="fInfowrapper effect2">
							<span class="folioTitles">
								<?php echo $listItem['title'];?>		
							</span>
						</div>
					</div>
				</a>
			</div>-->

			<div id="pgmItem<?php echo $j;?>" class="pgmItems shufItems" data-groups='[<?php echo $listItem['termList2'];?>]'>

				<div class="pgmitmTop">
					<iframe loading="lazy" title="<?php echo $listItem['title'];?>" allowtransparency="true" allow="encrypted-media" src="<?php echo $listItem['sptfyembed'];?>" data-origwidth="100%" data-origheight="232" style="width: 316px;" width="100%" height="232" frameborder="0"></iframe>
					<!--<div class="bgImage" style="background-image: url('<?php echo $listItem['postImg'];?>');"></div>
					<img class="imageAbove" src="<?php echo $listItem['postImg'];?>" alt="<?php echo $listItem['postAlt'];?>" />-->
				</div><!-- END OF PGMITMTOP -->

				<div class="pgmitmMid">
					<span class="pgmTitles"><?php echo $listItem['title'];?></span>
					<div class="pgmExcrpt"><?php echo $listItem['excerpt'];?></div>
				</div><!-- END OF PGMITMMID -->

				<div class="pgmitmBtm">

					<span class="pgmSubtitles">View the Episode</span>

					<?php foreach($listItem['sm'] as $social){ ?>

						<span class="pgmIcons">

							<?php if($social['socialLink'] != '' && $social['socialLink'] != NULL){?>
								<!--<a data-fancybox data-type="iframe" data-src="<?php echo $social['socialLink'];?>" href="javascript:;">-->
								<a href="<?php echo $social['socialLink'];?>" target="_blank">
							<?php }?>

								<?php if($social['socialIcon'] != '' && $social['socialIcon'] != NULL){?>
									<img src="<?php echo $social['socialIcon'];?>" alt="<?php echo $social['socialType'];?>" />
								<?php }else{?>
									<i class="icon-<?php echo $social['socialType'];?>"></i>
								<?php }?>

							<?php if($social['socialLink'] != '' && $social['socialLink'] != NULL){?>
								</a>
							<?php }?>

						</span>

					<?php }?>

				</div><!-- END OF PGMITMBTM -->

			</div>

		<?php 
					//$total--;
				$j++;
			}
		?>
		
		<div class="shufItems sizer"></div>

	</div><!-- END OF GRID -->

</div><!-- END OF PGMWRAPPER -->

<script type="text/javascript">

	var Shuffle = window.Shuffle;
	var element = document.querySelector('.grid');
	var sizer = element.querySelector('.sizer');
	var winWidth = $(window).width();
	var winHeight = $(window).height();

	var shuffleInstance = new Shuffle(element, {
	  itemSelector: '.pgmItems',
	  columnWidth: 0,
	  sizer: sizer // could also be a selector: '.my-sizer-element'
	});

	$(document).ready(function(){
		winWidth = $(window).width();
		winHeight = $(window).height();
		//updatePGM('all','allBtn');
		<?php if($_GET['category'] == true){ ?>

			updatePGM('<?php echo $cuName;?>');

		<?php }else{ ?>

			updatePGM('<?php echo $seasonSlct;?>');

		<?php }?>
		shuffleInstance.update();
	});

	function updatePGM(category){
		$('#catButtons a').removeClass('active');
		$('#galmasSelect').val(category);
		shuffleInstance.filter(category);
		$('#'+category+'Btn').addClass('active');
		if(winWidth < 768){
			//$('html, body').animate({'scrollTop': $(window).height()}, 1000);
			//alert(topContainheight);
			$('html, body').animate({scrollTop: $('#portContainer').offset().top - 137 }, 'slow');
		}
	}

</script>


<?php get_footer(); ?>
