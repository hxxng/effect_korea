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

        $data = array(
            'customer_uid' => $list['cpt_customer_uid'],
            'merchant_uid' => $list['cpt_merchant_uid'],
        );

        //예약취소
        $getPaymentData = $objPayment->PostMethodData('https://api.iamport.kr/subscribe/payments/unschedule', $data, $mReferer, '', $mCookie, true, '', $access_token);

        $getPaymentData = $http->GetMethodData('https://api.iamport.kr/payments/'.$list['cpt_pg_pg_tid'], $mReferer, '', $mCookie, true, '', $access_token);
        $getPaymentDataJson = json_decode($getPaymentData, true);

        //아임포트에 요청한 실제 결제 정보
        $responseData = $getPaymentDataJson['response'];

        if($responseData['amount'] == 0) {      //첫 달 무료
            $cpt_name = "멤버십 구독 취소";
        } else {
            if($responseData['amount'] > 4000) {
                $cpt_name = "프리미엄 구독 취소";
            } else {
                $cpt_name = "멤버십 구독 취소";
            }
        }

        //결제 취소(환불)
        $query = "select * from contents_play_log_t where mt_idx = ".$_POST['mt_idx']." and (cplt_wdate >= DATE_ADD(NOW(), INTERVAL -7 DAY ) and cplt_wdate <= now())";
        $count = $DB->count_query($query);
        if($count > 0) {
            $amount = $responseData['amount'] / 2;
        } else {
            $amount = "";
        }

        $data2 = array(
            'imp_uid' => $list['cpt_pg_pg_tid'],
            'merchant_uid' => $list['cpt_merchant_uid'],
            'amount' => $amount,
            'reason' => $_POST['reason'],
        );
        $getPaymentData2 = $objPayment->PostMethodData('https://api.iamport.kr/payments/cancel', $data2, $mReferer, '', $mCookie, true, '', $access_token);
        $getPaymentDataJson2 = json_decode($getPaymentData2, true);

        $now = date('Y-m-d H:i:s', time());
        $next_date = date("Y-m-d H:i:s", strtotime("+1 months", strtotime($now)));

        $name = explode(" ", $responseData['name']);
        $set = array();
        $mt_idx = explode("_", $list['cpt_customer_uid']);
        $set = array(
            'mt_idx' => $mt_idx[1],
            'cpt_state' => 3,
            'cpt_type' => 1,
            'cpt_name' => $cpt_name,
            'cpt_price' => $responseData['amount'],
            'cpt_method' => $list['cpt_method'],
            'cpt_cancel_price' => $amount,
            'cpt_wdate' => $now,
            'cpt_cdate' => $now,
            'cpt_customer_uid' =>  $list['cpt_customer_uid'],
        );
        $DB->update_query("member_t", array("mt_grade" => 1), " idx = ".$mt_idx[1]);
        $result_pay = $DB->insert_query("contents_payment_t", $set);
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