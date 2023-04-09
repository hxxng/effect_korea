<?php
$title = "메인";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$codes_arr = get_nationality();
$phone_arr = get_international_num();

$_lang = $_SESSION['_lang'];
$info1 = lang("info1", $_lang, "tailored");
$info2 = lang("info2", $_lang, "tailored");
$info3 = lang("info3", $_lang, "tailored");
$company = lang("company", $_lang, "tailored");
$title2 = lang("title", $_lang, "tailored");
$memo = lang("memo", $_lang, "tailored");
$submit = lang("submit", $_lang, "tailored");
$firstname = lang("firstname", $_lang, "signup");
$lastname = lang("lastname", $_lang, "signup");
$hp = lang("hp", $_lang, "signup");
$nationality = lang("nationality", $_lang, "order");
$num = lang("num", $_lang, "pay");
$select = lang("select", $_lang, "contents_upload");
?>

<div class="wrap">
    <div class="tailor_pg position-relative">
        <div class="tailor_pg_top text-center position-absolute">
            <p class="tailored_tit fw_700 ff_play">TAILORED :</p>
            <p class="tailored_sub"><?=$info1?></p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tailor_pg_mid text-center">
                    <h2><?=$info2?></h2>
                    <p><?=$info3?></p>
                    <div class="tailor_ic_box">
                        <div class="row row-cols-2 row-cols-md-4">
                            <div class="col text-center">
                                <div class="tailor_ic"><img src="img/ic_tailor_1.png" alt=""></div>
                                <p class="ff_play fw_400">Professional Advertising</p>
                            </div>
                            <div class="col text-center">
                                <div class="tailor_ic"><img src="img/ic_tailor_2.png" alt=""></div>
                                <p class="ff_play fw_400">Customized Content</p>
                            </div>
                            <div class="col text-center">
                                <div class="tailor_ic"><img src="img/ic_tailor_3.png" alt=""></div>
                                <p class="ff_play fw_400">Global Director
                                    of Photography</p>
                            </div>
                            <div class="col text-center">
                                <div class="tailor_ic"><img src="img/ic_tailor_4.png" alt=""></div>
                                <p class="ff_play fw_400">Internal Copyright</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tailor_contact">
        <div class="tailor_contact_wrap">
            <h2 class="ff_play text-center">CONTACT</h2>
            <div class="tailor_contact_box">
                <form method="post" name="frm_login" id="frm_login" action="/models/inquiry_model.php" onsubmit="return frm_signup_submit(this);">
                <input type="hidden" name="type" value="send_mail2"/>
                <div class="find_name d-flex justify-content-between">
                    <div class="form-group form-group_1 form_l">
                        <label for="firstname"><?=$firstname?></label>
                        <input type="text" class="form-control" id="firstname" name="firstname">
                    </div>
                    <div class="form-group form-group_1 form_r">
                        <label for="lastname"><?=$lastname?></label>
                        <input type="text" class="form-control" id="lastname" name="lastname">
                    </div>
                </div>
                <div class="find_name d-flex justify-content-between">
                    <div class="form-group form-group_1 form_l">
                        <label for="company"><?=$company?></label>
                        <input type="text" class="form-control" id="company" name="company">
                    </div>
                    <div class="form-group form-group_1 form_r">
                        <label for="title"><?=$title2?></label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                </div>
                <div class="form-group form-group_1">
                    <label for="exampleFormControlSelect1" class="on"><?=$nationality?></label>
                    <select class="form-control" id="exampleFormControlSelect1" name="nationality" aria-placeholder="선택">
                        <option value="" disabled selected><?=$select?></option>
                        <?
                        if($codes_arr) {
                            asort($codes_arr);
                            foreach ($codes_arr as $key => $val) {
                                echo '<option value="'.$val.'">'.$val.'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form_tel d-flex">
                    <div class="form-group form-group_1 form_l">
                        <label for="exampleFormControlSelect1" class="on"><?=$num?></label>
                        <select class="form-control" id="exampleFormControlSelect1" name="num" aria-placeholder="선택">
                            <option value="" disabled selected><?=$select?></option>
                            <?
                            if($phone_arr) {
                                asort($phone_arr);
                                foreach ($phone_arr as $key => $val) {
                                    if($val!=""&&$val!=" ") {
                                        echo '<option value="'.$val.'">'.$val.'</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div> 
                    <div class="form-group form-group_1 form_r">
                        <label for="hp"><?=$hp?></label>
                        <input type="text" class="form-control" id="hp" name="hp" numberOnly>
                    </div>
                </div>
                <div class="form-group form-group_1">
                    <label for="memo"><?=$memo?></label>
                    <textarea class="form-control" id="memo" name="memo"></textarea>
                </div>
                <button type="submit" class="btn btn-primary login_btn"><?=$submit?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function frm_signup_submit(f){
        if(f.firstname.value==''){
            alert("이름을 입력해주세요.");
            f.firstname.focus();
            return false;
        }
        if(f.lastname.value==''){
            alert("성을 입력해주세요.");
            f.lastname.focus();
            return false;
        }
        if(f.company.value==''){
            alert("회사명을 입력해주세요.");
            f.company.focus();
            return false;
        }
        if(f.title.value==''){
            alert("직함을 입력해주세요.");
            f.title.focus();
            return false;
        }
        if(f.nationality.value==''){
            alert("국적을 선택해주세요.");
            f.nationality.focus();
            return false;
        }
        if(f.hp.value==''){
            alert("연락처를 입력해주세요.");
            f.hp.focus();
            return false;
        }
        if(f.num.value==''){
            alert("국제번호을 선택해주세요.");
            f.num.focus();
            return false;
        }
    }
</script>
                
<? include_once("./inc/tail.php"); ?>