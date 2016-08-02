<nav class="navbar navbar-dark bg-inverse">
    <div class="container">
        <ul class="nav navbar-nav">
            <?php if (has_nav_menu('primary')) {
                wp_nav_menu(array(
                    'theme_location'  => 'primary',
                    'menu'            => 'primary',
                    'container'       => 'ul',
                    'container_id'    => 'primary-navigation',
                    'menu_class'      => 'nav navbar-nav',
                    'depth' => 1
                ));
            } ?>
        </ul>
    </div>
</nav>
