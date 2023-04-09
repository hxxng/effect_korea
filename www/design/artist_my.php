<?php
$title = "아티스트 마이페이지";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-12 my-5">
                <div class="wr_tit1">
                    <h2>마이페이지</h2>
                </div>
                <div class="order_hd mp_hd d-flex justify-content-between align-items-center">
                    <h3 class="fw_600">공드리님 반가워요!</h3>
                    <button type="button" class="cart_del" onclick="location.href='my_info.php';"><img src="img/ic_modify.png" alt="">내 정보 수정</button>
                </div>
                <ul class="t_menu">
                    <li class="t_active"><a href="artist_my.php">홈</a></li>
                    <li><a href="artist_my_subscription.php">구독현황</a></li>
                    <li><a href="artist_my_orderlist.php">구매내역</a></li>
                    <li><a href="artist_my_like.php">즐겨찾기</a></li>
                </ul> 
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-12">
                <div class="artist_profile d-md-flex align-items-center justify-content-between">
                    <div class="artist_pf_wrap d-flex align-items-center justify-content-between">
                        <div class="artist_pf_img square"><img src="img/sample_img_1.png" alt=""></div>
                        <div class="artist_pf_txt">
                            <h4 class="fw_700 ff_play">Alisabeith Hanna</h4>
                            <p class="text_hidden2">굳세게 생생하며, 반짝이는 있는 인생의 착목한는 철환하였는가? 석가는 들어 싸인 어디 뜨거운지라, 놀이 우리의 군영과 두손을아… 름다우냐? 되려니와, 이상은 따뜻한 품었기 않는 청춘의 그들의 끓는다.</p>
                        </div>
                    </div>
                    <div class="artist_pf_btn"><button type="button" class="btn btn-secondary btn-sm btn_pf" onclick="location.href='artist_my_info.php'"><img src="img/ic_modify.png" alt="">프로필 수정</button></div>
                </div>
                <div class="artist_pf_grid">
                    <a href="artist_my_upload.php">
                        <div class="artist_pf_box text-center">
                            <img src="img/ic_upload.png" alt="">
                            <p>콘텐츠업로드</p>
                        </div>
                    </a>
                    <a href="artist_my_contents.php">
                        <div class="artist_pf_box text-center">
                            <img src="img/ic_contents.png" alt="">
                            <p>콘텐츠관리</p>
                        </div>
                    </a>
                    <a href="artist_my_calc.php">
                        <div class="artist_pf_box text-center">
                            <img src="img/ic_sell.png" alt="">
                            <p>판매내역</p>
                        </div>
                    </a>
                    <a href="artist_my_account1.php">
                        <div class="artist_pf_box text-center">
                            <img src="img/ic_calc.png" alt="">
                            <p>정산계좌</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-6 col-12">
                <div class="artist_my_contents_grid">
                    <div class="artist_my_contents">
                        <p>콘텐츠 등록건수</p>
                        <p class="fw_600 text-right artist_my_sub">10,000건</p>
                    </div>
                    <div class="artist_my_contents">
                        <p>콘텐츠 즐겨찾기수</p>
                        <p class="fw_600 text-right artist_my_sub">8,443건</p>
                    </div>
                    <div class="artist_my_contents">
                        <p>판매건수</p>
                        <p class="fw_600 text-right artist_my_sub">123건</p>
                    </div>
                    <div class="artist_my_contents">
                        <p>판매금액</p>
                        <p class="fw_600 text-right artist_my_sub">1,843,000원</p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="btm_ad text-center">최고관리자에서 등록한 광고배너가 들어옵니다.</div>
            </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>