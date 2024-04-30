<?php /* Template Name: Entrance用テンプレート */ ?>

<?php
/**
 * The template for displaying works of costum template .
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pcolor
 */

get_header();
?>
	<!-- template-entrance.php-->
	<main id="primary" class="site-main-costum-entrance">

		<?php

		while ( have_posts() ) :
			the_post();

		
			////////////////////
			//display content
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->

				<?php if ( get_edit_post_link() ) : ?>
					<footer class="entry-footer">
						<?php
						edit_post_link(
							sprintf(
								wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers */
									__( 'Edit <span class="screen-reader-text">%s</span>', 'pcolor' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								wp_kses_post( get_the_title() )
							),
							'<span class="edit-link">',
							'</span>'
						);
						?>
					</footer><!-- .entry-footer -->
				<?php endif; ?>
			</article><!-- #post-<?php the_ID(); ?> -->

		<?php
			///////////////////
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
