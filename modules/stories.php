<?php
# Template Name: Blog Posts Module
# Template Post Type: modules

function moduleStories($id) {

	$pal = ( palette ) ? [2,3,1] : [1,2,2];

	$stories = '';
	$i = $count = (int)get_field('stories_count',$id);
	$order = ( get_field('sortable',$id) == 'DESC' ) ? 'ASC' : 'DESC';

	$title = get_field('title',$id);
	$sub = get_field('subtitle',$id);
	if ( $sub != '' ) $title .= '<p class="bgc'.$pal[1].'">'. $sub .'</p>';
	if ( $title != '' ) $title = '<div class="title">'. $title .'<div class="bg'.$pal[1].'"></div></div>';

	$posts = get_posts( [ 'numberposts' => $count, 'orderby' => 'date', 'order' => $order, 'suppress_filters' => false ] );

	foreach ( $posts as $key ) {
		$i--;

		$excerpt = $key->post_excerpt;
		if ( trim($excerpt) == '' ) {
			$excerpt = substr(trim(strip_tags($key->post_content)),0,150);
			$temp = explode(' ',$excerpt);
			array_pop($temp);
			$excerpt = implode(' ',$temp);
		}

		$stories .= '<div class="col-md-6" data-test="">
			<div class="img" style="background-image:url('. get_the_post_thumbnail_url($key->ID,'full') .')"></div>
			<div class="data">
				<div class="name"><a href="'. get_permalink($key->ID) .'">'. $key->post_title .'<div class="bg1"></div></a></div>			
				'. $excerpt .'		
				<div class="meta '.$pal[2].'">'. get_the_date( $format, $key ) .' | '. get_the_author_meta('display_name',$key->post_author) .'</div>
				<a href="'. get_permalink($key->ID) .'"><button class="ih-btn btn'.$pal[2].'">view'. arrowR .'</button></a>		
			</div>
        </div>';
	}

	$btn = ( $i < 1 ) ? '<button class="addStory ih-btn" data-story="'. $id .'">load more stories</button><i class="glyphicon glyphicon-refresh gi-animate"></i>' : '';

	return '<div class="mdls area-stories bg'.$pal[0].'">
		<div class="container">
			'. $title .'<div class="mod-content">'. get_field('content',$id) .'</div>
			<div class="row story-'. $id .'">'. $stories .'</div>
			'. $btn .'
    	</div>
    </div>
    <script>
        jQuery(document).ready(function(){
            stories['. $id .'] = ['. $count .',"'. $order .'",0];
        });
    </script>
    ';

}