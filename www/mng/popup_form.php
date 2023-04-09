<?
include "./head_inc.php";
$chk_menu = "5";
$chk_sub_menu = '3';
include "./head_menu_inc.php";

$_act = $_GET['act'];
if($_act == "input") {
    $act_title = "등록";
} else {
    $act_title = "수정";
    $query = "select a1.*, a1.idx as pt_idx from popup_t a1 where a1.idx = '".$_GET['pt_idx']."'";
    $row = $DB->fetch_query($query);
}
$list_url_t = "popup_list.php";


$_get_txt = "pg=".$_GET['pg'];
?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">팝업 <?=$act_title?></h4>
                        <p class="card-description">
                            Chrome 사용을 권장합니다. 이외의 브라우저 또는 Chrome 하위버전으로 접속 할 경우 페이지가 깨져 보일 수 있습니다.
                        </p>
                        <form method="post" name="frm_form" id="frm_form" action="./popup_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" enctype="multipart/form-data">
                            <input type="hidden" name="act" id="act" value="<?=$_act?>" />
                            <input type="hidden" name="idx" id="idx" value="<?=$row['idx']?>" />

                            <div class="form-group row">
                                <div class="card-body">
                                    <p class="mb-0"></p>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">기본 이미지 등록 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="pt_file" id="pt_file" value="<?=$row['pt_file']?>" accept=".jpeg, .jpg, .png, .gif" class="d-none">
                                                    <input type="hidden" name="pt_file_on" id="pt_file_on" value="<?=$row['pt_file']?>" class="form-control">

                                                    <label for="pt_file" class="plus-input-small" id="file_name" style="width: 200px;height: 300px;line-height: 300px;"><i class="mdi mdi-plus"></i></label>
                                                    <label class="plus-input-small" id="pt_file_box" style="width: 200px;height: 300px;border: none;<? if($row['pt_file']) echo ''; else echo 'display: none;';?>">
                                                        <img src='<?=$ct_img_url."/".$row['pt_file']."?cache=".strtotime($row['pt_udate'])?>' style="width: 200px;height: 300px;">
                                                    </label>
                                                    <div class="input-group">
                                                        <small id="select_category_help" class="form-text text-muted">
                                                            - 크기 고정 : 500px * 600px<br/>
                                                            - 단 1개 이미지만 등록가능<br/>
                                                            - jpg, jpeg, png, gif 확장자로 등록 가능
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="bt_contents" class="col-sm-2 col-form-label">url <i class="mdi mdi-circle-medium text-danger"></i></label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="pt_url" value="<?=$row['pt_url']?>" />
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="bt_contents" class="col-sm-2 col-form-label">팝업 게시기간 설정 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                                <div class="col-sm-2">
                                                    <input type="date" class="form-control" name="pt_sdate" value="<?=$row['pt_sdate']?>" />
                                                </div>
                                                ~
                                                <div class="col-sm-2">
                                                    <input type="date" class="form-control" name="pt_edate" value="<?=$row['pt_edate']?>" />
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="fixed-bottom product_form">
                                <p class="p-3 mt-3 text-center">
                                    <input type="button" value="목록" onclick="location.href='<?=$list_url_t."?".$_get_txt?>'" class="btn btn-outline-secondary mx-2" />
                                    <input type="submit" value="저장" class="btn btn-info" />
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("input[name='bt_show'][value='<?=$row['bt_show']?>']").prop("checked", true);
        });
        function frm_form_chk(f) {
            if(f.pt_file.value=="" && f.pt_file_on.value=="") {
                alert("메인배너를 등록해주세요.");
                return false;
            }
            if(f.pt_url.value=="") {
                alert("url을 입력해주세요.");
                f.pt_url.focus();
                return false;
            }
            if(f.pt_sdate.value=="") {
                alert("팝업 게시 시작일자를 선택해주세요.");
                f.pt_sdate.focus();
                return false;
            }
            if(f.pt_edate.value=="") {
                alert("팝업 게시 종료일자를 선택해주세요.");
                f.pt_edate.focus();
                return false;
            }
            $('#splinner_modal').modal('show');
        }
        $('#pt_file').on('change', function(e) {
            var target_id = e.target.id;
            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);

            filesArr.forEach(function(f) {
                if("<?=$_GET['type']?>" != "main") {
                    if(!f.type.match("image.*")) {
                        alert("확장자는 이미지 확장자만 가능합니다.");
                        return;
                    }
                }

                sel_files.push(f);

                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#"+target_id+"_box").css('display', 'block');
                    $("#"+target_id+"_box").css('border', 'none');
                    $("#"+target_id+"_box").html('<img src="'+e.target.result+'" style="width: 100%;height: 100%;" /><i class="mdi mdi-close" style="position: relative;bottom: 323px;left: 87px;color:red;cursor: pointer;font-size: 20px;" onclick="del_img2('+target_id+')"></i>')
                }
                reader.readAsDataURL(f);
            });
        });
        function del_img2(e) {
            var id = e.id;
            $("#"+id).val("");
            $("#"+id+"_box").html('');
            $("#file_name").html('<i class="mdi mdi-plus"></i>');
            setTimeout(function() {
                $("#file_name").attr('for', 'pt_file');
            }, 1000);
        }
    </script>
<?
include "./foot_inc.php";
?>