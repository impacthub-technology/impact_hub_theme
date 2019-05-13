<?php

add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'modules',
		array(
			'labels' => [
				'name'              => 'Modules',
				'singular_name'     => 'Module',
				'search_items'      => 'Search Module',
				'all_items'         => 'All Modules',
				'edit_item'         => 'Edit Module',
				'update_item'       => 'Update Module',
				'add_new_item'      => 'Add New Module',
				'new_item_name'     => 'New Module',
				'menu_name'         => 'Modules'
			],
			'public' => false,
			'show_ui' => true,
			'menu_icon' => THEME_URL . '/img/sidebar_IH_white.png',
			'menu_position' => 2,
			'exclude_from_search' => true,
			'supports' => [ 'title' ]
		)
	);
}


function Shortcodes_callback() {
	global $post;
	$tpl = get_post_meta( $post->ID, '_wp_page_template', true );
	?><input readonly onclick="this.select()" value='[module id="<?= $post->ID; ?>"]'><?php
}
function addMetaBox() {
	if ( !isset($_GET['post']) ) return;
	add_meta_box( 'modules_div', 'Module Shortcode', 'Shortcodes_callback', 'modules', 'side' );
}
add_action('add_meta_boxes', 'addMetaBox');


add_shortcode('module', 'themeModules');
function themeModules( $atts ){
	$id = floor($atts['id']);
	$tpl = get_post_meta( $id, '_wp_page_template', true );
	if ( get_post_type( $id ) != 'modules' or substr($tpl,0,8) != 'modules/' ) return;
	$func = 'module'. ucfirst(substr($tpl,8,-4));
	return ( function_exists($func) ) ? $func($id) : '';
}


add_filter('manage_modules_posts_columns', 'module_columns_head');
add_action('manage_modules_posts_custom_column', 'module_columns_content', 10, 2);
add_filter('manage_edit-modules_sortable_columns', 'module_sortable_column');
add_action('pre_get_posts', 'module_orderby');
function module_columns_head($defaults) {
	$defaults['type'] = 'Type';
	return $defaults;
}
function module_columns_content($column_name, $id) {
	if ( $column_name == 'type' ) echo ucfirst(substr( get_post_meta( $id, '_wp_page_template', true ), 8, -4));
}
function module_sortable_column($sortable_columns){
	$sortable_columns['type'] = 'type';
	return $sortable_columns;
}
function module_orderby( $query ) {
	if( !is_admin() ) return;
	$orderby = $query->get( 'orderby');
	if( 'type' == $orderby ) {
		$query->set('meta_key','_wp_page_template');
		$query->set('orderby','meta_value');
	}
}


add_action( 'admin_init' , 'my_column_init' );
function posts_manage_columns( $columns ) {
	unset($columns['categories']);
	unset($columns['comments']);
	unset($columns['tags']);
	return $columns;
}
function my_column_init() {
	add_filter( 'manage_posts_columns' , 'posts_manage_columns' );
}


add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {
	return '<button class="ih-btn btn4" id="gform_submit_button_'. $form['id'] .'">send'. arrowR .'</button>';
}


function getDateSF ( $start, $end ) {

	$_start = [ date_format( $start, 'F d' ), date_format( $start, 'g:i a' ) ];
	$_end = [ date_format( $end, 'F d' ), date_format( $end, 'g:i a' ) ];

	$date = $_start[0] .' | '. $_start[1] .' to '. $_end[1];

	if ( date_format( $start, 'Y/m/d' ) != date_format( $end, 'Y/m/d' ) )
	    $date = $_start[0] .' | '. $_start[1] .' to<br>'. $_end[0] .' | '. $_end[1];

	return $date;
}