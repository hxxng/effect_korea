<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/Membership_class.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/http.class.php";

if($_SESSION['_mt_idx'] < 1){
	echo json_encode(array('result' => '_false', 'msg' => '로그인 후 시도해 주세요.'));
	exit;	
}

$PAYPAL_CLIENT_ID = "PAYPAL_CLIENT_ID";
$PAYPAL_SECRET = "PAYPAL_SECRET";

if($_POST['type'] == "create_plan") {
    $http = new http;

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

    //상품 리스트
    $header = array(
        "Content-Type: application/json",
        "Authorization: Bearer ".$token,
    );

    $ch = curl_init();

    curl_setopt($ch,CURLOPT_URL, "https://api-m.sandbox.paypal.com/v1/catalogs/products?page_size=4&page=1&total_required=true");
    curl_setopt($ch,CURLOPT_HTTPHEADER, $header );
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

    $result = curl_exec($ch);

    curl_close($ch);

    $list = json_decode($result, true);
    $list2 = $list['products'];

    if($_POST['mt_type'] == 1) {
        $name = "월간 베이직";
        $interval_count = 1;
    } else if($_POST['mt_type'] == 2) {
        $name = "연간 베이직";
        $interval_count = 12;
    } else if($_POST['mt_type'] == 3){
        $name = "월간 프리미엄";
        $interval_count = 1;
    } else {
        $name = "연간 프리미엄";
        $interval_count = 12;
    }

    if($list2) {
        foreach ($list2 as $row) {
            if($row['name'] == $name) {
                $product_id = $row['id'];
                break;
            }
        }
    }

    //상품 등록
//    $query['name'] = "연간 프리미엄";
//    $query['type'] = "DIGITAL";
//
//    $header = array(
//        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
//        "Accept-Language: ja,en-US;q=0.8,en;q=0.6",
//        "Accept-Charset: Shift_JIS,utf-8;q=0.7,*;q=0.3",
//        "Content-Type: application/json",
//        "Authorization: Bearer ".$token,
//    );
//
//    $url = "https://api-m.sandbox.paypal.com/v1/catalogs/products";
//
//    $fields_string = json_encode($query, true);
//
//    $ch = curl_init();
//    curl_setopt($ch,CURLOPT_URL, $url);
//    curl_setopt($ch,CURLOPT_HTTPHEADER, $header);
//    curl_setopt($ch,CURLOPT_POST, 1);
//    curl_setopt($ch,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
//    curl_setopt($ch,CURLOPT_POST, true);
//    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
//    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
//    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//
//    $result = curl_exec($ch);
//
//    curl_close($ch);
//
//    $array = json_decode($result, true);
//
//    print_r($array);
//    exit;

    //하루 뒤로 웹훅 테스트
    $query['billing_cycles'] = array(
        array(
//            "frequency" => array("interval_unit" => "MONTH", "interval_count" => $interval_count),
            "frequency" => array("interval_unit" => "DAY", "interval_count" => 1),
            "sequence" => 1,
            "tenure_type" => "REGULAR",
            "pricing_scheme" => array("fixed_price" => array("value" => $_POST['amount'], "currency_code" => "USD")),
        ));
    $query['name'] = $name;
    $query['payment_preferences'] = array(
        "auto_bill_outstanding" => true,
        "setup_fee" => array(
            "value" => $_POST['amount'],
            "currency_code" => "USD"
        ),
        "setup_fee_failure_action" => "CONTINUE",
        "payment_failure_threshold" => 3,
    );
    $query['product_id'] = $product_id;

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

    $result = curl_exec($ch);

    curl_close($ch);

    $array = json_decode($result, true);
//    print_r($array);

    $objPayment = new Membership_class(array('db' => $DB, 'mt_idx' => $_SESSION['_mt_idx'], 'act' => $_POST['act']));
    $result = $objPayment->before($_POST, $array['id']);
    if ($result['result'] == 'true') {
        echo json_encode($array['id']);
    } else {
        if ($result['key'] == 'member') $msg = '회원 정보가 없습니다.';
        if ($result['key'] == 'content') $msg = '콘텐츠 정보가 없습니다.';
        if ($result['key'] == 'payment') $msg = '결제 실패되었습니다.';
        echo json_encode(array(""));
    }

    //구독 취소
//    $header = array(
//        "Content-Type: application/json",
//        "Authorization: Bearer ".$token,
//    );
//
//    $ch = curl_init();
//
//    curl_setopt($ch,CURLOPT_URL, "https://api-m.sandbox.paypal.com/v1/billing/plans/I-PDV7D79T0NUH/deactivate");
//    curl_setopt($ch,CURLOPT_HTTPHEADER, $header );
//    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
//    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//
//    $result = curl_exec($ch);
//
//    curl_close($ch);
//
//    $array = json_decode($result, true);
//
//    print_r($array);
//    exit;
} else {
    $objPayment = new Membership_class(array('db' => $DB, 'mt_idx' => $_SESSION['_mt_idx'], 'act' => $_POST['act']));
    $result = $objPayment->before($_POST, "");
    if ($result['result'] == 'true') {
        echo json_encode(array('result' => '_true', 'data_arr' => $result['data']));
        exit;
    } else {
        if ($result['key'] == 'member') $msg = '회원 정보가 없습니다.';
        if ($result['key'] == 'content') $msg = '콘텐츠 정보가 없습니다.';
        if ($result['key'] == 'payment') $msg = '결제 실패되었습니다.';
        echo json_encode(array('result' => '_false', 'msg' => $msg));
        exit;
    }
}
?>