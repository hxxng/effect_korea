<?
include "./head_inc.php";
$chk_menu = '5';
$chk_sub_menu = '3';
include "./head_menu_inc.php";

$_get_txt = "pg=";

$n_limit = $n_limit_num;
$pg = $_GET['pg'];
$_colspan_txt = "9";

$query = "select a1.*, a1.idx as pt_idx from popup_t a1 ";
$query_count = "select count(*) from popup_t a1 ";

$row_cnt = $DB->fetch_query($query_count);
$couwt_query = $row_cnt[0];
$counts = $couwt_query;
$n_page = ceil($couwt_query / $n_limit_num);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;
$counts = $counts - (($pg - 1) * $n_limit_num);

unset($list);
$sql_query = $query." order by a1.pt_wdate desc limit ".$n_from.", ".$n_limit;
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
                        <h4 class="card-title">팝업관리</h4>
                        <div class="card-description float-right">
                            <input type="button" class="btn btn-info" value="신규등록" onclick="location.href='./popup_form.php?act=input&<?=$_get_txt.$_GET['pg']?>'"/>
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
                                <th class="text-center" style="width: 25%;">
                                    팝업이미지
                                </th>
                                <th class="text-center">
                                    url
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
                                            <div class="media">
                                                <img src="<?=$ct_img_url.'/'.$row['pt_file']."?cache=".strtotime($row['pt_udate'])?>" class="align-self-center" style="width: 100%;height:80px;border-radius: 0;">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <?=$row['pt_url']?>
                                        </td>
                                        <td class="text-center">
                                            <input type="button" class="btn btn-outline-dark btn-sm" value="수정" onclick="location.href='./popup_form.php?act=update&pt_idx=<?=$row['pt_idx']?>&<?=$_get_txt.$_GET['pg']?>'" />
                                            <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="delete_popup('<?=$row['pt_idx']?>')" />
                                        </td>
                                    </tr>
                                    <script>
                                        if("<?=$row['pt_show']?>" == "Y") {
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
    function delete_popup(idx) {
        if(confirm("정말로 삭제하시겠습니까?")) {
            $.ajax({
                type: 'post',
                url: './popup_update.php',
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
            url: './popup_update.php',
            dataType: 'json',
            data: {act: "chg_show", idx: input.dataset['idx'], pt_show: e.checked},
            success: function (d, s) {
                if(d['result'] == "false") {
                    alert(d['msg']);
                }
                location.reload();
            },
            cache: false
        });
    }
</script>
<?
include "./foot_inc.php";
?>
