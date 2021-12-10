<?php
    $use_live_search = startit_qode_return_use_live_search();
    $use_live_search = ($use_live_search) ? '' : ' no-livesearch';
?>
<form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url( '/' )); ?>">
    <div><label class="screen-reader-text" for="s"><?php esc_html_e( 'Search for:', 'startit' ); ?></label>
        <input class="<?php echo esc_attr($use_live_search);?>" type="text" value="" placeholder="<?php esc_attr_e('Search', 'startit'); ?>" name="s" id="s" />
        <?php if($use_live_search) { ?>
            <i class="ion-ios-search-strong"></i>
        <?php } else { ?>
            <input type="submit" id="searchsubmit" value="&#xf002;" />
        <?php } ?>
    </div>
</form>