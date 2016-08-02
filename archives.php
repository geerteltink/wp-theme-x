<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php the_post(); ?>
        <header class="page-header">
            <?php
            the_archive_title('<h1 class="page-title">', '</h1>');
            the_archive_description('<div class="taxonomy-description">', '</div>');
            ?>
        </header>

        <?php get_search_form(); ?>

        <div class="row">
            <div class="col-md-6">
                <h2><?php _e('Archives by Year', 'twentyeleven'); ?>:</h2>
                <ul class="list-inline">
                    <?php wp_get_archives(['type' => 'yearly']); ?>
                </ul>
            </div>
            <div class="col-md-6">
                <h2><?php _e('Archives by Subject', 'twentyeleven'); ?>:</h2>
                <ul class="list-inline">
                    <?php wp_list_categories(['hierarchical' => false, 'depth' => 1, 'title_li' => '']); ?>
                </ul>
            </div>
        </div>
    </main>
</div>

<?php get_footer(); ?>
