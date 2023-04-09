<?php
$title = "비밀번호 변경 완료";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="find_pg">
        <div class="sign_pg_right">
            <h2>비밀번호 변경 완료</h2>
            <div class="login_box">
                <div class="find_success">
                    <p>비밀번호가 변경되었습니다.</p>
                </div>
                <button type="button" class="btn btn-primary" onclick="location.href='signin.php'">로그인</button>
            </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>