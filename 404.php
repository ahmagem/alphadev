<?php get_header(); ?>

	<?php get_template_part( 'title' ); ?>

	<div class="qodef-container">
	<?php do_action('qode_startit_after_container_open'); ?>
		<div class="qodef-container-inner qodef-404-page">
			<div class="qodef-page-not-found">
				<h2>
					<?php if(startit_qode_options()->getOptionValue('404_title')){
						echo esc_html(startit_qode_options()->getOptionValue('404_title'));
					}
					else{
						esc_html_e('Page you are looking for is not found', 'startit');
					} ?>
				</h2>
				<h4>
					<?php if(startit_qode_options()->getOptionValue('404_text')){
						echo esc_html(startit_qode_options()->getOptionValue('404_text'));
					}
					else{
						esc_html_e('The page you are looking for does not exist. It may have been moved, or removed altogether. Perhaps you can return back to the site\'s homepage and see if you can find what you are looking for.', 'startit');
					} ?>
				</h4>
				<?php
					$params = array();
					if (startit_qode_options()->getOptionValue('404_back_to_home')){
						$params['text'] = startit_qode_options()->getOptionValue('404_back_to_home');
					}
					else{
						$params['text'] = "Back to Home Page";
					}
					$params['link'] = esc_url(home_url('/'));
					$params['target'] = '_self';
				echo startit_qode_execute_shortcode('qodef_button',$params);?>
			</div>
		</div>
		<?php do_action('qode_startit_before_container_close'); ?>
	</div>
<?php get_footer(); ?>