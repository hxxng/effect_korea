<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

$type = $_POST['type'];

if($type == "chk_email") {
    $query = "select * from member_t where mt_level in (3,5) and mt_id = '" . $_POST['mt_id'] . "'";
    $list = $DB->fetch_assoc($query);
    if($list) {
        if($list['mt_login_type'] != 1) {
            echo json_encode(array('result' => 'false'));
        } else {
            echo json_encode(array('result' => 'false2'));
        }
    } else {
        echo json_encode(array('result' => 'ok'));
    }
} else if($type == "sns_sign_up") {
    $query = "select * from member_t where mt_level in (3,5) and mt_id = '" . $_POST['mt_id'] . "'";
    $list = $DB->fetch_assoc($query);
    if($list) {
        echo json_encode(array('result' => 'false'));
    } else {
        $pwd = password_hash($_POST['mt_pwd'], PASSWORD_DEFAULT);
        if ($_POST['mt_login_type'] == "") {
            $mt_login_type = 1;
        } else {
            $mt_login_type = $_POST['mt_login_type'];
        }
        unset($arr_query);
        $arr_query = array(
            "mt_login_type" => $mt_login_type,
            "mt_id" => $_POST['mt_id'],
            "mt_pwd" => $pwd,
            "mt_level" => 3,
            "mt_status" => "Y",
            "mt_wdate" => "now()",
            "mt_ldate" => "now()",
        );
        $DB->insert_query('member_t', $arr_query);
        $idx = $DB->insert_id();

        $DB->insert_query("pushnotification_log_t", array("plt_title" => "이펙트코리아 회원가입을 환영합니다!", "plt_type" => 4, "op_idx" => $idx, "plt_wdate" => "now()"));

        $_mt_idx = $_SESSION['_mt_idx'] = $idx;
        $_mt_id = $_SESSION['_mt_id'] = $_POST['mt_id'];
        $_mt_level = $_SESSION['_mt_level'] = 3;

        echo json_encode(array('result' => 'ok'));
    }
} else if($type == "sign_up") {
    $member = $DB->fetch_assoc("select * from member_t where mt_id = '".$_POST['mt_id']."' and mt_login_type = 0 and mt_level = 0");
    if(!$member) {
        p_alert("해당정보로 회원가입 할 수 없습니다.\n다시 진행해주세요.", "/signup.php");
        exit;
    }

    $pwd = password_hash($_POST['mt_pwd'], PASSWORD_DEFAULT);
    if ($_POST['mt_login_type'] == "") {
        $mt_login_type = 1;
    } else {
        $mt_login_type = $_POST['mt_login_type'];
    }
    unset($arr_query);
    $arr_query = array(
        "mt_login_type" => $mt_login_type,
        "mt_firstname" => $_POST['mt_firstname'],
        "mt_lastname" => $_POST['mt_lastname'],
        "mt_id" => $_POST['mt_id'],
        "mt_hp" => $_POST['mt_hp'],
        "mt_pwd" => $pwd,
        "mt_level" => 3,
        "mt_status" => "Y",
        "mt_mail" => "Y",
        "mt_wdate" => "now()",
        "mt_ldate" => "now()",
    );
    $DB->update_query('member_t', $arr_query, "idx = ".$member['idx']);

    $_mt_idx = $_SESSION['_mt_idx'] = $member['idx'];
    $_mt_id = $_SESSION['_mt_id'] = $_POST['mt_id'];
    $_mt_level = $_SESSION['_mt_level'] = 3;

    gotourl("/signup_success.php");
} else if($type == "send_mail") {
    unset($arr_query);
    $arr_query = array(
        "mt_login_type" => 0,
        "mt_firstname" => $_POST['mt_firstname'],
        "mt_lastname" => $_POST['mt_lastname'],
        "mt_id" => $_POST['mt_id'],
        "mt_hp" => $_POST['mt_hp'],
        "mt_level" => 0,
    );
    $DB->insert_query('member_t', $arr_query);

    $to = $_POST['mt_id'];

    $subject = "[이펙트코리아] 메일 인증";

    $nameFrom = "EFFECT KOREA";
    $mailFrom = "mailFrom";

    $content = '<div class="mail_box" style="border:1px solid #D2DCE8; background-color:#fff; padding: 60px; text-align: center; max-width:461px; font-family:\'Pretendard\'; font-weight: 400; line-height: 1.6;">
                <img src="'.STATIC_HTTP.'/img/mail_img.png" alt="">
                <h1>메일 인증 안내입니다.</h1>
                <p style="white-space:pre-line; word-break:keep-all; margin-bottom: 40px;">'.$_POST['mt_firstname'].'님 안녕하세요.
                EFFECT KOREA에 가입해주셔서 진심으로 감사드립니다.
                아래 <span style="font-weight:bold; color:#0059B7;">메일인증</span> 버튼을 클릭하여 회원가입을 완료해주세요.
                감사합니다.</p>
                <form method="post" name="frm_search" id="frm_search" action="'.STATIC_HTTP.'/models/login/sign_up.php">
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
    $fromEmail = 'hmailFrom';
    $toName = $_POST['mt_firstname'];
    $toEmail = $to;
    $contents = $content;
    $result = mailer_new($fromName, $fromEmail, $toEmail, $toName, $subject, $contents);
    if($result == "Message has been sent") {
        echo json_encode(array("result" => "ok"));
    } else {
        echo json_encode(array("result" => "false", "msg" => "메일 발송에 실패하였습니다."));
    }
} else if($type == "sign_up_artist1") {
    $pwd = password_hash($_POST['mt_pwd'], PASSWORD_DEFAULT);
    unset($arr_query);
    $arr_query = array(
        "mt_login_type" => 1,
        "mt_firstname" => $_POST['mt_firstname'],
        "mt_lastname" => $_POST['mt_lastname'],
        "mt_id" => $_POST['mt_id'],
        "mt_hp" => $_POST['mt_hp'],
        "mt_pwd" => $pwd,
        "mt_level" => 3,
        "mt_status" => "Y",
        "mt_wdate" => "now()",
        "mt_ldate" => "now()",
    );
    $DB->insert_query('member_t', $arr_query);
    $idx = $DB->insert_id();

    $_mt_idx = $_SESSION['_mt_idx'] = $idx;
    $_mt_id = $_SESSION['_mt_id'] = $_POST['mt_id'];
    $_mt_level = $_SESSION['_mt_level'] = 3;

    gotourl("/signup_artist2.php");
} else if($type == 'chk_nickname') {
    $query = "select * from member_t where mt_level in (3,5) and mt_nickname = '" . $_POST['mt_nickname'] . "' and idx != ".$_SESSION['_mt_idx'];
    $list = $DB->fetch_assoc($query);
    if($list) {
        echo json_encode(array('result' => 'false'));
    } else {
        echo json_encode(array('result' => 'ok'));
    }
} else if($type == "sign_up_artist2") {
    $ct_img_dir_a = $_SERVER['DOCUMENT_ROOT'] . "/images/uploads";

    $temp_img_txt = "mt_image";
    $temp_img_on_txt = "mt_image_on";
    $temp_img_temp_on_txt = "mt_image_temp_on";
    $temp_img_del_txt = "mt_image_del";
    if($_FILES[$temp_img_txt]['name']) {
        $mt_image = $_FILES[$temp_img_txt]['tmp_name'];
        $mt_image_name = $_FILES[$temp_img_txt]['name'];
        $mt_image_size = $_FILES[$temp_img_txt]['size'];
        $mt_image_type = $_FILES[$temp_img_txt]['type'];

        if($mt_image_name!="") {
            @unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
            $_POST[$temp_img_on_txt] = "mt_image_".$_SESSION['_mt_idx'].".".get_file_ext($mt_image_name);
            upload_file($mt_image, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
            //thumnail($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            //scale_image_fit($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            thumnail_width($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "500");
        }
    } else {
        if($_POST[$temp_img_del_txt]) {
            unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
        }
    }
    unset($arr_query);
    $arr_query = array(
        "mt_nickname" => $_POST['mt_nickname'],
        "mt_url1" => $_POST['mt_url1'],
        "mt_url2" => $_POST['mt_url2'],
        "mt_url3" => $_POST['mt_url3'],
        "mt_url4" => $_POST['mt_url4'],
        "mt_url5" => $_POST['mt_url5'],
        "mt_introduce" => $_POST['mt_introduce'],
        "mt_image" => $_POST['mt_image_on'],
//        "mt_approve" => 1,    //베타테스트 후 이걸로 변경
        "mt_approve" => 2,       //베타테스트 후 삭제
        "mt_level" => 5,        //베타테스트 후 삭제
        "mt_approve_memo" => "",
        "mt_udate" => "now()",
        "mt_adate" => "now()",
    );
    $DB->update_query('member_t', $arr_query, "idx = ".$_SESSION['_mt_idx']);

    $DB->insert_query("pushnotification_log_t", array("plt_title" => "아티스트 가입 신청이 완료되었습니다. 관리자 승인까지 7일정도 소요됩니다.", "plt_type" => 4, "op_idx" => $_SESSION['_mt_idx'], "plt_wdate" => "now()"));

    gotourl("/signup_artist_success.php");
} else if($type == "sign_up_artist1_1") {
    unset($arr_query);
    $arr_query = array(
        "mt_hp" => $_POST['mt_hp'],
    );
    $DB->update_query('member_t', $arr_query, "idx = ".$_SESSION['_mt_idx']);

    gotourl("/signup_artist2.php");
} else if($type == "mail") {
    $DB->update_query("member_t", array("mt_mail" => "Y"), "mt_id = '".$_POST['mt_id']."' and mt_login_type = 0 and mt_level = 0");
    echo '<script type="text/javascript">alert("정상적으로 이메일이 인증되었습니다.\nEFFECT KOREA 홈페이지에서 확인해보세요.");history.back();</script>';
    exit;
} else if($type == "mail_certification") {
    $member = $DB->fetch_assoc("select * from member_t where where mt_id = '".$_POST['mt_id']."' and mt_level = 0 and mt_login_type = 0");
    if($member['mt_mail'] == "Y") {
        echo json_encode(array("result" => "ok"));
    } else {
        echo json_encode(array("result" => "false", "메일인증을 다시 진행해주세요."));
    }
}
?>