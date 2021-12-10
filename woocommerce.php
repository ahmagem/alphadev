<?php 
/*
Template Name: WooCommerce
*/ 
?>
<?php

$woocommerce = startit_qode_return_woocommerce();

$id = get_option('woocommerce_shop_page_id');
$shop = get_post($id);
$sidebar = startit_qode_sidebar_layout();

if(get_post_meta($id, 'qode_page_background_color', true) != ''){
	$background_color = 'background-color: '.esc_attr(get_post_meta($id, 'qode_page_background_color', true));
}else{
	$background_color = '';
}

$content_style = '';
if(get_post_meta($id, 'qode_content-top-padding', true) != '') {
	if(get_post_meta($id, 'qode_content-top-padding-mobile', true) == 'yes') {
		$content_style = 'padding-top:'.esc_attr(get_post_meta($id, 'qode_content-top-padding', true)).'px !important';
	} else {
		$content_style = 'padding-top:'.esc_attr(get_post_meta($id, 'qode_content-top-padding', true)).'px';
	}
}

get_header();

get_template_part( 'title' );
get_template_part('slider');

$full_width = false;

if ( startit_qode_options()->getOptionValue('qodef_woo_products_list_full_width') == 'yes' && !is_singular('product') ) {
	$full_width = true;
}

if ( $full_width ) { ?>
	<div class="qodef-full-width" <?php startit_qode_inline_style($background_color); ?>>
<?php } else { ?>
	<div class="qodef-container" <?php startit_qode_inline_style($background_color); ?>>
<?php }
		if ( $full_width ) { ?>
			<div class="qodef-full-width-inner" <?php startit_qode_inline_style($content_style); ?>>
		<?php } else { ?>
			<div class="qodef-container-inner clearfix" <?php startit_qode_inline_style($content_style); ?>>
		<?php }

			//Woocommerce content
			if ( ! is_singular('product') ) {

				switch( $sidebar ) {

					case 'sidebar-33-right': ?>
						<div class="qodef-two-columns-66-33 grid2 qodef-content-has-sidebar qodef-woocommerce-with-sidebar clearfix">
							<div class="qodef-column1">
								<div class="qodef-column-inner">
									<?php startit_qode_woocommerce_content(); ?>
								</div>
							</div>
							<div class="qodef-column2">
								<?php get_sidebar();?>
							</div>
						</div>
					<?php
						break;
					case 'sidebar-25-right': ?>
						<div class="qodef-two-columns-75-25 grid2 qodef-content-has-sidebar qodef-woocommerce-with-sidebar clearfix">
							<div class="qodef-column1 qodef-content-left-from-sidebar">
								<div class="qodef-column-inner">
									<?php startit_qode_woocommerce_content(); ?>
								</div>
							</div>
							<div class="qodef-column2">
								<?php get_sidebar();?>
							</div>
						</div>
					<?php
						break;
					case 'sidebar-33-left': ?>
						<div class="qodef-two-columns-33-66 grid2 qodef-content-has-sidebar qodef-woocommerce-with-sidebar clearfix">
							<div class="qodef-column1">
								<?php get_sidebar();?>
							</div>
							<div class="qodef-column2">
								<div class="qodef-column-inner">
									<?php startit_qode_woocommerce_content(); ?>
								</div>
							</div>
						</div>
					<?php
						break;
					case 'sidebar-25-left': ?>
						<div class="qodef-two-columns-25-75 grid2 qodef-content-has-sidebar qodef-woocommerce-with-sidebar clearfix">
							<div class="qodef-column1">
								<?php get_sidebar();?>
							</div>
							<div class="qodef-column2 qodef-content-right-from-sidebar">
								<div class="qodef-column-inner">
									<?php startit_qode_woocommerce_content(); ?>
								</div>
							</div>
						</div>
					<?php
						break;
					default:
						startit_qode_woocommerce_content();
				}

			} else {
				startit_qode_woocommerce_content();
			} ?>

			</div>
	</div>
<?php get_footer(); ?>
