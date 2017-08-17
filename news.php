<?php
/*******************************************************************************
SiteWiN 10 20 30（MySQL版）N3-2
新着情報の内容をFlashに出力するプログラム

※使用する際はファイル名を“news.php”にする事！

*******************************************************************************/

// 設定ファイル＆共通ライブラリの読み込み
if(file_exists('./common/INI_config.php')){
	$com_path = './common/';
}
else{
	$com_path = '../common/';
}
require_once($com_path."config_N3_2.php");		// 共通設定情報
require_once("util_lib.php");	// 汎用処理クラスライブラリ
require_once($com_path."INI_ShopConfig.php");

#------------------------------------------------------------------------
#	ページネーション情報の取得
#------------------------------------------------------------------------
//ページネーション
$sql_page = "
SELECT
	RES_ID,
	PAGE_FLG
FROM
	".N3_2WHATSNEW_PAGE."
	";

$fetch_page = $PDO -> fetch($sql_page);

// 1ページ辺りの表示件数
$page = $fetch_page[0]['PAGE_FLG'];
if($page == 0)$page = N3_2DBMAX_CNT;

#-------------------------------------------------------------------------
# DBより新着情報のデータを取り出す
#-------------------------------------------------------------------------
$sql = "
SELECT
	RES_ID,TITLE,CONTENT,
	YEAR(DISP_DATE) AS Y,
	MONTH(DISP_DATE) AS M,
	DAYOFMONTH(DISP_DATE) AS D,
	LINK,
	LINK_FLG,
	IMG_FLG,
	DISPLAY_FLG
FROM
	".N3_2WHATSNEW."
WHERE
	(DISPLAY_FLG = '1' )
AND
	(DEL_FLG = '0')
ORDER BY
	DISP_DATE DESC
LIMIT
	0 , ".N3_2DBMAX_CNT."
";

// ＳＱＬを実行
$fetch = $PDO -> fetch($sql);

		for($i=0;$i<count($fetch);$i++):

		//ＨＴＭＬでの表示処理
			//ID
				$id[$i] = $fetch[$i]['RES_ID'];

			// 日付
				$time[$i] = sprintf("%04d.%02d.%02d", $fetch[$i]['Y'], $fetch[$i]['M'], $fetch[$i]['D']);

			// タイトル
				$title[$i] = ($fetch[$i]['TITLE'])?$fetch[$i]['TITLE']:"&nbsp;";

			// コメント
				$content[$i] = ($fetch[$i]['CONTENT'])?nl2br($fetch[$i]['CONTENT']):"&nbsp";
			// リンク先
				$link[$i] = $fetch[$i]['LINK'];
			// リンク先表示タイプ
				$link_flg[$i] = $fetch[$i]['LINK_FLG'];

			// 記事の並び順の取得
				$target = ($i + 1); // ○番目

			// 表示されるページを算出
				$p[$i] = ceil($target/$page);

		endfor;

        $sql = "
        SELECT
	        PRODUCT_LST.PRODUCT_ID,
	        PRODUCT_LST.PRODUCT_NAME,
	        PRODUCT_LST.SELLING_PRICE
        FROM
	        ".PRODUCT_LST."
        WHERE
	        (RECOMMEND_FLG = '1')
        AND
	        (PRODUCT_LST.DEL_FLG = '0')
        AND
	        (PRODUCT_LST.DISPLAY_FLG = '1')
        AND
	        (PRODUCT_LST.SALE_START_DATE <= NOW() || PRODUCT_LST.SALE_START_DATE = '0000-00-00 00:00:00')
        AND
	        (PRODUCT_LST.SALE_END_DATE > NOW() || PRODUCT_LST.SALE_END_DATE = '0000-00-00 00:00:00')
        ORDER BY
	        PRODUCT_LST.RECOMMEND_VO ASC
        LIMIT
	        0 , ".RECOMMEND_DBMAX_CNT."
        ";
        $fetch_recomend = $PDO -> fetch($sql);

?>
