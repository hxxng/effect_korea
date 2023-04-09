<?php
$title = "내 정보 수정";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>


<div class="wrap">
    <div class="signup_pg">
        <div class="go_back"><a href="#" onclick="history.back();"><img src="img/arrow_left.png" alt=""> 이전</a></div>
        <h2>내 정보 수정</h2>
        <div class="login_box">
            <ul class="list_style_1 list_pa">
                <li>
                    <span>이름</span>
                    <p>길동 홍</p>
                </li>
                <li>
                    <span>아이디</span>
                    <p>artist@email.com</p>
                </li>
            </ul>
            <div class="info_cont">
                <h3 class="fw_700">비밀번호 변경</h3>
                <div class="form-group form-group_1">
                    <label for="extInput">비밀번호</label>
                    <input type="password" class="form-control" id="textInput">
                </div>
                <div class="form-group form-group_1">
                    <label for="extInput">비밀번호 확인</label>
                    <input type="password" class="form-control" id="textInput">
                </div>
                <button type="button" class="btn btn-secondary" onclick="location.href='#'">변경하기</button>
            </div>
            <div class="info_cont">
                <h3 class="fw_700">연락처 변경</h3>
                <div class="form-group form-group_1">
                    <label for="extInput">연락처('-'없이 숫자만 입력)</label>
                    <input type="text" class="form-control" id="textInput">
                </div>
                <button type="button" class="btn btn-secondary" onclick="location.href='#'">변경하기</button>
            </div>
            <div class="info_cont text-center">
                <span class="member_br" data-toggle="modal" data-target="#modal_sm">탈퇴하기</span>
            </div>
        </div>
    </div>
</div>


<!-- 회원탈퇴 팝업 -->
<div class="modal fade" id="modal_sm" tabindex="-1" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-sm">
        <div class="modal-content">
        <div class="modal-header">
        </div>
        <div class="modal-body member_br_modal">
            <lottie-player src="img/lottie_sad.json" class="lottie lottie_sad" loop autoplay></lottie-player>
            <h3 class="fw_600">회원 탈퇴하기</h3>
            <p class="fs_18">회원 탈퇴후 개인정보 파기 및 구매내역 확인이 불가능합니다. 구매하신 콘텐츠 저장을 권장합니다.</p>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    <div class="chkbox">
                        <i class="bi bi-check-lg"></i>
                    </div>
                    동의합니다.
                </label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">취소</button>
            <button type="button" class="btn btn-primary" onclick="location.href='#'">탈퇴하기</button>
        </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>