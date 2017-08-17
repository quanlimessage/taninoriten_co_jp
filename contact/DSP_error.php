<?php
    /************************************************************************
    お問い合わせフォーム（POST渡しバージョン）
     View：入力内容確認画面
    
    ************************************************************************/
    
    // 不正アクセスチェック
    if(!$accessChk){
        header("HTTP/1.0 404 Not Found");exit();
    }
    
    // HTTPヘッダを直接記述して出力
    
    utilLib::httpHeadersPrint("UTF-8",true,true,false,false);
?>
<?php require_once("../common/include_disp.php");?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>お問い合わせ｜千葉県優良県産品の焼きのり谷海苔店。お歳暮、お中元、ギフト、仏事にどうぞ。</title>
        <meta name="description" content="株式会社谷海苔店の商品に関するお問い合わせはお気軽にご連絡ください。弊社では千葉県優良県産品に選ばれたの焼きのりを皆様にお届けします。お歳暮、お中元、ギフト、仏事の際には弊社の海苔を是非ご利用ください。">
        <meta name="keywords" content="谷海苔店,千葉,海苔,のり,焼きのり,お歳暮,お中元,ギフト">
        <meta name="robots" content="INDEX,FOLLOW">
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=1000">

        <!-- CSS -->
        <link href="../css/reset.css" rel="stylesheet" type="text/css">
        <link href="../css/base.css" rel="stylesheet" type="text/css">
        <link href="../css/content.css" rel="stylesheet" type="text/css">
        <link href="../css/lightbox.css" rel="stylesheet" type="text/css">
        <link href="../css/TMPL_news.css" rel="stylesheet" type="text/css">
        <link href="../css/form.css" rel="stylesheet" type="text/css">
        <!-- JS -->
        <script type="text/javascript" src="common.js"></script>
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
                            <h1 class="SEO">お問い合わせ｜谷海苔店は千葉県優良県産品の焼きのりをお届けします。お歳暮、お中元、ギフト、仏事にどうぞ。</h1>
                            <?php echo DispHeader();?>
                        </div>
                    </div>
                </section>
            </header>
            <!-- end header -->
            <?php echo DispHeader2();?>
            <!-- end gnav -->
            <main id="contact_page">
                <section class="ttl_page">
                    <div class="container">
                        <h2><img src="./images/ttl_page.png" alt="お問い合わせ"></h2>
                    </div>
                </section>
                <!-- end ttl_page -->
                <section id="breadcrumb">
                    <ul class="container clearfix">
                        <li><a href="../">HOME</a></li>
                        <li class="arrow">></li>
                        <li>お問い合わせ</li>
                    </ul>
                </section>
                <!-- end breadcrumb -->
                <section id="main">
                    <div class="container clearfix">
                        <div class="sec_contact">
                            <h3 class="mb20"><img src="./images/tit_02.jpg" alt="お問い合わせフォーム"></h3>
                            <a name="mf"></a>
                            <form method="post" action="./" onsubmit="return inputChk(this,true)">
                                <table width="100%">
                                    <tr bgcolor="#FFFFFF" align="left">
                                        <td colspan="2" align="center">
                                            <p style="color:#FF0000;font-weight: bold;text-align:center;">
                                                <br>
			恐れ入りますが、下記の内容を確認してください<br><br>
                                                <?php echo $error_mes;?>
                                            </p>
                                            <div align="center">
                                                <input type="button" value="&lt;&lt;&nbsp;前に戻り修正します" onclick="javascript:history.back();">

                                                <br>

                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <!-- end sec_contact -->
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
    </body>
</html>