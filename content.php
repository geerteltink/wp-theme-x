<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post__header">
		<h1 class="post__title"><?php the_title(); ?></h1>
		<div class="post__meta">
			<i class="glyphicon glyphicon-time"></i>&nbsp;
			<time class="entry-date published" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
				<?php echo get_the_date(); ?>
			</time>
			<span class="hidden-xs">
				<?php echo __('in', 'themex'); ?>
				<?php echo get_the_category_list(__(', ', 'themex')); ?>
			</span>
			<?php edit_post_link(__('Edit', 'themex'), '&nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-pencil"></i> <span>', '</span>'); ?>
		</div>
	</header>
	<?php themex_post_thumbnail(); ?>
	<div class="post__content">
		<div class="row">
			<div class="col-md-8">
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
			<aside class="col-md-4">
				<?php
				// Author bio
				if (get_the_author_meta('description')) :
					get_template_part('author-bio');
				endif;
				?>
				<div class="post-aside__block"><?php the_tags(); ?></div>
			</aside>
		</div>
	</div>
</article>
