<?php
add_action('wp_ajax_stories', 'ajaxStory');
add_action('wp_ajax_nopriv_stories', 'ajaxStory');
function ajaxStory () {

	$pal = ( palette ) ? 1 : 2;

	$order = ( $_POST['order'] == 'ASC' ) ? 'ASC' : 'DESC';
	$stories = '';

	$agrs = [ 'numberposts' => 2, 'orderby' => 'date', 'order' => $order, 'offset' => (int)$_POST['num'] ];
	if ( (int)$_POST['cat'] > 0 ) $agrs['category'] = (int)$_POST['cat'];

	$posts = get_posts( $agrs );

	foreach ( $posts as $key ) {
		$stories .= '<div class="col-md-6">
			<div class="img" style="background-image:url('. get_the_post_thumbnail_url($key->ID,'full') .')"></div>
			<div class="data">
				<div class="name">'. $key->post_title .'<div class="bg1"></div></div>			
				'. $key->post_excerpt .'		
				<div class="meta bgc'.$pal.'">'. get_the_date( 'd/m/Y', $key ) .' - '. get_the_author_meta('display_name',$key->post_author) .'</div>	
				<a href="'. get_permalink($key->ID) .'"><button class="ih-btn btn'.$pal.'">view'. arrowR .'</button></a>		
			</div>
        </div>';
	}
	die($stories);
}


add_action('wp_ajax_events', 'ajaxEvent');
add_action('wp_ajax_nopriv_events', 'ajaxEvent');
function ajaxEvent () {

	$pal = ( palette ) ? [1,2] : [3,4];

	$events = '';
	$agrs = [
		'post_type' => 'tribe_events',
		'numberposts' => 2,
		'orderby' => 'meta_value',
		'meta_key' => '_EventStartDate',
		'order' => 'ASC',
		'offset' => (int)$_POST['num'],
		'meta_query' => array(
			array(
				'key' => '_EventStartDate',
				'value' => $_POST['from'],
				'compare' => '>',
				'type' => 'DATETIME'
			)
		)
	];

	$posts = get_posts( $agrs );

	foreach ( $posts as $key ) {

		$date = getDateSF( get_post_meta($key->ID,'_EventStartDate',true), get_post_meta($key->ID,'_EventEndDate',true) );

		$events .= '<div class="col-md-6">
				<div class="v-mid">
					<div class="vc-mid">
						<div class="data">
							<div class="name">'. $key->post_title .'<div class="bg'.$pal[0].'"></div></div>			
							'. $key->post_excerpt .'		
							<div class="meta bgc'.$pal[0].'">'. $date .'</div>
							<a href="'. get_permalink($key->ID) .'"><button class="ih-btn btn'.$pal[1].'">view'. arrowR .'</button></a>		
						</div>
					</div>
					<div class="vc-mid img" style="background-image:url('. get_the_post_thumbnail_url($key->ID,'large') .')"></div>
				</div>
			</div>';
	}

	die($events);
}