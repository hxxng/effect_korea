<?php
$title = "비밀번호 찾기";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="find_pg">
        <div class="sign_pg_right">
            <h2>비밀번호 찾기</h2>
            <div class="login_box">
                <div class="form-group form-group_1">
                    <label for="extInput">아이디(이메일형식)</label>
                    <input type="text" class="form-control" id="textInput">
                    <small class="form-text text-danger"><img class="mr-2" src="img/ic_label_danger.png">메일 인증 후 다음 단계로 이동해주세요.</small>
                    <button type="button" class="btn btn-outline-primary btn-sm btn_in">메일 인증</button>
                    <!-- <div class="btn btn-outline-secondary btn-sm btn_in pe_none">인증완료</div> -->
                </div>
                <div class="find_name d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-primary login_btn form_l" onclick="location.href='signin.php'">로그인</button>
                    <button type="button" class="btn btn-primary login_btn form_r n_active" onclick="location.href='find_newpw.php'">비밀번호 찾기</button>
                </div>
            </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>