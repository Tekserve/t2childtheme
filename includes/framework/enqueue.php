<?php

	// Load Custom Theme Scripts using Enqueue
	function load_tmq_theme_scripts() {
		// register javascripts
		wp_register_script('jquery', get_template_directory_uri() .  '/js/jquery.min.js', array(), '1.10.2');
		wp_register_script('migrate', get_template_directory_uri() .  '/js/jquery.migrate.js', array(), '1.0', true);
		wp_register_script('bootstrap', get_template_directory_uri() .  '/js/bootstrap.js', array(), '3.0.0', true);
		wp_register_script('retina', get_template_directory_uri() .  '/js/retina-1.1.0.min.js', array(), '1.1.0', true);
		wp_deregister_script('flexslider');
		wp_register_script('flexslider', get_template_directory_uri() .  '/js/jquery.flexslider.js', array(), '0.1', true);
		wp_register_script('plugins-scroll', get_template_directory_uri() .  '/js/plugins-scroll.js', array(), '0.1', true);
		wp_register_script('magnific-popup', get_template_directory_uri() .  '/js/jquery.magnific-popup.min.js', array(), '0.1', true);
//child theme edit
// 		wp_register_script('vertikal_script', get_template_directory_uri() .  '/js/script.js', array(), '1.0.1');
		wp_register_script('vertikal_script', get_stylesheet_directory_uri() .  '/js/script.js', array(), '1.5');
//end child theme edit
		wp_register_script('isotope', get_template_directory_uri() .  '/js/jquery.isotope.min.js', array(), '1.0', true);
		wp_register_script('imagesloaded', get_template_directory_uri() .  '/js/jquery.imagesloaded.min.js', array(), '1.0', true);
		wp_register_script('style_switcher', get_template_directory_uri() .  '/js/style_switcher.js', array(), '1.0', true);
		wp_register_script('respond', get_template_directory_uri() .  '/js/respond.min.js', array(), '1.0');
		wp_register_script('hoverintent', get_template_directory_uri() .  '/js/hoverIntent.js', array(), '1.0');
		wp_register_script('superfish', get_template_directory_uri() .  '/js/superfish.js', array(), '1.0');

		if (!is_admin()) {
			// Enqueue Some of Theme Scripts in the Header
			wp_enqueue_script('jquery');
			wp_enqueue_script('vertikal_script');
			wp_enqueue_script('respond');
			wp_enqueue_script('hoverintent');
			wp_enqueue_script('superfish');
			
			// Footer Scripts
			wp_enqueue_script('migrate');
			wp_enqueue_script('bootstrap');
			wp_enqueue_script('retina');
			wp_enqueue_script('flexslider');
			wp_enqueue_script('magnific-popup');
			wp_enqueue_script('imagesloaded');
			wp_enqueue_script('isotope');
			wp_enqueue_script( 'waypoints' );
			// We need switcher on demo not your website!
			if ( $_SERVER['SERVER_NAME'] == 'preview.themique.com' || $_SERVER['SERVER_NAME'] == 'demo.themique.com' || $_SERVER['SERVER_NAME'] == 'localhost' ) {
				wp_enqueue_script('style_switcher');
			}			
			
			if ( function_exists( 'ot_get_option' ) ) {
				// Enqueue plugins-scroll by condition
				$tmq_scrollbar = ot_get_option( 'tmq_scrollbar' );
				if ( $tmq_scrollbar == 'on' ) {
					wp_enqueue_script('plugins-scroll');
				}
				
				$tmq_ajax_loader = ot_get_option( 'tmq_ajax_loader' );
				if ( $tmq_ajax_loader == 'on' ) {
					tmq_aws_load_scripts();
				}
			}
			
			wp_localize_script(
				'bootstrap',
				'tmq_script_vars', 
				array( 
					'plugins_scroll' 	=> tmq_scrollbartype()
				)
			);			
		}
	}

	add_action('wp_enqueue_scripts', 'load_tmq_theme_scripts'); // Add Custom Scripts
	
	// Theme Stylesheets using Enqueue
	function load_theme_styles() {
		// register css stylesheets
		wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.0.0', 'all');
		wp_register_style('fullwidth', get_template_directory_uri() . '/css/fullwidth.css', array(), '1.0.0', 'all');
		wp_register_style('settings', get_template_directory_uri() . '/css/settings.css', array(), '1.5.3', 'all');
		wp_register_style('magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css', array(), '1.5.3', 'all');
		wp_register_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '1.5.3', 'all');
		wp_deregister_style( 'flexslider' );
		wp_register_style('flexslider', get_template_directory_uri() . '/css/flexslider.css', array(), '1.5.3', 'all');
		wp_register_style('vertikal_style', get_template_directory_uri() . '/css/style.css', array('bootstrap'), '1.4.0', 'all');
		wp_register_style('ot-dynamic-tmq_css', get_stylesheet_directory_uri() . '/dynamic.css', array('vertikal_style'), '1.0', 'all');
		wp_register_style('ot-dynamic-tmq_usercss', get_stylesheet_directory_uri() . '/dynamic.css', array('vertikal_style'), '1.0', 'all');
		wp_register_style('custom_style', get_stylesheet_directory_uri() . '/style.css', array('vertikal_style'), '1.4.0', 'all');
		wp_register_style('responsive', get_template_directory_uri() . '/css/responsive.css', array('ot-dynamic-tmq_css'), '1.0', 'all');
		wp_register_style('style_switcher', get_template_directory_uri() . '/css/style_switcher.css', array(), '1.0.0', 'all');		
		wp_register_style('fullwidth-layout', get_template_directory_uri() . '/css/fullwidth-layout.css', array('responsive'), '1.0.0', 'all');		
		wp_deregister_style('ot-dynamic-tmq_usercss');

		if ( function_exists( 'ot_get_option' ) ) {
			// Enable full width layout
			$tmq_full_width_layout = ot_get_option( 'tmq_full_width_layout' );
			if ( $tmq_full_width_layout == 'on' ) {
					wp_enqueue_style('fullwidth-layout'); 
			}
			
			// Add Google Web Fonts
			$googlefontfamily = googlefontfamily('style', 'tmq_google_webfont');
			$tmq_menu_googlefontfamily = googlefontfamily('style', 'tmq_menu_webfont');
			$tmq_heading_googlefontfamily = googlefontfamily('style', 'tmq_heading_webfont');
			$tmq_paragraph_googlefontfamily = googlefontfamily('style', 'tmq_paragraph_font');
			
			// Enable Latin and Greek Language Support
			$tmq_support_latin = ot_get_option( 'tmq_support_latin' );
			$tmq_support_greek = ot_get_option( 'tmq_support_greek' );

			if ( $tmq_support_latin != 'off' ) {
				// Latin is ON
				if ( $tmq_support_greek != 'off' ) {
					// Both Latin and Greek
					$googlefontfamily .= '&subset=latin,latin-ext,greek-ext,greek';
					$tmq_menu_googlefontfamily .= '&subset=latin,latin-ext,greek-ext,greek';
					$tmq_heading_googlefontfamily .= '&subset=latin,latin-ext,greek-ext,greek';			
					$tmq_paragraph_googlefontfamily .= '&subset=latin,latin-ext,greek-ext,greek';
				} else {
					// Only Latin
					$googlefontfamily .= '&subset=latin,latin-ext';
					$tmq_menu_googlefontfamily .= '&subset=latin,latin-ext';
					$tmq_heading_googlefontfamily .= '&subset=latin,latin-ext';			
					$tmq_paragraph_googlefontfamily .= '&subset=latin,latin-ext';
				}
			} else {
				// Greek is ON
				if ( $tmq_support_greek != 'off' ) {
					// Only Greek
					$googlefontfamily .= '&subset=greek-ext,greek';
					$tmq_menu_googlefontfamily .= '&subset=greek-ext,greek';
					$tmq_heading_googlefontfamily .= '&subset=greek-ext,greek';			
					$tmq_paragraph_googlefontfamily .= '&subset=greek-ext,greek';
				}			
			}
			
			wp_register_style('google-font', 'http://fonts.googleapis.com/css?family='. $googlefontfamily, array(), '', 'all');
			wp_enqueue_style('google-font');

			// Check for duplicate fonts
			if ( $tmq_menu_googlefontfamily != $googlefontfamily ) {
				wp_register_style('menu-google-font', 'http://fonts.googleapis.com/css?family='. $tmq_menu_googlefontfamily, array(), '', 'all');
				wp_enqueue_style('menu-google-font');
			}
			
			if ( ( $tmq_heading_googlefontfamily != $googlefontfamily ) && ( $tmq_menu_googlefontfamily != $tmq_heading_googlefontfamily ) ) {
				wp_register_style('heading-google-font', 'http://fonts.googleapis.com/css?family='. $tmq_heading_googlefontfamily, array(), '', 'all');
				wp_enqueue_style('heading-google-font');
			}	
			
			if ( ( $tmq_paragraph_googlefontfamily != $googlefontfamily ) && ( $tmq_menu_googlefontfamily != $tmq_paragraph_googlefontfamily ) && ( $tmq_heading_googlefontfamily != $tmq_paragraph_googlefontfamily ) ) {
				wp_register_style('paragraph-google-font', 'http://fonts.googleapis.com/css?family='. $tmq_paragraph_googlefontfamily, array(), '', 'all');
				wp_enqueue_style('paragraph-google-font');
			}
			// End duplicate font check
			
			$tmq_responsive_layout = ot_get_option ( 'tmq_responsive_layout' );
			if ( empty( $tmq_responsive_layout ) ) {
				$tmq_responsive_layout == 'on';
			}
		}	
	
		// We need switcher on demo not your website!
		if ( $_SERVER['SERVER_NAME'] == 'preview.themique.com'  || $_SERVER['SERVER_NAME'] == 'demo.themique.com'  || $_SERVER['SERVER_NAME'] == 'localhost' ) {
			wp_enqueue_style('style_switcher'); 
		}
		
		wp_enqueue_style('bootstrap'); 
		wp_enqueue_style('fullwidth'); 
		wp_enqueue_style('settings'); 
		wp_enqueue_style('magnific-popup'); 
		wp_enqueue_style('font-awesome'); 
		wp_enqueue_style('flexslider'); 
		wp_enqueue_style('vertikal_style'); 
		wp_enqueue_style('custom_style'); 
		wp_enqueue_style('ot-dynamic-tmq_css'); 
		if ( $tmq_responsive_layout != 'off' ) {
			wp_enqueue_style('responsive'); 
		}
	}
	add_action('wp_enqueue_scripts', 'load_theme_styles'); // Add Theme Stylesheet

?>