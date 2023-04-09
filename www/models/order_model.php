<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
if($member_info['idx'] < 1) {
    p_alert("로그인된 사용자만 접근 가능한 페이지입니다.", "/login.php");
    exit;
}

$cart_info = $DB->select_query("select cart_t.* from cart_t left join contents_t on (cart_t.ct_idx = contents_t.idx) 
                               where cart_t.mt_idx=".$_SESSION['_mt_idx']." and cart_t.ct_select=1 and cart_t.ct_status=0");

if($_POST['payment_complete'] != 'ok' && $_POST['payment_method'] == 2){	//모바일 카드결제
	if($DB->count_query("select * from order_t where ot_code='".$_POST['ot_code']."'") > 0){
		echo json_encode(array('result' => '_false', 'msg'=>'결제시도가 된 주문건 입니다. 재 주문 요청드립니다.'));
		exit;
	}
	$order_arr = array();
	$order_arr['ot_code'] = $_POST['ot_code'];
	$order_arr['mt_idx'] = $_SESSION['_mt_idx'];
	$order_arr['ot_pay_type'] = 2;
	$order_arr['ot_status'] = 1;
	$order_arr['ot_vat'] = $_POST['ot_vat'];
	$order_arr['ot_price'] = $_POST['sum_price'];
	$order_arr['ot_name'] = $_POST['mt_firstname']." ".$_POST['mt_lastname'];
	$order_arr['ot_email'] = $_POST['mt_email'];
	$order_arr['ot_hp'] = $_POST['mt_hp'];
	$order_arr['ot_wdate'] = date('Y-m-d H:i:s');
	if($DB->insert_query('order_t', $order_arr)){
		echo json_encode(array('result' => '_ok'));
	}
	exit;
}

include $_SERVER['DOCUMENT_ROOT']."/lib/http.class.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/Point_class.php";
$objPoint = new Point_class(array('db'=>$DB, 'mt_idx'=>$_SESSION['_mt_idx']));

$ot_pay_type = $_POST['payment_method'];//$arr_ct_method[$_POST['payment_method']];    //결제방법
$ot_method = ($_POST['payment_method'] == 1) ? 1 : 2; //무통장 1, 그외 2

$ot_code = get_ot_code();

if($ot_method=='2'){
    $http = new http;
    $ot_code = $_POST['ot_code'];
    $order_t = $DB->fetch_query("select * from order_t where ot_code='".$ot_code."'");
    if($_SESSION['_lang'] == "en") {
        $chk = number_format($_POST['sum_price'],2);
    } else {
        $chk = $_POST['sum_price'];
    }
    if(($order_t['ot_price'] != $chk)){
        //결제금액 상이
        $query['imp_key'] = $imp_key;
        $query['imp_secret'] = $imp_secret;
        $getToken = $http->PostMethodData('https://api.iamport.kr/users/getToken', $query, $mReferer, '',$mCookie, true);

        $getTokenJson = json_decode($getToken, true);
        $access_token = $getTokenJson['response']['access_token'];

        $query_cancel['reason'] = '결제금액 상이';
        $query_cancel['imp_uid'] = $order_t['ot_pg_pg_tid'];
        $query_cancel['amount'] = $order_t['ot_price'];
        $query_cancel['checksum'] = $order_t['ot_price'];
        $getpayment_cancel = $http->PostMethodData('https://api.iamport.kr/payments/cancel', $query_cancel, $mReferer, '',$mCookie, true, '', $access_token);
        $getpayment_cancel_data = json_decode($getpayment_cancel,true);
        p_alert('결제금액이 상이하여 취소되었습니다. 재시도 하시거나 관리자 문의주세요.', '/');
        exit;
    }
}

$order_arr = array();
$order_arr['ot_code'] = $ot_code;
$order_arr['mt_idx'] = $member_info['idx'];
$order_arr['ot_pay_type'] = $ot_pay_type;
$order_arr['ot_status'] = 1;
$order_arr['ot_vat'] = $_POST['ot_vat'];
$order_arr['ot_price'] = $_POST['sum_price'];
$order_arr['ot_name'] = $_POST['mt_firstname']." ".$_POST['mt_lastname'];
$order_arr['ot_email'] = $_POST['mt_email'];
$order_arr['ot_hp'] = $_POST['mt_hp'];
$order_arr['ot_wdate'] = date('Y-m-d H:i:s');

if($cart_info) {
    foreach($cart_info as $row){
        $query = "select *, (SELECT ct_name FROM category_t WHERE idx=ct_cate_idx2) as ct_name from contents_t where idx = ".$row['ct_idx'];
        $contents = $DB->fetch_assoc($query);
        if($contents) {
            $point += $arr_point[$contents['ct_name']];
        }
    }
}
$order_arr['ot_point'] = $point;
$query = "select * from membership_t where mt_status in (2,3) and mt_idx = ".$member_info['idx'];
$membership = $DB->fetch_assoc($query." order by mt_pdate desc limit 1");
$order_arr['mt_type'] = $membership['mt_type'];

if($_SESSION['_lang'] == "en") {
    $ct_unit = 2;
} else {
    $ct_unit = 1;
}

$query = "select * from member_t where idx = ".$_SESSION['_mt_idx'];
$member = $DB->fetch_assoc($query);
if($member['mt_level'] == 3) {
    $page = "my_orderlist.php";
} else {
    $page = "artist_my_orderlist.php";
}
if($ot_method=='2'){    //신용카드
	$order_arr['ot_status'] = 2;
    $order_arr['ot_pdate'] = date('Y-m-d H:i:s');
    if($DB->update_query('order_t', $order_arr, " ot_code = '".$ot_code."'")){
        if($cart_info) {
            foreach($cart_info as $row){
                $query = "select *, (SELECT ct_name FROM category_t WHERE idx=ct_cate_idx2) as ct_name, (SELECT mt_nickname FROM member_t WHERE idx=mt_idx) as mt_nickname from contents_t where idx = ".$row['ct_idx'];
                $contents = $DB->fetch_assoc($query);
                if($contents) {
                    $point = $arr_point[$contents['ct_name']];
                    $title = $contents['ct_title'];
                    $DB->insert_query("pushnotification_log_t", array("plt_title" => "‘".$contents['mt_nickname']."’님의 ‘".$contents['ct_title']."’가 판매 되었습니다.", "plt_type" => 2, "op_idx" => $contents['mt_idx'], "plt_page" => "artist_my_contents.php", "plt_wdate" => "now()"));
                }
                $DB->update_query('cart_t', array('ct_pdate'=> 'now()', 'ot_code'=>$ot_code, 'ct_select'=> 2, 'ct_status'=>2, 'ct_unit' => $ct_unit, "ct_point" => $point), "idx = ".$row['idx']);
            }
            if(count($cart_info) > 1) {
                $txt = " 외 ".(count($cart_info)-1)."개";
            }
            $DB->insert_query("pushnotification_log_t", array("plt_title" => "‘".$title.$txt."’를 구매하였습니다. 구매 후 2주간 다운로드가 가능합니다.", "plt_type" => 2, "op_idx" => $_SESSION['_mt_idx'], "plt_page" => $page, "plt_wdate" => "now()"));
        }
    }
}else{
    if($DB->insert_query('order_t', $order_arr)){
        foreach($cart_info as $row){
            $query = "select *, (SELECT ct_name FROM category_t WHERE idx=ct_cate_idx2) as ct_name, (SELECT mt_nickname FROM member_t WHERE idx=mt_idx) as mt_nickname from contents_t where idx = ".$row['ct_idx'];
            $contents = $DB->fetch_assoc($query);
            if($contents) {
                $point = $arr_point[$contents['ct_name']];
                $DB->insert_query("pushnotification_log_t", array("plt_title" => "‘".$contents['mt_nickname']."’님의 ‘".$contents['ct_title']."’가 판매 되었습니다.", "plt_type" => 2, "op_idx" => $contents['mt_idx'], "plt_page" => "artist_my_contents.php", "plt_wdate" => "now()"));
            }
            $DB->update_query('cart_t', array('ot_code'=>$ot_code, 'ct_select'=> 2, 'ct_status'=>1, 'ct_unit' => $ct_unit, "ct_point" => $point), "idx = ".$row['idx']);
            $title = $contents['ct_title'];
        }
        if(count($cart_info) > 1) {
            $txt = " 외 ".(count($cart_info)-1)."개";
        }
        $DB->insert_query("pushnotification_log_t", array("plt_title" => "‘".$title.$txt."’를 구매하였습니다. 구매 후 2주간 다운로드가 가능합니다.", "plt_type" => 2, "op_idx" => $_SESSION['_mt_idx'], "plt_page" => $page, "plt_wdate" => "now()"));
    }
}

gotourl('/order_success.php?ot_code='.$ot_code);
?>