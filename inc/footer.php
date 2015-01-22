<div class="container footer__site">
    <div class="row">
        <div class="col-md-6">
            <?php if (has_nav_menu('social')) {
                // Social links navigation menu
                wp_nav_menu( array(
                    'theme_location'  => 'social',
                    'menu'            => '',
                    'container'       => 'nav',
                    'container_class' => 'social-navigation',
                    'container_id'    => 'social-navigation',
                    'menu_class'      => 'list-inline',
                    'menu_id'         => '',
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu',
                    'before'          => '',
                    'after'           => '',
                    'link_before'     => '<span class="screen-reader-text">',
                    'link_after'      => '</span>',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 1,
                    'walker'          => ''
                ) );
            } ?>
        </div>
        <div class="col-md-6 text-right">
            <a href="https://github.com/xtreamwayz/wp-theme-x">Theme X</a> is developed by
            <a href="http://xtreamwayz.github.io/">@XtreamWayz</a>
        </div>
    </div>
</div>
