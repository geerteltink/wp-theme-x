        </div>
    </div>

    <footer id="colophon" class="footer" role="contentinfo">
        <div class="container footer__site">
            <div class="row">
                <div class="col-md-6">

                    <?php if (has_nav_menu('social')) {
                        // Social links navigation menu.
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
                    Developed by <a href="http://twitter.com/xtreamwayz">@xtreamwayz</a>
                </div>
            </div>
        </div>
    </footer><!-- #colophon -->

	<?php wp_footer(); ?>
    <script type="text/javascript" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/js/plugins.js"></script>
</body>
</html>
