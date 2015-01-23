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
	set_post_thumbnail_size(640, 360, true);

	add_theme_support('title-tag');

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

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support('post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
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
function themex_cover_image($size = 'md')
{
	if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
		return;
	}

	if (is_singular()) {
		$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
	} else {
		$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumbnail');
	}

	echo sprintf(
		'<div class="cover-img cover-img-%s" style="background-image: url(\'%s\');"></div>',
		$size,
		$image[0]
	);
}

/**
 * Enable widget areas
 */
function themex_widgets_init()
{
	register_sidebar(array(
		'name'          => 'Home right sidebar',
		'id'            => 'sidebar_home_right',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
	));
}
add_action('widgets_init', 'themex_widgets_init');

/**
 * Enqueue scripts
 */
function themex_enqueue_scripts()
{
	if (!is_admin()) {
		wp_enqueue_style('font-noto-serif', '//www.google.com/fonts#ReviewPlace:refine/Collection:Noto+Serif:400,700,400italic,700italic');
		wp_enqueue_style('themex-css', get_template_directory_uri() . '/assets/css/stylesheet.css', array());

		wp_deregister_script('jquery');
		wp_register_script('jquery', get_template_directory_uri() . '/assets/js/jquery.js', array(), false, false);

		wp_enqueue_script('themex-bundle', get_template_directory_uri() . '/assets/js/bundle.js', array('jquery'), false, true);
	}
}
add_action('wp_enqueue_scripts', 'themex_enqueue_scripts');

/**
 * Optimize page loading
 */
function themex_optimize_page_loading()
{
	// Remove some links from the head
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'rsd_link');

	// Remove wordpress generator info
	remove_action('wp_head', 'wp_generator');

	// Force JavaScript at the end of the page for faster loading
	remove_action('wp_head', 'wp_print_scripts');
	remove_action('wp_head', 'wp_print_head_scripts', 9);
	add_action('wp_footer', 'wp_print_scripts', 5);
	add_action('wp_footer', 'wp_enqueue_scripts', 5);
}
add_action('after_setup_theme', 'themex_optimize_page_loading');
