<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

$query = "select * from terms_t where idx = 1";
$row = $DB->fetch_assoc($query);
?>

<div class="wrap">
    3.4회원은 회사에 언제든지 탈퇴를 신청할 수 있으며 회사는 회원의 요청에 따라 즉시 탈퇴를 수락합니다.<br><br>

    3.4-1 회원탈퇴방법
    마이페이지-내정보수정-탈퇴하기
</div>