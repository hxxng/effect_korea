<?php
require $_SERVER['DOCUMENT_ROOT'].'/lib/aws/vendor/autoload.php';
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

if($member_info['idx'] < 1) {
    p_alert('로그인 후 이용가능한 서비스입니다.', '/');
    exit;
} else {
    $query = "select * from cart_t where ot_pcode = '" . $_GET['ot_pcode'] . "' and ct_select = 2 and ct_status = 2";
    $cart = $DB->fetch_assoc($query);
    if ($cart['mt_idx'] != $member_info['idx']) {
        p_alert('실제로 구매한 사용자가 아닙니다.', '/');
        exit;
    }
}

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$bucket = 'bucket';
$keyname = $_GET['s'];
$keyname = explode("?",$keyname);
$keyname = $keyname[0];

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

try {
    $result = $s3->getObject([
        'Bucket' => $bucket,
        'Key'    => $keyname
    ]);

    header("Content-Type: {$result['ContentType']}");
    header("Content-Disposition: attachment; filename=".basename($keyname));
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$result['ContentLength']);
    header("Cache-Control: cache, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");
    echo $result['Body'];
} catch (S3Exception $e) {
//    echo $e->getMessage() . PHP_EOL;
    if($_GET['type'] == "artist") {
        $url = "/artist_my_orderlist.php";
    } else if($_GET['type'] == "success") {
        $url = "/";
    } else {
        $url = "/my_orderlist.php";
    }
    echo "<script type=\"text/javascript\">
					alert('다운로드 할 수 없습니다.');parent.document.location.href = '".$url."';
        </script>";
}
exit();
?>