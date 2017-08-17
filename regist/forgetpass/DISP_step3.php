<?php
/*******************************************************************************
ShopWinLite コンテンツ：ショッピングカートプログラム内

パスワード変更プログラム
View：Step3	新しいパスワード変更　入力画面
	※ユーザーが指定されたパラメーター付URLよりアクセスし、認証ＯＫな場合に表示
	（要はつづきです）

*******************************************************************************/

// 不正アクセスチェック（直接このファイルにアクセスした場合）
if ( !$injustice_access_chk ){
	header("HTTP/1.0 404 Not Found");	exit();
}

#------------------------------------------------------------------------
# HTTPヘッダーを出力
# 文字コード／JSとCSSの設定／無効な有効期限／キャッシュ拒否／ロボット拒否
#------------------------------------------------------------------------
utilLib::httpHeadersPrint("UTF-8",true,true,true,true);

// テンプレートクラスライブラリ読込みと出力用HTMLテンプレートをセット
if ( !file_exists("TMPL_step3.html") )	die("Template File Is Not Found!!");
$tmpl = new Tmpl2("TMPL_step3.html");

#=================================================================================
# テンプレートを使用してHTML出力の設定
#=================================================================================

// HEADのTITLE
$tmpl->assign("shopping_title", SHOPPING_TITLE);

$tmpl->assign("DispHeader",DispHeader());
$tmpl->assign("DispHeader2",DispHeader2());
$tmpl->assign("DispAnalytics",DispAnalytics());
$tmpl->assign("DispSide",DispSide());
$tmpl->assign("DispFooter",DispFooter());
$tmpl->assign("DispBeforeBodyEndTag",DispBeforeBodyEndTag());
$tmpl->assign("DispAccesslog",DispAccesslog());
$tmpl->assign("php_self",'../regist/');

// エラーメッセージがある場合は表示（認証チェック後にエラーがあり再入力）
if ( $error_message ){
    //$mes = "\n<div style=\"width:90%;margin:1em;color:crimson;font-size:medium;font-weight:bold;\">\n{$error_message}\n</div>\n";
	//$tmpl->assign("error_message", $mes);
	$tmpl->assign("error_message", $error_message);
}
else{
	$tmpl->assign("error_message", "");
}

#------------------------------------------------------------
# 設定した内容を一括出力
#------------------------------------------------------------
$tmpl->flush();
?>
