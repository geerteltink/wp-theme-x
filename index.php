<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php if (!is_singular() && is_active_sidebar('sidebar_home_right')) : ?>
        <div class="row">
            <div class="col-sm-8">
        <?php endif; ?>

        <?php
        if (have_posts()) {

			// Start the loop.
			while (have_posts()) : the_post();

                if (is_singular()) {
                    // Include the single post-format-specific template for the content.
                    // You can override this file by creating a file called content-<post-format>.php.
                    get_template_part('content', get_post_format());
                } else {
                    // Get the content-list. This is an extra template to list posts.
                    // It is not an official post format.
                    get_template_part('content', 'list');
                }

                // End the loop.
            endwhile;

            // Previous/next page navigation.
            themex_pagination();

        } else {
            // If no content, include the "No posts found" template.
            get_template_part('content', 'none');
        }
        ?>

        <?php if (!is_singular() && is_active_sidebar('sidebar_home_right')) : ?>
            </div>
            <div class="col-sm-4" role="complementary">
                <?php dynamic_sidebar('sidebar_home_right'); ?>
            </div>
        </div>
        <?php endif; ?>

    </main>
</div>

<?php get_footer(); ?>
