<?php
$title = "회원가입 완료";

include_once("./inc/head.php");
include_once("./inc/nav.php");
$_lang = $_SESSION['_lang'];
$success = lang("success",$_lang, "signup");
$ment = lang("ment",$_lang, "signup");
$home = lang("home",$_lang, "signup");
?>

<div class="wrap">
    <div class="find_pg">
        <div class="sign_pg_right">
            <div class="login_box">
                <lottie-player src="img/lottie_success.json" class="lottie" background="transparent"  speed="1" autoplay loop></lottie-player>
                <div class="sign_success">
                    <div class="success_tit"><h3 class="fw_600"><?=$success?></h3></div>
                    <p><?=$ment?></p>
                </div>
                <button type="button" class="btn btn-primary" onclick="location.href='index.php'"><?=$home?></button>
            </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>