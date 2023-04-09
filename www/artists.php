<?php
$title = "아티스트";

include_once("./inc/head.php");
include_once("./inc/nav.php");

if($member_info['idx']) {
    $url = "/signup_artist1_1.php";
} else {
    $url = "/signin.php";
}
$_lang = $_SESSION['_lang'];
$artist = lang("artist", $_lang, "artists");
$artist2 = lang("artist2", $_lang, "artists");
$search_txt = lang("search_txt", $_lang, "artists");
$search_txt2 = lang("search_txt2", $_lang, "artists");
$search_x = lang("search_x", $_lang, "artists");

$_get_txt = "search_txt=".$_GET['search_txt']."&pg=";
$n_limit = 16;
$pg = $_GET['pg'];

$query = "SELECT member_t.idx, sum(cart_t.ct_price) FROM member_t
        left join contents_t on contents_t.mt_idx = member_t.idx
        left join cart_t on cart_t.ct_idx = contents_t.idx
        where mt_level = 5 and mt_approve = 2 and mt_login_status = 'Y' group by member_t.idx order by sum(cart_t.ct_price) desc limit 8 ";
$member = $DB->select_query($query);

$query = "select * from member_t where mt_level = 5 and mt_approve = 2 and mt_login_status = 'Y'";
if($_GET['search_txt']) {
    $query .= " and instr(mt_nickname, '".$_GET['search_txt']."')";
}
$row_cnt = $DB->count_query($query);
$couwt_query = $row_cnt[0];
$counts = $couwt_query;
$n_page = ceil($couwt_query / $n_limit);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;
$counts = $counts - (($pg - 1) * $n_limit);

unset($list);
$sql_query = $query." order by mt_nickname limit ".$n_from.", ".$n_limit;
$list = $DB->select_query($sql_query);
?>

<div class="wrap">
    <div class="artist_pg_hd">
        <div class="at_bg_slider">
            <div class="at_bg swiper">
                <div class="swiper-wrapper">
<!--                    <div class="swiper-slide"><div class="img square"><img src="/img/sample_img_1.png" alt=""></div></div>-->
<!--                    <div class="swiper-slide"><div class="img square"><img src="/img/sample_img_2.png" alt=""></div></div>-->
<!--                    <div class="swiper-slide"><div class="img square"><img src="/img/sample_img_3.png" alt=""></div></div>-->
<!--                    <div class="swiper-slide"><div class="img square"><img src="/img/sample_img_4.png" alt=""></div></div>-->
<!--                    <div class="swiper-slide"><div class="img square"><img src="/img/sample_img_5.png" alt=""></div></div>-->
                </div>
            </div>
        </div>
        <div class="filter">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="artist_hd_wr d-flex justify-content-between align-items-center" style="min-height: 348px;">
                            <div class="hd_tit hd_tit2">
                                <h2 class="ff_play">TOP ARTISTS</h2>
                                <?php
                                if($member_info['mt_level'] == 3 || !$member_info) {
                                    ?>
                                <p><?=$artist?></p>
                                <button type="button" class="btn btn-outline-secondary tp_btn tp_btn_1" onclick="javascript:location.replace('<?=$url?>')"><?=$artist2?><img src="img/arrow_right_2.png" alt=""></button>
                                <? } ?>
                            </div>
                            <div class="carousel_slider">
                                <div thumbsSlider="" class="carousel swiper">
                                    <div class="swiper-wrapper">
                                        <?
                                        if($member) {
                                            foreach ($member as $row_m) {
                                                $query = "select * from member_t where idx = " . $row_m['idx'];
                                                $info = $DB->fetch_assoc($query);
                                                if ($info['mt_image']) {
                                                    $url = $ct_img_url . "/" . $info['mt_image'];
                                                } else {
                                                    $url = $ct_member_no_img_url;
                                                }
                                        ?>
                                        <div class="swiper-slide"><div class="img square"><img src="<?=$url?>" alt=""></div></div>
                                        <?
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>">
                <div class="wr_tit1 d-flex justify-content-between align-items-end">
                    <h2 class="ff_play">ARTIST</h2>
                    <div class="form-group form-group_1 sch_input_wrap">
                        <label for="search_txt" class="search_label"><?=$search_txt?> <span class="hide_text"><?=$search_txt2?></span></label>
                        <input type="text" class="form-control" id="search_txt" name="search_txt">
                        <button class="btn btn-link btn_sch btn_sch_1" type="submit"><img src="img/ic_sub_search.png" alt="검색"></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <? if($list) { ?>
        <div class="at_list row row-cols-2 row-cols-xl-4 row-cols-lg-3">
            <? foreach ($list as $row) { ?>
            <div class="col">
                <a href="/artist_detail.php?mt_idx=<?=$row['idx']?>">
                    <div class="at_box">
                        <div class="at_cr_img square"><img src="<? if($row['mt_image']) echo $ct_img_url."/".$row['mt_image']; else echo $ct_member_no_img_url;?>" alt=""></div>
                        <h4 class="at_name fw_500"><?=$row['mt_nickname']?></h4>
                        <p class="at_txt" style="height: 60px;"><?=$row['mt_introduce']?></p>
                    </div>
                </a>
            </div>
            <? } ?>
        </div>
        <? } else { ?>
        <div class="row">
            <div class="col-12">
                <div class="result_none fc_gray">
                    <img src="img/result_img.png" alt="">
                    <p class="fs_18"><?=$search_x?></p>
                </div>
            </div>
        </div>
        <?
        }

        if($n_page>1) {
            echo page_listing2($pg, $n_page, $_SERVER['PHP_SELF']."?".$_get_txt);
        }
        ?>
    </div>
</div>

<script>
    var swiper = new Swiper(".carousel", {
        loop: true,
        slidesPerView: 1,
        grabCursor: true,
        effect: "creative",
        creativeEffect: {
          prev: {
            translate: ["-50%", 0, -200],
          },
          next: {
            translate: ["50%", 0, -200],
          },
        },
    });
    var swiper2 = new Swiper(".at_bg", {
        spaceBetween: 10,
        thumbs: {
          swiper: swiper,
        },
    });
</script>

<? include_once("./inc/tail.php"); ?>