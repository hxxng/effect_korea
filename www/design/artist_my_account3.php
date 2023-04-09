<?php
$title = "국내계좌인증";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
        <div class="signup_pg">
            <div class="progress_bar">
                <div class="progress_bar_p progress_bar_p3"></div>
            </div>
            <h2 class="account_tit text-center">감사합니다.<br>인증이 완료되었습니다.</h2>
            <div class="account_box">
                <lottie-player src="img/lottie_success.json" class="lottie lottie_sm" background="transparent"  speed="1" autoplay loop></lottie-player>
                <div class="d-flex">
                    <button type="button" class="btn btn-secondary mr-3" onclick="location.href='artist_my_account1.php'"><img src="img/ic_reset.png" alt=""> 다시하기</button>
                    <button type="button" class="btn btn-primary" onclick="location.href='#'">확인</button>
                </div>
            </div>
        </div>
</div>
                
<? include_once("./inc/tail.php"); ?>