<?php /* Template Name: New Information */ ?>

<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pixsquare
 */

get_header();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<?php if (comments_open() || get_comments_number()) : ?>
		<div class="comments-area">
			<?php comments_template(); ?>
		</div><!-- .comments-area -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->



<!--template-arc-inforlist.php-->
<main id="primary" class="site-main">
	<?php


	the_content();




	// 取得したい内容を配列に記載します（不要箇所は省略可）
	$args = array(
		'posts_per_page'   => 3, // 読み込みしたい記事数（全件取得時は-1）
		'order'            => 'DESC' // 昇順(ASC)か降順か(DESC）
	);

	// 配列で指定した内容で、記事情報を取得
	$the_query = new WP_Query($args);

	if ($the_query->have_posts()) :
		echo ("<table class='infotable'>");
		echo ('<tr><th>日付</th><th>タイトル</th></tr>');

		while ($the_query->have_posts()) {
			$the_query->the_post();
			echo ('<tr>');
			echo ('<td>' . get_the_date() . '</td>');
			echo ('<td><a href="' . get_permalink() . '">' . get_the_title() . '</a></td>');
			echo ('</tr>');
		}

		echo ("</table>");

	endif;

	wp_reset_postdata();


	// 取得したい内容を配列に記載します（不要箇所は省略可）
	$args = array(
		'posts_per_page'   => 3, // 読み込みしたい記事数（全件取得時は-1）
		//'orderby'          => 'ID', // 何順で記事を読み込むか（省略時は日付順）
		'order'            => 'DESC' // 昇順(ASC)か降順か(DESC）
	);

	// 配列で指定した内容で、記事情報を取得
	$the_query = new WP_Query($args);

	if ($the_query->have_posts()) :



		while ($the_query->have_posts()) {
			$the_query->the_post();
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
						<?php the_title('<h3 class="bl_card_ttl">', '</h3>'); ?>
						<div class="bl_card_body">
							<span class="entry-date"><?php echo get_the_date(); ?></span>
							<p class="bl_card_txt"><?php echo get_the_excerpt(); ?></p>
							<a href="<?php the_permalink(); ?>">続きを読む</a>
						</div>
					</article>
				</div>
			</div>
			<button class="pagetop"><span class="pagetop__arrow"></span></button>
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

	else :


	endif;

	wp_reset_postdata();
	?>

</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
