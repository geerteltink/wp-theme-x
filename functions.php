<?php

// Register Custom Navigation Walker
require_once('lib/themex_comment_walker.php');
require_once('lib/themex_nav_walker.php');

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
    add_theme_support('automatic-feed-links');

    // Use html5
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ]);

    //See: https://codex.wordpress.org/Post_Formats
    add_theme_support('post-formats', [
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
        'status',
        'audio',
        'chat',
    ]);

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus([
        'primary' => __('Primary Menu', 'themex'),
        'social'  => __('Social Links Menu', 'themex'),
    ]);
}

add_action('after_setup_theme', 'themex_setup');

/**
 * Change the excerpt length
 *
 * @param $length
 *
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
 *
 * @return string
 */
function themex_excerpt_more($more)
{
    return '...';
}

add_filter('excerpt_more', 'themex_excerpt_more');

function themex_pagination()
{
    $pages = paginate_links([
        'type'      => 'array',
        'prev_next' => true,
        'prev_text' => __('&laquo; Previous page', 'themex'),
        'next_text' => __('Next page &raquo;', 'themex'),
    ]);

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
    register_sidebar([
        'name'          => 'Home right sidebar',
        'id'            => 'sidebar_home_right',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget__title">',
        'after_title'   => '</h3>',
    ]);
}

add_action('widgets_init', 'themex_widgets_init');

/**
 * Disable the emoji's
 */
function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}

add_action('init', 'disable_emojis');

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param    array $plugins
 *
 * @return   array             Difference betwen the two arrays
 */
function disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, ['wpemoji']);
    } else {
        return [];
    }
}

/**
 * Enqueue scripts
 */
function themex_enqueue_scripts()
{
    if (!is_admin()) {
        wp_deregister_style('open-sans');
        wp_enqueue_style('themex-css', get_template_directory_uri() . '/assets/css/stylesheet.css', []);

        wp_deregister_script('jquery');
        wp_register_script('jquery', get_template_directory_uri() . '/assets/js/jquery.js', [], false, false);

        wp_enqueue_script('themex-bundle', get_template_directory_uri() . '/assets/js/bundle.js', ['jquery'], false,
            true);
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

/**
 * Make form fields work with bootstrap
 */
function themex_comment_form_fields($fields)
{
    $commenter = wp_get_current_commenter();

    $req      = get_option('require_name_email');
    $aria_req = ($req ? ' aria-required="true"' : '');
    $html5    = current_theme_supports('html5', 'comment-form') ? true : false;

    $fields = [
        'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __('Name') . ($req ? ' <span class="required">*</span>' : '') . '</label>' .
            '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></div>',
        'email'  => '<div class="form-group comment-form-email"><label for="email">' . __('Email') . ($req ? ' <span class="required">*</span>' : '') . '</label>' .
            '<input class="form-control" id="email" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></div>',
        'url'    => '<div class="form-group comment-form-url"><label for="url">' . __('Website') . '</label> ' .
            '<input class="form-control" id="url" name="url" ' . ($html5 ? 'type="url"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></div>',
    ];

    // Remove url field
    unset($fields['url']);

    return $fields;
}

add_filter('comment_form_default_fields', 'themex_comment_form_fields');

/**
 * Make comment form work with bootstrap
 */
function themex_comment_form_defaults($args)
{
    $args['comment_field'] = '<div class="form-group comment-form-comment">
            <label for="comment">' . _x('Comment', 'noun') . '</label>
            <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
        </div>';

    $args['class_submit'] = 'btn btn-primary'; // since WP 4.1

    return $args;
}

add_filter('comment_form_defaults', 'themex_comment_form_defaults');
