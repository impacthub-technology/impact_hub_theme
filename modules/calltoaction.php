<?php
# Template Name: Call-to-Action Module
# Template Post Type: modules

function moduleCallToAction($id) {

	$pal = ( palette ) ? 1 : 3;

	$btn = '<br><a href="'. get_field('button_link',$id) .'"><button class="ih-btn btn'.$pal.'">'. get_field('button_text',$id) . arrowR .'</button></a>';
	if ( get_field('button_link',$id) == '' or get_field('button_text',$id) == '' ) $btn = '';

	$title = ( get_field('title',$id) != '' ) ? '<div class="title">'. get_field('title',$id) .'<div class="bg'.$pal.'"></div></div>' : '';
	$img = ( get_field('image',$id) != '' ) ? '<p><img src="'. get_field('image',$id) .'" alt=""></p><br>' : '';

	return '<div class="mdls area-book bg6">
		<div class="container">
			'. $img . $title .'<div class="mod-content">'. get_field('content',$id) .'</div>'. $btn .'
    	</div>
    </div>';
}