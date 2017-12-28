<?php
/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', 'tmq_vertikal_meta_boxes' );

/**
 * @access    private
 * @since     2.0
 */
 
function tmq_vertikal_meta_boxes() {
	// Get supported post formats
	$format_arg = array( 'gallery', 'video' );
	if ( is_array( $format_arg ) ) {
		add_theme_support( 'post-formats', $format_arg );
	}
	/**
	* After adding the theme support, we add an empty item to $format_arg to make it an array to prevent system 
	* conflict null and array
	*/	
	if ( empty( $format_arg ) ) {
		$format_arg[] = '';
	}
  
  /**
   * Create a custom meta boxes array that we pass to 
   * the OptionTree Meta Box API Class.
   */

   // Get Sidebars in Array
	$tmq_sidebarsArray = array();
	
	$tmq_sidebarsArray[] = array('label' => __('Default (Theme Options)', 'vertikal'), 'value' => 'theme-options');
	$tmq_sidebarsArray[] = array('label' => __('Right Sidebar', 'vertikal'), 'value' => tmq_generateSlug('right-sidebar', 45));
	$tmq_sidebarsArray[] = array('label' => __('Left Sidebar', 'vertikal'), 'value' => tmq_generateSlug('left-sidebar', 45));

	//echo $tmq_sidebarsArray .'-'. $tmq_sidebarsArray[0] .'-'. $tmq_sidebarsArray[0][0];
	
	$tmq_customsidebars = ot_get_option( 'tmq_customsidebars' );
	if(!empty($tmq_customsidebars) && sizeof($tmq_customsidebars) > 0)  
	{  
		foreach($tmq_customsidebars as $sidebar)  
		{  
			foreach( $sidebar as $myside ) {
				$tmq_sidebarsArray[] = array('label' => $myside, 'value' => tmq_generateSlug($myside, 45));
			}
		}  
	} 
	//End Get Sidebars
	
	$tmq_post_options = array (
		array(
			'id'          => 'tmq_sidebar_settings',
			'title'       => __('Sidebar Settings', 'vertikal'),
			'desc'        => '',
			'pages'       => array( 'post', 'page', 'tmq-portfolio' ),
			'context'     => 'side',
			'priority'    => 'high',
			'fields'      => array(
				array(
					'id'          => 'tmq_sidebar_position',
					'label'       => __('Sidebar Position', 'vertikal'),
					'std'         => 'tmq_default',
					'type'        => 'radio-image',
					'section'     => 'tmq_pageoptions_sec',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'choices'     => array(
						array(
							'value'       => 'tmq_leftsidebar',
							'label'       => __('Left Sidebar', 'vertikal'),
							'src'         => get_template_directory_uri() . '/includes/framework/images/sch_sides_left_105.png'
						),
						array(
							'value'       => 'tmq_rightsidebar',
							'label'       => __('Right Sidebar', 'vertikal'),
							'src'         => get_template_directory_uri() . '/includes/framework/images/sch_sides_right_105.png'
						),
						array(
							'value'       => 'tmq_fullwidth',
							'label'       => __('Full Width', 'vertikal'),
							'src'         => get_template_directory_uri() . '/includes/framework/images/sch_sides_full_width_105.png'
						),
						array(
							'value'       => 'tmq_default',
							'label'       => __('Default (Read From Theme Options)', 'vertikal'),
							'src'         => get_template_directory_uri() . '/includes/framework/images/sch_sides_default_105.png'
						)
					),
				),
				array(
					'label'       => __('Choose Sidebar (If appliable)', 'vertikal'),
					'id'          => 'tmq_pagesidebar',
					'type'        => 'sidebar-select',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'condition'   => 'tmq_sidebar_position:not(tmq_fullwidth)',
					'operator'    => 'and',						
					'taxonomy'    => '',
					'class'       => ''
				),
				array(
					'id'          => 'tmq_pagesidebar_desc',
					'type'        => 'textblock',
					'desc'        => 'Leave the above field empty to read the default sidebar from theme options',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'condition'   => 'tmq_sidebar_position:isnot(tmq_fullwidth)',
					'operator'    => 'and',						
					'taxonomy'    => '',
					'class'       => ''
				)
			)
		),
		array(
			'id'          => 'tmq_featured_image_single',
			'title'       => __('Featured Image Settings', 'vertikal'),
			'desc'        => '',
			'pages'       => array( 'post', 'tmq-portfolio' ),
			'context'     => 'side',
			'priority'    => 'low',
			'fields'      => array(
				array(
				  'id'          => 'tmq_featured_image_text',
  				  'label'       => 'Featured Image Desc',
  				  'desc'        => 'Show featured image in single page:',
				  'std'         => '',
				  'type'        => 'textblock',
				  'rows'        => '',
				  'post_type'   => '',
				  'taxonomy'    => '',
				  'class'       => ''
			    ),
				array(
					'label'       => '',
					'id'          => 'tmq_featured_image',
					'type'        => 'on-off',
					'desc'        => '',
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				)
			)
		),
		array(
			'id'          => 'tmq_gallery_options',
			'title'       => __('Gallery Post Format', 'vertikal'),
			'desc'        => '',
			'pages'       => array( 'post', 'tmq-portfolio' ),
			'context'     => 'side',
			'priority'    => 'high',
			'fields'      => array(
			    array(
				  'id'          => 'tmq_gallery_desc',
  				  'label'       => 'Gallery Desc',
  				  'desc'        => 'Upload images that you want to see in this post slideshow - This will only works with <strong>GALLERY</strong> post format.',
				  'std'         => '',
				  'type'        => 'textblock',
				  'rows'        => '',
				  'post_type'   => '',
				  'taxonomy'    => '',
				  'class'       => ''
			    ),
				array(
					'id'          => 'tmq_gallery_post_format_images',
					'type'        => 'gallery',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
				)
			)
		),
		array(
			'id'          => 'tmq_author_options',
			'title'       => __('Author Options', 'vertikal'),
			'desc'        => '',
			'pages'       => array( 'post' ),
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				array(
					'label'       => __('Author Information Box', 'vertikal'),
					'id'          => 'tmq_author_box',
					'type'        => 'select',
					'desc'        => __('Do you want your visitors see the author information box in bottom of this post?', 'vertikal'),
					'std'         => 'tmq_default',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'choices'     => array(
						array(
						'label'        => __('Default (Read from theme options)', 'vertikal'),
						'value'        => 'tmq_default'
						),
						array(
						'label'        => __('Show', 'vertikal'),
						'value'        => 'tmq_show'
						),
						array(
						'label'        => __('Hide', 'vertikal'),
						'value'        => 'tmq_hide'
						)
					)
				)
			)
		),
		array(
			'id'          => 'tmq_review_options',
			'title'       => __('Review Post Type', 'vertikal'),
			'desc'        => '',
			'pages'       => array( 'post' ),
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				array(
					'label'       => __('Enable as a Review', 'vertikal'),
					'id'          => 'tmq_reviewtype',
					'type'        => 'on-off',
					'desc'        => __('Configure this post as a review?', 'vertikal'),
					'std'         => 'off',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
				),array(
					'label'       => __('Overall Rating', 'vertikal'),
					'id'          => 'tmq_review_rating',
					'type'        => 'text',
					'desc'        => __('Rate this post from 0 to 10', 'vertikal'),
					'std'         => '8',
					'rows'        => '',
					'type'        => 'numeric-slider',
					'taxonomy'    => '',
					'min_max_step'=> '0,10,0.5',
					'condition'   => 'tmq_reviewtype:is(on)',
					'operator'    => 'and',	
					'taxonomy'    => '',
					'class'       => ''
				),array(
					'label'       => __('Rating Title', 'vertikal'),
					'id'          => 'tmq_review_title',
					'type'        => 'text',
					'desc'        => __('Enter review title here. Such as Very Good! Fantastic! Awesome!', 'vertikal'),
					'std'         => 'Very Good!',
					'rows'        => '',
					'post_type'   => '',
					'condition'   => 'tmq_reviewtype:is(on)',
					'operator'    => 'and',						
					'taxonomy'    => '',
					'class'       => ''
				),
				array(
					'id'          => 'tmq_review_overview',
					'label'       => __('Review Overview Text', 'vertikal'),
					'desc'        => __('Tell what you feel about what you have reviewed in this post in a few words', 'vertikal'),
					'std'         => '',
					'type'        => 'textarea',
					'rows'        => '3',
					'post_type'   => '',
					'condition'   => 'tmq_reviewtype:is(on)',
					'operator'    => 'and',			
					'taxonomy'    => '',
					'class'       => '',
				),
				array(
					'label'       => __('Review Items (Optional)', 'vertikal'),
					'id'          => 'tmq_review_item',
					'type'        => 'list-item',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'condition'   => 'tmq_reviewtype:is(on)',
					'operator'    => 'and',					
					'taxonomy'    => '',
					'class'       => '',
					'settings'	  => array(
						array(
							'label'       => __('Your Rate (Percent)', 'vertikal'),
							'id'          => 'tmq_review_item_rate',
							'type'        => 'textarea',
							'desc'        => __('Rate this item in percent.', 'vertikal'),
							'std'         => '80',
							'rows'        => '',
							'post_type'   => '',
							'type'        => 'numeric-slider',
							'taxonomy'    => '',
							'min_max_step'=> '0,100,1',
							'class'       => ''						
						)
					)
				)				
			)
		),		
		array(
			'id'          => 'tmq_slider_options',
			'title'       => __('Slider Settings', 'vertikal'),
			'desc'        => '',
			'pages'       => array( 'post', 'page', 'tmq-portfolio' ),
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				array(
					'label'       => __('Slider Type', 'vertikal'),
					'id'          => 'tmq_slidertype',
					'type'        => 'select',
					'desc'        => __('How should this page deal with Sliders?', 'vertikal'),
					'std'         => 'tmq_text',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'choices'     => array(
						array(
							'label'        => __('None', 'vertikal'),
							'value'        => 'tmq_none'
						),
						array(
							'label'        => __('Text and Background', 'vertikal'),
							'value'        => 'tmq_text'
						),
						array(
							'label'        => __('Revolution Slider', 'vertikal'),
							'value'        => 'tmq_revolution'
						),
						array(
							'label'        => __('Flex Slider', 'vertikal'),
							'value'        => 'tmq_flex'
						)
					)
				),array(
					'label'       => __('Page / Post Heading', 'vertikal'),
					'id'          => 'tmq_banner_title',
					'type'        => 'text',
					'desc'        => __('The Main Title of this Page or Post.', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'condition'   => 'tmq_slidertype:is(tmq_text)',
					'operator'    => 'and',	
					'taxonomy'    => '',
					'class'       => ''
				),array(
					'label'       => __('Page / Post Subtitle', 'vertikal'),
					'id'          => 'tmq_banner_subtitle',
					'type'        => 'text',
					'desc'        => __('The second line in the banner area. A quick description about this page/post. Use at most 10 words.', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'condition'   => 'tmq_slidertype:is(tmq_text)',
					'operator'    => 'and',						
					'taxonomy'    => '',
					'class'       => ''
				),
				array(
					'id'          => 'tmq_banner_bg_type',
					'label'       => 'Background Type',
					'desc'        => 'Choose the background type of banner area?',
					'std'         => 'tmq_default',
					'type'        => 'select',
					'rows'        => '',
					'post_type'   => '',
					'condition'   => 'tmq_slidertype:is(tmq_text)',
					'operator'    => 'and',			
					'taxonomy'    => '',
					'class'       => '',
					'choices'     => array(
						array(
							'value'       => 'tmq_default',
							'label'       => 'Theme Default',
							'src'         => ''
						),					
						array(
							'value'       => 'tmq_color',
							'label'       => 'Background Color',
							'src'         => ''
						),
						array(
							'value'       => 'tmq_gradient',
							'label'       => 'Gradient Background Color',
							'src'         => ''
						),
						array(
							'value'       => 'tmq_image',
							'label'       => 'Background Image',
							'src'         => ''
						)
					),
				),
				array(
					'id'          => 'tmq_banner_background_color',
					'label'       => 'Background Color of Banner Area',
					'desc'        => 'Choose the background color of the background area',
					'std'         => '',
					'type'        => 'colorpicker',
					'rows'        => '',
					'post_type'   => '',
					'condition'	  => 'tmq_slidertype:is(tmq_text),tmq_banner_bg_type:is(tmq_color)',
					'operator'	  => 'and',		
					'taxonomy'    => '',
					'class'       => ''
				),
				array(
					'id'          => 'tmq_banner_background_gradient_1',
					'label'       => 'Gradient Color - Start',
					'desc'        => 'Choose the start color of the background gradient color of banner area',
					'std'         => '',
					'type'        => 'colorpicker',
					'rows'        => '',
					'post_type'   => '',
					'condition'	  => 'tmq_slidertype:is(tmq_text),tmq_banner_bg_type:is(tmq_gradient)',
					'operator'	  => 'and',		
					'taxonomy'    => '',
					'class'       => ''
				),
				array(
					'id'          => 'tmq_banner_background_gradient_2',
					'label'       => 'Gradient Color - End',
					'desc'        => 'Choose the end color of the background gradient color of banner area',
					'std'         => '',
					'type'        => 'colorpicker',
					'rows'        => '',
					'post_type'   => '',
					'condition'	  => 'tmq_slidertype:is(tmq_text),tmq_banner_bg_type:is(tmq_gradient)',
					'operator'	  => 'and',		
					'taxonomy'    => '',
					'class'       => ''
				),
				array(
					'label'       => __('Upload Background Image for Banner Area', 'vertikal'),
					'id'          => 'tmq_banner_background_image',
					'type'        => 'upload',
					'desc'        => __('Upload image to set it as the background image of the banner area.<br><br> This will only work if <strong>Text and Background</strong> is set as <strong>Slider Type</strong>.', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'condition'   => 'tmq_slidertype:is(tmq_text),tmq_banner_bg_type:is(tmq_image)',
					'operator'    => 'and',						
					'taxonomy'    => '',
					'class'       => ''
				),array(
					'label'       => __('Choose Revolution Slider to Show', 'vertikal'),
					'id'          => 'tmq_revolution_slider',
					'type'        => 'revslider-select',
					'desc'        => __('Choose a revolution slider which you have built previously.<br><br> This will only work if <strong>Revolution Slider</strong> is set as <strong>Slider Type</strong>.', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'condition'   => 'tmq_slidertype:is(tmq_revolution)',
					'operator'    => 'and',						
					'taxonomy'    => '',
					'class'       => ''
				),array(
					'label'       => __('Upload Images for Flex Slider', 'vertikal'),
					'id'          => 'tmq_flex_gallery',
					'type'        => 'gallery',
					'desc'        => __('Uplad images to be used in flex slider.', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'condition'   => 'tmq_slidertype:is(tmq_flex)',
					'operator'    => 'and',						
					'taxonomy'    => '',
					'class'       => ''
				)
			)
		),
		array(
			'id'          => 'tmq_custom_background',
			'title'       => __('Custom Background Image', 'vertikal'),
			'desc'        => '',
			'pages'       => array( 'post', 'tmq-portfolio', 'page' ),
			'context'     => 'normal',
			'priority'    => 'low',
			'fields'      => array(
				array(
					'id'          => 'tmq_backgroundimage',
					'label'       => 'Background Image',
					'desc'        => 'Upload a large and beautiful background image for this page. If you leave this empty, it will load from theme options default background image.',
					'std'         => '',
					'type'        => 'upload',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				)
			)
		),
		array(
			'id'          => 'tmq_relatedposts_options',
			'title'       => __('Related Posts Options', 'vertikal'),
			'desc'        => '',
			'pages'       => array( 'post', 'tmq-portfolio' ),
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				array(
					'label'       => __('Related Posts', 'vertikal'),
					'id'          => 'tmq_relatedposts',
					'type'        => 'select',
					'desc'        => __('Show related post at the end of the current post.', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'choices'     => array(
						array(
						'label'        => __('Default (Read from theme options)', 'vertikal'),
						'value'        => 'tmq_default'
						),
						array(
						'label'        => __('Show', 'vertikal'),
						'value'        => 'tmq_show'
						),
						array(
						'label'        => __('Hide', 'vertikal'),
						'value'        => 'tmq_hide'
						)
					)
				)
			)
		),
		array(
			'id'          => 'tmq_team_member_options',
			'title'       => __('Themique Team Member Options', 'vertikal'),
			'desc'        => '',
			'pages'       => array( 'team-members' ),
			'context'     => 'normal',
			'priority'    => 'low',
			'fields'      => array(
				array(
					'label'       => __('Member Position', 'vertikal'),
					'id'          => 'tmq_memberposition',
					'type'        => 'text',
					'desc'        => __('Enter member position in the Company.', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				),
//child theme edit
				array(
					'label'	      => __('Short Bio', 'vertikal'),
					'id'          => 'tmq_membershortbio',
					'type'        => 'texta',
					'desc'        => __('Short bio to display on the team page.', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				),
//end child theme edit
				array(
					'label'       => __('Facebook Profile', 'vertikal'),
					'id'          => 'tmq_memberfacebook',
					'type'        => 'text',
					'desc'        => __('Member\'s Facebook profile url. Enter "none" to omit this item.', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				),array(
					'label'       => __('Twitter Page', 'vertikal'),
					'id'          => 'tmq_membertwitter',
					'type'        => 'text',
					'desc'        => __('Member\'s Twitter page url. Enter "none" to omit this item.', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				),array(
					'label'       => __('Google Plus Page', 'vertikal'),
					'id'          => 'tmq_membergoogleplus',
					'type'        => 'text',
					'desc'        => __('Member\'s Google+ page url. Enter "none" to omit this item.', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				),array(
					'label'       => __('LinkedIn Page', 'vertikal'),
					'id'          => 'tmq_memberlinkedin',
					'type'        => 'text',
					'desc'        => __('Member\'s LinkedIn page url. Enter "none" to omit this item.', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				),array(
					'label'       => __('Website URL', 'vertikal'),
					'id'          => 'tmq_memberweburl',
					'type'        => 'text',
					'desc'        => __('Member\'s Website url. Enter "none" to omit this item.', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				),array(
					'label'       => __('Email Address', 'vertikal'),
					'id'          => 'tmq_memberemailaddress',
					'type'        => 'text',
					'desc'        => __('Member\'s Email address. Enter "none" to omit this item.', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				),array(
					'label'       => __('Phone Number', 'vertikal'),
					'id'          => 'tmq_memberphone',
					'type'        => 'text',
					'desc'        => __('Member\'s Phone Number. Enter "none" to omit this item.', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				),
//child theme edit
				array(
					'label'       => 'vCard',
					'id'          => 'tmq_membervcard',
					'type'        => 'upload',
					'desc'        => __('Upload a vCard for this Member', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				)
//end child theme edit
			)
		),
		array(
			'id'          => 'tmq_testimonials_options',
			'title'       => __('Themique Testimonials Options', 'vertikal'),
			'desc'        => '',
			'pages'       => array( 'tmq-testimonials' ),
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				array(
					'label'       => __('Author Company', 'vertikal'),
					'id'          => 'tmq_testimonial_company',
					'type'        => 'text',
					'desc'        => __('Company name of testimonial author', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				),array(
					'label'       => __('Author Role / Job', 'vertikal'),
					'id'          => 'tmq_testimonial_role',
					'type'        => 'text',
					'desc'        => __('Role of the testimonial author in the company', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				),array(
					'label'       => __('Author Email', 'vertikal'),
					'id'          => 'tmq_testimonial_email',
					'type'        => 'text',
					'desc'        => __('Email address of the testimonial author', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				),array(
					'label'       => __('Testimonial', 'vertikal'),
					'id'          => 'tmq_testimonial_text',
					'type'        => 'textarea',
					'desc'        => __('What did he/she said?', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				)
			)
		),
		array(
			'id'          => 'tmq_pricetable_options',
			'title'       => __('Themique Price Table Items', 'vertikal'),
			'desc'        => '',
			'pages'       => array( 'tmq-pricetable' ),
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				array(
					'label'       => __('List of Items', 'vertikal'),
					'id'          => 'tmq_price_item',
					'type'        => 'list-item',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'settings'	  => array(
						array(
							'label'       => __('Is Featured', 'vertikal'),
							'id'          => 'tmq_price_item_featured',
							'type'        => 'on-off',
							'desc'        => __('Is this the most recommended package that you want to offer? Will style different.', 'vertikal'),
							'std'         => 'off',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => '',
						),
						array(
							'label'       => __('Price', 'vertikal'),
							'id'          => 'tmq_price_item_price',
							'type'        => 'text',
							'desc'        => __('e.g. $10.99/month', 'vertikal'),
							'std'         => '$10.99/month',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => ''						
						),
						array(
							'label'       => __('Feature #1', 'vertikal'),
							'id'          => 'tmq_price_item_f1',
							'type'        => 'text',
							'desc'        => __('Any feature you wish', 'vertikal'),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => ''						
						),
						array(
							'label'       => __('Feature #2', 'vertikal'),
							'id'          => 'tmq_price_item_f2',
							'type'        => 'text',
							'desc'        => __('Any feature you wish', 'vertikal'),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => ''						
						),
						array(
							'label'       => __('Feature #3', 'vertikal'),
							'id'          => 'tmq_price_item_f3',
							'type'        => 'text',
							'desc'        => __('Any feature you wish', 'vertikal'),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => ''						
						),
						array(
							'label'       => __('Feature #4', 'vertikal'),
							'id'          => 'tmq_price_item_f4',
							'type'        => 'text',
							'desc'        => __('Any feature you wish', 'vertikal'),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => ''						
						),
						array(
							'label'       => __('Feature #5', 'vertikal'),
							'id'          => 'tmq_price_item_f5',
							'type'        => 'text',
							'desc'        => __('Any feature you wish', 'vertikal'),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => ''						
						),
						array(
							'label'       => __('Feature #6', 'vertikal'),
							'id'          => 'tmq_price_item_f6',
							'type'        => 'text',
							'desc'        => __('Any feature you wish', 'vertikal'),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => ''						
						),
						array(
							'label'       => __('Button Text', 'vertikal'),
							'id'          => 'tmq_price_item_button',
							'type'        => 'text',
							'desc'        => __('e.g. SIGN UP! / ORDER NOW! / MORE', 'vertikal'),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => ''						
						),
						array(
							'label'       => __('Button Link', 'vertikal'),
							'id'          => 'tmq_price_item_href',
							'type'        => 'text',
							'desc'        => __('Link of the Table Button', 'vertikal'),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => ''						
						),
					)
				)
			)
		),
		array(
			'id'          => 'tmq_clients_options',
			'title'       => __('Themique Clients List', 'vertikal'),
			'desc'        => '',
			'pages'       => array( 'tmq-clients' ),
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				array(
					'label'       => __('Clients List', 'vertikal'),
					'id'          => 'tmq_clients_list',
					'type'        => 'list-item',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'settings'	  => array(
						array(
							'label'       => __('Logo', 'vertikal'),
							'id'          => 'tmq_clients_logo',
							'type'        => 'upload',
							'desc'        => __('Upload client\'s logo here.', 'vertikal'),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => ''						
						),array(
							'label'       => __('Link to Website', 'vertikal'),
							'id'          => 'tmq_clients_website',
							'type'        => 'text',
							'desc'        => __('Leave empty or enter "none" to ignore this item', 'vertikal'),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => ''						
						)
					)
				)
			)
		),
		array(
			'id'          => 'tmq_link_format',
			'title'       => __('Post Formats (LINK)', 'vertikal'),
			'desc'        => '',
			'pages'       => array( 'post' ),
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				array(
					'label'       => __('URL to Link', 'vertikal'),
					'id'          => 'tmq_linkurl',
					'type'        => 'text',
					'desc'        => __('Enter link URL which you want the Link Post Format links to it.', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				)
			)
		),
		array(
			'id'          => 'tmq_audio_format',
			'title'       => __('Post Formats (AUDIO)', 'vertikal'),
			'desc'        => '',
			'pages'       => array( 'post' ),
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				array(
					'label'       => __('Audio Source', 'vertikal'),
					'id'          => 'tmq_audiosource',
					'type'        => 'select',
					'desc'        => __('What is the source of audio file which you want to put it into your site?', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'choices'     => array(
						array(
							'label'        => __('Third Party (SoundCloud)', 'vertikal'),
							'value'        => 'tmq_thirdparty'
						),
						array(
							'label'        => __('Hosted', 'vertikal'),
							'value'        => 'tmq_hosted'
						)
					)
				),array(
					'label'       => __('(SoundCloud) Enter Embed Code', 'vertikal'),
					'id'          => 'tmq_audiosoundcloud',
					'type'        => 'textarea',
					'desc'        => __('Enter the embed code from SoundCloud website.', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				),
				array(
					'label'       => __('(Hosted) Upload Audio File', 'vertikal'),
					'id'          => 'tmq_audiohosted',
					'type'        => 'upload',
					'desc'        => __('Upload audio file for audio format post here.', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				)
			)
		),
		array(
			'id'          => 'tmq_video_format',
			'title'       => __('Video Post Formats', 'vertikal'),
			'desc'        => '',
			'pages'       => array( 'post', 'tmq-portfolio' ),
			'context'     => 'side',
			'priority'    => 'high',
			'fields'      => array(
				array(
					'label'       => __('Video Post Format', 'vertikal'),
					'id'          => 'tmq_video_text',
					'type'        => 'textblock',
					'desc'        => __('<strong>Youtube Video URL</strong><br><hr>Enter youtube video URL (Only works in video post format).', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				),
				array(
					'id'          => 'tmq_video_url',
					'type'        => 'text',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				)
			)
		),
		array(
			'id'          => 'tmq_quote_format',
			'title'       => __('Post Formats (QUOTE)', 'vertikal'),
			'desc'        => '',
			'pages'       => array( 'post' ),
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				array(
					'label'       => __('Quoted Text', 'vertikal'),
					'id'          => 'tmq_quotedtext',
					'type'        => 'textarea',
					'desc'        => __('Enter quoted text here.', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				),
				array(
					'label'       => __('Quoted From', 'vertikal'),
					'id'          => 'tmq_quotedfrom',
					'type'        => 'text',
					'desc'        => __('Enter the person name who this text is quoted from him/her.', 'vertikal'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => ''
				)
			)
		)	
	);
  
  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */
   foreach ( $tmq_post_options as $tmq_option ) {
		/** 
		 *	This switch will check for enabled post-formats in admin panel. Only enabled post-formats related
		 *  metaboxes will load. DEFAULT switch will register other metaboxes without any conditions.
		 */
		switch ( $tmq_option['id'] ) {
			case 'tmq_link_format':
				if (in_array( 'link', $format_arg )){
					ot_register_meta_box( $tmq_option );
				}			
				break;
			case 'tmq_quote_format':
				if (in_array( 'quote', $format_arg )){
					ot_register_meta_box( $tmq_option );
				}
				break;
			case 'tmq_audio_format':
				if (in_array( 'audio', $format_arg )){
					ot_register_meta_box( $tmq_option );
				}			
				break;
			case 'tmq_video_format':
				if (in_array( 'video', $format_arg )){
					ot_register_meta_box( $tmq_option );
				}			
				break;
			default:
				ot_register_meta_box( $tmq_option );
				break;
		}
	}

}
