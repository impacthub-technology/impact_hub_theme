<!DOCTYPE html>
<html <?php language_attributes(); ?> class="bg4 no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]><script src="<?= THEME_URL; ?>/js/html5.js"></script><![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="preloader" class="v-mid" style="background:<?= pre_bg; ?>">
    <div class="vc-mid">
        <?php if ( pre_logo != '' ) echo '<img src="'. pre_logo .'" alt="Logo">'; ?>
        <div class="wave" style="background:<?= pre_wave; ?>"></div>
    </div>
</div>

<div id="page">

    <div id="header" class="<?php if ( !is_front_page() ) echo 'fixed'; ?> bg4">
        <div class="header" <?= getHeadBg(); ?>>
            <div class="container">

				<?= getLogo(); ?>

                <div class="pull-right">
                    <div id="mainNav">
	                    <?= getLang(); ?>
                        <ul class="main"><?= getMainNav(); ?></ul>
                    </div>
                    <span class="navbg"></span>

                    <img id="toggle" src="<?= THEME_URL; ?>/img/nav.svg" alt="">
                    <span class="searchBtn"><?php svg('search'); ?></span>
                </div>
            </div>
        </div>
	    <?php getPageMenu(); ?>

        <div id="search" class="bg1">
            <div class="sbg"><?php svg('search-bg'); ?></div>
            <form action="<?= home_url(); ?>" onsubmit="return !(sr.value.trim() === '')">
                <div class="ih-input"><input id="sr" name="s" placeholder="Search..."></div>
                <button class="ih-btn btn2">show results<?php arrowR; ?></button>
                <div class="sclose"><?php svg('close'); ?></div>
            </form>
        </div>
        <span class="searchBtn"><?php svg('search'); ?></span>
    </div>
    <div id="headBlank" class="bg6"></div>

	<div id="content" role="main" class="bg6">
