<?php
$title = "국내계좌인증";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$confirm = lang("confirm", $_lang, "order");
$finish = lang("finish", $_lang, "account");
$repeat = lang("repeat", $_lang, "account");
?>

<div class="wrap">
        <div class="signup_pg">
            <div class="progress_bar">
                <div class="progress_bar_p progress_bar_p3"></div>
            </div>
            <h2 class="account_tit text-center"><?=$finish?></h2>
            <div class="account_box">
                <lottie-player src="img/lottie_success.json" class="lottie lottie_sm" background="transparent"  speed="1" autoplay loop></lottie-player>
                <div class="d-flex">
                    <button type="button" class="btn btn-secondary mr-3" onclick="location.href='/artist_my_account1.php'"><img src="img/ic_reset.png" alt=""> <?=$repeat?></button>
                    <button type="button" class="btn btn-primary" onclick="location.href='/artist_my_calc.php'"><?=$confirm?></button>
                </div>
            </div>
        </div>
</div>
                
<? include_once("./inc/tail.php"); ?>