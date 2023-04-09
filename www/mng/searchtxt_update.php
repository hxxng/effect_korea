<?
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

$_act = $_REQUEST['act'];

if($_POST['act']=='delete') {
    if($_POST['idx']) {
        $DB->del_query("popular_searchtxt_t", " idx = ".$_POST['idx']);
        echo json_encode(array("result" => "ok", "msg" => "삭제되었습니다."));
    } else {
        echo json_encode(array('result' => 'false', 'msg'=>'삭제할 수 없습니다.'));
    }
} else if($_POST['act']=='input') {
    if($_POST['pst_language']) {
        $pst_language = $_POST['pst_language'];
    } else {
        $pst_language = 1;
    }
    unset($arr_query);
    $arr_query = array(
        "pst_language" => $pst_language,
        "pst_text" => $_POST['pst_text'],
        "pst_wdate" => "now()",
    );

    $DB->insert_query('popular_searchtxt_t', $arr_query);
    echo json_encode(array("result" => "ok", "msg" => "등록되었습니다."));
}

include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>