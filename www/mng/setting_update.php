<?
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

if($_POST['act']=='update') {
    unset($arr_query);
    $arr_query = array(
        "st_service_comm" => $_POST['st_service_comm'],
        "st_pay_comm" => $_POST['st_pay_comm'],
    );

    $where_query = "idx in (1,2)";
    $DB->update_query('setting_t', $arr_query, $where_query);

    $arr_query = array(
        "st_company_name" => $_POST['st_company_name'],
        "st_ceo" => $_POST['st_ceo'],
        "st_register_num" => $_POST['st_register_num'],
        "st_report_num" => $_POST['st_report_num'],
        "st_manager" => $_POST['st_manager'],
        "st_addr" => $_POST['st_addr'],
        "st_tel" => $_POST['st_tel'],
        "st_udate" => "now()",
    );
    if($_POST['st_language']) {
        $where_query = "idx = ".$_POST['st_language'];
    } else {
        $where_query = "idx = 1";
    }
    $DB->update_query('setting_t', $arr_query, $where_query);

    p_alert("수정되었습니다.");
}

include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>