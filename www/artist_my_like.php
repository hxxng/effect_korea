<?php
$title = "아티스트 구매내역";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
if($member_info['idx'] < 1) {
    p_alert('로그인 후 이용가능한 서비스입니다.', '/');
    exit;
}
if($member_info['mt_level'] != 5) {
    p_alert('아티스트만 접근가능한 서비스입니다.', '/');
    exit;
}
$mypage = lang("mypage", $_lang, "mypage");
$info_update = lang("info_update", $_lang, "mypage");
$home = lang("home", $_lang, "mypage");
$subscription = lang("subscription", $_lang, "mypage");
$order = lang("order", $_lang, "mypage");
$favorites = lang("favorites", $_lang, "mypage");
$cart1 = lang("cart1", $_lang, "modal");
$cart2 = lang("cart2", $_lang, "modal");

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

$_get_txt = "pg=";
$n_limit = 25;
$pg = $_GET['pg'];

$query = "select * from wish_contents_t where mt_idx = ".$member_info['idx']." and wct_status = 'Y'";
$row_cnt = $DB->count_query($query);
$couwt_query = $row_cnt;
$counts = $couwt_query;
$n_page = ceil($couwt_query / $n_limit);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;
$counts = $counts - (($pg - 1) * $n_limit);

unset($list);
$sql_query = $query." order by wct_wdate desc limit ".$n_from.", ".$n_limit;
$list = $DB->select_query($sql_query);
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
                    <li><a href="/artist_my.php"><?=$home?></a></li>
                    <li><a href="/artist_my_subscription.php"><?=$subscription?></a></li>
                    <li><a href="/artist_my_orderlist.php"><?=$order?></a></li>
                    <li class="t_active"><a href="/artist_my_like.php"><?=$favorites?></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="ct_list row row-cols-2 row-cols-xl-5 row-cols-lg-4 row-cols-md-3">
            <? if($list) {
                foreach ($list as $row) {
                    $query = "select *, (SELECT ct_name FROM category_t WHERE idx=ct_cate_idx2) as ct_name from contents_t where ct_show = 'Y' and ct_status = 2 and idx = ".$row['ct_idx'];
                    $row_c = $DB->fetch_assoc($query);
                    if($row_c) {
                        ?>
                        <div class="col">
                            <div class="ct_box">
                                <div class="video_list square rectangle">
                                    <img src="<?=$ct_img_url.'/'.$row_c['ct_image']?>">
                                </div>
                                <div class="m_over">
                                    <div class="m_over_top d-flex align-items-center justify-content-between">
                                        <p class="time"><?=$row_c['ct_playtime']?></p>
                                        <div class="icon">
                                            <button type="button" class="btn btn_cart" onclick="cart_ing('<?=$row_c['idx']?>')">
                                                <div class="ic_cart"></div>
                                            </button>
                                            <button type="button" class="btn m_over_btn on" onclick="wish_ing2('<?=$row_c['idx']?>', 'content')">
                                                <div class="ic_heart"></div>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="m_over_bottom" onclick="location.href='/contents_list.php?ct_type=<?=$row_c['ct_type']?>&ct_idx=<?=$row_c['ct_cate_idx2']?>&idx=<?=$row_c['idx']?>';" style="cursor: pointer;">
                                        <p class="ct_txt"><?=$row_c['ct_name']?></p>
                                        <p class="ct_tit fw_500"><?=$row_c['ct_title']?></p>
                                    </div>
                                    <form name="info<?=$row_c['idx']?>" id="info<?=$row_c['idx']?>" method="post">
                                    <input type="hidden" name="type" id="type" value="insert">
                                    <input type="hidden" name="order_act" id="order_act">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?
                    }
                }
            }
            ?>
        </div>
        <?
        if($n_page>1) {
            echo page_listing2($pg, $n_page, $_SERVER['PHP_SELF']."?".$_get_txt);
        }
        ?>
    </div>
</div>

<!-- 장바구니 알럿 토스트 -->
<div class="toast_cont position-fixed">
    <div class="toast toast_cart align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex align-items-center justify-content-between">
            <div class="toast_body">
                <?=$cart1?>
            </div>
            <a class="toast_for fc_blue1" href="cart.php"><?=$cart2?></a>
        </div>
    </div>
</div>

<script>
    $(".side_filter li .side_filter_tit").on("click",function(){
        $(this).parents("li").toggleClass("on");
    })
    $(".m_over_btn").on("click",function(){
        $(this).toggleClass("on");
    })
    $(".btn_heart").on("click",function(){
        $(this).toggleClass("on");
    })

    function cart_ing(idx) {
        const param = $("<input type='hidden' value=" + idx + " name='ct_idx'>");
        $("#info"+idx).append(param);
        $.ajax({
            type: 'post',
            url: '/models/cart_model.php',
            dataType: 'json',
            data: $("#info"+idx).serialize(),
            success: function(d,s) {
                if(d.result=='_ok'){
                    $(".toast_cont").addClass("on");

                    setTimeout(function(){
                        $(".toast_cont").removeClass("on");
                    },3000);
                }else {
                    alert(d.msg);
                }
            },
            cache: false
        });
    }

    function wish_ing2(idx, table){
        $.ajax({
            type: 'post',
            url: '/models/wish_model.php',
            dataType: 'json',
            data: { act : 'wish', wish_idx : idx, table : table},
            success: function(d,s) {
                if(d.result=='_false'){
                    alert('로그인이 필요한 기능입니다.');
                    return false;
                } else {
                    location.reload();
                }
            },
            cache: false
        });
    }

</script>

<? include_once("./inc/tail.php"); ?>