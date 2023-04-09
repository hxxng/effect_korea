<?
include "./head_inc.php";
$chk_menu = "3";
$chk_sub_menu = '1';
include "./head_menu_inc.php";

$query = "select a1.*, mt_id, mt_firstname, mt_lastname, mt_hp from membership_t a1 left join member_t a2 on a2.idx = a1.mt_idx where a1.idx = '".$_GET['mt_idx']."'";
$row = $DB->fetch_query($query);
if($row['mt_payment'] == 1) {
    $mt_payment = "무통장입금";
} else if($row['mt_payment'] == 2) {
    $mt_payment = "카드결제";
} else if($row['mt_payment'] == 3) {
    $mt_payment = "간편결제";
} else if($row['mt_payment'] == 4) {
    $mt_payment = "가상계좌";
} else {
    $mt_payment = "휴대폰";
}

$_act = $_GET['act'];
$list_url_t = "sales_membership_list.php";

$_get_txt = "search_txt=".$_GET['search_txt']."&sel_search_sdate=".$_GET['sel_search_sdate']."&sel_search_edate=".$_GET['sel_search_edate']."&date_chk=".$_GET['date_chk']."&sel_search=".$_GET['sel_search']."&pg=".$_GET['pg'];
?>
<style>
    /* 드롭 반응 */
    .dropBox.active {
        background: #eee;
    }
</style>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">상세</h4>
                        <p class="card-description">
                            Chrome 사용을 권장합니다. 이외의 브라우저 또는 Chrome 하위버전으로 접속 할 경우 페이지가 깨져 보일 수 있습니다.
                        </p>
                        <form method="post" name="frm_form" id="frm_form" action="./sales_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" enctype="multipart/form-data">
                            <input type="hidden" name="act" id="act" value="membership_<?=$_act?>" />
                            <input type="hidden" name="idx" id="idx" value="<?=$row['idx']?>" />

                            <div class="form-group row">
                                <div class="card-body">
                                    <p class="mb-0"></p>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">결제상태</label>
                                                <div class="col-sm-6">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="status1" name="mt_status" value="1" class="custom-control-input">
                                                        <label class="custom-control-label" for="status1">결제전</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline mr-5 ml-5">
                                                        <input type="radio" id="status2" name="mt_status" value="2" class="custom-control-input">
                                                        <label class="custom-control-label" for="status2">결제완료</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="status3" name="mt_status" value="3" class="custom-control-input">
                                                        <label class="custom-control-label" for="status3">취소</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <h4 class="card-title mt-4">결제정보</h4>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">결제일시</label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span><?=$row['mt_pdate']?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">결제금액</label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span><?=number_format($row['mt_price'])?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">결제수단</label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span><?=$mt_payment?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <h4 class="card-title mt-4">구매정보</h4>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">주문번호</label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span><?=$row['mt_code']?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <h4 class="card-title mt-4">회원권정보</h4>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">구매일자</label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span><?=DateType($row['mt_pdate'],1)?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">유효기간</label>
                                                <div class="col-sm-2">
                                                    <div class="input-group">
                                                        <input type="date" class="form-control" value="" id="mt_edate" name="mt_edate"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">회원권</label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span><?=$row['mt_membership']?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">이용가능 콘텐츠</label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span><?=$arr_membership_contents[$row['mt_type']]?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">다운로드 수량</label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span><?=$arr_membership_download[$row['mt_type']]?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">사용가능범위</label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span><?=$arr_membership_use[$row['mt_type']]?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">회원권가격</label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span id="membership_price"><?=number_format($arr_membership_price[$row['mt_type']])?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <h4 class="card-title mt-4">구매자정보</h4>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">구매자아이디</label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span><?=$row['mt_id']?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">구매자이름</label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span><?=$row['mt_firstname']." ".$row['mt_lastname']?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">구매자연락처</label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span><?=$row['mt_hp']?></span>
                                                    </div>
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
            $('#mt_edate').val('<?=$row['mt_edate']?>');
            $("input[name='mt_status'][value='<?=$row['mt_status']?>']").prop("checked", true);
        });
        function frm_form_chk(f) {
            if(f.mt_edate.value=="" || f.mt_edate.value=="0000-00-00") {
                alert("유효기간을 입력해주세요.");
                f.mt_edate.focus();
                return false;
            }

            $('#splinner_modal').modal('show');
        }
    </script>
<?
include "./foot_inc.php";
?>