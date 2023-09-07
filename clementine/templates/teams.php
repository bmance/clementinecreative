<?php
/**
 * Template Name: Teams
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage CCA
 * @since 1.0
 */

$defaultAlt = get_bloginfo('name');
$rightImg = get_template_directory_uri().'/images/clementine-founders.jpg';
$rightAlt = $defaultAlt;


$i = 0;
$j = 0;
$team = array(array());


$args = array( 'post_type' => 'team', 'posts_per_page' => -1, 'orderby'=>'post_date', 'order'=>'ASC');

$list_of_posts = new WP_Query( $args );
//sort($list_of_posts);
while ( $list_of_posts->have_posts() ) :
	
	$list_of_posts->the_post();

	$team[$i]['name'] = get_the_title();
	$team[$i]['link'] = get_post_permalink();
	$team[$i]['title'] = get_field('team_title');

	$team[$i]['photo1'] = get_template_directory_uri().'/images/postDefault.png';
	$team[$i]['pAlt1'] = $defaultAlt;

	$team[$i]['photo2'] = get_template_directory_uri().'/images/postDefault.png';
	$team[$i]['pAlt2'] = $defaultAlt;

	if(have_rows('team_photos')){
		while(have_rows('team_photos')):
			the_row();
			$tpImg1 = get_sub_field('team_first_photo');
			$tpImg2 = get_sub_field('team_second_photo');

			if($tpImg1 != '' && $tpImg1 != NULL){
				$team[$i]['photo1'] = $tpImg1['url'];
				$team[$i]['pAlt1'] = $tpImg1['alt'];
			}

			if($tpImg2 != '' && $tpImg2 != NULL){
				$team[$i]['photo2'] = $tpImg2['url'];
				$team[$i]['pAlt2'] = $tpImg2['alt'];
			}

		endwhile;
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

get_header(); ?>

<?php if($content != '' && $content != NULL){ ?>
<div id="tdContainer">
	<?php echo $content;?>		
</div>
<?php }?>

<?php if(have_rows('teams_top_section')){ ?>
	<div id="ttContainer">
		<?php while(have_rows('teams_top_section')): the_row();?>

			<?php
				$leftContent = get_sub_field('team_text_section');
				$tempImg = get_sub_field('team_image');

				if($tempImg != '' && $tempImg != NULL){
					$rightImg = $tempImg['url'];
					$rightAlt = $tempImg['alt'];
				}
			?>

			<div id="teamTmleft">
				<div id="tmLftwrapper">
					<?php echo $leftContent;?>
				</div>
			</div>

			<div id="teamTmright">
				<div class="bgImage" style="background-image: url('<?php echo $rightImg;?>');"></div>
				<img data-src="<?php echo $rightImg;?>" alt="<?php echo $rightAlt;?>" class="imageAbove" />
			</div>

		<?php endwhile;?>
		<div class="clear"></div>
	</div><!-- END OF TTCONTAINER -->
<?php }?>


<div id="tmContainer">

	<div id="tmtpContainer">
		<?php
			$tmTitle = 'The Clementine Bunch';
			$tmTemp = get_field('team_mid_section_title');

			if($tmTemp != '' && $tmTemp != NULL){
				$tmTitle = $tmTemp;
			}

			echo '<h2>'.$tmTitle.'</h2>';
		?>
	</div>

	<?php foreach($team as $member){ ?>
		<a href="<?php echo $member['link'];?>" class="teamMbrs effect2">
			
			<div class="teamTop effect2">
				<div class="bgImage" style="background-image: url('<?php echo $member['photo1'];?>');"></div>
				<img data-src="<?php echo $member['photo1'];?>" alt="<?php echo $member['pAlt1'];?>" class="imageAbove" />
				<img src="<?php echo get_template_directory_uri();?>/images/slidePlacement.png"  class="teamPlacement" />
			</div>
			<div class="teamBottom effect2">
				<div class="bgImage" style="background-image: url('<?php echo $member['photo2'];?>');"></div>
				<img data-src="<?php echo $member['photo2'];?>" alt="<?php echo $member['pAlt2'];?>" class="imageAbove" />
				<img src="<?php echo get_template_directory_uri();?>/images/slidePlacement.png"  class="teamPlacement" />';
				<div class="teamInfo">
					<div class="rel">
						<span class="infoNames"><?php echo $member['name'];?></span>
						<?php if($member['title'] != '' && $member['title'] != NULL){ ?>
						<span class="infoTitles"><?php echo $member['title'];?></span>
						<?php }?>
					</div>
				</div>
				<div class="tealOverlay"></div>
			</div>
			
		</a>
	<?php }?>
	<div class="clear"></div>


</div><!-- END OF TMCONTAINER -->


<div id="tbContainer">
	
	<?php
		$tbTitle = 'Join Our Team'; 
		if(have_rows('team_bottom_section')){
			while(have_rows('team_bottom_section')):
				the_row();
				$tmpbtitle = get_sub_field('team_bottom_title');
				if($tmpbtitle != '' && $tmpbtitle != NULL){
					$tbTitle = $tmpbtitle;
				}
				$tbText = get_sub_field('team_bottom_text');
			endwhile;
		}
	?>

	<h3><?php echo $tbTitle;?></h3>

	<?php 
		if($tbText != '' && $tbText != NULL){
			echo $tbText;
		}else{ 
	?>

		<p>Interested in joining our bunch? <a href="/contact-us">Click here</a> for job opportunities at Clementine Creative.</p>

	<?php }?>

</div><!-- END OF TBCONTAINER -->


<?php get_footer(); ?>
