<?php
$title = "국내계좌인증";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="signup_pg">
        <div class="progress_bar">
            <div class="progress_bar_p progress_bar_p2"></div>
        </div>
        <div class="go_back"><a href="#" onclick="history.back();"><img src="img/arrow_left.png" alt=""> 이전</a></div>
        <h2 class="account_tit">입금자명 코드 입력</h2>
        <h4 class="account_subtit">계좌에 입력된 입금자명을 확인 후 입력해주세요.</h4>
        <div class="account_box">
            
            <div class="d-flex account_input_group">
                <input type="number" class="form-control account_input active mr-3" placeholder="">
                <input type="number" class="form-control account_input mr-3" placeholder="">
                <input type="number" class="form-control account_input mr-3" placeholder="">
                <input type="number" class="form-control account_input" placeholder="">
            </div>
            <button type="button" class="btn btn-primary login_btn n_active" onclick="location.href='artist_my_account3.php'">다음</button>
        </div>
    </div>
</div>
                
<? include_once("./inc/tail.php"); ?>