<?php
/**
 * Template Name: Instagram
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage CCA
 * @since 1.0
 */

get_header(); ?>

<?php 
	$defaultAlt = get_bloginfo('name');

	//INSTAGRAM HEADER
	$ihImage = get_template_directory_uri().'/images/cca-original-logo.png';
	$ihAlt = $defaultAlt;

	//INSTAGRAM MIDTOP
	$imtpTxt = 'Celebrate that Cozy Fall Feeling';

	//INSTAGRAM MIDSECTION
	$imsImage = get_template_directory_uri().'/images/pgm-logo.png';
	$imAlt = $defaultAlt;

	//INSTAGRAM MIDBOTTOM

	//INSTAGRAM FOOTER
	$iftNumber = 4;
	$iftTitle = 'Recent Blog Posts';
?>

<div id="clmInstwrapper">
	
	<?php if(have_rows('instagram_header')){?>
		<div id="clmInstheader" class="clmInstasecs">
			<?php 
				while(have_rows('instagram_header')){
					the_row();
					$thlogo = get_sub_field('header_logo');
					if($thlogo != '' && $thlogo != NULL){
						$ihImage = $thlogo['url'];
						$ihAlt = $thlogo['alt'];
					}
					$thtxt = get_sub_field('header_logo_text');  
			?>

				<img src="<?php echo $ihImage;?>" alt="<?php echo $ihAlt;?>" />

				<?php if($thtxt != '' && $thtxt != NULL){ ?>
					<div class="clmInstTxt">
						<?php echo $thtxt;?>
					</div>
				<?php }?>

			<?php }?>
		</div>
	<?php }?>

	<?php if(have_rows('instagram_midtop')){?>
		<div id="clmInsMdtp" class="clmInstasecs">
			<?php 
				while(have_rows('instagram_midtop')){
					the_row();
					$tmtplogo = get_sub_field('midtop_image');
					$tmtptxt = get_sub_field('midtop_text');  
			?>

				<?php if($tmtptxt != '' && $tmtptxt != NULL){ ?>
					<div class="clmInstTxt">
						<?php echo $tmtptxt;?>
					</div>
				<?php }?>

				<?php if($tmtplogo != '' && $tmtplogo != NULL){ ?>
					<img src="<?php echo $tmtplogo['url'];?>" alt="<?php echo $tmtplogo['alt'];?>" />
				<?php }?>

			<?php }?>
		</div>
	<?php }?>

	<?php if(have_rows('instagram_midsection')){?>
		<div id="clmInsmid" class="clmInstasecs">
			<?php 
				while(have_rows('instagram_midsection')){
					the_row();
					$tmdlogo = get_sub_field('midsection_image');
					if($tmdlogo != '' && $tmdlogo != NULL){
						$imsImage = $tmdlogo['url'];
						$imAlt = $tmdlogo['alt'];
					}
					$tmdtxt = get_sub_field('midsection_text');  
			?>

				<?php if($tmdlogo != '' && $tmdlogo != NULL){ ?>
					<img src="<?php echo $imsImage;?>" alt="<?php echo $imAlt;?>" />
				<?php }?>

				<?php if($tmdtxt != '' && $tmdtxt != NULL){ ?>
					<div class="clmInstTxt">
						<?php echo $tmdtxt;?>
					</div>
				<?php }?>

			<?php }?>
		</div>
	<?php }?>

	<?php if(have_rows('instagram_midbottom')){?>
		<div id="clmInsMdbm" class="clmInstasecs">
			<?php 
				while(have_rows('instagram_midbottom')){
					the_row();
					$tmbtxt = get_sub_field('instagram_midbottom_text'); 
			?>

				<?php if(have_rows('instagram_buttons')){ ?>
					<div class="clmIBContainers">
						<?php 
							while(have_rows('instagram_buttons')){
								the_row();
								$buttonTxt = get_sub_field('button_text');
								$buttonLink = get_sub_field('button_link');

								echo '<a class="clmIButtons" href="'.$buttonLink.'">';
								echo $buttonTxt;
								echo '</a>';
							} 
						?>
					</div>
				<?php }?> 

				<?php if($tmbtxt != '' && $tmbtxt != NULL){ ?>
					<div class="clmInstTxt">
						<?php echo $tmbtxt;?>
					</div>
				<?php }?>

			<?php }?>
		</div>
	<?php }?>

	<?php if(have_rows('instagram_footer')){?>
		<div id="clmInstfter" class="clmInstasecs">
			<?php 
				while(have_rows('instagram_footer')){
					the_row();
					$tftPstNumber = get_sub_field('instagram_blog_post_view');
					if($tftPstNumber != '' && $tftPstNumber != NULL){
						$iftNumber =  $tftPstNumber;
					}
					$tftxt = get_sub_field('instagram_footer_text');  
			?>

				<?php if($tftxt != '' && $tftxt != NULL){ ?>
					<div class="clmInstTxt">
						<?php echo $tftxt;?>
					</div>
				<?php }?>

			<?php }?>

			<?php
				$i = 0;
				$blog = array(array());

				$args = array('posts_per_page' => $iftNumber, 'orderby'=>'date', 'order'=>'DESC');

				$list_of_posts = new WP_Query( $args );
				//sort($list_of_posts);
				while ( $list_of_posts->have_posts() ) :
					
					$list_of_posts->the_post();

					//FOR THE BLOG EXCERPT
					$blog[$i]['content'] = substr(get_the_content(), 0, 120).'...<a href="'.get_post_permalink().'" class="clmIButtons">Read More</a>';

					$blog[$i]['postLink'] = get_post_permalink();
					$blog[$i]['title'] = get_the_title();
					$blog[$i]['postAlt'] = $defaultAlt;
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
				$i = 0;
				wp_reset_postdata();

			?>

			<div id="cblgContainer">
				
				<?php foreach ($blog as $post) {?>
					
					<div id="clminblgp<?php echo $i;?>" class="hbItems clminblgp">
						<div class="rel">
							<div class="hbImgs clminImgs">
								<a href="<?php echo $post['postLink'];?>">
									<div class="flexCenter">
										<div class="bgImage effect2" data-src="<?php echo $post['postImg'];?>"></div>
										<img src="<?php echo $post['postImg'];?>" class="imageAbove" alt="<?php echo $post['postAlt'];?>" title="<?php echo $post['postAlt'];?>" />
									</div>
								</a>		
							</div>
							<div class="blgTxts">
								<span class="blgTitles"><?php echo $post['title'];?></span>
								<span class="blgSubtxt"><?php echo $post['content'];?></span>
							</div>
						</div>
					</div>

				<?php }?>

				<div class="clear"></div>

			</div>

		</div>
	<?php }?>

</div><!-- END OF CLMINSTWRAPPER -->

<?php get_footer(); ?>
