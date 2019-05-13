<?php
add_action('wp_ajax_stories', 'ajaxStory');
add_action('wp_ajax_nopriv_stories', 'ajaxStory');
function ajaxStory () {

	$pal = ( palette ) ? 1 : 2;

	$order = ( $_POST['order'] == 'ASC' ) ? 'ASC' : 'DESC';

	$args = [
		'posts_per_page' => 2,
		'orderby' => 'date',
		'order' => $order,
		'offset' => (int)$_POST['num']
	];

	if ( (int)$_POST['cat'] > 0 )
		$args['category'] = (int)$_POST['cat'];


	$the_query = new WP_Query( $args );
	set_query_var( 'pal', $pal );

	ob_start();
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			get_template_part('templates/post','summary');
		}
	}
	wp_reset_postdata();

	$stories = ob_get_clean();
	$stories .= $_POST['num'];


	die($stories);
}


add_action('wp_ajax_events', 'ajaxEvent');
add_action('wp_ajax_nopriv_events', 'ajaxEvent');
function ajaxEvent () {

	$args = [
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

	$posts = get_posts( $args );

	ob_start();
	foreach ( $posts as $key ) {

		$start = date_create(get_post_meta($key->ID,'_EventStartDate',true));
		$end = date_create(get_post_meta($key->ID,'_EventEndDate',true));

		$event = [
			'label' => '',
			'title' => $key->post_title,
			'desc' => $key->post_excerpt,
			'img' => get_the_post_thumbnail_url($key->ID, 'large'),
			'date' => getDateSF( $start, $end ),
			'link' => get_permalink($key->ID)
		];

		set_query_var('event', $event);

		get_template_part('templates/event-calendar-summary');
	}

	die(ob_get_clean());
}