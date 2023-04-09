<?
include "./head_inc.php";
$chk_menu = "4";
include "./head_menu_inc.php";

$query = "select a1.*, mt_nickname, mt_lastname, mt_firstname, mt_hp 
        from calculate_t a1 left join member_t a2 on a2.idx = a1.mt_idx where a1.idx = '".$_GET['ct_idx']."'";
$row = $DB->fetch_query($query);

//수수료 합계
$query = "select sum(ct_service_comm) as service_comm_price, sum(ct_pay_comm) as pay_comm_price, sum(ct_etc_comm) as etc_comm_price
        from calculate_t a1 left join member_t a2 on a2.idx = a1.mt_idx 
        where mt_idx = ".$row['mt_idx']." and ct_status = ".$row['ct_status']." group by ct_status ";
$comm_row = $DB->fetch_query($query);

//결제수단별 결제 금액
$query = "select sum(ot_price) as sum_pay_type, ot_pay_type
        from order_t 
        left join cart_t on cart_t.ot_code = order_t.ot_code
        left join contents_t on contents_t.idx = cart_t.ct_idx
        where contents_t.mt_idx = ".$row['mt_idx']." and ot_pdate >= '".$row['ct_cdate']."' and ot_pdate <= '".$row['ct_cedate']."' and ot_status = 2 and cart_t.ct_status = 2
        and order_t.mt_idx != 70 and cart_t.mt_idx != 70 group by ot_pay_type";
$pay = $DB->select_query($query);
if($pay) {
    foreach ($pay as $row2) {
        $pay_arr[] = array(
            $arr_ct_method[$row2['ot_pay_type']] => $row2['sum_pay_type'],
        );
    }
}

$query = "select * from cart_t a1 left join order_t a2 on a1.ot_code = a2.ot_code where ot_pdate between '".$row['ct_cdate']."' and '".$row['ct_cedate']."' and ot_status = 2 and a1.ct_status = 2 and a1.mt_idx != 70 and a2.mt_idx != 70";
$count = $DB->count_query($query);

$query = "select * from calculate_sum_t where mt_idx = ".$row['mt_idx']." and ct_rdate = '".$row['ct_rdate']."'";
$sum = $DB->fetch_query($query);
if($sum) {
    $chk = "Y";
} else {
    $chk = "N";
}

$_act = $_GET['act'];
$list_url_t = "./calculate_list.php";

$_get_txt = "search_txt=".$_GET['search_txt']."&sel_search_sdate=".$_GET['sel_search_sdate']."&sel_search_edate=".$_GET['sel_search_edate']."&pg=".$_GET['pg'];
$_get_txt2 = $_get_txt."&ct_idx=".$_GET['ct_idx']."&pg2=";
$pg = $_GET['pg2'];
?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">정산내역 상세</h4>
                        <p class="card-description">
                            Chrome 사용을 권장합니다. 이외의 브라우저 또는 Chrome 하위버전으로 접속 할 경우 페이지가 깨져 보일 수 있습니다.
                        </p>
                        <form method="post" name="frm_form" id="frm_form" action="./calculate_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" enctype="multipart/form-data">
                            <input type="hidden" name="act" id="act" value="<?=$_act?>" />
                            <input type="hidden" name="idx" id="idx" value="<?=$row['idx']?>" />
                            <input type="hidden" name="mt_idx" id="mt_idx" value="<?=$row['mt_idx']?>" />

                            <div class="form-group row">
                                <div class="card-body">
                                    <p class="mb-0"></p>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">아티스트<br/>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary mt-1" onclick="f_view_popup('<?=$row['mt_idx']?>')">정산계좌정보</button>
                                                </label>
                                                <div class="col-sm-10">
                                                    <span><?=$row['mt_nickname']?></span><br/>
                                                    <span class="font-weight-bold"><?=$row['mt_firstname']." ".$row['mt_lastname']?></span><span><?="(".$row['mt_hp'].")"?></span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">정산기간</label>
                                                <div class="col-sm-4">
                                                    <span style="color: blue;">
                                                        <?
                                                        if($row['ct_status'] == 1){
                                                            $query = "select * from calculate_t where mt_idx = ".$row['mt_idx']." and idx = ".$_GET['ct_idx'];
                                                            $list = $DB->fetch_assoc($query);
                                                            if($list) {
                                                                echo DateType($row['ct_cdate'],2)." ~ ".DateType($row['ct_cedate'],1);
                                                            }
                                                        } else {
                                                            echo DateType($row['ct_cdate'],1)." ~ ".DateType($row['ct_cedate'],1);
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">정산상태</label>
                                                <div class="col-sm-10">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="status1" name="ct_status" value="1" class="custom-control-input" <?=($row['ct_status'] == 1 || $row['ct_status'] == '') ? 'checked' : ''?>>
                                                        <label class="custom-control-label" for="status1">정산중</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="status2" name="ct_status" value="2" class="custom-control-input" <?=$row['ct_status'] == 2 ? 'checked' : ''?>>
                                                        <label class="custom-control-label" for="status2">정산신청</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="status3" name="ct_status" value="3" class="custom-control-input" <?=$row['ct_status'] == 3 ? 'checked' : ''?>>
                                                        <label class="custom-control-label" for="status3">정산완료</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">정산신청일</label>
                                                <div class="col-sm-4">
                                                    <? if($chk=="Y") $ct_price = $sum['ct_price']; else $ct_price = $row['ct_price']; ?>
                                                    <span><?=$row['ct_rdate']?><? if($row['ct_status'] > 1) echo ' (정산신청금액 '.number_format($ct_price).')';?></span>
                                                </div>
                                                <label for="ct_title" class="col-sm-1 col-form-label">정산완료일</label>
                                                <div class="col-sm-2">
                                                    <input type="date" class="form-control" value="" id="ct_ridate" name="ct_ridate" value="" <? if($row['ct_status'] == 1) echo 'readonly' ?> />
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">정산예정금액</label>
                                                <div class="col-sm-2">
                                                    <input type="text" name="ct_price" id="ct_price" value="<? if($chk=="Y") echo $sum['ct_price']; else echo $row['ct_price'];?>" numberonly="" class="form-control" <? if($row['ct_status'] == 1) echo 'readonly' ?>/>
                                                </div>
                                                <div class="col-sm-2"></div>
                                                <label for="ct_title" class="col-sm-1 col-form-label">비고</label>
                                                <div class="col-sm-5">
                                                    <input type="text" name="ct_memo" value="<?=$row['ct_memo']?>" class="form-control" />
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="bt_contents" class="col-sm-2 col-form-label">결제건수</label>
                                                <div class="col-sm-1">
                                                    <span><?=number_format($count)?></span>건
                                                </div>
                                                <div class="col-sm-1">
                                                    <button type="button" class="btn btn-primary" onclick="location.href='./calculate_list2.php?ct_idx=<?=$_GET['ct_idx']?>'">정산 상세</button>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="bt_contents" class="col-sm-2 col-form-label font-weight-bold">총 결제금액 합계
                                                    <small id="select_category_help" class="form-text text-muted">
                                                        (일반결제금액+회원권결제금액)
                                                    </small>
                                                </label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" numberonly="" id="total_price" name="ot_sum_price" value="<? if($chk=="Y") echo $sum['ot_sum_price']; ?>" <? if($row['ct_status'] == 1) echo 'readonly' ?>/>
                                                </div>
                                                <div class="col-sm-2"></div>
                                                <label for="bt_contents" class="col-sm-2 col-form-label font-weight-bold">결제수단</label>
                                            </div>
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="bt_contents" class="col-sm-2 col-form-label">일반 결제</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" numberonly="" id="normal_pay" name="ot_pay_price" value="<? if($chk=="Y") echo $sum['ot_pay_price']; ?>" <? if($row['ct_status'] == 1) echo 'readonly' ?>/>
                                                </div>
                                                <div class="col-sm-2"></div>
                                                <label for="bt_contents" class="col-sm-2 col-form-label">신용카드</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" numberonly="" name="normal_pay" value="<? if($pay_arr) { foreach ($pay_arr as $row_p) { echo $row_p["카드결제"]; } } ?>" <? if($row['ct_status'] == 1) echo 'readonly' ?>/>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="bt_contents" class="col-sm-2 col-form-label">회원권 결제</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" numberonly="" id="membership_pay" name="ot_membership_price" value="<? if($pay_arr) { foreach ($pay_arr as $row_p) { echo $row_p["회원권결제"]; } } ?>" <? if($row['ct_status'] == 1) echo 'readonly' ?>/>
                                                </div>
                                                <div class="col-sm-2"></div>
                                                <label for="bt_contents" class="col-sm-2 col-form-label">해외카드</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" numberonly="" name="normal_pay" value="<? if($pay_arr) { foreach ($pay_arr as $row_p) { echo $row_p["카드결제"]; } } ?>" <? if($row['ct_status'] == 1) echo 'readonly' ?>/>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="bt_contents" class="col-sm-2 col-form-label font-weight-bold">총 수수료 합계
                                                    <small id="select_category_help" class="form-text text-muted">
                                                        (서비스+결제+기타)
                                                    </small>
                                                </label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" numberonly="" name="ct_comm_sum_price" id="ct_comm_sum_price" value="<? if($chk=="Y") echo $sum['ct_comm_sum_price']; ?>" <? if($row['ct_status'] == 1) echo 'readonly' ?>/>
                                                </div>
                                                <div class="col-sm-2"></div>
                                                <label for="bt_contents" class="col-sm-2 col-form-label">실시간 계좌이체</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" numberonly="" name="normal_pay" value="<? if($pay_arr) { foreach ($pay_arr as $row_p) { echo $row_p["계좌이체"]; } } ?>" <? if($row['ct_status'] == 1) echo 'readonly' ?>/>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="bt_contents" class="col-sm-2 col-form-label">서비스수수료</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" numberonly="" name="ct_service_comm" value="<? if($chk=="Y") echo $sum['ct_service_comm']; else echo $comm_row['service_comm_price']; ?>" <? if($row['ct_status'] == 1) echo 'readonly' ?>/>
                                                </div>
                                                <div class="col-sm-2"></div>
                                                <label for="bt_contents" class="col-sm-2 col-form-label">가상계좌</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" numberonly="" name="normal_pay" value="<? if($pay_arr) { foreach ($pay_arr as $row_p) { echo $row_p["가상계좌"]; } } ?>" <? if($row['ct_status'] == 1) echo 'readonly' ?>/>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="bt_contents" class="col-sm-2 col-form-label">결제 수수료</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" numberonly="" name="ct_pay_comm" value="<? if($chk=="Y") echo $sum['ct_pay_comm']; else echo $comm_row['pay_comm_price']; ?>" <? if($row['ct_status'] == 1) echo 'readonly' ?>/>
                                                </div>
                                                <div class="col-sm-2"></div>
                                                <label for="bt_contents" class="col-sm-2 col-form-label">휴대폰소액결제</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" numberonly="" name="normal_pay" value="<? if($pay_arr) { foreach ($pay_arr as $row_p) { echo $row_p["휴대폰"]; } } ?>" <? if($row['ct_status'] == 1) echo 'readonly' ?>/>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="bt_contents" class="col-sm-2 col-form-label">기타 수수료</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" numberonly="" name="ct_etc_comm" value="<? if($chk=="Y") echo $sum['ct_etc_comm']; else echo $comm_row['etc_comm_price']; ?>" <? if($row['ct_status'] == 1) echo 'readonly' ?>/>
                                                </div>
                                                <div class="col-sm-2"></div>
                                                <label for="bt_contents" class="col-sm-2 col-form-label">삼성페이</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" numberonly="" name="normal_pay" value="<? if($pay_arr) { foreach ($pay_arr as $row_p) { echo $row_p["간편결제"]; } } ?>" <? if($row['ct_status'] == 1) echo 'readonly' ?>/>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center mb-0">
                                                <div class="col-sm-6"></div>
                                                <label for="bt_contents" class="col-sm-2 col-form-label">카카오페이</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" numberonly="" name="normal_pay" value="<? if($pay_arr) { foreach ($pay_arr as $row_p) { echo $row_p["간편결제"]; } } ?>" <? if($row['ct_status'] == 1) echo 'readonly' ?>/>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center mb-0">
                                                <div class="col-sm-6"></div>
                                                <label for="bt_contents" class="col-sm-2 col-form-label">네이버페이</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" numberonly="" name="normal_pay" value="<? if($pay_arr) { foreach ($pay_arr as $row_p) { echo $row_p["간편결제"]; } } ?>" <? if($row['ct_status'] == 1) echo 'readonly' ?>/>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <p class="p-3 mt-3 text-center">
                                <input type="button" value="목록" onclick="location.href='<?=$list_url_t."?".$_get_txt?>'" class="btn btn-outline-secondary mx-2">
                                <input type="submit" value="확인" class="btn btn-outline-primary mx-2">
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        //var lastScroll = 0;
        $(document).ready(function() {
            $("#ct_ridate").val("<?=$row['ct_ridate']?>");
            init();
        //    var scrollY = localStorage.getItem("scrolly"); // LocalStorage에 저장된 scroll Y의 위치값 조회.
        //    window.scrollTo(0, scrollY);  // scroll 위치 지정 window.scrollTo(scrollX값, scrollY값)
        });
        function init() {
            //결제수단 합계 => 일반결제
            var data = $("input[name='normal_pay']");
            var sum = 0;
            for(var i=0; i<data.length; i++) {
                if(data[i].value) {
                    sum += parseInt(data[i].value);
                }
            }
            $("#normal_pay").val(sum);

            //회원권 결제 합계
            var membership_pay = 0;
            if($("#membership_pay").val()) {
                membership_pay = parseInt($("#membership_pay").val());
            }
            var normal_pay = 0;
            if($("#normal_pay").val()) {
                normal_pay = parseInt($("#normal_pay").val());
            }
            
            //총 결제금액 합계
            var sum2 = membership_pay + normal_pay;
            $("#total_price").val(sum2);

            //총 수수료 합계
            var data2 = $("input[name$='comm']");
            var sum2 = 0;
            for(var j=0; j<data2.length; j++) {
                if(data2[j].value) {
                    sum2 += parseInt(data2[j].value);
                }
            }
            $("#ct_comm_sum_price").val(sum2);
            // $("#ct_price").val(sum - sum2);
        }
 
        function frm_form_chk(f) {
            // if(f.bt_file.value=="" && f.bt_file_on.value=="") {
            //     alert("메인배너를 등록해주세요.");
            //     return false;
            // }
            $('#splinner_modal').modal('show');
        }

        function f_order_search_date_range(nm, sd, ed) {
            $('#sel_search_sdate2').val(sd);
            $('#sel_search_edate2').val(ed);

            $('.c_pt_selling_date_range').removeClass('btn-info text-white');
            $('#f_order_search_date_range'+nm).addClass('btn-info text-white');

            return false;
        }

        function f_view_popup(idx){		//모달창
            $.post('./calculate_update.php', {act: 'pc_modal', idx: idx}, function (data) {
                if(data){
                    $('#modal-default-content').html(data);
                    $('#modal-default-size').css('max-width', '400px');
                    $('#modal-default').addClass('modal-dialog-centered');
                    $('#modal-default').addClass('modal-dialog-scrollable');
                    $('#modal-default').modal();
                }
            });
            return false;
        }
    </script>
<?
include "./foot_inc.php";
?>