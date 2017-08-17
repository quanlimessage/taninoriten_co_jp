<?php
    /************************************************************************
      お問い合わせフォーム（POST渡しバージョン）
     View：入力画面	※デフォルトで表示する画面
    
    ************************************************************************/
    
    // 不正アクセスチェック
    if(!$accessChk){
        header("HTTP/1.0 404 Not Found");exit();
    }
    
    // HTTPヘッダー
    utilLib::httpHeadersPrint("UTF-8",true,false,false,false);
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
                            <p class="mb60"><img src="./images/banner_01.jpg" alt="オンラインショップで販売している各種商品、オンラインショップの捜査などに関するお問い合わせは、下記フォームよりご連絡ください。その他商品の販売、紹介希望などお取引に関するお問い合わせも随時お待ちしております。"></p>
                            <h3 class="mb30"><img src="./images/tit_01.jpg" alt="お電話・FAXでのお問い合わせ"></h3>
                            <p class="mb50"><img src="./images/banner_02.jpg" alt="043-242-4252 043-242-0011 営業時間｜9:00～17:00　休日｜水日祝"></p>
                            <h3 class="mb20"><img src="./images/tit_02.jpg" alt="お問い合わせフォーム"></h3>
                            <p class="text_51473b ml15">
            お問い合わせフォームをご利用の際は、必ず下記「<a href="#pp" class="text_b29e62">個人情報保護方針</a>」をご一読ください。<br>下記内容に同意していただけましたら、下記フォームに必要事項をご入力のうえ、「入力内容確認画面へ」ボタンをクリックしてください。<br>なお、お問い合わせの内容によっては、ご返答が遅れる場合がございます。ご了承ください。
                            </p>
                            <form method="post" action="./confirm.php#mf" onsubmit="return inputChk(this,false)">
                                <table class="style_table01">
                                    <tbody>
                                    <tr>
                                        <th>
                                            <span class="red">必須</span>
                                            <p>お問い合わせ項目</p>
                                        </th>
                                        <td>
                                            <select name="inquiry_item" id="inquiry_item" class="ml10">
                                                <option selected="" value="">▼選択してください</option>
                                                <option value="掲載商品に関して">掲載商品に関して</option>
                                                <option value="お取引・商品の取扱いに関して">お取引・商品の取扱いに関して</option>
                                                <option value="オンラインショップに関して">オンラインショップに関して</option>
                                                <option value="その他のお問い合わせ">その他のお問い合わせ</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <span class="red">必須</span>
                                            <p>お名前</p>
                                        </th>
                                        <td>
                                            <input type="text" value="" name="name" id="" size="" tabindex="" accesskey="" placeholder="(例)山田　太郎">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <span class="red">必須</span>
                                            <p>フリガナ</p>
                                        </th>
                                        <td>
                                            <input type="text" value="" name="kana" id="" size="" tabindex="" accesskey="" placeholder="(例)ヤマダ　タロウ">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <span class="red">必須</span>
                                            <p>メールアドレス</p>
                                        </th>
                                        <td>
                                            <input type="text" value="" name="email" id="" size="" tabindex="" accesskey="" placeholder="(例)xxx@taninoriten.co.jp/半角数字">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <span class="blue">任意</span>
                                            <p>電話番号</p>
                                        </th>
                                        <td>
                                            <input type="text" value="" name="tel" id="" size="" tabindex="" accesskey="" placeholder="(例) 043-242-4252/半角数字">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <span class="blue">任意</span>
                                            <p>FAX番号</p>
                                        </th>
                                        <td>
                                            <input type="text" value="" name="fax" id="" size="" tabindex="" accesskey="" placeholder="(例) 043-242-4252/半角数字">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <span class="blue">任意</span>
                                            <p>住所</p>
                                        </th>
                                        <td>〒
                                            <input type="text" name="zip" id="zip" maxlength="8" value="" class="ime_off w30" placeholder="(例) 260-0025/半角数字">
                                            <p class="mt15 mb15">
                                                <label for="state">都道府県名</label>
                                                <select name="state" id="state" class="ml10">
                                                    <option selected="" value="">▼都道府県を選択してください</option>
                                                    <optgroup label="北海道・東北地方">
                                                    <option value="北海道">北海道</option>
                                                    <option value="青森県">青森県</option>
                                                    <option value="岩手県">岩手県</option>
                                                    <option value="秋田県">秋田県</option>
                                                    <option value="宮城県">宮城県</option>
                                                    <option value="山形県">山形県</option>
                                                    <option value="福島県">福島県</option>
                        </optgroup>
                                                    <optgroup label="関東地方">
                                                    <option value="東京都">東京都</option>
                                                    <option value="神奈川県">神奈川県</option>
                                                    <option value="埼玉県">埼玉県</option>
                                                    <option value="千葉県">千葉県</option>
                                                    <option value="茨城県">茨城県</option>
                                                    <option value="栃木県">栃木県</option>
                                                    <option value="群馬県">群馬県</option>
                        </optgroup>
                                                    <optgroup label="甲信越地方">
                                                    <option value="山梨県">山梨県</option>
                                                    <option value="長野県">長野県</option>
                                                    <option value="新潟県">新潟県</option>
                        </optgroup>
                                                    <optgroup label="東海地方">
                                                    <option value="静岡県">静岡県</option>
                                                    <option value="愛知県">愛知県</option>
                                                    <option value="岐阜県">岐阜県</option>
                                                    <option value="三重県">三重県</option>
                        </optgroup>
                                                    <optgroup label="北陸地方">
                                                    <option value="富山県">富山県</option>
                                                    <option value="石川県">石川県</option>
                                                    <option value="福井県">福井県</option>
                        </optgroup>
                                                    <optgroup label="近畿地方">
                                                    <option value="大阪府">大阪府</option>
                                                    <option value="京都府">京都府</option>
                                                    <option value="奈良県">奈良県</option>
                                                    <option value="滋賀県">滋賀県</option>
                                                    <option value="和歌山県">和歌山県</option>
                                                    <option value="兵庫県">兵庫県</option>
                        </optgroup>
                                                    <optgroup label="中国地方">
                                                    <option value="岡山県">岡山県</option>
                                                    <option value="広島県">広島県</option>
                                                    <option value="鳥取県">鳥取県</option>
                                                    <option value="島根県">島根県</option>
                                                    <option value="山口県">山口県</option>
                        </optgroup>
                                                    <optgroup label="四国地方">
                                                    <option value="香川県">香川県</option>
                                                    <option value="徳島県">徳島県</option>
                                                    <option value="愛媛県">愛媛県</option>
                                                    <option value="高知県">高知県</option>
                        </optgroup>
                                                    <optgroup label="九州・沖縄地方">
                                                    <option value="福岡県">福岡県</option>
                                                    <option value="佐賀県">佐賀県</option>
                                                    <option value="長崎県">長崎県</option>
                                                    <option value="大分県">大分県</option>
                                                    <option value="熊本県">熊本県</option>
                                                    <option value="宮崎県">宮崎県</option>
                                                    <option value="鹿児島県">鹿児島県</option>
                                                    <option value="沖縄県">沖縄県</option>
                        </optgroup>
                                                </select>
                                            </p>
                                            <p class="mb05">市区町村・番地・マンション名・部屋番号など</p>
                                            <input type="text" name="address" id="address" value="" class="ime_on" placeholder="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <span class="red">必須</span>
                                            <p>お問い合わせ内容</p>
                                        </th>
                                        <td>
                                            <textarea id="formTextBox" name="comment" rows="10" cols="60" placeholder=""></textarea>
                                        </td>
                                    </tr>
              </tbody>
                                </table>
                                <div class="form_submit mt35">
                                    <p class="confirm pb05">
                                        <label for="sendChkbox"><input type="checkbox" name="agreement" value="1" id="sendChkbox">弊社規定の「個人情報保護方針」の内容に同意する</label>
                                    </p>
                                    <p class="mb25">※ご同意いただけない場合は送信ができません。</p>
                                    <input type="image" tabindex="16" alt="送信内容確認画面へ" src="./images/btn.jpg" accesskey="g" class="btn_inp hover50" id="mail_preview" name="submit">
                                    <input type="hidden" name="action" value="confirm">
                                </div>
                            </form>
                            <h3 class="mb20 mt60" id="pp"><img src="./images/tit_02.jpg" alt="個人情報保護方針"></h3>
                            <div class="box_pp">
                                <p class="text_b29e62 text_bold mb25">【個人情報の利用目的】</p>
                                <p>a ) お客様のご要望に合わせたサービスをご提供するための各種ご連絡。<br>
                                    b ) お問い合わせいただいたご質問への回答のご連絡。</p>
                                <ul>
                                    <li><span>●</span>公正かつ適正な手段で、上記目的に必要となる個人情報を収集します。</li>
                                    <li><span>●</span>要配慮個人情報を取得する際は、ご本人の同意を得るものとします。</li>
                                    <li><span>●</span>取得した個人情報・要配慮個人情報は、ご本人の同意なしに目的以外では利用しません。</li>
                                    <li><span>●</span>情報が漏洩しないよう対策を講じ、従業員だけでなく委託業者も監督します。</li>
                                    <li><span>●</span>国内外を問わず、ご本人の同意を得ずに第三者に情報を提供しません。</li>
                                    <li><span>●</span>ご本人からの求めに応じ情報を開示します。</li>
                                    <li><span>●</span>公開された個人情報が事実と異なる場合、訂正や削除に応じます。</li>
                                    <li><span>●</span>個人情報の取り扱いに関する苦情に対し、適切・迅速に対処します。</li>
                                    <li><span>●</span>本個人情報保護方針の適用範囲は本ホームページ内のみとします。</li>
                                </ul>
                            </div>
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
        <?php echo DispAccesslog();?>
    </body>
</html>
