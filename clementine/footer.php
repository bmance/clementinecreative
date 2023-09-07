<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>
			</main>

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

			<a href="javascript:scrollBack();" class="scrollBck">
				<i class="icon-arrow-up2"></i>
			</a>

			<footer id="footerContainer" role="contentinfo">

				<?php

					$footerIcon = get_template_directory_uri().'/images/cca-logo.png';
					$footerAlt = get_bloginfo('name');
					$homeUrl = get_home_url();
					$curYear = date('Y');
					$blogName = get_bloginfo('name');
					$cDisplay = get_field('cookie_agreement_display','options');

					$ftPhone = get_field('phone_number','options');
					$ftAddress = get_field('address','options');
					$ftCity = get_field('city','options');
					$ftState = get_field('state','options');
					$ftZip = get_field('zip_code','options');

					$iconTemp = get_field('footer_icon','options');
					if($iconTemp != '' || $iconTemp != NULL){
						$footerIcon = $iconTemp['url'];
						$footerAlt = $iconTemp['alt'];
					}
				?>

				<a href="<?php echo $homeUrl;?>">
					<img id="footerIcon" src="<?php echo $footerIcon;?>" alt="<?php echo $footerAlt;?>" />
				</a>

				<?php if(have_rows('social_media','options')){ ?>

					<div id="smContainer">

						<?php
							while(have_rows('social_media','options')):
								the_row();
								$smType = get_sub_field('social_media_type');
								$smIcon = get_sub_field('sm_custom_icon');

								$smAlt = $smType;
								if($smIcon != '' ||  $smIcon != NULL){
									$smAlt = ' '.$smIcon['alt'];
								}

								if($smIcon != '' ||  $smIcon != NULL){
									$smIcon = $smIcon['url'];
								}
								$smLink = get_sub_field('social_media_link');
						?>

							<span class="smIcons">

								<?php if($smLink != '' || $smLink != NULL){ ?>
									<a href="<?php echo $smLink;?>" target="_blank">
								<?php }?>

										<?php if($smIcon != '' ||  $smIcon != NULL){ ?>

											<img src="<?php echo $smIcon;?>" alt="<?php echo $smAlt;?>" title="" />

										<?php }else{ ?>

											<i class="icon-<?php echo $smType;?>" title="<?php echo $footerAlt;?>" aria-hidden="true"></i>

										<?php }?>

								<?php if($smLink != '' || $smLink != NULL){ ?>
									</a>
								<?php }?>

							</span>

						<?php
							endwhile;
						?>

					</div><!-- END OF SMCONTAINER -->

				<?php }?>

				<div id="ftInfo">
					<?php if($ftPhone != '' || $ftPhone != NULL){?>
						<span class="infoSections">
							<a href="tel:<?php echo $ftPhone;?>">
								<?php echo $ftPhone; ?>
							</a>
						</span>
					<?php }?>
					<a href="https://www.google.com/maps/dir//<?php echo $ftAddress; ?>,+<?php echo $ftCity; ?>,+<?php echo $ftState; ?>+<?php echo $ftZip; ?>/" target="_blank" title="Clementine Creative Agency is located Here!">
						<span><?php echo $ftAddress; ?></span>
						<span class="mobileBlock"></span>
						<span><?php echo $ftCity; ?>,</span>
						<span><?php echo $ftState; ?></span>
						<span><?php echo $ftZip; ?></span>
					</a>
				</div><!-- END OF FTINFO -->

				<div id="ftDisclaimers">
					<span>&copy;<?php echo $curYear.' '.$blogName;?></span>
					<span class="fDividers mobileDivs">|</span>
					<span class="mobileBlock"></span>
					<span class="ptSection">
						<?php
							$privacyType = get_field('privacy_type','options');
							if($privacyType == 'link'){
								$privacyLink = get_field('privacy_link','options');
								echo '<a id="privacyBtn" data-fancybox data-type="iframe" data-src="'.$privacyLink.'" href="javascript:;">';
							}else{
								$privacyText = get_field('privacy_text','options');
								echo '<div id="privacyPolicy" class="policyTerms">'.$privacyText.'</div>';
								echo '<a id="privacyBtn" data-fancybox data-src="#privacyPolicy" href="javascript:;">';
							}
						?>
							Privacy Policy
						</a>

						<span class="fDividers">|</span>

						<?php
							$termsType = get_field('terms_type','options');
							if($termsType == 'link'){
								echo '<a id="termsBtn" data-fancybox data-type="iframe" data-src="'.get_field('terms_link','options').'" href="javascript:;">';
							}else{
								echo '<div id="terms" class="policyTerms">'.get_field('terms_text','options').'</div>';
								echo '<a id="termsBtn" data-fancybox data-src="#terms" href="javascript:;">';
							}
						?>
							Terms
						</a>

					</span>

				</div><!-- END OF FTDISCLAIMERS -->

			</footer><!-- #site-footer -->

			<?php if($link == 'https://clementinecreativeagency.com/?privacy-policy'){ ?>

				<script type="text/javascript">
					$("#privacyBtn")[0].click();
				</script>

			<?php }?>

			<?php if($link == 'https://clementinecreativeagency.com/?terms'){ ?><?php }?>

			<?php if($cDisplay == 'on'){ ?>

				<div id="caDisplay">

					<?php
						$agreeTxt = '<p>We use cookies to enhance your experience, for analytics and to show you offers tailored to your interests on our site and third party sites. We may share your information with our advertising and analytic partners. By clicking Accept, you agree to our use of cookies and similar technologies.</p>';
						$txtAgreement = get_field('cookie_agreement');
						if($txtAgreement != '' || $txtAgreement != NULL){
							$agreeTxt = $txtAgreement;
						}
					?>

					<div id="caLeft">
						<div class="rel">
							<?php echo $agreeTxt;?>
						</div>
					</div><!-- END OF CALEFT -->
					<div id="caRight">
						<div class="rel">
							<a id="caButton" href="javascript:cookieAccept('yes');">
								Accept
							</a>
						</div>
					</div><!-- END OF CARIGHT -->
					<div class="clear"></div>

				</div><!-- END OF CADISPLAY -->

				<script type="text/javascript">

					$('#caDisplay').delay(8000).animate({bottom: '0px'}, 1000);

					function cookieAccept(answer){
						if(answer == 'yes'){
							$('#caDisplay').animate({bottom: '-1000px'}, 1000);

						}
					}

				</script>

			<?php }?>

			<?php if(get_field('custom_footer_code','options')){?>

				<!-- CUSTOM FOOTER CODE -->
				<?php echo '<div class="invisiContainer">'.get_field('custom_footer_code','options').'</div>';?>

			<?php }?>

		<?php wp_footer(); ?>

	</body>

	<script type="text/javascript">

		$(window).on('load', function(){ // WAITS TILL THE WHOLE PAGE LOADS
			imageDefer();
			backgroundDefer();
		});

		function backgroundDefer() {
			var totalBgImage = $(".bgImage").length;
		    for (var i = 0; i < totalBgImage; i++) {
				if($(".bgImage").eq(i).attr('data-src')) {
		        	$(".bgImage").eq(i).css('background-image',  "url('"+$(".bgImage").eq(i).attr('data-src')+"')");
				}
		    }
		}

		function imageDefer() {
		    var imgDefer = document.getElementsByTagName('img');
		    for (var i=0; i<imgDefer.length; i++) {
		        if(imgDefer[i].getAttribute('data-src')) {
		            imgDefer[i].setAttribute('src',imgDefer[i].getAttribute('data-src'));
		        }

				// ADDS THE BLOG NAME BY DEFAULT TO ALL THE IMAGE ALT TAG
				var altstring = '<?php echo get_bloginfo('name'); ?> ' + imgDefer[i].getAttribute('alt');
				imgDefer[i].setAttribute('alt', altstring);
		    }
		}

	</script>

</html>
