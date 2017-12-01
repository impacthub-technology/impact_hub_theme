<?php
# Template Name: Newsletter, Contact and Social Media Module
# Template Post Type: modules

function moduleForms($id) {

	$pal = ( palette ) ? [1,1,2,2,2,1] : [3,2,1,3,3,2];
	$palBtn = ( palette ) ? [1,2] : [2,3];

	$col2 = ( get_field('in2col',$id) ) ? '' : 'db';
	$sn_c = get_field('social',$id);
	$f1_c = get_field('form_1',$id);
	$f2_c = get_field('form_2',$id);

	$sn = $f1 = $f2 = '';
	$icon = '<div><i title="Click to open form" class="glyphicon glyphicon-chevron-down"></i></div>';

	if ( $sn_c ) {
		$gf = get_field('content',$id);
		if ( $gf[0]['title'] != '' ) $gf[0]['title'] = '<div class="title">'. $gf[0]['title'] .'<div class="bg'.$pal[0].'"></div></div>';
		$sn = '<div class="af-sn af-row bg6"><div>'. $gf[0]['title'] . $gf[0]['text'] . getSocial() .'</div></div>';
	}

	if ( $f1_c ) {
		$gf = get_field('form_1_content',$id);
		if ( $gf[0]['title'] != '' ) $gf[0]['title'] = '<div class="title">'. $gf[0]['title'] .'<div class="bg'.$pal[1].'"></div></div>';
		$btn = ( $gf[0]['button'] != '' ) ? '<button class="ih-btn btn'.$palBtn[0].'">'. $gf[0]['button'] .'</button>' : '';
		$form = ( floor($gf[0]['form']) > 0 ) ? do_shortcode('[gravityform id='. $gf[0]['form'] .' ajax=true title=false description=false]') : '';
		$f1 = '<div class="af-sn af-row bg'.$pal[3].'"><div><div class="showForm">'. $gf[0]['title'] .'<p>'. $gf[0]['text'] .'</p>'. $btn .'</div>'. $form .'</div></div>';
	}

	if ( $f2_c ) {
		$gf = get_field('form_2_content',$id);
		if ( $gf[0]['title'] != '' ) $gf[0]['title'] = '<div class="title">'. $gf[0]['title'] .'<div class="bg'.$pal[2].'"></div></div>';
		$btn = ( $gf[0]['button'] != '' ) ? '<button class="ih-btn btn'.$palBtn[1].'">'. $gf[0]['button'] .'</button>' : '';
		$form = ( floor($gf[0]['form']) > 0 ) ? do_shortcode('[gravityform id='. $gf[0]['form'] .' ajax=true title=false description=false]') : '';
		$f2 = '<div class="af-sn af-row"><div><div class="showForm">'. $gf[0]['title'] .'<p>'. $gf[0]['text'] .'</p>'. $btn .'</div>'. $form .'</div></div>';
	}

	return '<div class="mdls area-forms bg'.$pal[4].' v-mid '. $col2 .'">
		<div class="vc-mid">'. $sn . $f1 . '</div>
		<div class="vc-mid bg'.$pal[5].'">'. $f2 .'</div>
    </div>';

}