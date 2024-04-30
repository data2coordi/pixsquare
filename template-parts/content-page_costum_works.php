<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pcolor
 */

?>
<!-- content-page-costum-works.php -->


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php pcolor_post_thumbnail(); ?>

	<div class="entry-content"> 
		<?php



		$content = get_the_content();

		// imgタグをaタグでラップする
		$content = preg_replace_callback(
			'/<img(.*?)src=["\'](.*?)["\'](.*?)>/i',
			function ($matches) {
				$img_tag = $matches[0];
				$src = $matches[2];
				// aタグでラップ
				$anchor_tag = '<a href="' . $src . '" target="_blank" data-lightbox="image">' . $img_tag . '</a>';
				return $anchor_tag;
			},
			$content
		);


		// HTMLパーサーを使用してwp-block-galleryクラスが適用された要素を削除
		$doc = new DOMDocument();
		libxml_use_internal_errors(true); // HTML5構文に対応するためにエラーを抑制
		$doc->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

		$xpath = new DOMXPath($doc);

		// wp-block-galleryクラスが適用された要素を取得
		$galleryElements = $xpath->query('//figure[contains(@class, "wp-block-gallery")]');

		// 取得した要素を削除
		foreach ($galleryElements as $galleryElement) {
			// 要素の中身を取得し、その内容を親に挿入してから要素を削除
			while ($galleryElement->childNodes->length > 0) {
				$galleryElement->parentNode->insertBefore($galleryElement->childNodes->item(0), $galleryElement);
			}
			// 削除
			$galleryElement->parentNode->removeChild($galleryElement);
		}

		// 結果を表示
		echo $doc->saveHTML();


		//echo $content;
		?>



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
