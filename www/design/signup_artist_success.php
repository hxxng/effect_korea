<?php
$title = "아티스트 회원가입";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="find_pg">
        <div class="sign_pg_right">
            <div class="login_box">
                <lottie-player src="img/lottie_success.json" class="lottie" background="transparent"  speed="1" autoplay loop></lottie-player>
                <div class="sign_success">
                    <div class="success_tit"><h3 class="fw_600">아티스트 회원 신청이 완료되었습니다.</h3></div>
                    <p>최고관리자의 승인까지 잠시만 기다려주세요.</p>
                </div>
                <button type="button" class="btn btn-primary" onclick="location.href='index.php'">확인</button>
            </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>