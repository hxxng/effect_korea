<?
include "./head_inc.php";
$chk_menu = "0";
$chk_sub_menu = '2';
include "./head_menu_inc.php";

$query = "select a1.*, a1.idx as mt_idx from member_t a1 where a1.idx = '".$_GET['mt_idx']."'";
$row = $DB->fetch_query($query);

$_act = $_GET['act'];
$list_url_t = "artist_approve_list.php";

$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&mt_approve=".$_GET['mt_approve']."&pg=".$_GET['pg'];
?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">아티스트 승인 상세</h4>
                        <div class="card-description float-right">
                            <button class="btn btn-danger" type="button" onclick="delete_approve('<?=$row['mt_idx']?>')">삭제</button>
                        </div>
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
                                                <label for="ct_title" class="col-sm-2 col-form-label">승인요청일</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <span><?=DateType($row['mt_adate'],4)?></span>
                                                    </div>
                                                </div>
                                                <label for="ct_title" class="col-sm-2 col-form-label">승인수정일</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <span><?=DateType($row['mt_audate'],4)?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label class="col-sm-2 col-form-label">승인상태</label>
                                                <div class="col-sm-6">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="approve1" name="mt_approve" value="1" class="custom-control-input">
                                                        <label class="custom-control-label" for="approve1">승인대기</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline mr-5 ml-5">
                                                        <input type="radio" id="approve2" name="mt_approve" value="2" class="custom-control-input">
                                                        <label class="custom-control-label" for="approve2">승인</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="approve3" name="mt_approve" value="3" class="custom-control-input">
                                                        <label class="custom-control-label" for="approve3">반려</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <script>
                                            $("input[name='mt_approve'][value='<?=$row['mt_approve']?>']").prop("checked", true);
                                        </script>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label class="col-sm-4 col-form-label"></label>
                                                <div class="col-sm-3">
                                                    <input type="text" id="mt_approve_memo" placeholder="승인 반려사유 입력" value="<?=$row['mt_approve_memo']?>" class="form-control"/>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button type="button" class="btn btn-primary" onclick="save_approve_memo('<?=$row['mt_idx']?>')">저장</button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">이름</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <span type="text"><?=$row['mt_firstname']." ".$row['mt_lastname']?></span>
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
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">휴대폰 번호</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <span type="text"><?=$row['mt_hp']?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
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
            $('#splinner_modal').modal('show');
        }
        function save_approve_memo(idx) {
            if($("#mt_approve_memo").val() == "") {
                alert("승인 반려사유를 입력해주세요.");
                $("#mt_approve_memo").focus();
                return false;
            }
            $.ajax({
                type: 'post',
                url: './member_update.php',
                dataType: 'json',
                data: {act: "save_approve_memo", idx: idx, mt_approve_memo: $("#mt_approve_memo").val()},
                success: function (d, s) {
                    alert(d['msg']);
                    location.reload();
                },
                cache: false
            });
        }
        function f_popup_image(idx) {
            $.post('./member_update.php', {act: 'popup_image', idx: idx}, function (data) {
                if(data) {
                    $('#modal-default-content').html(data);

                    $('#product-swiper').slick({
                        dots: true,
                        infinite: false,
                        speed: 300,
                        variableWidth: true,
                        slidesToShow: 1,
                    });

                    $('#modal-default').modal();
                }
            });

            return false;
        }
        function delete_approve(idx) {
            if(confirm("정말로 삭제하시겠습니까?\n삭제한 회원정보는 보이지 않습니다.")) {
                $.ajax({
                    type: 'post',
                    url: './member_update.php',
                    dataType: 'json',
                    data: {act: "delete_approve", idx: idx},
                    success: function (d, s) {
                        if(d['result'] == "ok") {
                            alert(d['msg']);
                            location.replace("./artist_approve_list.php");
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