<?php
$title = "아티스트 신청";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-12 my-5">
                <div class="wr_tit1">
                    <h2>마이페이지</h2>
                </div>
                <div class="order_hd mp_hd d-flex justify-content-between align-items-center">
                    <h3 class="fw_600">공드리님 반가워요!</h3>
                    <button type="button" class="cart_del" onclick="location.href='my_info.php';"><img src="img/ic_modify.png" alt="">내 정보 수정</button>
                </div>
                <ul class="t_menu">
                    <li><a href="my_subscription.php">구독현황</a></li>
                    <li><a href="my_orderlist.php">구매내역</a></li>
                    <li><a href="my_like.php">즐겨찾기</a></li>
                    <li class="t_active"><a href="my_request.php">아티스트신청</a></li>
                </ul> 
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">

                <!-- 아티스트 신청전 -->
                <div class="mp_cont_box">
                    <img src="img/mp_img01.png" alt="">
                    <h3 class="fw_700">EFFECT KOREA의 아티스트가 되어 <br>멋진 콘텐츠를 제작해 보세요.</h3>
                    <button type="button" class="btn btn-primary mp_btn" onclick="location.href='signup_artist1_1.php';">아티스트 신청하기</button>
                </div>
                <!-- 아티스트 신청전 끝 -->

                <!-- 아티스트 신청전-1 -->
                <!-- <div class="mp_cont_box login_box">
                    <lottie-player src="img/lottie_loading.json" class="lottie lottie_caution" loop autoplay speed="2"></lottie-player>
                    <h3 class="fw_700">EFFECT KOREA의 아티스트 회원 승인중입니다. <br>검토는 최대 7일 소요됩니다.</h3>
                    <button type="button" class="btn btn-primary mp_btn" onclick="location.href='signup_artist1_1.php';">재신청하기</button>
                </div> -->
                <!-- 아티스트 신청전-1 끝 -->

                <!-- 아티스트 신청전-2 -->
                <!-- <div class="mp_cont_box login_box">
                    <lottie-player src="img/lottie_warning.json" class="lottie lottie_caution" loop autoplay speed="2"></lottie-player>
                    <h3 class="fw_700">아티스트 회원 신청이 [거절사유]로 <br>반려되었습니다.</h3>
                    <div class="mp_btn d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary form_l" onclick="location.href='#'">확인</button>
                        <button type="button" class="btn btn-primary form_r" onclick="location.href='signup_artist1_1.php'">다시 신청하기</button>
                    </div>
                </div> -->
                <!-- 아티스트 신청전-2 끝 -->
            </div>
        </div> 
    </div>
</div>


<? include_once("./inc/tail.php"); ?>