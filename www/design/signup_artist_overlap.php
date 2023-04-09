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
                    <div class="success_tit"><h3 class="fw_600">SNS로 회원가입이 되어 있습니다.</h3></div>
                    <p>중복가입 불가로 로그인 페이지로 이동합니다.</p>
                </div>
                <button type="button" class="btn btn-primary" onclick="location.href='signin.php'">로그인</button>
            </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>