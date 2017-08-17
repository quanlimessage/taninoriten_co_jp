<?php
/*******************************************************************************
ShopWinLite コンテンツ：ショッピングカートプログラム内

パスワード変更プログラム
View：Step4	新しいパスワード変更　完了画面
	※パスワードの変更が完了した場合に表示して終了

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
if ( !file_exists("TMPL_step4.html") )	die("Template File Is Not Found!!");
$tmpl = new Tmpl2("TMPL_step4.html");

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
#------------------------------------------------------------
# 設定した内容を一括出力
#------------------------------------------------------------
$tmpl->flush();

?>
