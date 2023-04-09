<?php
$title = "콘텐츠 업로드";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$back = lang("back", $_lang, "account");
$contents_upload = lang("contents_upload", $_lang, "contents_upload");
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
$Exclusive_content = lang("Exclusive_content", $_lang, "contents_upload");
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
$info9 = lang("info9", $_lang, "contents_upload");
$resolution = lang("resolution", $_lang, "contents_upload");
$program = lang("program", $_lang, "contents_upload");
$sale_price = lang("sale_price", $_lang, "contents_upload");
$price = lang("price", $_lang, "contents_upload");
$list_btn = lang("list_btn", $_lang, "contents_upload");
$input_btn = lang("input_btn", $_lang, "contents_upload");
$info8 = lang("info8", $_lang, "contents_upload");
$preview1 = lang("preview1", $_lang, "contents_upload");
$preview2 = lang("preview2", $_lang, "contents_upload");
$keyword1 = lang("keyword1", $_lang, "contents_upload");
$keyword2 = lang("keyword2", $_lang, "contents_upload");
$guide = lang("guide", $_lang, "contents_upload");
if($member_info['idx'] < 1) {
    p_alert('로그인 후 이용가능한 서비스입니다.', '/');
    exit;
}
if($member_info['mt_level'] != 5) {
    p_alert('아티스트만 접근가능한 서비스입니다.', '/');
    exit;
}
?>

<div class="wrap">
    <div class="upload_pg">
        <div class="go_back"><a href="#" onclick="history.back();"><img src="img/arrow_left.png" alt=""> <?=$back?></a></div>
        <div class="d-flex justify-content-between align-items-center upload_pg_tit">
            <h2><?=$contents_upload?></h2>
            <div class="upload_pg_img">
                <img src="img/ic_upload2.png" alt="">
            </div>
        </div>
        <form method="post" name="frm_form" id="frm_form" action="/models/mypage/member.php" onsubmit="return frm_form_chk(this);" target="_self" enctype="multipart/form-data">
        <input type="hidden" name="type" id="type" value="input" />
        <input type="hidden" name="ct_type" id="ct_type" value="<?=$_GET['ct_type']?>" />
        <div class="upload_box">
            <p class="c_txt"><span class="fc_rd">*</span> <?=$require_input?></p>
            <hr class="hr">
            <h3 class="fw_700"><?=$info1?></h3>
            <div class="form-group">
                <label><?=$name?> <span class="fc_rd">*</span></label>
                <input type="text" class="form-control" placeholder="<?=$name_input?>" name="ct_title">
            </div>
            <div class="form-group">
                <label class="d-flex justify-content-between">
                    <p><?=$contents?></p>
                    <p class="contents_lm textCount">0/100</p>
                </label>
                <textarea class="form-control" placeholder="<?=$contents_input?>" name="ct_contents" id="ct_contents"></textarea>
            </div>
            <div class="form-group">
                <label><?=$keyword1?></label>
                <input type="text" class="form-control" placeholder="<?=$keyword2?>" name="ct_keyword" id="ct_keyword">
            </div>
            <div class="d-flex justify-content-between">
                <div class="form-group mr-5">
                    <label for="ct_cate_idx"><?=$category1?> <span class="fc_rd">*</span></label>
                    <select class="form-control" id="ct_cate_idx" name="ct_cate_idx" aria-placeholder="선택해주세요.">
                        <option value="" disabled selected><?=$select?></option>
                        <?
                        $query = "select * from category_t where ct_level = 0 order by ct_orderby";
                        $category1 = $DB->select_query($query);
                        if($category1) {
                            foreach ($category1 as $cate1) {
                                ?>
                                <option value="<?=$cate1['idx']?>"><?=$cate1['ct_name']?></option>
                                <?
                            }
                        }
                        ?>
                    </select>
                </div>     
                <div class="form-group">
                    <label for="ct_cate_idx2"><?=$category2?> <span class="fc_rd">*</span></label>
                    <select class="form-control" id="ct_cate_idx2" name="ct_cate_idx2" aria-placeholder="선택해주세요.">
                        <option value="" disabled selected><?=$select?></option>
                    </select>
                </div>     
            </div>
            <div class="form-group">
                <label for="ct_format"><?=$format?> <span class="fc_rd">*</span></label>
                <select class="form-control" id="ct_format" name="ct_format" aria-placeholder="선택해주세요.">
                    <option value="" disabled selected><?=$select?></option>
                </select>
            </div>
            <hr class="hr">
            <h3 class="fw_700"><?=$info2?></h3>
            <div class="upload_detail_wr">
                <div class="form-group mr-5">
                    <label for="ct_framerate" id="framerate_label"><?=$framerate?></label>
                    <select class="form-control" id="ct_framerate" name="ct_framerate" aria-placeholder="선택해주세요.">
                    <option value="" disabled selected><?=$select?></option>
                        <?= $arr_framerate_option ?>
                    </select>
                </div>
                <div class="form-group">
                    <label><?=$playtime?></label>
                    <div class="upload_p_time">
                        <input type="text" class="form-control" placeholder="0" numberOnly="" name="ct_time_hour"><span>:</span>
                        <input type="text" class="form-control" placeholder="0" numberOnly="" name="ct_time_min"><span>:</span>
                        <input type="text" class="form-control" placeholder="0" numberOnly="" name="ct_time_sec">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label><?=$size?></label>
                <input class="form-control" type="text" placeholder="0MB" readonly id="ct_size" name="ct_size">
            </div>
            <div class="form-group filter_chk_group">
                <label id="filtering_category"><?=$filter_category?> </label>
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
                        <input class="form-check-input" type="checkbox" value="N" id="ct_editorial" name="ct_editorial">
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
                        <input class="form-check-input" type="checkbox" value="N" id="ct_exclusive" name="ct_exclusive">
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
            <div class="contents_thumb">
                <label><?=$thumbnail?> <span class="fc_rd">*</span></label>
                <input type="hidden" name="ct_image_on" id="ct_image_on" value="" class="form-control">
                <label class="thumb_upload_btn" for="ct_image" id="ct_image_box"></label>
                <input type="file" id="ct_image" hidden name="ct_image" accept=".jpeg, .jpg, .png, .gif">
                <p><?=$ment1?></p>
            </div>

            <div class="contents_thumb d-none" id="preview_area">
                <label><?=$preview1?> <span class="fc_rd">*</span></label>
                <input type="hidden" name="ct_preview_on" id="ct_preview_on" value="" class="form-control">
                <label class="thumb_upload_btn" for="ct_preview" id="ct_preview_box"></label>
                <input type="file" id="ct_preview" hidden name="ct_preview" accept=".mp4">
                <p><?=$preview2?></p>
            </div>

            <div class="file_upload">
                <label><?=$file?> <span class="fc_rd">*</span></label>
                <div class="file_upload_box">
                    <input type="hidden" name="ct_file_on" id="ct_file_on" value="" class="form-control">
                    <label class="file_upload_btn position-relative" for="ct_file">
                        <div class="position-absolute file_upload_b dropBox">
                            <img src="img/upload_img.png" alt="">
                            <p><?=$ment2?></p>
                        </div>
                    </label>
                    <input type="file" id="ct_file" name="ct_file" hidden accept=".jpeg, .jpg, .png, .gif">
                    <div class="file_attention">
                        <h4 class="fw_600"><?=$info3?></h4>
                        <ol>
                            <li><?=$info4?></li>
                            <li><?=$info5?></li>
                            <li><?=$info6?></li>
                            <li><?=$info9?></li>
                        </ol>
                    </div>
                </div>
                <p><?=$info7?></p>
            </div>
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
                        ?>
                        <div class="prg_box square" name="program" value="<?=$key?>">
                            <button type="button" class="" >
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
                    <input type="text" class="form-control" placeholder="0" numberOnly="" name="ct_price" id="ct_price"><p class="upload_price ml-4">원</p>
                </div>
                <small class="form-text text-danger"><img class="mr-2" src="img/ic_label_danger.png"><?=$info8?></small>
                <small class="form-text"><?=$guide?></small>
            </div>
        </div>
        <div class="d-flex mp_btn1">
            <button type="button" class="btn btn-secondary form_l" onclick="location.href='/artist_my_contents.php'"><?=$list_btn?></button>
            <button type="submit" class="btn btn-primary form_r"><?=$input_btn?></button>
        </div>
        </form>
    </div>
</div>

<?php include_once("./inc/alert_modal.php"); ?>

<script>
    $('#ct_contents').keyup(function () {
        let content = $(this).val();
        if (content.length == 0 || content == '') {
            $('.textCount').text('0/100');
        } else {
            if (content.length > 100) {
                $(this).val($(this).val().substring(0, 100));
                $('.textCount').text('100/100');
            } else {
                $('.textCount').text(content.length + '/100');
            }
        }
    });
    $(".prg_box").on("click",function(){
        $(this).toggleClass("on");
    })

    function frm_form_chk(f) {
        if(f.ct_title.value=="") {
            alert("컨텐츠명을 입력해주세요.");
            f.ct_title.focus();
            return false;
        }
        if(f.ct_cate_idx.value=="") {
            alert("카테고리(대분류)를 선택해주세요.");
            f.ct_cate_idx.focus();
            return false;
        }
        if(f.ct_cate_idx2.value=="") {
            alert("카테고리(중분류)를 선택해주세요.");
            f.ct_cate_idx2.focus();
            return false;
        }
        if(f.ct_cate_idx.value=="1") {
            if(f.ct_framerate.value=="") {
                alert("프레임레이트를 선택해주세요.");
                f.ct_framerate.focus();
                return false;
            }
        }
        if(f.ct_format.value=="") {
            alert("포맷을 선택해주세요.");
            f.ct_format.focus();
            return false;
        }
        if(f.ct_cate_idx2.value!="12"&&f.ct_cate_idx2.value!="14"&&f.ct_cate_idx2.value!="15"&&f.ct_cate_idx2.value!="16") {
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
        if(f.ct_image.value=="" && f.ct_image_on.value=="") {
            alert("대표 썸네일을 등록해주세요.");
            f.ct_image.focus();
            return false;
        }
        if(f.ct_cate_idx2.value==14||f.ct_cate_idx2.value==15) {
            if(f.ct_preview.value=="" && f.ct_preview_on.value=="") {
                alert("미리보기 영상을 등록해주세요.");
                f.ct_preview.focus();
                return false;
            }
        }
        if((f.ct_file.value=="" && f.ct_file_on.value=="")) {
            alert("업로드할 파일을 등록해주세요.");
            f.ct_file.focus();
            return false;
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
        $('#splinner_modal').modal('show');
    }

    $("#ct_price").on("keyup", function() {
        if($("#ct_price").val() >= 1000 && $("#ct_price").val() <= 200000) {
            $("#ct_price").removeClass("border-danger");
        } else {
            $("#ct_price").addClass("border-danger");
        }
    });

    const dropZone = document.querySelector(".dropBox");
    const $title = document.querySelector(".dropBox p");
    var $file = document.getElementById("ct_file");

    var toggleClass = function(className) {
        var list = ["dragenter", "dragleave", "dragover", "drop"]

        for (var i = 0; i < list.length; i++) {
            if (className === list[i]) {
                dropZone.classList.add("active")
            } else {
                dropZone.classList.remove("active")
            }
        }
    }

    var showFiles = function(files) {
        $title.innerHTML = ""
        for(var i = 0, len = files.length; i < len; i++) {
            var size = files[i].size;
            size = size / 1024 / 1024;
            $("#ct_size").val(size.toFixed(1)+"MB");
            $title.innerHTML += files[i].name+"<br>";
        }
    }

    var selectFile = function(files) {
        // input file 영역에 드랍된 파일들로 대체
        $file.files = files
        showFiles($file.files)
    }

    $file.addEventListener("change", function(e) {
        showFiles(e.target.files)
    })

    // 드래그한 파일이 최초로 진입했을 때
    dropZone.addEventListener("dragenter", function(e) {
        e.stopPropagation()
        e.preventDefault()

        toggleClass("dragenter")
    })

    // 드래그한 파일이 dropZone 영역을 벗어났을 때
    dropZone.addEventListener("dragleave", function(e) {
        e.stopPropagation()
        e.preventDefault()

        toggleClass("dragleave")
    })

    // 드래그한 파일이 dropZone 영역에 머물러 있을 때
    dropZone.addEventListener("dragover", function(e) {
        e.stopPropagation()
        e.preventDefault()

        toggleClass("dragover")
    })

    // 드래그한 파일이 드랍되었을 때
    dropZone.addEventListener("drop", function(e) {
        e.preventDefault()

        toggleClass("drop")

        var files = e.dataTransfer && e.dataTransfer.files

        if (files != null) {
            if (files.length < 1) {
                alert("폴더 업로드 불가")
                return false;
            }
            selectFile(files)
        } else {
            alert("ERROR")
        }
    })

    $('#ct_image').on('change', function(e) {
        var target_id = e.target.id;
        var files = e.target.files;
        var filesArr = Array.prototype.slice.call(files);

        filesArr.forEach(function(f) {
            if(!f.type.match("image.*")) {
                alert("확장자는 이미지 확장자만 가능합니다.");
                return;
            }

            sel_files.push(f);

            var reader = new FileReader();
            reader.onload = function(e) {
                $("#"+target_id+"_box").removeClass('d-none');
                $("#"+target_id+"_box").css('border', 'none');
                $("#"+target_id+"_box").html('<img src="'+e.target.result+'" style="width: 100%;height: 100%;" />')
            }
            reader.readAsDataURL(f);
        });
    });
    $('#ct_preview').on('change', function(e) {
        var target_id = e.target.id;
        var files = e.target.files;
        var filesArr = Array.prototype.slice.call(files);

        filesArr.forEach(function(f) {
            sel_files.push(f);

            var reader = new FileReader();
            reader.onload = function(e) {
                $("#"+target_id+"_box").removeClass('d-none');
                $("#"+target_id+"_box").css('border', 'none');
                $("#"+target_id+"_box").html('<video src="'+e.target.result+'" style="width: 100%;height: 100%;" />');
            }
            reader.readAsDataURL(f);
        });
    });
    $('#ct_file').on('change', function(e) {
        var target_id = e.target.id;
        var files = e.target.files;
        var filesArr = Array.prototype.slice.call(files);

        filesArr.forEach(function(f) {
            sel_files.push(f);

            var reader = new FileReader();
            reader.onload = function(e) {
                $title.innerHTML = f.name+"<br>";
            }
            reader.readAsDataURL(f);

            var size = f.size;
            size = size / 1024 / 1024;
            $("#ct_size").val(size.toFixed(1)+"MB");
        });
    });
    $('#ct_file').on('click', function(e) {
        if($("#ct_format").val() == "") {
            alert("포맷을 선택해주세요.");
            return false;
        } else {
            $("#ct_file").attr("accept", "."+$("#ct_format").val());
        }
    });
    $("#ct_cate_idx2").on("change", function() {
        var html = f_format($("#ct_cate_idx2 option:checked").text());
        if($("#ct_cate_idx2").val()==14||$("#ct_cate_idx2").val()==15) {
            $("#preview_area").removeClass("d-none");
            $("#filtering_category").html("<?=$filter_category?>");
        } else {
            if($("#ct_cate_idx2").val()==12||$("#ct_cate_idx2").val()==16) {
                $("#filtering_category").html("<?=$filter_category?>");
            } else {
                $("#filtering_category").html("필터링 카테고리(중복선택가능) <span class='fc_rd'>*</span>");
            }
            $("#preview_area").addClass("d-none");
        }
        $("#ct_format").html(html);
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
    $("#ct_cate_idx").on("change", function() {
        $.ajax({
            type: 'post',
            url: '/models/mypage/member.php',
            dataType: 'json',
            data: {type: "get_category", idx: $("#ct_cate_idx").val()},
            success: function (d, s) {
                if(d['result'] == "ok") {
                    $("#ct_cate_idx2").html(d['data']);
                    $("#ct_format").html('<option value="" disabled="" selected="">선택</option>');
                    if($("#ct_cate_idx").val() == "1") {
                        $("#framerate_label").html($("#framerate_label").text()+" <span class='fc_rd'>*</span>");
                    } else {
                        $("#framerate_label").html("<?=$framerate?>");
                    }
                }
            },
            cache: false
        });
    });

    $("#ct_keyword").on("keyup", function(e) {
        var str = $("#ct_keyword").val();
        var count = str.split(' ').length - 1;
        if(count > 4) {
            alert("키워드는 최대 5개까지 입력가능합니다.");
            $("#ct_keyword").val($("#ct_keyword").val().substring(0, $("#ct_keyword").val().length-1));
        }
    });
</script>

<? include_once("./inc/tail.php"); ?>