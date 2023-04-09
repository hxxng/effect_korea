<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/Membership_class.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/http.class.php";
$result = array("code"=>200, "message"=>"success");

$data = json_decode(file_get_contents('php://input'), true);
$objPayment = new Membership_class(array('db' => $DB, 'act' => $merchant_arr[0]));
$http = new http;
try {
    if ($data['status'] == "paid") {
        $query['imp_key'] = $imp_key;
        $query['imp_secret'] = $imp_secret;
        $getToken = $http->PostMethodData('https://api.iamport.kr/users/getToken', $query, $mReferer, '', $mCookie, true);
        $getTokenJson = json_decode($getToken, true);
        $access_token = $getTokenJson['response']['access_token'];

        $query = "SELECT * FROM membership_t where mt_pg_pg_tid = '" . $data['imp_uid'] . "' and mt_customer_uid <> '' order by idx desc";
        $list = $DB->fetch_assoc($query);

        $getPaymentData = $http->GetMethodData('https://api.iamport.kr/payments/' . $data['imp_uid'], '', '', '', true, '', $access_token);
        $getPaymentDataJson = json_decode($getPaymentData, true);

        //아임포트에 요청한 실제 결제 정보
        $responseData = $getPaymentDataJson['response'];
        //아임포트 결제 상태 값 (paid가 정상 결제 된 값)
        $iamport_status = $responseData['status'];

        $now = date('Y-m-d H:i:s', time());
        if($list['mt_type'] == 1 || $list['mt_type'] == 3) {
            $next_date = date("Y-m-d H:i:s", strtotime("+1 months", strtotime($now)));
            $next_date2 = strtotime("+1 months", strtotime($now));
        } else {
            $next_date = date("Y-m-d H:i:s", strtotime("+12 months", strtotime($now)));
            $next_date2 = strtotime("+12 months", strtotime($now));
        }
        $name = explode(" ", $responseData['name']);
        $mt_idx = explode("_", $responseData['customer_uid']);
        $amount = $responseData['amount'];

        //가입 내역 있으면 나중에 정기결제 시 인서트되게
        $query = "select * from membership_t where mt_customer_uid = '".$list['cpt_customer_uid']."' 
        and mt_status = 2 and DATE_FORMAT(mt_pdate, '%Y-%m-%d') = DATE_FORMAT('".$now."', '%Y-%m-%d') order by idx desc ";
        $list2 = $DB->fetch_assoc($query);
        if(date("Y-m-d", strtotime($now)) == date("Y-m-d", strtotime($list2['mt_next_pdate'])))
        {
            if($list2['mt_type'] == 1) {
                $name = "월간 베이직";
                $amount = 30000;
            } else if($list2['mt_type'] == 2) {
                $name = "연간 베이직";
                $amount = 252000;
            } else if($list2['mt_type'] == 3){
                $name = "월간 프리미엄";
                $amount = 150000;
            } else {
                $name = "연간 프리미엄";
                $amount = 1260000;
            }
            $set = array(
                'mt_idx' => $mt_idx[1],
                'mt_status' => 2,
                'mt_membership' => $name,
                'mt_price' => $amount,
                'mt_pg_pg_tid' => $responseData['imp_uid'],
                'mt_pg_apply_num' => $responseData['pg_tid'],
                'mt_pg_card_name' => $responseData['card_name'],
                'mt_pdate' => date('Y-m-d H:i:s', strtotime($now)),
                'mt_edate' => $next_date,
                'mt_wdate' => $now,
                'mt_next_pdate' => $next_date,
                'mt_payment' => ($responseData['pay_method'] == 'card') ? '2' : '3',
                'mt_customer_uid' => $responseData['customer_uid'],
                'mt_merchant_uid' => "merchant_uid_" . time(),
            );
            $result_pay = $DB->insert_query("membership_t", $set);
        }
        if ($result_pay == 'false') $result = ['code' => '', 'message' => 'update 실패되었습니다.'];
        if ($iamport_status == "paid") {
            $data = ['customer_uid' => $responseData['customer_uid']];
            $data['schedules'] =
                [[
                    'merchant_uid' => "merchant_uid_" . time(),
                    'schedule_at' => $next_date2,
                    'amount' => $amount,
                    'name' => $responseData['name'],
                    'buyer_name' => $responseData['buyer_name'],
                    'buyer_tel' => $responseData['buyer_tel'],
                    'buyer_email' => $responseData['buyer_email'],
                ]];

            $getPaymentData2 = $objPayment->PostMethodData2('https://api.iamport.kr/subscribe/payments/schedule', $data, $mReferer, '', $mCookie, true, '', $access_token);
            $getPaymentDataJson2 = json_decode($getPaymentData2, true);

            $DB->update_query("membership_t", array("mt_merchant_uid" => "merchant_uid_" . time()), " mt_pg_pg_tid = '" . $data['imp_uid'] . "'");
        }
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