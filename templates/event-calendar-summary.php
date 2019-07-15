<?php
$pal = ( palette ) ? 1 : 3;
if ( isset( $event ) ) {
	    $event = $event;
}
?>

<div class="col-md-6">
	<div class="v-mid">
		<div class="vc-mid">
			<div class="data">
				<div class="name">
					<?= $event['title'] ?>
					<div class="bg<?= $pal ?>"></div>
				</div>
				<p><?= $event['desc'] ?></p>
				<div class="meta"><?= $event['date'] ?></div>
				<a href="<?= $event['link'] ?>">
					<button class="ih-btn btn4"><?= __('view','impact-hub-theme') . arrowR ?></button>
				</a>
			</div>
		</div>
		<div class="vc-mid img" style="background-image:url('<?= $event['img'] ?>')"></div>
	</div>
</div>