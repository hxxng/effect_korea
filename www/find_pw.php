<?php
$title = "비밀번호 찾기";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$mail = lang("mail",$_lang, "signup");
$mail2 = lang("mail2",$_lang, "signup");
$id = lang("id",$_lang, "signup");
$find_pwd = lang("find_pwd",$_lang, "find");
$info = lang("info",$_lang, "find");
$pwd_update = lang("pwd_update",$_lang, "find");
$cancel = lang("cancel",$_lang, "find");
$chk3 = lang("chk3",$_lang, "signup");
?>

<div class="wrap">
    <div class="find_pg">
        <div class="sign_pg_right">
            <h2><?=$find_pwd?></h2>
            <div class="login_box">
                <div class="form-group form-group_1">
                    <input type="hidden" name="chk_id" id="chk_id" value="false"/>
                    <label for="mt_id"><?=$id?></label>
                    <input type="text" class="form-control" id="mt_id">
                    <small class="form-text text-danger"><img class="mr-2" src="img/ic_label_danger.png"><?=$info?></small>
                    <button type="button" class="btn btn-outline-primary btn-sm btn_in" id="mail_btn" onclick="mail();"><?=$mail?></button>
                     <div class="btn btn-outline-secondary btn-sm btn_in pe_none d-none" id="success_btn"><?=$chk3?></div>
                </div>
                <div class="find_name d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary login_btn form_l" onclick="location.href='/signin.php'"><?=$cancel?></button>
                    <button type="button" class="btn btn-primary login_btn form_r n_active" id="pw_btn" onclick="mail_certification();"><?=$pwd_update?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("./inc/alert_modal.php"); ?>
<script>
    function mail_certification() {
        $.ajax({
            type: 'post',
            url: './models/login/login.php',
            dataType: 'json',
            data: {type: "mail_certification", mt_id: $("#mt_id").val()},
            success: function (result) {
                if(result['result'] == "ok") {
                    location.replace('/find_newpw.php');
                } else {
                    alert("메일인증을 다시 진행해주세요.");
                    $("#mail_btn").removeClass("d-none");
                    $("#success_btn").addClass("d-none");
                    return false;
                }
            },
        });
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
            $("#txt").text("아이디를 입력해주세요.");
            $('#id_alert').modal('show');
            return false;
        } else if(chk_email("mt_id") == false) {
            $("#txt").text("이메일 형식을 확인해주세요.");
            $('#id_alert').modal('show');
            return false;
        } else {
            $.ajax({
                type: 'post',
                url: './models/login/login.php',
                dataType: 'json',
                data: {type: "find_pw", mt_id: $("#mt_id").val()},
                success: function (r) {
                    if(r['result'] == "ok") {
                        $("#chk_id").val("true");
                        $.ajax({
                            type: 'post',
                            url: './models/login/login.php',
                            dataType: 'json',
                            data: {type: "send_mail", mt_id: $("#mt_id").val()},
                            success: function (r) {
                                if(r['result'] == "ok") {
                                    $("#pw_btn").removeClass("n_active");
                                    $("#mail_btn").addClass("d-none");
                                    $("#success_btn").removeClass("d-none");
                                } else {

                                }
                            },
                        });
                    } else {
                        $("#txt").text("해당 아이디를 가진 회원이 존재하지 않습니다.");
                        $('#id_alert').modal('show');
                        $("#chk_id").val("false");
                    }
                },
            });
        }
    }
</script>

<? include_once("./inc/tail.php"); ?>