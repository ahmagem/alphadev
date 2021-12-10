<?php get_header(); ?>
<?php get_template_part( 'title' ); ?>
	<div class="qodef-container">
		<?php do_action('qode_startit_after_container_open'); ?>
		<div class="qodef-container-inner clearfix">
			<?php startit_qode_get_blog(startit_qode_get_default_blog_list()); ?>
		</div>
		<?php do_action('qode_startit_before_container_close'); ?>
	</div>
<?php get_footer(); ?>