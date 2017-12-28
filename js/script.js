/*jshint jquery:true */
/*global $:true */

var $ = jQuery.noConflict();

$(document).ready(function($) {
	"use strict";
	
	//Initialize All Scripts 
	try {
		tmq_init_scripts();
		init_flexslider();
		init_magnificPopup();
		init_staff();
		init_headscroll();
		init_Ajax();
		init_ToggleBar();
		init_HeaderSearch();
		init_responsive_menu();
// child theme edit
		init_copyright_year();
		wrap_footer_button();
// end child theme edit
	} catch(err) {
		//console.log(err);
	}
});

// Superfish Menu
//=======================================   
if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i)) || (navigator.userAgent.match(/Android/i))) {
	(function($){ //create closure so we can safely use $ as alias for jQuery

		$(document).ready(function(){

			// initialise plugin
			var example = $('#header-menu').superfish({
				//add options here if required
			});

			// buttons to demonstrate Superfish's public methods
			$('.destroy').on('click', function(){
				example.superfish('destroy');
			});

			$('.init').on('click', function(){
				example.superfish();
			});

			$('.open').on('click', function(){
				example.children('li:first').superfish('show');
			});

			$('.close').on('click', function(){
				example.children('li:first').superfish('hide');
			});
		});

	})(jQuery);	
}

jQuery(window).load(function($) {
	try {
		tmq_init_centercaro();
	} catch(err) {
		//console.log(err);
	}
});

function tmq_init_centercaro() {
	var $ = jQuery.noConflict();
	/* ---------------------------------------------------------------------- */
	/*	Center Carousel
	/* ---------------------------------------------------------------------- */	
	var max_caroheight = 0;
	$('.clients-section .carousel .carousel-inner .active img').each(function() {
		if ( $(this).height() > max_caroheight ) {
			max_caroheight = $(this).height();
		}
    });

	$('.clients-section .carousel .carousel-inner .active img').each(function() {
		$(this).css('margin-top', ( ( max_caroheight - $(this).height() ) / 2 ) + 'px');
    });	
}

/* Main Script */
function tmq_init_scripts() {
	var $ = jQuery.noConflict();
	
	$('.phone').tooltip({container: 'body'});
	
	/*-------------------------------------------------*/
	/* =  portfolio isotope
	/*-------------------------------------------------*/

	var winDow = $(window);
		// Needed variables
		var $container=$('.portfolio-container');
		var $filter=$('.filter');

		try{
			$container.imagesLoaded( function(){
				$container.show();
				$container.isotope({
					filter:'*',
					layoutMode:'masonry',
					animationOptions:{
						duration:750,
						easing:'linear'
					}
				});
			});
		} catch(err) {
		}

		winDow.bind('resize', function(){
			var selector = $filter.find('a.active').attr('data-filter');

			try {
				$container.isotope({ 
					filter	: selector,
					animationOptions: {
						duration: 750,
						easing	: 'linear',
						queue	: false,
					}
				});
			} catch(err) {
			}
			return false;
		});
		
		// Isotope Filter 
		$filter.find('a').click(function(){
			var selector = $(this).attr('data-filter');

			try {
				$container.isotope({ 
					filter	: selector,
					animationOptions: {
						duration: 750,
						easing	: 'linear',
						queue	: false,
					}
				});
			} catch(err) {

			}
			return false;
		});


	var filterItemA	= $('.filter li a');

		filterItemA.on('click', function(){
			var $this = $(this);
			if ( !$this.hasClass('active')) {
				filterItemA.removeClass('active');
				$this.addClass('active');
			}
		});

	/*-------------------------------------------------*/
	/* =  Smooth Scroll
	/*-------------------------------------------------*/
	if (tmq_script_vars.plugins_scroll == 'on') {
		try {
			$.browserSelector();
			// Adds window smooth scroll on chrome.
			if($("html").hasClass("chrome")) {
				$.smoothScroll();
			}
		} catch(err) {

		}
	}
	
	/*-------------------------------------------------*/
	/* =  Scroll to TOP
	/*-------------------------------------------------*/

	var animateTopButton = $('.go-top'),
		htmBody = $('html, body');
		
	animateTopButton.click(function(){
	htmBody.animate({scrollTop: 0}, 'slow');
		return false;
	});

	/* ---------------------------------------------------------------------- */
	/*	Accordion
	/* ---------------------------------------------------------------------- */
	
	// Moved to Visual Composer in v1.4+
	// Activate first accordion
	// $('.accordion-box').each( function() {
		// $(this).find('.accord-content:eq(0)').slideDown(400, function(){});
		// $(this).find('.accord-elem:eq(0)').addClass('active');
	// });

	// var clickElem = $('a.accord-link');

	// clickElem.on('click', function(e){
		// e.preventDefault();
		
		// var $this = $(this),
			// parentCheck = $this.parent('div').parent('.accord-elem'),
			// accordContainer = $this.parent('div').parent('div').parent('div'),
			// accordItems = accordContainer.find('.accord-elem'),
			// accordContent = accordContainer.find('.accord-content');
			
		// if( !parentCheck.hasClass('active')) {
			// // Close active accordions and open current accordion
			// accordContent.slideUp(400, function(){
				// accordItems.removeClass('active');
			// });
			// parentCheck.find('.accord-content').slideDown(400, function(){
				// parentCheck.addClass('active');
			// });

		// } else {
			// // Close the open accordion ( User clicked it while it's open )
			// accordContent.slideUp(400, function(){
				// accordItems.removeClass('active');
			// });

		// }
	// });
	
	var clickElem = $('.accord-title');

	clickElem.on('click', function(e){
		e.preventDefault();
		
		var $this = $(this),
			parentCheck = $this.parent('.accord-elem'),
			accordContainer = $this.parent('div').parent('div'),
			accordItems = accordContainer.find('.accord-elem'),
			accordContent = accordContainer.find('.accord-content');
			
		if( !parentCheck.hasClass('active')) {
			// Close active accordions and open current accordion
			accordContent.slideUp(400, function(){
				accordItems.removeClass('active');
			});
			parentCheck.find('.accord-content').slideDown(400, function(){
				parentCheck.addClass('active');
			});

		} else {
			// Close the open accordion ( User clicked it while it's open )
			accordContent.slideUp(400, function(){
				accordItems.removeClass('active');
			});

		}
	});

	/* ---------------------------------------------------------------------- */
	/*	Tabs
	/* ---------------------------------------------------------------------- */
	
	// Set the default height for each iconned-tab

	$('.iconned-tabs').each( function() {
		var largest_height = 200;
		$(this).find('.tab-content').each( function() {
			if ( $(this).outerHeight() > largest_height ) {
				largest_height = $(this).outerHeight();
			}
		});
		$(this).find('.tab-box').animate({ 'height' : largest_height + 110});
	});

	$('.tab-links li a').on('click', function(e){
		var clickTab = $('.tab-links li a');
		e.preventDefault();

		var $this = $(this),
			hisIndex = $this.parent('li').index(),
			tabContainer = $this.parent('li').parent('ul').parent('div'),
			tabCont = tabContainer.find('.tab-content'),
			tabContIndex = tabContainer.find(".tab-content:eq(" + hisIndex + ")");
			
		if( !$this.hasClass('active')) {
			
			tabContainer.find(clickTab).each( function() { 
				$(this).removeClass('active');
			});
			$this.addClass('active');

			tabCont.slideUp(400);
			tabCont.removeClass('active');
			tabContIndex.delay(500).slideDown(400);
			tabContIndex.addClass('active');
		}
	});
	
	/*-------------------------------------------------*/
	/* = skills animate
	/*-------------------------------------------------*/

	var animateElement = $(".meter > span");
	animateElement.each(function() {
		$(this).animate( {width: 'hide'} , 0);
		$(this).animate( {width: 'show'} ,1200);
	});

	
	/*-------------------------------------------------*/
	/* =  Shop accordion
	/*-------------------------------------------------*/

	var AccordElement = $('a.accordion-link');

	AccordElement.on('click', function(e){
		e.preventDefault();
		var elemSlide = $(this).parent('li').find('.accordion-list-content');

		if( !$(this).hasClass('active') ) {
			$(this).addClass('active');
			elemSlide.slideDown(200);
		} else {
			$(this).removeClass('active');
			elemSlide.slideUp(200);			
		}
	});

	/*-------------------------------------------------*/
	/* =  price range code
	/*-------------------------------------------------*/

	try {

		for( var i = 100; i <= 10000; i++ ){
			$('#start-val').append(
				'<option value="' + i + '">' + i + '</option>'
			);
		}
		// Initialise noUiSlider
		$('.noUiSlider').noUiSlider({
			range: [0,1600],
			start: [0,1000],
			handles: 2,
			connect: true,
			step: 1,
			serialization: {
				to: [ $('#start-val'),
					$('#end-val') ],
				resolution: 1
			}
		});
	} catch(err) {

	}
	
	winDow.bind('resize', function(){
		//jQuery('.navbar-vertical').removeClass('active');
	});	
}


/*-------------------------------------------------*/
/* = Responsive Menu
/*-------------------------------------------------*/
function init_responsive_menu() {
	var menuClick = jQuery('a.elemadded'),
		navbarVertical = jQuery('.navbar-vertical');
		
	menuClick.on('click', function(e){
		e.preventDefault();

		if( jQuery('.navbar-vertical').hasClass('active') ){
			jQuery('.navbar-vertical').removeClass('active');
		} else {
			jQuery('.navbar-vertical').addClass('active');
		}
	});
}

/*-------------------------------------------------*/
/* = Staff adjustment
/*-------------------------------------------------*/
// Set the default height for each staff block
function init_staff() {
	jQuery(window).load(function() {
		jQuery('.staff-box').each( function() {
			// var default_height = 320;
			var current_height = jQuery(this).find('.staff-post').parent('div').outerHeight();
			// Put some space for social items
			current_height =  current_height + 50;
			jQuery(this).find('.staff-post').each( function() {
				jQuery(this).animate({ 'height' : current_height});
			});
		});
	});
}


	function init_flexslider() {
		var SliderPost = jQuery('.flexslider');

		SliderPost.flexslider({
			animation: "slide",
			slideshowSpeed: 3000,
			easing: "swing",
			direction: "horizontal"
		});
	}
	
	function init_magnificPopup() {
		jQuery('.zoom').magnificPopup({
			type: 'image',
			gallery: {
				enabled: true
			}
		});
		
		try {
			// Example with multiple objects
			jQuery('.zoom.video').magnificPopup({
				type: 'iframe',
				gallery: {
					enabled: true
				}
			});
		} catch(err) {
			//error!
		}		
	}
	
	
	/* ---------------------------------------------------------------------- */
	/*	Header animate after scroll
	/* ---------------------------------------------------------------------- */

	function init_headscroll() {

		var docElem = document.documentElement,
		didScroll = false,
		changeHeaderOn = 40;
		document.querySelector( 'header' );
		
		function tmq_moveheader() {
			window.addEventListener( 'scroll', function() {
				if( !didScroll ) {
					didScroll = true;
					setTimeout( scrollPage, 50 );
				}
			}, false );
		}
		
		function scrollPage() {
			var sy = scrollY();
			if ( sy >= changeHeaderOn ) {
				jQuery( 'header' ).addClass('active');
			}
			else {
				jQuery( 'header' ).removeClass('active');
			}
			didScroll = false;
		}
		
		function scrollY() {
			return window.pageYOffset || docElem.scrollTop;
		}
		
		tmq_moveheader();
	}
	
function init_Ajax() {

	var tmq_siteURL = "http://" + top.location.host.toString();
	// var tmq_vMenu = jQuery('.navbar-vertical').find('a[href^="'+tmq_siteURL+'"], a[href^="/"], a[href^="./"], a[href^="../"], a[href^="#"]');
	var tmq_vMenu = jQuery('.ajaxisDisabled');
	
	tmq_vMenu.on('click', function(e) {
		e.preventDefault();
		
		var tmq_ajaxHref = jQuery(this).attr('href');

		// Continue for current page
		if ( jQuery(this).parent('li').hasClass('current-menu-item') || tmq_ajaxHref == window.location.href) {
			return true;
		}
		
		// Continue as normal for cmd clicks etc
		if ( e.which == 2 || e.metaKey || e.ctrlKey ) {
			return true;
		}
		
		//hide page
		var $tmq_current_menu_top = jQuery('header').css('left');
		var $tmq_current_top_line = jQuery('.top-line').css('margin-top');
		
		jQuery('.tmq_loading_container').fadeIn();
		jQuery('#content').animate({'opacity': 0}, 500, 'linear', function() {
			jQuery('header').animate({'left': 0}, 100, 'linear', function() {
				jQuery('.top-line').animate({'margin-top': -45}, 0, 'linear' );
			});
		});
		
		//load the ajax
		var request = jQuery.ajax({
			url: tmq_ajaxHref,
			type: 'GET',
			dataType: 'html'
		});

		request.done(function( msg ) {
			var tmq_pageContent = jQuery(msg).find('#page-content');
			jQuery( '#page-content' ).html( tmq_pageContent );
			
			var tmq_menuContent = jQuery(msg).find('.navbar-vertical');
			jQuery('.navbar-vertical').html( tmq_menuContent );

			var tmq_pageTitle = jQuery(msg).filter('title').text();
			jQuery('title').text(tmq_pageTitle);
			
			history.pushState(null, tmq_pageTitle, tmq_ajaxHref);
			
			jQuery('.tmq_loading_container').fadeOut();
			jQuery('header').animate({'left': $tmq_current_menu_top}, 200, 'linear' );
			// jQuery('.top-line').animate({'margin-top': $tmq_current_top_line}, 0, 'linear', function() {
			jQuery('.top-line').animate({'margin-top': '0'}, 0, 'linear', function() {
				jQuery('#content').animate({'opacity': 1}, 500, 'linear', function() { 
					try {
						tmq_init_scripts();
						init_flexslider();
						init_magnificPopup();
						init_staff();
						init_headscroll();
						init_Ajax();
						init_teaserGrid();
					} catch(err) {
						//console.log(err);
					}
				});
			});	
		});

		request.fail(function( jqXHR, textStatus ) {
			alert( "Request failed: " + textStatus );
		});
		
		request.always(function( jqXHR, textStatus ) {
			// always what?
		});
	});
}	

// Toggle Bar
function init_ToggleBar () {
	jQuery('.tmq_toggle_bar .tmq_toggle_switch, .tmq_toggle_bar .tmq_toggle_close').on('click', function() {
		if (jQuery('.tmq_toggle_bar .tmq_toggle_switch').hasClass('active') ) {
			jQuery('.tmq_toggle_bar .tmq_toggle_content').animate({'height': 'hide', 'padding': 'hide'}, function() {
				jQuery('.tmq_toggle_bar').css({'z-index': '0'});
			});
			jQuery('.tmq_toggle_bar .tmq_toggle_switch').removeClass('active');
		} else {
			jQuery('.tmq_toggle_bar').animate({'z-index': '10000'}, function() {
			jQuery('.tmq_toggle_bar .tmq_toggle_content').animate({'height': 'show', 'padding': 'show'});
			jQuery('.tmq_toggle_bar .tmq_toggle_switch').addClass('active');
			});
		}
	});
}

// Header Search Box
function init_HeaderSearch () {
	jQuery('.top-line .search_topbar').on('click', function() {
		if (jQuery('.top-line .search-header-form').hasClass('active') ) {
			//child theme edit
// 			jQuery('.search-icons').animate({'width': '26px'});
			jQuery('.top-line .search-icons').animate({'width': '26px'});
			//end child theme edit
			jQuery('.top-line .search-header-form').animate({'width': '0', 'opacity': '0', 'padding-right': '0', 'padding-left': '0', 'margin-right': '-35px'});
			jQuery('.top-line .search-header-form input').animate({'width': '0'});
			jQuery('.top-line .search-header-form').removeClass('active');
		} else {
//child theme edit
// 			jQuery('.search-icons').animate({'width': '191px'});
			jQuery('.top-line .search-icons').animate({'width': '191px'});
//end child theme edit
			jQuery('.top-line .search-header-form').animate({'width': '190px', 'opacity': '1', 'padding-right': '10px', 'padding-left': '10px', 'margin-right': '-35px'});
			jQuery('.top-line .search-header-form input').animate({'width': '160px'});
			jQuery('.top-line .search-header-form').addClass('active');
			jQuery('.top-line .search-header-form input').focus();
		}
	});
}

// Duplicate code for initializing VC animation on Ajax
function tmq_waypoints() {
	jQuery('.wpb_animate_when_almost_visible').waypoint(function() {
		jQuery(this).addClass('wpb_start_animation');
	}, { offset: '85%' });
}
// child theme edit
// Set copyright to current year
function init_copyright_year() {
	var $ = jQuery.noConflict();
	var d = new Date();
	$( '#copyYear' ).html( d.getFullYear() );	
}

// wrap footer submit button in span
function wrap_footer_button() {

	if ( jQuery( '.contact-footer input[type="submit"]' ).length > 0 ) {
	
		jQuery( '.contact-footer input[type="submit"]' ).wrap( '<span class="form-submit"></span>' );
	
	}
	
}
//end child theme edit

