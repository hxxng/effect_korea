<?
include "./head_inc.php";
$chk_menu = "2";

$_act = $_GET['act'];
if($_act == "input") {
    $act_title = "등록";
} else {
    $act_title = "수정";
    $query = "select a1.*, a1.idx as bt_idx from banner_t a1 where a1.idx = '".$_GET['bt_idx']."'";
    $row = $DB->fetch_query($query);
}
if($_GET['type'] == "main") {
    $menu = "1";
    $url = "banner_main_list.php";
    $title = "메인배너";
} else if($_GET['type'] == "1") {
    $menu = "2";
    $url = "banner_ads1_list.php";
    $title = "광고배너1";
} else {
    $menu = "3";
    $url = "banner_ads2_list.php";
    $title = "광고배너2";
}
$chk_sub_menu = $menu;
$list_url_t = $url;
include "./head_menu_inc.php";

$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&bt_language=".$_GET['bt_language']."&pg=".$_GET['pg'];
?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?=$title." ".$act_title?></h4>
                        <p class="card-description">
                            Chrome 사용을 권장합니다. 이외의 브라우저 또는 Chrome 하위버전으로 접속 할 경우 페이지가 깨져 보일 수 있습니다.
                        </p>
                        <form method="post" name="frm_form" id="frm_form" action="./banner_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" enctype="multipart/form-data">
                            <input type="hidden" name="act" id="act" value="<?=$_act?>" />
                            <input type="hidden" name="idx" id="idx" value="<?=$row['idx']?>" />
                            <input type="hidden" name="type" id="type" value="<?=$_GET['type']?>" />

                            <div class="form-group row">
                                <div class="card-body">
                                    <p class="mb-0"></p>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">구분 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                                <div class="col-sm-10">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="language1" name="bt_language" value="1" class="custom-control-input" <?=($row['bt_language'] == 1 || $row['bt_language'] == '' || $_GET['bt_language'] == "" || $_GET['bt_language'] == 1) ? 'checked' : ''?>>
                                                        <label class="custom-control-label" for="language1">한국어</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="language2" name="bt_language" value="2" class="custom-control-input" <?=$row['bt_language'] == 2 || $_GET['bt_language'] == 2 ? 'checked' : ''?>>
                                                        <label class="custom-control-label" for="language2">English</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">메인배너 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="bt_file" id="bt_file" value="<?=$row['bt_file']?>" accept="<? if($_GET['type'] == "main") echo '.mp4'; else echo '.jpeg, .jpg, .png, .gif'; ?>" class="d-none">
                                                    <input type="hidden" name="bt_file_on" id="bt_file_on" value="<?=$row['bt_file']?>" class="form-control">

                                                    <label for="bt_file" class="plus-input-small" id="file_name" style="width: 300px;height: 140px;line-height: 140px;"><i class="mdi mdi-plus"></i></label>
                                                    <label class="plus-input-small" id="bt_file_box" style="width: 140px;height: 140px;border: none;<? if($row['bt_file']) echo ''; else echo 'display: none;';?>">
                                                        <? if($_GET['type'] == "main") { ?>
                                                        <video controls width="300" height="100%">
                                                            <source src="<?=$ct_img_url."/".$row['bt_file']."?cache=".time()?>" type="video/mp4">
                                                        </video>
                                                        <? } else { ?>
                                                        <img src='<?=$ct_img_url."/".$row['bt_file']."?cache=".time()?>' style="width: 140px;height: 140px;">
                                                        <? } ?>
                                                    </label>
                                                    <div class="input-group">
                                                        <small id="select_category_help" class="form-text text-muted">
                                                            <? if($_GET['type'] == "main") { ?>
                                                            - 단 1개 영상만 등록가능<br/>
                                                            - mp4 확장자, 16:9(1920px * 1080px)로 등록해 주세요
                                                            <? } else { ?>
                                                            - 4:0.6비율(최소크기 : 1600px * 240px)<br/>
                                                            - 단 1개 이미지만 등록가능<br/>
                                                            - jpg, jpeg, png, gif 확장자로 등록 가능
                                                            <? } ?>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <script>
                                            if("<?=$row['mct_video']?>" != "") {
                                                $("#video_delete").removeClass("d-none");
                                            }
                                        </script>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="bt_contents" class="col-sm-2 col-form-label">배너 내용</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="bt_contents" value="<?=$row['bt_contents']?>" />
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
            if(f.bt_file.value=="" && f.bt_file_on.value=="") {
                alert("메인배너를 등록해주세요.");
                return false;
            }
            $('#splinner_modal').modal('show');
        }
        $('#bt_file').on('change', function(e) {
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
                    if("<?=$_GET['type']?>" != "main") {
                        $("#"+target_id+"_box").css('display', 'block');
                        $("#"+target_id+"_box").css('border', 'none');
                        $("#"+target_id+"_box").html('<img src="'+e.target.result+'" style="width: 100%;height: 100%;" /><i class="mdi mdi-close" style="position: relative;bottom: 165px;left: 58px;color:red;cursor: pointer;font-size: 20px;" onclick="del_img2('+target_id+')"></i>')
                    } else {
                        $("#file_name").html(f.name+'<i class="mdi mdi-close" style="position: relative;bottom: 54px;left: 7px;color:red;cursor: pointer;font-size: 20px;" onclick="del_img2('+target_id+')"></i>');
                        $("#file_name").attr("for", "");
                    }
                }
                reader.readAsDataURL(f);
            });
            $("#mct_image_box").css("display", "table-cell");
        });
        function del_img(idx, type, name) {
            let title = "";
            if(type == "image") {
                title = "이미지는";
            } else {
                title = "영상은";
            }
            if(confirm("삭제하시겠습니까?\n※삭제한 "+title+" 복구할 수 없습니다.")) {
                $.ajax({
                    type: 'post',
                    url: './banner_update.php',
                    dataType: 'json',
                    data: {act: 'del_img', idx: idx, name: name},
                    success: function (d, s) {
                        if(d['result'] == "_ok") {
                            alert(d['msg']);
                            location.reload();
                        }
                    },
                    cache: false
                });
            }
        }
        function del_img2(e) {
            var id = e.id;
            $("#"+id).val("");
            $("#"+id+"_box").html('');
            $("#file_name").html('<i class="mdi mdi-plus"></i>');
            setTimeout(function() {
                $("#file_name").attr('for', 'bt_file');
            }, 1000);
        }
    </script>
<?
include "./foot_inc.php";
?>