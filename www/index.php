<?php
$title = "메인";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$search = lang("search",$_lang, "main");
$template = lang("template",$_lang, "main");
$artist = lang("artist",$_lang, "main");
$login = lang("login",$_lang, "main");
$logout = lang("logout",$_lang, "main");
$mypage = lang("mypage",$_lang, "main");
$order = lang("order",$_lang, "main");
$favorites = lang("favorites",$_lang, "nav");
$settlement = lang("settlement",$_lang, "main");
$search_popular = lang("search_popular",$_lang, "main");
$artists = lang("artists",$_lang, "main");

$count = 1;
if(isset($_SESSION["count"])){
    $count = $_SESSION["count"];
    $count ++;
}
$_SESSION["count"] = $count;

if($count == 1) {
    $DB->insert_query("visitor_log_t", array("vlt_wdate" => "now()"));
}
?>

<style>
    .mobile_subheader_wrap {
        display: none;
    }

    @media (max-width: 991.98px) {
        .wrap {
            padding-top: 0;
        }
    }
</style>

<div class="wrap main_wrap">
    <div class="main_pg">
        <div class="main_vd position-relative">
            <?
            if ($_lang == 'kr' || $_lang == "") {
                $bt_language = 1;
            } else {
                $bt_language = 2;
            }
            $query = "select * from banner_t where bt_main = 'Y' and bt_show = 'Y' and bt_language = ".$bt_language." order by bt_wdate desc limit 1";
            $main = $DB->fetch_assoc($query);
            if($main) {
                echo '<video src="'.$ct_img_url."/".$main['bt_file'].'" autoplay muted loop playsinline id="main_video"></video>';
            }
            ?>
            <div class="sch_form position-absolute">
                <div class="d-flex sch_input_wrap pb-sm-15 pb-05">
                    <input type="text" class="sch_input oultline-0 w-100" id="search_txt" placeholder="<?=$search?>">
                    <ul class="sch_related_wrap">
                        <?php if($_lang == 'kr' || $_lang == "") {
                            $pst_language = 1;
                        } else {
                            $pst_language = 2;
                        }
                        $query = "select * from popular_searchtxt_t where pst_language = ".$pst_language;
                        $searchtxt_list = $DB->select_query($query);
                        if($searchtxt_list) {
                            foreach ($searchtxt_list as $row_search) {
                        ?>
                            <li class="sch_related_li">
                                <a href="/search_result_contents.php?search_txt=<?=$row_search['pst_text']?>"><?=$row_search['pst_text']?></a>
                            </li>
                        <?
                            }
                        }
                        ?>
                    </ul>
                    <button class="btn btn-link btn_sch" type="button" onclick="search()"><img src="img/ic_search_sm.png" alt="검색"> </button>
                </div>
                <ul class="popular_sch_word">
                    <li><a class="fw_700"><img src="img/ic_popular.png"> <?=$search_popular?></a></li>
                    <?php if($_lang == 'kr' || $_lang == "") {
                        $pst_language = 1;
                    } else {
                        $pst_language = 2;
                    }
                    $query = "select * from popular_searchtxt_t where pst_language = ".$pst_language;
                    $searchtxt_list = $DB->select_query($query);
                    if($searchtxt_list) {
                        foreach ($searchtxt_list as $row_search) {
                    ?>
                        <li><a href="/search_result_contents.php?search_txt=<?=$row_search['pst_text']?>">#<?=$row_search['pst_text']?></a></li>
                    <?
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="container position-absolute main_nav">
                <div class="d-flex justify-self justify-content-start">
                    <nav class="lang_select ff_play">
                        <a href="javascript:chg_language('kr')" class="<?php if($_lang == 'kr' || $_lang == '') echo 'on';?>">KOR</a>
                        <span>|</span>
                        <a href="javascript:chg_language('en')" class="<?php if($_lang == 'en') echo 'on';?>">ENG</a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <div class="main_title d-flex justify-content-between align-items-center">
                    <div class="m_title">
                        <h1 class="ff_play">CATEGORY</h1>
                        <p>All the videos in the world for you.</p>
                    </div>
                    <div class="img"><img src="img/main_img01.png" alt=""></div>
                </div>
            </div>
        </div>
        <div class="row category_fl">
            <div class="col-12 col-lg-6 cate_box">
                <a href="/contents_list.php?ct_type=1&ct_idx=2">
                    <div class="cate_img cate_img01 video_list square">
                        <img src="<?=STATIC_HTTP."/data/4k.png"?>">
                        <video class="video_item" muted loop id="video1_1">
                            <source src='<?=STATIC_HTTP."/data/4K.mp4"?>' type='video/mp4'/>
                        </video> 
                        <h2 class="ff_play position-absolute">4K</h2>
                    </div>
                </a>
            </div>
            <div class="col-12 col-lg-6 cate_box">
                <a href="/contents_list.php?ct_type=1&ct_idx=9">
                    <div class="cate_img cate_img01 video_list square">
                        <img src="<?=STATIC_HTTP."/data/drone.png"?>">
                        <video class="video_item" muted loop id="video1_2">
                            <source src='<?=STATIC_HTTP."/data/Drone.mp4"?>' type='video/mp4'/>
                        </video> 
                        <h2 class="ff_play position-absolute">DRONE</h2>
                    </div>
                </a>
            </div>
            <?php
            $query = "select *, (SELECT ct_name FROM category_t WHERE idx=ct_idx) as ct_name, (SELECT ct_p_idx FROM category_t WHERE idx=ct_idx) as ct_p_idx 
                    from main_category_t where mct_show = 'Y' order by mct_orderby";
            $category = $DB->select_query($query);
            if($category) {
                foreach ($category as $row_c) {
                    if($row_c['ct_p_idx'] == 1) {
                        $ct_type = 1;
                    } else if($row_c['ct_p_idx'] == 11) {
                        $ct_type = 2;
                    }
            ?>
                <div class="col-12 col-md-6 col-lg-3 cate_box">
                    <a href="/contents_list.php?ct_type=<?=$ct_type?>&ct_idx=<?=$row_c['ct_idx']?>">
                        <div class="cate_img cate_img02 video_list square">
                            <img src="<?=$ct_img_url."/".$row_c['mct_image']?>">
                            <video class="video_item" muted loop id="video<?=$row_c['idx']?>">
                                <source src='<?=$ct_img_url."/".$row_c['mct_video']?>' type='video/mp4'/>
                            </video>
                            <h2 class="ff_play position-absolute"><?=$row_c['ct_name']?></h2>
                        </div>
                    </a>
                </div>
            <?
                }
            }
            ?>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tp_tit position-relative">
                    <div class="m_title">
                        <h1 class="ff_play">TOP ARTISTS</h1>
                        <p>All the videos in the world for you.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-xl-2">
            <div class="col-12 col-xl-1">
                <div class="thumbs_tp d-flex">
                <?php
                $query = "SELECT member_t.idx, sum(cart_t.ct_price) FROM member_t
                        left join contents_t on contents_t.mt_idx = member_t.idx
                        left join cart_t on cart_t.ct_idx = contents_t.idx
                        where mt_level = 5 and mt_approve = 2 group by member_t.idx order by sum(cart_t.ct_price) desc limit 8 ";
                $member = $DB->select_query($query);
                if($member) {
                    foreach ($member as $row_m) {
                        $query = "select * from member_t where idx = ".$row_m['idx'];
                        $member_info2 = $DB->fetch_assoc($query);
                        if($member_info2['mt_image']) {
                            $url = $ct_img_url."/".$member_info2['mt_image'];
                        } else {
                            $url = $ct_member_no_img_url;
                        }
                ?>
                    <div class="thumbs_img on">
                        <div class="img_border square"><img src="<?=$url?>" alt=""></div>
                    </div>
                <?
                    }
                }
                ?>
                </div>
            </div>
            <div class="col-12 col-xl-11">
                <div class="tp_wrap">
                    <?
                    if($member) {
                        foreach ($member as $row_m) {
                            $query = "select * from member_t where idx = ".$row_m['idx'];
                            $member_info2 = $DB->fetch_assoc($query);
                            if($member_info2['mt_image']) {
                                $url = $ct_img_url."/".$member_info2['mt_image'];
                            } else {
                                $url = $ct_member_no_img_url;
                            }
                            $query = "select * from wish_contents_t left join contents_t on contents_t.idx = wish_contents_t.ct_idx where contents_t.mt_idx = ".$row_m['idx']." and wct_status = 'Y'";
                            $wish = $DB->count_query($query);
                    ?>
                    <div class="tp_content on">
                        <div class="tp_flex d-flex justify-content-between">
                            <div class="tp_left">
                                <div class="tp_img square"><img src="<?=$url?>" alt=""></div>
                            </div>
                            <div class="tp_right">
                                <div class="tp_r_top">
                                    <div class="tp_name ff_play"><?=$member_info2['mt_nickname']?></div>
                                    <div class="tp_fav"><img src="img/ic_heart.png" alt=""> <?=$favorites?> <?=number_format($wish)?></div>
                                </div>
                                <hr class="hr">
                                <div class="tp_md">
                                    <p><?=$member_info2['mt_introduce']?></p>
                                </div>
                                <hr class="hr">
                                <div class="tp_bottom">
                                    <button type="button" class="btn btn-outline-secondary tp_btn" onclick="location.href='/artist_detail.php?mt_idx=<?=$member_info2['idx']?>'"><?=$artists?><img src="img/arrow_right.png"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$query = "select * from popup_t where pt_show = 'Y' and pt_sdate <= date_format(now(), '%Y-%m-%d') and pt_edate >= date_format(now(), '%Y-%m-%d') order by pt_wdate desc limit 1";
$popup = $DB->fetch_assoc($query);
if($popup) {
    if($_COOKIE['modal_firstPopup']!="ok") {
?>
    <!-- Popi[ Modal -->
    <div class="modal fade modal_firstPopup" id="firstPopup" tabindex="-1" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <a href="<?=$popup['pt_url']?>">
                        <img src="<?=$ct_img_url."/".$popup['pt_file']."?cache=".strtotime($popup['pt_udate'])?>" alt="팝업 샘플" style="max-height: 600px;max-width: 500px;">
                    </a>
                </div>
                <div class="modal-footer">
                    <span class="col-5" data-dismiss="modal" style="cursor: pointer;" onclick="close_today('today')">하루동안 보지 않기</span>
                    <div class="col-4"></div>
                    <span class="col-3 text-right" data-dismiss="modal" style="cursor: pointer;"><i class="bi bi-x mr-1"></i>닫기</span>
                </div>
            </div>
        </div>
    </div>
<?php
    }
}
?>
<script>
    $("#search_txt").on("keyup",function(key){
        if(key.keyCode == 13) {
            if($("#search_txt").val() == "") {
                alert("검색어를 입력해주세요.");
                $("#search_txt").focus();
                return false;
            }
            $.ajax({
                type: 'post',
                url: '/models/ajax.session.php',
                dataType: 'json',
                data: {type: "search_log", mt_idx: "<?=$member_info['idx']?>", slt_language: "<?=$pst_language?>", slt_txt: $("#search_txt").val()},
                success: function (d, s) {
                    if(d['result'] == "ok") {
                        location.replace("/search_result_contents.php?search_txt="+$("#search_txt").val());
                    }
                },
                cache: false
            });
        }
    });

    function close_today(time) {
        if(time == "today") {
            setCookie("modal_firstPopup", "ok", 1);
        }
        $('#modal_firstPopup').modal('hide');
    }

    $(document).ready(function(){
        $(".thumbs_tp .thumbs_img").removeClass("on");
        $(".tp_wrap .tp_content").removeClass("on");
        $(".tp_wrap .tp_content").eq(0).addClass("on");
        $(".thumbs_tp .thumbs_img").eq(0).addClass("on");

        //첫팝업 띄우기
        $("#firstPopup").modal("show");
    });

    $(".thumbs_tp .thumbs_img").on("click",function(){
        var idx = $(this).index();
        
        $(".thumbs_tp .thumbs_img").removeClass("on");
        $(".tp_wrap .tp_content").removeClass("on");
        $(this).addClass("on");
        $(".tp_wrap .tp_content").eq(idx).addClass("on");
    });

    //동영상 우클릭 금지
    // $(document).bind("contextmenu", function(e){
    //     return false;
    // });
    $('video[id^="video"]').bind("contextmenu",function(e){
        return false;
    });
    $('video[id^="video"]').bind("selectstart",function(e){
        return false;
    });
    // $(document).on("contextmenu dragstart selectstart",function(e){
    //     return false;
    // });

    const video = document.querySelectorAll(".video_item");

    //다른 페이지 갔다가 다시 돌아온 경우 메인 영상 재생 안되는 부분 처리
    window.onpageshow = function (event) {
        if (event.persisted) {
            $("#main_video").muted = true;
            $("#main_video")[0].currentTime = 0;
            $("#main_video").playbackRate = 1;
            $("#main_video")[0].play();
        }
        else {
            $("#main_video").muted = true;
            $("#main_video")[0].currentTime = 0;
            $("#main_video").playbackRate = 1;
            $("#main_video")[0].play();
        }
    };

    function startPreview(video1) {
        $("#"+video1.id).muted = true;
        $("#"+video1.id)[0].currentTime = 0;
        $("#"+video1.id).playbackRate = 1;
        $("#"+video1.id)[0].play();
    }

    function stopPreview(video2) {
        $("#"+video2.id)[0].currentTime = 0;
        $("#"+video2.id).playbackRate = 1;
        $("#"+video2.id)[0].pause();
    }

    let previewTimeout = null;

    for(var i=0; i<video.length; i++) {
        video[i].addEventListener("mouseenter", (e) => {
            startPreview(e.target);
            previewTimeout = setTimeout(function() { stopPreview(e.target) }, 15000);
        });

        video[i].addEventListener("mouseleave", (e) => {
            clearTimeout(previewTimeout);
            previewTimeout = null;
            stopPreview(e.target);
        });
    }

    function search() {
        if($("#search_txt").val() == "") {
            alert("검색어를 입력해주세요.");
            $("#search_txt").focus();
            return false;
        }
        $.ajax({
            type: 'post',
            url: '/models/ajax.session.php',
            dataType: 'json',
            data: {type: "search_log", mt_idx: "<?=$member_info['idx']?>", slt_language: "<?=$pst_language?>", slt_txt: $("#search_txt").val()},
            success: function (d, s) {
                if(d['result'] == "ok") {
                    location.replace("/search_result_contents.php?search_txt="+$("#search_txt").val());
                }
            },
            cache: false
        });
    }

</script>

<? include_once("./inc/tail.php"); ?>