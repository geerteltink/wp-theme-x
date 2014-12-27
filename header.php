<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?php wp_title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" href="//www.google.com/fonts#ReviewPlace:refine/Collection:Noto+Serif:400,700,400italic,700italic" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/css/stylesheet.css" type="text/css" media="all" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php if (is_singular() && get_option('thread_comments')) { wp_enqueue_script('comment-reply'); } ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<a class="skip-link sr-only" href="#content">Skip to content</a>

	<header class="header">
		<div class="container">
			HEADER
		</div>
	</header>

    <div id="content" class="content">
        <div class="container">
