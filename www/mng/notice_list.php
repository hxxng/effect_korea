<?
include "./head_inc.php";
$chk_menu = '5';
$chk_sub_menu = '1';
include "./head_menu_inc.php";

$n_limit = $n_limit_num;
$pg = $_GET['pg'];
$_colspan_txt = "8";
$_get_txt = "pg=";
?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> 공지사항</h4>
                        <div class="card-description float-right">
                            <input type="button" class="btn btn-info" value="신규등록" onclick="location.href='./notice_form.php?act=input'"/>
                        </div>
                        <div class="form-group row align-items-center mb-0">
                            <div class="col-sm-6">
                                <div class="btn-group" role="group" aria-label="ct_type">
                                    <button type="button" onclick="f_language('1');" id="f_ct_type_btn1" class="btn btn-outline-secondary <? if($_GET['nt_language'] == "" || $_GET['nt_language'] == 1) echo 'btn-info text-white';?>">한국어</button>
                                    <button type="button" onclick="f_language('2');" id="f_ct_type_btn2" class="btn btn-outline-secondary <? if($_GET['nt_language'] == 2) echo 'btn-info text-white';?>">English</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 100px;">
                                    번호
                                </th>
                                <th class="text-center" style="width: 100px;">
                                    노출
                                </th>
                                <th class="text-center" style="width: 100px;">
                                    순서
                                </th>
                                <th class="text-left">
                                    내용
                                </th>
                                <th class="text-center" style="width: 120px;">
                                    작성일
                                </th>
                                <th class="text-center" style="width: 150px;">
                                    관리
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?
                            $where_query = " where 1=1 ";
                            $query = "
                                SELECT a1.*, a1.idx as nt_idx FROM notice_t a1
                            ";
                            $query_count = "
                                SELECT count(*) FROM notice_t a1
                            ";
                            if($_GET['nt_language']) {
                                $where_query .= " and nt_language = ".$_GET['nt_language'];
                            } else {
                                $where_query .= " and nt_language = 1";
                            }

                            $row_cnt = $DB->fetch_query($query_count.$where_query);
                            $couwt_query = $row_cnt[0];
                            $counts = $couwt_query;
                            $n_page = ceil($couwt_query / $n_limit_num);
                            if($pg=="") $pg = 1;
                            $n_from = ($pg - 1) * $n_limit;
                            $counts = $counts - (($pg - 1) * $n_limit_num);

                            unset($list);
                            $sql_query = $query.$where_query." order by a1.nt_orderby, a1.idx desc limit ".$n_from.", ".$n_limit;
                            $list = $DB->select_query($sql_query);

                            if($list) {
                                foreach($list as $row) {
                                    if($row['nt_show'] == "Y") {
                                        $nt_show = "노출";
                                    } else {
                                        $nt_show = "노출안함";
                                    }
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <?=$counts?>
                                        </td>
                                        <td class="text-center">
                                            <?=$nt_show?>
                                        </td>
                                        <td class="text-center">
                                            <?=$row['nt_orderby']?>
                                        </td>
                                        <td class="text-left">
                                            <?=cut_str(strip_tags($row['nt_content']), 0, 100, "..")?>
                                        </td>
                                        <td class="text-center">
                                            <?=DateType($row['nt_wdate'],1)?>
                                        </td>
                                        <td class="text-center">
                                            <input type="button" class="btn btn-outline-secondary btn-sm" value="상세" onclick="location.href='./notice_form.php?act=update&nt_idx=<?=$row['nt_idx']?>&<?=$_get_txt.$_GET['pg']?>'" />
                                            <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="delete_notice('<?=$row['nt_idx']?>')" />
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
        function delete_notice(idx) {
            if(confirm("정말로 삭제하시겠습니까?")) {
                $.ajax({
                    type: 'post',
                    url: './notice_update.php',
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
        function f_language(language) {
            location.replace("./notice_list.php?nt_language="+language);
        }
    </script>
<?
include "./foot_inc.php";
?>