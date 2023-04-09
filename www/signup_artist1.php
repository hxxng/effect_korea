<?php
$title = "아티스트 회원가입";

include_once("./inc/head.php");
include_once("./inc/nav.php");
$_lang = $_SESSION['_lang'];
$signup = lang("signup",$_lang, "signup");
$artist = lang("artist",$_lang, "signup");
$firstname = lang("firstname",$_lang, "signup");
$lastname = lang("lastname",$_lang, "signup");
$id = lang("id",$_lang, "signup");
$pwd = lang("pwd",$_lang, "signup");
$mail = lang("mail",$_lang, "signup");
$mail2 = lang("mail2",$_lang, "signup");
$pwd_re = lang("pwd_re",$_lang, "signup");
$hp = lang("hp",$_lang, "signup");
$whole = lang("whole",$_lang, "signup");
$use_term = lang("use_term",$_lang, "signup");
$privacy_term = lang("privacy_term",$_lang, "signup");
$license_term = lang("license_term",$_lang, "signup");
$show = lang("show",$_lang, "signup");
$email1 = lang("email1",$_lang, "signup");
$email2 = lang("email2",$_lang, "signup");
?>
<div class="wrap">
    <div class="signup_pg">
        <h2><?=$artist?></h2>
        <div class="login_box">
            <form method="post" name="frm_login" id="frm_login" action="/models/login/sign_up.php" onsubmit="return frm_signup_submit(this);">
            <input type="hidden" name="type" value="sign_up_artist1"/>
            <input type="hidden" name="chk_id" id="chk_id" value="false"/>
            <div class="find_name d-flex justify-content-between">
                <div class="form-group form-group_1 form_l">
                    <label for="mt_firstname"><?=$firstname?></label>
                    <input type="text" class="form-control" name="mt_firstname">
                </div>
                <div class="form-group form-group_1 form_r">
                    <label for="mt_lastname"><?=$lastname?></label>
                    <input type="text" class="form-control" name="mt_lastname" id="mt_lastname">
                </div>
            </div>
            <div class="form-group form-group_1">
                <label for="mt_id"><?=$id?></label>
                <input type="text" class="form-control" name="mt_id" id="mt_id">
                <small class="form-text text-danger d-none"><img class="mr-2" src="img/ic_label_danger.png"><?=$email1?></small>
                 <small class="form-text text-success"><img class="mr-2" src="img/ic_label_success.png"><?=$email2?></small>
                <button type="button" class="btn btn-outline-primary btn-sm btn_in"><?=$mail?></button>
                <!-- <div class="btn btn-outline-secondary btn-sm btn_in pe_none"><?=$mail2?></div> -->
            </div>
            <div class="form-group form-group_1">
                <label for="mt_pwd"><?=$pwd?></label>
                <input type="password" class="form-control" name="mt_pwd" id="mt_pwd">
            </div>
            <div class="form-group form-group_1">
                <label for="mt_pwd_re"><?=$pwd_re?></label>
                <input type="password" class="form-control" name="mt_pwd_re" id="mt_pwd_re">
            </div>
            <div class="form-group form-group_1">
                <label for="mt_hp"><?=$hp?></label>
                <input type="text" class="form-control" name="mt_hp" id="mt_hp" numberOnly>
            </div>
            <div class="terms">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="chk_all" onclick="f_checkbox_all2('defaultCheck')">
                    <label class="form-check-label" for="chk_all">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        <?=$whole?>
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
                                <?=$use_term?>
                            </label>
                        </div>
                        <a data-target="#use_terms" data-toggle="modal"><?=$show?></a>
                    </div>
                    <div class="d-flex justify-content-between terms_wr">
                        <div class="form-check justify-content-between">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck3">
                            <label class="form-check-label" for="defaultCheck3">
                                <div class="chkbox">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <?=$privacy_term?>
                            </label>
                        </div>
                        <a data-target="#private_terms" data-toggle="modal"><?=$show?></a>
                    </div>
                    <div class="d-flex justify-content-between terms_wr">
                        <div class="form-check justify-content-between">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck4">
                            <label class="form-check-label" for="defaultCheck4">
                                <div class="chkbox">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <?=$license_term?>
                            </label>
                        </div>
                        <a data-target="#license" data-toggle="modal"><?=$show?></a>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary login_btn"><?=$signup?></button>
            </form>
        </div>
    </div>
</div>
<?php include_once("./inc/alert_modal.php"); ?>
<script>
    function f_checkbox_all(obj) {
        $('input:checkbox[id^="'+obj+'"]').each(function() {
            if($("#chk_all").prop("checked") == true) {
                $(this).prop('checked', true);
            } else {
                $(this).prop('checked', false);
            }
        });

        return false;
    }
    function frm_signup_submit(f){
        // if(f.mt_firstname.value=='' || f.mt_lastname.value==''){
        //     $("#txt").text("이름을 입력해주세요.");
        //     $('#id_alert').modal('show');
        //     return false;
        // }
        // if(f.mt_id.value==''){
        //     $("#txt").text("아이디를 입력해주세요.");
        //     $('#id_alert').modal('show');
        //     return false;
        // }
        // if(chk_email("mt_id") == false) {
        //     $("#wrong_email").removeClass("d-none");
        //     return false;
        // }
        // if(f.mt_pwd.value==''){
        //     $("#txt").text("비밀번호를 입력해주세요.");
        //     $('#id_alert').modal('show');
        //     return false;
        // }
        // if(f.mt_pwd_re.value==''){
        //     $("#txt").text("비밀번호 확인을 입력해주세요.");
        //     $('#id_alert').modal('show');
        //     return false;
        // }
        // if(f.mt_pwd.value != f.mt_pwd_re.value){
        //     $("#txt").text("비밀번호가 일치하지 않습니다.\n비밀번호를 다시 입력해 주세요.");
        //     $('#id_alert').modal('show');
        //     return false;
        // }
        // if(chk_pwd("mt_pwd") == false) {
        //     return false;
        // }
        // if(f.chk_id.value == false) {
        //     return false;
        // }
        if($("#defaultCheck2").is(":checked") == false) {
            $("#txt").text("이용약관에 동의가 필요합니다.");
            $('#id_alert').modal('show');
            return false;
        }
        if($("#defaultCheck3").is(":checked") == false) {
            $("#txt").text("개인정보취급방침에 동의가 필요합니다.");
            $('#id_alert').modal('show');
            return false;
        }
        if($("#defaultCheck4").is(":checked") == false) {
            $("#txt").text("라이선스 약관에 동의가 필요합니다.");
            $('#id_alert').modal('show');
            return false;
        }
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
    function chk_email(id) {
        var sEmail = $("#"+id).val();
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (filter.test(sEmail)) {
            return true;
        }
        else {
            return false;
        }
    }
    function mail() {
        if($("#mt_id").val() == "") {
            $('#id_alert').modal('show');
            return false;
        } else if(chk_email("mt_id") == false) {
            $("#wrong_email").removeClass("d-none");
            return false;
        } else {
            $("#wrong_email").addClass("d-none");
            $.ajax({
                type: 'post',
                url: './models/login/sign_up.php',
                dataType: 'json',
                data: {type: "chk_email", mt_id: $("#mt_id").val()},
                success: function (result) {
                    if(result['result'] == "false") {
                        $("#txt").text("이미 사용중인 이메일 입니다.");
                        $('#id_alert').modal('show');
                        $("#chk_id").val("false");
                    } else {
                        $("#chk_id").val("true");
                        //메일 발송
                        $.ajax({
                            type: 'post',
                            url: './models/login/sign_up.php',
                            dataType: 'json',
                            data: {type: "send_mail", mt_id: $("#mt_id").val()},
                            success: function (result) {
                                if(result['result'] == "false") {

                                } else {

                                }
                            },
                        });
                    }
                },
            });
        }
    }
</script>

<? include_once("./inc/tail.php"); ?>