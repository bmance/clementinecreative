<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header(); 

$pageTitle = get_the_title();
$date = get_the_date( 'F j, Y' );
$current_url = home_url( add_query_arg( array(), $wp->request ) );
$blogUrl = get_page_link(28);

$postImage = get_template_directory_uri().'/images/postDefault.png';

if(get_the_post_thumbnail_url()){
	$postImage = get_the_post_thumbnail_url();
}

$postCategories = get_the_terms( $post->ID, 'category' );
if ( ! empty( $postCategories ) && ! is_wp_error( $postCategories ) ) {
    //$blog[$i]['cateSeparate'] = wp_list_pluck( $postCategories, 'name' );
    $categoryList = join(', ', wp_list_pluck($postCategories, 'name'));
}

$category = get_the_terms($post->ID, 'category');
$categorySize = sizeof($category);

$blgBtntxt = 'See Our Blog';
$blgBtn = '/blog';

$tempBtntxt = get_field('universal_blog_button_text','options');
$tempBtn = get_field('universal_blog_page_link','options');

if($tempBtntxt != '' && $tempBtntxt != NULL){
	$blgBtntxt = $tempBtntxt;
}

if($tempBtn != '' && $tempBtn != NULL){
	$blgBtn = $tempBtn;
}

?>

<?php
$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>

<div id="bpContainer" class="postWrappers">
	
	<?php if(have_rows('blog_top_section')){ ?>

		<div class="postTop">
			
			<?php while(have_rows('blog_top_section')){ the_row(); ?>

				<?php if(have_rows('blog_top_left')){?>
					
					<?php 
						$lftbkgColor = '#ff8200';
						$lftxtColor = '#ffffff';
						$overlayActivate;
						while(have_rows('blog_top_left')){
							the_row();
							$overlayActivate = get_sub_field('feature_image_overlay');
							$tempBckColor = get_sub_field('left_background_color');
							if($tempBckColor != '' && $tempBckColor != NULL){
								$lftbkgColor = $tempBckColor;
							}
							$tempTxtColor = get_sub_field('left_text_color');
							if($tempTxtColor != '' && $tempTxtColor != NULL){
								$lftxtColor = $tempTxtColor;
							}

							if($overlayActivate == 'no' || $overlayActivate == '' || $overlayActivate == NULL){
								$leftStyle = 'background-color:'.$lftbkgColor.'; color:'.$lftxtColor.';';
							?>
								<style type="text/css">
									.ptlbShare, .ptlbShare a,
									.ptlbCategories, .ptlbCategories a{
										color:<?php echo $lftxtColor;?>;
									}
								</style>
							<?
							}else{
								$leftStyle = 'color:#ffffff;background-image: url(\''.$postImage.'\');';
							?>
								<style type="text/css">
									.ptlbShare, .ptlbShare a,
									.ptlbCategories, .ptlbCategories a{
										color: #fff;
									}
								</style>
							<?
							}

					?>
					<div class="ptLeft" style="<?php echo $leftStyle;?>">
						<?php if($overlayActivate != 'no' && $overlayActivate != '' && $overlayActivate != NULL){ ?>
							<div class="tealOverlay effect2"></div>
						<?php }?>
						<div class="plbWrapper">
							<div class="rel">
								<div class="ptlTitles">
									<h1><?php echo $pageTitle;?></h1>
								</div>
								<div class="ptlbInfos">				
									<span class="ptlbDates">
										<?php echo $date;?>
									</span>
									<span class="ptlbCategories">
										<?php //echo $categoryList;?>
										<?php //echo $categorySize;?>
										<?php //var_dump($category);?>

										<?php
											$i = 1; 
											foreach($category as $cat){

												$catLink = '/blog?category="'.trim($cat->slug).'"';

												if($categorySize > 1){

													if($i > 1){
														echo ', ';
													}
												?>

													<a href="/blog?category=<?php echo $cat->slug;?>">
														<?php echo $cat->name;?>
													</a>

												<?php
													

												}else{

													//echo '<a href="'.$blogUrl.'?category="'.$cat->name.'"">';
													/*echo '<a href="'.$catLink.'">';
														echo $cat->name;
														echo $cat->slug;
													echo '</a>';*/
												?>

													<a href="/blog?category=<?php echo $cat->slug;?>">
														<?php echo $cat->name;?>
													</a>

												<?php


												}
												$i++;
											}
										?>
									</span>
									<div class="ptlbShare">
										<a href="https://twitter.com/intent/tweet?url=<?php echo $current_url;?>" target="_blank">
											<i class="icon-twitter"></i>
										</a>
										<a href="https://www.facebook.com/sharer.php?u=<?php echo $current_url;?>" target="_blank">
											<i class="icon-facebook"></i>
										</a>
									</div>
								</div><!-- END OF PTLBINFOS -->
							</div>
						</div>
					</div><!-- END OF PTLEFT -->
					<?php }?>
					
				<?php }?>

				<?php if(have_rows('blog_top_right')){?>
					<?php
						$rghtbkgColor = '#00778B';
						$rghtxtColor = '#ffffff'; 
						$defaultClass = '';
						while(have_rows('blog_top_right')){
							the_row();
							$rightExcerpt = get_sub_field('right_excerpt');

							if($rightExcerpt == '' || $rightExcerpt == NULL){
								$defaultClass = ' noExcerpt';
							}

							$tempBckColor2 = get_sub_field('right_background_color');
							if($tempBckColor2 != '' && $tempBckColor2 != NULL){
								$rghtbkgColor = $tempBckColor2;
							}
							$tempTxtColor2 = get_sub_field('right_text_color');
							if($tempTxtColor2 != '' && $tempTxtColor2 != NULL){
								$rghtxtColor = $tempTxtColor2;
							}
					?>
						<div class="ptRight<?php echo $defaultClass;?>" style="color:<?php echo $rghtxtColor;?>;background-color:<?php echo $rghtbkgColor;?>;">
							<div class="rel">
								<?php echo $rightExcerpt;?>
							</div>
						</div><!-- END OF PTRIGHT -->
					<?php }?>
				<?php }?>

			<?php }?>

			<div class="clear"></div>

		</div><!-- END OF POSTTOP -->

	<?php }?>

	<div class="postMid">
		<?php
			if(have_posts()){
				while(have_posts()):
					the_post();
					the_content();
				endwhile; 
			}
		?>

		<?php
			if(!isset($_COOKIE[$cookie_name])) {
			     //echo "Cookie named '" . $cookie_name . "' is not set!";
			} else {
			     //echo "Cookie '" . $cookie_name . "' is set!<br>";
			     //echo "Value is: " . $_COOKIE[$cookie_name];
			}
		?>


	</div><!-- END OF POSTMID -->

	<a class="pbButtons" href="<?php echo $blgBtn;?>">
		<?php echo $blgBtntxt; ?>		
	</a>

</div>

<?php
	$blgPop = get_field('blog_popup','options');
	$blgBckg = get_template_directory_uri().'/images/clementines.jpg';
	$tempBckg = get_field('blog_popup_background_image','options'); 

	if($tempBckg != '' && $tempBckg != NULL){
		$blgBckg = $tempBckg['url'];
	}

	$blgTxt = get_field('blog_popup_text','options'); 
	if($blgPop == true){ 
?>

	<div id="blgpstpop" style="display:none;max-width: 1024px;margin:0px auto;">
		
		<div class="bgImage" style="background-image: url('<?php echo $blgBckg;?>');"></div>

		<div class="tealOverlay"></div>

		<div class="clmpopWrapper">

			<?php echo $blgTxt;?>

		</div>

	</div>

	<style type="text/css">
		
		.invisLinks{
			position: absolute;
			top: 0px;
			left: 0px;
			width: auto;
			height: auto;
			opacity: 0;
			filter: alpha(opacity=0);

			/*position: relative;
			width: 100px;
			height: 100px;
			background: red;*/
		}

	</style>

	<a id="blginvBtn" data-fancybox data-src="#blgpstpop" href="javascript:;" class="invisLinks">test</a>

	<script type="text/javascript">

		var wpcf7Elm = document.querySelector('.wpcf7');

		$(document).ready(function() {
		    if(localStorage.getItem('popState') != 'shown'){
		        openFancybox();
		    }
		});

		function openFancybox() {
		    // launches fancybox after half second when called
		    setTimeout(function () {
		        $("#blginvBtn")[0].click();
		    }, 7000);
		};

		document.addEventListener( 'wpcf7submit', function( event ) {
		 	$('.fancybox-close-small')[0].click();
		 	localStorage.setItem('popState','shown');
		}, false );

		$("#blgpstpop").fancybox({
			afterClose  : function() {
                //localStorage.setItem('popState','shown');
            }

    	});

		function popup(source){
			//$.fancybox.open({src  : '#blgpstpop'});
			$.fancybox.open({src  : source});
		}

	</script>

<?php }?>

<?php get_footer(); ?>
