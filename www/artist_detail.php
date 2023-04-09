<?php
$title = "아티스트 상세페이지";

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

if(!$_GET['mt_idx']) {
    p_alert("해당 아티스트가 존재하지않습니다.", "/artists.php");
    exit;
}

$_lang = $_SESSION['_lang'];
$favorites = lang("favorites", $_lang, "mypage");
$search_txt = lang("search_txt", $_lang, "artists");
$search_txt2 = lang("search_txt2", $_lang, "artists");
$search_x = lang("search_x", $_lang, "artists");
$order_btn = lang("order_btn", $_lang, "artists");
$cart1 = lang("cart1", $_lang, "modal");
$cart2 = lang("cart2", $_lang, "modal");
$download = lang("download", $_lang, "order");

$_get_txt = "mt_idx=".$_GET['mt_idx']."&search_txt=".$_GET['search_txt']."&pg=";
$n_limit = 25;
$pg = $_GET['pg'];

//전체 즐겨찾기 개수
$query = "select * from wish_contents_t left join contents_t on contents_t.idx = wish_contents_t.ct_idx where contents_t.mt_idx = " . $_GET['mt_idx'] . " and wct_status = 'Y'";
$wish_cnt = $DB->count_query($query);

//아티스트 정보
$query = "select * from member_t where idx = ".$_GET['mt_idx']." and mt_level = 5 and mt_login_status = 'Y'";
$row = $DB->fetch_assoc($query);

//아티스트의 콘텐츠 리스트
$query = "select *, (SELECT ct_name FROM category_t WHERE idx=ct_cate_idx2) as ct_name, (SELECT mt_nickname FROM member_t WHERE idx=mt_idx) as mt_nickname, 
        (SELECT mt_image FROM member_t WHERE idx=mt_idx) as mt_image
        from contents_t where mt_idx = ".$_GET['mt_idx']." and ct_show = 'Y' and ct_status = 2";
if($_GET['search_txt']) {
    $query .= " and instr(ct_title, '".$_GET['search_txt']."')";
}
$row_cnt = $DB->count_query($query);
$couwt_query = $row_cnt;
$counts = $couwt_query;
$n_page = ceil($couwt_query / $n_limit);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;
$counts = $counts - (($pg - 1) * $n_limit);

unset($contents);
$sql_query = $query." order by ct_wdate desc limit ".$n_from.", ".$n_limit;
$contents = $DB->select_query($sql_query);

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
        <div class="artist_pg_hd">
            <div class="filter">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="artist_hd_wr d-flex align-items-center">
                                <div class="artist_hd_img square">
                                    <img src="<? if($row['mt_image']) echo $ct_img_url."/".$row['mt_image']; else echo $ct_member_no_img_url;?>" alt="">
                                </div>
                                <div class="hd_tit hd_tit1">
                                    <h2 class="ff_play"><?=$row['mt_nickname']?></h2>
                                    <p><?=$row['mt_introduce']?></p>
                                    <span><img src="img/ic_heart.png" alt=""> <?=$favorites?> <?=number_format($wish_cnt)?></span>
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
                        <input type="hidden" name="mt_idx" value="<?=$_GET['mt_idx']?>">
                        <div class="wr_tit1 d-flex justify-content-between align-items-end">
                            <h2 class="ff_play">ARTIST</h2>
                            <div class="form-group form-group_1 sch_input_wrap">
                                <label for="search_txt" class="search_label"><?=$search_txt?> <span class="hide_text"><?=$search_txt2?></span></label>
                                <input type="text" class="form-control" id="search_txt" name="search_txt" value="<?=$_GET['search_txt']?>">
                                <button class="btn btn-link btn_sch btn_sch_1" type="submit"><img src="img/ic_sub_search.png" alt="검색"></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                var j = 1;
            </script>
            <? if($contents) { ?>
                <div class="accordion" id="collapse_parent">
                    <div class="ct_list row row-cols-2 row-cols-xl-5 row-cols-lg-4 row-cols-md-3">
                        <? foreach ($contents as $row_c) {
                            if($member_info['idx']) {
                                $query = "select * from wish_contents_t where mt_idx = " . $member_info['idx'] . " and ct_idx = " . $row_c['idx'] . " and wct_status = 'Y'";
                                $wish_chk = $DB->fetch_assoc($query);
                            }
                            $ct_filter = "";
                            $filter = explode(",", $row_c['ct_filter']);
                            foreach ($filter as $f) {
                                $ct_filter .= $arr_filter[$f].",";
                            }
                            $ct_filter = substr($ct_filter, 0, -1);
                            $key = $row_c['ct_file'];
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
                                <div class="ct_box" id="heading<?=$row_c['idx']?>" onclick="show_video(<?=$row_c['idx']?>)">
                                    <div class="video_list square rectangle" data-toggle="collapse" href="#collapse<?=$row_c['idx']?>" role="button" aria-expanded="false" aria-controls="collapse">
                                        <img src="<?=$ct_img_url."/".$row_c['ct_image']?>">
                                        <?
                                        if($row_c['ct_type'] == 1) {      //영상
                                            if(file_exists($_SERVER['DOCUMENT_ROOT']."/data/preview/ct_file_preview_".$row_c['idx'].".gif")) {
                                                ?>
                                                <img id="preview<?=$row_c['idx']?>" src="<?=$ct_img_url."/".$row_c['ct_image']?>" alt="" data-animated="<?=$ct_audio_url."/preview/ct_file_preview_".$row_c['idx'].".gif"?>" data-static="<?=$ct_img_url."/".$row_c['ct_image']?>" class="hov-anim">
                                            <? } else { ?>
                                                <video class="video_item" muted loop playsinline id="preview<?=$row_c['idx']?>">
                                                    <source src='<?=$ct_audio_url."/preview/ct_file_preview_".$row_c['idx'].".mp4"?>' type='video/mp4'/>
                                                </video>
                                            <? }
                                        } else {
                                            if($row_c['ct_cate_idx2'] == 14 || $row_c['ct_cate_idx2'] == 15) {
                                                if($row_c['ct_preview']) {
                                                    ?>
                                                    <video class="video_item" muted loop id="preview<?=$row_c['idx']?>" playsinline>
                                                        <source src='<?=$ct_audio_url."/preview/".$row_c['ct_preview']?>' type='video/mp4'/>
                                                    </video>
                                                    <?
                                                } else {
                                                    ?>
                                                    <img src="<?=$ct_img_url."/".$row_c['ct_image']?>">
                                                    <?
                                                }
                                            } else {
                                                ?>
                                                <img src="<?=$ct_img_url."/".$row_c['ct_image']?>">
                                                <?
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="m_over">
                                        <div class="m_over_top d-flex align-items-center justify-content-between">
                                            <p class="time"><?=$row_c['ct_playtime']?></p>
                                            <div class="icon">
                                                <button type="button" class="btn btn_cart" id="btn_cart" onclick="cart_ing('<?=$row_c['idx']?>')">
                                                    <div class="ic_cart"></div>
                                                </button>
                                                <button type="button" class="btn m_over_btn <? if($wish_chk) { echo 'on'; }?>" onclick="wish_ing('<?=$row_c['idx']?>', 'content')">
                                                    <div class="ic_heart"></div>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="m_over_bottom" data-toggle="collapse" href="#collapse<?=$row_c['idx']?>" role="button" aria-expanded="false" aria-controls="collapse">
                                            <p class="ct_txt"><?=$row_c['ct_name']?></p>
                                            <p class="ct_tit fw_500"><?=$row_c['ct_title']?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="list_detail list_detail_2 collapse" id="collapse<?=$row_c['idx']?>" aria-labelledby="heading<?=$row_c['idx']?>" data-parent="#collapse_parent">
                                    <button type="button" class="close btn_close" data-toggle="collapse" data-target="#collapse<?=$row_c['idx']?>" aria-expanded="false" aria-controls="collapseExample">
                                        <img src="img/ic_x.png" alt="닫기">
                                    </button>
                                    <div class="list_detail_wrap">
                                        <div class="list_detail_video">
                                            <div class="square">
                                                <?
                                                if($row_c['ct_type'] == 1) {      //영상
                                                    ?>
                                                    <video class="video_item" muted loop id="video<?=$row_c['idx']?>" playsinline>
                                                        <source src='<?=$ct_audio_url."/preview/ct_file_preview_".$row_c['idx'].".mp4"?>' type='video/mp4'/>
                                                    </video>
                                                    <?
                                                } else {
                                                    if($row_c['ct_cate_idx2'] == 14 || $row_c['ct_cate_idx2'] == 15) {
                                                        if($row_c['ct_preview']) {
                                                            ?>
                                                            <video class="video_item" muted loop id="video<?=$row_c['idx']?>" playsinline>
                                                                <source src='<?=$ct_audio_url."/preview/".$row_c['ct_preview']?>' type='video/mp4'/>
                                                            </video>
                                                            <?
                                                        } else {
                                                            ?>
                                                            <img src="<?=$ct_img_url."/".$row_c['ct_image']?>">
                                                            <?
                                                        }
                                                    } else {
                                                        ?>
                                                        <img src="<?=$ct_img_url."/".$row_c['ct_image']?>">
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
                                                        $program = explode(",", $row_c['ct_program']);
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
                                            <h4 class="cart_tit ff_play"><?=$row_c['ct_title']?></h4>
                                            <div class="cart_artist">
                                                <div class="square"><img src="<? if($row_c['mt_image']) echo $ct_img_url."/".$row_c['mt_image']; else echo $ct_member_no_img_url;?>" alt=""></div>
                                                <span class="at_name"><?=$row_c['mt_nickname']?></span>
                                            </div>
                                            <div class="cart_de">
                                                <div class="cart_op"><span class="badge badge-secondary fw_600"><?=$row_c['ct_resolution']?></span><span class="c_reso"><?=$arr_resolution2[$row_c['ct_resolution']]?></span></div>
                                            </div>
                                            <hr class="hr2">
                                            <ul class="detail_data">
                                                <li>
                                                    <p class="f_name">Frame rate</p>
                                                    <p class="f_sub"><?=($row_c['ct_framerate']=="") ? "00":$row_c['ct_framerate']?>.00</p>
                                                </li>
                                                <li>
                                                    <p class="f_name">Length</p>
                                                    <p class="f_sub"><?=$row_c['ct_playtime']?></p>
                                                </li>
                                                <li>
                                                    <p class="f_name">Format</p>
                                                    <p class="f_sub"><?=$row_c['ct_format']?></p>
                                                </li>
                                                <li>
                                                    <p class="f_name">Size</p>
                                                    <p class="f_sub"><?=$row_c['ct_size']?></p>
                                                </li>
                                            </ul>
                                            <hr class="hr2">
                                            <div class="d-flex justify-content-between align-items-end">
                                                <p class="price_name">PRICE</p>
                                                <?
                                                if($_SESSION['_lang'] == "en") {
                                                    ?>
                                                    <div class="cart_price">$<span class="price ff_play"><?=number_format($row_c['ct_price'] / $dollar,2)?></span></div>
                                                    <?
                                                } else {
                                                    ?>
                                                    <div class="cart_price"><span class="price ff_play"><?=number_format($row_c['ct_price'])?></span>원</div>
                                                    <?
                                                }
                                                ?>
                                            </div>
                                            <div class="detail_btn d-flex">
                                                <?
                                                if($member_info['idx']) {
                                                    $query = "select * from wish_contents_t where mt_idx = " . $member_info['idx'] . " and ct_idx = " . $row_c['idx'] . " and wct_status = 'Y'";
                                                    $wish_chk = $DB->fetch_assoc($query);
                                                }
                                                ?>
                                                <form name="info" id="info" method="post">
                                                    <input type="hidden" name="type" id="type" value="insert">
                                                    <input type="hidden" name="order_act" id="order_act">
                                                    <input type="hidden" name="membership" id="membership">
                                                    <button type="button" class="btn_cart btn_circle mr-4" onclick="cart_ing('<?=$row_c['idx']?>')"><div class="ic_cart_lg"><img src="img/ic_cart.png" alt=""></div></button>
                                                </form>
                                                <button type="button" class="btn_heart btn_circle mr-4 <? if($wish_chk) { echo 'on'; }?>" onclick="wish_ing('<?=$row_c['idx']?>', 'content')"><div class="ic_heart_lg"><img class="off" src="img/ic_heart_lg.png" alt=""><img class="on" src="img/ic_heart_lg_b.png" alt=""></div></button>
                                                <button type="button" class="btn btn-primary btn_buy" onclick="chk_membership('<?=$row_c['idx']?>');order_ing('<?=$row_c['idx']?>')"><?=$download?></button>
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
                                    $("#collapse<?=$row_c['idx']?>").addClass("ld_c"+j);
                                    j += 1;
                                </script>
                            </div>
                            <?
                        }
                        ?>
                    </div>
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
                $("#" + this.id).children().children('video').css("display", "none");
                stopPreview($("#" + this.id).children().children('video')[0].id);
            } else {
                $("#"+$(this).children().children('img')[1].id).attr("src", $("#"+$(this).children().children('img')[1].id).data("static"))
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
                startPreview("video"+idx);
                previewTimeout = setTimeout(function() { stopPreview("video"+idx) }, 15000);
            } else {
                clearTimeout(previewTimeout);
                previewTimeout = null;
                stopPreview("video"+idx);
            }
        }

    </script>
<? include_once("./inc/tail.php"); ?>