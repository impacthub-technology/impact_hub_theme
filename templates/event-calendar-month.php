<?php
    if ( isset( $month_events ) ) {
	    $month_events = $month_events;
    }
	$events_per_page = 10;
	$paged = count($month_events) > $events_per_page ? true : false;
?>
<div class="item">
	<div class="month">
		<?= $month_events[0]['label'] ?>
	</div>

	<?php
        foreach ( array_slice($month_events, 0, $events_per_page) as $event )  {
            set_query_var('event', $event);
            get_template_part('templates/event-calendar-summary');
        }
    ?>

	<?php if ( $paged ) : ?>

	<p class="clear"><button class="showEvent ih-btn btn4"><?= __('load more','impact-hub-theme') ?></button></p>

	<?php endif; ?>

</div>
