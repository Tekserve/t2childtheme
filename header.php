<?php
/**
 * Vertikal
 * ==================================================
 * This is the main header file - header.php
 *
 */

// child theme edit
// retrieves the attachment ID from the file URL
if( !function_exists( 'pippin_get_image_id' ) ) {
	function pippin_get_image_id($image_url) {
		global $wpdb;
		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
			return $attachment[0]; 
	}
}
// child theme edit

 /* Theme Options Variables
 * ==================================================
 */
	if ( function_exists( 'ot_get_option' ) ) {
		// Website Logo
		$tmq_logo_type = ot_get_option( 'tmq_logo_type' );
		if ( empty( $tmq_logo_type ) ) {
			$tmq_logo_type = 'tmq_image'; 
		}
		if ( $tmq_logo_type == 'tmq_text' ) {
			$tmq_logo_text = ot_get_option( 'tmq_logo_text' );
			if ( empty( $tmq_logo_text ) ) {
				$tmq_logo_text = 'Vertikal';
			}
		} else {
			$tmq_logo_url = ot_get_option( 'tmq_logo' );
			if ( empty( $tmq_logo_url ) ) {
				$tmq_logo_url = get_template_directory_uri() . '/images/logo.png';
			}
		}
		
		// Email and Phone Number
		$tmq_email_contact = ot_get_option( 'tmq_email_contact' );
		// Check for empty or NONE
		if ( !empty( $tmq_email_contact ) && $tmq_email_contact != '' && $tmq_email_contact != 'none' ) {
			$tmq_email_contact = '<i class="fa fa-envelope-o"></i>' . $tmq_email_contact;
		} else {
			$tmq_email_contact = '';
		}		
		
		// Link email address to somewhere
		$tmq_email_contact_url = ot_get_option( 'tmq_email_contact_url' );
		
		if ( !empty( $tmq_email_contact_url ) && $tmq_email_contact_url != '' ) {
			$tmq_email_contact_before = '<a href="'. esc_url($tmq_email_contact_url) .'" class="header-contact-link">';
			$tmq_email_contact_after = '</a>';
		} else {
			$tmq_email_contact_before = '';
			$tmq_email_contact_after = '';
		}
		
		$tmq_phone_contact = ot_get_option( 'tmq_phone_contact' );
		// Check for empty or NONE
		if ( !empty( $tmq_phone_contact ) && $tmq_phone_contact != '' && $tmq_phone_contact != 'none' ) {
			$tmq_phone_contact = '<i class="fa fa-phone"></i>' . $tmq_phone_contact;
		} else {
			$tmq_phone_contact = '';
		}
		
		$tmq_phone_contact_url = ot_get_option( 'tmq_phone_contact_url' );
		
		if ( !empty( $tmq_phone_contact_url ) && $tmq_phone_contact_url != '' ) {
			$tmq_phone_contact_before = '<a href="'. esc_url($tmq_phone_contact_url) .'" class="header-contact-link">';
			$tmq_phone_contact_after = '</a>';
		} else {
			$tmq_phone_contact_before = '';
			$tmq_phone_contact_after = '';
		}
		
		// Header Social Elements - Sortable List
		$tmq_social_items = ot_get_option( 'tmq_social_items' );
		if ( is_Array ( $tmq_social_items ) ) {
			// Socials are available - make the empty string to add items and prepare for output
			$tmq_social_media_links = '';
			
			foreach ( $tmq_social_items as $tmq_social_item ) {
				// Extract icons from Theme Options
				$tmq_social_title 		= $tmq_social_item['title'];
				$tmq_social_items_type 	= $tmq_social_item['tmq_social_items_type'];
				$tmq_social_items_url 	= $tmq_social_item['tmq_social_items_url'];
				$tmq_social_custom_icon	= $tmq_social_item['tmq_social_custom_icon'];

				// Choose Social Icon
				switch ( $tmq_social_items_type ) {
					case 'facebook':
					case 'twitter':
					case 'pinterest':
					case 'linkedin':
					case 'youtube':
					case 'dribbble':
					case 'skype':
						$tmq_social_icon = 'fa-' . $tmq_social_items_type;
						break;
					case 'google':
						$tmq_social_icon = 'fa-' . $tmq_social_items_type . '-plus';
						break;
					case 'vimeo':
						$tmq_social_icon = 'fa-' . $tmq_social_items_type . '-square';
						break;
					case 'custom':
						$tmq_social_icon = 'fa-' . $tmq_social_custom_icon;
						break;
					default:
						$tmq_social_icon = 'fa-share';
						break;
				}
				// Check for empty custom icon
				if ( $tmq_social_icon == 'fa-' ) {
					$tmq_social_icon = 'fa-link';
				}
				// Put Social Option into the Variable
				if ( !empty( $tmq_social_items_url ) && !empty( $tmq_social_title ) ) { 
					$tmq_social_media_links .= '<li><a class="' . esc_attr($tmq_social_items_type) . '" title="'. esc_attr($tmq_social_title) .'" href="'. esc_url($tmq_social_items_url) .'" target="_blank"><i class="fa '. esc_attr($tmq_social_icon) .'"></i></a></li>' . "\n";
				}
			}
		} else {
			// No social items are added - make the empty variable.
			$tmq_social_media_links = '';
		}
		
		// Header Search Button
		$tmq_search_topbar = ot_get_option( 'tmq_search_topbar' );
		if ( $tmq_search_topbar != 'off' ) {
			$tmq_search_in_header = '<li><a class="search_topbar" title="' . __( 'Search the Site', 'vertikal' ) . '" href="#" ><i class="fa fa-search"></i></a></li>' . "\n";
			$tmq_search_header_form_class = '';
		} else {
			$tmq_search_in_header = '';
			$tmq_search_header_form_class = ' no-width';
		}


		// Background image should be load from page meta first
		if ( is_single() || is_page() ) {
			$tmq_backgroundimage = get_post_meta( $post->ID, 'tmq_backgroundimage', true );
		} else {
			$tmq_backgroundimage = '';
		}

		// empty? read from theme options
		if ( empty( $tmq_backgroundimage ) ) {
			$tmq_backgroundimage = ot_get_option( 'tmq_backgroundimage' );
		}
		
		// Apply it
		if ( !empty( $tmq_backgroundimage ) ) {
// child theme edit
// 			$tmq_backgroundimage = '<img alt="' . esc_attr(get_bloginfo( 'name' )) . '" src="' . $tmq_backgroundimage . '">';
			$tmq_backgroundimage_url = get_site_url() . $tmq_backgroundimage;
			$tmq_backgroundimage_id = pippin_get_image_id( $tmq_backgroundimage );
			$tmq_backgroundimage_classes = 'alignnone size-full tmq_backgroundimage';
			if( !empty( $tmq_backgroundimage_id ) ) {
				$tmq_backgroundimage_classes .= ' wp-image-' . $tmq_backgroundimage_id;
				if( wp_get_attachment_metadata( $tmq_backgroundimage_id ) ) {
					$tmq_backgroundimage_dimensions = wp_get_attachment_metadata( $tmq_backgroundimage_id );
				}
				else {
					$tmq_backgroundimage_dimensions = array(
						'width'		=> '',
						'height'	=> ''
					);
				}
			}
			$tmq_backgroundimage = '<img class="' . $tmq_backgroundimage_classes . '" alt="' . esc_attr(get_bloginfo( 'name' )) . '" src="' . $tmq_backgroundimage . '" width="' . $tmq_backgroundimage_dimensions['width'] . '" height="' . $tmq_backgroundimage_dimensions['height'] . '" />';
// end child theme edit
		} else {
			$tmq_backgroundimage = '';
		}
		
		$tmq_undermenu_sidebar = ot_get_option( 'tmq_undermenu_sidebar' );
		if ( empty( $tmq_undermenu_sidebar ) ) {
			$tmq_undermenu_sidebar = 'off';
		}
		
		$tmq_responsive_layout = ot_get_option ( 'tmq_responsive_layout' );
		if ( empty( $tmq_responsive_layout ) ) {
			$tmq_responsive_layout == 'on';
		}
		
	} else {
		// Fall backs
		$tmq_logo_type = 'tmq_image';
		$tmq_logo_url = get_template_directory_uri() . '/images/logo.png';
		$tmq_email_contact = 'info@company.com';
		$tmq_email_contact_before = '';
		$tmq_email_contact_after = '';
		$tmq_phone_contact = '<i class="fa fa-phone"></i>+1-888-123-1234';
		$tmq_phone_contact_before = '';
		$tmq_phone_contact_after = '';
		$tmq_social_media_links = '';
		$tmq_backgroundimage = '';
		$tmq_undermenu_sidebar = 'off';
		$tmq_responsive_layout = 'on';
		
	}
 /* 
 * ==================================================
 @END Theme Options Variables */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php wp_title( '|', true, 'right');?> <?php bloginfo( 'name' ); ?> </title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<?php 
		// First step to disable responsiveness 
		if ( $tmq_responsive_layout != 'off' ) {
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php } ?>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,700,600,300' rel='stylesheet' type='text/css'>
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?> Atom Feed" href="<?php bloginfo( 'atom_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php 
		if ( is_single() || is_page() ) {
			// Get page background -- Check for category, search and tag later
			$tmq_banner_bg_type = get_post_meta( $post->ID, 'tmq_banner_bg_type', true );
		} elseif ( is_home() ) {
			$tmq_banner_bg_type = ot_get_option( 'tmq_blog_banner_bg_type' );
		} elseif ( is_search() ) {
			$tmq_banner_bg_type = ot_get_option( 'tmq_search_banner_bg_type' );
		}
		if ( !empty( $tmq_banner_bg_type ) && $tmq_banner_bg_type != 'tmq_default' ) {
			// It's not default setting
			if ( $tmq_banner_bg_type == 'tmq_color' ) {
				// Solid BG Color
				if ( is_single() || is_page() ) {
					$tmq_banner_background_color = get_post_meta( $post->ID, 'tmq_banner_background_color', true );
				} elseif ( is_home() ) {
					$tmq_banner_background_color = ot_get_option( 'tmq_blog_banner_background_color' );
				} elseif ( is_search() ) {
					$tmq_banner_background_color = ot_get_option( 'tmq_search_banner_background_color' );
				}
				if ( !empty( $tmq_banner_background_color ) ) {
					$tmq_banner_background_css_code = '
						background: '. $tmq_banner_background_color .';
					';
				} else {
					$tmq_banner_background_css_code = '';
				}
			} elseif ( $tmq_banner_bg_type == 'tmq_gradient' ) {
				// Gradient BG Color
				if ( is_single() || is_page() ) {			
					$tmq_banner_background_gradient_1 = get_post_meta( $post->ID, 'tmq_banner_background_gradient_1', true );
					$tmq_banner_background_gradient_2 = get_post_meta( $post->ID, 'tmq_banner_background_gradient_2', true );
				} elseif ( is_home() ) {
					$tmq_banner_background_gradient_1 = ot_get_option( 'tmq_blog_banner_background_gradient_1' );
					$tmq_banner_background_gradient_2 = ot_get_option( 'tmq_blog_banner_background_gradient_2' );
				} elseif ( is_search() ) {
					$tmq_banner_background_gradient_1 = ot_get_option( 'tmq_search_banner_background_gradient_1' );
					$tmq_banner_background_gradient_2 = ot_get_option( 'tmq_search_banner_background_gradient_2' );
				}
				if ( !empty( $tmq_banner_background_gradient_1 ) && !empty( $tmq_banner_background_gradient_2 ) ) {
					$tmq_banner_background_css_code = '
						background: -moz-linear-gradient(left, '. $tmq_banner_background_gradient_1 .' 0%, '. $tmq_banner_background_gradient_2 .' 100%);
						background: -webkit-gradient(left top, right top, color-stop(0%, '. $tmq_banner_background_gradient_1 .'), color-stop(100%, '. $tmq_banner_background_gradient_2 .'));
						background: -webkit-linear-gradient(left, '. $tmq_banner_background_gradient_1 .' 0%, '. $tmq_banner_background_gradient_2 .' 100%);
						background: -o-linear-gradient(left, '. $tmq_banner_background_gradient_1 .' 0%, '. $tmq_banner_background_gradient_2 .' 100%);
						background: -ms-linear-gradient(left, '. $tmq_banner_background_gradient_1 .' 0%, '. $tmq_banner_background_gradient_2 .' 100%);
						background: linear-gradient(to right, '. $tmq_banner_background_gradient_1 .' 0%, '. $tmq_banner_background_gradient_2 .' 100%);
						filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\''. $tmq_banner_background_gradient_1 .'\', endColorstr=\''. $tmq_banner_background_gradient_2 .'\', GradientType=1 );
					';
				} else {
					$tmq_banner_background_css_code = '';
				}

			} elseif ( $tmq_banner_bg_type == 'tmq_image' ) {
				// Background Image
				if ( is_single() || is_page() ) {				
					$tmq_banner_background_image = get_post_meta( $post->ID, 'tmq_banner_background_image', true );
				} elseif ( is_home() ) {
					$tmq_banner_background_image = ot_get_option( 'tmq_blog_banner_background_image' );
				} elseif ( is_search() ) {
					$tmq_banner_background_image = ot_get_option( 'tmq_search_banner_background_image' );
				}
				
				if ( !empty( $tmq_banner_background_image ) ) {
					$tmq_banner_background_css_code = '
						background: url(\'' . $tmq_banner_background_image . '\');
						background-size: cover;
					';						
				} else {
					$tmq_banner_background_css_code = '';					
				}
		
			}
		}

		// if background is set in page or theme options
		if ( !empty ( $tmq_banner_background_css_code ) ) {
			add_action( 'wp_enqueue_scripts', 'tmq_update_banner_bg_image', 10, 1 );
			do_action( 'wp_enqueue_scripts', $tmq_banner_background_css_code );
		}
		
		// Add google headshot
		if ( is_single() ) {
			global $post;
			$google_headshotlink = get_the_author_meta( 'google_profile', $post->post_author );
			if ( !empty( $google_headshotlink ) ) {
				echo '<link rel="author" href="' . esc_url($google_headshotlink) . '" />' . "\n";
			}
		}
		
		
	?>
	
	<?php wp_head();?>
	
<!-- child theme edit -->
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
<!-- end child theme edit -->
<script>
		jQuery(document).ready(function(){
				
				jQuery(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
                
				});
				
		var displayTitle = function(title){
			jQuery('#video-title-display').html(title);
		
		}
	var play = function(src, title){
		//console.log(src);
		jQuery('#video').attr("src",src);
		jQuery('#current-video').html(title);
		
	}		
	function openVideoGate(){
		console.log('open sesame');
		jQuery('#video-gate').css("display","none");
		jQuery('#video-player').css("display","block");
	}			
</script>
</head>
<body <?php body_class(); ?>>

	<!-- Background -->
	<div id="background-container">
<!-- child theme edit -->
		<?php // echo $tmq_backgroundimage . "\n"; ?>
	<?php if(defined('PICTUREFILL_WP_VERSION') && '2' === substr(PICTUREFILL_WP_VERSION, 0, 1)): ?>
		<?php echo picturefill_wp_apply_to_html( $tmq_backgroundimage ) . "\n" ?>
	<?php else: ?>
		<?php echo $tmq_backgroundimage . "\n" ?>
	<?php endif ?>
<!-- end child theme edit -->
	</div>

	<!-- End Background -->

	<!-- Container -->
	<div id="container" class="container">
	<div id="portals">
					 <?=portals_menu()?>
					
				</div>
		<!-- top-line
		    ================================================== -->
		<div class="top-line">
			<div class="top-line-container">
				<p>
					<span><?php echo $tmq_phone_contact_before;?><?php echo $tmq_phone_contact; ?><?php echo $tmq_phone_contact_after;?></span>
					<span><?php echo $tmq_email_contact_before;?><?php echo $tmq_email_contact; ?><?php echo $tmq_email_contact_after;?></span>
				</p>
			
				<ul class="social-icons search-icons<?php echo esc_attr($tmq_search_header_form_class) ?>">
					<li class="search-header-form">
						<form class="topbar_searchbox" method="get" action="<?php echo home_url() ?>">
<!-- child theme edit -->
<!-- 						<input type="search" name="s" placeholder="<?php _e( 'Search and hit Enter!', 'vertikal' );?>"> -->
							<input type="search" name="s" placeholder="<?php _e( 'Search', 'vertikal' );?>">
<!-- end child theme edit -->
						</form>
					</li>
					<?php 
						echo $tmq_search_in_header;
					?>
				</ul>
				
				<ul class="social-icons">
					<?php echo $tmq_social_media_links;?>
				</ul>
			</div>
		</div>
		<!-- End Top line -->

		<!-- Header
		    ================================================== -->
		<header class="clearfix">
			<div class="header-logo">
				<a class="logo" title="<?php esc_attr(bloginfo( 'name' )) ?>" href="<?php echo home_url() ?>"><?php
					if ( $tmq_logo_type == 'tmq_text' ) {
						// Text Logo
						?><span><?php echo $tmq_logo_text;?></span><?php
					} else {
						// Image Logo
						?><img alt="<?php esc_attr(bloginfo( 'name' )) ?>" src="<?php echo esc_url($tmq_logo_url) ?>"><?php
					}				
				?></a>
			</div>
			<a class="elemadded responsive-link" href="#"><?php _e( 'Menu', 'vertikal' );?></a>
			<div class="navbar-vertical">
				<?php
					// Load Navigation Menu
					theme_nav();
				?>
			</div>
			<?php
				if ( $tmq_undermenu_sidebar == 'on' ) {
			?>
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="undernav-sidebar sidebar-widgets"><?php dynamic_sidebar('undermenu-sidebar'); ?></div>
				</div>
			</div>
			<?php 
				}
			?>
		</header>
		<!-- End Header -->
