<?php
$title = "내 정보 수정";

include_once("./inc/head.php");
include_once("./inc/nav.php");

if($member_info['idx'] < 1) {
    p_alert('로그인 후 이용가능한 서비스입니다.', '/');
    exit;
}

$_lang = $_SESSION['_lang'];
$back = lang("back", $_lang, "account");
$info_update = lang("info_update", $_lang, "mypage");
$id = lang("id", $_lang, "signin");
$firstname = lang("firstname", $_lang, "signup");
$pwd_re = lang("pwd_re", $_lang, "signup");
$hp = lang("hp", $_lang, "signup");
$pwd_update = lang("pwd_update", $_lang, "find");
$pwd = lang("pwd", $_lang, "signin");
$update_btn = lang("update_btn", $_lang, "mypage");
$hp_update = lang("hp_update", $_lang, "my_info");
$retire = lang("retire", $_lang, "my_info");
$cancel = lang("cancel", $_lang, "find");
$retire1 = lang("retire1", $_lang, "modal");
$retire2 = lang("retire2", $_lang, "modal");
$agree = lang("agree", $_lang, "modal");
?>
<div class="wrap">
    <div class="signup_pg">
        <div class="go_back"><a href="#" onclick="history.back();"><img src="img/arrow_left.png" alt=""> <?=$back?></a></div>
        <input type="hidden" id="mt_idx" value="<?=$member_info['idx']?>"/>
        <h2><?=$info_update?></h2>
        <div class="login_box">
            <ul class="list_style_1 list_pa">
                <li>
                    <span><?=$firstname?></span>
                    <p><?=$member_info['mt_firstname']." ".$member_info['mt_lastname']?></p>
                </li>
                <li>
                    <span><?=$id?></span>
                    <p><?=$member_info['mt_id']?></p>
                </li>
            </ul>
            <?
            if($member_info['mt_login_type'] == 1) {
            ?>
            <div class="info_cont">
                <h3 class="fw_700"><?=$pwd_update?></h3>
                <div class="form-group form-group_1">
                    <label for="mt_pwd"><?=$pwd?></label>
                    <input type="password" class="form-control" id="mt_pwd">
                </div>
                <div class="form-group form-group_1">
                    <label for="mt_pwd_re"><?=$pwd_re?></label>
                    <input type="password" class="form-control" id="mt_pwd_re">
                </div>
                <button type="button" class="btn btn-secondary" onclick="chg_pwd();"><?=$update_btn?></button>
            </div>
            <? } ?>
            <div class="info_cont">
                <h3 class="fw_700"><?=$hp_update?></h3>
                <div class="form-group form-group_1">
                    <label for="mt_hp"><?=$hp?></label>
                    <input type="text" class="form-control" id="mt_hp" numberOnly value="<?=$member_info['mt_hp']?>">
                </div>
                <button type="button" class="btn btn-secondary" onclick="chg_hp();"><?=$update_btn?></button>
            </div>
            <div class="info_cont text-center">
                <span class="member_br" data-toggle="modal" data-target="#modal_sm"><?=$retire?></span>
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
            <h3 class="fw_600"><?=$retire1?></h3>
            <p class="fs_18"><?=$retire2?></p>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    <div class="chkbox">
                        <i class="bi bi-check-lg"></i>
                    </div>
                    <?=$agree?>
                </label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal"><?=$cancel?></button>
            <button type="button" class="btn btn-primary" onclick="retire()"><?=$retire?></button>
        </div>
        </div>
    </div>
</div>
<?php include_once("./inc/alert_modal.php"); ?>
<script>
    function chg_pwd() {
        if($("#mt_pwd").val() == "") {
            $("#txt").text("비밀번호를 입력해주세요.");
            $('#id_alert').modal('show');
            return false;
        }
        if($("#mt_pwd_re").val() == "") {
            $("#txt").text("비밀번호 확인을 입력해주세요.");
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
            url: './models/mypage/member.php',
            dataType: 'json',
            data: {type: "chg_pw", mt_pwd: $("#mt_pwd").val(), mt_idx : $("#mt_idx").val()},
            success: function (r) {
                if(r['result'] == "_ok") {
                    alert("비밀번호가 변경되었습니다.");
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
            $("#txt").text("비밀번호는 공백 없이 입력해주세요.");
            $('#id_alert').modal('show');
            return false;
        } else if((num < 0 && eng < 0) || (eng < 0 && spe < 0) || (spe < 0 && num < 0)){
            $("#txt").text("영문, 숫자, 특수문자 중 2종류 이상 포함하여 입력해주세요.");
            $('#id_alert').modal('show');
            return false;
        } else {
            return true;
        }
    }

    function chg_hp() {
        if($("#mt_hp").val() == "") {
            $("#txt").text("연락처를 입력해주세요.");
            $('#id_alert').modal('show');
            return false;
        }
        $.ajax({
            type: 'post',
            url: './models/mypage/member.php',
            dataType: 'json',
            data: {type: "chg_hp", mt_hp: $("#mt_hp").val(), mt_idx : $("#mt_idx").val()},
            success: function (r) {
                if(r['result'] == "_ok") {
                    alert("연락처가 변경되었습니다.");
                    location.reload();
                }
            },
        });
    }

    function retire() {
        if(!$("#defaultCheck1").is(":checked")) {
            alert("회원 탈퇴에 동의해주세요.");
            return false;
        }
        $.ajax({
            type: 'post',
            url: './models/mypage/member.php',
            dataType: 'json',
            data: {type: "retire", mt_idx : $("#mt_idx").val()},
            success: function (r) {
                if(r['result'] == "_ok") {
                    alert("탈퇴처리가 완료되었습니다.");
                    location.replace("/signin.php");
                }
            },
        });
    }
</script>

<? include_once("./inc/tail.php"); ?>