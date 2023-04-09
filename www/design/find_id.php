<?php
$title = "아이디 찾기";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="find_pg">
        <div class="sign_pg_right">
            <h2>아이디 찾기</h2>
            <div class="login_box">
                <div class="find_name d-flex justify-content-between">
                    <div class="form-group form-group_1 form_l">
                        <label for="extInput">이름</label>
                        <input type="text" class="form-control" id="textInput">
                    </div>
                    <div class="form-group form-group_1 form_r">
                        <label for="extInput">성</label>
                        <input type="text" class="form-control" id="textInput">
                    </div>
                </div>
                <div class="form-group form-group_1">
                    <label for="extInput">연락처('-' 없이 숫자만 입력)</label>
                    <input type="text" class="form-control" id="textInput">
                </div>
                <button type="button" class="btn btn-primary login_btn" onclick="location.href='find_id_sucess.php'">확인</button>
            </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>