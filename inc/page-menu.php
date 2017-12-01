<?php
$nav = '';
if ( $pageMenu[0]['menu'] != '' ) {
	foreach ( wp_get_nav_menu_items( $pageMenu[0]['menu'], [ 'order' => 'ASC', 'orderby' => 'menu_order' ] ) as $key ) {
		$class = ( get_the_ID() == $key->object_id ) ? 'current' : '';
		$nav .= '<a class="na '. $class .'" href="'. $key->url .'">'. $key->title .'</a>';
	}
}
switch ($pageMenu[0]['palette']) {
    case 2: $cr = bgc2; break;
	case 3: $cr = bgc3; break;
    default: $cr = bgc1;
}
$title = '<span>' . $pageMenu[0]['title'] .'</span>';
?>

<div id="pageMenu" class="bg6">

    <div class="container">

		<?php $img = ( $pageMenu[0]['icon'] != '' ) ? '<img src="'. $pageMenu[0]['icon'] .'" alt="" class="icon">' : ''; ?>

		<?= $img; ?>

        <div class="v-mid">
            <div class="vc-mid fort">
				<?php if ( $pageMenu[0]['title'] != '' ) { ?>
                    <h3 class="title bgc<?= (int)$pageMenu[0]['palette']; ?>"><?= $img . $title; ?></h3>
				<?php } ?>
            </div>
            <div class="vc-mid forn">
                <div>
                    <div class="nav bg6"><?= $nav; ?></div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>#pageMenu .nav a.current {border-bottom-color:<?= $cr; ?>}</style>
