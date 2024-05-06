<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package pixsquare
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php if (have_posts()) : ?>

		<header class="page-header">
			<h1 class="page-title">
				<?php
				/* translators: %s: search query. */
				printf(esc_html__('Search Results for: %s', 'pixsquare'), '<span>' . get_search_query() . '</span>');
				?>
			</h1>
		</header><!-- .page-header -->

		<?php


		/* Start the Loop */
		//////////////////////////

		while (have_posts()) {
			the_post();
		?>
			<div class="bl_card_container">
				<!-- 左側のカラム：画像 -->
				<div class="bl_card_column">
					<a href="<?php the_permalink(); ?>" class="bl_card_link">
						<figure class="bl_card_imgWrapper">
							<img src="<?php the_post_thumbnail_url(); ?>" alt="">
						</figure>
					</a>
				</div>

				<!-- 右側のカラム：本文 -->
				<div class="bl_card_column">
					<article class="bl_card">
						<div class="bl_card_body">
							<?php the_title('<h3 class="bl_card_ttl">', '</h3>'); ?>
							<span class="entry-date"><?php echo get_the_date(); ?></span>
							<p class="bl_card_txt"><?php echo get_the_excerpt(); ?></p>
							<a href="<?php the_permalink(); ?>">続きを読む</a>
						</div>
					</article>
				</div>
			</div>
			<button id="js-pagetop" class="pagetop"><span class="pagetop__arrow"></span></button>
	<?php
		}

		the_posts_pagination( //ページャーを出力
			array(
				'mid_size'      => 2, // 現在ページの左右に表示するページ番号の数
				'prev_next'     => true, // 「前へ」「次へ」のリンクを表示する場合はtrue
				'prev_text'     => 'prev', // 「前へ」リンクのテキスト
				'next_text'     => 'next', // 「次へ」リンクのテキスト
				//'prev_text'     => __( 'prev'), // 「前へ」リンクのテキスト
				//'next_text'     => __( 'next'), // 「次へ」リンクのテキスト
				'type'          => 'plain', // 戻り値の指定 (plain/list)
			)
		);

	//////////////////////////

	else :

		get_template_part('template-parts/content', 'none');

	endif;
	?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
