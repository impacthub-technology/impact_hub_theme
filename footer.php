<?php
$sb_1 = is_active_sidebar('footer_1');
$sb_2 = is_active_sidebar('footer_2');
$sb_3 = is_active_sidebar('footer_3');
$count = $sb_1 + $sb_2 + $sb_3;
?>

</div>

<div id="footer" class="bg4 num-<?= $count; ?>">
    <div class="container">
        <div class="row">
			<?php
			if ( $sb_1 ) {
				echo '<div class="col-sm-4">';
				dynamic_sidebar('footer_1');
				echo '</div>';
			}
			if ( $sb_2 ) {
				echo '<div class="col-sm-4">';
				dynamic_sidebar('footer_2');
				echo '</div>';
			}
			if ( $sb_3 ) {
				echo '<div class="col-sm-4">';
				dynamic_sidebar('footer_3');
				echo '</div>';
			}
			?>
        </div>
    </div>
</div>

</div>

<?php wp_footer(); ?>

</body>
</html>