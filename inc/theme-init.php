<?php

add_action( 'after_setup_theme', 'wds_setup' );
function wds_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus( [ 'main' => 'Main Menu' ] );
	register_sidebar( [ 'name' => 'Footer 1', 'id' => 'footer_1', 'before_title' => '<h4>', 'after_title' => '</h4>' ] );
	register_sidebar( [ 'name' => 'Footer 2', 'id' => 'footer_2', 'before_title' => '<h4>', 'after_title' => '</h4>' ] );
	register_sidebar( [ 'name' => 'Footer 3', 'id' => 'footer_3', 'before_title' => '<h4>', 'after_title' => '</h4>' ] );
	register_sidebar( [ 'name' => 'Event Footer', 'id' => 'event_footer', 'before_title' => '<h4>', 'after_title' => '</h4>' ] );
	register_widget( 'siteLogo' );
	register_widget( 'socialLinks' );

	if ( function_exists('acf_add_options_page') ) acf_add_options_page([ 'page_title' => 'Social Links', 'icon_url' => 'dashicons-share' ]);
}


class socialLinks extends WP_Widget {
	function __construct() {
		parent::__construct( 'socialLinks', 'Social Links' );
	}
	function widget( $args, $instance ) {
		echo getSocial();
	}
	function form () {}
	function update() {}
}
class siteLogo extends WP_Widget {
	function __construct() {
		parent::__construct( 'siteLogo', 'Logo' );
	}
	public function widget( $args, $instance ) {
		echo getLogo( false );
	}
	function form () {}
	function update() {}

}


add_filter('upload_mimes', 'add_mime_types');
function add_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}


function unset_image_sizes( $sizes ) {
	unset( $sizes['medium_large'] );
	unset( $sizes['medium'] );
	if ( get_option('thumbnail_crop') == '' ) unset( $sizes['thumbnail'] );
	return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'unset_image_sizes');


add_action( 'wp_enqueue_scripts', 'wds_scripts' );
function wds_scripts() {
	wp_enqueue_style( 'wds', get_stylesheet_uri() );
	wp_enqueue_style( 'bootstrap', THEME_URL .'/css/bootstrap.min.css' );
	wp_enqueue_style( 'owl', THEME_URL .'/css/owl.css' );
	wp_enqueue_style( 'select', THEME_URL .'/css/select.css' );
	wp_enqueue_style( 'scroll', THEME_URL .'/css/scroll.css' );
	wp_enqueue_style( 'theme', THEME_URL .'/css/theme.css' );

	wp_enqueue_script( 'bootstrap', THEME_URL .'/js/bootstrap.min.js', array( 'jquery' ), '1', true );
	wp_enqueue_script( 'owl', THEME_URL .'/js/owl.js', array( 'jquery' ), '1', true );
	wp_enqueue_script( 'select', THEME_URL .'/js/select.js', array( 'jquery' ), '1', true );
	wp_enqueue_script( 'scroll', THEME_URL .'/js/scroll.js', array( 'jquery' ), '1', true );
	wp_enqueue_script( 'gallery-grid', THEME_URL .'/js/gallery-grid.js', array( 'jquery' ), '1', true );
	wp_enqueue_script( 'ajax-area', THEME_URL .'/js/ajax.js', array( 'jquery' ), '1', true );
	wp_enqueue_script( 'wds', THEME_URL .'/js/scripts.js', array( 'jquery' ), '2', true );
}


add_action( 'admin_enqueue_scripts', 'load_admin_style' );
function load_admin_style() {
	wp_enqueue_style( 'admin_css', THEME_URL . '/css/admin.css', false, '1' );
	wp_enqueue_script( 'admin_js', THEME_URL .'/js/admin.js', array( 'jquery' ), '1', true );
}


add_filter( 'mce_buttons_2', 'add_more_buttons_2' );
function add_more_buttons_2($buttons) {
	array_unshift($buttons, 'backcolor');
	array_unshift($buttons, 'media');
	array_unshift($buttons, 'fontsizeselect');
	return $buttons;
}


add_filter( 'tiny_mce_before_init', 'add_text_sizes' );
function add_text_sizes( $init_array ){
	$init_array['fontsize_formats'] = "14px 16px 18px 20px 25px 30px 35px 45px";
	return $init_array;
}


add_filter('site_transient_update_plugins', 'remove_update_notification');
function remove_update_notification($value) {
	if ( isset( $value->response['advanced-custom-fields-pro/acf.php'] ) ) unset($value->response['advanced-custom-fields-pro/acf.php']);
	return $value;
}


add_action( 'wp_loaded', function () {

	$bg1 = get_theme_mod( 'color_bg_1', '#075A61' );
	$bg2 = get_theme_mod( 'color_bg_2', '#3A9B89' );
	$bg3 = get_theme_mod( 'color_bg_3', '#CA2C55' );
	$cr1 = get_theme_mod( 'color_font_1', '#fff' );
	$cr2 = get_theme_mod( 'color_font_2', '#fff' );
	$cr3 = get_theme_mod( 'color_font_3', '#fff' );
	$input = get_theme_mod( 'color_border', '#404043' );
	if ( $bg1 == '' ) $bg1 = '#075A61';
	if ( $bg2 == '' ) $bg2 = '#3A9B89';
	if ( $bg3 == '' ) $bg3 = '#CA2C55';
	if ( $cr1 == '' ) $cr1 = '#fff';
	if ( $cr2 == '' ) $cr2 = '#fff';
	if ( $cr3 == '' ) $cr3 = '#fff';
	if ( $input == '' ) $input = '#404043';

	define( 'palette', get_theme_mod( 'select_palette' ) == '#812926,#404043,#F0F0F0,#fff,#fff,#000' );
	define( 'bg1', $bg1 );
	define( 'bg2', $bg2 );
	define( 'bg3', $bg3 );
	define( 'bgc1', bg1 );
	define( 'bgc2', bg2 );
	define( 'bgc3', bg3 );
	define( 'cr1', $cr1 );
	define( 'cr2', $cr2 );
	define( 'cr3', $cr3 );
	define( 'cr_input', $input );
	define( 'pre_logo', get_theme_mod( 'preloader_logo', '' ) );
	define( 'pre_bg', get_theme_mod( 'preloader_bg', '#f5f5f5' ) );
	define( 'pre_wave', get_theme_mod( 'preloader_wave', '#f5f5f5' ) );

} );