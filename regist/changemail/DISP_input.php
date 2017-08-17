<?php
/*******************************************************************************

メールアドレス変更プログラム
View：入力画面を表示（エラー／修正等の再入力画面としても使用）

	※入力内容：古いメールアドレス／パスワード／新しいパスワード
	※エラーがあった場合はエラーメッセージを表示（再入力画面としても使用）
	　（この際はテキスト入力で入力したものを表示させない）
	※修正時は認証済みなのでテキスト入力で入力したものを表示させる
	　（パスワード入力ボックスは表示しない）

	※共通でstatusは2へ

2005/10/13 KC
s*******************************************************************************/

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
if ( !file_exists("TMPL_input.html") )	die("Template File Is Not Found!!");
$tmpl = new Tmpl2("TMPL_input.html");

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
  $mes = "\n{$error_message}<br>\n";
	$tmpl->assign("error_message", $mes);
}
else{
	$tmpl->assign("error_message", "");
}

// 認証済みかどうかで新しいメールアドレスの欄の切り替えを行う
if ( !$_SESSION['setParam']['emailChg_Auth_flg'] ){

	$tmpl->assign("new_email_message","新しいメールアドレス");
	$tmpl->assign("newmail", "");
}
else{

	$tmpl->assign("new_email_message","新しいメールアドレスを入力してください");
	$tmpl->assign("newmail", $_SESSION['getParam']['newmail']);

}

#------------------------------------------------------------
# 設定した内容を一括出力
#------------------------------------------------------------
$tmpl->flush();

?>
