<?php


function set_mediaLibrary_customSection_imgAltText()
{
	global $pagenow;



	// 現在のページがメディアライブラリのページの場合
	if ($pagenow === 'upload.php') {


?>


		<style>
			/* カスタムセクションのスタイルをここに追加 */
			.mediaLibrary-customSection {
				/*position: absolute;*/
				/*position: relative;*/
				/*top: 0px;*/
				/*left: 100px;*/
				/*z-index: 9999;*/
				background-color: #fff;
				padding: 20px;
				border-bottom: 1px solid #e5e5e5;
				margin-left: 180px;
			}

			.list-result-getImgAltText {
				list-style: none;
				/*padding: 100px;*/
			}

			#resultTable {
				border-collapse: collapse;
				width: 100%;
				display: none;
			}

			th,
			td {
				border: 1px solid #ddd;
				padding: 8px;
				text-align: left;
			}

			td.editable-after {
				background-color: lightblue;
			}


			th {
				background-color: #f2f2f2;
			}

			#compCt {
				font-weight: bold;
				color: blue;
			}
		</style>


		<div class="mediaLibrary-customSection">

			<h2><?php esc_html_e('Bulk Setting Function for Alternative Text of Images ', 'pixsquare'); ?></h2>

			<p><?php esc_html_e('This function sets the alternative text of images from their file names. It can also append English words identified by AI from the images.', 'pixsquare'); ?></p>
			<p><?php esc_html_e('How to Use:', 'pixsquare'); ?></p>
			<p><?php esc_html_e('1. Select images using the "Select All" button below.', 'pixsquare'); ?></p>
			<p><?php esc_html_e('2. Choose one of the options A, B, or C from the selection box.', 'pixsquare'); ?></p>
			<p><?php esc_html_e('3. Click the "Get Alternative Text of Selected Images" button. (The "Modify Alternative Text" button will be displayed.)', 'pixsquare'); ?></p>
			<p><?php esc_html_e('4. If there are no issues with the displayed alternative text, click the "Modify Alternative Text" button.', 'pixsquare'); ?></p>
			<select id="selectOption" name="options">
				<option value="onlyfile"><?php esc_html_e('A. Set from "Image File Name"', 'pixsquare'); ?></option>
				<option value="clear"><?php esc_html_e('B. Remove Alternative Text', 'pixsquare'); ?></option>
				<option value="addai"><?php esc_html_e('C. Set from "Image File Name + AI Identified English Words"', 'pixsquare'); ?></option>
			</select>

			<!-- Button to display the file path of the selected image when clicked -->
			<button id="btn-get-imgAltText"><?php esc_html_e('Get Alternative Text of Selected Images', 'pixsquare'); ?></button>

			<p><?php esc_html_e('Note: The AI identification function in step 3 utilizes publicly available AI (TensorFlow.js). It may not provide perfect identification. If AI fails to retrieve, only the file name will be applied. Please use it when appropriate.', 'pixsquare'); ?></p>





			<!-- 完了状況を表示する。 -->
			<div id="compCt"></div>

			<!-- 結果の一覧を表示するリスト -->
			<ul class="list-result-getImgAltText"></ul>

			<!-- DBへの登録ボタン -->
			<button id="btn-reg-imgAltText" style="display: none;" disabled><?php esc_html_e('Modify Alternative Text', 'pixsquare'); ?></button>

			<!-- 結果テーブル -->
			<table id="resultTable">
				<thead>
					<tr>
						<th><?php esc_html_e('ID', 'pixsquare'); ?></th>
						<th><?php esc_html_e('File Name', 'pixsquare'); ?></th>
						<th><?php esc_html_e('Current Alternative Text', 'pixsquare'); ?></th>
						<th><?php esc_html_e('Modified Alternative Text', 'pixsquare'); ?></th>
						<th><?php esc_html_e('Selection Checkbox', 'pixsquare'); ?></th>
					</tr>
				</thead>
				<tbody>
					<!-- ここにJavaScriptで追加される行が入ります -->
				</tbody>
			</table>


		</div>

		<!--
		<script src=/wp-content/themes/pixsquare/set_imgAltText/set_imgAltText.js></script>
		-->
		<script src='https://cdn.jsdelivr.net/npm/@tensorflow/tfjs'></script>
		<script src='https://cdn.jsdelivr.net/npm/@tensorflow-models/mobilenet'></script>
		<script>
			let msgtbl = {};
			msgtbl["msg1"] = "<?php _e('Please select images using the bulk selection button.', 'pixsquare'); ?>"; /*一括選択ボタンで画像を選択してください*/
			msgtbl["msg2"] = "<?php _e('Running. AI-based evaluation may take some time.', 'pixsquare'); ?>"; /*処理中です。AIによる判定に時間を要します。*/


			let htmlOb_compStatus = document.getElementById("compCt");
			let htmlOb_resultList = document.querySelector('.list-result-getImgAltText');
			let htmlOb_btn_get_imgAltText = document.getElementById('btn-get-imgAltText');
			let htmlOb_btn_reg_imgAltText = document.getElementById('btn-reg-imgAltText');
			let htmlOb_resultTable = document.getElementById('resultTable');

			let mgr_gui;
			document.addEventListener('DOMContentLoaded', function() {




				mgr_gui = new Mgr_guiStatus_class(htmlOb_compStatus, htmlOb_resultList, htmlOb_btn_get_imgAltText, htmlOb_btn_reg_imgAltText, htmlOb_resultTable, msgtbl);

				let set_imgAltText = new Get_imgAltText_class(mgr_gui);
				// メディアライブラリの「選択」ボタンがクリックされたときの処理
				htmlOb_btn_get_imgAltText.addEventListener('click', async function() {
					try {


						const selectedImages = wp.media.frame.state().get('selection').toJSON();
						const selectOption = document.getElementById("selectOption").value;
						//GUI コントロール

						if (!(mgr_gui.start(selectedImages))) return;

						//実行
						ret = await set_imgAltText.get_imgAltText(selectedImages, selectOption);


						//GUI コントロール
						mgr_gui.comp_get();

					} catch (error) {
						console.error('Error:', error);
					}

				});

				let url_dbUpdate = '<?php echo  get_template_directory_uri(); ?>' + '/set_imgAltText/regist_tbl_imgAltText.php';

				let regist_imgAltText = new Regist_imgAltText_class(mgr_gui);

				// メディアライブラリの「登録」ボタンがクリックされたときの処理
				htmlOb_btn_reg_imgAltText.addEventListener('click', async function() {
					try {
						//登録するデータの送信
						ret = await regist_imgAltText.send(url_dbUpdate);

						//GUI コントロール
						mgr_gui.comp_reg();

						alert('Complete!');
						location.reload();
					} catch (error) {
						console.error('Error:', error);
					}
				});

			});
		</script>
<?php
	}
}
