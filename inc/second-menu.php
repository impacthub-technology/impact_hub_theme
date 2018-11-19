<?php

function getPID ( $nav, $nid ) {
    $id = 0;
	foreach ( $nav as $key ) {
        if ( (int)$key->ID === (int)$nid ) {
            $id = $key->object_id;
            break;
        }
	}
    return $id;
}

$id = get_nav_menu_locations()['main'];
if ( $id > 0 ) {

	$nav    = wp_get_nav_menu_items( $id, [ 'order' => 'ASC', 'orderby' => 'menu_order' ] );
	$pageID = get_the_ID();
	$menu   = '';
	$title  = '';
	$pg     = 0;

	foreach ( $nav as $key ) {
		if ( $key->object_id == $pageID ) {

			if ( $key->menu_item_parent < 1 ) {

				$pg = $key->ID;
				$title = $key->title;
				foreach ( $nav as $item ) {
					if ( $item->menu_item_parent == $key->ID ) {
						$class = ( $pageID == $item->object_id ) ? 'current' : '';
						$menu  .= '<a class="na ' . $class . '" href="' . $item->url . '">' . $item->title . '</a>';
					}
				}

			} else {

				$pg = $key->menu_item_parent;
				$title = $key->title;
				foreach ( $nav as $item ) {
				    if ( (int)$key->menu_item_parent == (int)$item->ID ) $title = $item->title;
					if ( (int)$item->menu_item_parent == (int)$key->menu_item_parent ) {
						$class = ( $pageID == $item->object_id ) ? 'current' : '';
						$menu  .= '<a class="na ' . $class . '" href="' . $item->url . '">' . $item->title . '</a>';
					}
				}

			}
			break;

		}
	}

	$color = get_field( 'color', $pg );
	$icon = get_field( 'icon', $pg );
	$title = '<span>'. $title .'</span>';

}

if ( PAGE_BLOG === get_permalink() ) {
    $menu = '';
	$categories = get_categories();
	if ( $categories ) {
		$menu .= '<a class="na blog_cat" data-href="all">All</a>';
		foreach ( $categories as $categ ) {
		    $cur = ( isset($_COOKIE['blogCat']) and $_COOKIE['blogCat'] == $categ->slug ) ? 'current' : '';
		    $menu .= '<a class="na blog_cat '.$cur.'" data-href="' . $categ->slug . '">' . $categ->name . '</a>';
		}
	}
}

if ( $id > 0 and strip_tags($title) != '' ) {
?>

<div id="pageMenu" class="bg6" data-t="<?= $icon; ?>">

	<div class="container">

		<?php $img = ( $icon != '' ) ? '<span class="icon">'. _svg($icon,true) .'</span>' : ''; ?>

		<?= $img; ?>

		<div class="v-mid">
			<div class="vc-mid fort">
				<h3 class="title bgc"><?= $img . $title; ?></h3>
			</div>
            <?php if ( $menu != '' ) { ?>
			<div class="vc-mid forn">
				<div>
					<div class="nav bg6"><?= $menu; ?></div>
				</div>
			</div>
            <?php } ?>
		</div>
	</div>

</div>

<style>
#pageMenu .nav a.current {border-bottom-color:<?= $color; ?>}
#pageMenu .title { color: <?= $color; ?>}
#pageMenu svg { fill: <?= $color; ?>}
</style>
<?php }