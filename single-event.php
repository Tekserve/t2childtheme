
<?php
/**
 * Vertikal
 * ==================================================
 * This is the single portfolio file - single-tmq-portfolio.php
 *
 */
$external = get_post_meta($post->ID,"external_url",true);

if(@$external !=""){
	?>
    	<script>
			window.location = '<?=$external?>';
		</script>
    <?php
}


get_header();


/* ======================================================
   // Get Portfolio Banner Information
   ====================================================== */
    
	// Get Breadcrumb Status 
	$tmq_brcr = ot_get_option( 'tmq_brcr' );
	if ( empty( $tmq_brcr ) ) {
		$tmq_brcr = 'tmq_show';
	}
	
    // Get Banner Settings 
	$tmq_slidertype = get_post_meta( $post->ID, 'tmq_slidertype', true );
	
	if ( empty( $tmq_slidertype ) ) {
		// Default value if nothing is set - Usually when theme is installed on a site with old content
		$tmq_banner_area_setting = ot_get_option( 'tmq_banner_area_setting' );
		if ( !empty( $tmq_banner_area_setting ) ) {
			// read from theme options
			$tmq_slidertype = $tmq_banner_area_setting;
		} else {
			// Set my favorite value as default
			$tmq_slidertype = 'tmq_text';
		}
	}	
	
	if ( $tmq_slidertype == 'tmq_text' ) {

		// TEXT AND BACKGROUND is SET **********
		
		// Get page heading / title
		$tmq_banner_title = get_post_meta( $post->ID, 'tmq_banner_title', true );
		if ( empty( $tmq_banner_title ) ) {
			// Empty? Read from default and add span
			$tmq_banner_title = '<span>' . ot_get_option( 'tmq_default_banner_title' ) . '</span>';
		} else {
			// Add H1 tag to it
			$tmq_banner_title = '<h1>' . $tmq_banner_title . '</h1>';
		}
		
		// Get page sub-heading / sub-title
		$tmq_banner_subtitle = get_post_meta( $post->ID, 'tmq_banner_subtitle', true );
		if ( empty( $tmq_banner_subtitle ) ) {
			// Empty? Read from default
			$tmq_banner_subtitle = ot_get_option( 'tmq_default_banner_subtitle' );
		}
		
		// Get page background ( I Should Move This to Header )
		$tmq_banner_background_image = get_post_meta( $post->ID, 'tmq_banner_background_image', true );	
		
	} elseif ( $tmq_slidertype == 'tmq_revolution' ) {
		
		// REVOLUTION SLIDER is SET **********
		$tmq_revolution_slider = get_post_meta($post->ID, 'tmq_revolution_slider', true);
	} elseif ( $tmq_slidertype == 'tmq_flex' ) {
	
		// Flex Slider Images
		$tmq_flex_gallery = get_post_meta($post->ID, 'tmq_flex_gallery', true);
	}
	
	//Get Next and Previous Links
	$prev_post = get_permalink(get_adjacent_post(false,'',true));
	if ( $prev_post == get_permalink() ) {
		$prev_post = '#';
		$prev_tooltip = __('No More Projects','vertikal');
	} else {
		$prev_tooltip = __('Previous Project','vertikal');
	}
	
	$next_post = get_permalink(get_adjacent_post(false,'',false));
	if ( $next_post == get_permalink() ) {
		$next_post = '#';
		$next_tooltip = __('No More Projects','vertikal');
	} else {
		$next_tooltip = __('Next Project','vertikal');
	}
	
	// Get default portfolio page
	$tmq_defportfoliopage = ot_get_option( 'tmq_defportfoliopage' );
	if ( empty( $tmq_defportfoliopage ) ) {
		$tmq_defportfoliopage = '#';
	} else {
		$tmq_defportfoliopage = $tmq_defportfoliopage;
	}	
?>
		<!-- content 
			================================================== -->
		<div id="content">
			<div class="inner-content">
				<div id="page-content">
				<!-- slider 
					================================================== -->
				<?php if ( $tmq_slidertype == 'tmq_text' ) { ?>
				<!--<div id="page-banner">
					<?php echo $tmq_banner_title;?>
					<p><?php echo $tmq_banner_subtitle;?></p>
					<?php
						if ( ( function_exists( 'tmq_show_bc' ) ) && ( $tmq_brcr == 'tmq_show' ) ) {
								tmq_show_bc();
						}
					?>
				</div>
				<?php } ?>
				<?php if ( $tmq_slidertype == 'tmq_revolution' ) { ?>
				<div id="slider">
					<!--
					#################################
						- THEMEPUNCH BANNER -
					#################################
					-->
					<?php
						if ( function_exists( 'putRevSlider' ) ) {
							putRevSlider( $tmq_revolution_slider );
						}
					?>
				</div>
				<?php } ?>
				<?php if ( $tmq_slidertype == 'tmq_flex' ) { 
					// Check if it has more than one image to show it as slideshow
					if ( !empty( $tmq_flex_gallery ) ) {
						$tmq_flex_gallery_array = explode(',', $tmq_flex_gallery);
						?>
						<div id="slider">
							<!--
							#################################
									- FlexSlider Banner -
							#################################
							-->
							<div class="flexslider">
								<ul class="slides">
								<?php 
									foreach ( $tmq_flex_gallery_array as $tmq_flex_image ) {
										$img_title = get_the_title( $tmq_flex_image );   // title
										//$img_caption = get_post_field('post_excerpt', $tmq_flex_image ); // Get Caption - We don't use it now
										
										// Get slideshow size
										$big_array = image_downsize( $tmq_flex_image, 'full' );
										$img_url = $big_array[0];
										?>
											<li><img src="<?php echo esc_url($img_url); ?>" alt="" title="<?php echo esc_attr($img_title); ?>" /></li>
										<?php
									}
								?>
								</ul>
							</div>
						</div>
						<?php }
					} ?>				
				<!-- End slider -->

				<!-- Content sections 
					================================================== -->
					
                
				
					<?php
					
					if ( have_posts() ) {
						$img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id()), "medium");
						$src = $img[0];
						
						?>
                        <div id="page-banner">
                        
					 <h1><?php $event_type = get_post_meta($post->ID,"event_type",true); echo strtoupper($event_type);?></h1>
					<p><?php echo get_the_title();
					//print "<br>".get_the_date();
					?>
                    </p>
					
					<?php
					
						$event_video_id = get_post_meta($post->ID,"event_video_id",true);
						
						
						
					?>
                    </div>
                   
                   <?php
                   		if($event_video_id != ''){
							$video_url = get_post_meta($event_video_id,"video_url",true);
				   ?>
				   <div id="video-player" style="display:none"><iframe src="<?=$video_url?>" scrolling="no" frameborder="0" id="video"  allowfullscreen></iframe></div>
					<?php
						}
					?>
                   
                <div class="content-sections">
              <!--  <div id="thank-you" style="opacity:0">Thank you, please enjoy the video</div>-->
                <div id="events">	
    			 <div class="event">
     
     <div class="event-thumb">
	 	<img src="<?=$src?>" alt="<?=$src?>" alt="<?=get_the_title()?>">
	 </div>
     <div class="event-listing">
	 
                <?php
	            if($event_type == 'Webinar'){
                	print wpautop(get_the_content());
				} else if ($event_type == 'Trade Show'){
					print "<h3>".get_the_title()."</h3>";
					print wpautop(get_the_excerpt());
				}
				?>
      </div>
      </div>          
      </div>
      <div id="trade-show-info"> 
	  		<?php 
			print wpautop(get_the_content());
			?>
      </div>
      <div id="thanks-trade-show" style="display:none;"><strong>Thank you for registering! See you at the show.</strong></div>
            <div id="lead-gate-form">
            <?php 
			
			?>
			
			<?php
			$form_action = 'http://go.t2computing.com/l/72052/2016-08-04/3zq4mf'; // default = webinar
			$message = "<strong> Thank you for your interest in watching our webinar.</strong>
            <p>Please provide us with your contact info before watching the video</p>";
			
				if($event_type == 'Trade Show'){ 
					$form_action = 'https://go.pardot.com/l/72052/2016-10-17/4h17st'; // IF TRADE SHOW
					$message = "<strong>Please register for your visit to our booth</strong><br><br>";
				} else {
				print $message;	
				}
				
					
			if($event_type == 'Webinar'){ 
			?>
            
            
                	<form action="<?=$form_action?>" method="post" id="lead-gate" novalidate>
                    
                    <?php if($event_type == 'Webinar'){ 
                     print "<input type='hidden' name='webinar' value='Webinar | ".get_the_title()."'>";
					} else if($event_type == 'Trade Show'){
						 print "<input type='hidden' name='trade_show' value='Trade Show | ".get_the_title()."'>";
					}
					?>

<p>First Name* <br />
    <span class="first_name"><input type="text" id="first_name" name="first_name" value="" size="40" class="wpcf7-text" aria-required="true" aria-invalid="false" required></span> </p>
<p>Last Name*<br />
    <span class="last_name"><input type="text"  id="last_name" name="last_name" value="" size="40" class="wpcf7-text" aria-required="true" aria-invalid="false" required></span> </p>
<p>Your Email* <br />
    <span class="email"><input type="email"  id="email" name="email" value="" size="40" class="wpcf7-text wpcf7-email required email" aria-required="true" aria-invalid="false" required></span> </p>
<p>Company*<br />
<span class="company"><input type="text"  id="company" name="company" value="" size="40" class="wpcf7-text" aria-required="true" aria-invalid="false" required></span>
</p>
<p>Title*<br />
<span class="title"><input type="text"  id="title" name="title" value="" size="40" class="wpcf7-text" aria-required="true" aria-invalid="false" required></span>
</p>
<p>Website<br />
<span class="website"><input type="text"  id="" name="website" value="" size="40" class="wpcf7-text" aria-invalid="false"></span></p>
<p>Phone number<br />
<span class="phone"><input type="text"  id="" name="phone" value="" size="40" class="wpcf7-text" aria-invalid="false"></span>
</p>
<p>Your Message<br />
    <span class="message"><textarea id="" name="message" cols="40" rows="10" class="wpcf7-textarea" aria-invalid="false"></textarea></span> </p>
<p><input type="submit" value="Send" class="wpcf7-submit" /><br />

<span id="complete_required"></span>

<span style="font-size:80%" id="required_message">(*=required)</p>
</form>

</div>
                        <?php 
						}// close if event is webinar
					}
								// Show Post Content
					//	the_post();
						// Read single post template
						//print get_the_title();
						//get_template_part( 'layouts/portfolio/content', 'post' );
						// Check if we should show related posts
						if ( 'tmq_show' == $tmq_relatedposts ) {
							// RELATED POSTS START
							get_template_part( 'layouts/portfolio/content-related-posts', 'loop' );
							//RELATED POSTS END
						}
						// Check if we should show Comments?
						if ( 'on' == $tmq_portfolio_comments ) {
							comments_template( '', true );
						}	
					
					
					
					$args = array( 'post_type' => 'video', 'post_status'=> 'publish', 'category' => 1 );

					$myposts = get_posts( $args );
					
					
					print "<br>";
					
		
					
					?>
					
					
					
				</div>
			</div>
           
			
            <script>
			
			
			
			jQuery(document).ready(function () {
				var hash = window.location.hash;
				
				
				
				<?php if($event_type == 'Webinar'){
			 print "if(hash === '#featured'){
					openLeadGate();	
				}";
			}  else if($event_type == 'Trade Show'){
				print "if(hash === '#thanks'){
				displayThankYouMessage();
				}";
			}
			?>
				function validateEmail(email) {
					var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
					
					var filtertest =  filter.test(email);
					
    				return filtertest;
				}
				function validateLeadGate(){
					
				 valid = true;   
				
					
					
					
					if (valid && jQuery('#first_name').val() == '') {
						jQuery(".first_name input").css("border","1px solid #f00");
						valid = false;
					} else {
						
					}
					
					
					
					if (valid && jQuery('#last_name').val() == '') {
						jQuery(".last_name input").css("border","1px solid #f00");
						valid = false;
					}
					var email_valid = validateEmail(jQuery('#email').val());
					if (valid === false || email_valid === false) {
					//if (valid && jQuery('#email').val() == '') {
						jQuery(".email input").css("border","1px solid #f00");
						
						 valid = false;
					} 
					if (valid && jQuery('#company').val() == '') {
						jQuery(".company input").css("border","1px solid #f00");
						
						 valid = false;
					}   
					if (valid && jQuery('#title').val() == '') {
						jQuery(".title input").css("border","1px solid #f00");
						 valid = false;
					}    
					if(valid === false){
						jQuery("#required_message").css("color","#f00");
					}
				
					return valid;	
				}
				
				
				
    jQuery('#lead-gate').on('submit', function(e) {
        e.preventDefault();
		var form_is_valid = validateLeadGate();
		if (form_is_valid === true){
			jQuery.ajax({
				url : jQuery(this).attr('action'),
				type: "POST",
				data: jQuery(this).serialize(),
				success: function (data) {
				   console.log(jQuery("#form_output").html(data));
				},
				error: function (jXHR, textStatus, errorThrown) {
					console.log(errorThrown);
				}
			});
			<?php if($event_type == 'Webinar'){
			 print "openLeadGate();";
			} else if($event_type == 'Trade Show'){
				print "displayThankYouMessage();";
			}
			?>
			
			
			//console.log('succeed');	
		} else {
			//console.log('fail');	
		}
    });
});
function displayThankYouMessage(){
	//jQuery('#lead-gate-form').css("display","none");
	
	
	
		window.location.hash = "#thanks";
	jQuery('#thanks-trade-show').css("display","block");
	jQuery('#trade-show-info').css("display","none");
	jQuery( '#lead-gate-form' ).fadeOut( 500, function() {
		 
	  });
	
}

function openLeadGate(){
	//jQuery('#lead-gate-form').css("display","none");
	
	jQuery('#video-player').css("display","block");
	
		window.location.hash = "#featured";
	
	
	jQuery( '#lead-gate-form' ).fadeOut( 500, function() {
		 
	  });
	
}



            </script>
           
				<!-- End content sections -->
<?php get_footer(); ?>