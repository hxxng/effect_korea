<?php
$title = "회원권 결제 완료";

include_once("./inc/head.php");
include_once("./inc/nav.php");

if($member_info['idx'] < 1) {
    p_alert('로그인 후 이용가능한 서비스입니다.', '/');
    exit;
}

$query = "select * from membership_t where mt_idx = ".$member_info['idx']." and mt_status = 2 order by mt_pdate desc limit 1";
$row = $DB->fetch_assoc($query);

$_lang = $_SESSION['_lang'];
$notice = lang("notice", $_lang, "membership");
$info1 = lang("info1", $_lang, "membership");
$info2 = lang("info2", $_lang, "membership");
$order_success = lang("order_success", $_lang, "membership");
$ment1 = lang("ment1", $_lang, "membership");
$ment2 = lang("ment2", $_lang, "membership");
$ment3 = lang("ment3", $_lang, "membership");
$ment4 = lang("ment4", $_lang, "membership");
$confirm = lang("confirm", $_lang, "order");
$membership1 = lang("membership1", $_lang, "mypage");
$membership2 = lang("membership2", $_lang, "mypage");
$membership3 = lang("membership3", $_lang, "mypage");
$membership4 = lang("membership4", $_lang, "mypage");
$available_content = lang("available_content", $_lang, "mypage");
$membership_download = lang("membership_download", $_lang, "mypage");
$unlimited = lang("unlimited", $_lang, "mypage");
$available_use = lang("available_use", $_lang, "mypage");
$pay_info = lang("pay_info", $_lang, "order");
$pay_date = lang("pay_date", $_lang, "order");
$pay_amount = lang("pay_amount", $_lang, "mypage");
$pay_status = lang("pay_status", $_lang, "mypage");
$pay_method = lang("pay_method", $_lang, "order");
$card = lang("card", $_lang, "order");

if($row['mt_type'] < 3) {
    $membership_contents = lang("membership_contents12", $_lang, "mypage");
    $membership_download_range = lang("membership_download12", $_lang, "mypage")." ".lang("unlimited", $_lang, "mypage");
} else {
    $membership_contents = lang("membership_contents34", $_lang, "mypage");
    $membership_download_range = lang("unlimited", $_lang, "mypage");
}
?>

<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="order_box order_box1">
                    <lottie-player src="img/lottie_success.json" class="lottie" background="transparent"  speed="1" autoplay loop></lottie-player>
                    <div class="order_success">
                        <div class="success_tit fw_600">
                            <?=$order_success?>
                            <br>
                            <?=$ment1?>
                            <br class="mobile">
                            <span class="fc_blue1">[<?=$row['mt_membership']?>]</span> <?=$ment2?>
                        </div>
                        <p><?=$ment3?> <?=DateType($row['mt_edate'],1)?><?=$ment4?></p>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="location.href='index.php'"><?=$confirm?></button>
                </div>
                <div class="m_order_detail">
                    <div class="m_detail_box info_box">
                        <div class="membership_cont">
                            <p class="m_name fc_blue1 fw_600"><img src="img/ic_check.png" alt=""> <?=$available_content?></p>
                            <p class="m_sub"><?=$membership_contents?></p>
                        </div>
                        <div class="membership_cont">
                            <p class="m_name fc_blue1 fw_600"><img src="img/ic_check.png" alt=""> <?=$membership_download?></p>
                            <p class="m_sub"><?=$membership_download_range?></p>
                        </div>
                        <div class="membership_cont">
                            <p class="m_name fc_blue1 fw_600"><img src="img/ic_check.png" alt=""> <?=$available_use?></p>
                            <p class="m_sub"><?=$unlimited?></p>
                        </div>
                    </div>
                    <div class="m_detail_box info_box">
                        <div class="info_tit fw_600"><?=$pay_info?></div>
                        <ul class="list_style_1">
                            <li>
                                <span><?=$pay_date?></span>
                                <p><?=$row['mt_pdate']?></p>
                            </li>
                            <li>
                                <span><?=$pay_status?></span>
                                <p><? if($row['mt_status'] == 2) echo "결제완료"; if($row['mt_status'] == 3) echo '결제취소'; ?></p>
                            </li>
                            <li>
                                <span><?=$pay_amount?></span>
                                <?
                                if($row['mt_pg_pg_tid']) {
                                ?>
                                <p><?=number_format($row['mt_price'])?>원</p>
                                <?
                                } else {
                                ?>
                                <p>$<?=number_format($row['mt_price'],2)?></p>
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
                    <div class="member_caution">
                        <p class="caution fw_600"><img src="img/ic_caution.png" alt=""> <?=$notice?></p>
                        <p><?=$info1?></p>
                        <p><?=$info2?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<? include_once("./inc/tail.php"); ?>