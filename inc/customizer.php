<?php
/**
 * pixsquare Theme Customizer
 *
 * @package pixsquare
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */




function pixsquare_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'pixsquare_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'pixsquare_customize_partial_blogdescription',
			)
		);
	}

	///// copy right _s
	// フッダー設定セクションを追加
	$wp_customize->add_section('footer_settings_section', array(
		'title'      => __('footer setting', 'pixsquare'),
		'priority'   => 30,
	));

	// コピーライト設定を追加
	$wp_customize->add_setting('copy_right', array(
		'default'    => '',
		'sanitize_callback' => 'sanitize_text_field',
	));

	// コピーライト入力フィールドを追加
	$wp_customize->add_control('copy_right_control', array(
		'label'      => __('Copy Right setting', 'pixsquare'),
		'section'    => 'footer_settings_section',
		'settings'   => 'copy_right',
		'type'       => 'text',
	));
	///// copy right _e

}
add_action( 'customize_register', 'pixsquare_customize_register' );



/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function pixsquare_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function pixsquare_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pixsquare_customize_preview_js() {
	wp_enqueue_script( 'pixsquare-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'pixsquare_customize_preview_js' );
