<?
include "./head_inc.php";
$chk_menu = "0";

$query = "select a1.*, a1.idx as mt_idx from member_t a1 where a1.idx = '".$_GET['mt_idx']."'";
$row = $DB->fetch_query($query);

$_act = $_GET['act'];

if($row['mt_level'] > 2) {
    if($row['mt_level'] == 3) {
        $chk_sub_menu = '1';
        $title = "일반";
        $list_url_t = "member_list.php";
    } else {
        $chk_sub_menu = '3';
        $title = "아티스트";
        $list_url_t = "artist_list.php";
    }
} else {
    $chk_sub_menu = '4';
    $title = "탈퇴";
    $list_url_t = "member_retire_list.php";
}

include "./head_menu_inc.php";

$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&pg=".$_GET['pg'];
?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?=$title?>회원 상세</h4>
                        <?
                        if($row['mt_level'] == 1 || $row['mt_level'] == 2) {
                        ?>
                            <div class="card-description float-right">
                                <button class="btn btn-danger" type="button" onclick="delete_mem('<?=$row['mt_idx']?>')">삭제</button>
                            </div>
                        <?
                        }
                        ?>
                        <p class="card-description">
                            Chrome 사용을 권장합니다. 이외의 브라우저 또는 Chrome 하위버전으로 접속 할 경우 페이지가 깨져 보일 수 있습니다.
                        </p>
                        <form method="post" name="frm_form" id="frm_form" action="./member_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" enctype="multipart/form-data">
                            <input type="hidden" name="act" id="act" value="<?=$_act?>" />
                            <input type="hidden" name="idx" id="idx" value="<?=$row['idx']?>" />

                            <div class="form-group row">
                                <div class="card-body">
                                    <p class="mb-0"></p>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">이름</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <span type="text"><?=$row['mt_firstname']." ".$row['mt_lastname']?></span>
                                                    </div>
                                                </div>
                                                <label for="ct_title" class="col-sm-2 col-form-label">가입일시</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <span type="text" id="mt_id"><?=DateType($row['mt_wdate'],4)?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">아이디</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <span type="text"><?=$row['mt_id']?></span>
                                                    </div>
                                                </div>
                                                <label for="ct_title" class="col-sm-2 col-form-label">로그인일시</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <span type="text"><?=DateType($row['mt_ldate'],4)?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">로그인 가능</label>
                                                <div class="col-sm-2">
                                                    <div class="input-group">
                                                        <select id="mt_login_status" name="mt_login_status" class="form-control">
                                                            <option value="Y">가능</option>
                                                            <option value="N">불가능</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <script>
                                            $("#mt_login_status").val("<?=$row['mt_login_status']?>");
                                        </script>
                                        <?php
                                        if($row['mt_login_type'] == 1) {
                                        ?>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">

                                                <label for="ct_title" class="col-sm-2 col-form-label">비밀번호</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="text" name="mt_pwd" id="mt_pwd" value="" class="form-control" maxlength="255" placeholder="비밀번호 입력"/>
                                                    </div>
                                                </div>
                                                <label for="ct_title" class="col-sm-2 col-form-label">비밀번호 확인</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="text" name="mt_pwd_re" id="mt_pwd_re" value="" class="form-control" maxlength="255" placeholder="비밀번호 재 입력"/>
                                                    </div>
                                                    <div class="input-group">
                                                        <small> * 비밀번호 변경 시에는 비밀번호 확인까지 입력바랍니다.</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <? } ?>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">휴대폰 번호</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="text" name="mt_hp" id="mt_hp" value="<?=$row['mt_hp']?>" class="form-control" maxlength="255" numberonly="" placeholder='"-" 제외한 숫자만 입력'/>
                                                    </div>
                                                </div>
                                                <label for="ct_title" class="col-sm-2 col-form-label">회원탈퇴</label>
                                                <div class="col-sm-2">
                                                    <div class="input-group">
                                                        <?
                                                        if($row['mt_level'] > 2) {
                                                        ?>
                                                        <button type="button" class="btn btn-secondary" onclick="retire('<?=$row['mt_idx']?>');">탈퇴</button>
                                                        <?
                                                        } else {
                                                        ?>
                                                        <button type="button" class="btn btn-secondary" onclick="restore('<?=$row['mt_idx']?>');">복구</button>
                                                        <?
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="mt_memo" class="col-sm-8 col-form-label"></label>
                                                <div class="col-sm-4">
                                                    <textarea class="form-control" id="mt_retire_memo" style="height: 150px;" placeholder="메모 입력"><?=$row['mt_memo']?></textarea>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <?
                                    if($row['mt_level'] == 5) {
                                    ?>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <div class="form-group row align-items-center mb-0">
                                                    <label for="ct_title" class="col-sm-2 col-form-label">닉네임</label>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span type="text"><?=$row['mt_nickname']?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="form-group row align-items-center mb-0">
                                                    <label for="ct_title" class="col-sm-2 col-form-label">포트폴리오<br/>(Url)</label>
                                                    <div class="col-sm-4">
                                                        <?
                                                        for($i=1; $i<=5; $i++) {
                                                            if($row['mt_url'.$i] != "") {
                                                                ?>
                                                                <div class="input-group">
                                                                    <span type="text"><?=$row['mt_url'.$i]?></span>
                                                                </div>
                                                                <?
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="form-group row align-items-center mb-0">
                                                    <label class="col-sm-2 col-form-label">프로필사진</label>
                                                    <div class="col-sm-10">
                                                        <label for="mt_image" id="mt_image_box">
                                                            <a href="javascript:;" onclick="f_popup_image('<?=$row['idx']?>')">
                                                                <img style="width: 100px;" onclick="" src="<?php echo ($row['mt_image']) ? $ct_img_url."/".$row['mt_image']."?cache=".time() : $ct_member_no_img_url; ?>">
                                                            </a>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="form-group row align-items-center mb-0">
                                                    <label for="ct_title" class="col-sm-2 col-form-label">자기소개글</label>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span type="text"><?=$row['mt_introduce']?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    <?
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="fixed-bottom product_form">
                                <p class="p-3 mt-3 text-center">
                                    <input type="button" value="목록" onclick="location.href='<?=$list_url_t."?".$_get_txt?>'" class="btn btn-outline-secondary mx-2" />
                                    <input type="submit" value="저장" class="btn btn-info" />
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function frm_form_chk(f) {
            if(f.mt_pwd.value!="") {
                if(f.mt_pwd_re.value=="") {
                    alert("비밀번호 확인을 입력해주세요.");
                    f.mt_pwd_re.focus();
                    return false;
                } else {
                    if(f.mt_pwd.value != f.mt_pwd_re.value) {
                        alert("비밀번호가 일치하지않습니다.");
                        f.mt_pwd_re.focus();
                        return false;
                    }
                }
            }
            $('#splinner_modal').modal('show');
        }
        function retire(idx) {
            if($("#mt_retire_memo").val() == "") {
                alert("탈퇴 사유를 입력해주세요.");
                $("#mt_retire_memo").focus();
                return false;
            }
            $.ajax({
                type: 'post',
                url: './member_update.php',
                dataType: 'json',
                data: {act: "retire", idx: idx, mt_retire_memo: $("#mt_retire_memo").val()},
                success: function (d, s) {
                    if (d['result'] == "ok") {
                        alert(d['msg']);
                        location.reload();
                    } else {
                        alert(d['msg']);
                        location.reload();
                    }
                },
                cache: false
            });
        }
        function restore(idx) {
            $.ajax({
                type: 'post',
                url: './member_update.php',
                dataType: 'json',
                data: {act: "restore", idx: idx},
                success: function (d, s) {
                    if (d['result'] == "ok") {
                        alert(d['msg']);
                        location.reload();
                    } else {
                        alert(d['msg']);
                        location.reload();
                    }
                },
                cache: false
            });
        }
        function delete_mem(idx) {
            if(confirm("정말로 삭제하시겠습니까?")) {
                $.ajax({
                    type: 'post',
                    url: './member_update.php',
                    dataType: 'json',
                    data: {act: "delete", idx: idx},
                    success: function (d, s) {
                        if (d['result'] == "ok") {
                            alert(d['msg']);
                            location.replace("./member_retire_list.php");
                        } else {
                            alert(d['msg']);
                            location.reload();
                        }
                    },
                    cache: false
                });
            }
        }
    </script>
<?
include "./foot_inc.php";
?>