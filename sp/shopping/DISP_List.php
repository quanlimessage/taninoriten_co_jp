<?php
/*******************************************************************************

 LOGIC:商品一覧ページを表示

*******************************************************************************/

// 不正アクセスチェック
if(!$injustice_access_chk){
	header("HTTP/1.0 404 Not Found");exit();
}

#=============================================================
# ヘッダー調整
#=============================================================
utilLib::httpHeadersPrint("UTF-8",true,true,false,false);
#----------------------------------------------------------------------------
# テンプレートクラスライブラリ読込みと出力用HTMLテンプレートをセット
# ※$category_codeの内容により分岐
#----------------------------------------------------------------------------
$tmpl_file = "TMPL_list.html";

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
#--------------------------------------------------------------------------------
# HTML出力
#--------------------------------------------------------------------------------

	// 商品が何も登録されていない場合に表示
	if(count($fetch) == 0):
		$tmpl->assign("disp_no_data","<br><div align=\"center\">ただいま準備中のため、もうしばらくお待ちください。</div>");
	else:
		$tmpl->assign("disp_no_data","");
	endif;

    $tmpl->assign("ca_name",$ca_name);

	// ループセットと取得レコード分のHTML出力設定
    $table = "";
	// 全商品分ループ
	for($i=0;$i<count($fetch);$i++){

		#===============================================================================================
		# 変数を整形する
		# DBから取り出して整形が必要な変数等は軽い変数名に代入してテーブルテンプレートに貼り付ける
		# 例１）$id : 画像名等で頻繁に使用するので変数名を短くする
		# 例２）金額用変数 : number_formatを指定
		# 例３）改行込み文章 : nl2br
		# 例４）GET送信用変数 : urlencode
		# 例５）画像用変数
		#===============================================================================================

		// 商品ID
		$id = $fetch[$i]['PRODUCT_ID'];
		// 商品名
		$pname = nl2br($fetch[$i]['PRODUCT_NAME']);
		// 価格
		$price = ($fetch[$i]["SELLING_PRICE"])?"<p class=\"price\">価 格".number_format(math_tax($fetch[$i]["SELLING_PRICE"]))."円（税込）</p>":"";
		// 商品番号
		$part_no = $fetch[$i]["PART_NO"];
		// 詳細情報
		$content = nl2br($fetch[$i]["ITEM_LISTS"]);
		// 詳細画面へリンク
		if(strlen($param)>0){
			$for_detail = $param."&pid=".urlencode($fetch[$i]['PRODUCT_ID']);
		}else{
			$for_detail = "?pid=".urlencode($fetch[$i]['PRODUCT_ID']);
		}

		// 画像
		if(!$_POST['status']){

			if(search_file_flg("../../shopping/product_img/",$fetch[$i]['PRODUCT_ID']."_s.*")){
				$img = search_file_disp("../../shopping/product_img/",$fetch[$i]['PRODUCT_ID']."_s.*","",2);
			}else{
				$img = "";
			}

		}else{
			$img = $prev_img_s;
		}

		if(!file_exists($img)){
			$image = "";
		}else{
			$image = "<figure><a href=\"{$for_detail}\"><img src=\"".$img."?r=".rand()."\" alt=\"{$pname}\"></a></figure>";
		}

		//ＮＥＷ・お勧めアイコンの表示
		if($fetch[$i]["NEW_ITEM_FLG"]){//アイコン表示
			$new_icon = "<img src=\"./images/new_b.gif\">";
		}else{//アイコン非表示
			$new_icon = "";
		}
        if($pname == ""){
            continue;
        }
        
        if( ($fetch[$i]["STOCK_QUANTITY"]>0) && ($fetch[$i]["CART_CLOSE_FLG"] == 0) ){
	        $btnRegist = "
                <form method=\"post\" action=\"../regist/\">
                    <input type=\"image\" name=\"\" value=\"カートに入れる\" style=\"width:200px;\" src=\"images/btn03.png\" alt=\"カートに入れる\">
                    <input name=\"quantity\" type=\"hidden\" id=\"quantity\" value=\"1\">
                    <input type=\"hidden\" name=\"pid\" value=\"{$id}\">
                    <input type=\"hidden\" name=\"dispcart\" value=\"1\">
                </form>
            ";
        }else{
            $btnRegist = "<span style=\"color:#FF0000;\">在庫なし</span>";
        }
        
		#==============================================================================================
		# テーブルテンプレート貼り付け
		# HTMLから商品情報テーブルソースを貼り付け変数を展開
		# 必ずソースをすっきりさせる為ヒアドキュメントは使用せず
		# 上記で変数を整形してから貼り付ける
		#==============================================================================================
		$table .= "
			<div class=\"shopping_item\">
                <h3>{$pname}</h3>
                {$price}
                <div class=\"clearfix\">
                    {$image}
                    <p>{$content}</p>
                </div>
                <ul class=\"shopping_btn clearfix\">
                    <li class=\"pull_left w48\"><a href={$for_detail}><img src=\"images/btn01.png\" alt=\"商品詳細はこちら\"></a></li>
                    <li class=\"pull_right\">{$btnRegist}</li>
                </ul>
            </div>
		";
	}
    $tmpl->assign("table",$table);
#--------------------------------------------------------
# ページング用リンク文字列処理
#--------------------------------------------------------

// 次ページ番号
$next = $p + 1;
// 前ページ番号
$prev = $p - 1;
// 商品全件数
$tcnt = count($fetchCNT);
// 全ページ数
$totalpage = ceil($tcnt/SHOP_MAXROW);

// カテゴリー別で表示していればページ遷移もカテゴリーパラメーターをつける
if($ca)$cpram = "&ca=".urlencode($ca);

// 前ページへのリンク
$pr = "<a href=\"./?p=".urlencode($prev).$cpram."\" class=\"pull_left w23\"><img src=\"images/prev.png\" alt=\"前へ\"></a>";
if($p <= 1){
	$pr = "";
}

//次ページリンク
$nx = "<a href=\"./?p=".urlencode($next).$cpram."\" class=\"pull_right w23\"><img src=\"images/next.png\" alt=\"次へ\"></a>";
if($totalpage <= $p){
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
