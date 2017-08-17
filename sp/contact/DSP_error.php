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
        
        <a name="mf"></a>
	   <form method="post" action="./" onSubmit="return inputChk(this,true)">
		<table width="100%"  border="0" cellspacing="2" cellpadding="5">
		  <tr bgcolor="#FFFFFF" align="left">
			<td colspan="2" align="center">
			<p style="color:#FF0000;font-weight: bold;text-align:center;">
			<br>
			恐れ入りますが、下記の内容を確認してください<br><br>
			<?php echo $error_mes;?>
			</p>
			<div align="center">
			<input type="button" value="&lt;&lt;&nbsp;前に戻り修正します" onClick="javascript:history.back();">

			<br>

			</div>
			</td>
		  </tr>
		</table>
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