<?php
$title = "국내계좌인증";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$next = lang("next", $_lang, "signup");
$back = lang("back", $_lang, "account");
$code_input = lang("code_input", $_lang, "account");
$code_ment = lang("code_ment", $_lang, "account");
?>

<div class="wrap">
    <div class="signup_pg">
        <div class="progress_bar">
            <div class="progress_bar_p progress_bar_p2"></div>
        </div>
        <div class="go_back" style="cursor: pointer;"><a onclick="history.back();"><img src="img/arrow_left.png" alt=""> <?=$back?></a></div>
        <h2 class="account_tit"><?=$code_input?></h2>
        <h4 class="account_subtit"><?=$code_ment?></h4>
        <div class="account_box">
            
            <div class="d-flex account_input_group">
                <input type="text" class="form-control account_input  mr-3" maxlength="1" numberOnly="" id="1">
                <input type="text" class="form-control account_input mr-3" maxlength="1" numberOnly="" id="2">
                <input type="text" class="form-control account_input mr-3" maxlength="1" numberOnly="" id="3">
                <input type="text" class="form-control account_input" maxlength="1" numberOnly="" id="4">
            </div>
            <button type="button" class="btn btn-primary login_btn n_active" id="next_btn" onclick="certified()"><?=$next?></button>
        </div>
    </div>
</div>

<script>
    $("#4").on("focusout", function() {
        if($("#4").val() != "") {
            $("#next_btn").removeClass("n_active");
        } else {
            $("#next_btn").addClass("n_active");
        }
    });
    function certified() {
        if(($("#1").val() == "") || ($("#2").val() == "") || ($("#3").val() == "") || ($("#4").val() == "")) {
            alert("코드를 입력해주세요.");
            return false;
        } else {
            var code = $("#1").val()+$("#2").val()+$("#3").val()+$("#4").val();
        }
        $.ajax({
            type: 'post',
            url: '/models/mypage/member.php',
            dataType: 'json',
            data: {type: "1won_2", code: code},
            success: function (d, s) {
                if(d['result'] == "ok") {
                    location.replace("/artist_my_account3.php");
                } else {
                    alert(d['msg']);
                    return false;
                }
            },
            cache: false
        });
    }
</script>
                
<? include_once("./inc/tail.php"); ?>