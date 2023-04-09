<?php
$title = "아티스트 회원가입";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$login = lang("login", $_lang, "nav");
$overlap = lang("overlap", $_lang, "signup");
$overlap_ment = lang("overlap_ment", $_lang, "signup");
?>

<div class="wrap">
    <div class="find_pg">
        <div class="sign_pg_right">
            <div class="login_box">
                <lottie-player src="img/lottie_warning.json" class="lottie lottie_caution" background="transparent"  speed="1" autoplay loop></lottie-player>
                <div class="sign_success">
                    <div class="success_tit"><h3 class="fw_600"><?=$overlap?></h3></div>
                    <p><?=$overlap_ment?></p>
                </div>
                <button type="button" class="btn btn-primary" onclick="location.href='signin.php'"><?=$login?></button>
            </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>