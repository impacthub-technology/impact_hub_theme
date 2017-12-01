<?php

add_action( 'wp_head', 'wds_script_area', 999 );
function wds_script_area() {
	include THEME_DIR . '/inc/style.php';
}


function getLogo ( $top = true ) {

	$type = 'main';
	if ( $top and get_field('header_logo') == 'second' ) $type = 'second';
	if ( is_search() or is_category() or is_archive() ) $type = 'main';
	$logo = get_theme_mod('logo_'.$type);

	return '<a href="'. home_url() .'">
			<div class="logo v-mid">
				<div class="vc-mid img"><img src="'. $logo .'" alt="Logo"></div>
				<div class="vc-mid loc">'. get_theme_mod('location') .'</div>
			</div>
			</a>';

}


function getHeadBg () {

	$bg = get_field('header_image');
	return ( !$bg or $bg == '' or is_search() or is_category() or is_archive() ) ? '' : 'style="background-image:url('. $bg .')"';

}


function getSocial () {

	$social = get_field('social_links','options');
	$list = '';
	foreach ( $social as $key ) {
		$img = ( substr($key['icon'],-4) === '.svg' ) ? _svg($key['icon'],true) : '<img src="'. $key['icon'] .'" alt="">';
		$list .= '<a href="'. $key['link'] .'" target="_blank">'. $img .'</a>';
	}

	/*$links['facebook'] = get_theme_mod('social_fb');
	$links['vimeo'] = get_theme_mod('social_vm');
	$links['twitter'] = get_theme_mod('social_tw');
	$links['linkedin'] = get_theme_mod('social_li');
	$list = '';

	foreach ( [ 'facebook', 'vimeo', 'twitter', 'linkedin' ] as $key ) {
		if ( $links[$key] != '' ) {
			$list .= '<a href="'. $links[$key] .'" target="_blank" class="'. $key .'">'. file_get_contents( THEME_URL . '/img/social-'. $key .'.svg') .'</a>';
		}
	}*/

	return ( $list == '' ) ? '' : '<div class="social">'. $list .'</div>';

}


function getFText () {

	$text = get_field( 'footer_content', 'options' );
	return ( $text == '' ) ? '' : '<div class="text">'. $text .'</div>';

}


function getPageMenu () {

	$pageMenu = get_field('page_menu');
	if ( !isset($pageMenu[0]) ) return;
	include THEME_DIR . '/inc/page-menu.php';

}

function getMainNav () {
	$id = get_nav_menu_locations()['main'];
	if ( $id < 1 ) return '';

	$nav = '';
	$menu = [];

	foreach ( wp_get_nav_menu_items( $id, [ 'order' => 'ASC', 'orderby' => 'menu_order' ] ) as $key ) {
		if ( $key->menu_item_parent < 1 ) {
			$menu[$key->ID] = $key;
			$menu[$key->ID]->submenu = [];
		} else {
			$menu[$key->menu_item_parent]->submenu[] = $key;
		}
	}

	foreach ( $menu as $key ) {

		$class = !empty($key->submenu) ? 'has-child ' : '';
		$class .= get_field('only_for_mobile',$key->ID) ? 'mob ' : '';
		$class .= get_field('search_button',$key->ID) ? 'searchBtn ' : '';
		#$class .= implode(' ',$key->classes) .' ';
		$class .= ( get_the_ID() == $key->object_id ) ? 'current' : '';

		$nav .= '<li class="'. $class .'">';

		$nav .= '<a href="'. $key->url .'"><span style="background-image:url('. get_field('icon',$key->ID) .')"></span>'. $key->title .'<i class="ar"></i></a>';

		if ( !empty($key->submenu) ) {
			$nav .= '<ul class="sub-menu">';
			foreach ( $key->submenu as $sub ) {
				$nav .= '<li><a href="'. $sub->url .'">'. $sub->title .'</a></li>';
			}
			$nav .= '</ul>';
		}

		$nav .= '</li>';

	}

	return $nav;
}

function svg ( $url ) {
	include THEME_DIR . '/img/'. $url .'.svg';
}
function _svg ( $url, $path = false ) {
	$dir = ( $path ) ? $url : THEME_DIR .'/img/'. $url .'.svg';
	return file_get_contents($dir);
}