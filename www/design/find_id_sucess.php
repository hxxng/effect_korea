<?php
$title = "아이디 찾기 완료";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="find_pg">
        <div class="sign_pg_right">
            <h2>아이디 찾기 완료</h2>
            <div class="login_box">
                <div class="find_success">
                    <p>회원님의 아이디는 <span>hong_123</span> 입니다.</p>
                </div>
                <div class="find_name d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-primary form_l" onclick="location.href='signin.php'">로그인</button>
                    <button type="button" class="btn btn-primary form_r" onclick="location.href='find_pw.php'">비밀번호 찾기</button>
                </div>
            </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>