<?php
$title = "결제완료";

include_once("./inc/head.php");
include_once("./inc/nav.php");
include $_SERVER['DOCUMENT_ROOT']."/lib/Mall_class.php";
require $_SERVER['DOCUMENT_ROOT'].'/lib/aws/vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;

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

$info= lang("info", $_lang, "order");
$order_code = lang("order_code", $_lang, "order");
$contents_code = lang("contents_code", $_lang, "order");
$content_download = lang("content_download", $_lang, "order");
$download_btn = lang("download", $_lang, "order");
$download_x = lang("download_x", $_lang, "order");
$pay_success = lang("pay_success", $_lang, "order");
$confirm = lang("confirm", $_lang, "order");
$go_list = lang("go_list", $_lang, "order");

$pay_info = lang("pay_info", $_lang, "order");
$pay_date = lang("pay_date", $_lang, "order");
$pay_status = lang("pay_status", $_lang, "order");
$pay_list = lang("pay_list", $_lang, "order");
$contents_price = lang("contents_price", $_lang, "order");
$vat = lang("vat", $_lang, "order");
$pay_price = lang("pay_price", $_lang, "order");
$card = lang("card", $_lang, "order");
$pay_method = lang("pay_method", $_lang, "order");
$customer_info = lang("customer_info", $_lang, "order");
$foriener = lang("foriener", $_lang, "order");
$nationality = lang("nationality", $_lang, "order");
$name2 = lang("name", $_lang, "order");
$hp = lang("hp", $_lang, "order");
$email = lang("email", $_lang, "order");
$list_btn = lang("list_btn", $_lang, "order");

if($member_info['idx'] < 1) {
    p_alert('로그인 후 이용가능한 서비스입니다.', '/');
    exit;
}
$objMall = new Mall_class(array('db'=>$DB, 'mt_idx'=>$_SESSION['_mt_idx']));
$result = $objMall->complete($_GET['ot_code']);
$order = $result['order'];
$cart = $result['cart'];

foreach($cart as $row){
    $product_amount += ($row['ct_price']);
}

$timestamp = strtotime("+2 weeks", strtotime($order['ot_pdate']));
$download = date("Y-m-d", $timestamp);

$codes_arr = get_nationality();
$phone_arr = get_international_num();
?>

<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="order_box">
                    <lottie-player src="img/lottie_success.json" class="lottie" background="transparent"  speed="1" autoplay loop></lottie-player>
                    <div class="order_success">
                        <div class="success_tit fw_600"><?=$pay_success?></div>
                        <p><?=$info?></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-primary form_l" onclick="location.href='/'"><?=$confirm?></button>
                        <button type="button" class="btn btn-primary form_r" onclick="location.href='/my_orderlist.php'"><?=$go_list?></button>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="order_hd">
                    <span class="fw_500"><?=DateType($order['ot_pdate'])?></span><span class="cart_del">(<?=$order_code?>: <?=$order['ot_code']?>)</span>
                </div>
                <ul class="order_list">
                    <?php foreach ($cart as $row) {
                        $query = "select *, (SELECT ct_name FROM category_t WHERE idx=ct_cate_idx2) as ct_name, 
                                (SELECT mt_nickname FROM member_t WHERE idx=mt_idx) as mt_nickname, (SELECT mt_image FROM member_t WHERE idx=mt_idx) as mt_image 
                                from contents_t 
                                where idx = ".$row['ct_idx']." and ct_status = 2 and ct_show = 'Y'";
                        $content = $DB->fetch_assoc($query);
                        if($content) {
                            if($content['mt_image']) {
                                $mt_image = $ct_img_url."/".$content['mt_image'];
                            } else {
                                $mt_image = $ct_member_no_img_url;
                            }
                    ?>
                    <li>
                        <div class="order_cont_box">
                            <div class="cart_thumbs video_list square rectangle">
                                <img src="<?=$ct_img_url."/".$row['ct_image']?>" alt="">
                            </div>
                        </div>
                        <div class="order_cont_box1">
                            <a class="cart_cont" href="/contents_list.php?ct_type=<?=$content['ct_type']?>&ct_idx=<?=$content['ct_cate_idx2']?>&idx=<?=$content['idx']?>" style="width: 46%;">
                                <div class="cart_cate"><?=$content['ct_name']?></div>
                                <h4 class="cart_tit ff_play"><?=$content['ct_title']?></h4>
                                <div class="cart_artist">
                                    <div class="square"><img src="<?=$mt_image?>" alt=""></div>
                                    <span class="at_name"><?=$content['mt_nickname']?></span>
                                </div>
                                <div class="cart_op cart_de"><span class="badge badge-secondary fw_600"><?=$content['ct_resolution']?></span><span class="c_reso"><?=$arr_resolution2[$content['ct_resolution']]?></span></div>
                                <p class="cart_order"><?=$contents_code?> : <?=$row['ot_pcode']?></p>
                            </a>
                            <div class="order_cont cart_price">
                                <?
                                if($_SESSION['_lang'] == "en") {
                                    ?>
                                    <span class="price ff_play">$<?=number_format($row['ct_price'],2)?></span>
                                    <?
                                } else {
                                    ?>
                                    <span class="price ff_play"><?=number_format($row['ct_price'])?></span>원
                                    <?
                                }
                                ?>
                            </div>
                            <div class="order_cont">
                                <p><?=$content_download?> : <br/><?=$download?></p>
                            </div>
                            <div class="order_cont">
                                <?
                                if(date("Y-m-d", strtotime("+2 weeks", strtotime($order['ot_pdate']))) < date("Y-m-d", time())) {
                                    ?>
                                    <button type="button" class="btn btn-secondary btn_down_exp fc_dgray" style="cursor:pointer;"><?=$download_x?></button>
                                    <?
                                } else {
                                    $key = $content['ct_file'];
                                    $cmd = $s3->getCommand('GetObject', [
                                        'Bucket' => $bucket,
                                        'Key' => $key,
                                    ]);
                                    $request = $s3->createPresignedRequest($cmd, '+5 minutes');
                                    $presignedUrl = (string)$request->getUri();

                                    $url = explode("https://bucket.object.ncloudstorage.com/", $presignedUrl);
                                    $url = $url[1];
                                    ?>
                                    <a href="/download.php?type=success&ot_pcode=<?=$row['ot_pcode']?>&s=<?=$url?>">
                                        <button type="button" class="btn btn-outline-primary btn_download"><?=$download_btn?></button>
                                    </a>
                                    <?
                                }
                                ?>
                            </div>
                        </div>
                    </li>
                    <?
                            $count++;
                            $sum += $row['ct_price'];
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="col-12 col-lg-6">
                <div class="info_box">
                    <div class="info_tit fw_600"><?=$pay_info?></div>
                    <ul class="list_style_1">
                        <li>
                            <span><?=$pay_date?></span>
                            <p><?=$order['ot_pdate']?></p>
                        </li>
                        <li>
                            <span><?=$pay_status?></span>
                            <p><? if($order['ot_status'] == 2) echo "결제완료"; else echo '결제취소'; ?></p>
                        </li>
                        <li>
                            <span><?=$pay_list?></span>
                            <p><?=$count?>개</p>
                        </li>
                        <li>
                            <span><?=$contents_price?></span>
                            <?
                            if($_SESSION['_lang'] == "en") {
                                ?>
                                <p>$<?=number_format($sum,2)?></p>
                                <?
                            } else {
                                ?>
                                <p><?=number_format($sum)?>원</p>
                            <?
                            }
                            ?>
                        </li>
                        <li>
                            <span><?=$vat?></span>
                            <?
                            if($_SESSION['_lang'] == "en") {
                                ?>
                                <p>$<?=number_format($order['ot_vat'],2)?></p>
                                <?
                            } else {
                                ?>
                                <p><?=number_format($order['ot_vat'])?>원</p>
                                <?
                            }
                            ?>
                        </li>
                        <li>
                            <span><?=$pay_price?></span>
                            <?
                            if($_SESSION['_lang'] == "en") {
                                ?>
                                <p>$<?=number_format($order['ot_price'],2)?></p>
                                <?
                            } else {
                                ?>
                                <p><?=number_format($order['ot_price'])?>원</p>
                                <?
                            }
                            ?>
                        </li>
                        <li>
                            <span><?=$pay_method?></span>
                            <p><?=$card?></p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="info_box">
                    <div class="info_tit fw_600"><?=$customer_info?></div>
                    <ul class="list_style_1">
                        <li>
                            <span><?=$foriener?></span>
                            <p><? if($member_info['mt_local'] == 1) echo "내국인"; else echo '외국인'; ?></p>
                        </li>
                        <li>
                            <span><?=$nationality?></span>
                            <p><?=$codes_arr[$member_info['mt_nationality']]?></p>
                        </li>
                        <li>
                            <span><?=$name2?></span>
                            <p><?=$member_info['mt_firstname']." ".$member_info['mt_lastname']?></p>
                        </li>
                        <li>
                            <span><?=$hp?></span>
                            <p><?=$member_info['mt_hp']?></p>
                        </li>
                        <li>
                            <span><?=$email?></span>
                            <p><?=$member_info['mt_email']?></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>