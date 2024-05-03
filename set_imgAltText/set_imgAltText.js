class Regist_imgAltText_class {


	#mgr_gui;
	#msg;

	/**
	 * コンストラクタ
	 * @param mgr_gui Gui制御クラス
	 */
	constructor(mgr_gui) {
			this.#mgr_gui=mgr_gui;
			console.log(this.#mgr_gui.msgtbl["msg1"]);
			this.send = this.send.bind(this);
	}

	async send(url_dbUpdate){
		let tbl_list_imgAltTexts=this.#mgr_gui.create_obArray();

		console.log('送信用データ:');
		console.log(tbl_list_imgAltTexts);

		fetch(wpData.url_dbUpdate, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
			},
			//body: JSON.stringify({list_imgAltTexts: tbl_list_imgAltTexts, nonce: "test_nonce"})
			body: JSON.stringify({list_imgAltTexts: tbl_list_imgAltTexts, nonce: wpData.nonce})
		})
		.then(response => response.json())
		.then(data => {
			console.log('Alt text updated successfully.');
		})
		.catch(error => {
			console.error('Error updating alt text:');
			alert('System Error. Fail to update');
		});

		await mgr_gui.update_gui("Update! Complete!");
		return true;
	}





}


class Mgr_guiStatus_class {


	#htmlOb_compStatus;
	#htmlOb_resultList;
	#htmlOb_btn_get_imgAltText;
	#htmlOb_btn_reg_imgAltText;
	#htmlOb_resultTable;
	msgtbl;
	/**
	 * コンストラクタ
	 * @param compStatus ステータス表示領域
	 * @param resultList 結果表示領域 
	 * @param getBtn	代替テキスト取得ボタン
	 * @param regBtn	代替テキスト登録ボタン
	 */
	constructor(
				compStatus
				,resultList
				,getBtn
				,regBtn
				,rsultTable
				,msgtbl
	) {

			this.#htmlOb_compStatus = compStatus;
			this.#htmlOb_resultList = resultList;
			this.#htmlOb_btn_get_imgAltText = getBtn;
			this.#htmlOb_btn_reg_imgAltText = regBtn;
			this.#htmlOb_resultTable = rsultTable;
			this.msgtbl =msgtbl;

			this.start      = this.start.bind(this);
			this.update_gui = this.update_gui.bind(this);
			this.update_guix = this.update_guix.bind(this);
			this.comp_get   = this.comp_get.bind(this);
			this.comp_reg   = this.comp_reg.bind(this);
			this.create_obArray   = this.create_obArray.bind(this);
	}


	create_obArray() {
		var table = this.#htmlOb_resultTable;
		var data = [];

		// var headers = Array.from(table.querySelectorAll('thead th')).map(th => th.textContent.trim());
		var headers = ['id', 'orgFilename', 'beforeFilename', 'filename', 'option'];

		// テーブルが存在するか確認
		if (table) {
			// データ行を取得
			var rows = Array.from(table.querySelectorAll('tbody tr'));

			rows.forEach(row => {
				var rowData = {};
				// 各セルのデータをオブジェクトにセット
				Array.from(row.cells).forEach((cell, index) => {
					var cellValue = cell.textContent.trim();
					// 'option' ヘッダーに対応する列の場合、チェックボックスの状態を確認
					if (headers[index] === 'option') {
						// チェックボックスの状態が true（チェックされている）の場合にセット
						rowData[headers[index]] = cell.querySelector('input[type="checkbox"]').checked;
					} else {
						// 通常のセルの場合
						rowData[headers[index]] = cellValue;
					}
				});

				// 'option' チェックボックスがチェックされている場合のみオブジェクトに追加
				if (rowData['option']) {
					data.push(rowData);
				}
			});

			console.log("オブジェクト配列にセットされたデータ:", data);
		} else {
			console.log("テーブルがありません");
		}

		return data;
	}



	#screenUpdate_sync(statusMsg) {
	  return new Promise(resolve => {
		  								setTimeout(()=> {
													this.#htmlOb_compStatus.innerHTML = "<p>" + statusMsg + "</p>";
													resolve();
			  										}, 0)

	  								});
	}

	#screenUpdate_syncx(/*statusMsg,*/ id, filename, before, after) {
	  return new Promise(resolve => {
		  								setTimeout(()=> {
													// テーブルのボディ部分
													const tbody = this.#htmlOb_resultTable.tBodies[0];

													// 行を追加する関数
													const row = document.createElement('tr');
													row.innerHTML = `
														<td>${id}</td>
														<td>${filename}</td>
														<td>${before}</td>
														<td  class="editable-after" contenteditable="true">${after}</td>
														<td><input type="checkbox" checked></td>
													`;
													tbody.appendChild(row);

													resolve();
			  										}, 0)

	  								});
	}

	//代替テキスト取得ボタン押下
	start(selectedImages){
		if (selectedImages.length==0) {
			alert(this.msgtbl["msg1"]);//"一括選択"ボタンで画像を選択してください
			return false;
		}

		let tbody=this.#htmlOb_resultTable.tBodies[0];
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }
		this.#htmlOb_resultTable.style.display = "table"; //テーブルを表示
		this.#htmlOb_btn_reg_imgAltText.style.display = 'none'; // ボタンを非表示
		this.#htmlOb_btn_reg_imgAltText.disabled = true; // ボタンを非活性化
		this.#htmlOb_btn_get_imgAltText.disabled = true; // ボタンを非活性化
		this.#htmlOb_compStatus.innerHTML ='';
		this.#htmlOb_resultList.innerHTML ='';
		return true;
	};

	//代替テキスト生成完了
	comp_get(){
		this.#htmlOb_btn_reg_imgAltText.style.display = 'block'; // ボタンを表示
		this.#htmlOb_btn_reg_imgAltText.disabled = false; // ボタンを活性化
		this.#htmlOb_btn_get_imgAltText.disabled = false; // ボタンを非活性化
	};
	//DB登録完了状態
	comp_reg(){
		this.#htmlOb_btn_reg_imgAltText.style.display = 'none'; // ボタンを非表示
		this.#htmlOb_btn_reg_imgAltText.disabled = true; // ボタンを非活性化
	};

	//処理更新
	async update_gui(statusMsg){

		
		try{
			await this.#screenUpdate_sync(statusMsg);
		} catch (error) {
			console.error('Error:', error);
		}

	};

	async update_guix( id, filename, before, after){

		try{
			await this.#screenUpdate_syncx(id, filename, before, after);
		} catch (error) {
			console.error('Error:', error);
		}
	}
}

class Classify_image_class {


	#model;
	/**
	 * コンストラクタ
	 * @param model 機械学習モデル
	 */
	constructor( model) {
			this.#model=model;
	}

	async classify(img){

		try {

			// 画像の分類
			const predictions = await this.#model.classify(img);

			// 結果の表示（最も確信度の高いクラス名）
			console.log(predictions[0]['className']);
			return predictions[0]['className'];

		} catch (error) {
			console.log("classfyでのエラー:");
			console.error('Error:', error);
		}
	}


}


class Get_imgAltText_class {

	#mgr_gui;
	/**
	 * コンストラクタ
	 * @param mgr_gui 	gui制御クラス 
	 */
	constructor(mgr_gui ) {
			this.#mgr_gui=mgr_gui;
			this.get_imgAltText = this.get_imgAltText.bind(this);
	}





	async get_imgAltText(selectedImages, selectOption){

		var tgtImg = document.createElement('img');
		tgtImg.width = 300;
		tgtImg.height = 300;
		tgtImg.style.display = 'none';      // 非表示に設定

		//update gui
		await mgr_gui.update_gui(this.#mgr_gui.msgtbl["msg2"]); //"処理中です。AIによる判定に時間を要します。" 


		let model_mbnet="";
		if (selectOption == 'addai'){
			let model = await mobilenet.load();
			model_mbnet = new Classify_image_class(model);
		}



		let ct=0;
		for  (var i = 0; i < selectedImages.length; i++) {
			tgtImg.src = selectedImages[i].url;
		
			let imgAltText="";
			let filename=selectedImages[i].filename.split('.').slice(0, -1).join('.');

			if (selectOption == 'addai'){
				try{
					imgAltText = await model_mbnet.classify(tgtImg);
					if ((imgAltText===undefined) || (imgAltText.includes('nematode'))){
						imgAltText="";
					}else{
						imgAltText=":   " + imgAltText;
					}
				} catch (error) {
					console.log("for loop awaitでのエラー:");
					console.error('Error:', error);
				}

			}else if (selectOption == 'clear'){
				filename="";
			}


			//画面表示用
			let listMsg = selectedImages[i].id + ':   ' + selectedImages[i].filename.split('.').slice(0, -1).join('.')  + imgAltText;
			ct=i+1;
			let statusMsg = '***Running*** [Complete Counta]:' +  ct + '/' + selectedImages.length + ',';
			//update gui
			await mgr_gui.update_gui(statusMsg);
			await mgr_gui.update_guix(
									selectedImages[i].id
									,selectedImages[i].filename
									,selectedImages[i].alt
									,filename + imgAltText);





		}

		//update gui
		let status = '[Complete Count]:' +   selectedImages.length + '/' + selectedImages.length ;
		await mgr_gui.update_gui(status + '\n. Complete!');
		tgtImg.src = "";

		return true;


	}
}




