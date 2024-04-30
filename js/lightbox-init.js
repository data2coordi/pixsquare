
jQuery(document).ready(function ($) {
    // mainタグに works クラスがある場合
    if ($('main.site-main-costum-works').length) {
        // すべての画像に Lightbox を適用
        $('img').each(function () {
            $(this).on('click', function () {
                // 画像がクリックされたときの処理
				//alert('test');
                $(this).lightBox();

				//lightbox.start($(this));
            });
        });
    }
});


