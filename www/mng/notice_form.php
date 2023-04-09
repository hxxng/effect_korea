<?
include "./head_inc.php";
$chk_menu = '5';
$chk_sub_menu = '1';
$list_url_t = "notice_list.php";
$chk_ckeditor = 'Y';
include "./head_menu_inc.php";

if($_GET['act']=="update") {
    $_act = "update";
    $_act_txt = "수정";
    $_title = "공지사항 관리";
} else {
    $_act = "input";
    $_act_txt = "등록";
    $_title = "신규등록";
}

$query = "
    SELECT a1.*, a1.idx as nt_idx FROM notice_t a1
    where a1.idx = '".$_GET['nt_idx']."'
";
$row = $DB->fetch_query($query);

$_get_txt = "pg=";
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
                <form method="post" name="frm_form" id="frm_form" action="./notice_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" >
                <input type="hidden" name="act" id="act" value="<?=$_act?>" />
                <input type="hidden" name="nt_idx" id="nt_idx" value="<?=$_GET['nt_idx']?>" />
                <div class="card-body">
                    <h4 class="card-title"><?=$_title?></h4>
                    <ul class="list-group list-group-flush">
                        <?if($_act != "input") { ?>
                            <li class="list-group-item">
                                <div class="form-group row align-items-center mb-0">
                                    <label for="ct_title" class="col-sm-2 col-form-label">작성일</label>
                                    <div class="col-sm-2">
                                        <div class="input-group">
                                            <span><?=DateType($row['nt_wdate'],1)?></span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <? } ?>
                        <li class="list-group-item">
                            <div class="form-group row align-items-center mb-0">
                                <label for="ct_title" class="col-sm-2 col-form-label">구분 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                <div class="col-sm-10">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="language1" name="nt_language" value="1" class="custom-control-input" <?=($row['nt_language'] == 1 || $row['nt_language'] == '') ? 'checked' : ''?>>
                                        <label class="custom-control-label" for="language1">한국어</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="language2" name="nt_language" value="2" class="custom-control-input" <?=$row['nt_language'] == 2 ? 'checked' : ''?>>
                                        <label class="custom-control-label" for="language2">English</label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?if($_act != "input") { ?>
                            <li class="list-group-item">
                                <div class="form-group row align-items-center mb-0">
                                    <label for="ct_title" class="col-sm-2 col-form-label">노출 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                    <div class="col-sm-2">
                                        <div class="input-group">
                                            <select class="form-control custom-select" id="nt_show" name="nt_show">
                                                <option value="Y">노출</option>
                                                <option value="N">노출안함</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <? } ?>
                        <li class="list-group-item">
                            <div class="form-group row align-items-center mb-0">
                                <label for="ct_title" class="col-sm-2 col-form-label">순서 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                <div class="col-sm-2">
                                    <div class="input-group">
                                        <select class="form-control" id="nt_orderby" name="nt_orderby">
                                            <?
                                            for($i=1;$i<=20;$i++) {
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-group row align-items-center mb-0">
                                <label for="pt_delivery_price" class="col-sm-2 col-form-label">타이틀 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="nt_title" id="nt_title" value="<?=$row['nt_title']?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-group row align-items-center mb-0">
                                <label for="pt_delivery_price" class="col-sm-2 col-form-label">내용 <b class="text-danger">*</b></label>
                                <div class="col-sm-10">
                                    <textarea name="nt_content" id="nt_content" class="form-control form-control-sm"><?php echo $row['nt_content']?></textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace('nt_content', {
                                            extraPlugins: 'uploadimage, image2',
                                            height : '300px',
                                            filebrowserImageBrowseUrl : '',
                                            filebrowserImageUploadUrl : './file_upload.php?Type=Images&upload_name=nt_content',
                                            enterMode : CKEDITOR.ENTER_BR,
                                        });
                                    </script>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <p class="p-3 mt-3 text-center">
                    <input type="button" value="목록" onclick="location.href='./<?=$list_url_t?>?<?=$_get_txt?>'" class="btn btn-outline-secondary" />
                    <button type="submit" class="btn btn-primary mx-2" id="input_btn"><?=$_act_txt?></button>
                </p>
                </form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#nt_show").val("<?=$row['nt_show']?>");
        if("<?=$row['nt_orderby']?>" == "") {
            $("#nt_orderby").val(1);
        } else {
            $("#nt_orderby").val("<?=$row['nt_orderby']?>");
        }
    });
    function frm_form_chk(f) {
        if(f.nt_title.value=="") {
            alert("타이틀을 입력해주세요.");
            f.nt_title.focus();
            return false;
        }
        if(f.nt_content.value=="") {
            alert("내용을 입력해주세요.");
            f.nt_content.focus();
            return false;
        }
        $('#splinner_modal').modal('show');
    }
</script>
<?
	include "./foot_inc.php";
?>