<?php

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function themex_setup() {
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(1280, 720, true);

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(array(
		'primary' => __('Primary Menu',      'themex'),
		'social'  => __('Social Links Menu', 'themex'),
	));

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support('html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	));
}
add_action('after_setup_theme', 'themex_setup');

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function themex_post_thumbnail() {
	if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
		return;
	}

	if (is_singular()) : ?>

		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>

	<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php the_post_thumbnail('post-thumbnail', array('alt' => get_the_title())); ?>
		</a>

	<?php endif;
}

/**
 * Prints HTML with meta information for the categories, tags.
 */
function themex_entry_meta() {
	if (is_sticky() && is_home() && !is_paged()) {
		printf('<li><i class="glyphicon glyphicon-asterisk"></i> %s</li>', __('Featured', 'themex'));
	}

	$format = get_post_format();
	if (current_theme_supports('post-formats', $format)) {
		printf('<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
			sprintf('<span class="sr-only">%s </span>', _x('Format', 'Used before post format.', 'themex')),
			esc_url(get_post_format_link($format)),
			get_post_format_string($format)
		);
	}

	if (in_array(get_post_type(), array('post', 'attachment'))) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf($time_string,
			esc_attr(get_the_date('c')),
			get_the_date(),
			esc_attr(get_the_modified_date('c')),
			get_the_modified_date()
		);

		printf('<li><i class="glyphicon glyphicon-calendar"></i><span class="sr-only">%1$s</span> <a href="%2$s" rel="bookmark">%3$s</a></li>',
			_x('Posted on', 'Used before publish date.', 'themex'),
			esc_url(get_permalink()),
			$time_string
		);
	}

	if ('post' == get_post_type()) {
		if (is_singular() || is_multi_author()) {
			printf('<li><i class="glyphicon glyphicon-user"></i><span class="sr-only">%1$s</span> <a class="url fn n" href="%2$s">%3$s</a></li>',
				_x('Author', 'Used before post author name.', 'themex'),
				esc_url(get_author_posts_url(get_the_author_meta('ID'))),
				get_the_author()
			);
		}

		$categories_list = get_the_category_list(_x(', ', 'Used between list items, there is a space after the comma.', 'themex'));
		if ($categories_list && themex_categorized_blog()) {
			printf('<li><i class="glyphicon glyphicon-folder-open"></i><span class="sr-only">%1$s</span> %2$s</li>',
				_x('Categories', 'Used before category names.', 'themex'),
				$categories_list
			);
		}

		$tags_list = get_the_tag_list('', _x(', ', 'Used between list items, there is a space after the comma.', 'themex'));
		if ($tags_list) {
			printf('<li><i class="glyphicon glyphicon-tags"></i><span class="sr-only">%1$s</span> %2$s</li>',
				_x('Tags', 'Used before tag names.', 'themex'),
				$tags_list
			);
		}
	}

	if (is_attachment() && wp_attachment_is_image()) {
		// Retrieve attachment metadata.
		$metadata = wp_get_attachment_metadata();

		printf('<span class="full-size-link"><span class="sr-only">%1$s</span> <a href="%2$s">%3$s &times; %4$s</a></span>',
			_x('Full size', 'Used before full size attachment link.', 'themex'),
			esc_url(wp_get_attachment_url()),
			$metadata['width'],
			$metadata['height']
		);
	}

	if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
		echo '<li><i class="glyphicon glyphicon-comment"></i> ';
		comments_popup_link(__( 'Leave a comment', 'themex'), __('1 Comment', 'themex'), __('% Comments', 'themex'));
		echo '</li>';
	}
}

/**
 * Determine whether blog/site has more than one category.
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function themex_categorized_blog() {
	if (false === ($all_the_cool_cats = get_transient('themex_categories'))) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		));

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count($all_the_cool_cats);

		set_transient('themex_categories', $all_the_cool_cats);
	}

	if ($all_the_cool_cats > 1) {
		// This blog has more than 1 category so themex_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so themex_categorized_blog should return false.
		return false;
	}
}
