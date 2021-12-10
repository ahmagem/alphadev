<?php
    /*
    Template Name: Blog: Standard Whole Post
    */
?>
<?php get_header(); ?>
<?php get_template_part( 'title' ); ?>
<?php get_template_part('slider'); ?>
    <div class="qodef-container">
        <?php do_action('qode_startit_after_container_open'); ?>
        <div class="qodef-container-inner">
            <?php startit_qode_get_blog('standard-whole-post'); ?>
        </div>
        <?php do_action('qode_startit_before_container_close'); ?>
    </div>
<?php get_footer(); ?>