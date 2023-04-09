<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/Membership_class.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/http.class.php";
$result2 = array("code"=>200, "message"=>"success");

if($_POST['type'] == "imp") {
    $imp_uid = $_POST['imp_uid'];
    $customer_arr = explode('_', $_POST['customer_uid']);
    $customer_uid = end($customer_arr);
    $merchant_arr = explode('_', $_POST['merchant_uid']);
    $merchant_uid = end($merchant_arr);

    $objPayment = new Membership_class(array('db' => $DB, 'act' => "content"));
    $http = new http;
    try {
        $query['imp_key'] = $imp_key;
        $query['imp_secret'] = $imp_secret;
        $getToken = $http->PostMethodData('https://api.iamport.kr/users/getToken', $query, $mReferer, '', $mCookie, true);

        $getTokenJson = json_decode($getToken, true);
        $access_token = $getTokenJson['response']['access_token'];

        $getPaymentData = $http->GetMethodData('https://api.iamport.kr/payments/' . $imp_uid, '', '', '', true, '', $access_token);
        $getPaymentDataJson = json_decode($getPaymentData, true);

        //아임포트에 요청한 실제 결제 정보
        $responseData = $getPaymentDataJson['response'];
        //아임포트 결제 상태 값 (paid가 정상 결제 된 값)
        $iamport_status = $responseData['status'];
        //아임포트 실제 결제 금액
        $iamport_amount = $responseData['amount'];

        $now = date('Y-m-d H:i:s', time());
        $pay_arr = array();
        //결제 내역 테이블 update
        if ($iamport_status == 'paid') {    //성공
            $pay_arr['mt_pg_pg_tid'] = $responseData['imp_uid'];
            $pay_arr['mt_pg_apply_num'] = $responseData['pg_tid'];
            $pay_arr['mt_pg_card_name'] = $responseData['card_name'];
            $pay_arr['mt_pdate'] = date('Y-m-d H:i:s', $responseData['started_at']);
            if ($_POST['mt_type'] == 1 || $_POST['mt_type'] == 3) {
                $next_date = date("Y-m-d H:i:s", strtotime("+1 months", strtotime($now)));
            } else {
                $next_date = date("Y-m-d H:i:s", strtotime("+12 months", strtotime($now)));
            }
            if($_POST['mt_type'] == 1) {
                $name = "월간 베이직";
            } else if($_POST['mt_type'] == 2) {
                $name = "연간 베이직";
            } else if($_POST['mt_type'] == 3){
                $name = "월간 프리미엄";
            } else {
                $name = "연간 프리미엄";
            }
            $pay_arr['mt_edate'] = $next_date;
            $pay_arr['mt_next_pdate'] = $next_date;
            $pay_arr['mt_status'] = 2;
            $pay_arr['mt_payment'] = 2;
            $pay_arr['mt_merchant_uid'] = "merchant_uid_" . time();
            $pay_arr['mt_customer_uid'] = $_POST['customer_uid'];
            $pay_arr['idx'] = $merchant_uid;
            $result_pay = $objPayment->success($pay_arr);

            if ($result_pay == 'false') $result2 = ['code' => '', 'message' => 'update 실패되었습니다.'];

            $query = "select * from member_t where idx = ".$_SESSION['_mt_idx'];
            $member = $DB->fetch_assoc($query);
            if($member['mt_level'] == 3) {
                $page = "my_subscription.php";
            } else {
                $page = "artist_my_subscription.php";
            }

            $DB->insert_query("pushnotification_log_t", array("plt_title" => "‘".$name."’가 구매되었습니다.", "plt_type" => 4, "op_idx" => $_SESSION['_mt_idx'], "plt_page" => $page, "plt_wdate" => "now()"));
        }

    } catch (Exception $e) {
        $result2 = [
            'code' => 410,
            'message' => $e->getMessage()
        ];
    }

    echo json_encode($result2);
    exit;
} else {
    $PAYPAL_CLIENT_ID = "PAYPAL_CLIENT_ID";
    $PAYPAL_SECRET = "PAYPAL_SECRET";

    $plan_id = $_POST['plan_id'];

    $objPayment = new Membership_class(array('db' => $DB, 'act' => "content"));
    $http = new http;
    try {
        //토큰 발급
        $header = array("Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
            "Accept-Language: ja,en-US;q=0.8,en;q=0.6",
            "Accept-Charset: Shift_JIS,utf-8;q=0.7,*;q=0.3",
            "Content-Type: application/json");

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
        curl_setopt($ch, CURLOPT_USERPWD, $PAYPAL_CLIENT_ID.":".$PAYPAL_SECRET);
        curl_setopt($ch,CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,"grant_type=client_credentials");

        $result = curl_exec($ch);

        curl_close($ch);

        $array = json_decode($result, true);
        $token = $array['access_token'];

        //결제 세부정보
        $header = array(
            "Content-Type: application/json",
            "Authorization: Bearer ".$token,
        );

        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL, "https://api-m.sandbox.paypal.com/v1/billing/plans/".$plan_id);
        curl_setopt($ch,CURLOPT_HTTPHEADER, $header );
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

        $result = curl_exec($ch);

        curl_close($ch);

        $getPaymentDataJson = json_decode($result, true);

        $status = $getPaymentDataJson['status'];
        $plan_id = $getPaymentDataJson['id'];

        $payment_preferences = $getPaymentDataJson['payment_preferences'];
        $amount = $payment_preferences['setup_fee']['value'];

        $now = date('Y-m-d H:i:s', time());
        $pay_arr = array();
        //결제 내역 테이블 update
        if ($status == 'ACTIVE') {    //성공
            $pay_arr['mt_plan_id'] = $plan_id;
            $pay_arr['mt_subscription_id'] = $_POST['subscriptionID'];
            $pay_arr['mt_pdate'] = $now;
            if ($_POST['mt_type'] == 1 || $_POST['mt_type'] == 3) {
                $next_date = date("Y-m-d H:i:s", strtotime("+1 months", strtotime($now)));
            } else {
                $next_date = date("Y-m-d H:i:s", strtotime("+12 months", strtotime($now)));
            }
            $pay_arr['mt_edate'] = $next_date;
            $pay_arr['mt_next_pdate'] = $next_date;
            $pay_arr['mt_status'] = 2;
            $pay_arr['mt_payment'] = 2;
            $query = "select * from membership_t where mt_plan_id = '".$plan_id."'";
            $row = $DB->fetch_assoc($query);
            if($row) {
                $pay_arr['idx'] = $row['idx'];
                $result_pay = $objPayment->success($pay_arr);
            } else {
                $result_pay = "false";
            }

            if ($result_pay == 'false') $result2 = ['code' => '', 'message' => 'update 실패되었습니다.'];
        }

    } catch (Exception $e) {
        $result2 = [
            'code' => 410,
            'message' => $e->getMessage()
        ];
    }

    echo json_encode($result2);
    exit;
}

?>