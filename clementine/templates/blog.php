<?php
/**
 * Template Name: Blog
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
	$k = 0;
	$blog = array(array());
	$catList = array();
	$catSlug = array();
	$catgList = array(array());

	$args = array('posts_per_page' => -1, 'orderby'=>'date', 'order'=>'DESC');

	$cats = get_categories($args);

	$list_of_posts = new WP_Query( $args );
	//sort($list_of_posts);
	while ( $list_of_posts->have_posts() ) :

		$list_of_posts->the_post();

		$category = get_the_terms($post->ID, 'category');
		$terms_string = join(', ', wp_list_pluck($category, 'name'));

		foreach($category as $cat){ //CREATES THE CATEGORY LIST FOR POST
			if(in_array($cat->name, $catList)) {
				continue;
			}else{
				$catList[$j] .= $cat->name;

				$catgList[$j]['catNames'] .= $cat->name;
				$catgList[$j]['catSlug'] .= $cat->slug;
				$j++;
			}
			$blog[$i]['categories'] .= ''.$cat->slug;
			$blog[$i]['categoryNames'] .= $cat->name.' ';
		}


		$post_categories = get_the_terms( $post->ID, 'category' );
		if ( ! empty( $post_categories ) && ! is_wp_error( $post_categories ) ) {
		    //$blog[$i]['cateSeparate'] = wp_list_pluck( $post_categories, 'name' );
		    $blog[$i]['cateSeparate'] = join(', ', wp_list_pluck($post_categories, 'name'));
		}


		//FOR THE BLOG EXCERPT



		//FOR THE CATEGORY LIST
		$blog[$i]['postTerms'] = '"all"';
		$blog[$i]['ctList'] = 'all';

		$termList = wp_get_object_terms( $post->ID,  'category' );

		if ( ! empty( $termList ) ) {
		    if ( ! is_wp_error( $termList ) ) {
		    	foreach( $termList as $term ) {
		     		//$blog[$i]['termList2'] .= esc_html( $term->name );
		     		$blog[$i]['postTerms'] .= ',"'.esc_html( $term->slug ).'"';
		     		$blog[$i]['ctList'] .= ' / '.esc_html( $term->name );
		        }
		    }
		}

		$blog[$i]['postLink'] = get_post_permalink();
		$blog[$i]['title'] = get_the_title();
		$blog[$i]['date'] = get_the_date( 'F j, Y' );
		$blog[$i]['postAlt'] = $pcthLogo_Alt;
		$blog[$i]['postImg'] = get_template_directory_uri().'/images/postDefault.png';

		if(has_post_thumbnail()){
			$blog[$i]['postImg'] = get_the_post_thumbnail_url();
			$thumbnail_id = get_post_thumbnail_id( $post->ID );
			$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
			if($blog[$i]['postImg'] == ''){
				$blog[$i]['postImg'] = get_template_directory_uri().'/images/postDefault.png';
			}
			//$blog[$i]['postAlt'] = get_bloginfo('name');
			if($alt != ''){
				//$blog[$i]['postAlt'] = esc_html ( $alt );
			}else{
				//$blog[$i]['postAlt'] = $pcthLogo_Alt;
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

<div id="blgContainer">

	<?php if($content != '' && $content != NULL){ ?>

		<div id="blgTop">

			<div id="blgTitle">
				<div class="rel">
					<h1><?php echo $pageTitle;?></h1>
				</div>
			</div><!-- END OF BLGTITLE -->

			<div id="blgContent">
				<div class="rel">
					<?php echo $content;?>
				</div>
			</div><!-- END OF BLGCONTENT -->

			<div class="clear"></div>

		</div><!-- END OF BLGTOP -->

	<?php }else{ ?>

		<div id="blgTitletop">
			<h1><?php echo $pageTitle;?></h1>
		</div>

	<?php }?>

	<div id="blgcatBtns">

		<div id="blgBtnwrapper" class="buttonAnimation">

			<div class="filterBtns">
				<a id='allBtn' data-group="all" class="galCategories animBtns" data-group="all" href="javascript:updateBlog('all','allBtn');">
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

				<div class="filterBtns">
					<a id="<?php echo $catItem;?>Btn" class="galCategories animBtns" data-group="<?php echo $catItem;?>" href="javascript:updateBlog('<?php echo $catItem;?>','<?php echo $catItem;?>Btn');">
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

		</div><!-- END OF BLGBTNWRAPPER -->

	</div><!-- END OF BLGCATBTNS -->

	<div style="position:relative;" class="gsContainer" id="blgSelect">
		<select id="blgmSelect" class="galSelect" onChange="updateBlog(this.value);">
			<option value="all">All</option>
            <?php foreach($catgList as $category){ ?>
            <option value="<?php echo $category['catSlug'];?>"><?php echo $category['catNames'];?></option>
            <?php }?>
        </select>
	</div>


	<div id="blogList" class="grid">

		<?php
			$j = 1;
			foreach($blog as $listItem){
		?>

			<div id="bpItem<?php echo $j;?>" class="blogItems itemCols" data-groups='[<?php echo $listItem['postTerms'];?>]'>
				<a href="<?php echo $listItem['postLink'];?>">
					<div class="blgImg_inner">
						<img class="effect2" src="<?php echo $listItem['postImg'];?>" alt="<?php echo $listItem['title'];?>" />
						<div class="blogInfo">
							<span class="blgTitles"><?php echo $listItem['title'];?></span>
							<span class="blgCats"><?php echo $listItem['cateSeparate'];?></span>
							<span class="blgDate"><?php echo $listItem['date'];?></span>
							<div class="blgShare">

								<a href="https://twitter.com/intent/tweet?url=<?php echo $listItem['postLink'];?>" target="_blank">
									<i class="icon-twitter"></i>
								</a>

								<a href="https://www.facebook.com/sharer.php?u=<?php echo $listItem['postLink'];?>" target="_blank">
									<i class="icon-facebook"></i>
								</a>

							</div><!-- END OF BLGSHARE -->

						</div><!-- END OF BLGINFO -->

					</div><!-- END OF BLGIMG INNER -->

				</a>

			</div><!-- END OF BPITEM -->

		<?php
				$j++;
			}
		?>

		<div class="itemCols sizer"></div>

	</div><!-- END OF BLOGLIST -->

</div><!-- END OF BLGCONTAINER -->


<script type="text/javascript">

	var Shuffle = window.Shuffle;
	var element = document.querySelector('.grid');
	var sizer = element.querySelector('.sizer');
	var winWidth = $(window).width();
	var winHeight = $(window).height();

	var shuffleInstance = new Shuffle(element, {
	  itemSelector: '.blogItems',
	  columnWidth: 0,
	  sizer: sizer // could also be a selector: '.my-sizer-element'
	});

	$(document).ready(function(){
		winWidth = $(window).width();
		winHeight = $(window).height();
		//updateBlog('all','allBtn');
		<?php if($_GET['category'] == true){ ?>

			updateBlog('<?php echo $cuName;?>');

		<?php }else{ ?>

			updateBlog('all');

		<?php }?>
		shuffleInstance.update();
	});

	function updateBlog(category){
		$('#blgcatBtns a').removeClass('active');
		$('#blgmSelect').val(category);
		shuffleInstance.filter(category);
		$('#'+category+'Btn').addClass('active');
		if(winWidth < 768){
			//$('html, body').animate({'scrollTop': $(window).height()}, 1000);
			//alert(topContainheight);
			$('html, body').animate({scrollTop: $('#blogList').offset().top - 137 }, 'slow');
		}
	}



	$(window).resize(function(){
		shuffleInstance.update();
	});

</script>


<?php get_footer(); ?>
