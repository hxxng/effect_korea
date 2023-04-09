<?
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

if($_POST['act']=='membership_update') {
    unset($arr_query);
    $arr_query = array(
        "mt_status" => $_POST['mt_status'],
        "mt_edate" => $_POST['mt_edate'],
        "mt_udate" => "now()",
    );
    if($_POST['mt_status'] == 3) {
        $arr_query['mt_cdate'] = "now()";
    }
    $DB->update_query("membership_t", $arr_query, "idx = ".$_POST['idx']);

    p_alert("변경 내용으로 저장되었습니다!");
} else if($_POST['act']=='contents_update') {
    unset($arr_query);
    $arr_query = array(
        "ot_status" => $_POST['ot_status'],
        "ot_udate" => "now()",
    );
    if($_POST['ot_status'] == 3) {
        $arr_query['ot_cidate'] = "now()";
    }
    $DB->update_query("order_t", $arr_query, "ot_code = '".$_POST['ot_code']."'");
    $DB->update_query("cart_t", array("ct_status" => $_POST['ot_status'], "ct_udate" => "now()"), "ot_code = '".$_POST['ot_code']."'");

    p_alert("변경 내용으로 저장되었습니다!");
} else if($_POST['act']=='delete') {
    if($_POST['idx']) {
        if($_POST['type'] == "membership") {
            $table = "membership_t";
        } else {
            $table = "contents_payment_t";
        }
        $DB->del_query($table, " idx = '".$_POST['idx']."'");
        echo json_encode(array("result" => "ok", "msg" => "삭제되었습니다."));
    } else {
        echo json_encode(array("result" => "false", "msg" => "처리할 수 없습니다."));
    }
} else if($_POST['act'] == "del_img") {
    if($_POST['idx']) {
        if($_POST['type'] == "image") {
            $DB->update_query("main_category_t", array("mct_image" => null, "mct_udate" => "now()"), "idx = ".$_POST['idx']);
        } else {
            $DB->update_query("main_category_t", array("mct_video" => null, "mct_udate" => "now()"), "idx = ".$_POST['idx']);
        }
        @unlink($ct_img_dir_a . "/" . $_POST['name']);
        echo json_encode(array('result' => '_ok', 'msg'=>'삭제되었습니다.'));
    } else {
        echo json_encode(array('result' => 'false', 'msg'=>'삭제할 수 없습니다.'));
    }
} else if($_POST['act']=='chg_show') {
    if($_POST['idx']) {
        if($_POST['mct_show'] == "true") {
            $mct_show = "Y";
        } else {
            $mct_show = "N";
        }
        unset($arr_query);
        $arr_query = array(
            "mct_show" => $mct_show,
            "mct_udate" => "now()",
        );

        $where_query = "idx = '".$_POST['idx']."'";

        $DB->update_query('main_category_t', $arr_query, $where_query);

        echo json_encode(array("result" => "ok", "msg" => ""));
    } else {
        echo json_encode(array("result" => "false", "msg" => "처리할 수 없습니다."));
    }
}

include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>