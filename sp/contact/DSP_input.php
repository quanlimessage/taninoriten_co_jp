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
        <h3 class="mb4pr"><img src="./images/tit_01.jpg" alt="お電話・FAXでのお問い合わせ"></h3>
        <div class="mb7pr">
          <img src="./images/banner_02.jpg" alt="043-242-4252 043-242-0011 営業時間｜9:00～17:00　休日｜水日祝" usemap="#Map">
          <map name="Map" id="Map">
            <area alt="" title="" href="tel:043-242-4252" shape="rect" coords="28,31,434,98" />
          </map>
        </div>
        <h3 class="mb3pr"><img src="./images/tit_02.jpg" alt="お問い合わせフォーム"></h3>
        <p>
          お問い合わせフォームをご利用の際は、必ず下記「<a href="../shopping/total.html#guide04" class="text_b29e62">個人情報保護方針</a>」をご一読ください。<br>下記内容に同意していただけましたら、下記フォームに必要事項をご入力のうえ、「入力内容確認画面へ」ボタンをクリックしてください。<br>なお、お問い合わせの内容によっては、ご返答が遅れる場合がございます。ご了承ください。
        </p>
        <form method="post" action="./confirm.php#mf" onSubmit="return inputChk(this,false)">
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
                  <select name="inquiry_item" id="state">
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
              </tr>
              <tr>
                <td>
                  <input type="text" value="" name="name" id="name" size="" tabindex="" accesskey="" placeholder="(例)山田　太郎">
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
                  <input type="text" value="" name="kana" id="kana" size="" tabindex="" accesskey="" placeholder="(例)ヤマダ　タロウ">
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
                  <input type="text" value="" name="email" id="email" size="" tabindex="" accesskey="" placeholder="(例)xxx@taninoriten.co.jp/半角数字">
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
                  <input type="text" value="" name="tel" id="tel" size="" tabindex="" accesskey="" placeholder="(例) 043-242-4252/半角数字">
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
                  <input type="text" value="" name="fax" id="fax" size="" tabindex="" accesskey="" placeholder="(例) 043-242-4252/半角数字">
                </td>
              </tr>
              <tr>
                <th>
                  <span class="blue">任意</span>
                  <p>住所</p>
                </th>
              </tr>
              <tr>
                <td>〒
                  <input type="text" name="zip" id="zip" maxlength="8" value="" class="ime_off w45" placeholder="(例) 260-0025/半角数字">
                  <p class="mt10 mb10">
                    <label for="state">都道府県名</label>
                    <select name="state" id="state" class="mt05 w73">
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
              </tr>
              <tr>
                <td>
                  <textarea id="formTextBox" name="comment" rows="6" cols="30" placeholder=""></textarea>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="form_submit mt5pr">
            <p class="mb5pr">
              <label for="sendChkbox"><input type="checkbox" name="agreement" value="1" id="sendChkbox">弊社規定の「<a href="../shopping/total.html#guide04">個人情報保護方針</a>」の内容に同意する<br>
              ※ご同意いただけない場合は送信ができません。</label>
            </p>
            <input type="image" tabindex="16" alt="送信内容確認画面へ" src="./images/btn.png" accesskey="g" class="w51" id="mail_preview" name="submit">
            <input type="hidden" name="action" value="confirm">
          </div>
        </form>
        <div id="pp" class="mt7pr">
          <h3 class="mb3pr"><img src="images/tit_03.jpg" alt="個人情報保護方針"></h3>
          <div class="box_pp">
            <h4 class="mb3pr color01">【個人情報の利用目的】</h4>
            <p>a ) お客様のご要望に合わせたサービスをご提供するための各種ご連絡。<br>
            b ) お問い合わせいただいたご質問への回答のご連絡。</p>
            <ul>
              <li>公正かつ適正な手段で、<br>
              上記目的に必要となる個人情報を収集します。</li>
              <li>要配慮個人情報を取得する際は、<br>
              ご本人の同意を得るものとします。</li>
              <li>取得した個人情報・要配慮個人情報は、<br>
              ご本人の同意なしに目的以外では利用しません。</li>
              <li>情報が漏洩しないよう対策を講じ、<br>従業員だけでなく委託業者も監督します。</li>
              <li>国内外を問わず、<br>ご本人の同意を得ずに第三者に情報を提供しません。</li>
              <li>ご本人からの求めに応じ情報を開示します。</li>
              <li>公開された個人情報が事実と異なる場合、<br>
              訂正や削除に応じます。</li>
              <li>個人情報の取り扱いに関する苦情に対し、<br>
              適切・迅速に対処します。</li>
              <li>本個人情報保護方針の適用範囲は本ホームページ内のみとします。</li>
            </ul>
          </div>
        </div>
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
<?php echo DispAccesslog();?>

</body>
</html>