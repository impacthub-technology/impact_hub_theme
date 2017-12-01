<?php if ( post_password_required() ) return; ?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h4 class="ctitle">
			<?php
				printf( _nx( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;:', get_comments_number(), 'comments title', 'webdesingsun' ),
					number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h4>

		<ol class="comment-list">
			<?php wp_list_comments( [ 'per_page' => 0 ] ); ?>
		</ol>

	<?php endif; // have_comments() ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'webdesingsun' ); ?></p>
	<?php endif; ?>

	<?php comment_form( [ 'logged_in_as' => ''] ); ?>

</div>
