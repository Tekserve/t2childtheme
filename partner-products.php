<?php
/*
Template Name: Partners Product Links


*/ ?>

<?php
/**
 * Vertikal
 * ==================================================
 * This is the single portfolio file - single-tmq-portfolio.php
 *
 */
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
			// Add h2 tag to it
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
				<div id="page-banner">
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
				<div class="content-sections" style="display:inline-block !important">
				
<?php
    
	print wpautop($post->post_content);
	$partner_categories = get_partner_categories();
					 print display_partner_links($partner_categories['additional-products']);
?>
					</div>			<!-- Content sections 
					================================================== -->
	<!-- End content sections -->
<?php get_footer(); ?>