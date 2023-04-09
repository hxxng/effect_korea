<?
include "./head_inc.php";
$chk_menu = '6';
$chk_sub_menu = '1';
include "./head_menu_inc.php";
?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">인기검색어 설정</h4>
                        <div class="form-group row align-items-center mb-0">
                            <div class="col-sm-6">
                                <div class="btn-group" role="group" aria-label="ct_type">
                                    <button type="button" onclick="f_language('1');" id="f_ct_type_btn1" class="btn btn-outline-secondary <? if($_GET['pst_language'] == "" || $_GET['pst_language'] == 1) echo 'btn-info text-white';?>">한국어</button>
                                    <button type="button" onclick="f_language('2');" id="f_ct_type_btn2" class="btn btn-outline-secondary <? if($_GET['pst_language'] == 2) echo 'btn-info text-white';?>">English</button>
                                </div>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" style="border-top: 0;">
                                <h4 class="font-weight-bold mt-4">신규등록</h4>
                                <div class="form-group row align-items-center mb-0">
                                    <label for="pt_delivery_price" class="col-sm-2 col-form-label">검색어명 <b class="text-danger">*</b></label>
                                    <div class="col-sm-2">
                                        <input type="text" name="pst_text" id="pst_text" value="" class="form-control">
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-dark" onclick="save_txt()">저장</button>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mt-3">
                                    <h4 class="font-weight-bold ">인기검색어</h4>
                                    <span class="ml-4" style="color: red;">* 최대 4개까지 노출됩니다.</span>
                                </div>
                                <div class="form-group row align-items-center mb-0 mt-2">
                                <?
                                $query = "select * from popular_searchtxt_t ";
                                if($_GET['pst_language']) {
                                    $where_query = " where pst_language = ".$_GET['pst_language'];
                                } else {
                                    $where_query = " where pst_language = 1";
                                }
                                $list = $DB->select_query($query.$where_query);
                                $count = $DB->count_query($query.$where_query);
                                if($list) {
                                    foreach ($list as $row) {
                                ?>
                                    <div class="p-2 m-1" style="border: 1px solid #0e66a4;border-radius: 25px;color: #0e66a4;">
                                        <?=$row['pst_text']?><a class="ml-4" onclick="delete_txt('<?=$row['idx']?>')" style="color: black;cursor: pointer;">&times;</a>
                                    </div>
                                <?
                                    }
                                }
                                ?>
                                </div>
                                <input type="hidden" id="count" value="<?=$count?>">
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mt-3">
                                    <h4 class="font-weight-bold ">검색횟수 조회</h4>
                                </div>
                                <div class="form-group row align-items-center mb-0 mt-2">
                                    <?
                                    $query = "select *, count(slt_txt) as cnt from search_log_t ";
                                    if($_GET['pst_language']) {
                                        $where_query = " where slt_language = ".$_GET['pst_language'];
                                    } else {
                                        $where_query = " where slt_language = 1";
                                    }
                                    $where_query .= " group by slt_txt order by cnt desc";
                                    $list2 = $DB->select_query($query.$where_query);
                                    if($list2) {
                                        foreach ($list2 as $row2) {
                                            ?>
                                            <div class="p-2 m-1" style="border: 1px solid #0e66a4;border-radius: 25px;color: #0e66a4;">
                                                <?=$row2['slt_txt']?>
                                                <span>&nbsp;&nbsp;/&nbsp;&nbsp;<?=$row2['cnt']?>회</span>
                                            </div>
                                            <?
                                        }
                                    }
                                    ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    function delete_txt(idx) {
        if(confirm("정말로 삭제하시겠습니까?")) {
            $.ajax({
                type: 'post',
                url: './searchtxt_update.php',
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
        location.replace("./searchtxt_list.php?pst_language="+language);
    }
    function save_txt() {
        if($("#count").val() >= 4) {
            alert("인기검색어는 최대 4개까지 등록가능합니다.");
            return false;
        } else {
            $.ajax({
                type: 'post',
                url: './searchtxt_update.php',
                dataType: 'json',
                data: {act: "input", pst_text: $("#pst_text").val(), pst_language: "<?=$_GET['pst_language']?>"},
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
