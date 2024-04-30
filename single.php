<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Pcolor
 */

get_header();
?>
	<!--single.php -->
	<main id="primary" class="site-main">

<?php
// 投稿本文を取得
$content = get_post_field('post_content', get_the_ID());

// 投稿本文からH1タグを抽出
preg_match_all('/<h1.*?>(.*?)<\/h1>/', $content, $matches);

// H1タグが存在する場合に目次を表示
if (!empty($matches[0])) :
?>
    <div class="post-toc">
        <h2>目次</h2>
        <ul>
            <?php foreach ($matches[1] as $index => $heading) : ?>
                <?php $id = sanitize_title_with_dashes($heading); ?>
                <li><a href="#<?php echo $id; ?>"><?php echo strip_tags($heading); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; 


		//ぱんくず
		breadcrumb(); 
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'pcolor' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'pcolor' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

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
