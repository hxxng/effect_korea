<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
include $_SERVER['DOCUMENT_ROOT']."/lib/http.class.php";
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

$http = new http;

$type = $_POST['type'];
$ct_img_dir_a = $_SERVER['DOCUMENT_ROOT'] . "/images/uploads";
$ct_preview_dir_a = $_SERVER['DOCUMENT_ROOT'] . "/data/preview";

if($type == "pay_info_update") {
    $arr = array(
        "mt_local" => $_POST['mt_local'],
        "mt_nationality" => $_POST['mt_nationality'],
        "mt_firstname" => $_POST['mt_firstname'],
        "mt_lastname" => $_POST['mt_lastname'],
        "mt_international_num" => $_POST['mt_international_num'],
        "mt_hp" => $_POST['mt_hp'],
        "mt_email" => $_POST['mt_email'],
        "mt_udate" => "now()",
        "mt_first_info" => "Y",
    );
    $DB->update_query("member_t", $arr, "idx = ".$_SESSION['_mt_idx']);
    p_alert("등록되었습니다.","/membership.php");
} else if($type == "chg_pw") {
    $pwd = password_hash($_POST['mt_pwd'], PASSWORD_DEFAULT);

    unset($arr_query);
    $arr_query = array(
        "mt_pwd" => $pwd,
        "mt_udate" => "now()",
    );
    $DB->update_query('member_t', $arr_query, "idx = ".$_POST['mt_idx']);
    echo json_encode(array("result" => "_ok"));
} else if($type == "chg_hp") {
    unset($arr_query);
    $arr_query = array(
        "mt_hp" => $_POST['mt_hp'],
        "mt_udate" => "now()",
    );
    $DB->update_query('member_t', $arr_query, "idx = ".$_POST['mt_idx']);
    echo json_encode(array("result" => "_ok"));
} else if($type == "retire") {
    if($_SESSION['_mt_level'] == 3) {
        $mt_level = 1;
    } else if($_SESSION['_mt_level'] == 5) {
        $mt_level = 2;
    }
    unset($arr_query);
    $arr_query = array(
        "mt_level" => $mt_level,
        "mt_status" => "N",
        "mt_rdate" => "now()",
        "mt_udate" => "now()",
        "mt_login_status" => "N",
        "mt_first_info" => "N",
    );
    $DB->update_query('member_t', $arr_query, "idx = ".$_POST['mt_idx']);
    echo json_encode(array("result" => "_ok"));
} else if($type == "profile_update") {
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
        "mt_udate" => "now()",
    );
    $DB->update_query('member_t', $arr_query, "idx = ".$_SESSION['_mt_idx']);

    gotourl("/artist_my.php");
} else if($type == 'chk_nickname') {
    $query = "select * from member_t where mt_level in (3,5) and mt_nickname = '" . $_POST['mt_nickname'] . "' and idx <> ".$_SESSION['_mt_idx'];
    $list = $DB->fetch_assoc($query);
    if($list) {
        echo json_encode(array('result' => 'false'));
    } else {
        echo json_encode(array('result' => 'ok'));
    }
} else if($type == "get_category") {
    $query = "select * from category_t where ct_p_idx = ".$_POST['idx'];
    $list = $DB->select_query($query);
    if($list) {
        $html = '<option value="" selected="">선택</option>';
        foreach ($list as $row) {
            $html .= "<option value='".$row['idx']."'>".$row['ct_name']."</option>";
        }
    }
    echo json_encode(array("result" => "ok", "data" => $html));
} else if($type == 'input') {
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
    unset($arr_query);
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
    $arr_query = array(
        "mt_idx" => $_SESSION['_mt_idx'],
        "ct_status" => 1,
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
        "ct_adate" => "now()",
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

    $query = "select * from member_t where idx = ".$_SESSION['_mt_idx'];
    $member = $DB->fetch_assoc($query);

    $DB->insert_query("pushnotification_log_t", array("plt_title" => "‘".$member['mt_nickname']."’님의 ‘".$_POST['ct_title']."’가 업로드 되었습니다. 관리자 승인까지 7일정도 소요됩니다.", "plt_type" => 1, "op_idx" => $_SESSION['_mt_idx'], "plt_page" => "artist_my_contents.php","plt_wdate" => "now()"));

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
//                  echo "Upload complete: {$result['ObjectURL']}\n";
                } catch (MultipartUploadException $e) {
//                  echo $e->getMessage() . "\n";
                }
            } while (!isset($result));
        }
        $_POST[$temp_img_on_txt] = "ct_file_".$_last_idx.".".get_file_ext($ct_file_name);
    } else {
        if($_POST[$temp_img_del_txt]) {
            unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
        }
    }
    $arr_query_img['ct_file'] = $_POST['ct_file_on'];

    $DB->update_query('contents_t', $arr_query_img, "idx = ".$_last_idx);

    p_alert("정상적으로 등록 되었습니다.", "/artist_my_contents.php");
} else if($type == "contents_update") {
    unset($arr_query);
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
    $arr_query = array(
        "ct_show" => $_POST['ct_show'],
        "ct_filter" => $_POST['ct_filter'],
        "ct_editorial" => $_POST['ct_editorial'],
        "ct_resolution" => $_POST['ct_resolution'],
        "ct_program" => $_POST['ct_program'],
        "ct_price" => $_POST['ct_price'],
        "ct_exclusive" => $_POST['ct_exclusive'],
        "ct_udate" => "now()",
    );
    $DB->update_query("contents_t", $arr_query, "idx = ".$_POST['ct_idx']);

    if($_POST['ct_keyword'] != "") {
        $query = "select * from contents_keyword_t where ct_idx = ".$_POST['ct_idx'];
        $translate = $DB->fetch_assoc($query);
        if($translate) {
            $DB->del_query("contents_keyword_t", "ct_idx = ".$_POST['ct_idx']);
        }
        $keyword = explode(" ", $_POST['ct_keyword']);
        if($keyword) {
            foreach ($keyword as $row) {
                $DB->insert_query("contents_keyword_t", array("ct_idx" => $_POST['ct_idx'], "ct_korean" => $row, "ct_english" => translate($row), "ct_wdate" => "now()"));
            }
        }
    } else {
        $DB->del_query("contents_keyword_t", "ct_idx = ".$_POST['ct_idx']);
    }

    p_alert("수정되었습니다", "/artist_my_contents_detail.php?ct_idx=".$_POST['ct_idx']);
} else if($type=='delete') {
    if($_POST['idx']) {
        $query = "select * from contents_t where idx = ".$_POST['idx'];
        $row = $DB->fetch_assoc($query);
        if($row) {
            @unlink($ct_img_dir_a . "/" . $row['ct_image']);
            @unlink($ct_preview_dir_a."/ct_file_preview_". $row['idx'].".mp4");

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
} else if($type == "settlement") {
    $query = "select a1.*, a2.*, a2.ct_price as cart_price,
            (SELECT ct_name FROM category_t WHERE a3.ct_cate_idx=idx) as ct_cate, (SELECT ct_name FROM category_t WHERE a3.ct_cate_idx2=idx) as ct_cate2
            from order_t a1
            left join cart_t a2 on a2.ot_code = a1.ot_code
            left join contents_t a3 on a3.idx = a2.ct_idx
            where a3.mt_idx = " . $_SESSION['_mt_idx'] . " and ot_status = 2 and ot_pdate > any (select max(ct_cedate) from calculate_t) and ot_pdate <= now() order by a1.ot_pdate
    ";
    unset($list);
    $sql_query = $query;
    $list = $DB->select_query($sql_query);
    $date = $DB->fetch_assoc($query);

    $query = "select * from setting_t where idx = 1";
    $setting = $DB->fetch_assoc($query);

    if($list) {
        foreach ($list as $row) {
            $query = "select * from calculate_t where ct_cdate <= '".$row['ot_pdate']."' and ct_cedate >= '".$row['ot_pdate']."' and mt_idx = ".$_SESSION['_mt_idx'];
            $settlement = $DB->fetch_assoc($query);
            if(!$settlement) {
                if($row['ot_pay_type'] == 6) {
                    if($row['ot_point'] > 0) {
                        if ($row['mt_type'] == 1 || $row['mt_type'] == 3) {
                            $price = ($arr_membership_price[$row['mt_type']] * 0.7) * ($row['ct_point'] / $row['ot_point']);
                        } else {
                            $price = ($arr_membership_price[$row['mt_type']] / 12 * 0.7) * ($row['ct_point'] / $row['ot_point']);
                        }
                    } else {
                        $price = 0;
                    }
                } else {
                    $price = $row['cart_price'];
                    $price = $price + ($price * 0.1);
                }
                $sum += $price;
            }
        }
        $sum_price += $sum - ($sum * 0.1);
        $ct_service_comm += $sum * ($setting['st_service_comm'] / 100);
        $ct_pay_comm += $sum * ($setting['st_pay_comm'] / 100);
    }

    $arr = array(
        "mt_idx" => $_SESSION['_mt_idx'],
        "ct_status" => 2,
        "ct_price" => floor($sum_price),
        "ct_price2" => floor($sum_price),
        "ct_service_comm" => floor($ct_service_comm),
        "ct_pay_comm" => floor($ct_pay_comm),
        "ct_rdate" => "now()",
        "ct_wdate" => "now()",
        "ct_cdate" => $date['ot_pdate'],
        "ct_cedate" => "now()",
    );
    $DB->insert_query("calculate_t", $arr);

    $DB->insert_query("pushnotification_log_t", array("plt_title" => "정산신청이 완료되었습니다. 정산은 ‘n일’에 처리됩니다.", "plt_type" => 4, "op_idx" => $_SESSION['_mt_idx'], "plt_page" => "artist_my_calc.php", "plt_wdate" => "now()"));

    echo json_encode(array("result" => "ok"));
} else if($type == "1won") {
    //유즈비 1원 계좌이체 테스트
    //토큰생성
    $query['email'] = 'email';
    $query['password'] = 'password';
    $getToken = $http->PostMethodData('https://auth.useb.co.kr/oauth/token', $query, $mReferer, '', $mCookie, true);
    $getTokenJson = json_decode($getToken, true);

    //1원이체
    $query2['bank_code'] = $_POST['bank_code'];
    $query2['account_num'] = $_POST['account_num'];
    $query2['account_holder_name'] = $_POST['account_holder_name'];
    $query2['code_type'] = 'number';
    $getResponse = $http->PostMethodData('https://openapi.useb.co.kr/send', $query2, $mReferer, '', $mCookie, true, '', $getTokenJson['jwt']);
    $getResponseJson = json_decode($getResponse, true);
    if($getResponseJson['success']) {
        $DB->insert_query("send_1won_t", array("mt_idx" => $_SESSION['_mt_idx'], "transaction_id" => $getResponseJson['transaction_id'], "smt_wdate" => "now()"));
        $DB->update_query("member_t", array("mt_bank" => $_POST['bank_code'], "mt_account" => $_POST['account_num'], "mt_account_name" => $_POST['account_holder_name'], "mt_udate" => "now()"), "idx = ".$_SESSION['_mt_idx']);
        echo json_encode(array("result" => "ok"));
    } else {
        echo json_encode(array("result" => "false", "msg" => $getResponseJson['message']));
    }
} else if($type == "1won_2") {
    //토큰생성
    $query['email'] = 'email';
    $query['password'] = 'password';
    $getToken = $http->PostMethodData('https://auth.useb.co.kr/oauth/token', $query, $mReferer, '', $mCookie, true);
    $getTokenJson = json_decode($getToken, true);

    //1원 이체 확인
    $row = $DB->fetch_assoc("select * from send_1won_t where mt_idx = ".$_SESSION['_mt_idx']." order by smt_wdate desc limit 1");

    $query2['transaction_id'] = $row['transaction_id'];     //DB에 transaction id 저장
    $query2['print_content'] = $_POST['code'];                                  //사용자에게 입력받는 값
    $getResponse = $http->PostMethodData('https://openapi.useb.co.kr/verify', $query2, $mReferer, '', $mCookie, true, '', $getTokenJson['jwt']);
    $getResponseJson = json_decode($getResponse, true);
    if($getResponseJson['success']) {
        $DB->update_query("member_t", array("mt_account_status" => "Y", "mt_udate" => "now()"), "idx = ".$_SESSION['_mt_idx']);
        echo json_encode(array("result" => "ok"));
    } else {
        $DB->update_query("member_t", array("mt_account_status" => "N", "mt_udate" => "now()"), "idx = ".$_SESSION['_mt_idx']);
        echo json_encode(array("result" => "false", "msg" => $getResponseJson['message']));
    }
} else if($type == "del_account") {
    $DB->update_query("member_t", array("mt_account_status" => "N", "mt_bank" => "", "mt_account" => "", "mt_account_name" => "", "mt_udate" => "now()"), "idx = ".$_SESSION['_mt_idx']);
    echo json_encode(array("result" => "ok"));
}

?>