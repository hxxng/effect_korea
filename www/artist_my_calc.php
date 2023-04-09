<?php
$title = "정산내역";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$calc = lang("calc", $_lang, "calc");
$calc_amount = lang("calc_amount", $_lang, "calc");
$calc_ment1 = lang("calc_ment1", $_lang, "calc");
$calc_ment2_1 = lang("calc_ment2_1", $_lang, "calc");
$calc_ment2_2 = lang("calc_ment2_2", $_lang, "calc");
$calc_application = lang("calc_application", $_lang, "calc");
$update_account = lang("update_account", $_lang, "calc");
$delete_account = lang("delete_account", $_lang, "calc");
$input_account = lang("input_account", $_lang, "calc");
$calc_ing = lang("calc_ing", $_lang, "calc");
$calc_finish = lang("calc_finish", $_lang, "calc");
$search = lang("search", $_lang, "calc");
$reset = lang("reset", $_lang, "calc");
$pay_date = lang("pay_date", $_lang, "calc");
$pay_method = lang("pay_method", $_lang, "calc");
$pay_amount = lang("pay_amount", $_lang, "calc");
$vat = lang("vat", $_lang, "calc");
$calc_finish_date = lang("calc_finish_date", $_lang, "calc");
$calc_status = lang("calc_status", $_lang, "calc");
$calc_date = lang("calc_date", $_lang, "calc");
$manage = lang("manage", $_lang, "calc");
$search2 = lang("search2", $_lang, "calc");

$settlement_account = lang("settlement_account", $_lang, "mypage");
$mail2 = lang("mail2", $_lang, "signup");
$whole = lang("whole", $_lang, "order");
$order_code = lang("order_code", $_lang, "order");
$contents_code = lang("contents_code", $_lang, "order");
$days = lang("days", $_lang, "mypage");
$direct_input = lang("direct_input", $_lang, "mypage");
$num = lang("num", $_lang, "notice");
$category = lang("category", $_lang, "contents");
$calc = lang("calc", $_lang, "calc");
$detail = lang("detail", $_lang, "calc");

$_lang = $_SESSION['_lang'];

if($member_info['idx'] < 1) {
    p_alert('로그인 후 이용가능한 서비스입니다.', '/');
    exit;
}
if($member_info['mt_level'] != 5) {
    p_alert('아티스트만 접근가능한 서비스입니다.', '/');
    exit;
}

$_get_txt = "ct_status=".$_GET['ct_status']."&search_txt=".$_GET['search_txt']."&pg=";
$n_limit = 10;
$pg = $_GET['pg'];

$query = "select a1.*, a2.*, a2.ct_price as cart_price,
        (SELECT ct_name FROM category_t WHERE a3.ct_cate_idx=idx) as ct_cate, (SELECT ct_name FROM category_t WHERE a3.ct_cate_idx2=idx) as ct_cate2,
        (SELECT ct_status FROM calculate_t WHERE ot_pdate between ct_cdate and ct_cedate) as ct_status2
        from order_t a1
        left join cart_t a2 on a2.ot_code = a1.ot_code
        left join contents_t a3 on a3.idx = a2.ct_idx
        where a3.mt_idx = " . $member_info['idx'] . " and ot_status = 2 and a2.ct_status = 2
        and a1.mt_idx != '70' and a2.mt_idx != '70' 
";
$where_query = "";
if($_GET['search_txt']) {
    $where_query .= " and (instr(a2.ot_pcode, '".$_GET['search_txt']."'))";
}
if($_GET['ct_status']) {
    if($_GET['ct_status'] == 1) {
        $where_query .= " and (SELECT ct_status FROM calculate_t WHERE ot_pdate between ct_cdate and ct_cedate) is null";
    } else {
        $where_query .= " and (SELECT ct_status FROM calculate_t WHERE ot_pdate between ct_cdate and ct_cedate) = ".$_GET['ct_status'];
    }
}
if($_GET['s_date'] && $_GET['e_date']) {
    $query .= " and ot_pdate between '".$_GET['s_date']."' and '".$_GET['e_date']."'";
}
$count_query = $DB->count_query($query.$where_query);
$counts = $count_query;
$n_page = ceil($count_query / $n_limit);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;
$counts = $counts - (($pg - 1) * $n_limit);

unset($list);
$sql_query = $query.$where_query." order by a1.ot_pdate desc limit ".$n_from.", ".$n_limit;
$list = $DB->select_query($sql_query);
$list2 = $DB->select_query($query);

if($list2) {
    foreach ($list2 as $row) {
        $query = "select * from calculate_t where ct_cdate <= '".$row['ot_pdate']."' and ct_cedate >= '".$row['ot_pdate']."' and mt_idx = ".$member_info['idx'];
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
            }
            $sum += $price;
        }
    }
}
$query = "select * from setting_t where idx = 1";
$setting = $DB->fetch_assoc($query);
?>
    <div class="wrap">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-5">
                    <div class="wr_tit2">
                        <h2><?=$calc?></h2>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="calc_box calc_box1 d-flex justify-content-between">
                        <div class="calc_content calc_content1">
                            <h4><?=$calc_amount?></h4>
                            <div class="p_wr">
                                <p class="p1"><?=$calc_ment1?></p>
                                <p class="p1"><?=$calc_ment2_1?> <?=$setting['st_service_comm']?>% <?=$calc_ment2_2?></p>
                            </div>
                        </div>
                        <div class="calc_content calc_pr_cont">
                            <input type="hidden" id="settlement_amount" value="<?=$sum?>" />
                            <input type="hidden" id="mt_account_status" value="<?=$member_info['mt_account_status']?>"/>
                            <p class="calc_price fw_600"><?=number_format($sum)?>원</p>
                            <button type="button" class="btn btn-sm btn-primary" onclick="settlement()"><?=$calc_application?></button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <?
                    if($member_info['mt_account_status'] == "Y") {
                        ?>
                        <div class="calc_box calc_box2 d-flex justify-content-between">
                            <div class="calc_content calc_content1">
                                <h4><?=$settlement_account?><div class="badge_ing"><?=$mail2?></div></h4>
                                <p class="bank"><?=$arr_bank_useb[$member_info['mt_bank']]?> <?=$member_info['mt_account']?> <?=$member_info['mt_account_name']?></p>
                            </div>
                            <div class="calc_content calc_content1 calc_btn_wr">
                                <button type="button" class="btn btn-sm btn-secondary" onclick="location.href='/artist_my_account1.php'"><img src="img/ic_modify.png" alt=""> <?=$update_account?></button>
                                <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="del_account()"><img src="img/ic_del.png" alt=""> <?=$delete_account?></button>
                            </div>
                        </div>
                    <? } else { ?>
                        <!-- 정산계좌 등록없음 -->
                        <div class="calc_box calc_box2 d-flex align-items-center justify-content-between">
                            <div class="calc_content calc_content1">
                                <h4><?=$settlement_account?></h4>
                            </div>
                            <div class="calc_content calc_content1 calc_btn_wr">
                                <button type="button" class="btn btn-sm btn-secondary" onclick="location.href='/artist_my_account1.php'"><img src="img/ic_plus.png" alt=""> <?=$input_account?></button>
                            </div>
                        </div>
                        <!-- 정산계좌 등록없음 끝 -->
                    <? } ?>
                </div>
                <div class="col-12">
                    <div class="calc_box calc_box_b">
                        <div class="d-md-flex align-items-end">
                            <div class="group_wr">
                                <label><?=$calc_status?></label>
                                <div class="btn-group btn-group-toggle btn_group_grid3 mr-5" data-toggle="buttons">
                                    <label class="btn btn-outline-primary <?=($_GET['ct_status'] == "") ? 'active' : '' ?>">
                                        <input type="radio" name="status" id="status1" value="" <?=($_GET['ct_status'] == "") ? 'checked' : '' ?>> <?=$whole?>
                                    </label>
                                    <label class="btn btn-outline-primary <?=($_GET['ct_status'] == "1") ? 'active' : '' ?>">
                                        <input type="radio" name="status" id="status2" value="1" <?=($_GET['ct_status'] == "1") ? 'checked' : '' ?>> <?=$calc_ing?>
                                    </label>
                                    <label class="btn btn-outline-primary <?=($_GET['ct_status'] == "2") ? 'active' : '' ?>">
                                        <input type="radio" name="status" id="status3" value="2" <?=($_GET['ct_status'] == "2") ? 'checked' : '' ?>> <?=$calc_application?>
                                    </label>
                                    <label class="btn btn-outline-primary <?=($_GET['ct_status'] == "3") ? 'active' : '' ?>">
                                        <input type="radio" name="status" id="status4" value="3" <?=($_GET['ct_status'] == "3") ? 'checked' : '' ?>> <?=$calc_finish?>
                                    </label>
                                    <!--                                <label class="btn btn-outline-primary --><?//=($_GET['ct_status'] == "") ? 'active' : '' ?><!--">-->
                                    <!--                                    <input type="radio" name="options" id="option3" --><?//=($_GET['ct_status'] == "") ? 'checked' : '' ?><!-- onclick="chk_status('')"> 취소-->
                                    <!--                                </label>-->
                                </div>
                            </div>
                            <div class="form-group form-group_1 fg_1">
                                <label for="search_txt" class="search_label_1"><?=$order_code?><span class="hide_text"><?=$search?></span></label>
                                <input type="text" class="form-control" id="search_txt" name="search_txt" value="<?=$_GET['search_txt']?>">
                                <!--                            <button class="btn btn-link btn_sch btn_sch_1"><img src="img/ic_sub_search.png" alt="검색"> </button>-->
                            </div>
                        </div>
                        <div class="d-xl-flex align-items-end d-block date_wrap date_wrap2">
                            <div class="group_wr">
                                <label><?=$calc_date?></label>
                                <div class="btn-group btn-group-toggle mr-5 btn_group_grid2" data-toggle="buttons">
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" name="options" id="option1" value="3" onclick="search_date(3)" <? if($_GET['search_date'] == 3) echo 'checked'; ?>> 3<?=$days?>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" name="options" id="option2" value="5" onclick="search_date(5)" <? if($_GET['search_date'] == 5) echo 'checked'; ?>> 5<?=$days?>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" name="options" id="option3" value="7" onclick="search_date(7)" <? if($_GET['search_date'] == 7) echo 'checked'; ?>> 7<?=$days?>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" name="options" id="option4" value="15" onclick="search_date(15)" <? if($_GET['search_date'] == 15) echo 'checked'; ?>> 15<?=$days?>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" name="options" id="option5" value="30" onclick="search_date(30)" <? if($_GET['search_date'] == 30) echo 'checked'; ?>> 30<?=$days?>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" name="options" id="option6" value="60" onclick="search_date(60)" <? if($_GET['search_date'] == 60) echo 'checked'; ?>> 60<?=$days?>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" name="options" id="option7" value="90" onclick="search_date(90)" <? if($_GET['search_date'] == 90) echo 'checked'; ?>> 90<?=$days?>
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" name="options" id="option8" value="120" onclick="search_date(120)" <? if($_GET['search_date'] == 120) echo 'checked'; ?>> 120<?=$days?>
                                    </label>
                                    <label class="btn btn-outline-primary <? if($_GET['search_date'] == "" && !$_GET['search_date']) echo 'active';?> btn_self">
                                        <input type="radio" name="options" id="option9" value="" <? if($_GET['search_date'] == "" && !$_GET['search_date']) echo 'checked';?>> <?=$direct_input?>
                                    </label>
                                </div>
                            </div>
                            <section class="calendar_wrap <? if($_GET['search_date'] == "" && !$_GET['search_date']) echo 'on';?>">
                                <div class="form-group calendar">
                                    <input type="text" class="form-control" id="datepicker" placeholder="yyyy.mm.dd" value="<?=$_GET['s_date']?>">
                                    <i class="ic_calendar"><img src="img/ic_calendar.png" alt="캘린더"></i>
                                </div>
                                <span class="px-1 pt-n05">~</span>
                                <div class="form-group calendar">
                                    <input type="text" class="form-control" id="datepicker2" placeholder="yyyy.mm.dd" value="<?=$_GET['e_date']?>">
                                    <i class="ic_calendar"><img src="img/ic_calendar.png" alt="캘린더"></i>
                                </div>
                            </section>
                        </div>
                        <hr class="hr">
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn_reset btn_reset1" onclick="javascript:location.replace('/artist_my_calc.php');"><img src="img/ic_reset.png" alt=""> <?=$reset?></button>
                            <button type="button" class="btn btn-primary btn_calc_sch" onclick="search();"><?=$search2?></button>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="table-responsive-xl">
                        <table class="table history_list my_contents_list my_contents_list1 text-center">
                            <thead>
                            <tr>
                                <th scope="col"><?=$num?></th>
                                <th scope="col" class="my_cont_num"><?=$contents_code?></th>
                                <th scope="col"><?=$pay_date?></th>
                                <th scope="col"><?=$pay_method?></th>
                                <th scope="col" class="my_cont_cate"><?=$category?></th>
                                <th scope="col" class="my_cont_pr"><?=$pay_amount?></th>
                                <th scope="col"><?=$vat?></th>
                                <th scope="col"><?=$calc_amount?></th>
                                <th scope="col"><?=$calc_finish_date?></th>
                                <th scope="col"><?=$calc_status?></th>
                                <th scope="col"><?=$manage ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <? if($list) {
                                foreach ($list as $row) {
                                    if($row['ot_pay_type'] == 6) {
                                        $pay = "회원권";
                                    } else {
                                        $pay = $arr_ct_method[$row['ot_pay_type']];
                                    }
                                    $query = "select * from calculate_t where ct_cdate <= '".$row['ot_pdate']."' and ct_cedate >= '".$row['ot_pdate']."' and mt_idx = ".$member_info['idx'];
                                    $settlement = $DB->fetch_assoc($query);
                                    ?>
                                    <tr>
                                        <td><?=$counts?></td>
                                        <td class="my_cont_num"><?=$row['ot_pcode']?></td>
                                        <td><?=DateType($row['ot_pdate'])?></td>
                                        <td><?=$pay?></td>
                                        <td class="my_cont_cate"><?=$row['ct_cate']?> > <?=$row['ct_cate2']?></td>
                                        <?
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
                                        ?>
                                        <td class="my_cont_pr"><?=number_format($price)?>원</td>
                                        <td><?=number_format(($price * ($setting['st_service_comm']/100)) + ($price * ($setting['st_pay_comm']/100)))?>원</td>
                                        <td><?=number_format($price - (($price * ($setting['st_service_comm']/100)) + ($price * ($setting['st_pay_comm']/100))))?>원</td>
                                        <td><?=DateType($settlement['ct_ridate'])?></td>
                                        <td>
                                            <?
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
                                            echo $ct_status;
                                            ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" onclick="location.href='/artist_my_calc_detail.php?ot_pcode=<?=$row['ot_pcode']."&".$_get_txt?>'"><?=$detail?></button>
                                        </td>
                                    </tr>
                                    <?
                                    $counts--;
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 my-5">
                    <?
                    if($n_page>1) {
                        echo page_listing2($pg, $n_page, $_SERVER['PHP_SELF']."?".$_get_txt);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".btn_group_grid2 .btn").on("click",function(){
            if($(this).hasClass("active")) {
                var id =$(this).find("input")[0].id;
                $("#"+id).attr("checked", true);
            }
            $(".date_wrap .calendar_wrap").removeClass("on");
        })
        $(".btn_self").on("click",function(){
            $(".date_wrap .calendar_wrap").addClass("on");
        })
        $(".btn_group_grid3 .btn").on("click",function(){
            if($(this).hasClass("active")) {
                var id =$(this).find("input")[0].id;
                $("#"+id).attr("checked", true);
            }
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
            $("#datepicker").val(dateFormat(s_date));
            $("#datepicker2").val(dateFormat(now));
        }

        function search() {
            var ct_status = $('input[name=status]:checked').val();
            var search_date = $('input[name=options]:checked').val();
            var s_date = $("#datepicker").val().replaceAll(".", "-");
            var e_date = $("#datepicker2").val().replaceAll(".", "-");
            if(($("#datepicker").val() == "") && ($("#datepicker2").val() == "")) {
                var search_txt = $("#search_txt").val();
                location.replace("/artist_my_calc.php?ct_status="+ct_status+"&search_date="+search_date+"&s_date="+s_date+"&e_date="+e_date+"&search_txt="+search_txt);
            } else {
                if(($("#datepicker").val() == "") || ($("#datepicker2").val() == "")) {
                    alert("조회기간을 입력해주세요.");
                    return false;
                } else{
                    var search_txt = $("#search_txt").val();
                    location.replace("/artist_my_calc.php?ct_status="+ct_status+"&search_date="+search_date+"&s_date="+s_date+"&e_date="+e_date+"&search_txt="+search_txt);
                }
            }
        }

        function settlement() {
            if($("#settlement_amount").val() < 50000) {
                alert("50,000원 이상부터 정산 신청가능합니다.");
                return false;
            }
            if($("#mt_account_status").val() == "N") {
                alert("정산계좌를 등록해야 정산 신청가능합니다.");
                return false;
            }
            $.ajax({
                type: 'post',
                url: '/models/mypage/member.php',
                dataType: 'json',
                data: {type: "settlement", settlement_amount: $("#settlement_amount").val()},
                success: function (d, s) {
                    if(d['result'] == "ok") {
                        alert("정산신청이 완료되었습니다");
                        location.reload();
                    }
                },
                cache: false
            });
        }

        function del_account() {
            if(confirm("정산계좌를 삭제할 경우 정산이 지급되지 않습니다.")) {
                $.ajax({
                    type: 'post',
                    url: '/models/mypage/member.php',
                    dataType: 'json',
                    data: {type: "del_account"},
                    success: function (d, s) {
                        if(d['result'] == "ok") {
                            alert("삭제되었습니다.");
                            location.reload();
                        }
                    },
                    cache: false
                });
            }
        }
    </script>

<? include_once("./inc/tail.php"); ?>