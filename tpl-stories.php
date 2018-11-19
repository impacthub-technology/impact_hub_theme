<?php
# Template Name: Stories
get_header();

$pal = ( palette ) ? 1 : 2;

$stories = '';
$i = $count = (int)get_field('stories_count');
$order = ( get_field('sortable') == 'ASC' ) ? 'ASC' : 'DESC';

if ( isset($_COOKIE['blogSort']) and $_COOKIE['blogSort'] == 'ASC' ) $order = 'ASC';
if ( isset($_COOKIE['blogSort']) and $_COOKIE['blogSort'] == 'DESC' ) $order = 'DESC';

$cat = ( isset($_COOKIE['blogCat']) and $_COOKIE['blogCat'] != 'all' ) ? get_category_by_slug($_COOKIE['blogCat'])->term_id : 0;

$args = [
	'posts_per_page' => $count,
	'orderby' => 'date',
	'order' => $order, 'suppress_filters' => false
];

if ( $cat > 0 ) $args['category'] = $cat;

$the_query = new WP_Query( $args );
set_query_var( 'pal', $pal );

?>

    <div class="sortable bg<?= $pal ?>">
        <select id="sortable">
            <option value="DESC" <?= $order == 'DESC' ? 'selected' : '' ?>>
				<?= __('Show newest first', 'impact-hub-theme') ?>
            </option>
            <option value="ASC" <?= $order == 'ASC' ? 'selected' : '' ?>>
				<?= __('Show oldest first', 'impact-hub-theme') ?>
            </option>
        </select>
    </div>

    <section id="content" role="main" class="bg6">
        <div class="mdls area-stories bg6">
            <div class="container">
				<?php if (get_field('title')) : ?>
                    <div class="title">
						<?= get_field('title') ?>
						<?php if (get_field('subtitle')) : ?>
                            <p class="bgc2">
								<?= get_field('subtitle') ?>
                            </p>
						<?php endif; ?>
                        <div class="bg2"></div>
                    </div>
				<?php endif; ?>
                <div class="mod-content"><?= get_field('content'); ?></div>
                <div class="row story-<?= get_the_ID() ?>">
					<?php
					if ( $the_query->have_posts() ) {
						while ( $the_query->have_posts() ) {
							$i--;
							$the_query->the_post();
							get_template_part('templates/post','summary');
						}
					}
					wp_reset_postdata();
					?>
                </div>
				<?php if( $i < 1 ) : ?>
                    <button class="addStory ih-btn btn1" data-story="<?= get_the_ID() ?>"><?= __('load more', 'impact-hub-theme') ?></button>
                    <i class="glyphicon glyphicon-refresh gi-animate"></i>
				<?php endif; ?>
            </div>
        </div>
    </section>

<?php the_content(); ?>

    <script>
        jQuery(document).ready(function($){
            stories[<?= get_the_ID() ?>] = [<?= $count; ?>,"<?= $order; ?>",<?= $cat; ?>];
        });
    </script>


<?php get_footer(); ?>