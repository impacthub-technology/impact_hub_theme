<?php
if ( isset( $module_id ) ) {
	$module_id = $module_id;
}
if ( isset( $events_per_months ) ) {
	$events_per_months = $events_per_months;
}
if ( isset( $show ) ) {
	$show = $show;
}

$pal = ( palette ) ? 1 : 3;
?>

<div class="mdls area-events bg<?= $pal ?>">
    <div class="container">
        <div class="row">
            <div class="slider-<?= $module_id ?> owl-carousel">
	            <?php
	                foreach ($events_per_months as $month) {
		                set_query_var('month_events', $month);
		                get_template_part('templates/event-calendar-month');
	                }
	            ?>
            </div>
        </div>
    </div>
</div>

<script>
 jQuery(document).ready(function(){
     jQuery(".slider-<?= $module_id ?>").owlCarousel({
            nav: true,
            navText: [ "", "" ],
            items: 1,
            mouseDrag: false,
            pullDrag: false,
            touchDrag: false,
            startPosition: <?= $show == 'past' ? count($events_per_months) - 1 : 0 ?>
        });
    });
</script>