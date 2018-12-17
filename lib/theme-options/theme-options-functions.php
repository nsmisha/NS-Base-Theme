<?php

// Resource: https://gist.github.com/claudiosanches/4185152

/**
 * Theme Options Functions
 */

/**
 * Load options scripts
 */
function neversettle_theme_options_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'farbtastic' );
	wp_enqueue_script( 'media-upload' );
	wp_enqueue_script( 'thickbox' );
	wp_enqueue_script( 'chosen_js', get_template_directory_uri() . '/lib/admin/js/chosen.jquery.min.js' );
	wp_enqueue_script( 'neversettle_admin_js', get_template_directory_uri() . '/lib/admin/js/ns_admin.js' );
	
	wp_enqueue_style( 'thickbox' );
	wp_enqueue_style( 'farbtastic' );
	wp_enqueue_style( 'chosen_css', get_template_directory_uri() . '/lib/admin/css/chosen.css' );
	wp_enqueue_style( 'neversettle_admin_css', get_template_directory_uri() . '/lib/admin/css/ns_admin.css' );
	
	wp_enqueue_media();
}

if ( isset( $_GET['page'] ) && $_GET['page'] == $neversettle_options_url ) {
	add_action( 'admin_init', 'neversettle_theme_options_scripts' );
}

/**
 * Section fallback
 */
function neversettle_section_options_callback() {
	// your code here
}

/**
 * Text
 */
function neversettle_text_element_callback( $args ) {
	$menu = $args['menu'];
	$id   = $args['id'];
	
	$options = get_option( $menu );
	
	if ( isset( $options[ $id ] ) ) {
		$current = $options[ $id ];
	} else {
		$current = isset( $args['default'] ) ? $args['default'] : '';
	}
	
	$html = '<div class="theme_option_wrapper">';
	
	if ( isset( $args['before'] ) ) {
		$before = $args['before'];
		$html   .= '<div class="addon before">' . $before . '</div>';
	}
	
	$html .= '<input type="text" id="' . $id . '" name="' . $menu . '[' . $id . ']" value="' . esc_attr( $current ) . '" class="regular-text" />';
	
	if ( isset( $args['after'] ) ) {
		$after = $args['after'];
		$html  .= '<div class="addon after">' . $after . '</div>';
	}
	
	if ( isset( $args['description'] ) ) {
		$html .= '<p class="description">' . $args['description'] . '</p>';
	}
	
	$html .= '</div>'; //theme_option_wrapper
	
	echo $html;
}

/**
 * Textarea
 */
function neversettle_textarea_element_callback( $args ) {
	$menu = $args['menu'];
	$id   = $args['id'];
	
	$options = get_option( $menu );
	
	if ( isset( $options[ $id ] ) ) {
		$current = $options[ $id ];
	} else {
		$current = isset( $args['default'] ) ? $args['default'] : '';
	}
	
	$html = '<textarea id="' . $id . '" name="' . $menu . '[' . $id . ']" rows="5" cols="50">' . esc_attr( $current ) . '</textarea>';
	
	if ( isset( $args['description'] ) ) {
		$html .= '<p class="description">' . $args['description'] . '</p>';
	}
	
	echo $html;
}

/**
 * Checkbox
 */
function neversettle_checkbox_element_callback( $args ) {
	$menu  = $args['menu'];
	$id    = $args['id'];
	$label = $args['label'];
	
	$options = get_option( $menu );
	
	if ( isset( $options[ $id ] ) ) {
		$current = $options[ $id ];
	} else {
		$current = isset( $args['default'] ) ? $args['default'] : '0';
	}
	
	$html = '<input type="checkbox" id="' . $id . '" name="' . $menu . '[' . $id . ']" value="1"' . checked( 1, $current, false ) . '/>';
	$html .= ' <label for="' . $id . '">' . $label . '</label>';
	
	if ( isset( $args['description'] ) ) {
		$html .= '<p class="description">' . $args['description'] . '</p>';
	}
	
	echo $html;
}

/**
 * Radio
 */
function neversettle_radio_element_callback( $args ) {
	$menu  = $args['menu'];
	$id    = $args['id'];
	$items = $args['items'];
	
	$options = get_option( $menu );
	
	if ( isset( $options[ $id ] ) ) {
		$current = $options[ $id ];
	} else {
		$current = isset( $args['default'] ) ? $args['default'] : '';
	}
	
	$html = '';
	
	foreach ( $items as $key => $value ) {
		$html .= '<input type="radio" id="' . $id . '-' . $key . '" name="' . $menu . '[' . $id . ']" value="' . $key . '"' . checked( $key, $current, false ) . '/>';
		$html .= ' <label for="' . $id . '-' . $key . '">' . $value . '</label><br />';
	}
	
	if ( isset( $args['description'] ) ) {
		$html .= '<p class="description">' . $args['description'] . '</p>';
	}
	
	echo $html;
}

/**
 * Select
 */
function neversettle_select_element_callback( $args ) {
	$menu  = $args['menu'];
	$id    = $args['id'];
	$items = $args['items'];
	
	$options = get_option( $menu );
	
	if ( isset( $options[ $id ] ) ) {
		$current = $options[ $id ];
	} else {
		$current = isset( $args['default'] ) ? $args['default'] : '';
	}
	
	$html = '<select id="' . $id . '" name="' . $menu . '[' . $id . ']">';
	foreach ( $items as $key => $value ) {
		$html .= '<option value="' . $key . '"' . selected( $current, $key, false ) . '>' . $value . '</option>';
	}
	$html .= '</select>';
	
	if ( isset( $args['description'] ) ) {
		$html .= '<p class="description">' . $args['description'] . '</p>';
	}
	
	echo $html;
}

/**
 * Select category
 */
function neversettle_category_element_callback( $args ) {
	$menu  = $args['menu'];
	$id    = $args['id'];
	$items = get_categories( 'hide_empty=0&orderby=name' );
	
	$options = get_option( $menu );
	
	if ( isset( $options[ $id ] ) ) {
		$current = $options[ $id ];
	} else {
		$current = isset( $args['default'] ) ? $args['default'] : '';
	}
	
	$html = '<select id="' . $id . '" name="' . $menu . '[' . $id . ']">';
	foreach ( $items as $cat ) {
		$key   = $cat->cat_ID;
		$value = $cat->category_nicename;
		$html  .= '<option value="' . $key . '"' . selected( $current, $key, false ) . '>' . $value . '</option>';
	}
	$html .= '</select>';
	
	if ( isset( $args['description'] ) ) {
		$html .= '<p class="description">' . $args['description'] . '</p>';
	}
	
	echo $html;
}

/**
 * Color
 */
function neversettle_color_element_callback( $args ) {
	$menu = $args['menu'];
	$id   = $args['id'];
	
	$options = get_option( $menu );
	
	if ( isset( $options[ $id ] ) ) {
		$current = $options[ $id ];
	} else {
		$current = isset( $args['default'] ) ? $args['default'] : '#ffffff';
	}
	
	$html = '<input style="width: 70px" name="' . $menu . '[' . $id . ']" type="text" id="color-' . $id . '" value="' . esc_attr( $current ) . '" class="regular-text" />';
	
	if ( isset( $args['description'] ) ) {
		$html .= '<p class="description">' . $args['description'] . '</p>';
	}
	
	$html .= '<div id="farbtasticbox-' . $id . '"></div>';
	
	$html .= '<script type="text/javascript">';
	$html .= 'jQuery(document).ready(function($) {';
	$html .= '$("#farbtasticbox-' . $id . '").hide();';
	$html .= '$("#farbtasticbox-' . $id . '").farbtastic("#color-' . $id . '");';
	$html .= '$("#color-' . $id . '").click(function(){';
	$html .= '$("#farbtasticbox-' . $id . '").slideToggle()';
	$html .= '});';
	$html .= '});';
	$html .= '</script>';
	
	echo $html;
}

/**
 * Upload
 */
function neversettle_upload_element_callback( $args ) {
	$menu = $args['menu'];
	$id   = $args['id'];
	
	$options = get_option( $menu );
	
	if ( isset( $options[ $id ] ) ) {
		$current = $options[ $id ];
	} else {
		$current = isset( $args['default'] ) ? $args['default'] : '';
	}
	
	$html = '<input name="' . $menu . '[' . $id . ']" type="text" id="' . $id . '_target" value="' . esc_attr( $current ) . '" class="regular-text" />';
	
	$html .= '<input data-preview="#' . $id . '_preview" data-target="#' . $id . '_target" data-action="toggle-upload-img" class="button" id="' . $id . '_button" type="button" value="' . __( 'Edit/Upload', 'neversettle' ) . '" />';
	
	if ( isset( $args['description'] ) ) {
		$html .= '<p class="description">' . $args['description'] . '</p>';
	}
	
	echo $html;
}

/**
 * Image preview
 */
function neversettle_image_preview_callback( $args ) {
	$menu        = $args['menu'];
	$related     = $args['related'];
	$options     = get_option( $menu );
	$description = isset( $args['description'] ) ? $args['description'] : '';
	if ( isset( $options[ $related ] ) ): ?>
        <div class="image_preview">
            <img id="<?php echo $related; ?>_preview" src="<?php echo esc_url( $options[ $related ] ); ?>"/>
            <p class="description"><?php echo $description; ?></p>
        </div>
	<?php endif;
}

/**
 * Get Fonts
 */
function neversettle_available_fonts() {
	
	$os_faces = array(
		array(
			'name' => 'Arial',
			'css'  => 'font-family: Arial, sans-serif;',
		),
		array(
			'name' => 'Avant Garde',
			'css'  => 'font-family: "Avant Garde", sans-serif;',
		),
		array(
			'name' => 'Cambria',
			'css'  => 'font-family: Cambria, Georgia, serif;',
		),
		array(
			'name' => 'Copse',
			'css'  => 'font-family: Copse, sans-serif;',
		),
		array(
			'name' => 'Garamond',
			'css'  => 'font-family: Garamond, "Hoefler Text", Times New Roman, Times, serif;',
		),
		array(
			'name' => 'Georgia',
			'css'  => 'font-family: Georgia, serif;',
		),
		array(
			'name' => 'Helvetica Neue',
			'css'  => 'font-family: "Helvetica Neue", Helvetica, sans-serif;',
		),
		array(
			'name' => 'Tahoma',
			'css'  => 'font-family: Tahoma, Geneva, sans-serif;',
		),
	);
	$google_fonts_array = array(
		array(
			'name'   => 'Anton',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Anton:regular);',
			'css'    => 'font-family: \'Anton\', sans-serif;',
		),
		array(
			'name'   => 'Arimo',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Arimo:regular,italic,700,700italic);',
			'css'    => 'font-family: \'Arimo\', sans-serif;',
		),
		array(
			'name'   => 'Bitter',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Bitter:regular,italic,700);',
			'css'    => 'font-family: \'Bitter\', sans-serif;',
		),
		array(
			'name'   => 'Dosis',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Dosis:200,300,regular,500,600,700,800);',
			'css'    => 'font-family: \'Dosis\', sans-serif;',
		),
		array(
			'name'   => 'Inconsolata',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Inconsolata:regular,700);',
			'css'    => 'font-family: \'Inconsolata\', sans-serif;',
		),
		array(
			'name'   => 'Indie Flower',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Indie+Flower:regular);',
			'css'    => 'font-family: \'Indie Flower\', sans-serif;',
		),
		array(
			'name'   => 'Lato',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Lato:100,100italic,300,300italic,regular,italic,700,700italic,900,900italic);',
			'css'    => 'font-family: \'Lato\', sans-serif;',
		),
		array(
			'name'   => 'Lora',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Lora:regular,italic,700,700italic);',
			'css'    => 'font-family: \'Lora\', sans-serif;',
		),
		array(
			'name'   => 'Merriweather',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Merriweather:300,300italic,regular,italic,700,700italic,900,900italic);',
			'css'    => 'font-family: \'Merriweather\', sans-serif;',
		),
		array(
			'name'   => 'Montserrat',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Montserrat:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic);',
			'css'    => 'font-family: \'Montserrat\', sans-serif;',
		),
		array(
			'name'   => 'Muli',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Muli:200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,800,800italic,900,900italic);',
			'css'    => 'font-family: \'Muli\', sans-serif;',
		),
		array(
			'name'   => 'Noto Sans',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Noto+Sans:regular,italic,700,700italic);',
			'css'    => 'font-family: \'Noto Sans\', sans-serif;',
		),
		array(
			'name'   => 'Noto Serif',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Noto+Serif:regular,italic,700,700italic);',
			'css'    => 'font-family: \'Noto Serif\', sans-serif;',
		),
		array(
			'name'   => 'Nunito',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Nunito:200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,800,800italic,900,900italic);',
			'css'    => 'font-family: \'Nunito\', sans-serif;',
		),
		array(
			'name'   => 'Open Sans',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,regular,italic,600,600italic,700,700italic,800,800italic);',
			'css'    => 'font-family: \'Open Sans\', sans-serif;',
		),
		array(
			'name'   => 'Open Sans Condensed',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700);',
			'css'    => 'font-family: \'Open Sans Condensed\', sans-serif;',
		),
		array(
			'name'   => 'Oswald',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Oswald:200,300,regular,500,600,700);',
			'css'    => 'font-family: \'Oswald\', sans-serif;',
		),
		array(
			'name'   => 'PT Sans',
			'import' => '@import url(https://fonts.googleapis.com/css?family=PT+Sans:regular,italic,700,700italic);',
			'css'    => 'font-family: \'PT Sans\', sans-serif;',
		),
		array(
			'name'   => 'PT Sans Narrow',
			'import' => '@import url(https://fonts.googleapis.com/css?family=PT+Sans+Narrow:regular,700);',
			'css'    => 'font-family: \'PT Sans Narrow\', sans-serif;',
		),
		array(
			'name'   => 'PT Serif',
			'import' => '@import url(https://fonts.googleapis.com/css?family=PT+Serif:regular,italic,700,700italic);',
			'css'    => 'font-family: \'PT Serif\', sans-serif;',
		),
		array(
			'name'   => 'Playfair Display',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Playfair+Display:regular,italic,700,700italic,900,900italic);',
			'css'    => 'font-family: \'Playfair Display\', sans-serif;',
		),
		array(
			'name'   => 'Poppins',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic);',
			'css'    => 'font-family: \'Poppins\', sans-serif;',
		),
		array(
			'name'   => 'Raleway',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Raleway:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic);',
			'css'    => 'font-family: \'Raleway\', sans-serif;',
		),
		array(
			'name'   => 'Roboto',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic);',
			'css'    => 'font-family: \'Roboto\', sans-serif;',
		),
		array(
			'name'   => 'Roboto Condensed',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300italic,regular,italic,700,700italic);',
			'css'    => 'font-family: \'Roboto Condensed\', sans-serif;',
		),
		array(
			'name'   => 'Roboto Slab',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,regular,700);',
			'css'    => 'font-family: \'Roboto Slab\', sans-serif;',
		),
		array(
			'name'   => 'Slabo 27px',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Slabo+27px:regular);',
			'css'    => 'font-family: \'Slabo 27px\', sans-serif;',
		),
		array(
			'name'   => 'Source Sans Pro',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,900,900italic);',
			'css'    => 'font-family: \'Source Sans Pro\', sans-serif;',
		),
		array(
			'name'   => 'Titillium Web',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Titillium+Web:200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,900);',
			'css'    => 'font-family: \'Titillium Web\', sans-serif;',
		),
		array(
			'name'   => 'Ubuntu',
			'import' => '@import url(https://fonts.googleapis.com/css?family=Ubuntu:300,300italic,regular,italic,500,500italic,700,700italic);',
			'css'    => 'font-family: \'Ubuntu\', sans-serif;',
		),
	);
	
	$os_faces = array_merge( $os_faces, $google_fonts_array );
	asort( $os_faces );
	
	return $os_faces;
}

/**
 * Display Select with available fonts
 *
 * @param $args
 */
function neversettle_select_font_callback( $args ) {
	$menu = $args['menu'];
	$id   = $args['id'];
	
	$options = get_option( $menu );
	$fonts   = neversettle_available_fonts();
	
	$current_font = 'arial';
	$html         = '';
	
	if ( isset( $options[ $id ] ) ) {
		$current_font = $options[ $id ];
	}
	$html .= '<select class="chosen-select" name="' . $menu . '[' . $id . ']">';
	
	foreach ( $fonts as $font_key => $font ):
		
		$selected = $font_key == $current_font ? 'selected' : '';
		
		$html .= '<option ' . $selected . ' value="' . $font_key . '">';
		$html .= $font['name'];
		$html .= '</option>';
	
	endforeach;
	
	$html .= '</select>';
	
	if ( isset( $args['separator'] ) ) {
		$separator = $args['separator'];
		$html      .= '<div class="separator"></div>';
	}
	
	echo $html;
}

/**
 * Include fonts settings to theme
 */
add_action( 'wp_head', 'neversettle_admin_head' );
function neversettle_admin_head() {
	$options = (array) get_option( 'neversettle_typography' );
	$fonts   = neversettle_available_fonts();
	
	$font_tags = [
		'h1',
		'h2',
		'h3',
		'h4',
		'h5',
		'h6',
		'p',
	];
	
	$import = array();
	$html   = '<style>' . "\n";
	foreach ( $font_tags as $font_tag ) {
		$current_font = $fonts[ $options[ $font_tag . '_font' ] ];
		if ( isset( $options[ $font_tag . '_font' ] ) && isset( $current_font['import'] ) && ! in_array( $current_font['import'], $import ) ) {
			$import[] = $current_font['import'];
			$html     .= $current_font['import'];
		}
		$css_tag = $font_tag == 'p' ? 'body' : $font_tag;
		$html    .= "\n" . $css_tag . ' {';
		$html    .= $current_font['css'];
		$html    .= 'font-size: ' . $options[ $font_tag . '_size' ] . 'px;';
		$html    .= 'color: ' . $options[ $font_tag . '_color' ] . ';';
		$html    .= '}' . "\n";
	}
	$html .= '</style>' . "\n";
	echo $html;
}

/**
 * Include uploaded favicon to theme
 */
add_action( 'login_head', 'neversettle_theme_favicon' );
add_action( 'admin_head', 'neversettle_theme_favicon' );
add_action( 'wp_head', 'neversettle_theme_favicon' );
function neversettle_theme_favicon() {
	$general_settings = get_option( 'neversettle_general' );
	if ( ! empty( $general_settings['fav_ico'] ) ) {
		$favicon = '<link rel="icon" href="' . $general_settings['fav_ico'] . '" type="image/x-icon" />';
		$favicon .= '<link rel="shortcut icon" href="' . $general_settings['fav_ico'] . '" type="image/x-icon" />';
		echo $favicon;
	}
}

/**
 * Sanitization callback
 *
 * @params type string $input
 *   The unsanitized collection of options.
 *
 * @returns string
 *   The collection of sanitized values.
 */
function neversettle_validate_input( $input ) {
	// Create our array for storing the validated options
	$output = neversettle_recursive_input_validation( $input );
	
	// Return the array processing any additional functions filtered by this action
	return apply_filters( 'neversettle_validate_input', $output, $input );
}

/**
 * Recursive input validation
 *
 * @param $data
 *
 * @return mixed
 */
function neversettle_recursive_input_validation( $data ) {
	foreach ( $data as $key => $value ) {
		if ( is_array( $value ) ) {
			$data[ $key ] = neversettle_recursive_input_validation( $value );
		} else {
			$data[ $key ] = strip_tags( stripslashes( $value ) );
		}
	}
	
	return $data;
}