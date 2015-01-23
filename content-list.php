<article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
	<div class="row">
		<div class="col-sm-8 col-lg-9">
			<div class="visible-xs article__thumbnail article__thumbnail--xs">
				<?php the_post_thumbnail('thumbnail'); ?>
			</div>
			<h2 class="article__heading">
				<a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
			<div class="article__meta">
				<i class="glyphicon glyphicon-time"></i>&nbsp;
				<time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
					<?php echo get_the_date(); ?>
				</time>
				<span class="hidden-xs">
					<?php echo __('in', 'themex'); ?>
					<?php echo get_the_category_list(__(', ', 'themex')); ?>
				</span>
			</div>
			<div class="article__content">
				<?php the_excerpt(); ?>
			</div>
		</div>
		<div class="col-sm-4 col-lg-3 hidden-xs">
			<?php themex_cover_image('xs'); ?>
		</div>
	</div>
</article>
