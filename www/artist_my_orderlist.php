<?php
$title = "아티스트 구매내역";

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

$_get_txt = "search_date=".$_GET['search_date']."&s_date=".$_GET['s_date']."&e_date=".$_GET['e_date']."&pg=";
$n_limit = 5;
$pg = $_GET['pg'];

$query = "select * from order_t left join cart_t on cart_t.ot_code = order_t.ot_code where ot_show = 'Y' and cart_t.ct_select = 2 and order_t.mt_idx = ".$member_info['idx'];

if($_GET['s_date'] && $_GET['e_date']) {
    $query .= " and ot_pdate between '".$_GET['s_date']." 00:00:00' and '".$_GET['e_date']." 23:59:59'";
}
$query .= " group by order_t.ot_code";
$count = $DB->select_query($query);
if($count) {
    $count = count($count);
}
$row_cnt = $count;
$couwt_query = $row_cnt;
$counts = $couwt_query;
$n_page = ceil($couwt_query / $n_limit);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;
$counts = $counts - (($pg - 1) * $n_limit);

unset($list);
$sql_query = $query." order by ot_pdate desc limit ".$n_from.", ".$n_limit;
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
                    <li class="t_active"><a href="/artist_my_orderlist.php"><?=$order?></a></li>
                    <li><a href="/artist_my_like.php"><?=$favorites?></a></li>
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
                    <section class="calendar_wrap on">
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

                <div class="mp_order_chk d-flex justify-content-between align-items-center mb-5">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="chk_all" onclick="f_checkbox_all2('defaultCheck');">
                        <label class="form-check-label" for="chk_all">
                            <div class="chkbox">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <?=$whole?>
                        </label>
                    </div>
                    <button type="button" class="cart_del" onclick="del_order()"><img src="img/ic_del.png" alt=""><?=$select_del?></button>
                </div>
                <? if($list) {
                    foreach ($list as $row) {
                        ?>
                        <div class="mp_order">
                            <div class="order_hd mp_order_hd">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="<?=$row['ot_code']?>" id="defaultCheck<?=$row['ot_code']?>">
                                    <label class="form-check-label mp_chk_label_wr" for="defaultCheck<?=$row['ot_code']?>">
                                        <div class="chkbox">
                                            <i class="bi bi-check-lg"></i>
                                        </div>
                                        <div class="mp_chk_label">
                                            <span class="fw_500 order_hd_fs"><?=DateType($row['ot_pdate'])?></span><span class="order_hd_fs2">(<?=$order_code?>: <?=$row['ot_code']?>)</span>
                                        </div>
                                    </label>
                                </div>
                                <button type="button" class="mp_detail" onclick="location.href='artist_my_orderlist_detail.php?ot_code=<?=$row['ot_code']?>&<?=$_get_txt.$_GET['pg']?>';"><?=$detail?><img src="img/arrow_right.png" alt=""></button>
                            </div>
                            <?
                            $query = "select * from order_t left join cart_t on cart_t.ot_code = order_t.ot_code where order_t.mt_idx = ".$member_info['idx']." and order_t.ot_code = '".$row['ot_code']."'";
                            $list_p = $DB->select_query($query);
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
                                    <ul class="order_list">
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
                                                        <?= date("Y-m-d", strtotime("+2 weeks", strtotime($row['ot_pdate'])));?>
                                                    </p>
                                                </div>
                                                <div class="order_cont mp_down_cont">
                                                    <?
                                                    if(date("Y-m-d", strtotime("+2 weeks", strtotime($row['ot_pdate']))) < date("Y-m-d", time())) {
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
                                                        <a href="/download.php?type=artist&ot_pcode=<?=$row['ot_pcode']?>&s=<?=$url?>">
                                                            <button type="button" class="btn btn-outline-primary btn_download"><?=$download?></button>
                                                        </a>
                                                        <?
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <?
                                }
                            }
                            ?>
                        </div>
                        <?
                    }
                }
                ?>
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
        location.replace("/artist_my_orderlist.php?search_date="+date+"&s_date="+dateFormat(s_date)+"&e_date="+dateFormat(now));
    }

    function chk_calendar(type) {
        if(type != 1) {
            if($("#datepicker").val() == "") {
                alert("시작날짜를 선택해주세요.");
                return false;
            }
            location.replace("/artist_my_orderlist.php?s_date="+$("#datepicker").val().replaceAll(".", "-")+"&e_date="+$("#datepicker2").val().replaceAll(".", "-"));
        }
    }

    function f_checkbox_all2(obj) {
        $('input:checkbox[id^="'+obj+'"]').each(function() {
            if($("#chk_all").prop("checked") == true) {
                $(this).prop('checked', true);
            } else {
                $(this).prop('checked', false);
            }
        });

        return false;
    }

    function del_order() {
        var cnt = 0;
        var ot_code = "";
        $('input:checkbox[id^="defaultCheck"]').each(function() {
            if($(this).prop("checked") == true) {
                cnt++;
                ot_code += $(this).val()+",";
            }
        });
        if(cnt == 0) {
            alert("삭제할 주문내역을 선택해주세요.");
            return false;
        }
        $.ajax({
            type: 'post',
            url: '/models/cart_model.php',
            dataType: 'json',
            data: {type: "del_order", ot_code: ot_code},
            success: function (d, s) {
                if (d.result == '_ok') {
                    alert(d.msg);
                    location.reload();
                } else {
                    alert(d.msg);
                }
            },
            cache: false
        });
    }
</script>


<? include_once("./inc/tail.php"); ?>