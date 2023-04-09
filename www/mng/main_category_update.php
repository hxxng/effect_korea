<?
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

if($_POST['act']=='input') {
    $query = "select * from main_category_t";
    $count = $DB->count_query($query);
    if($count > 7) {
        p_alert("대표 카테고리는 최대 8개까지 등록가능합니다.", "./main_category_list.php");
        return false;
    }
    unset($arr_query);
    $arr_query = array(
        "ct_idx" => $_POST['ct_idx'],
        "mct_orderby" => $_POST['mct_orderby'],
        "mct_wdate" => "now()",
    );
    $DB->insert_query("main_category_t", $arr_query);
    $_last_pt_idx = $DB->insert_id();

    $temp_img_txt = "mct_image";
    $temp_img_on_txt = "mct_image_on";
    $temp_img_temp_on_txt = "mct_image_temp_on";
    $temp_img_del_txt = "mct_image_del";
    if($_FILES[$temp_img_txt]['name']) {
        $mct_image = $_FILES[$temp_img_txt]['tmp_name'];
        $mct_image_name = $_FILES[$temp_img_txt]['name'];
        $mct_image_size = $_FILES[$temp_img_txt]['size'];
        $mct_image_type = $_FILES[$temp_img_txt]['type'];

        if($mct_image_name!="") {
            @unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
            $_POST[$temp_img_on_txt] = "mct_image_".$_last_pt_idx.".".get_file_ext($mct_image_name);
            upload_file($mct_image, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
            //thumnail($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            //scale_image_fit($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            thumnail_width($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000");
        }
    } else {
        if($_POST[$temp_img_del_txt]) {
            unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
        }
    }
    $arr_query_img['mct_image'] = $_POST['mct_image_on'];

    $temp_img_txt = "mct_video";
    $temp_img_on_txt = "mct_video_on";
    $temp_img_temp_on_txt = "mct_video_temp_on";
    $temp_img_del_txt = "mct_video_del";
    if($_FILES[$temp_img_txt]['name']) {
        $mct_video = $_FILES[$temp_img_txt]['tmp_name'];
        $mct_video_name = $_FILES[$temp_img_txt]['name'];
        $mct_video_size = $_FILES[$temp_img_txt]['size'];
        $mct_video_type = $_FILES[$temp_img_txt]['type'];

        if($mct_video_name!="") {
            @unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
            $_POST[$temp_img_on_txt] = "mct_video_".$_last_pt_idx.".".get_file_ext($mct_video_name);
            upload_file($mct_video, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
            //thumnail($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            //scale_image_fit($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            thumnail_width($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000");
        }
    } else {
        if($_POST[$temp_img_del_txt]) {
            unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
        }
    }
    $arr_query_img['mct_video'] = $_POST['mct_video_on'];

    $DB->update_query('main_category_t', $arr_query_img, "idx = ".$_last_pt_idx);

    p_alert("변경 내용으로 저장되었습니다!", "./main_category_list.php");
} else if($_POST['act']=='update') {
    unset($arr_query);
    $arr_query = array(
        "ct_idx" => $_POST['ct_idx'],
        "mct_orderby" => $_POST['mct_orderby'],
        "mct_udate" => "now()",
    );
    $DB->update_query("main_category_t", $arr_query, "idx = ".$_POST['idx']);

    $temp_img_txt = "mct_image";
    $temp_img_on_txt = "mct_image_on";
    $temp_img_temp_on_txt = "mct_image_temp_on";
    $temp_img_del_txt = "mct_image_del";
    if($_FILES[$temp_img_txt]['name']) {
        $mct_image = $_FILES[$temp_img_txt]['tmp_name'];
        $mct_image_name = $_FILES[$temp_img_txt]['name'];
        $mct_image_size = $_FILES[$temp_img_txt]['size'];
        $mct_image_type = $_FILES[$temp_img_txt]['type'];

        if($mct_image_name!="") {
            @unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
            $_POST[$temp_img_on_txt] = "mct_image_".$_POST['idx'].".".get_file_ext($mct_image_name);
            upload_file($mct_image, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
            //thumnail($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            //scale_image_fit($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            thumnail_width($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000");
        }
    } else {
        if($_POST[$temp_img_del_txt]) {
            unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
        }
    }
    $arr_query_img['mct_image'] = $_POST['mct_image_on'];

    $temp_img_txt = "mct_video";
    $temp_img_on_txt = "mct_video_on";
    $temp_img_temp_on_txt = "mct_video_temp_on";
    $temp_img_del_txt = "mct_video_del";
    if($_FILES[$temp_img_txt]['name']) {
        $mct_video = $_FILES[$temp_img_txt]['tmp_name'];
        $mct_video_name = $_FILES[$temp_img_txt]['name'];
        $mct_video_size = $_FILES[$temp_img_txt]['size'];
        $mct_video_type = $_FILES[$temp_img_txt]['type'];

        if($mct_video_name!="") {
            @unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
            $_POST[$temp_img_on_txt] = "mct_video_".$_POST['idx'].".".get_file_ext($mct_video_name);
            upload_file($mct_video, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
            //thumnail($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            //scale_image_fit($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            thumnail_width($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000");
        }
    } else {
        if($_POST[$temp_img_del_txt]) {
            unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
        }
    }
    $arr_query_img['mct_video'] = $_POST['mct_video_on'];

    $DB->update_query('main_category_t', $arr_query_img, "idx = ".$_POST['idx']);

    p_alert("변경 내용으로 저장되었습니다!");
} else if($_POST['act']=='delete') {
    if($_POST['idx']) {
        $query = "select * from main_category_t where idx = ".$_POST['idx'];
        $row = $DB->fetch_assoc($query);
        if($row) {
            @unlink($ct_img_dir_a . "/" . $row['mct_image']);
            @unlink($ct_img_dir_a . "/" . $row['mct_video']);
            $DB->del_query('main_category_t', " idx = '".$_POST['idx']."'");
            echo json_encode(array("result" => "ok", "msg" => "삭제되었습니다."));
        } else {
            echo json_encode(array("result" => "false", "msg" => "처리할 수 없습니다."));
        }
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