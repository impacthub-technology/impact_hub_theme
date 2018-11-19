<?php
# Template Name: Stories
get_header();

$pal = ( palette ) ? 1 : 2;

$id = get_the_ID();
$stories = '';
$i = $count = (int)get_field('stories_count',$id);
$order = ( get_field('sortable',$id) == 'ASC' ) ? 'ASC' : 'DESC';
if ( isset($_COOKIE['blogSort']) and $_COOKIE['blogSort'] == 'ASC' ) $order = 'ASC';
if ( isset($_COOKIE['blogSort']) and $_COOKIE['blogSort'] == 'DESC' ) $order = 'DESC';

$cat = ( isset($_COOKIE['blogCat']) and $_COOKIE['blogCat'] != 'all' ) ? get_category_by_slug($_COOKIE['blogCat'])->term_id : 0;

$agrs = [ 'numberposts' => $count, 'orderby' => 'date', 'order' => $order, 'suppress_filters' => false ];
if ( $cat > 0 ) $agrs['category'] = $cat;

$posts = get_posts( $agrs );
$sel = ( $order == 'ASC' ) ? 'selected' : '';

$title = get_field('title',$id);
$sub = get_field('subtitle',$id);
if ( $sub != '' ) $title .= '<p class="bgc2">'. $sub .'</p>';
if ( $title != '' ) $title = '<div class="title">'. $title .'<div class="bg2"></div></div>';

?>

<div class="sortable bg<?= $pal; ?>">
	<select id="sortable">
		<option value="DESC">Show newest first</option>
		<option value="ASC" <?= $sel; ?>>Show oldest first</option>
	</select>
</div>

<section id="content" role="main" class="bg6">
	<div class="mdls area-stories bg6">
		<div class="container">
            <?= $title; ?><div class="mod-content"><?= get_field('content',$id); ?></div>
			<div class="row story-<?= $id; ?>">
				<?php foreach ( $posts as $key ) { $i--; ?>

                    <?php
					$excerpt = $key->post_excerpt;
					if ( trim($excerpt) == '' ) {
						$excerpt = substr(trim(strip_tags($key->post_content)),0,150);
						$temp = explode(' ',$excerpt);
						array_pop($temp);
						$excerpt = implode(' ',$temp);
					}
					?>
					<div class="col-md-6">
						<div class="img" style="background-image:url(<?= get_the_post_thumbnail_url($key->ID,'full') ; ?>)"></div>
						<div class="data">
							<div class="name"><?= $key->post_title; ?><div class="bg1"></div></div>
							<?= $excerpt; ?>
							<div class="meta bgc<?= $pal[2]; ?>"><?= get_the_date( $format, $key ) .' | '. get_the_author_meta('display_name',$key->post_author); ?></div>
							<a href="<?= get_permalink($key->ID); ?>"><button class="ih-btn btn<?= $pal; ?>">view<?= arrowR; ?></button></a>
						</div>
					</div>
				<?php } ?>
			</div>
			<?= ( $i < 1 ) ? '<button class="addStory ih-btn btn1" data-story="'. $id .'">load more</button><i class="glyphicon glyphicon-refresh gi-animate"></i>' : ''; ?>
		</div>
	</div>
</section>

<?php the_content(); ?>

<script>
jQuery(document).ready(function($){
    stories[<?= $id; ?>] = [<?= $count; ?>,"<?= $order; ?>",<?= $cat; ?>];
});
</script>


<?php get_footer(); ?>