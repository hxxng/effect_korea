<?php
$_lang = $_SESSION['_lang'];

$video = lang("video",$_lang, "nav");
$template = lang("template",$_lang, "nav");
$artist = lang("artist",$_lang, "nav");
$login = lang("login",$_lang, "nav");
$logout = lang("logout",$_lang, "nav");
$mypage = lang("mypage",$_lang, "nav");
$order = lang("order",$_lang, "nav");
$favorites = lang("favorites",$_lang, "nav");
$settlement = lang("settlement",$_lang, "nav");
$home = lang("home",$_lang, "nav");
$search_popular = lang("search_popular",$_lang, "main");
$all_read = lang("all_read",$_lang, "nav");
$alert = lang("alert",$_lang, "nav");
$confirm = lang("confirm",$_lang, "order");
$subscription = lang("subscription", $_lang, "mypage");
$contents_upload = lang("contents_upload", $_lang, "mypage");
$subscription2 = lang("subscription2", $_lang, "mypage");

if($member_info['idx']) {
    $query = "select * from pushnotification_log_t a1
        left join  pushnotification_read_log_t a2 on a2.plt_idx = a1.idx               
        where a1.op_idx = ".$member_info['idx']." and a2.plt_idx is null";
    $push_count = $DB->count_query($query);
}
?>
<!-- 헤더 시작 -->
<style>
    .btn_no_notice{
        position:relative;
    }
    .btn_no_notice::after{
        content: ''; position:absolute; top:20px; right:20px; width:9px; height:9px;
        border-radius: 50%;
    }
</style>
<body>    
    <div class="container-fluid header_wrap">
        <div class="row">
            <div class="col-12">
                <header id="header">
                    <div class="header_left">                        
                        <figure class="header_logo">
                            <a href="index.php"><img src="img/logo.png" alt="판로인로고"></a>
                        </figure>                        
                    </div>                    
                    <div class="header_right">
                        <ul class="lnb">
                            <li>
                                <a href="/membership.php"><?=$subscription2?></a>
                            </li>
                            <li class="btn_submenu">
                                <a><?=$video?><img src="img/arrow_down.png"></a>
                                <nav class="submenu_list">
                                    <ul>
                                        <?
                                        $query = "select * from category_t where ct_p_idx = 1 order by ct_orderby";
                                        $category = $DB->select_query($query);
                                        if($category) {
                                            foreach ($category as $c) {
                                        ?>
                                            <li><a href="/contents_list.php?ct_type=1&ct_idx=<?=$c['idx']?>"><span><?=$c['ct_name']?></span></a></li>
                                        <?
                                            }
                                        }
                                        ?>
                                    </ul>
                                </nav>
                            </li>
                            <li class="btn_submenu">
                                <a><?=$template?><img src="img/arrow_down.png"></a>
                                <nav class="submenu_list">
                                    <ul>
                                        <?
                                        $query = "select * from category_t where ct_p_idx = 11 order by ct_orderby";
                                        $category = $DB->select_query($query);
                                        if($category) {
                                            foreach ($category as $c) {
                                                ?>
                                                <li><a href="/contents_list.php?ct_type=2&ct_idx=<?=$c['idx']?>"><span><?=$c['ct_name']?></span></a></li>
                                                <?
                                            }
                                        }
                                        ?>
                                    </ul>
                                </nav>
                            </li>
                            <li>
                                <a href="/artists.php"><?=$artist?></a>
                            </li>
                            <li>
                                <a href="/tailored.php">TAILORED</a>
                            </li>
                        </ul>
                        <span class="btns_wrap">
                            <div class="text-white btn_submenu">
                                <?
                                if($_lang == 'kr' || $_lang == '') {
                                    $img = "flag_kor.png";
                                    if($member_info['mt_firstname']) {
                                        $mt_firstname = $member_info['mt_firstname']."님";
                                    } else {
                                        $mt_firstname = "회원님";
                                    }
                                } else {
                                    $img = "flag_eng.png";
                                    if($member_info['mt_firstname']) {
                                        $mt_firstname = $member_info['mt_firstname'];
                                    } else {
                                        $mt_firstname = "member";
                                    }
                                }

                                if($member_info['idx']) {
                                ?>
                                <div class="btn_my"><img src="/img/<?=$img?>" class="mr-2" alt="한국어">&nbsp;<?=$mt_firstname?><img src="img/arrow_down.png"></div>
                                    <nav class="submenu_list">
                                    <ul>
                                        <?
                                        if($member_info['mt_level'] == 5) {
                                        ?>
                                        <li><a href="/artist_my.php"><span><?=$mypage?></span></a></li>
                                        <li><a href="/artist_my_orderlist.php"><span><?=$order?></span></a></li>
                                        <li><a href="/artist_my_like.php"><span><?=$favorites?></span></a></li>
                                        <li><a href="/artist_my_calc.php"><span><?=$settlement?></span></a></li>
                                        <li><a href="/artist_my_upload.php"><span><?=$contents_upload?></span></a></li>
                                        <li><a href="/artist_my_subscription.php"><span><?=$subscription?></span></a></li>
                                        <?
                                        } else {
                                        ?>
                                        <li><a href="/my_subscription.php"><span><?=$mypage?></span></a></li>
                                        <li><a href="/my_orderlist.php"><span><?=$order?></span></a></li>
                                        <li><a href="/my_like.php"><span><?=$favorites?></span></a></li>
                                        <li><a href="/my_subscription.php"><span><?=$subscription?></span></a></li>
                                        <? } ?>
                                        <li><a href="./models/login/logout.php"><span><?=$logout?></span></a></li>
                                    </ul>
                                </nav>
                                <?
                                } else {
                                ?>
                                <div class="btn_my"><a href="./signin.php"><img src="/img/<?=$img?>" class="mr-2" alt="한국어">&nbsp;<?=$login?></a></div>
                                <?
                                }
                                ?>
                            </div>
                            <button class="btn btn-link btn_cart position-relative" type="button" onclick="location.href='cart.php'">
                                <span class="badge badge-primary cart_badge"><?php echo $cart['cnt'];?></span>
                                <img src="img/ic_cart.png" alt="장바구니">
                            </button>
                            <button class="btn btn-link btn_notice" type="button" data-toggle="modal" data-target="#notice">
                                <img src="img/ic_notice.png" alt="알림">
                            </button>
                            <button class="btn btn-link" type="button" data-toggle="modal" data-target="#sch_modal">
                                <img src="img/ic_search.png" alt="검색하기">
                            </button>
                            <!-- <button class="btn btn-link text-white" type="button">
                                로그인
                            </button> -->
                        </span>
                    </div>        
                </header>
            </div>
        </div>        
    </div>
    <!-- 모바일 헤더 (메인) -->
    <div class="container-fluid mobile_wrap mobile_mainheader_wrap">
        <div class="mobile_header_left">
            <a href="index.php" class="logo"><img src="img/logo.png" alt="홈으로가기"></a>
        </div>        
        <div class="mobile_header_right">
            <button class="btn btn-link" type="button" data-toggle="modal" data-target="#sch_modal">
                <img src="img/ic_sub_search.png" style="margin-bottom: -1px;" alt="검색하기">
            </button>
            <button class="btn btn-link btn_sideMenu" type="button">
                <img src="img/ic_sub_hamburger.png" alt="메뉴열기">
            </button>
        </div>
    </div>
        <!-- 모바일 헤더 (서브) -->
    <div class="container-fluid mobile_wrap mobile_subheader_wrap d-none">
        <div class="mobile_header_left">
            <button class="btn btn-link" type="button" data-toggle="modal" data-target="#sch_modal">
                <img src="img/ic_sub_back.png" style="margin-bottom: -1px;" alt="뒤로가기">
            </button>
            <button class="btn btn-link" type="button" onclick="location.href='index.php'">
                <img src="img/ic_sub_home.png" alt="홈으로 가기">
            </button>
        </div>
        
        <p class="fs_15"><?= $title ?></p>
        <div class="mobile_header_right">
            <button class="btn btn-link" type="button" data-toggle="modal" data-target="#sch_modal">
                <img src="img/ic_sub_search.png" style="margin-bottom: -1px;" alt="검색하기">
            </button>
            <button class="btn btn-link btn_sideMenu" type="button">
                <img src="img/ic_sub_hamburger.png" alt="메뉴열기">
            </button>
        </div>
    </div>
    <!-- 헤더 끝 -->

    <div class="modal fade sch_modal" id="sch_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">            
            <div class="modal-content mt-n55 bg-transparent">       
            <div class="btn_close" data-dismiss="modal"><img src="img/ic_x.png" alt="닫기"></div>         
                <div class="container row justify-content-center no-gutters">
                    <div class="col-lg-5 col-sm-7 col-12">                        
<!--                        <form action="">-->
                            <div class="d-flex sch_input_wrap pb-sm-15 pb-05">                                
                                <input type="text" class="sch_input oultline-0 w-100" id="search_txt2" placeholder="검색어 입력">
                                <ul class="sch_related_wrap">
                                    <?php if($_lang == 'kor' || $_lang == "") {
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
                                <button class="btn btn-link btn_sch" type="button" onclick="search2()"><img src="img/ic_search_sm.png" alt="검색"> </button>
                            </div>
                            <ul class="popular_sch_word">
                                <li><a href="#" class="fw_700"><img src="img/ic_popular.png"> <?=$search_popular?></a></li>
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
<!--                        </form>-->
                        <script>
                            $("#search_txt2").on("keyup",function(key){
                                if(key.keyCode == 13) {
                                    if($("#search_txt2").val() == "") {
                                        alert("검색어를 입력해주세요.");
                                        $("#search_txt2").focus();
                                        return false;
                                    }
                                    $.ajax({
                                        type: 'post',
                                        url: '/models/ajax.session.php',
                                        dataType: 'json',
                                        data: {type: "search_log", mt_idx: "<?=$member_info['idx']?>", slt_language: "<?=$pst_language?>", slt_txt: $("#search_txt2").val()},
                                        success: function (d, s) {
                                            if(d['result'] == "ok") {
                                                location.replace("/search_result_contents.php?search_txt="+$("#search_txt2").val());
                                            }
                                        },
                                        cache: false
                                    });
                                }
                            });
                            function search2() {
                                if($("#search_txt2").val() == "") {
                                    alert("검색어를 입력해주세요.");
                                    $("#search_txt2").focus();
                                    return false;
                                }
                                $.ajax({
                                    type: 'post',
                                    url: '/models/ajax.session.php',
                                    dataType: 'json',
                                    data: {type: "search_log", mt_idx: "<?=$member_info['idx']?>", slt_language: "<?=$pst_language?>", slt_txt: $("#search_txt2").val()},
                                    success: function (d, s) {
                                        if(d['result'] == "ok") {
                                            location.replace("/search_result_contents.php?search_txt="+$("#search_txt2").val());
                                        }
                                    },
                                    cache: false
                                });
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid sideMenu_wrap px-0 pt-lg-5">
        <div class="row no-gutters sideMenu">
            <div class="col-12">
                <div class="closed">
                    <img src="https://palroin.com//design/img/modal_close.png" alt="닫기">
                </div>
            </div>
            <div class="col-12">
                <nav class="shortcut">
                    <button class="btn btn-link btn_cart position-relative" type="button" onclick="location.href='cart.php'">
                        <span class="badge badge-primary cart_badge"><?php echo $cart['cnt'];?></span>
                        <img src="img/ic_cart.png" alt="장바구니">
                    </button>
                    <button class="btn btn-link btn_notice" type="button" data-toggle="modal" data-target="#notice">
                        <img src="img/ic_notice.png" alt="알림">
                    </button>
                </nav>
                <ul class="lnb">
                    <li class="lnb_item">
                        <a class="lnb_link" href="/membership.php"><?=$subscription2?></a>
                    </li>
                    <li class="lnb_item btn_submenu on">
                        <div class="lnb_link" href="/contents_list.php?ct_type=1"><?=$video?><img src="img/arrow_down.png"></div>
                        <nav class="submenu_list">
                            <ul>
                                <?
                                $query = "select * from category_t where ct_p_idx = 1 order by ct_orderby";
                                $category = $DB->select_query($query);
                                if($category) {
                                    foreach ($category as $c) {
                                        ?>
                                        <li><a href="/contents_list.php?ct_type=1&ct_idx=<?=$c['idx']?>"><span><?=$c['ct_name']?></span></a></li>
                                        <?
                                    }
                                }
                                ?>
                            </ul>
                        </nav>
                    </li>
                    <li class="lnb_item btn_submenu">
                        <div class="lnb_link" href="/contents_list.php?ct_type=2"><?=$template?><img src="img/arrow_down.png"></div>
                        <nav class="submenu_list">
                            <ul>
                                <?
                                $query = "select * from category_t where ct_p_idx = 11 order by ct_orderby";
                                $category = $DB->select_query($query);
                                if($category) {
                                    foreach ($category as $c) {
                                        ?>
                                        <li><a href="/contents_list.php?ct_type=2&ct_idx=<?=$c['idx']?>"><span><?=$c['ct_name']?></span></a></li>
                                        <?
                                    }
                                }
                                ?>
                            </ul>
                        </nav>
                    </li>
                    <li class="lnb_item">
                        <a class="lnb_link" href="/artists.php"><?=$artist?></a>
                    </li>
                    <li class="lnb_item">
                        <a class="lnb_link" href="/tailored.php">TAILORED</a>
                    </li>
                    <li class="lnb_item btn_submenu">
                        <div class="lnb_link" href="/tailored.php"><?=$mypage?><img src="img/arrow_down.png"></div>
                        <nav class="submenu_list">
                            <ul>
                                <?
                                if($member_info) {
                                    if($member_info['mt_level'] == 5) {
                                        ?>
                                        <li><a href="/artist_my.php"><span><?=$mypage?></span></a></li>
                                        <li><a href="/artist_my_orderlist.php"><span><?=$order?></span></a></li>
                                        <li><a href="/artist_my_like.php"><span><?=$favorites?></span></a></li>
                                        <li><a href="/artist_my_calc.php"><span><?=$settlement?></span></a></li>
                                        <li><a href="/artist_my_upload.php"><span><?=$contents_upload?></span></a></li>
                                        <li><a href="/artist_my_subscription.php"><span><?=$subscription?></span></a></li>
                                        <?
                                    } else {
                                        ?>
                                        <li><a href="/my_subscription.php"><span><?=$mypage?></span></a></li>
                                        <li><a href="/my_orderlist.php"><span><?=$order?></span></a></li>
                                        <li><a href="/my_like.php"><span><?=$favorites?></span></a></li>
                                        <li><a href="/my_subscription.php"><span><?=$subscription?></span></a></li>
                                    <?
                                        }
                                    ?>
                                        <li><a href="./models/login/logout.php"><span><?=$logout?></span></a></li>
                                    <?
                                    } else {
                                    ?>
                                    <li><a href="/signin.php"><span><?=$login?></span></a></li>
                                <? } ?>
                            </ul>
                        </nav>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row no-gutters dimmed">

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="notice" >
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-md">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?=$alert?></h5>
                <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
                    <img src="img/ic_x.png" alt="닫기">
                </button>
            </div>
            <div class="modal-body">
                <ul class="notice_wrap">
                    <?
                    if($member_info['idx']) {
                        $query = "select a1.*, a2.idx as read_idx from pushnotification_log_t a1
                             left join  pushnotification_read_log_t a2 on a2.plt_idx = a1.idx               
                             where a1.op_idx = ".$member_info['idx']." order by plt_wdate desc";
                        $list = $DB->select_query($query);
                        if($list) {
                            foreach ($list as $row) {
                                if($row['plt_type'] == 1) {
                                    $icon = "bi-upload";
                                } else if($row['plt_type'] == 2) {
                                    $icon = "bi-download";
                                } else if($row['plt_type'] == 3) {
                                    $icon = "bi-exclamation-circle";
                                } else {
                                    $icon = "bi-patch-check";
                                }
                    ?>
                    <li class="notice_item <? if($row['read_idx']) echo ''; else echo 'not_reading'; ?>" onclick="chk_read('<?=$row['idx']?>')">
                        <div class="notice_ic">
                            <i class="bi <?=$icon?>"></i>
                        </div>
                        <? if($row['plt_page']) { ?>
                        <a href="<?=$row['plt_page']?>">
                        <? } ?>
                        <div class="notice_text">
                            <h2 class="h2"><?=$row['plt_title']?></h2>
                            <p class="date"><?=DateType($row['plt_wdate'],2)?></p>
                        </div>
                        <? if($row['plt_page']) { ?>
                        </a>
                        <? } ?>
                    </li>
                    <?
                        }
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-outline-secondary mr-3" onclick="all_read();"><?=$all_read?></button>
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?=$confirm?></button>
            </div>

            <script>
                $(document).ready(function () {
                    if("<?=$push_count?>" ==  0) {
                        $('.btn_notice').addClass("btn_no_notice");
                        $('.btn_notice').removeClass("btn_notice");
                    }
                });
                function all_read() {
                    $.ajax({
                        type: 'post',
                        url: '/models/ajax.session.php',
                        dataType: 'json',
                        data: {type: "all_read"},
                        success: function (d, s) {
                            if (d.result == 'ok') {
                                location.replace("/");
                            }
                        },
                        cache: false
                    });
                }
                function chk_read(idx) {
                    $.ajax({
                        type: 'post',
                        url: '/models/ajax.session.php',
                        dataType: 'json',
                        data: {type: "chk_read", idx: idx},
                        success: function (d, s) {
                        },
                        cache: false
                    });
                }
            </script>

            </div>
        </div>
    </div>