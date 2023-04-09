<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/Point_class.php";

$mem_list = $DB->select_query("select * from member_t where mt_level in (3,5) and mt_rdate is null");

switch($_GET['push']){
	case '1':
		membership_extinction();	//1.멤버십 유효기간알림
	break;
	case '2':
//		point_extinction();	//3.포인트 소멸알림
	break;
}

//1.멤버십 유효기간알림
function membership_extinction(){
	global $DB;

    //7일
	$list1 = $DB->select_query("select * from membership_t where mt_edate = '".date("Y-m-d",strtotime("+7 day"))."' and mt_status = 2");
    //3일
    $list2 = $DB->select_query("select * from membership_t where mt_edate = '".date("Y-m-d",strtotime("+3 day"))."' and mt_status = 2");
    //1일
    $list3 = $DB->select_query("select * from membership_t where mt_edate = '".date("Y-m-d",strtotime("+1 day"))."' and mt_status = 2");
    if($list1) {
        foreach($list1 as $row){
            if($row['mt_level'] == 3) {
                $page = "my_subscription.php";
            } else {
                $page = "artist_my_subscription.php";
            }
            $DB->insert_query("pushnotification_log_t", array("plt_title" => "‘".$row['mt_membership']."’가 ‘7’일 남았습니다.", "plt_type" => 4, "plt_page" => $page, "op_idx" => $row['mt_idx'], "plt_wdate" => "now()"));
        }
    } else if($list2) {
        foreach($list2 as $row2){
            if($row2['mt_level'] == 3) {
                $page = "my_subscription.php";
            } else {
                $page = "artist_my_subscription.php";
            }
            $DB->insert_query("pushnotification_log_t", array("plt_title" => "‘".$row2['mt_membership']."’가 ‘3’일 남았습니다.", "plt_type" => 4, "plt_page" => $page, "op_idx" => $row2['mt_idx'], "plt_wdate" => "now()"));
        }
    } else if($list3) {
        foreach($list3 as $row3){
            if($row3['mt_level'] == 3) {
                $page = "my_subscription.php";
            } else {
                $page = "my_subscription.php";
            }
            $DB->insert_query("pushnotification_log_t", array("plt_title" => "‘".$row3['mt_membership']."’가 ‘1’일 남았습니다.", "plt_type" => 4, "plt_page" => $page, "op_idx" => $row3['mt_idx'], "plt_wdate" => "now()"));
        }
    }
    //멤버십 만료
    membership();
}

//멤버십 만료
function membership(){
	global $DB;
    $membership = $DB->select_query("select * from membership_t where mt_edate < '".date("Y-m-d")."' and mt_status = 2");
    if($membership) {
        foreach ($membership as $row) {
            $DB->update_query("membership_t", array("mt_status" => 4, "mt_udate" => "now()"), "idx = ".$row['idx']);
        }
    }
}
?>