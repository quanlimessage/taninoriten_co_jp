<?php
    /***********************************************************
    SiteWin10 20 30（MySQL対応版）
    S系表示用プログラム
    View：取得したデータをHTML出力
    
    ***********************************************************/
    
    // 不正アクセスチェック
    if(!$injustice_access_chk){
        header("HTTP/1.0 404 Not Found");exit();
    }
    
        #--------------------------------------------------------
        # ページング用リンク文字列処理
        #--------------------------------------------------------
    
            //ページリンクの初期化
            $link_prev = "";
            $link_next = "";
    
            // 次ページ番号
            $next = $p + 1;
            // 前ページ番号
            $prev = $p - 1;
    
            // 商品全件数
            $tcnt = count($fetchCNT);
            // 全ページ数
            $totalpage = ceil($tcnt/$page);
    
            // カテゴリー別で表示していればページ遷移もカテゴリーパラメーターをつける
            if($ca)$cpram = "&ca=".urlencode($ca);
    
            // 前ページへのリンク
            if($p > 1){
                $link_prev = "<a href=\"./?p=".urlencode($prev).$cpram."\">前のページへ</a>";
            }
    
            //次ページリンク
            if($totalpage > $p){
                $link_next = "<a href=\"./?p=".urlencode($next).$cpram."\">次のページへ</a>";
            }
    
    #-------------------------------------------------------------
    # HTTPヘッダーを出力
    #	１．文字コードと言語：utf8で日本語
    #	２．ＪＳとＣＳＳの設定：する
    #	３．有効期限：設定しない
    #	４．キャッシュ拒否：設定する
    #	５．ロボット拒否：設定しない
    #-------------------------------------------------------------
    utilLib::httpHeadersPrint("UTF-8",true,true,false,false);
?>
<?php require_once("../common/include_disp.php");?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>新着情報｜千葉県優良県産品の焼きのり谷海苔店。お歳暮、お中元、ギフト、仏事にどうぞ。</title>
        <meta name="description" content="株式会社谷海苔店の最新情報をご紹介します。弊社は千葉県優良県産品に選ばれたの焼きのりを皆様にお届けします。お歳暮、お中元、ギフト、仏事の際には弊社の海苔を是非ご利用ください。">
        <meta name="keywords" content="谷海苔店,千葉,海苔,のり,焼きのり,お歳暮,お中元,優良県産品">
        <meta name="robots" content="INDEX,FOLLOW">
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=1000">

        <!-- CSS -->
        <link href="../css/reset.css" rel="stylesheet" type="text/css">
        <link href="../css/base.css" rel="stylesheet" type="text/css">
        <link href="../css/content.css" rel="stylesheet" type="text/css">
        <link href="../css/lightbox.css" rel="stylesheet" type="text/css">
        <link href="../css/TMPL_news.css" rel="stylesheet" type="text/css">
        <!-- JS -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script><!-- jQueryの読み込み -->
        <script>window.jQuery || document.write('<script src="../js/jquery.min.js"><\/script>')</script><!-- 上記CDNダウン時のフォールバック -->
        <?php echo DispAnalytics();?>
    </head>
    <body>
        <div class="wrapper">
            <header id="header">
                <section class="container">
                    <div class="header_content clearfix">
                        <p class="h_logo">
                            <a href="../"><img src="../common_img/h_logo.png" alt="株式会社谷海苔店"></a>
                        </p>
                        <div class="head_infor">
                            <h1 class="SEO">新着情報｜谷海苔店は千葉県優良県産品の焼きのりをお届けします。お歳暮、お中元、ギフト、仏事にどうぞ。</h1>
                            <?php echo DispHeader();?>
                        </div>
                    </div>
                </section>
            </header>
            <!-- end header -->
            <?php echo DispHeader2();?>
            <!-- end gnav -->
            <main id="news_page">
                <section class="ttl_page">
                    <div class="container">
                        <h2><img src="./images/ttl_page.png" alt="新着情報"></h2>
                    </div>
                </section>
                <!-- end ttl_page -->
                <section id="breadcrumb">
                    <ul class="container clearfix">
                        <li><a href="../">HOME</a></li>
                        <li class="arrow">></li>
                        <li>新着情報</li>
                    </ul>
                </section>
                <!-- end breadcrumb -->
                <section id="main">
                    <div class="container clearfix">
                        <?php echo DispSide();?>
                        <div id="main_content">
                            <div class="sec_news">
                                <!-- コピーここから -->
                                <div id="news_list">

                                    <?php
                                        
                                        if(!count($fetch)):
                                            echo "<center><br>ただいま準備中のため、もうしばらくお待ちください。<br><br></center>\n";//表示件数が０件の場合
                                        
                                        else:
                                            for($i=0;$i<count($fetch);$i++):
                                        
                                            //ID
                                            $id = $fetch[$i]['RES_ID'];
                                        
                                            //日付
                                            $time = sprintf("%04d/%02d/%02d", $fetch[$i]['Y'], $fetch[$i]['M'], $fetch[$i]['D']);
                                            $datetime = sprintf("%04d-%02d-%02d", $fetch[$i]['Y'], $fetch[$i]['M'], $fetch[$i]['D']);
                                        
                                            //タイトル
                                            $title = ($fetch[$i]['TITLE'])?"<a href=\"./?id=".urlencode($id)."\">".$fetch[$i]['TITLE']."</a>":"&nbsp;";
                                            $ititle = ($fetch[$i]['TITLE'])?strip_tags($fetch[$i]['TITLE']):"";
                                        
                                            //コメント
                                            $content = ($fetch[$i]['CONTENT'])?mb_strimwidth(strip_tags($fetch[$i]['CONTENT']), 0, 420, "..."):"";
                                            //image拡大有（１）・無（０）表示
                                            $img_flg = $fetch[$i]['IMG_FLG'];
                                        
                                            // 画像
                                            if($_POST['act']){//プレビュー
                                                $img = $prev_img[1];
                                            }else{// 表示する画像を検索（拡張子の特定）
                                                if(search_file_flg("./up_img/",$id."_1.*")){
                                                    $img = search_file_disp("./up_img/",$id."_1.*","",2);
                                                }else{
                                                    $img = "";
                                                }
                                            }
                                        
                                            // 画像表示処理
                                            if(!file_exists($img)){
                                                $image = "";
                                        
                                            }else{
                                                //画像サイズが固定でない場合（サイズ自動調整、横固定縦可変など）
                                                $size = getimagesize($img);//画像サイズを取得
                                                if($img_flg==1){
                                                    $image = "<a href=\"{$img}\" data-lightbox=\"lightbox\"><img src=\"{$img}\" alt=\"{$ititle}\"></a>";
                                                }else{
                                                    $image = "<img src=\"{$img}\" alt=\"{$ititle}\">";
                                                }
                                                $image = "<div class=\"news_img\"><p>".$image."</p></div>";
                                            }
                                        
                                            //表示内容の格納
                                            $table = "
                                        <!-- .news_box -->
                                        <article class=\"news_box\">
                                            <header class=\"headline clearfix\">
                                                <time datetime=\"{$datetime}\">{$time}</time>
                                                <h2>{$title}</h2>
                                            </header>
                                            <div class=\"news_inner clearfix\">
                                                {$image}
                                                <div class=\"news_txt\">
                                                    {$content}
                                                </div>
                                            </div>
                                        </article>
                                        <!-- /.news_box -->
                                            ";
                                        
                                            //表示内容を表示する
                                            echo $table;
                                        
                                            endfor;
                                        endif;
                                        
                                    ?>

                                </div>
                                <!-- .news_pager -->
                                <div class="news_pager">
                                    <div class="clearfix">
                                        <p class="pager_btn prev_btn"><?php echo $link_prev;?></p>
                                        <p class="pager_btn next_btn"><?php echo $link_next;?></p>
                                    </div>
                                </div>
                                <!-- /.news_pager -->
                            </div>
                        </div>
                    </div>
                </section>
            </main>
            <!-- end main -->
            <?php echo DispFooter();?>
            <!-- end footer -->
        </div>
        <!-- end wrapper -->
        <!-- End tn-wrapper -->
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script type="text/javascript" src="../js/common.js"></script>
        <script type="text/javascript" src="../js/fix-height.js"></script>
        <script type="text/javascript" src="../js/lightbox.js"></script>
        <?php echo DispBeforeBodyEndTag();?>
        <?php echo DispAccesslog();?>
    </body>
</html>