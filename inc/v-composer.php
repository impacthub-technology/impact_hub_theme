<?php

foreach ( scandir( THEME_DIR . '/modules') as $key ) {
	if ( strlen($key) > 2 and is_readable(THEME_DIR . '/modules/' . $key) ) add_shortcode( 'vc_module_'. substr($key,0,-4), 'vc_module_sc' );
}
add_shortcode( 'theme_button', 'vc_theme_button' );
add_shortcode( 'theme_social', 'vc_theme_social' );
add_shortcode( 'theme_underline', 'vc_theme_underline' );

add_action( 'init', function () {

	$titles = [
		'actions' => 'Impact Hub Main Actions Module',
		'calltoaction' => 'Call-to-Action Module',
		'events' => 'Events Module',
		'forms' => 'Newsletter, Contact and Social Media Module',
		'gallery' => 'Gallery Module',
		'membership' => 'Membership Table Module',
		'numbers' => 'Global Impact Hub Numbers Module',
		'slider' => 'Slider Module',
		'stories' => 'Blog Posts Module',
		'team' => 'Team Module'
	];

	$modules = [];
	$posts = get_posts([ 'post_type' => 'modules', 'numberposts' => -1, 'orderby' => 'title', 'order' => 'ASC', 'suppress_filters' => false ]);
	foreach ( $posts as $key ) {
		$tpl = substr( get_post_meta( $key->ID, '_wp_page_template', true ), 8, -4 );
		$modules[strtolower($tpl)][] = $key;
	}

	foreach ( $titles as $key => $val ) {

		if ( $key == 'popup' ) continue;

		$dd = [ 'Select Module' => '0' ];
		if ( isset($modules[$key]) and count($modules[$key]) > 0 ) {
			foreach ( $modules[ $key ] as $mod ) {
				$dd[ '[' . $mod->ID . '] ' . $mod->post_title ] = $mod->ID;
			}
		}

		vc_map(
			array(
				'name' => $titles[$key],
				'base' => 'vc_module_'. $key,
				'category' => 'Impact Hub Modules',
				'icon' => THEME_URL.'/img/favicon.png',
				'params' => [ [
					'param_name' => 'id',
					'type' => 'dropdown',
					'value' => $dd
				] ]
			)
		);

	}

	vc_map(
		array(
			'name' => 'Theme Button',
			'base' => 'theme_button',
			'category' => 'Impact Hub Modules',
			'icon' => THEME_URL.'/img/favicon.png',
			'params' => [
				[
					'param_name' => 'color',
					'type' => 'dropdown',
					'value' => [ 'Select Color' => '', 'Color 1' => 'btn1', 'Color 2' => 'btn2', 'Color 3' => 'btn3', 'Color Gray' => 'btn4' ]
				],
				[
					'param_name' => 'arrow',
					'type' => 'dropdown',
					'value' => [ 'Without Arrow' => 'no', 'With Arrow' => 'yes' ]
				],
				[
					'param_name' => 'link',
					'heading' => 'Link',
					'type' => 'vc_link'
				]
			]
		)
	);

	vc_map(
		array(
			'name' => 'Social Button',
			'base' => 'theme_social',
			'icon' => THEME_URL.'/img/favicon.png',
			'category' => 'Impact Hub Modules'
		)
	);

	vc_map(
		array(
			'name' => 'Title with underline',
			'base' => 'theme_underline',
			'category' => 'Impact Hub Modules',
			'icon' => THEME_URL.'/img/favicon.png',
			'params' => [
				[
					'param_name' => 'title',
					'type' => 'textfield',
					'heading' => 'Title'
				],
				[
					'param_name' => 'color',
					'type' => 'dropdown',
					'value' => [ 'Select Color' => '', 'Color 1' => 'bg1', 'Color 2' => 'bg2', 'Color 3' => 'bg3', 'Color Gray' => 'bg4' ]
				]
			]
		)
	);

} );

function vc_module_sc( $atts ) {
	if(!isset($atts['id']) || $atts['id'] == '')
		return "You need to select a module in the administration.";
	return do_shortcode('[module id="'. floor($atts['id']) .'"]');
}

function vc_theme_button( $atts ) {
	$arrow = ( $atts['arrow'] == 'yes' ) ? arrowR : '';
	$link = vc_build_link( $atts['link'] );
	$target = ( $link['target'] == '' ) ? '' : 'target="'. $link['target'] .'"';
	return '<a href="'. $link['url'] .'" '. $target .'><button class="ih-btn '. $atts['color'] .'">'. $link['title'] . $arrow .'</button></a>';
}

function vc_theme_social( $atts ) {
	return getSocial();
}

function vc_theme_underline( $atts ) {
	return '<div class="mdls"><div class="title">'. $atts['title'] .'<div class="'. $atts['color'] .'"></div></div></div>';
}



add_action( 'vc_after_init', function () {
	if( function_exists('vc_remove_element') ){

		#vc_remove_element( "vc_message" );

	}
} );


$colorsHTML = '';
$colors = [ '2FBACB', '3A9B89', '075A61', '3890BF', '093247', '266383', '404043', '812926', 'B1C976', 'CA2C55', 'D95543', 'E95356', 'F0F0F0', 'EDA46C' ];
for ( $i = 0; $i < count($colors); $i++ ) {
	$colorsHTML .= '<span><input id="rc-'.($i+1).'" name="row-colors" type="radio" value="color-'. ($i+1) .'"><label for="rc-'.($i+1).'"></label></span>';
}

$colorsHTML = '<li id="customize-control-color_bg">
	<span></span><span><input id="rc-0" name="row-colors" type="radio" value=""><label for="rc-0"></label></span>
	'. $colorsHTML .'<div class="clear"></div>
</li>';


$colors = [ '2FBACB', '3A9B89', '075A61', '3890BF', '093247', '266383', '404043', '812926', 'B1C976', 'CA2C55', 'D95543', 'E95356', 'F0F0F0', 'EDA46C' ];
$vc_section = array(
	'type' => 'textfield',
	'heading' => "Background",
	'param_name' => 'row-color',
	'description' => $colorsHTML
	#'value' => [ 'Select Color' => '' ]
);
vc_add_param( 'vc_section', $vc_section );
