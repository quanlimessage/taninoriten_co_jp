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
                            <p class="text_51473b ml15">
                                下記の内容で承ります。<br>
				                入力内容に誤りがないか再度確認してください。<br>
				                万が一誤りがあった場合は、「前に戻り修正します」ボタンを押して<br>
				                入力画面に戻り修正してください。<br>
				                間違いがなければ「上記の内容で送信します」ボタンを押してください。<br>
				                後日、担当者よりご連絡いたします。
                            </p>
                            <form method="post" action="./#mf" onsubmit="return inputChk(this,true)">
                                <table class="style_table01">
                                    <tbody>
                                    <tr>
                                        <th>
                                            <span class="red">必須</span>
                                            <p>お問い合わせ項目</p>
                                        </th>
                                        <td><?php echo ($inquiry_item)?$inquiry_item:"&nbsp;";?><input name="inquiry_item" type="hidden" value="<?php echo $inquiry_item;?>"></td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <span class="red">必須</span>
                                            <p>お名前</p>
                                        </th>
                                        <td><?php echo ($name)?$name:"&nbsp;";?><input name="name" type="hidden" value="<?php echo $name;?>"></td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <span class="red">必須</span>
                                            <p>フリガナ</p>
                                        </th>
                                        <td><?php echo ($kana)?$kana:"&nbsp;";?><input name="kana" type="hidden" value="<?php echo $kana;?>"></td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <span class="red">必須</span>
                                            <p>メールアドレス</p>
                                        </th>
                                        <td>
                                            <?php echo ($email)?$email:"&nbsp;";?><input name="email" type="hidden" value="<?php echo $email;?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <span class="blue">任意</span>
                                            <p>電話番号</p>
                                        </th>
                                        <td><?php echo ($tel)?$tel:"&nbsp;";?><input name="tel" type="hidden" value="<?php echo $tel;?>"></td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <span class="blue">任意</span>
                                            <p>FAX番号</p>
                                        </th>
                                        <td><?php echo ($fax)?$fax:"&nbsp;";?><input name="fax" type="hidden" value="<?php echo $fax;?>"></td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <span class="blue">任意</span>
                                            <p>住所</p>
                                        </th>
                                        <td>
                                            〒<?php echo ($zip)?$zip:"";?><br>
                                            <?php echo ($state)?($state):"";?><?php echo ($address)?' '.($address):"&nbsp;";?>
                                            <input type="hidden" name="zip" value="<?php echo $zip;?>">
                                            <input type="hidden" name="state" value="<?php echo $state;?>">
                                            <input type="hidden" name="address" value="<?php echo $address;?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <span class="red">必須</span>
                                            <p>お問い合わせ内容</p>
                                        </th>
                                        <td style="word-break: break-all;">
                                            <?php echo ($comment)?nl2br($comment):"&nbsp;";?><input type="hidden" name="comment" value="<?php echo $comment;?>">
                                        </td>
                                    </tr>
              </tbody>
                                </table>
                                <div class="form_submit mt35">
                                    <input type="button" value="&lt;&lt;&nbsp;前に戻り修正します" onclick="javascript:history.back();">
                                    <input type="hidden" name="agreement" value="1">
                                    <input name="Submit" type="submit" value="上記の内容で送信します&nbsp;&gt;&gt;">
                                    <input type="hidden" name="action" value="completion"><br>
                                </div>
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