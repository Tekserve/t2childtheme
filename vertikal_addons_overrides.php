<?php

/* ======================================================
// Rewrite of Team Members function in Vertikal Addons Plugin (tmq_teammembers)
====================================================== */

// if( !function_exists( 'tmq_teammembers' ) ) {
	function tmq_teammembers( $atts, $content=null) {
		extract(shortcode_atts(array(
			'item_title'	=> '',
			'grid_columns'	=> '3',
			'items'			=> '18',
			'order_item'	=> 'date',
			'carousel'		=> '',
			'department'	=> '',
			'order_type'	=> 'ASC'
			), $atts));

		$teammembers = '';
	
		// Responsive Layout or not?
		if ( function_exists( 'ot_get_option' ) ) {
			$tmq_responsive_layout = ot_get_option( 'tmq_responsive_layout' );
		} else {
			// fallback
			$tmq_responsive_layout = 'on';
		}
	
		// Number of columns. We use it later.
	/*child theme edit*/
		// set to 2 for staff member fix. - EC @horngroup
		$cols = 2;
		$grid_columns = 'col-sm-6 col-xs-12';
	//		$cols = $grid_columns;
	// 		
	// 		switch( $grid_columns )	{
	// 			case '1': 
	// 				$grid_columns = 'col-md-12';
	// 				if ( $tmq_responsive_layout == 'off' ) {
	// 					$grid_columns .= ' col-xs-12';
	// 				}
	// 				break;
	// 			case '2': 
	// 				$grid_columns = 'col-md-6';
	// 				if ( $tmq_responsive_layout == 'off' ) {
	// 					$grid_columns .= ' col-xs-6';
	// 				}
	// 				break;
	// 			case '3': 
	// 				$grid_columns = 'col-md-4';
	// 				if ( $tmq_responsive_layout == 'off' ) {
	// 					$grid_columns .= ' col-xs-4';
	// 				}
	// 				break;
	// 			case '4': 
	// 				$grid_columns = 'col-md-3';
	// 				if ( $tmq_responsive_layout == 'off' ) {
	// 					$grid_columns .= ' col-xs-3';
	// 				}
	// 				break;
	// 			default:
	// 				$grid_columns = 'col-md-4';
	// 				if ( $tmq_responsive_layout == 'off' ) {
	// 					$grid_columns .= ' col-xs-4';
	// 				}
	// 				$cols = 3;
	// 				break;
	// 		}
	/*end child theme edit*/
	


	
		$teammembers_counter = 0;
	
			$teammembers .= '<div class="staff-box">';
	/*child theme edit*/
	// 			$teammembers .= ( empty( $item_title ) || $item_title == ' ' ) ? '<h3>&nbsp;</h3>' : "\n\t" . '<h3>' . $item_title . '</h3>';
			$teammembers .= ( empty( $item_title ) || $item_title == ' ' ) ? '' : "\n\t" . '<h3>' . $item_title . '</h3>';
	// 			if ( $carousel == '1' ) {
				// Carousel is Enabled
	// 				$teammembers .= "\n\t" . '<div id="carousel-example-generic3" class="carousel slide" data-ride="carousel">';
	// 				$teammembers .= "\n\t\t" . '<div class="carousel-inner">';
	// 			}
	/*end child theme edit*/
				$members = new WP_Query(array(
					'post_type' 		=> array('team-members'),
					'orderby' 			=> $order_item,
					'order' 			=> $order_type,
					'posts_per_page' 	=> -1,
					'department'		=> $department,
					'post_status'		=> 'publish'
				));
				global $post;
				if ($members->have_posts()) :
					while ($members->have_posts()) : 
						$members->the_post();
					
						$teammembers_counter++;
					
						$tmq_memberposition 	= get_post_meta($post->ID, 'tmq_memberposition', true);
	/*child theme edit*/
						$tmq_membershortbio     = get_post_meta($post->ID, 'tmq_membershortbio', true);
	/*end child theme edit*/
					
						// Social Information
						$tmq_memberfacebook 	=  get_post_meta($post->ID, 'tmq_memberfacebook', true);
						$tmq_membergoogleplus	=  get_post_meta($post->ID, 'tmq_membergoogleplus', true);
						$tmq_membertwitter 		=  get_post_meta($post->ID, 'tmq_membertwitter', true);
						$tmq_memberemailaddress =  get_post_meta($post->ID, 'tmq_memberemailaddress', true);
						$tmq_memberweburl 		=  get_post_meta($post->ID, 'tmq_memberweburl', true);
						$tmq_memberlinkedin		=  get_post_meta($post->ID, 'tmq_memberlinkedin', true);
						$tmq_memberphone		=  get_post_meta($post->ID, 'tmq_memberphone', true);
/*child theme edit*/						
						$tmq_membervcard		= get_post_meta($post->ID, 'tmq_membervcard', true);
/*end child theme edit*/
						// Get Post Thumbnail - If it's not empty get values
						$large_image_url = '';
						if ( '' != get_the_post_thumbnail() ) {
							$large_image_url_array = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'masonry');
							if ( is_array( $large_image_url_array ) ) {
								$large_image_url = $large_image_url_array[0];
							}
	/*child theme edit*/
	// 							$team_image = get_the_post_thumbnail($post->ID, 'masonry');
							$team_image = '<div class="col-sm-5 col-xs-12 member-photo"><img src="'. $large_image_url .'"></div>';
	/*end child theme edit*/
						}
	/*child theme edit*/
						else {
							$team_image = '';
						}
	/*end child theme edit*/
					
	/*child theme edit*/
						// columns settings
	// 						if ( $teammembers_counter == 1 ) {
						// If it's the beginning row, it should be active!
	// 								$teammembers .= '<div class="item active">';
	// 								$teammembers .= "\n\t" . '<div class="row">';
	// 						} elseif ( is_int( ( $teammembers_counter - 1 ) / $cols ) ) {
						// If it's the start of if it's on 3, 5, 7 ... or 4, 7, 10 ...
	// 								$teammembers .= '<div class="item">';
	// 								$teammembers .= "\n\t" . '<div class="row">';
	// 						}
	//						$teammembers .= '
	// 							<div class="'. $grid_columns .'">
	// 								<div class="staff-post">
	// 									<div class="staff-post-gal">
	// 										<ul class="staf-social">';
	// 											if ( !empty( $tmq_memberweburl) && $tmq_memberweburl != 'none' ) { 										
	// 												$teammembers .= '<li><a class="website" href="'. $tmq_memberweburl .'" target="_blank"><i class="fa fa-link"></i></a></li>';
	// 											}
	// 											if ( !empty( $tmq_memberemailaddress) && $tmq_memberemailaddress != 'none' ) { 										
	// 												$teammembers .= '<li><a class="email" href="mailto:'. $tmq_memberemailaddress .'" target="_blank"><i class="fa fa-envelope-o"></i></a></li>';
	// 											}
	// 											if ( !empty( $tmq_memberfacebook) && $tmq_memberfacebook != 'none' ) { 										
	// 												$teammembers .= '<li><a class="facebook" href="'. $tmq_memberfacebook .'" target="_blank"><i class="fa fa-facebook"></i></a></li>';
	// 											}
	// 											if ( !empty( $tmq_membertwitter) && $tmq_membertwitter != 'none' ) { 										
	// 												$teammembers .= '<li><a class="twitter" href="'. $tmq_membertwitter .'" target="_blank"><i class="fa fa-twitter"></i></a></li>';
	// 											}
	// 											if ( !empty( $tmq_membergoogleplus) && $tmq_membergoogleplus != 'none' ) { 										
	// 												$teammembers .= '<li><a class="google" href="'. $tmq_membergoogleplus .'" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
	// 											}
	// 											if ( !empty( $tmq_memberlinkedin) && $tmq_memberlinkedin != 'none' ) { 										
	// 												$teammembers .= '<li><a class="linkedin" href="'. $tmq_memberlinkedin .'" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
	// 											}	
	// 											if ( !empty( $tmq_memberphone) && $tmq_memberphone != 'none' ) { 										
	// 												$teammembers .= '<li><a data-toggle="tooltip" data-placement="top" title="'. $tmq_memberphone .'" class="phone" href="tel:'. $tmq_memberphone .'" target="_blank"><i class="fa fa-phone"></i></a></li>';
	// 											}									
	// 										$teammembers .= '</ul>';
	// 										if ( '' != get_the_post_thumbnail() ) {
	// 											$teammembers .= $team_image;
	// 										}
	// 									$teammembers .= '</div>
	// 									<div class="staff-post-content">
	// 										<h5>' . get_the_title() .'</h5>
	// 										<span>'. $tmq_memberposition .'</span>
	// 									</div>
	// 								</div>
	// 							</div>';
	// 							if ( is_int( $teammembers_counter / $cols ) ) {
							// If it's the end. if it's on 2, 4, 6 ... or 3, 6, 9 ...
	// 									$teammembers .= '</div>';
	// 									$teammembers .= "\n\t" . '</div>';
	// 							}															
	// 						endwhile;
	// 						if ( !is_int( $teammembers_counter / $cols ) ) {
						// If it's done without closing the row in the last condition (it didn't finished on a round number)
	// 									$teammembers .= '</div>';
	// 									$teammembers .= "\n\t" . '</div>';
	// 						} 
	// 				endif;
	// 				wp_reset_query();
	// 						
			// Create the final output string
	// 			$teammembers .= "\n\t\t" . '</div>';
	// 			if ( $carousel == '1' ) {
				// Carousel is enabled
	// 				$teammembers .= "\n\t\t" . '<!-- Controls -->';
	// 				$teammembers .= "\n\t\t" . '<a class="left carousel-control" href="#carousel-example-generic3" data-slide="prev">';
	// 				$teammembers .= "\n\t\t\t" . '<span class="glyphicon glyphicon-chevron-left"></span>';
	// 				$teammembers .= "\n\t\t" . '</a>';
	// 				$teammembers .= "\n\t\t" . '<a class="right carousel-control" href="#carousel-example-generic3" data-slide="next">';
	// 				$teammembers .= "\n\t\t\t" . '<span class="glyphicon glyphicon-chevron-right"></span>';
	// 				$teammembers .= "\n\t\t" . '</a>';
	// 				$teammembers .= "\n\t" . '</div>';
	// 				$teammembers .= '</div>';
	// 			}
						$teammembers .= '
							<div class="'. $grid_columns .' member-col">
							'. $team_image .'
								<div class="col-sm-7 col-xs-12 member-info">
									<span class="member-name">' . get_the_title() .'</span>
									<span class="member-position">'. $tmq_memberposition .'</span>
									<p class="member-shortbio">'. $tmq_membershortbio .'</p>
									<div class="member-social">';
										if ( !empty( $tmq_membervcard ) && $tmq_membervcard != 'none' ) { 										
											$teammembers .= '<a class="vcard" href="'. esc_url($tmq_membervcard) .'"><i class="fa fa-user member-vcard link"></i></a>';
										}
										if ( !empty( $tmq_memberemailaddress) && $tmq_memberemailaddress != 'none' && is_email( $tmq_memberemailaddress ) ) { 										
											$teammembers .= '<a class="email" href="mailto:'. sanitize_email($tmq_memberemailaddress) .'"><i class="fa fa-envelope member-mail link"></i></a>';
										}
										if ( !empty( $tmq_memberfacebook) && $tmq_memberfacebook != 'none' ) { 										
											$teammembers .= '<a class="facebook" href="'. esc_url($tmq_memberfacebook) .'" target="_blank"><i class="fa fa-facebook link"></i></a>';
										}
										if ( !empty( $tmq_membertwitter) && $tmq_membertwitter != 'none' ) { 										
											$teammembers .= '<a class="twitter" href="'. esc_url($tmq_membertwitter) .'" target="_blank"><i class="fa fa-twitter link"></i></a>';
										}
										if ( !empty( $tmq_membergoogleplus) && $tmq_membergoogleplus != 'none' ) { 										
											$teammembers .= '<a class="google" href="'. esc_url($tmq_membergoogleplus) .'" target="_blank"><i class="fa fa-google-plus link"></i></a>';
										}
										if ( !empty( $tmq_memberlinkedin) && $tmq_memberlinkedin != 'none' ) { 										
											$teammembers .= '<a class="linkedin" href="'. esc_url($tmq_memberlinkedin) .'" target="_blank"><i class="fa fa-linkedin link"></i></a>';
										}	
										if ( !empty( $tmq_memberphone) && $tmq_memberphone != 'none' ) { 										
											$teammembers .= '<a href="tel:'. $tmq_memberphone .'"><i class="fa fa-phone member-phone-icon link"></i>
															<span class="member-phone">'. $tmq_memberphone .'</span></a>';
										}
									$teammembers .='</div>';
									$teammembers .='
							</div>
						</div>';
					endwhile;
			endif;
			wp_reset_query();
			
	/*end child theme edit*/
		return $teammembers;
	}
	
// }