<?
include "./head_inc.php";
$chk_menu = '1';
$chk_sub_menu = '5';
include "./head_menu_inc.php";

$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&ct_show=".$_GET['ct_show']."&ct_cate_idx=".$_GET['ct_cate_idx']."&pg=";

$n_limit = $n_limit_num;
$pg = $_GET['pg'];
$_colspan_txt = "10";

$query = "select a1.*, a1.idx as ct_idx, a2.ct_name, a3.ct_name, a4.mt_nickname 
from contents_t a1 
left join category_t a2 on a2.idx = a1.ct_cate_idx
left join category_t a3 on a3.idx = a1.ct_cate_idx2
left join member_t a4 on a4.idx = a1.mt_idx";
$query_count = "select count(*) from contents_t a1 
left join category_t a2 on a2.idx = a1.ct_cate_idx
left join category_t a3 on a3.idx = a1.ct_cate_idx2
left join member_t a4 on a4.idx = a1.mt_idx";
$where_query = " where ct_type = 2 and ct_status = 2 ";

if($_GET['search_txt']!="") {
    $_where = " and ";
    if($_GET['sel_search']=="all") {
        $where_query .= $_where."(instr(a1.ct_title, '".$_GET['search_txt']."') or instr(a4.mt_nickname, '".$_GET['search_txt']."'))";
    } else {
        $where_query .= $_where."instr(".$_GET['sel_search'].", '".$_GET['search_txt']."')";
    }
}
if($_GET['ct_show']!="") {
    $where_query .= " and ct_show = '".$_GET['ct_show']."' ";
}
if($_GET['ct_cate_idx'] != "") {
    $where_query .= " and ct_cate_idx2 = ".$_GET['ct_cate_idx'];
}

$row_cnt = $DB->fetch_query($query_count.$where_query);
$couwt_query = $row_cnt[0];
$counts = $couwt_query;
$n_page = ceil($couwt_query / $n_limit_num);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;
$counts = $counts - (($pg - 1) * $n_limit_num);

unset($list);
$sql_query = $query.$where_query." order by a1.ct_wdate desc limit ".$n_from.", ".$n_limit;
$list = $DB->select_query($sql_query);
?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">영상콘텐츠</h4>
                        <form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" onsubmit="return frm_search_chk(this);">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="form-group row align-items-center mb-0">
                                        <label for="sel_search" class="col-sm-2 col-form-label">검색어</label>
                                        <div class="col-sm-1">
                                            <div class="input-group">
                                                <select name="sel_search" id="sel_search" class="form-control form-control-sm">
                                                    <option value="all">통합검색</option>
                                                    <option value="a1.ct_title">컨텐츠명</option>
                                                    <option value="a4.mt_nickname">아티스트</option>
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
                                        <label for="select_category" class="col-sm-2 col-form-label">노출</label>
                                        <div class="col-sm-6">
                                            <input type="hidden" name="ct_show" id="ct_show" value="<?=$_GET['ct_show']?>" />
                                            <div class="btn-group" role="group" aria-label="ct_show">
                                                <button type="button" onclick="f_ct_show('');" id="f_pt_sale_now_btn1" class="btn btn-outline-secondary<? if($_GET['ct_show']=='') { ?> btn-info text-white<? } ?>">전체</button>
                                                <button type="button" onclick="f_ct_show('Y');" id="f_pt_sale_now_btn2" class="btn btn-outline-secondary<? if($_GET['ct_show']=='Y') { ?> btn-info text-white<? } ?>">노출</button>
                                                <button type="button" onclick="f_ct_show('N');" id="f_pt_sale_now_btn3" class="btn btn-outline-secondary<? if($_GET['ct_show']=='N') { ?> btn-info text-white<? } ?>">노출안함</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-group row align-items-center mb-0">
                                        <label for="select_category" class="col-sm-2 col-form-label">카테고리</label>
                                        <div class="col-sm-7">
                                            <input type="hidden" name="ct_cate_idx" id="ct_cate_idx" value="<?=$_GET['ct_cate_idx']?>" />
                                            <div class="btn-group" role="group" aria-label="ct_cate_idx">
                                                <button type="button" onclick="f_category('', this);" id="f_ct_resolution_btn1" value="" class="btn btn-outline-secondary <? if($_GET['ct_cate_idx']=='') { ?> btn-info text-white<? } ?>">전체</button>
                                                <?
                                                $query = "select * from category_t where ct_p_idx = 11";
                                                $category = $DB->select_query($query);
                                                if($category) {
                                                    $i = 1;
                                                    foreach ($category as $row_c) {
                                                        ?>
                                                        <button type="button" onclick="f_category('<?=$i+1?>', this);" id="f_ct_resolution_btn<?=$i+1?>" value="<?=$row_c['idx']?>" class="btn btn-outline-secondary <? if($_GET['ct_cate_idx']==$row_c['idx']) { ?> btn-info text-white<? } ?>"><?=$row_c['ct_name']?></button>
                                                        <?
                                                        $i++;
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-group row align-items-center mb-0">
                                        <div class="col-sm-12 text-center">
                                            <input type="submit" class="btn btn-primary" value="검색" />
                                            <input type="button" class="btn btn-secondary ml-2" value="초기화" onclick="location.href='./contents_template_list.php'" />
                                            <input type="button" class="btn btn-info float-right" value="신규등록" onclick="location.href='./contents_form.php?act=input&ct_type=2'"/>
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
                                    노출
                                </th>
                                <th class="text-center">
                                    카테고리
                                </th>
                                <th class="text-center">
                                    필터링 카테고리
                                </th>
                                <th class="text-center" style="width: 20%;">
                                    콘텐츠명
                                </th>
                                <th class="text-center">
                                    해상도
                                </th>
                                <th class="text-center">
                                    판매가격
                                </th>
                                <th class="text-center">
                                    등록일
                                </th>
                                <th class="text-center">
                                    아티스트
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
                                    if($row['ct_show'] == 'Y') {
                                        $ct_show = "노출";
                                    } else {
                                        $ct_show = "노출안함";
                                    }
                                    $query = "select * from category_t where idx = ".$row['ct_cate_idx'];
                                    $category1 = $DB->fetch_assoc($query);
                                    $query = "select * from category_t where idx = ".$row['ct_cate_idx2'];
                                    $category2 = $DB->fetch_assoc($query);
                                    $filter = explode(",", $row['ct_filter']);
                                    foreach ($filter as $val) {
                                        if($val) {
                                            $filtering .= $arr_filter[$val].",";
                                        }
                                    }
                                    $filtering = substr($filtering, 0, -1);
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <?=$counts?>
                                        </td>
                                        <td class="text-center">
                                            <?=$ct_show?>
                                        </td>
                                        <td class="text-center">
                                            <?=$category1['ct_name']?> > <?=$category2['ct_name']?>
                                        </td>
                                        <td class="text-center">
                                            <?=cut_str(get_text($filtering), 0, 5, '...')?>
                                        </td>
                                        <td class="text-center">
                                            <?=$row['ct_title'];?>
                                        </td>
                                        <td class="text-center">
                                            <?=$row['ct_resolution'];?>
                                        </td>
                                        <td class="text-center">
                                            <?=number_format($row['ct_price'])?>원
                                        </td>
                                        <td class="text-center">
                                            <?=DateType($row['ct_wdate'], 4)?>
                                        </td>
                                        <td class="text-center">
                                            <? if($row['mt_nickname']) echo $row['mt_nickname']; else echo "effect korea"; ?>
                                        </td>
                                        <td class="text-center">
                                            <input type="button" class="btn btn-outline-dark btn-sm" value="상세" onclick="location.href='./contents_form.php?act=update&ct_type=2&ct_idx=<?=$row['ct_idx']?>&<?=$_get_txt.$_GET['pg']?>'" />
                                            <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="delete_contents('<?=$row['ct_idx']?>')" />
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
    function delete_contents(idx) {
        if(confirm("정말로 콘텐츠를 삭제하시겠습니까?")) {
            $.ajax({
                type: 'post',
                url: './contents_update.php',
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

    function f_category(chk_t, e) {
        if(chk_t=='') {
            $('#f_ct_resolution_btn1').addClass('btn-info text-white');
            $('#f_ct_resolution_btn2').removeClass('btn-info text-white');
            $('#f_ct_resolution_btn3').removeClass('btn-info text-white');
            $('#f_ct_resolution_btn4').removeClass('btn-info text-white');
            $('#f_ct_resolution_btn5').removeClass('btn-info text-white');
        } else {
            var length = $('button[id^="f_ct_resolution_btn"]').length;
            for(var i = 1; i<length+1; i++) {
                if(i == chk_t) {
                    $('#f_ct_resolution_btn'+i).addClass('btn-info text-white');
                } else {
                    $('#f_ct_resolution_btn'+i).removeClass('btn-info text-white');
                }
            }
        }
        $('#ct_cate_idx').val($("#"+e.id).val());

        return false;
    }
</script>
<?
include "./foot_inc.php";
?>
