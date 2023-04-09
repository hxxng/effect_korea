<?
include "./head_inc.php";
$chk_menu = '0';
$chk_sub_menu = '4';
include "./head_menu_inc.php";

$n_limit = $n_limit_num;
$pg = $_GET['pg'];
$_colspan_txt = "9";
$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&pg=";

$query = "select *, a1.idx as mt_idx from member_t a1";
$query_count = "select count(*) from member_t a1";

$where_query .= " where mt_level in (1,2) ";
$_where = " and ";

if($_GET['search_txt']) {
if($_GET['sel_search']=="all") {
    $where_query .= $_where."(instr(a1.mt_id, '".$_GET['search_txt']."') or instr(a1.mt_firstname, '".$_GET['search_txt']."') or instr(a1.mt_lastname, '".$_GET['search_txt']."') or instr(a1.mt_hp, '".$_GET['search_txt']."'))";
} else {
    if($_GET['sel_search'] == "a1.mt_name") {
        $where_query .= $_where."(instr(a1.mt_firstname, '".$_GET['search_txt']."') or instr(a1.mt_lastname, '".$_GET['search_txt']."'))";
    } else {
        $where_query .= $_where."instr(".$_GET['sel_search'].", '".$_GET['search_txt']."')";
    }
}
$_where = " and ";
}

$row_cnt = $DB->fetch_query($query_count.$where_query);
$couwt_query = $row_cnt[0];
$counts = $couwt_query;
$n_page = ceil($couwt_query / $n_limit_num);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;
$counts = $counts - (($pg - 1) * $n_limit_num);

unset($list);
$sql_query = $query.$where_query." order by a1.idx desc limit ".$n_from.", ".$n_limit;
$list = $DB->select_query($sql_query);
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">탈퇴회원</h4>
                    <p class="card-description">
                        총 탈퇴회원 수 <?=number_format($counts)?>명<br/>
                    </p>
					<div class="p-3 float-right">
						<form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" class="form-inline" onsubmit="return frm_search_chk(this);">
							<div class="form-group mx-sm-1">
								<select name="sel_search" id="sel_search" class="form-control form-control-sm">
									<option value="all">통합검색</option>
									<option value="a1.mt_id">아이디</option>
									<option value="a1.mt_name">이름</option>
									<option value="a1.mt_hp">연락처</option>
								</select>
							</div>

							<div class="form-group mx-sm-1">
								<input type="text" class="form-control form-control-sm" style="width:200px;" name="search_txt" id="search_txt" value="<?=$_GET['search_txt']?>" />
							</div>

							<div class="form-group mx-sm-1">
								<input type="submit" class="btn btn-primary" value="검색" />
							</div>

							<div class="form-group mx-sm-1">
								<input type="button" class="btn btn-secondary" value="초기화" onclick="location.href='./member_retire_list.php'" />
							</div>
						</form>
						<script type="text/javascript">
							function frm_search_chk(f) {
								// if(f.search_txt.value=="") {
								// 	alert("검색어를 입력바랍니다.");
								// 	f.search_txt.focus();
								// 	return false;
								// }
								return true;
							}
							<? if($_GET['sel_search']) { ?>$('#sel_search').val('<?=$_GET['sel_search']?>');<? } ?>
						</script>
					</div>

					<table class="table table-striped table-hover">
					<thead>
					<tr>
						<th class="text-center" style="width:80px;">
							번호
						</th>
						<th class="text-center">
							아이디
						</th>
						<th class="text-center">
							이름
						</th>
						<th class="text-center">
							연락처
						</th>
                        <th class="text-center">
                            닉네임
                        </th>
						<th class="text-center">
							탈퇴일시
						</th>
						<th class="text-center">
							관리
						</th>
					</tr>
					</thead>
					<tbody>
					<?
                    if($list) {
                        foreach($list as $row) {
					?>
					<tr>
                        <td class="text-center">
                            <?=$counts?>
                        </td>
                        <td class="text-center">
                            <?=$row['mt_id'];?>
                        </td>
                        <td class="text-center">
                            <?=$row['mt_firstname'];?> <?=$row['mt_lastname'];?>
                        </td>
                        <td class="text-center">
                            <?=$row['mt_hp'];?>
                        </td>
                        <td class="text-center">
                            <?=$row['mt_nickname'];?>
                        </td>
                        <td class="text-center">
                            <?=DateType($row['mt_rdate'], 4)?>
                        </td>
                        <td class="text-center">
                            <input type="button" class="btn btn-outline-dark btn-sm" value="상세" onclick="location.href='./member_form.php?act=update&mt_idx=<?=$row['mt_idx']?>&<?=$_get_txt.$_GET['pg']?>'" />
                            <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="delete_mem('<?=$row['mt_idx']?>')" />
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
    function delete_mem(idx) {
        if(confirm("정말로 삭제하시겠습니까?")) {
            $.ajax({
                type: 'post',
                url: './member_update.php',
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