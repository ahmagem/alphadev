<?php $sidebar = startit_qode_sidebar_layout(); ?>
<?php get_header(); ?>

<?php get_template_part( 'title' ); ?>

	<div class="qodef-container">
		<?php do_action('qode_startit_after_container_open'); ?>
		<div class="qodef-container-inner clearfix">
			<div class="qodef-container">
				<?php do_action('qode_startit_after_container_open'); ?>
				<div class="qodef-container-inner" >
					<div class="qodef-blog-holder qodef-blog-type-standard">
				<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="qodef-post-content">
							<div class="qodef-post-text">
								<div class="qodef-post-text-inner">
									<h2>
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									</h2>
									<?php
										startit_qode_read_more_button();
									?>
								</div>
							</div>
						</div>
					</article>
					<?php endwhile; ?>
					<?php
						if( startit_qode_options()->getOptionValue('pagination') == 'yes') {
							startit_qode_pagination(startit_qode_get_blog_query());
						}
					?>
					<?php else: ?>
					<div class="entry">
						<p><?php esc_html_e('No posts were found.', 'startit'); ?></p>
					</div>
					<?php endif; ?>
				</div>
				<?php do_action('qode_startit_before_container_close'); ?>
			</div>
			</div>
		</div>
		<?php do_action('qode_startit_before_container_close'); ?>
	</div>
<?php get_footer(); ?>