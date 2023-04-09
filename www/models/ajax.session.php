<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

$type = $_POST['type'];

if($type == "chg_language") {
    $_lang = $_SESSION['_lang'] = $_POST['lang'];
    echo json_encode(array('result' => 'ok'));
} else if($type == "all_read") {
    $query = "select * from pushnotification_log_t where op_idx = ".$_SESSION['_mt_idx'];
    $list = $DB->select_query($query);
    if($list) {
        foreach ($list as $row) {
            $query = "select * from pushnotification_read_log_t where plt_idx = ".$row['idx'];
            $read = $DB->fetch_assoc($query);
            if(!$read) {
                $DB->insert_query("pushnotification_read_log_t", array("mt_idx" => $_SESSION['_mt_idx'], "plt_idx" => $row['idx'], "prlt_wdate" => "now()"));
            }
        }
    }
    echo json_encode(array('result' => 'ok'));
} else if($type == "chk_read") {
    if($_POST['idx']) {
        $query = "select * from pushnotification_read_log_t where plt_idx = ".$_POST['idx'];
        $chk = $DB->fetch_assoc($query);
        if(!$chk) {
            $DB->insert_query("pushnotification_read_log_t", array("mt_idx" => $_SESSION['_mt_idx'], "plt_idx" => $_POST['idx'], "prlt_wdate" => "now()"));
        }
    }
} else if($type == "search_log") {
    $DB->insert_query("search_log_t", array("mt_idx" => $_POST['mt_idx'], "slt_language" => $_POST['slt_language'], "slt_txt" => $_POST['slt_txt'], "slt_wdate" => "now()"));
    echo json_encode(array('result' => 'ok'));
}
?>