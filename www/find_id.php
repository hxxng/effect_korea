<?php
$title = "아이디 찾기";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$firstname = lang("firstname",$_lang, "signup");
$lastname = lang("lastname",$_lang, "signup");
$hp = lang("hp",$_lang, "signup");
$confirm = lang("confirm",$_lang, "order");
$find_id = lang("find_id",$_lang, "find");
?>

<div class="wrap">
    <div class="find_pg">
        <div class="sign_pg_right">
            <h2><?=$find_id?></h2>
            <div class="login_box">
                <form method="post" name="frm_login" id="frm_login" action="/models/login/login.php" onsubmit="return frm_find_submit(this);">
                <input type="hidden" name="type" value="find_id"/>
                <div class="find_name d-flex justify-content-between">
                    <div class="form-group form-group_1 form_l">
                        <label for="mt_firstname"><?=$firstname?></label>
                        <input type="text" class="form-control" name="mt_firstname">
                    </div>
                    <div class="form-group form-group_1 form_r">
                        <label for="mt_lastname"><?=$lastname?></label>
                        <input type="text" class="form-control" name="mt_lastname">
                    </div>
                </div>
                <div class="form-group form-group_1">
                    <label for="mt_hp"><?=$hp?></label>
                    <input type="text" class="form-control" name="mt_hp" numberOnly>
                </div>
                <button type="submit" class="btn btn-primary login_btn"><?=$confirm?></button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once("./inc/alert_modal.php"); ?>
<script>
    function frm_find_submit(f){
        if(f.mt_firstname.value=='' || f.mt_lastname.value==''){
            $("#txt").text("이름을 입력해주세요.");
            $('#id_alert').modal('show');
            return false;
        }
        if(f.mt_hp.value==''){
            $("#txt").text("연락처를 입력해주세요.");
            $('#id_alert').modal('show');
            return false;
        }
    }
</script>

<? include_once("./inc/tail.php"); ?>