<?php

include_once get_template_directory().'/theme-includes.php';


if(!function_exists('startit-qode-theme_setup')) {
	/**
	 * Function that adds various features to theme. Also defines image sizes that are used in a theme
	 */
	function startit_qode_theme_setup() {
		//add support for feed links
		add_theme_support('automatic-feed-links');

		//add support for post formats
		add_theme_support('post-formats', array('gallery', 'link', 'quote', 'video', 'audio'));

		//add theme support for post thumbnails
		add_theme_support('post-thumbnails');

		//add theme support for title tag
		if(function_exists('_wp_render_title_tag')) {
			add_theme_support('title-tag');
		}

		//define thumbnail sizes
		add_image_size('qode_startit_square', 550, 550, true);
		add_image_size('qode_startit_landscape', 800, 600, true);
		add_image_size('qode_startit_portrait', 600, 800, true);
		add_image_size('qode_startit_large_width', 1000, 500, true);
		add_image_size('qode_startit_large_height', 500, 1000, true);
		add_image_size('qode_startit_large_width_height', 1000, 1000, true);

		add_filter('widget_text', 'do_shortcode');

		load_theme_textdomain( 'startit', get_template_directory().'/languages' );
	}

	add_action('after_setup_theme', 'startit_qode_theme_setup');
}


if(!function_exists( 'startit_qode_styles' )) {
    /**
     * Function that includes theme's core styles
     */
    function startit_qode_styles() {

	    global $wp_styles;
        $qode_startit_toolbar = startit_qode_return_toolbar();

        wp_register_style('startit-qode-blog', QODE_ASSETS_ROOT.'/css/blog.min.css');

        //include theme's core styles
        wp_enqueue_style('startit-qode-default-style', QODE_ROOT.'/style.css');
        wp_enqueue_style('startit-qode-modules-plugins', QODE_ASSETS_ROOT.'/css/plugins.min.css');
        wp_enqueue_style('startit-qode-modules', QODE_ASSETS_ROOT.'/css/modules.min.css');

	    wp_enqueue_style( 'startit-qode-ie9-style', QODE_ASSETS_ROOT . '/css/ie9_stylesheet.min.css' );
	    $wp_styles->add_data( 'startit-qode-ie9-style', 'conditional', 'IE 9' );

        startit_qode_icon_collections()->enqueueStyles();

        if(startit_qode_load_blog_assets()) {
            wp_enqueue_style('startit-qode-blog');
        }

        if( startit_qode_load_blog_assets() || is_singular('portfolio-item')) {
            wp_enqueue_style('wp-mediaelement');
        }

        //define files afer which style dynamic needs to be included. It should be included last so it can override other files
        $style_dynamic_deps_array = array();
        if(startit_qode_load_woo_assets()) {
            $style_dynamic_deps_array[] = 'startit-qode-woocommerce';
        }

        //is responsive option turned on?
        if(startit_qode_is_responsive_on()) {
            wp_enqueue_style('startit-qode-modules-responsive', QODE_ASSETS_ROOT.'/css/modules-responsive.min.css');
            wp_enqueue_style('startit-qode-blog-responsive', QODE_ASSETS_ROOT.'/css/blog-responsive.min.css');
            if(startit_qode_load_woo_assets()) {
                $style_dynamic_deps_array[] = 'startit-qode-woocommerce-responsive';
            }

	        //include proper styles
	        if ( file_exists(QODE_ASSETS_ROOT_DIR . "/css/style_dynamic_responsive.css") && startit_select_is_css_folder_writable() && !is_multisite()){
		        wp_enqueue_style("startit-qode-style-dynamic-responsive", QODE_ASSETS_ROOT . "/css/style_dynamic_responsive.css", array(), filemtime(QODE_ASSETS_ROOT_DIR . "/css/style_dynamic_responsive.css"));
	        } else if ( file_exists( QODE_ASSETS_ROOT_DIR . '/style_dynamic_responsive_ms_id_' . startit_select_get_multisite_blog_id() . '.css' ) && startit_select_is_css_folder_writable() && is_multisite() ) {

		        wp_enqueue_style( 'startit-qode-style-dynamic-responsive', QODE_ASSETS_ROOT . '/css/style_dynamic_responsive_ms_id_' . startit_select_get_multisite_blog_id() . '.css', array(), filemtime( QODE_ASSETS_ROOT_DIR . '/css/style_dynamic_responsive_ms_id_' . startit_select_get_multisite_blog_id() . '.css' ) );
	        } else {
		        wp_enqueue_style("startit-qode-style-dynamic-responsive", QODE_ASSETS_ROOT . "/css/style_dynamic_responsive_callback.php");
	        }
        }


	    if ( file_exists(QODE_ASSETS_ROOT_DIR . "/css/style_dynamic.css") && startit_select_is_css_folder_writable() && !is_multisite()) {
		    wp_enqueue_style("startit-qode-style-dynamic", QODE_ASSETS_ROOT . "/css/style_dynamic.css", $style_dynamic_deps_array, filemtime(QODE_ASSETS_ROOT_DIR . "/css/style_dynamic.css") ); //it must be included after woocommerce styles so it can override it
	    } else if ( file_exists( QODE_ASSETS_ROOT_DIR . '/style_dynamic_ms_id_' . startit_select_get_multisite_blog_id() . '.css' ) && startit_select_is_css_folder_writable() && is_multisite() ) {
		    wp_enqueue_style( 'startit-qode-style-dynamic', QODE_ASSETS_ROOT . '/css/style_dynamic_ms_id_' . startit_select_get_multisite_blog_id() . '.css', array(), filemtime(QODE_ASSETS_ROOT_DIR . '/css/style_dynamic_ms_id_' . startit_select_get_multisite_blog_id() . '.css') );
	    } else {
		    wp_enqueue_style("startit-qode-style-dynamic", QODE_ASSETS_ROOT . "/css/style_dynamic_callback.php", $style_dynamic_deps_array); //it must be included after woocommerce styles so it can override it
	    }

        //is toolbar turned on?
        if (isset($qode_startit_toolbar)) {
            //include toolbar specific styles
            wp_enqueue_style("startit-qode-toolbar", get_home_url() . "/toolbar/toolbar.css");

        }

        //include Visual Composer styles
        if(class_exists('WPBakeryVisualComposerAbstract')) {
            wp_enqueue_style('js_composer_front');
        }
    }

    add_action('wp_enqueue_scripts', 'startit_qode_styles');
}

if(!function_exists( 'startit_qode_google_fonts_styles' )) {
    /**
     * Function that includes google fonts defined anywhere in the theme
     */
    function startit_qode_google_fonts_styles() {
        $font_simple_field_array = startit_qode_options()->getOptionsByType('fontsimple');
        if(!(is_array($font_simple_field_array) && count($font_simple_field_array) > 0)) {
            $font_simple_field_array = array();
        }

        $font_field_array = startit_qode_options()->getOptionsByType('font');
        if(!(is_array($font_field_array) && count($font_field_array) > 0)) {
            $font_field_array = array();
        }

        $available_font_options = array_merge($font_simple_field_array, $font_field_array);
        $font_weight_str        = '100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';

        //define available font options array
        $fonts_array = array();
        foreach($available_font_options as $font_option) {
            //is font set and not set to default and not empty?
            $font_option_value = startit_qode_options()->getOptionValue($font_option);
            if( startit_qode_is_font_option_valid($font_option_value) && !startit_qode_is_native_font($font_option_value)) {
                $font_option_string = $font_option_value.':'.$font_weight_str;
                if(!in_array($font_option_string, $fonts_array)) {
                    $fonts_array[] = $font_option_string;
                }
            }
        }

        wp_reset_postdata();

        $fonts_array         = array_diff($fonts_array, array('-1:'.$font_weight_str));
        $google_fonts_string = implode('|', $fonts_array);

	    $protocol = is_ssl() ? 'https:' : 'http:';

	    //default fonts should be separated with %7C because of HTML validation
	    $default_font_family = array(
		    'Raleway',
	    );

	    $modified_default_font_family = array();
	    foreach ( $default_font_family as $default_font ) {
		    $modified_default_font_family[] = $default_font . ':' . str_replace( ' ', '', $font_weight_str );
	    }

	    //default fonts should be separated with %7C because of HTML validation
	    $default_font_string = implode( '|', $modified_default_font_family );

        //is google font option checked anywhere in theme?
        if (count($fonts_array) > 0) {

            //include all checked fonts
            $fonts_full_list = $default_font_string . '|' . str_replace('+', ' ', $google_fonts_string);
            $fonts_full_list_args = array(
                'family' => urlencode($fonts_full_list),
                'subset' => urlencode('latin,latin-ext'),
            );

            $qode_startit_fonts = add_query_arg( $fonts_full_list_args, $protocol . '//fonts.googleapis.com/css' );
            wp_enqueue_style( 'startit-qode-google-fonts', esc_url_raw($qode_startit_fonts), array(), '1.0.0' );

        } else {
            //include default google font that theme is using
            $default_fonts_args = array(
                'family' => urlencode($default_font_string),
                'subset' => urlencode('latin,latin-ext'),
            );
            $qode_startit_fonts = add_query_arg( $default_fonts_args, $protocol . '//fonts.googleapis.com/css' );
            wp_enqueue_style( 'startit-qode-google-fonts', esc_url_raw($qode_startit_fonts), array(), '1.0.0' );
        }

    }

    add_action('wp_enqueue_scripts', 'startit_qode_google_fonts_styles');
}

/*Because of the bug when Revolution slider, Layer Slider and Smooth Scroll are enabled together (greensock.js doesn't have included ScrollTo so it need to be included before)*/

if(!function_exists( 'startit_qode_scrollto_script' )) {

    function startit_qode_scrollto_script(){
        wp_enqueue_script('scrollto', QODE_ASSETS_ROOT . '/js/modules/plugins/scrolltoplugin.min.js', array("jquery"), false, false);
    }

    add_action('wp_enqueue_scripts', 'startit_qode_scrollto_script', 1);

}

if(!function_exists( 'startit_qode_scripts' )) {
    /**
     * Function that includes all necessary scripts
     */
    function startit_qode_scripts() {
        global $wp_scripts;
        $startit_qode_toolbar = startit_qode_return_toolbar();

        //init theme core scripts
        wp_enqueue_script( 'jquery-ui-core');
        wp_enqueue_script( 'jquery-ui-tabs');
        wp_enqueue_script( 'jquery-ui-accordion');
        wp_enqueue_script( 'wp-mediaelement');
        wp_enqueue_script( 'jquery-ui-slider');


	    wp_enqueue_script('appear', QODE_ASSETS_ROOT.'/js/modules/plugins/jquery.appear.js', array('jquery'), false, true);
        wp_enqueue_script('modernizr', QODE_ASSETS_ROOT.'/js/modules/plugins/modernizr.js', array('jquery'), false, true);
	    wp_enqueue_script( 'hoverIntent' );
        wp_enqueue_script('jquery-plugin', QODE_ASSETS_ROOT.'/js/modules/plugins/jquery.plugin.js', array('jquery'), false, true);
        wp_enqueue_script('countdown', QODE_ASSETS_ROOT.'/js/modules/plugins/jquery.countdown.min.js', array('jquery'), false, true);
        wp_enqueue_script('owl', QODE_ASSETS_ROOT.'/js/modules/plugins/owl.carousel.min.js', array('jquery'), false, true);
        wp_enqueue_script('parallax', QODE_ASSETS_ROOT.'/js/modules/plugins/parallax.min.js', array('jquery'), false, true);
        wp_enqueue_script("select2");
        wp_enqueue_script('easypiechart', QODE_ASSETS_ROOT.'/js/modules/plugins/easypiechart.js', array('jquery'), false, true);
        wp_enqueue_script('waypoints', QODE_ASSETS_ROOT.'/js/modules/plugins/jquery.waypoints.min.js', array('jquery'), false, true);
        wp_enqueue_script('chart', QODE_ASSETS_ROOT.'/js/modules/plugins/Chart.min.js', array('jquery'), false, true);
        wp_enqueue_script('counter', QODE_ASSETS_ROOT.'/js/modules/plugins/counter.js', array('jquery'), false, true);
        wp_enqueue_script('fluidvids', QODE_ASSETS_ROOT.'/js/modules/plugins/fluidvids.min.js', array('jquery'), false, true);
        wp_enqueue_script('prettyPhoto', QODE_ASSETS_ROOT.'/js/modules/plugins/jquery.prettyPhoto.js', array('jquery'), false, true);
        wp_enqueue_script('nicescroll', QODE_ASSETS_ROOT.'/js/modules/plugins/jquery.nicescroll.min.js', array('jquery'), false, true);
        wp_enqueue_script('TweenLite', QODE_ASSETS_ROOT.'/js/modules/plugins/TweenLite.min.js', array('jquery'), false, true);
        wp_enqueue_script('mixitup', QODE_ASSETS_ROOT.'/js/modules/plugins/jquery.mixitup.min.js', array('jquery'), false, true);
        wp_enqueue_script('waitforimages', QODE_ASSETS_ROOT.'/js/modules/plugins/jquery.waitforimages.js', array('jquery'), false, true);
        wp_enqueue_script('infinitescroll', QODE_ASSETS_ROOT.'/js/modules/plugins/jquery.infinitescroll.min.js', array('jquery'), false, true);
        wp_enqueue_script('jquery-easing', QODE_ASSETS_ROOT.'/js/modules/plugins/jquery.easing.1.3.js', array('jquery'), false, true);
        wp_enqueue_script('particles', QODE_ASSETS_ROOT.'/js/modules/plugins/particles.min.js', array('jquery'), false, true);
        wp_enqueue_script('skrollr', QODE_ASSETS_ROOT.'/js/modules/plugins/skrollr.js', array('jquery'), false, true);
        wp_enqueue_script('bootstrapCarousel', QODE_ASSETS_ROOT.'/js/modules/plugins/bootstrapCarousel.js', array('jquery'), false, true);
        wp_enqueue_script('touchSwipe', QODE_ASSETS_ROOT.'/js/modules/plugins/jquery.touchSwipe.min.js', array('jquery'), false, true);
        wp_enqueue_script('absoluteCounter', QODE_ASSETS_ROOT.'/js/modules/plugins/absoluteCounter.min.js', array('jquery'), false, true);
        wp_enqueue_script('draggable', QODE_ASSETS_ROOT.'/js/modules/plugins/jquery.draggable.min.js', array('jquery'), false, true);
        wp_enqueue_script('touchpunch', QODE_ASSETS_ROOT.'/js/modules/plugins/jquery.touchpunch.min.js', array('jquery'), false, true);

        wp_enqueue_script('isotope', QODE_ASSETS_ROOT.'/js/modules/plugins/jquery.isotope.min.js', array('jquery'), false, true);

        if(startit_qode_is_smoth_scroll_enabled()) {
            wp_enqueue_script("startit-qode-smooth-page-scroll", QODE_ASSETS_ROOT . "/js/modules/plugins/smoothPageScroll.js", array('jquery'), false, true);
        }

        //include google map api script
        if( startit_qode_options()->getOptionValue('google_maps_api_key') != '') {
            $google_maps_api_key = startit_qode_options()->getOptionValue('google_maps_api_key');
            wp_enqueue_script('google_map_api', '//maps.googleapis.com/maps/api/js?key=' . $google_maps_api_key, array('jquery'), false, true);
        }

        //wp_enqueue_script('qode_default', QODE_ASSETS_ROOT.'/js/default.js', array(), false, true);
        wp_enqueue_script('startit-qode-modules', QODE_ASSETS_ROOT.'/js/modules.min.js', array('jquery'), false, true);

        if(startit_qode_load_blog_assets()) {
            wp_enqueue_script('startit-qode-blog', QODE_ASSETS_ROOT.'/js/blog.min.js', array('jquery'), false, true);
        }

        //include comment reply script
        $wp_scripts->add_data('comment-reply', 'group', 1);
        if(is_singular()) {
            wp_enqueue_script("comment-reply");
        }

        //include Visual Composer script
        if(class_exists('WPBakeryVisualComposerAbstract')) {
            wp_enqueue_script('wpb_composer_front_js');
        }

        if(isset($startit_qode_toolbar)){
            wp_enqueue_script("$startit_qode_toolbar", get_home_url() . "/toolbar/toolbar.js",array("jquery"),false,true);
        }
    }

    add_action('wp_enqueue_scripts', 'startit_qode_scripts');
}


if(!function_exists( 'startit_qode_get_global_variables' )) {
	/**
	 * Function that generates global variables and put them in array so they could be used in the theme
	 */
	function startit_qode_get_global_variables() {

		$global_variables = array();
		$element_appear_amount = -150;

		$global_variables['qodefAddForAdminBar'] = is_admin_bar_showing() ? 32 : 0;
		$global_variables['qodefElementAppearAmount'] = startit_qode_options()->getOptionValue('element_appear_amount') !== '' ? startit_qode_options()->getOptionValue('element_appear_amount') : $element_appear_amount;
		$global_variables['qodefFinishedMessage'] = esc_html__('No more posts', 'startit');
		$global_variables['qodefMessage'] = esc_html__('Loading new posts...', 'startit');

		$global_variables = apply_filters('qode_startit_js_global_variables', $global_variables);

		wp_localize_script('startit-qode-modules', 'qodefGlobalVars', array(
			'vars' => $global_variables
		));

	}

	add_action('wp_enqueue_scripts', 'startit_qode_get_global_variables');
}

if(!function_exists( 'startit_qode_per_page_js_variables' )) {
	function startit_qode_per_page_js_variables() {
		$per_page_js_vars = apply_filters('qode_startit_per_page_js_vars', array());

		wp_localize_script('startit-qode-modules', 'qodefPerPageVars', array(
			'vars' => $per_page_js_vars
		));
	}

	add_action('wp_enqueue_scripts', 'startit_qode_per_page_js_variables');
}

if ( ! function_exists( 'startit_qode_is_gutenberg_installed' ) ) {
	/**
	 * Function that checks if Gutenberg plugin installed
	 * @return bool
	 */
	function startit_qode_is_gutenberg_installed() {
		return function_exists( 'is_gutenberg_page' ) && is_gutenberg_page();
	}
}

if ( ! function_exists( 'startit_qode_is_wp_gutenberg_installed' ) ) {
	/**
	 * Function that checks if WordPress 5.x with Gutenberg editor installed
	 * @return bool
	 */
	function startit_qode_is_wp_gutenberg_installed() {
		return class_exists( 'WP_Block_Type' );
	}
}

if( ! function_exists('startit_qode_is_elementor_installed') ){
	function startit_qode_is_elementor_installed(){
		return defined('ELEMENTOR_VERSION');
	}
}

if( ! function_exists( 'startit_qode_is_theme_registered' ) ) {
	function startit_qode_is_theme_registered() {
		if( function_exists( 'select_core_is_theme_registered' ) ){
			return select_core_is_theme_registered();
		} else {
			return false;
		}
	}
}

if( ! function_exists( 'startit_qode_add_registration_admin_notice' ) ) {
	function startit_qode_add_registration_admin_notice() {
		if( startit_qode_core_installed() &&  ! startit_qode_is_theme_registered() ) {
			?>
			<div class="error">
				<p>
					<?php
					echo wp_kses_post( sprintf(
						__( 'Your copy of the theme has not been activated. Please navigate to <a href="%s">Startit Dashboard</a> where you can input your purchase code and activate your copy of the theme so you can have access to all the theme features, elements & options.', 'startit' ),
						admin_url('admin.php?page=qodef_core_dashboard')
					) );
					?>
				</p>
			</div>
			<?php
		}
	}

	add_action('admin_notices', 'startit_qode_add_registration_admin_notice');
}
