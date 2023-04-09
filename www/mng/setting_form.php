<?
include "./head_inc.php";
$chk_menu = '6';
$chk_sub_menu = '3';
include "./head_menu_inc.php";

$query = "
    select * from setting_t
";
if($_GET['st_language']) {
    $where_query .= "where st_language = ".$_GET['st_language'];
} else {
    $where_query .= "where st_language = 1";
}
$row = $DB->fetch_query($query.$where_query);
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">설정</h4>
					<form method="post" name="frm_form" id="frm_form" action="./setting_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" enctype="multipart/form-data">
                    <input type="hidden" name="act" value="update" />
                    <input type="hidden" name="st_language" value="<?=$_GET['st_language']?>" />
                    <div class="form-group row" id="primary" style="margin-bottom: 0px;">
                        <div class="card-body">
                            <p class="mb-0"></p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="form-group row align-items-center mb-0">
                                        <label for="ct_title" class="col-sm-2 col-form-label">서비스 수수료(%)</label>
                                        <div class="col-sm-2">
                                            <div class="input-group-append">
                                                <input type="text" name="st_service_comm" id="st_service_comm" value="<?=$row['st_service_comm']?>" class="form-control" numberonly="" />
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-2"></div>
                                        <label for="ct_title" class="col-sm-2 col-form-label">결제수수료(%)</label>
                                        <div class="col-sm-2">
                                            <div class="input-group-append">
                                                <input type="text" name="st_pay_comm" id="st_pay_comm" value="<?=$row['st_pay_comm']?>" class="form-control" numberonly="" />
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="col-sm-12">
                                        <div class="btn-group" role="group" aria-label="ct_type">
                                            <button type="button" onclick="f_language('1');" id="f_ct_type_btn1" class="btn btn-outline-secondary <? if($_GET['st_language'] == "" || $_GET['st_language'] == 1) echo 'btn-info text-white';?>">한국어</button>
                                            <button type="button" onclick="f_language('2');" id="f_ct_type_btn2" class="btn btn-outline-secondary <? if($_GET['st_language'] == 2) echo 'btn-info text-white';?>">English</button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="form-group row align-items-center mb-0">
                                        <label for="ct_title" class="col-sm-2 col-form-label">회사명</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="st_company_name" id="st_company_name" value="<?=$row['st_company_name']?>" class="form-control" />
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-group row align-items-center mb-0">
                                        <label for="ct_title" class="col-sm-2 col-form-label">대표</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="st_ceo" id="st_ceo" value="<?=$row['st_ceo']?>" class="form-control" />
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-group row align-items-center mb-0">
                                        <label for="ct_title" class="col-sm-2 col-form-label">사업자등록번호</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="st_register_num" id="st_register_num" value="<?=$row['st_register_num']?>" class="form-control" />
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-group row align-items-center mb-0">
                                        <label for="ct_title" class="col-sm-2 col-form-label">제 통신판매업신고번호</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="st_report_num" id="st_report_num" value="<?=$row['st_report_num']?>" class="form-control" />
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-group row align-items-center mb-0">
                                        <label for="ct_title" class="col-sm-2 col-form-label">개인정보 보호책임자</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="st_manager" id="st_manager" value="<?=$row['st_manager']?>" class="form-control" />
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-group row align-items-center mb-0">
                                        <label for="ct_title" class="col-sm-2 col-form-label">주소</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="st_addr" id="st_addr" value="<?=$row['st_addr']?>" class="form-control" />
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-group row align-items-center mb-0">
                                        <label for="ct_title" class="col-sm-2 col-form-label">고객센터 전화번호</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="st_tel" id="st_tel" value="<?=$row['st_tel']?>" class="form-control" />
                                        </div>
                                    </div>
                                </li>
                            </ul>
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
        }
        function f_language(language) {
            location.replace("./setting_form.php?st_language="+language);
        }
    </script>
<?
	include "./foot_inc.php";
?>