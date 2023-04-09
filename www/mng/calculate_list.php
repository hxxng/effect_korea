<?
include "./head_inc.php";
$chk_menu = '4';
include "./head_menu_inc.php";

$n_limit = $n_limit_num;
$pg = $_GET['pg'];
$_colspan_txt = "12";
$_get_txt = "ct_status=".$_GET['ct_status']."&search_txt=".$_GET['search_txt']."&pg=";
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">정산내역</h4>
					<form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" onsubmit="return frm_search_chk(this);">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="form-group row align-items-center mb-0">
                                    <label for="sel_search" class="col-sm-2 col-form-label">검색어</label>
                                    <div class="col-sm-2">
                                        <div class="input-group">
                                            <select name="sel_search" id="sel_search" class="form-control form-control-sm">
                                                <option value="all">통합검색</option>
                                                <option value="a2.mt_nickname">아티스트 닉네임</option>
                                                <option value="a2.mt_name">아티스트 이름</option>
                                                <option value="a2.mt_hp">아티스트 연락처</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="text" name="search_txt" id="search_txt" value="<?=$_GET['search_txt']?>" class="form-control form-control-sm" />
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="form-group row align-items-center mb-0">
                                    <label for="select_category" class="col-sm-2 col-form-label">정산상태</label>
                                    <div class="col-sm-6">
                                        <input type="hidden" name="ct_status" id="mt_approve" value="<?=$_GET['ct_status']?>" />
                                        <div class="btn-group" role="group" aria-label="ct_type">
                                            <button type="button" onclick="f_mt_approve('');" id="f_mt_approve_btn1" class="btn btn-outline-secondary<? if($_GET['ct_status']=='') { ?> btn-info text-white<? } ?>">전체</button>
                                            <button type="button" onclick="f_mt_approve('1');" id="f_mt_approve_btn2" class="btn btn-outline-secondary<? if($_GET['ct_status']=='1') { ?> btn-info text-white<? } ?>">정산중</button>
                                            <button type="button" onclick="f_mt_approve('2');" id="f_mt_approve_btn3" class="btn btn-outline-secondary<? if($_GET['ct_status']=='2') { ?> btn-info text-white<? } ?>">정산신청</button>
                                            <button type="button" onclick="f_mt_approve('3');" id="f_mt_approve_btn4" class="btn btn-outline-secondary<? if($_GET['ct_status']=='3') { ?> btn-info text-white<? } ?>">정산완료</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="form-group row align-items-center mb-0">
                                    <div class="col-sm-12 text-center">
                                        <input type="submit" class="btn btn-primary" id="search_btn" value="검색" />
                                        <input type="button" class="btn btn-secondary ml-2" value="초기화" onclick="location.href='./calculate_list.php'" />
                                    </div>
                                </div>
                            </li>
                        </ul>
					<p>&nbsp;</p>
					</form>
                    <div class="input-group">
                        <h4 class="font-weight-bold ml-1 mr-2 mt-2">아티스트 정산</h4>
                        <button type="button" class="btn btn-sm" style="border-color: green;color: green;" onclick="f_excel_down()"><i class="mdi mdi-file-excel mr-1"></i>계산 결과 내려받기</button>
                    </div>
					<table class="table table-striped table-hover">
					<thead>
					<tr>
						<th class="text-center" style="width:80px;">
							번호
						</th>
						<th class="text-center">
							아티스트
						</th>
                        <th class="text-center">
                            결제금액합계
                        </th>
                        <th class="text-center">
                            수수료합계
                        </th>
						<th class="text-center">
							정산예정금액
						</th>
						<th class="text-center">
							정산상태
						</th>
                        <th class="text-center">
                            정산신청일
                        </th>
                        <th class="text-center">
                            정산완료일
                        </th>
                        <th class="text-center" style="width: 160px;">
                            비고
                        </th>
						<th class="text-center" style="width: 150px;">
							관리
						</th>
					</tr>
					</thead>
					<tbody>
					<?
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
						$n_page = ceil($count_query[0] / $n_limit_num);
						if($pg=="") $pg = 1;
						$n_from = ($pg - 1) * $n_limit;
						$counts = $counts - (($pg - 1) * $n_limit_num);

						unset($list);
						$sql_query = $query.$where_query." order by a1.ct_wdate desc limit ".$n_from.", ".$n_limit;
                        $list = $DB->select_query($sql_query);

                        if($list) {
							foreach($list as $row) {
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
					?>
					<tr>
						<td class="text-center">
							<?=$counts?>
						</td>
						<td class="text-center">
                            <?=$row['mt_nickname']?><br/>
                            <?=$row['mt_firstname'].$row['mt_lastname']."(".$row['mt_hp'].")"?>
						</td>
                        <td class="text-center">
                            <? if($chk=="Y") echo number_format($sum['ot_sum_price']); else echo number_format($row['ct_price']);?>
                        </td>
						<td class="text-center">
                            <? if($chk=="Y") echo number_format($sum['ct_comm_sum_price']); else echo number_format($row['ct_service_comm']+$row['ct_pay_comm']+$row['ct_etc_comm']);?>
						</td>
                        <td class="text-center">
                            <? if($chk=="Y") echo number_format($sum['ct_price']); else echo number_format($row['ct_price'] - ($row['ct_service_comm']+$row['ct_pay_comm']+$row['ct_etc_comm']));?>
                        </td>
                        <td class="text-center" <?if($ct_status=="정산신청") echo 'style="color:blue;"'?>>
                            <?= $ct_status ?>
                        </td>
                        <td class="text-center">
                            <?=$row['ct_rdate']?>
                        </td>
                        <td class="text-center">
                            <?=$row['ct_ridate']?>
                        </td>
						<td class="text-center">
                            <?=cut_str(get_text($row['ct_memo']), 0, 10, '...')?>
						</td>
						<td class="text-center">
                            <input type="button" class="btn btn-outline-dark btn-sm" value="상세" onclick="location.href='./calculate_form.php?act=update&ct_idx=<?=$row['idx']?>&<?=$_get_txt.$_GET['pg']?>'" />
                            <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="delete_calculate('<?=$row['idx']?>')" />
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
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    $(document).ready(function() {
        <? if($_GET['sel_search']) { ?>$('#sel_search').val('<?=$_GET['sel_search']?>');<? } ?>
    });
    function frm_search_chk(f) {
        /*
        if(f.search_txt.value=="") {
            alert("검색어를 입력바랍니다.");
            f.search_txt.focus();
            return false;
        }
        */

        return true;
    }

    function f_excel_down() {
        var f = document.frm_search;

        hidden_ifrm.document.location.href = './calculate_excel.php?sel_search='+f.sel_search.value+'&search_txt='+f.search_txt.value+"&ct_status="+f.ct_status.value;

        return false;
    }
    function delete_calculate(idx) {
        if(confirm("정말로 삭제하시겠습니까?")) {
            $.ajax({
                type: 'post',
                url: './calculate_update.php',
                dataType: 'json',
                data: {act: "delete", idx: idx},
                success: function (d, s) {
                    alert(d['msg']);
                    location.reload();
                },
                cache: false
            });
        }
    }
</script>
<?
	include "./foot_inc.php";
?>