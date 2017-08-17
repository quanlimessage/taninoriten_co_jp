<?php
#=================================================================================
# インクルード処理用関数
#=================================================================================

require_once(dirname(__FILE__)."/INI_config.php");
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
// href="../ → href="{$inc_ssl_path}
// href="../ → href="{$inc_nor_path}
// src="../ → src="{$inc_file_path}
// ,'../ → ,'{$inc_file_path}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//	ヘッダー
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function DispHeader()
{
    global $inc_nor_path,$inc_ssl_path,$inc_file_path;//ドメイン名をグローバル宣言

$html = <<<EDIT
<div class="main_infor clearfix">
                                <div class="h_sitemap">
                                    <ul>
                                        <li class="pull_left">
                                            <a href="{$inc_nor_path}company">
                                                <img src="{$inc_file_path}common_img/h_btn01.png" alt="会社案内">
                                            </a>
                                        </li>
                                        <li class="pull_right">
                                            <a href="{$inc_nor_path}news">
                                                <img src="{$inc_file_path}common_img/h_btn02.png" alt="新着情報">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="h_tel">
                                    <img src="{$inc_file_path}common_img/h_tel.png" alt="043-242-4252 営業時間｜9:00～17:00　休日｜水日祝">
                                </div>
                                <div class="h_btn">
                                    <ul>
                                        <li class="mb05">
                                            <a href="{$inc_nor_path}regist"><img src="{$inc_file_path}common_img/h_btn03.png" alt="お買い物カゴを見る"></a>
                                        </li>
                                        <li>
                                            <a href="{$inc_nor_path}contact"><img src="{$inc_file_path}common_img/h_btn04.png" alt="メールお問い合わせ"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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
    <nav id="gnav">
                <ul class="container clearfix">
                    <li class="hvr-underline-from-left">
                        <a href="{$inc_nor_path}about"><img src="{$inc_file_path}common_img/gnav_01_off.png" alt="谷海苔店のこだわり"></a>
                    </li>
                    <li class="hvr-underline-from-left">
                        <a href="{$inc_nor_path}shopping"><img src="{$inc_file_path}common_img/gnav_02_off.png" alt="お買いもの"></a>
                    </li>
                    <li class="hvr-underline-from-left">
                        <a href="{$inc_nor_path}flow"><img src="{$inc_file_path}common_img/gnav_03_off.png" alt="のりができるまで"></a>
                    </li>
                    <li class="hvr-underline-from-left">
                        <a href="{$inc_nor_path}voice"><img src="{$inc_file_path}common_img/gnav_04_off.png" alt="お客様のお声"></a>
                    </li>
                    <li class="hvr-underline-from-left">
                        <a href="{$inc_nor_path}introduction"><img src="{$inc_file_path}common_img/gnav_05_off.png" alt="店舗紹介"></a>
                    </li>
                    <li class="hvr-underline-from-left">
                        <a href="{$inc_nor_path}seller"><img src="{$inc_file_path}common_img/gnav_06_off.png" alt="販売業者様へ"></a>
                    </li>
                </ul>
            </nav>
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
<aside id="sidebar">
                            <p class="mb15">
                                <a href="{$inc_nor_path}shopping/?ca=1"><img src="{$inc_file_path}common_img/side_banner01.jpg" alt="焼きのり ギフト・ご贈答用"></a>
                            </p>
                            <p class="mb15">
                                <a href="{$inc_nor_path}shopping/?ca=2"><img src="{$inc_file_path}common_img/side_banner02.jpg" alt="焼きのり 食卓用"></a>
                            </p>
                            <p class="mb15">
                                <a href="{$inc_nor_path}about"><img src="{$inc_file_path}common_img/side_banner03.jpg" alt="谷海苔店のこだわり"></a>
                            </p>
                            <p class="mb15">
                                <a href="{$inc_nor_path}voice"><img src="{$inc_file_path}common_img/side_banner04.jpg" alt="お客様のお声"></a>
                            </p>
                            <div class="side_list">
                                <h3 class="text_center"><img src="{$inc_file_path}common_img/side_ttl01.png" alt="お買いものガイド"></h3>
                                <p class="text_center">
                                    <a href="{$inc_nor_path}regist/"><img src="{$inc_file_path}common_img/side_btn01.png" alt="かごの中を見る"></a>
                                </p>
                                <ul>
                                    <li>
                                        <a href="{$inc_nor_path}shopping/total.html#guide01">ご購入方法</a>
                                    </li>
                                    <li>
                                        <a href="{$inc_nor_path}shopping/total.html#guide02">ご利用規約</a>
                                    </li>
                                    <li>
                                        <a href="{$inc_nor_path}shopping/total.html#guide03">特定商取引法に基づく表記</a>
                                    </li>
                                    <li>
                                        <a href="{$inc_nor_path}shopping/total.html#guide04">個人情報保護方針</a>
                                    </li>
                                </ul>
                                <h4 class="f16 text_center mb08">◆返品について◆</h4>
                                <p class="text_center f13">商品到着後、7日以内に弊社までご<br>連絡の上、ご返送ください。</p>
                                <p class="text_center mt10 pb20">
                                    <a href="{$inc_nor_path}shopping/total.html#guide02_3"><img src="{$inc_file_path}common_img/side_btn02.png" alt="詳しくはこちら"></a>
                                </p>
                            </div>
                            <div class="side_contact">
                                <h3 class="text_center mb10"><img src="{$inc_file_path}common_img/side_ttl02.png" alt="お問い合わせ"></h3>
                                <p class="f13 pl07">谷海苔店の商品や販売等に関する<br>お問い合わせはこちらからどうぞ</p>
                                <div class="side_tel">
                                    <img src="{$inc_file_path}common_img/side_tel.png" alt="043-242-4252 営業時間｜9:00～17:00　休日｜水日祝" class="mb15">
                                    <a href="{$inc_nor_path}contact"><img src="{$inc_file_path}common_img/side_btn03.png" alt="お問い合わせフォーム"></a>
                                </div>
                            </div>
                        </aside>
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
<footer id="footer">
                <div id="back-top">
                    <a class="ov_hover" href="#wrapper"><img src="{$inc_file_path}common_img/page_top.png" alt="To Top"></a>
                </div>
                <div class="container">
                    <div class="footer_sitemap">
                        <ul class="clearfix">
                            <li>
                                <a href="{$inc_nor_path}about" class="hvr-underline-from-left">谷海苔店のこだわり</a>
                            </li>
                            <li>
                                <a href="{$inc_nor_path}shopping" class="hvr-underline-from-left">お買いもの</a>
                            </li>
                            <li>
                                <a href="{$inc_nor_path}flow" class="hvr-underline-from-left">のりができるまで</a>
                            </li>
                            <li>
                                <a href="{$inc_nor_path}voice" class="hvr-underline-from-left">お客様のお声</a>
                            </li>
                            <li>
                                <a href="{$inc_nor_path}introduction" class="hvr-underline-from-left">店舗紹介</a>
                            </li>
                        </ul>
                        <ul class="mt15 clearfix">
                            <li>
                                <a href="{$inc_nor_path}seller" class="hvr-underline-from-left">販売店業者様へ</a>
                            </li>
                            <li>
                                <a href="{$inc_nor_path}company" class="hvr-underline-from-left">会社案内</a>
                            </li>
                            <li>
                                <a href="{$inc_nor_path}news" class="hvr-underline-from-left">新着情報</a>
                            </li>
                            <li>
                                <a href="{$inc_nor_path}contact" class="hvr-underline-from-left">お問い合わせ</a>
                            </li>
                            <li>
                                <a href="{$inc_nor_path}shopping/total.html#guide04" class="hvr-underline-from-left">個人情報保護方針</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer_content clearfix">
                        <div class="left_footer clearfix">
                            <p class="f_logo">
                                <a href="{$inc_nor_path}"><img src="{$inc_file_path}common_img/f_logo.png" alt="株式会社谷海苔店"></a>
                            </p>
                            <p class="f_address">
            〒260-0025<br>千葉県千葉市中央区問屋町16-6
                            </p>
                        </div>
                        <div class="right_footer clearfix">
                            <p class="f_tel">
                                <img src="{$inc_file_path}common_img/f_tel.png" alt="043-242-4252 営業時間｜9:00～17:00　休日｜水日祝">
                            </p>
                            <p class="f_contact">
                                <a href="{$inc_nor_path}contact"><img src="{$inc_file_path}common_img/f_btn.png" alt="お問い合わせ"></a>
                            </p>
                        </div>
                    </div>
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
