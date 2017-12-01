<?php

function modulePopup($id) {

	$title = get_field('title',$id);
	$form = get_field('form',$id);
	if ( $title != '' ) $title = '<div class="title">'. $title .'<div class="bg3"></div></div>';
	$form = ( floor($form) > 0 ) ? do_shortcode('[gravityform id='. $form .' ajax=true title=false description=false]') : '';

	return '<div class="mdls popup popup-'. $id .' bg4">
		<div class="container m-body">
			<div class="p-arrow">
				<span class="times">'. _svg('arrow-l') .'</span>
			</div>
			'. $title .'
			<div class="mod-content">'. get_field('content',$id) .'</div>
			'. $form .'
		</div>
		<span class="times">'. _svg('close') .'</span>
    </div>';

}