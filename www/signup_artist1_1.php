<?php
$title = "아티스트 회원가입";

include_once("./inc/head.php");
include_once("./inc/nav.php");
$_lang = $_SESSION['_lang'];
$signup = lang("signup",$_lang, "signup");
$artist = lang("artist",$_lang, "signup");
$id = lang("id",$_lang, "signup");
$hp = lang("hp",$_lang, "signup");
$whole = lang("whole",$_lang, "signup");
$use_term = lang("use_term",$_lang, "signup");
$privacy_term = lang("privacy_term",$_lang, "signup");
$license_term = lang("license_term",$_lang, "signup");
$show = lang("show",$_lang, "signup");
$next = lang("next",$_lang, "signup");
$name = lang("name",$_lang, "order");
?>
<div class="wrap">
    <div class="signup_pg">
        <h2><?=$artist?></h2>
        <div class="login_box">
            <form method="post" name="frm_login" id="frm_login" action="/models/login/sign_up.php" onsubmit="return frm_signup_submit(this);">
            <input type="hidden" name="type" value="sign_up_artist1_1"/>
            <input type="hidden" name="chk_id" id="chk_id" value="false"/>
            <ul class="list_style_1 list_pa">
                <li>
                    <span><?=$name?></span>
                    <p><?=$member_info['mt_lastname']." ".$member_info['mt_firstname']?></p>
                </li>
                <li>
                    <span><?=$id?></span>
                    <p><?=$member_info['mt_id']?></p>
                </li>
            </ul>
            <div class="form-group form-group_1">
                <label for="mt_hp"><?=$hp?></label>
                <input type="text" class="form-control" name="mt_hp" id="mt_hp" value="<?=$member_info['mt_hp']?>" numberOnly maxlength="20">
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
            <button type="submit" class="btn btn-primary login_btn"><?=$next?></button>
            </form>
        </div>
    </div>
</div>
<?php include_once("./inc/alert_modal.php"); ?>
<script>
    function frm_signup_submit(f){
        if(f.mt_hp.value==''){
            $("#txt").text("연락처를 입력해주세요.");
            $('#id_alert').modal('show');
            return false;
        }
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
</script>

<? include_once("./inc/tail.php"); ?>