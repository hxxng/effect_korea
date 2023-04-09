<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/Mall_class.php";

$type = $_POST['type'];

if(!$_SESSION['_mt_idx'] || $_SESSION['_mt_idx']==''){
    echo json_encode(array('result'=>'_false', 'msg'=>'로그인이 필요한 기능입니다.'));
    exit;
}

if($type=='buy'){
    if(!$_POST['pt_idx'] || $_POST['pt_idx']==''){
        echo json_encode(array('result'=>'_false', 'msg'=>'상품 정보가 필요합니다.'));
        exit;
    }
    exit;
}

if($type=='insert'){
    if(!$_POST['ct_idx'] || $_POST['ct_idx']==''){
        echo json_encode(array('result'=>'_false', 'msg'=>'상품 정보가 필요합니다.'));
        exit;
    }
    $objMall = new Mall_class(array('db'=>$DB, 'mt_idx'=>$_SESSION['_mt_idx']));
    $set_arr = $_POST;
    $result = $objMall->cart($type, $set_arr);
    if($result===true){
        if($_POST['order_act']=='direct'){
            echo json_encode(array('result'=>'_ok'));
        }else{
            echo json_encode(array('result'=>'_ok'));
        }
    }else{
        if($result=='cart_ing'){
            echo json_encode(array('result'=>'_ok'));
        } else if($result=='same_cart') {
            echo json_encode(array('result'=>'_false', 'msg'=>'이미 장바구니에 담겨져 있습니다.'));
        } else{
            echo json_encode(array('result'=>'_false', 'msg'=>'잠시후 다시 시도해 주시거나 고객센터로 문의바랍니다.'));
        }
    }
    exit;
}

if($type=='delete') {
    $in_idx = substr($_POST['idx_arr'], 0, -1);
    if($DB->del_query("cart_t", "idx in (".$in_idx.")")){
        echo json_encode(array('result'=>'_ok', 'msg'=>'삭제 되었습니다.'));
    }else{
        echo json_encode(array('result'=>'_false', 'msg'=>'잠시후 다시 시도해 주시거나 고객센터로 문의바랍니다.'));
    }
    exit;
}

if($type=='cart_update'){
    $objMall = new Mall_class(array('db'=>$DB, 'mt_idx'=>$_SESSION['_mt_idx']));
    $in_idx = implode(',', $_POST['chk_box']);
    $query = "select * from cart_t where idx in (".$in_idx.") and mt_idx = ".$_SESSION['_mt_idx'];
    $list = $DB->select_query($query);

    $ot_code = get_ot_code();

    if($_POST['membership'] == "membership") {
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

        if($list) {
            $ct_price = 0;
            foreach ($list as $row) {
                $ct_price += $row['ct_price'];
                $query = "select *, (SELECT ct_name FROM category_t WHERE idx=ct_cate_idx2) as ct_name from contents_t where idx = ".$row['ct_idx'];
                $contents = $DB->fetch_assoc($query);
                if($contents) {
                    $title = $contents['ct_title'];
                }
            }
            if(count($list) > 1) {
                $txt = " 외 ".(count($list)-1)."개";
            }
            $field_arr = array();
            $field_arr['ot_code'] = $ot_code;
            $field_arr['mt_idx'] = $_SESSION['_mt_idx'];
            $field_arr['ot_pay_type'] = 6;
            $field_arr['ot_status'] = 2;
            $field_arr['ot_vat'] = $ct_price * 0.1;
            $field_arr['ot_price'] = $ct_price;	//상품가
            $field_arr['ot_wdate'] = date('Y-m-d H:i:s');	//등록일시
            $field_arr['ot_pdate'] = date('Y-m-d H:i:s');	//결제일시
            if($DB->insert_query("order_t", $field_arr)) {
                $query = "select * from member_t where idx = ".$_SESSION['_mt_idx'];
                $member = $DB->fetch_assoc($query);
                if($member['mt_level'] == 3) {
                    $page = "my_orderlist.php";
                } else {
                    $page = "artist_my_orderlist.php";
                }
                $DB->insert_query("pushnotification_log_t", array("plt_title" => "‘".$title.$txt."’를 구매하였습니다. 구매 후 2주간 다운로드가 가능합니다.", "plt_type" => 2, "op_idx" => $_SESSION['_mt_idx'], "plt_page" => $page, "plt_wdate" => "now()"));

                $DB->update_query("cart_t", array('ct_pdate'=> 'now()', 'ot_code'=>$ot_code, 'ct_select'=> 2, 'ct_status'=>2, 'ct_unit' => $ct_unit), "idx in (".$in_idx.")");

                echo json_encode(array("result" => "_ok"));
            }
        }
    } else {
        //선택필드 초기화
        $objMall->cart_reset();

        foreach($list as $row){
            $DB->update_query("cart_t", array('ct_select'=>'1', 'ct_select_wdate'=>"now()"), "idx = '".$row['idx']."'");
        }
        gotourl('/order.php');
    }
}

if($type == "cart_reset") {
    $objMall = new Mall_class(array('db'=>$DB, 'mt_idx'=>$_SESSION['_mt_idx']));
    $objMall->cart_reset();

    echo json_encode(array("result" => "_ok"));
}

if($type == "chk_membership") {     //바로구매 회원권 확인
    $query = "select * from membership_t where mt_status in (2,3) and mt_idx = ".$_SESSION['_mt_idx']." order by mt_pdate desc";
    $membership = $DB->fetch_assoc($query." limit 1");
    if($membership) {
        $query = "select * from contents_t where idx = ".$_POST['ct_idx'];
        $content = $DB->fetch_assoc($query);
        if($content) {
            if($membership['mt_status'] == 2) {
                if($membership['mt_type'] == 1 || $membership['mt_type'] == 2) {
                    //가입된 멤버십이 베이직일 때 => 4K, 드론, 타임랩스, 3D 일러스트 제외
                    if($content['ct_cate_idx2'] == 2 || $content['ct_cate_idx2'] == 9 || $content['ct_cate_idx2'] == 13 || $content['ct_cate_idx2'] == 18) {
                        echo json_encode(array("result" => "_false2"));
                    } else {
                        echo json_encode(array("result" => "_ok"));
                    }
                } else {
                    echo json_encode(array("result" => "_ok"));
                }
            } else {
                echo json_encode(array("result" => "_false"));
            }
        } else {
            echo json_encode(array("result" => "_false"));
        }
    } else{
        echo json_encode(array("result" => "_false"));
    }
}

if($type == "chk_membership2") {        //장바구니 회원권 확인
    $false2 = 0;
    $query = "select * from membership_t where mt_status in (2,3) and mt_idx = ".$_SESSION['_mt_idx']." order by mt_pdate desc";
    $membership = $DB->fetch_assoc($query." limit 1");
    if($membership) {
        if($_POST['ct_idx']) {
            $arr = explode(",",$_POST['ct_idx']);
            if($arr) {
                if(count($arr) > 2) {
                    foreach ($arr as $cart_idx) {
                        if($cart_idx) {
                            $query = "select * from cart_t where idx = ".$cart_idx;
                            $cart = $DB->fetch_assoc($query);
                            if($cart) {
                                $query = "select * from contents_t where idx = ".$cart['ct_idx'];
                                $content = $DB->fetch_assoc($query);
                                if($content) {
                                    if($membership['mt_status'] == 2) {
                                        if($membership['mt_type'] == 1 || $membership['mt_type'] == 2) {
                                            //가입된 멤버십이 베이직일 때 => 4K, 드론, 타임랩스, 3D 일러스트 제외
                                            if($content['ct_cate_idx2'] == 2 || $content['ct_cate_idx2'] == 9 || $content['ct_cate_idx2'] == 13 || $content['ct_cate_idx2'] == 18) {
                                                $false2++;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    if($false2 > 0) {
                        echo json_encode(array("result" => "_false2"));
                        exit;
                    } else {
                        echo json_encode(array("result" => "_ok"));
                        exit;
                    }
                }
            }
        }
    }
    echo json_encode(array("result" => "_false"));
    exit;
}

if($type == "del_order") {
    $data = explode(",", $_POST['ot_code']);
    if($data) {
        foreach ($data as $row) {
            $DB->update_query("order_t", array("ot_show" => 'N'), "ot_code = '".$row."'");
        }
        echo json_encode(array('result'=>'_ok', 'msg'=>'삭제 되었습니다.'));
    } else {
        echo json_encode(array('result'=>'_false', 'msg'=>'잠시후 다시 시도해 주시거나 고객센터로 문의바랍니다.'));
    }
    exit;
}
?>