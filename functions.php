<?php
//allow vCard uploads in media manager
add_filter('upload_mimes','add_custom_mime_types');
function add_custom_mime_types($mimes){
	return array_merge($mimes,array (
		'vcf' => 'text/vcard',
		)
	);
}
function register_menu() {
  register_nav_menu('tekserve-menu',__( 'Tekserve Menu' ));
}
add_action( 'init', 'register_menu' );
function enqueue_accordion() {
    
    wp_enqueue_script( 'jquery-ui-accordion' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_accordion' );

if(defined('PICTUREFILL_WP_VERSION') && '2' === substr(PICTUREFILL_WP_VERSION, 0, 1)) {
	
	function register_vertikal_srcsets(){
	  picturefill_wp_register_srcset('full-bg', array('medium', 'large', 'hd-background', 'full'), 'full');
	}

	add_filter('picturefill_wp_register_srcset', 'register_vertikal_srcsets');
	
}
function get_partner_product_links(){
	
	return "partner products";
}
function theme_name_scripts() {
    if (is_page('21')) {
        wp_enqueue_script('myscript', get_stylesheet_directory_uri().
            '/js/script.js', array(), '1.0.0', true);
    }

}
add_action('wp_enqueue_scripts', 'theme_name_scripts');

function get_partner_categories(){
	
	$partners = get_partners();
	$partner_categories = array();
	$partner_categories["all"] = array();
	
	foreach($partners as $key => $partner){
		extract( $partner);
	
		 $categories = get_the_category( $id);
		 $partner['partnership_level'] = get_post_meta($id,"partnership_level",true);
		
	
		foreach ( $categories  as $key => $value ) {
			
			$value = (array) $value;
		   extract($value);
		 	 
			 if(!array_key_exists($slug,$partner_categories)){
			 	$partner_categories[$slug]  = array();
			 }
			 $partnership_level=
			array_push($partner_categories[$slug],$partner);
			
			
		}
		
		
	}
	
	return $partner_categories;
	
	
	
}
function getThumbnail($id,$use="full"){
		global $post;
		
		
		$img = wp_get_attachment_image_src( get_post_thumbnail_id( $id), $use);
		if($img[0] !=""){
    		 return $img[0];
		} 
}
function display_partner_links($partners){
	
		ob_start();
		print '<ul class="partner-category">';
	
	
		foreach($partners as $key => $value){
			extract((array) $value);
				
			$partner_url = get_post_meta($id,"partner_url",true);
				print "<li class='partner'><a href=\"$partner_url\" target=\"_blank\">
				<img src=\"$src\" title\"$title\"></a>
				<span class=\"partnership-level\">$partnership_level</span>
				</li>
				
				";
		}
		print "<ul>";
	
	return ob_get_clean();
}
function display_partner_categories($partners){
	
		ob_start();
		print '<ul class="partner-category">';
	
		foreach($partners as $key => $value){
			
			extract((array) $value);
			
				print "<li class='partner'><a href=\"$link\" $target>
				<img src=\"$src\" title\"$title\"></a>
				<span class=\"partnership-level\">$partnership_level</span>
				</li>
				";
		}
		print "<ul>";
	
	return ob_get_clean();
}


function get_partners($use="thumbnail"){
	$args = array(
      'post_type' => 'partner',
      "category" => 'PARTNERS',
      'post_status' => 'publish',
	  'orderby' => 'post_title',
	  'order' => 'ASC',
	  'fields' => ids,
	   'numberposts'=>-1
    );
	
	$partners = get_posts($args);
	$data = array();
	foreach($partners as $key => $value){
		$title = get_the_title($value);
		
		$img = wp_get_attachment_image_src( get_post_thumbnail_id($value), $use);
		$src = $img[0];
		$link = get_permalink($value);
		$target = '';
		$external_link = get_post_meta($id,"external_url",true);;
		if($external_url != ''){
			$link = $external_link;
			$target = ' target="_blank"';
		}
				
		array_push($data,array("id"=>$value,"title"=>$title,"src" => $src, "link"=>$link));	
			
	}
	return $data;
	
	
}
function display_partners($cols,$use="thumbnail"){
	$padding = $cols-1;
	$width = intval((100-($cols+1))/$cols);
	
	
	$partners = get_partners($use);
	ob_start();
		print "<ul style='padding-left:1%'>";
		foreach($partners as $key => $value){
			extract($value);
				print "<li class='partner' style='margin-right:1%;width:$width%;padding-bottom:$width%;' title='$title'><a href=\"$link\">
				<img src=\"$src\" title\"$title\"></a></li>
				";
		}
		print "<ul>";
	return ob_get_clean();
}

function get_partner_media($slug){
	$attachments = array();
	$attachments['videos'] = array();
	ob_start();
	 $args = array(
      'post_type' => 'video',
      "category_media" => $slug,
      'post_status' => 'publish',
	  'orderby' => 'menu_order',
	  'order' => 'ASC'
    );
	
	$videos = get_posts($args);
	foreach ($videos as $key =>  $value){

		
		extract( (array) $value);
		$post_fields = array();
		$post_fields['ID'] = $ID;
		$post_fields['post_title'] = $post_title;
		$post_fields['post_content'] = $post_content;
		$post_fields['video_url'] = get_post_meta($ID,"video_url",true);
		
		$img = wp_get_attachment_image_src( get_post_thumbnail_id( $ID), "thumb");
		$post_fields['src'] = $img[0];
		array_push($attachments['videos'],$post_fields);
	}
	
	
	
	
	 $ids = mcm_get_attachment_ids(array("category"=>"$slug"));
	 //var_dump($ids);
	$attachments['case_studies'] = array();
	$attachments['white_papers'] = array();
	$attachments['brochures'] = array();
	$upload_dir = wp_upload_dir();
	//var_dump($upload_dir);
	$upload_path = $upload_dir['baseurl'];
	foreach(explode(",",$ids) as $key=>$value){ 
		$post_fields = array();
		$this_post = get_post($value,ARRAY_A);
		$post_fields['ID'] = $value;
		$post_fields['post_title'] = $this_post['post_title'];
		$post_fields['post_excerpt'] = $this_post['post_excerpt'];
		$post_fields['post_mime_type'] = $this_post['post_mime_type'];
		$post_fields['url'] = $upload_path . "/". get_post_meta($value,"_wp_attached_file",true);
		
		if(has_term( "case-study", "category_media", $value )){
			array_push($attachments['case_studies'],$post_fields);
			
		} else if (has_term( "white-paper", "category_media", $value )) {
			array_push($attachments['white_papers'],$post_fields);
		} else if (has_term( "brochure", "category_media", $value )) {
			array_push($attachments['brochures'],$post_fields);
		}
		
	
	}
	 
	return $attachments;
}
function display_attachment_list($attachments){
	
	
	ob_start();
		print "<ul>";
		foreach($attachments as $key => $value){
			extract($value);
			if($post_mime_type == 'application/pdf'){
				$class = "pdf";
			}
			$title_clean = str_replace('"','',$post_title);
			
			print "<li class=\"pdf\">
				 	<a class=\"iframe\" href=\"$url\" title=\"$title_clean\">$post_title</a><br>
					<span>$post_excerpt</span>
			</li>";	
			
		}
	
	
		print "</ul>";	
	return ob_get_clean();
	
}
function display_videos($videos){
		ob_start();
	$default_video = $videos[0]['video_url'];
	$default_video_title = $videos[0]['post_title'];
	
	?>
	<div id="videos">
			<div id="video-player">
			
				<iframe src="<?=$default_video?>?rel=0&fs=1" scrolling="no" frameborder="0" id="video"  allowfullscreen></iframe>
			</div>
		<p id="video-title-display"><?=$default_video_title?></p>
			<ul id="video-playlist">
		<?php
		foreach($videos as $key => $value){
			extract($value);
				$title_clean = str_replace('"','',$post_title);
				$title_clean = str_replace("'","\'",$title_clean);
				
			?>
              <li><a href="#" onMouseover="displayTitle('Watch: <?=$title_clean?>');" onMouseOut="" onClick="play('<?=$video_url?>?rel=0', '<?=$title_clean ?>'); return false;" title="<?=$title_clean ?>"><img src="<?=$src?>" alt="<?=$title_clean?>"></a><span class="video-label"><?=$post_title?></span></li>
		<?php
		}
		?>
		</ul>
	</div>
	<?php
	
	return ob_get_clean();	
}
if ( function_exists('register_sidebars') ){
    register_sidebar( array(
        'name' => __( 'Partners Menu', 'theme-slug' ),
        'id' => 'partners-menu',
        'description' => __( '', 'theme-slug' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
}
function partners_menu() {
}

add_filter('wpcf7_form_action_url', 'wpcf7_custom_form_action_url');
function wpcf7_custom_form_action_url($url)
{
    global $post;
    $id_to_change = 7703;
    if($post->ID === $id_to_change)
        return 'https://go.pardot.com/l/72052/2016-08-04/3zq4mf';
    else
        return $url;
		
}

/*
	Events
	
*/

function get_events(){
	global $wpdb;
	$sql = "select ID, post_title, post_content, post_excerpt, post_date from wp_posts where post_type = 'event' and (post_status = 'publish' or post_status = 'future') order by post_date"; 
	$events = $wpdb->get_results ($sql);

	$date_now = date("Y-m-d");
	$data = array('coming_events'=>array(),'past_events'=>array());
	foreach($events as $key => $value){
		extract((array) $value);
		$img = wp_get_attachment_image_src( get_post_thumbnail_id($ID), $use);
		
		$link = get_permalink($ID);
		$this_date =	 date("Y-m-d", strtotime($post_date));
		
		$this_event = array(
			'id' => $ID,
			'title' => $post_title,
			'content' => $post_content,
			'excerpt' => $post_excerpt,
			'date' => $post_date,
			'link' => $link,
			'event_type'=>get_post_meta($ID,"event_type",true),
			'event_url'=>get_post_meta($ID,"event_url",true),
			'event_date_span'=>get_post_meta($ID,"event_date_span",true),
			'event_time_span'=>get_post_meta($ID,"event_time_span",true),
			'event_address'=>get_post_meta($ID,"event_address",true),
			'img' => getThumbnail($ID)
			
			
			
		);
		
		if ($date_now < $this_date) {	
			array_push($data['coming_events'], $this_event);
		} else {
			array_push($data['past_events'], $this_event);
		}

				
					
			
	}
	
	
	return $data;
	
	
}
function get_event($event){
	extract($event);
	ob_start();
	
	
	
	$this_target = ''; // default target to none;
	if($event_url == 'self') { 
		$this_url = get_permalink($id);//don't show a date
	} else if($event_url == ''){ 
		$this_url = ''; // show specified date 
	} else {
		$this_url = $event_url;
		$this_target = ' target="_blank"'; // if external url, target new window.
	} // show date stamp specified on post
	
	
	
	//($event_date_span != '') ? $this_date = $event_date_span : $this_date = date("l, F j, Y", strtotime($date)); //date
	//date
	if($event_date_span == 'null') { $this_date = '';//don't show a date
	} else if($event_date_span != ''){ $this_date = $event_date_span; // show specified date 
	} else {$this_date = date("l, F j, Y", strtotime($date));} // show date stamp specified on post
	
	//time
	if($event_time_span == 'null') { $this_time = '';//don't show a time
	} else if($event_time_span != ''){ $this_time = $event_time_span; // show specified time 
	} else {$this_time = date("g:i a", strtotime($date));} // show time stamp specified on post
	
	
	?>
	 <div class="event">
     <div class="event-type"><?=strtoupper($event_type)?></div>
     <div class="event-thumb">
	 <?php
	
	if($img != ""){
		if($this_url != ""){
			
     ?><a href="<?=$this_url?>" <?=$this_target?> title="<?=$title?>"><?php } ?><img src="<?=$img?>" alt="<?=$title?>"><?php
		if($img != ""){
     ?></a><?php } else {?><img src="<?=$img?>" alt="<?=$title?>"><?php } 
	}
?>	</div>
    <div class="event-listing">
    <?php
    if($this_url != ""){
     ?><a class="event-title" href="<?=$this_url?>" <?=$this_target?>><?=$title?></a><?php
	} else {?><span class="event-title" title="<?=$title?>"><?=$title?></span><?php } ?>
    
    <?=showField($this_date,'strong')?>
    <?=showField($this_time,'h5')?>
    <?=showField($event_address,'h5')?>
   <?=showField($excerpt)?>
    </div>
</div>
        
<?php
	return ob_get_clean();
}
function showField($field,$wrap=''){
    $result = '';
	
	if($field != ''){
		if($wrap!= ''){
			$result .= "<$wrap>";
			$result .= $field;
		} else {
			$result .= wpautop($field);
		}
		
		if($wrap!= ''){
			$result .= "</$wrap>";
		}
		
	}
	return $result;
	
}
function cptui_register_my_cpts_rental_product() {

	/**
	 * Post Type: Rental Products.
	 */

	$labels = array(
		"name" => __( 'Rental Products', 'vertikal_t2' ),
		"singular_name" => __( 'Rental Product', 'vertikal_t2' ),
		"add_new" => __( 'Add New Rental Product', 'vertikal_t2' ),
	);

	$args = array(
		"label" => __( 'Rental Products', 'vertikal_t2' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => array( "slug" => "rental_product", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail", "custom-fields", "page-attributes" ),
		"taxonomies" => array( "category", "post_tag", "category_media" ),
	);

	register_post_type( "rental_product", $args );
}

add_action( 'init', 'cptui_register_my_cpts_rental_product' );

function get_rental_products(){
	global $wpdb;
	$sql = "select ID, post_title, post_content, post_excerpt, post_parent from wp_posts where post_type = 'rental_product' and post_status = 'publish' and post_parent = 0 order by menu_order"; 
	$product_groups = $wpdb->get_results ($sql);
	ob_start();
	foreach($product_groups as $group_key=>$group_value){
		$sql = "select ID, post_title, post_content, post_excerpt, post_parent, post_name from wp_posts where post_type = 'rental_product' and post_status = 'publish' and post_parent = $group_value->ID order by menu_order";
		
		$products = $wpdb->get_results ($sql);
		 
		print "<h3>$group_value->post_title</h3>";
		print "<div id='rg".$group_value->ID."' title='".$group_value->post_title."'>";
		//print count($products);
			if(count($products) > 0){
				foreach($products as $key=>$value){
					extract ((array) $value);
					$ids = mcm_get_attachment_ids(array("category"=>"$post_name"));
					print "<div class='rental-item' title='".$post_title."'>";
					print '<input type="text size="1" value="1" class="quan" title="Change Quanity for '.$post_title.'"><input type="checkbox" id="rp'.$ID.'" class="check">';
						print "<span>$post_title</span></div>";
				}
			} else{
				print "<div class='rental-item' title='".$group_value->post_title."'>";
					print '<input type="text size="1" value="1" class="quan"><input type="checkbox" id="rp'.$group_value->ID.'" class="check">';
					
				print wpautop($group_value->post_content);
					print "</div>";
			}
			
		print "</div>";
		
		
	}
	
	
	
	return ob_get_clean();
	
}

function display_rental_products(){
	$product_list = get_rental_products();
	return $product_list;
}



function display_events(){
	
	
	
	
	$data = get_events();
	ob_start();
	
	if(count($data['coming_events']) > 0){
	
	?>
    
	<div class="event-group" id="coming-events">
    	<h3>Upcoming Events</h3>
        
		<?php 
			foreach($data['coming_events'] as $key => $event){
				print get_event($event);
			}
		?>
        
    </div>
	<?php
	} //count of upcoming events > 0
	?>
    
    <div class="event-group" id="past-events">
        <h3>All Events</h3>
		
   		<?php 
			foreach(array_reverse($data['past_events']) as $key => $event){
				print get_event($event);
			}
		?>
        
        
    </div>
	
    
	<?php
	
	return ob_get_clean();
}
function portals_menu(){
	ob_start();
	?><div class="dropdown">
   	<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Customer Portals
    <span class="caret"></span></button>
	 <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
      <li role="presentation"><a role="menuitem" tabindex="-1" href="http://invoiceviewer.t2computing.com" target="_blank">Invoices</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="http://corporateservice.t2computing.com" target="_blank">Repairs</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="https://t2computing.cmcengage.com/" target="_blank">Web Shop</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="https://shopapple.t2computing.com" target="_blank">Shop Apple</a></li>

</div>

<script>
    jQuery(function(){
      // bind change event to select
      jQuery('.portals-menu').on('change', function () {
		  console.log("relocate to",jQuery(this).val());
          var url = jQuery(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>
	
	
	
	<?php
	
	return ob_get_clean();
	
}