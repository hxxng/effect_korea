<?php
$title = "회원권";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$membership_ment = lang("membership", $_lang, "mypage");
$notice = lang("notice", $_lang, "membership");
$info1 = lang("info1", $_lang, "membership");
$info2 = lang("info2", $_lang, "membership");
$membership1 = lang("membership1", $_lang, "mypage");
$membership2 = lang("membership2", $_lang, "mypage");
$membership3 = lang("membership3", $_lang, "mypage");
$membership4 = lang("membership4", $_lang, "mypage");
$available_content = lang("available_content", $_lang, "mypage");
$membership_contents12 = lang("membership_contents12", $_lang, "mypage");
$membership_contents34 = lang("membership_contents34", $_lang, "mypage");
$membership_download = lang("membership_download", $_lang, "mypage");
$membership_download12 = lang("membership_download12", $_lang, "mypage");
$unlimited = lang("unlimited", $_lang, "mypage");
$available_use = lang("available_use", $_lang, "mypage");
$select = lang("select", $_lang, "contents_upload");
$pay = lang("title", $_lang, "pay");
$customer_info = lang("customer_info", $_lang, "order");
$local = lang("local", $_lang, "pay");
$foreiner = lang("foreiner", $_lang, "pay");
$nationality = lang("nationality", $_lang, "pay");
$num = lang("num", $_lang, "pay");
$email = lang("email", $_lang, "order");
$hp = lang("hp", $_lang, "signup");
$firstname = lang("firstname", $_lang, "signup");
$lastname = lang("lastname", $_lang, "signup");
$confirm = lang("confirm", $_lang, "order");
$discount1 = lang("discount1", $_lang, "order");
$discount2 = lang("discount2", $_lang, "order");

if($_SESSION['_lang'] == "en") {
    $url = 'https://quotation-api-cdn.dunamu.com/v1/forex/recent?codes=FRX.KRWUSD';
    $result = get_exchange_rate($url);
    $data = json_decode($result,true);
    $data = $data[0];

    $_provider = $data['provider'];

    $_buying = $data['cashBuyingPrice'];
    $_selling = $data['cashSellingPrice'];
    $_ttselling = $data['ttSellingPrice'];
    $_ttbuyling = $data['ttBuyingPrice'];
    $_usd = $data['basePrice'];
    $_openusd = $data['openingPrice'];
    $_chusd = $data['changePrice'];
    $_openusd_o = $_usd - $_openusd;
    $_openusd_op = ($_chusd/$_usd)*100;
    $_openusd = round($_openusd,2);

    $dollar = sprintf('%0.2f',$_usd);
}

$codes_arr = get_nationality();
$phone_arr = get_international_num();
?>
<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="wr_tit">
                    <h2 class="h2_tit"><?=$membership_ment?></h2>
                </div>
                <div class="member_caution mb-5">
                    <p class="caution fw_600"><img src="img/ic_caution.png" alt=""> <?=$notice?></p>
                    <p><?=$info1?></p>
                    <p><?=$info2?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="membership_grid">
                    <input type="hidden" id="mt_type" value="1"/>
                    <div class="membership_box position-relative on">
                        <div class="membership_top">
                            <div class="info_tit fw_600"><?=$membership1?></div>
                            <div class="membership_cont">
                                <p class="m_name fc_blue1 fw_600"><img src="img/ic_check.png" alt=""> <?=$available_content?></p>
                                <p class="m_sub"><?=$membership_contents12?></p>
                            </div>
                            <div class="membership_cont">
                                <p class="m_name fc_blue1 fw_600"><img src="img/ic_check.png" alt=""> <?=$membership_download?></p>
                                <p class="m_sub"><?=$membership_download12?> <strong><?=$unlimited?></strong></p>
                            </div>
                            <div class="membership_cont">
                                <p class="m_name fc_blue1 fw_600"><img src="img/ic_check.png" alt=""> <?=$available_use?></p>
                                <p class="m_sub"><?=$unlimited?></p>
                            </div>
                        </div>
                        <div class="membership_btm">
                            <hr class="hr3">
                            <div class="d-flex justify-content-between align-items-end">
                                <div class="cart_price">
                                    <p class="price_dc">
                                        <?if($_SESSION['_lang'] == "en") echo '<span class="price ff_play">$'.number_format(60000 / $dollar,2).'</span>'; else echo '<span class="price ff_play">'.number_format(60000).'</span>원';?>
                                    </p>
                                    <p class="price_b">
                                        <?if($_SESSION['_lang'] == "en") echo '<span class="price ff_play">$'.number_format(30000 / $dollar,2).'</span>'; else echo '<span class="price ff_play">'.number_format(30000).'</span>원';?>
                                    </p>
                                </div>
                                <button type="button" class="btn btn-outline-primary btn_select" onclick="chg_membership(1)"><?=$select?></button>
                            </div>
                        </div>
                        <div class="m_tooltip position-absolute">50% <?=$discount1?></div>
                    </div>
                    <div class="membership_box position-relative">
                        <div class="membership_top">
                            <div class="info_tit fw_600"><?=$membership2?></div>
                            <div class="membership_cont">
                                <p class="m_name fc_blue1 fw_600"><img src="img/ic_check.png" alt=""> <?=$available_content?></p>
                                <p class="m_sub"><?=$membership_contents12?></p>
                            </div>
                            <div class="membership_cont">
                                <p class="m_name fc_blue1 fw_600"><img src="img/ic_check.png" alt=""> <?=$membership_download?></p>
                                <p class="m_sub"><?=$membership_download12?> <strong><?=$unlimited?></strong></p>
                            </div>
                            <div class="membership_cont">
                                <p class="m_name fc_blue1 fw_600"><img src="img/ic_check.png" alt=""> <?=$available_use?></p>
                                <p class="m_sub"><?=$unlimited?></p>
                            </div> 
                        </div>
                        <div class="membership_btm">
                            <hr class="hr3">
                            <div class="d-flex justify-content-between align-items-end">
                                <div class="cart_price">
                                    <p class="price_dc">
                                    <?if($_SESSION['_lang'] == "en") echo '<span class="price ff_play">$'.number_format(720000 / $dollar,2).'</span>'; else echo '<span class="price ff_play">'.number_format(720000).'</span>원';?>
                                    </p>
                                    <p class="price_b">
                                    <?if($_SESSION['_lang'] == "en") echo '<span class="price ff_play">$'.number_format(252000 / $dollar,2).'</span>'; else echo '<span class="price ff_play">'.number_format(252000).'</span>원';?>
                                    </p>
                                </div>
                                <button type="button" class="btn btn-outline-primary btn_select" onclick="chg_membership(2)"><?=$select?></button>
                            </div>
                        </div>
                        <div class="m_tooltip position-absolute">50% <?=$discount1?> + 30% <?=$discount2?></div>
                    </div>
                    <div class="membership_box position-relative">
                        <div class="membership_top">
                            <div class="info_tit fw_600"><?=$membership3?></div>
                            <div class="membership_cont">
                                <p class="m_name fc_blue1 fw_600"><img src="img/ic_check.png" alt=""> <?=$available_content?></p>
                                <p class="m_sub"><?=$membership_contents34?></p>
                            </div>
                            <div class="membership_cont">
                                <p class="m_name fc_blue1 fw_600"><img src="img/ic_check.png" alt=""> <?=$membership_download?></p>
                                <p class="m_sub"><?=$unlimited?></p>
                            </div>
                            <div class="membership_cont">
                                <p class="m_name fc_blue1 fw_600"><img src="img/ic_check.png" alt=""> <?=$available_use?></p>
                                <p class="m_sub"><?=$unlimited?></p>
                            </div>
                        </div>
                        <div class="membership_btm">
                            <hr class="hr3">
                            <div class="d-flex justify-content-between align-items-end">
                                <div class="cart_price">
                                    <p class="price_dc">
                                        <?if($_SESSION['_lang'] == "en") echo '<span class="price ff_play">$'.number_format(300000 / $dollar,2).'</span>'; else echo '<span class="price ff_play">'.number_format(300000).'</span>원';?>
                                    </p>
                                    <p class="price_b">
                                        <?if($_SESSION['_lang'] == "en") echo '<span class="price ff_play">$'.number_format(150000 / $dollar,2).'</span>'; else echo '<span class="price ff_play">'.number_format(150000).'</span>원';?>
                                    </p>
                                </div>
                                <button type="button" class="btn btn-outline-primary btn_select" onclick="chg_membership(3)"><?=$select?></button>
                            </div>
                        </div>
                        <div class="m_tooltip position-absolute">50% <?=$discount1?></div>
                    </div>
                    <div class="membership_box position-relative">
                        <div class="membership_top">
                            <div class="info_tit fw_600"><?=$membership4?></div>
                            <div class="membership_cont">
                                <p class="m_name fc_blue1 fw_600"><img src="img/ic_check.png" alt=""> <?=$available_content?></p>
                                <p class="m_sub"><?=$membership_contents34?></p>
                            </div>
                            <div class="membership_cont">
                                <p class="m_name fc_blue1 fw_600"><img src="img/ic_check.png" alt=""> <?=$membership_download?></p>
                                <p class="m_sub"><?=$unlimited?></p>
                            </div>
                            <div class="membership_cont">
                                <p class="m_name fc_blue1 fw_600"><img src="img/ic_check.png" alt=""> <?=$available_use?></p>
                                <p class="m_sub"><?=$unlimited?></p>
                            </div>
                        </div>
                        <div class="membership_btm">
                            <hr class="hr3">
                            <div class="d-flex justify-content-between align-items-end">
                                <div class="cart_price">
                                    <p class="price_dc">
                                        <?if($_SESSION['_lang'] == "en") echo '<span class="price ff_play">$'.number_format(3600000 / $dollar,2).'</span>'; else echo '<span class="price ff_play">'.number_format(3600000).'</span>원';?>
                                    </p>
                                    <p class="price_b">
                                        <?if($_SESSION['_lang'] == "en") echo '<span class="price ff_play">$'.number_format(1260000 / $dollar,2).'</span>'; else echo '<span class="price ff_play">'.number_format(1260000).'</span>원';?>
                                    </p>
                                </div>
                                <button type="button" class="btn btn-outline-primary btn_select" onclick="chg_membership(4)"><?=$select?></button>
                            </div>
                        </div>
                        <div class="m_tooltip position-absolute">50% <?=$discount1?> + 30% <?=$discount2?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="membership_pg_btm">
                    <button type="button" class="btn btn-primary <? if($_SESSION['_lang'] == "en") echo 'd-none'; ?>" onclick="membership_pay();"><?=$pay?></button>
                    <div id="paypal-button-container" class="<? if($_SESSION['_lang'] == "kr" || $_SESSION['_lang'] == "") echo 'd-none'; ?>"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 고객 정보 모달 -->
<div class="modal fade" id="modal_md" >
    <form method="post" name="frm_login" id="frm_login" action="/models/mypage/member.php" onsubmit="return frm_submit(this);">
    <input type="hidden" name="type" value="pay_info_update"/>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?=$customer_info?></h5>
                <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
                    <img src="img/ic_x.png" alt="닫기">
                </button>
            </div>
            <div class="modal-body">
                <div class="order_customer">
                    <div class="customer_radio">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="mt_local" id="exampleRadios1" value="1" <? if($member_info['mt_local']==1 || $member_info['mt_local']=="") echo 'checked';?>>
                            <label class="form-check-label" for="exampleRadios1">
                                <div class="chkbox radio">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <?=$local?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="mt_local" id="exampleRadios2" value="2" <? if($member_info['mt_local']==2) echo 'checked';?>>
                            <label class="form-check-label" for="exampleRadios2">
                                <div class="chkbox radio">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <?=$foreiner?>
                            </label>
                        </div>
                    </div>
                    <div class="customer_modal">
                        <div class="form-group form-group_1">
                            <label for="mt_nationality" class="on"><?=$nationality?></label>
                            <select class="form-control" id="mt_nationality" name="mt_nationality" aria-placeholder="선택">
                                <option value="" disabled selected><?=$select?></option>
                                <?
                                if($codes_arr) {
                                    asort($codes_arr);
                                    foreach ($codes_arr as $key => $val) {
                                        echo '<option value="'.$key.'">'.$val.'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div> 
                        <div class="form_tel d-flex">
                            <div class="form-group form-group_1 form_l">
                                <label for="mt_international_num" class="on"><?=$num?></label>
                                <select class="form-control" id="mt_international_num" name="mt_international_num" aria-placeholder="선택">
                                    <option value="" disabled selected><?=$select?></option>
                                    <?
                                    if($phone_arr) {
                                        asort($phone_arr);
                                        foreach ($phone_arr as $key => $val) {
                                            if($val!=""&&$val!=" ") {
                                                echo '<option value="'.$key.'">'.$val.'</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div> 
                            <div class="form-group form-group_1 form_r">
                                <label for="extInput"><?=$hp?></label>
                                <input type="text" class="form-control" id="textInput" name="mt_hp" value="<?=$member_info['mt_hp']?>" numberOnly>
                            </div>
                        </div>
                        <div class="find_name d-flex justify-content-between">
                            <div class="form-group form-group_1 form_l">
                                <label for="mt_firstname"><?=$firstname?></label>
                                <input type="text" class="form-control" name="mt_firstname" value="<?=$member_info['mt_firstname']?>">
                            </div>
                            <div class="form-group form-group_1 form_r">
                                <label for="mt_lastname"><?=$lastname?></label>
                                <input type="text" class="form-control" name="mt_lastname" value="<?=$member_info['mt_lastname']?>">
                            </div>
                        </div>
                        <div class="form-group form-group_1">
                            <label for="extInput"><?=$email?></label>
                            <input type="text" class="form-control" id="textInput" name="mt_email" value="<?=$member_info['mt_email']?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?=$confirm?></button>
            </div>
        </div>
    </div>
    </form>
</div>
<script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.2.0.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=client-id&components=buttons&vault=true&intent=subscription"></script>
<script>
    $(document).ready(function() {
        $("#mt_nationality").val("<?=$member_info['mt_nationality']?>");
        $("#mt_international_num").val("<?=$member_info['mt_international_num']?>");

        var plan_id = '';
        if("<?=$_SESSION['_lang']?>" == "en") {
            paypal.Buttons({
                style: {
                    layout: 'horizontal',
                    color:  'blue',
                    shape:  'pill',
                    label:  'paypal',
                    tagline : 'false',
                },

                createSubscription: function(data, actions) {
                    plan_id = create_plan();
                    return actions.subscription.create({
                        'plan_id': plan_id
                    });
                },

                onApprove: function(data, actions) {
                    console.log(data);
                    $.ajax({
                        url: "<?php echo STATIC_HTTP;?>/models/membership/membership_pay2.php",
                        type: "POST",
                        dataType: 'json',
                        data: {
                            type: "paypal",
                            plan_id: plan_id,
                            subscriptionID: data.subscriptionID,
                            mt_type: $("#mt_type").val(),
                        },
                        success: function (result) {
                            if(result['code'] == 200){
                                location.replace("/membership_success.php");
                            } else if(result['code'] != 200){
                                //결제실패
                                alert(result['message']);
                            }
                        },
                        error: function (data) {
                            console.log("error" + data);
                        }
                    });
                }
            }).render('#paypal-button-container');
        }
    });

    $(".btn_select").on("click",function(){
        $(".membership_box").removeClass("on");
        $(this).parents(".membership_box").addClass("on");
    })

    function chg_membership(val) {
        $("#mt_type").val(val);
    }

    function chk_info() {
        if("<?=$member_info['mt_first_info']?>" == "N") {
            $("#modal_md").modal("show");
            return false;
        } else {
            return true;
        }
    }

    function membership_pay(){
        if("<?=$member_info['idx']?>" == "") {
            alert("로그인 후 이용가능합니다.");
            location.replace('/signin.php');
            return false;
        }
        if(chk_info()) {
            var type = $("#mt_type").val();
            var amount = 0;
            if (type == 1) {
                amount = 30000;
            } else if (type == 2) {
                amount = 252000;
            } else if (type == 3) {
                amount = 150000;
            } else {
                amount = 1260000;
            }
            $.ajax({
                type: 'post',
                url: '/models/membership/membership_pay1.php',
                dataType: 'json',
                data: {
                    act: 'content',
                    mt_type: type,
                    pay_type: 2,
                    amount: amount,
                    customer_uid: "<?=$_SESSION['_mt_idx']?>"
                },
                success: function (d, s) {
                    if (d.result == '_true') {
                        requestPay(d.data_arr);
                    } else if (d.result == '_false') {
                        alert(d.msg);
                        return false;
                    }
                },
                cache: false
            });
        }
    }
    var IMP = window.IMP;
    IMP.init("imp");
    function requestPay(data_arr) {
        IMP.request_pay({ // param
            pg: "html5_inicis.INIBillTst",   // 실제 계약 후에는 실제 상점아이디로 변경
            pay_method: "card", // 'card'만 지원됩니다.
            merchant_uid: data_arr.merchant_uid,
            customer_uid: data_arr.customer_uid, // 필수 입력.
            name: data_arr.name,
            amount: data_arr.amount,
            buyer_email: data_arr.buyer_email,
            buyer_name: data_arr.buyer_name,
            buyer_tel: data_arr.buyer_tel,
            m_redirect_url: "",
        }, function (rsp) { // callbacktest2
            if (rsp.success) {
                // jQuery로 HTTP 요청
                $.ajax({
                    url: "<?php echo STATIC_HTTP;?>/models/membership/membership_pay2.php",
                    type: "POST",
                    // headers: { "Content-Type": "application/json" },
                    data: {
                        type: "imp",
                        imp_uid: rsp.imp_uid,
                        customer_uid: rsp.customer_uid,
                        merchant_uid: rsp.merchant_uid,
                        amount: rsp.paid_amount,
                        name: rsp.name,
                        buyer_email: data_arr.buyer_email,
                        buyer_name: data_arr.buyer_name,
                        buyer_tel: data_arr.buyer_tel,
                        card_number: rsp.card_number,
                        mt_type: data_arr.mt_type,
                    },
                    success: function (result) {
                        var obj = JSON.parse(result);
                        if (obj.code == 200) {
                            location.replace("/membership_success.php");
                        } else if (obj.code != 200) {
                            //결제실패
                            alert(obj.message);
                        }
                    },
                    error: function (data) {
                        console.log("error" + data);
                    }
                });
            } else {
                alert("결제에 실패하였습니다. 에러 내용: " + rsp.error_msg);
            }
        });
    }

    function create_plan() {
        var mt_type = $("#mt_type").val();
        var amount = 0;
        if (mt_type == 1) {
            amount = 21.82;
        } else if (mt_type == 2) {
            amount = 183.27;
        } else if (mt_type == 3) {
            amount = 109.09;
        } else {
            amount = 916.36;
        }
        var data = "";
        $.ajax({
            url: "<?php echo STATIC_HTTP;?>/models/membership/membership_pay1.php",
            type: "POST",
            dataType: 'json',
            async: false,
            data: {
                type: "create_plan",
                mt_type: mt_type,
                amount: amount
            },
            success: function (result) {
                data = result;
            },
            error: function (data) {
                console.log("error" + data);
            }
        });
        return data;
    }

    function frm_submit(f){
        if(f.mt_nationality.value==''){
            $("#txt").text("국적을 선택해주세요..");
            $('#id_alert').modal('show');
            f.mt_nationality.addClass("border-danger");
            return false;
        }
        if(f.mt_firstname.value==''){
            $("#txt").text("이름을 입력해주세요.");
            $('#id_alert').modal('show');
            f.mt_firstname.addClass("border-danger");
            return false;
        }
        if(f.mt_lastname.value==''){
            $("#txt").text("성을 입력해주세요.");
            $('#id_alert').modal('show');
            return false;
        }
        if(f.mt_international_num.value==''){
            $("#txt").text("국제번호를 선택해주세요.");
            $('#id_alert').modal('show');
            return false;
        }
        if(f.mt_hp.value==''){
            $("#txt").text("연락처를 입력해주세요.");
            $('#id_alert').modal('show');
            return false;
        }
        if(f.mt_email.value==''){
            $("#txt").text("이메일을 입력해주세요.");
            $('#id_alert').modal('show');
            return false;
        }
    }

</script>

<? include_once("./inc/tail.php"); ?>