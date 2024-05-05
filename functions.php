<?php

/**
 * pixsquare functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pixsquare
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}
//////////////////////////////////////////////////////////
/**
 *投稿への目次の追加
 */
function pixsquare_add_index($content)
{

	if (!(is_single())) return $content;

	$content = get_post_field('post_content', get_the_ID());
	preg_match_all('/<(h[1-6]).*?>(.*?)<\/h[1-6]>/', $content, $matches);
	//var_dump($matches);
	$tabBlank = array('h1' => '', 'h2' => '  ', 'h3' => '   ', 'h4' => '    ', 'h5' => '     ', 'h6' => '      ');

	// H1-H3タグが存在する場合に目次を表示
	if (!empty($matches[0])) :
?>
		<div class="post-toc">
			<h2>目次</h2>
			<ul>
				<?php foreach ($matches[2] as $index => $heading) : ?>
					<?php $id = sanitize_title_with_dashes($heading); ?>
					<li><a href="#<?php echo $id; ?>"><?php echo $tabBlank[$matches[1][$index]] . strip_tags($heading); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php
	endif;

	$pattern = '/(<h[1-6])(.+?>)(.+?)(<\/h[1-6]>)/s';
	preg_match_all($pattern, $content, $elements, PREG_SET_ORDER);
	//elementsの数だけループ
	foreach ($elements as $em) {
		$id = sanitize_title_with_dashes($em[3]);
		$hPlusId = $em[1] . " id=" . $id . " " . $em[2] . $em[3] . $em[4];
		$content = str_replace($em[0], $hPlusId, $content);
	}

	return $content;
}
add_filter('the_content', 'pixsquare_add_index');

/////////////////////////////////////////////////////////

/**
 *画像代替テキスト編集機能
 */
//nonceの導入
function pixsquare_enqueue_imgAltText_script()
{
	wp_enqueue_script('pixsquare_y_imgAltText-script', get_template_directory_uri() . '/set_imgAltText/set_imgAltText.js', array('jquery'), '', true);
	wp_localize_script('pixsquare_y_imgAltText-script', 'wpData', array(
		'url_dbUpdate' => get_template_directory_uri() .  '/set_imgAltText/regist_tbl_imgAltText.php',
		'nonce'   => wp_create_nonce('my-custom-nonce'),
	));
}
add_action('admin_enqueue_scripts', 'pixsquare_enqueue_imgAltText_script');


// ## メディアライブラリにカスタムセクションの追加
function pixsquare_add_mediaLibrary_customSection()
{


	add_action('admin_head', 'set_mediaLibrary_customSection_imgAltText');
}
add_action('admin_menu', 'pixsquare_add_mediaLibrary_customSection');

include(get_template_directory() . '/set_imgAltText/set_mediaLibrary_customSection_imgAltText.php');




// ## パンくずリスト
//////////////////////////////////////////////////////////
function pixsquare_breadcrumb()
{
	$home = '<li><a href="' . home_url('url') . '" >HOME</a></li>';

	echo '<ul class="create_bread">';
	if (is_front_page()) {
		// トップページの場合は表示させない
	}
	// カテゴリページ
	else if (is_category()) {
		$cat = get_queried_object();
		$cat_id = $cat->parent;
		$cat_list = array();
		while ($cat_id != 0) {
			$cat = get_category($cat_id);
			$cat_link = get_category_link($cat_id);
			array_unshift($cat_list, '<li><a href="' . $cat_link . '">' . $cat->name . '</a></li>');
			$cat_id = $cat->parent;
		}
		echo $home;
		foreach ($cat_list as $value) {
			echo $value;
		}
		the_archive_title('<li>', '</li>');
	}
	// アーカイブ・タグページ
	else if (is_archive()) {
		echo $home;
		the_archive_title('<li>', '</li>');
	}
	// 投稿ページ
	else if (is_single()) {
		$cat = get_the_category();
		if (isset($cat[0]->cat_ID)) $cat_id = $cat[0]->cat_ID;
		$cat_list = array();
		while ($cat_id != 0) {
			$cat = get_category($cat_id);
			$cat_link = get_category_link($cat_id);
			array_unshift($cat_list, '<li><a href="' . $cat_link . '">' . $cat->name . '</a></li>');
			$cat_id = $cat->parent;
		}
		foreach ($cat_list as $value) {
			echo $value;
		}
		the_title('<li>', '</li>');
	}
	// 固定ページ
	else if (is_page()) {
		echo $home;
		the_title('<li>', '</li>');
	}
	// 404ページの場合
	else if (is_404()) {
		echo $home;
		echo '<li>ページが見つかりません</li>';
	}
	echo "</ul>";
}
// アーカイブのタイトルを削除
add_filter('get_the_archive_title', function ($title) {
	if (is_category()) {
		$title = single_cat_title('', false);
	} elseif (is_tag()) {
		$title = single_tag_title('', false);
	} elseif (is_month()) {
		$title = single_month_title('', false);
	}
	return $title;
});

//////////////////////////////////////////////////////////














/////////////////////////////////////////////
// ## 配色カスタマイズ
add_action('customize_register', 'pixsquare_theme_customize');

function pixsquare_theme_customize($wp_customize)
{

	$wp_customize->add_section('base_pattern_section', array(
		'title'    => __('ベース配色パターン', 'pixsquare'),
		'priority' => 30,
		'description' => '選択したベース配色はサイト全体に反映されます。',
	));

	//type theme_modにするとwp_optionsにテーマ設定として値が格納される。
	$wp_customize->add_setting('base_color_setting', array(
		'type'  => 'theme_mod',
		'sanitize_callback' => 'pixsquare_sanitize_choices',
	));

	$wp_customize->add_control('base_color_setting', array(
		'section' => 'base_pattern_section',
		'settings' => 'base_color_setting',
		'label' => 'ベース配色設定',
		'description' => '配色を選択してください。',
		'type' => 'radio',
		'choices' => array(
			'pattern1' => 'なし',
			'pattern2' => 'シンプル',
			'pattern3' => 'ファッション',
			'pattern4' => '信頼',
		),
	));

	//	  アイコン化する場合
	//	'choices' => array(
	//											'radio1' => 'https://example_setting.com/image/radio1.png', 
	//											'radio2' => 'https://example_setting.com/image/radio2.png', 
	//											'radio3' => 'https://example_setting.com/image/radio3.png'
	//										  )

}


/* テーマカスタマイザー用のサニタイズ関数
---------------------------------------------------------- */
//ラジオボタン
function pixsquare_sanitize_choices($input, $setting)
{
	global $wp_customize;
	$control = $wp_customize->get_control($setting->id);
	if (array_key_exists($input, $control->choices)) {
		return $input;
	} else {
		return $setting->default;
	}
}

function pixsquare_your_theme_enqueue_custom_css()
{
	//$base_pattern = get_option('op_base_color_setting', 'pattern1');
	$base_pattern = get_theme_mod('base_color_setting', 'pattern1');

	// パターンに応じてCSSファイルを読み込む
	wp_enqueue_style('custom-pattern', get_template_directory_uri() . '/css/' . $base_pattern . '.css', array(), '1.0.0');
	//var_dump(get_template_directory_uri() . '/css/' . $base_pattern . '.css');
}

add_action('wp_enqueue_scripts', 'pixsquare_your_theme_enqueue_custom_css');

//////////////////////////////////////////////////////////////////////////////



































// ## コピーライト対応
//////////////////////////////////////////////////////////////////////////////////
function pixsquare_add_custom_menu_page()
{
	?>
	<div class="wrap">
		<h2>Copy Rightの設定</h2>
		<form method="post" action="options.php" enctype="multipart/form-data" encoding="multipart/form-data">
			<?php
			settings_fields('custom-menu-group');
			do_settings_sections('custom-menu-group'); ?>
			<div class="metabox-holder">
				<p>Copy Rightを入力してください。</p>
				<p><input type="text" id="copy_right" name="copy_right" value="<?php echo get_option('copy_right'); ?>"></p>
			</div>
			<?php submit_button(); ?>
		</form>
	</div>
<?php
}

function pixsquare_register_custom_setting()
{
	register_setting('custom-menu-group', 'copy_right');
}


function pixsquare_custom_menu_page()
{
	add_submenu_page('themes.php', 'フッダー設定', 'フッダー', 'manage_options', 'custom_menu_page', 'pixsquare_add_custom_menu_page',  5);
	add_action('admin_init', 'pixsquare_register_custom_setting');
}

add_action('admin_menu', 'pixsquare_custom_menu_page');

//////////////////////////////////////////////////////////////////////////////////































/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pixsquare_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on pixsquare, use a find and replace
		* to change 'pixsquare' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('pixsquare', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'pixsquare'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'pixsquare_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// resolve of  theme check _s
	add_theme_support("wp-block-styles");
	add_theme_support("responsive-embeds");
	add_theme_support("align-wide");
	// resolve of  theme check _e

}
add_action('after_setup_theme', 'pixsquare_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pixsquare_content_width()
{
	$GLOBALS['content_width'] = apply_filters('pixsquare_content_width', 640);
}
add_action('after_setup_theme', 'pixsquare_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pixsquare_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'pixsquare'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'pixsquare'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'pixsquare_widgets_init');



///////////////////////////////////////////////////////////////////////////////
//## スタイルシート、JSファイルの追加
/**
 * Enqueue scripts and styles.
 */
function pixsquare_scripts()
{

	//add y_add_s
	wp_enqueue_style('pixsquare-y_style', get_template_directory_uri() . '/css/pixsquare.css', array(), false);
	wp_enqueue_style('pixsquare-y_style_gallery', get_template_directory_uri() . '/css/pixsquare_gallery.css', array(), false);


	wp_enqueue_style('pixsquare-y_style_font_awesome', 'https://use.fontawesome.com/releases/v5.15.4/css/all.css', array(), false);
	wp_enqueue_script('pixsquare-y_font_awesome', ' https://use.fontawesome.com/releases/v5.15.4/js/all.js', array(), false, true);
	//add y_add_e

	wp_enqueue_style('pixsquare-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('pixsquare-style', 'rtl', 'replace');


	// y add_share_s
	//add for lightbox_s
	wp_enqueue_style('pixsquare-y_lightbox_style', get_template_directory_uri() . '/lightbox/css/lightbox.min.css', array(), false);
	wp_enqueue_script('pixsquare-y_lightbox_js',    get_template_directory_uri() . '/lightbox/js/lightbox-plus-jquery.min.js', array(), false, false);
	//add for lightbox_e


	// ui control s
	wp_enqueue_script('pixsquare-hamburger',   get_template_directory_uri() . '/js/hamburger.js',   array(), _S_VERSION, true);
	wp_enqueue_script('pixsquare-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('pixsquare-page-top',   get_template_directory_uri() . '/js/page-top.js',   array(), _S_VERSION, true);
	// ui control e

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'pixsquare_scripts');
/////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}




//////////////////////////////////////////////////////////////////////////////////
function pixsquare_add_my_editor_styles()
{
	add_theme_support('editor-styles');
	add_editor_style(get_theme_file_uri('/style.css'));
	add_editor_style(get_theme_file_uri('/css/pixsuqre.css'));
	add_editor_style(get_theme_file_uri('/css/pixsuqre_gallery.css'));
	add_editor_style(get_theme_file_uri('https://use.fontawesome.com/releases/v5.15.4/css/all.css'));
	add_editor_style(get_theme_file_uri(get_template_directory_uri() . '/lightbox/css/lightbox.min.css'));
}
add_action('admin_init', 'pixsquare_add_my_editor_styles');
//////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////

//for localization 
function pixsquare_my_load_textdomain()
{
	$ret = load_theme_textdomain('pixsquare', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'pixsquare_my_load_textdomain');


///////////////////////////////////////////////