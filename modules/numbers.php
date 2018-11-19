<?php
# Template Name: Global Impact Hub Numbers Module
# Template Post Type: modules

function moduleNumbers($id) {

	$pal = ( palette ) ? 1 : 3;

	$data = [
		'members' => jsonMembers,
		'locations' => jsonLocations,
		'makers' => jsonMakers

	];

	$title = get_field('title',$id);
	$want = '';

	if ( $title != '' ) $title = '<div class="title">'. $title .'<div class="bg4"></div></div>';

	foreach ( get_field('blocks',$id) as $key ) {
		$j = strtolower($key['json']);
		$val = ( isset($data[$j]) and $data[$j] != '' ) ? $data[$j] : $key['title'];
		$want .= '<div class="item">
			<div class="v-mid" style="background-image:url('. $key['image'] .')">
				<div class="vc-mid">
					<div class="val">'. $val .'</div>
					<div class="key">'. $key['subtitle'] .'</div>
				</div>			
			</div>
        </div>';
	}

	return '<div class="mdls area-numbers bg'.$pal.'">
		<div class="container">
			'. $title .'<div class="mod-content">'. get_field('content',$id) .'</div>
	        <div class="slider-'. $id .' owl-carousel">'. $want .'</div>
    	</div>
    </div>
    <script>
        jQuery(document).ready(function(){
            jQuery(".slider-'. $id .'").owlCarousel({
            	nav: true,
            	navText: [ "", "" ],
                loop: true,
                mouseDrag: false,
                pullDrag: false,
                responsive: {
			        0:{ items:1 },
			        800:{ items: 4 }
			    }
            });
        });
    </script>
    ';

}