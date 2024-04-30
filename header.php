<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pcolor
 */

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">-->
	<link rel="profile" href="https://gmpg.org/xfn/11">



	<!-- ハンバーガーメニュー _s -->
	<div class="drawer">
	    <!-- ハンバーガーメニューの表示・非表示を切り替えるチェックボックス -->
	    <input type="checkbox" id="drawer-check" class="drawer-hidden" >

	    <!-- ハンバーガーアイコン -->
	    <label for="drawer-check" class="drawer-open"><span></span></label>
	 </div>
	<!-- ハンバーガーメニュー _e -->


	<?php wp_head(); ?>
</head>

<body <?php body_class('createpc createp1 createp2 createp3 createp4 createp5'); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'pcolor' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php

			if (has_custom_logo()) :	
				the_custom_logo();
			else :
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
			endif;


			$pcolor_description = get_bloginfo( 'description', 'display' );
			if ( $pcolor_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $pcolor_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'pcolor' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id' => 'gNavi',
					'container_class' => 'clearfix',
				)
			);
			?>
		</nav><!-- #site-navigation -->

		<!-- ハンバーガーメニューjs _s -->
		<script>
			// スマートフォン用のハンバーガーアイコン制御
			const drawerInput = document.getElementById('drawer-check');
			const navList = document.querySelector('.menu');
			const drawerOpen = document.querySelector('.drawer-open');

			drawerOpen.addEventListener('click', () => {
			navList.classList.toggle('active');
			});
		</script>
		<!-- ハンバーガーメニューjs _e -->
	</header><!-- #masthead -->
