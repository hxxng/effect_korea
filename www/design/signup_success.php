<?php
$title = "회원가입 완료";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="find_pg">
        <div class="sign_pg_right">
            <div class="login_box">
                <lottie-player src="img/lottie_success.json" class="lottie" background="transparent"  speed="1" autoplay loop></lottie-player>
                <div class="sign_success">
                    <div class="success_tit"><h3 class="fw_600">회원가입이 완료되었습니다.</h3></div>
                    <p>EFFECT KOREA에서 다양한 컨텐츠를 만나보세요!</p>
                </div>
                <button type="button" class="btn btn-primary" onclick="location.href='index.php'">홈으로</button>
            </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>