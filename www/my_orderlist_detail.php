<?php
$title = "구매내역";

include_once("./inc/head.php");
include_once("./inc/nav.php");
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

$_lang = $_SESSION['_lang'];

if($member_info['idx'] < 1) {
    p_alert('로그인 후 이용가능한 서비스입니다.', '/');
    exit;
}
$mypage = lang("mypage", $_lang, "mypage");
$info_update = lang("info_update", $_lang, "mypage");
$home = lang("home", $_lang, "mypage");
$subscription = lang("subscription", $_lang, "mypage");
$order2 = lang("order", $_lang, "mypage");
$favorites = lang("favorites", $_lang, "mypage");
$artist = lang("artist", $_lang, "mypage");
$days = lang("days", $_lang, "mypage");
$direct_input = lang("direct_input", $_lang, "mypage");

$info= lang("info", $_lang, "order");
$whole = lang("whole", $_lang, "order");
$select_del = lang("select_del", $_lang, "order");
$order_code = lang("order_code", $_lang, "order");
$contents_code = lang("contents_code", $_lang, "order");
$content_download = lang("content_download", $_lang, "order");
$download = lang("download", $_lang, "order");
$download_x = lang("download_x", $_lang, "order");
$detail = lang("detail", $_lang, "order");
$del = lang("del", $_lang, "order");

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

$name = lang("name", $_lang, "mypage");
if($member_info['mt_firstname'] == "") {
    $name2 = lang("no_name", $_lang, "mypage");
    if($_lang == "en") {
        $name = $name.$name2;
    } else {
        $name = $name2.$name;
    }
} else {
    if($_lang == "en") {
        $name = $name.$member_info['mt_firstname'];
    } else {
        $name = $member_info['mt_firstname'].$name;
    }
}

$_get_txt = "search_date=".$_GET['search_date']."&s_date=".$_GET['s_date']."&e_date=".$_GET['e_date']."&pg=".$_GET['pg'];

$query = "select * from order_t where mt_idx = ".$member_info['idx']." and ot_code = '".$_GET['ot_code']."'";
$order = $DB->fetch_assoc($query);

$query = "select * from order_t left join cart_t on cart_t.ot_code = order_t.ot_code where order_t.mt_idx = ".$member_info['idx']." and order_t.ot_code = '".$_GET['ot_code']."'";
$list_p = $DB->select_query($query);

$codes_arr = get_nationality();
?>
    <div class="wrap">
        <div class="container">
            <div class="row">
                <div class="col-12 my-5">
                    <div class="wr_tit1">
                        <h2><?=$mypage?></h2>
                    </div>
                    <div class="order_hd mp_hd d-flex justify-content-between align-items-center">
                        <h3 class="fw_600"><?=$name?></h3>
                        <button type="button" class="cart_del" onclick="location.href='my_info.php';"><img src="img/ic_modify.png" alt=""><?=$info_update?></button>
                    </div>
                    <ul class="t_menu">
                        <li><a href="/my_subscription.php"><?=$subscription?></a></li>
                        <li class="t_active"><a href="/my_orderlist.php"><?=$order2?></a></li>
                        <li><a href="/my_like.php"><?=$favorites?></a></li>
                        <li><a href="/my_request.php"><?=$artist?></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="member_caution">
                        <p class="caution fw_600"><img src="img/ic_caution.png" alt=""> <?=$info?></p>
                    </div>
                    <div class="mp_order_detail">
                        <div class="order_hd d-flex justify-content-between align-items-center">
                            <div class="mp_chk_label">
                                <input type="hidden" id="ot_code" value="<?=$order['ot_code']?>"/>
                                <span class="fw_500 order_hd_fs"><?=DateType($order['ot_pdate'])?></span><span class="order_hd_fs2">(<?=$contents_code?>: <?=$order['ot_code']?>)</span>
                            </div>
                            <button type="button" class="cart_del" onclick="del_order()"><img src="img/ic_del.png" alt=""><?=$del?></button>
                        </div>
                        <ul class="order_list">
                            <?
                            if($list_p) {
                                foreach ($list_p as $row_p) {
                                    $query_p = "select *, (SELECT ct_name FROM category_t WHERE idx=ct_cate_idx2) as ct_name, 
                                                            (SELECT mt_nickname FROM member_t WHERE idx=mt_idx) as mt_nickname, (SELECT mt_image FROM member_t WHERE idx=mt_idx) as mt_image 
                                                            from contents_t 
                                                            where idx = ".$row_p['ct_idx'];
                                    $c_info = $DB->fetch_assoc($query_p);
                                    if($c_info['mt_image']) {
                                        $mt_image = $ct_img_url."/".$c_info['mt_image'];
                                    } else {
                                        $mt_image = $ct_member_no_img_url;
                                    }
                                    ?>
                                    <li>
                                        <div class="order_cont_box">
                                            <div class="cart_thumbs video_list square rectangle">
                                                <img src="<?=$ct_img_url.'/'.$c_info['ct_image']?>" alt="">
                                            </div>
                                        </div>
                                        <div class="order_cont_box1">
                                            <a class="cart_cont" href="/contents_list.php?ct_type=<?=$c_info['ct_type']?>&ct_idx=<?=$c_info['ct_cate_idx2']?>&idx=<?=$c_info['idx']?>">
                                                <div class="cart_cate"><?=$c_info['ct_name']?></div>
                                                <h4 class="cart_tit ff_play"><?=$c_info['ct_title']?></h4>
                                                <div class="cart_artist">
                                                    <div class="square"><img src="<?=$mt_image?>" alt=""></div>
                                                    <span class="at_name"><?=$c_info['mt_nickname']?></span>
                                                </div>
                                                <div class="cart_op cart_de"><span class="badge badge-secondary fw_600"><?=$c_info['ct_resolution']?></span><span class="c_reso"><?=$arr_resolution2[$c_info['ct_resolution']]?></span></div>
                                                <p class="cart_order"><?=$contents_code?> : <?=$row_p['ot_pcode']?></p>
                                            </a>
                                            <div class="order_cont cart_price">
                                                <?
                                                if($_SESSION['_lang'] == "en") {
                                                    ?>
                                                    $<span class="price ff_play"><?=number_format($row_p['ct_price'],2)?></span>
                                                    <?
                                                } else {
                                                    ?>
                                                    <span class="price ff_play"><?=number_format($row_p['ct_price'])?></span>원
                                                    <?
                                                }
                                                ?>
                                            </div>
                                            <div class="order_cont">
                                                <p><?=$content_download?> :
                                                    <?=date("Y-m-d", strtotime("+2 weeks", strtotime($row_p['ot_pdate'])))?></p>
                                            </div>
                                            <div class="order_cont mp_down_cont">
                                                <?
                                                if(date("Y-m-d", strtotime("+2 weeks", strtotime($row_p['ot_pdate']))) < date("Y-m-d", time())) {
                                                    ?>
                                                    <button type="button" class="btn btn-secondary btn_down_exp fc_dgray" style="cursor:pointer;"><?=$download_x?></button>
                                                    <?
                                                } else {
                                                    $key = $c_info['ct_file'];
                                                    $cmd = $s3->getCommand('GetObject', [
                                                        'Bucket' => $bucket,
                                                        'Key' => $key,
                                                    ]);
                                                    $request = $s3->createPresignedRequest($cmd, '+5 minutes');
                                                    $presignedUrl = (string)$request->getUri();

                                                    $url = explode("https://bucket.object.ncloudstorage.com/", $presignedUrl);
                                                    $url = $url[1];
                                                    ?>
                                                    <a href="/download.php?type=my&ot_pcode=<?=$row_p['ot_pcode']?>&s=<?=$url?>">
                                                        <button type="button" class="btn btn-outline-primary btn_download"><?=$download?></button>
                                                    </a>
                                                    <?
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </li>
                                    <?
                                    $counts++;
                                }
                            }
                            ?>
                        </ul>
                    </div>
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
                                <p>
                                    <?
                                    if($order['ot_status'] == 2) {
                                        echo '결제완료';
                                    } else if($order['ot_status'] == 3) {
                                        echo '결제취소';
                                    }
                                    ?>
                                </p>
                            </li>
                            <li>
                                <span><?=$pay_list?></span>
                                <p><?=$counts?>개</p>
                            </li>
                            <li>
                                <span><?=$contents_price?></span>
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
                                <span><?=$pay_price?><</span>
                                <?
                                if($_SESSION['_lang'] == "en") {
                                    ?>
                                    <p>$<?=number_format(($order['ot_price']+$order['ot_vat']),2)?></p>
                                    <?
                                } else {
                                    ?>
                                    <p><?=number_format(($order['ot_price']+$order['ot_vat']))?>원</p>
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
                <div class="col-12">
                    <div class="mp_detail_btm">
                        <button type="button" class="btn btn-primary mp_btn" onclick="location.href='my_orderlist.php';"><?=$list_btn?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function del_order() {
            $.ajax({
                type: 'post',
                url: '/models/cart_model.php',
                dataType: 'json',
                data: {type: "del_order", ot_code: $("#ot_code").val()},
                success: function (d, s) {
                    if (d.result == '_ok') {
                        alert(d.msg);
                        location.replace("/my_orderlist.php");
                    } else {
                        alert(d.msg);
                    }
                },
                cache: false
            });
        }
    </script>

<? include_once("./inc/tail.php"); ?>