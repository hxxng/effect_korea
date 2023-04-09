<?
include "./head_inc.php";
$chk_menu = '2';
$chk_sub_menu = '1';
include "./head_menu_inc.php";

$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&bt_language=".$_GET['bt_language']."&pg=";

$n_limit = $n_limit_num;
$pg = $_GET['pg'];
$_colspan_txt = "9";

$query = "select a1.*, a1.idx as bt_idx from banner_t a1 where bt_main = 'Y'";
$query_count = "select count(*) from banner_t a1 where bt_main = 'Y'";
if($_GET['bt_language']) {
    $where_query = " and bt_language = ".$_GET['bt_language'];
} else {
    $where_query = " and bt_language = 1";
}

$row_cnt = $DB->fetch_query($query_count.$where_query);
$couwt_query = $row_cnt[0];
$counts = $couwt_query;
$n_page = ceil($couwt_query / $n_limit_num);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;
$counts = $counts - (($pg - 1) * $n_limit_num);

unset($list);
$sql_query = $query.$where_query." order by a1.bt_wdate desc limit ".$n_from.", ".$n_limit;
$list = $DB->select_query($sql_query);
?>
<style>
    input[type="checkbox"] {
        display: none;
    }

    .label__on-off {
        overflow: hidden;
        position: relative;
        display: inline-block;
        width: 58px;
        height: 26px;
        -webkit-border-radius: 13px;
        -moz-border-radius: 13px;
        border-radius: 13px;
        background-color: #ed4956;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        -webkit-transition: all .3s;
        -moz-transition: all .3s;
        -ms-transition: all .3s;
        -o-transition: all .3s;
        transition: all .3s;
    }

    .label__on-off > * {
        vertical-align: middle;
        -webkit-transition: all .3s;
        -moz-transition: all .3s;
        -ms-transition: all .3s;
        -o-transition: all .3s;
        transition: all .3s;
        font-size: 14px;
        font-weight: 100;
    }

    .label__on-off .marble {
        position: absolute;
        top: 1px;
        left: 1px;
        display: block;
        width: 24px;
        height: 24px;
        background-color: #fff;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, .3);
        -moz-box-shadow: 0 0 10px rgba(0, 0, 0, .3);
        box-shadow: 0 0 10px rgba(0, 0, 0, .3);
    }

    .label__on-off .on {
        display: none;
        padding-right: 25px;
        line-height: 25px;
    }

    .label__on-off .off {
        padding-left: 30px;
        line-height: 25px;
    }

    .input__on-off:checked + .label__on-off {
        background-color: #0bba82;
    }

    .input__on-off:checked + .label__on-off .on {
        display: inline-block;
    }

    .input__on-off:checked + .label__on-off .off {
        display: none;
    }

    .input__on-off:checked + .label__on-off .marble {
        left: 33px;
    }
</style>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">메인배너관리</h4>
                        <div class="card-description float-right">
                            <input type="button" class="btn btn-info" value="신규등록" onclick="location.href='./banner_form.php?type=main&act=input&<?=$_get_txt.$_GET['pg']?>'"/>
                        </div>
                        <div class="form-group row align-items-center mb-0">
                            <div class="col-sm-6">
                                <input type="hidden" name="ct_type" id="ct_type" value="">
                                <div class="btn-group" role="group" aria-label="ct_type">
                                    <button type="button" onclick="f_language('1');" id="f_ct_type_btn1" class="btn btn-outline-secondary <? if($_GET['bt_language'] == "" || $_GET['bt_language'] == 1) echo 'btn-info text-white';?>">한국어</button>
                                    <button type="button" onclick="f_language('2');" id="f_ct_type_btn2" class="btn btn-outline-secondary <? if($_GET['bt_language'] == 2) echo 'btn-info text-white';?>">English</button>
                                </div>
                            </div>
                        </div>
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
                                    배너내용
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
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <?=$counts?>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" id="switch<?=$counts?>" name="switch<?=$counts?>" class="input__on-off" onclick="chg_show(this)" data-idx="<?=$row['idx']?>">
                                            <label for="switch<?=$counts?>" class="label__on-off mb-0">
                                                <span class="marble"></span>
                                                <span class="on">on</span>
                                                <span class="off">off</span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <?=$row['bt_contents']?>
                                        </td>
                                        <td class="text-center">
                                            <input type="button" class="btn btn-outline-dark btn-sm" value="수정" onclick="location.href='./banner_form.php?type=main&act=update&bt_idx=<?=$row['bt_idx']?>&<?=$_get_txt.$_GET['pg']?>'" />
                                            <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="delete_banner('<?=$row['bt_idx']?>')" />
                                        </td>
                                    </tr>
                                    <script>
                                        if("<?=$row['bt_show']?>" == "Y") {
                                            $("#switch<?=$counts?>").prop("checked", "checked");
                                        }
                                    </script>
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
    function delete_banner(idx) {
        if(confirm("정말로 삭제하시겠습니까?")) {
            $.ajax({
                type: 'post',
                url: './banner_update.php',
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
    function chg_show(e) {
        var input=document.querySelector('#'+e.id);
        $.ajax({
            type: 'post',
            url: './banner_update.php',
            dataType: 'json',
            data: {act: "chg_show", idx: input.dataset['idx'], bt_show: e.checked},
            success: function (d, s) {
                if(d['result'] == "false") {
                    alert(d['msg']);
                }
                location.reload();
            },
            cache: false
        });
    }
    function f_language(language) {
        location.replace("./banner_main_list.php?bt_language="+language);
    }
</script>
<?
include "./foot_inc.php";
?>
