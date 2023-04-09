<?php
$title = "아티스트 회원가입";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$artist_application = lang("artist_application",$_lang, "signup");
$artist_application_ment = lang("artist_application_ment",$_lang, "signup");
$confirm = lang("confirm",$_lang, "order");
?>

<div class="wrap">
    <div class="find_pg">
        <div class="sign_pg_right">
            <div class="login_box">
                <lottie-player src="img/lottie_success.json" class="lottie" background="transparent"  speed="1" autoplay loop></lottie-player>
                <div class="sign_success">
                    <div class="success_tit"><h3 class="fw_600"><?=$artist_application?></h3></div>
                    <p><?=$artist_application_ment?></p>
                </div>
                <button type="button" class="btn btn-primary" onclick="location.href='index.php'"><?=$confirm?></button>
            </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>