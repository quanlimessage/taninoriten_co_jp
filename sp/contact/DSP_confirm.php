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
        <link rel="canonical" href="http://www.taninoriten.co.jp/contact">

        <!-- CSS -->
        <link rel="stylesheet" href="../css/reset.css">
        <!-- リセット用 -->
        <link rel="stylesheet" href="../css/base.css">
        <!-- 全体のレイアウト・共通設定用 -->
        <link rel="stylesheet" href="../css/content.css">
        <link rel="stylesheet" href="../css/form.css">
        <!-- トップページの設定用 -->
        <!-- JS -->
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script><!-- jQueryの読み込み -->
        <script>window.jQuery || document.write('<script src="../js/jquery-1.8.min.js"><\/script>')</script>
        <script>
            /*MAP Banner Contact*/
            $(document).ready(function(e) {
                $('img[usemap]').rwdImageMaps();
            });
        </script>
        <script type="text/javascript" src="../../contact/common.js"></script>
        <?php echo DispAnalytics();?>
    </head>

    <body id="pagetop" class="toppage">
        <article id="wrapper">
            <!-- wrapper -->
            <header>
                <!-- header -->
                <h1><a href="../"><img src="../common_img/h_logo.png" alt="株式会社谷海苔店" width="225"></a></h1>
                <?php echo DispHeader();?>
            </header>
            <!-- end header -->
            <article class="tt_pages">
                <h2><img src="./images/tt_pages.png" alt="お問い合わせ" width="137"></h2>
            </article>
            <main>
                <!-- main -->
                <article class="content" id="contact">
                    <div class="sec_contact">
                        <p class="mb7pr"><img src="images/banner_01.jpg" alt="オンラインショップで販売している各種商品、オンラインショップの捜査などに関するお問い合わせは、下記フォームよりご連絡ください。その他商品の販売、紹介希望などお取引に関するお問い合わせも随時お待ちしております。"></p>

                        <h3 class="mb3pr"><img src="./images/tit_02.jpg" alt="お問い合わせフォーム"></h3>
                        <p>
          下記の内容で承ります。<br>
				入力内容に誤りがないか再度確認してください。<br>
				万が一誤りがあった場合は、「前に戻り修正します」ボタンを押して<br>
				入力画面に戻り修正してください。<br>
				間違いがなければ「上記の内容で送信します」ボタンを押してください。<br>
				後日、担当者よりご連絡いたします。
                        </p>
                        <a name="mf"></a>
                        <form method="post" action="./#mf" onsubmit="return inputChk(this,true)">
                            <table class="style_table01">
                                <tbody>
                                <tr>
                                    <th>
                                        <span class="red">必須</span>
                                        <p>お問い合わせ項目</p>
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        <?php echo ($inquiry_item)?$inquiry_item:"&nbsp;";?><input name="inquiry_item" type="hidden" value="<?php echo $inquiry_item;?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <span class="red">必須</span>
                                        <p>お名前</p>
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        <?php echo ($name)?$name:"&nbsp;";?><input name="name" type="hidden" value="<?php echo $name;?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <span class="red">必須</span>
                                        <p>フリガナ</p>
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        <?php echo ($kana)?$kana:"&nbsp;";?><input name="kana" type="hidden" value="<?php echo $kana;?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <span class="red">必須</span>
                                        <p>メールアドレス</p>
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        <?php echo ($email)?$email:"&nbsp;";?><input name="email" type="hidden" value="<?php echo $email;?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <span class="blue">任意</span>
                                        <p>電話番号</p>
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        <?php echo ($tel)?$tel:"&nbsp;";?><input name="tel" type="hidden" value="<?php echo $tel;?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <span class="blue">任意</span>
                                        <p>FAX番号</p>
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        <?php echo ($fax)?$fax:"&nbsp;";?><input name="fax" type="hidden" value="<?php echo $fax;?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <span class="blue">任意</span>
                                        <p>住所</p>
                                    </th>
                                </tr>
                                <tr>
                                    <td>〒<?php echo ($zip)?$zip:"&nbsp;";?><input name="zip" type="hidden" value="<?php echo $zip;?>"><br>
                                        <?php echo ($state)?$state:"&nbsp;";?><input name="state" type="hidden" value="<?php echo $state;?>">
                                        <?php echo ($address)?$address:"&nbsp;";?><input name="address" type="hidden" value="<?php echo $address;?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <span class="red">必須</span>
                                        <p>お問い合わせ内容</p>
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        <?php echo ($comment)?nl2br($comment):"&nbsp;";?><input type="hidden" name="comment" value="<?php echo $comment;?>">
                                    </td>
                                </tr>
            </tbody>
                            </table>
                            <br>
                            <div align="center">
                                <input type="button" value="&lt;&lt;&nbsp;前に戻り修正します" onclick="javascript:history.back();">
                                <input type="hidden" value="1" name="agreement">
                                <input name="Submit" type="submit" value="上記の内容で送信します&nbsp;&gt;&gt;">
                                <input type="hidden" name="action" value="completion"><br>

                            </div>
                        </form>

                    </div>
                </article>
                <!-- content -->
            </main>
            <!-- end main -->
            <?php echo DispFooter();?>
            <!-- end footer -->
        </article>
        <!-- end wrapper -->
        <!-- End tn-wrapper -->
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../js/common.js"></script>
        <script src="../js/jquery.rwdImageMaps.min.js"></script>
        <?php echo DispBeforeBodyEndTag();?>

    </body>
</html>