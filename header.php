<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="developer" content="@XtreamWayz" />
    <link rel="developer" href="https://xtreamwayz.github.io/" />
    <?php if (is_singular() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply', false, [], false, true);
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

    <?php get_template_part('inc/navigation'); ?>

    <?php get_template_part('inc/banner'); ?>

    <div id="content" class="content">
        <div class="container">
