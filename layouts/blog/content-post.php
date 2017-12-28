<?php
	// Check if it's blog single post
	if ( is_single() ) {
		// Get sidebar of this post
		$tmq_pagesidebar = get_post_meta( $post->ID, 'tmq_pagesidebar', true);
		
		// Zoom Effect for SlideShow
		if ( function_exists( 'ot_get_option' ) ) {
			$tmq_gallery_image_zoom = ot_get_option( 'tmq_gallery_image_zoom' );
		} else {
			// fallback
			$tmq_gallery_image_zoom = 'tmq_zoom';
		}
		
		// Fallback for empty theme options
		if ( empty( $tmq_gallery_image_zoom ) ) {
			$tmq_gallery_image_zoom = 'tmq_zoom';
		}

		// Get Featured Image Settings
		$tmq_featured_image = get_post_meta( $post->ID, 'tmq_featured_image', true);		
		
	} elseif ( is_search() ) {
		$tmq_pagesidebar = ot_get_option( 'tmq_search_right_sidebar' );
	} else {
		$tmq_pagesidebar = '';
	}
	
	// Posts Limit Excerpt
	$tmq_blogexceptlimit = ot_get_option( 'tmq_blogexceptlimit' );
	if ( empty( $tmq_blogexceptlimit ) ) {
		$tmq_blogexceptlimit = '40';
	}
	
	// Posts Limit Excerpt After!
	$tmq_blogexcept_after_text = ot_get_option( 'tmq_blogexcept_after_text' );
	
	// If sidebar is not selected or if it's main index page
	if ( $tmq_pagesidebar == '' || empty( $tmq_pagesidebar ) ) {
		// Set to default theme options if nothing is set or it says to read from default
		if ( function_exists( 'ot_get_option' ) ) {
			$tmq_pagesidebar = ot_get_option( 'tmq_blog_right_sidebar' );
		} else {
			// fallback
			$tmq_pagesidebar = 'right-sidebar';
		}
	}	
	
	// Is it still empty? Set a default value - fallback
	if ( $tmq_pagesidebar == '' || empty( $tmq_pagesidebar ) ) {
		$tmq_pagesidebar = 'right-sidebar';
	}
	
	// Author information box settings 
	if ( is_single() ) {
		$tmq_author_box = get_post_meta( $post->ID, 'tmq_author_box', true);
		if ( empty( $tmq_author_box ) || $tmq_author_box == 'tmq_default' ) {
			// Set to default theme options if nothing is set or it says to read from default
			if ( function_exists( 'ot_get_option' ) ) {
				$tmq_author_box = ot_get_option( 'tmq_author_box' );
			} else {
				// fallback
				$tmq_author_box = 'tmq_show';
			}
		}
		// Is it still empty? Set a default value - fallback
		if ( $tmq_author_box == '' || empty( $tmq_author_box ) ) {
			$tmq_author_box = 'tmq_show';
		}		
	}	
	
	// Related posts settings 
	if ( is_single() ) {
		$tmq_relatedposts = get_post_meta( $post->ID, 'tmq_relatedposts', true);
		if ( empty( $tmq_relatedposts ) || $tmq_relatedposts == 'tmq_default' ) {
			// Set to default theme options if nothing is set or it says to read from default
			if ( function_exists( 'ot_get_option' ) ) {
				$tmq_relatedposts = ot_get_option( 'tmq_relatedposts' );
			} else {
				// fallback
				$tmq_relatedposts = 'tmq_show';
			}
		}
		// Is it still empty? Set a default value - fallback
		if ( $tmq_relatedposts == '' || empty( $tmq_relatedposts ) ) {
			$tmq_relatedposts = 'tmq_show';
		}
		
		// Do we need to show image for related posts?
		$tmq_relatedposts_show_image = ot_get_option( 'tmq_relatedposts_show_image' );
		if ( empty( $tmq_relatedposts_show_image ) ) {
			$tmq_relatedposts_show_image = 'tmq_hide';
		}
		
		// Limit related posts excerpts
		$tmq_relatedposts_exceptlimit = ot_get_option( 'tmq_relatedposts_exceptlimit' );
		if ( empty( $tmq_relatedposts_exceptlimit ) ) {
			$tmq_relatedposts_exceptlimit = '40';
		}
		
		// Set the columns setting ( Default: 2 for pages with sidebar 3 for full width )
		$tmq_relatedposts_cols = ot_get_option( 'tmq_relatedposts_sidebar_cols' );
		if ( empty( $tmq_relatedposts_cols ) ) {
			$tmq_relatedposts_cols = 'tmq_2';
		}
		switch ( $tmq_relatedposts_cols ) {
			case 'tmq_1':
				$tmq_relatedposts_carousel_count = 1;
				$tmq_relatedposts_column_class = 'col-md-12';
				break;
			case 'tmq_2':
				$tmq_relatedposts_carousel_count = 2;
				$tmq_relatedposts_column_class = 'col-md-6';
				break;
			case 'tmq_3':
				$tmq_relatedposts_carousel_count = 3;
				$tmq_relatedposts_column_class = 'col-md-4';
				break;
			default:
				$tmq_relatedposts_carousel_count = 2;
				$tmq_relatedposts_column_class = 'col-md-6';
				break;
		}
	}
?>
			<div class="single-post-content" <?php post_class(); ?>>
			<?php
				// Detect Post Format
				$tmq_post_format = get_post_format( $post->ID );
				if ( $tmq_post_format == 'gallery' ) {
				
					$tmq_gallery_post_format_images = get_post_meta( $post->ID, 'tmq_gallery_post_format_images', true );
					// Check if it has more than one image to show it as slideshow
					if ( !empty( $tmq_gallery_post_format_images ) ) {
						$tmq_gallery_post_format_images_array = explode(',', $tmq_gallery_post_format_images);
						?>										
						<div class="flexslider">
							<ul class="slides">
							<?php 
								foreach ( $tmq_gallery_post_format_images_array as $image ) {
									$img_title = get_the_title( $image );   // title
									$img_caption = get_post_field('post_excerpt', $image ); // Get Caption - We don't use it now
									
									// Get slideshow size
									$big_array = image_downsize( $image, 'gallery-post-format' );
									$img_url = $big_array[0];
									
									// Get zoom size
									$main_array = image_downsize( $image, 'full' );
									$zoom_img_url = $main_array[0];
									?>
										<li><?php if ( $tmq_gallery_image_zoom == 'tmq_zoom' ) { 
												?><a href="<?php echo $zoom_img_url; ?>" class="zoom"><?php 
											}?><img src="<?php echo $img_url; ?>" alt="" title="<?php echo $img_title; ?>" /><?php if ( $tmq_gallery_image_zoom == 'tmq_zoom' ) { 
												?></a><?php
											}?></li>
									<?php
								}
							?>
							</ul>
						</div>
					<?php
					}
					
				} elseif ( $tmq_post_format == 'video' ) {
					$tmq_video_post_format_url = get_post_meta( $post->ID, 'tmq_video_url', true );
					$search     = '/youtube\.com\/watch\?v=([a-zA-Z0-9]+)/smi';
					$replace    = "youtube.com/embed/$1";    
					$tmq_video_post_format_url = preg_replace( $search,$replace, $tmq_video_post_format_url );
					?><div class="video-format-image-container"><?php
					echo '<iframe src="' . $tmq_video_post_format_url . '"></iframe>';
					?></div><?php
				} else { 
					// Conditional loading of featured image
					if ( $tmq_featured_image != 'off' ) {
						?>
						<div class="featured-image">
						<?php
							if ( has_post_thumbnail() && ! post_password_required() ) {
								the_post_thumbnail($post->ID, 'slideshow');
							} 
						?>
						</div>										
				<?php
					}
				} ?>
				<h1><?php the_title(); ?></h1>
<?php
/*child theme edit*/
/*
				<p class="blog-info"><?php _e('By','vertikal');?> <?php the_author_posts_link(); ?> <?php _e('In','vertikal');?> <?php 
					$i = 0;
					// Limit Number of Categories to Show on Page
					foreach((get_the_category()) as $cat) {
						if ( $i > 0 ) echo ', ';
						echo '<a href="'.get_category_link($cat->cat_ID).'">' . $cat->cat_name . '</a>';
						if (++$i == 4) break;
					}
					if ( sizeof(get_the_category()) > 4 ) {
						echo ', . . .';
					}
				 ?> <?php _e( 'On' ,'vertikal' );?> <?php echo get_the_date( );?></p>
*/
/*end child theme edit*/
?>
				<hr class="blog-info-divider">
				<?php the_content();?>
				<?php
					$post_pg_arg = array(
						'before'           => '<p>' . __( 'Pages:', 'vertikal' ),
						'after'            => '</p>',
						'link_before'      => '',
						'link_after'       => '',
						'next_or_number'   => 'number',
						'separator'        => ' | ',
						'nextpagelink'     => __( 'Next page', 'vertikal' ),
						'previouspagelink' => __( 'Previous page', 'vertikal' ),
						'pagelink'         => '%',
						'echo'             => 1
					);
					wp_link_pages( $post_pg_arg );
					
					$tmq_show_tags = 'off';
					if ( $tmq_show_tags == 'on' ) {
						the_tags();
					}
				 ?>
				<hr class="blog-content-divider">
			</div>
			<?php
			// Check if we should show it as a review post
			$tmq_reviewtype = get_post_meta( $post->ID, 'tmq_reviewtype', true );
			if ( $tmq_reviewtype == 'on' ) {
				
				$tmq_review_rating = get_post_meta( $post->ID, 'tmq_review_rating', true );
				$tmq_review_title = get_post_meta( $post->ID, 'tmq_review_title', true );
				$tmq_review_overview = get_post_meta( $post->ID, 'tmq_review_overview', true );
			
			?>
			<div class="review-box">
				<div class="review-overall">
					<div class="review-overall-rating">
						<?php _e('Overall Rating', 'vertikal')?>
					</div>
					<div class="review-rate">
						<?php
						if ( is_numeric( $tmq_review_rating ) ) {
							echo number_format($tmq_review_rating, 1);
						} else {
							echo $tmq_review_rating;
						}
						?>
					</div>
					<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
						<meta itemprop="ratingValue" content="<?php echo $tmq_review_rating;?>" />
						<meta itemprop="worstRating" content="0" />
						<meta itemprop="bestRating" content="10" />
					</div>
					<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
						<meta itemprop="ratingValue" content="<?php echo ($tmq_review_rating / 2);?>" />
						<meta itemprop="worstRating" content="1" />
						<meta itemprop="bestRating" content="5" />
					</div>												
				</div>
				<div class="review-overview">
					<h4><?php echo $tmq_review_title;?></h4>
					<p><?php echo $tmq_review_overview;?></p>
				</div>
				<div class="clearfix"></div>
			</div>
			<?php
				$tmq_review_group = get_post_meta( $post->ID, 'tmq_review_item', true );
				if ( is_array( $tmq_review_group ) ) {
					?>
					<div class="review-ratings">
						<div class="skills-progress">
							<h4><?php _e('Review Overview', 'vertikal')?></h4>
							<hr>												
					<?php
				
					foreach ( $tmq_review_group as $tmq_review_item ) {
						
						// Read Values From Post Meta Boxes
						$this_rv_title = $tmq_review_item['title'];
						$this_rv_rate = $tmq_review_item['tmq_review_item_rate'];
						?>
						<p><?php echo $this_rv_title;?> <span><?php echo $this_rv_rate;?>%</span></p>
						<div class="meter nostrips wp">
							<span style="width: <?php echo $this_rv_rate;?>%"></span>
						</div>													
						<?php
					}
					?>
						</div>
					</div>											
					<?php												
				} else {
					echo '<div class="no-rating-review"></div>';
				}
			?>
			<?php 
			}
			?>