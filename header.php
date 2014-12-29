<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php wp_title(); ?></title>
	<meta name="description" content="" />

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php if (is_singular() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply', false, array(), false, true);
	} ?>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<a class="skip-link sr-only" href="#content">Skip to content</a>

	<header class="header">
		<div class="container">
			<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
			<?php
			$description = get_bloginfo('description', 'display');
			if ($description || is_customize_preview()) : ?>
				<p class="site-description"><?php echo $description; ?></p>
			<?php endif; ?>

			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-navigation">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">Brand</a>
					</div>

					<?php if (has_nav_menu('primary')) {
						// Social links navigation menu.
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

				</div><!-- /.container-fluid -->
			</nav>

		</div>
	</header>

    <div id="content" class="content">
        <div class="container">
