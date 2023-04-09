<?php
$title = "아티스트 회원가입";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>
<div class="wrap">
    <div class="signup_pg">
        <h2>아티스트 회원가입</h2>
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
            <button type="button" class="btn btn-primary login_btn" onclick="location.href='signup_artist_success.php'">다음</button>
        </div>
    </div>
</div>



<? include_once("./inc/tail.php"); ?>