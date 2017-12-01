<?php
# Template Name: Global Impact Hub Numbers Module
# Template Post Type: modules

function moduleNumbers($id) {

	$pal = ( palette ) ? 1 : 3;

	$data = [];
	$json = json_decode(file_get_contents(get_field('json_link',$id)));

	if ( isset($json->feed->entry) ) {
		foreach ( $json->feed->entry as $key ) {
			$k = (array)$key->title;
			$v = (array)$key->content;
			$val = explode(':',$v['$t']);
			if ( isset($val[1]) ) $data[$k['$t']] = trim($val[1]);
			if ( $k['$t'] == 'members' ) $data[$k['$t']] = floor($data[$k['$t']]/1000) . 'k';
		}
	}

	$title = get_field('title',$id);
	$want = '';

	if ( $title != '' ) $title = '<div class="title">'. $title .'<div class="bg4"></div></div>';

	foreach ( get_field('blocks',$id) as $key ) {
		$j = strtolower($key['json']);
		$val = ( isset($data[$j]) ) ? $data[$j] : $key['title'];
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