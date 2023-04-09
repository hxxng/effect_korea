<?php
$title = "비밀번호 변경";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="find_pg">
        <div class="sign_pg_right">
            <h2>비밀번호 변경</h2>
            <div class="login_box">
                <div class="form-group form-group_1">
                    <label for="extInput">새 비밀번호</label>
                    <input type="password" class="form-control" id="textInput">
                </div>
                <div class="form-group form-group_1">
                    <label for="extInput">새 비밀번호 확인</label>
                    <input type="password" class="form-control" id="textInput">
                </div>
                <div class="find_name d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary login_btn form_l" onclick="location.href='signin.php'">취소</button>
                    <button type="button" class="btn btn-primary login_btn form_r" onclick="location.href='find_pw_sucess.php'">변경하기</button>
                </div>
            </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>