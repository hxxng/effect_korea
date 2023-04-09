<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/Payment_class.php";

if($_SESSION['_mt_idx'] < 1){
	echo json_encode(array('result' => '_false', 'msg' => '로그인 후 시도해 주세요.'));
	exit;	
}

if($_POST['act'] == 'content') {
    if($_POST['act'] == 'content' && !$_POST['ot_code']){
        echo json_encode(array('result' => '_false', 'msg' => '콘텐츠 정보가 없습니다.'));
        exit;
    }

    $objPayment = new Payment_class(array('db'=>$DB, 'mt_idx'=>$_SESSION['_mt_idx'], 'act'=>$_POST['act']));
    $result = $objPayment->before($_POST);
    if($result['result']=='true'){
        echo json_encode(array('result' => '_true', 'data_arr'=>$result['data']));
        exit;
    }else{
        if($result['key']=='member') $msg = '로그인이 필요합니다.';
        if($result['key']=='content') $msg = '콘텐츠 정보가 없습니다.';
        if($result['key']=='payment') $msg = '결제 실패되었습니다.';
        echo json_encode(array('result' => '_false', 'msg' => $msg));
        exit;
    }
} else if($_POST['act'] == "update_member") {
    $arr = array(
        "mt_local" => $_POST['mt_local'],
        "mt_nationality" => $_POST['mt_nationality'],
        "mt_firstname" => $_POST['mt_firstname'],
        "mt_lastname" => $_POST['mt_lastname'],
        "mt_international_num" => $_POST['mt_international_num'],
        "mt_hp" => $_POST['mt_hp'],
        "mt_email" => $_POST['mt_email'],
        "mt_udate" => "now()",
        "mt_first_info" => "Y",
    );
    $DB->update_query("member_t", $arr, "idx = ".$_POST['mt_idx']);
    exit;
}


?>