<?php
/**
 * Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

// Load modules
$theme_includes = array(
	'/lib/cleanup.php',
	// Clean up default theme includes
	'/lib/enqueue-scripts.php',
	// Enqueue styles and scripts
	'/lib/protocol-relative-theme-assets.php',
	// Protocol (http/https) relative assets path
	'/lib/framework.php',
	// Css framework related stuff (content width, nav walker class, comments, pagination, etc.)
	'/lib/theme-support.php',
	// Theme support options
	'/lib/template-tags.php',
	// Custom template tags
	'/lib/menu-areas.php',
	// Menu areas
	'/lib/widget-areas.php',
	// Widget areas
	'lib/customizer.php',
	// Theme customizer
	'/lib/vc_shortcodes.php',
	// Visual Composer shortcodes
	'/lib/jetpack.php',
	// Jetpack compatibility file
	'/lib/theme-options/theme-options.php'
	// Theme options
);

foreach ( $theme_includes as $file ) {
	if ( ! $filepath = locate_template( $file ) ) {
		trigger_error( sprintf( __( 'Error locating %s for inclusion', 'neversettle' ), $file ), E_USER_ERROR );
	}
	
	require_once $filepath;
}
unset( $file, $filepath );

/**
 * Include VC templates dynamically
 */
if ( defined( 'WPB_VC_VERSION' ) ) {
	add_action( 'vc_before_init', function () {
		$dir = STYLESHEETPATH . '/vc_templates/';
		// If directory exists
		if ( is_dir( $dir ) ) {
			// Get files from the directory
			if ( $vc_templates = scandir( $dir ) ) {
				for ( $i = 0; $i < count( $vc_templates ); $i ++ ) {
					// Check if is file
					if ( is_file( $vc_template = $dir . $vc_templates[ $i ] ) ) {
						// Include VC templates
						include_once( $vc_template );
					}
				}
			}
		}
	} );
}

/**
 * Add dynamic styles from VC widgets in footer
 *
 * Example:
 *
add_filter( 'project_name_vc_page_styles', function ( $styles ) use ( $background_image, $rand ) {
$styles .= "#ato-full-width-feature-{$rand} { background-image: url('{$background_image[0]}'); } ";

return $styles;
} );
 */
add_action( 'wp_footer', function () {
	$styles = apply_filters( 'project_name_vc_page_styles', '' );
	if ( ! empty( $styles ) ) : ?>
		<!-- Page dynamic styles start -->
		<style><?php echo $styles; ?></style>
		<!-- Page dynamic styles end -->
	<?php endif;
} );


// Theme the TinyMCE editor (Copy post/page text styles in this file)

add_editor_style( 'assets/dist/css/custom-editor-style.css' );


// Custom CSS for the login page

function loginCSS() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_stylesheet_directory_uri() . '/assets/dist/css/wp-login.css"/>';
}

add_action( 'login_head', 'loginCSS' );


// Add body class for active sidebar
function wp_has_sidebar( $classes ) {
	if ( is_active_sidebar( 'sidebar' ) ) {
		// add 'class-name' to the $classes array
		$classes[] = 'has_sidebar';
	}
	
	// return the $classes array
	return $classes;
}

add_filter( 'body_class', 'wp_has_sidebar' );

// Remove the version number of WP
// Warning - this info is also available in the readme.html file in your root directory - delete this file!
remove_action( 'wp_head', 'wp_generator' );


// Obscure login screen error messages
function wp_login_obscure() {
	return '<strong>Error</strong>: wrong username or password';
}

add_filter( 'login_errors', 'wp_login_obscure' );

/**
 * Add Browser-Detection to body class
 */
add_filter( 'body_class', function ( $classes ) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	
	if ( $is_lynx ) {
		$classes[] = 'lynx';
	} elseif ( $is_gecko ) {
		$classes[] = 'gecko';
	} elseif ( $is_opera ) {
		$classes[] = 'opera';
	} elseif ( $is_NS4 ) {
		$classes[] = 'ns4';
	} elseif ( $is_safari ) {
		$classes[] = 'safari';
	} elseif ( $is_chrome ) {
		$classes[] = 'chrome';
	} elseif ( $is_IE ) {
		$classes[] = 'ie';
		if ( preg_match( '/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version ) ) {
			$classes[] = 'ie' . $browser_version[1];
		}
	} else {
		$classes[] = 'unknown';
	}
	if ( $is_iphone ) {
		$classes[] = 'iphone';
	}
	if ( stristr( $_SERVER['HTTP_USER_AGENT'], "mac" ) ) {
		$classes[] = 'osx';
	} elseif ( stristr( $_SERVER['HTTP_USER_AGENT'], "linux" ) ) {
		$classes[] = 'linux';
	} elseif ( stristr( $_SERVER['HTTP_USER_AGENT'], "windows" ) ) {
		$classes[] = 'windows';
	}
	
	return $classes;
} );