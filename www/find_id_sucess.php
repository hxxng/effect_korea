<?php
$title = "아이디 찾기 완료";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$login = lang("login",$_lang, "signin");
$find_id_success = lang("find_id_success",$_lang, "find");
$find_pwd = lang("find_pwd",$_lang, "find");
$your_id = lang("your_id",$_lang, "find");
$your_id2 = lang("your_id2",$_lang, "find");
?>

<div class="wrap">
    <div class="find_pg">
        <div class="sign_pg_right">
            <h2><?=$find_id_success?></h2>
            <div class="login_box">
                <div class="find_success">
                    <p><?=$your_id?> <span><?=$_GET['id']?></span> <?=$your_id2?></p>
                </div>
                <div class="find_name d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-primary form_l" onclick="location.href='/signin.php'"><?=$login?></button>
                    <button type="button" class="btn btn-primary form_r" onclick="location.href='/find_pw.php'"><?=$find_pwd?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>