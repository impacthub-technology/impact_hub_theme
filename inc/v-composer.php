<?php

define( '_bg1', get_theme_mod( 'color_bg_1', '#075A61' ) );
define( '_bg2', get_theme_mod( 'color_bg_2', '#3A9B89' ) );
define( '_bg3', get_theme_mod( 'color_bg_3', '#CA2C55' ) );

$rowColor = '<li id="customize-control-color_bg" class="fontColor">
		<span><input id="rowc-1" name="row-text-color" type="radio" value="bgc1"><label for="rowc-1"></label></span>
		<span><input id="rowc-2" name="row-text-color" type="radio" value="bgc2"><label for="rowc-2"></label></span>
		<span><input id="rowc-3" name="row-text-color" type="radio" value="bgc3"><label for="rowc-3"></label></span>
		<span><input id="rowc-4" name="row-text-color" type="radio" value="bgc5"><label for="rowc-4"></label></span>
		<span><input id="rowc-5" name="row-text-color" type="radio" value="bgc4"><label for="rowc-5"></label></span>
	</li>
	<style>
	li[id*="customize-control-color_"].fontColor {display:block;min-height:50px}
	li[id*="customize-control-color_"].fontColor span:nth-child(1) label {background:' . _bg1 . '}
	li[id*="customize-control-color_"].fontColor span:nth-child(2) label {background:' . _bg2 . '}
	li[id*="customize-control-color_"].fontColor span:nth-child(3) label {background:' . _bg3 . '}
	li[id*="customize-control-color_"].fontColor span:nth-child(4) label {background:' . bg5 . '}
	li[id*="customize-control-color_"].fontColor span:nth-child(5) label {background:' . bg4 . '}
	</style>
	';

$lineColor = '<li id="customize-control-color_bg" class="fontColor">
		<span><input id="linec-1" name="line-color" type="radio" value="bg1"><label for="linec-1"></label></span>
		<span><input id="linec-2" name="line-color" type="radio" value="bg2"><label for="linec-2"></label></span>
		<span><input id="linec-3" name="line-color" type="radio" value="bg3"><label for="linec-3"></label></span>
		<span><input id="linec-4" name="line-color" type="radio" value="bg5"><label for="linec-4"></label></span>
		<span><input id="linec-5" name="line-color" type="radio" value="bg4"><label for="linec-5"></label></span>
	</li>
	<style>
	li[id*="customize-control-color_"].fontColor {display:block;min-height:50px}
	li[id*="customize-control-color_"].fontColor span:nth-child(1) label {background:' . _bg1 . '}
	li[id*="customize-control-color_"].fontColor span:nth-child(2) label {background:' . _bg2 . '}
	li[id*="customize-control-color_"].fontColor span:nth-child(3) label {background:' . _bg3 . '}
	li[id*="customize-control-color_"].fontColor span:nth-child(4) label {background:' . bg5 . '}
	li[id*="customize-control-color_"].fontColor span:nth-child(5) label {background:' . bg4 . '}
	</style>
	';

$btnColor = '<li id="customize-control-color_bg" class="btnColor">
		<span><input id="btnc-1" name="btn-color" type="radio" value="btn1"><label for="btnc-1"></label></span>
		<span><input id="btnc-2" name="btn-color" type="radio" value="btn2"><label for="btnc-2"></label></span>
		<span><input id="btnc-3" name="btn-color" type="radio" value="btn3"><label for="btnc-3"></label></span>
		<span><input id="btnc-4" name="btn-color" type="radio" value="btn4"><label for="btnc-4"></label></span>
	</li>
	<style>
	li[id*="customize-control-color_"].btnColor {display:block;min-height:50px}
	li[id*="customize-control-color_"].btnColor span:nth-child(1) label {background:' . _bg1 . '}
	li[id*="customize-control-color_"].btnColor span:nth-child(2) label {background:' . _bg2 . '}
	li[id*="customize-control-color_"].btnColor span:nth-child(3) label {background:' . _bg3 . '}
	li[id*="customize-control-color_"].btnColor span:nth-child(4) label {background:' . bg4 . '}
	</style>
	';


foreach ( scandir( THEME_DIR . '/modules') as $key ) {
	if ( strlen($key) > 2 and is_readable(THEME_DIR . '/modules/' . $key) ) add_shortcode( 'vc_module_'. substr($key,0,-4), 'vc_module_sc' );
}
add_shortcode( 'theme_button', 'vc_theme_button' );
add_shortcode( 'theme_social', 'vc_theme_social' );
add_shortcode( 'theme_underline', 'vc_theme_underline' );

add_action( 'init', function () {

	global $rowColor, $btnColor, $lineColor;

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
					'type' => 'textfield',
					'heading' => "Button Color",
					'description' => $btnColor,
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
			'category' => 'Impact Hub Modules',
			'description' => 'This module has no parameters.'
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
					'type' => 'textfield',
					'heading' => "Text Color",
					'description' => $rowColor
				],
				[
					'param_name' => 'line',
					'type' => 'textfield',
					'heading' => "Line Color",
					'description' => $lineColor
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
	return '<div class="mdls"><div class="title '. $atts['color'] .'">'. $atts['title'] .'<div class="'. $atts['line'] .'"></div></div></div>';
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

$vc_section = array(
	'type' => 'textfield',
	'heading' => "Background",
	'param_name' => 'row-color',
	'description' => $colorsHTML
);
vc_add_param( 'vc_section', $vc_section );


vc_add_param( 'vc_row', array(
	'type'        => 'textfield',
	'heading'     => "Text Color",
	'param_name'  => '_row-text-color',
	'description' => $rowColor
) );
