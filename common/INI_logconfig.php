<?php
/*******************************************************************************
����������������ե����� SQLite��

2006.04.19 fujiyama
*******************************************************************************/

// �ޥ���Х��ȴؿ��Ѥ˸����ʸ�������ɤ���ꤹ���ʸ�����ִ����᡼����������ɬ�ܡ�
mb_language("Japanese");
mb_internal_encoding("EUC-JP");

#=================================================================================
#API���������� �����ˤϵ�Ͽ���Ƥ������������ϻ��Ѥ��Ƥ��ʤ���
#=================================================================================
define('APIKEY','ABQIAAAAzUeQaij4iMqMQPJle9Iv4RQm2qs8Zmu-k6zztjdh0ayEoC2uLBRhCOIpme2p3-uPVbvgjpAsr5LaTA');

#===================================================================================
# �С�����������(����2�����ꤹ��)
# ������ 1 : �������󥸥󡢸���������ɤ�ɽ���ʤ����ץ����ΰ٥ǥե���Ȥˤ��Ƥ���
# ������ 2 : �������󥸥󡢥�����ɤ�ɽ������
#===================================================================================
define('VARSION_CONFIG',2);

#=================================================================================
#���ե������PV���ξ���ͤ�����
#=================================================================================
define('LOGFILE_SIZE_MAX',100000);

#=================================================================================
#PV��������ͤ�ۤ����ݤΥ᡼��������̵ͭ��0:�������ʤ���1:���������
#=================================================================================
define('ALERT_MAIL_SEND',0);

#=================================================================================
#����ʸ���Ѥν���
#=================================================================================
	//�ţգäǤ����ѥ��ڡ������ִ��ϰ�����ʸ�����Զ�絯�����١ʡڡ��ۤ�Ǹ�ˤ���ȥ��ڡ����ȸ�ǧ������Ƥ��ޤ���
	//�գԣƣ����Ѵ����Ƥ������Ѥ�Ⱦ�ѥ��ڡ������Ѵ����������Ԥ�
	function utf_preg_replace($pattern){
			$pattern = mb_convert_encoding($pattern, "UTF-8", "EUC-JP");//����ʸ����UTF8���Ѵ�
			$space_data1 = mb_convert_encoding("��", "UTF-8", "EUC-JP");//����Ѥ����ѥ��ڡ�����UTF8���Ѵ�
			$space_data2 = mb_convert_encoding(" ", "UTF-8", "EUC-JP");//�ִ��Ѥ�Ⱦ�ѥ��ڡ�����UTF8���Ѵ�
			$subject = @mb_ereg_replace($space_data1, $space_data2, $pattern);//�ִ������򤹤�
			$subject = mb_convert_encoding($subject, "EUC-JP", "UTF-8");//UTF8����EUC���᤹
		return $subject;
	}

#=================================================================================
# DB�Υե�����ѥ���DB�ڤӥơ��֥��ư�������뤿���SQLʸ������
#	���ǥ��쥯�ȥ�̾��ɬ�פ˱����Ƶ��Ҥ�ľ��������DB̾�Ϥ��Τޤޤǣϣˡ�
#	��DB���֤��ǥ��쥯�ȥ��db�ɤΥѡ��ߥå����ϡ�777�ɤˤ��뤳�ȡ�
#=================================================================================

$date_name = date('Y_m');

$access_path = str_replace("/common","",dirname(__FILE__))."/db/";
define('ACCESS_PATH',$access_path);
define('DB_FILEPATH',ACCESS_PATH.$date_name."_access_log_db");
define('SQLITE','sqlite:'.DB_FILEPATH);
define('CREATE_SQL',"CREATE TABLE ACCESS_LOG(ID INTEGER PRIMARY KEY,REMOTE_ADDR,USER_AGENT,REFERER,QUERY_STRING,ENGINE,OS,BROWSER,PAGE_URL,STATE,UNIQUE_FLG,USER_FLG,INS_DATE,TIME,DEL_FLG DEFAULT 0);");

#==================================================================================
# �������󥸥�ڤӸ���������ɤ��������ؿ�
# list�ե�����ˤ���ƥ����ȥե�������ɤ߹���
#==================================================================================

function setting_read($uri){
	if(file_exists($uri)){
		if($arr_exclude = @file($uri)){
			$arr_exclude = @array_unique($arr_exclude);
			foreach($arr_exclude as $k => $v){
				$arr_exclude[$k] = trim($v);
			}
			return $arr_exclude;
		}
	}
}

//����������ɼ���
function get_keyword($query ,$query_key){
	global $google_cache;

	$keyword = "";
	foreach(explode("&", $query) as $tmp){
		unset($k,$v);
		list($k,$v) = explode("=", $tmp);
		$k = eregi_replace('amp;', '', $k);
		if($k == $query_key){
			if(trim($v) == "") continue;
			$v = urldecode($v);
			if(function_exists('mb_convert_encoding')){
				$v = @mb_convert_encoding($v, "EUC", "auto");
			}else{
				$v = jcode_convert_encoding($v,'euc-jp');
			}
			$v = str_replace('+', ' ', $v);
			$v = utf_preg_replace($v);

			if(function_exists('mb_ereg_replace')){
				$v = @mb_ereg_replace('��', ' ', $v);
			}else{
				$v = jstr_replace('��', ' ', $v);
			}
			$v = ereg_replace(" {2,}", " ", $v);
			$v = trim($v);

			//Google����å���Υ����å�
			if($google_cache && ereg('^cache:',$v)) continue;
			if($v == "") continue;

			$v = "��".ereg_replace(' ', '��&nbsp;��', $v)."��";

			$keyword = $v;
			break;
		}
	}

	return $keyword;
}


function access_log_start($filename) {
        $filename = (!$filename)?date('Y_m')."_access_log_db":$filename;
	$SQLITE = new dbOpe("sqlite:".ACCESS_PATH.$filename);
	$sql_chk = "SELECT COUNT(*) AS CNT FROM sqlite_master WHERE TYPE='table' and NAME='ACCESS_LOG';";
	$chk = $SQLITE -> fetch($sql_chk);
	if ($chk[0]["CNT"] < 1) {
		$SQLITE -> exec(CREATE_SQL);
    }
	return $SQLITE;
}
?>
