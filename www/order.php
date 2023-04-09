<?php
//$title = "결제하기";

include_once("./inc/head.php");
include_once("./inc/nav.php");
include $_SERVER['DOCUMENT_ROOT']."/lib/Mall_class.php";

//로그인체크
if($member_info['idx'] < 1) {
    p_alert('로그인 후 이용가능한 서비스입니다.', '/');
    exit;
}

//언어셋
$_lang = $_SESSION['_lang'];
$title = lang("title", $_lang, "pay");
$contents_info = lang("contents_info", $_lang, "pay");
$customer_info = lang("customer_info", $_lang, "pay");
$local = lang("local", $_lang, "pay");
$foreiner = lang("foreiner", $_lang, "pay");
$nationality = lang("nationality", $_lang, "pay");
$num = lang("num", $_lang, "pay");
$info = lang("info", $_lang, "pay");
$contents_code = lang("contents_code", $_lang, "order");
$contents_price = lang("contents_price", $_lang, "order");
$vat2 = lang("vat", $_lang, "order");
$email = lang("email", $_lang, "order");
$cart_update = lang("cart_update", $_lang, "pay");
$select = lang("select", $_lang, "contents_upload");
$firstname = lang("firstname", $_lang, "signup");
$lastname = lang("lastname", $_lang, "signup");
$hp = lang("hp", $_lang, "signup");
$select_content = lang("select_content", $_lang, "cart");
$sum2 = lang("sum", $_lang, "cart");
$info1 = lang("info1", $_lang, "cart");
$subscribe = lang("subscribe", $_lang, "order");
$subscribe2 = lang("subscribe2", $_lang, "order");

$users = $objLogin->get_info($_SESSION['_mt_idx']);
$objMall = new Mall_class(array('db'=>$DB, 'mt_idx'=>$_SESSION['_mt_idx']));

$cart_info = $DB->select_query("select cart_t.* from cart_t left join contents_t on cart_t.ct_idx = contents_t.idx where cart_t.mt_idx=".$_SESSION['_mt_idx']." and cart_t.ct_select=1 and cart_t.ct_status=0");
if(!$cart_info){
    p_alert('결제할 상품정보가 없습니다. 재주문 바랍니다.', '/');
}

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
                    <h2 class="h2_tit"><?=$title?></h2>
                </div>
            </div>
            <div class="col-12 col-xl-8">
                <form name="frmorderlist" id="frmorderlist" method="post" action="/models/order_model.php" onsubmit="return frmorder_check(this);">
                <input type="hidden" name="ot_code" id="ot_code" value="<?php echo $cart_info[0]['ot_code'];?>">
                <input type="hidden" name="payment_complete" id="payment_complete">
                <input type="hidden" name="act" value="update_member">
                <input type="hidden" name="mt_idx" value="<?=$_SESSION['_mt_idx']?>">
                <div class="order_hd d-flex justify-content-between align-items-center">
                    <p class="fw_500"><?=$contents_info?></p>
                    <? if($cart_info[0]['ct_direct'] != 1) { ?> <!-- 바로구매시 장바구니 수정하기 숨김 -->
                    <button type="button" class="cart_del" onclick="cart_update()"><img src="img/ic_modify.png" alt=""><?=$cart_update?></button>
                    <? } ?>
                </div>
                <ul class="cart_list">
                    <?
                    if($cart_info) {
                        foreach ($cart_info as $row) {
                            $query = "select *, (SELECT ct_name FROM category_t WHERE idx=ct_cate_idx2) as ct_name, 
                                    (SELECT mt_nickname FROM member_t WHERE idx=mt_idx) as mt_nickname, (SELECT mt_image FROM member_t WHERE idx=mt_idx) as mt_image 
                                    from contents_t 
                                    where idx = ".$row['ct_idx']." and ct_status = 2 and ct_show = 'Y'";
                            $content = $DB->fetch_assoc($query);
                            if($content) {
                                if($content['mt_image']) {
                                    $mt_image = $ct_img_url."/".$content['mt_image'];
                                } else {
                                    $mt_image = $ct_member_no_img_url;
                                }
                                ?>
                                <li>
                                    <div class="cart_cont_box">
                                        <div class="cart_thumbs video_list square rectangle">
                                            <img src="<?=$ct_img_url."/".$content['ct_image']?>" alt="">
                                        </div>
                                        <a class="cart_cont" href="/contents_list.php?ct_type=<?=$content['ct_type']?>&ct_idx=<?=$content['ct_cate_idx2']?>&idx=<?=$content['idx']?>">
                                            <div class="cart_cate"><?=$content['ct_name']?></div>
                                            <h4 class="cart_tit ff_play"><?=$content['ct_title']?></h4>
                                            <div class="cart_artist">
                                                <div class="square"><img src="<?=$mt_image?>" alt=""></div>
                                                <span class="at_name"><?=$content['mt_nickname']?></span>
                                            </div>
                                            <div class="cart_de d-flex justify-content-between">
                                                <div class="cart_op"><span class="badge badge-secondary fw_600"><?=$content['ct_resolution']?></span><span class="c_reso"><?=$arr_resolution2[$content['ct_resolution']]?></span></div>
                                                <?
                                                if($_SESSION['_lang'] == "en") {
                                                    ?>
                                                    <div class="cart_price">$<span class="price ff_play"><?=number_format($content['ct_price'] / $dollar,2)?></span></div>
                                                    <?
                                                } else {
                                                    ?>
                                                    <div class="cart_price"><span class="price ff_play"><?=number_format($content['ct_price'])?></span>원</div>
                                                    <?
                                                }
                                                ?>
                                            </div>
                                            <p class="cart_order"><?=$contents_code?> : <?=$row['ot_pcode']?></p>
                                        </a>
                                    </div>
                                </li>
                                <?
                            } else {
                                //장바구니에서 삭제
                            }
                            $count++;
                            $sum += $row['ct_price'];
                        }
                        $vat = $sum * 0.1;
                        $total_price = $sum + $vat;
                    }
                    ?>
                </ul>
                <input type="hidden" name="sum_price" id="sum_price" value="<?php echo $total_price;?>">
                <input type="hidden" name="ot_vat" id="ot_vat" value="<?php echo $vat;?>">
                <input type="hidden" name="payment_method" id="payment_method" value="2">
                <?
                if($users['mt_first_info'] == "N") {
                ?>
                <div class="order_btm">
                    <div class="order_customer">
                        <div class="customer_tit fw_600"><?=$customer_info?></div>
                        <div class="customer_radio">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="mt_local" id="exampleRadios1" value="1" <? if($users['mt_local']==1 || $users['mt_local']=="") echo 'checked';?>>
                                <label class="form-check-label" for="exampleRadios1">
                                    <div class="chkbox radio">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    <?=$local?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="mt_local" id="exampleRadios2" value="2" <? if($users['mt_local']==2) echo 'checked';?>>
                                <label class="form-check-label" for="exampleRadios2">
                                    <div class="chkbox radio">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    <?=$foreiner?>
                                </label>
                            </div>
                        </div>
                        <div class="customer_info">
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
                            <div class="find_name d-flex justify-content-between">
                                <div class="form-group form-group_1 form_l">
                                    <label for="mt_firstname"><?=$firstname?></label>
                                    <input type="text" class="form-control" name="mt_firstname" value="<?=$users['mt_firstname']?>">
                                </div>
                                <div class="form-group form-group_1 form_r">
                                    <label for="mt_lastname"><?=$lastname?></label>
                                    <input type="text" class="form-control" name="mt_lastname" value="<?=$users['mt_lastname']?>">
                                </div>
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
                                    <input type="text" class="form-control" id="textInput" name="mt_hp" value="<?=$users['mt_hp']?>" numberOnly>
                                </div>
                            </div>
                            <div class="form-group form-group_1">
                                <label for="extInput"><?=$email?></label>
                                <input type="text" class="form-control" id="textInput" name="mt_email" value="<?=$users['mt_email']?>">
                            </div>
                        </div>
                    </div>
                </div>
                <? } ?>
            </div>
            <div class="col-12 col-xl-4">
                <div class="cart_side sticky-top">
                    <div class="cart_side_box">
                        <ul class="cart_side_list">
                            <li>
                                <p class="cart_select"><?=$select_content?></p>
                                <p><?=$count?>개</p>
                            </li>
                            <li>
                                <p class="cart_select"><?=$contents_price?></p>
                                <?
                                if($_SESSION['_lang'] == "en") {
                                    ?>
                                    <div class="cart_price">$<span class="price ff_play"><?=number_format($sum,2)?></span></div>
                                    <?
                                } else {
                                    ?>
                                    <div class="cart_price"><span class="price ff_play"><?=number_format($sum)?></span>원</div>
                                    <?
                                }
                                ?>
                            </li>
                            <li>
                                <p class="cart_select"><?=$vat2?></p>
                                <?
                                if($_SESSION['_lang'] == "en") {
                                    ?>
                                    <div class="cart_price">$<span class="price ff_play"><?=number_format($vat,2)?></span></div>
                                    <?
                                } else {
                                    ?>
                                    <div class="cart_price"><span class="price ff_play"><?=number_format($vat)?></span>원</div>
                                    <?
                                }
                                ?>
                            </li>
                        </ul>
                        <hr class="hr2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="cart_sum fw_600"><?=$sum2?></div>
                            <?
                            if($_SESSION['_lang'] == "en") {
                                ?>
                                <div class="cart_price">$<span class="price ff_play"><?=number_format($total_price,2)?></span></div>
                                <?
                            } else {
                                ?>
                                <div class="cart_price"><span class="price ff_play"><?=number_format($total_price)?></span>원</div>
                                <?
                            }
                            ?>
                        </div>
                        <hr class="hr2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label d-flex" for="defaultCheck1">
                                <div class="chkbox chkbox-md">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <p><?=$info?></p>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary"><?=$title?></button>
                        <p class="cart_select mt-5" style="text-align: center;"><?=$subscribe2?></p>
                        <button type="button" class="btn btn-primary mt-1" onclick="location.replace('/membership.php')"><?=$subscribe?></button>
                    </div>
                    <p class="cart_txt"><?=$info1?></p>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<?php include_once("./inc/alert_modal.php"); ?>
<script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.2.0.js"></script>
<script>
    $(document).ready(function() {
        $("#mt_nationality").val("<?=$users['mt_nationality']?>");
        $("#mt_international_num").val("<?=$users['mt_international_num']?>");
    });

    history.pushState(null, null, location.href);
    window.onpopstate = function(event) {
        var prevUrl = document.referrer;
        if(prevUrl.indexOf('cart.php') < 0){
            cart_update();
        }else{
            location.href= prevUrl;
        }
    };

    function frmorder_check(f) {
        if("<?=$users['mt_first_info']?>" == "N") {
            if(f.mt_nationality.value==''){
                $("#txt").text("국적을 선택해주세요.");
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
            update_memberinfo();
        }
        if(!$("#defaultCheck1").is(":checked")) {
            $("#txt").text("약관에 동의가 필요합니다.");
            $('#id_alert').modal('show');
            return false;
        }
        if($('#payment_complete').val()!='ok'){
            content_payment();
            return false;
        } else{
            return true;
        }
    }

    function update_memberinfo(){
        $.ajax({
            type: 'post',
            url: '/models/payments/before.php',
            dataType: 'json',
            data: $('#frmorderlist').serialize(),
            success: function(d,s) { },
            cache: false
        });
    }

    //결제전 insert
    function content_payment(){
        $.ajax({
            type: 'post',
            url: '/models/payments/before.php',
            dataType: 'json',
            data: { act : 'content', ot_code : $('#ot_code').val(), amount: $("#sum_price").val()},
            success: function(d,s) {
                if(d.result=='_true'){
                    requestPay(d.data_arr);
                }else if(d.result=='_false'){
                    alert(d.msg);
                    return false;
                }
            },
            cache: false
        });
    }
    var IMP = window.IMP;
    IMP.init("imp");
    function requestPay(data_arr) {
        if(data_arr.m_redirect_url){    //모바일
            $.ajax({
                type: 'post',
                url: '/models/order_model.php',
                dataType: 'json',
                data: $('#frmorderlist').serialize(),
                success: function (d,s) {
                    if(d.result=='_ok'){
                        IMP.request_pay({ // param
                            pg: "html5_inicis",
                            pay_method: "card",
                            merchant_uid: data_arr.merchant_uid,
                            name: data_arr.name,
                            amount: data_arr.amount,
                            buyer_email: data_arr.buyer_email,
                            buyer_name: data_arr.buyer_name,
                            m_redirect_url: data_arr.m_redirect_url
                        });
                    }else{
                        alert(d.msg);
                        location.href='/mall.php';
                    }
                },
                cache: false
            });
        }else {
            if ("<?=$_SESSION['_lang']?>" == "en") {
                IMP.request_pay({ // param
                    pg: "paypal",
                    popup: true,
                    pay_method: "card",
                    merchant_uid: data_arr.merchant_uid,
                    name: data_arr.name,
                    amount: data_arr.amount,
                    buyer_email: data_arr.buyer_email,
                    buyer_name: data_arr.buyer_name
                }, function (rsp) { // callback
                    if (rsp.success) {
                        // jQuery로 HTTP 요청
                        $.ajax({
                            url: "<?php echo STATIC_HTTP;?>/models/payments/complete.php", // 예: https://www.myservice.com/payments/complete
                            type: "POST",
                            dataType: 'json',
                            data: {
                                imp_uid: rsp.imp_uid,
                                merchant_uid: rsp.merchant_uid
                            },
                            success: function (d, s) {
                                if (d.code != 200) {
                                    //결제실패
                                    alert(d.message);
                                } else {
                                    //결제성공
                                    $('#payment_complete').val('ok');
                                    $('#frmorderlist').submit();
                                }
                            },
                            error: function (data) {
                                console.log("error" + data);
                            }
                        })
                    } else {
                        alert("결제에 실패하였습니다. 에러 내용: " + rsp.error_msg, '/');
                    }
                });
            } else {
                IMP.request_pay({ // param
                    pg: "html5_inicis",
                    pay_method: "card",
                    merchant_uid: data_arr.merchant_uid,
                    name: data_arr.name,
                    amount: data_arr.amount,
                    buyer_email: data_arr.buyer_email,
                    buyer_name: data_arr.buyer_name
                }, function (rsp) { // callback
                    if (rsp.success) {
                        // jQuery로 HTTP 요청
                        $.ajax({
                            url: "<?php echo STATIC_HTTP;?>/models/payments/complete.php", // 예: https://www.myservice.com/payments/complete
                            type: "POST",
                            dataType: 'json',
                            data: {
                                imp_uid: rsp.imp_uid,
                                merchant_uid: rsp.merchant_uid
                            },
                            success: function (d, s) {
                                if (d.code != 200) {
                                    //결제실패
                                    alert(d.message);
                                } else {
                                    //결제성공
                                    $('#payment_complete').val('ok');
                                    $('#frmorderlist').submit();
                                }
                            },
                            error: function (data) {
                                console.log("error" + data);
                            }
                        })
                    } else {
                        alert("결제에 실패하였습니다. 에러 내용: " + rsp.error_msg, '/');
                    }
                });
            }
        }
    }

    function cart_update() {
        $.ajax({
            type: 'post',
            url: '/models/cart_model.php',
            dataType: 'json',
            data: { type : 'cart_reset'},
            success: function (d,s) {
                if(d.result=='_ok'){
                    location.href='/cart.php';
                }
            },
            cache: false
        });
    }
</script>

<? include_once("./inc/tail.php"); ?>