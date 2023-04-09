<?php
$_lang = $_SESSION['_lang'];

$notice = lang("notice", $_lang, "tail");
$privacy = lang("privacy", $_lang, "tail");
$use_term = lang("use_term", $_lang, "tail");
$license = lang("license", $_lang, "tail");
$representative = lang("representative", $_lang, "tail");
$registration_num = lang("registration_num", $_lang, "tail");
$address = lang("address", $_lang, "tail");
$report_num = lang("report_num", $_lang, "tail");
$manager = lang("manager", $_lang, "tail");
$faq = lang("faq", $_lang, "tail");
$contact = lang("contact", $_lang, "tail");
$qna = lang("qna", $_lang, "tail");
$email = lang("email", $_lang, "tail");
$title = lang("title", $_lang, "tail");
$content = lang("content", $_lang, "tail");
$hp = lang("hp", $_lang, "tail");
$confirm = lang("confirm",$_lang, "order");
$inqury1 = lang("inqury1",$_lang, "modal");
$inqury2 = lang("inqury2",$_lang, "modal");
$pay_success = lang("pay_success",$_lang, "modal");
$close = lang("close",$_lang, "modal");
$pay_fail = lang("pay_fail",$_lang, "modal");
$pay_fail2 = lang("pay_fail2",$_lang, "modal");
$pay = lang("pay",$_lang, "modal");
?>
        <div class="container-fluid footer_wrap px-0">
            <footer id="footer">
                <div class="footer_header">
                    <ul class="footer_left">
                        <li><a href="/notice.php"><?=$notice?></a></li>
                        <li><a data-target="#private_terms" data-toggle="modal" style="cursor: pointer;"><?=$privacy?></a></li>
                        <li><a data-target="#use_terms" data-toggle="modal" style="cursor: pointer;"><?=$use_term?></a></li>
                        <li><a data-target="#license" data-toggle="modal" style="cursor: pointer;"><?=$license?></a></li>

                        <nav class="lang_select ff_play">
                            <a href="javascript:chg_language('kr')" class="<?php if($_lang == 'kr' || $_lang == '') echo 'on';?>">KOR</a>
                            <span>|</span>
                            <a href="javascript:chg_language('en')" class="<?php if($_lang == 'en') echo 'on';?>">ENG</a>
                        </nav>
                    </ul>
                </div>
                <div class="footer_body">
                    <div class="footer_left fs_15">
                        <p class="mb-2">
                            <?php if($_lang == 'kr' || $_lang == "") {
                                $st_language = 1;
                            } else {
                                $st_language = 2;
                            }
                            $query = "select * from setting_t where st_language = ".$st_language;
                            $setting = $DB->fetch_assoc($query);
                            ?>
                            <?=$setting['st_company_name']?><span class="mx-2">|</span><?=$representative?> : <?=$setting['st_ceo']?><span class="mx-2">|</span><?=$registration_num?> : <?=$setting['st_register_num']?><span class="mx-2">|</span><br class="br_hide_md">
                            <?=$address?> : <?=$setting['st_addr']?><span class="mx-2">|</span><br class="br_hide_md">
                            <?=$report_num?> : <?=$setting['st_report_num']?><span class="mx-2">|</span><?=$manager?> : <?=$setting['st_manager']?><br><br>
                            <span class="fw_200">COPYRIGHT(c) 2022 EFFECT KOREA ALL RIGHTS RESERVED.</span>
                        </p>
                    </div>
                    <div class="footer_right">
                        <a href="/faq.php"><button class="btn btn-secondary w-100 mb-4"><?=$faq?></button></a>
                        <button class="btn btn-secondary w-100" type="button" onclick="chk_login()"><?=$contact?></button>
                    </div>
                </div>                
            </footer>
        </div>
        <script>
            function chg_language(lang) {
                $.ajax({
                    type: 'post',
                    url: './models/ajax.session.php',
                    dataType: 'json',
                    data: {
                        type: "chg_language",
                        lang : lang,
                    },
                    success: function (r) {
                        location.reload();
                    }
                });
            }
            function chk_login() {
                if("<?=$_SESSION['_mt_idx']?>" == "") {
                    alert("로그인이 필요합니다.");
                    location.replace("/signin.php");
                } else {
                    $("#inquiry").modal("show");
                }
            }
        </script>

        <!-- Modal -->
        <div class="modal fade" id="private_terms" tabindex="-1" >
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?=$privacy?></h5>
                        <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
                            <img src="img/ic_x.png" alt="닫기">
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php if($_lang == 'kr' || $_lang == "") {
                            $query = "select tt_agree2 as private from terms_t ";
                        } else {
                            $query = "select tt_agree5 as private from terms_t ";
                        }
                        $private= $DB->fetch_assoc($query);
                        echo $private['private'];
                        ?>
                    </div>
                    <div class="modal-footer">                    
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><?=$confirm?></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="use_terms" tabindex="-1" >
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?=$use_term?></h5>
                        <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
                            <img src="img/ic_x.png" alt="닫기">
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php if($_lang == 'kr' || $_lang == "") {
                            $query = "select tt_agree1 as use_terms from terms_t ";
                        } else {
                            $query = "select tt_agree4 as use_terms from terms_t ";
                        }
                        $use= $DB->fetch_assoc($query);
                        echo $use['use_terms'];
                        ?>
                    </div>
                    <div class="modal-footer">                    
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><?=$confirm?></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="license" tabindex="-1" >
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?=$license?></h5>
                        <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
                            <img src="img/ic_x.png" alt="닫기">
                        </button>
                    </div>
                    <div class="modal-body">
                    <?php if($_lang == 'kr' || $_lang == "") {
                        $query = "select tt_agree3 as license from terms_t ";
                    } else {
                        $query = "select tt_agree6 as license from terms_t ";
                    }
                    $license= $DB->fetch_assoc($query);
                    echo $license['license'];
                    ?>
                    </div>
                    <div class="modal-footer">                    
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><?=$confirm?></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade modal_inquiry" id="inquiry" tabindex="-1" >
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">EFFECT KOREA <?=$qna?></h5>
                        <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
                            <img src="img/ic_x.png" alt="닫기">
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list_style_1">
                            <li>
                                <span><?=$email?></span>
                                <p><?=$_SESSION['_mt_id']?></p>
                            </li>
                        </ul>
                        <div class="form-group form-group_1">
                            <label for="title"><?=$title?></label>
                            <input type="text" class="form-control" id="title">
                        </div>
                        <div class="form-group form-group_1">
                            <label for="content"><?=$content?></label>
                            <textarea class="form-control" id="content"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">                    
                        <button type="button" class="btn btn-primary" onclick="inquiry()"><?=$contact?></button>
                        <div class="cs_center">
                            <ul class="list_style_1">
                                <li>
                                    <span><?=$hp?></span>
                                    <p><a href="tel:+041-427-0102"><img src="img/ic_cscenter.png"> 041-427-0102</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function inquiry(){
                if($("#title").val()=='') {
                    alert("제목을 입력해주세요.");
                    $("#title").focus();
                    return false;
                } else if($("#content").val()==''){
                    alert("내용을 입력해주세요.");
                    $("#content").focus();
                    return false;
                } else {
                    $.ajax({
                        type: 'post',
                        url: './models/inquiry_model.php',
                        dataType: 'json',
                        data: {type: "send_mail", mt_id: "<?=$_SESSION['_mt_id']?>", title: $("#title").val(), content: $("#content").val()},
                        success: function (r) {
                            $("#inquiry").modal("hide");
                            if(r['result'] == "ok") {
                                $("#confirm").modal("show");
                            } else {
                                $("#warning").modal("show");
                            }
                        },
                    });

                }
            }
        </script>

        <!-- Modal -->
        <div class="modal fade" id="confirm" tabindex="-1" >
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-sm">
                <div class="modal-content">
                    <div class="modal-header">                        
                        <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
                            <img src="img/ic_x.png" alt="닫기">
                        </button>
                    </div>
                    <div class="modal-body">
                        <lottie-player class="lottie lottie_success" src="img/lottie_success.json" loop autoplay style="width:156px; height:156px"></lottie-player>                        
                        <p class="fs_20"><?=$inqury1?></p>

                    </div>
                    <div class="modal-footer">                    
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><?=$confirm?></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="warning" tabindex="-1" >
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-sm">
                <div class="modal-content">
                    <div class="modal-header">                        
                        <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
                            <img src="img/ic_x.png" alt="닫기">
                        </button>
                    </div>
                    <div class="modal-body">
                        <lottie-player class="lottie lottie_warning" src="img/lottie_warning.json" loop autoplay style="width:100px; height:100px"></lottie-player>
                        <p class="fs_24"><?=$inqury2?></p>
                    </div>
                    <div class="modal-footer">                    
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><?=$confirm?></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 구매하기 클릭 팝업 모달 -->
        <div class="modal fade" id="modal_sm1" tabindex="-1" >
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-sm">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                        <p class="fs_18"><?=$pay_success?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal"><?=$close?></button>
                        <button type="button" class="btn btn-primary" onclick="javascript:location.replace('./my_orderlist.php');">구매내역 가기</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 회원권 허용범위 초과 팝업 모달 -->
        <div class="modal fade" id="modal_sm2" tabindex="-1" >
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-sm">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                        <p class="fs_18"><?=$pay_fail?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary mr-3" data-dismiss="modal"><?=$confirm?></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 회원권 허용범위 초과 및 일반결제 팝업 모달 -->
        <div class="modal fade" id="modal_sm3" tabindex="-1" >
            <input type="hidden" id="ct_idx" value="" />
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-sm">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                        <p class="fs_18"><?=$pay_fail2?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal"><?=$confirm?></button>
                        <button type="button" class="btn btn-primary mr-3" data-dismiss="modal" onclick="order_ing2()"><?=$pay?></button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function order_ing2() {
                $('#order_act').val('direct');
                const param = $("<input type='hidden' value=" + $("#ct_idx").val() + " name='ct_idx'>");
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
                        }
                    },
                    cache: false
                });
            }
        </script>

    </body>
</html>