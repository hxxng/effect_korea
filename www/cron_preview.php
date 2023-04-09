<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/Point_class.php";

$mem_list = $DB->select_query("select * from member_t where mt_level in (3,5) and mt_rdate is null");

create_preview();

//콘텐츠 등록일이 오래된 것부터 프리뷰 파일이 없는 것들 중에서 하나씩 프리뷰 파일 생성 함수
function create_preview(){
	global $DB;

    $row = $DB->fetch_assoc("select *, (SELECT mt_nickname FROM member_t WHERE idx=mt_idx) as mt_nickname from contents_t where ct_type = 1 and ct_status = 4 and ct_preview_file = 'N' order by ct_wdate");
    if ($row) {
        if ($row['ct_status'] != 2) {
            $DB->insert_query("pushnotification_log_t", array("plt_title" => "‘" . $row['mt_nickname'] . "’님의 ‘" . $row['ct_title'] . "’가 승인되었습니다. ", "plt_type" => 4, "op_idx" => $row['mt_idx'], "plt_page" => "artist_my_contents.php", "plt_wdate" => "now()"));
        }

        if ($row['ct_preview'] == "") {
            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/preview/ct_file_preview_" . $row['idx'] . ".mp4")) {
                if ($row['ct_format'] == "mov") {
                    exec("ffmpeg -ss 00:00:00 -i " . $_SERVER['DOCUMENT_ROOT'] . "/data/" . $row['ct_file'] . " -to 00:00:15 -vcodec h264 -acodec mp2 " . $_SERVER['DOCUMENT_ROOT'] . "/data/preview/ct_file_preview_" . $row['idx'] . ".mp4");
                } else {
                    exec("ffmpeg -ss 00:00:00 -i " . $_SERVER['DOCUMENT_ROOT'] . "/data/" . $row['ct_file'] . " -t 00:00:15 -c:v libx265 -crf 26 -preset fast -c:a aac -b:a 128k " . $_SERVER['DOCUMENT_ROOT'] . "/data/preview/ct_file_preview_" . $row['idx'] . "." . $row['ct_format']);
                }
                unlink($_SERVER['DOCUMENT_ROOT'] . "/data/" . $row['ct_file']);
            }
        }
        $DB->update_query("contents_t", array("ct_status" => 2, "ct_udate" => "now()", "ct_audate" => "now()", "ct_acdate" => "now()", "ct_preview_file" => "Y"), "idx = ".$row['idx']);
    }
}

?>