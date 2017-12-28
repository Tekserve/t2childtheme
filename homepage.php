<?php
/**
 * Template Name: HomePage
 * ==================================================
 * This is a template for Home Page
 *
 * @Theme Vertikal
 */
get_header();
/* ======================================================
   // Get Page Banner Information
   ====================================================== */
    
	// Get Breadcrumb Status 
	if ( is_front_page() ) {
		// We don't need it on frontpage
		$tmq_brcr = 'tmq_hide';
	} else {
		$tmq_brcr = ot_get_option( 'tmq_brcr' );
		if ( empty( $tmq_brcr ) ) {
			$tmq_brcr = 'tmq_show';
		}
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
	
	$hero_image = getThumbnail($post->ID);
	
?>
		<!-- content 
			================================================== -->
		<div id="content">
			<div class="inner-content">
				<div id="page-content">
                <div id="hero" style="background:url(<?=$hero_image?>);">
                	
                    <?php
						if (have_posts()) : 
							
							the_content();
										
						endif; 
						?>
                    
                </div>
	
				<!-- End slider -->

				<!-- Content sections 
					================================================== -->
				
                <?php
	include "partner-tabs.php";
?>
					<?php
						/* ======================================================
						   // Get Sidebar Settings
						   ====================================================== */					
							$tmq_sidebar_position = get_post_meta( $post->ID, 'tmq_sidebar_position', true );
							if ( empty( $tmq_sidebar_position ) || $tmq_sidebar_position == 'tmq_default' ) {
								// Empty? Read from theme default
							//	$tmq_sidebar_position = ot_get_option( 'tmq_default_sidebar_position' );
							}
							if ( empty( $tmq_sidebar_position ) ) {
								// Even Theme Default is Empty?! OK! Force full width
							//	$tmq_sidebar_position = 'tmq_fullwidth';
							}
							
							// Load the layout based on theme options and page meta options
							switch ( $tmq_sidebar_position ) {
								case 'tmq_fullwidth':
							//		get_template_part( 'layouts/pages/no-sidebar', 'page' );
									break;
								case 'tmq_leftsidebar':
								//	get_template_part( 'layouts/pages/left-sidebar', 'page' );
									break;
								case 'tmq_rightsidebar':
									//get_template_part( 'layouts/pages/right-sidebar', 'page' );
									break;
								default:
									//get_template_part( 'layouts/pages/no-sidebar', 'page' );
									break;
							}
					?>
				
			</div>
				<!-- End content sections -->
<?php get_footer(); ?>