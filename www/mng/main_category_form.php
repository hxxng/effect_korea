<?
include "./head_inc.php";
$chk_menu = '1';
$chk_sub_menu = '1';
include "./head_menu_inc.php";

$query = "select a1.*, a1.idx as mct_idx from main_category_t a1 where a1.idx = '".$_GET['mct_idx']."'";
$row = $DB->fetch_query($query);

$_act = $_GET['act'];
if($_act == "input") {
    $title = "신규등록";
} else {
    $title = "수정";
}
$list_url_t = "main_category_list.php";

$_get_txt = "pg=".$_GET['pg'];
?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">대표카테고리 <?=$title?></h4>
                        <p class="card-description">
                            Chrome 사용을 권장합니다. 이외의 브라우저 또는 Chrome 하위버전으로 접속 할 경우 페이지가 깨져 보일 수 있습니다.
                        </p>
                        <form method="post" name="frm_form" id="frm_form" action="./main_category_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" enctype="multipart/form-data">
                            <input type="hidden" name="act" id="act" value="<?=$_act?>" />
                            <input type="hidden" name="idx" id="idx" value="<?=$row['idx']?>" />

                            <div class="form-group row">
                                <div class="card-body">
                                    <p class="mb-0"></p>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">대표이미지 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="mct_image" id="mct_image" value="<?=$row['mct_image']?>" accept=".jpeg, .jpg, .png, .gif" class="d-none">
                                                    <input type="hidden" name="mct_image_on" id="mct_image_on" value="<?=$row['mct_image']?>" class="form-control">

                                                    <label for="mct_image" class="plus-input-small" style="width: 140px;height: 140px;line-height: 140px;"><i class="mdi mdi-plus"></i></label>
                                                    <label class="plus-input-small" id="mct_image_box" style="width: 140px;height: 140px;border: none;
                                                    <? if($row['mct_image']) echo ''; else echo 'display: none;';?>"><img src='<?=$ct_img_url."/".$row['mct_image']."?cache=".time()?>' style="width: 140px;height: 140px;"><i class="mdi mdi-close" style="position: relative;bottom: 165px;left: 58px;color:red;cursor: pointer;font-size: 20px;" onclick="del_img('<?=$row['mct_idx']?>', 'image', '<?=$row['mct_image']?>')"></i>
                                                    </label>
                                                    <div class="input-group">
                                                        <small id="select_category_help" class="form-text text-muted">
                                                            - 한 개 등록 가능<br/>
                                                            - 16:9비율(최소크기 : 297px * 167px)<br/>
                                                            - jpeg, jpg, png, gif 등록 가능(정지된 이미지로 노출)
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">대표영상 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="mct_video" id="mct_video" value="<?=$row['mct_video']?>" accept=".mp4" class="d-none">
                                                    <input type="hidden" name="mct_video_on" id="mct_video_on" value="<?=$row['mct_video']?>" class="form-control">
                                                    <div class="input-group">
                                                        <label type="button" for="mct_video" class="btn-sm btn-secondary mr-2 mt-1">파일 첨부</label>
                                                        <input type="text" value="<?=$row['mct_video']?>" id="video_name" class="form-control col-sm-4" readonly/>
                                                        <i class="mdi mdi-close d-none" id="video_delete" style="position: relative;bottom: -3px;right: 30px;color:red;cursor: pointer;font-size: 20px;" onclick="del_img('<?=$row['mct_idx']?>', 'video', '<?=$row['mct_video']?>')"></i>
                                                    </div>
                                                    <div class="input-group">
                                                        <small id="select_category_help" class="form-text text-muted">
                                                            - 단 한 개 등록 가능<br/>
                                                            - 16:9비율(최소크기 : 297px * 167px)<br/>
                                                            - mp4 등록 가능(마우스오버시 움직이는 영상으로 노출)
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
                                                <label for="ct_title" class="col-sm-2 col-form-label">카테고리 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                                <div class="col-sm-2">
                                                    <select id="ct_idx" name="ct_idx" class="form-control">
                                                        <option value="">선택</option>
                                                        <?
                                                        $query = "select * from category_t where ct_name <> '4K' and ct_name <> 'Drone' and ct_level = 1";
                                                        $category = $DB->select_query($query);
                                                        if($category) {
                                                            foreach ($category as $row_c) {
                                                                echo '<option value="'.$row_c['idx'].'">'.$row_c['ct_name'].'</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <script>
                                            $("#ct_idx").val("<?=$row['ct_idx']?>");
                                        </script>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">카테고리 노출순서 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" numberonly="" name="mct_orderby" value="<?=$row['mct_orderby']?>" />
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
        function frm_form_chk(f) {
            if(f.mct_image.value=="" && f.mct_image_on.value=="") {
                alert("대표이미지를 등록해주세요.");
                return false;
            }
            if(f.mct_video.value=="" && f.mct_video_on.value=="") {
                alert("대표영상을 등록해주세요.");
                return false;
            }
            if(f.ct_idx.value=="") {
                alert("카테고리를 선택해주세요.");
                return false;
            }
            if(f.mct_orderby.value=="") {
                alert("카테고리 노출순서를 입력해주세요.");
                return false;
            }
            $('#splinner_modal').modal('show');
        }
        $('#mct_image').on('change', function(e) {
            var target_id = e.target.id;
            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);

            filesArr.forEach(function(f) {
                if(!f.type.match("image.*")) {
                    alert("확장자는 이미지 확장자만 가능합니다.");
                    return;
                }

                sel_files.push(f);

                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#"+target_id+"_box").css('border', 'none');
                    $("#"+target_id+"_box").html('<img src="'+e.target.result+'" style="width: 100%;height: 100%;" /><i class="mdi mdi-close" style="position: relative;bottom: 165px;left: 58px;color:red;cursor: pointer;font-size: 20px;" onclick="del_img2('+target_id+')"></i>')
                }
                reader.readAsDataURL(f);
            });
            $("#mct_image_box").css("display", "table-cell");
        });
        $('#mct_video').on('change', function(e) {
            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);

            filesArr.forEach(function(f) {
                sel_files.push(f);

                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#video_name").val(f.name);
                }
                reader.readAsDataURL(f);
            });
            $("#video_delete").removeClass("d-none");
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
                    url: './main_category_update.php',
                    dataType: 'json',
                    data: {act: 'del_img', idx: idx, type: type, name: name},
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
    </script>
<?
include "./foot_inc.php";
?>