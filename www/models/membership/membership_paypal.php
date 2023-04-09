<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/Membership_class.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/http.class.php";
$result = array("code"=>200, "message"=>"success");

$PAYPAL_CLIENT_ID = "PAYPAL_CLIENT_ID";
$PAYPAL_SECRET = "PAYPAL_SECRET";

$data = json_decode(file_get_contents('php://input'), true);
$objPayment = new Membership_class(array('db' => $DB, 'act' => $merchant_arr[0]));
$http = new http;
try {
    if ($data['status'] == "ACTIVE") {
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

        $query = "SELECT * FROM membership_t where mt_plan_id = '" . $data['id'] . "' and mt_customer_uid = '' and mt_customer_uid is null order by idx desc";
        $list = $DB->fetch_assoc($query);

        if($list['mt_type'] == 1 || $list['mt_type'] == 3) {
            $next_date = date("Y-m-d H:i:s", strtotime("+1 months", strtotime($now)));
            $next_date2 = strtotime("+1 months", strtotime($now));
        } else {
            $next_date = date("Y-m-d H:i:s", strtotime("+12 months", strtotime($now)));
            $next_date2 = strtotime("+12 months", strtotime($now));
        }

        $now = date('Y-m-d H:i:s', time());

        //가입 내역 있으면 나중에 정기결제 시 인서트되게
        $query = "select * from membership_t where mt_plan_id = '".$list['mt_plan_id']."' 
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
                'mt_idx' => $list2["mt_idx"],
                'mt_status' => 2,
                'mt_membership' => $name,
                'mt_price' => $amount,
                'mt_plan_id' => $data['id'],
                'mt_pdate' => date('Y-m-d H:i:s', strtotime($now)),
                'mt_edate' => $next_date,
                'mt_wdate' => $now,
                'mt_next_pdate' => $next_date,
                'mt_payment' => '2',
            );
            $result_pay = $DB->insert_query("membership_t", $set);
        }
        if ($result_pay == 'false') $result = ['code' => '', 'message' => 'update 실패되었습니다.'];
        //결제 세부정보
        $header = array(
            "Content-Type: application/json",
            "Authorization: Bearer ".$token,
        );

        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL, "https://api-m.sandbox.paypal.com/v1/billing/plans/".$data['id']);
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

        $DB->insert_query("zzz", array("pagename" => $_SERVER['PHP_SELF'], "contents" => json_encode($getPaymentDataJson), "remoteip" => $_SERVER['REMOTE_ADDR'], "regdate" => "now()"));

        if ($status == "ACTIVE") {
            //하루 뒤로 웹훅 테스트
            $query['billing_cycles'] = array(
                array(
//            "frequency" => array("interval_unit" => "MONTH", "interval_count" => $interval_count),
                    "frequency" => array("interval_unit" => "DAY", "interval_count" => 1),
                    "sequence" => 1,
                    "tenure_type" => "REGULAR",
                    "pricing_scheme" => array("fixed_price" => array("value" => $amount, "currency_code" => "USD")),
                ));
            $query['name'] = $data['name'];
            $query['payment_preferences'] = array(
                "auto_bill_outstanding" => true,
                "setup_fee" => array(
                    "value" => $amount,
                    "currency_code" => "USD"
                ),
                "setup_fee_failure_action" => "CONTINUE",
                "payment_failure_threshold" => 3,
            );
            $query['product_id'] = $data['product_id'];

            $header = array(
                "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
                "Accept-Language: ja,en-US;q=0.8,en;q=0.6",
                "Accept-Charset: Shift_JIS,utf-8;q=0.7,*;q=0.3",
                "Content-Type: application/json",
                "Authorization: Bearer ".$token,
            );

            $url = "https://api-m.sandbox.paypal.com/v1/billing/plans";

            $fields_string = json_encode($query, true);

            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch,CURLOPT_POST, 1);
            curl_setopt($ch,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
            curl_setopt($ch,CURLOPT_POST, true);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

            $result2 = curl_exec($ch);

            curl_close($ch);

//            $array = json_decode($result2, true);

//            $DB->update_query("membership_t", array("mt_plan_id" => "merchant_uid_" . time()), " mt_plan_id = '" . $data['id'] . "'");
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