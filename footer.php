<?php
/**
 * Vertikal
 * ==================================================
 * This is the footer file - footer.php
 *
 */
 
  /* Theme Options Variables
 * ==================================================
 */
	if ( function_exists( 'ot_get_option' ) ) {
		// Back to Top Button
		$tmq_backtotop = ot_get_option( 'tmq_backtotop' );
		if ( $tmq_backtotop != 'off' ) {
			$tmq_backtotop = '<a class="go-top" href="#"></a>';
		} else {
			$tmq_backtotop = '';
		}
		
		// Copyright Text
		$tmq_copyrighttext = ot_get_option( 'tmq_copyrighttext' );
		if ( empty( $tmq_copyrighttext ) ) {
			$tmq_copyrighttext = __( 'Copyright' , 'vertikal' ) . ' &copy; '. date( 'Y' ) .' ' . get_bloginfo( 'name' );
		}
		
		// Widgets Area
		$tmq_footerwidgetzones = ot_get_option( 'tmq_footerwidgetzones' );
		
		// Toggle Bar
		$tmq_toggle_bar = ot_get_option( 'tmq_toggle_bar' );
		if ( empty( $tmq_toggle_bar ) ) {
			$tmq_toggle_bar = 'off';
		}
		
		$tmq_togglewidgetzones = ot_get_option( 'tmq_togglewidgetzones' );
		
	} else {
		// Fall backs
		$tmq_backtotop = '<a class="go-top" href="#"></a>';
		$tmq_copyrighttext = __( 'Copyright' , 'vertikal' ) . ' &copy; '. date( 'Y' ) .' ' . get_bloginfo( 'name' );
		$tmq_footerwidgetzones = 'tmq_13_13_13';
		$tmq_toggle_bar = 'off';
		$tmq_togglewidgetzones = 'tmq_13_13_13';
	}
	
	// Read Widget Settings - We got it above
	if ( empty( $tmq_footerwidgetzones ) ) {
		// Options fallback
		$tmq_footerwidgetzones = 'tmq_13_13_13';
	}
		
	// FooterSideBar Enable
	switch ( $tmq_footerwidgetzones ) {
		case 'tmq_1': 
			$tmq_footer_template = '1';
			break;
		case 'tmq_12_12':
			$tmq_footer_template = '12_12';
			break;
		case 'tmq_13_13_13':
			$tmq_footer_template = '13_13_13';
			break;
		case 'tmq_13_23':
			$tmq_footer_template = '13_23';
			break;
		case 'tmq_23_13':
			$tmq_footer_template = '23_13';
			break;
		default:
			$tmq_footer_template = '13_13_13';
			break;
	}

	// Read Widget Settings for Toggle Bar - We got it above
	if ( empty( $tmq_togglewidgetzones ) ) {
		// Options fallback
		$tmq_togglewidgetzones = 'tmq_13_13_13';
	}		
		
	// ToggleSidebar Enable
	switch ( $tmq_togglewidgetzones ) {
		case 'tmq_1': 
			$tmq_toggle_template = '1';
			break;
		case 'tmq_12_12':
			$tmq_toggle_template = '12_12';
			break;
		case 'tmq_13_13_13':
			$tmq_toggle_template = '13_13_13';
			break;
		case 'tmq_13_23':
			$tmq_toggle_template = '13_23';
			break;
		case 'tmq_23_13':
			$tmq_toggle_template = '23_13';
			break;
		case 'tmq_14_14_14_14':
			$tmq_toggle_template = '14_14_14_14';
			break;
		case 'tmq_14_12_14':
			$tmq_toggle_template = '14_12_14';
			break;
		case 'tmq_12_14_14':
			$tmq_toggle_template = '12_14_14';
			break;
		case 'tmq_14_14_12':
			$tmq_toggle_template = '14_14_12';
			break;
		default:
			$tmq_toggle_template = '13_13_13';
			break;
	}	
 /* 
 * ==================================================
 @END Theme Options Variables */
 
 ?>
				<!-- footer 
					================================================== -->
				<footer>
					<div class="up-footer">
						<div class="row">
						<?php
							// Read footer template based on the theme options settings
							//get_template_part( 'layouts/footers/' . $tmq_footer_template, 'footer' );
						?> 	
						</div>
					</div>

					<div class="footer-line">
						<p><?php echo $tmq_copyrighttext; ?></p>
						<?php echo $tmq_backtotop; ?>
					</div>

				</footer>
				<!-- End footer -->

			</div>
			<!-- End innercontent -->

		</div>
		<!-- End content -->
	</div>
	<!-- End Container -->
	
	<?php 
		if ( $_SERVER['SERVER_NAME'] == 'preview.themique.com'  || $_SERVER['SERVER_NAME'] == 'demo.themique.com'  || $_SERVER['SERVER_NAME'] == 'localhost' ) {
	?>
  	<ul id="navigation">
  		<li><span><i class="fa fa-cogs"></i></span>
  			<div id="panel">
				<div class="colour-container">
					<h5>Sample Colors:</h5>				
  					<a class="style_corporate"></a>
  					<a class="style_cars"></a>
  					<a class="style_food"></a>
  					<a class="style_medical"></a>
  					<a class="style_charity"></a>
  					<a class="style_equestrain"></a>
  					<a class="style_furniture"></a>
  					<a class="style_photography"></a>
  					<a class="style_magazine"></a>
  		   		</div>	
				<div class="sw-width-container">
					<h5>Skins:</h5>
					<a class="premade">Pre-Made Skins</a>
				</div>
				<hr />
				<div class="sw-width-container">
					<p>You can simply enable or disable AJAX Navigation in the Theme Options</p>
				</div>
				<hr />				
				<div class="sw-width-container">
					<h5 class="sw-much-more">And Much More!</h5>
				</div>				
  			</div>
  		</li>
  	</ul>
	<?php
		}
	?>
	<?php
	if ( $tmq_toggle_bar == 'on' ) {
	?>
	<div class="tmq_toggle_bar">
		<div class="tmq_toggle_content">
			<div class="container">
				<div class="row">
				<?php
					// Read toggle bar template based on the theme options settings
					get_template_part( 'layouts/toggle/' . $tmq_toggle_template, 'toggle' );
				?> 	
				</div>
			</div>
			<div class="tmq_toggle_close">
				<i class="fa fa-times-circle"></i>
			</div>
		</div>
		<div class="tmq_toggle_switch">
		</div>
	</div>
	<?php
	}
	?>
	<div class="tmq_loading_container"><div class="tmq_loading"><div class="wBall" id="wBall_1"><div class="wInnerBall"></div></div><div class="wBall" id="wBall_2"><div class="wInnerBall"></div></div><div class="wBall" id="wBall_3"><div class="wInnerBall"></div></div><div class="wBall" id="wBall_4"><div class="wInnerBall"></div></div><div class="wBall" id="wBall_5"><div class="wInnerBall"></div></div></div></div>
	<?php
		// Load Comment Reply WP JS - We dont check for is_single because of the ajax loader
		wp_enqueue_script( 'comment-reply' );
		
		// Load Google Analytics
   		if ( function_exists( 'ot_get_option' ) ) {
			$tmq_googleanalytics = ot_get_option( 'tmq_googleanalytics' );
		} else {
			$tmq_googleanalytics = '<!-- Google Analytics -->';
		}
		
		echo $tmq_googleanalytics;		
		// Load WordPress Footer Functions		
	?>		
	<?php wp_footer(); ?>
    <script>
	function setRemoteSupportDownload(){
		var OSName="Unknown OS";
		var src= '';
		mac_link = "http://t2computing.wpengine.com//wp-content/uploads/TekserveRemoteSupport9.zip";
		windows_link = 'https://get.teamviewer.com/T2_Computing_QS';
		var download_this = '';
		var src ="";
		if (navigator.appVersion.indexOf("Win")!=-1){
			jQuery("#download-for-mac").css("display","none");
			jQuery("#download-for-mac-alt").css("display","none");
			
			jQuery("#download-for-windows").css("display","block !important");
			jQuery("#download-for-windows-alt").css("display","block !important");
		} else if (navigator.appVersion.indexOf("Mac")!=-1){
			
			jQuery("#download-for-mac").css("display","block !important");
			jQuery("#download-for-mac-alt").css("display","block !important");
			jQuery("#download-for-windows").css("display","none");
			jQuery("#download-for-windows-alt").css("display","none");
			
		} else {
			
		}
		
	//console.log("OSName",OSName);
	
}
	$( document ).ready(function() {
	  setRemoteSupportDownload();
		jQuery( "#accordion" ).accordion({
			
			heightStyle: "content" 

		});
		
	});

jQuery('a[href^="#"]').on('click', function(e) {
    e.preventDefault();

    var target = this.hash;
    var $target = jQuery(target);
    var offset = 0;//jQuery(window).height();
    // console.log("offset",offset);
    jQuery('html, body').stop().animate({
       scrollTop: jQuery( jQuery(this) ).offset().top-40


    }, 900, 'swing', function() {
        //window.location.hash = offset;
    });
});

function eMitch(){
	var person = 'msimchowitz';
	window.location = 'mailto:'+person+'@t2computing.com';
	
}






</script>
</body>
</html>