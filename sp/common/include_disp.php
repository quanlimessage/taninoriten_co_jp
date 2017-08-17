<?php
#=================================================================================
# インクルード処理用関数
#=================================================================================

require_once(dirname(__FILE__)."/../../common/INI_config.php");
require_once("util_lib.php");        // 汎用処理クラスライブラリ
require_once("dbOpe.php");        // ＤＢ操作クラスライブラリ

// SSLチェック
// SSLページならTRUEを返す
function sslchk()
{
    if ((false === empty($_SERVER['HTTPS'])) && ('off' !== $_SERVER['HTTPS'])) {
        return true;
    }
    return false;
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// $domain_name		SSLの場合このドメイン名を使用して絶対パスを作る。またはSSLへのパスを作る。wwwは無しで設定
// $demojp_name		demopage.jpでSSLページから簡単に戻れるようにする
// 新方式：$ssl_domain_name	SSLの【example-https.all-internet.jp】の部分を入れる。
// 旧方式：$ssl_domain_name	SSLの【mx00.all-internet.jp】の部分を入れる。
//
function path_maker()
{
    $domain_name = "taninoriten2.com";//wwwは無しで設定
    $demojp_name = "taninoriten2-dev.demopage.jp";
    $ssl_domain_name = "taninoriten2-dev-https.all-internet.jp";
    // $ssl_domain_name = "mx00.all-internet.jp";

    $path_data = array();//最後にパスを返すための格納

    //このサイトのＴＯＰ階層を抽出する（裏側のファイルのパスなどに使用）
    $base_path = str_replace("/common", "", dirname(__FILE__));

    //ドキュメントルート ディレクトリのパスを除去する
    $dest_path = str_replace($_SERVER['DOCUMENT_ROOT'], '', $base_path) . '/';

    //通常ページへのリンク（０）、SSLへのリンク（１）、ファイルのパス（２）の３種類を設定
    if (strpos(__FILE__, "demopage.jp") !== false) {//デモページの場合　SSLが一切無い設定

        $path_data[0]     = $dest_path;
        $path_data[1]     = $dest_path;
        $path_data[2]     = $dest_path;
    } else if (sslchk()) {//sslページの場合

        //全て絶対パスにする
        $path_data[0]     = "http://www.".$domain_name.$dest_path;
        $path_data[1]     = "https://".$ssl_domain_name.$dest_path;
        // $path_data[1]	 = "https://".$ssl_domain_name."/".$domain_name.$dest_path;
        $path_data[2]     = "https://".$ssl_domain_name.$dest_path;
        // $path_data[2]	 = "https://".$ssl_domain_name."/".$domain_name.$dest_path;
    } else {

        //http抜きの全て絶対パスにする
        $path_data[0]     = $dest_path;
        $path_data[1]     = "https://".$ssl_domain_name.$dest_path;
        // $path_data[1]	 = "https://".$ssl_domain_name."/".$domain_name.$dest_path;
        $path_data[2]     = $dest_path;
    }

    return $path_data;
}

//リンク、パスのデータを受け取る 順番に通常リンクパス、SSL用リンクパス、ファイル用のパス
list($inc_nor_path, $inc_ssl_path, $inc_file_path) = path_maker();

// ディレクトリ名
//$plc = basename(dirname($_SERVER['PHP_SELF']));

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//　function で内容を出力　案件によって、左・右メニュー、フッターに動的カテゴリーなど
//　データベースへの接続が必要な場合がある。
//　変数名を多く使うと、同じ変数名を使用されてしまい誤動作を起こす可能性があるためfunctionを使用
//　（変数が初期化されていないと表示内容のデータが出てしまう、別なところで配列で使っているなどがある場合）
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 置換をすれば楽にパスが変更できるが、SSLを優先に置換をすること
// href="{$inc_nor_path} → href="{$inc_ssl_path}
// href="{$inc_nor_path} → href="{$inc_nor_path}
// src="{$inc_file_path} → src="{$inc_file_path}
// ,'../ → ,'{$inc_file_path}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//	ヘッダー
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function DispHeader()
{
    global $inc_nor_path,$inc_ssl_path,$inc_file_path;//ドメイン名をグローバル宣言

$html = <<<EDIT
<div class="h_main clearfix">
      <ul>
        <li><a href="tel:043-242-4252"><img src="{$inc_file_path}common_img/h_tel.jpg" alt=""></a></li>
        <li><a href="{$inc_nor_path}contact"><img src="{$inc_file_path}common_img/h_mail.jpg" alt=""></a></li>
        <li><a href="{$inc_nor_path}regist"><img src="{$inc_file_path}common_img/h_card.jpg" alt=""></a></li>
        <li class="btn_gnav"><img src="{$inc_file_path}common_img/h_menu.jpg" alt=""></li>
      </ul>
    </div>
    <nav id="gnav" class="menu">
      <ul>
        <li><a href="{$inc_nor_path}about">谷海苔店のこだわり</a></li>
        <li><a href="{$inc_nor_path}shopping">お買いもの</a></li>
        <li><a href="{$inc_nor_path}flow">のりができるまで</a></li>
        <li><a href="{$inc_nor_path}voice">お客様のお声</a></li>
        <li><a href="{$inc_nor_path}introduction">店舗紹介</a></li>
        <li><a href="{$inc_nor_path}seller">販売店業者様へ</a></li>
        <li><a href="{$inc_nor_path}company">会社案内</a></li>
        <li><a href="{$inc_nor_path}news">新着情報</a></li>
        <li><a href="{$inc_nor_path}contact">お問い合わせ</a></li>
        <li><a href="{$inc_nor_path}contact#pp">個人情報保護方針</a></li>
      </ul>
    </nav>
EDIT;

//内容を返す。（ここで表示だとショッピングのテンプレートでは表示が難しい為、データを返す）
return $html;
}

function DispHeader2()
{
    global $inc_nor_path,$inc_ssl_path,$inc_file_path;//ドメイン名をグローバル宣言

    //表示ページによるヘッダーメニューの選択表示制御
        $dirname = dirname($_SERVER["PHP_SELF"]);//フォルダ名を取得
        $flist = array('about','service','jisseki','company','topics');//フォルダ名のリストを配列に入れる

        //ループで各フォルダを判定する
        for ($i=0;$i < count($flist);$i++) {
            ${'fdisp'.$i} = (strpos($dirname, $flist[$i]))?"on":"off";
        }

    $html = <<<EDIT
EDIT;

//内容を返す。（ここで表示だとショッピングのテンプレートでは表示が難しい為、データを返す）
return $html;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//	サイド
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function DispSide()
{
    global $inc_nor_path,$inc_ssl_path,$inc_file_path;//ドメイン名をグローバル宣言

$html = <<<EDIT
<article id="sidebar">
      <div class="sidebar03">
        <h3 class="mb6pr"><img src="{$inc_file_path}common_img/side_ttl03.png" alt="弊社の焼きのりがオンラインでお買い上げいただけます。"></h3>
        <p class="mb6pr"><a href="{$inc_nor_path}shopping/?ca=1"><img src="{$inc_file_path}images/banner01.png" alt="焼きのり ギフト・ご贈答用"></a></p>
        <p><a href="{$inc_nor_path}shopping/?ca=2"><img src="{$inc_file_path}images/banner02.png" alt="焼きのり 食卓用"></a></p>
      </div>
      <ul class="clearfix mb7pr">
        <li class="pull_left w49"><a href="{$inc_nor_path}about"><img src="{$inc_file_path}common_img/side_banner03.png" alt="谷海苔店のこだわり"></a></li>
        <li class="pull_right w49"><a href="{$inc_nor_path}voice"><img src="{$inc_file_path}common_img/side_banner04.png" alt="お客様のお声"></a></li>
      </ul>
      <div class="sidebar01">
        <h3><img src="{$inc_file_path}common_img/side_ttl01.png" alt="お買いものガイド"></h3>
        <div class="box01">
          <p><a href="{$inc_nor_path}regist"><img src="{$inc_file_path}common_img/side_btn01.png" alt="かごの中を見る" class="w87"></a></p>
          <div class="mt5pr clearfix">
            <ul>
              <li><a href="{$inc_nor_path}shopping/total.html#guide01">ご購入方法</a></li>
              <li><a href="{$inc_nor_path}shopping/total.html#guide03">特定商取引法に基づく表記</a></li>
              <li><a href="{$inc_nor_path}shopping/total.html#guide02">ご利用規約</a></li>
              <li><a href="{$inc_nor_path}shopping/total.html#guide04">個人情報保護方針</a></li>
            </ul>
          </div>
          <h4>◆返品について◆</h4>
          <p>商品到着後、7日以内に弊社までご<br>
          連絡の上、ご返送ください。</p>
          <p class="mt5pr"><a href="{$inc_nor_path}shopping/total.html#guide02_3"><img src="{$inc_file_path}common_img/side_btn02.png" alt="詳しくはこちら" class="w80"></a></p>
        </div>
      </div>
      <div class="sidebar02">
        <h3 class="mb5pr"><img src="{$inc_file_path}common_img/side_ttl02.png" alt="お問い合わせ" class="w79"></h3>
        <p class="mb4pr">谷海苔店の商品や販売等に関する<br>
        お問い合わせはこちらからどうぞ</p>
        <p><a href="tel:043-242-4252"><img src="{$inc_file_path}common_img/side_tel.png" alt="043-242-4252 営業時間｜9:00～17:00　休日｜水日祝" class="w81"></a></p>
        <p class="mt5pr"><a href="{$inc_nor_path}contact/"><img src="{$inc_file_path}common_img/side_btn03.png" alt="お問い合わせフォーム" class="w82"></a></p>
      </div>
    </article>
EDIT;

//内容を返す。（ここで表示だとショッピングのテンプレートでは表示が難しい為、データを返す）
return $html;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//	フッター
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function DispFooter()
{
    global $inc_nor_path,$inc_ssl_path,$inc_file_path;//ドメイン名をグローバル宣言

$html = <<<EDIT
<footer> 
    <!-- footer --> 
    <div class="page_up">
      <a href="#wrapper"><img src="{$inc_file_path}common_img/top.png" alt="Page Up" width="55"></a>
    </div>
    <div class="f_main">
      <h1 class="mb05"><a href="{$inc_nor_path}"><img src="{$inc_file_path}common_img/f_logo.png" alt="株式会社谷海苔店" width="295"></a></h1>
      <p class="mb5pr">〒260-0025   千葉県千葉市中央区問屋町16-6</p>
      <p class="mb5pr"><a href="tel:043-242-4252"><img src="{$inc_file_path}common_img/f_tel.png" alt="043-242-4252" width="246"></a></p>
      <p><a href="{$inc_nor_path}contact"><img src="{$inc_file_path}common_img/f_mail.png" alt="お問い合わせ" width="242"></a></p>
    </div>
    <div class="f_link clearfix">
      <ul>
        <li><a href="{$inc_nor_path}about">谷海苔店のこだわり</a></li>
        <li><a href="{$inc_nor_path}seller">販売店業者様へ</a></li>
        <li><a href="{$inc_nor_path}shopping">お買いもの</a></li>
        <li><a href="{$inc_nor_path}company">会社案内</a></li>
        <li><a href="{$inc_nor_path}flow">のりができるまで</a></li>
        <li><a href="{$inc_nor_path}news">新着情報</a></li>
        <li><a href="{$inc_nor_path}voice">お客様のお声</a></li>
        <li><a href="{$inc_nor_path}contact">お問い合わせ</a></li>
        <li><a href="{$inc_nor_path}introduction">店舗紹介</a></li>
        <li><a href="{$inc_nor_path}contact#pp">個人情報保護方針</a></li>
      </ul>
    </div>
    <div class="f_pc">
      <a href="{$inc_nor_path}../bm.php?mode=pc" target="_blank"><img src="{$inc_file_path}common_img/pc.png" alt="PC" width="83"></a>
    </div>
  </footer>
EDIT;

//内容を返す。（ここで表示だとショッピングのテンプレートでは表示が難しい為、データを返す）
return $html;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//	Googleアナリティクス
//	head閉じタグの直前に挿入
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function DispAnalytics()
{
    global $inc_nor_path,$inc_ssl_path,$inc_file_path;//ドメイン名をグローバル宣言

$html = <<<EDIT

EDIT;

//内容を返す。（ここで表示だとショッピングのテンプレートでは表示が難しい為、データを返す）
return $html;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//	全ページに追加するタグ
//	body閉じタグの直前に挿入
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function DispBeforeBodyEndTag()
{
    global $inc_nor_path,$inc_ssl_path,$inc_file_path;//ドメイン名をグローバル宣言

$html = <<<EDIT

EDIT;

//内容を返す。（ここで表示だとショッピングのテンプレートでは表示が難しい為、データを返す）
return $html;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//	アクセス解析
//	body閉じタグの直前に挿入
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function DispAccesslog()
{
    global $inc_file_path;//リンクをグローバル宣言

$html = "";

// プレビューはログを取らない
if (!empty($_POST['act'])) {
    return $html;
}

/*
$ua = $_SERVER['HTTP_USER_AGENT'];
if ((strpos($ua, 'Android') !== false) && (strpos($ua, 'Mobile') !== false) || (strpos($ua, 'iPhone') !== false) || (strpos($ua, 'Windows Phone') !== false)) {
    // スマートフォンからアクセスされた場合
    $link_type = "log_sp.php";
} elseif ((strpos($ua, 'Android') !== false) || (strpos($ua, 'iPad') !== false) || strpos($ua,'Silk') !== false) {
    // タブレットからアクセスされた場合
    $link_type = "log_tb.php";
} else {
    // その他（PC）からアクセスされた場合
    $link_type = "log.php";
}
*/
$link_type = "log.php";

    //////////////////////////////////////////
    //ログファイルのパス設定
        $top_path = $inc_file_path;

    $html = <<<EDIT
<!-- ここから -->
<script type="text/javascript" src="https://www.google.com/jsapi?key="></script>
<script src="https://api.all-internet.jp/accesslog/access.js" language="javascript" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript">
<!--
var s_obj = new _WebStateInvest();
document.write('<img src="{$top_path}{$link_type}?referrer='+escape(document.referrer)+'&st_id_obj='+encodeURI(String(s_obj._st_id_obj))+'" width="1" height="1" style="display:none">');
//-->
</script>
<!-- ここまで -->
EDIT;

//内容を返す。（ここで表示だとショッピングのテンプレートでは表示が難しい為、データを返す）
return $html;
}
