<?php
$title = "해외계좌인증";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="signup_pg">
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
            <button type="button" class="btn btn-primary login_btn n_active" data-toggle="modal" data-target="#modal_sm">인증하기</button>
        </div>
    </div>
</div>

<!-- 해외계좌 인증 실패 토스트 -->
<div class="toast_cont position-fixed">
    <div class="toast toast_cart align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex align-items-center justify-content-between">
            <div class="toast_body">
                계좌 인증이 실패했습니다. <br class="mobile2">페이팔 이메일을 확인해주세요.
            </div>
            <a class="toast_for fc_blue1" href="#">닫기</a>
        </div>
    </div>
</div>

<!-- 계좌인증팝업 -->
<div class="modal fade" id="modal_sm" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-sm">
        <div class="modal-content">
        <div class="modal-header">
        </div>
        <div class="modal-body">
            <lottie-player src="img/lottie_success.json" class="lottie lottie_sm" background="transparent"  speed="1" autoplay loop></lottie-player>
            <h3 class="fw_600">계좌 인증이 완료되었습니다.</h3>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="location.href='#'">확인</button>
        </div>
        </div>
    </div>
</div>
                
<? include_once("./inc/tail.php"); ?>