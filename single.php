<?php get_header(); ?>

<?php while ( have_posts() ) { the_post(); ?>

    <div class="container area-stories">
        <a href="<?= PAGE_BLOG; ?>"><?php svg('arrow-l'); ?></a>
        <div id="sTitle">
            <div class="icon" style="background-image:url(<?= get_the_post_thumbnail_url(); ?>)"></div>
            <div class="data">
                <div class="name"><?php the_title(); ?><div class="bg1"></div></div>
                <div class="meta bgc2"><?= get_the_date( 'j F Y', $post ) .' - '. get_the_author_meta('display_name',$post->post_author); ?></div>
            </div>
        </div>
    </div>

	<div id="single">
        <div class="container">
            <?php the_content(); ?>
        </div>
    </div>

    <style>
        #single h5, #single a {color:<?= bg1; ?>}
        .area-stories .arrow-l {stroke:<?= bg1; ?>!important}
    </style>

<?php } ?>

<?php get_footer(); ?>
