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
		<div id="content" class="partners-page">
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
					<?php echo "<h1>PARTNERS</h1>" ?>
					<p><?php echo get_the_title() ?></p>
					
					<?php
						if ( ( function_exists( 'tmq_show_bc' ) ) && ( $tmq_brcr == 'tmq_show' ) ) {
								tmq_show_bc();
						}
						
						
						
					?>
                    </div>
                    <div id="partner-header" class="clearfix">
                    <div class="partner-info" id="partner-logo">
                    	<img src="<?=$src?>">
                    </div>
                    <div class="partner-info" id="partner-content">
                    	<?php the_content();?>
                    </div>
					</div>
                <div class="content-sections">
                	
                        <?php
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
					
					
					
					$attachments = get_partner_media($post->post_name);
					//var_dump($attachments);	
					
					if(count($attachments['videos'])){
						if(count($attachments['videos'])>1){
							print "<h3>Videos</h3>";
						} else {
							print "<h3>Video:</h3>";
							
						}
                    	print display_videos($attachments['videos']);   
					
					}
					if(count($attachments['case_studies'])){
	
						if(count($attachments['case_studies'])>1){
						print "<h3>Case Studies</h3>";
    					} else {
						print "<h3>Case Study:</h3>";
    						
						}
                    	print display_attachment_list($attachments['case_studies']);   
					
					}
					if(count($attachments['white_papers'])){
						if(count($attachments['white_papers'])>1){
							print "<h3>White Papers</h3>";
    					} else {
							print "<h3>White Paper:</h3>";
    						
						}
						
                       	print display_attachment_list($attachments['white_papers']);   
						
						
						
					}
					if(count($attachments['brochures'])){
						
						if(count($attachments['brochures'])>1){
							print "<h3>Brochures</h3>";
    					} else {
							print "<h3>Brochure:</h3>";
    						
						}
                       	print display_attachment_list($attachments['brochures']);   
						
						
						
					}
					
					?>
					
					
					
				</div>
			</div>
            <div id="partners-menu" class="partners-footer clearfix">
            	<h4>Our Partners</h4>
                <?php echo display_partners(6);?>
             </div>
				<!-- End content sections -->
<?php get_footer(); ?>