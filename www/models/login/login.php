<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

$type = $_POST['type'];

if(isset($_GET["code"])) {
    include('./gconfig.php');
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    if(!isset($token['error']))
    {
        //Set the access token used for requests
        $google_client->setAccessToken($token['access_token']);

        //Store "access_token" value in $_SESSION variable for future use.
        $_SESSION['access_token'] = $token['access_token'];

        //Create Object of Google Service OAuth 2 class
        $google_service = new Google_Service_Oauth2($google_client);

        //Get user profile data from google
        $data = $google_service->userinfo->get();

        if(!empty($data['email'] && !empty($data['id'])))
        {
            $query = "select * from member_t where mt_level in (3,5) and mt_id = '".$data['email']."' and mt_login_status = 'Y'";
            $list = $DB->fetch_assoc($query);
            if($list) {
                if(password_verify($data['id'], $list['mt_pwd'])) {
                    unset($arr_query);
                    $arr_query = array(
                        'mt_ldate' => "now()",
                        'mt_status' => "Y",
                    );

                    $where_query = "idx = '".$list['idx']."'";

                    $DB->update_query('member_t', $arr_query, $where_query);

                    $_mt_idx = $_SESSION['_mt_idx'] = $list['idx'];
                    $_mt_id = $_SESSION['_mt_id'] = $list['mt_id'];
                    $_mt_level = $_SESSION['_mt_level'] = $list['mt_level'];

                    if($_POST['act'] == "sns") {
                        echo json_encode(array('result' => 'ok'));
                    } else{
                        p_gotourl("/");
                    }
                } else {
                    if($_POST['act'] == "sns") {
                        echo json_encode(array('result' => 'false'));
                    } else{
                        p_alert("아이디 또는 비밀번호를 다시 확인하세요.\\n아이디 또는 비밀번호를 잘못 입력하셨습니다.", '/signin.php');
                        exit;
                    }
                }
            } else {
                $query = "select * from member_t where mt_level = 9 and mt_id = '".$data['email']."'";
                $list = $DB->fetch_assoc($query);
                if($list) {
                    p_alert("관리자 계정입니다.", STATIC_HTTP.'/mng/login.php');
                } else {
                    if($_POST['act'] == "sns") {
                        echo json_encode(array('result' => 'false'));
                    } else{
                        echo '<script src="'.STATIC_HTTP.'/js/jquery-1.12.4.min.js"></script>';
                        echo "<script type=\"text/javascript\">
                                if(confirm('존재하지 않는 회원입니다.\\n회원가입 하시겠습니까?')) {
                                    $.ajax({
                                    type: 'post',
                                    url: './sign_up.php',
                                    dataType: 'json',
                                    data: {
                                        type: 'sns_sign_up',
                                        mt_login_type : 5,
                                        mt_id: '".$data['email']."',
                                        mt_pwd: '".$data['id']."'
                                    },
                                    success: function (r) {
                                        if(r['result'] == 'ok') {
                                            location.replace('/signup_success.php');
                                        }
                                    }
                                });
                                } else {
                                    parent.document.location.href = '/signin.php';
                                }
                            </script>";
                        exit;
                    }
                }
            }
        }
    }
}
if($type == "login") {
    $query = "select * from member_t where mt_level in (3,5) and mt_id = '".$_POST['mt_id']."'";
    $list = $DB->fetch_assoc($query);
    if($list) {
        if(password_verify($_POST['mt_pwd'], $list['mt_pwd'])) {
            unset($arr_query);
            $arr_query = array(
                'mt_ldate' => "now()",
                'mt_status' => "Y",
            );

            $where_query = "idx = '".$list['idx']."'";

            $DB->update_query('member_t', $arr_query, $where_query);

            $_mt_idx = $_SESSION['_mt_idx'] = $list['idx'];
            $_mt_id = $_SESSION['_mt_id'] = $list['mt_id'];
            $_mt_level = $_SESSION['_mt_level'] = $list['mt_level'];

            if($_POST['act'] == "sns") {
                echo json_encode(array('result' => 'ok'));
            } else{
                p_gotourl("/");
            }
        } else {
            if($_POST['act'] == "sns") {
                echo json_encode(array('result' => 'false2'));
            } else{
                p_alert("아이디 또는 비밀번호를 다시 확인하세요.\\n아이디 또는 비밀번호를 잘못 입력하셨습니다.", '/signin.php');
                exit;
            }
        }
    } else {
        $query = "select * from member_t where mt_level = 9 and mt_id = '".$_POST['mt_id']."'";
        $list = $DB->fetch_assoc($query);
        if($list) {
            p_alert("관리자 계정입니다.", STATIC_HTTP.'/mng/login.php');
        } else {
            if($_POST['act'] == "sns") {
                echo json_encode(array('result' => 'false'));
            } else{
                p_alert("회원정보가 없습니다.", '/signin.php');
                exit;
            }
        }
    }
} else if($type == "find_id") {
    $query = "select * from member_t where mt_firstname = '".$_POST['mt_firstname']."' and mt_lastname = '".$_POST['mt_lastname']."' and mt_hp = '".$_POST['mt_hp']."' and mt_login_status = 'Y'";
    $row = $DB->fetch_assoc($query);
    if($row) {
        p_gotourl("/find_id_sucess.php?id=".$row['mt_id']);
    } else {
        p_alert("해당 정보를 가진 회원이 없습니다.","/find_id.php");
    }
} else if($type == "find_pw") {
    $query = "select * from member_t where mt_level in (3,5) and mt_id = '" . $_POST['mt_id'] . "' and mt_login_status = 'Y'";
    $list = $DB->fetch_assoc($query);
    if($list) {
        echo json_encode(array('result' => 'ok'));
    } else {
        echo json_encode(array('result' => 'false'));
    }
} else if($type == "chg_pw") {
    $_mt_id = $_SESSION['_mt_id'];
    $pwd = password_hash($_POST['mt_pwd'], PASSWORD_DEFAULT);
    $DB->update_query("member_t", array("mt_pwd" => $pwd, "mt_udate" => "now()"), " mt_id = '".$_mt_id."' and mt_level in (3,5) ");
    echo json_encode(array('result' => 'ok'));
} else if($type == "send_mail") {
    $DB->update_query("member_t", array("mt_pwd_mail" => "N"), "mt_id = '".$_POST['mt_id']."'");

    $to = $_POST['mt_id'];

    $subject = "[이펙트코리아] 메일 인증";

    $nameFrom = "EFFECT KOREA";
    $mailFrom = "mailFrom";

    $content = '<div class="mail_box" style="border:1px solid #D2DCE8; background-color:#fff; padding: 60px; text-align: center; max-width:461px; font-family:\'Pretendard\'; font-weight: 400; line-height: 1.6;">
                <img src="'.STATIC_HTTP.'/img/mail_img.png" alt="">
                <h1>메일 인증 안내입니다.</h1>
                <p style="white-space:pre-line; word-break:keep-all; margin-bottom: 40px;">
                비밀번호 재설정을 위해 아래 <span style="font-weight:bold; color:#0059B7;">메일인증</span> 버튼을 클릭하여 인증을 완료해주세요.
                감사합니다.</p>
                <form method="post" name="frm_search" id="frm_search" action="'.STATIC_HTTP.'/models/login/login.php">
                <input type="hidden" name="type" value="mail">
                <input type="hidden" name="mt_id" value="'.$_POST['mt_id'].'">
                    <button type="submit" style="width: 266px;height: 52px;border-radius: 5em;color: #fff;background-color: #0076F2;border-color: #0076F2;padding: 12px 21px;font-weight: 600;border: 0;cursor: pointer;font-family: \'Pretendard\';font-size: 16px;" onclick="javasciprt:alert(\'정상적으로 이메일이 인증되었습니다.\nEFFECT KOREA 홈페이지에서 확인해보세요.\')">메일 인증</button>
                </form>
            </div>
            ';

    $headers = "Content-Type: text/html; charset=utf-8\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Cc: mailFrom\r\n";
    $headers .= "From: " . $nameFrom . " <" . $mailFrom . ">\r\n";

    $fromName = 'EFFECT KOREA';
    $fromEmail = 'fromEmail';
    $toName = $_POST['mt_id'];
    $toEmail = $to;
    $contents = $content;
    $result = mailer_new($fromName, $fromEmail, $toEmail, $toName, $subject, $contents);
    if($result == "Message has been sent") {
        echo json_encode(array("result" => "ok"));
    } else {
        echo json_encode(array("result" => "false", "msg" => "메일 발송에 실패하였습니다."));
    }
} else if($type == "mail") {
    $DB->update_query("member_t", array("mt_pwd_mail" => "Y"), "mt_id = '".$_POST['mt_id']."'");
    echo '<script type="text/javascript">alert("정상적으로 이메일이 인증되었습니다.\nEFFECT KOREA 홈페이지에서 확인해보세요.");history.back();</script>';
    exit;
} else if($type == "mail_certification") {
    $member = $DB->fetch_assoc("select * from member_t where mt_id = '".$_POST['mt_id']."' and mt_level in (3,5)");
    if($member['mt_pwd_mail'] == "Y") {
        $_mt_idx = $_SESSION['_mt_idx'] = $member['idx'];
        $_mt_id = $_SESSION['_mt_id'] = $_POST['mt_id'];
        echo json_encode(array("result" => "ok"));
    } else {
        echo json_encode(array("result" => "false", "메일인증을 다시 진행해주세요."));
    }
}

?>