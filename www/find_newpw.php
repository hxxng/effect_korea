<?php
$title = "비밀번호 변경";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$new_pwd = lang("new_pwd",$_lang, "find");
$new_pwd_re = lang("new_pwd_re",$_lang, "find");
$pwd_update = lang("pwd_update",$_lang, "find");
$cancel = lang("cancel",$_lang, "find");
$update_btn = lang("update_btn",$_lang, "mypage");
?>

<div class="wrap">
    <div class="find_pg">
        <div class="sign_pg_right">
            <h2><?=$pwd_update?></h2>
            <div class="login_box">
                <div class="form-group form-group_1">
                    <label for="mt_pwd"><?=$new_pwd?></label>
                    <input type="password" class="form-control" id="mt_pwd">
                </div>
                <div class="form-group form-group_1">
                    <label for="mt_pwd_re"><?=$new_pwd_re?></label>
                    <input type="password" class="form-control" id="mt_pwd_re">
                </div>
                <div class="find_name d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary login_btn form_l" onclick="location.href='/signin.php'"><?=$cancel?></button>
                    <button type="button" class="btn btn-primary login_btn form_r" onclick="chg_pwd()"><?=$update_btn?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("./inc/alert_modal.php"); ?>
<script>
    function chg_pwd() {
        if($("#mt_pwd").val() == "") {
            $("#txt").text("새 비밀번호를 입력해주세요.");
            $('#id_alert').modal('show');
            return false;
        }
        if($("#mt_pwd_re").val() == "") {
            $("#txt").text("새 비밀번호 확인을 입력해주세요.");
            $('#id_alert').modal('show');
            return false;
        }
        if(chk_pwd("mt_pwd") == false) {
            return false;
        }
        if($("#mt_pwd").val() != $("#mt_pwd_re").val()){
            $("#txt").text("비밀번호가 일치하지 않습니다.\n비밀번호를 다시 입력해 주세요.");
            $('#id_alert').modal('show');
            return false;
        }
        $.ajax({
            type: 'post',
            url: './models/login/login.php',
            dataType: 'json',
            data: {type: "chg_pw", mt_pwd: $("#mt_pwd").val()},
            success: function (r) {
                if(r['result'] == "ok") {
                    location.replace("/find_pw_sucess.php");
                } else {
                    alert("비밀번호 변경에 실패하였습니다.");
                    location.reload();
                }
            },
        });
    }
    function chk_pwd(id) {
        var pwd = $("#"+id).val();
        var num = pwd.search(/[0-9]/g);
        var eng = pwd.search(/[a-z]/ig);
        var spe = pwd.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);
        if(pwd.search(/\s/) != -1){
            alert("비밀번호는 공백 없이 입력해주세요.");
            $("#"+id).focus();
            return false;
        } else if(eng < 0 && (num < 0 || spe < 0) || num < 0 && (eng < 0 || spe < 0) || spe < 0 && (eng < 0 || spe < 0)){
            alert("영문, 숫자, 특수문자 중 2종류 이상 포함하여 입력해주세요.");
            $("#"+id).focus();
            return false;
        } else {
            return true;
        }
    }
</script>

<? include_once("./inc/tail.php"); ?>