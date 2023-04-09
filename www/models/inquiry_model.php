<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

$type = $_POST['type'];

if($type == "send_mail") {
    $query = "select * from member_t where mt_level in (3,5) and mt_id = '".$_POST['mt_id']."'";
    $row = $DB->fetch_assoc($query);

    $to = "email";

    $subject = "[이펙트코리아 문의] ".$_POST['title'];

    $nameFrom = "EFFECT KOREA";
    $mailFrom = "email";

    $content = '<p style="white-space:pre-line; word-break:keep-all; margin-bottom: 40px;">
                문의 내용 : '.$_POST['content'].'
                답변 받을 이메일 : '.$_POST['mt_id'].'</p>';

    $headers = "Content-Type: text/html; charset=utf-8\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Cc: email\r\n";
    $headers .= "From: " . $nameFrom . " <" . $mailFrom . ">\r\n";

    $fromName = 'EFFECT KOREA';
    $fromEmail = 'email';
    $toName = $_POST['mt_id'];
    $toEmail = $to;
    $contents = $content;
    $result = mailer_new($fromName, $fromEmail, $toEmail, $toName, $subject, $contents);
    if($result == "Message has been sent") {
        echo json_encode(array("result" => "ok"));
    } else {
        echo json_encode(array("result" => "false", "msg" => "메일 발송에 실패하였습니다."));
    }
} else if($type == "send_mail2") {
    $to = "email";

    $subject = "[이펙트코리아 TAILORED]";

    $nameFrom = "EFFECT KOREA";
    $mailFrom = "email";

    $content = '<p style="white-space:pre-line; word-break:keep-all; margin-bottom: 40px;">
                이름 : '.$_POST['firstname'].'
                성 : '.$_POST['lastname'].'
                회사명 : '.$_POST['company'].'
                직함 : '.$_POST['title'].'
                국적 : '.$_POST['nationality'].'
                국제번호 : '.$_POST['num'].'
                연락처 : '.$_POST['hp'].'
                비고 : '.$_POST['memo'].'</p>';

    $headers = "Content-Type: text/html; charset=utf-8\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Cc: email\r\n";
    $headers .= "From: " . $nameFrom . " <" . $mailFrom . ">\r\n";

    $fromName = 'EFFECT KOREA';
    $fromEmail = 'email';
    $toName = $_POST['mt_id'];
    $toEmail = $to;
    $contents = $content;
    $result = mailer_new($fromName, $fromEmail, $toEmail, $toName, $subject, $contents);
    if($result == "Message has been sent") {
        p_alert("제출되었습니다.", "/tailored.php");
    } else {
        p_alert("메일 발송에 실패하였습니다.", "/tailored.php");
    }
}
?>