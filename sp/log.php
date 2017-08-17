<?php
/*******************************************************************************

	�������ѥե����� DB��¸��
	�����������Ϥ򤷤����ڡ�����Ž�äƤ���
	���󥯥롼���ѥ������ɤ߹��ޤ줿�餳�Υե����뤬�¹Ԥ����

	SQLite��

*******************************************************************************/

// ����ե���������̥饤�֥����ɤ߹���
require_once("./common/INI_logconfig.php");		// ����ե�����
require_once("util_lib.php");				// ���ѽ������饹�饤�֥��
require_once("dbOpe.php");				// SQLite���饹�饤�֥��
require_once("envOpe.php");					// �Ķ��ѿ������饤�֥��

#---------------------------------------------------------------------------------
# �桼�����Ķ��μ���
# 	����IP���ɥ쥹����
# 	�����Ķ��ѿ������饤�֥������Ƚ�ꤷ��UA�������� ������ͤ�$result[1]����Ѥ���
#		����OS����μ���       ������ͤ�$result[2]��$result[3]����Ѥ���
#   �����֥饦������μ��� ������ͤ�$result[4]��$result[5]����Ѥ���
#
#---------------------------------------------------------------------------------
$ip = $_SERVER["REMOTE_ADDR"];

/* OS.�֥饦��������������� */
$agent = $_SERVER["HTTP_USER_AGENT"];

$e = new UA_Info();
$result = $e->getNavInfo();

$os      = $result[2] . $result[3];
$browser = $result[4] . $result[5];

#-------------------------------------------------------------------------------------------------------
# ��󥯸��γƾ�������(parse_url)
#		�� ���֤���HTML�ե����뤫��img�����Ǥ��ɹ��߻���
#		GET�ѥ�᡼�����ղä��Ƥ���JavaScript�Ǽ���������ե��顼����
#		$_GET["referrer"]�����󥯸������
#				(�̾��̤��ե��顼�򻲾Ȥ��Ƥ⡢���֤���HTML�ե�����ξ������äƤ��ޤ�����)
#--------------------------------------------------------------------------------------------------------

// �������ȤΥۥ��Ȥ����
$host_addr = $_SERVER["HTTP_HOST"];
//$host_addr = "all-internet.jp";

// ��ե��顼��URL�����parse_url������˥��å�
$ref_info	= parse_url($_GET["referrer"]);

// ��󥯸�URL���� ����󥯸��������Ǥ��Ƥ���Τߡ�URLʸ��������
if(!empty($_GET["referrer"])){
	$ref_url	= $ref_info["scheme"]."://".$ref_info["host"].$ref_info["path"];

	// ��󥯸��˸������ȤΥۥ���̾�����äƤ���Х�ե��顼��Ȥ�ʤ�
	$str = strstr($ref_url , $host_addr);

	// $str���ͤ�����Х�ե��顼����ˤ��Ƴ�Ǽ���ʤ�
	if($str)$ref_url = "";
}

#----------------------------------------------------------------------------------------------------------------------
# ��̾����
#----------------------------------------------------------------------------------------------------------------------
$state = ($_GET["st_id_obj"])?mb_convert_encoding(urldecode($_GET["st_id_obj"]),"EUC-JP","auto"):"";
$state = ($state == "Hokkaido")?"�̳�ƻ":$state;
$state = ($state == "Kanagawa")?"�����":$state;

#----------------------------------------------------------------------------------------------------------------------
# ���ե������������(parse_url)
#		�� ���֤���HTML�ե����������������ˤ�
#		���μ����ե�����log.php�Υ�ե��顼������̾��̤껲�Ȥ���Ф褤
#		��󥯸��ξ���(���󥯥롼�ɸ��ξ���)�ĤޤꡢJavaScript����Ѥ������֤�����HTML�ե�������󤬼����Ǥ���
#----------------------------------------------------------------------------------------------------------------------
$file_info	= parse_url($_SERVER['HTTP_REFERER']);

// index.html,index.php,index.cfm�ϳ���
$file_path = str_replace("/index.html","/",$file_info["path"]);
$file_path = str_replace("/index.php","/",$file_path);
$file_path = str_replace("/index.cfm","/",$file_path);

$url_q = (empty($file_info["query"]))?"":"?".$file_info["query"];

$fname		= $file_info["scheme"]."://".$file_info["host"].$file_path.$url_q;		// ������ʸ�����ޤ�URL�����

$filename = str_replace(".","_",$fname);

// ��ե��顼��ʸ�������
$refe = $_GET["referrer"];

// ������ʸ���������ɬ��url�ǥ����ɤ���ʸ�������ɤ������
$query = mb_convert_encoding(urldecode($ref_info["query"]),"EUC-JP","auto");

#----------------------------------------------------------------------------------------------------------------------
# ��ˡ������������μ���
#	�������������Ƥ����桼�������Ф���URL̾�ǥ��å���������Ǽ($_COOKIE["URL̾"])
#   ��$_COOKIE["URL"]��¸�ߤ��뤫�ɤ����ǥ�ˡ������������桼�������������
#   ���Ϥ�ƤΥ��������ʤ�$unique�򣱡������ܰʹߤʤ�$unique�򣲤˥��åȤ���
#   ��COOKIE��ͭ�����¤�3���֤Ȥ��롣
#----------------------------------------------------------------------------------------------------------------------
if($_COOKIE[$filename]!=$filename){
	$value = $filename;
	$expire = time() + 3600*3;
	setcookie($filename, $value, $expire);
	$unique = 1;
}else{
	$unique = 2;
}

#----------------------------------------------------------------------------------------------------------------------
# ˬ��Կ��μ���
#	�������������Ƥ����桼�������Ф��ƥ��å���������Ǽ
#   ��$_COOKIE['UNIQUE_USER']��¸�ߤ��뤫�ɤ����ǥ�ˡ������������桼�������������
#   ���Ϥ�ƤΥ��������ʤ�$unique_user�򣱡������ܰʹߤʤ�$unique_user�򣲤˥��åȤ���
#   ��COOKIE��ͭ�����¤�3���֤Ȥ��롣
#----------------------------------------------------------------------------------------------------------------------
if(!isset($_COOKIE["UNIQUE_USER"])){
	$cookie = "UNIQUE_USER";
	$value = "visited";
	$expire = time() + 3600*3;
	setcookie($cookie, $value, $expire);
	$unique_user = 1;
}else{
	$unique_user = 2;
}

#============================================
# �������󥸥����&����������ɼ���
#============================================

//�ꥹ���ɤ߹���
$list_fn = "../back_office/list/engine.txt";
if(file_exists($list_fn)) $engine_list = setting_read($list_fn);
unset($list_fn);

#====================================================================================
# get_keyword�ؿ��Ǹ���������ɤ����
# list�ե�����ˤ���engine.txt�ե�������$fname�ȥޥå����븡�����󥸥��URL�����
# $eng["name"]  // �������󥸥�̾
# $eng["q"]     // ����������ɤ�key̾ google���ä����p=%E8%A7%A3%E6%�פΣ����ʬ
# $eng["uri"]   // �������󥸥��URL msn���ä���search.msn.co.jp
#====================================================================================

foreach($engine_list as $list){

	unset($eng);

	list($eng["name"],$eng["q"],$eng["uri"]) = explode("||",$list);
		if(eregi("($eng[uri])",$refe)){

				//������ɼ���
				$keyword = get_keyword($query ,$eng["q"]);

				// �������󥸥�̾
        $engine = $eng["name"];
		}
}

// �����������
$query = $keyword;

#=================================================================================
# �ƥǡ�����DB��Ͽ
#=================================================================================

	$date_now = date("Y-m-d");
	$time_now = date("H:i:s");

	$sql_ins = "
	INSERT INTO ACCESS_LOG(
		REMOTE_ADDR,
		USER_AGENT,
		REFERER,
		QUERY_STRING,
		ENGINE,
		OS,
		BROWSER,
		PAGE_URL,
		STATE,
		UNIQUE_FLG,
		USER_FLG,
		INS_DATE,
		TIME
	)
	VALUES(
		'".utilLib::strRep($ip,5)."',
		'".utilLib::strRep($agent,5)."',
		'".utilLib::strRep($ref_url,5)."',
		'".utilLib::strRep($query,5)."',
		'".utilLib::strRep($engine,5)."',
		'".utilLib::strRep($os,5)."',
		'".utilLib::strRep($browser,5)."',
		'".utilLib::strRep($fname,5)."',
		'".utilLib::strRep($state,5)."',
		'".utilLib::strRep($unique,5)."',
		'".utilLib::strRep($unique_user,5)."',
		'$date_now',
		'$time_now'
	)
	";
// SQL�¹�
if( (!empty($sql_ins)) && ($fname != "://") ){
	$SQLITE = access_log_start();
	$SQLITE -> regist($sql_ins);
}

/*
echo nl2br(print_r($_COOKIE , true));
echo "UNIQU : ".$unique."<br>\n";
echo "USER : ".$unique_user."<br>\n";
*/
?>
