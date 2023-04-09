<?php
$title = "콘텐츠 상세";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$back = lang("back", $_lang, "account");
$detail = lang("detail", $_lang, "artist_my_contents");
$require_input = lang("require_input", $_lang, "contents_upload");
$approve_status = lang("approve_status", $_lang, "artist_my_contents");
$approve1 = lang("approve1", $_lang, "artist_my_contents");
$approve2 = lang("approve2", $_lang, "artist_my_contents");
$approve3 = lang("approve3", $_lang, "artist_my_contents");
$show = lang("show", $_lang, "artist_my_contents");
$hide = lang("hide", $_lang, "artist_my_contents");
$type = lang("type", $_lang, "artist_my_contents");
$wdate = lang("wdate", $_lang, "artist_my_contents");
$adate = lang("adate", $_lang, "artist_my_contents");
$whole = lang("whole", $_lang, "order");
$category = lang("category", $_lang, "contents");
$name = lang("name", $_lang, "contents_upload");
$sale_price = lang("sale_price", $_lang, "contents_upload");
$resolution = lang("resolution", $_lang, "contents");
$reset = lang("reset", $_lang, "calc");
$detail2 = lang("detail", $_lang, "calc");
$info1 = lang("info1", $_lang, "contents_upload");
$format = lang("format", $_lang, "contents_upload");
$info2 = lang("info2", $_lang, "contents_upload");
$framerate = lang("framerate", $_lang, "contents_upload");
$playtime = lang("playtime", $_lang, "contents_upload");
$size = lang("size", $_lang, "contents_upload");
$filter_category = lang("filter_category", $_lang, "contents_upload");
$editorial = lang("editorial", $_lang, "contents_upload");
$contents = lang("contents", $_lang, "contents_upload");
$upload = lang("upload", $_lang, "contents_upload");
$thumbnail = lang("thumbnail", $_lang, "contents_upload");
$file = lang("file", $_lang, "contents_upload");
$info3 = lang("info3", $_lang, "contents_upload");
$info4 = lang("info4", $_lang, "contents_upload");
$info5 = lang("info5", $_lang, "contents_upload");
$info6 = lang("info6", $_lang, "contents_upload");
$program = lang("program", $_lang, "contents_upload");
$list_btn = lang("list_btn", $_lang, "contents_upload");
$confirm = lang("confirm", $_lang, "order");
$preview1 = lang("preview1", $_lang, "contents_upload");
$keyword1 = lang("keyword1", $_lang, "contents_upload");
$edit_btn = lang("edit_btn", $_lang, "contents_upload");
$Exclusive_content = lang("Exclusive_content", $_lang, "contents_upload");

if($member_info['idx'] < 1) {
    p_alert('로그인 후 이용가능한 서비스입니다.', '/');
    exit;
}
if($member_info['mt_level'] != 5) {
    p_alert('아티스트만 접근가능한 서비스입니다.', '/');
    exit;
}

$_get_txt = "ct_status=".$_GET['ct_status']."&ct_show=".$_GET['ct_show']."&search_txt=".$_GET['search_txt']."&pg=".$_GET['pg'];

$query = "select *, (SELECT ct_name FROM category_t WHERE idx=ct_cate_idx) as ct_cate, (SELECT ct_name FROM category_t WHERE idx=ct_cate_idx2) as ct_cate2 
        from contents_t
        where mt_idx = ".$member_info['idx']." and idx = ".$_GET['ct_idx'];
$row = $DB->fetch_assoc($query);

if($row['ct_status'] == 1) {
    $ct_status = "승인대기";
} else if($row['ct_status'] == 2) {
    $ct_status = "승인완료";
} else{
    $ct_status = "승인반려";
}
?>

    <div class="wrap">
        <div class="upload_pg">
            <div class="go_back"><a href="#" onclick="history.back();"><img src="img/arrow_left.png" alt=""> <?=$back?></a></div>
            <div class="d-flex justify-content-between align-items-center upload_pg_tit">
                <h2><?=$detail?></h2>
                <div class="upload_pg_img">
                    <img src="img/ic_upload2.png" alt="">
                </div>
            </div>
            <div class="upload_box">
                <p class="c_txt"><span class="fc_rd">*</span> <?=$require_input?></p>
                <hr class="hr">
                <ul class="list_style_1 list_pa list_pa1">
                    <li>
                        <span><?=$wdate?></span>
                        <p><?=DateType($row['ct_wdate'])?></p>
                    </li>
                    <li>
                        <span><?=$approve_status?></span>
                        <p><?=$ct_status?></p>
                    </li>
                    <li>
                        <span><?=$adate?></span>
                        <p><?=DateType($row['ct_acdate'])?></p>
                    </li>
                    <li>
                        <span><?=$show?></span>
                        <p><? if($row['ct_show'] == 'Y') echo $show.' (Y)';  else echo $hide.' (N)'; ?></p>
                    </li>
                </ul>
                <hr class="hr">
                <h3 class="fw_700"><?=$info1?></h3>
                <ul class="list_style_1 list_pa list_pa1">
                    <li>
                        <span><?=$name?> <span class="fc_rd">*</span></span>
                        <p><?=$row['ct_title']?></p>
                    </li>
                    <li>
                        <span><?=$category?> <span class="fc_rd">*</span></span>
                        <p><?=$row['ct_cate']?> > <?=$row['ct_cate2']?></p>
                    </li>
                    <li>
                        <span><?=$format?> <span class="fc_rd">*</span></span>
                        <p><?=$row['ct_format']?></p>
                    </li>
                </ul>
                <hr class="hr">
                <h3 class="fw_700"><?=$info2?></h3>
                <ul class="list_style_1 list_pa list_pa1">
                    <li>
                        <span><?=$framerate?></span>
                        <p><?=($row['ct_framerate'] == "") ? "00" : $row['ct_framerate']?>.00</p>
                    </li>
                    <li>
                        <span><?=$playtime?></span>
                        <p><?=$row['ct_playtime']?></p>
                    </li>
                    <li>
                        <span><?=$size?></span>
                        <p><?=$row['ct_size']?></p>
                    </li>
                    <li>
                        <span><?=$filter_category?> <span class="fc_rd">*</span></span>
                        <p>
                            <?
                            if($row['ct_filter']) {
                                $arr = explode(",", $row['ct_filter']);
                                foreach ($arr as $val) {
                                    $filter .= $arr_filter[$val].",";
                                }
                                $filter = substr($filter, 0, -1);
                                echo $filter;
                            }
                            ?>
                        </p>
                    </li>
                    <li>
                        <span><?=$contents?></span>
                        <p><?=$row['ct_contents']?></p>
                    </li>
                    <li>
                        <span><?=$keyword1?></span>
                        <p>
                            <?
                            $query = "select * from contents_keyword_t where ct_idx = ".$row['idx'];
                            $keyword = $DB->select_query($query);
                            if($keyword) {
                                foreach ($keyword as $row_k) {
                                    if($_lang == "kr"||$_lang == "") {
                                        $txt .= $row_k['ct_korean']." ";
                                    } else {
                                        $txt .= $row_k['ct_english']." ";
                                    }
                                }
                            }
                            echo $txt;
                            ?>
                        </p>
                    </li>
                    <li>
                        <span><?=$editorial?></span>
                        <p>
                            <?
                            if($row['ct_editorial'] == "" || $row['ct_editorial'] == "N") {
                                echo "선택안함";
                            } else {
                                echo "선택";
                            }
                            ?>
                        </p>
                    </li>
                    <li>
                        <span><?=$Exclusive_content?></span>
                        <p>
                            <?
                            if($row['ct_exclusive'] == "" || $row['ct_exclusive'] == "N") {
                                echo "선택안함";
                            } else {
                                echo "선택";
                            }
                            ?>
                        </p>
                    </li>
                </ul>
                <hr class="hr">
                <h3 class="fw_700"><?=$upload?></h3>
                <div class="contents_thumb">
                    <label><?=$thumbnail?> <span class="fc_rd">*</span></label>
                    <div class="contents_thumb_img square"><img src="<?=$ct_img_url.'/'.$row['ct_image']?>" alt=""></div>
                </div>
                <?
                if($row['ct_preview']) {
                    ?>
                    <div class="contents_thumb">
                        <label><?=$preview1?> <span class="fc_rd">*</span></label>
                        <div class="file_upload_btn position-relative mb-0">
                            <div class="contents_thumb_img square">
                                <div class="position-absolute file_upload_b">
                                    <p class="file_name fw_600"><?=$row['ct_preview']?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?
                }
                ?>
                <div class="file_upload">
                    <label><?=$file?> <span class="fc_rd">*</span></label>
                    <div class="file_upload_box">
                        <label class="file_upload_btn position-relative mb-0">
                            <div class="position-absolute file_upload_b">
                                <p class="file_name fw_600"><?=$row['ct_file']?></p>
                            </div>
                        </label>
                        <div class="file_attention">
                            <h4 class="fw_600"><?=$info3?></h4>
                            <ol>
                                <li><?=$info4?></li>
                                <li><?=$info5?></li>
                                <li><?=$info6?></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <ul class="list_style_1 list_pa list_pa1">
                    <li>
                        <span><?=$resolution?> </span>
                        <p><?=$row['ct_resolution']?></p>
                    </li>
                </ul>
                <hr class="hr hr_m">
                <h3 class="fw_700"><?=$program?></h3>
                <div class="prg_select">
                    <?
                    if($row['ct_program']) {
                        $arr = explode(",", $row['ct_program']);
                        foreach ($arr as $val) {
                            if ($val == 1) {
                                $url = 'ic_premiere.png';
                                $name = "프리미어 프로";
                            } else if ($val == 2) {
                                $url = 'ic_aftereffect.png';
                                $name = "애프터 이펙트";
                            } else if ($val == 3) {
                                $url = 'ic_davinci.png';
                                $name = "다빈치 리졸브";
                            } else if ($val == 4) {
                                $url = 'ic_vegas.png';
                                $name = "베가스 프로";
                            } else if ($val == 5) {
                                $url = 'ic_finalcut.png';
                                $name = "파이널 컷 프로";
                            } else if ($val == 6) {
                                $url = 'ic_illustrator.png';
                                $name = "일러스트레이터";
                            } else if ($val == 7) {
                                $url = 'ic_photoshop_b.png';
                                $name = "포토샵";
                            } else {
                                $url = 'ic_indesign.png';
                                $name = "인디자인";
                            }
                            ?>
                            <div class="prg_box square on">
                                <button type="button" class="">
                                    <img src="<?=STATIC_HTTP."/img"."/".$url?>" alt="">
                                    <p><?=$name?></p>
                                </button>
                            </div>
                            <?
                        }
                    }
                    ?>
                </div>
                <hr class="hr">
                <h3 class="fw_700"><?=$sale_price?></h3>
                <ul class="list_style_1 list_pa list_pa1">
                    <li>
                        <span><?=$sale_price?> <span class="fc_rd">*</span></span>
                        <p><?=number_format($row['ct_price'])?>원</p>
                    </li>
                </ul>
            </div>
            <div class="d-flex mp_btn1">
                <button type="button" class="btn btn-secondary form_l" onclick="location.href='artist_my_contents.php'"><?=$list_btn?></button>
                <!--            <button type="button" class="btn btn-primary form_l form_r" onclick="update();">--><?//=$confirm?><!--</button>-->
                <button type="button" class="btn btn-primary form_r" onclick="location.href='artist_my_modify.php?ct_idx=<?=$_GET['ct_idx']."&".$_get_txt?>'"><?=$edit_btn?></button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#ct_show").val("<?=$row['ct_show']?>");
        });
        function update() {
            $.ajax({
                type: 'post',
                url: '/models/mypage/member.php',
                dataType: 'json',
                data: {type: "contents_update", ct_idx: "<?=$_GET['ct_idx']?>", ct_show: $("#ct_show").val()},
                success: function (d, s) {
                    if(d['result'] == "ok") {
                        alert("수정되었습니다.");
                        location.reload();
                    }
                },
                cache: false
            });
        }
    </script>

<? include_once("./inc/tail.php"); ?>