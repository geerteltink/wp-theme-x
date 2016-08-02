<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="row">
            <div class="col-sm">
                <section class="error-404 not-found">
                    <header class="page-header">
                        <h1 class="page-title"><?php _e('Oops! That page can&rsquo;t be found.', 'themex'); ?></h1>
                    </header>

                    <div class="page-content">
                        <p><?php _e('It looks like nothing was found at this location. Maybe try a search?',
                                'themex'); ?></p>
                        <?php get_search_form(); ?>
                    </div>
                </section>
            </div>

            <?php if (!is_singular() && is_active_sidebar('sidebar_home_right')) : ?>
                <div class="col-sm-4" role="complementary">
                    <?php dynamic_sidebar('sidebar_home_right'); ?>
                </div>
            <?php endif; ?>
        </div>
    </main>
</div>

<?php get_footer(); ?>
