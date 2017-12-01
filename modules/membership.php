<?php
# Template Name: Membership Table Module
# Template Post Type: modules

function moduleMembership($id) {

	$pal = ( palette ) ? 1 : 3;

	$head = $body = '';

	$title = get_field('title',$id);
	$button = get_field('button_text',$id);
	$headers = get_field('headers_table',$id);
	$values = get_field('values_table',$id);
	$link = get_field('link',$id);
	if ( get_field('button_action',$id) != 'Link' ) $link = '#popup-'. $id;

	$p_title = get_field('popup_title',$id);
	$form = get_field('form',$id);
	if ( $p_title != '' ) $p_title = '<div class="title">'. $p_title .'<div class="bg'.$pal.'"></div></div>';
	$form = ( floor($form) > 0 ) ? do_shortcode('[gravityform id='. $form .' ajax=true title=false description=false]') : '';

	$popup = '<div class="mdls popup popup-'. $id .' bg4">
		<div class="container m-body">
			<div class="p-arrow">
				<span class="times">'. _svg('arrow-l') .'</span>
			</div>
			'. $p_title .'
			<div class="mod-content">'. get_field('popup_content',$id) .'</div>
			'. $form .'
		</div>
		<span class="times">'. _svg('close') .'</span>
    </div>';



	if ( $title != '' ) $title = '<div class="title">'. $title .'<div class="bg4"></div></div>';

	for ( $i = 0; $i < count($headers); $i++ ) $head .= '<div><div class="v-mid"><div class="vc-mid">'. $headers[$i]['title'] .'</div></div></div>';

	for ( $i = 0; $i < count($values); $i++ ) {
		$sub = ( trim($values[$i]['price_sub']) == '' ) ? '' : '<div>'. $values[$i]['price_sub'] .'</div>';
		$body .= '<div class="item">' . '<div class="name">'. $values[$i]['title'] .'<div class="bg4"></div></div>';
		for ( $a = 0; $a < count($values[$i]['values']); $a++ ) $body .= '<div class="v-mid"><div class="vc-mid">'. getMemberVal($values[$i]['values'][$a]) .'</div></div>';
		$body .= '<div class="v-mid price"><div class="vc-mid">'. $values[$i]['price'] . $sub .'</div></div>';
		$body .= '<div class="fbtn"><a href="'. $link .'"><button class="ih-btn btn4">'. $button . arrowR .'</button></a></div>';
		$body .= '</div>';
	}

	$member = '<div class="tHead">'. $head .'</div>' . '<div class="tBody"><div class="owl-carousel">'. $body .'</div></div>';

	return '<div class="mdls area-member bg'.$pal.' items-'. count($values) .'">
		<div class="container">'. $title .'<div class="mod-content">'. get_field('content',$id) .'</div><div class="row">'. $member .'</div></div>
		'. $popup .'
    </div>
    ';

}

function getMemberVal ( $arr ) {
	$a = ( $arr['truefalse'] ) ? 'true' : 'false';
	return ( $arr['type'] == 'Text' ) ? $arr['text'] : '<img src="'. THEME_URL .'/img/member-'. $a .'.svg" alt="">';
}