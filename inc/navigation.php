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
