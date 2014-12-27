<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Post thumbnail.
		themex_post_thumbnail();
	?>

	<header class="post__header">
		<?php
			if (is_single()) :
				the_title('<h1 class="entry-title">', '</h1>');
			else :
				the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
			endif;
		?>
	</header>

	<div class="post__content">
		<?php
			/* translators: %s: Name of current post */
			the_content(sprintf(
				__('Continue reading %s', 'themex'),
				the_title('<span class="screen-reader-text">', '</span>', false)
			) );

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

	<?php
		// Author bio.
		if (is_single() && get_the_author_meta('description')) :
			get_template_part('author-bio');
		endif;
	?>

	<footer class="post__footer">
		<ul class="list-inline">
			<?php themex_entry_meta(); ?>
			<?php edit_post_link(__('Edit', 'themex'), '<li><i class="glyphicon glyphicon-pencil"></i> ', '</li>'); ?>
		</ul>
	</footer>

</article>
