<?php get_header(); ?>
<?php get_template_part( 'title' ); ?>
<?php $result = startit_qode_blog_archive_pages_classes(startit_qode_get_default_blog_list()); ?>
<div class="<?php startit_qode_module_part($result['holder']); ?>">
<?php do_action('qode_startit_after_container_open'); ?>
	<div class="<?php startit_qode_module_part($result['inner']); ?>">
		<?php startit_qode_get_blog(startit_qode_get_default_blog_list()); ?>
	</div>
<?php do_action('qode_startit_before_container_close'); ?>
</div>
<?php get_footer(); ?>