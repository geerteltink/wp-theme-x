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
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
					<?php bloginfo('name'); ?>
				</a>
			</div>

			<div class="collapse navbar-collapse">
				<?php if (has_nav_menu('primary')) {
					// Primary navigation menu
					wp_nav_menu(array(
						'theme_location'  => 'primary',
						'menu'            => 'primary',
						'container'       => 'ul',
						'container_id'    => 'primary-navigation',
						'menu_class'      => 'nav navbar-nav',
						'fallback_cb'     => 'Themex_Nav_Walker::fallback',
						'walker'          => new Themex_Nav_Walker()
					));
				} ?>
				<ul class="nav navbar-nav navbar-right">
				<?php if (is_user_logged_in()) : ?>
					<?php if (is_super_admin()) : ?>
					<li>
						<a href="<?php echo admin_url(); ?>" title="Dashboard">
							<i class="glyphicon glyphicon-dashboard"></i> <span class="visible-xs-inline-block">Dashboard</span>
						</a>
					</li>
					<?php endif; ?>
					<li>
						<a href="<?php echo wp_logout_url(); ?>" title="Logout">
							<i class="glyphicon glyphicon-log-out"></i> <span class="visible-xs-inline-block">Logout</span>
						</a>
					</li>
				<?php else : ?>
					<li>
						<a href="<?php echo wp_login_url(); ?>" title="Login">
							<i class="glyphicon glyphicon-log-in"></i> <span class="visible-xs-inline-block">Login</span>
						</a>
					</li>
				<?php endif; ?>
				</ul>
			</div>
		</nav>
	</div>

    <div id="content" class="content">
        <div class="container">
