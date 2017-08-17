<?php
/*******************************************************************************
ショッピングカートプログラム

View：エラー画面を表示（エラー発生時に表示）

s*******************************************************************************/

#------------------------------------------------------------------------
# HTTPヘッダーを出力
# 文字コード／JSとCSSの設定／無効な有効期限／キャッシュ拒否／ロボット拒否
#------------------------------------------------------------------------
utilLib::httpHeadersPrint("UTF-8",true,true,true,true);

// テンプレートクラスライブラリ読込みと出力用HTMLテンプレートをセット
if ( !file_exists("TMPL_error_disp.html") )	die("Template File Is Not Found!!");
$tmpl = new Tmpl2("TMPL_error_disp.html");

// TITLE
$tmpl->assign("shopping_title", SHOPPING_TITLE);
$tmpl->assign("DispHeader",DispHeader());
$tmpl->assign("DispHeader2",DispHeader2());
$tmpl->assign("DispAnalytics",DispAnalytics());
$tmpl->assign("DispSide",DispSide());
$tmpl->assign("DispFooter",DispFooter());
$tmpl->assign("DispBeforeBodyEndTag",DispBeforeBodyEndTag());
$tmpl->assign("DispAccesslog",DispAccesslog());
$tmpl->assign("php_self",'../regist/');

// エラーメッセージ
$tmpl->assign("error_mes", $error_message);

#------------------------------------------------------------
# 設定した内容を一括出力
#------------------------------------------------------------
$tmpl->flush();

?>
