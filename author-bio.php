<div class="post-aside__block post-author">
	<p class="post-author__by"><?php _e('Published by', 'themex'); ?></p>
	<div class="media">
		<div class="media-body">
			<p class="post-author__name"><?php echo get_the_author(); ?></p>
			<p class="post-author__desc"><?php the_author_meta('description'); ?></p>
			<a class="post-author__link" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author">
				<?php printf( __('View all posts by %s', 'twentyfifteen'), get_the_author()); ?>
			</a>
		</div>
		<div class="media-right post-author__avatar">
			<?php echo get_avatar(get_the_author_meta('user_email'), 96); ?>
		</div>
	</div>
</div>
