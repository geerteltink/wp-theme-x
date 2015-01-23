<form method="get" id="searchform" class="searchform" action="<?php echo esc_url(home_url('/')); ?>" role="search">
    <div class="input-group">
        <input type="text" class="form-control" name="s" value="<?php echo get_search_query(); ?>" id="s" placeholder="<?php echo esc_attr_x('Search ...', 'placeholder') ?>">
        <span class="input-group-btn">
            <button class="btn btn-primary" id="searchsubmit" type="button">
                <?php echo esc_attr_x('Search', 'submit button'); ?>
            </button>
        </span>
    </div>
</form>
