<?php
// Inplace theme options
// @package Inplace
// Default options values

$neversettle_options = array(
	'logo_display'       => 'image',
	'logo_text'          => 'Inplace',
	'scaletitle'         => 'Post with scaled image',
	'postslidertitle'    => 'Sliding category',
	'newstitle'          => 'our news',
	'newsdescription'    => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took...",
	'lasttitle'          => 'last product',
	'contacttitle'       => 'contacts',
	'testimonialtittle'  => 'testimonials',
	'specificationtitle' => 'Specification',
	'contactdescription' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took...",
	'mapcode'            => '',
	'expertstitle'       => 'our experts',
	'expertsdescription' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took...",
	'timer1title'        => 'facebook likes',
	'timer2title'        => 'twitter likes',
	'timer3title'        => 'instagram likes',
	'timer4title'        => 'happy clients',
	'timer1count'        => '150',
	'timer2count'        => '115',
	'timer3count'        => '395',
	'timer4count'        => '98',
	'relpostlinktext'    => 'read more',
	'seo'                => 'no',
	'preloader'          => 'yes',
	'preloadtemplate'    => 'preload-1',
	'preloadcolor'       => '#ffffff',
	'preloadback'        => '#000000',
	'second'             => 'yes',
	'second_a'           => 'yes',
	'third'              => 'yes',
	'fourth'             => 'yes',
	'fifth'              => 'yes',
	'sixth'              => 'yes',
	'seventh'            => 'yes',
	'eighth'             => 'yes',
	'nineth'             => 'yes',
	'tenth'              => 'yes',
	'eleventh'           => 'yes',
	'twelveth'           => 'yes',
	'underconstruct'     => 'no',
	'constructtemplate'  => 'stopper-1'

);

if ( is_admin() ) : // Load only if we are viewing an admin page
	
	function inplace_admin_styles_and_scripts() {
		wp_enqueue_media();
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'inplace_admin', get_template_directory_uri() . '/lib/admin/js/inplaceadmin.js' );
		wp_enqueue_style( 'admin_page', get_template_directory_uri() . '/lib/admin/css/admin.css' );
	}
	
	add_action( 'admin_enqueue_scripts', 'inplace_admin_styles_and_scripts' );
	
	
	function neversettle_register_settings() {
		// Register settings and call sanitation functions
		register_setting( 'neversettle_theme_options', 'neversettle_options', 'neversettle_validate_options' );
	}
	
	add_action( 'admin_init', 'neversettle_register_settings' );
	
	function neversettle_theme_options() {
		// Add theme options page to the addmin menu
		add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'theme_options', 'neversettle_theme_options_page' );
	}
	
	add_action( 'admin_menu', 'neversettle_theme_options' );
	
	// Function to generate options page
	function neversettle_theme_options_page() {
		
		// Store Posts in array
		$inplace_postlist[0] = array(
			'value' => 0,
			'label' => '--choose--'
		);
		$arg                 = array( 'posts_per_page' => - 1, 'post_type' => 'post' );
		$inplace_posts       = get_posts( $arg );
		foreach ( $inplace_posts as $inplace_post ) :
			$inplace_postlist[ $inplace_post->ID ] = array(
				'value' => $inplace_post->ID,
				'label' => $inplace_post->post_title
			);
		endforeach;
		wp_reset_postdata();
		
		
		global $neversettle_options;
		
		if ( ! isset( $_REQUEST['settings-updated'] ) ) {
			$_REQUEST['settings-updated'] = false;
		} // This checks whether the form has just been submitted. ?>

        <div class="wrap">
			
			<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
                <div class="updated fade"><p><strong><?php _e( 'Options saved', 'inplace' ); ?></strong></p></div>
			<?php endif; // If the form has just been submitted, this shows the notification ?>

            <form method="post" action="options.php">
				<?php $settings = get_option( 'neversettle_options', $neversettle_options ); ?>
				
				<?php settings_fields( 'neversettle_theme_options' );
				/* This function outputs some hidden fields required by the form,
				including a nonce, a unique number used to ensure the form has been submitted from the admin page
				and not somewhere else, very important for security */ ?>


                <div class="container">
                    <div id="logo-block">
                        <div class="logo-inblock"><img
                                    src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/lib/admin/images/AdminPanel-logo_1.png"
                                    alt="photo"/></div>
                        <div class="logo-inblock_2"><a href="http://neversettleplace.com"><img
                                        src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/lib/admin/images/AdminPanel-logo_2.png"
                                        alt="photo"/></a></div>
                    </div>
                    <div id="blueline"></div>
                </div>
                <div class="container">

                    <div class="col-md-3 left" style="clear: both;">
                        <img class="leftphadmin"
                             src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/lib/admin/images/iNPALCE_wp.jpg"
                             alt=""/>
                        <div class="blackline"></div>
                        <ul id="leftmenu_2">
                            <li><img class="adminico"
                                     src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/lib/admin/images/adminico_1.png"/><span
                                        id="templateli"><strong>General settings</strong></span></li>
                            <li><img class="adminico"
                                     src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/lib/admin/images/adminico_8.png"/><span
                                        id="bannerli"><strong>Home page settings</strong></span></li>
                            <li><img class="adminico"
                                     src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/lib/admin/images/adminico_9.png"/><span
                                        id="sliderli"><strong>Slider settings</strong></span></li>
                            <li><img class="adminico"
                                     src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/lib/admin/images/adminico_2.png"/><span
                                        id="contactli"><strong>Contacts settings</strong></span></li>
                            <li><img class="adminico"
                                     src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/lib/admin/images/adminico_7.png"/><span
                                        id="seoli"><strong>Theme seo meta</strong></span></li>
                            <li><img class="adminico"
                                     src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/lib/admin/images/adminico_3.png"/><span
                                        id="additionalli"><strong>Additional settings</strong></span></li>
                            <li><img class="adminico"
                                     src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/lib/admin/images/adminico_6.jpg"/><span
                                        id="supportli"><strong>Theme support</strong></span></li>
                        </ul>
                    </div>

                    <div class="col-md-9" style="margin-bottom: 35px;">


                        <div id="templateset">
                            <h3 class="admin-title"><strong><?php _e( 'General settings', 'inplace' ); ?></strong>
                            </h3>
                            <table class="tableopt">
                                <tr>
                                    <td style="width:20%;"><?php _e( 'Display logo:', 'inplace' ); ?></td>
                                    <td colspan="3" style="width:63%;">

                                        <input type="radio" name="neversettle_options[logo_display]" id="radioimage"
                                               class="radio radioimage"
                                               value="image" <?php checked( $settings['logo_display'], 'image' ); ?>>
                                        <div class="ibox_1"><?php _e( 'Image', 'inplace' ); ?></div>
                                        <input type="radio" name="neversettle_options[logo_display]" id="radiotext"
                                               class="radio radiotext"
                                               value="text" <?php checked( $settings['logo_display'], 'text' ); ?>>
                                        <div class="ibox_1"><?php _e( 'Text', 'inplace' ); ?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Logo url:', 'inplace' ); ?></td>
                                    <td colspan="3" style="width:63%;">
                                        <a class="selectupload" target="_blank"
                                           href="<?php echo admin_url( '/themes.php?page=custom-header' ); ?>"><?php _e( 'Upload or Select', 'inplace' ); ?></a>
                                        <input type="text" class="textinput" value="<?php header_image(); ?>"
                                               readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Logo text:', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[logo_text]"
                                                           id="neversettle_options[logo_text]" class="textinput"
                                                           value="<?php echo $settings['logo_text']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><?php _e( 'Upload Favicon:', 'inplace' ); ?></td>
                                    <td>
                                        <input class="selectupload" name="favicon_button"
                                               id="neversettleplace_favicon_button"
                                               value="<?php _e( 'Upload or Select', 'inplace' ); ?>" type="button"/>
                                        <br/>
                                        <input type="text" class="textinput faviconurl"
                                               name="neversettle_options[favicon]" id="neversettle_options[favicon]"
                                               value="<?php echo $settings['favicon']; ?>"/>
                                        <em><?php _e( 'Upload favicon(.png) with size of 16px X 16px', 'inplace' ); ?></em>
										
										<?php if ( ! empty( $settings['favicon'] ) ){ ?>
                                        <div id="neversettleplace_media_image">
                                            <img src="<?php echo $settings['favicon'] ?>"
                                                 id="neversettleplace_show_image">
                                            <a id="neversettleplace_fav_icon_remove" class="selectupload"
                                               title="remove"
                                               href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
											<?php } else { ?>
                                                <div id="neversettleplace_media_image" style="display:none">
                                                    <img src="<?php $settings['favicon']; ?>"
                                                         id="neversettleplace_show_image">
                                                    <a id="neversettleplace_fav_icon_remove" class="selectupload"
                                                       title="remove"
                                                       href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                                </div>
											<?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php _e( 'Enable preloader:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input type="radio" name="neversettle_options[preloader]"
                                               class="radio radioimage"
                                               value="no" <?php checked( $settings['preloader'], 'no' ); ?>>
                                        <div class="ibox_1">disable</div>
                                        <input type="radio" name="neversettle_options[preloader]"
                                               class="radio radiotext"
                                               value="yes" <?php checked( $settings['preloader'], 'yes' ); ?>>
                                        <div class="ibox_1">enable</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Preloader template:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <table>
                                            <tr>
                                                <td>
                                                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/lib/admin/images/preloaders/1.png"/>
                                                </td>
                                                <td>
                                                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/lib/admin/images/preloaders/2.png"/>
                                                </td>
                                                <td>
                                                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/lib/admin/images/preloaders/3.png"/>
                                                </td>
                                                <td>
                                                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/lib/admin/images/preloaders/4.png"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;"><input type="radio"
                                                                                       name="neversettle_options[preloadtemplate]"
                                                                                       value="preload-1" <?php checked( $settings['preloadtemplate'], 'preload-1' ); ?>>
                                                </td>
                                                <td style="text-align: center;"><input type="radio"
                                                                                       name="neversettle_options[preloadtemplate]"
                                                                                       value="preload-2" <?php checked( $settings['preloadtemplate'], 'preload-2' ); ?>>
                                                </td>
                                                <td style="text-align: center;"><input type="radio"
                                                                                       name="neversettle_options[preloadtemplate]"
                                                                                       value="preload-3" <?php checked( $settings['preloadtemplate'], 'preload-3' ); ?>>
                                                </td>
                                                <td style="text-align: center;"><input type="radio"
                                                                                       name="neversettle_options[preloadtemplate]"
                                                                                       value="preload-4" <?php checked( $settings['preloadtemplate'], 'preload-4' ); ?>>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/lib/admin/images/preloaders/5.png"/>
                                                </td>
                                                <td>
                                                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/lib/admin/images/preloaders/6.png"/>
                                                </td>
                                                <td>
                                                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/lib/admin/images/preloaders/7.png"/>
                                                </td>
                                                <td>
                                                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/lib/admin/images/preloaders/8.png"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;"><input type="radio"
                                                                                       name="neversettle_options[preloadtemplate]"
                                                                                       value="preload-5" <?php checked( $settings['preloadtemplate'], 'preload-5' ); ?>>
                                                </td>
                                                <td style="text-align: center;"><input type="radio"
                                                                                       name="neversettle_options[preloadtemplate]"
                                                                                       value="preload-6" <?php checked( $settings['preloadtemplate'], 'preload-6' ); ?>>
                                                </td>
                                                <td style="text-align: center;"><input type="radio"
                                                                                       name="neversettle_options[preloadtemplate]"
                                                                                       value="preload-7" <?php checked( $settings['preloadtemplate'], 'preload-7' ); ?>>
                                                </td>
                                                <td style="text-align: center;"><input type="radio"
                                                                                       name="neversettle_options[preloadtemplate]"
                                                                                       value="preload-8" <?php checked( $settings['preloadtemplate'], 'preload-8' ); ?>>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Preloader color:', 'inplace' ); ?></td>
                                    <td colspan="3"><input name="neversettle_options[preloadcolor]"
                                                           id="neversettle_options[preloadcolor]" class="textinput"
                                                           type="color"
                                                           value="<?php echo $settings['preloadcolor']; ?>"></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Preloader background color:', 'inplace' ); ?></td>
                                    <td colspan="3"><input name="neversettle_options[preloadback]"
                                                           id="neversettle_options[preloadback]" class="textinput"
                                                           type="color"
                                                           value="<?php echo $settings['preloadback']; ?>"></td>
                                </tr>


                            </table>
                        </div>
                        <div id="bannerset" style="display: none;">
                            <h3 class="admin-title"><strong><?php _e( 'Home page settings', 'inplace' ); ?></strong>
                            </h3>

                            <div class="sectionlink"
                                 id="secondlink"><?php _e( 'Sliding category block', 'inplace' ); ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() ) ?>/lib/admin/images/second.png">
                            </div>
                            <table class="tableoptin" id="second">
                                <tr>
                                    <td><?php _e( 'Enable block:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input type="radio" name="neversettle_options[second]"
                                               class="radio radioimage"
                                               value="no" <?php checked( $settings['second'], 'no' ); ?>>
                                        <div class="ibox_1">disable</div>
                                        <input type="radio" name="neversettle_options[second]"
                                               class="radio radiotext"
                                               value="yes" <?php checked( $settings['second'], 'yes' ); ?>>
                                        <div class="ibox_1">enable</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;"><?php _e( 'Post slider category:', 'inplace' ); ?></td>
                                    <td style="width: 63%;" colspan="3"><?php wp_dropdown_categories( array(
											'name'       => 'neversettle_options[postslider]',
											'id'         => 'neversettle_options[postslider]',
											'selected'   => $settings['postslider'],
											'hide_empty' => 0,
											'class'      => 'dropselect'
										) ); ?></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Post slider block title', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[postslidertitle]"
                                                           id="neversettle_options[postslidertitle]"
                                                           class="textinput"
                                                           value="<?php echo $settings['postslidertitle']; ?>"/>
                                    </td>
                                </tr>
                            </table>


                            <div class="sectionlink"
                                 id="second_alink"><?php _e( 'Scale image block', 'inplace' ); ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() ) ?>/lib/admin/images/second_a.png">
                            </div>

                            <table class="tableoptin" id="second_a">
                                <tr>
                                    <td><?php _e( 'Enable block:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input type="radio" name="neversettle_options[second_a]"
                                               class="radio radioimage"
                                               value="no" <?php checked( $settings['second_a'], 'no' ); ?>>
                                        <div class="ibox_1">disable</div>
                                        <input type="radio" name="neversettle_options[second_a]"
                                               class="radio radiotext"
                                               value="yes" <?php checked( $settings['second_a'], 'yes' ); ?>>
                                        <div class="ibox_1">enable</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;"><?php _e( 'Scale image related post', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <select id="neversettle_options[scalerelpostid]" class="dropselect"
                                                name="neversettle_options[scalerelpostid]">
											<?php
											foreach ( $inplace_postlist as $single_post ) :
												$label = $single_post['label'];
												echo '<option value="' . $single_post['value'] . '" ' . selected( $single_post['value'], $settings['scalerelpostid'] ) . '>' . $label . '</option>';
											endforeach;
											?>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Scale image related post block title', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[scaletitle]"
                                                           id="neversettle_options[scaletitle]" class="textinput"
                                                           value="<?php echo $settings['scaletitle']; ?>"/></td>
                                </tr>
                            </table>

                            <div class="sectionlink"
                                 id="thirdlink"><?php _e( 'Features category block', 'inplace' ); ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() ) ?>/lib/admin/images/third.png">
                            </div>

                            <table class="tableoptin" id="third">
                                <tr>
                                    <td><?php _e( 'Enable block:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input type="radio" name="neversettle_options[third]"
                                               class="radio radioimage"
                                               value="no" <?php checked( $settings['third'], 'no' ); ?>>
                                        <div class="ibox_1">disable</div>
                                        <input type="radio" name="neversettle_options[third]"
                                               class="radio radiotext"
                                               value="yes" <?php checked( $settings['third'], 'yes' ); ?>>
                                        <div class="ibox_1">enable</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;"><?php _e( 'Features category:', 'inplace' ); ?></td>
                                    <td colspan="3"><?php wp_dropdown_categories( array(
											'name'       => 'neversettle_options[features_cat]',
											'id'         => 'neversettle_options[features_cat]',
											'selected'   => $settings['features_cat'],
											'hide_empty' => 0,
											'class'      => 'dropselect'
										) ); ?></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Features block title', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[featurestitle]"
                                                           id="neversettle_options[featurestitle]" class="textinput"
                                                           value="<?php echo $settings['featurestitle']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Features block description', 'inplace' ); ?></td>
                                    <td colspan="3"><textarea name="neversettle_options[featuresdescription]"
                                                              id="neversettle_options[featuresdescription]" rows="2"
                                                              class="themeopt"><?php echo $settings['featuresdescription']; ?></textarea>
                                    </td>
                                </tr>


                            </table>

                            <div class="sectionlink"
                                 id="fourthlink"><?php _e( 'Specification category block', 'inplace' ); ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() ) ?>/lib/admin/images/fourth.png">
                            </div>

                            <table class="tableoptin" id="fourth">
                                <tr>
                                    <td><?php _e( 'Enable block:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input type="radio" name="neversettle_options[fourth]"
                                               class="radio radioimage"
                                               value="no" <?php checked( $settings['fourth'], 'no' ); ?>>
                                        <div class="ibox_1">disable</div>
                                        <input type="radio" name="neversettle_options[fourth]"
                                               class="radio radiotext"
                                               value="yes" <?php checked( $settings['fourth'], 'yes' ); ?>>
                                        <div class="ibox_1">enable</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;"><?php _e( 'Specification category:', 'inplace' ); ?></td>
                                    <td colspan="3"><?php wp_dropdown_categories( array(
											'name'       => 'neversettle_options[specification]',
											'id'         => 'neversettle_options[specification]',
											'selected'   => $settings['specification'],
											'hide_empty' => 0,
											'class'      => 'dropselect'
										) ); ?></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Specification block title', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text"
                                                           name="neversettle_options[specificationtitle]"
                                                           id="neversettle_options[specificationtitle]"
                                                           class="textinput"
                                                           value="<?php echo $settings['specificationtitle']; ?>"/>
                                    </td>
                                </tr>


                            </table>

                            <div class="sectionlink"
                                 id="fifthlink"><?php _e( 'Experts category block', 'inplace' ); ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() ) ?>/lib/admin/images/fifth.png">
                            </div>

                            <table class="tableoptin" id="fifth">

                                <tr>
                                    <td><?php _e( 'Enable block:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input type="radio" name="neversettle_options[fifth]"
                                               class="radio radioimage"
                                               value="no" <?php checked( $settings['fifth'], 'no' ); ?>>
                                        <div class="ibox_1">disable</div>
                                        <input type="radio" name="neversettle_options[fifth]"
                                               class="radio radiotext"
                                               value="yes" <?php checked( $settings['fifth'], 'yes' ); ?>>
                                        <div class="ibox_1">enable</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;"><?php _e( 'Experts category:', 'inplace' ); ?></td>
                                    <td colspan="3"><?php wp_dropdown_categories( array(
											'name'       => 'neversettle_options[experts]',
											'id'         => 'neversettle_options[experts]',
											'selected'   => $settings['experts'],
											'hide_empty' => 0,
											'class'      => 'dropselect'
										) ); ?></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Experts block title', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[expertstitle]"
                                                           id="neversettle_options[expertstitle]" class="textinput"
                                                           value="<?php echo $settings['expertstitle']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Experts block description', 'inplace' ); ?></td>
                                    <td colspan="3"><textarea name="neversettle_options[expertsdescription]"
                                                              id="neversettle_options[expertsdescription]" rows="2"
                                                              class="themeopt"><?php echo $settings['expertsdescription']; ?></textarea>
                                    </td>
                                </tr>

                            </table>

                            <div class="sectionlink" id="sixthlink"><?php _e( 'Social timer block', 'inplace' ); ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() ) ?>/lib/admin/images/sixth.png">
                            </div>

                            <table class="tableoptin" id="sixth">

                                <tr>
                                    <td><?php _e( 'Enable block:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input type="radio" name="neversettle_options[sixth]"
                                               class="radio radioimage"
                                               value="no" <?php checked( $settings['sixth'], 'no' ); ?>>
                                        <div class="ibox_1">disable</div>
                                        <input type="radio" name="neversettle_options[sixth]"
                                               class="radio radiotext"
                                               value="yes" <?php checked( $settings['sixth'], 'yes' ); ?>>
                                        <div class="ibox_1">enable</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;"><?php _e( 'first timer title', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[timer1title]"
                                                           id="neversettle_options[timer1title]" class="textinput"
                                                           value="<?php echo $settings['timer1title']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'first timer count', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[timer1count]"
                                                           id="neversettle_options[timer1count]" class="textinput"
                                                           value="<?php echo $settings['timer1count']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'second timer title', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[timer2title]"
                                                           id="neversettle_options[timer2title]" class="textinput"
                                                           value="<?php echo $settings['timer2title']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'second timer count', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[timer2count]"
                                                           id="neversettle_options[timer2count]" class="textinput"
                                                           value="<?php echo $settings['timer2count']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'third timer title', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[timer3title]"
                                                           id="neversettle_options[timer3title]" class="textinput"
                                                           value="<?php echo $settings['timer3title']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'third timer count', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[timer3count]"
                                                           id="neversettle_options[timer3count]" class="textinput"
                                                           value="<?php echo $settings['timer3count']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'fourth timer title', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[timer4title]"
                                                           id="neversettle_options[timer4title]" class="textinput"
                                                           value="<?php echo $settings['timer4title']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'fourth timer count', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[timer4count]"
                                                           id="neversettle_options[timer4count]" class="textinput"
                                                           value="<?php echo $settings['timer4count']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Timer custom background image url:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input placeholder="<?php _e( 'image url', 'inplace' ); ?>"
                                               class="selectupload" name="timerback_button"
                                               id="neversettleplace_timerback_button"
                                               value="<?php _e( 'Upload or Select', 'inplace' ); ?>" type="button"/>
                                        <br/>
                                        <em><?php _e( 'Upload Slider image with recommended size of 1920px X 500px', 'inplace' ); ?></em>
                                        <input type="text" name="neversettle_options[timerback]"
                                               id="neversettle_options[timerback]" class="textinput timerback"
                                               value="<?php echo $settings['timerback']; ?>"/>
										
										<?php if ( ! empty( $settings['timerback'] ) ) { ?>
                                            <div id="neversettleplace_timerback_template">
                                                <img src="<?php echo $settings['timerback'] ?>"
                                                     id="neversettleplace_timerback_image">
                                                <a id="neversettleplace_timerback_remove" class="selectupload"
                                                   title="remove"
                                                   href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                            </div>
										<?php } else { ?>
                                            <div id="neversettleplace_timerback_template" style="display:none">
                                                <img src="<?php $settings['timerback']; ?>"
                                                     id="neversettleplace_timerback_image">
                                                <a id="neversettleplace_timerback_remove" class="selectupload"
                                                   title="remove"
                                                   href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                            </div>
										<?php } ?>
                                    </td>
                                </tr>


                            </table>

                            <div class="sectionlink" id="seventhlink"><?php _e( 'Widget block', 'inplace' ); ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() ) ?>/lib/admin/images/seventh.png">
                            </div>

                            <table class="tableoptin" id="seventh">

                                <tr>
                                    <td><?php _e( 'Enable block:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input type="radio" name="neversettle_options[seventh]"
                                               class="radio radioimage"
                                               value="no" <?php checked( $settings['seventh'], 'no' ); ?>>
                                        <div class="ibox_1">disable</div>
                                        <input type="radio" name="neversettle_options[seventh]"
                                               class="radio radiotext"
                                               value="yes" <?php checked( $settings['seventh'], 'yes' ); ?>>
                                        <div class="ibox_1">enable</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;"><?php _e( 'Widget block title', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[widgettitle]"
                                                           id="neversettle_options[widgettitle]" class="textinput"
                                                           value="<?php echo $settings['widgettitle']; ?>"/></td>
                                </tr>

                            </table>

                            <div class="sectionlink" id="eighthlink"><?php _e( 'Related post block', 'inplace' ); ?>

                                <img src="<?php echo esc_url( get_template_directory_uri() ) ?>/lib/admin/images/eighth.png">

                            </div>

                            <table class="tableoptin" id="eighth">
                                <tr>
                                    <td><?php _e( 'Enable block:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input type="radio" name="neversettle_options[eighth]"
                                               class="radio radioimage"
                                               value="no" <?php checked( $settings['eighth'], 'no' ); ?>>
                                        <div class="ibox_1">disable</div>
                                        <input type="radio" name="neversettle_options[eighth]"
                                               class="radio radiotext"
                                               value="yes" <?php checked( $settings['eighth'], 'yes' ); ?>>
                                        <div class="ibox_1">enable</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;"><?php _e( 'Related post', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <select id="neversettle_options[relpostid]" class="dropselect"
                                                name="neversettle_options[relpostid]">
											<?php
											foreach ( $inplace_postlist as $single_post ) :
												$label = $single_post['label'];
												echo '<option value="' . $single_post['value'] . '" ' . selected( $single_post['value'], $settings['relpostid'] ) . '>' . $label . '</option>';
											endforeach;
											?>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Related post link text', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[relpostlinktext]"
                                                           id="neversettle_options[relpostlinktext]"
                                                           class="textinput"
                                                           value="<?php echo $settings['relpostlinktext']; ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Related post custom background image url:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input placeholder="<?php _e( 'image url', 'inplace' ); ?>"
                                               class="selectupload" name="relpostback_button"
                                               id="neversettleplace_relpostback_button"
                                               value="<?php _e( 'Upload or Select', 'inplace' ); ?>" type="button"/>
                                        <br/>
                                        <em><?php _e( 'Upload Slider image with recommended size of 1920px X 500px', 'inplace' ); ?></em>
                                        <input type="text" name="neversettle_options[relpostback]"
                                               id="neversettle_options[relpostback]" class="textinput relpostback"
                                               value="<?php echo $settings['relpostback']; ?>"/>
										
										<?php if ( ! empty( $settings['relpostback'] ) ) { ?>
                                            <div id="neversettleplace_relpostback_template">
                                                <img src="<?php echo $settings['relpostback'] ?>"
                                                     id="neversettleplace_relpostback_image">
                                                <a id="neversettleplace_relpostback_remove" class="selectupload"
                                                   title="remove"
                                                   href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                            </div>
										<?php } else { ?>
                                            <div id="neversettleplace_relpostback_template" style="display:none">
                                                <img src="<?php $settings['relpostback']; ?>"
                                                     id="neversettleplace_relpostback_image">
                                                <a id="neversettleplace_relpostback_remove" class="selectupload"
                                                   title="remove"
                                                   href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                            </div>
										<?php } ?>
                                    </td>
                                </tr>

                            </table>

                            <div class="sectionlink"
                                 id="ninethlink"><?php _e( 'Testimonials category block', 'inplace' ); ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() ) ?>/lib/admin/images/nineth.png">
                            </div>

                            <table class="tableoptin" id="nineth">
                                <tr>
                                    <td><?php _e( 'Enable block:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input type="radio" name="neversettle_options[nineth]"
                                               class="radio radioimage"
                                               value="no" <?php checked( $settings['nineth'], 'no' ); ?>>
                                        <div class="ibox_1">disable</div>
                                        <input type="radio" name="neversettle_options[nineth]"
                                               class="radio radiotext"
                                               value="yes" <?php checked( $settings['nineth'], 'yes' ); ?>>
                                        <div class="ibox_1">enable</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;"><?php _e( 'Testimonials category:', 'inplace' ); ?></td>
                                    <td colspan="3"><?php wp_dropdown_categories( array(
											'name'       => 'neversettle_options[testimonials]',
											'id'         => 'neversettle_options[testimonials]',
											'selected'   => $settings['testimonials'],
											'hide_empty' => 0,
											'class'      => 'dropselect'
										) ); ?></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'News block title', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[testimonialtittle]"
                                                           id="neversettle_options[testimonialtittle]"
                                                           class="textinput"
                                                           value="<?php echo $settings['testimonialtittle']; ?>"/>
                                    </td>
                                </tr>

                            </table>

                            <div class="sectionlink" id="tenthlink"><?php _e( 'News category block', 'inplace' ); ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() ) ?>/lib/admin/images/tenth.png">
                            </div>

                            <table class="tableoptin" id="tenth">
                                <tr>
                                    <td><?php _e( 'Enable block:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input type="radio" name="neversettle_options[tenth]"
                                               class="radio radioimage"
                                               value="no" <?php checked( $settings['tenth'], 'no' ); ?>>
                                        <div class="ibox_1">disable</div>
                                        <input type="radio" name="neversettle_options[tenth]"
                                               class="radio radiotext"
                                               value="yes" <?php checked( $settings['tenth'], 'yes' ); ?>>
                                        <div class="ibox_1">enable</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;"><?php _e( 'News category:', 'inplace' ); ?></td>
                                    <td colspan="3"><?php wp_dropdown_categories( array(
											'name'       => 'neversettle_options[news_cat]',
											'id'         => 'neversettle_options[news_cat]',
											'selected'   => $settings['news_cat'],
											'hide_empty' => 0,
											'class'      => 'dropselect'
										) ); ?></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'News block title', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[newstitle]"
                                                           id="neversettle_options[newstitle]" class="textinput"
                                                           value="<?php echo $settings['newstitle']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'News block description', 'inplace' ); ?></td>
                                    <td colspan="3"><textarea name="neversettle_options[newsdescription]"
                                                              id="neversettle_options[newsdescription]" rows="2"
                                                              class="themeopt"><?php echo $settings['newsdescription']; ?></textarea>
                                    </td>
                                </tr>

                            </table>

                            <div class="sectionlink"
                                 id="eleventhlink"><?php _e( 'Last carousel category block', 'inplace' ); ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() ) ?>/lib/admin/images/eleventh.png">
                            </div>

                            <table class="tableoptin" id="eleventh">
                                <tr>
                                    <td><?php _e( 'Enable block:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input type="radio" name="neversettle_options[eleventh]"
                                               class="radio radioimage"
                                               value="no" <?php checked( $settings['eleventh'], 'no' ); ?>>
                                        <div class="ibox_1">disable</div>
                                        <input type="radio" name="neversettle_options[eleventh]"
                                               class="radio radiotext"
                                               value="yes" <?php checked( $settings['eleventh'], 'yes' ); ?>>
                                        <div class="ibox_1">enable</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;"><?php _e( 'Last carousel category:', 'inplace' ); ?></td>
                                    <td colspan="3"><?php wp_dropdown_categories( array(
											'name'       => 'neversettle_options[lastcat]',
											'id'         => 'neversettle_options[lastcat]',
											'selected'   => $settings['lastcat'],
											'hide_empty' => 0,
											'class'      => 'dropselect'
										) ); ?></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Last carousel title', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[lasttitle]"
                                                           id="neversettle_options[lasttitle]" class="textinput"
                                                           value="<?php echo $settings['lasttitle']; ?>"/></td>
                                </tr>

                            </table>

                            <div class="sectionlink"
                                 id="twelvethlink"><?php _e( 'Brands category block', 'inplace' ); ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() ) ?>/lib/admin/images/twelveth.png">
                            </div>

                            <table class="tableoptin" id="twelveth">
                                <tr>
                                    <td><?php _e( 'Enable block:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input type="radio" name="neversettle_options[twelveth]"
                                               class="radio radioimage"
                                               value="no" <?php checked( $settings['twelveth'], 'no' ); ?>>
                                        <div class="ibox_1">disable</div>
                                        <input type="radio" name="neversettle_options[twelveth]"
                                               class="radio radiotext"
                                               value="yes" <?php checked( $settings['twelveth'], 'yes' ); ?>>
                                        <div class="ibox_1">enable</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;"><?php _e( 'Brands category:', 'inplace' ); ?></td>
                                    <td colspan="3"><?php wp_dropdown_categories( array(
											'name'       => 'neversettle_options[brands_cat]',
											'id'         => 'neversettle_options[brands_cat]',
											'selected'   => $settings['brands_cat'],
											'hide_empty' => 0,
											'class'      => 'dropselect'
										) ); ?></td>
                                </tr>
                                <tr>
                                    <td><?php _e( '"Brand section" custom background image url:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input placeholder="<?php _e( 'image url', 'inplace' ); ?>"
                                               class="selectupload" name="brand_back_button"
                                               id="neversettleplace_brand_back_button"
                                               value="<?php _e( 'Upload or Select', 'inplace' ); ?>" type="button"/>
                                        <br/>
                                        <em><?php _e( 'Upload Slider image with recommended size of 1920px X 500px', 'inplace' ); ?></em>
                                        <input type="text" name="neversettle_options[brand_back]"
                                               id="neversettle_options[brand_back]" class="textinput brand_back"
                                               value="<?php echo $settings['brand_back']; ?>"/>
										
										<?php if ( ! empty( $settings['brand_back'] ) ) { ?>
                                            <div id="neversettleplace_brand_back_template">
                                                <img src="<?php echo $settings['brand_back'] ?>"
                                                     id="neversettleplace_brand_back_image">
                                                <a id="neversettleplace_brand_back_remove" class="selectupload"
                                                   title="remove"
                                                   href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                            </div>
										<?php } else { ?>
                                            <div id="neversettleplace_brand_back_template" style="display:none">
                                                <img src="<?php $settings['brand_back']; ?>"
                                                     id="neversettleplace_brand_back_image">
                                                <a id="neversettleplace_brand_back_remove" class="selectupload"
                                                   title="remove"
                                                   href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                            </div>
										<?php } ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="sliderset" style="display: none;">
                            <h3 class="admin-title">
                                <strong><?php _e( 'Header slider settings', 'inplace' ); ?></strong></h3>
                            <table class="tableopt">
                                <tr>
                                    <td style="width:20%;">
										<?php _e( 'Slider 1 settings:', 'inplace' ); ?>
                                    </td>
                                    <td style="width:63%;">
										<?php _e( 'Slider 1 image:', 'inplace' ); ?>
                                        <input placeholder="<?php _e( 'image url', 'inplace' ); ?>"
                                               class="selectupload" name="slider1_button"
                                               id="neversettleplace_slider1_button"
                                               value="<?php _e( 'Upload or Select', 'inplace' ); ?>" type="button"/>
                                        <br/>
                                        <em><?php _e( 'Upload Slider image with recommended size of 1920px X 800px', 'inplace' ); ?></em>
                                        <input type="text" name="neversettle_options[slider1img]"
                                               id="neversettle_options[slider1img]" class="textinput slider1"
                                               value="<?php echo $settings['slider1img']; ?>" readonly/>
										
										<?php if ( ! empty( $settings['slider1img'] ) ) { ?>
                                            <div id="neversettleplace_slider1_template">
                                                <img src="<?php echo $settings['slider1img'] ?>"
                                                     id="neversettleplace_slider1_image">
                                                <a id="neversettleplace_slider1_remove" class="selectupload"
                                                   title="remove"
                                                   href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                            </div>
										<?php } else { ?>
                                            <div id="neversettleplace_slider1_template" style="display:none">
                                                <img src="<?php $settings['slider1img']; ?>"
                                                     id="neversettleplace_slider1_image">
                                                <a id="neversettleplace_slider1_remove" class="selectupload"
                                                   title="remove"
                                                   href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                            </div>
										<?php } ?>
                                        <br>
										<?php _e( 'Slider 1 title:', 'inplace' ); ?>
                                        <input placeholder="<?php _e( 'title', 'inplace' ); ?>" type="text"
                                               name="neversettle_options[slider1title]"
                                               id="neversettle_options[slider1title]"
                                               class="textinput" value="<?php echo $settings['slider1title']; ?>"/>
										<?php _e( 'Slider 1 subtitle:', 'inplace' ); ?>
                                        <input placeholder="<?php _e( 'subtitle', 'inplace' ); ?>" type="text"
                                               name="neversettle_options[slider1subtitle]"
                                               id="neversettle_options[slider1subtitle]" class="textinput"
                                               value="<?php echo $settings['slider1subtitle']; ?>"/>
										<?php _e( 'Slider 1 text:', 'inplace' ); ?>
                                        <textarea placeholder="<?php _e( 'text', 'inplace' ); ?>"
                                                  name="neversettle_options[slider1text]"
                                                  id="neversettle_options[slider1text]"
                                                  class="themeopt"
                                                  rows="3"><?php echo $settings['slider1text']; ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
										<?php _e( 'Slider 2 settings:', 'inplace' ); ?>
                                    </td>
                                    <td>
										<?php _e( 'Slider 2 image:', 'inplace' ); ?>
                                        <input placeholder="<?php _e( 'image url', 'inplace' ); ?>"
                                               class="selectupload" name="slider2_button"
                                               id="neversettleplace_slider2_button"
                                               value="<?php _e( 'Upload or Select', 'inplace' ); ?>" type="button"/>
                                        <br/>
                                        <em><?php _e( 'Upload Slider image with recommended size of 1920px X 800px', 'inplace' ); ?></em>
                                        <input type="text" name="neversettle_options[slider2img]"
                                               id="neversettle_options[slider2img]" class="textinput slider2"
                                               value="<?php echo $settings['slider2img']; ?>" readonly/>
										
										<?php if ( ! empty( $settings['slider2img'] ) ) { ?>
                                            <div id="neversettleplace_slider2_template">
                                                <img src="<?php echo $settings['slider2img'] ?>"
                                                     id="neversettleplace_slider2_image">
                                                <a id="neversettleplace_slider2_remove" class="selectupload"
                                                   title="remove"
                                                   href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                            </div>
										<?php } else { ?>
                                            <div id="neversettleplace_slider2_template" style="display:none">
                                                <img src="<?php $settings['slider2img']; ?>"
                                                     id="neversettleplace_slider2_image">
                                                <a id="neversettleplace_slider2_remove" class="selectupload"
                                                   title="remove"
                                                   href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                            </div>
										<?php } ?>
                                        <br>
										<?php _e( 'Slider 2 title:', 'inplace' ); ?>
                                        <input placeholder="<?php _e( 'title', 'inplace' ); ?>" type="text"
                                               name="neversettle_options[slider2title]"
                                               id="neversettle_options[slider2title]"
                                               class="textinput" value="<?php echo $settings['slider2title']; ?>"/>
										<?php _e( 'Slider 2 subtitle:', 'inplace' ); ?>
                                        <input placeholder="<?php _e( 'subtitle', 'inplace' ); ?>" type="text"
                                               name="neversettle_options[slider2subtitle]"
                                               id="neversettle_options[slider2subtitle]" class="textinput"
                                               value="<?php echo $settings['slider2subtitle']; ?>"/>
										<?php _e( 'Slider 2 text:', 'inplace' ); ?>
                                        <textarea placeholder="<?php _e( 'text', 'inplace' ); ?>"
                                                  name="neversettle_options[slider2text]"
                                                  id="neversettle_options[slider2text]"
                                                  class="themeopt"
                                                  rows="3"><?php echo $settings['slider2text']; ?></textarea>
                                    </td>

                                <tr>
                                    <td>
										<?php _e( 'Slider 3 settings:', 'inplace' ); ?>
                                    </td>
                                    <td>
										<?php _e( 'Slider 3 image:', 'inplace' ); ?>
                                        <input placeholder="<?php _e( 'image url', 'inplace' ); ?>"
                                               class="selectupload" name="slider3_button"
                                               id="neversettleplace_slider3_button"
                                               value="<?php _e( 'Upload or Select', 'inplace' ); ?>" type="button"/>
                                        <br/>
                                        <em><?php _e( 'Upload Slider image with recommended size of 1920px X 800px', 'inplace' ); ?></em>
                                        <input type="text" name="neversettle_options[slider3img]"
                                               id="neversettle_options[slider3img]" class="textinput slider3"
                                               value="<?php echo $settings['slider3img']; ?>" readonly/>
										
										<?php if ( ! empty( $settings['slider3img'] ) ) { ?>
                                            <div id="neversettleplace_slider3_template">
                                                <img src="<?php echo $settings['slider3img'] ?>"
                                                     id="neversettleplace_slider3_image">
                                                <a id="neversettleplace_slider3_remove" class="selectupload"
                                                   title="remove"
                                                   href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                            </div>
										<?php } else { ?>
                                            <div id="neversettleplace_slider3_template" style="display:none">
                                                <img src="<?php $settings['slider3img']; ?>"
                                                     id="neversettleplace_slider3_image">
                                                <a id="neversettleplace_slider3_remove" class="selectupload"
                                                   title="remove"
                                                   href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                            </div>
										<?php } ?>
                                        <br>
										<?php _e( 'Slider 3 title:', 'inplace' ); ?>
                                        <input placeholder="<?php _e( 'title', 'inplace' ); ?>" type="text"
                                               name="neversettle_options[slider3title]"
                                               id="neversettle_options[slider3title]"
                                               class="textinput" value="<?php echo $settings['slider3title']; ?>"/>
										<?php _e( 'Slider 3 subtitle:', 'inplace' ); ?>
                                        <input placeholder="<?php _e( 'subtitle', 'inplace' ); ?>" type="text"
                                               name="neversettle_options[slider3subtitle]"
                                               id="neversettle_options[slider3subtitle]" class="textinput"
                                               value="<?php echo $settings['slider3subtitle']; ?>"/>
										<?php _e( 'Slider 3 text:', 'inplace' ); ?>
                                        <textarea placeholder="<?php _e( 'text', 'inplace' ); ?>"
                                                  name="neversettle_options[slider3text]"
                                                  id="neversettle_options[slider3text]"
                                                  class="themeopt"
                                                  rows="3"><?php echo $settings['slider3text']; ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
										<?php _e( 'Slider 4 settings:', 'inplace' ); ?>
                                    </td>
                                    <td>
										<?php _e( 'Slider 4 image:', 'inplace' ); ?>
                                        <input placeholder="<?php _e( 'image url', 'inplace' ); ?>"
                                               class="selectupload" name="slider4_button"
                                               id="neversettleplace_slider4_button"
                                               value="<?php _e( 'Upload or Select', 'inplace' ); ?>" type="button"/>
                                        <br/>
                                        <em><?php _e( 'Upload Slider image with recommended size of 1920px X 800px', 'inplace' ); ?></em>
                                        <input type="text" name="neversettle_options[slider4img]"
                                               id="neversettle_options[slider4img]" class="textinput slider4"
                                               value="<?php echo $settings['slider4img']; ?>" readonly/>
										
										<?php if ( ! empty( $settings['slider4img'] ) ) { ?>
                                            <div id="neversettleplace_slider4_template">
                                                <img src="<?php echo $settings['slider4img'] ?>"
                                                     id="neversettleplace_slider4_image">
                                                <a id="neversettleplace_slider4_remove" class="selectupload"
                                                   title="remove"
                                                   href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                            </div>
										<?php } else { ?>
                                            <div id="neversettleplace_slider4_template" style="display:none">
                                                <img src="<?php $settings['slider4img']; ?>"
                                                     id="neversettleplace_slider4_image">
                                                <a id="neversettleplace_slider4_remove" class="selectupload"
                                                   title="remove"
                                                   href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                            </div>
										<?php } ?>
                                        <br>
										<?php _e( 'Slider 4 title:', 'inplace' ); ?>
                                        <input placeholder="<?php _e( 'title', 'inplace' ); ?>" type="text"
                                               name="neversettle_options[slider4title]"
                                               id="neversettle_options[slider4title]"
                                               class="textinput" value="<?php echo $settings['slider4title']; ?>"/>
										<?php _e( 'Slider 4 subtitle:', 'inplace' ); ?>
                                        <input placeholder="<?php _e( 'subtitle', 'inplace' ); ?>" type="text"
                                               name="neversettle_options[slider4subtitle]"
                                               id="neversettle_options[slider4subtitle]" class="textinput"
                                               value="<?php echo $settings['slider4subtitle']; ?>"/>
										<?php _e( 'Slider 4 text:', 'inplace' ); ?>
                                        <textarea placeholder="<?php _e( 'text', 'inplace' ); ?>"
                                                  name="neversettle_options[slider4text]"
                                                  id="neversettle_options[slider4text]"
                                                  class="themeopt"
                                                  rows="3"><?php echo $settings['slider4text']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
										<?php _e( 'Slider 5 settings:', 'inplace' ); ?>
                                    </td>
                                    <td>
										<?php _e( 'Slider 5 image:', 'inplace' ); ?>
                                        <input placeholder="<?php _e( 'image url', 'inplace' ); ?>"
                                               class="selectupload" name="slider5_button"
                                               id="neversettleplace_slider5_button"
                                               value="<?php _e( 'Upload or Select', 'inplace' ); ?>" type="button"/>
                                        <br/>
                                        <em><?php _e( 'Upload Slider image with recommended size of 1920px X 800px', 'inplace' ); ?></em>
                                        <input type="text" name="neversettle_options[slider5img]"
                                               id="neversettle_options[slider5img]" class="textinput slider5"
                                               value="<?php echo $settings['slider5img']; ?>" readonly/>
										
										<?php if ( ! empty( $settings['slider5img'] ) ) { ?>
                                            <div id="neversettleplace_slider5_template">
                                                <img src="<?php echo $settings['slider5img'] ?>"
                                                     id="neversettleplace_slider5_image">
                                                <a id="neversettleplace_slider5_remove" class="selectupload"
                                                   title="remove"
                                                   href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                            </div>
										<?php } else { ?>
                                            <div id="neversettleplace_slider5_template" style="display:none">
                                                <img src="<?php $settings['slider5img']; ?>"
                                                     id="neversettleplace_slider5_image">
                                                <a id="neversettleplace_slider5_remove" class="selectupload"
                                                   title="remove"
                                                   href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                            </div>
										<?php } ?>
                                        <br>
										<?php _e( 'Slider 5 title:', 'inplace' ); ?>
                                        <input placeholder="<?php _e( 'title', 'inplace' ); ?>" type="text"
                                               name="neversettle_options[slider5title]"
                                               id="neversettle_options[slider5title]"
                                               class="textinput" value="<?php echo $settings['slider5title']; ?>"/>
										<?php _e( 'Slider 5 subtitle:', 'inplace' ); ?>
                                        <input placeholder="<?php _e( 'subtitle', 'inplace' ); ?>" type="text"
                                               name="neversettle_options[slider5subtitle]"
                                               id="neversettle_options[slider5subtitle]" class="textinput"
                                               value="<?php echo $settings['slider5subtitle']; ?>"/>
										<?php _e( 'Slider 5 text:', 'inplace' ); ?>
                                        <textarea placeholder="<?php _e( 'text', 'inplace' ); ?>"
                                                  name="neversettle_options[slider5text]"
                                                  id="neversettle_options[slider5text]"
                                                  class="themeopt"
                                                  rows="3"><?php echo $settings['slider5text']; ?></textarea>
                                    </td>
                                </tr>

                            </table>
                        </div>
                        <div id="contactset" style="display: none;">
                            <h3 class="admin-title"><strong><?php _e( 'Contacts settings', 'inplace' ); ?></strong>
                            </h3>
                            <table class="tableopt">
                                <tr>
                                    <td style="width:20%;"><?php _e( 'Admin email:', 'inplace' ); ?></td>
                                    <td style="width:63%;" colspan="3"><input type="text"
                                                                              name="neversettle_options[adminmail]"
                                                                              id="neversettle_options[adminmail]"
                                                                              class="textinput"
                                                                              value="<?php echo $settings['adminmail']; ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Facebook url:', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[facebook]"
                                                           id="neversettle_options[facebook]" class="textinput"
                                                           value="<?php echo $settings['facebook']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Twitter url:', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[twitter]"
                                                           id="neversettle_options[twitter]" class="textinput"
                                                           value="<?php echo $settings['twitter']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Pinterest url:', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[pinterest]"
                                                           id="neversettle_options[pinterest]" class="textinput"
                                                           value="<?php echo $settings['pinterest']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Instagram url:', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[instagram]"
                                                           id="neversettle_options[instagram]" class="textinput"
                                                           value="<?php echo $settings['instagram']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Contacts block title', 'inplace' ); ?></td>
                                    <td colspan="3"><input type="text" name="neversettle_options[contacttitle]"
                                                           id="neversettle_options[contacttitle]" class="textinput"
                                                           value="<?php echo $settings['contacttitle']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Contacts block description', 'inplace' ); ?></td>
                                    <td colspan="3"><textarea name="neversettle_options[contactdescription]"
                                                              id="neversettle_options[contactdescription]" rows="2"
                                                              class="themeopt"><?php echo $settings['contactdescription']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Map code', 'inplace' ); ?></td>
                                    <td colspan="3"><textarea name="neversettle_options[mapcode]"
                                                              id="neversettle_options[mapcode]" rows="5"
                                                              class="themeopt"><?php echo $settings['mapcode']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e( '"Contacts section" custom background image url:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input placeholder="<?php _e( 'image url', 'inplace' ); ?>"
                                               class="selectupload" name="contact_back_button"
                                               id="neversettleplace_contact_back_button"
                                               value="<?php _e( 'Upload or Select', 'inplace' ); ?>" type="button"/>
                                        <br/>
                                        <em><?php _e( 'Upload Slider image with recommended size of 1900px X 350px', 'inplace' ); ?></em>
                                        <input type="text" name="neversettle_options[contact_back]"
                                               id="neversettle_options[contact_back]" class="textinput contact_back"
                                               value="<?php echo $settings['contact_back']; ?>"/>
										
										<?php if ( ! empty( $settings['contact_back'] ) ) { ?>
                                            <div id="neversettleplace_contact_back_template">
                                                <img src="<?php echo $settings['contact_back'] ?>"
                                                     id="neversettleplace_contact_back_image">
                                                <a id="neversettleplace_contact_back_remove" class="selectupload"
                                                   title="remove"
                                                   href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                            </div>
										<?php } else { ?>
                                            <div id="neversettleplace_contact_back_template" style="display:none">
                                                <img src="<?php $settings['contact_back']; ?>"
                                                     id="neversettleplace_contact_back_image">
                                                <a id="neversettleplace_contact_back_remove" class="selectupload"
                                                   title="remove"
                                                   href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                            </div>
										<?php } ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="seoset" style="display: none;">
                            <h3 class="admin-title"><strong><?php _e( 'Theme seo meta', 'inplace' ); ?></strong>
                            </h3>
                            <table class="tableopt">
                                <tr>
                                    <td style="width:20%;"><?php _e( 'Inplace theme SEO meta:', 'inplace' ); ?></td>
                                    <td style="width:63%;" colspan="3">
                                        <input type="radio" name="neversettle_options[seo]" class="radio radioimage"
                                               value="no" <?php checked( $settings['seo'], 'no' ); ?>>
                                        <div class="ibox_1"><?php _e( 'disable', 'inplace' ); ?></div>
                                        <input type="radio" name="neversettle_options[seo]" class="radio radiotext"
                                               value="yes" <?php checked( $settings['seo'], 'yes' ); ?>>
                                        <div class="ibox_1"><?php _e( 'enable', 'inplace' ); ?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'SEO meta description:', 'inplace' ); ?></td>
                                    <td colspan="3"><textarea name="neversettle_options[seodescription]"
                                                              id="seodescription" rows="5"
                                                              class="themeopt"><?php echo $settings['seodescription']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'SEO meta keywords:', 'inplace' ); ?></td>
                                    <td colspan="3"><textarea name="neversettle_options[seowords]"
                                                              id="neversettle_options[seowords]" rows="5"
                                                              class="themeopt"><?php echo $settings['seowords']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'SEO revisit after:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <select class="dropselect" name="neversettle_options[seorevisit]"
                                                id="neversettle_options[seorevisit]">
                                            <option <?php selected( $settings['seorevisit'], '1' ); ?>>1</option>
                                            <option <?php selected( $settings['seorevisit'], '2' ); ?>>2</option>
                                            <option <?php selected( $settings['seorevisit'], '3' ); ?>>3</option>
                                            <option <?php selected( $settings['seorevisit'], '4' ); ?>>4</option>
                                            <option <?php selected( $settings['seorevisit'], '5' ); ?>>5</option>
                                            <option <?php selected( $settings['seorevisit'], '6' ); ?>>6</option>
                                            <option <?php selected( $settings['seorevisit'], '7' ); ?>>7</option>
                                            <option <?php selected( $settings['seorevisit'], '8' ); ?>>8</option>
                                            <option <?php selected( $settings['seorevisit'], '9' ); ?>>9</option>
                                            <option <?php selected( $settings['seorevisit'], '10' ); ?>>10</option>
                                            <option <?php selected( $settings['seorevisit'], '11' ); ?>>11</option>
                                            <option <?php selected( $settings['seorevisit'], '12' ); ?>>12</option>
                                            <option <?php selected( $settings['seorevisit'], '13' ); ?>>13</option>
                                            <option <?php selected( $settings['seorevisit'], '14' ); ?>>14</option>
                                            <option <?php selected( $settings['seorevisit'], '15' ); ?>>15</option>
                                            <option <?php selected( $settings['seorevisit'], '16' ); ?>>16</option>
                                            <option <?php selected( $settings['seorevisit'], '17' ); ?>>17</option>
                                            <option <?php selected( $settings['seorevisit'], '18' ); ?>>18</option>
                                            <option <?php selected( $settings['seorevisit'], '19' ); ?>>19</option>
                                            <option <?php selected( $settings['seorevisit'], '20' ); ?>>20</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Active Robots Indexing:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input type="radio" name="neversettle_options[seorobots]"
                                               class="radio radioimage"
                                               value="no" <?php checked( $settings['seorobots'], 'no' ); ?>>
                                        <div class="ibox_1"><?php _e( 'disable', 'inplace' ); ?></div>
                                        <input type="radio" name="neversettle_options[seorobots]"
                                               class="radio radiotext"
                                               value="yes" <?php checked( $settings['seorobots'], 'yes' ); ?>>
                                        <div class="ibox_1"><?php _e( 'enable', 'inplace' ); ?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'General Bot Indexing Type:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <select class="dropselect" name="neversettle_options[seogeneralbot]"
                                                id="neversettle_options[seogeneralbot]">
                                            <option <?php selected( $settings['seogeneralbot'], 'none' ); ?>>none
                                            </option>
                                            <option <?php selected( $settings['seogeneralbot'], 'index,follow' ); ?>>
                                                index,follow
                                            </option>
                                            <option <?php selected( $settings['seogeneralbot'], 'index,nofollow' ); ?>>
                                                index,nofollow
                                            </option>
                                            <option <?php selected( $settings['seogeneralbot'], 'index,all' ); ?>>
                                                index,all
                                            </option>
                                            <option <?php selected( $settings['seogeneralbot'], 'index,follow,archive' ); ?>>
                                                index,follow,archive
                                            </option>
                                            <option <?php selected( $settings['seogeneralbot'], 'noindex,follow' ); ?>>
                                                noindex,follow
                                            </option>
                                            <option <?php selected( $settings['seogeneralbot'], 'noindex,nofollow' ); ?>>
                                                noindex,nofollow
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Google Bot Indexing Type:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <select class="dropselect" name="neversettle_options[seogooglebot]"
                                                id="neversettle_options[seogooglebot]">
                                            <option <?php selected( $settings['seogooglebot'], 'none' ); ?>>none
                                            </option>
                                            <option <?php selected( $settings['seogooglebot'], 'index,follow' ); ?>>
                                                index,follow
                                            </option>
                                            <option <?php selected( $settings['seogooglebot'], 'index,nofollow' ); ?>>
                                                index,nofollow
                                            </option>
                                            <option <?php selected( $settings['seogooglebot'], 'index,all' ); ?>>
                                                index,all
                                            </option>
                                            <option <?php selected( $settings['seogooglebot'], 'index,follow,archive' ); ?>>
                                                index,follow,archive
                                            </option>
                                            <option <?php selected( $settings['seogooglebot'], 'noindex,follow' ); ?>>
                                                noindex,follow
                                            </option>
                                            <option <?php selected( $settings['seogooglebot'], 'noindex,nofollow' ); ?>>
                                                noindex,nofollow
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Msn Bot Indexing Type:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <select class="dropselect" name="neversettle_options[seomsnbot]"
                                                id="neversettle_options[seomsnbot]">
                                            <option <?php selected( $settings['seomsnbot'], 'none' ); ?>>none
                                            </option>
                                            <option <?php selected( $settings['seomsnbot'], 'index,follow' ); ?>>
                                                index,follow
                                            </option>
                                            <option <?php selected( $settings['seomsnbot'], 'index,nofollow' ); ?>>
                                                index,nofollow
                                            </option>
                                            <option <?php selected( $settings['seomsnbot'], 'index,all' ); ?>>
                                                index,all
                                            </option>
                                            <option <?php selected( $settings['seomsnbot'], 'index,follow,archive' ); ?>>
                                                index,follow,archive
                                            </option>
                                            <option <?php selected( $settings['seomsnbot'], 'noindex,follow' ); ?>>
                                                noindex,follow
                                            </option>
                                            <option <?php selected( $settings['seomsnbot'], 'noindex,nofollow' ); ?>>
                                                noindex,nofollow
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="additionalset" style="display: none;">
                            <h3 class="admin-title">
                                <strong><?php _e( 'Additional settings', 'inplace' ); ?></strong></h3>
                            <table class="tableopt">
                                <tr>
                                    <td style="width:20%;"><?php _e( 'Custom css code:', 'inplace' ); ?></td>
                                    <td style="width:63%;" colspan="3"><textarea name="neversettle_options[css]"
                                                                                 id="neversettle_options[css]"
                                                                                 rows="5"
                                                                                 class="themeopt"><?php echo $settings['css']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Stats code (e.g.Google):', 'inplace' ); ?></td>
                                    <td colspan="3"><textarea name="neversettle_options[analytics]"
                                                              id="neversettle_options[analytics]" rows="5"
                                                              class="themeopt"><?php echo $settings['analytics']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Under Construction mode:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input type="radio" name="neversettle_options[underconstruct]"
                                               class="radio radioimage"
                                               value="no" <?php checked( $settings['underconstruct'], 'no' ); ?>>
                                        <div class="ibox_1">disable</div>
                                        <input type="radio" name="neversettle_options[underconstruct]"
                                               class="radio radiotext"
                                               value="yes" <?php checked( $settings['underconstruct'], 'yes' ); ?>>
                                        <div class="ibox_1">enable</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Construction Templates:', 'inplace' ); ?></td>
                                    <td><img style="width:100%;"
                                             src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/1.jpg">
                                    </td>
                                    <td><img style="width:100%;"
                                             src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/2.jpg">
                                    </td>
                                    <td><img style="width:100%;"
                                             src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/3.jpg">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td style="text-align: center;">stopper 1</td>
                                    <td style="text-align: center;">stopper 2</td>
                                    <td style="text-align: center;">stopper 3</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td style="text-align: center;"><input type="radio"
                                                                           name="neversettle_options[constructtemplate]"
                                                                           value="stopper-1" <?php checked( $settings['constructtemplate'], 'stopper-1' ); ?>>
                                    </td>
                                    <td style="text-align: center;"><input type="radio"
                                                                           name="neversettle_options[constructtemplate]"
                                                                           value="stopper-2" <?php checked( $settings['constructtemplate'], 'stopper-2' ); ?>>
                                    </td>
                                    <td style="text-align: center;"><input type="radio"
                                                                           name="neversettle_options[constructtemplate]"
                                                                           value="stopper-3" <?php checked( $settings['constructtemplate'], 'stopper-3' ); ?>>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Stopper background image:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input placeholder="<?php _e( 'image url', 'inplace' ); ?>"
                                               class="selectupload" name="stopback_button"
                                               id="neversettleplace_stopback_button"
                                               value="<?php _e( 'Upload or Select', 'inplace' ); ?>" type="button"/>
                                        <br/>
                                        <em><?php _e( 'Upload image with recommended size of 1920px X 1100px', 'inplace' ); ?></em>
                                        <input type="text" name="neversettle_options[stopback]"
                                               id="neversettle_options[stopback]" class="textinput stopback"
                                               value="<?php echo $settings['stopback']; ?>"/>
										
										<?php if ( ! empty( $settings['stopback'] ) ) { ?>
                                            <div id="neversettleplace_stopback_template">
                                                <img src="<?php echo $settings['stopback'] ?>"
                                                     id="neversettleplace_stopback_image">
                                                <a id="neversettleplace_stopback_remove" class="selectupload"
                                                   title="remove"
                                                   href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                            </div>
										<?php } else { ?>
                                            <div id="neversettleplace_stopback_template" style="display:none">
                                                <img src="<?php $settings['stopback']; ?>"
                                                     id="neversettleplace_stopback_image">
                                                <a id="neversettleplace_stopback_remove" class="selectupload"
                                                   title="remove"
                                                   href="javascript:void(0)"><?php _e( 'Remove', 'inplace' ); ?></a>
                                            </div>
										<?php } ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Date of website open:', 'inplace' ); ?></td>
                                    <td colspan="3">
                                        <input type="date" name="neversettle_options[constructdate]"
                                               id="neversettle_options[constructdate]"
                                               value="<?php echo $settings['constructdate']; ?>" class="textinput">
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div id="supportset" style="display: none;">
                            <h3 class="admin-title"><strong>Inplace Theme Support</strong></h3>
                            <form method="post">
                                <table class="tableopt">
                                    <tr>
                                        <td>Have problems with Inplace theme?</td>
                                    </tr>
                                    <tr>
                                        <td>Check our neversettlePlace support page - <a
                                                    href="http://neversettleplace.net"
                                                    target="_blank">neversettleplace.net</a>
                                            You can add your question to our support team or look for your question
                                            in FAQ section
                                        </td>
                                    </tr>
									<?php if ( isset( $_POST['submitsupport'] ) && isset( $_POST['supportsubject'] ) && isset( $_POST['supportmessage'] ) ) {
										send_support_mail( $_POST['supportsubject'], $_POST['supportmessage'] );
										?>
                                        <tr>
                                            <td><strong>Your message has been sent to our support team.
                                                    <br>We'll contact you by e-mail
                                                    (if you set an option "admin e-mail" you'll get an answer on
                                                    this e-mail, else you'll get an answer on e-mail that you
                                                    entered for wordpress admin user)</strong>
                                            </td>
                                        </tr>
									<?php } else {
										?>
                                        <tr>
                                            <td>
                                                Or you can just print your question in this form and our support
                                                team will receive it. <br>Once our team will have an answer for you,
                                                they will contact you by e-mail
                                                (if you set an option "admin e-mail" you'll get an answer on this
                                                e-mail, else you'll get an answer on e-mail that you entered for
                                                wordpress admin user)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong><?php _e( 'Subject', 'inplace' ); ?></strong>
                                                <input type="text" name="supportsubject" class="textinput"
                                                       placeholder="Enter the subject of message..."/>
                                            <td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong><?php _e( 'Message', 'inplace' ); ?></strong>
                                                <textarea
                                                        placeholder="Describe the problem you've got with Inplace theme..."
                                                        name="supportmessage" rows="5" class="themeopt"></textarea>
                                            <td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="submit" name="submitsupport" class="saveoptions"
                                                       formaction="" value="Send Message">
                                            <td>
                                        </tr>
									<?php } ?>
                                </table>
                            </form>
                        </div>

                        <input id="savesettings" type="submit" class="saveoptions"
                               value="<?php _e( 'Save Options', 'inplace' ); ?>"/>
                    </div>

                </div>

            </form>

        </div>
		
		<?php
	}
	
	function neversettle_validate_options( $input ) {
		global $neversettle_options;
		
		$settings = get_option( 'neversettle_options', $neversettle_options );
		
		// Save with possible html tags
		//$input['copyright_text'] = htmlspecialchars( $input['copyright_text'] );
		
		//$input['analytics'] = htmlspecialchars( $input['analytics'] );
		
		return $input;
	}

endif;  // EndIf is_admin()