<?php
$title = "국내계좌인증";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="signup_pg">
        <div class="progress_bar">
            <div class="progress_bar_p"></div>
        </div>
        <h2 class="account_tit">계좌인증</h2>
        <h4 class="account_subtit">실명인증을 위해 보유하고 있는 <br>계좌정보를 입력해주세요.</h4>
        <div class="account_box">
            <div class="form-group form-group_1">                       
                <label for="exampleFormControlSelect1" class="on">은행명</label> 
                <select class="form-control" id="exampleFormControlSelect1" aria-placeholder="선택해주세요.">
                    <option>한국은행</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>  
            <div class="form-group form-group_1">
                <label for="extInput">계좌번호</label>
                <input type="number" class="form-control" id="textInput">
                <p class="p1">* 평생 계좌번호, 가상 계좌번호는 지정할 수 없습니다.</p>
            </div>
            <button type="button" class="btn btn-primary login_btn n_active" data-toggle="modal" data-target="#modal_md">다음</button>
        </div>
    </div>
</div>

<!-- 계좌인증팝업 -->
<div class="modal fade" id="modal_md" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-md">
        <div class="modal-content">
        <div class="modal-header justify-content-center">
            <h5 class="modal-title text-center" id="exampleModalLabel">입력하신 계좌로<br>1원을 보내드렸어요.</h5>
            <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
                <img src="img/ic_x.png" alt="닫기">
            </button>
        </div>
        <div class="modal-body text-center">
            <div class="account_img"><img src="img/account_img.png" alt=""></div>
            <p>1. 은행앱 또는 텔레뱅킹 거래내역을 확인해주세요.</p>
            <p>2. 입금된 1원의 입금자명 4글자를 확인 후 입력해주세요.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="location.href='artist_my_account2.php'">확인</button>
        </div>
        </div>
    </div>
</div>
                
<? include_once("./inc/tail.php"); ?>