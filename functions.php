<?php

// Register Custom Navigation Walker
require_once('inc/wp_bootstrap_navwalker.php');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function themex_setup()
{
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(320, 180, true);

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
 * Change the excerpt length
 *
 * @param $length
 * @return int
 */
function themex_excerpt_length($length)
{
	return 32;
}
add_filter('excerpt_length', 'themex_excerpt_length', 999);

/**
 * Change the excerpt ellipses
 *
 * @param $more
 * @return string
 */
function themex_excerpt_more($more)
{
	return '...';
}
add_filter('excerpt_more', 'themex_excerpt_more');

function themex_pagination()
{
	$pages = paginate_links(array(
		'type' => 'array',
		'prev_next' => true,
		'prev_text' => __('&laquo; Previous page', 'themex'),
		'next_text' => __('Next page &raquo;', 'themex')
	));

	if (is_array($pages)) {
		echo '<ul class="pagination">';
		foreach ($pages as $page) {
			if (strpos($page, 'current') !== false) {
				echo '<li class="active">' . $page . '</li>';
			} else {
				echo '<li>' . $page . '</li>';
			}

		}
		echo '</ul>';
	}
}

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function themex_post_thumbnail()
{
	if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
		return;
	}

	if (is_singular()) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
	} else {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-thumbnail' );
	}

	echo sprintf('<div class="post__thumbnail" style="background-image: url(\'%s\');"></div>', $image[0]);
}
