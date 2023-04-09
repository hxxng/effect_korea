<?php
$title = "국내계좌인증";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$confirm = lang("confirm", $_lang, "order");
$next = lang("next", $_lang, "signup");
$account = lang("account", $_lang, "account");
$account_ment = lang("account_ment", $_lang, "account");
$bank = lang("bank", $_lang, "account");
$account_num = lang("account_num", $_lang, "account");
$account_ment2 = lang("account_ment2", $_lang, "account");
$holder = lang("holder", $_lang, "account");
$send = lang("send", $_lang, "account");
$modal_ment1 = lang("modal_ment1", $_lang, "account");
$modal_ment2 = lang("modal_ment2", $_lang, "account");
?>

<div class="wrap">
    <div class="signup_pg">
        <div class="progress_bar">
            <div class="progress_bar_p"></div>
        </div>
        <h2 class="account_tit"><?=$account?></h2>
        <h4 class="account_subtit"><?=$account_ment?></h4>
        <div class="account_box">
            <div class="form-group form-group_1">                       
                <label for="exampleFormControlSelect1" class="on"><?=$bank?></label>
                <select class="form-control" id="bank_code" aria-placeholder="선택해주세요.">
                    <?=$arr_bank_useb_option?>
                </select>
            </div>  
            <div class="form-group form-group_1">
                <label for="account_num"><?=$account_num?></label>
                <input type="text" class="form-control" id="account_num" numberOnly="">
                <p class="p1"><?=$account_ment2?></p>
            </div>
            <div class="form-group form-group_1">
                <label for="account_num"><?=$holder?></label>
                <input type="text" class="form-control" id="account_holder_name">
            </div>
            <button type="button" class="btn btn-primary login_btn n_active" id="next_btn" onclick="certified()"><?=$next?></button>
        </div>
    </div>
</div>

<!-- 계좌인증팝업 -->
<div class="modal fade" id="modal_md" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-md">
        <div class="modal-content">
        <div class="modal-header justify-content-center">
            <h5 class="modal-title text-center" id="exampleModalLabel"><?=$send?></h5>
            <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
                <img src="img/ic_x.png" alt="닫기">
            </button>
        </div>
        <div class="modal-body text-center">
            <div class="account_img"><img src="img/account_img.png" alt=""></div>
            <p><?=$modal_ment1?></p>
            <p><?=$modal_ment2?></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="location.href='artist_my_account2.php'"><?=$confirm?></button>
        </div>
        </div>
    </div>
</div>

<script>
    $("#account_num").on("focusout", function() {
        if($("#account_num").val() != "") {
            $("#next_btn").removeClass("n_active");
        } else {
            $("#next_btn").addClass("n_active");
        }
    });
    function certified() {
        $.ajax({
            type: 'post',
            url: '/models/mypage/member.php',
            dataType: 'json',
            data: {type: "1won", bank_code: $("#bank_code").val(), account_num: $("#account_num").val(), account_holder_name: $("#account_holder_name").val()},
            success: function (d, s) {
                if(d['result'] == "ok") {
                    $("#modal_md").modal("show");
                } else {
                    alert("계좌정보를 다시 확인해주세요.");
                    return false;
                }
            },
            cache: false
        });
    }
</script>
                
<? include_once("./inc/tail.php"); ?>