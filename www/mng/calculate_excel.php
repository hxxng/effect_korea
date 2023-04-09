<?
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

set_time_limit(0);
ini_set("memory_limit", -1);

$arr_cell = array(
    '번호', '아티스트', '결제금액합계', '수수료합계', '정산예정금액', '정산상태', '정산신청일', '정산완료일', '비고'
);

require_once $_SERVER['DOCUMENT_ROOT'].'/lib/PHPExcel-1.8/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();
$sheetIndex = $objPHPExcel->createSheet(0);
$sheetIndex->setTitle('정산내역엑셀_'.date("YmdHis"));

$a = 'A';
foreach($arr_cell as $key => $val) {
    $sheetIndex->setCellValue($a.'1', $val);
    $a++;
}

$q = 2;
unset($list);
$_where = " and ";
$query = "
    select a1.*, mt_nickname, mt_lastname, mt_firstname, mt_hp
    from calculate_t a1 left join member_t a2 on a2.idx = a1.mt_idx
";
$count_query = "
    SELECT count(*) FROM (select a1.idx
    from calculate_t a1 left join member_t a2 on a2.idx = a1.mt_idx
";

$where_query = "where 1=1 ";
if($_GET['search_txt']) {
    if($_GET['sel_search']=="all") {
        $where_query .= $_where."(instr(a2.mt_nickname, '".$_GET['search_txt']."') or instr(a2.mt_lastname, '".$_GET['search_txt']."') or instr(a2.mt_firstname, '".$_GET['search_txt']."') or instr(a2.mt_hp, '".$_GET['search_txt']."'))";
    } else {
        if($_GET['sel_search'] == "a2.mt_name") {
            $where_query .= $_where."(instr(a2.mt_firstname, '".$_GET['search_txt']."') or instr(a2.mt_lastname, '".$_GET['search_txt']."'))";
        } else {
            $where_query .= $_where."instr(".$_GET['sel_search'].", '".$_GET['search_txt']."')";
        }
    }
    $_where = " and ";
}
if($_GET['ct_status']) {
    $where_query .= $_where." a1.ct_status = ".$_GET['ct_status'];
}
$where_query .= " group by ct_rdate ";

$count_query = $DB->fetch_query($count_query.$where_query." ) A");
$counts = $count_query[0];

$sql_query = $query.$where_query." order by a1.ct_wdate desc ";
$list = $DB->select_query($sql_query);

if($list) {
    foreach($list as $row) {
        $query = "select * from calculate_sum_t where mt_idx = ".$row['mt_idx']." and ct_rdate = '".$row['ct_rdate']."'";
        $sum = $DB->fetch_query($query);
        if($sum) {
            $chk = "Y";
        } else {
            $chk = "N";
        }
        if($row['ct_status'] == 1) {
            $ct_status = "정산중";
        } else if($row['ct_status'] == 2) {
            $ct_status = "정산신청";
        } else {
            $ct_status = "정산완료";
        }
        $query = "select * from calculate_sum_t where mt_idx = ".$row['mt_idx']." and ct_rdate = '".$row['ct_rdate']."'";
        $sum = $DB->fetch_query($query);
        if($sum) {
            $chk = "Y";
        } else {
            $chk = "N";
        }
        if($chk=="Y") $ot_sum_price = $sum['ot_sum_price']; else $ot_sum_price = $row['ct_price'];
        if($chk=="Y") $ct_comm_sum_price = $sum['ct_comm_sum_price']; else $ct_comm_sum_price = $row['ct_service_comm']+$row['ct_pay_comm']+$row['ct_etc_comm'];
        if($chk=="Y") $ct_price = $sum['ct_price']; else $ct_price = $row['ct_price'] - ($row['ct_service_comm']+$row['ct_pay_comm']+$row['ct_etc_comm']);
        $sheetIndex->setCellValue('A'.$q, $counts);
        $sheetIndex->setCellValue('B'.$q, $row['mt_nickname']." | ".$row['mt_firstname'].$row['mt_lastname']."(".$row['mt_hp'].")");
        $sheetIndex->setCellValue('C'.$q, $ot_sum_price);
        $sheetIndex->setCellValue('D'.$q, $ct_comm_sum_price);
        $sheetIndex->setCellValue('E'.$q, $ct_price);
        $sheetIndex->setCellValue('F'.$q, $ct_status);
        $sheetIndex->setCellValue('G'.$q, $row['ct_rdate']);
        $sheetIndex->setCellValue('H'.$q, $row['ct_ridate']);
        $sheetIndex->setCellValue('I'.$q, $row['ct_memo']);

        $q++;
        $counts--;
    }
}

$objPHPExcel->removeSheetByIndex('1');
$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="calculate_excel_'.date("YmdHis").'.xls"');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Set-Cookie: fileDownload=true; path=/');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>