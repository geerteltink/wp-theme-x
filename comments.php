<?php
if (post_password_required()) {
	return;
}
?>

<footer class="post__footer">
    <?php if (have_comments()) : ?>
        <h3 class="comments-title">
            <?php
                printf(
                    _nx(
                        'One thought on &ldquo;%2$s&rdquo;',
                        '%1$s thoughts on &ldquo;%2$s&rdquo;',
                        get_comments_number(),
                        'comments title',
                        'themex'
                    ), number_format_i18n(get_comments_number()), get_the_title()
                );
            ?>
        </h3>
        <ul class="list-unstyled">
            <?php
                wp_list_comments(array(
                    'style'       => 'ul',
                    'short_ping'  => true,
                    'avatar_size' => 64,
                    'format'      => 'html5',
                    'walker' => new Themex_Comment_Walker()
                ));
            ?>
        </ul>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <div class="row">
                <div class="col-xs-6">
                    <?php previous_comments_link(__('&larr; Previous Comments', 'themex')); ?>
                </div>
                <div class="col-xs-6 text-right">
                    <?php next_comments_link(__('More Comments &rarr;', 'themex')); ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments"><?php _e('Comments are closed.', 'themex'); ?></p>
    <?php endif; ?>

    <?php comment_form(); ?>
</footer>
