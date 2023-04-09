<?
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

$_act = $_REQUEST['act'];

if($_POST['act']=='update') {
    unset($arr_query);
    $arr_query = array(
        "ft_language" => $_POST['ft_language'],
        "ft_show" => $_POST['ft_show'],
        "ft_title" => $_POST['ft_title'],
        "ft_answer" => $_POST['ft_answer'],
        "ft_orderby" => $_POST['ft_orderby'],
        "ft_udate" => "now()",
    );

    $where_query = "idx = '".$_POST['ft_idx']."'";

    $DB->update_query('faq_t', $arr_query, $where_query);

    p_alert('수정되었습니다.');
} else if($_POST['act']=='delete') {
    if($_POST['idx']) {
        //에디터 사진 삭제
        $row = $DB->fetch_assoc("select * from faq_t where idx = ".$_POST['idx']);

        preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $row['ft_answer'], $pt_content_img);

        foreach($pt_content_img[1] as $key => $val) {
            $val = str_replace($ct_img_url, '', $val);
            if(is_file($ct_img_dir_a."/".$val)) {
                @unlink($ct_img_dir_a."/".$val);
            }
        }

        $DB->del_query("faq_t", " idx = ".$_POST['idx']);
        echo json_encode(array("result" => "ok", "msg" => "삭제되었습니다."));
    } else {
        echo json_encode(array('result' => 'false', 'msg'=>'삭제할 수 없습니다.'));
    }
} else if($_POST['act']=='input') {
    unset($arr_query);
    $arr_query = array(
        "ft_language" => $_POST['ft_language'],
        "ft_show" => "Y",
        "ft_title" => $_POST['ft_title'],
        "ft_answer" => $_POST['ft_answer'],
        "ft_orderby" => $_POST['ft_orderby'],
        "ft_wdate" => "now()",
    );

    $DB->insert_query('faq_t', $arr_query);
    p_alert('등록되었습니다.', "./faq_list.php");
}

include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>