<?php
$title = "정산내역 상세";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>


<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="wr_tit1">
                    <h2>정산내역 상세</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="mp_order_detail">
                    <div class="order_hd">
                        <span class="fw_500 order_hd_fs">2022.08.09</span><span class="order_hd_fs2">(주문번호: 123456789)</span>
                    </div>
                    <ul class="order_list">
                        <li>
                            <div class="order_cont_box">
                                <div class="cart_thumbs video_list square rectangle">
                                    <img src="img/img_sample_1.jpg" alt="">
                                    <video class="video_item" muted loop>
                                        <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                                    </video>   
                                </div>
                            </div>
                            <div class="cart_cont_box calc_detail_box">
                                <a class="cart_cont" href="contents_list.php">
                                    <div class="cart_cate">Nature</div>
                                    <h4 class="cart_tit ff_play">The Ocean Club, A Four Seasons Resort Malibu</h4>
                                    <div class="cart_artist">
                                        <div class="square"><img src="img/sample_img_7.png" alt=""></div>
                                        <span class="at_name">artist nikflims</span>
                                    </div>
                                    <div class="cart_op cart_de"><span class="badge badge-secondary fw_600">4K</span><span class="c_reso">1920 x 1080</span></div>
                                    <div class="cart_de d-flex align-items-center justify-content-between">
                                        <p class="cart_order">콘텐츠 주문번호 : 65843213854</p>
                                        <div class="cart_price"><span class="price ff_play">500,000</span>원</div>
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="info_box info_box2">
                    <div class="info_tit fw_600">정산정보</div>
                    <ul class="list_style_1">
                        <li>
                            <span>정산상태</span>
                            <p>정산완료</p>
                        </li>
                        <li>
                            <span>정산완료일</span>
                            <p>2021.01.01</p>
                        </li>
                        <li>
                            <span>정산예정금액</span>
                            <p>10,000원</p>
                        </li>
                        <li>
                            <span>수수료합계</span>
                            <p>30,000원</p>
                        </li>
                        <li>
                            <span>기본수수료</span>
                            <p>10,000원</p>
                        </li>
                        <li>
                            <span>결제수수료</span>
                            <p>10,000원</p>
                        </li>
                        <li>
                            <span>기타수수료</span>
                            <p>10,000원</p>
                        </li>
                        <li>
                            <span>결제일</span>
                            <p>10,000원</p>
                        </li>
                        <li>
                            <span>결제구분</span>
                            <p>10,000원</p>
                        </li>
                        <li>
                            <span>결제금액(부가세포함)</span>
                            <p>10,000원</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="info_box info_box2">
                    <div class="info_tit fw_600">주문정보</div>
                    <ul class="list_style_1">
                        <li>
                            <span>결제일시</span>
                            <p>2022.00.00 00:00:00</p>
                        </li>
                        <li>
                            <span>결제상태</span>
                            <p>결제완료</p>
                        </li>
                        <li>
                            <span>총 결제 금액</span>
                            <p>500,000원</p>
                        </li>
                        <li>
                            <span>부가세</span>
                            <p>50,000원</p>
                        </li>
                        <li>
                            <span>결제수단</span>
                            <p>카드결제</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div class="mp_detail_btm">
                    <button type="button" class="btn btn-primary mp_btn" onclick="location.href='artist_my_calc.php';">목록가기</button>
                </div>
            </div>
        </div>
    </div>
</div>



<? include_once("./inc/tail.php"); ?>