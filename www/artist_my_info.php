<?php
$title = "프로필수정";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$profile_update = lang("profile_update", $_lang, "mypage");
$update_btn = lang("update_btn", $_lang, "mypage");
$nickname = lang("nickname", $_lang, "signup");
$chk = lang("chk", $_lang, "signup");
$chk2 = lang("chk2", $_lang, "signup");
$portpolio = lang("portpolio", $_lang, "signup");
$url = lang("url", $_lang, "signup");
$profile = lang("profile", $_lang, "signup");
$introduce = lang("introduce", $_lang, "signup");

if($member_info['idx'] < 1) {
    p_alert('로그인 후 이용가능한 서비스입니다.', '/');
    exit;
}
if($member_info['mt_level'] != 5) {
    p_alert('아티스트만 접근가능한 서비스입니다.', '/');
    exit;
}
?>
    <style>
        .form-group:last-child {
            margin-bottom: 30px;
        }
    </style>
    <div class="wrap">
        <div class="signup_pg">
            <h2><?=$profile_update?></h2>
            <div class="login_box">
                <form method="post" name="frm_login" id="frm_login" action="/models/mypage/member.php" onsubmit="return frm_signup_submit(this);" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="profile_update"/>
                    <input type="hidden" name="chk_nickname" id="chk_nickname" value="false"/>
                    <div class="form-group form-group_1">
                        <label for="mt_nickname"><?=$nickname?></label>
                        <input type="text" class="form-control" name="mt_nickname" id="mt_nickname" value="<?=$member_info['mt_nickname']?>">
                        <button type="button" class="btn btn-outline-primary btn-sm btn_in" onclick="f_chk_nickname()" id="chk_btn"><?=$chk?></button>
                        <div class="btn btn-outline-secondary btn-sm btn_in pe_none d-none" id="confirm_btn"><?=$chk2?></div>
                    </div>
                    <div class="form-group form-group_1">
                        <label for="url1"><?=$portpolio?></label>
                        <input type="text" class="form-control" name="mt_url1" id="url1" value="<?=$member_info['mt_url1']?>">
                    </div>
                    <div id="portfolio_area">
                        <? for($i=2; $i<=5; $i++) {
                            if($member_info['mt_url'.$i]) {
                                ?>
                                <div class="form-group form-group_1" id="area<?=$i?>" onfocus="area_focus(this)" onkeyup="area_focus(this)" onfocusin="area_focus(this)" onfocusout="area_blur(this)">
                                    <label for="url<?=$i?>"><?=$portpolio?></label>
                                    <input type="text" class="form-control" name="mt_url<?=$i?>" id="url<?=$i?>" value="<?=$member_info['mt_url'.$i]?>">
                                    <button type="button" class="btn_in btn_del" onclick="minus_portfolio('area<?=$i?>')"></button>
                                </div>
                                <?
                            }
                        }
                        ?>
                    </div>
                    <div class="btn_add">
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="plus_portfolio();">+ <?=$url?></button>
                    </div>
                    <div class="prof_box">
                        <p class="fs-17"><?=$profile?></p>
                        <div class="prof_file">
                            <input type="file" name="mt_image" id="mt_image" value="<?=$member_info['mt_image']?>" accept=".gif, .jpg, .jpeg, .png, .bmp" class="d-none" />
                            <input type="hidden" name="mt_image_on" id="mt_image_on" value="<?=$member_info['mt_image']?>" class="form-control" />
                            <div class="file_img square" id="mt_image_box">
                                <img src="<? if($member_info['mt_image']) echo $ct_img_url."/".$member_info['mt_image']; else echo $ct_member_no_img_url;?>" alt="">
                            </div>
                            <button type="button" class="btn_write" onclick="$('#mt_image').click();"></button>
                        </div>
                        <div class="form-group form-group_1">
                            <label for="mt_introduce"><?=$introduce?></label>
                            <textarea class="form-control" name="mt_introduce" id="mt_introduce" style="resize: none;" maxlength="120"><?=$member_info['mt_introduce']?></textarea>
                            <small class="form-text textCount" id="txt_cnt">0/120</small>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary login_btn"><?=$update_btn?></button>
                </form>
            </div>
        </div>
    </div>

<?php include_once("./inc/alert_modal.php"); ?>
    <script>
        $(document).ready(function() {
            let content = $("#mt_introduce").val();
            if (content.length == 0 || content == '') {
                $('.textCount').text('0/120');
            } else {
                if (content.length > 120) {
                    $(this).val($(this).val().substring(0, 120));
                    $('.textCount').text('120/120');
                } else {
                    $('.textCount').text(content.length + '/120');
                }
            }
        });
        $('#mt_introduce').keyup(function () {
            let content = $(this).val();
            if (content.length == 0 || content == '') {
                $('.textCount').text('0/120');
            } else {
                if (content.length > 120) {
                    $(this).val($(this).val().substring(0, 120));
                    $('.textCount').text('120/120');
                } else {
                    $('.textCount').text(content.length + '/120');
                }
            }
        });
        $('#mt_image').on('change', function(e) {
            var target_id = e.target.id;
            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);

            filesArr.forEach(function(f) {
                if(!f.type.match("image.*")) {
                    alert("확장자는 이미지 확장자만 가능합니다.");
                    return;
                }
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#"+target_id+"_box").html('<img src="'+e.target.result+'" />');
                }
                reader.readAsDataURL(f);
            });
        });
        $("#mt_nickname").on("change", function() {
            $("#chk_nickname").val("false");
            $("#confirm_btn").addClass("d-none");
            $("#chk_btn").removeClass("d-none");
        });
        function frm_signup_submit(f){
            if(f.mt_nickname.value==''){
                $("#txt").text("닉네임을 입력해주세요.");
                $('#id_alert').modal('show');
                return false;
            }
            if(f.mt_url1.value==''){
                $("#txt").text("포트폴리오(url)을 하나 이상 입력해주세요.");
                $('#id_alert').modal('show');
                return false;
            }
            if(f.chk_nickname.value=="false") {
                $("#txt").text("닉네임 중복확인을 해주세요.");
                $('#id_alert').modal('show');
                return false;
            }
        }
        function f_chk_nickname() {
            if($("#mt_nickname").val() == "") {
                $("#txt").text("닉네임을 입력해주세요.");
                $('#id_alert').modal('show');
                return false;
            }
            $.ajax({
                type: 'post',
                url: './models/mypage/member.php',
                dataType: 'json',
                data: {type: "chk_nickname", mt_nickname: $("#mt_nickname").val()},
                success: function (result) {
                    if(result['result'] == "ok") {
                        $("#chk_nickname").val("true");
                        $("#confirm_btn").removeClass("d-none");
                        $("#chk_btn").addClass("d-none");
                    } else {
                        $("#chk_nickname").val("false");
                        $("#txt").text("이미 사용중인 닉네임입니다.");
                        $('#id_alert').modal('show');
                    }
                },
            });
        }
        function plus_portfolio() {
            var url =  $("input[id^='url']");
            var url_arr = {};
            for(var j=0; j<url.length; j++) {
                url_arr[url[j].id] = $("#"+url[j].id).val();
            }
            var html = $("#portfolio_area").html();
            var max = $("input[id^='url']").length + 1;
            if(max > 5) {
                alert("포트폴리오(url)은 최대 5개까지 등록할 수 있습니다.");
                return false;
            } else {
                html += '<div class="form-group form-group_1" id="area'+max+'" onfocus="area_focus(this)" onkeyup="area_focus(this)" onfocusin="area_focus(this)" onfocusout="area_blur(this)">';
                html += '<label for="url'+max+'">포트폴리오(url)</label>';
                html += '<input type="text" class="form-control" name="mt_url'+max+'" id="url'+max+'">';
                html += '<button type="button" class="btn_in btn_del" onclick="minus_portfolio(\'area'+max+'\')"></button>';
                html += '</div>';
                $("#portfolio_area").html(html);
                $.each(url_arr, function(id, val) {
                    $("#"+id).val(val);
                });
            }
        }
        function minus_portfolio(id) {
            $("#"+id).remove();
        }

        function area_blur(e) {
            if($("#"+e.id).children('input').val() == ''){
                $("#"+e.id).children('label').removeClass('on');
            }else{

            }
        }

        function area_focus(e) {
            $("#"+e.id).children('label').addClass('on');
        }
    </script>

<? include_once("./inc/tail.php"); ?>