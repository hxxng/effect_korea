<?php
$title = "프로필수정";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>
<div class="wrap">
    <div class="signup_pg">
        <h2>프로필수정</h2>
        <div class="login_box">
            <div class="form-group form-group_1">
                <label for="extInput">이름</label>
                <input type="text" class="form-control" id="textInput">
                <button type="button" class="btn btn-outline-primary btn-sm btn_in">중복 확인</button>
                <!-- <div class="btn btn-outline-secondary btn-sm btn_in pe_none">확인 완료</div> -->
            </div>
            <div class="form-group form-group_1">
                <label for="extInput">포트폴리오(url)</label>
                <input type="text" class="form-control" id="textInput">
            </div>
            <div class="form-group form-group_1">
                <label for="extInput">포트폴리오(url)</label>
                <input type="text" class="form-control" id="textInput">
                <button type="button" class="btn_in btn_del"></button>
            </div>
            <div class="btn_add">
                <button type="button" class="btn btn-outline-primary btn-sm">+ url 추가 입력</button>
            </div>
            <div class="prof_box">
                <p class="fs-17">프로필사진(선택)</p>
                <div class="prof_file">
                    <div class="file_img square"><img src="img/profile_img.png" alt=""></div>
                    <button class="btn_write"></button>
                </div>
                <div class="form-group form-group_1">
                    <label for="extInput" class="">자기소개글(선택)</span></label>
                    <textarea class="form-control"></textarea>
                    <small class="form-text">0/120</small>
                </div>
            </div>
            <button type="button" class="btn btn-primary login_btn" onclick="location.href='artist_my.php'">변경하기</button>
        </div>
    </div>
</div>



<? include_once("./inc/tail.php"); ?>