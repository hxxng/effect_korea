<?php
$title = "로그인";

include_once("./inc/head.php");
include_once("./inc/nav.php");
include('./models/login/gconfig.php');

$_lang = $_SESSION['_lang'];

$ment = lang("ment", $_lang, "signin");
$login = lang("login", $_lang, "signin");
$id = lang("id", $_lang, "signin");
$pwd = lang("pwd", $_lang, "signin");
$signup = lang("signup", $_lang, "signin");
$find_id = lang("find_id", $_lang, "signin");
$find_pwd = lang("find_pwd", $_lang, "signin");
$sns_login = lang("sns_login", $_lang, "signin");

$google_login_btn = '<a href="'.$google_client->createAuthUrl().'"><img src="img/ic_sns01.png" /></a>';

?>
<style>
    .header_wrap, 
    .mobile_mainheader_wrap{
        display: none !important;
    }
    .footer_wrap{
        margin-top: 0 !important;
    }
</style>

<div class="container-fluid sign_pg">
    <div class="sign_pg_flex">
        <div class="sign_f_m sign_f_left">
            <div class="sign_pg_left">
                <a href="/index.php">
                    <img src="img/logo_w.png" alt="">
                    <div class="sign_tit ff_play fs_40">Effect Korea</div>
                </a>
                <p><?=$ment ?></p>
                <div class="ad_box">
                    <?
                    if($_lang == "" || $_lang == "kr") {
                        $bt_language = 1;
                    } else {
                        $bt_language = 2;
                    }
                    $query = "select * from banner_t where bt_main = 'N' and bt_show = 'Y' and bt_type = 1 and bt_language = ".$bt_language." order by bt_wdate desc limit 1";
                    $banner = $DB->fetch_assoc($query);
                    if($banner) {
                    ?>
                        <img src="<?=$ct_img_url."/".$banner['bt_file']?>?date=<?=$banner['bt_udate']?>" alt="">
                    <?
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="sign_f_m sign_f_right">
            <div class="sign_pg_right">
                <h2><?=$login?></h2>
                <div class="login_box">
                    <form method="post" name="frm_login" id="frm_login" action="/models/login/login.php" onsubmit="return frm_login_submit(this);">
                    <input type="hidden" name="type" value="login"/>
                    <div class="form-group form-group_1">
                        <label for="mt_id"><?=$id?></label>
                        <input type="text" class="form-control" id="mt_id" name="mt_id">
                    </div>
                    <div class="form-group form-group_1">
                        <label for="mt_pwd"><?=$pwd?></label>
                        <input type="password" class="form-control" name="mt_pwd" id="mt_pwd">
                    </div>
                    <button type="submit" class="btn btn-primary login_btn"><?=$login?></button>
                    <div class="d-flex justify-content-between login_box_b">
                        <a href="/signup.php"><?=$signup?></a>
                        <div class="find">
                            <a href="/find_id.php"><?=$find_id?></a>
                            <span>|</span>
                            <a href="/find_pw.php"><?=$find_pwd?></a>
                        </div>
                    </div>
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
    </div>
</div>

<?php include_once("./inc/alert_modal.php"); ?>

<script src="https://accounts.google.com/gsi/client" async defer></script>
<script src="https://developers.kakao.com/sdk/js/kakao.js"></script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
<script src="https://static.nid.naver.com/js/naveridlogin_js_sdk_2.0.2.js" charset="utf-8"></script>
<script>
    window.onload = function () {
        google.accounts.id.initialize({
            client_id: "client_id.apps.googleusercontent.com",
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

    function frm_login_submit(f){
        if(f.mt_id.value==''){
            $("#txt").text("아이디를 입력해주세요.");
            $('#id_alert').modal('show');
            return false;
        }
        if(f.mt_pwd.value==''){
            $("#txt").text("비밀번호를 입력해주세요.");
            $('#id_alert').modal('show');
            return false;
        }
    }

    function logout() {
        $.ajax({
            type: 'post',
            url: './models/login/logout.php',
            dataType: 'json',
            data: {},
        });
    }

</script>

<? include_once("./inc/tail.php"); ?>