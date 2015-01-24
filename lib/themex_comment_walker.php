<?php

/**
 * Use Bootstrap's media object for listing comments
 *
 * @link http://twitter.github.com/bootstrap/components.html#media
 */
class Themex_Comment_Walker extends Walker_Comment
{
    protected function html5_comment($comment, $depth, $args)
    {
        $tag = ('div' === $args['style']) ? 'div' : 'li';
        ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '' ); ?>>
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
            <div class="comment-metadata media">
                <?php if (0 != $args['avatar_size']) : ?>
                <div class="media-object media-object-sm media-object-circle">
                    <?php echo get_avatar($comment, $args['avatar_size']); ?>
                </div>
                <?php endif; ?>
                <div class="media-body">
                    <h4 class="media-heading">
                        <?php echo get_comment_author_link(); ?>
                    </h4>
                    <div class="media-subheading">
                        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">#</a>
                        <time datetime="<?php comment_time( 'c' ); ?>">
                            <?php printf(_x('%1$s at %2$s', '1: date, 2: time'), get_comment_date(), get_comment_time()); ?>
                        </time>
                        <?php edit_comment_link(__(' &nbsp; <i class="glyphicon glyphicon-pencil"></i>'), '<span class="edit-link">', '</span>' ); ?>
                        <?php
                        comment_reply_link(array_merge($args, array(
                            'add_below' => 'div-comment',
                            'depth'     => $depth,
                            'max_depth' => $args['max_depth'],
                            'before'    => ' &nbsp; <span class="reply">',
                            'after'     => '</span>',
                            'reply_text'=> '<i class="glyphicon glyphicon-comment"></i>'
                        )));
                        ?>
                    </div>
                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
                    <?php endif; ?>
                    <br />
                    <?php comment_text(); ?>
                    <br />
                </div>
            </div>
        </article>
    <?php
    }
}
