<?
	include "./head_inc.php";
    $chk_menu = '5';
    $chk_sub_menu = '2';
    $list_url_t = "faq_list.php";
    $chk_ckeditor = 'Y';
	include "./head_menu_inc.php";

    if($_GET['act']=="update") {
        $_act = "update";
        $_act_txt = "수정";
        $_title = "자주묻는질문 관리";
    } else {
        $_act = "input";
        $_act_txt = "등록";
        $_title = "신규등록";
    }

    $query = "
        SELECT a1.*, a1.idx as ft_idx FROM faq_t a1
        where a1.idx = '".$_GET['ft_idx']."'
    ";
    $row = $DB->fetch_query($query);

    $_get_txt = "pg=";
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
                <form method="post" name="frm_form" id="frm_form" action="./faq_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" >
                <input type="hidden" name="act" id="act" value="<?=$_act?>" />
                <input type="hidden" name="ft_idx" id="ft_idx" value="<?=$_GET['ft_idx']?>" />
                <div class="card-body">
                    <h4 class="card-title"><?=$_title?></h4>
                    <ul class="list-group list-group-flush">
                        <?if($_act != "input") { ?>
                            <li class="list-group-item">
                                <div class="form-group row align-items-center mb-0">
                                    <label for="ct_title" class="col-sm-2 col-form-label">작성일</label>
                                    <div class="col-sm-2">
                                        <div class="input-group">
                                            <span><?=DateType($row['ft_wdate'],1)?></span>
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
                                        <input type="radio" id="language1" name="ft_language" value="1" class="custom-control-input" <?=($row['ft_language'] == 1 || $row['ft_language'] == '') ? 'checked' : ''?>>
                                        <label class="custom-control-label" for="language1">한국어</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="language2" name="ft_language" value="2" class="custom-control-input" <?=$row['ft_language'] == 2 ? 'checked' : ''?>>
                                        <label class="custom-control-label" for="language2">English</label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?if($_act != "input") { ?>
                            <li class="list-group-item">
                                <div class="form-group row align-items-center mb-0">
                                    <label for="ct_title" class="col-sm-2 col-form-label">노출 <b class="text-danger">*</b></label>
                                    <div class="col-sm-2">
                                        <div class="input-group">
                                            <select class="form-control custom-select" id="ft_show" name="ft_show">
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
                                        <select class="form-control" id="ft_orderby" name="ft_orderby">
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
                                <label for="pt_delivery_price" class="col-sm-2 col-form-label">자주묻는질문 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="ft_title" id="ft_title" value="<?=$row['ft_title']?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-group row align-items-center mb-0">
                                <label for="pt_delivery_price" class="col-sm-2 col-form-label">답변 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                <div class="col-sm-10">
                                    <textarea name="ft_answer" id="ft_answer" class="form-control form-control-sm"><?php echo $row['ft_answer']?></textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace('ft_answer', {
                                            extraPlugins: 'uploadimage, image2',
                                            height : '300px',
                                            filebrowserImageBrowseUrl : '',
                                            filebrowserImageUploadUrl : './file_upload.php?Type=Images&upload_name=ft_answer',
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
        $("#ft_show").val("<?=$row['ft_show']?>");
        if("<?=$row['ft_orderby']?>" == "") {
            $("#ft_orderby").val(1);
        } else {
            $("#ft_orderby").val("<?=$row['ft_orderby']?>");
        }
    });
    function frm_form_chk(f) {
        if(f.ft_title.value=="") {
            alert("자주묻는질문을 입력해주세요.");
            f.ft_title.focus();
            return false;
        }
        if(f.ft_answer.value=="") {
            alert("답변을 입력해주세요.");
            f.ft_answer.focus();
            return false;
        }
        $('#splinner_modal').modal('show');
    }
</script>
<?
	include "./foot_inc.php";
?>