<?php
$title = "콘텐츠 업로드";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$back = lang("back", $_lang, "account");
$contents_upload2 = lang("contents_upload2", $_lang, "contents_upload");
$require_input = lang("require_input", $_lang, "contents_upload");
$info1 = lang("info1", $_lang, "contents_upload");
$name = lang("name", $_lang, "contents_upload");
$name_input = lang("name_input", $_lang, "contents_upload");
$contents = lang("contents", $_lang, "contents_upload");
$contents_input = lang("contents_input", $_lang, "contents_upload");
$category1 = lang("category1", $_lang, "contents_upload");
$category2 = lang("category2", $_lang, "contents_upload");
$format = lang("format", $_lang, "contents_upload");
$select = lang("select", $_lang, "contents_upload");
$info2 = lang("info2", $_lang, "contents_upload");
$framerate = lang("framerate", $_lang, "contents_upload");
$playtime = lang("playtime", $_lang, "contents_upload");
$size = lang("size", $_lang, "contents_upload");
$filter_category = lang("filter_category", $_lang, "contents_upload");
$editorial = lang("editorial", $_lang, "contents_upload");
$upload = lang("upload", $_lang, "contents_upload");
$thumbnail = lang("thumbnail", $_lang, "contents_upload");
$ment1 = lang("ment1", $_lang, "contents_upload");
$file = lang("file", $_lang, "contents_upload");
$ment2 = lang("ment2", $_lang, "contents_upload");
$info3 = lang("info3", $_lang, "contents_upload");
$info4 = lang("info4", $_lang, "contents_upload");
$info5 = lang("info5", $_lang, "contents_upload");
$info6 = lang("info6", $_lang, "contents_upload");
$info7 = lang("info7", $_lang, "contents_upload");
$resolution = lang("resolution", $_lang, "contents_upload");
$program = lang("program", $_lang, "contents_upload");
$sale_price = lang("sale_price", $_lang, "contents_upload");
$price = lang("price", $_lang, "contents_upload");
$list_btn = lang("list_btn", $_lang, "contents_upload");
$edit_btn = lang("edit_btn", $_lang, "contents_upload");
$info8 = lang("info8", $_lang, "contents_upload");
$preview1 = lang("preview1", $_lang, "contents_upload");
$preview2 = lang("preview2", $_lang, "contents_upload");
$keyword1 = lang("keyword1", $_lang, "contents_upload");
$keyword2 = lang("keyword2", $_lang, "contents_upload");
$show = lang("show", $_lang, "artist_my_contents");
$hide = lang("hide", $_lang, "artist_my_contents");
$Exclusive_content = lang("Exclusive_content", $_lang, "contents_upload");

$cancel = lang("cancel", $_lang, "find");
if($member_info['idx'] < 1) {
    p_alert('로그인 후 이용가능한 서비스입니다.', '/');
    exit;
}
if($member_info['mt_level'] != 5) {
    p_alert('아티스트만 접근가능한 서비스입니다.', '/');
    exit;
}

$query = "select *, (SELECT ct_name FROM category_t WHERE idx=ct_cate_idx) as ct_cate, (SELECT ct_name FROM category_t WHERE idx=ct_cate_idx2) as ct_cate2 
        from contents_t
        where mt_idx = ".$member_info['idx']." and idx = ".$_GET['ct_idx'];
$row = $DB->fetch_assoc($query);
?>

<div class="wrap">
    <div class="upload_pg">
        <div class="go_back"><a href="#" onclick="history.back();"><img src="img/arrow_left.png" alt=""> <?=$back?></a></div>
        <div class="d-flex justify-content-between align-items-center upload_pg_tit">
            <h2><?=$contents_upload2?></h2>
            <div class="upload_pg_img">
                <img src="img/ic_upload2.png" alt="">
            </div>
        </div>
        <form method="post" name="frm_form" id="frm_form" action="/models/mypage/member.php" onsubmit="return frm_form_chk(this);" target="_self" enctype="multipart/form-data">
        <input type="hidden" name="type" id="type" value="contents_update" />
        <input type="hidden" name="ct_idx" id="ct_idx" value="<?=$_GET['ct_idx']?>" />
        <div class="upload_box">
            <p class="c_txt"><span class="fc_rd">*</span> <?=$require_input?></p>
            <hr class="hr">
            <div class="form-group">
                <label for="exampleFormControlSelect1"><?=$show?></label>
                <select class="form-control" id="ct_show" name="ct_show" aria-placeholder="선택해주세요.">
                    <option value="N"><?=$hide?> (N)</option>
                    <option value="Y"><?=$show?> (Y)</option>
                </select>
            </div>
            <hr class="hr">
            <h3 class="fw_700"><?=$info1?></h3>
            <div class="form-group">
                <label><?=$keyword1?></label>
                <?
                $query = "select * from contents_keyword_t where ct_idx = ".$row['idx'];
                $keyword = $DB->select_query($query);
                if($keyword) {
                    foreach ($keyword as $row_k) {
                        if($_lang == "kr") {
                            $txt .= $row_k['ct_korean']." ";
                        } else {
                            $txt .= $row_k['ct_english']." ";
                        }
                    }
                }
                ?>
                <input type="text" class="form-control" placeholder="<?=$keyword2?>" name="ct_keyword" id="ct_keyword" value="<?=$txt?>">
            </div>
            <hr class="hr">
            <h3 class="fw_700"><?=$info2?></h3>
            <div class="form-group filter_chk_group">
                <label id="filtering_category"><?=$filter_category?> <? if($row['ct_cate_idx2'] != 14 || $row['ct_cate_idx2'] != 15 || $row['ct_cate_idx2'] != 12 || $row['ct_cate_idx2'] != 16) echo "<span class='fc_rd'>*</span>"; ?></label>
                <input type="hidden" id="ct_filter" name="ct_filter"/>
                <?
                foreach($arr_filter as $key => $val) {
                    if($key>0) {
                        ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?=$key?>" name="filter" id="filter<?=$key?>">
                            <label class="form-check-label" for="filter<?=$key?>">
                                <div class="chkbox">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <?=$val?>
                            </label>
                        </div>
                        <?
                    }
                }
                ?>
            </div>
            <div class="d-flex justify-content-between">
                <div class="form-group mr-5">
                    <label><?=$editorial?></label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?=$row['ct_editorial']?>" id="ct_editorial" name="ct_editorial">
                        <label class="form-check-label" for="ct_editorial">
                            <div class="chkbox">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <?=$editorial?>
                        </label>
                    </div>
                </div>
                <div class="form-group mr-5">
                    <label><?=$Exclusive_content?></label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?=$row['ct_exclusive']?>" id="ct_exclusive" name="ct_exclusive">
                        <label class="form-check-label" for="ct_exclusive">
                            <div class="chkbox">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <?=$Exclusive_content?>
                        </label>
                    </div>
                </div>
            </div>
            <hr class="hr">
            <h3 class="fw_700"><?=$upload?></h3>
            <div class="form-group filter_chk_group">
                <label><?=$resolution?></label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="6K+" name="ct_resolution" id="6K">
                    <label class="form-check-label" for="6K">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        6K+
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="4K" name="ct_resolution" id="4K">
                    <label class="form-check-label" for="4K">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        4K
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="QHD" name="ct_resolution" id="QHD">
                    <label class="form-check-label" for="QHD">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        QHD
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="FHD" name="ct_resolution" id="FHD">
                    <label class="form-check-label" for="FHD">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        FHD
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="HD" name="ct_resolution" id="HD">
                    <label class="form-check-label" for="HD">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        HD
                    </label>
                </div>
            </div>
            <hr class="hr">
            <h3 class="fw_700"><?=$program?></h3>
            <div class="prg_select">
                <input type="hidden" id="ct_program" name="ct_program" value=""/>
                <?
                foreach($arr_program as $key => $val) {
                    if($key>0) {
                        $program2 = explode(",", $row['ct_program']);
                        if($program2):
                            foreach ($program2 as $row_p):
                                if($key == $row_p) {
                                    $class = "on";
                                    break;
                                } else {
                                    $class = "";
                                    continue;
                                }
                        endforeach; endif;
                        ?>
                        <div class="prg_box square <?=$class?>" name="program" value="<?=$key?>">
                            <button type="button">
                                <?
                                if($key == 1) {
                                    $url = 'ic_premiere.png';
                                    $name = "프리미어 프로";
                                } else if($key == 2) {
                                    $url = 'ic_aftereffect.png';
                                    $name = "애프터 이펙트";
                                } else if($key == 3) {
                                    $url = 'ic_davinci.png';
                                    $name = "다빈치 리졸브";
                                } else if($key == 4) {
                                    $url = 'ic_vegas.png';
                                    $name = "베가스 프로";
                                } else if($key == 5) {
                                    $url = 'ic_finalcut.png';
                                    $name = "파이널 컷 프로";
                                } else if($key == 6) {
                                    $url = 'ic_illustrator.png';
                                    $name = "일러스트레이터";
                                } else if($key == 7) {
                                    $url = 'ic_photoshop_b.png';
                                    $name = "포토샵";
                                } else {
                                    $url = 'ic_indesign.png';
                                    $name = "인디자인";
                                }
                                ?>
                                <img src="<?=STATIC_HTTP."/img"."/".$url?>" style="width: 50px;height: 50px;">
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
            <div class="form-group">
                <label><?=$price?> <span class="fc_rd">*</span></label>
                <div class="d-flex align-items-center">
                    <input type="text" class="form-control" placeholder="0" numberOnly="" name="ct_price" id="ct_price" value="<?=$row['ct_price']?>"><p class="upload_price ml-4">원</p>
                </div>
                <small class="form-text text-danger"><img class="mr-2" src="img/ic_label_danger.png"><?=$info8?></small>
            </div>
        </div>
        <div class="d-flex mp_btn1">
            <button type="button" class="btn btn-secondary form_l" onclick="history.back();"><?=$cancel?></button>
            <button type="submit" class="btn btn-primary form_r"><?=$edit_btn?></button>
        </div>
        </form>
    </div>
</div>

<?php include_once("./inc/alert_modal.php"); ?>

<script>
    $(document).ready(function() {
        $("#ct_show").val("<?=$row['ct_show']?>");
        if("<?=$row['ct_editorial']?>" == "Y") {
            $("#ct_editorial").attr("checked", true);
        }
        if("<?=$row['ct_exclusive']?>" == "Y") {
            $("#ct_exclusive").attr("checked", true);
        }
        $("input:radio[name='ct_resolution'][value='<?=$row['ct_resolution']?>']").prop("checked", true);
        var filter = "<?=$row['ct_filter']?>";
        filter = filter.split(",");
        if(filter) {
            for(var i=0; i<filter.length; i++) {
                $("input[name='filter'][value='"+filter[i]+"']").prop("checked", true);
            }
        }
    });

    $(".prg_box").on("click",function(){
        $(this).toggleClass("on");
    })

    $("#ct_price").on("keyup", function() {
        if($("#ct_price").val() >= 1000 && $("#ct_price").val() <= 200000) {
            $("#ct_price").removeClass("border-danger");
        } else {
            $("#ct_price").addClass("border-danger");
        }
    });
    $("#ct_editorial").on("click", function() {
        if($("#ct_editorial").is(":checked") == true) {
            $("#ct_editorial").val("Y");
        } else {
            $("#ct_editorial").val("N");
        }
    });
    $("#ct_exclusive").on("click", function() {
        if($("#ct_exclusive").is(":checked") == true) {
            $("#ct_exclusive").val("Y");
        } else {
            $("#ct_exclusive").val("N");
        }
    });

    $("#ct_keyword").on("keyup", function(e) {
        var str = $("#ct_keyword").val();
        var count = str.split(' ').length - 1;
        if(count > 4) {
            alert("키워드는 최대 5개까지 입력가능합니다.");
            $("#ct_keyword").val($("#ct_keyword").val().substring(0, $("#ct_keyword").val().length-1));
        }
    });

    function frm_form_chk(f) {
        if("<?=$row['ct_cate_idx2']?>"!="12"&&"<?=$row['ct_cate_idx2']?>".value!="14"&&"<?=$row['ct_cate_idx2']?>".value!="15"&&"<?=$row['ct_cate_idx2']?>".value!="16") {
            var v = '' ;
            var c = 0;
            for (var i = 0; i < $("input[name=filter]:checkbox").length; i++) {
                if ($( "input[name=filter]:checkbox")[i].checked == true) {
                    if (c > 0) v = v + "," ;
                    v = v + $("input[name=filter]:checkbox")[i].value;
                    c++;
                }
            }
            if(c<1) {
                alert("필터링 카테고리를 하나 이상 선택해주세요.");
                return false;
            } else {
                $("#ct_filter").val(v);
            }
        }
        if(f.ct_price.value=="") {
            alert("판매가격을 입력해주세요.");
            f.ct_price.focus();
            $("#ct_price").addClass("border-danger");
            return false;
        } else {
            if(f.ct_price.value < 1000 || f.ct_price.value > 200000) {
                $("#ct_price").addClass("border-danger");
                return false;
            }
        }
        var v = '' ;
        var c = 0;
        $('.prg_box.square.on').each(function(){
            if (c > 0) v = v + "," ;
            v = v + $(this).attr("value");
            c++;
        });
        $("#ct_program").val(v);
    }
</script>

<? include_once("./inc/tail.php"); ?>