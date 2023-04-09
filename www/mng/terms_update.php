<?
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

if($_POST['act']=='update') {
    unset($arr_query);
    $arr_query = array(
        "tt_agree1" => $_POST['tt_agree1'],
        "tt_agree2" => $_POST['tt_agree2'],
        "tt_agree3" => $_POST['tt_agree3'],
        "tt_agree4" => $_POST['tt_agree4'],
        "tt_agree5" => $_POST['tt_agree5'],
        "tt_agree6" => $_POST['tt_agree6'],
    );

    $where_query = "idx = '1'";

    $DB->update_query('terms_t', $arr_query, $where_query);

    p_alert("수정되었습니다.");
} else if($_POST['act']=='logo_update') {
    $temp_img_txt = "tt_image";
    $temp_img_on_txt = "tt_image_on";
    $temp_img_temp_on_txt = "tt_image_temp_on";
    $temp_img_del_txt = "tt_image_del";
    if($_FILES[$temp_img_txt]['name']) {
        $tt_image = $_FILES[$temp_img_txt]['tmp_name'];
        $tt_image_name = $_FILES[$temp_img_txt]['name'];
        $tt_image_size = $_FILES[$temp_img_txt]['size'];
        $tt_image_type = $_FILES[$temp_img_txt]['type'];

        if($tt_image_name!="") {
            @unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
            $_POST[$temp_img_on_txt] = "tt_image_1.".get_file_ext($tt_image_name);
            upload_file($tt_image, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
            //thumnail($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            //scale_image_fit($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            thumnail_width($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000");
        }
    } else {
        if($_POST[$temp_img_del_txt]) {
            unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
        }
    }
    $arr_query_img['tt_image'] = $_POST['tt_image_on'];
    $arr_query_img['tt_udate'] = "now()";

    $DB->update_query('terms_t', $arr_query_img, "idx = 1");
    p_alert("저장되었습니다.");
}

include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>