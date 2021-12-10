<?php
/*
Template Name: Landing Page
*/
$sidebar = startit_qode_sidebar_layout();

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <?php startit_qode_wp_title(); ?>

        <?php
        /**
         * qode_startit_header_meta hook
         *
         * @see startit_qode_header_meta() - hooked with 10
         * @see qode_user_scalable_meta() - hooked with 10
         */
        do_action('qode_startit_header_meta');
        ?>

        <?php wp_head(); ?>
    </head>

<body <?php body_class(); ?>>

<div class="qodef-wrapper">
	<div class="qodef-wrapper-inner">
		<div class="qodef-content">
			<div class="qodef-content-inner">
				<?php get_template_part( 'title' ); ?>
				<?php get_template_part('slider');?>
				<div class="qodef-full-width">
					<div class="qodef-full-width-inner">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<?php if(($sidebar == 'default')||($sidebar == '')) : ?>
								<?php the_content(); ?>
								<?php do_action('qode_startit_page_after_content'); ?>
							<?php elseif($sidebar == 'sidebar-33-right' || $sidebar == 'sidebar-25-right'): ?>
								<div <?php echo startit_qode_sidebar_columns_class(); ?>>
									<div class="qodef-column1 qodef-content-left-from-sidebar">
										<div class="qodef-column-inner">
											<?php the_content(); ?>
											<?php do_action('qode_startit_page_after_content'); ?>
										</div>
									</div>
									<div class="qodef-column2">
										<?php get_sidebar(); ?>
									</div>
								</div>
							<?php elseif($sidebar == 'sidebar-33-left' || $sidebar == 'sidebar-25-left'): ?>
								<div <?php echo startit_qode_sidebar_columns_class(); ?>>
									<div class="qodef-column1">
										<?php get_sidebar(); ?>
									</div>
									<div class="qodef-column2 qodef-content-right-from-sidebar">
										<div class="qodef-column-inner">
											<?php the_content(); ?>
											<?php do_action('qode_startit_page_after_content'); ?>
										</div>
									</div>
								</div>
							<?php endif; ?>
						<?php endwhile; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>