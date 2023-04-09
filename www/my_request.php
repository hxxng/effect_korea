<?php
$title = "아티스트 신청";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$mypage = lang("mypage", $_lang, "mypage");
$info_update = lang("info_update", $_lang, "mypage");
$subscription = lang("subscription", $_lang, "mypage");
$order = lang("order", $_lang, "mypage");
$favorites = lang("favorites", $_lang, "mypage");
$artist = lang("artist", $_lang, "mypage");
$info1 = lang("info1", $_lang, "mypage");
$btn1 = lang("btn1", $_lang, "mypage");
$info2 = lang("info2", $_lang, "mypage");
$btn2 = lang("btn2", $_lang, "mypage");
$info3_1 = lang("info3_1", $_lang, "mypage");
$info3_2 = lang("info3_2", $_lang, "mypage");
$btn3 = lang("btn3", $_lang, "mypage");
$confirm = lang("confirm", $_lang, "order");

if($member_info['idx'] < 1) {
    p_alert('로그인 후 이용가능한 서비스입니다.', '/');
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
                    <button type="button" class="cart_del" onclick="location.href='/my_info.php';"><img src="img/ic_modify.png" alt=""><?=$info_update?></button>
                </div>
                <ul class="t_menu">
                    <li><a href="/my_subscription.php"><?=$subscription?></a></li>
                    <li><a href="/my_orderlist.php"><?=$order?></a></li>
                    <li><a href="/my_like.php"><?=$favorites?></a></li>
                    <li class="t_active"><a href="/my_request.php"><?=$artist?></a></li>
                </ul> 
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <? if($member_info['mt_approve'] == 0) { ?>
                <!-- 아티스트 신청전 -->
                <div class="mp_cont_box">
                    <img src="img/mp_img01.png" alt="">
                    <h3 class="fw_700"><?=$info1?></h3>
                    <button type="button" class="btn btn-primary mp_btn" onclick="location.href='signup_artist1_1.php';"><?=$btn1?></button>
                </div>
                <!-- 아티스트 신청전 끝 -->
                <? } else if($member_info['mt_approve'] == 1) { ?>
                <!-- 아티스트 신청전-1 -->
                <div class="mp_cont_box login_box">
                    <lottie-player src="img/lottie_loading.json" class="lottie lottie_caution" loop autoplay speed="2"></lottie-player>
                    <h3 class="fw_700"><?=$info2?></h3>
                    <button type="button" class="btn btn-primary mp_btn" onclick="location.href='signup_artist1_1.php';"><?=$btn2?></button>
                </div>
                <!-- 아티스트 신청전-1 끝 -->
                <? } else if($member_info['mt_approve'] == 3) { ?>
                <!-- 아티스트 신청전-2 -->
                <div class="mp_cont_box login_box">
                    <lottie-player src="img/lottie_warning.json" class="lottie lottie_caution" loop autoplay speed="2"></lottie-player>
                    <h3 class="fw_700"><?=$info3_1?> [<?=$member_info['mt_approve_memo']?>]<?=$info3_2?></h3>
                    <div class="mp_btn d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary form_l" onclick="location.href='/my_subscription.php'"><?=$confirm?></button>
                        <button type="button" class="btn btn-primary form_r" onclick="location.href='signup_artist1_1.php'"><?=$btn3?></button>
                    </div>
                </div>
                <!-- 아티스트 신청전-2 끝 -->
            <? } ?>
            </div>
        </div> 
    </div>
</div>


<? include_once("./inc/tail.php"); ?>