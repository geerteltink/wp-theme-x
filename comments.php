<?php
if (post_password_required()) {
	return;
}
?>

<footer class="post__footer">
    <?php if (have_comments()) : ?>
        <h3 class="comments-title">
            <?php
                printf(_nx(
                    'One thought on &ldquo;%2$s&rdquo;',
                    '%1$s thoughts on &ldquo;%2$s&rdquo;',
                    get_comments_number(),
                    'comments title', 'themex'
                    ), number_format_i18n(get_comments_number()), get_the_title()
                );
            ?>
        </h3>
        <ol class="comment-list">
            <?php
                wp_list_comments(array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 56,
                    'format'      => 'html5'
                ));
            ?>
        </ol>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav class="navigation comment-navigation" role="navigation">
                <div class="comment-nav-prev"><?php previous_comments_link( __( '&larr; Previous Comments', 'bonestheme' ) ); ?></div>
                <div class="comment-nav-next"><?php next_comments_link( __( 'More Comments &rarr;', 'bonestheme' ) ); ?></div>
            </nav>
        <?php endif; ?>
    <?php endif; // have_comments() ?>

    <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
    ?>
        <p class="no-comments"><?php _e('Comments are closed.', 'themex'); ?></p>
    <?php endif; ?>

    <?php comment_form(); ?>
</footer>
