<?php
/*******************************************************************************
アパレル対応

	受注情報：詳細購入情報の表示

*******************************************************************************/
#---------------------------------------------------------------
# 不正アクセスチェック（直接このファイルにアクセスした場合）
#	※厳しく行う場合はIDとPWも一致するかまで行う
#---------------------------------------------------------------
if( !$_SESSION['LOGIN'] ){
	header("Location: ../err.php");exit();
}
if( !$_SERVER['PHP_AUTH_USER'] || !$_SERVER['PHP_AUTH_PW'] ){
//	header("HTTP/1.0 404 Not Found"); exit();
}

#=============================================================
# HTTPヘッダーを出力
#	文字コードと言語：utf8で日本語
#	他：ＪＳとＣＳＳの設定／キャッシュ拒否／ロボット拒否
#=============================================================
utilLib::httpHeadersPrint("UTF-8",true,true,true,true);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo BO_TITLE;?></title>
<link href="../for_bk.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../common.js"></script>
</head>
<body>
<form action="../main.php" method="post">
<input type="submit" value="管理画面トップへ" style="width:150px;">
</form>
<p class="page_title">売上管理：購入詳細</p>
<p class="explanation">
▼決済・配送状況の情報を「決済」「配送」欄のクリックで切り替えることが出来ます。<br>
▼決済・配送情報を更新すると日付データも更新されます。
</p>
<table width="500" border="0" cellpadding="5" cellspacing="2" style="margin-top:1em;">
	<tr>
		<th colspan="2" align="center" valign="middle" nowrap class="tdcolored">■購入詳細</th>
	</tr>
	<tr>
		<th width="20%" align="right" valign="middle" nowrap class="tdcolored">注文番号：</th>
		<td valign="middle" class="other-td">&nbsp;<?php echo $fetchOrderCust[0]["ORDER_ID"];?></td>
	</tr>
	<tr>
		<th align="right" valign="middle" nowrap class="tdcolored">決済状況：</th>
		<form method="post" action="" style="margin:0px;">
		<td valign="middle" class="other-td">&nbsp;
		<?php if($fetchOrderCust[0]["PAYMENT_FLG"] == 1):?>
		<input type="submit" value="決済完了" style="width:60px;" onClick="return confirm('未決済にします。宜しいですか？');">
		<?php elseif($fetchOrderCust[0]["PAYMENT_FLG"] == 0):?>
		<input type="submit" value="未決済" style="background-color:#FF9900;border-color:#FF9900;width:60px;" onClick="return confirm('決済完了にします。宜しいですか？');">
		<?php elseif($fetchOrderCust[0]["PAYMENT_FLG"] == 2):?>
		<font style="font-size:12px;color:#FF0000;">決済失敗</font>
		<?php endif;?>
		</td>
		<input type="hidden" name="payment_flg" value="<?php echo $fetchOrderCust[0]["PAYMENT_FLG"];?>">
		<input type="hidden" name="regist_type" value="change_payment_flg">
		<input type="hidden" name="status" value="disp_details">
		<input type="hidden" name="target_order_id" value="<?php echo $fetchOrderCust[0]["ORDER_ID"];?>">
		</form>
	</tr>
	<tr>
		<th align="right" valign="middle" nowrap class="tdcolored">配送状況：</th>
		<form method="post" action="" style="margin:0px;">
		<td valign="middle" class="other-td">&nbsp;
		<?php if($fetchOrderCust[0]["SHIPPED_FLG"] == 1):?>
		<input type="submit" value="配送済" style="width:60px;" onClick="return confirm('未配送に修正します。宜しいですか？');">
		<?php else:?>
		<input type="submit" value="未配送" style="background-color:#FF9900;border-color:#FF9900;width:60px;" onClick="return confirm('配送完了にします。宜しいですか？');">
		<?php endif;?>
		</td>
		<input type="hidden" name="shipped_flg" value="<?php echo $fetchOrderCust[0]["SHIPPED_FLG"];?>">
		<input type="hidden" name="regist_type" value="change_shipped_flg">
		<input type="hidden" name="status" value="disp_details">
		<input type="hidden" name="target_order_id" value="<?php echo $fetchOrderCust[0]["ORDER_ID"];?>">
		</form>
	</tr>
	<tr>
		<th align="right" valign="middle" nowrap class="tdcolored">支払い方法：</th>

  <td valign="middle" class="other-td">&nbsp;
   <?php switch($fetchOrderCust[0]["PAYMENT_TYPE"]){case 1:echo "クレジット決済";break;case 2:echo "銀行振込決済";break;case 3:echo "代引き決済";break;case 4:echo "コンビニ決済";break;case 5:echo "郵便振替決済";break;}?>
  </td>
	</tr>
	<tr>
		<th align="right" valign="middle" nowrap class="tdcolored">注文日：</th>
		<td valign="middle" class="other-td">&nbsp;<?php if($fetchOrderCust[0]["ORDER_DATE"] &&($fetchOrderCust[0]["ORDER_DATE"] != "0000-00-00 00:00:00"))echo $fetchOrderCust[0]["ORDER_DATE"];?></td>
	</tr>
	<tr>
		<th align="right" valign="middle" nowrap class="tdcolored">支払日：</th>
		<td valign="middle" class="other-td">&nbsp;<?php if($fetchOrderCust[0]["PAYMENT_DATE"] &&($fetchOrderCust[0]["PAYMENT_DATE"] != "0000-00-00 00:00:00"))echo $fetchOrderCust[0]["PAYMENT_DATE"];?></td>
	</tr>
	<tr>
		<th align="right" valign="middle" nowrap class="tdcolored">配送日：</th>
		<td valign="middle" class="other-td">&nbsp;<?php if($fetchOrderCust[0]["SHIPPED_DAY"] && ($fetchOrderCust[0]["SHIPPED_DAY"] != "0000-00-00 00:00:00"))echo $fetchOrderCust[0]["SHIPPED_DAY"];?></td>
	</tr>
	<tr>
		<th align="right" valign="middle" nowrap class="tdcolored">購入金額：</th>
		<td valign="middle" class="other-td">&nbsp;<?php echo number_format($fetchOrderCust[0]["TOTAL_PRICE"]);?><?php echo ($fetchOrderCust[0]["PAYMENT_TYPE"] == 3)?"　※代引手数料（\\".$fetchOrderCust[0]["DAIBIKI_AMOUNT"]."）を含みます":"";?></td>
	</tr>
	<tr>
		<th align="right" valign="middle" nowrap class="tdcolored">送料：</th>
		<td valign="middle" class="other-td">&nbsp;<?php echo number_format($fetchOrderCust[0]["SHIPPING_AMOUNT"]);?></td>
	</tr>
	<tr>
		<th align="right" valign="middle" nowrap class="tdcolored">時間帯指定：</th>
		<td valign="middle" class="other-td"><?php echo ($fetchOrderCust[0]["DELI_TIME"])?$fetchOrderCust[0]["DELI_TIME"]:"&nbsp;";?></td>
	</tr>
	<tr>
		<th align="right" valign="middle" nowrap class="tdcolored">備考：</th>
		<td valign="middle" class="other-td"><?php echo ($fetchOrderCust[0]["REMARKS"])?nl2br($fetchOrderCust[0]["REMARKS"]):"&nbsp;";?></td>
	</tr>
</table>

<!-- 配送先 -->
<table width="500" border="0" cellpadding="5" cellspacing="2" style="margin-top:1em;">
	<tr valign="middle">
		<th colspan="2" align="center" nowrap class="tdcolored">■配送先</th>
	</tr>
	<tr valign="middle">
		<th width="20%" align="right" nowrap class="tdcolored">氏名：</th>
		<td class="other-td">&nbsp;<?php echo $fetchOrderCust[0]["DELI_LAST_NAME"]."&nbsp;".$fetchOrderCust[0]["DELI_FIRST_NAME"];?></td>
	</tr>
	<tr valign="middle">
		<th align="right" nowrap class="tdcolored">電話番号：</th>
		<td class="other-td">&nbsp;<?php echo $fetchOrderCust[0]["DELI_TEL1"]."-".$fetchOrderCust[0]["DELI_TEL2"]."-".$fetchOrderCust[0]["DELI_TEL3"];?></td>
	</tr>
	<tr valign="middle">
		<th align="right" nowrap class="tdcolored">郵便番号：</th>
		<td class="other-td">&nbsp;<?php echo $fetchOrderCust[0]["DELI_ZIP_CD1"]."-".$fetchOrderCust[0]["DELI_ZIP_CD2"];?></td>
	</tr>
	<tr valign="middle">
		<th align="right" nowrap class="tdcolored">都道府県：</th>
		<td class="other-td">&nbsp;<?php $sid = $fetchOrderCust[0]["DELI_STATE"];echo $shipping_list[$sid]['pref'];?></td>
	</tr>
	<tr valign="middle">
		<th align="right" nowrap class="tdcolored">市区町村番地：</th>
		<td class="other-td">&nbsp;<?php echo $fetchOrderCust[0]["DELI_ADDRESS1"];?></td>
	</tr>
	<tr valign="middle">
		<th align="right" nowrap class="tdcolored">マンション名 部屋番号など：</th>
		<td class="other-td">&nbsp;<?php echo $fetchOrderCust[0]["DELI_ADDRESS2"];?></td>
	</tr>
</table>

<!-- 購入者 -->
<table width="500" border="0" cellpadding="5" cellspacing="2" style="margin-top:1em;">
	<tr valign="middle">
		<th colspan="2" align="center" nowrap class="tdcolored">■購入者</th>
	</tr>
	<tr valign="middle">
		<th width="20%" align="right" nowrap class="tdcolored">会社名／店舗名：</th>
		<td class="other-td">&nbsp;<?php echo $fetchOrderCust[0]["COMPANY"];?></td>
	</tr>
	<tr valign="middle">
		<th width="20%" align="right" nowrap class="tdcolored">氏名：</th>
		<td class="other-td">&nbsp;<?php echo $fetchOrderCust[0]["LAST_NAME"]."&nbsp;".$fetchOrderCust[0]["FIRST_NAME"];?></td>
	</tr>
	<tr valign="middle">
		<th align="right" nowrap class="tdcolored">電話番号：</th>
		<td class="other-td">&nbsp;<?php echo $fetchOrderCust[0]["TEL1"]."-".$fetchOrderCust[0]["TEL2"]."-".$fetchOrderCust[0]["TEL3"];?></td>
	</tr>
	<tr valign="middle">
		<th align="right" nowrap class="tdcolored">FAX：</th>
		<td class="other-td">&nbsp;<?php echo $fetchOrderCust[0]["FAX1"]."-".$fetchOrderCust[0]["FAX2"]."-".$fetchOrderCust[0]["FAX3"];?></td>
	</tr>
	<tr valign="middle">
		<th align="right" nowrap class="tdcolored">郵便番号：</th>
		<td class="other-td">&nbsp;<?php echo $fetchOrderCust[0]["ZIP_CD1"]."-".$fetchOrderCust[0]["ZIP_CD2"];?></td>
	</tr>
	<tr valign="middle">
		<th align="right" nowrap class="tdcolored">都道府県：</th>
		<td class="other-td">&nbsp;<?php $sid = $fetchOrderCust[0]["STATE"];echo $shipping_list[$sid]['pref'];?></td>
	</tr>
	<tr valign="middle">
		<th align="right" nowrap class="tdcolored">市区町村番地：</th>
		<td class="other-td">&nbsp;<?php echo $fetchOrderCust[0]["ADDRESS1"];?></td>
	</tr>
	<tr valign="middle">
		<th align="right" nowrap class="tdcolored">マンション名 部屋番号など：</th>
		<td class="other-td">&nbsp;<?php echo $fetchOrderCust[0]["ADDRESS2"];?></td>
	</tr>
</table>
<p class="explanation">
▼上段に現在の管理メモ内容が表示されています。<br>
▼内容を編集したい場合には「メモ入力欄」にメモ内容を入力後、「内容更新」を押してください。
</p>
<form method="post" action="./" style="margin:0px;">
<table width="500" border="0" cellpadding="5" cellspacing="2">
	<tr>
		<th colspan="2" class="tdcolored">■管理メモ</th>
	</tr>
	<tr>
		<th width="20%" class="tdcolored">現在の内容</th>
		<td class="other-td"><?php echo ($fetchOrderCust[0]["CONFIG_MEMO"])?nl2br($fetchOrderCust[0]["CONFIG_MEMO"]):"&nbsp;";?></td>
	</tr>
	<tr>
		<th width="20%" class="tdcolored">メモ入力欄</th>
		<td class="other-td">
		<p class="explanation" style="width:300px;">
		▼現在のメモがある場合は、初期表示されています。<br>
		▼メモを<strong>追加する場合は続けて入力</strong>してください。<br>
		▼<strong>上書きをすると元のメモ内容は更新</strong>されます。
		</p>
		<textarea name="config_memo" rows="5" cols="50"><?php echo $fetchOrderCust[0]["CONFIG_MEMO"];?></textarea>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center" class="other-td">
		<input type="submit" value="内容更新" style="width:150px;">
		<input type="hidden" name="target_order_id" value="<?php echo $fetchOrderCust[0]["ORDER_ID"];?>">
		<input type="hidden" name="status" value="disp_details">
		<input type="hidden" name="regist_type" value="add_config_memo">
		</td>
	</tr>
</table>
</form>
<table width="500" border="0" cellpadding="5" cellspacing="2ｓ" style="margin-top:1em;">
	<tr class="back2">
		<th colspan="6" nowrap class="tdcolored">■購入商品</th>
	</tr>
	<tr class="tdcolored">
		<th width="20%" nowrap>商品番号</th>
		<th width="40%" nowrap>商品名</th>
		<th width="15%" nowrap>単価</th>
		<th width="5%" nowrap>数量</th>
	</tr>
	<?php for($i=0;$i<count($fetchPerItem);$i++):?>
	<tr valign="middle">
		<td class="<?php echo (($i % 2)==0)?"other-td":"otherColTd";?>" align="center"><?php echo $fetchPerItem[$i]["PART_NO"];?></td>
		<td class="<?php echo (($i % 2)==0)?"other-td":"otherColTd";?>" align="center"><?php echo $fetchPerItem[$i]["PRODUCT_NAME"];?></td>
		<td class="<?php echo (($i % 2)==0)?"other-td":"otherColTd";?>" align="center"><?php echo number_format($fetchPerItem[$i]["SELLING_PRICE"]);?></td>
		<td class="<?php echo (($i % 2)==0)?"other-td":"otherColTd";?>" align="center"><?php echo $fetchPerItem[$i]["QUANTITY"];?></td>
	</tr>
	<?php endfor;?>
</table>
<input type="button" value="この画面を印刷" style="width:150px;" onClick="javascript:PrintPage();">

<form action="./" method="post">
<input type="submit" value="検索結果画面へ戻る" style="width:150px;">
<input type="hidden" name="status" value="search_result">
</form>

<form action="./" method="post">
<input type="submit" value="注文情報条件入力へ" style="width:150px;">
</form>
</body>
</html>
