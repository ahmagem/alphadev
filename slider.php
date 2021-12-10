<?php
$slider_shortcode = get_post_meta($id, "qodef_page_slider_meta", true);
if (!empty($slider_shortcode)) { ?>
	<div class="qodef-slider">
		<div class="qodef-slider-inner">
			<?php echo do_shortcode(wp_kses_post($slider_shortcode)); // XSS OK ?>
		</div>
	</div>
<?php } ?>