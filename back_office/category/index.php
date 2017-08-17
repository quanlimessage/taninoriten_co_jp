<?php
/*******************************************************************************
Sx系プログラム バックオフィス（MySQL対応版）
メインコントローラー

*******************************************************************************/
#---------------------------------------------------------------
# 不正アクセスチェック（直接このファイルにアクセスした場合）
#	※厳しく行う場合はIDとPWも一致するかまで行う
#---------------------------------------------------------------
error_reporting (E_ALL);
//error_reporting (E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
error_reporting (E_ERROR | E_WARNING | E_PARSE);
ini_set('track_errors',1);
ini_set('display_errors',1);
session_start();
if( !$_SESSION['LOGIN'] ){
	header("Location: ../err.php");exit();
}/*
if( !$_SERVER['PHP_AUTH_USER'] || !$_SERVER['PHP_AUTH_PW'] ){
	header("Location: ../");exit();
}*/

// 不正アクセスチェックのフラグ
$accessChk = 1;

// 設定ファイル＆共通ライブラリの読み込み
require_once("../../common/INI_config.php");	// 共通設定情報
require_once("../../common/INI_ShopConfig.php");// ショップ用設定情報
require_once('../tag_pg/LGC_color_table.php');//ＨＴＭＬタグのカラーパレット
require_once('../../common/imgOpe2.php');	// 画像アップロードクラスライブラリ(gif・png対応)

#===============================================================================
# $_POST["action"]の内容により処理を分岐
#===============================================================================
switch($_POST["action"]):
case "completion":

	// データ登録処理を行い一覧へ戻る
	include("LGC_regist.php");
	header("Location: ./");

	break;
case "update":
//////////////////////////////////////////////////
//	更新画面出力

	include("LGC_getDB-data.php");
	include("DISP_update.php");

	break;
case "new_entry":
//////////////////////////////////////////////////
//	新規登録画面出力

	include("DISP_newInput.php");

	break;
case "display_change":case "del_data":
/////////////////////////////////////////////////
//	対象データの表示・非表示の切替 OR 削除

	include("LGC_del_and_dispchng.php");
	header("Location: ./");

default:
/////////////////////////////////////////////////
// DBより情報を取得し、一覧表示する

	include("LGC_getDB-data.php");
	include("DISP_listview.php");

endswitch;
?>
