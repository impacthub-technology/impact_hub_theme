<?php
# Template Name: Slider Module
# Template Post Type: modules

function moduleSlider($id) {

	$pal = ( palette ) ? 3 : 2;

	$opt = get_field('slider_settings',$id);

	$slider = '';
	foreach ( get_field('slides',$id) as $key ) {
	    $btn = '<a href="'. $key['button_link'] .'"><button class="ih-btn btn'.$pal.'">'. $key['button_text'] . arrowR .'</button></a>';
	    if ( $key['button_text'] == '' or $key['button_link'] == '' ) $btn = '';

	    $title = ( $key['title'] != '' ) ? '<div class="title">'. $key['title'] .'</div>' : '';
		$slider .= '<div class="item" style="background-image:url('. $key['image'] .')">
            <div class="container v-mid"><div class="vc-mid">'. $title . $key['content'] . $btn .'</div></div>
        </div>';
    }

    return '
    <div class="area-slider">
        <div class="slider-'. $id .' owl-carousel">'. $slider .'</div>
    </div>
    <script>
        jQuery(document).ready(function(){
            jQuery(".slider-'. $id .'").owlCarousel({
                autoplay: '. ( ( $opt[0]['autoplay'] ) ? "true" : "false" ) .',
                autoplayTimeout: '. $opt[0]['timeout']*1000 .',
                loop: true,
                items: 1,
                mouseDrag: false,
                pullDrag: false
            });
        });
    </script>
    ';

}