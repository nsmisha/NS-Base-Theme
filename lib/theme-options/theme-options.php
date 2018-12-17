<?php

// Resource: https://gist.github.com/claudiosanches/4185152

/**
 * Theme options.
 */
$neversettle_options_name       = __( 'Theme Options', 'neversettle' );
$neversettle_options_url        = 'theme-options';
$neversettle_options_capability = 'manage_options';

/**
 * Calls theme options functons.
 */
require_once get_template_directory() . '/lib/theme-options/theme-options-functions.php';
// Use this for a child theme
//require_once get_stylesheet_directory() . '/lib/theme-options/theme-options-functions.php';

/**
 * Add theme options menu page.
 *
 * References:
 * add_theme_page: http://codex.wordpress.org/Function_Reference/add_theme_page
 * add_submenu_page: http://codex.wordpress.org/Function_Reference/add_submenu_page
 * Capability: http://codex.wordpress.org/Roles_and_Capabilities
 */
function neversettle_theme_menu() {
	global $neversettle_options_name, $neversettle_options_url, $neversettle_options_capability;
	add_menu_page(
		$neversettle_options_name,       // Page title
		$neversettle_options_name,       // Menu title
		$neversettle_options_capability, // Capability
		$neversettle_options_url,        // Menu slug
		'neversettle_theme_display'      // Function
	);
}

add_action( 'admin_menu', 'neversettle_theme_menu' );

/**
 * Display Options
 */
function neversettle_theme_display() {
	global $neversettle_options_name, $neversettle_options_url;
	$current_tab = '';
	
	if ( isset( $_GET['tab'] ) ) {
		$current_tab = $_GET['tab'];
	} else {
		$current_tab = 'general';
	}
	
	?>
    <div id="ns_theme_options" class="wrap">
        <div id="icon-themes" class="icon32"></div>
        <h2 class="nav-tab-wrapper">
            <a href="?page=<?php echo $neversettle_options_url; ?>&amp;tab=general"
               class="nav-tab <?php echo $current_tab == 'general' ? 'nav-tab-active' : ''; ?>">
				<?php _e( 'General Settings', 'neversettle' ); ?>
            </a>
            <a href="?page=<?php echo $neversettle_options_url; ?>&amp;tab=typography"
               class="nav-tab <?php echo $current_tab == 'typography' ? 'nav-tab-active' : ''; ?>">
				<?php _e( 'Typography', 'neversettle' ); ?>
            </a>
        </h2>
		<?php settings_errors(); ?>
        <form method="post" action="options.php">
			<?php
			if ( $current_tab == 'typography' ) {
				settings_fields( 'neversettle_typography' );
				do_settings_sections( 'neversettle_typography' );
			} else {
				settings_fields( 'neversettle_general' );
				do_settings_sections( 'neversettle_general' );
			}
			
			submit_button();
			?>
        </form>
    </div><!-- .wrap -->
	<?php
}

/**
 * References:
 * add_settings_section: http://codex.wordpress.org/Function_Reference/add_settings_section
 * add_settings_field: http://codex.wordpress.org/Function_Reference/add_settings_field
 * register_setting: http://codex.wordpress.org/Function_Reference/register_setting
 */
function neversettle_initialize_theme_options() {
	$option = 'neversettle_general';
	
	// Create option in wp_options
	if ( false == get_option( $option ) ) {
		add_option( $option );
	}
	
	// General Section
	
	// Title
	add_settings_section(
		'general_settings_section',
		__( 'General', 'neversettle' ),
		'__return_false',
		$option
	);
	
	// Upload Field
	add_settings_field(
		'favicon_ico',
		__( 'Favicon', 'neversettle' ),
		'neversettle_upload_element_callback',
		$option,
		'general_settings_section',
		array(
			'menu'    => $option,
			'id'      => 'fav_ico',
			'default' => ''
		)
	);
	
	// Favicon Preview
	add_settings_field(
		'favicon_preview',
		__( 'Favicon Preview', 'neversettle' ) . '<span>Recommended Size: [200]x[200]px</span>',
		'neversettle_image_preview_callback',
		$option,
		'general_settings_section',
		array(
			'menu'    => $option,
			'id'      => 'fav_preview',
			'related' => 'fav_ico',
			'default' => ''
		)
	);
	
	// Upload Small icon (logo)
	add_settings_field(
		'small_logo_ico',
		__( 'Small Icon', 'neversettle' ),
		'neversettle_upload_element_callback',
		$option,
		'general_settings_section',
		array(
			'menu'        => $option,
			'id'          => 'small_icon',
			'default'     => '',
			'description' => 'When header shrinks'
		)
	);
	
	// Small Icon Preview
	add_settings_field(
		'small_logo_preview',
		__( 'Small Icon Preview', 'neversettle' ) . '<span>Recommended Size: [##]x[##]px</span>',
		'neversettle_image_preview_callback',
		$option,
		'general_settings_section',
		array(
			'menu'    => $option,
			'id'      => 'small_icon_preview',
			'related' => 'small_icon',
			'default' => ''
		)
	);
	
	// Register settings
	register_setting( $option, $option, 'neversettle_validate_input' );
	
}

add_action( 'admin_init', 'neversettle_initialize_theme_options' );

/**
 * Typography
 */
function neversettle_initialize_theme_typography() {
	$option  = 'neversettle_typography';
	$section = 'typography_settings_section';
	
	// Create option in wp_options
	if ( false == get_option( $option ) ) {
		add_option( $option );
	}
	
	// Add text
	add_settings_section(
		$section,
		__( 'Typography Settings', 'neversettle' ),
		'__return_false',
		$option
	);
	
	// Add font size
	add_settings_field(
		'h1_size',
		__( 'h1 Font Size', 'neversettle' ),
		'neversettle_text_element_callback',
		$option,
		$section,
		array(
			'menu'    => $option,
			'id'      => 'h1_size',
			'default' => '32',
			'after'   => 'px'
		)
	);
	
	// Add color picker
	add_settings_field(
		'h1_color',
		__( 'h1 Font Color', 'neversettle' ),
		'neversettle_color_element_callback',
		$option,
		$section,
		array(
			'menu'    => $option,
			'id'      => 'h1_color',
			'default' => '#CC0000'
		)
	);
	
	// Add Font Select
	add_settings_field(
		'h1_font',
		__( 'h1 Font Family', 'neversettle' ),
		'neversettle_select_font_callback',
		$option,
		$section,
		array(
			'menu'      => $option,
			'id'        => 'h1_font',
			'separator' => '1'
		)
	);
	
	/*********************************************************************/
	
	// Add font size
	add_settings_field(
		'h2_size',
		__( 'h2 Font Size', 'neversettle' ),
		'neversettle_text_element_callback',
		$option,
		$section,
		array(
			'menu'    => $option,
			'id'      => 'h2_size',
			'default' => '28',
			'after'   => 'px'
		)
	);
	
	// Add color picker
	add_settings_field(
		'h2_color',
		__( 'h2 Font Color', 'neversettle' ),
		'neversettle_color_element_callback',
		$option,
		$section,
		array(
			'menu'    => $option,
			'id'      => 'h2_color',
			'default' => '#CC0000'
		)
	);
	
	// Add Font Select
	add_settings_field(
		'h2_font',
		__( 'h2 Font Family', 'neversettle' ),
		'neversettle_select_font_callback',
		$option,
		$section,
		array(
			'menu'      => $option,
			'id'        => 'h2_font',
			'separator' => '1'
		)
	);
	
	/*********************************************************************/
	
	// Add font size
	add_settings_field(
		'h3_size',
		__( 'h3 Font Size', 'neversettle' ),
		'neversettle_text_element_callback',
		$option,
		$section,
		array(
			'menu'    => $option,
			'id'      => 'h3_size',
			'default' => '24',
			'after'   => 'px'
		)
	);
	
	// Add color picker
	add_settings_field(
		'h3_color',
		__( 'h3 Font Color', 'neversettle' ),
		'neversettle_color_element_callback',
		$option,
		$section,
		array(
			'menu'    => $option,
			'id'      => 'h3_color',
			'default' => '#CC0000'
		)
	);
	
	// Add Font Select
	add_settings_field(
		'h3_font',
		__( 'h3 Font Family', 'neversettle' ),
		'neversettle_select_font_callback',
		$option,
		$section,
		array(
			'menu'      => $option,
			'id'        => 'h3_font',
			'separator' => '1'
		)
	);
	
	/*********************************************************************/
	
	// Add font size
	add_settings_field(
		'h4_size',
		__( 'h4 Font Size', 'neversettle' ),
		'neversettle_text_element_callback',
		$option,
		$section,
		array(
			'menu'    => $option,
			'id'      => 'h4_size',
			'default' => '20',
			'after'   => 'px'
		)
	);
	
	// Add color picker
	add_settings_field(
		'h4_color',
		__( 'h4 Font Color', 'neversettle' ),
		'neversettle_color_element_callback',
		$option,
		$section,
		array(
			'menu'    => $option,
			'id'      => 'h4_color',
			'default' => '#CC0000'
		)
	);
	
	// Add Font Select
	add_settings_field(
		'h4_font',
		__( 'h4 Font Family', 'neversettle' ),
		'neversettle_select_font_callback',
		$option,
		$section,
		array(
			'menu'      => $option,
			'id'        => 'h4_font',
			'separator' => '1'
		)
	);
	
	/*********************************************************************/
	
	// Add font size
	add_settings_field(
		'h5_size',
		__( 'h5 Font Size', 'neversettle' ),
		'neversettle_text_element_callback',
		$option,
		$section,
		array(
			'menu'    => $option,
			'id'      => 'h5_size',
			'default' => '16',
			'after'   => 'px'
		)
	);
	
	// Add color picker
	add_settings_field(
		'h5_color',
		__( 'h5 Font Color', 'neversettle' ),
		'neversettle_color_element_callback',
		$option,
		$section,
		array(
			'menu'    => $option,
			'id'      => 'h5_color',
			'default' => '#CC0000'
		)
	);
	
	// Add Font Select
	add_settings_field(
		'h5_font',
		__( 'h5 Font Family', 'neversettle' ),
		'neversettle_select_font_callback',
		$option,
		$section,
		array(
			'menu'      => $option,
			'id'        => 'h5_font',
			'separator' => '1'
		)
	);
	
	/*********************************************************************/
	
	// Add font size
	add_settings_field(
		'h6_size',
		__( 'h6 Font Size', 'neversettle' ),
		'neversettle_text_element_callback',
		$option,
		$section,
		array(
			'menu'    => $option,
			'id'      => 'h6_size',
			'default' => '12',
			'after'   => 'px'
		)
	);
	
	// Add color picker
	add_settings_field(
		'h6_color',
		__( 'h6 Font Color', 'neversettle' ),
		'neversettle_color_element_callback',
		$option,
		$section,
		array(
			'menu'    => $option,
			'id'      => 'h6_color',
			'default' => '#CC0000'
		)
	);
	
	// Add Font Select
	add_settings_field(
		'h6_font',
		__( 'h6 Font Family', 'neversettle' ),
		'neversettle_select_font_callback',
		$option,
		$section,
		array(
			'menu'      => $option,
			'id'        => 'h6_font',
			'separator' => '1'
		)
	);
	
	/*********************************************************************/
	
	// Add font size
	add_settings_field(
		'p_size',
		__( 'Body Text Font Size', 'neversettle' ),
		'neversettle_text_element_callback',
		$option,
		$section,
		array(
			'menu'    => $option,
			'id'      => 'p_size',
			'default' => '16',
			'after'   => 'px'
		)
	);
	
	// Add color picker
	add_settings_field(
		'p_color',
		__( 'Body Text Font Color', 'neversettle' ),
		'neversettle_color_element_callback',
		$option,
		$section,
		array(
			'menu'    => $option,
			'id'      => 'p_color',
			'default' => '#CC0000'
		)
	);
	
	// Add Font Select
	add_settings_field(
		'p_font',
		__( 'Body Text Font Family', 'neversettle' ),
		'neversettle_select_font_callback',
		$option,
		$section,
		array(
			'menu' => $option,
			'id'   => 'p_font',
		)
	);
	
	// Register settings
	register_setting( $option, $option, 'neversettle_validate_input' );
	
}

add_action( 'admin_init', 'neversettle_initialize_theme_typography' );

/*
function neversettle_initialize_theme_seo() {

    // Fields example:

    $option = 'neversettle_theme_options_seo';
    $section = 'seo_settings_section';

    // Create option in wp_options
    if (false == get_option($option)) {
        add_option($option);
    }

    // Add section
    add_settings_section(
        $section,
        __('', 'neversettle'),
        '__return_false',
        $option
    );

    // Add text
    add_settings_field(
        'test_text',
        __( 'Text', 'neversettle' ),
        'neversettle_text_element_callback',
        $option,
        $section,
        array(
            'menu' => $option,
            'id' => 'text_id',
            'default' => ''
        )
    );

    // Add Textarea
    add_settings_field(
        'test_textarea',
        __( 'Textarea', 'neversettle' ),
        'neversettle_textarea_element_callback',
        $option,
        $section,
        array(
            'menu' => $option,
            'id' => 'textarea_id',
            'default' => ''
        )
    );

    // Add checkbox
    add_settings_field(
        'test_checkbox',
        __( 'Checkbox', 'neversettle' ),
        'neversettle_checkbox_element_callback',
        $option,
        $section,
        array(
            'menu' => $option,
            'id' => 'checkbox_id',
            'label' => 'Teste legenda do checkbox'
        )
    );

    // Add radio
    add_settings_field(
        'test_radio',
        __( 'Radio', 'neversettle' ),
        'neversettle_radio_element_callback',
        $option,
        $section,
        array(
            'menu' => $option,
            'id' => 'radio_1',
            'items' => array(
                '1' => 'Valor 1',
                '2' => 'Valor 2',
                '3' => 'Valor 3'
            )
        )
    );

    // Add Select
    add_settings_field(
        'test_select',
        __( 'Select', 'neversettle' ),
        'neversettle_select_element_callback',
        $option,
        $section,
        array(
            'menu' => $option,
            'id' => 'select_id',
            'items' => array(
                '1' => 'Valor 1',
                '2' => 'Valor 2',
                '3' => 'Valor 3'
            )
        )
    );

    // Add Category
    add_settings_field(
        'test_category',
        __( 'Category', 'neversettle' ),
        'neversettle_category_element_callback',
        $option,
        $section,
        array(
            'menu' => $option,
            'id' => 'category_id'
        )
    );

    // Add color picker
    add_settings_field(
        'test_color',
        __( 'Color Picker', 'neversettle' ),
        'neversettle_color_element_callback',
        $option,
        $section,
        array(
            'menu' => $option,
            'id' => 'color_id',
            'default' => '#CC0000'
        )
    );

    // Add upload Button
    add_settings_field(
        'test_upload',
        __( 'Upload', 'neversettle' ),
        'neversettle_upload_element_callback',s
        $option,
        $section,
        array(
            'menu' => $option,
            'id' => 'upload_id'
        )
    );

    // Add Font Select
    add_settings_field(
        'h1_font',
        __( 'Font Family', 'neversettle' ),
        'neversettle_select_font_callback',
        $option,
        $section,
        array(
            'menu' => $option,
            'id'   => 'h1_font_id',
        )
    );

    // Register settings
    register_setting( $option, $option, 'neversettle_validate_input' );

}

add_action( 'admin_init', 'neversettle_initialize_theme_seo' );

*/