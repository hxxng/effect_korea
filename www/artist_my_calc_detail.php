<?php
$title = "정산내역 상세";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$calc_detail = lang("calc_detail", $_lang, "calc");
$calc_amount = lang("calc_amount", $_lang, "calc");
$pay_method = lang("pay_method", $_lang, "calc");
$pay_amount = lang("pay_amount", $_lang, "calc");
$calc_finish_date = lang("calc_finish_date", $_lang, "calc");
$calc_status = lang("calc_status", $_lang, "calc");
$calc_info = lang("calc_info", $_lang, "calc");
$commission1 = lang("commission1", $_lang, "calc");
$commission2 = lang("commission2", $_lang, "calc");
$commission3 = lang("commission3", $_lang, "calc");
$order_info = lang("order_info", $_lang, "calc");
$vat2 = lang("vat", $_lang, "calc");

$order_code = lang("order_code", $_lang, "order");
$contents_code = lang("contents_code", $_lang, "order");
$pay_date = lang("pay_date", $_lang, "order");
$pay_status = lang("pay_status", $_lang, "order");
$pay_price = lang("pay_price", $_lang, "order");
$vat = lang("vat", $_lang, "order");
$pay_method = lang("pay_method", $_lang, "order");
$list_btn = lang("list_btn", $_lang, "order");

if($member_info['idx'] < 1) {
    p_alert('로그인 후 이용가능한 서비스입니다.', '/');
    exit;
}
if($member_info['mt_level'] != 5) {
    p_alert('아티스트만 접근가능한 서비스입니다.', '/');
    exit;
}

$query = "select *, (SELECT ct_name FROM category_t WHERE idx=ct_cate_idx2) as ct_name, 
(SELECT mt_nickname FROM member_t WHERE idx=a3.mt_idx) as mt_nickname, (SELECT mt_image FROM member_t WHERE idx=a3.mt_idx) as mt_image, a2.ct_price as cart_price, a3.idx as ct_idx
from order_t a1 
left join cart_t a2 on a2.ot_code = a1.ot_code
left join contents_t a3 on a3.idx = a2.ct_idx
where ot_pcode = '".$_GET['ot_pcode']."'";
$row = $DB->fetch_assoc($query);
if($row['mt_image']) {
    $mt_image = $ct_img_url."/".$row['mt_image'];
} else {
    $mt_image = $ct_member_no_img_url;
}

$query = "select * from calculate_t where ct_cdate <= '".$row['ot_pdate']."' and ct_cedate >= '".$row['ot_pdate']."' and mt_idx = ".$member_info['idx'];
$settlement = $DB->fetch_assoc($query);
if($settlement) {
    if($settlement['ct_status'] == 1) {
        $ct_status = "정산중";
    } else if($settlement['ct_status'] == 2) {
        $ct_status = "정산신청";
    } else {
        $ct_status = "정산완료";
    }
} else {
    $ct_status = "정산중";
}
?>
    <div class="wrap">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-5">
                    <div class="wr_tit1">
                        <h2><?=$calc_detail?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mp_order_detail">
                        <div class="order_hd">
                            <span class="fw_500 order_hd_fs"><?=DateType($row['ot_pdate'])?></span><span class="order_hd_fs2">(<?=$order_code?>: <?=$row['ot_code']?>)</span>
                        </div>
                        <ul class="order_list">
                            <li>
                                <div class="order_cont_box">
                                    <div class="cart_thumbs video_list square rectangle">
                                        <img src="<?=$ct_img_url."/".$row['ct_image']?>" alt="">
                                    </div>
                                </div>
                                <div class="cart_cont_box calc_detail_box">
                                    <a class="cart_cont" href="/contents_list.php?ct_type=<?=$row['ct_type']?>&ct_idx=<?=$row['ct_cate_idx2']?>&idx=<?=$row['ct_idx']?>">
                                        <div class="cart_cate"><?=$row['ct_name']?></div>
                                        <h4 class="cart_tit ff_play"><?=$row['ct_title']?></h4>
                                        <div class="cart_artist">
                                            <div class="square"><img src="<?=$mt_image?>" alt=""></div>
                                            <span class="at_name"><?=$row['mt_nickname']?></span>
                                        </div>
                                        <div class="cart_op cart_de"><span class="badge badge-secondary fw_600"><?=$row['ct_resolution']?></span><span class="c_reso"><?=$arr_resolution2[$row['ct_resolution']]?></span></div>
                                        <div class="cart_de d-flex align-items-center justify-content-between">
                                            <p class="cart_order"><?=$contents_code?> : <?=$row['ot_pcode']?></p>
                                            <div class="cart_price"><span class="price ff_play"><?=number_format($row['cart_price'])?></span>원</div>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="info_box info_box2">
                        <div class="info_tit fw_600"><?=$calc_info?></div>
                        <ul class="list_style_1">
                            <li>
                                <span><?=$calc_status?></span>
                                <p><?=$ct_status?></p>
                            </li>
                            <li>
                                <span><?=$calc_finish_date?></span>
                                <p><?=DateType($settlement['ct_ridate'])?></p>
                            </li>
                            <li>
                                <span><?=$calc_amount?></span>
                                <p><?=number_format($settlement['ct_price'])?>원</p>
                            </li>
                            <li>
                                <span><?=$vat2?></span>
                                <p><?=number_format($settlement['ct_service_comm'] + $settlement['ct_pay_comm'] + $settlement['ct_etc_comm'])?>원</p>
                            </li>
                            <li>
                                <span><?=$commission1?></span>
                                <p><?=number_format($settlement['ct_service_comm'])?>원</p>
                            </li>
                            <li>
                                <span><?=$commission2?></span>
                                <p><?=number_format($settlement['ct_pay_comm'])?>원</p>
                            </li>
                            <li>
                                <span><?=$commission3?></span>
                                <p><?=number_format($settlement['ct_etc_comm'])?>원</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="info_box info_box2">
                        <div class="info_tit fw_600"><?=$order_info?></div>
                        <ul class="list_style_1">
                            <li>
                                <span><?=$pay_date?></span>
                                <p><?=$row['ot_pdate']?></p>
                            </li>
                            <li>
                                <span><?=$pay_status?></span>
                                <p>
                                    <?
                                    if($row['ot_status'] == 2) {
                                        echo '결제완료';
                                    } else if($row['ot_status'] == 3) {
                                        echo '결제취소';
                                    }
                                    ?>
                                </p>
                            </li>
                            <?
                            if($row['ot_pay_type'] != 6) {
                                ?>
                                <li>
                                    <span><?=$pay_price?></span>
                                    <p><?=number_format($row['ot_price'])?>원</p>
                                </li>
                                <li>
                                    <span><?=$vat?></span>
                                    <p><?=number_format($row['ot_vat'])?>원</p>
                                </li>
                            <? } ?>
                            <li>
                                <span><?=$pay_method?></span>
                                <p><?=$arr_ct_method[$row['ot_pay_type']]?></p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mp_detail_btm">
                        <button type="button" class="btn btn-primary mp_btn" onclick="location.href='artist_my_calc.php';"><?=$list_btn?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>



<? include_once("./inc/tail.php"); ?>