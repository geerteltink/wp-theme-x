<div class="container">
    <h1 class="site-title">
        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
    </h1>
    <?php
    $description = get_bloginfo('description', 'display');
    if ($description || is_customize_preview()) : ?>
        <p class="site-description"><?php echo $description; ?></p>
    <?php endif; ?>
</div>
