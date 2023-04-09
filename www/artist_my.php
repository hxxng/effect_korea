<?php
$title = "아티스트 마이페이지";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$mypage = lang("mypage", $_lang, "mypage");
$info_update = lang("info_update", $_lang, "mypage");
$home = lang("home", $_lang, "mypage");
$subscription = lang("subscription", $_lang, "mypage");
$order = lang("order", $_lang, "mypage");
$favorites = lang("favorites", $_lang, "mypage");
$profile_update = lang("profile_update", $_lang, "mypage");
$contents_cnt_txt = lang("contents_cnt", $_lang, "mypage");
$favorites_cnt = lang("favorites_cnt", $_lang, "mypage");
$sales_cnt = lang("sales_cnt", $_lang, "mypage");
$sale_price = lang("sale_price", $_lang, "mypage");
$contents_upload = lang("contents_upload", $_lang, "mypage");
$contents_menu = lang("contents_menu", $_lang, "mypage");
$sales_list = lang("sales_list", $_lang, "mypage");
$settlement_account = lang("settlement_account", $_lang, "mypage");

if($member_info['idx'] < 1) {
    p_alert('로그인 후 이용가능한 서비스입니다.', '/');
    exit;
}
if($member_info['mt_level'] != 5) {
    p_alert('아티스트만 접근가능한 서비스입니다.', '/');
    exit;
}
$name = lang("name", $_lang, "mypage");
if($member_info['mt_firstname'] == "") {
    $name2 = lang("no_name", $_lang, "mypage");
    if($_lang == "en") {
        $name = $name.$name2;
    } else {
        $name = $name2.$name;
    }
} else {
    if($_lang == "en") {
        $name = $name.$member_info['mt_firstname'];
    } else {
        $name = $member_info['mt_firstname'].$name;
    }
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

$query = "select * from contents_t where mt_idx = ".$member_info['idx']." and ct_status = 2 and ct_show = 'Y'";
$contents_cnt = $DB->count_query($query);

$query = "select * from wish_contents_t left join contents_t on contents_t.idx = wish_contents_t.ct_idx where wish_contents_t.mt_idx = ".$member_info['idx']." and ct_status = 2 and ct_show = 'Y' and wct_status = 'Y'";
$wish_cnt = $DB->count_query($query);

$query = "select * from cart_t left join order_t on order_t.ot_code = cart_t.ot_code left join contents_t on contents_t.idx = cart_t.ct_idx 
         where contents_t.mt_idx = ".$member_info['idx']." and contents_t.ct_status = 2 and ct_show = 'Y' and ot_status = 2 and (ot_pdate is not null and ot_pdate <> '')";
$sale_cnt = $DB->count_query($query);

$query = "select sum(ot_price) as kr_sum, sum(ot_vat) as kr_vat from cart_t left join order_t on order_t.ot_code = cart_t.ot_code left join contents_t on contents_t.idx = cart_t.ct_idx 
         where contents_t.mt_idx = ".$member_info['idx']." and contents_t.ct_status = 2 and ct_show = 'Y' and ot_status = 2 and (ot_pdate is not null and ot_pdate <> '') and ct_unit = 1";
$kor = $DB->fetch_assoc($query);

$query = "select sum(ot_price) as en_sum, sum(ot_vat) as en_vat from cart_t left join order_t on order_t.ot_code = cart_t.ot_code left join contents_t on contents_t.idx = cart_t.ct_idx 
         where contents_t.mt_idx = ".$member_info['idx']." and contents_t.ct_status = 2 and ct_show = 'Y' and ot_status = 2 and (ot_pdate is not null and ot_pdate <> '') and ct_unit = 2";
$eng = $DB->fetch_assoc($query);

if($_lang == "en") {
    $sum = ($kor['kr_sum'] / $dollar) + ($kor['kr_vat'] / $dollar) + $eng['en_sum'] + $eng['en_vat'];
    $bt_language = 2;
} else {
    $sum = $kor['kr_sum'] + $kor['kr_vat'] + ($eng['en_sum'] * $dollar) + ($eng['en_vat'] * $dollar);
    $bt_language = 1;
}

$query = "select * from banner_t where bt_main = 'N' and bt_show = 'Y' and bt_type = 2 and bt_language = ".$bt_language." order by bt_wdate limit 1";
$banner = $DB->fetch_assoc($query);
?>

<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-12 my-5">
                <div class="wr_tit1">
                    <h2><?=$mypage?></h2>
                </div>
                <div class="order_hd mp_hd d-flex justify-content-between align-items-center">
                    <h3 class="fw_600"><?=$name?></h3>
                    <button type="button" class="cart_del" onclick="location.href='my_info.php';"><img src="img/ic_modify.png" alt=""><?=$info_update?></button>
                </div>
                <ul class="t_menu">
                    <li class="t_active"><a href="/artist_my.php"><?=$home?></a></li>
                    <li><a href="/artist_my_subscription.php"><?=$subscription?></a></li>
                    <li><a href="/artist_my_orderlist.php"><?=$order?></a></li>
                    <li><a href="/artist_my_like.php"><?=$favorites?></a></li>
                </ul> 
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-12">
                <div class="artist_profile d-md-flex align-items-center justify-content-between">
                    <div class="artist_pf_wrap d-flex align-items-center justify-content-between">
                        <div class="artist_pf_img square"><img src="<? if($member_info['mt_image']) echo $ct_img_url."/".$member_info['mt_image']; else echo $ct_member_no_img_url;?>" alt=""></div>
                        <div class="artist_pf_txt">
                            <h4 class="fw_700 ff_play"><?=$member_info['mt_nickname']?></h4>
                            <p class="text_hidden2"><?=$member_info['mt_introduce']?></p>
                        </div>
                    </div>
                    <div class="artist_pf_btn"><button type="button" class="btn btn-secondary btn-sm btn_pf" onclick="location.href='artist_my_info.php'"><img src="img/ic_modify.png" alt=""><?=$profile_update?></button></div>
                </div>
                <div class="artist_pf_grid">
                    <a href="/artist_my_upload.php">
                        <div class="artist_pf_box text-center">
                            <img src="img/ic_upload.png" alt="">
                            <p><?=$contents_upload?></p>
                        </div>
                    </a>
                    <a href="/artist_my_contents.php">
                        <div class="artist_pf_box text-center">
                            <img src="img/ic_contents.png" alt="">
                            <p><?=$contents_menu?></p>
                        </div>
                    </a>
                    <a href="/artist_my_calc.php">
                        <div class="artist_pf_box text-center">
                            <img src="img/ic_sell.png" alt="">
                            <p><?=$sales_list?></p>
                        </div>
                    </a>
                    <a href="/artist_my_account1.php">
                        <div class="artist_pf_box text-center">
                            <img src="img/ic_calc.png" alt="">
                            <p><?=$settlement_account?></p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-6 col-12">
                <div class="artist_my_contents_grid">
                    <div class="artist_my_contents">
                        <p><?=$contents_cnt_txt?></p>
                        <p class="fw_600 text-right artist_my_sub"><?=number_format($contents_cnt)?>건</p>
                    </div>
                    <div class="artist_my_contents">
                        <p><?=$favorites_cnt?></p>
                        <p class="fw_600 text-right artist_my_sub"><?=number_format($wish_cnt)?>건</p>
                    </div>
                    <div class="artist_my_contents">
                        <p><?=$sales_cnt?></p>
                        <p class="fw_600 text-right artist_my_sub"><?=number_format($sale_cnt)?>건</p>
                    </div>
                    <div class="artist_my_contents">
                        <p><?=$sale_price?></p>
                        <?if($_SESSION['_lang'] == "en") { ?>
                        <p class="fw_600 text-right artist_my_sub">$<?=number_format($sum,2)?></p>
                        <? } else {?>
                            <p class="fw_600 text-right artist_my_sub"><?=number_format($sum)?>원</p>
                        <? } ?>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <? if($banner) { ?>
                <div class="btm_ad text-center" style="padding: 0;"><img src="<?=$ct_img_url.'/'.$banner['bt_file']?>" style="width: 100%;height: 100%;"/></div>
                <? } ?>
            </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>