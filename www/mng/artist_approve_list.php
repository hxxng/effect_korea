<?
include "./head_inc.php";
$chk_menu = '0';
$chk_sub_menu = '2';
include "./head_menu_inc.php";

$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&mt_approve=".$_GET['mt_approve']."&pg=";

$n_limit = $n_limit_num;
$pg = $_GET['pg'];
$_colspan_txt = "9";

$query = "select a1.*, a1.idx as mt_idx from member_t a1 where (mt_level = 5 or mt_level = 3) and mt_approve > 0";
$query_count = "select count(*) from member_t a1 where (mt_level = 5 or mt_level = 3) and mt_approve > 0";
$where_query = "";
$_where = " and ";

if($_GET['search_txt']!="") {
    if($_GET['sel_search']=="all") {
        $where_query .= $_where."(instr(a1.mt_id, '".$_GET['search_txt']."') or instr(a1.mt_firstname, '".$_GET['search_txt']."') or instr(a1.mt_lastname, '".$_GET['search_txt']."') or instr(a1.mt_hp, '".$_GET['search_txt']."') or instr(a1.mt_id, '".$_GET['search_txt']."') or instr(a1.mt_nickname, '".$_GET['search_txt']."'))";
    } else {
        if($_GET['sel_search'] == "a1.mt_name") {
            $where_query .= $_where."(instr(a1.mt_firstname, '".$_GET['search_txt']."') or instr(a1.mt_lastname, '".$_GET['search_txt']."'))";
        } else {
            $where_query .= $_where."instr(".$_GET['sel_search'].", '".$_GET['search_txt']."')";
        }
    }
    $_where = " and ";
}
if($_GET['mt_approve']!="") {
    $where_query .= " and mt_approve = ".$_GET['mt_approve'];
}

$row_cnt = $DB->fetch_query($query_count.$where_query);
$couwt_query = $row_cnt[0];
$counts = $couwt_query;
$n_page = ceil($couwt_query / $n_limit_num);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;
$counts = $counts - (($pg - 1) * $n_limit_num);

unset($list);
$sql_query = $query.$where_query." order by a1.mt_adate desc limit ".$n_from.", ".$n_limit;
$list = $DB->select_query($sql_query);
?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">아티스트 승인관리</h4>
                        <form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" onsubmit="return frm_search_chk(this);">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="form-group row align-items-center mb-0">
                                        <label for="sel_search" class="col-sm-2 col-form-label">검색어</label>
                                        <div class="col-sm-1">
                                            <div class="input-group">
                                                <select name="sel_search" id="sel_search" class="form-control form-control-sm">
                                                    <option value="all">통합검색</option>
                                                    <option value="a1.mt_id">아이디</option>
                                                    <option value="a1.mt_name">이름</option>
                                                    <option value="a1.mt_hp">연락처</option>
                                                    <option value="a1.mt_nickname">닉네임</option>
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
                                        <label for="select_category" class="col-sm-2 col-form-label">승인상태</label>
                                        <div class="col-sm-6">
                                            <input type="hidden" name="mt_approve" id="mt_approve" value="<?=$_GET['mt_approve']?>" />
                                            <div class="btn-group" role="group" aria-label="mt_approve">
                                                <button type="button" onclick="f_mt_approve('');" id="f_mt_approve_btn1" class="btn btn-outline-secondary<? if($_GET['mt_approve']=='') { ?> btn-info text-white<? } ?>">전체</button>
                                                <button type="button" onclick="f_mt_approve('1');" id="f_mt_approve_btn2" class="btn btn-outline-secondary<? if($_GET['mt_approve']=='1') { ?> btn-info text-white<? } ?>">승인대기</button>
                                                <button type="button" onclick="f_mt_approve('2');" id="f_mt_approve_btn3" class="btn btn-outline-secondary<? if($_GET['mt_approve']=='2') { ?> btn-info text-white<? } ?>">승인</button>
                                                <button type="button" onclick="f_mt_approve('3');" id="f_mt_approve_btn4" class="btn btn-outline-secondary<? if($_GET['mt_approve']=='3') { ?> btn-info text-white<? } ?>">반려</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-group row align-items-center mb-0">
                                        <div class="col-sm-12 text-center">
                                            <input type="submit" class="btn btn-primary" value="검색" />
                                            <input type="button" class="btn btn-secondary ml-2" value="초기화" onclick="location.href='./artist_approve_list.php'" />
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

                            <? if($_GET['sel_search']) { ?>$('#sel_search').val('<?=$_GET['sel_search']?>');<? } ?>
                        </script>

                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">
                                    번호
                                </th>
                                <th class="text-center">
                                    승인상태
                                </th>
                                <th class="text-center">
                                    승인요청일
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
                                    관리
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($list) {
                                foreach($list as $row) {
                                    if($row['mt_approve'] == 1) {
                                        $mt_approve = "승인대기";
                                    } else if($row['mt_approve'] == 2) {
                                        $mt_approve = "승인";
                                    } else {
                                        $mt_approve = "반려";
                                    }
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <?=$counts?>
                                        </td>
                                        <td class="text-center">
                                            <?=$mt_approve?>
                                        </td>
                                        <td class="text-center">
                                            <?=DateType($row['mt_adate'], 4)?>
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
                                            <input type="button" class="btn btn-outline-dark btn-sm" value="관리" onclick="location.href='./artist_approve_form.php?act=approve_update&mt_idx=<?=$row['mt_idx']?>&<?=$_get_txt.$_GET['pg']?>'" />
                                            <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="delete_approve('<?=$row['mt_idx']?>')" />
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
    function delete_approve(idx) {
        if(confirm("정말로 삭제하시겠습니까?\n삭제한 회원정보는 보이지 않습니다.")) {
            $.ajax({
                type: 'post',
                url: './member_update.php',
                dataType: 'json',
                data: {act: "delete_approve", idx: idx},
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
