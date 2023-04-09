<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/Membership_class.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/http.class.php";
$result = array("code"=>200, "message"=>"success");

$imp_key = "imp_key";
$imp_secret = "imp_secret";

$objPayment = new Membership_class(array('db' => $DB, 'act' => $merchant_arr[0]));
$http = new http;
try {
    $sql_query = "select * from contents_payment_t where mt_idx = ".$_POST['mt_idx']." and cpt_state = 2 and cpt_customer_uid = 'customer_".$_POST['mt_idx']."' order by idx desc";
    $list = $DB->fetch_assoc($sql_query);

    if($list['cpt_customer_uid'] != "") {
        $query['imp_key'] = $imp_key;
        $query['imp_secret'] = $imp_secret;
        $getToken = $http->PostMethodData('https://api.iamport.kr/users/getToken', $query, $mReferer, '', $mCookie, true);
        $getTokenJson = json_decode($getToken, true);
        $access_token = $getTokenJson['response']['access_token'];

        $data2 = array(
            'customer_uid' => $list['cpt_customer_uid'],
            'merchant_uid' => $list['cpt_merchant_uid'],
        );

        //예약되있던 결제 예약취소
        $getPaymentData = $objPayment->PostMethodData('https://api.iamport.kr/subscribe/payments/unschedule', $data2, $mReferer, '', $mCookie, true, '', $access_token);

        $query = "select from contents_payment_t where mt_idx = ".$_POST['mt_idx']." and cpt_price = 0 and instr(cpt_name, '무료') order by idx desc";
        $count = $DB->count_query($query);

        if($_POST['pay_type'] == "멤버십") {
            if($count > 0) {
                $amount = 4000;
                $cpt_name = date("m", time()) . "월 멤버십 구독 결제";
            } else {
                $amount = 0;         //첫 달 무료
                $cpt_name = "첫 달 무료 멤버십 가입";
            }
        } else {
            $amount = 7900;
            $cpt_name = date("m", time()) . "월 프리미엄 구독 결제";
        }

        $query = "select * from member_t where idx = ".$_POST['mt_idx'];
        $member_info = $DB->fetch_assoc($query);

        //다른 등급 결제 예약
        $data = ['customer_uid' => $list['cpt_customer_uid']];
        $data['schedules'] =
            [[
                'merchant_uid' => "merchant_uid_" . time(),
                'schedule_at' => strtotime($list['cpt_wdate']) + 2592000,
                'amount' => $amount,
                'name' => $cpt_name,
                'buyer_name' => $member_info['mt_nickname'],
                'buyer_tel' => $member_info['mt_tel'],
                'buyer_email' => $member_info['mt_id'],
            ]];
        $getPaymentData2 = $objPayment->PostMethodData2('https://api.iamport.kr/subscribe/payments/schedule', $data, $mReferer, '', $mCookie, true, '', $access_token);
        $getPaymentDataJson2 = json_decode($getPaymentData2, true);


    } else {
        $result = array("code"=>0, "message"=>"false", "msg"=>"취소할 주문이 없습니다.");
    }
} catch (Exception $e) {
    $result = [
        'code' => 410,
        'message' => $e->getMessage()
    ];
}

echo json_encode($result);
exit;

?>