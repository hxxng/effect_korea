<?
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
require $_SERVER['DOCUMENT_ROOT'].'/lib/aws/vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;
use Aws\Exception\AwsException;
use Aws\S3\ObjectUploader;

$s3 = Aws\S3\S3Client::factory(
    array(
        'endpoint' => 'https://kr.object.ncloudstorage.com',
        'version' => 'latest',
        'region' => 'ap-northeast-2', //한국
        'credentials' => array(
            'key' => 'key',
            'secret' => 'secret',
        )
    )
);

$bucket = 'bucket';

$ct_preview_dir_a = $_SERVER['DOCUMENT_ROOT'] . "/data/preview";

if($_POST['act']=='input') {
    if($_POST['ct_time_hour']) {
        $hour = sprintf('%02d',$_POST['ct_time_hour']);
    } else {
        $hour = "00";
    }
    if($_POST['ct_time_min']) {
        $min = sprintf('%02d',$_POST['ct_time_min']);
    } else {
        $min = "00";
    }
    if($_POST['ct_time_sec']) {
        $sec = sprintf('%02d',$_POST['ct_time_sec']);
    } else {
        $sec = "00";
    }
    $time = $hour.":".$min.":".$sec;
    if($_POST['ct_editorial']) {
        $_POST['ct_editorial'] = $_POST['ct_editorial'];
    } else {
        $_POST['ct_editorial'] = "N";
    }
    if($_POST['ct_exclusive']) {
        $_POST['ct_exclusive'] = $_POST['ct_exclusive'];
    } else {
        $_POST['ct_exclusive'] = "N";
    }
    unset($arr_query);
    $arr_query = array(
        "mt_idx" => 1,
        "ct_status" => 2,
        "ct_show" => "Y",
        "ct_title" => $_POST['ct_title'],
        "ct_contents" => $_POST['ct_contents'],
        "ct_cate_idx" => $_POST['ct_cate_idx'],
        "ct_cate_idx2" => $_POST['ct_cate_idx2'],
        "ct_format" => $_POST['ct_format'],
        "ct_framerate" => $_POST['ct_framerate'],
        "ct_size" => $_POST['ct_size'],
        "ct_playtime" => $time,
        "ct_filter" => $_POST['ct_filter'],
        "ct_editorial" => $_POST['ct_editorial'],
        "ct_resolution" => $_POST['ct_resolution'],
        "ct_program" => $_POST['ct_program'],
        "ct_price" => $_POST['ct_price'],
        "ct_exclusive" => $_POST['ct_exclusive'],
        "ct_wdate" => "now()",
        "ct_preview_file" => "N",
    );
    if($_POST['ct_cate_idx'] == 1) {
        $arr_query['ct_type'] = 1;
    } else {
        $arr_query['ct_type'] = 2;
    }
    $DB->insert_query("contents_t", $arr_query);
    $_last_idx = $DB->insert_id();

    if($_POST['ct_keyword'] != "") {
        $keyword = explode(" ", $_POST['ct_keyword']);
        if($keyword) {
            foreach ($keyword as $row) {
                $DB->insert_query("contents_keyword_t", array("ct_idx" => $_last_idx, "ct_korean" => $row, "ct_english" => translate($row), "ct_wdate" => "now()"));
            }
        }
    }

    $temp_img_txt = "ct_image";
    $temp_img_on_txt = "ct_image_on";
    $temp_img_temp_on_txt = "ct_image_temp_on";
    $temp_img_del_txt = "ct_image_del";
    if($_FILES[$temp_img_txt]['name']) {
        $ct_image = $_FILES[$temp_img_txt]['tmp_name'];
        $ct_image_name = $_FILES[$temp_img_txt]['name'];
        $ct_image_size = $_FILES[$temp_img_txt]['size'];
        $ct_image_type = $_FILES[$temp_img_txt]['type'];

        if($ct_image_name!="") {
            @unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
            $_POST[$temp_img_on_txt] = "ct_image_".$_last_idx.".".get_file_ext($ct_image_name);
            upload_file($ct_image, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
            //thumnail($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            //scale_image_fit($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            thumnail_width($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000");
        }
    } else {
        if($_POST[$temp_img_del_txt]) {
            unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
        }
    }
    $arr_query_img['ct_image'] = $_POST['ct_image_on'];

    $temp_img_txt = "ct_preview";
    $temp_img_on_txt = "ct_preview_on";
    $temp_img_temp_on_txt = "ct_preview_temp_on";
    $temp_img_del_txt = "ct_preview_del";
    if($_FILES[$temp_img_txt]['name']) {
        $ct_preview = $_FILES[$temp_img_txt]['tmp_name'];
        $ct_preview_name = $_FILES[$temp_img_txt]['name'];
        $ct_preview_size = $_FILES[$temp_img_txt]['size'];
        $ct_preview_type = $_FILES[$temp_img_txt]['type'];

        if($ct_preview_name!="") {
            @unlink($ct_preview_dir_a."/".$_POST[$temp_img_on_txt]);
            $_POST[$temp_img_on_txt] = "ct_file_preview_".$_last_idx.".".get_file_ext($ct_preview_name);
            upload_file($ct_preview, $_POST[$temp_img_on_txt], $ct_preview_dir_a."/");
            thumnail_width($ct_preview_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_preview_dir_a."/", "1000");
        }
    } else {
        if($_POST[$temp_img_del_txt]) {
            unlink($ct_preview_dir_a."/".$_POST[$temp_img_del_txt]);
        }
    }
    $arr_query_img['ct_preview'] = $_POST['ct_preview_on'];

    $temp_img_txt = "ct_file";
    $temp_img_on_txt = "ct_file_on";
    $temp_img_temp_on_txt = "ct_file_temp_on";
    $temp_img_del_txt = "ct_file_del";
    if($_FILES[$temp_img_txt]['name']) {
        $ct_file = $_FILES[$temp_img_txt]['tmp_name'];
        $ct_file_name = $_FILES[$temp_img_txt]['name'];
        $ct_file_size = $_FILES[$temp_img_txt]['size'];
        $ct_file_type = $_FILES[$temp_img_txt]['type'];

        if($ct_file_name!="") {
            $files = $_FILES[$temp_img_txt];
            $name = $files['name'];
            $tmpName = $files['tmp_name'];
            $size = $files['size'];
            $extension = explode('.', $files['name']);
            $extension = strtolower(end($extension));
            $key = "ct_file_" . $_last_idx . "." . get_file_ext($ct_file_name);
            $tmp_file_name = "{$key}";
            $tmp_file_path = $_SERVER['DOCUMENT_ROOT'] . "/data/{$tmp_file_name}";
            move_uploaded_file($tmpName, $tmp_file_path);

            $source = fopen($tmp_file_path, 'rb');

            $uploader = new ObjectUploader(
                $s3,
                $bucket,
                $key,
                $source
            );

            do {
                try {
                    $result = $uploader->upload();
                    if(file_exists($_SERVER['DOCUMENT_ROOT']."/data/preview/ct_file_preview_" . $_last_idx . ".mp4")) {
                        unlink($_SERVER['DOCUMENT_ROOT'] . "/data/preview/ct_file_preview_" . $_last_idx . ".mp4");
                    }
                    if ($_FILES['ct_preview']['name'] == "") {
                        if (get_file_ext($ct_file_name) == "mov") {
                            exec("ffmpeg -ss 00:00:00 -i " . $_SERVER['DOCUMENT_ROOT'] . "/data/" . $tmp_file_name . " -to 00:00:15 -vcodec h264 -acodec mp2 " . $_SERVER['DOCUMENT_ROOT'] . "/data/preview/ct_file_preview_" . $_last_idx . ".mp4");

                            //ffmpeg mp4파일 -> gif로 변환 명령어
//                            exec("ffmpeg -i " . $_SERVER['DOCUMENT_ROOT'] . "/data/" . $tmp_file_name . " -vf scale=1920:-1 -t 15 -r 10  " . $_SERVER['DOCUMENT_ROOT'] . "/data/preview/ct_file_preview_" . $_last_idx . ".gif");
                        } else {
                            exec("ffmpeg -ss 00:00:00 -i " . $_SERVER['DOCUMENT_ROOT'] . "/data/" . $tmp_file_name . " -t 00:00:15 -c:v libx265 -crf 26 -preset fast -c:a aac -b:a 128k " . $_SERVER['DOCUMENT_ROOT'] . "/data/preview/ct_file_preview_" . $_last_idx . "." . get_file_ext($ct_file_name));
                        }
                        $arr_query_img['ct_preview_file'] = "Y";
                    }
//                  echo "Upload complete: {$result['ObjectURL']}\n";
                    unlink($tmp_file_path);
                } catch (MultipartUploadException $e) {
//                  echo $e->getMessage() . "\n";
                }
            } while (!isset($result));

            fclose($tmp_file_path);
        }
        $_POST[$temp_img_on_txt] = "ct_file_".$_last_idx.".".get_file_ext($ct_file_name);
    } else {
        if($_POST[$temp_img_del_txt]) {
            unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
        }
    }
    $arr_query_img['ct_file'] = $_POST['ct_file_on'];

    $DB->update_query('contents_t', $arr_query_img, "idx = ".$_last_idx);

    if($_POST['ct_cate_idx'] == 1) {
        $url = "./contents_video_list.php";
    } else {
        $url = "./contents_template_list.php";
    }

    p_alert("정상적으로 등록 되었습니다.", $url);
} else if($_POST['act']=='update') {
    if($_POST['ct_time_hour']) {
        $hour = sprintf('%02d',$_POST['ct_time_hour']);
    } else {
        $hour = "00";
    }
    if($_POST['ct_time_min']) {
        $min = sprintf('%02d',$_POST['ct_time_min']);
    } else {
        $min = "00";
    }
    if($_POST['ct_time_sec']) {
        $sec = sprintf('%02d',$_POST['ct_time_sec']);
    } else {
        $sec = "00";
    }
    $time = $hour.":".$min.":".$sec;
    if($_POST['ct_editorial']) {
        $_POST['ct_editorial'] = $_POST['ct_editorial'];
    } else {
        $_POST['ct_editorial'] = "N";
    }
    if($_POST['ct_exclusive']) {
        $_POST['ct_exclusive'] = $_POST['ct_exclusive'];
    } else {
        $_POST['ct_exclusive'] = "N";
    }
    unset($arr_query);
    $arr_query = array(
        "ct_show" => $_POST['ct_show'],
        "ct_title" => $_POST['ct_title'],
        "ct_contents" => $_POST['ct_contents'],
        "ct_cate_idx" => $_POST['ct_cate_idx'],
        "ct_cate_idx2" => $_POST['ct_cate_idx2'],
        "ct_format" => $_POST['ct_format'],
        "ct_framerate" => $_POST['ct_framerate'],
        "ct_size" => $_POST['ct_size'],
        "ct_playtime" => $time,
        "ct_filter" => $_POST['ct_filter'],
        "ct_editorial" => $_POST['ct_editorial'],
        "ct_resolution" => $_POST['ct_resolution'],
        "ct_program" => $_POST['ct_program'],
        "ct_price" => $_POST['ct_price'],
        "ct_exclusive" => $_POST['ct_exclusive'],
        "ct_udate" => "now()",
        "ct_preview_file" => "N",
    );
    if($_POST['ct_cate_idx'] == 1) {
        $arr_query['ct_type'] = 1;
    } else {
        $arr_query['ct_type'] = 2;
    }
    $DB->update_query("contents_t", $arr_query, "idx = ".$_POST['idx']);

    if($_POST['ct_keyword'] != "") {
        $query = "select * from contents_keyword_t where ct_idx = ".$_POST['idx'];
        $translate = $DB->fetch_assoc($query);
        if($translate) {
            $DB->del_query("contents_keyword_t", "ct_idx = ".$_POST['idx']);
        }
        $keyword = explode(" ", $_POST['ct_keyword']);
        if($keyword) {
            foreach ($keyword as $row) {
                $DB->insert_query("contents_keyword_t", array("ct_idx" => $_POST['idx'], "ct_korean" => $row, "ct_english" => translate($row), "ct_wdate" => "now()"));
            }
        }
    } else {
        $DB->del_query("contents_keyword_t", "ct_idx = ".$_POST['idx']);
    }

    $temp_img_txt = "ct_image";
    $temp_img_on_txt = "ct_image_on";
    $temp_img_temp_on_txt = "ct_image_temp_on";
    $temp_img_del_txt = "ct_image_del";
    if($_FILES[$temp_img_txt]['name']) {
        $ct_image = $_FILES[$temp_img_txt]['tmp_name'];
        $ct_image_name = $_FILES[$temp_img_txt]['name'];
        $ct_image_size = $_FILES[$temp_img_txt]['size'];
        $ct_image_type = $_FILES[$temp_img_txt]['type'];

        if($ct_image_name!="") {
            @unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
            $_POST[$temp_img_on_txt] = "ct_image_".$_POST['idx'].".".get_file_ext($ct_image_name);
            upload_file($ct_image, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
            //thumnail($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            //scale_image_fit($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            thumnail_width($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000");
        }
    } else {
        if($_POST[$temp_img_del_txt]) {
            unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
        }
    }
    $arr_query_img['ct_image'] = $_POST['ct_image_on'];

    $temp_img_txt = "ct_preview";
    $temp_img_on_txt = "ct_preview_on";
    $temp_img_temp_on_txt = "ct_preview_temp_on";
    $temp_img_del_txt = "ct_preview_del";
    if($_FILES['ct_preview']['name'] == "") {
        $ct_preview = $_FILES[$temp_img_txt]['tmp_name'];
        $ct_preview_name = $_FILES[$temp_img_txt]['name'];
        $ct_preview_size = $_FILES[$temp_img_txt]['size'];
        $ct_preview_type = $_FILES[$temp_img_txt]['type'];

        if($ct_preview_name!="") {
            @unlink($ct_preview_dir_a."/".$_POST[$temp_img_on_txt]);
            $_POST[$temp_img_on_txt] = "ct_file_preview_".$_POST['idx'].".".get_file_ext($ct_preview_name);
            upload_file($ct_preview, $_POST[$temp_img_on_txt], $ct_preview_dir_a."/");
            thumnail_width($ct_preview_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_preview_dir_a."/", "1000");
        }
    } else {
        if($_POST[$temp_img_del_txt]) {
            unlink($ct_preview_dir_a."/".$_POST[$temp_img_del_txt]);
        }
    }
    $arr_query_img['ct_preview'] = $_POST['ct_preview_on'];

    $temp_img_txt = "ct_file";
    $temp_img_on_txt = "ct_file_on";
    $temp_img_temp_on_txt = "ct_file_temp_on";
    $temp_img_del_txt = "ct_file_del";
    if($_FILES[$temp_img_txt]['name']) {
        $ct_file = $_FILES[$temp_img_txt]['tmp_name'];
        $ct_file_name = $_FILES[$temp_img_txt]['name'];
        $ct_file_size = $_FILES[$temp_img_txt]['size'];
        $ct_file_type = $_FILES[$temp_img_txt]['type'];

        if($ct_file_name!="") {
            $files = $_FILES[$temp_img_txt];
            $name = $files['name'];
            $tmpName = $files['tmp_name'];
            $size = $files['size'];
            $extension = explode('.', $files['name']);
            $extension = strtolower(end($extension));
            $key = "ct_file_" . $_POST['idx'] . "." . get_file_ext($ct_file_name);
            $tmp_file_name = "{$key}";
            $tmp_file_path = $_SERVER['DOCUMENT_ROOT'] . "/data/{$tmp_file_name}";
            move_uploaded_file($tmpName, $tmp_file_path);

            $source = fopen($tmp_file_path, 'rb');

            $uploader = new ObjectUploader(
                $s3,
                $bucket,
                $key,
                $source
            );

            do {
                try {
                    $result = $uploader->upload();
                    if(file_exists($_SERVER['DOCUMENT_ROOT']."/data/preview/ct_file_preview_" . $_POST['idx'] . ".mp4")) {
                        unlink($_SERVER['DOCUMENT_ROOT'] . "/data/preview/ct_file_preview_" . $_POST['idx'] . ".mp4");
                    }
                    if ($_FILES['ct_preview']['name'] == "") {
                        if (get_file_ext($ct_file_name) == "mov") {
                            exec("ffmpeg -ss 00:00:00 -i " . $_SERVER['DOCUMENT_ROOT'] . "/data/" . $tmp_file_name . " -to 00:00:15 -vcodec h264 -acodec mp2 " . $_SERVER['DOCUMENT_ROOT'] . "/data/preview/ct_file_preview_" . $_POST['idx'] . ".mp4");
                        } else {
                            exec("ffmpeg -ss 00:00:00 -i " . $_SERVER['DOCUMENT_ROOT'] . "/data/" . $tmp_file_name . " -t 00:00:15 -c:v libx265 -crf 26 -preset fast -c:a aac -b:a 128k " . $_SERVER['DOCUMENT_ROOT'] . "/data/preview/ct_file_preview_" . $_POST['idx'] . "." . get_file_ext($ct_file_name));
                        }
                        $arr_query_img['ct_preview_file'] = "Y";
                    }
//                  echo "Upload complete: {$result['ObjectURL']}\n";
                    unlink($tmp_file_path);
                } catch (MultipartUploadException $e) {
//                  echo $e->getMessage() . "\n";
                }
            } while (!isset($result));

            fclose($tmp_file_path);
        }
        $_POST[$temp_img_on_txt] = "ct_file_".$_POST['idx'].".".get_file_ext($ct_file_name);
    } else {
        if($_POST[$temp_img_del_txt]) {
            unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
        }
    }
    $arr_query_img['ct_file'] = $_POST['ct_file_on'];

    $DB->update_query('contents_t', $arr_query_img, "idx = ".$_POST['idx']);

    $DB->update_query("cart_t", array("pt_title" => $_POST['ct_title'], "pt_price" => $_POST['ct_price'], "ct_price" => $_POST['ct_price'], "ct_udate" => "now()"), "ct_idx = ".$_POST['idx']." and ct_select != 2 and ct_status < 2");

    p_alert("변경 내용으로 저장되었습니다!");
} else if($_POST['act']=='approve_update') {
    if($_POST['ct_time_hour']) {
        $hour = sprintf('%02d',$_POST['ct_time_hour']);
    } else {
        $hour = "00";
    }
    if($_POST['ct_time_min']) {
        $min = sprintf('%02d',$_POST['ct_time_min']);
    } else {
        $min = "00";
    }
    if($_POST['ct_time_sec']) {
        $sec = sprintf('%02d',$_POST['ct_time_sec']);
    } else {
        $sec = "00";
    }
    $time = $hour.":".$min.":".$sec;
    if($_POST['ct_editorial']) {
        $_POST['ct_editorial'] = $_POST['ct_editorial'];
    } else {
        $_POST['ct_editorial'] = "N";
    }
    if($_POST['ct_exclusive']) {
        $_POST['ct_exclusive'] = $_POST['ct_exclusive'];
    } else {
        $_POST['ct_exclusive'] = "N";
    }
    unset($arr_query);
    $arr_query = array(
        "ct_status" => $_POST['ct_status'],
        "ct_show" => $_POST['ct_show'],
        "ct_title" => $_POST['ct_title'],
        "ct_contents" => $_POST['ct_contents'],
        "ct_cate_idx" => $_POST['ct_cate_idx'],
        "ct_cate_idx2" => $_POST['ct_cate_idx2'],
        "ct_format" => $_POST['ct_format'],
        "ct_framerate" => $_POST['ct_framerate'],
        "ct_size" => $_POST['ct_size'],
        "ct_playtime" => $time,
        "ct_filter" => $_POST['ct_filter'],
        "ct_editorial" => $_POST['ct_editorial'],
        "ct_resolution" => $_POST['ct_resolution'],
        "ct_price" => $_POST['ct_price'],
        "ct_exclusive" => $_POST['ct_exclusive'],
        "ct_udate" => "now()",
        "ct_preview_file" => "N",
    );
    $query = "select *, (SELECT mt_nickname FROM member_t WHERE idx=mt_idx) as mt_nickname from contents_t where idx = ".$_POST['idx'];
    $info = $DB->fetch_assoc($query);
    if($_POST['ct_status'] == 2) {
        $arr_query['ct_acdate'] = "now()";

        if($info['ct_status'] != 2) {
            $DB->insert_query("pushnotification_log_t", array("plt_title" => "‘".$info['mt_nickname']."’님의 ‘".$_POST['ct_title']."’가 승인되었습니다. ", "plt_type" => 4, "op_idx" => $info['mt_idx'], "plt_page" => "artist_my_contents.php" , "plt_wdate" => "now()"));
        }
    }

    $DB->update_query("contents_t", $arr_query, "idx = ".$_POST['idx']);

    if($_POST['ct_keyword'] != "") {
        $query = "select * from contents_keyword_t where ct_idx = ".$_POST['idx'];
        $translate = $DB->fetch_assoc($query);
        if($translate) {
            $DB->del_query("contents_keyword_t", "ct_idx = ".$_POST['idx']);
        }
        $keyword = explode(" ", $_POST['ct_keyword']);
        if($keyword) {
            foreach ($keyword as $row) {
                $DB->insert_query("contents_keyword_t", array("ct_idx" => $_POST['idx'], "ct_korean" => $row, "ct_english" => translate($row), "ct_wdate" => "now()"));
            }
        }
    } else {
        $DB->del_query("contents_keyword_t", "ct_idx = ".$_POST['idx']);
    }

    $temp_img_txt = "ct_image";
    $temp_img_on_txt = "ct_image_on";
    $temp_img_temp_on_txt = "ct_image_temp_on";
    $temp_img_del_txt = "ct_image_del";
    if($_FILES[$temp_img_txt]['name']) {
        $ct_image = $_FILES[$temp_img_txt]['tmp_name'];
        $ct_image_name = $_FILES[$temp_img_txt]['name'];
        $ct_image_size = $_FILES[$temp_img_txt]['size'];
        $ct_image_type = $_FILES[$temp_img_txt]['type'];

        if($ct_image_name!="") {
            @unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
            $_POST[$temp_img_on_txt] = "ct_image_".$_POST['idx'].".".get_file_ext($ct_image_name);
            upload_file($ct_image, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
            //thumnail($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            //scale_image_fit($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000", "1000");
            thumnail_width($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", "1000");
        }
    } else {
        if($_POST[$temp_img_del_txt]) {
            unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
        }
    }
    $arr_query_img['ct_image'] = $_POST['ct_image_on'];

    $temp_img_txt = "ct_preview";
    $temp_img_on_txt = "ct_preview_on";
    $temp_img_temp_on_txt = "ct_preview_temp_on";
    $temp_img_del_txt = "ct_preview_del";
    if($_FILES[$temp_img_txt]['name']) {
        $ct_preview = $_FILES[$temp_img_txt]['tmp_name'];
        $ct_preview_name = $_FILES[$temp_img_txt]['name'];
        $ct_preview_size = $_FILES[$temp_img_txt]['size'];
        $ct_preview_type = $_FILES[$temp_img_txt]['type'];

        if($ct_preview_name!="") {
            @unlink($ct_preview_dir_a."/".$_POST[$temp_img_on_txt]);
            $_POST[$temp_img_on_txt] = "ct_file_preview_".$_POST['idx'].".".get_file_ext($ct_preview_name);
            upload_file($ct_preview, $_POST[$temp_img_on_txt], $ct_preview_dir_a."/");
            thumnail_width($ct_preview_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_preview_dir_a."/", "1000");
        }
    } else {
        if($_POST[$temp_img_del_txt]) {
            unlink($ct_preview_dir_a."/".$_POST[$temp_img_del_txt]);
        }
    }
    $arr_query_img['ct_preview'] = $_POST['ct_preview_on'];

    $temp_img_txt = "ct_file";
    $temp_img_on_txt = "ct_file_on";
    $temp_img_temp_on_txt = "ct_file_temp_on";
    $temp_img_del_txt = "ct_file_del";
    if($_FILES[$temp_img_txt]['name']) {
        $ct_file = $_FILES[$temp_img_txt]['tmp_name'];
        $ct_file_name = $_FILES[$temp_img_txt]['name'];
        $ct_file_size = $_FILES[$temp_img_txt]['size'];
        $ct_file_type = $_FILES[$temp_img_txt]['type'];

        if($ct_file_name!="") {
            $files = $_FILES[$temp_img_txt];
            $name = $files['name'];
            $tmpName = $files['tmp_name'];
            $size = $files['size'];
            $extension = explode('.', $files['name']);
            $extension = strtolower(end($extension));
            $key = "ct_file_" . $_POST['idx'] . "." . get_file_ext($ct_file_name);
            $tmp_file_name = "{$key}.{$extension}";
            $tmp_file_path = $_SERVER['DOCUMENT_ROOT'] . "/data/{$tmp_file_name}";
            move_uploaded_file($tmpName, $tmp_file_path);

            $uploader = new MultipartUploader($s3, $tmp_file_path, [
                'bucket' => $bucket,
                'key' => $key,
            ]);

            do {
                try {
                    $result = $uploader->upload();
                    if(file_exists($_SERVER['DOCUMENT_ROOT']."/data/preview/ct_file_preview_" . $_POST['idx'] . ".mp4")) {
                        unlink($_SERVER['DOCUMENT_ROOT'] . "/data/preview/ct_file_preview_" . $_POST['idx'] . ".mp4");
                    }
                    if ($_FILES['ct_preview']['name'] == "") {
                        if (get_file_ext($ct_file_name) == "mov") {
                            exec("ffmpeg -ss 00:00:00 -i " . $_SERVER['DOCUMENT_ROOT'] . "/data/" . $tmp_file_name . " -to 00:00:15 -vcodec h264 -acodec mp2 " . $_SERVER['DOCUMENT_ROOT'] . "/data/preview/ct_file_preview_" . $_POST['idx'] . ".mp4");
                        } else {
                            exec("ffmpeg -ss 00:00:00 -i " . $_SERVER['DOCUMENT_ROOT'] . "/data/" . $tmp_file_name . " -t 00:00:15 -c:v libx265 -crf 26 -preset fast -c:a aac -b:a 128k " . $_SERVER['DOCUMENT_ROOT'] . "/data/preview/ct_file_preview_" . $_POST['idx'] . "." . get_file_ext($ct_file_name));
                        }
                        $arr_query_img['ct_preview_file'] = "Y";
                    }
//                  echo "Upload complete: {$result['ObjectURL']}\n";
                    unlink($tmp_file_path);
                } catch (MultipartUploadException $e) {
//                  echo $e->getMessage() . "\n";
                }
            } while (!isset($result));

            fclose($tmp_file_path);
        }
        $_POST[$temp_img_on_txt] = "ct_file_".$_POST['idx'].".".get_file_ext($ct_file_name);
    } else {
        if(!file_exists($_SERVER['DOCUMENT_ROOT']."/data/preview/ct_file_preview_" . $_POST['idx']. ".mp4")) {
            if($_POST['ct_status'] == 2) {
                $row = $DB->fetch_assoc("select * from contents_t where idx = " . $_POST['idx']);
                if ($row) {
                    if ($row['ct_preview'] == "") {
                        if ($row['ct_format'] == "mov") {
                            exec("ffmpeg -ss 00:00:00 -i " . $_SERVER['DOCUMENT_ROOT'] . "/data/" . $row['ct_file'] . "  -to 00:00:15 -c:v libx265 -crf 26 -preset fast -c:a aac -b:a 128k " . $_SERVER['DOCUMENT_ROOT'] . "/data/preview/ct_file_preview_" . $_POST['idx'] . "." . $row['ct_format']);
                            exec("ffmpeg -ss 00:00:00 -i " . $_SERVER['DOCUMENT_ROOT'] . "/data/" . $row['ct_file'] . " -t 00:00:15 -c copy " . $_SERVER['DOCUMENT_ROOT'] . "/data/preview/ct_file_preview_" . $_POST['idx'] . ".mp4");
                            unlink($_SERVER['DOCUMENT_ROOT'] . "/data/preview/ct_file_preview_" . $_POST['idx'] . "." . $row['ct_format']);
                        } else {
                            exec("ffmpeg -ss 00:00:00 -i " . $_SERVER['DOCUMENT_ROOT'] . "/data/" . $row['ct_file'] . " -t 00:00:15 -c:v libx265 -crf 26 -preset fast -c:a aac -b:a 128k " . $_SERVER['DOCUMENT_ROOT'] . "/data/preview/ct_file_preview_" . $_POST['idx'] . "." . $row['ct_format']);
                        }
                        unlink($_SERVER['DOCUMENT_ROOT'] . "/data/" . $row['ct_file']);
                    }
                }
                $arr_query_img['ct_file'] = $_POST['ct_file_on'];
                $arr_query_img['ct_preview_file'] = "Y";

                $DB->update_query('contents_t', $arr_query_img, "idx = " . $_POST['idx']);
            }
        }
    }

    p_alert("변경 내용으로 저장되었습니다!");
} else if($_POST['act']=='delete') {
    if($_POST['idx']) {
        $query = "select * from contents_t where idx = ".$_POST['idx'];
        $row = $DB->fetch_assoc($query);
        if($row) {
            @unlink($ct_img_dir_a . "/" . $row['ct_image']);
            @unlink("../data/preview/ct_file_preview_". $row['idx'].".mp4");

            $toDelete_img_list = array();

            array_push($toDelete_img_list, array('Key' => $row['ct_file']));

            $objects = array('Objects' => $toDelete_img_list);

            $result = $s3->deleteObjects(Array(
                'Bucket' => $bucket,
                'Delete' => $objects
            ));
            if($result['@metadata']['statusCode'] == 200) {
                $DB->del_query('contents_t', " idx = '".$_POST['idx']."'");
            } else {
                echo json_encode(array("result" => "false", "msg" => "처리할 수 없습니다."));
                exit;
            }
            echo json_encode(array("result" => "ok", "msg" => "삭제되었습니다."));
        } else {
            echo json_encode(array("result" => "false", "msg" => "처리할 수 없습니다."));
        }
    } else {
        echo json_encode(array("result" => "false", "msg" => "처리할 수 없습니다."));
    }
} else if($_POST['act']=='popup_image') {
    ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="slider" id="product-swiper">
            <?
            $query = "
					select * from contents_t
					where idx = '".$_POST['idx']."'
				";
            $row = $DB->fetch_query($query);
            ?>
                <div class="m-2" style="width: 100%;"><img src="<?=$ct_img_url."/".$row['ct_image']?>" onerror="this.src='<?=$ct_member_no_img_url?>'" class="product-swipe"></div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("li.slick-active").hide();
        });
    </script>
<?
} else if($_POST['act']=='save_approve_memo') {
    if($_POST['idx']) {
        unset($arr_query);
        $arr_query = array(
            "ct_approve_memo" => $_POST['ct_approve_memo'],
            "ct_status" => 3,
            "ct_audate" => "now()",
            "ct_udate" => "now()",
        );

        $where_query = "idx = '".$_POST['idx']."'";

        $query = "select *, (SELECT mt_nickname FROM member_t WHERE idx=mt_idx) as mt_nickname from contents_t where idx = ".$_POST['idx'];
        $info = $DB->fetch_assoc($query);

        $DB->update_query('contents_t', $arr_query, $where_query);

        if($info['ct_status'] != 3) {
            $DB->insert_query("pushnotification_log_t", array("plt_title" => "‘" . $info['mt_nickname'] . "’님의 ‘" . $info['ct_title'] . "’가 ‘".$_POST['ct_approve_memo']."’로 거절되었습니다. ", "plt_type" => 3, "op_idx" => $info['mt_idx'], "plt_page" => "artist_my_contents.php", "plt_wdate" => "now()"));
        }
        echo json_encode(array("result" => "ok", "msg" => "승인 반려사유가 저장되었습니다!"));
    } else {
        echo json_encode(array("result" => "false", "msg" => "처리할 수 없습니다."));
    }
} else if($_POST['act'] == "get_category") {
    $query = "select * from category_t where ct_p_idx = ".$_POST['idx'];
    $list = $DB->select_query($query);
    if($list) {
        $html = '<option value="" selected="">선택</option>';
        foreach ($list as $row) {
            $html .= "<option value='".$row['idx']."'>".$row['ct_name']."</option>";
        }
    }
    echo json_encode(array("result" => "ok", "data" => $html));
} else if($_POST['act']=='popup_image2') {
    ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="slider" id="product-swiper">
            <?
            $query = "
					select * from contents_t
					where idx = '".$_POST['idx']."'
				";
            $row = $DB->fetch_query($query);

            $key = $row['ct_file'];
            $cmd = $s3->getCommand('GetObject', [
                'Bucket' => $bucket,
                'Key' => $key
            ]);
            $request = $s3->createPresignedRequest($cmd, '+20 minutes');
            $presignedUrl = (string)$request->getUri();

            $url = explode("https://bucket.object.ncloudstorage.com/", $presignedUrl);
            $url = $url[1];
            ?>
            <div class="m-2" style="width: 100%;"><img src="https://url.gcdn.ntruss.com/<?=$url?>" onerror="this.src='<?=$ct_member_no_img_url?>'" class="product-swipe"></div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("li.slick-active").hide();
        });
    </script>
<?
} else if($_POST['act']=="status_chg") {
    if($_POST['idx']=='') {
        echo json_encode(array("result" => "N"));
    } else {
        $idx_ex = explode("|", $_POST['idx']);
        try {
            foreach ($idx_ex as $val) {
                if ($val) {
                    $DB->update_query("contents_t", array("ct_status" => 4, "ct_udate" => "now()", "ct_audate" => "now()"), "idx = ".$val);
                }
            }
            echo json_encode(array("result" => "Y"));
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }
}

include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>