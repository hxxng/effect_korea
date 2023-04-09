<?php
$title = "아티스트 회원가입";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="find_pg">
        <div class="sign_pg_right">
            <div class="login_box">
                <lottie-player src="img/lottie_warning.json" class="lottie lottie_caution" background="transparent"  speed="1" autoplay loop></lottie-player>
                <div class="sign_success">
                    <div class="success_tit"><h3 class="fw_600">아티스트 회원가입이 [거절사유]로 반려되었습니다.</h3></div>
                </div>
                <button type="button" class="btn btn-primary login_btn_1" onclick="location.href='signin.php'">로그인</button>
            </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>