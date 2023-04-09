<?php
$title = "아티스트 구독현황";

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
$name = lang("name", $_lang, "mypage");
$in_use = lang("in_use", $_lang, "mypage");
$memebership_info = lang("memebership_info", $_lang, "mypage");
$validity = lang("validity", $_lang, "mypage");
$available_content = lang("available_content", $_lang, "mypage");
$membership_download = lang("membership_download", $_lang, "mypage");
$unlimited = lang("unlimited", $_lang, "mypage");
$available_use = lang("available_use", $_lang, "mypage");
$membership_list2 = lang("membership_list", $_lang, "mypage");
$days = lang("days", $_lang, "mypage");
$direct_input = lang("direct_input", $_lang, "mypage");
$order_date = lang("order_date", $_lang, "mypage");
$membership_type = lang("membership_type", $_lang, "mypage");
$pay_method = lang("pay_method", $_lang, "mypage");
$pay_amount = lang("pay_amount", $_lang, "mypage");
$pay_status = lang("pay_status", $_lang, "mypage");
$download_cnt = lang("download_cnt", $_lang, "mypage");
$no_membership = lang("no_membership", $_lang, "mypage");
$go_membership = lang("go_membership", $_lang, "mypage");
$no_list = lang("no_list", $_lang, "mypage");
$order_code = lang("order_code", $_lang, "order");
$membership_ment = lang("membership", $_lang, "mypage");
$card = lang("card", $_lang, "order");
$confirm = lang("confirm", $_lang, "order");
$pay_success = lang("pay_success", $_lang, "mypage");
$membership_update = lang("membership_update", $_lang, "mypage");

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

$query = "select * from member_t where idx = ".$member_info['idx'];
$member = $DB->fetch_assoc($query);

$query = "select * from membership_t where mt_status in (2,3) and mt_idx = ".$member_info['idx'];
$membership = $DB->fetch_assoc($query." order by mt_pdate desc limit 1");

$membership_name = lang("membership".$membership['mt_type'], $_lang, "mypage");

if($membership['mt_type'] < 3) {
    $membership_contents = lang("membership_contents12", $_lang, "mypage");
    $membership_download_range = lang("membership_download12", $_lang, "mypage");
} else {
    $membership_contents = lang("membership_contents34", $_lang, "mypage");
    $membership_download_range = lang("unlimited", $_lang, "mypage");
}

$_get_txt = "&pg=";
$n_limit = 10;
$pg = $_GET['pg'];

if($_GET['s_date'] && $_GET['e_date']) {
    $query .= " and mt_pdate between '".$_GET['s_date']."' and '".$_GET['e_date']."'";
}

$row_cnt = $DB->count_query($query);
$couwt_query = $row_cnt;
$counts = $couwt_query;
$n_page = ceil($couwt_query / $n_limit);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;
$counts = $counts - (($pg - 1) * $n_limit);

unset($list);
$sql_query = $query." order by mt_pdate desc limit ".$n_from.", ".$n_limit;
$membership_list = $DB->select_query($sql_query);
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
                    <li><a href="artist_my.php"><?=$home?></a></li>
                    <li class="t_active"><a href="artist_my_subscription.php"><?=$subscription?></a></li>
                    <li><a href="artist_my_orderlist.php"><?=$order?></a></li>
                    <li><a href="artist_my_like.php"><?=$favorites?></a></li>
                </ul> 
            </div>
        </div>
    </div>
    <div class="container">
        <?
        if($membership) {
            if($membership['mt_status'] == 2) {
                ?>
                <!-- 회원권 구독후 -->
                <div class="row">
                    <div class="col-12">
                        <div class="subsc_grid">
                            <div class="subsc_box position-relative d-flex justify-content-between align-items-center">
                                <div class="subsc_text">
                                    <div class="subsc_tit1 fw_600"><span><?=$membership_name?></span><div class="badge_ing"><?=$in_use?></div></div>
                                    <p class="subsc_sub1"><?=$validity?> : <?=DateType($membership['mt_edate'])?></p>
                                </div>
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_md"><?=$memebership_info?></button>
                            </div>
                            <div class="subsc_box position-relative d-flex justify-content-between align-items-center">
                                <div class="subsc_text">
                                    <p class="subsc_sub2"><?=$available_content?></p>
<!--                                    <p class="subsc_tit2 fw_600">--><?//=$arr_membership_contents[$membership['mt_type']]?><!--</p>-->
                                    <p class="subsc_tit2 fw_600"><?=$membership_contents?></p>
                                </div>
                                <div class="mp_img"><img src="img/mp_img02.png" alt=""></div>
                            </div>
                            <div class="subsc_box position-relative d-flex justify-content-between align-items-center">
                                <div class="subsc_text">
                                    <p class="subsc_sub2"><?=$membership_download?></p>
                                    <p class="subsc_tit2 fw_600"><?=$unlimited?></p>
                                </div>
                                <div class="mp_img"><img src="img/mp_img03.png" alt=""></div>
                                <div class="position-absolute m_tooltip sub_tt"><?=$membership_download_range?></div>
                            </div>
                            <div class="subsc_box position-relative d-flex justify-content-between align-items-center">
                                <div class="subsc_text">
                                    <p class="subsc_sub2"><?=$available_use?></p>
                                    <p class="subsc_tit2 fw_600"><?=$unlimited?></p>
                                </div>
                                <div class="mp_img"><img src="img/mp_img04.png" alt=""></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 회원권 구독후 끝 -->
                <?
            } else {
                ?>
                <!-- 회원권 구독전 -->
                <div class="row">
                    <div class="col-12">
                        <div class="mp_none fc_gray">
                            <img src="img/img_attention.png" alt="">
                            <p class="fs_18"><?=$no_membership?></p>
                            <button type="button" class="btn btn-outline-primary" onclick="location.href='/membership.php';"><?=$go_membership?></button>
                        </div>
                    </div>
                </div>
                <!-- 회원권 구독전 끝 -->
                <?
            }
        } else {
            ?>
            <!-- 회원권 구독전 -->
            <div class="row">
                <div class="col-12">
                    <div class="mp_none fc_gray">
                        <img src="img/img_attention.png" alt="">
                        <p class="fs_18"><?=$no_membership?></p>
                        <button type="button" class="btn btn-outline-primary" onclick="location.href='/membership.php';"><?=$go_membership?></button>
                    </div>
                </div>
            </div>
        <? } ?>
        <div class="row">
            <div class="col-12">
                <div class="subsc_history">
                    <div class="sub_tit fw_600"><?=$membership_list2?></div>
                    <hr class="hr">
                    <!-- 회원권 결제내역 -->
                    <div class="d-xl-flex d-block date_wrap">
                        <div class="btn-group btn-group-toggle mr-5 btn_group_grid" data-toggle="buttons">
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="options" id="option1" onclick="search_date(3)" <? if($_GET['search_date'] == 3) echo 'checked'; ?>> 3<?=$days?>
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="options" id="option2" onclick="search_date(5)" <? if($_GET['search_date'] == 5) echo 'checked'; ?>> 5<?=$days?>
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="options" id="option3" onclick="search_date(7)" <? if($_GET['search_date'] == 7) echo 'checked'; ?>> 7<?=$days?>
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="options" id="option4" onclick="search_date(15)" <? if($_GET['search_date'] == 15) echo 'checked'; ?>> 15<?=$days?>
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="options" id="option5" onclick="search_date(30)" <? if($_GET['search_date'] == 30) echo 'checked'; ?>> 30<?=$days?>
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="options" id="option6" onclick="search_date(60)" <? if($_GET['search_date'] == 60) echo 'checked'; ?>> 60<?=$days?>
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="options" id="option7" onclick="search_date(90)" <? if($_GET['search_date'] == 90) echo 'checked'; ?>> 90<?=$days?>
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="options" id="option8" onclick="search_date(120)" <? if($_GET['search_date'] == 120) echo 'checked'; ?>> 120<?=$days?>
                            </label>
                            <label class="btn btn-outline-primary <? if($_GET['search_date'] == "" && !$_GET['search_date']) echo 'active';?> btn_self">
                                <input type="radio" name="options" id="option9" <? if($_GET['search_date'] == "" && !$_GET['search_date']) echo 'checked';?>> <?=$direct_input?>
                            </label>
                        </div>
                        <section class="calendar_wrap <? if($_GET['search_date'] == "" && !$_GET['search_date']) echo 'active';?>">
                            <div class="form-group calendar">
                                <input type="text" class="form-control" id="datepicker" placeholder="yyyy.mm.dd" value="<?=$_GET['s_date']?>" onchange="chk_calendar(1)">
                                <i class="ic_calendar"><img src="img/ic_calendar.png" alt="캘린더"></i>
                            </div>
                            <span class="px-1 pt-n05">~</span>
                            <div class="form-group calendar">
                                <input type="text" class="form-control" id="datepicker2" placeholder="yyyy.mm.dd" value="<?=$_GET['e_date']?>" onchange="chk_calendar(2)">
                                <i class="ic_calendar"><img src="img/ic_calendar.png" alt="캘린더"></i>
                            </div>
                        </section>
                    </div>
                    <div class="table-responsive-lg">
                        <table class="table history_list text-center">
                            <thead>
                            <tr>
                                <th scope="col"><?=$order_date?></th>
                                <th scope="col"><?=$membership_type?></th>
                                <th scope="col"><?=$pay_method?></th>
                                <th scope="col"><?=$pay_amount?></th>
                                <th scope="col"><?=$pay_status?></th>
                                <th scope="col"><?=$download_cnt?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?
                            //페이징 10개
                            if($membership_list) {
                                foreach ($membership_list as $row_m) {
                                    if($row_m['mt_status'] == 2) {
                                        $date = DateType($row_m['mt_pdate'])."<br>(~".DateType($row_m['mt_edate'])."까지)";
                                        $mt_status = "결제완료";
                                    } else {
                                        $date = DateType($row_m['mt_pdate']);
                                        $mt_status = "결제취소";
                                    }
                                    ?>
                                    <tr>
                                        <td><?=$date?></td>
                                        <td><?=lang("membership".$row_m['mt_type'], $_lang, "mypage")?></td>
                                        <td><?=$arr_ct_method[$row_m['mt_payment']]?></td>
                                        <?
                                        if($_SESSION['_lang'] == "en") {
                                            ?>
                                            <td><?=number_format($row_m['mt_price'],2)?></td>
                                            <?
                                        } else {
                                            ?>
                                            <td><?=number_format($row_m['mt_price'])?>원</td>
                                            <?
                                        }
                                        ?>
                                        <td><?=$mt_status?></td>
                                        <td><?=$unlimited?></td>
                                    </tr>
                                    <?
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                        <? if(!$membership_list) { ?>
                            <!-- 회원권 결제내역 없음 -->
                            <div class="mp_none fc_gray">
                                <img src="img/img_attention.png" alt="">
                                <p class="fs_18 mb-0"><?=$no_list?></p>
                            </div>
                            <!-- 결제내역 없음 끝 -->
                            <?
                        }
                        ?>
                    </div>
                    <?
                    if($n_page>1) {
                        echo page_listing2($pg, $n_page, $_SERVER['PHP_SELF']."?".$_get_txt);
                    }
                    ?>
                    <!-- 회원권 결제내역 끝 -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 회원권 상세 모달 -->
    <div class="modal fade" id="modal_md" >
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?=$memebership_info?></h5>
                    <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
                        <img src="img/ic_x.png" alt="닫기">
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list_style_1 member_detail">
                        <li>
                            <span><?=$order_code?></span>
                            <p><?=$membership['mt_code']?></p>
                        </li>
                        <li>
                            <span><?=$order_date?></span>
                            <p><?=DateType($membership['mt_pdate'])?> (~<?=DateType($membership['mt_edate'])?>까지)</p>
                        </li>
                        <li>
                            <span><?=$membership_ment?></span>
                            <p><?=$membership['mt_membership']?></p>
                        </li>
                        <li>
                            <span><?=$available_content?></span>
                            <p><?=$membership_contents?></p>
                        </li>
                        <li>
                            <span><?=$membership_download?></span>
                            <p><?=$membership_download_range." ".$unlimited?></p>
                        </li>
                        <li>
                            <span><?=$available_use?></span>
                            <p><?=$unlimited?></p>
                        </li>
                        <li>
                            <span><?=$pay_method?></span>
                            <p><?=$card?></p>
                        </li>
                        <li>
                            <span><?=$pay_amount?></span>
                            <?
                            if($_SESSION['_lang'] == "en") {
                                ?>
                                <p>$<?=number_format($membership['mt_price'],2)?></p>
                                <?
                            } else {
                                ?>
                                <p><?=number_format($membership['mt_price'])?>원</p>
                                <?
                            }
                            ?>
                        </li>
                        <li>
                            <span><?=$pay_status?></span>
                            <p><?=$pay_success?></p>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-3" onclick="location.href='membership.php';"><?=$membership_update?></button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?=$confirm?></button>
                </div>
            </div>
        </div>
    </div>


<script>
    $(".btn_group_grid .btn").on("click",function(){
        $(".date_wrap .calendar_wrap").removeClass("on");
    })
    $(".btn_self").on("click",function(){
        $(".date_wrap .calendar_wrap").addClass("on");
    })

    function dateFormat(date) {
        let month = date.getMonth() + 1;
        let day = date.getDate();

        month = month >= 10 ? month : '0' + month;
        day = day >= 10 ? day : '0' + day;

        return date.getFullYear() + '-' + month + '-' + day;
    }

    function search_date(date) {
        let now = new Date();	// 현재 날짜 및 시간
        let s_date = new Date();
        s_date.setDate(s_date.getDate() - date);
        location.replace("/artist_my_subscription.php?search_date="+date+"&s_date="+dateFormat(s_date)+"&e_date="+dateFormat(now));
    }

    function chk_calendar(type) {
        if(type != 1) {
            if($("#datepicker").val() == "") {
                alert("시작날짜를 선택해주세요.");
                return false;
            }
            location.replace("/artist_my_subscription.php?s_date="+$("#datepicker").val().replaceAll(".", "-")+"&e_date="+$("#datepicker2").val().replaceAll(".", "-"));
        }
    }
</script>


<? include_once("./inc/tail.php"); ?>