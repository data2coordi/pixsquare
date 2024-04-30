<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pixsquare
 */

?>

	<footer id="colophon" class="site-footer">

		<div class="site-info">

			
			<?php echo "<br>" . get_option('copy_right'); ?>
			<br>
			<span class="sep">  </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'pixsquare' ), 'Create', '<a class="create_footer" href="https://color.toshidayurika.com/">Yurika Toshida at Aurora Lab</a>' );
				?>
			<a  class="create_footer" href="<?php echo esc_url( __( 'https://wordpress.org/', 'pixsquare' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'pixsquare' ), 'WordPress' );
				?>
			</a>
			<script>
			$(function () {
  $("#js-pagetop").click(function () {
    $('html, body').animate({
      scrollTop: 0
    }, 300);
  });
  $(window).scroll(function () {
    if ($(window).scrollTop() > 1) {
      $('#js-pagetop').fadeIn(300).css('display', 'flex')
    } else {
      $('#js-pagetop').fadeOut(300)
    }
  });
});
 </script>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
