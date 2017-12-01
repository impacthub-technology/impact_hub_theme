<?php
# Template Name: Gallery Module
# Template Post Type: modules

function moduleGallery($id) {

	$pal = ( palette ) ? ['bgc1',1,3,'bg1'] : ['',2,4,''];

	$title = get_field('title',$id);
	$gallery = [];
	$slider = '';

	if ( $title != '' ) $title = '<div class="title '.$pal[0].'">'. $title .'<div class="bg'.$pal[1].'"></div></div>';

	foreach ( get_field('gallery',$id) as $key ) {

		$gallery[] = $key['image'];

		if ( $key['subtitle'] != '' ) $key['title'] .= ' - <span>'. $key['subtitle'] .'</span>';
		$slider .= '<div class="item">
			<div class="image" style="background-image:url('. $key['image'] .')"></div>
			<div class="name v-mid '.$pal[3].'"><div class="vc-mid">'. $key['title'] .'</span></div></div>
        </div>';

	}

	return '<div class="mdls area-gallery bg'.$pal[2].'">
		<div class="container">
			'. $title .'<div class="mod-content">'. get_field('content',$id) .'</div>
	        <div class="gallery-'. $id .' row">
		        <div class="popup popup-'. $id .'">
	           		<div class="m-body owl-carousel">'. $slider .'</div>
	           		<div class="times">'. file_get_contents( THEME_DIR . '/img/close.svg') .'</div>
	        	</div>
			</div>
	        <button class="addGallery ih-btn" data-gal="'. $id .'">load more</button>
    	</div>
    </div>
   
    <script>
    jQuery(document).ready(function($){
        galArray['.$id.'] = '. json_encode($gallery) .';
        galG_n['.$id.'] = 0;
    	galG_t['.$id.'] = 1;
    	
    	galleryRow('.$id.');
    	galleryImg('.$id.');
    	if ( $(window).width() > 767 ) {
    	 	galleryRow('.$id.');
    	    galleryImg('.$id.');
    	}
    	
    	$(".mdls .popup-'. $id .' .owl-carousel").owlCarousel({
            	nav: true,
            	navText: [ "", "" ],
            	dots: false,
                loop: true,
                items: 1,
                mouseDrag: false,
                pullDrag: false
            });
    });
    </script>
    ';

}