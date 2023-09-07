<?php
/**
 * Template Name: Portfolio
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

	$cuName = htmlspecialchars($_GET["category"]);

	$i = 0;
	$j = 0;
	$portfolio = array(array());
	$catList = array();
	$catSlug = array();
	$catgList = array(array());
	$homeCount = '';

	$args = array( 'post_type' => 'portfolio', 'posts_per_page' => -1, 'orderby'=>'name', 'order'=>'ASC');

	$cats = get_categories($args);

	$list_of_posts = new WP_Query( $args );
	//sort($list_of_posts);
	while ( $list_of_posts->have_posts() ) :
		$list_of_posts->the_post();

		//$portfolio[$i]['categories'] = 'all';
		$category = get_the_terms($post->ID, 'portcategory');
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
		if(get_field('directory_subtext')){
			//$portfolio[$i]['subText'] = get_field('directory_subtext');
		}else{
			//$portfolio[$i]['subText'] = 'Visit';
		}
		$portfolio[$i]['termList2'] = '"all"';
		$portfolio[$i]['tdList'] = 'all';
		//$portfolio[$i]['termList2'] = 'all';
		$portfolio[$i]['termList'] = get_the_term_list( $post->ID, 'portcategory', 'People: ', ', ' );
		$termList = wp_get_object_terms( $post->ID,  'portcategory' );

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

		//$portfolio[$i]['termList2'] = wp_get_object_terms( $post->ID,  'portcategory' );

		$portfolio[$i]['postLink'] = get_post_permalink();
		$portfolio[$i]['title'] = get_the_title();
		//$portfolio[$i]['link'] = get_field('directory_link');
		$portfolio[$i]['postAlt'] = $pcthLogo_Alt;
		$portfolio[$i]['postImg'] = get_template_directory_uri().'/images/postDefault.png';

		if(has_post_thumbnail()){
			$portfolio[$i]['postImg'] = get_the_post_thumbnail_url();
			$thumbnail_id = get_post_thumbnail_id( $post->ID );
			$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
			if($portfolio[$i]['postImg'] == ''){
				$portfolio[$i]['postImg'] = get_template_directory_uri().'/images/postDefault.png';
			}
			//$portfolio[$i]['postAlt'] = get_bloginfo('name');
			if($alt != ''){
				//$portfolio[$i]['postAlt'] = esc_html ( $alt );
			}else{
				//$portfolio[$i]['postAlt'] = $pcthLogo_Alt;
			} 
		}

		$i++;

	endwhile;

	$total = $i;

	wp_reset_postdata();

	//FOR MAIN PAGE CONTENT
	if(have_posts()){
		while(have_posts()):
			the_post();
			$content = get_the_content();
		endwhile; 
	}

?>


<?php if($content != '' && $content != NULL){ ?>

	<div id="pmContainer">
		
		<?php 
			while(have_posts()):
				the_post();
				the_content();
			endwhile; 
		?>

	</div><!-- END OF HMCONTAINER -->

<?php }?>


<?php if($content != '' && $content != NULL){ ?>

		<div id="pmTop">

			<div id="pmTitle">
				<div class="rel">
					<h1><?php echo $pageTitle;?></h1>
				</div>
			</div><!-- END OF pmTITLE -->

			<div id="pmContent">
				<div class="rel">
					<?php echo $content;?>
				</div>
			</div><!-- END OF pmCONTENT -->

			<div class="clear"></div>

		</div><!-- END OF pmTOP -->

	<?php }else{ ?>

		<div id="pmTitletop">
			<h1><?php echo $pageTitle;?></h1>
		</div>

	<?php }?>


<div id="pCatwrapper">
	
	<div id="pcatContainer">
		
		<div id="catButtons" class="buttonAnimation">

			<div class="filterBtns">
				<a id='allBtn' data-group="all" class="galCategories animBtns" data-group="all" href="javascript:updatePortfolio('all','allBtn');">
					<span class="btnTxt">All</span>
					<span class="line -right"></span>
					<span class="line -top"></span>
					<span class="line -left"></span>
					<span class="line -bottom"></span>	
				</a>
			</div>

			<?php
				$i = 1;
				foreach($catgList as $category){
					$catItem = $category['catSlug'];
			?>

				<!--<span class="catDividers">/</span>-->

				<div class="filterBtns">
					<a id="<?php echo $catItem;?>Btn" class="galCategories animBtns" data-group="<?php echo $catItem;?>" href="javascript:updatePortfolio('<?php echo $catItem;?>','<?php echo $catItem;?>Btn');">
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
			<select id="galmasSelect" class="galSelect" onChange="updatePortfolio(this.value);">
				<option value="all">All</option> 
	            <?php foreach($catgList as $category){ ?>
	            <option value="<?php echo $category['catSlug'];?>"><?php echo $category['catNames'];?></option>
	            <?php }?>
	        </select>  
		</div>

	</div>

</div><!-- END OF pCatwrapper -->

<div id="portContainer" class="grid">

	<?php
		$j = 1; 
		foreach($portfolio as $listItem){ 
	?>

		<div id="portfolioItem<?php echo $j;?>" class="portItems cols2" data-groups='[<?php echo $listItem['termList2'];?>]'>
			<a href="<?php echo $listItem['postLink'];?>">
				<div class="bgImage effect2" style="background-image: url('<?php echo $listItem['postImg'];?>');"></div>
				<!--<img data-src="<?php echo $listItem['postImg'];?>" alt="<?php echo $listItem['title'];?>" class="imageAbove" />-->
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
		</div>

	<?php 
			$j++;
		}
	?>
	
	<div class="cols2 sizer"></div>

</div><!-- END OF GRID -->

<script type="text/javascript">

	var Shuffle = window.Shuffle;
	var element = document.querySelector('.grid');
	var sizer = element.querySelector('.sizer');
	var winWidth = $(window).width();
	var winHeight = $(window).height();

	var shuffleInstance = new Shuffle(element, {
	  itemSelector: '.portItems',
	  columnWidth: 0,
	  sizer: sizer // could also be a selector: '.my-sizer-element'
	});

	$(document).ready(function(){
		winWidth = $(window).width();
		winHeight = $(window).height();
		//updatePortfolio('all','allBtn');
		<?php if($_GET['category'] == true){ ?>

			updatePortfolio('<?php echo $cuName;?>');

		<?php }else{ ?>

			updatePortfolio('all');

		<?php }?>
		shuffleInstance.update();
	});

	function updatePortfolio(category){
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