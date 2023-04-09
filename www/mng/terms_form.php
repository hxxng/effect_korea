<?
include "./head_inc.php";
$chk_menu = '6';
$chk_sub_menu = '2';
$chk_ckeditor = 'Y'; //CKEDITOR
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
					<h4 class="card-title">약관관리</h4>
					<form method="post" name="frm_form" id="frm_form" action="terms_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" enctype="multipart/form-data">
					<input type="hidden" name="act" id="act" value="update" />
					<div class="form-group row">
						<div class="col-sm-6">
                            <label>이용약관(한국어)</label>
							<textarea name="tt_agree1" id="tt_agree1" class="form-control form-control-sm"><?=$row['tt_agree1']?></textarea>
							<script type="text/javascript">
								CKEDITOR.replace('tt_agree1', {
									extraPlugins: 'uploadimage, image2',
									height : '150px',
									filebrowserImageBrowseUrl : '',
									filebrowserImageUploadUrl : './file_upload.php?Type=Images&upload_name=tt_agree1',
									enterMode : CKEDITOR.ENTER_BR,
                                    toolbar : [
                                    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                                    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
                                    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                    ['Link','Unlink','Anchor'], ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
                                    '/',
                                    ['Styles','Format','Font','FontSize'], ['TextColor','BGColor'], ['Maximize', 'ShowBlocks','-','About']]
								});
							</script>
						</div>
                        <div class="col-sm-6">
                            <label>이용약관(english)</label>
                            <textarea name="tt_agree4" id="tt_agree4" class="form-control form-control-sm"><?=$row['tt_agree4']?></textarea>
                            <script type="text/javascript">
                                CKEDITOR.replace('tt_agree4', {
                                    extraPlugins: 'uploadimage, image2',
                                    height : '150px',
                                    filebrowserImageBrowseUrl : '',
                                    filebrowserImageUploadUrl : './file_upload.php?Type=Images&upload_name=tt_agree4',
                                    enterMode : CKEDITOR.ENTER_BR,
                                    toolbar : [
                                        ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                                        ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
                                        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                        ['Link','Unlink','Anchor'], ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
                                        '/',
                                        ['Styles','Format','Font','FontSize'], ['TextColor','BGColor'], ['Maximize', 'ShowBlocks','-','About']]
                                });
                            </script>
                        </div>
                        <div class="col-sm-6 mt-5">
                            <label>개인정보 처리방침(한국어)</label>
                            <textarea name="tt_agree2" id="tt_agree2" class="form-control form-control-sm"><?=$row['tt_agree2']?></textarea>
                            <script type="text/javascript">
                                CKEDITOR.replace('tt_agree2', {
                                    extraPlugins: 'uploadimage, image2',
                                    height : '150px',
                                    filebrowserImageBrowseUrl : '',
                                    filebrowserImageUploadUrl : './file_upload.php?Type=Images&upload_name=tt_agree2',
                                    enterMode : CKEDITOR.ENTER_BR,
                                    toolbar : [
                                        ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                                        ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
                                        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                        ['Link','Unlink','Anchor'], ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
                                        '/',
                                        ['Styles','Format','Font','FontSize'], ['TextColor','BGColor'], ['Maximize', 'ShowBlocks','-','About']]
                                });
                            </script>
                        </div>
                        <div class="col-sm-6 mt-5">
                            <label>개인정보 처리방침(english)</label>
                            <textarea name="tt_agree5" id="tt_agree5" class="form-control form-control-sm"><?=$row['tt_agree5']?></textarea>
                            <script type="text/javascript">
                                CKEDITOR.replace('tt_agree5', {
                                    extraPlugins: 'uploadimage, image2',
                                    height : '150px',
                                    filebrowserImageBrowseUrl : '',
                                    filebrowserImageUploadUrl : './file_upload.php?Type=Images&upload_name=tt_agree5',
                                    enterMode : CKEDITOR.ENTER_BR,
                                    toolbar : [
                                        ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                                        ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
                                        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                        ['Link','Unlink','Anchor'], ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
                                        '/',
                                        ['Styles','Format','Font','FontSize'], ['TextColor','BGColor'], ['Maximize', 'ShowBlocks','-','About']]
                                });
                            </script>
                        </div>
                        <div class="col-sm-6 mt-5">
                            <label>라이선스(한국어)</label>
                            <textarea name="tt_agree3" id="tt_agree3" class="form-control form-control-sm"><?=$row['tt_agree3']?></textarea>
                            <script type="text/javascript">
                                CKEDITOR.replace('tt_agree3', {
                                    extraPlugins: 'uploadimage, image2',
                                    height : '150px',
                                    filebrowserImageBrowseUrl : '',
                                    filebrowserImageUploadUrl : './file_upload.php?Type=Images&upload_name=tt_agree3',
                                    enterMode : CKEDITOR.ENTER_BR,
                                    toolbar : [
                                        ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                                        ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
                                        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                        ['Link','Unlink','Anchor'], ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
                                        '/',
                                        ['Styles','Format','Font','FontSize'], ['TextColor','BGColor'], ['Maximize', 'ShowBlocks','-','About']]
                                });
                            </script>
                        </div>
                        <div class="col-sm-6 mt-5">
                            <label>라이선스(english)</label>
                            <textarea name="tt_agree6" id="tt_agree6" class="form-control form-control-sm"><?=$row['tt_agree6']?></textarea>
                            <script type="text/javascript">
                                CKEDITOR.replace('tt_agree6', {
                                    extraPlugins: 'uploadimage, image2',
                                    height : '150px',
                                    filebrowserImageBrowseUrl : '',
                                    filebrowserImageUploadUrl : './file_upload.php?Type=Images&upload_name=tt_agree6',
                                    enterMode : CKEDITOR.ENTER_BR,
                                    toolbar : [
                                        ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                                        ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
                                        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                        ['Link','Unlink','Anchor'], ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
                                        '/',
                                        ['Styles','Format','Font','FontSize'], ['TextColor','BGColor'], ['Maximize', 'ShowBlocks','-','About']]
                                });
                            </script>
                        </div>
                    </div>
					<p class="p-3 text-center">
						<input type="submit" value="수정" class="btn btn-outline-primary" />
					</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    function frm_form_chk(f) {
        var oEditor1 = CKEDITOR.instances.tt_agree1;
        var oEditor2 = CKEDITOR.instances.tt_agree2;

        if(oEditor1.getData()=="") {
            alert("내용을 입력해주세요.");
            oEditor1.focus();
            return false;
        }
        if(oEditor2.getData()=="") {
            alert("내용을 입력해주세요.");
            oEditor2.focus();
            return false;
        }

        return true;
    }
</script>
<?
	include "./foot_inc.php";
?>