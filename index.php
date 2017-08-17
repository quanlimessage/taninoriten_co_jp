<?php
    include('news.php');
    require_once("./common/include_disp.php");
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>千葉県優良県産品の焼きのり谷海苔店。お歳暮、お中元、ギフト、仏事にどうぞ。</title>
        <meta name="description" content="株式会社谷海苔店は千葉県優良県産品に選ばれたの焼きのりを皆様にお届けします。お歳暮、お中元、ギフト、仏事の際には弊社の海苔を是非ご利用ください。">
        <meta name="keywords" content="谷海苔店,千葉,海苔,のり,焼きのり,お歳暮,お中元,県産品">
        <meta name="robots" content="INDEX,FOLLOW">
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=1000">

        <!-- CSS -->
        <link href="./css/reset.css" rel="stylesheet" type="text/css">
        <link href="./css/base.css" rel="stylesheet" type="text/css">
        <link href="./css/top.css" rel="stylesheet" type="text/css">
        <!-- JS -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script><!-- jQueryの読み込み -->
        <script>window.jQuery || document.write('<script src="./js/jquery.min.js"><\/script>')</script><!-- 上記CDNダウン時のフォールバック -->
        <?php echo DispAnalytics();?>
    </head>
    <body>
        <div class="wrapper">
            <header id="header">
                <section class="container">
                    <div class="header_content clearfix">
                        <p class="h_logo">
                            <a href="./"><img src="./common_img/h_logo.png" alt="株式会社谷海苔店"></a>
                        </p>
                        <div class="head_infor">
                            <h1 class="SEO">谷海苔店は千葉県優良県産品の焼きのりをお届け。お歳暮、お中元、ギフト、仏事に弊社の海苔を是非ご利用ください。</h1>
                            <div class="main_infor clearfix">
                                <div class="h_sitemap">
                                    <ul>
                                        <li class="pull_left">
                                            <a href="./company">
                                                <img src="./common_img/h_btn01.png" alt="会社案内">
                                            </a>
                                        </li>
                                        <li class="pull_right">
                                            <a href="./news">
                                                <img src="./common_img/h_btn02.png" alt="新着情報">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="h_tel">
                                    <img src="./common_img/h_tel.png" alt="043-242-4252 営業時間｜9:00～17:00　休日｜水日祝">
                                </div>
                                <div class="h_btn">
                                    <ul>
                                        <li class="mb05">
                                            <a href="./regist"><img src="./common_img/h_btn03.png" alt="お買い物カゴを見る"></a>
                                        </li>
                                        <li>
                                            <a href="./contact"><img src="./common_img/h_btn04.png" alt="メールお問い合わせ"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </header>
            <!-- end header -->
            <nav id="gnav">
                <ul class="container clearfix">
                    <li class="hvr-underline-from-left">
                        <a href="./about"><img src="./common_img/gnav_01_off.png" alt="谷海苔店のこだわり"></a>
                    </li>
                    <li class="hvr-underline-from-left">
                        <a href="./shopping"><img src="./common_img/gnav_02_off.png" alt="お買いもの"></a>
                    </li>
                    <li class="hvr-underline-from-left">
                        <a href="./flow"><img src="./common_img/gnav_03_off.png" alt="のりができるまで"></a>
                    </li>
                    <li class="hvr-underline-from-left">
                        <a href="./voice"><img src="./common_img/gnav_04_off.png" alt="お客様のお声"></a>
                    </li>
                    <li class="hvr-underline-from-left">
                        <a href="./introduction"><img src="./common_img/gnav_05_off.png" alt="店舗紹介"></a>
                    </li>
                    <li class="hvr-underline-from-left">
                        <a href="./seller"><img src="./common_img/gnav_06_off.png" alt="販売業者様へ"></a>
                    </li>
                </ul>
            </nav>
            <!-- end gnav -->
            <main>
                <section class="main_visual">
                    <div class="container">
                        <h2><img src="./images/text_mainvisual.png" alt="初摘みの 焼きたて海苔を お届けします"></h2>
                    </div>
                </section>
                <div class="top_01">
                    <div class="container">
                        <h3 class="text_center"><img src="./images/top01_ttl.jpg" alt="おすすめ商品 recommend"></h3>
                        <ul class="style_list01 clearfix">
                            <?php if(count($fetch_recomend) > 0){?>
                            <?php for($i=0;$i<count($fetch_recomend);$i++):?>
                            <li>
                                <?php
                                    $ititle = strip_tags($fetch_recomend[$i]["PRODUCT_NAME"]);
                                    if(search_file_flg("./shopping/product_img/",$fetch_recomend[$i]['PRODUCT_ID']."_s.*")){
					                    $img_path = search_file_disp("./shopping/product_img/",$fetch_recomend[$i]['PRODUCT_ID']."_s.*","",2);
					                    echo "<p class=\"list01_img\"><img src=\"{$img_path}?r=".rand()."\" alt=\"{$ititle}\"></p>\n";
				                    }else{
					                    echo "&nbsp;\n";
				                    }
                                ?>
                                <p class="list01_title">
                                    <a href="./shopping?pid=<?php echo $fetch_recomend[$i]['PRODUCT_ID'];?>"><?php echo ($fetch_recomend[$i]["PRODUCT_NAME"])?nl2br($fetch_recomend[$i]["PRODUCT_NAME"]):"";?></a>
                                </p>
                                <p class="list01_price"><?php echo ($fetch_recomend[$i]["SELLING_PRICE"])?"価格 ".number_format(math_tax($fetch_recomend[$i]["SELLING_PRICE"]))."円(税込)":"";?></p>
                            </li>
                            <?php endfor;?>
                            <?php }?>
                        </ul>
                    </div>
                </div>
                <!-- end top_01 -->
                <div class="top_02">
                    <div class="container">
                        <h3 class="text_center"><img src="./images/top02_ttl.png" alt="用途で選ぶ purpose"></h3>
                        <ul class="ml40 mr30 mt45 clearfix">
                            <li class="pull_left">
                                <a href="./shopping/?ca=1"><img src="./images/top02_ban01.png" alt="焼きのり ギフト・ご贈答用"></a>
                            </li>
                            <li class="pull_right">
                                <a href="./shopping/?ca=2"><img src="./images/top02_ban02.png" alt="焼きのり 食卓用"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end top_02 -->
                <div class="top_03">
                    <div class="container">
                        <div class="top03_sec01">
                            <h3 class="text_center"><img src="./images/top03_ttl.png" alt="谷海苔店について about us"></h3>
                            <div class="clearfix">
                                <div class="style_list02">
                                    <p class="list02_img">
                                        <img src="./images/top03_img01.jpg" alt="谷海苔店のこだわり">
                                    </p>
                                    <div class="list02_content">
                                        <h4 class="list02_title">
                  谷海苔店のこだわり
                                        </h4>
                                        <p class="list02_txt">
                  弊社製品は千葉県、千葉市より優良名産品として推奨される評価を頂いております。
                                        </p>
                                        <p class="list02_btn">
                                            <a href="./about"><img src="./images/top03_btn.png" alt="詳しくはこちら"></a>
                                        </p>
                                    </div>
                                </div>
                                <div class="style_list02">
                                    <p class="list02_img">
                                        <img src="./images/top03_img02.jpg" alt="のりができるまで">
                                    </p>
                                    <div class="list02_content">
                                        <h4 class="list02_title">
                  のりができるまで
                                        </h4>
                                        <p class="list02_txt">
                  海苔の繁殖から摘採、海苔が市場に出るまでの流れをご紹介いたします。
                                        </p>
                                        <p class="list02_btn">
                                            <a href="./flow"><img src="./images/top03_btn.png" alt="詳しくはこちら"></a>
                                        </p>
                                    </div>
                                </div>
                                <div class="style_list02 mr00">
                                    <p class="list02_img">
                                        <img src="./images/top03_img03.jpg" alt="お客様のお声">
                                    </p>
                                    <div class="list02_content">
                                        <h4 class="list02_title">
                  お客様のお声
                                        </h4>
                                        <p class="list02_txt">
                  谷海苔店へ寄せられたお客様のお声をご紹介いたします。ご購入前にご一読ください。
                                        </p>
                                        <p class="list02_btn">
                                            <a href="./voice"><img src="./images/top03_btn.png" alt="詳しくはこちら"></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end top03_sec01 -->
                        <div class="clearfix">
                            <div class="top03_sec02">
                                <h4 class="text_center mb15"><img src="./images/top03_ttl02.png" alt="お問い合わせ"></h4>
                                <p class="text_center">
              谷海苔店の商品や販売等に関する<br>お問い合わせはこちらからどうぞ
                                </p>
                                <div class="top03_contact">
                                    <dl class="clearfix">
                                        <dt>
                                            <img src="./images/top03_tit01.png" alt="お電話">
                                        </dt>
                                        <dd>
                                            <img src="./images/top03_tel.png" alt="043-242-4252 営業時間｜9:00～17:00　休日｜水日祝">
                                        </dd>
                                    </dl>
                                    <dl class="clearfix">
                                        <dt>
                                            <img src="./images/top03_tit02.png" alt="E-mail">
                                        </dt>
                                        <dd class="mt05">
                                            <a href="./contact"><img src="./images/top03_contact.png" alt="お問い合わせフォーム"></a>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                            <!-- end top03_sec02 -->
                            <div class="top03_sec03">
                                <div class="sec03_title clearfix">
                                    <h4 class="text_center mb15"><img src="./images/top03_tit03.png" alt="お買いものガイド"></h4>
                                    <a href="./regist"><img src="./images/top03_btn_cart.png" alt="かごの中を見る" class="mt05"></a>
                                </div>
                                <div class="clearfix">
                                    <div class="sidemap_sec03">
                                        <ul>
                                            <li>
                                                <a href="./shopping/total.html#guide01">ご購入方法</a>
                                            </li>
                                            <li>
                                                <a href="./shopping/total.html#guide02">ご利用規約</a>
                                            </li>
                                            <li>
                                                <a href="./shopping/total.html#guide03">特定商取引法に基づく表記</a>
                                            </li>
                                            <li>
                                                <a href="./shopping/total.html#guide04">個人情報保護方針</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="right_sec03">
                                        <h5 class="f17 mb30">◆返品について◆</h5>
                                        <p>商品到着後、7日以内に弊社までご<br>連絡の上、ご返送ください。</p>
                                        <a href="./shopping/total.html#guide02_3"><img src="./images/top03_btn02.png" alt="詳しくはこちら" class="mt30"></a>
                                    </div>
                                </div>
                            </div>
                            <!-- end top03_sec03 -->
                        </div>
                    </div>
                </div>
                <!-- end top_03 -->
                <div class="top_04">
                    <div class="container">
                        <ul class="style_list03 clearfix">
                            <li>
                                <p class="list03_img">
                                    <a href="./introduction"><img src="./images/top04_img01.png" alt="店舗情報"></a>
                                </p>
                                <p class="list03_title">店舗情報</p>
                                <p>千葉県みなと駅にある<br>谷海苔店の直営店舗を<br>ご紹介します。</p>
                            </li>
                            <li>
                                <p class="list03_img">
                                    <a href="./seller"><img src="./images/top04_img02.png" alt="販売業者様へ"></a>
                                </p>
                                <p class="list03_title">販売業者様へ</p>
                                <p>商品のお取扱い、お取引を<br>希望される業者様への<br>ご案内です。</p>
                            </li>
                            <li>
                                <p class="list03_img">
                                    <a href="./company"><img src="./images/top04_img03.png" alt="会社案内"></a>
                                </p>
                                <p class="list03_title">会社案内</p>
                                <p>谷海苔店の会社概要・<br>アクセスマップを<br>ご案内いたします。</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end top_04 -->
                <div class="top_05">
                    <div class="container clearfix">
                        <div class="top05_ttl">
                            <h3 class="mb25"><img src="./images/top05_ttl.png" alt="お知らせ Information"></h3>
                            <a href="./news"><img src="./images/top05_btn.png" alt="一覧を見る"></a>
                        </div>
                        <div class="news_content">
                            <?php for($i=0;$i<count($fetch);$i++):?>
                            <dl class="clearfix">
                                <dt><?php echo $time[$i];?></dt>
                                <dd>
                                    <?php
										if($link[$i]){
											if($link_flg[$i] == 1){
												echo "<a href='./news/?id={$id[$i]}'>{$title[$i]}</a>";
											}
											elseif($link_flg[$i] == 2){
												echo "<a href='{$link[$i]}' target=\"_blank\">{$title[$i]}</a>";
											}
											elseif($link_flg[$i] == 3){
												echo "<a href='{$link[$i]}'>{$title[$i]}</a>";
											}

										}
										else{
											echo "<a href='./news/?id={$id[$i]}'>{$title[$i]}</a>";
										}
										?>
                                </dd>
                            </dl>
                            <?php endfor;?>
                        </div>
                    </div>
                </div>
            </main>
            <!-- end main -->
            <footer id="footer">
                <div id="back-top">
                    <a class="ov_hover" href="#wrapper"><img src="./common_img/page_top.png" alt="To Top"></a>
                </div>
                <div class="container">
                    <div class="footer_sitemap">
                        <ul class="clearfix">
                            <li>
                                <a href="./about" class="hvr-underline-from-left">谷海苔店のこだわり</a>
                            </li>
                            <li>
                                <a href="./shopping" class="hvr-underline-from-left">お買いもの</a>
                            </li>
                            <li>
                                <a href="./flow" class="hvr-underline-from-left">のりができるまで</a>
                            </li>
                            <li>
                                <a href="./voice" class="hvr-underline-from-left">お客様のお声</a>
                            </li>
                            <li>
                                <a href="./introduction" class="hvr-underline-from-left">店舗紹介</a>
                            </li>
                        </ul>
                        <ul class="mt15 clearfix">
                            <li>
                                <a href="./seller" class="hvr-underline-from-left">販売店業者様へ</a>
                            </li>
                            <li>
                                <a href="./company" class="hvr-underline-from-left">会社案内</a>
                            </li>
                            <li>
                                <a href="./news" class="hvr-underline-from-left">新着情報</a>
                            </li>
                            <li>
                                <a href="./contact" class="hvr-underline-from-left">お問い合わせ</a>
                            </li>
                            <li>
                                <a href="./shopping/total.html#guide04" class="hvr-underline-from-left">個人情報保護方針</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer_content clearfix">
                        <div class="left_footer clearfix">
                            <p class="f_logo">
                                <a href="./"><img src="./common_img/f_logo.png" alt="株式会社谷海苔店"></a>
                            </p>
                            <p class="f_address">
            〒260-0025<br>千葉県千葉市中央区問屋町16-6
                            </p>
                        </div>
                        <div class="right_footer clearfix">
                            <p class="f_tel">
                                <img src="./common_img/f_tel.png" alt="043-242-4252 営業時間｜9:00～17:00　休日｜水日祝">
                            </p>
                            <p class="f_contact">
                                <a href="./contact"><img src="./common_img/f_btn.png" alt="お問い合わせ"></a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end footer -->
        </div>
        <!-- end wrapper -->
        <!-- End tn-wrapper -->
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script type="text/javascript" src="./js/common.js"></script>
        <script type="text/javascript" src="./js/fix-height.js"></script>
        <?php echo DispBeforeBodyEndTag();?>
        <?php echo DispAccesslog();?>
    </body>
</html>