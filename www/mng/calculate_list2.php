<?
include "./head_inc.php";
$chk_menu = '4';
include "./head_menu_inc.php";

$pg = $_GET['pg'];
$_colspan_txt = "13";
$_get_txt = "ct_idx=".$_GET['ct_idx']."&pg=";
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">정산상세</h4>
                    <button type="button" class="btn btn-sm" style="border-color: green;color: green;" onclick="f_excel_down()"><i class="mdi mdi-file-excel mr-1"></i>계산 결과 내려받기</button>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center" style="width:80px;">
                                번호
                            </th>
                            <th class="text-center">
                                주문번호<br/>
                                (콘텐츠주문번호)
                            </th>
                            <th class="text-center">
                                결제구분
                            </th>
                            <th class="text-center">
                                결제금액
                            </th>
                            <th class="text-center">
                                결제상태
                            </th>
                            <th class="text-center">
                                결제일
                            </th>
                            <th class="text-center">
                                취소일
                            </th>
                            <th class="text-center">
                                카테고리<br/>
                                (포인트)
                            </th>
                            <th class="text-center">
                                기본수수료
                            </th>
                            <th class="text-center">
                                결제수수료
                            </th>
                            <th class="text-center">
                                기타수수료
                            </th>
                            <th class="text-center">
                                정산예정금액
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?
                        $query = "select * from calculate_t where idx = ".$_GET['ct_idx'];
                        $row = $DB->fetch_assoc($query);
                        if($row) {
//                            if($row['ct_status'] > 1) {
//                                $where_query = "where a2.ct_pdate >= '".$row['ct_cdate']."' and a2.ct_pdate <= '".$row['ct_cedate']."' and a1.ct_status = ".$row['ct_status']." group by a1.idx";
//                            } else {
//                                $where_query = "where a1.ct_status = 1 group by a1.idx";
//                            }
                            $query = "
                                select cart_t.*, order_t.*, (SELECT ct_name FROM category_t WHERE idx = ct_cate_idx) as category1, 
                               (SELECT ct_name FROM category_t WHERE idx = ct_cate_idx2) as category2
                                from order_t 
                                left join cart_t on cart_t.ot_code = order_t.ot_code
                                left join contents_t on contents_t.idx = cart_t.ct_idx
                                where contents_t.mt_idx = ".$row['mt_idx']." and ot_pdate >= '".$row['ct_cdate']."' and ot_pdate <= '".$row['ct_cedate']."' and ot_status = 2 and cart_t.ct_status = 2 
                                and order_t.mt_idx != 70 and cart_t.mt_idx != 70
                            ";
                            $countquery = "
                                select count(*) as cnt from order_t 
                                left join cart_t on cart_t.ot_code = order_t.ot_code
                                left join contents_t on contents_t.idx = cart_t.ct_idx
                                where contents_t.mt_idx = ".$row['mt_idx']." and ot_pdate >= '".$row['ct_cdate']."' and ot_pdate <= '".$row['ct_cedate']."' and ot_status = 2 and cart_t.ct_status = 2 
                                and order_t.mt_idx != 70 and cart_t.mt_idx != 70
                            ";
                        }
                        $n_limit = $n_limit_num;
                        $count_query = $DB->fetch_assoc($countquery.$where_query);
                        $counts = $count_query['cnt'];
                        $n_page = ceil($count_query['cnt'] / $n_limit_num);
                        if($pg=="") $pg = 1;
                        $n_from = ($pg - 1) * $n_limit;
                        $counts = $counts - (($pg - 1) * $n_limit_num);

                        unset($list);
                        $sql_query = $query.$where_query." order by ot_pdate desc limit ".$n_from.", ".$n_limit;
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
                        ?>
                                <tr>
                                    <td class="text-center">
                                        <?=$counts?>
                                    </td>
                                    <td class="text-center">
                                        <span class="font-weight-bold"><?=$row['ot_code']?></span><br/>
                                        <?=$row['ot_pcode']?>
                                    </td>
                                    <td class="text-center">
                                        <?= $arr_ct_method[$row['ot_pay_type']] ?>
                                    </td>
                                    <td class="text-center">
                                        <?=number_format($price)?>
                                    </td>
                                    <td class="text-center">
                                        <?=$ot_status?>
                                    </td>
                                    <td class="text-center">
                                        <?=DateType($row['ot_pdate'])?>
                                    </td>

                                    <td class="text-center">
                                        <?=DateType($row['ct_cidate'])?>
                                    </td>
                                    <td class="text-center">
                                        <?
                                        if($row['ot_pay_type'] == 6) {
                                            echo $row['category1'].">".$row['category2'].'<br/>';
                                            echo $arr_point[$row['category2']];
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?=number_format($price * ($setting['st_service_comm']/100))?>
                                    </td>
                                    <td class="text-center">
                                        <?=number_format($price * ($setting['st_pay_comm']/100))?>
                                    </td>
                                    <td class="text-center">
                                        <?=0?>
                                    </td>
                                    <td class="text-center">
                                        <?=number_format($price - (($price * ($setting['st_service_comm']/100)) + ($price * ($setting['st_pay_comm']/100))))?>
                                    </td>
                                </tr>
                                <?
                                $counts--;
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="<?=$_colspan_txt?>" class="text-center"><b>자료가 없습니다.</b></td>
                            </tr>
                            <?
                        }
                        ?>
                        </tbody>
                    </table>
                    <?
                    if($n_page>1) {
                        echo page_listing($pg, $n_page, $_SERVER['PHP_SELF']."?".$_get_txt);
                    }
                    ?>
                    <p class="p-3 mt-3 text-center">
                        <input type="button" value="목록" onclick="location.href='./calculate_list.php'" class="btn btn-outline-secondary mx-2">
                    </p>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    function f_excel_down() {
        var f = document.frm_search;

        hidden_ifrm.document.location.href = './calculate_detail_excel.php?ct_idx=<?=$_GET['ct_idx']?>';

        return false;
    }
</script>
<?
	include "./foot_inc.php";
?>