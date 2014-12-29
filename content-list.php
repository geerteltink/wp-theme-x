<article class="media">
	<div class="media-left media-list__thumbnail">
		<?php the_post_thumbnail('thumbnail'); ?>
	</div>
	<div class="media-body">
		<h2 class="media-heading media-list__heading">
			<a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>
		<div class="media-list__meta">
			<i class="glyphicon glyphicon-time"></i>&nbsp;
			<time class="entry-date published" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
				<?php echo get_the_date(); ?>
			</time>
			<span class="hidden-xs">
				<?php echo __('in', 'themex'); ?>
				<?php echo get_the_category_list(__(', ', 'themex')); ?>
			</span>
		</div>
		<div class="media-list__content">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>
