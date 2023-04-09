<?php
$title = "회원가입";

include_once("./inc/head.php");
include_once("./inc/nav.php");
include('./models/login/gconfig.php');

$_lang = $_SESSION['_lang'];
$signup = lang("signup",$_lang, "signup");
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
$chk3 = lang("chk3",$_lang, "signup");
$sns_login = lang("sns_login2", $_lang, "signin");

$google_login_btn = '<a href="'.$google_client->createAuthUrl().'"><img src="img/ic_sns01.png" /></a>';
?>
<div class="wrap">
    <div class="signup_pg">
        <h2><?=$signup?></h2>
        <div class="login_box">
            <form method="post" name="frm_login" id="frm_login" action="/models/login/sign_up.php" onsubmit="return frm_signup_submit(this);">
            <input type="hidden" name="type" value="sign_up"/>
            <input type="hidden" name="chk_id" id="chk_id" value="false"/>
            <div class="find_name d-flex justify-content-between">
                <div class="form-group form-group_1 form_l">
                    <label for="mt_firstname"><?=$firstname?></label>
                    <input type="text" class="form-control" name="mt_firstname" id="mt_firstname" value="<?=$_SESSION['_mt_firstname']?>">
                </div>
                <div class="form-group form-group_1 form_r">
                    <label for="mt_lastname"><?=$lastname?></label>
                    <input type="text" class="form-control" name="mt_lastname" id="mt_lastname" value="<?=$_SESSION['_mt_lastname']?>">
                </div>
            </div>
            <div class="form-group form-group_1">
                <label for="mt_id"><?=$id?></label>
                <input type="text" class="form-control" name="mt_id" id="mt_id" value="<?=$_SESSION['_mt_id']?>" maxlength="50">
                <small class="form-text text-danger d-none" id="wrong_email"><img class="mr-2" src="img/ic_label_danger.png"><?=$email1?></small>
                <small class="form-text text-success d-none"><img class="mr-2" src="img/ic_label_success.png"><?=$email2?></small>
                <button type="button" class="btn btn-outline-primary btn-sm btn_in" id="mail_btn" onclick="mail()"><?=$mail?></button>
                <div class="btn btn-outline-secondary btn-sm btn_in pe_none d-none" id="success_btn"><?=$chk3?></div>
            </div>
            <div class="form-group form-group_1">
                <label for="mt_pwd"><?=$pwd?></label>
                <input type="password" class="form-control" name="mt_pwd" id="mt_pwd">
            </div>
            <div class="form-group form-group_1">
                <label for="mt_pwd_re"><?=$pwd_re?></label>
                <input type="password" class="form-control" name="mt_pwd_re">
            </div>
            <div class="form-group form-group_1">
                <label for="mt_hp"><?=$hp?></label>
                <input type="text" class="form-control" name="mt_hp" id="mt_hp" numberOnly value="<?=$_SESSION['_mt_hp']?>" maxlength="20">
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
        <div class="sns_box">
            <p class="sns_txt"><?=$sns_login?></p>
            <ul class="sns_grid">
                <li>
                    <?=$google_login_btn?>
                </li>
                <li>
                    <a href="javascript:kakaoLogin()"><img src="img/ic_sns02.png" alt=""></a>
                </li>
                <li>
                    <a id="naverIdLogin_loginButton" style="cursor: pointer;"><img src="img/ic_sns03.png" alt=""></a>
                </li>
                <li>
                    <a href="javascript:facebookLogin()"><img src="img/ic_sns04.png" alt=""></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php include_once("./inc/alert_modal.php"); ?>
<script src="https://accounts.google.com/gsi/client" async defer></script>
<script src="https://developers.kakao.com/sdk/js/kakao.js"></script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
<script src="https://static.nid.naver.com/js/naveridlogin_js_sdk_2.0.2.js" charset="utf-8"></script>
<script>
    function frm_signup_submit(f){
        if(f.mt_firstname.value=='' || f.mt_lastname.value==''){
            $("#txt").text("이름을 입력해주세요.");
            $('#id_alert').modal('show');
            return false;
        }
        if(f.mt_id.value==''){
            $("#txt").text("아이디를 입력해주세요.");
            $('#id_alert').modal('show');
            return false;
        }
        if(chk_email("mt_id") == false) {
            $("#wrong_email").removeClass("d-none");
            return false;
        } else {
            $("#wrong_email").addClass("d-none");
        }
        if(f.mt_pwd.value==''){
            $("#txt").text("비밀번호를 입력해주세요.");
            $('#id_alert').modal('show');
            return false;
        }
        if(f.mt_pwd_re.value==''){
            $("#txt").text("비밀번호 확인을 입력해주세요.");
            $('#id_alert').modal('show');
            return false;
        }
        if(f.mt_pwd.value != f.mt_pwd_re.value){
            $("#txt").text("비밀번호가 일치하지 않습니다.\n비밀번호를 다시 입력해 주세요.");
            $('#id_alert').modal('show');
            return false;
        }
        if(chk_pwd("mt_pwd") == false) {
            return false;
        }
        if(f.chk_id.value == false) {
            alert("메일인증을 진행해주세요.");
            return false;
        }
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
        if(mail_certification == false) {
            alert("메일인증을 다시 진행해주세요.");
            $("#mail_btn").removeClass("d-none");
            $("#success_btn").addClass("d-none");
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
        } else if(eng < 0 && (num < 0 || spe < 0) || num < 0 && (eng < 0 || spe < 0) || spe < 0 && (eng < 0 || num < 0)){
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
                        location.replace("/signup_artist_overlap.php");
                    } else if(result['result'] == "false2") {
                        alert("이미 가입된 아이디입니다.");
                        return false;
                    } else {
                        $("#chk_id").val("true");
                        //메일 발송
                        $.ajax({
                            type: 'post',
                            url: './models/login/sign_up.php',
                            dataType: 'json',
                            data: {type: "send_mail", mt_id: $("#mt_id").val(), mt_firstname: $("#mt_firstname").val(), mt_lastname: $("#mt_lastname").val(), mt_hp: $("#mt_hp").val()},
                            success: function (result) {
                                if(result['result'] == "ok") {
                                    $("#mail_btn").addClass("d-none");
                                    $("#success_btn").removeClass("d-none");
                                }
                            },
                        });
                    }
                },
            });
        }
    }
    function mail_certification() {
        var test;
        $.ajax({
            type: 'post',
            url: './models/login/sign_up.php',
            dataType: 'json',
            async: false,
            data: {type: "mail_certification", mt_id: $("#mt_id").val()},
            success: function (result) {
                if(result['result'] == "ok") {
                    test = true;
                } else {
                    test = false;
                }
            },
        });
        return test;
    }

    window.onload = function () {
        google.accounts.id.initialize({
            client_id: "client_id",
            callback: handleCredentialResponse
        });
        google.accounts.id.renderButton(
            document.getElementById("buttonDiv"),
            // { type: "icon", theme: "outline", size: "large", shape: "circle", width: 400 }  // customization attributes
        );
        // google.accounts.id.prompt(); // also display the One Tap dialog
        $(".S9gUrf-YoZ4jf").css("opacity", "0");
    }
    <!-- --------------------------------구글 로그인------------------------------------- -->
    function handleCredentialResponse(response) {
        const responsePayload = parseJwt(response.credential);
        var mt_id = responsePayload.email;
        var mt_pwd = responsePayload.sub;

        $.ajax({
            type: 'post',
            url: './models/login/login.php',
            dataType: 'json',
            data: {type: 'login', act: "sns", mt_id: mt_id, mt_pwd: mt_pwd},
            success: function (result) {
                if(result['result'] == "ok") {
                    location.replace("/");
                } else if(result['result'] == "false2") {
                    alert("이미 가입된 계정이 있습니다.");
                    return false;
                } else if(result['result'] == "false") {
                    if(confirm("존재하지 않는 회원입니다.\n회원가입 하시겠습니까?")) {
                        $.ajax({
                            type: 'post',
                            url: './models/login/sign_up.php',
                            dataType: 'json',
                            data: {
                                type: "sns_sign_up",
                                mt_login_type : 5,
                                mt_id: mt_id,
                                mt_pwd: mt_pwd
                            },
                            success: function (r) {
                                if(r['result'] == "ok") {
                                    location.replace("/signup_success.php");
                                } else {
                                    $("#txt").text("이미 사용중인 아이디입니다.");
                                    $('#id_alert').modal('show');
                                }
                            }
                        });
                    } else {
                        location.replace("/signin.php");
                    }
                }
            },
            error: function () {
            }
        });
    }
    function parseJwt (token) {
        var base64Url = token.split('.')[1];
        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));

        return JSON.parse(jsonPayload);
    }

    function google_signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
            //signout
        });
        auth2.disconnect();
    }

    <!-- --------------------------------카카오 로그인------------------------------------- -->

    Kakao.init('Kakao');
    function kakaoLogin() {
        Kakao.Auth.login({
            success: function (response) {
                Kakao.API.request({
                    url: '/v2/user/me',
                    success: function (response) {
                        $.ajax({
                            type: 'post',
                            url: './models/login/login.php',
                            dataType: 'json',
                            data: {type: 'login', act: "sns", mt_id: response['kakao_account']['email'], mt_pwd: response['id']},
                            success: function (result) {
                                if(result['result'] == "ok") {
                                    location.replace("/");
                                } else if(result['result'] == "false2") {
                                    alert("이미 가입된 계정이 있습니다.");
                                    return false;
                                } else if(result['result'] == "false") {
                                    if(confirm("존재하지 않는 회원입니다.\n회원가입 하시겠습니까?")) {
                                        $.ajax({
                                            type: 'post',
                                            url: './models/login/sign_up.php',
                                            dataType: 'json',
                                            data: {
                                                type: "sns_sign_up",
                                                mt_login_type : 3,
                                                mt_id: response['kakao_account']['email'],
                                                mt_pwd: response['id']
                                            },
                                            success: function (r) {
                                                if(r['result'] == "ok") {
                                                    location.replace("/signup_success.php");
                                                } else {
                                                    $("#txt").text("이미 사용중인 아이디입니다.");
                                                    $('#id_alert').modal('show');
                                                }
                                            }
                                        });
                                    } else {
                                        location.replace("/signin.php");
                                    }
                                }
                            },
                            error: function () {
                            }
                        });
                    },
                    fail: function (error) {
                    },
                })
            },
            fail: function (error) {
            },
        })
    }
    function kakaoLogout() {
        if (Kakao.Auth.getAccessToken()) {
            Kakao.API.request({
                url: '/v1/user/unlink',
                success: function (response) {
                },
                fail: function (error) {
                },
            })
            Kakao.Auth.setAccessToken(undefined)
        }
    }

    <!-- --------------------------------페이스북 로그인------------------------------------- -->

    window.fbAsyncInit = function() {
        FB.init({
            appId      : 'appId',
            cookie     : true,
            xfbml      : true,
            version    : 'v10.0'
        });
        FB.AppEvents.logPageView();
    };

    function facebookLogin(){
        FB.login(function(response) {
            if (response.status === 'connected') {
                FB.api('/me', 'get', {fields: 'email'}, function(r) {
                    $.ajax({
                        type: 'post',
                        url: './models/login/login.php',
                        dataType: 'json',
                        data: {type: 'login', act: "sns", mt_id: r['email'], mt_pwd: r['id']},
                        success: function (result) {
                            if(result['result'] == "ok") {
                                location.replace("/");
                            } else if(result['result'] == "false2") {
                                alert("이미 가입된 계정이 있습니다.");
                                return false;
                            } else if(result['result'] == "false") {
                                if(confirm("존재하지 않는 회원입니다.\n회원가입 하시겠습니까?")) {
                                    $.ajax({
                                        type: 'post',
                                        url: './models/login/sign_up.php',
                                        dataType: 'json',
                                        data: {
                                            type: "sns_sign_up",
                                            mt_login_type : 6,
                                            mt_id: r['email'],
                                            mt_pwd: r['id']
                                        },
                                        success: function (r) {
                                            if(r['result'] == "ok") {
                                                location.replace("/signup_success.php");
                                            } else {
                                                $("#txt").text("이미 사용중인 아이디입니다.");
                                                $('#id_alert').modal('show');
                                            }
                                        }
                                    });
                                } else {
                                    location.replace("/signin.php");
                                }
                            }
                        },
                        error: function () {
                        }
                    });
                })
            }
        }, {scope: 'public_profile,email'});
    }

    function facebookLogout() {
        FB.logout(function(response) {
            window.location.reload();
        });
    }

    //기존 로그인 상태를 가져오기 위해 Facebook에 대한 호출
    function statusChangeCallback(res){
        statusChangeCallback(response);
    }

    <!-- --------------------------------네이버 로그인------------------------------------- -->
    var naverLogin = new naver.LoginWithNaverId(
        {
            clientId: "clientId",
            callbackUrl: "<?=STATIC_HTTP?>/models/login/naver_login.php/",
            isPopup: false,
        }
    );
    naverLogin.init();

    <!-- --------------------------------sns 로그인 끝------------------------------------- -->
</script>

<?php include_once("./inc/tail.php"); ?>