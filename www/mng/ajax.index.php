<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
$date = $_POST['date'];

if($_POST['type']=='get_visitor_cnt'){
	$query = "select count(*) as cnt, vlt_wdate from visitor_log_t ";
	if($_POST['sdate'] && $_POST['edate']) {
		$query .= " where vlt_wdate between '".$_POST['sdate']." 00:00:00' and '".$_POST['edate']." 23:59:59'";
	} else {
		$query .= " where vlt_wdate BETWEEN DATE_ADD(NOW(),INTERVAL -1 WEEK) AND NOW() ";
	}
	$query .= " group by vlt_wdate ";
	$list = $DB->select_query($query);
	if($list) {
		foreach ($list as $row) {
			$arr[] = array("label" => $row['vlt_wdate'], "y" => (int)$row['cnt']);
		}
		echo json_encode(array('result' => '_ok', 'data' => $arr));
	} else {
		echo json_encode(array('result' => 'false', 'data' => ""));
	}
} else if($_POST['type']=='get_join_cnt'){
	$query = "select count(*) as cnt, DATE_FORMAT(mt_wdate, '%Y-%m-%d') as mt_wdate from member_t ";
	if($_POST['sdate'] && $_POST['edate']) {
		$query .= " where mt_wdate between '".$_POST['sdate']." 00:00:00' and '".$_POST['edate']." 23:59:59'";
	} else {
		$query .= " where mt_wdate BETWEEN DATE_ADD(NOW(),INTERVAL -1 WEEK) AND NOW() ";
	}
	$query .= " group by DATE_FORMAT(mt_wdate, '%Y-%m-%d') ";
	$list = $DB->select_query($query);
	if($list) {
		foreach ($list as $row) {
			$arr[] = array("label" => $row['mt_wdate'], "y" => (int)$row['cnt']);
		}
		echo json_encode(array('result' => '_ok', 'data' => $arr));
	} else {
		echo json_encode(array('result' => 'false', 'data' => ""));
	}
} else if($_POST['type']=='get_buy_cnt') {
	$query = "select count(*) as cnt, date_format(mt_pdate, '%Y-%m-%d') as mt_pdate from membership_t where mt_status = 2";
	if($_POST['sdate'] && $_POST['edate']) {
		$query .= " and mt_pdate between '".$_POST['sdate']." 00:00:00' and '".$_POST['edate']." 23:59:59'";
	} else {
		$query .= " and mt_pdate BETWEEN DATE_ADD(NOW(),INTERVAL -1 WEEK ) AND NOW() ";
	}
	$query .= " group by date_format(mt_pdate, '%Y-%m-%d') ";
	$list = $DB->select_query($query);
	if($list) {
		foreach ($list as $row) {
			$arr[] = array("label" => $row['mt_pdate'], "y" => (int)$row['cnt']);
		}
		echo json_encode(array('result' => '_ok', 'data' => $arr));
	} else {
		echo json_encode(array('result' => 'false', 'data' => ""));
	}
} else if($_POST['type']=='get_ot_price'){
	$query = "select ifnull(sum(ot_price),0) as ot_price, date_format(ot_pdate, '%Y-%m-%d') as ot_pdate from order_t where ot_status > 1";
	if($_POST['sdate'] && $_POST['edate']) {
		$query .= " and ot_pdate between '".$_POST['sdate']." 00:00:00' and '".$_POST['edate']." 23:59:59'";
	} else {
		$query .= " and ot_pdate BETWEEN DATE_ADD(NOW(),INTERVAL -1 WEEK ) AND NOW() ";
	}
	$query .= " group by date_format(ot_pdate, '%Y-%m-%d') ";
	$list = $DB->select_query($query);
	if($list) {
		foreach ($list as $row) {
			$arr[] = array("label" => $row['ot_pdate'], "y" => (int)$row['ot_price']);
		}
	}
	echo json_encode(array('result' => '_ok', 'data' => $arr));
}
?>
