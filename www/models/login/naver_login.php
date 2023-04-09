<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
print_r($_GET['error_description']);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://static.nid.naver.com/js/naveridlogin_js_sdk_2.0.2.js" charset="utf-8"></script>
<script>
    var naverLogin = new naver.LoginWithNaverId(
        {
            clientId: "clientId",
            callbackUrl: "callbackUrl",
            isPopup: false
        }
    );

    naverLogin.init();

    window.addEventListener('load', function () {
        naverLogin.getLoginStatus(function (status) {
            if (status) {
                var email = naverLogin.user.getEmail(); // 필수로 설정할것을 받아와 아래처럼 조건문을 줍니다.
                var id = naverLogin.user.getId();

                if( email == undefined || email == null) {
                    alert("이메일은 필수정보입니다. 정보제공을 동의해주세요.");
                    naverLogin.reprompt();
                    return;
                } else {
                    $.ajax({
                        type: 'post',
                        url: '/models/login/login.php',
                        dataType: 'json',
                        data: {type: "login", act: "sns",  mt_id: email, mt_pwd: id},
                        success: function (result) {
                            if(result['result'] == "ok") {
                                location.replace("/");
                            } else if(result['result'] == "false") {
                                if(confirm("존재하지 않는 회원입니다.\n회원가입 하시겠습니까?")) {
                                    $.ajax({
                                        type: 'post',
                                        url: '/models/login/sign_up.php',
                                        dataType: 'json',
                                        data: {
                                            type: "sns_sign_up",
                                            mt_login_type : 2,
                                            mt_id: email,
                                            mt_pwd: id
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
                            } else if(result['result'] == "chk_false") {
                                alert("아이디 및 비밀번호가 올바르지 않습니다.\n아이디, 비밀번호는 대문자, 소문자를 구분합니다.\n<Caps Lock>키가 켜져 있는지 확인하시고 다시 입력하십시오.");
                                    location.replace("/signin.php");
                            }
                        },
                        error: function () {

                        }
                    });
                }
            } else {
                if("<?=$_GET['error_description']?>" == "Canceled By User") {
                    alert("취소되었습니다.");
                    location.replace("/login.php");
                }else {
                    console.log("callback 처리에 실패하였습니다.");
                }
            }
        });
    });
</script>