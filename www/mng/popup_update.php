<?
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

if($_POST['act']=='input') {
    unset($arr_query);
    $arr_query = array(
        "pt_show" => "Y",
        "pt_url" => $_POST['pt_url'],
        "pt_sdate" => $_POST['pt_sdate'],
        "pt_edate" => $_POST['pt_edate'],
        "pt_wdate" => "now()",
    );
    $DB->insert_query("popup_t", $arr_query);
    $_last_pt_idx = $DB->insert_id();

    $temp_img_txt = "pt_file";
    $temp_img_on_txt = "pt_file_on";
    $temp_img_temp_on_txt = "pt_file_temp_on";
    $temp_img_del_txt = "pt_file_del";
    if($_FILES[$temp_img_txt]['name']) {
        $pt_file = $_FILES[$temp_img_txt]['tmp_name'];
        $pt_file_name = $_FILES[$temp_img_txt]['name'];
        $pt_file_size = $_FILES[$temp_img_txt]['size'];
        $pt_file_type = $_FILES[$temp_img_txt]['type'];

        if($pt_file_name!="") {
            @unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
            $_POST[$temp_img_on_txt] = "pt_file_".$_last_pt_idx.".".get_file_ext($pt_file_name);
            upload_file($pt_file, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
            thumnail_width($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000");
        }
    } else {
        if($_POST[$temp_img_del_txt]) {
            unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
        }
    }
    $arr_query_img['pt_file'] = $_POST['pt_file_on'];

    $DB->update_query('popup_t', $arr_query_img, "idx = ".$_last_pt_idx);

    p_alert("저장되었습니다!", "./popup_list.php");
} else if($_POST['act']=='update') {
    unset($arr_query);
    unset($arr_query);
    $arr_query = array(
        "pt_url" => $_POST['pt_url'],
        "pt_sdate" => $_POST['pt_sdate'],
        "pt_edate" => $_POST['pt_edate'],
        "pt_udate" => "now()",
    );
    $DB->update_query("popup_t", $arr_query, "idx = ".$_POST['idx']);

    $temp_img_txt = "pt_file";
    $temp_img_on_txt = "pt_file_on";
    $temp_img_temp_on_txt = "pt_file_temp_on";
    $temp_img_del_txt = "pt_file_del";
    if($_FILES[$temp_img_txt]['name']) {
        $pt_file = $_FILES[$temp_img_txt]['tmp_name'];
        $pt_file_name = $_FILES[$temp_img_txt]['name'];
        $pt_file_size = $_FILES[$temp_img_txt]['size'];
        $pt_file_type = $_FILES[$temp_img_txt]['type'];

        if($pt_file_name!="") {
            @unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
            $_POST[$temp_img_on_txt] = "pt_file_".$_POST['idx'].".".get_file_ext($pt_file_name);
            upload_file($pt_file, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
            thumnail_width($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000");
        }
    } else {
        if($_POST[$temp_img_del_txt]) {
            unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
        }
    }
    $arr_query_img['pt_file'] = $_POST['pt_file_on'];

    $DB->update_query('popup_t', $arr_query_img, "idx = ".$_POST['idx']);

    p_alert("변경 내용으로 저장되었습니다!");
} else if($_POST['act']=='delete') {
    if($_POST['idx']) {
        $query = "select * from popup_t where idx = ".$_POST['idx'];
        $row = $DB->fetch_assoc($query);
        if($row) {
            @unlink($ct_img_dir_a . "/" . $row['pt_file']);
            $DB->del_query('popup_t', " idx = '".$_POST['idx']."'");
            echo json_encode(array("result" => "ok", "msg" => "삭제되었습니다."));
        } else {
            echo json_encode(array("result" => "false", "msg" => "처리할 수 없습니다."));
        }
    } else {
        echo json_encode(array("result" => "false", "msg" => "처리할 수 없습니다."));
    }
} else if($_POST['act'] == "del_img") {
    if($_POST['idx']) {
        $DB->update_query("popup_t", array("pt_file" => null, "pt_udate" => "now()"), "idx = ".$_POST['idx']);
        @unlink($ct_img_dir_a . "/" . $_POST['name']);
        echo json_encode(array('result' => '_ok', 'msg'=>'삭제되었습니다.'));
    } else {
        echo json_encode(array('result' => 'false', 'msg'=>'삭제할 수 없습니다.'));
    }
} else if($_POST['act']=='chg_show') {
    if($_POST['idx']) {
        if($_POST['pt_show'] == "true") {
            $bt_show = "Y";
        } else {
            $bt_show = "N";
        }
        unset($arr_query);
        $arr_query = array(
            "pt_show" => $bt_show,
            "pt_udate" => "now()",
        );

        $where_query = "idx = '".$_POST['idx']."'";

        $DB->update_query('popup_t', $arr_query, $where_query);

        echo json_encode(array("result" => "ok", "msg" => ""));
    } else {
        echo json_encode(array("result" => "false", "msg" => "처리할 수 없습니다."));
    }
}

include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>