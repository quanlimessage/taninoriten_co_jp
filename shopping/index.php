<?php
/*******************************************************************************

	商品閲覧(ブランド別)：メインコントローラー
		※主に商品のカテゴリー別の表示制御を行う

*******************************************************************************/

// 不正アクセスチェックのフラグ
$injustice_access_chk = 1;

// 設定ファイル＆共通ライブラリの読み込み
require_once("../common/INI_config.php");		// 共通設定情報
require_once("../common/INI_ShopConfig.php");	// ショップ用設定情報
require_once('tmpl2.class.php');				// テンプレートクラスライブラリ
require_once('../common/imgOpe2.php');					// 画像アップロードクラスライブラリ
require_once("../common/include_disp.php");
#=================================================================================
# GET受信パラメーターを元に表示させる情報をＤＢより取得し表示
#
#	$_GET["cn"]の中身の内訳 = CATEGORY_CODE(CATEGORY_MST)
#
#=================================================================================

	// 商品情報取得
	if($_POST['status']){
		include("LGC_preview.php");//プレビュー表示
	}else{
		include("LGC_getDB-data.php");
	}

	// 商品IDが送信されパラメーターが不正でなければ商品詳細を表示
	if( ( isset($_GET['pid']) && preg_match("/^([0-9]{10,})-([0-9]{6})$/", $_GET['pid']) ) || $_POST['status']=="prev_d" ){
		include("DISP_detail.php");

	}else{
		include("DISP_List.php");

	}

?>
