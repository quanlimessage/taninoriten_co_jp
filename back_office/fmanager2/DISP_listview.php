<?php
/*******************************************************************************
�����������ϥե�����ޥ͡����㡼
View�������������ե��������ɽ���ʺǽ��ɽ�������

*******************************************************************************/

#---------------------------------------------------------------
# �����������������å���ľ�ܤ��Υե�����˥���������������
#	���������Ԥ�����ID��PW����פ��뤫�ޤǹԤ�
#---------------------------------------------------------------
if( !$_SESSION['LOGIN'] ){
	header("Location: ../err.php");exit();
}
if( !$_SERVER['PHP_AUTH_USER'] || !$_SERVER['PHP_AUTH_PW'] ){
//	header("Location: ../index.php");exit();
}
if(!$injustice_access_chk){
	header("HTTP/1.0 404 Not Found");exit();
}

#=============================================================
# HTTP�إå��������
#	ʸ�������ɤȸ��졧EUC�����ܸ�
#	¾���ʣӤȣãӣӤ����꡿ͭ�����¤����꡿����å�����ݡ���ܥåȵ���
#=============================================================
utilLib::httpHeadersPrint("EUC-JP",true,false,true,true);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<title></title>
<link href="../for_bk.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="header"></div>
<p class="page_title">�����������ϡ��ե�����ޥ͡����㡼</p>
<p class="explanation">
��<strong>�ֺ����</strong>�򥯥�å��������Ͽ����Ƥ��볺�����ե����뤬�������ޤ���<br>
��<strong>��������ե�����������Ǥ��ޤ���</strong>��ʬ����դ��ƽ�����ԤäƤ���������<br><br>
��<strong>�֥�ݡ��ȡ�</strong>�򥯥�å�����ȥ�ݡ��ȥǡ��������ǤΥХå����åפ�<br>
<strong>��CSV���ϡ�</strong>�򥯥�å������CSV�ǡ��������ǤΥХå����åפ�Ȥ뤳�Ȥ�����ޤ���<br>
�ե������������ݤ����Ӥ˹�碌�Ƥ��줾�����ˡ�ǥХå����åפ�Ȥ뤳�Ȥ򤪴��ᤷ�ޤ���
</p>
<table width="600" border="1" cellpadding="2" cellspacing="0">
	<tr class="tdcolored">
		<th width="15%" nowrap>�ǡ�������</th>
		<th nowrap>�ե�����̾</th>
		<th width="5%" nowrap>�ե����륵����</th>
		<th width="10%" nowrap>���ϥ�ݡ��Ƚ���</th>
		<th width="10%" nowrap>CSV����</th>
	    <th width="5%" nowrap>���</th>
	</tr>
<?php
$dir = opendir(ACCESS_PATH);
while($strfile[] = readdir($dir));
rsort($strfile);
reset($strfile);
closedir($dir);
?>
	<?php foreach($strfile as $v):?>
	<?php if(strstr($v,"access_log_db")):?>
	<tr class="<?php echo (($i % 2)==0)?"other-td":"otherColTd";?>">
		<td align="center">&nbsp;<?php $db_fname = explode("_",$v);
										echo $db_fname[0]."ǯ".$db_fname[1]."��";?></td>
		<td align="center">&nbsp;<?php echo $v;?></td>
		<td align="center">&nbsp;<?php echo round(filesize(ACCESS_PATH.$v)/(1024 * 1024),2)."MB";?></td>
		<td align="center">
		<form method="post" action="file.php" style="margin:0;">
		<input type="submit" value="��ݡ���">
		<input type="hidden" name="filename" value="<?php echo $v;?>">
		</form>
		</td>
		<td align="center">
		<form method="post" action="csv.php" style="margin:0;">
		<input type="submit" value="CSV����">
		<input type="hidden" name="filename" value="<?php echo $v;?>">
		</form>
		</td>
		<td align="center">
		<form method="post" action="./" style="margin:0;" onSubmit="return confirm('���Υ����������ե���������˺�����ޤ���\n�����������ե�����������Ͻ���ޤ���\n������Ǥ�����');">
		<input type="submit" value="���">
		<input type="hidden" name="filename" value="<?php echo $v;?>">
		<input type="hidden" name="action" value="del_file">
		</form>
		</td>
	</tr>
	<?php endif; ?>
	<?php endforeach;?>
</table>
<div class="footer" style="margin-top:5em;"><?php //echo FOOTER_TITLE;?></div>
</body>
</html>
