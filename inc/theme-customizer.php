<?php

add_action( 'customize_register', 'themeCustomize');

function themeCustomize( $wp_customize ) {

	$themeBG = [
		'#2FBACB' => '',
		'#3A9B89' => '',
		'#075A61' => '',
		'#3890BF' => '',
		'#093247' => '',
		'#266383' => '',
		'#404043' => '',
		'#812926' => '',
		'#B1C976' => '',
		'#CA2C55' => '',
		'#D95543' => '',
		'#E95356' => '',
		'#F0F0F0' => '',
		'#EDA46C' => ''
	];

	$themeCR = [ '#fff' => '', '#000' => '' ];

	$themePL = [
		'none' => 'Select Palette',
		'#075A61,#3A9B89,#CA2C55,#fff,#fff,#fff' => 'Palette 1',
		'#075A61,#3A9B89,#E95356,#fff,#fff,#fff' => 'Palette 2',
		'#D95543,#EDA46C,#093247,#fff,#fff,#fff' => 'Palette 3',
		'#D95543,#EDA46C,#075A61,#fff,#fff,#fff' => 'Palette 4',
		'#266383,#2FBACB,#E95356,#fff,#fff,#fff' => 'Palette 5',
		'#266383,#2FBACB,#CA2C55,#fff,#fff,#fff' => 'Palette 6',
		'#075A61,#3A9B89,#B1C976,#fff,#fff,#fff' => 'Palette 7',
		'#266383,#2FBACB,#3890BF,#fff,#fff,#fff' => 'Palette 8',
		'#D95543,#EDA46C,#CA2C55,#fff,#fff,#fff' => 'Palette 9',
		'#812926,#404043,#F0F0F0,#fff,#fff,#000' => 'Palette 10'
	];


	$wp_customize->add_section( 'theme_palette', [ 'title' => 'Palette', 'priority' => 21 ] );
	$wp_customize->add_section( 'preloader', [ 'title' => 'Preloader', 'priority' => 22 ] );
	$wp_customize->add_section( 'social_links', [ 'title' => 'Social Links', 'priority' => 23 ] );


	$wp_customize->add_setting( 'select_palette', [ 'default' => 'none' ] );
	$wp_customize->add_control( 'select_palette', [ 'type' => 'select', 'section' => 'theme_palette', 'label' => 'Suggested colour combinations', 'description' => 'Or customise the colours below:', 'choices' => $themePL ] );


	$wp_customize->add_setting( 'color_bg_1' );
	$wp_customize->add_control( 'color_bg_1', [ 'type' => 'radio', 'section' => 'theme_palette', 'label' => 'Background Color 1', 'choices' => $themeBG ] );
	$wp_customize->add_setting( 'color_bg_2' );
	$wp_customize->add_control( 'color_bg_2', [ 'type' => 'radio', 'section' => 'theme_palette', 'label' => 'Background Color 2', 'choices' => $themeBG ] );
	$wp_customize->add_setting( 'color_bg_3' );
	$wp_customize->add_control( 'color_bg_3', [ 'type' => 'radio', 'section' => 'theme_palette', 'label' => 'Background Color 3', 'choices' => $themeBG ] );

	$wp_customize->add_setting( 'color_font_1' );
	$wp_customize->add_control( 'color_font_1', [ 'type' => 'radio', 'section' => 'theme_palette', 'label' => 'Font Color 1', 'choices' => $themeCR ] );
	$wp_customize->add_setting( 'color_font_2' );
	$wp_customize->add_control( 'color_font_2', [ 'type' => 'radio', 'section' => 'theme_palette', 'label' => 'Font Color 2', 'choices' => $themeCR ] );
	$wp_customize->add_setting( 'color_font_3' );
	$wp_customize->add_control( 'color_font_3', [ 'type' => 'radio', 'section' => 'theme_palette', 'label' => 'Font Color 3', 'choices' => $themeCR ] );

	$wp_customize->add_setting( 'color_border' );
	$wp_customize->add_control( 'color_border', [ 'type' => 'radio', 'section' => 'theme_palette', 'label' => 'Input Border Color', 'choices' => $themeBG ] );


	/*$wp_customize->add_setting( 'social_fb' );
	$wp_customize->add_control( 'social_fb', [ 'section' => 'social_links', 'label' => 'Facebook' ] );
	$wp_customize->add_setting( 'social_vm' );
	$wp_customize->add_control( 'social_vm', [ 'section' => 'social_links', 'label' => 'Vimeo' ] );
	$wp_customize->add_setting( 'social_tw' );
	$wp_customize->add_control( 'social_tw', [ 'section' => 'social_links', 'label' => 'Twitter' ] );
	$wp_customize->add_setting( 'social_li' );
	$wp_customize->add_control( 'social_li', [ 'section' => 'social_links', 'label' => 'LinkedIn' ] );*/


	$wp_customize->add_setting( 'location' );
	$wp_customize->add_control( 'location', [ 'section' => 'title_tagline', 'label' => 'Location' ] );

	$wp_customize->add_setting( 'logo_main' );
	$wp_customize->add_setting( 'logo_second' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_main', [ 'label' => 'Main Logo', 'section' => 'title_tagline' ] ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_second', [ 'label' => 'Second Logo', 'section' => 'title_tagline' ] ) );


	$wp_customize->add_setting( 'preloader_logo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'preloader_logo', [ 'section' => 'preloader', 'label' => 'Logo' ] ) );
	$wp_customize->add_setting( 'preloader_bg' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'preloader_bg', [ 'section' => 'preloader', 'label' => 'Background' ] ) );
	$wp_customize->add_setting( 'preloader_wave' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'preloader_wave', [ 'section' => 'preloader', 'label' => 'Wave' ] ) );



}
