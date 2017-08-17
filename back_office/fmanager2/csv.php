<?php
/*******************************************************************************
�����������ϥե�����ޥ͡����㡼

�ꥹ�Ƚ���

*******************************************************************************/

session_start();
// ����ե���������̥饤�֥����ɤ߹���
require_once("../../sp/common/INI_logconfig.php");		// ����ե�����
require_once("util_lib.php");					// ���ѽ������饹�饤�֥��
require_once("dbOpe.php");					// SQLite���饹�饤�֥��
/*
#---------------------------------------------------------------
# �����������������å���ľ�ܤ��Υե�����˥���������������
#	���������Ԥ�����ID��PW����פ��뤫�ޤǹԤ�
#---------------------------------------------------------------
if( !$_SERVER['PHP_AUTH_USER'] || !$_SERVER['PHP_AUTH_PW'] ){
	header("HTTP/1.0 404 Not Found"); exit();
}

if( !$injustice_access_chk){
	header("HTTP/1.0 404 Not Found"); exit();
}
*/
if( !$_SESSION['LOGIN'] ){
	header("Location: ../err.php");exit();
}

// POST�ǡ����μ������ȶ��̤�ʸ�������
extract(utilLib::getRequestParams("post",array(8,7,1,4),true));

#=============================================================================================
# CSV�����Υե��������¸����
#
# ���ߤλ��֤��������list-����.csv�Ȥ����ե�����̾�ˤ��ƽ��Ϥ���
#=============================================================================================

header("Content-Type: text/plain; charset=Shift_JIS");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=list-".date("YmdHis").".csv");

$SQLITE = access_log_start($filename);

// �ƹ��ܤΥ����ȥ��Ĥ���
$data = "��⡼�ȥۥ���,��ե���,�����������,�������󥸥�,�ϰ�,OS,�֥饦��,URL,����,����\n";
$data = mb_convert_encoding($data,"SJIS","EUC-JP");

// ���Ϥ�ɬ�פʥǡ����μ���
$sql = "
	SELECT
		REMOTE_ADDR,
		USER_AGENT,
		REFERER,
		QUERY_STRING,
		ENGINE,
		OS,
		BROWSER,
		PAGE_URL,
		UNIQUE_FLG,
		STATE,
		INS_DATE,
		TIME
	FROM
		ACCESS_LOG
	ORDER BY
		INS_DATE ASC,TIME ASC
";

$fetchLogList = $SQLITE->fetch($sql);

	// �ǡ����ο������롼�פ��롣
	for($i=0;$i<count($fetchLogList);$i++):

		$data .= str_replace(",",".",$fetchLogList[$i]['REMOTE_ADDR']).",";
	//	$data .= str_replace(",",".",$fetchLogList[$i]['USER_AGENT']).",";
		$data .= str_replace(",",".",$fetchLogList[$i]['REFERER']).",";
		$data .= mb_convert_encoding(str_replace(",",".",$fetchLogList[$i]['QUERY_STRING']),"SJIS","EUC-JP").",";
		$data .= str_replace(",",".",$fetchLogList[$i]['ENGINE']).",";
		$data .= mb_convert_encoding(str_replace(",",".",$fetchLogList[$i]['STATE']),"SJIS","EUC-JP").",";
		$data .= str_replace(",",".",$fetchLogList[$i]['OS']).",";
		$data .= $fetchLogList[$i]['BROWSER'].",";
		$data .= str_replace(",",".",$fetchLogList[$i]['PAGE_URL']).",";
	//	$data .= str_replace(",",".",$fetchLogList[$i]['UNIQUE_FLG']).",";
		$data .= $fetchLogList[$i]['INS_DATE'].",";
		$data .= $fetchLogList[$i]['TIME']."\n";

	endfor;

echo $data;

?>
