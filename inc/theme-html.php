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
	if ( empty($social) ) return '';
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

	include THEME_DIR . '/inc/second-menu.php';

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

		$nav .= '<a href="'. $key->url .'">
				<span>'. _svg(get_field('icon',$key->ID),true) .'</span>
			'. $key->title .'<i class="ar"></i></a>';

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

function getLang () {
	$count = apply_filters( 'wpml_active_languages', null, '' );
	if ( !is_array($count) or count($count) < 2 ) return '';
	return '<div id="lang_area">' . do_shortcode('[wpml_language_switcher flags=1 native=0 translated=0][/wpml_language_switcher]') . '</div>';
}


function is_url_exists ($url) {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_NOBODY, true);
	curl_exec($ch);
	$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	if ( $code == 200 ) return true;
	return false;
}


function svg ( $url ) {
	$file = THEME_DIR . '/img/'. $url .'.svg';
	if ( file_exists($file) ) include $file;
}
function _svg ( $url, $path = false ) {
	$file = ( $path ) ? $url : THEME_DIR .'/img/'. $url .'.svg';
	if ( substr($file,-4) != '.svg' ) return '<img src="'. $file .'" alt="">';
	if ( is_url_exists($file) ) return file_get_contents($file);
}