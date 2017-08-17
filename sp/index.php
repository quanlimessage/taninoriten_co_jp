<?php
    require_once("../news.php");
?>
<?php require_once("./common/include_disp.php");?>
<!DOCTYPE html>
<html dir="ltr" lang="ja">
    <head>
        <meta charset="UTF-8">
        <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
                    <!--[if IE]>
                        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
                        <![endif]-->
        <title>千葉県優良県産品の焼きのり谷海苔店。お歳暮、お中元、ギフト、仏事にどうぞ。</title>
        <meta name="description" content="株式会社谷海苔店は千葉県優良県産品に選ばれたの焼きのりを皆様にお届けします。お歳暮、お中元、ギフト、仏事の際には弊社の海苔を是非ご利用ください。">
        <meta name="keywords" content="谷海苔店,千葉,海苔,のり,焼きのり,お歳暮,お中元,県産品">
        <meta name="robots" content="INDEX,FOLLOW">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="format-detection" content="telephone=no">
        <link rel="canonical" href="http://www.taninoriten.co.jp">

        <!-- CSS -->
        <link rel="stylesheet" href="./css/reset.css">
        <!-- リセット用 -->
        <link rel="stylesheet" href="./css/base.css">
        <!-- 全体のレイアウト・共通設定用 -->
        <link rel="stylesheet" href="./css/top.css">
        <!-- トップページの設定用 -->
        <!-- JS -->
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script><!-- jQueryの読み込み -->
        <script>window.jQuery || document.write('<script src="./js/jquery-1.8.min.js"><\/script>')</script><!-- 上記CDNダウン時のフォールバック -->
        <script>
            /*MAP Banner Contact*/
            $(document).ready(function(e) {
                $('img[usemap]').rwdImageMaps();
            });
        </script>
        <?php echo DispAnalytics();?>
    </head>

    <body id="pagetop" class="toppage">
        <article id="wrapper">
            <!-- wrapper -->
            <header>
                <!-- header -->
                <h1><a href="./"><img src="./common_img/h_logo.png" alt="株式会社谷海苔店" width="225"></a></h1>
                <?php echo DispHeader();?>
            </header>
            <!-- end header -->
            <article>
                <h2><img src="./images/main_txt.jpg" alt="初摘みの焼きたて海苔をお届けします"></h2>
            </article>
            <main>
                <!-- main -->
                <section class="ctn01">
                    <h3 class="mb5pr"><img src="images/tt01.png" alt="おすすめ商品"></h3>
                    <ul class="clearfix">
                        <?php if(count($fetch_recomend) > 0){?>
                        <?php for($i=0;$i<count($fetch_recomend);$i++):?>
                        <li>
                            <?php
                                $ititle = strip_tags($fetch_recomend[$i]["PRODUCT_NAME"]);
                                if(search_file_flg("../shopping/product_img/",$fetch_recomend[$i]['PRODUCT_ID']."_s.*")){
                                    $img_path = search_file_disp("../shopping/product_img/",$fetch_recomend[$i]['PRODUCT_ID']."_s.*","",2);
                                    echo "<figure><img src=\"{$img_path}?r=".rand()."\" style=\"max-width: 147px;max-height: 112px;width: auto;\" alt=\"{$ititle}\"></figure>\n";
                                }else{
                                    echo "&nbsp;\n";
                                }
                            ?>
                            <h4><a href="./shopping?pid=<?php echo $fetch_recomend[$i]['PRODUCT_ID'];?>"><?php echo ($fetch_recomend[$i]["PRODUCT_NAME"])?nl2br($fetch_recomend[$i]["PRODUCT_NAME"]):"";?></a></h4>
                            <p class="price"><?php echo ($fetch_recomend[$i]["SELLING_PRICE"])?"価格 ".number_format(math_tax($fetch_recomend[$i]["SELLING_PRICE"]))."円(税込)":"";?></p>
                        </li>
                        <?php endfor;?>
                        <?php }?>
                    </ul>
                </section>
                <!-- ctn01 -->
                <section class="ctn02">
                    <h3 class="mb5pr"><img src="images/tt02.png" alt="用途で選ぶ"></h3>
                    <ul>
                        <li class="mb5pr"><a href="./shopping/?ca=1"><img src="images/banner01.png" alt="焼きのり ギフト・ご贈答用"></a></li>
                        <li><a href="./shopping/?ca=2"><img src="images/banner02.png" alt="焼きのり 食卓用"></a></li>
                    </ul>
                </section>
                <!-- ctn02 -->
                <section class="ctn03">
                    <div class="box01">
                        <div class="bg_white">
                            <h3><span><img src="images/tt03.png" alt="谷海苔店について" class="w64"></span></h3>
                            <div class="clearfix mt5pr">
                                <figure class="pull_left w30"><img src="images/img06.jpg" alt=""></figure>
                                <div class="msg">
                                    <h4>谷海苔店のこだわり</h4>
                                    <p>弊社製品は千葉県、千葉市より優良名産品として推奨される評価を頂いております。</p>
                                    <p class="mt3pr text_center"><a href="./about"><img src="images/btn01.png" alt="詳しくはこちら" class="w67"></a></p>
                                </div>
                            </div>
                            <div class="clearfix">
                                <figure class="pull_left w30"><img src="images/img07.jpg" alt=""></figure>
                                <div class="msg">
                                    <h4>のりができるまで</h4>
                                    <p>海苔の繁殖から摘採、海苔が市場に出るまでの流れをご紹介いたします。</p>
                                    <p class="mt3pr text_center"><a href="./about"><img src="images/btn01.png" alt="詳しくはこちら" class="w67"></a></p>
                                </div>
                            </div>
                            <div class="clearfix">
                                <figure class="pull_left w30"><img src="images/img08.jpg" alt=""></figure>
                                <div class="msg">
                                    <h4>お客様のお声</h4>
                                    <p>谷海苔店へ寄せられたお客様のお声をご紹介いたします。ご購入前にご一読ください。</p>
                                    <p class="mt3pr text_center"><a href="./about"><img src="images/btn01.png" alt="詳しくはこちら" class="w67"></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- box01 -->
                    <div class="box02">
                        <img src="images/banner03.jpg" alt="お問い合わせ" usemap="#Map">
                        <map name="Map" id="Map">
                            <area alt="" title="" href="tel:043-242-4252" shape="rect" coords="295,214,798,277" />
                            <area alt="" title="" href="./contact" shape="rect" coords="301,361,791,447" />
                        </map>
                    </div>
                    <!-- box02 -->
                    <div class="box03">
                        <h3><img src="images/tt04.png" alt="お買いものガイド"><a href="./regist"><img src="images/btn_card.png" alt="かごの中を見る"></a></h3>
                        <div class="bg">
                            <div class="clearfix">
                                <ul>
                                    <li><a href="./shopping/total.html#guide01">ご購入方法</a></li>
                                    <li><a href="./shopping/total.html#guide03">特定商取引法に基づく表記</a></li>
                                    <li><a href="./shopping/total.html#guide02">ご利用規約</a></li>
                                    <li><a href="./shopping/total.html#guide04">個人情報保護方針</a></li>
                                </ul>
                            </div>
                            <h4>◆返品について◆</h4>
                            <p>商品到着後、7日以内に弊社までご連絡の上、ご返送ください。</p>
                            <p class="mt3pr"><a href="./shopping/total.html#guide02_3"><img src="images/btn02.png" alt="詳しくはこちら" class="w50"></a></p>
                        </div>
                    </div>
                    <!-- box03 -->
                    <div class="box04 clearfix">
                        <ul>
                            <li>
                                <figure><img src="images/img09.png" alt=""></figure>
                                <h3><a href="./introduction">店舗情報</a></h3>
                                <p>千葉県みなと駅にある谷海苔店の直営店舗をご紹介します。</p>
                            </li>
                            <li>
                                <figure><img src="images/img10.png" alt=""></figure>
                                <h3><a href="./seller">販売業者様へ</a></h3>
                                <p>商品のお取扱い、お取引を希望される業者様へのご案内です。</p>
                            </li>
                            <li>
                                <figure><img src="images/img11.png" alt=""></figure>
                                <h3><a href="./company">会社案内</a></h3>
                                <p>谷海苔店の会社概要・アクセスマップをご案内いたします。</p>
                            </li>
                        </ul>
                    </div>
                    <!-- box04 -->
                </section>
                <!-- ctn03 -->
                <section class="ctn04">
                    <h3><img src="images/tt05.png" alt="お知らせ"><a href="./news"><img src="images/more.png" alt="一覧を見る"></a></h3>
                    <div class="ctn04_news">
                        <dl>
                            <?php for($i=0;$i<count($fetch);$i++):?>
                            <dt>
                                <?php echo $time[$i];?>
                            </dt>
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
                            <?php endfor;?>
                        </dl>
                    </div>
                </section>
                <!-- ctn04 -->
            </main>
            <!-- end main -->
            <?php echo DispFooter();?>
            <!-- end footer -->
        </article>
        <!-- end wrapper -->
        <!-- End tn-wrapper -->
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="./js/common.js"></script>
        <script src="./js/jquery.rwdImageMaps.min.js"></script>
        <?php echo DispBeforeBodyEndTag();?>
        <?php echo DispAccesslog();?>
    </body>
</html>