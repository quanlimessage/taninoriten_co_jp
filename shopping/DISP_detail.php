<?php
/*******************************************************************************

	商品詳細ページ表示

*******************************************************************************/

// 不正アクセスチェックのフラグ
$injustice_access_chk = 1;

// エラーメッセージの初期化
$error_message = "";

// 設定ファイル＆共通ライブラリの読み込み
require_once("../common/INI_config.php");		// 共通設定情報
require_once("../common/INI_ShopConfig.php");	// ショップ用設定情報
require_once('tmpl2.class.php');				// テンプレートクラスライブラリ

#----------------------------------------------------------------------------
# テンプレートクラスライブラリ読込みと出力用HTMLテンプレートをセット
# ※$category_codeの内容により分岐
#----------------------------------------------------------------------------
$tmpl_file = "TMPL_detail.html";

if(!file_exists($tmpl_file))die("Template File Is Not Found!!");
$tmpl = new Tmpl2($tmpl_file);

#------------------------------------------------------------------------------------------
# 共通HTML出力の設定
#------------------------------------------------------------------------------------------

// HEADのTITLE
$tmpl->assign("shopping_title",SHOPPING_TITLE);
$tmpl->assign("DispHeader",DispHeader());
$tmpl->assign("DispHeader2",DispHeader2());
$tmpl->assign("DispAnalytics",DispAnalytics());
$tmpl->assign("DispSide",DispSide());
$tmpl->assign("DispFooter",DispFooter());
$tmpl->assign("DispBeforeBodyEndTag",DispBeforeBodyEndTag());
$tmpl->assign("DispAccesslog",DispAccesslog());

$tmpl->assign("ca_name",$fetch[0]["CATEGORY_NAME"]);
#------------------------------------------------------------------------------------------
# 該当商品の並び位置の取得
#------------------------------------------------------------------------------------------
for($i=0,$target="";$i < count($fetchCNT);$i++):
if($fetch[0]['PRODUCT_ID'] == $fetchCNT[$i]['PRODUCT_ID']){$target = $i + 1;break;}
endfor;

//ページ位置の取得
$p = ceil($target/SHOP_MAXROW);

#------------------------------------------------------------------------------------------
# 一覧に戻るボタン
#------------------------------------------------------------------------------------------
$back_page= "./?p=".urlencode($p)."&ca=".urlencode($fetch[0]['CATEGORY_CODE'])."";

$tmpl->assign("back_page",$back_page);

#------------------------------------------------------------------------------------------
# テキスト情報HTML出力の設定
#------------------------------------------------------------------------------------------

// 商品ID
$tmpl->assign("product_id",$fetch[0]["PRODUCT_ID"]);

// 商品名
$tmpl->assign("product_name",nl2br($fetch[0]["PRODUCT_NAME"]));

$ititle = strip_tags(nl2br($fetch[0]["PRODUCT_NAME"]));
$tmpl->assign("ititle",$ititle);
// 商品番号
$tmpl->assign("part_no",$fetch[0]["PART_NO"]);

// 価格 税抜き価格に税込価格を入れる処理も入れている
$tmpl->assign("selling_price",($fetch[0]["SELLING_PRICE"])?"<p class=\"price\">価 格".number_format(math_tax($fetch[0]["SELLING_PRICE"]))."円（税込）</p>":"");

// 商品説明
$tmpl->assign("item_details",nl2br($fetch[0]["ITEM_DETAILS"]));

// タイトルタグ
$tmpl->assign("title_tag",($fetch[0]["TITLE_TAG"])?nl2br($fetch[0]["TITLE_TAG"])."｜":"");

// カートフラグ判断して「カートへ」「売り切れ」ボタン表示制御
if( ($fetch[0]["STOCK_QUANTITY"]>0) && ($fetch[0]["CART_CLOSE_FLG"] == 0) ){
	$tmpl->assign_def("stock_exists",true);
}

//ＮＥＷ・お勧めアイコンの表示
if($fetch[0]["NEW_ITEM_FLG"] == "1"){//アイコン表示
	$tmpl->assign("img_icon","<img src=\"./images/new_b.gif\">");

}else{//アイコン非表示
	$tmpl->assign("img_icon","");
}

#--------------------------------------------------------------------------------
# 詳細画像ボタンの出力とポップアップ画像の表示
#--------------------------------------------------------------------------------

$img = "./";

$tmpl->assign("path",$img);

$main_flg==false;
// 詳細画像をクリックしてメイン画像を変更する
for($i=1;$i<=3;$i++):

if($_POST['status']){ //プレビュー
	$img_path[$i] = $prev_img[$i];
}else{//
	$img_path[$i] = search_file_disp($img."/product_img/",$fetch[0]["PRODUCT_ID"]."_".$i.".*","",2);
}

if(file_exists($img_path[$i])){

	$chang_img[$i] .= ($i == 1)?"<li class=\"active\"><img src=\"".$img_path[$i]."?r=".rand()."\" alt=\"img\" class=\"1\"></li>":"<li><img src=\"".$img_path[$i]."?r=".rand()."\" alt=\"img\" class=\"1\"></li>";

	// メイン画像NO
	if($main_flg==false){
		$main_img_path = $img_path[$i];
	}

	$main_flg=true;

	$tmpl->assign("mini_img_src".$i,$chang_img[$i]);

}else{
	$tmpl->assign("mini_img_src".$i,"");
}

endfor;

// 拡大画像メインイメージ
if($main_flg){
	$main_img = "<div id=\"Target-img\"><img src=\"".$main_img_path."?r=".rand()."\" id=\"Fade1\"></div>";

}else{
	$main_img = "";
}

$tmpl->assign("main_img",($main_img)?$main_img:"");

#--------------------------------------------------------
# 詳細ページング用リンク文字列処理
#--------------------------------------------------------

//該当商品の並び位置の取得
for($i=0;$i < count($fetchCNT);$i++):
if($fetch[0]['PRODUCT_ID'] == $fetchCNT[$i]['PRODUCT_ID']){
$next = $fetchCNT[$i+1]['PRODUCT_ID'];
$prev = $fetchCNT[$i-1]['PRODUCT_ID'];
break;
}
endfor;

// 前ページへのリンク
$pr = "<a href=\"./?pid=".$prev."\"><img src=\"../common_img/btn_prev.jpg\" alt=\"前へ\"></a>";
if(!$prev){
	$pr = "";
}

//次ページリンク
$nx = "<a href=\"./?pid=".$next."\"><img src=\"../common_img/btn_next.jpg\" alt=\"次へ\"></a>";
if(!$next){
	$nx = "";
}

// $page = $pr." &nbsp; ".$nx;

$tmpl->assign("pr",$pr);
$tmpl->assign("nx",$nx);

//アクセス解析タグ
if(!$_POST['status']){
$access_tag="<script type=\"text/javascript\" src=\"https://www.google.com/jsapi?key=\"></script>
<script src=\"https://mx16.all-internet.jp/state/state2.js\" language=\"javascript\" type=\"text/javascript\"></script>
<script language=\"JavaScript\" type=\"text/javascript\">
<!--
var s_obj = new _WebStateInvest();
var _accessurl = setUrl();
document.write('<img src=\"' + _accessurl + '/log.php?referrer='+escape(document.referrer)+'&st_id_obj='+encodeURI(String(s_obj._st_id_obj))+'\" width=\"1\" height=\"1\">');
//-->
</script>
";
}else{
$access_tag="";
}
$tmpl->assign("access_tag",$access_tag);

#------------------------------------------------------------
# 設定した内容を一括出力
#------------------------------------------------------------
$tmpl->flush();

?>
