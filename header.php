<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php startit_qode_wp_title(); ?>
    <?php
    /**
     * @see startit_qode_header_meta() - hooked with 10
     * @see qode_user_scalable - hooked with 10
     */
    ?>
	<?php do_action('qode_startit_header_meta'); ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php startit_qode_get_side_area(); ?>

<div class="qodef-wrapper">
    <div class="qodef-wrapper-inner">
        <?php startit_qode_get_header(); ?>

        <?php if( startit_qode_options()->getOptionValue('show_back_button') == "yes") { ?>
            <a id='qodef-back-to-top'  href='#'>
                <span class="qodef-icon-stack">
                     <?php
                        startit_qode_icon_collections()->getBackToTopIcon('font_awesome');
                    ?>
                </span>
            </a>
        <?php } ?>
        <?php startit_qode_get_full_screen_menu(); ?>

        <div class="qodef-content" <?php startit_qode_content_elem_style_attr(); ?>>
 <div class="qodef-content-inner">