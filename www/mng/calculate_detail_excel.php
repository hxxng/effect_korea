<?
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

set_time_limit(0);
ini_set("memory_limit", -1);

$arr_cell = array(
    '번호', '주문번호(콘텐츠주문번호)', '결제구분', '결제금액', '결제상태', '결제일', '취소일', '카테고리(포인트)', '기본수수료', '결제수수료', '기타수수료', '정산예정금액'
);

require_once $_SERVER['DOCUMENT_ROOT'].'/lib/PHPExcel-1.8/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();
$sheetIndex = $objPHPExcel->createSheet(0);
$sheetIndex->setTitle('정산상세엑셀_'.date("YmdHis"));

$a = 'A';
foreach($arr_cell as $key => $val) {
    $sheetIndex->setCellValue($a.'1', $val);
    $a++;
}

$q = 2;
unset($list);
$query = "select * from calculate_t where idx = ".$_GET['ct_idx'];
$row = $DB->fetch_assoc($query);
if($row) {
    $query = "
        select cart_t.*, order_t.*, (SELECT ct_name FROM category_t WHERE idx = ct_cate_idx) as category1, 
        (SELECT ct_name FROM category_t WHERE idx = ct_cate_idx2) as category2
        from order_t 
        left join cart_t on cart_t.ot_code = order_t.ot_code
        left join contents_t on contents_t.idx = cart_t.ct_idx
        where contents_t.mt_idx = ".$row['mt_idx']." and ot_pdate >= '".$row['ct_cdate']."' and ot_pdate <= '".$row['ct_cedate']."' and ot_status = 2 and cart_t.ct_status = 2 
    ";
    $countquery = "
        select count(*) as cnt from order_t 
        left join cart_t on cart_t.ot_code = order_t.ot_code
        left join contents_t on contents_t.idx = cart_t.ct_idx
        where contents_t.mt_idx = ".$row['mt_idx']." and ot_pdate >= '".$row['ct_cdate']."' and ot_pdate <= '".$row['ct_cedate']."' and ot_status = 2 and cart_t.ct_status = 2 
    ";
}
$count_query = $DB->fetch_assoc($countquery.$where_query);
$counts = $count_query['cnt'];

unset($list);
$sql_query = $query.$where_query." order by ot_pdate desc ";
$list = $DB->select_query($sql_query);

$query = "select * from setting_t where idx = 1";
$setting = $DB->fetch_assoc($query);

if($list) {
    foreach($list as $row) {
        if($row['ot_status'] == 1) {
            $ot_status = "결제대기";
        } else if($row['ot_status'] == 2) {
            $ot_status = "결제완료";
        } else {
            $ot_status = "취소";
        }
        if($row['ot_pay_type'] == 6) {
            if($row['ot_point'] > 0) {
                if ($row['mt_type'] == 1 || $row['mt_type'] == 3) {
                    $price = ($arr_membership_price[$row['mt_type']] * 0.7) * ($row['ct_point'] / $row['ot_point']);
                } else {
                    $price = ($arr_membership_price[$row['mt_type']] / 12 * 0.7) * ($row['ct_point'] / $row['ot_point']);
                }
            } else {
                $price = 0;
            }
        } else {
            $price = $row['ct_price'];
            $price = $price + ($price * 0.1);
        }
        $category = "";
        if($row['ot_pay_type'] == 6) { $category = $row['category1'].">".$row['category2']." (".$arr_point[$row['category2']].")"; } else { $category = ""; }
        $sheetIndex->setCellValue('A'.$q, $counts);
        $sheetIndex->setCellValue('B'.$q, $row['ot_code']." (".$row['ot_pcode'].")");
        $sheetIndex->setCellValue('C'.$q, $arr_ct_method[$row['ot_pay_type']]);
        $sheetIndex->setCellValue('D'.$q, $price);
        $sheetIndex->setCellValue('E'.$q, $ot_status);
        $sheetIndex->setCellValue('F'.$q, DateType($row['ot_pdate']));
        $sheetIndex->setCellValue('G'.$q, DateType($row['ct_cidate']));
        $sheetIndex->setCellValue('H'.$q, $category);
        $sheetIndex->setCellValue('I'.$q, $price * ($setting['st_service_comm']/100));
        $sheetIndex->setCellValue('J'.$q, $price * ($setting['st_pay_comm']/100));
        $sheetIndex->setCellValue('K'.$q, 0);
        $sheetIndex->setCellValue('L'.$q, $price - (($price * ($setting['st_service_comm']/100)) + ($price * ($setting['st_pay_comm']/100))));

        $q++;
        $counts--;
    }
}

$objPHPExcel->removeSheetByIndex('1');
$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="calculate_detail_excel_'.date("YmdHis").'.xls"');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Set-Cookie: fileDownload=true; path=/');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>