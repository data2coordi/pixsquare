<?php /* Template Name: Works用テンプレート */ ?>

<?php
/**
 * The template for displaying works of costum template .
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pixsquare
 */

get_header();
?>
	<!-- template-works.php -->
	<main id="primary" class="site-main-costum-works">


		


		<?php



		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'page_costum_works' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		endwhile; // End of the loop.
		?>
  <button id="js-pagetop" class="pagetop"><span class="pagetop__arrow"></span></button>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();

?>
<script>
$(function () {
  lightbox.option({
    'alwaysShowNavOnTouchDevices': false,
    'albumLabel': 'ギャラリー： %1 of %2',
    'disableScrolling': false,
    'fadeDuration': 600,
    'fitImagesInViewport': false,
    'imageFadeDuration': 600,
    'maxWidth': 400,
    'maxHeight': 400,
    'positionFromTop': 50,
    'resizeDuration': 700,
    'showImageNumberLabel': true,
    'wrapAround': false,
  });
});

</script>
