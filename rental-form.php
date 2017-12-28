<?php
/*
Template Name: Rental Form

*/ 


$captcha_instance = new ReallySimpleCaptcha();
$word = $captcha_instance->generate_random_word();
$prefix = mt_rand();
$captcha_path = "/wp-content/plugins/really-simple-captcha/tmp/";
$img = $captcha_instance->generate_image( $prefix, $word );
$correct = $captcha_instance->check( $prefix, $the_answer_from_respondent );
//$captcha_instance->remove( $prefix );
$path = $_SERVER['DOCUMENT_ROOT'].$captcha_path;
error_reporting(E_ERROR | E_PARSE);
if ($handle = opendir($path)) {
    while (false !== ($file = readdir($handle))) { 
        $filelastmodified = filemtime($path . $file);
        //24 hours in a day * 3600 seconds per hour
        if((time() - $filelastmodified) > 10)
        {
           unlink($path . $file);
        }

    }

    closedir($handle); 
}
?>

<?php
/**
 * Vertikal
 * ==================================================
 * This is the single portfolio file - single-tmq-portfolio.php
 *
 */
wp_enqueue_script('jquery');
wp_enqueue_script('jquery-ui-core');
wp_enqueue_script('jquery-ui-datepicker');
wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');

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
              
                <div class="content-sections" id="rentals">
                
                
                <div id="rental-form-info">
					<?php
						// this is the content at the top of the page in the excerpt field
						print wpautop($post->post_excerpt);

					?>
				</div>
				 <div id="rentals-header">
				<span class="select-cat">Please select a category</span>
				 	<ul>
				 		<li class="rental-cat" title="iPads"><img src="/wp-content/uploads/2014/12/rental_cats_Ipad.jpg">
							<span>iPads</span></li>
				 		<li class="rental-cat" title="Mac Laptops"><img src="/wp-content/uploads/2014/12/rental_cats_macbook.jpg">
				 		<span>Mac Laptops</span></li>
				 		<li class="rental-cat" title="Mac Desktops"><img src="/wp-content/uploads/2014/12/rental_cats_mac_desktop.jpg">
				 		<span>Mac Desktops</span></li>
				 		<li class="rental-cat" title="Video Post-Production Equipment"><img src="/wp-content/uploads/2014/12/rental_cats_video_post.jpg"><span>Video Post-Production</span></li>
				 		<li class="rental-cat" title="Other"><img src="/wp-content/uploads/2014/12/rental_cats_other.jpg"><span>Other</span></li>
				 	</ul>
				 	 
				 	
				 </div>
				
				<form action="http://go.t2computing.com/l/72052/2016-12-13/4n1nb9" method="post" class="wpcf7-form" id="rental-request"  novalidate>
				<div role="form"  id="rental-form" lang="en-US" dir="ltr">
  <div class="screen-reader-response">
  </div>

<div id="rental-contact" class="rental-form" >
<?php
		// this is the form, editable in the content field on the rentals page.
					print wpautop($post->post_content);

?></div>
<!--
	<div id="rental-products" class="rental-form">
		<h3>Products For Rent</h3>
		<div id="rental-selections">Please select the products you wish to rent.</div>
		<div id="accordion">
			<?php
				// this is function which shows the accordion list pulled form the rental product content type. When selections are made, it pushes the compiled list into the HIDDEN rental_products variable in the form wich then pushes it into the field in Pardot. 
			
				//print display_rental_products();

			?>
		</div>
	</div>
-->
<div>
	  <label>Please enter the the following text in the box below*<br><img src="<?=$captcha_path?><?=$img?>"><br><span class="wpcf7-form-control-wrap"><input type="text" name="captcha" id="captcha"></span></label>
	
	
	
</div>			
    <input type="submit" value="Submit" class="wpcf7-form-control submit" />
</div>
</form>
<div style="display:none" id="thank-you">Thank for your submission, an account representative will follow up with you shortly.
</div>

			</div>
<script>
		var selected_products = {};    
		var rental_category = '';
	
		function validateEmail(email) {

			var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
			
			var filtertest =  filter.test(email);

			return filtertest;
		}
		function validateCaptcha(){
			
			if(jQuery('#captcha').val() == '<?=$word?>'){
				
				return true;
			} else {
				
				return false;
			}
		}

	
		function validateRentalForm(){
					
				 var valid =validateCaptcha();
				 console.log(valid);
			
					if (valid && jQuery('#rental_category').val() == '') {
						jQuery(".select-cat").css("border","1px solid #f00");
						
						 valid = false;
					}
					
					
					if (valid && jQuery('#first_name').val() == '') {
						jQuery(".first_name input").css("border","1px solid #f00");
						valid = false;
					} else {
						
					}
					
					
					
					if (valid && jQuery('#last_name').val() == '') {
						jQuery(".last_name input").css("border","1px solid #f00");
						valid = false;
					}
					var email_valid = validateEmail(jQuery('#email').val());
					if (valid === false || email_valid === false) {
					//if (valid && jQuery('#email').val() == '') {
						jQuery("#email input").css("border","1px solid #f00");
						
						 valid = false;
					} 
					if (valid && jQuery('#company').val() == '') {
						jQuery(".company input").css("border","1px solid #f00");
						
						 valid = false;
					}
					
					if (valid && jQuery('#title').val() == '') {
						jQuery(".company input").css("border","1px solid #f00");
						
						 valid = false;
					}
					
					if (valid && jQuery('#phone').val() == '') {
						jQuery(".company input").css("border","1px solid #f00");
						
						 valid = false;
					}
					
					
					return valid;	
				}
	
	
	
	
	
	/*
	function changeQuantity(item){
		// updates quanities without refreshing. removes items and groups when set to zero.
		
		var group = jQuery(item).parent().parent().attr('id');
		var id = jQuery(item).next().attr('id');
	console.log("spg",selected_products[group].items.length,selected_products[group].items);
				for(var i = 0; i<selected_products[group].items.length; i++){

					
				
					if(id == selected_products[group].items[i].id){
						selected_products[group].items[i].quan = item.val();
						
						
						//console.log("UpdateQuantity",item.val());
					//	console.log("selected_products",selected_products);
					}
								
					if(item.val() == 0){ // quanity set to zero
						
						
						for(var i = 0; i<selected_products[group].items.length; i++){
				
					
				
							if(id == selected_products[group].items[i].id){
							
								jQuery(item).val(1); //set form element quatity back to zero. 
								
								selected_products[group].items.splice(i,1);//remove from array of selected products
								
								jQuery('#'+id).prop('checked',false);//uncheck the box
								
								jQuery(item).css('visibility','hidden');//hide quantity 
								
								//console.log("Removed selected_products",selected_products);
							}


						} // for items
						
						if(selected_products[group].items.length == 0){
							delete selected_products[group];
							updateSelectionList();
							//console.log("Removed group"+group,selected_products);
						}
						
						
						
						
						
						
						
						
					}// quan = 0;
				
			
				}// for group items
		
		
	}
	function updateSelectionList(){
		// rewrites selecitons, above the rental product form
		
		
		var selected_list = '<h4>Selected Products</h4>';
		for(var p in selected_products){
			//console.log('updated selection',p);
			selected_list += '<h5>'+selected_products[p].title+'</h5>'; 
		    selected_list += '<ul>';
			for(i=0; i<selected_products[p].items.length;i++){
				selected_list += '<li>('+selected_products[p].items[i].quan+') '+selected_products[p].items[i].name+'</li>'; 
			
			}
			
			
			selected_list += '</ul>';
			
		}
		
		if(jQuery.isEmptyObject(selected_products)){ //removes empty list, resets
			selected_list = 'Please select the products you wish to rent.';
		}
		
		jQuery('#rental-selections').html(selected_list);
		jQuery('#rental_products').val(selected_list);
		
		
		
		
	}
	
	function rentalList(action,group,id,quan){
		// mananges adding and removing items and groups
		
		
		var group_exists = selected_products[group];
		//console.log("exists",group_exists);
		if(group_exists == undefined){
			var group_title = jQuery("#"+group).attr('title');
			//console.log("group title",group_title);

			selected_products[group] = {'title':group_title,'items':[]};
		}
		var item_name = selected_products[group].items.name = jQuery('#'+id).parent().attr('title');
	
	    if(action == 'add'){
			
			selected_products[group].items.push({'id':id,'name':item_name,'quan':quan});
		} else if (action == 'remove'){
			
			for(var i = 0; i<selected_products[group].items.length; i++){
				//console.log(i,id, selected_products[group].items[i].id);
					
				
					if(id == selected_products[group].items[i].id){
						//console.log(i,id,'matched');
						
						selected_products[group].items.splice(i,1);
						//console.log("Removed selected_products",selected_products);
					}
				
			
			}
			
			if(selected_products[group].items.length == 0){
							delete selected_products[group];
							updateSelectionList();
						//	console.log("Removed group"+group,selected_products);
						}
			
			updateSelectionList();
			
			//var result = jQuery.grep(selected_products[group].items, function(e){ return e.id == id; console.log("element", result);});
			//	console.log("Result",result);
			
		}
		
		
		
		
		
		
	}
	
	
	function selectRentalItem(group,product){
		// manages checkbox states | group = top level, product is "this" 
		
		//var isChecked = jQuery("#"+product.id+" check").prop('checked');
		//console.log("title",product.parent().title);
		//console.log("id",product.id);
		//console.log("group",group);
		//console.log(jQuery(product).siblings('.quan').val());
		//var products_in_group = 
		var quan = jQuery(product).siblings('.quan');
		//console.log("checked",isChecked);
		var action = 'add';
		jQuery("#"+product.id).prop('checked', function(){
			var isChecked = this.checked;
			//console.log("checked",isChecked);
			//console.log("this",!this);
			if(isChecked){
				jQuery(jQuery(quan)).css("visibility","visible");
				action = 'add';
			} else {
				jQuery(jQuery(quan)).css("visibility","hidden");
				action = 'remove';
			}
			
			
			//return !this.checked;
		 });
		rentalList(action,group,product.id,quan.val());
		updateSelectionList();
	}
	
	
	jQuery('.check').on('click', function(e) {
		var group = jQuery(this).parent().parent().attr('id');
		selectRentalItem(group,this);
	});
	*/
	jQuery('#rental-request').on('submit', function(e) {
        e.preventDefault();
		var form_is_valid = validateRentalForm();
		
		if (form_is_valid === true){
			jQuery.ajax({
				url : jQuery(this).attr('action'),
				type: "POST",
				data: jQuery(this).serialize(),
				success: function (data) {
					console.log(data);
					//  console.log(jQuery("#form_output").html(data));
				},
				error: function (jXHR, textStatus, errorThrown) {
					//console.log(errorThrown);
				}
			});
		
			displayThankYouMessage();
			
		
			
			
			//console.log('succeed');	
		} else {
			console.log('fail');	
		}
    });
	<?php
	
	?>
	
	function displayThankYouMessage(){
	
	
	
		window.location.hash = "#thanks";
		jQuery('#thank-you').css("display","block");
		jQuery('#rental-form-info').css("display","none");
		jQuery('#rentals-header').css("display","none");
		
		jQuery( '#rental-form' ).fadeOut( 500, function() {
		 
	  });
	
}
	function setCategoryMenu(obj){
		jQuery('.rental-cat').each(function(){
			//console.log(jQuery(this).css("border"));
			jQuery(this).css("border","2px solid #fff");
		});
		jQuery(obj).css("border","2px solid #999");
		
	}
	
	jQuery( document ).ready(function() {
		jQuery('.quan').on("change keyup",function(){
			// updates the quantity and list when a quantity is changed.
			changeQuantity(jQuery(this));
			updateSelectionList();
		});
		
		jQuery('.rental-cat').on("click",function(){
			var title = jQuery(this).attr("title").split(' ').join('_');
		    title = title.replace('-',"_");
			setCategoryMenu(jQuery(this));
			jQuery("#rental_category").val(title);
			
			jQuery("#rentals-header .select-cat").html("Selected Category: "+title);
			
			//console.log(title);
			
			
			
			
		});
		
		
		
		 jQuery('.quan').keydown(function (e) {//only allows #s in quantity field.
			 
			 
        // Allow: backspace, delete, tab, escape, enter and .
        if (jQuery.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
		
		
		
		jQuery('#rental-request').on('keyup keypress', function(e) {
			// stops the form from automatically submitting on enter. you must press the submit button
		  var keyCode = e.keyCode || e.which;
		  if (keyCode === 13) { 
			e.preventDefault();
			return false;
		  }
		});
		
		
	});
	
</script>
			
			
			
			
				<!-- Content sections 
					================================================== -->
	<!-- End content sections -->
<?php get_footer();
								?>