<?php
# Template Name: Impact Hub Main Actions Module
# Template Post Type: modules

function moduleActions($id) {

	$pal = ( palette ) ? 2 : 3;

	$title = get_field('title',$id);
	$we = '';

	if ( $title != '' ) $title = '<div class="title">'. $title .'<div class="bg'.$pal.'"></div></div>';

	foreach ( get_field('blocks',$id) as $key ) {
		$btn = '<a href="'. $key['link'] .'"><button class="ih-btn btn'.$pal.'">'. $key['button'] .'</button></a>';
		if ( $key['button'] == '' or $key['link'] == '' ) $btn = '';

		$we .= '<div class="item">
			<div class="icon">'. _svg($key['icon'],true) .'</div>
			<div class="name">'. $key['name'] .'</div>
            '. $btn .'
        </div>';
	}

	return '<div class="mdls area-actions bg6">
		<div class="container">
			'. $title .'<div class="mod-content">'. get_field('content',$id) .'</div>
	        <div class="slider-'. $id .' owl-carousel">'. $we .'</div>
    	</div>
    </div>
    <script>
        jQuery(document).ready(function(){
            var count'.$id.' = jQuery(".slider-'. $id .' .item").length;
            var items'.$id.' = ( count'.$id.' > 4 ) ? 4 : count'.$id.';
            jQuery(".slider-'. $id .'").owlCarousel({
            	nav: true,
            	navText: [ "", "" ],
                loop: true,
                mouseDrag: false,
                pullDrag: false,
                responsive: {
			        0:{ items:1 },
			        800:{ items: items'.$id.' }
			    }
            });
        });
    </script>
    ';

}