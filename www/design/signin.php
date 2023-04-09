<?php
$title = "로그인";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<style>

    .header_wrap, 
    .mobile_mainheader_wrap{
        display: none !important;
    }
    .footer_wrap{
        margin-top: 0 !important;
    }

</style>

<div class="container-fluid sign_pg">
    <div class="sign_pg_flex">
        <div class="sign_f_m sign_f_left">
            <div class="sign_pg_left">
                <a href="index.php">
                    <img src="img/logo_w.png" alt="">
                    <div class="sign_tit ff_play fs_40">Effect Korea</div>
                </a>
                <p>저작권 문제 없는 다양한 영상을 구매하거나
                이펙트코리아의 아티스트가 되어보세요</p>
                <div class="ad_box">
                    <img src="img/ad_box.png" alt="">
                </div>
            </div>
        </div>
        <div class="sign_f_m sign_f_right">
            <div class="sign_pg_right">
                <h2>로그인</h2>
                <div class="login_box">
                    <div class="form-group form-group_1">
                        <label for="extInput">아이디</label>
                        <input type="text" class="form-control" id="textInput">
                    </div>
                    <div class="form-group form-group_1">
                        <label for="extInput">비밀번호</label>
                        <input type="password" class="form-control" id="textInput">
                    </div>
                    <button type="button" class="btn btn-primary login_btn">로그인</button>
                    <div class="d-flex justify-content-between login_box_b">
                        <a href="signup.php">이펙트코리아가 처음이신가요?</a>
                        <div class="find">
                            <a href="find_id.php">아이디 찾기</a>
                            <span>|</span>
                            <a href="find_pw.php">비밀번호 찾기</a>
                        </div>
                    </div>
                </div>
                <div class="sns_box">
                    <p class="sns_txt">SNS로 간편하게 로그인 해보세요</p>
                    <ul class="sns_grid">
                        <li>
                            <a href="#"><img src="img/ic_sns01.png" alt=""></a>
                        </li>
                        <li>
                            <a href="#"><img src="img/ic_sns02.png" alt=""></a>
                        </li>
                        <li>
                            <a href="#"><img src="img/ic_sns03.png" alt=""></a>
                        </li>
                        <li>
                            <a href="#"><img src="img/ic_sns04.png" alt=""></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="login_allert" tabindex="-1" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-sm">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <lottie-player src="img/lottie_warning.json" class="lottie" style="width: 104px; height: 104px;" background="transparent"  speed="1" autoplay loop></lottie-player>
                <div class="sign_success">
                    <div class="success_tit"><h3 class="fw_600">아이디를 입력해주세요</h3></div>
                </div>
            </div>
            <div class="modal-footer">                    
                <button type="button" class="btn btn-primary" data-dismiss="modal">확인</button>
            </div>
        </div>
    </div>
</div> -->

<? include_once("./inc/tail.php"); ?>