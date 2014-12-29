<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

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

    </main>
</div>

<?php get_footer(); ?>
