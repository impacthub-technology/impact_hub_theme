<?php
define( 'THEME_URL', get_template_directory_uri() );
define( 'THEME_DIR', get_template_directory() );


define( 'bg4' , '#404043' );
define( 'bg5' , '#ffffff' );
define( 'bg6' , '#f5f5f5' );
define( 'cr4' , '#ffffff' );
define( 'cr5' , '#404043' );
define( 'cr6' , '#404043' );

define( 'arrowR' , file_get_contents(THEME_DIR . '/img/arrow-r.svg') );


function getLinks () {
	$link_blog = $link_events = home_url();
	$_pages = get_posts( [ 'post_type' => 'page', 'fields' => 'ids', 'numberposts' => 1, 'meta_key' => '_wp_page_template', 'meta_value' => 'tpl-stories.php' ] );
	foreach ( $_pages as $page ) $link_blog = get_page_link($page);
	$_pages = get_posts( [ 'post_type' => 'page', 'fields' => 'ids', 'numberposts' => 1, 'meta_key' => '_wp_page_template', 'meta_value' => 'tpl-events.php' ] );
	foreach ( $_pages as $page ) $link_events = get_page_link($page);
	define( 'PAGE_BLOG' , $link_blog );
	define( 'PAGE_EVENTS' , $link_events );
}
getLinks();


include __DIR__ . '/inc/theme-init.php';
include __DIR__ . '/inc/theme-settings.php';
include __DIR__ . '/inc/theme-customizer.php';
include __DIR__ . '/inc/theme-html.php';
include __DIR__ . '/inc/theme-ajax.php';
if ( defined( 'WPB_VC_VERSION' ) ) include __DIR__ . '/inc/v-composer.php';



foreach ( scandir( __DIR__ . '/modules') as $key ) {
	$file = __DIR__ . '/modules/' . $key;
	if ( is_readable($file) and strlen($key) > 2 ) include_once $file;
}


add_filter('acf/settings/save_json', function () {
	$path = get_template_directory() . '/acf-json';
	return $path;
} );

add_filter('acf/settings/load_json', function ( $paths ) {
	unset($paths[0]);
	$paths[] = get_template_directory() . '/acf-json';
	return $paths;
} );