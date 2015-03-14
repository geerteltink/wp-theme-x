<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post__header">
		<h1 class="post__title"><?php the_title(); ?></h1>
		<?php if (current_user_can('edit_pages')) : ?>
		<div class="post__meta">
			<?php edit_post_link(__('Edit', 'themex'), '<i class="glyphicon glyphicon-pencil"></i> <span>', '</span>'); ?>
		</div>
		<?php endif; ?>
	</header>
	<?php themex_cover_image(); ?>
	<div class="post__content">
		<?php
		/* translators: %s: Name of current post */
		the_content(sprintf(
			__('Continue reading %s', 'themex'),
			the_title('<span class="screen-reader-text">', '</span>', false)
		));

		wp_link_pages(array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'twentyfifteen') . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __('Page', 'twentyfifteen') . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		));
		?>
	</div>
</article>
