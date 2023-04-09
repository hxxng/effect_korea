<?
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

$_act = $_REQUEST['act'];

if($_POST['act']=='update') {
    unset($arr_query);
    $arr_query = array(
        "nt_language" => $_POST['nt_language'],
        "nt_show" => $_POST['nt_show'],
        "nt_title" => $_POST['nt_title'],
        "nt_content" => $_POST['nt_content'],
        "nt_orderby" => $_POST['nt_orderby'],
        "nt_udate" => "now()",
    );

    $where_query = "idx = '".$_POST['nt_idx']."'";

    $DB->update_query('notice_t', $arr_query, $where_query);

    p_alert('수정되었습니다.');
} else if($_POST['act']=='delete') {
    if($_POST['idx']) {
        //에디터 사진 삭제
        $row = $DB->fetch_assoc("select * from notice_t where idx = ".$_POST['idx']);

        preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $row['nt_content'], $pt_content_img);

        foreach($pt_content_img[1] as $key => $val) {
            $val = str_replace($ct_img_url, '', $val);
            if(is_file($ct_img_dir_a."/".$val)) {
                @unlink($ct_img_dir_a."/".$val);
            }
        }

        $DB->del_query("notice_t", " idx = ".$_POST['idx']);
        echo json_encode(array("result" => "ok", "msg" => "삭제되었습니다."));
    } else {
        echo json_encode(array('result' => 'false', 'msg'=>'삭제할 수 없습니다.'));
    }
} else if($_POST['act']=='input') {
    unset($arr_query);
    $arr_query = array(
        "nt_language" => $_POST['nt_language'],
        "nt_show" => "Y",
        "nt_title" => $_POST['nt_title'],
        "nt_content" => $_POST['nt_content'],
        "nt_orderby" => $_POST['nt_orderby'],
        "nt_wdate" => "now()",
    );

    $DB->insert_query('notice_t', $arr_query);
    p_alert('등록되었습니다.', "./notice_list.php");
}

include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>