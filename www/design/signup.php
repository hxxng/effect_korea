<?php
$title = "회원가입";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>
<div class="wrap">
    <div class="signup_pg">
        <h2>회원가입</h2>
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
                <label for="extInput">아이디(이메일형식)</label>
                <input type="text" class="form-control" id="textInput">
                <small class="form-text text-danger"><img class="mr-2" src="img/ic_label_danger.png">잘못된 이메일형식입니다.</small>
                <!-- <small class="form-text text-success"><img class="mr-2" src="img/ic_label_danger.png">메일 인증되었습니다.</small> -->
                <button type="button" class="btn btn-outline-primary btn-sm btn_in">메일 인증</button>
                <!-- <div class="btn btn-outline-secondary btn-sm btn_in pe_none">인증완료</div> -->
            </div>
            <div class="form-group form-group_1">
                <label for="extInput">비밀번호(영문, 숫자, 특수문자 중 2종류 이상 조합)</label>
                <input type="password" class="form-control" id="textInput">
            </div>
            <div class="form-group form-group_1">
                <label for="extInput">비밀번호 확인</label>
                <input type="password" class="form-control" id="textInput">
            </div>
            <div class="form-group form-group_1">
                <label for="extInput">연락처('-'없이 숫자만 입력)</label>
                <input type="text" class="form-control" id="textInput">
            </div>
            <div class="terms">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        전체 동의
                    </label>
                </div>
                <div class="terms_box">
                    <div class="d-flex justify-content-between terms_wr">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                            <label class="form-check-label" for="defaultCheck2">
                                <div class="chkbox">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                이용약관 동의
                            </label>
                        </div>
                        <a data-target="#use_terms" data-toggle="modal">보기</a>
                    </div>
                    <div class="d-flex justify-content-between terms_wr">
                        <div class="form-check justify-content-between">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck3">
                            <label class="form-check-label" for="defaultCheck3">
                                <div class="chkbox">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                개인정보취급방침 동의
                            </label>
                        </div>
                        <a data-target="#private_terms" data-toggle="modal">보기</a>
                    </div>
                    <div class="d-flex justify-content-between terms_wr">
                        <div class="form-check justify-content-between">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck4">
                            <label class="form-check-label" for="defaultCheck4">
                                <div class="chkbox">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                라이선스 약관 동의
                            </label>
                        </div>
                        <a data-target="#license" data-toggle="modal">보기</a>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary login_btn" onclick="location.href='signup_success.php'">회원가입</button>
        </div>
    </div>
</div>



<? include_once("./inc/tail.php"); ?>