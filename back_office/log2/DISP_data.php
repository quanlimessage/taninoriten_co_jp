<?php
/*******************************************************************************
������������

	������������ɽ���ǡ��������ѣģ¥�������
	ɽ�����ˤ�äƥǡ����١���ɽ�����ѹ�

*******************************************************************************/
#---------------------------------------------------------------
# �����������������å���ľ�ܤ��Υե�����˥���������������
#	���������Ԥ�����ID��PW����פ��뤫�ޤǹԤ�
#---------------------------------------------------------------
/*
if( !$_SERVER['PHP_AUTH_USER'] || !$_SERVER['PHP_AUTH_PW'] ){
	header("HTTP/1.0 404 Not Found"); exit();
}
*/
if(!$injustice_access_chk){
	header("HTTP/1.0 404 Not Found");exit();
}

#-------------------------------------------------------------
# HTTP�إå��������
#	ʸ�������ɤȸ��졧EUC�����ܸ�
#	¾���ʣӤȣãӣӤ����꡿����å�����ݡ���ܥåȵ���
#-------------------------------------------------------------
utilLib::httpHeadersPrint("EUC-JP",true,false,false,true);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<title>ALL INTERNET ������������</title>
<link href="access_style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function closs(){
	var popW = document.getElementById('keyword');
	popW.style.visibility="hidden";
}

function popWin(){
	// alert(window.event.screenX + ":" + window.event.screenY);
	var popW = document.getElementById('keyword');
	popW.style.visibility = 'visible';
}

//-->
</script>
</head>
<body onLoad="MM_preloadImages('images/menu_01_on.gif','images/menu_02_on.gif','images/menu_03_on.gif','images/menu_04_on.gif','images/menu_05_on.gif','images/menu_06_on.gif','images/menu_07_on.gif','images/menu_on_01.gif','images/menu_on_02.gif','images/menu_on_03.gif','images/menu_on_04.gif','images/menu_on_05.gif')">
<table width="770" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="2"><img src="images/header.gif" width="770" height="97" hspace="0" vspace="0"></td>
	</tr>
	<tr>
		<td width="178" valign="top" height="100%" background="images/bk.gif">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<!--��˥塼�ơ��֥�-->
			<tr>
				<td width="178" height="25"><img src="images/menu.gif" width="178" height="25" border="0"></td>
			</tr>
			<form method="post" action="./">
			<tr>
				<?php if($_POST["mode"]=="day" || empty($_POST["mode"])):?>
				<td width="178" height="30"><img src="images/menu_01_on.gif" name="Image1" width="178" height="30" id="Image1"></td>
				<?php else:?>
				<td width="178" height="30"><input type="image" src="images/menu_01_off.gif" name="Image1" width="178" height="30" id="Image1" onMouseOver="MM_swapImage('Image1','','images/menu_01_on.gif',1)" onMouseOut="MM_swapImgRestore()"></td>
				<?php endif;?>
			</tr>
			<input type="hidden" name="mode" value="day">
			<input type="hidden" name="term" value="<?php echo $_POST["term"];?>">
			</form>
			<form method="post" action="./">
			<tr>
				<?php if($_POST["mode"]=="month"):?>
				<td width="178" height="24"><img src="images/menu_02_on.gif" name="Image2" width="178" height="24" id="Image2"></td>
				<?php else:?>
				<td width="178" height="24"><input type="image" src="images/menu_02_off.gif" name="Image2" width="178" height="24" id="Image2" onMouseOver="MM_swapImage('Image2','','images/menu_02_on.gif',1)" onMouseOut="MM_swapImgRestore()"></td>
				<?php endif;?>
			</tr>
			<input type="hidden" name="mode" value="month">
			<input type="hidden" name="term" value="<?php echo $_POST["term"];?>">
			</form>
			<form method="post" action="./">
			<tr>
				<?php if($_POST["mode"]=="hour"):?>
				<td width="178" height="22"><img src="images/menu_03_on.gif" name="Image3" width="178" height="22" id="Image3"></td>
				<?php else:?>
				<td width="178" height="22"><input type="image" src="images/menu_03_off.gif" name="Image3" width="178" height="22" onMouseOver="MM_swapImage('Image3','','images/menu_03_on.gif',1)" onMouseOut="MM_swapImgRestore()" id="Image3"></td>
				<?php endif;?>
			</tr>
			<input type="hidden" name="mode" value="hour">
			<input type="hidden" name="term" value="<?php echo $_POST["term"];?>">
			</form>
			<form method="post" action="./">
			<tr>
				<?php if($_POST["mode"]=="youbi"):?>
				<td width="178" height="23"><img src="images/menu_04_on.gif" name="Image4" width="178" height="23" id="Image4"></td>
				<?php else:?>
				<td width="178" height="23"><input type="image" src="images/menu_04_off.gif" name="Image4" width="178" height="23" id="Image4" onMouseOver="MM_swapImage('Image4','','images/menu_04_on.gif',1)" onMouseOut="MM_swapImgRestore()"></td>
				<?php endif;?>
			</tr>
			<input type="hidden" name="mode" value="youbi">
			<input type="hidden" name="term" value="<?php echo $_POST["term"];?>">
			</form>
			<form method="post" action="./">
			<tr>
				<?php if($_POST["mode"]=="page"):?>
				<td width="178" height="22"><img src="images/menu_05_on.gif" name="Image5" width="178" height="22" border="0" id="Image5"></td>
				<?php else:?>
				<td width="178" height="22"><input type="image" src="images/menu_05_off.gif" name="Image5" width="178" height="22" border="0" id="Image5" onMouseOver="MM_swapImage('Image5','','images/menu_05_on.gif',1)" onMouseOut="MM_swapImgRestore()"></td>
				<?php endif;?>
			</tr>
			<input type="hidden" name="mode" value="page">
			<input type="hidden" name="term" value="<?php echo $_POST["term"];?>">
			</form>
<?php
	// �����������ϤΥС������Ǹ������󥸥󡢥�����ɼ������ץ��������ꤷ�����Τ�
	if((VARSION_CONFIG == 2) || ($_GET['zeek'] == "kenny")){
?>
			<form method="post" action="./">
			<tr>
				<?php if($_POST["mode"]=="engine"):?>
				<td width="178" height="22"><img src="images/menu_on_01.gif" name="Image6" width="178" height="22" border="0" id="Image6"></td>
				<?php else:?>
				<td width="178" height="22"><input type="image" src="images/menu_off_01.gif" name="Image6" width="178" height="22" border="0" id="Image6" onMouseOver="MM_swapImage('Image6','','images/menu_on_01.gif',1)" onMouseOut="MM_swapImgRestore()"></td>
				<?php endif;?>
			</tr>
			<input type="hidden" name="mode" value="engine">
			<input type="hidden" name="term" value="<?php echo $_POST["term"];?>">
			</form>
			<form method="post" action="./">
			<tr>
				<?php if($_POST["mode"]=="query"):?>
				<td width="178" height="23"><img src="images/menu_on_02.gif" name="Image7" width="178" height="23" border="0" id="Image7"></td>
				<?php else:?>
				<td width="178" height="23"><input type="image" src="images/menu_off_02.gif" name="Image7" width="178" height="23" border="0" id="Image7" onMouseOver="MM_swapImage('Image7','','images/menu_on_02.gif',1)" onMouseOut="MM_swapImgRestore()"></td>
				<?php endif;?>
			</tr>
			<input type="hidden" name="mode" value="query">
			<input type="hidden" name="term" value="<?php echo $_POST["term"];?>">
			</form>
<?php } ?>
			<form method="post" action="./">
			<tr>
				<?php if($_POST["mode"]=="bro"):?>
				<td width="178" height="22"><img src="images/menu_on_03.gif" name="Image8" width="178" height="22" border="0" id="Image8"></td>
				<?php else:?>
				<td width="178" height="22"><input type="image" src="images/menu_off_03.gif" name="Image8" width="178" height="22" border="0" id="Image8" onMouseOver="MM_swapImage('Image8','','images/menu_on_03.gif',1)" onMouseOut="MM_swapImgRestore()"></td>
				<?php endif;?>
			</tr>
			<input type="hidden" name="mode" value="bro">
			<input type="hidden" name="term" value="<?php echo $_POST["term"];?>">
			</form>
			<form method="post" action="./">
			<tr>
				<?php if($_POST["mode"]=="os"):?>
				<td width="178" height="23"><img src="images/menu_on_04.gif" name="Image9" width="178" height="23" border="0" id="Image9"></td>
				<?php else:?>
				<td width="178" height="23"><input type="image" src="images/menu_off_04.gif" name="Image9" width="178" height="23" border="0" id="Image9" onMouseOver="MM_swapImage('Image9','','images/menu_on_04.gif',1)" onMouseOut="MM_swapImgRestore()"></td>
				<?php endif;?>
			</tr>
			<input type="hidden" name="mode" value="os">
			<input type="hidden" name="term" value="<?php echo $_POST["term"];?>">
			</form>

			<form method="post" action="./">
			<tr>
				<?php if($_POST["mode"]=="state"):?>
				<td width="178" height="24"><img src="images/menu_11_on.gif" name="Image15" width="178" height="24" border="0" id="Image15"></td>
				<?php else:?>
				<td width="178" height="24"><input type="image" src="images/menu_11_off.gif" name="Image15" width="178" height="24" border="0" id="Image15" onMouseOver="MM_swapImage('Image15','','images/menu_11_on.gif',1)" onMouseOut="MM_swapImgRestore()"></td>
				<?php endif;?>
			</tr>
			<input type="hidden" name="mode" value="state">
			<input type="hidden" name="term" value="<?php echo $_POST["term"];?>">
			</form>

			<form method="post" action="./">
			<tr>
				<?php if($_POST["mode"]=="ref"):?>
				<td width="178" height="34"><img src="images/menu_on_05.gif" name="Image11" width="178" height="34" border="0" id="Image11"></td>
				<?php else:?>
				<td width="178" height="34"><input type="image" src="images/menu_off_05.gif" name="Image11" width="178" height="34" border="0" id="Image11" onMouseOver="MM_swapImage('Image11','','images/menu_on_05.gif',1)" onMouseOut="MM_swapImgRestore()"></td>
				<?php endif;?>
			</tr>
			<input type="hidden" name="mode" value="ref">
			<input type="hidden" name="term" value="<?php echo $_POST["term"];?>">
			</form>
			<form method="post" action="./">
			<tr>
				<?php if($_POST["mode"]=="all"):?>
				<td width="178" height="36"><img src="images/menu_07_on.gif" name="Image10" width="178" height="36" id="Image10"></td>
				<?php else:?>
				<td width="178" height="36"><input type="image" src="images/menu_07_off.gif" name="Image10" width="178" height="36" id="Image10" onMouseOver="MM_swapImage('Image10','','images/menu_07_on.gif',1)" onMouseOut="MM_swapImgRestore()"></td>
				<?php endif;?>
			</tr>
			<input type="hidden" name="mode" value="all">
			<input type="hidden" name="term" value="<?php echo $_POST["term"];?>">
			</form>
			<tr>
				<td width="178" height="28"><img src="images/m_access.gif" width="178" height="28"></td>
			</tr>
			<tr>

		  <td height="30" align="center" background="images/m_d_access_back.gif">
			PV �ʥڡ����ӥ塼��: <b><font color="#003399" size="3"><?php echo count($fetch);?></font></b><br>
			��ˬ�Կ� : <b><font color="#003399" size="3"><?php echo count($fetch_uu);?></font></b>
			</td>
			</tr>
			<tr>
				<td width="178" height="19"><img src="images/day_access.gif" width="178" height="19"></td>
			</tr>
			<tr>

		  <td height="30" align="center" background="images/m_d_access_back.gif">
			<b><font color="#003399" size="3"><?php echo count($TodayCnt);?></font></b>&nbsp;&nbsp;
			</td>
			</tr>
			<form method="post" action="./">
			<tr>
				<td width="178" height="158" background="images/menu_under_01.gif" align="right" valign="top" style="padding-right:5px;">
				�����ϥ⡼�ɻ���<br>
				(���6����֤Υǡ�����<br>�ݴɤ���Ƥ��ޤ���)<br>
				<select name="term">
<?php
$dir2 = opendir(ACCESS_PATH);
while($strfile2[] = readdir($dir2));
rsort($strfile2);
reset($strfile2);
closedir($dir2);

foreach($strfile2 as $v){
	if(strstr($v,"access_log_db")){
		$db_fname = explode("_",$v);
		$filedate = $db_fname[0]."_".$db_fname[1];
		$selected = ($_POST["term"] == $filedate)?" selected":"";
		echo "<option value=\"".$filedate."\"".$selected.">".$db_fname[0]."ǯ".$db_fname[1]."��</option>\n";
	}
}
?>
				</select>
				<br><br>
				<input type="submit" name="reg" value="���ϳ���">
				</td>
			</tr>
			</form>
		<!--��˥塼�����ޤ�-->
		</table>
		</td>
		<td width="622" align="center" class="right_bar" valign="top">
		<!--����ƥ�ĥ���-->
		<?php if(!empty($error_mes)):?>
		<br>
		<p class="err"><?php echo $error_mes;?></p>
		<?php endif;?>
		<br>
		<table width="250" cellpadding="0" cellspacing="1" border="0" bgcolor="#000000">
			<tr bgcolor="#FFFFFF">
				<td align="left" style="padding:5px;"><img src="images/bar.gif" width="50" height="10" align="absmiddle">����PV�ʥڡ����ӥ塼��<br><!--<img src="images/bar_u.gif" width="50" height="10" align="absmiddle">������ˡ���PV<br>--><img src="images/bar_uu.gif" width="50" height="10" align="absmiddle">������ˬ�Կ�</td>
			</tr>
		</table>
		<?php if(!empty($fetch_day)):?>
		<!--����-->
		<?php
			$fetch_max = 0;
			for($i=0;$i<count($fetch_day);$i++){
				if($fetch_max <= $fetch_day[$i]['CNT'])$fetch_max = $fetch_day[$i]['CNT'];
			}
			?>
		<br>
		<table width="553" cellpadding="0" cellspacing="1" border="0" bgcolor="#000000">
			<tr bgcolor="#E1E1E1">

	 <td align="left" colspan="2"><img src="images/ai_acc_2nd_01.gif" width="205" height="26"></td>
			</tr>
			<?php for($i=0;$i<count($fetch_day);$i++):?>
			<tr bgcolor="#FFFFFF">
				<td width="10%" align="center" height="25">
				<?php echo $fetch_day[$i]["M"];?>��<?php echo $fetch_day[$i]["D"];?>��
				</td>

	 <td align="left" style="padding-top:2px;">
	  <?php
					$width = @round($fetch_day[$i]['CNT']/$fetch_max * 100);
					$width_uu = @round($fetch_day_uu[$i]['CNT']/$fetch_max * 100);
	��?>
	  <img src="images/bar.gif" width="<?php echo $width*3;?>" height="10" align="left">&nbsp;
	  <?php echo "(".$fetch_day[$i]['CNT']."��)";?><br>
	  <img src="images/bar_uu.gif" width="<?php echo $width_uu*3;?>" height="10" align="absmiddle">&nbsp;
	  <?php echo "(".$fetch_day_uu[$i]['CNT']."��)";?><br>
	   </td>
			</tr>
			<?php endfor;?>
		</table>
		<!--����-->
		<?php endif;?>
		<?php if(!empty($MonCnt)):?>
		<!--����-->
		<br>
		<table width="553" cellpadding="0" cellspacing="1" border="0" bgcolor="#000000">
			<tr bgcolor="#E1E1E1">
				<td colspan="2" align="left"><img src="images/ai_acc_2nd_02.gif" width="205" height="26"></td>
			</tr>
			<?php //for($i=3;$i>=0;$i--):
			//$mon = date("n",mktime(0,0,0,date("n")-$i,1,date("y")));
			$year_mon = ($term)?$term:$date_name;
			$ym_date = explode("_",$year_mon);
			$mon = (int)$ym_date[1];
			//for($i=(date("n") - 3);$i<=date("n");$i++):?>
			<tr bgcolor="#FFFFFF">
				<td width="10%" align="center" height="25">
				<?php echo $mon;?>��
				</td>
				<td align="left" style="padding-top:2px;">
				<?php
				$num = count($fetch);
				$width = @round($MonCnt[$mon]/$num * 100); // ������ȿ�����������ȿ��ǥѡ�����ơ�������(����դ�����)
				$width_uu = @round($MonCnt_uu[$mon]/$num * 100); // ������ȿ�����������ȿ��ǥѡ�����ơ�������(����դ�����)
				if($width > 0):// ������Ȥ������Τߥ����ɽ��
				?>
				<img src="images/bar.gif" width="<?php echo $width*3;?>" height="10" align="left">&nbsp;
				<?php echo ($MonCnt[$mon])?"(".$MonCnt[$mon]."��)":"";?><br>
				<img src="images/bar_uu.gif" width="<?php echo $width_uu*3;?>" height="10" align="absmiddle">&nbsp;
				<?php echo ($MonCnt_uu[$mon])?"(".$MonCnt_uu[$mon]."��)":"";?>
				<?php endif;?>
				</td>
			</tr>
			<?php //endfor;?>
		</table>
		<!--����-->
		<?php endif;?>
		<?php if(!empty($fetch_time)):?>
		<!--������-->
		<?php
			$fetch_max = 0;
			for($i=0;$i<23;$i++){
				$i = sprintf("%02d",$i);
				if($fetch_max <= $fetch_time[$i])$fetch_max = $fetch_time[$i];
			}
			?>
		<br>
		<table width="553" cellpadding="0" cellspacing="1" border="0" bgcolor="#000000">
			<tr bgcolor="#E1E1E1">
				<td align="left" colspan="2"><img src="images/ai_acc_2nd_03.gif"></td>
			</tr>
			<?php for($i=0;$i<=23;$i++):?>
			<tr bgcolor="#FFFFFF">
				<td width="10%" align="center" height="25">
				<?php echo $i;?>��
				</td>
				<td align="left" style="padding-top:2px;">
				<?php
				$num = count($fetch);
				$i = sprintf("%02d",$i);

				$width = @round($fetch_time[$i]/$fetch_max * 100); // ������ȿ�����������ȿ��ǥѡ�����ơ�������
				if($width > 0):// ��������������Ȥ����ä��饰���ɽ��
				?>
				<img src="images/bar.gif" width="<?php echo $width*3;?>" height="10" align="left">&nbsp;
				<?php endif;?>
				<?php echo ($fetch_time[$i])?"(".$fetch_time[$i]."��)":"";?><br>
				<?php
				$width_uu = @round($fetch_time_uu[$i]/$fetch_max * 100 ); // ������ȿ�����������ȿ��ǥѡ�����ơ�������
				if($width_uu > 0):// ��������������Ȥ����ä��饰���ɽ��
				?>
				<img src="images/bar_uu.gif" width="<?php echo $width_uu*3;?>" height="10" align="absmiddle">&nbsp;
				<?php endif;?>
				<?php echo ($fetch_time_uu[$i])?"(".$fetch_time_uu[$i]."��)":"";?><br>
				</td>
			</tr>
			<?php endfor;?>
		</table>
		<!--������-->
		<?php endif;?>
		<?php if(!empty($fetch_dayofweek)):?>
		<!--������-->
		<?php
			$fetch_max = 0;
			for($i=0;$i<=6;$i++){
				if($fetch_max <= $fetch_dayofweek[$i])$fetch_max = $fetch_dayofweek[$i];
			}
			?>
		<br>
		<table width="553" cellpadding="0" cellspacing="1" border="0" bgcolor="#000000">
			<tr bgcolor="#E1E1E1">
				<td align="left" colspan="2"><img src="images/ai_acc_2nd_04.gif" width="205" height="26"></td>
			</tr>
			<?php for($i=0;$i<=6;$i++):?>
			<tr bgcolor="#FFFFFF">
				<td width="10%" align="center" height="25">
				<?php // �������ͤ�Ƚ�̤������������
				switch ($i):
					case 0:
						echo "������";
						break;
					case 1:
						echo "������";
						break;
					case 2:
						echo "������";
						break;
					case 3:
						echo "������";
						break;
					case 4:
						echo "������";
						break;
					case 5:
						echo "������";
						break;
					case 6:
						echo "������";
						break;
				endswitch;
				?>
				</td>
				<td align="left" style="padding-top:2px;">
				<?php
				$width = @round($fetch_dayofweek[$i]/$fetch_max * 100); // ������ȿ�����������ȿ��ǥѡ�����ơ�������(�����ɽ����)
				if($width > 0):// ������Ȥ����������Τߥ����ɽ��
				?>
				<!--<img src="images/bar_u.gif" width="<?php echo $width_u*3;?>" height="10" align="left">-->
				<img src="images/bar.gif" width="<?php echo $width*3;?>" height="10" align="left">&nbsp;
				<?php endif;?>
				<?php echo ($fetch_dayofweek[$i])?"(".$fetch_dayofweek[$i]."��)":"";?><br>
				<?php
				$width_uu = @round($fetch_dayofweek_uu[$i]/$fetch_max * 100 ); // ������ȿ�����������ȿ��ǥѡ�����ơ�������(�����ɽ����)
				if($width_uu > 0):// ������Ȥ����������Τߥ����ɽ��
				?>
				<img src="images/bar_uu.gif" width="<?php echo $width_uu*3;?>" height="10" align="absmiddle">
				<?php endif;?>
				<?php echo ($fetch_dayofweek_uu[$i])?"(".$fetch_dayofweek_uu[$i]."��)":"";?><br>
				</td>
			</tr>
			<?php endfor;?>
		</table>
		<!--������-->
		<?php endif;?>
		<?php if(!empty($fetchURL)):?>
		<!--�ڡ�����-->
		<?php
			$fetch_max = 0;
			for($i=0;$i<=count(fetchURL);$i++){
				if($fetch_max <= $fetchURL[$i]['CNT'])$fetch_max = $fetchURL[$i]['CNT'];
			}
			$fetch_sum = 0;
			for($i=0;$i<=count($fetchURL);$i++){
				$fetch_sum += $fetchURL[$i]['CNT'];
			}
			?>
		<br>
		<table width="553" cellpadding="0" cellspacing="1" border="0" bgcolor="#000000">
			<tr bgcolor="#E1E1E1">
				<td align="left"><img src="images/ai_acc_page.gif" width="205" height="26"></td>
			</tr>
			<?php for($i=0;$i<count($fetchURL);$i++):?>
			<tr bgcolor="#FFFFFF">
				<td align="left" height="20">
				&nbsp;<b><?php echo $i+1;?></b>&nbsp;
				<a href="<?php echo $fetchURL[$i]['PAGE_URL'];?>" target="_blank">
				<?php echo $fetchURL[$i]['PAGE_URL'];?>
				</a>
				</td>
			</tr>
			<tr bgcolor="#FAFAFA">
				<td height="25" align="left" bgcolor="#FAFAFA">
				<?php
					$width = @round($fetchURL[$i]['CNT']/$fetch_max * 100);
				?>
				<img src="images/bar.gif" width="<?php echo $width*3;?>" height="10" align="left">&nbsp;
				<?php echo round($fetchURL[$i]['CNT']/$fetch_sum * 100);?>%
				<?php echo "(".$fetchURL[$i]['CNT']."��)";?>

				</td>
			</tr>
			<?php endfor;?>
		</table>
		<!--�ڡ�����-->
		<?php endif;?>
<?php
	// �����������ϤΥС������Ǹ������󥸥󡢥�����ɼ������ץ��������ꤷ�����Τ�
	if((VARSION_CONFIG == 2) || ($_GET['zeek'] == "kenny")){
?>
		<?php if(!empty($fetchENGINE)):?>
		<!--�������󥸥���-->
		<?php
			$fetch_max = $fetchENGINE[0]['CNT'];
			$fetch_sum = 0;
			for($i=0;$i<=count($fetchENGINE);$i++){
				$fetch_sum += $fetchENGINE[$i]['CNT'];
			}
			?>
		<br>
		<table width="553" cellpadding="0" cellspacing="1" border="0" bgcolor="#000000">
			<tr bgcolor="#E1E1E1">
				<td align="left" height="26"><img src="images/ai_acc_2nd_07.gif" width="205" height="26"></td>
			</tr>
			<?php for($i=0;$i<count($fetchENGINE);$i++):?>
			<tr bgcolor="#FFFFFF">
				<td align="left" height="20">
				&nbsp;<b><?php echo $i+1;?></b>&nbsp;
				<!-- <a href="<?php //echo $fetchENGINE[$i]['ENGINE'];?>" target="_blank"> -->
				<?php echo $fetchENGINE[$i]['ENGINE'];?>
				<!-- </a> >-->
				</td>
			</tr>
			<tr bgcolor="#FAFAFA">
				<td height="25" align="left" bgcolor="#FAFAFA">
				<?php
				//$num = count($fetch);
					$width = @round($fetchENGINE[$i]['CNT']/$fetch_max * 100);
				?>
				<img src="images/bar.gif" width="<?php echo $width*3;?>" height="10" align="absmiddle">&nbsp;
				<?php echo round($fetchENGINE[$i]['CNT']/$fetch_sum * 100);?>%<?php echo "(".$fetchENGINE[$i]['CNT']."��)";?>
				</td>
			</tr>
			<?php endfor;?>
		</table>
		<!--�������󥸥���-->
		<?php endif;?>

		<?php if(!empty($fetchQuery)):?>
		<!--�������鸡��ʸ����-->
		<?php
			$fetch_max = $fetchQuery[0]['CNT'];
			$fetch_sum = 0;
			for($i=0;$i<=count($fetchQuery);$i++){
				$fetch_sum += $fetchQuery[$i]['CNT'];
			}
			?>
		<br>
		<form method="post" action="./">
		<input type="hidden" name="mode" value="<?php echo $_POST["mode"];?>"><input type="hidden" name="term" value="<?php echo $_POST["term"];?>">
		<table width="553" cellpadding="0" cellspacing="1" border="0" bgcolor="#000000">
			<tr bgcolor="#FFFFFF">
				<td align="left" height="20">
				&nbsp;ɽ�������<input type="radio" name="kensu" value="1" onClick="javascript:submit();"<?php echo ($kensu == 1)?" checked":"";?>>&nbsp;100��ޤ�ɽ��&nbsp;<input type="radio" name="kensu" value="2" onClick="javascript:submit();"<?php echo ($kensu == 2)?" checked":"";?>>&nbsp;300��ޤ�ɽ��&nbsp;<input type="radio" name="kensu" value="3"  onClick="javascript:submit();"<?php echo ($kensu == 3)?" checked":"";?>>&nbsp;����ɽ��
				</td>
			</tr>
		</table>
		</form>
		<table width="553" cellpadding="0" cellspacing="1" border="0" bgcolor="#000000">
			<tr bgcolor="#E1E1E1">
				<td align="left" height="26"><img src="images/ai_acc_2nd_08.gif" width="205" height="26"></td>
			</tr>
			<?php for($i=0;$i<count($fetchQuery);$i++):?>
			<tr bgcolor="#FFFFFF">
				<td align="left" height="20">
				&nbsp;<b><?php echo $i+1;?></b>&nbsp;
				<?php echo "<b>".$fetchQuery[$i]['ENGINE']."</b>".$fetchQuery[$i]['QUERY_STRING'];?>
				</td>
			</tr>
			<tr bgcolor="#FAFAFA">
				<td height="25" align="left" bgcolor="#FAFAFA">
				<?php
				//$num = count($fetch);
					$width = @round($fetchQuery[$i]['CNT']/$fetch_max * 100);
				?>
				<img src="images/bar.gif" width="<?php echo $width*3;?>" height="10" align="absmiddle">&nbsp;
				<?php echo round($fetchQuery[$i]['CNT']/$fetch_sum * 100);?>%<?php echo "(".$fetchQuery[$i]['CNT']."��)";?>
				</td>
			</tr>
			<?php endfor;?>
<!--			<tr>
				<td bgcolor="#FFFFFF">
				<div align="left"><input type="button" name="button" value="������ɣ���ʲ�" onClick="popWin()" class="button"></div>
				</td>
			</tr>-->
		</table>
		<!--����ʸ����-->
		<?php endif;?>
<?php
	// �С�����󣲽����
	}
?>
		<!--��������֥饦����-->
		<?php if(!empty($fetch_bro)):?>
		<?php $fetch_max = $fetch_bro[0]['CNT'];?>
		<br>
		<table width="553" cellpadding="0" cellspacing="1" border="0" bgcolor="#000000">
			<tr bgcolor="#E1E1E1">
				<td align="left" height="26"><img src="images/ai_acc_2nd_09.gif" width="205" height="26"></td>
			</tr>
			<?php for($i=0;$i<count($fetch_bro);$i++):?>
			<tr bgcolor="#FFFFFF">
				<td align="left" height="20">
				&nbsp;<b><?php echo $i+1;?></b>&nbsp;
				<?php echo $fetch_bro[$i]['BROWSER'];?>
				</td>
			</tr>
			<tr bgcolor="#FAFAFA">
				<td height="25" align="left" bgcolor="#FAFAFA">
				<?php
				//$num = count($fetch);
					$width = @round($fetch_bro[$i]['CNT']/$fetch_max * 100);
				?>
				<img src="images/bar.gif" width="<?php echo $width*3;?>" height="10" align="absmiddle">&nbsp;
				<?php echo round($fetch_bro[$i]['CNT']/count($fetch) * 100);?>%<?php echo "(".$fetch_bro[$i]['CNT']."��)";?>
				</td>
			</tr>
			<?php endfor;?>
		</table>
		<!--�֥饦����-->
		<?php endif;?>
		<!--��������OS��-->
		<?php if(!empty($fetch_os)):?>
		<?php $fetch_max = $fetch_os[0]['CNT'];?>
		<br>
		<table width="553" cellpadding="0" cellspacing="1" border="0" bgcolor="#000000">
			<tr bgcolor="#E1E1E1">
				<td align="left" height="26"><img src="images/ai_acc_2nd_10.gif" width="205" height="26"></td>
			</tr>
			<?php for($i=0;$i<count($fetch_os);$i++):?>
			<tr bgcolor="#FFFFFF">
				<td align="left" height="20">
				&nbsp;<b><?php echo $i+1;?></b>&nbsp;
				<?php echo $fetch_os[$i]['OS'];?>
				</td>
			</tr>
			<tr bgcolor="#FAFAFA">
				<td height="25" align="left" bgcolor="#FAFAFA">
				<?php
				//$num = count($fetch);
					$width = @round($fetch_os[$i]['CNT']/$fetch_max * 100);
				?>
				<img src="images/bar.gif" width="<?php echo $width*3;?>" height="10" align="absmiddle">&nbsp;
				<?php echo round($fetch_os[$i]['CNT']/count($fetch) * 100);?>%<?php echo "(".$fetch_os[$i]['CNT']."��)";?>
				</td>
			</tr>
			<?php endfor;?>
		</table>
		<!--OS��-->
		<?php endif;?>
		<!-- ���� -->
		<?php if(!empty($fetch_state_u)):?>
		<?php
			$fetch_max = $fetch_state_u[0]['CNT'];
			$fetch_sum = 0;
			for($i=0;$i<count($fetch_state_u);$i++){
				$fetch_sum += $fetch_state_u[$i]['CNT'];
			}
			?>
		<br>
		<table width="553" cellpadding="0" cellspacing="1" border="0" bgcolor="#000000">
			<tr bgcolor="#E1E1E1">
				<td align="left" height="26"><img src="images/ai_acc_2nd_15.gif" width="205" height="26"></td>
			</tr>
			<?php for($i=0;$i<count($fetch_state_u);$i++):?>
			<tr bgcolor="#FFFFFF">
				<td align="left" width="553" height="20">
				&nbsp;<b><?php echo $i+1;?></b>&nbsp;
				<?php echo $fetch_state_u[$i]['STATE'];?>
				</td>
			</tr>
			<tr bgcolor="#FAFAFA">
				<td height="25" align="left" bgcolor="#FAFAFA">
				<?php
				//$num = count($fetch);
					$width = @round($fetch_state_u[$i]['CNT']/$fetch_max * 100);
				?>
				<img src="images/bar.gif" width="<?php echo $width*3;?>" height="10" align="absmiddle">&nbsp;
				<?php echo round($fetch_state_u[$i]['CNT']/$fetch_sum * 100);?>%<?php echo "(".$fetch_state_u[$i]['CNT']."��)";?>
				</td>
			</tr>
			<?php endfor;?>
		</table>
		<!--����-->
		<?php endif;?>
		<!-- ��ե��顼�� -->
		<?php if(!empty($fetch_ref)):?>
		<?php
			$fetch_max = $fetch_ref[0]['CNT'];
			$fetch_sum = 0;
			for($i=0;$i<count($fetch_ref);$i++){
				$fetch_sum += $fetch_ref[$i]['CNT'];
			}
			?>
		<br>
		<table width="553" cellpadding="0" cellspacing="1" border="0" bgcolor="#000000">
			<tr bgcolor="#E1E1E1">
				<td align="left" height="26"><img src="images/ai_acc_2nd_11.gif" width="205" height="26"></td>
			</tr>
			<?php for($i=0;$i<count($fetch_ref);$i++):?>
			<tr bgcolor="#FFFFFF">
				<td align="left" width="553" height="20">
				&nbsp;<b><?php echo $i+1;?></b>&nbsp;
				<a href="<?php echo $fetch_ref[$i]['REFERER'];?>" target="_blank"><?php echo $fetch_ref[$i]['REFERER'];?></a>
				</td>
			</tr>
			<tr bgcolor="#FAFAFA">
				<td height="25" align="left" bgcolor="#FAFAFA">
				<?php
				//$num = count($fetch);
					$width = @round($fetch_ref[$i]['CNT']/$fetch_max * 100);
				?>
				<img src="images/bar.gif" width="<?php echo $width*3;?>" height="10" align="absmiddle">&nbsp;
				<?php echo round($fetch_ref[$i]['CNT']/$fetch_sum * 100);?>%<?php echo "(".$fetch_ref[$i]['CNT']."��)";?>
				</td>
			</tr>
			<?php endfor;?>
		</table>
		<!--��ե��顼��-->
		<?php endif;?>
		<br>
		</td>
	</tr>
	<tr>
		<td colspan="2"><img src="images/foder.gif" width="770"></td>
	</tr>
</table>
</body>
</html>
