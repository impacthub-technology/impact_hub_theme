<?php
# Template Name: Team Module
# Template Post Type: modules

function moduleTeam($id) {

	$pal = ( palette ) ? [2,1,3] : [1,2,2];

	$title = get_field('title',$id);
	$array = get_field('team',$id);
	$pagin = get_field('pagination',$id);
	$team = '';

	if ( $title != '' ) $title = '<div class="title">'. $title .'<div class="bg'.$pal[1].'"></div></div>';

	foreach ( $array as $key ) {
		$btn = ( $key['link'] == '' ) ? '' : '<a href="'. $key['link'] .'"><button class="ih-btn btn'.$pal[1].'">' . __('view profile', 'impact-hub-theme') . arrowR .'</button></a>';

		$team .= '<div class="item row col-md-6 hide">
			<div class="col-sm-6 col-xs-6 img" style="background-image:url('. $key['image'] .')"></div>
			<div class="col-sm-6 col-xs-6 data">
				<div class="name">'. $key['first_name'] .'</div>
				<div class="name">'. $key['last_name'] .'</div>
				<div class="bg'.$pal[1].'"></div>
				<div class="pos">'. $key['position'] .'</div>
				<div class="email bgc'.$pal[2].'"><a href="mailto:'. $key['email'] .'">' . $key['email'] . '</a></div>
			</div>
            '. $btn .'
        </div>';
	}

	return '<div class="mdls area-team bg'.$pal[0].'">
		<div class="container">'. $title .'<div class="mod-content">'. get_field('content',$id) .'</div><div class="row">'. $team .'</div></div>
		<div class="clear"></div><button class="ih-btn btn'.$pal[1].' addTeam">' . __('load more', 'impact-hub-theme') . '</button>
    </div>
    <script>
    	var cTeam = 0, tPagin = '. $pagin .';
        jQuery(".addTeam").click(function(){
            for ( var i = cTeam; i < cTeam+tPagin; i++ ) {
                jQuery(".area-team .row .item:eq("+i+")").removeClass("hide");
            }
            cTeam += tPagin;
            if ( jQuery(".area-team .row .item").length <= cTeam ) jQuery(".addTeam").remove();
        }).click();
    </script>
    ';

}