<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/Payment_class.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/http.class.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/Point_class.php";
$result = ["code"=>200, "message"=>"success"];

$imp_uid = $_REQUEST['imp_uid'];
$merchant_arr = explode('_', $_REQUEST['merchant_uid']);
$merchant_uid = end($merchant_arr);

$objPayment = new Payment_class(array('db'=>$DB, 'act'=>$merchant_arr[0]));
$http = new http;
try{
	/*주문서조회*/
	$payment_row = $objPayment->select_payment($merchant_uid);   
	
	/*
	 * 결제성공한 건에 대해서는 merchant_uid로 아임포트 API 통신을해야 한다.
	 * api access_key를 얻기위해 아임포트에서 제공되는 imp_key,imp_secret을 이용하여
	 * 아래 api로 token을 얻는다.
	 * return 값이 json이므로 decode하여 원하는 값을 들고온다.
	*/
	$query['imp_key'] = $imp_key;
	$query['imp_secret'] = $imp_secret;
	$getToken = $http->PostMethodData('https://api.iamport.kr/users/getToken', $query, $mReferer, '',$mCookie, true);

	$getTokenJson = json_decode($getToken, true);
	$access_token = $getTokenJson['response']['access_token'];

	$getPaymentData = $http->GetMethodData('https://api.iamport.kr/payments/'.$imp_uid, '', '', '', true, '', $access_token);
	$getPaymentDataJson = json_decode($getPaymentData,true);

	//아임포트에 요청한 실제 결제 정보
	$responseData = $getPaymentDataJson['response'];
	//아임포트 결제 상태 값 (paid가 정상 결제 된 값)
	$iamport_status = $responseData['status'];
	//아임포트 실제 결제 금액
	$iamport_amount = $responseData['amount'];            
	
	$pay_arr = array();
	//결제 내역 테이블 update
	if($iamport_status=='paid'){	//성공
        $pay_arr['ot_pg_pg_tid'] = $responseData['imp_uid'];   //PG사 거래고유번호
        $pay_arr['ot_pg_apply_num'] = $responseData['pg_tid']; //카드사 승인번호
        $pay_arr['ot_pg_card_name'] = $responseData['card_name'];  //카드명
        $pay_arr['ot_pdate'] = date('Y-m-d H:i:s', $responseData['started_at']);
        $pay_arr['ot_code'] = $merchant_uid;
        $pay_arr['ot_pay_type'] = ($responseData['pay_method']=='card') ? '2':'1';	//2신용카드, 3계좌이체
        $pay_arr['ot_price'] = $iamport_amount;
		$result_pay = $objPayment->success($pay_arr);
		if($result_pay=='false') $result = ['code'=> '', 'message' => 'update 실패되었습니다.'];
	}
}catch(Exception $e){
    $result = [
        'code' => 410,
        'message' => $e->getMessage()
    ];
}
if($chk_mobile===false){
	echo json_encode($result);
	exit;
}else{
	if($iamport_status=='paid'){	//성공
        $row = $DB->fetch_query("select * from order_t where ot_code='".$merchant_uid."'");
        $cart_info = $DB->select_query("select *, cart_t.idx as ct_idx from cart_t left join contents_t on(cart_t.pt_idx = contents_t.idx) 
                               where cart_t.mt_idx=".$_SESSION['_mt_idx']." and cart_t.ct_select=1 and cart_t.ct_status=0");
        $order_ar = array();
        $order_arr['ot_pdate'] = date('Y-m-d H:i:s');
        if($DB->update_query('order_t', $order_arr, " ot_code = '".$merchant_uid."'")){
            foreach($cart_info as $row){
                $DB->update_query('cart_t', array('ot_code'=>$merchant_uid, 'ct_select'=> 2, 'ct_status'=>2), "idx = ".$row['ct_idx']);
            }
        }

        $url = "/order_complete.php?ot_code=".$merchant_uid;
		p_gotourl("/order_success.php");
	}else{
		p_alert('결제가 취소되었습니다.', '/');
	}
}

?>