
<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/wp-load.php");


// リクエストがPOSTかつJSONデータが存在するかを確認
if ($_SERVER["REQUEST_METHOD"] === "POST" && stripos($_SERVER["CONTENT_TYPE"], 'application/json') !== false) {

    // JSONデータを取得
    $jsonData = file_get_contents("php://input");
    
    // JSONデータをデコード
    $reqData = json_decode($jsonData);

    // データの確認
    if ($reqData !== null && isset($reqData->list_imgAltTexts)) {


		if  (wp_verify_nonce( $reqData ->nonce, 'my-custom-nonce' ) === false ) {
			ob_start();
			//var_dump('@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@NG');
			//var_dump($reqData);
			error_log(ob_get_clean(), 4);
			return false;
		}else{
			ob_start();
			//var_dump('@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@OK');
			//var_dump($reqData);
			error_log(ob_get_clean(), 4);
		}


		$list_imgAltTexts = $reqData -> list_imgAltTexts; 

		foreach ($list_imgAltTexts as $imgAltText) {

			// 画像の代替テキストを更新
			$ret = update_post_meta(sanitize_text_field($imgAltText->id), '_wp_attachment_image_alt', sanitize_text_field($imgAltText->filename));
		}

        echo json_encode(['success' => true]);


    } else {
        echo json_encode(['error' => 'Invalid JSON data']);
		wp_die();
    }

} else {
    echo json_encode(['error' => 'Invalid request']);
	wp_die();
}
?>
