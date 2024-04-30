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
				display : none;
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
			<h2>Create設定：画像の代替テキスト一括設定機能(SEO対策機能)</h2>

			<p>本機能は画像の代替テキストをファイル名からセットします。AIが画像から判別した英単語を付与することもできます。</p>
			<p>使い方：</p>
			<p> 1. 下記の"一括選択"ボタンから画像を選択する。</p>
			<p> 2. 選択ボックスからA、B、Cのいずれかのオプションを選択する。</p>
			<p> 3. ”選択画像の代替テキストの取得”ボタンを押下する。("代替テキストを修正"ボタンが表示されます）</p>
			<p> 4. 表示された代替テキストに問題がなければ"代替テキストを修正"ボタンを押下する。</p>
			<select id="selectOption" name="options">
				<option value="onlyfile">A. "画像ファイル名" からセット</option>
				<option value="clear">B. 代替テキストを削除する</option>
				<option value="addai">C. "画像ファイル名＋AI判別の英単語" からセット</option>
			</select>

			<!-- ボタンをクリックしたときに画像のファイルパスを表示するためのボタン -->
			<button id="btn-get-imgAltText">選択画像の代替テキストの取得</button>

			<p>注意点：3.のAI判別機能は公開されているAI(TensorFlow.js)を利用しています。AIによる判定で完全ではありません。
			   AIが取得に失敗した場合はファイル名のみが適用されます。利用が適している場合にご利用ください。</p>


			<!-- 完了状況を表示する。 -->
			<div id="compCt"></div>

			<!-- 結果の一覧を表示するリスト -->
			<ul class="list-result-getImgAltText"></ul>

			<!-- DBへの登録ボタン -->
			<button id="btn-reg-imgAltText" style="display: none;" disabled>代替テキストを修正</button>

			<!-- 結果テーブル -->
			<table id="resultTable">
				<thead>
					<tr>
						<th>id</th>
						<th>ファイル名</th>
						<th>現在の代替テキスト</th>
						<th>修正後の代替テキスト</th>
						<th>選択チェックボックス</th>
					</tr>
				</thead>
				<tbody>
					<!-- ここにJavaScriptで追加される行が入ります -->
				</tbody>
			</table>


		</div>

		<!--
		<script src=/wp-content/themes/pcolor/set_imgAltText/set_imgAltText.js></script>
		-->
		<script src='https://cdn.jsdelivr.net/npm/@tensorflow/tfjs'></script>
		<script src='https://cdn.jsdelivr.net/npm/@tensorflow-models/mobilenet'></script>
		<script>
			let htmlOb_compStatus = document.getElementById("compCt");
			let htmlOb_resultList = document.querySelector('.list-result-getImgAltText');
			let htmlOb_btn_get_imgAltText = document.getElementById('btn-get-imgAltText');
			let htmlOb_btn_reg_imgAltText = document.getElementById('btn-reg-imgAltText');
			let htmlOb_resultTable = document.getElementById('resultTable');

			let mgr_gui;
			document.addEventListener('DOMContentLoaded', function() {

				mgr_gui = new Mgr_guiStatus_class(htmlOb_compStatus
													, htmlOb_resultList
													, htmlOb_btn_get_imgAltText
													, htmlOb_btn_reg_imgAltText
													, htmlOb_resultTable
													);
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

						alert('登録が完了しました。');
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
