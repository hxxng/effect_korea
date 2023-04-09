<?
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

if($_POST['act']=='input') {
    unset($arr_query);
    $arr_query = array(
        "bt_language" => $_POST['bt_language'],
        "bt_contents" => $_POST['bt_contents'],
        "bt_wdate" => "now()",
    );
    if($_POST['type'] == "main") {
        $arr_query['bt_main'] = "Y";
        $url = "./banner_main_list.php";
    } else {
        $arr_query['bt_main'] = "N";
        if($_POST['type'] == "1") {
            $url = "./banner_ads1_list.php";
        } else {
            $url = "./banner_ads2_list.php";
        }
        $arr_query['bt_type'] = $_POST['type'];
    }
    $DB->insert_query("banner_t", $arr_query);
    $_last_pt_idx = $DB->insert_id();

    $temp_img_txt = "bt_file";
    $temp_img_on_txt = "bt_file_on";
    $temp_img_temp_on_txt = "bt_file_temp_on";
    $temp_img_del_txt = "bt_file_del";
    if($_FILES[$temp_img_txt]['name']) {
        $bt_file = $_FILES[$temp_img_txt]['tmp_name'];
        $bt_file_name = $_FILES[$temp_img_txt]['name'];
        $bt_file_size = $_FILES[$temp_img_txt]['size'];
        $bt_file_type = $_FILES[$temp_img_txt]['type'];

        if($bt_file_name!="") {
            @unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
            $_POST[$temp_img_on_txt] = "bt_file_".$_last_pt_idx.".".get_file_ext($bt_file_name);
            upload_file($bt_file, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
            //thumnail($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            //scale_image_fit($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            thumnail_width($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000");
        }
    } else {
        if($_POST[$temp_img_del_txt]) {
            unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
        }
    }
    $arr_query_img['bt_file'] = $_POST['bt_file_on'];

    $DB->update_query('banner_t', $arr_query_img, "idx = ".$_last_pt_idx);

    p_alert("변경 내용으로 저장되었습니다!", $url);
} else if($_POST['act']=='update') {
    unset($arr_query);
    $arr_query = array(
        "bt_language" => $_POST['bt_language'],
        "bt_contents" => $_POST['bt_contents'],
        "bt_udate" => "now()",
    );
    $DB->update_query("banner_t", $arr_query, "idx = ".$_POST['idx']);

    $temp_img_txt = "bt_file";
    $temp_img_on_txt = "bt_file_on";
    $temp_img_temp_on_txt = "bt_file_temp_on";
    $temp_img_del_txt = "bt_file_del";
    if($_FILES[$temp_img_txt]['name']) {
        $bt_file = $_FILES[$temp_img_txt]['tmp_name'];
        $bt_file_name = $_FILES[$temp_img_txt]['name'];
        $bt_file_size = $_FILES[$temp_img_txt]['size'];
        $bt_file_type = $_FILES[$temp_img_txt]['type'];

        if($bt_file_name!="") {
            @unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
            $_POST[$temp_img_on_txt] = "bt_file_".$_POST['idx'].".".get_file_ext($bt_file_name);
            upload_file($bt_file, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
            //thumnail($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            //scale_image_fit($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            thumnail_width($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000");
        }
    } else {
        if($_POST[$temp_img_del_txt]) {
            unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
        }
    }
    $arr_query_img['bt_file'] = $_POST['bt_file_on'];

    $DB->update_query('banner_t', $arr_query_img, "idx = ".$_POST['idx']);

    p_alert("변경 내용으로 저장되었습니다!");
} else if($_POST['act']=='delete') {
    if($_POST['idx']) {
        $query = "select * from banner_t where idx = ".$_POST['idx'];
        $row = $DB->fetch_assoc($query);
        if($row) {
            @unlink($ct_img_dir_a . "/" . $row['bt_file']);
            $DB->del_query('banner_t', " idx = '".$_POST['idx']."'");
            echo json_encode(array("result" => "ok", "msg" => "삭제되었습니다."));
        } else {
            echo json_encode(array("result" => "false", "msg" => "처리할 수 없습니다."));
        }
    } else {
        echo json_encode(array("result" => "false", "msg" => "처리할 수 없습니다."));
    }
} else if($_POST['act'] == "del_img") {
    if($_POST['idx']) {
        $DB->update_query("banner_t", array("bt_file" => null, "bt_udate" => "now()"), "idx = ".$_POST['idx']);
        @unlink($ct_img_dir_a . "/" . $_POST['name']);
        echo json_encode(array('result' => '_ok', 'msg'=>'삭제되었습니다.'));
    } else {
        echo json_encode(array('result' => 'false', 'msg'=>'삭제할 수 없습니다.'));
    }
} else if($_POST['act']=='chg_show') {
    if($_POST['idx']) {
        if($_POST['bt_show'] == "true") {
            $bt_show = "Y";
        } else {
            $bt_show = "N";
        }
        unset($arr_query);
        $arr_query = array(
            "bt_show" => $bt_show,
            "bt_udate" => "now()",
        );

        $where_query = "idx = '".$_POST['idx']."'";

        $DB->update_query('banner_t', $arr_query, $where_query);

        echo json_encode(array("result" => "ok", "msg" => ""));
    } else {
        echo json_encode(array("result" => "false", "msg" => "처리할 수 없습니다."));
    }
}

include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>