<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php if (is_singular() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply', false, array(), false, true);
	} ?>
	<?php wp_head(); ?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
</head>
<body <?php body_class(); ?>>
	<a class="skip-link sr-only" href="#content">Skip to content</a>

	<header class="header">
		<?php get_template_part('inc/header'); ?>
	</header>

	<div class="navbar-container">
		<nav class="navbar navbar-inverse navbar-primary container">
			<!-- Brand and toggle get grouped for better mobile display -->

			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-navigation">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
					<?php bloginfo('name'); ?>
				</a>
			</div>

			<?php if (has_nav_menu('primary')) {
				// Primary navigation menu
				wp_nav_menu(array(
					'theme_location'  => 'primary',
					'menu'            => 'primary',
					'container'       => 'div',
					'container_class' => 'collapse navbar-collapse',
					'container_id'    => 'primary-navigation',
					'menu_class'      => 'nav navbar-nav',
					'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
					'walker'          => new wp_bootstrap_navwalker()
				));
			} ?>

		</nav>
	</div>

    <div id="content" class="content">
        <div class="container">
