<?php
$title = "비밀번호 변경 완료";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$login = lang("login",$_lang, "signin");
$find_pwd_success = lang("find_pwd_success",$_lang, "find");
$find_pwd_success2 = lang("find_pwd_success",$_lang, "find");
?>

<div class="wrap">
    <div class="find_pg">
        <div class="sign_pg_right">
            <h2><?=$find_pwd_success?></h2>
            <div class="login_box">
                <div class="find_success">
                    <p><?=$find_pwd_success2?></p>
                </div>
                <button type="button" class="btn btn-outline-primary form_l"><?=$login?></button>
            </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>