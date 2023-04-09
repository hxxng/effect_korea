<?
include "./head_inc.php";
$chk_menu = '2';
$chk_sub_menu = '4';
include "./head_menu_inc.php";

$query = "
		select * from terms_t
	";
$row = $DB->fetch_query($query);
?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">로고관리</h4>
                        <p class="card-description">
                            Chrome 사용을 권장합니다. 이외의 브라우저 또는 Chrome 하위버전으로 접속 할 경우 페이지가 깨져 보일 수 있습니다.
                        </p>
                        <form method="post" name="frm_form" id="frm_form" action="terms_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" enctype="multipart/form-data">
                            <input type="hidden" name="act" id="act" value="logo_update" />
                            <div class="form-group row" id="primary" style="margin-bottom: 0px;">
                                <div class="card-body">
                                    <p class="mb-0"></p>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">로고등록 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                                <div class="col-sm-4">
                                                    <input type="file" name="tt_image" id="tt_image" value="<?=$row['tt_image']?>" accept=".png, .jpg, .jpeg" class="d-none">
                                                    <input type="hidden" name="tt_image_on" id="tt_image_on" value="<?=$row['tt_image']?>" class="form-control">

                                                    <label for="tt_image" class="plus-input" id="tt_image_box"><?php echo ($row['tt_image']) ? "<img src='".$ct_img_url."/".$row['tt_image']."?cache=".time()."'>" : "<i class=\"mdi mdi-plus\"></i>"; ?></label>
                                                    <button type="button" class="btn btn-sm btn-outline-primary ml-5 mt-2" onclick="$('#tt_image').click();">변경</button>
                                                    <small id="select_category_help" class="form-text text-muted">
                                                        - 높이 40px<br>
                                                        - png로만 등록해주세요.
                                                    </small>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <p class="p-3 text-center">
                                <input type="submit" value="저장" class="btn btn-outline-primary" />
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#tt_image').on('change', function(e) {
            preview_image_multi_selected(e, '');
        });

        function openTab(evt, tabid) {
            var i, tabcontent, tablinks;

            tabcontent = document.getElementsByClassName("tab_area");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            document.getElementById(tabid).style.display = "flex";
            evt.currentTarget.className += " active";
        }
    </script>
<?
include "./foot_inc.php";
?>