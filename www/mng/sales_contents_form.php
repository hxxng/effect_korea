<?
include "./head_inc.php";
$chk_menu = "3";
$chk_sub_menu = '2';
include "./head_menu_inc.php";

$query = "
    select a3.*, a2.mt_id, a2.mt_firstname, a2.mt_lastname, a2.mt_hp, ct_idx
    from cart_t a1 left join member_t a2 on a2.idx = a1.mt_idx 
    left join order_t a3 on a3.ot_code = a1.ot_code 
    where a1.ot_code = '".$_GET['ot_code']."'";
$row = $DB->fetch_query($query);

if($row['pay_type'] != 6) {
    $pay_type = "일반결제수단";
} else {
    $ot_pay_type = "회원권결제";
}

if($row['ot_pay_type'] == 1) {
    $ot_pay_type = "무통장입금";
} else if($row['ot_pay_type'] == 2) {
    $ot_pay_type = "카드결제";
} else if($row['ot_pay_type'] == 3) {
    $ot_pay_type = "간편결제";
} else if($row['ot_pay_type'] == 4) {
    $ot_pay_type = "가상계좌";
} else if($row['ot_pay_type'] == 5) {
    $ot_pay_type = "휴대폰";
} else {
    $ot_pay_type = "회원권결제";
}

$_act = $_GET['act'];
$list_url_t = "sales_contents_list.php";

$_get_txt = "search_txt=".$_GET['search_txt']."&sel_search_sdate=".$_GET['sel_search_sdate']."&sel_search_edate=".$_GET['sel_search_edate']."&sel_search=".$_GET['sel_search']."&ot_status=".$_GET['ot_status']."&pg=".$_GET['pg'];
//$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&pg=".$_GET['pg'];
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
                            <input type="hidden" name="act" id="act" value="contents_<?=$_act?>" />
                            <input type="hidden" name="ot_code" id="ot_code" value="<?=$row['ot_code']?>" />
                            <div class="form-group row">
                                <div class="card-body">
                                    <p class="mb-0"></p>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">결제상태</label>
                                                <div class="col-sm-6">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="status1" name="ot_status" value="1" class="custom-control-input">
                                                        <label class="custom-control-label" for="status1">결제전</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline mr-5 ml-5">
                                                        <input type="radio" id="status2" name="ot_status" value="2" class="custom-control-input">
                                                        <label class="custom-control-label" for="status2">결제완료</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="status3" name="ot_status" value="3" class="custom-control-input">
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
                                                        <span><?=$row['ot_pdate']?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">결제금액</label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span><?=number_format($row['ot_price'])?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">결제수단</label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span><?=$pay_type?></span>
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
                                                        <span><?=$row['ot_code']?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <h4 class="card-title mt-4">콘텐츠정보</h4>
                                        <li class="list-group-item">
                                        <?
                                        $query = "select *, (SELECT mt_nickname FROM member_t WHERE idx=mt_idx) as mt_nickname from contents_t where idx = ".$row['ct_idx'];
                                        $contents = $DB->fetch_assoc($query);
                                        $i = 0;
                                        if($contents) {
                                            $i++;
                                            $ct_price += $contents['ct_price'];
                                        ?>
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">
                                                    <h6 class="text-secondary">상품주문번호 <?=$row['ot_pcode']?></h6>
                                                    <img src="<?=$ct_img_url."/".$contents['ct_image']?>" style="width: 100%;height: 150px;border-radius: 5px;">
                                                </label>
                                                <div class="col-sm-6">
                                                    <h4 class="mb-3 font-weight-bold"><?=$contents['ct_title']?></h4>
                                                    <h5 class="mb-3 text-secondary"><?=$contents['mt_nickname']?></h5>
                                                    <div class="input-group mb-3">
                                                        <span class="btn btn-sm btn-dark"><?=$contents['ct_resolution']?></span>
                                                        <h5 class="m-2"><?=$arr_resolution2[$contents['ct_resolution']]?></h5>
                                                    </div>
                                                    <div class="input-group">
                                                        <h4 class="mr-2 text-gray">KRW</h4>
                                                        <h4><?=number_format($contents['ct_price'])?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        <?
                                        }
                                        ?>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label font-weight-bold pb-0">구매내역</label>
                                                <div class="col-sm-2 text-right">
                                                    <span class="font-weight-bold"><?=$i?>개</span>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label pb-0">콘텐츠 총 금액</label>
                                                <div class="col-sm-2 text-right">
                                                    <span class="font-weight-bold"><?=number_format($ct_price)?></span>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label pb-0">부가세</label>
                                                <div class="col-sm-2 text-right">
                                                    <span class="font-weight-bold"><?=number_format($row['ot_vat'])?></span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label font-weight-bold pb-0">총 결제 금액</label>
                                                <div class="col-sm-2 text-right">
                                                    <span class="mr-2 text-gray">KRW</span><span class="font-weight-bold"><?=number_format($row['ot_price'])?></span>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label font-weight-bold pb-0">결제수단</label>
                                                <div class="col-sm-2 text-right">
                                                    <span class="font-weight-bold"><?=$ot_pay_type?></span>
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
            $("input[name='ot_status'][value='<?=$row['ot_status']?>']").prop("checked", true);
        });
        function frm_form_chk(f) {
            $('#splinner_modal').modal('show');
        }
    </script>
<?
include "./foot_inc.php";
?>