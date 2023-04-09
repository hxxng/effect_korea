<?
include "./head_inc.php";
$chk_menu = '1';
$chk_sub_menu = '3';
include "./head_menu_inc.php";

$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&ct_status=".$_GET['ct_status']."&ct_type=".$_GET['ct_type']."&pg=";

$n_limit = $n_limit_num;
$pg = $_GET['pg'];
$_colspan_txt = "10";

$query = "select a1.*, a1.idx as ct_idx, a2.ct_name, a3.ct_name 
from contents_t a1 
left join category_t a2 on a2.idx = a1.ct_cate_idx
left join category_t a3 on a3.idx = a1.ct_cate_idx2";
$query_count = "select count(*) from contents_t a1 
left join category_t a2 on a2.idx = a1.ct_cate_idx
left join category_t a3 on a3.idx = a1.ct_cate_idx2";
$where_query = " where 1=1 ";

if($_GET['search_txt']!="") {
    $_where = " and ";
    if($_GET['sel_search']=="all") {
        $where_query .= $_where."(instr(a1.ct_title, '".$_GET['search_txt']."') or instr(a1.ct_resolution, '".$_GET['search_txt']."') or instr(a1.ct_price, '".$_GET['search_txt']."') or (instr(a2.ct_name, '".$_GET['search_txt']."') or instr(a3.ct_name, '".$_GET['search_txt']."')))";
    } else {
        if($_GET['sel_search'] == "a1.category") {
            $where_query .= $_where."(instr(a2.ct_name, '".$_GET['search_txt']."') or instr(a3.ct_name, '".$_GET['search_txt']."'))";
        } else {
            $where_query .= $_where."instr(".$_GET['sel_search'].", '".$_GET['search_txt']."')";
        }
    }
}
if($_GET['ct_status']!="") {
    $where_query .= " and ct_status = ".$_GET['ct_status'];
}
if($_GET['ct_type']!="") {
    $where_query .= " and ct_type = ".$_GET['ct_type'];
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
                        <h4 class="card-title">콘텐츠승인관리</h4>
                        <form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" onsubmit="return frm_search_chk(this);">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="form-group row align-items-center mb-0">
                                        <label for="sel_search" class="col-sm-2 col-form-label">검색어</label>
                                        <div class="col-sm-1">
                                            <div class="input-group">
                                                <select name="sel_search" id="sel_search" class="form-control form-control-sm">
                                                    <option value="all">통합검색</option>
                                                    <option value="a1.category">카테고리</option>
                                                    <option value="a1.ct_title">컨텐츠명</option>
                                                    <option value="a1.ct_resolution">해상도</option>
                                                    <option value="a1.ct_price">판매가격</option>
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
                                            <input type="hidden" name="ct_status" id="mt_approve" value="<?=$_GET['ct_status']?>" />
                                            <div class="btn-group" role="group" aria-label="mt_approve">
                                                <button type="button" onclick="f_mt_approve('');" id="f_mt_approve_btn1" class="btn btn-outline-secondary<? if($_GET['ct_status']=='') { ?> btn-info text-white<? } ?>">전체</button>
                                                <button type="button" onclick="f_mt_approve('1');" id="f_mt_approve_btn2" class="btn btn-outline-secondary<? if($_GET['ct_status']=='1') { ?> btn-info text-white<? } ?>">승인대기</button>
                                                <button type="button" onclick="f_mt_approve('2');" id="f_mt_approve_btn3" class="btn btn-outline-secondary<? if($_GET['ct_status']=='2') { ?> btn-info text-white<? } ?>">승인완료</button>
                                                <button type="button" onclick="f_mt_approve('3');" id="f_mt_approve_btn4" class="btn btn-outline-secondary<? if($_GET['ct_status']=='3') { ?> btn-info text-white<? } ?>">반려</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-group row align-items-center mb-0">
                                        <label for="select_category" class="col-sm-2 col-form-label">구분</label>
                                        <div class="col-sm-6">
                                            <input type="hidden" name="ct_type" id="ct_type" value="<?=$_GET['ct_type']?>" />
                                            <div class="btn-group" role="group" aria-label="ct_type">
                                                <button type="button" onclick="f_ct_type('');" id="f_ct_type_btn1" class="btn btn-outline-secondary<? if($_GET['ct_type']=='') { ?> btn-info text-white<? } ?>">전체</button>
                                                <button type="button" onclick="f_ct_type('1');" id="f_ct_type_btn2" class="btn btn-outline-secondary<? if($_GET['ct_type']=='1') { ?> btn-info text-white<? } ?>">영상</button>
                                                <button type="button" onclick="f_ct_type('2');" id="f_ct_type_btn3" class="btn btn-outline-secondary<? if($_GET['ct_type']=='2') { ?> btn-info text-white<? } ?>">템플릿</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-group row align-items-center mb-0">
                                        <div class="col-sm-12 text-center">
                                            <input type="submit" class="btn btn-primary" value="검색" />
                                            <input type="button" class="btn btn-secondary ml-2" value="초기화" onclick="location.href='./contents_approve_list.php'" />
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
                        <input type="button" class="btn btn-sm btn-outline-dark" value="승인처리" onclick="all_approve()"/>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">
                                    <input type="checkbox" class="custom-checkbox-list" onclick="f_checkbox_all('chk_all')" />
                                </th>
                                <th class="text-center">
                                    번호
                                </th>
                                <th class="text-center">
                                    승인상태
                                </th>
                                <th class="text-center">
                                    프리뷰 생성
                                </th>
                                <th class="text-center">
                                    카테고리
                                </th>
                                <th class="text-center">
                                    카테고리필터링
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
                                    승인일
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
                                    if($row['ct_status'] == 1) {
                                        $ct_status = "승인대기";
                                    } else if($row['ct_status'] == 2) {
                                        $ct_status = "승인완료";
                                    } else if($row['ct_status'] == 3) {
                                        $ct_status = "반려";
                                    } else {
                                        $ct_status = "승인중";
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
                                            <input type="checkbox" id="chk_all" name="chk_all[]" value="<?=$row['ct_idx']?>" class="custom-checkbox-list" <? if($row['ct_preview_file'] == "Y") echo 'disabled'; ?>>
                                        </td>
                                        <td class="text-center">
                                            <?=$counts?>
                                        </td>
                                        <td class="text-center">
                                            <?=$ct_status?>
                                        </td>
                                        <td class="text-center">
                                            <?=$row['ct_preview_file']?>
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
                                            <?=DateType($row['ct_acdate'], 4)?>
                                        </td>
                                        <td class="text-center">
                                            <input type="button" class="btn btn-outline-dark btn-sm" value="상세" onclick="location.href='./contents_approve_form.php?act=update&ct_idx=<?=$row['ct_idx']?>&<?=$_get_txt.$_GET['pg']?>'" />
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

    function f_checkbox_all(obj) {
        $('input:checkbox[name="'+obj+'[]"]').each(function() {
            if($(this).prop('checked')==true) {
                $(this).prop('checked', false);
            } else {
                var disabled = $(this).prop("disabled"); //비활성화 여부 체크
                if(!disabled){ //비활성화가 아니라면
                    $(this).prop('checked', true); //체크 실행
                }
            }
        });

        return false;
    }

    function all_approve() {
        var chk_cnt = 0;
        var idx = '';

        $('input:checkbox[name="chk_all[]"]').each(function() {
            if($(this).prop('checked')==true) {
                chk_cnt++;
                idx += $(this).val()+'|';
            }
        });

        if(chk_cnt<1) {
            alert('처리할 콘텐츠를 선택해주세요.');
            return false;
        }

        if(idx=='') {
            return false;
        }
        $.ajax({
            type: 'post',
            url: './contents_update.php',
            dataType: 'json',
            data: {act: "status_chg", idx: idx},
            beforeSend: function() {
                $('#splinner_modal').modal('show');
            },
            success: function (d, s) {
                if(d['result']=='Y') {
                    alert('처리되었습니다.');
                } else {
                    alert('잘못된 접근입니다.');
                }
                document.location.reload();
            },
            cache: false
        });

        return false;
    }
</script>
<?
include "./foot_inc.php";
?>
