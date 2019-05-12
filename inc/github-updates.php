<?php

// Remove Events Calendar notices about expired key
add_filter('pre_update_option_tribe_pue_key_notices', 'remove_tribe_notices', 10, 0);
add_filter('pre_option_tribe_pue_key_notices', 'remove_tribe_notices', 10, 0);
function remove_tribe_notices() {
	return '';
}

// Remove Events Calendar notice about expired key on plugins page
add_filter( 'tribe_plugin_notices', 'filter_pre_set_site_transient_update_plugins', 20, 0 );
function filter_pre_set_site_transient_update_plugins() {
	return [];
};

// Display default Wordpress update notice
add_action( "after_plugin_row_events-calendar-pro/events-calendar-pro.php", 'wp_plugin_update_row', 100, 2 );

// Hide Revolution Slider update notice on plugins page
remove_action('admin_notices', array('RevSliderAdmin', 'add_plugins_page_notices'));

// Define plugins whose updates from wp.org are overridden by GitHub updates
add_filter( 'github_updater_override_dot_org', function() {
	return [
		'advanced-custom-fields-pro/acf.php',
		'event-tickets/event-tickets.php',
		'events-calendar-pro/events-calendar-pro.php',
		'gravityforms/gravityforms.php',
		'gravityforms-multilingual/plugin.php',
		'js_composer/js_composer.php',
		'revslider/revslider.php',
		'sitepress-multilingual-cms/sitepress.php',
		'the-events-calendar/the-events-calendar.php',
		'wpml-cms-nav/plugin.php',
		'wpml-string-translation/plugin.php',
		'wpml-translation-management/plugin.php',
		'wpml-all-import/wpml-all-import.php',
		'wpml-media-translation/plugin.php',
		'wpml-sticky-links/plugin.php'
	];
});