<?php
/*******************************************************************************
������������

	������������ɽ���ǡ��������ѣģ¥�������
	ɽ�����ˤ�äƥǡ����١���ɽ�����ѹ�

	SQLite�б���

*******************************************************************************/

// �����������������å���ľ�ܤ��Υե�����˥���������������
if(!$injustice_access_chk){
	header("Location: ../err.php");exit();
}

// POST�ǡ����μ������ȶ��̤�ʸ�������
if($_POST)extract(utilLib::getRequestParams("post",array(8,7,1,4),true));

$filename = ($term)?$term."_access_log_db":"";
$SQLITE = access_log_start($filename);

#---------------------------------------------------------------
# ��ǡ����κ��(4����ʾ�вᤷ�����)
#---------------------------------------------------------------
/*$DEL_limit = date('Ym', mktime(0,0,0,(date("n")-4),date("j"),date("Y")));

$del_sql = "
DELETE FROM
	ACCESS_LOG
WHERE
	( strftime('%Y%m', INS_DATE) <= '$DEL_limit' )
";
$delResult = $dbh->regist($del_sql);
if($delResult)die("�ǡ�������˼��Ԥ��ޤ���<br>\n{$delResult}<br>\n");
*/
$i = 6;
while(1){
	//$DEL_limit = date('Y_m', mktime(0,0,0,(date("n")-$i),date("j"),date("Y")));
	$DEL_limit = date('Y_m', mktime(0,0,0,(date("n")-$i),'1',date("Y")));

	if(file_exists(ACCESS_PATH.$DEL_limit."_access_log_db")){
		unlink(ACCESS_PATH.$DEL_limit."_access_log_db") or die("��ǡ����κ���˼��Ԥ��ޤ�����");
	}
	else{
		break;
	}
	$i++;
}

#---------------------------------------------------------------
# �ǡ�������
#---------------------------------------------------------------

// ���ǡ�������
$total_sql = "
SELECT
	ID
FROM
 ACCESS_LOG
".$where_term."
";
$fetch = $SQLITE->fetch($total_sql);

//if($where_term){$total_u_sql =  $total_sql."AND (UNIQUE_FLG == '1')";}else{$total_u_sql = $total_sql."WHERE (UNIQUE_FLG == '1')";}

//$fetch_u = $SQLITE->fetch($total_u_sql);

if($where_term){$total_uu_sql =  $total_sql."AND (USER_FLG == '1')";}else{$total_uu_sql = $total_sql."WHERE (USER_FLG == '1')";}

$fetch_uu = $SQLITE->fetch($total_uu_sql);

// �����Υ����������
$today_day_time = date('Ymd', mktime(0,0,0,date("n"),date("j"),date("Y")));

$today_sql = "
SELECT
	ID
FROM
 ACCESS_LOG
WHERE
	( strftime('%Y%m%d', INS_DATE) = '".$today_day_time."')
";
$TodayCnt = $SQLITE->fetch($today_sql);

#---------------------------------------------------------------
# �ƥǡ��������ؿ������
#---------------------------------------------------------------
// ���̥�������������
function day_access($where_term,$dbins){
	$day_sql = "
	SELECT
		INS_DATE,
		strftime('%Y', INS_DATE) AS Y,
		strftime('%m', INS_DATE) AS M,
		strftime('%d', INS_DATE) AS D,
		count(*) AS CNT
	FROM
		ACCESS_LOG
	".$where_term."
	GROUP BY
		strftime('%Y%m%d', INS_DATE)
	ORDER BY
		strftime('%Y%m%d', INS_DATE) DESC
	";

	$fetch_day = $dbins->fetch($day_sql);
	return $fetch_day;
}

// ���̥�ˡ�����������������
function day_u_access($where_term,$dbins){

	if($where_term){$where_term .= "AND (UNIQUE_FLG == '1')";}else{$where_term .= "WHERE (UNIQUE_FLG == '1')";}

	$day_u_sql = "
	SELECT
		INS_DATE,
		strftime('%Y', INS_DATE) AS Y,
		strftime('%m', INS_DATE) AS M,
		strftime('%d', INS_DATE) AS D,
		count(*) AS CNT
	FROM
		ACCESS_LOG
	".$where_term."
	GROUP BY
		strftime('%Y%m%d', INS_DATE)
	ORDER BY
		strftime('%Y%m%d', INS_DATE) DESC
	";

	$fetch_day_u = $dbins->fetch($day_u_sql);
	return $fetch_day_u;
}

// ����ˬ��Կ�����
function day_uu_access($where_term,$dbins){

	if($where_term){$where_term .= "AND (USER_FLG == '1')";}else{$where_term .= "WHERE (USER_FLG == '1')";}

	$day_uu_sql = "
	SELECT
		INS_DATE,
		strftime('%Y', INS_DATE) AS Y,
		strftime('%m', INS_DATE) AS M,
		strftime('%d', INS_DATE) AS D,
		count(*) AS CNT
	FROM
		ACCESS_LOG
	".$where_term."
	GROUP BY
		strftime('%Y%m%d', INS_DATE)
	ORDER BY
		strftime('%Y%m%d', INS_DATE) DESC
	";

	$fetch_day_uu = $dbins->fetch($day_uu_sql);
	return $fetch_day_uu;
}

// ���̥������������ؿ�
function mon_access($where_term,$dbins){
	$mon_sql = "
	SELECT
		INS_DATE,
		strftime('%m', INS_DATE) AS M,
		COUNT(*) AS CNT
	FROM
		ACCESS_LOG
	".$where_term."
	GROUP BY
		strftime('%m', INS_DATE)
	ORDER BY
		strftime('%m', INS_DATE) ASC
	";

	$cnt_month = $dbins->fetch($mon_sql);

	// ��(1����12)�򥤥�ǥå����������֤�����(ɽ���Ѥ�12�����������)
	foreach($cnt_month as $k => $v){
		$key = (int)$v["M"];
		$MonCnt[$key] = $v["CNT"];
	}
	return $MonCnt;
}

// ���̥�ˡ����������������ؿ�
function mon_u_access($where_term,$dbins){

	if($where_term){$where_term .= "AND (UNIQUE_FLG == '1')";}else{$where_term .= "WHERE (UNIQUE_FLG == '1')";}

	$mon_sql = "
	SELECT
		INS_DATE,
		strftime('%m', INS_DATE) AS M,
		COUNT(*) AS CNT
	FROM
		ACCESS_LOG
	".$where_term."
	GROUP BY
		strftime('%m', INS_DATE)
	ORDER BY
		strftime('%m', INS_DATE) ASC
	";

	$cnt_month = $dbins->fetch($mon_sql);

	// ��(1����12)�򥤥�ǥå����������֤�����(ɽ���Ѥ�12�����������)
	foreach($cnt_month as $k => $v){
		$key = (int)$v["M"];
		$MonCnt_u[$key] = $v["CNT"];
	}
	return $MonCnt_u;
}

// ����ˬ��Կ������ؿ�
function mon_uu_access($where_term,$dbins){

	if($where_term){$where_term .= "AND (USER_FLG == '1')";}else{$where_term .= "WHERE (USER_FLG == '1')";}

	$mon_sql = "
	SELECT
		INS_DATE,
		strftime('%m', INS_DATE) AS M,
		COUNT(*) AS CNT
	FROM
		ACCESS_LOG
	".$where_term."
	GROUP BY
		strftime('%m', INS_DATE)
	ORDER BY
		strftime('%m', INS_DATE) ASC
	";

	$cnt_month = $dbins->fetch($mon_sql);

	// ��(1����12)�򥤥�ǥå����������֤�����(ɽ���Ѥ�12�����������)
	foreach($cnt_month as $k => $v){
		$key = (int)$v["M"];
		$MonCnt_uu[$key] = $v["CNT"];
	}
	return $MonCnt_uu;
}

// �����̥�������������
function hour_access($where_term,$dbins){
	$time_sql = "
	SELECT
		strftime('%H', TIME) AS TIME,
		COUNT(*) AS CNT
	FROM
		ACCESS_LOG
	".$where_term."
	GROUP BY
		TIME
	ORDER BY
		TIME ASC
	";

	$cnt_time = $dbins->fetch($time_sql);

	// ����(1����24)�򥤥�ǥå����������֤�����(ɽ���Ѥ�24�����������)
	foreach($cnt_time as $k => $v){
		$key = $v["TIME"];

		$key = sprintf("%02d",$key);

		$fetch_time[$key] = $v["CNT"];
	}

	return $fetch_time;
}

// �����̥�ˡ�����������������
function hour_u_access($where_term,$dbins){

	if($where_term){$where_term .= "AND (UNIQUE_FLG == '1')";}else{$where_term .= "WHERE (UNIQUE_FLG == '1')";}

	$time_sql = "
	SELECT
		strftime('%H', TIME) AS TIME,
		COUNT(*) AS CNT
	FROM
		ACCESS_LOG
	".$where_term."
	GROUP BY
		TIME
	ORDER BY
		TIME ASC
	";

	$cnt_time = $dbins->fetch($time_sql);

	// ����(1����24)�򥤥�ǥå����������֤�����(ɽ���Ѥ�24�����������)
	foreach($cnt_time as $k => $v){
		$key = $v["TIME"];

		$key = sprintf("%02d",$key);

		$fetch_time_u[$key] = $v["CNT"];
	}

	return $fetch_time_u;
}

// ������ˬ��Կ�����
function hour_uu_access($where_term,$dbins){

	if($where_term){$where_term .= "AND (USER_FLG == '1')";}else{$where_term .= "WHERE (USER_FLG == '1')";}

	$time_sql = "
	SELECT
		strftime('%H', TIME) AS TIME,
		COUNT(*) AS CNT
	FROM
		ACCESS_LOG
	".$where_term."
	GROUP BY
		TIME
	ORDER BY
		TIME ASC
	";

	$cnt_time = $dbins->fetch($time_sql);

	// ����(1����24)�򥤥�ǥå����������֤�����(ɽ���Ѥ�24�����������)
	foreach($cnt_time as $k => $v){
		$key = $v["TIME"];

		$key = sprintf("%02d",$key);

		$fetch_time_uu[$key] = $v["CNT"];
	}

	return $fetch_time_uu;
}

// �ڡ����̥�������������
function page_access($where_term,$dbins){
	$url_sql = "
	SELECT
		PAGE_URL,
		COUNT(*) AS CNT
	FROM
		ACCESS_LOG
	".$where_term."
	GROUP BY
		PAGE_URL
	ORDER BY
		CNT DESC
	";

	$fetchURL = $dbins->fetch($url_sql);

	return $fetchURL;
}

// �ڡ����̥�ˡ�����������������
function page_u_access($where_term,$dbins){

	if($where_term){$where_term .= "AND (UNIQUE_FLG == '1')";}else{$where_term .= "WHERE (UNIQUE_FLG == '1')";}

	$url_sql = "
	SELECT
		PAGE_URL,
		COUNT(*) AS CNT
	FROM
		ACCESS_LOG
	".$where_term."
	GROUP BY
		PAGE_URL
	ORDER BY
		CNT DESC
	";

	$fetchURL_u = $dbins->fetch($url_sql);

	return $fetchURL_u;
}

// �������󥸥������
function engine_access($where_term,$dbins){
	$engine_sql = "
	SELECT
		ENGINE,
		COUNT(*) AS CNT
	FROM
		ACCESS_LOG
	".$where_term."
	GROUP BY
		ENGINE
	HAVING
   (ENGINE != \"\")
	ORDER BY
		CNT DESC
	";

	$fetchENGINE = $dbins->fetch($engine_sql);

	return $fetchENGINE;
}

// ����ʸ�������
function access_query($where_term,$dbins,$kensu){
	$q_sql = "
	SELECT
		ENGINE,QUERY_STRING,
		COUNT(*) AS CNT
	FROM
		ACCESS_LOG
	".$where_term."
	GROUP BY
		QUERY_STRING, ENGINE
	HAVING
   (QUERY_STRING != \"\")
	ORDER BY
		CNT DESC
	";

	if($kensu == 1)$q_sql .= " LIMIT 0,100";
	elseif($kensu == 2)$q_sql .= " LIMIT 0,300";

	$fetchQuery = $dbins->fetch($q_sql);

	return $fetchQuery;
}

// �����̥�������������
function dayofweek_access($where_term,$dbins){
	$dayofweek_sql = "
	SELECT
		strftime('%w', INS_DATE) AS DAYOFWEEK,
		COUNT(*) AS CNT
	FROM
		ACCESS_LOG
	".$where_term."
	GROUP BY
		strftime('%w', INS_DATE)
	ORDER BY
		strftime('%w', INS_DATE) ASC
	";

	$cnt_dayofweek = $dbins->fetch($dayofweek_sql);

	// ����(0����6)�򥤥�ǥå����������֤�����(ɽ���Ѥ�7�����������)
	foreach($cnt_dayofweek as $k => $v){
		$key = $v["DAYOFWEEK"];
		$fetch_dayofweek[$key] = $v["CNT"];
	}

	return $fetch_dayofweek;
}

// �����̥�ˡ�����������������
function dayofweek_u_access($where_term,$dbins){

	if($where_term){$where_term .= "AND (UNIQUE_FLG == '1')";}else{$where_term .= "WHERE (UNIQUE_FLG == '1')";}

	$dayofweek_sql = "
	SELECT
		strftime('%w', INS_DATE) AS DAYOFWEEK,
		COUNT(*) AS CNT
	FROM
		ACCESS_LOG
	".$where_term."
	GROUP BY
		strftime('%w', INS_DATE)
	ORDER BY
		strftime('%w', INS_DATE) ASC
	";

	$cnt_dayofweek = $dbins->fetch($dayofweek_sql);

	// ����(0����6)�򥤥�ǥå����������֤�����(ɽ���Ѥ�7�����������)
	foreach($cnt_dayofweek as $k => $v){
		$key = $v["DAYOFWEEK"];
		$fetch_dayofweek_u[$key] = $v["CNT"];
	}

	return $fetch_dayofweek_u;
}

// ������ˬ��Կ�����
function dayofweek_uu_access($where_term,$dbins){

	if($where_term){$where_term .= "AND (USER_FLG == '1')";}else{$where_term .= "WHERE (USER_FLG == '1')";}

	$dayofweek_sql = "
	SELECT
		strftime('%w', INS_DATE) AS DAYOFWEEK,
		COUNT(*) AS CNT
	FROM
		ACCESS_LOG
	".$where_term."
	GROUP BY
		strftime('%w', INS_DATE)
	ORDER BY
		strftime('%w', INS_DATE) ASC
	";

	$cnt_dayofweek = $dbins->fetch($dayofweek_sql);

	// ����(0����6)�򥤥�ǥå����������֤�����(ɽ���Ѥ�7�����������)
	foreach($cnt_dayofweek as $k => $v){
		$key = $v["DAYOFWEEK"];
		$fetch_dayofweek_uu[$key] = $v["CNT"];
	}

	return $fetch_dayofweek_uu;
}

// �֥饦��������
function bro_access($where_term,$dbins){
	$bro_sql = "
	SELECT
		BROWSER,
		COUNT(*) AS CNT
	FROM
		ACCESS_LOG
	".$where_term."
	GROUP BY
		BROWSER
	ORDER BY
		CNT DESC
	";

	$fetch_bro = $dbins->fetch($bro_sql);
	return $fetch_bro;
}

// OS������
function os_access($where_term,$dbins){
	$os_sql = "
	SELECT
		OS,
		COUNT(*) AS CNT
	FROM
		ACCESS_LOG
	".$where_term."
	GROUP BY
		OS
	ORDER BY
		CNT DESC
	";

	$fetch_os = $dbins->fetch($os_sql);
	return $fetch_os;
}

// ��ե��顼������
function ref_access($where_term,$dbins){

if($where_term){$where_term .= " AND ( REFERER != \"\" )";}else{$where_term = "WHERE ( REFERER != \"\" )";}

	$ref_sql = "
	SELECT
		REFERER,
		COUNT(*) AS CNT
	FROM
		ACCESS_LOG
	".$where_term."
	GROUP BY
		REFERER
	ORDER BY
		CNT DESC
	LIMIT 0 , 10
	";

	$fetch_ref = $dbins->fetch($ref_sql);

	return $fetch_ref;
}

// ���̥�ˡ�����������������
function state_access($where_term,$dbins){

	// if($where_term){$where_term .= "AND (UNIQUE_FLG == '1')";}else{$where_term .= "WHERE (UNIQUE_FLG == '1')";}

	$state_u_sql = "
	SELECT
		STATE,
		count(*) AS CNT
	FROM
		ACCESS_LOG
	".$where_term."
	GROUP BY
		STATE
	HAVING
		(STATE != \"\")
	ORDER BY
		CNT DESC
	";

	$fetch_state_u = $dbins->fetch($state_u_sql);
	return $fetch_state_u;
}


if(empty($kensu))$kensu = 1;

switch ($_POST["mode"]):
	case "day":
			$fetch_day = day_access($where_term,$SQLITE);
			//$fetch_day_u = day_u_access($where_term,$SQLITE);
			$fetch_day_uu = day_uu_access($where_term,$SQLITE);
		break;
	case "month":
			$MonCnt = mon_access($where_term,$SQLITE);
			//$MonCnt_u = mon_u_access($where_term,$SQLITE);
			$MonCnt_uu = mon_uu_access($where_term,$SQLITE);
		break;
	case "hour":
			$fetch_time = hour_access($where_term,$SQLITE);
			//$fetch_time_u = hour_u_access($where_term,$SQLITE);
			$fetch_time_uu = hour_uu_access($where_term,$SQLITE);
		break;
	case "youbi":
			$fetch_dayofweek = dayofweek_access($where_term,$SQLITE);
			//$fetch_dayofweek_u = dayofweek_u_access($where_term,$SQLITE);
			$fetch_dayofweek_uu = dayofweek_uu_access($where_term,$SQLITE);
		break;
	case "page":
			$fetchURL = page_access($where_term,$SQLITE);
			//$fetchURL_u = page_u_access($where_term,$SQLITE);
		break;
	case "engine":
			$fetchENGINE = engine_access($where_term,$SQLITE);
		break;
	case "query":
			$fetchQuery = access_query($where_term,$SQLITE,$kensu);
		break;
	case "bro":
			$fetch_bro = bro_access($where_term,$SQLITE);
		break;
	case "os":
			$fetch_os = os_access($where_term,$SQLITE);
		break;
	case "ref":
			$fetch_ref = ref_access($where_term,$SQLITE);
		break;
	case "state":
			$fetch_state_u = state_access($where_term,$SQLITE);
		break;
	case "all":
			$fetch_day = day_access($where_term,$SQLITE);
			//$fetch_day_u = day_u_access($where_term,$SQLITE);
			$fetch_day_uu = day_uu_access($where_term,$SQLITE);
			$MonCnt = mon_access($where_term,$SQLITE);
			//$MonCnt_u = mon_u_access($where_term,$SQLITE);
			$MonCnt_uu = mon_uu_access($where_term,$SQLITE);
			$fetch_time = hour_access($where_term,$SQLITE);
			//$fetch_time_u = hour_u_access($where_term,$SQLITE);
			$fetch_time_uu = hour_uu_access($where_term,$SQLITE);
			$fetch_dayofweek = dayofweek_access($where_term,$SQLITE);
			//$fetch_dayofweek_u = dayofweek_u_access($where_term,$SQLITE);
			$fetch_dayofweek_uu = dayofweek_uu_access($where_term,$SQLITE);
			$fetchURL = page_access($where_term,$SQLITE);
			//$fetchURL_u = page_u_access($where_term,$SQLITE);
			$fetchENGINE = engine_access($where_term,$SQLITE);
			$fetchQuery = access_query($where_term,$SQLITE,$kensu);
			$fetch_bro = bro_access($where_term,$SQLITE);
			$fetch_os = os_access($where_term,$SQLITE);
			$fetch_ref = ref_access($where_term,$SQLITE);
			$fetch_state_u = state_access($where_term,$SQLITE);
	default:
			$fetch_day = day_access($where_term,$SQLITE);
			//$fetch_day_u = day_u_access($where_term,$SQLITE);
			$fetch_day_uu = day_uu_access($where_term,$SQLITE);
		break;
endswitch;

?>
