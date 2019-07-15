<?php
/**
 * Template for post summary displayed on Stories page.
 * This template is used by the following files"
 * - /tpl-stories.php
 * - /inc/theme-ajax.php
 */

$excerpt = $post->post_excerpt;
if ( trim($excerpt) == '' ) {
	//cut off all HTML tags and take first 150 characters
	$excerpt = substr(trim(strip_tags($post->post_content)),0,150);
	//remove last word to be sure there is not a part of word at the end of the excerpt
	$temp = explode(' ',$excerpt);
	array_pop($temp);
	$excerpt = implode(' ',$temp);
}

?>

<div class="col-md-6">
	<div class="img" style="background-image:url(<?= get_the_post_thumbnail_url($post->ID, 'full') ?>)"></div>
	<div class="data">
		<div class="name"><?= get_the_title() ?><div class="bg1"></div></div>
		<p><?= $excerpt ?></p>
		<div class="meta bgc<?= $pal[2]; ?>"><?= get_the_date() ?> | <?= get_the_author_meta('display_name') ?></div>
		<a href="<?= get_permalink() ?>"><button class="ih-btn btn<?= $pal ?>"><?= __('view','impact-hub-theme') ?><?= arrowR ?></button></a>
	</div>
</div>