<?
include "./head_inc.php";
$chk_menu = '3';
$chk_sub_menu = '1';
include "./head_menu_inc.php";

$n_limit = $n_limit_num;
$pg = $_GET['pg'];
$_colspan_txt = "12";
$_get_txt = "search_txt=".$_GET['search_txt']."&sel_search_sdate=".$_GET['sel_search_sdate']."&sel_search_edate=".$_GET['sel_search_edate']."&date_chk=".$_GET['date_chk']."&sel_search=".$_GET['sel_search']."&pg=";
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">회원권</h4>
					<form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" onsubmit="return frm_search_chk(this);">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="form-group row align-items-center mb-0">
                                    <label for="pt_option_chk" class="col-sm-2 col-form-label">조회기간</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" name="date_chk" id="pt_option_chk" value="<?=$_GET['date_chk']?>" class="form-control" />
                                        <div class="btn-group" role="group" aria-label="select_category">
                                            <button type="button" onclick="f_pt_option_chk_1('1');" id="f_pt_option_chk1" class="btn btn-outline-secondary <?if($_GET['date_chk'] == "" || $_GET['date_chk'] == 1) echo 'btn-info text-white';?>">구매일시</button>
                                            <button type="button" onclick="f_pt_option_chk_1('2');" id="f_pt_option_chk2" class="btn btn-outline-secondary <? if($_GET['date_chk'] == 2) echo 'btn-info text-white';?>">유효기간</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="date" name="sel_search_sdate" id="sel_search_sdate" value="<?=$_GET['sel_search_sdate']?>" class="form-control datepicker" /> <span class="m-2">~</span> <input type="date" name="sel_search_edate" id="sel_search_edate" value="<?=$_GET['sel_search_edate']?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="form-group row align-items-center mb-0">
                                    <label for="sel_search" class="col-sm-2 col-form-label">검색어</label>
                                    <div class="col-sm-2">
                                        <div class="input-group">
                                            <select name="sel_search" id="sel_search" class="form-control form-control-sm">
                                                <option value="all">통합검색</option>
                                                <option value="a1.mt_membership">회원권</option>
                                                <option value="a2.mt_id">구매자아이디</option>
                                                <option value="a2.mt_hp">구매자연락처</option>
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
                                    <div class="col-sm-12 text-center">
                                        <input type="submit" class="btn btn-primary" id="search_btn" value="검색" />
                                        <input type="button" class="btn btn-secondary ml-2" value="초기화" onclick="location.href='./sales_membership_list.php'" />
                                    </div>
                                </div>
                            </li>
                        </ul>
					<p>&nbsp;</p>
					</form>
					<script type="text/javascript">
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

						function f_excel_down(act_t) {
							var f = document.frm_search;

							if(f.sel_search_sdate.value=="") {
								alert("조회기간을 입력바랍니다.");
								f.sel_search_sdate.focus();
								return false;
							}
							if(f.sel_search_edate.value=="") {
								alert("조회기간을 입력바랍니다.");
								f.sel_search_edate.focus();
								return false;
							}

							hidden_ifrm.document.location.href = './order_excel.php?act='+act_t+'&search_date='+f.sel_search_date.value+'&sdate='+f.sel_search_sdate.value+'&edate='+f.sel_search_edate.value;

							return false;
						}

						<? if($_GET['sel_search_sdate']) { ?>$('#sel_search_sdate').val('<?=$_GET['sel_search_sdate']?>');<? } ?>
						<? if($_GET['sel_search_edate']) { ?>$('#sel_search_edate').val('<?=$_GET['sel_search_edate']?>');<? } ?>
                        <? if($_GET['sel_search']) { ?>$('#sel_search').val('<?=$_GET['sel_search']?>');<? } ?>
					</script>
					<table class="table table-striped table-hover">
					<thead>
					<tr>
						<th class="text-center" style="width:80px;">
							번호
						</th>
						<th class="text-center">
							주문번호
						</th>
                        <th class="text-center" style="width: 150px;">
                            구매일시
                        </th>
						<th class="text-center">
							회원권
						</th>
						<th class="text-center">
							금액
						</th>
                        <th class="text-center" style="width: 150px;">
                            회원권 유효기간
                        </th>
                        <th class="text-center">
                            구매자
                        </th>
                        <th class="text-center" style="width: 100px;">
                            결제상태
                        </th>
						<th class="text-center" style="width: 150px;">
							관리
						</th>
					</tr>
					</thead>
					<tbody>
					<?
                        $_where = " where ";
						$query = "
                            select a1.*, mt_id, mt_firstname, mt_lastname, mt_hp from membership_t a1 left join member_t a2 on a2.idx = a1.mt_idx
						";
						if($_GET['search_txt']) {
                            $where_query .= $_where."(instr(a1.mt_membership, '".$_GET['search_txt']."') or instr(a2.mt_id, '".$_GET['search_txt']."') or instr(a2.mt_hp, '".$_GET['search_txt']."'))";
							$_where = " and ";
                        }
                        if($_GET['sel_search_sdate'] && $_GET['sel_search_edate']) {
                            if($_GET['date_chk'] == 1) {
                                $date = " a1.mt_pdate ";
                            } else {
                                $date = " a1.mt_edate ";
                            }
                            $where_query .= $_where.$date." between '".$_GET['sel_search_sdate']." 00:00:00' and '".$_GET['sel_search_edate']." 23:59:59'";
                            $_where = " and ";
                        }

                        $count_query = $DB->count_query($query.$where_query);
						$counts = $count_query;
						$n_page = ceil($count_query / $n_limit_num);
						if($pg=="") $pg = 1;
						$n_from = ($pg - 1) * $n_limit;
						$counts = $counts - (($pg - 1) * $n_limit_num);

						unset($list);
						$sql_query = $query.$where_query." order by a1.mt_wdate desc limit ".$n_from.", ".$n_limit;
						$list = $DB->select_query($sql_query);

						if($list) {
							foreach($list as $row) {
                                if($row['mt_status'] == 1) {
                                    $mt_status = "결제전";
                                } else if($row['mt_status'] == 2) {
                                    $mt_status = "결제완료";
                                } else {
                                    $mt_status = "취소";
                                }
                    ?>
					<tr>
						<td class="text-center">
							<?=$counts?>
						</td>
						<td class="text-center">
                            <?=$row['mt_code']?>
						</td>
                        <td class="text-center">
                            <?=$row['mt_pdate']?>
                        </td>
						<td class="text-center">
                            <?=$row['mt_membership']?>
						</td>
                        <td class="text-center">
                            <?=number_format($row['mt_price'])?>원
                        </td>
                        <td class="text-center">
                            <?=DateType($row['mt_edate'], 1)?>까지
                        </td>
                        <td class="text-center">
                            <div class="media-body mb-1">
                                <?=$row['mt_firstname']." ".$row['mt_lastname']."(".$row['mt_id'].")"?>
                            </div>
                            <?=$row['mt_hp']?>
                        </td>
						<td class="text-center" style="width: 80px;">
                            <?=$mt_status?>
						</td>
						<td class="text-center">
							<input type="button" class="btn btn-outline-secondary btn-sm" value="상세" onclick="location.href='./sales_membership_form.php?act=update&mt_idx=<?=$row['idx']?>&<?=$_get_txt.$_GET['pg']?>'" />
                            <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="delete_sales('<?=$row['idx']?>')" />
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
    function delete_sales(idx) {
        if(confirm("정말로 삭제하시겠습니까?")) {
            $.ajax({
                type: 'post',
                url: './sales_update.php',
                dataType: 'json',
                data: {act: "delete", idx: idx, type: "membership"},
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