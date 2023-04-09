<?php
$title = "검색어 입력 완료";

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
$result_ment = lang("result", $_lang, "search");
$contents = lang("contents", $_lang, "search");
$artist = lang("artist", $_lang, "nav");
$search_x = lang("search_x", $_lang, "artists");
$order_btn = lang("order_btn", $_lang, "artists");
$cart1 = lang("cart1", $_lang, "modal");
$cart2 = lang("cart2", $_lang, "modal");
$download = lang("download", $_lang, "order");

$_get_txt = "search_txt=".$_GET['search_txt']."&pg=";
$n_limit = 40;
$pg = $_GET['pg'];

$query = "select contents_t.*, (SELECT ct_name FROM category_t WHERE idx=ct_cate_idx2) as ct_name, (SELECT mt_nickname FROM member_t WHERE idx=mt_idx) as mt_nickname, 
        (SELECT mt_image FROM member_t WHERE idx=mt_idx) as mt_image
        from contents_t 
        left join contents_keyword_t on contents_keyword_t.ct_idx = contents_t.idx
        where (instr(ct_title, '".$_GET['search_txt']."') or instr(ct_korean, '".$_GET['search_txt']."') or instr(ct_english, '".$_GET['search_txt']."')) and ct_status = 2 and ct_show = 'Y'
        group by contents_t.idx";

$count_query = "SELECT COUNT(idx) AS cnt FROM (select contents_t.idx
        from contents_t 
        left join contents_keyword_t on contents_keyword_t.ct_idx = contents_t.idx
        where (instr(ct_title, '".$_GET['search_txt']."') or instr(ct_korean, '".$_GET['search_txt']."') or instr(ct_english, '".$_GET['search_txt']."')) and ct_status = 2 and ct_show = 'Y'
        group by contents_t.idx ) A ";
$row_cnt = $DB->fetch_assoc($count_query);
$couwt_query = $row_cnt[0];
$counts = $couwt_query;
$n_page = ceil($couwt_query / $n_limit);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;
$counts = $counts - (($pg - 1) * $n_limit);

unset($list);
$sql_query = $query." order by ct_wdate desc limit ".$n_from.", ".$n_limit;
$list = $DB->select_query($sql_query);

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

<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-12 my-5">
                <div class="wr_tit2">
                    <h2>'<?=$_GET['search_txt']?>' <?=$result_ment?></h2>
                    <ul class="t_menu">
                        <li class="t_active"><a href="/search_result_contents.php?search_txt=<?=$_GET['search_txt']?>"><?=$contents?></a></li>
                        <li><a href="/search_result_artist.php?search_txt=<?=$_GET['search_txt']?>"><?=$artist?></a></li>
                    </ul>
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
                    foreach ($list as $row) {
                        if($member_info['idx']) {
                            $query = "select * from wish_contents_t where mt_idx = " . $member_info['idx'] . " and ct_idx = " . $row['idx'] . " and wct_status = 'Y'";
                            $wish_chk = $DB->fetch_assoc($query);
                        }
                        $ct_filter = "";
                        $filter = explode(",", $row['ct_filter']);
                        foreach ($filter as $f) {
                            $ct_filter .= $arr_filter[$f].",";
                        }
                        $ct_filter = substr($ct_filter, 0, -1);
                ?>
                <div class="col">
                    <div class="ct_box" id="heading<?=$row['idx']?>" onclick="show_video(<?=$row['idx']?>)">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse<?=$row['idx']?>" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="<?=$ct_img_url."/".$row['ct_image']?>">
                            <?
                            if($row['ct_type'] == 1) {      //영상
                            ?>
                            <video class="video_item" muted loop playsinline id="preview<?=$row['idx']?>">
                                <source src='<?=$ct_audio_url."/preview/ct_file_preview_".$row['idx'].".mp4"?>' type='video/mp4'/>
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
                                    <button type="button" class="btn m_over_btn <? if($wish_chk) { echo 'on'; }?>" onclick="wish_ing('<?=$row['idx']?>', 'content')">
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
                    <div class="list_detail list_detail_2 collapse" id="collapse<?=$row['idx']?>" aria-labelledby="heading<?=$row['idx']?>" data-parent="#collapse_parent">
                        <button type="button" class="close btn_close" data-toggle="collapse" data-target="#collapse<?=$row['idx']?>" aria-expanded="false" aria-controls="collapseExample">
                            <img src="img/ic_x.png" alt="닫기">
                        </button>
                        <div class="list_detail_wrap">
                            <div class="list_detail_video">
                                <div class="square">
                                    <?
                                    $key = $row['ct_file'];
                                    $cmd = $s3->getCommand('GetObject', [
                                        'Bucket' => $bucket,
                                        'Key' => $key
                                    ]);
                                    $request = $s3->createPresignedRequest($cmd, '+20 minutes');
                                    $presignedUrl = (string)$request->getUri();

                                    $url = explode("https://bucket.object.ncloudstorage.com/", $presignedUrl);
                                    $url = $url[1];
                                    if($row['ct_type'] == 1) {      //영상
                                        ?>
                                        <video class="video_item" muted loop id="video<?=$row['idx']?>" playsinline>
                                            <source src='<?=$ct_audio_url."/preview/ct_file_preview_".$row['idx'].".mp4"?>' type='video/mp4'/>
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
            <a class="toast_for fc_blue1" href="/cart.php"><?=$cart2?></a>
        </div>
    </div>
</div>

<script>
    //작은 화면일때 마우스 오버시 프리뷰 재생
    $('.ct_box').hover(function() {
        if($("#"+this.id).children().children('video').length > 0) {
            $("#" + this.id).children().children('video').css("display", "block");

            var video_id = $("#" + this.id).children().children('video')[0].id;

            startPreview(video_id);
            previewTimeout = setTimeout(function () {
                stopPreview(video_id);
            }, 15000);
        } else {
            $("#"+$(this).children().children('img')[1].id).attr("src", $("#"+$(this).children().children('img')[1].id).data("animated"))
        }
    }, function(){
        if($("#"+this.id).children().children('video').length > 0) {
            $("#"+this.id).children().children('video').css("display", "none");
            stopPreview($("#"+this.id).children().children('video')[0].id);
        } else {
            $("#"+$(this).children().children('img')[1].id).attr("src", $("#"+$(this).children().children('img')[1].id).data("static"))
        }
    });

    $(".side_filter li .side_filter_tit").on("click",function(){
        $(this).parents("li").toggleClass("on");
    });

    $(".m_over_btn").on("click",function(){
        $(this).toggleClass("on");
    });

    $(".btn_heart").on("click",function(){
        $(this).toggleClass("on");
    });

    $('video[id^="video"]').bind("contextmenu",function(e){
        return false;
    });
    $('video[id^="video"]').bind("selectstart",function(e){
        return false;
    });

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

    function show_video(idx) {
        if(!$("#collapse"+idx).hasClass("show")) {
            if($("#video"+idx).length > 0) {
                startPreview("video"+idx);
                previewTimeout = setTimeout(function() { stopPreview("video"+idx) }, 15000);
            }
        } else {
            clearTimeout(previewTimeout);
            previewTimeout = null;
            stopPreview("video"+idx);
        }
    }

    function cart_ing(idx){
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