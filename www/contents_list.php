<?php
$title = "영상 콘텐츠리스트";

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
$editorial = lang("editorial", $_lang, "contents");
$resolution2 = lang("resolution", $_lang, "contents");
$category = lang("category", $_lang, "contents");
$frame = lang("frame", $_lang, "contents");
$playtime = lang("playtime", $_lang, "contents");
$filter_open = lang("filter_open", $_lang, "contents");
$whole = lang("whole", $_lang, "order");
$num_search = lang("num_search", $_lang, "contents");
$search_txt = lang("search_txt", $_lang, "artists");
$search_txt2 = lang("search_txt2", $_lang, "artists");
$order_btn = lang("order_btn", $_lang, "artists");
$search_x = lang("search_x", $_lang, "artists");
$cart1 = lang("cart1", $_lang, "modal");
$cart2 = lang("cart2", $_lang, "modal");
$download = lang("download", $_lang, "order");
$Exclusive_content = lang("Exclusive_content", $_lang, "contents_upload");

$_get_txt = "ct_type=".$_GET['ct_type']."&ct_idx=".$_GET['ct_idx']."&search_txt=".$_GET['search_txt']."&page_cnt=".$_GET['page_cnt']
    ."&ct_editorial=".$_GET['ct_editorial']."&ct_resolution=".$_GET['ct_resolution']."&ct_filter=".$_GET['ct_filter']."&ct_framerate=".$_GET['ct_framerate']."&ct_playtime=".$_GET['ct_playtime']
    ."&pg=";
if($_GET['page_cnt']) {
    $n_limit = $_GET['page_cnt'];
} else {
    $n_limit = 20;
}

$pg = $_GET['pg'];

$query = "select contents_t.*, (SELECT ct_name FROM category_t WHERE idx=ct_cate_idx2) as ct_name, (SELECT mt_nickname FROM member_t WHERE idx=mt_idx) as mt_nickname, 
        (SELECT mt_image FROM member_t WHERE idx=mt_idx) as mt_image
        from contents_t 
        left join contents_keyword_t on contents_keyword_t.ct_idx = contents_t.idx
        where ct_status = 2 and ct_show = 'Y' and ct_type = ".$_GET['ct_type'];
$count_query = "SELECT COUNT(idx) AS cnt FROM (select contents_t.idx
        from contents_t 
        left join contents_keyword_t on contents_keyword_t.ct_idx = contents_t.idx
        where ct_status = 2 and ct_show = 'Y' and ct_type = ".$_GET['ct_type'];
if($_GET['search_txt']) {
    $where_query .= " and (instr(ct_title, '".$_GET['search_txt']."') or instr(ct_korean, '".$_GET['search_txt']."') or instr(ct_english, '".$_GET['search_txt']."')) ";
}
if($_GET['ct_idx']) {
    $where_query .= " and ct_cate_idx2 = ".$_GET['ct_idx'];
} else {
    if($_GET['ct_type'] == 1) {
        $where_query .= " and ct_cate_idx2 = 2";
    } else {
        $where_query .= " and ct_cate_idx2 = 12";
    }
}
if($_GET['ct_editorial']) {
    $where_query .= " and ct_editorial = '".$_GET['ct_editorial']."'";
}
if($_GET['ct_exclusive']) {
    $where_query .= " and ct_exclusive = '".$_GET['ct_exclusive']."'";
}
if($_GET['ct_resolution']) {
    $ct_resolution = explode(",", $_GET['ct_resolution']);
    $where_query .= " and (";
    foreach ($ct_resolution as $resolution) {
        $where_query .= " instr(ct_resolution, '".$resolution."') or";
    }
    $where_query = substr($where_query, 0, -2);
    $where_query .= ")";
}
if($_GET['ct_filter']) {
    $where_query .= " and ct_filter in (".$_GET['ct_filter'].")";
}
if($_GET['ct_framerate']) {
    $where_query .= " and ct_framerate in (".$_GET['ct_framerate'].")";
}
if($_GET['ct_playtime']) {
    if($_GET['ct_playtime'] == 0) {
        $time = "00:00:30";
        $where_query .= " and ct_playtime < '".$time."' ";
    } else if($_GET['ct_playtime'] == 30) {
        $st_time = "00:00:30";
        $en_time = "00:00:60";
        $where_query .= " and (ct_playtime >= '".$st_time."' and ct_playtime <= '".$en_time."') ";
    } else if($_GET['ct_playtime'] == 60) {
        $st_time = "00:00:60";
        $en_time = "00:01:20";
        $where_query .= " and (ct_playtime >= '".$st_time."' and ct_playtime <= '".$en_time."') ";
    } else {
        $time = "00:01:20";
        $where_query .= " and ct_playtime >= '".$time."' ";
    }
}

$row_cnt = $DB->fetch_assoc($count_query.$where_query." group by contents_t.idx ) A");
$counts = $row_cnt['cnt'];
$n_page = ceil($counts / $n_limit);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;
$counts = $counts - (($pg - 1) * $n_limit);

unset($list);
$sql_query = $query.$where_query." group by contents_t.idx order by ct_wdate desc limit ".$n_from.", ".$n_limit;
$list = $DB->select_query($sql_query);

if($_GET['ct_idx']) {
    $query = "select * from category_t where idx = ".$_GET['ct_idx'];
    $category2 = $DB->fetch_assoc($query);
    $menu = $category2['ct_name'];
} else {
    if($_GET['ct_type'] == 1) {
        $menu = "4K";
    } else {
        $menu = "LUT";
    }
}

if($_SESSION['_lang'] == "en") {
    $url = 'https://quotation-api-cdn.dunamu.com/v1/forex/recent?codes=FRX.KRWUSD';
    $result = get_exchange_rate($url);
    $data = json_decode($result,true);
    $data = $data[0];

    $_provider = $data['provider'];

    $_buying = $data['cashBuyingPrice'];
    $_selling = $data['cashSellingPrice'];
    $_ttselling = $data['ttSellingPrice'];
    $_ttbuyling = $data['ttBuyingPrice'];
    $_usd = $data['basePrice'];
    $_openusd = $data['openingPrice'];
    $_chusd = $data['changePrice'];
    $_openusd_o = $_usd - $_openusd;
    $_openusd_op = ($_chusd/$_usd)*100;
    $_openusd = round($_openusd,2);

    $dollar = sprintf('%0.2f',$_usd);
}
?>

<style>
    .footer_wrap{
        margin-top: 0px;
    }
    @media screen and (min-width: 1200px) {
        .ld_c1{left: 0;}
        .ld_c2{
            left: calc(-100% - 20px);
        }
        .ld_c3{
            left: calc(-200% - 40px);
        }
        .ld_c4{
            left: calc(-300% - 60px);
        }
        .ld_c5{
            left: calc(-400% - 80px);
        }
    }
    @media screen and (max-width: 1200px) {
        .ld_c1{left: 0;}
        .ld_c2{
            left: calc(-100% - 20px);
        }
        .ld_c3{
            left: calc(-200% - 40px);
        }
        .ld_c4{
            left: calc(-300% - 60px);
        }
    }
    @media screen and (max-width: 992px) {
        .ld_c1{left: 0;}
        .ld_c2{
            left: calc(-100% - 20px);
        }
        .ld_c3{
            left: calc(-200% - 40px);
        }
    }
    @media screen and (max-width: 768px) {
        .ld_c1{left: 0;}
        .ld_c2{
            left: calc(-100% - 20px);
        }
    }
</style>

<div class="wrap wrap_flex">
    <div class="container_aside">
        <div class="mobile_filter">
            <button type="button" class="btn btn-secondary btn_filter"><img src="img/ic_filter.png" alt=""><?=$filter_open?></button>
        </div>
        <? if($_GET['ct_idx'] != 12 && $_GET['ct_idx'] != 14 && $_GET['ct_idx'] != 15 && $_GET['ct_idx'] != 16) { ?>
        <div class="side_filter">
            <div class="filter_close"><img src="img/ic_x.png" alt="닫기"></div>
            <ul class="side_filter_list">
                <li>            
                    <div class="form-check side_filter_tit">
                        <input class="form-check-input" type="checkbox" value="" id="ct_editorial" name="ct_editorial" <? if($_GET['ct_editorial'] == "Y") echo "checked"; ?> onclick="filtering();">
                        <label class="form-check-label" for="ct_editorial">
                            <div class="chkbox chkbox-sm">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <?=$editorial?>
                        </label>
                    </div>
                </li>
                <li>
                    <div class="form-check side_filter_tit">
                        <input class="form-check-input" type="checkbox" value="" id="ct_exclusive" name="ct_exclusive" <? if($_GET['ct_exclusive'] == "Y") echo "checked"; ?> onclick="filtering();">
                        <label class="form-check-label" for="ct_exclusive">
                            <div class="chkbox chkbox-sm">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <?=$Exclusive_content?>
                        </label>
                    </div>
                </li>
                <?
                if($_GET['ct_idx'] == 9 || $_GET['ct_idx'] == 13 || $_GET['ct_idx'] == 17 || $_GET['ct_idx'] == 18 || $_GET['ct_idx'] == 19)  {
                ?>
                <li class="on" id="li1">
                    <div class="side_filter_tit side_filter_tit1 d-flex justify-content-between align-items-center">
                        <p><img src="img/ic_resolution.png" alt=""> <?=$resolution2?></p>
                        <div class="more">
                            <div class="more_p"><img src="img/ic_plus.png" alt=""></div>
                            <div class="more_m"><img src="img/ic_minus.png" alt=""></div>
                        </div>
                    </div>
                    <ul class="sub_filter">
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="6K +" name="ct_resolution" id="defaultCheck2" <? if(preg_match("/6K +/", $_GET['ct_resolution'])){ echo "checked"; } ?> onclick="filtering();">
                                <label class="form-check-label" for="defaultCheck2">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    6K +
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="4K" name="ct_resolution" id="defaultCheck3" <? if(preg_match("/4K/", $_GET['ct_resolution'])){ echo "checked"; } ?> onclick="filtering();">
                                <label class="form-check-label" for="defaultCheck3">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    4K
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="FHD" name="ct_resolution" id="defaultCheck4" <? if(preg_match("/\bFHD\b/", $_GET['ct_resolution'])){ echo "checked"; } ?> onclick="filtering();">
                                <label class="form-check-label" for="defaultCheck4">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    FHD(1920 x 1080)
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="HD" name="ct_resolution" id="defaultCheck5" <? if(preg_match("/\bHD\b/", $_GET['ct_resolution'])){ echo "checked"; } ?> onclick="filtering();">
                                <label class="form-check-label" for="defaultCheck5">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    HD(1280 x 720)
                                </label>
                            </div>
                        </li>
                    </ul>
                </li>
                <? } ?>
                <? if(($_GET['ct_type'] == 1) || ($_GET['ct_type'] == 2 && ($_GET['ct_idx'] == 17 || $_GET['ct_idx'] == 18 || $_GET['ct_idx'] == 19))) { ?>
                <li id="li2">
                    <div class="side_filter_tit side_filter_tit1 d-flex justify-content-between align-items-center">
                        <p><img src="img/ic_cate.png" alt=""> <?=$category?></p>
                        <div class="more">
                            <div class="more_p"><img src="img/ic_plus.png" alt=""></div>
                            <div class="more_m"><img src="img/ic_minus.png" alt=""></div>
                        </div>
                    </div>
                    <ul class="sub_filter">
                        <?
                        $filter_cnt = 6;
                        foreach ($arr_filter as $key => $val) {
                        ?>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="<?=$key?>" name="ct_filter" id="defaultCheck<?=$filter_cnt?>" <? if(preg_match("/$key/", $_GET['ct_filter'])){ echo "checked"; } ?> onclick="filtering();">
                                <label class="form-check-label" for="defaultCheck<?=$filter_cnt?>">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    <?=$val?>
                                </label>
                            </div>
                        </li>
                        <?
                            $filter_cnt++;
                        }
                        ?>
                    </ul>
                </li>
                <? } ?>
                <? if($_GET['ct_idx'] != 17 && $_GET['ct_idx'] != 18 && $_GET['ct_idx'] != 19) { ?>
                <li id="li3">
                    <div class="side_filter_tit side_filter_tit1 d-flex justify-content-between align-items-center">
                        <p><img src="img/ic_frame.png" alt=""> <?=$frame?></p>
                        <div class="more">
                            <div class="more_p"><img src="img/ic_plus.png" alt=""></div>
                            <div class="more_m"><img src="img/ic_minus.png" alt=""></div>
                        </div>
                    </div>
                    <ul class="sub_filter">
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="24" name="ct_framerate" id="defaultCheck20" <? if(preg_match("/24/", $_GET['ct_framerate'])){ echo "checked"; } ?> onclick="filtering();">
                                <label class="form-check-label" for="defaultCheck20">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    24fps
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="25" name="ct_framerate" id="defaultCheck21" <? if(preg_match("/25/", $_GET['ct_framerate'])){ echo "checked"; } ?> onclick="filtering();">
                                <label class="form-check-label" for="defaultCheck21">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    25fps
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="30" name="ct_framerate" id="defaultCheck22" <? if(preg_match("/30/", $_GET['ct_framerate'])){ echo "checked"; } ?> onclick="filtering();">
                                <label class="form-check-label" for="defaultCheck22">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    30fps
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="60" name="ct_framerate" id="defaultCheck23" <? if(preg_match("/60/", $_GET['ct_framerate'])){ echo "checked"; } ?> onclick="filtering();">
                                <label class="form-check-label" for="defaultCheck23">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    60fps
                                </label>
                            </div>
                        </li>
                    </ul>
                </li>
                <li id="li4">
                    <div class="side_filter_tit side_filter_tit1 d-flex justify-content-between align-items-center">
                        <p><img src="img/ic_playtime.png" alt=""> <?=$playtime?></p>
                        <div class="more">
                            <div class="more_p"><img src="img/ic_plus.png" alt=""></div>
                            <div class="more_m"><img src="img/ic_minus.png" alt=""></div>
                        </div>
                    </div>
                    <ul class="sub_filter">
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="0" id="defaultCheck31" name="ct_playtime" <? if(preg_match("/\b0\b/", $_GET['ct_playtime'])){ echo "checked"; } ?> onclick="filtering();">
                                <label class="form-check-label" for="defaultCheck31">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    30초 미만
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="30" id="defaultCheck32" name="ct_playtime" <? if(preg_match("/\b30\b/", $_GET['ct_playtime'])){ echo "checked"; } ?> onclick="filtering();">
                                <label class="form-check-label" for="defaultCheck32">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    30초 - 60초
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="60" id="defaultCheck33" name="ct_playtime" <? if(preg_match("/\b60\b/", $_GET['ct_playtime'])){ echo "checked"; } ?> onclick="filtering();">
                                <label class="form-check-label" for="defaultCheck33">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    60초 - 120초
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="120" id="defaultCheck34" name="ct_playtime" <? if(preg_match("/\b120\b/", $_GET['ct_playtime'])){ echo "checked"; } ?> onclick="filtering();">
                                <label class="form-check-label" for="defaultCheck34">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    120초 이상
                                </label>
                            </div>
                        </li>
                    </ul>
                </li>
                <? } ?>
            </ul>
        </div>
        <? } ?>
    </div>
    <div class="container container_content">
        <div class="row">
            <div class="col-12">
                <div class="content_pg_wr">
                    <h2 class="ff_play"><?=$menu?></h2>
                    <form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>">
                    <input type="hidden" name="ct_type" value="<?=$_GET['ct_type']?>"/>
                    <input type="hidden" name="ct_idx" value="<?=$_GET['ct_idx']?>"/>
                    <input type="hidden" name="page_cnt" value="<?=$_GET['page_cnt']?>"/>
                    <input type="hidden" name="ct_editorial" value="<?=$_GET['ct_editorial']?>"/>
                    <input type="hidden" name="ct_exclusive" value="<?=$_GET['ct_exclusive']?>"/>
                    <input type="hidden" name="ct_resolution" value="<?=$_GET['ct_resolution']?>"/>
                    <input type="hidden" name="ct_filter" value="<?=$_GET['ct_filter']?>"/>
                    <input type="hidden" name="ct_framerate" value="<?=$_GET['ct_framerate']?>"/>
                    <input type="hidden" name="ct_playtime" value="<?=$_GET['ct_playtime']?>"/>
                    <div class="wr_form d-flex">
                        <div class="wr_f_txt"><?=$whole?> <?=$counts?></div>
                        <div class="form-group form-group_1 form_select form_l">
                            <select class="form-control" aria-placeholder="선택해주세요." id="pagecnt" onchange="chg_pagecnt()">
                                <option value="20">20<?=$num_search?></option>
                                <option value="40">40<?=$num_search?></option>
                                <option value="80">80<?=$num_search?></option>
                                <option value="100">100<?=$num_search?></option>
                            </select>
                        </div>
                        <div class="form-group form-group_1 form_r">
                            <label for="extInput" class="search_label_1"><?=$search_txt?> <span class="hide_text"><?=$search_txt2?></span></label>
                            <input type="text" class="form-control" id="textInput" name="search_txt">
                            <button class="btn btn-link btn_sch btn_sch_1" type="submit"><img src="img/ic_sub_search.png" alt="검색"> </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            var j = 1;
        </script>
        <?if($list) { ?>
        <div class="accordion" id="collapse_parent">
            <div class="ct_list row row-cols-2 row-cols-xl-5 row-cols-lg-4 row-cols-md-3">
                <?
                    $i = 1;
                    foreach ($list as $row) {
                        $ct_filter = "";
                        $filter = explode(",", $row['ct_filter']);
                        foreach ($filter as $f) {
                            $ct_filter .= $arr_filter[$f].",";
                        }
                        $ct_filter = substr($ct_filter, 0, -1);
                        if($member_info['idx']) {
                            $query = "select * from wish_contents_t where mt_idx = " . $member_info['idx'] . " and ct_idx = " . $row['idx'] . " and wct_status = 'Y'";
                            $wish_chk = $DB->fetch_assoc($query);
                        }
                        $key = $row['ct_file'];
                        $cmd = $s3->getCommand('GetObject', [
                            'Bucket' => $bucket,
                            'Key' => $key
                        ]);
                        $request = $s3->createPresignedRequest($cmd, '+20 minutes');
                        $presignedUrl = (string)$request->getUri();

                        $url = explode("https://bucket.object.ncloudstorage.com/", $presignedUrl);
                        $url = $url[1];
                ?>
                <div class="col">
                    <div class="ct_box" id="heading<?=$row['idx']?>" onclick="show_video(<?=$row['idx']?>)">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse<?=$row['idx']?>" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="<?=$ct_img_url."/".$row['ct_image']?>">
                            <?
                            if($row['ct_type'] == 1) {      //영상
                                ?>
                                <video class="video_item" muted loop playsinline id="preview<?=$row['idx']?>">
                                    <source src='<?=$ct_audio_url."/preview/ct_file_preview_".$row['idx'].".mp4?cache=".strtotime($row['ct_udate'])?>' type='video/mp4'/>
                                </video>
                            <?
                            } else {
                                if($row['ct_cate_idx2'] == 14 || $row['ct_cate_idx2'] == 15) {
                                    if($row['ct_preview']) {
                                        ?>
                                        <video class="video_item" muted loop id="preview<?=$row['idx']?>" playsinline>
                                            <source src='<?=$ct_audio_url."/preview/".$row['ct_preview']?>' type='video/mp4'/>
                                        </video>
                                        <?
                                    } else {
                                        ?>
                                        <img src="<?=$ct_img_url."/".$row['ct_image']?>">
                                        <?
                                    }
                                } else {
                                    ?>
                                    <img src="<?=$ct_img_url."/".$row['ct_image']?>">
                                    <?
                                }
                            }
                            ?>
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time"><?=$row['ct_playtime']?></p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" onclick="cart_ing('<?=$row['idx']?>')">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn <? if($wish_chk) { echo 'on'; }?>" onclick="wish_ing('<?=$row['idx']?>', 'content', 'list')">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse<?=$row['idx']?>" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt"><?=$row['ct_name']?></p>
                                <p class="ct_tit fw_500"><?=$row['ct_title']?></p>
                            </div>
                        </div>
                    </div>
                    <!-- 리스트 클릭시 -->
                    <div class="list_detail list_detail_2 collapse <? if($_GET['idx'] == $row['idx']) echo "show"; ?>" id="collapse<?=$row['idx']?>" aria-labelledby="heading<?=$row['idx']?>" data-parent="#collapse_parent">
                        <button type="button" class="close btn_close" data-toggle="collapse" data-target="#collapse<?=$row['idx']?>" aria-expanded="false" aria-controls="collapseExample">
                            <img src="img/ic_x.png" alt="닫기">
                        </button>
                        <div class="list_detail_wrap">
                            <div class="list_detail_video">
                                <div class="square">
                                    <?
                                    if($row['ct_type'] == 1) {      //영상
                                        ?>
                                        <video class="video_item" muted loop id="video<?=$row['idx']?>" playsinline>
                                            <source src='<?=$ct_audio_url."/preview/ct_file_preview_".$row['idx'].".mp4?cache=".strtotime($row['ct_udate'])?>' type='video/mp4'/>
                                        </video>
                                    <?
                                    } else {
                                        if($row['ct_cate_idx2'] == 14 || $row['ct_cate_idx2'] == 15) {
                                            if($row['ct_preview']) {
                                    ?>
                                        <video class="video_item" muted loop id="video<?=$row['idx']?>" playsinline>
                                            <source src='<?=$ct_audio_url."/preview/".$row['ct_preview']?>' type='video/mp4'/>
                                        </video>
                                    <?
                                            } else {
                                    ?>
                                        <img src="<?=$ct_img_url."/".$row['ct_image']?>">
                                    <?
                                            }
                                        } else {
                                            ?>
                                        <img src="<?=$ct_img_url."/".$row['ct_image']?>">
                                    <?
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="detail_text cart_cont">
                                <div class="cart_cate d-flex align-items-center">
                                    <p><?=$ct_filter?></p>
                                    <?
                                    foreach($arr_program as $key => $val) {
                                        if($key) {
                                            $program = explode(",", $row['ct_program']);
                                            foreach ($program as $p_row) {
                                                if($key == $p_row) {
                                                    if($key == 1) {
                                                        $url = 'ic_premiere.png';
                                                    } else if($key == 2) {
                                                        $url = 'ic_aftereffect.png';
                                                    } else if($key == 3) {
                                                        $url = 'ic_davinci.png';
                                                    } else if($key == 4) {
                                                        $url = 'ic_vegas.png';
                                                    } else if($key == 5) {
                                                        $url = 'ic_finalcut.png';
                                                    } else if($key == 6) {
                                                        $url = 'ic_illustrator.png';
                                                    } else if($key == 7) {
                                                        $url = 'ic_photoshop.png';
                                                    } else {
                                                        $url = 'ic_indesign.png';
                                                    }
                                                    ?>
                                                    <div class="cart_icon_p"><img src="<?=STATIC_HTTP."/img/".$url?>"></div>
                                                    <?
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                                <h4 class="cart_tit ff_play"><?=$row['ct_title']?></h4>
                                <div class="cart_artist">
                                    <div class="square"><img src="<? if($row['mt_image']) echo $ct_img_url."/".$row['mt_image']; else echo $ct_member_no_img_url;?>" alt=""></div>
                                    <span class="at_name"><?=$row['mt_nickname']?></span>
                                </div>
                                <div class="cart_de">
                                    <div class="cart_op"><span class="badge badge-secondary fw_600"><?=$row['ct_resolution']?></span><span class="c_reso"><?=$arr_resolution2[$row['ct_resolution']]?></span></div>
                                </div>
                                <hr class="hr2">
                                <ul class="detail_data">
                                    <li>
                                        <p class="f_name">Frame rate</p>
                                        <p class="f_sub"><?=($row['ct_framerate']=="") ? "00":$row['ct_framerate']?>.00</p>
                                    </li>
                                    <li>
                                        <p class="f_name">Length</p>
                                        <p class="f_sub"><?=$row['ct_playtime']?></p>
                                    </li>
                                    <li>
                                        <p class="f_name">Format</p>
                                        <p class="f_sub"><?=$row['ct_format']?></p>
                                    </li>
                                    <li>
                                        <p class="f_name">Size</p>
                                        <p class="f_sub"><?=$row['ct_size']?></p>
                                    </li>
                                </ul>
                                <hr class="hr2">
                                <div class="d-flex justify-content-between align-items-end">
                                    <p class="price_name">PRICE</p>
                                    <?
                                    if($_SESSION['_lang'] == "en") {
                                        ?>
                                        <div class="cart_price">$<span class="price ff_play"><?=number_format($row['ct_price'] / $dollar,2)?></span></div>
                                        <?
                                    } else {
                                        ?>
                                        <div class="cart_price"><span class="price ff_play"><?=number_format($row['ct_price'])?></span>원</div>
                                        <?
                                    }
                                    ?>
                                </div>
                                <div class="detail_btn d-flex">
                                    <?
                                    if($member_info['idx']) {
                                        $query = "select * from wish_contents_t where mt_idx = " . $member_info['idx'] . " and ct_idx = " . $row['idx'] . " and wct_status = 'Y'";
                                        $wish_chk = $DB->fetch_assoc($query);
                                    }
                                    ?>
                                    <form name="info" id="info" method="post">
                                        <input type="hidden" name="type" id="type" value="insert">
                                        <input type="hidden" name="order_act" id="order_act">
                                        <input type="hidden" name="membership" id="membership">
                                        <button type="button" class="btn_cart btn_circle mr-4" onclick="cart_ing('<?=$row['idx']?>')"><div class="ic_cart_lg"><img src="img/ic_cart.png" alt=""></div></button>
                                    </form>
                                    <button type="button" class="btn_heart btn_circle mr-4 <? if($wish_chk) { echo 'on'; }?>" onclick="wish_ing('<?=$row['idx']?>', 'content')"><div class="ic_heart_lg"><img class="off" src="img/ic_heart_lg.png" alt=""><img class="on" src="img/ic_heart_lg_b.png" alt=""></div></button>
                                    <button type="button" class="btn btn-primary btn_buy" onclick="chk_membership('<?=$row['idx']?>');order_ing('<?=$row['idx']?>')"><?=$download?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        if(window.outerWidth >= 1200) {
                            if(j > 5) {
                                j = 1;
                            }
                        } else if(window.outerWidth < 1200 && window.outerWidth >= 992) {
                            if(j > 4) {
                                j = 1;
                            }
                        } else if(window.outerWidth < 992 && window.outerWidth >= 768) {
                            if(j > 3) {
                                j = 1;
                            }
                        } else if(window.outerWidth < 768) {
                            if(j > 2) {
                                j = 1;
                            }
                        }
                        $("#collapse<?=$row['idx']?>").addClass("ld_c"+j);
                        j += 1;
                    </script>
                </div>
                <!-- 리스트 클릭시 끝 -->
            <?
                }
            ?>
            </div>
        </div>
        <?
        } else {
        ?>
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
    //작은 화면일때 마우스 오버시 프리뷰 재생
    $('.ct_box').hover(function() {
        if($("#"+this.id).children().children('video').length > 0){
            $("#"+this.id).children().children('video').css("display", "block");

            var video_id = $("#"+this.id).children().children('video')[0].id;

            startPreview(video_id);
            previewTimeout = setTimeout(function () {
                stopPreview(video_id);
            }, 15000);
        } else {
            $("#"+$(this).children().children('img')[1].id).attr("src", $("#"+$(this).children().children('img')[1].id).data("animated"))
        }
    }, function(){
        if($("#"+this.id).children().children('video').length > 0) {
            $("#" + this.id).children().children('video').css("display", "none");
            stopPreview($("#" + this.id).children().children('video')[0].id);
        } else {
            $("#"+$(this).children().children('img')[1].id).attr("src", $("#"+$(this).children().children('img')[1].id).data("static"))
        }
    });

    $(document).ready(function () {
        if("<?=$_GET['page_cnt']?>") {
            $("#pagecnt").val("<?=$_GET['page_cnt']?>");
        } else {
            $("#pagecnt").val("20");
        }

        if("<?=$_GET['idx']?>" != "") {
            show_video("<?=$_GET['idx']?>", "cart");
        }
        if($('input:checkbox[name=ct_resolution]:checked').length > 0) {
            $("#li1").addClass("on");
        }
        if($('input:checkbox[name=ct_filter]:checked').length > 0) {
            $("#li2").addClass("on");
        }
        if($('input:checkbox[name=ct_framerate]:checked').length > 0) {
            $("#li3").addClass("on");
        }
        if($('input:checkbox[name=ct_playtime]:checked').length > 0) {
            $("#li4").addClass("on");
        }
    });

    $(".side_filter li .side_filter_tit").on("click",function(){
        $(this).parents("li").toggleClass("on");
    })
    $(".m_over_btn").on("click",function(){
        $(this).toggleClass("on");
    })
    $(".btn_heart").on("click",function(){
        $(this).toggleClass("on");
    })
    $(".btn_filter").on("click",function(){
        $(".side_filter").toggleClass("on");
    })
    $(".filter_close").on("click",function(){
        $(".side_filter").removeClass("on");
    })

    //동영상 우클릭 금지
    // $(document).bind("contextmenu", function(e){
    //     return false;
    // });
    // $('video[id^="video"]').bind("contextmenu",function(e){
    //     return false;
    // });
    // $('video[id^="video"]').bind("selectstart",function(e){
    //     return false;
    // });
    // $(document).on("contextmenu dragstart selectstart",function(e){
    //     return false;
    // });

    const video = document.querySelectorAll(".video_item");
    let previewTimeout = null;

    function startPreview(video1) {
        $("#"+video1).muted = true;
        $("#"+video1)[0].currentTime = 0;
        $("#"+video1).playbackRate = 1;
        $("#"+video1)[0].play();
    }

    function stopPreview(video2) {
        $("#"+video2)[0].currentTime = 0;
        $("#"+video2).playbackRate = 1;
        $("#"+video2)[0].pause();

        if(previewTimeout != null) {
            startPreview(video2);
            previewTimeout = setTimeout(function() { stopPreview(video2) }, 15000);
        }
    }

    function show_video(idx, act) {
        if(act == "cart") {
            startPreview("video" + idx);
            previewTimeout = setTimeout(function () {
                stopPreview("video" + idx)
            }, 15000);
        } else {
            if (!$("#collapse" + idx).hasClass("show")) {
                startPreview("video" + idx);
                previewTimeout = setTimeout(function () {
                    stopPreview("video" + idx)
                }, 15000);
            } else {
                clearTimeout(previewTimeout);
                previewTimeout = null;
                stopPreview("video" + idx);
            }
        }
    }

    function filtering() {
        var ct_editorial = "";
        var ct_exclusive = "";
        var ct_resolution = "";
        var ct_filter = "";
        var ct_framerate = "";
        var ct_playtime = "";

        if($("#ct_editorial").is(":checked")) {
            ct_editorial = "Y";
        } else {
            ct_editorial = "N";
        }

        if($("#ct_exclusive").is(":checked")) {
            ct_exclusive = "Y";
        } else {
            ct_exclusive = "N";
        }

        for(var i=0; i<$("input[name='ct_resolution']:checkbox").length; i++) {
            if($("input[name='ct_resolution']:checkbox")[i].checked) {
                ct_resolution += $("input[name='ct_resolution']:checkbox")[i].value+",";
            }
        }
        ct_resolution = ct_resolution.slice(0, -1);

        for(var i=0; i<$("input[name='ct_filter']:checkbox").length; i++) {
            if($("input[name='ct_filter']:checkbox")[i].checked) {
                ct_filter += $("input[name='ct_filter']:checkbox")[i].value+",";
            }
        }
        ct_filter = ct_filter.slice(0, -1);

        for(var i=0; i<$("input[name='ct_framerate']:checkbox").length; i++) {
            if($("input[name='ct_framerate']:checkbox")[i].checked) {
                ct_framerate += $("input[name='ct_framerate']:checkbox")[i].value+",";
            }
        }
        ct_framerate = ct_framerate.slice(0, -1);

        for(var i=0; i<$("input[name='ct_playtime']:checkbox").length; i++) {
            if($("input[name='ct_playtime']:checkbox")[i].checked) {
                ct_playtime += $("input[name='ct_playtime']:checkbox")[i].value+",";
            }
        }
        ct_playtime = ct_playtime.slice(0, -1);

        var url = "/contents_list.php?ct_type=<?=$_GET['ct_type']?>&ct_idx=<?=$_GET['ct_idx']?>&search_txt=<?=$_GET['search_txt']?>&page_cnt=<?=$_GET['page_cnt']?>";
        url += "&ct_editorial="+ct_editorial+"&ct_exclusive="+ct_exclusive+"&ct_resolution="+ct_resolution+"&ct_filter="+ct_filter+"&ct_framerate="+ct_framerate+"&ct_playtime="+ct_playtime+"&pg=";
        location.replace(url);
    }

    function chg_pagecnt() {
        var url = "ct_type=<?=$_GET['ct_type']?>&ct_idx=<?=$_GET['ct_idx']?>&search_txt=<?=$_GET['search_txt']?>&page_cnt="+$("#pagecnt option:selected").val()+"&ct_editorial=<?=$_GET['ct_editorial']?>&ct_resolution=<?=$_GET['ct_resolution']?>&ct_filter=<?=$_GET['ct_filter']?>&ct_framerate=<?=$_GET['ct_framerate']?>&ct_playtime=<?=$_GET['ct_playtime']?>&pg=";
        location.replace("/contents_list.php?"+url);
    }

    function cart_ing(idx) {
        const param = $("<input type='hidden' value=" + idx + " name='ct_idx'>");
        $("#info").append(param);
        $.ajax({
            type: 'post',
            url: '/models/cart_model.php',
            dataType: 'json',
            data: $("#info").serialize(),
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

    var result = 3;
    function chk_membership(idx) {
        $.ajax({
            type: 'post',
            url: '/models/cart_model.php',
            dataType: 'json',
            async: false,
            data: {type: "chk_membership", ct_idx: idx},
            success: function (d, s) {
                if (d.result == '_ok') {
                    result = 1;
                } else if (d.result == '_false2') {
                    result = 2;
                }
            },
            cache: false
        });
        return result;
    }

    function order_ing(idx) {
        if(result == 1) {
            $('#order_act').val('direct');
            $('#membership').val('membership');
            const param = $("<input type='hidden' value=" + idx + " name='ct_idx'>");
            $("#info").append(param);
            $.ajax({
                type: 'post',
                url: '/models/cart_model.php',
                dataType: 'json',
                data: $("#info").serialize(),
                success: function (d, s) {
                    if (d.result == '_ok') {
                        $("#modal_sm1").modal("show");
                    } else {
                        alert(d.msg);
                    }
                },
                cache: false
            });
            return false;
        } else if(result == 2) {
            $("#modal_sm3").modal("show");
            $('#ct_idx').val(idx);
            return false;
        } else {
            $('#order_act').val('direct');
            const param = $("<input type='hidden' value=" + idx + " name='ct_idx'>");
            $("#info").append(param);
            $.ajax({
                type: 'post',
                url: '/models/cart_model.php',
                dataType: 'json',
                data: $("#info").serialize(),
                success: function (d, s) {
                    if (d.result == '_ok') {
                        location.href = "/order.php";
                    } else {
                        alert(d.msg);
                        location.replace("/signin.php");
                    }

                },
                cache: false
            });
        }
    }

</script>

<? include_once("./inc/tail.php"); ?>