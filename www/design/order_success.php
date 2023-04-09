<?php
$title = "결제완료";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="order_box">
                    <lottie-player src="img/lottie_success.json" class="lottie" background="transparent"  speed="1" autoplay loop></lottie-player>
                    <div class="order_success">
                        <div class="success_tit fw_600">결제 완료되었습니다.</div>
                        <p>구매하신 콘텐츠는 구매일자로부터 2주간 다운로드가 가능합니다.</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-primary form_l" onclick="location.href='index.php'">확인</button>
                        <button type="button" class="btn btn-primary form_r" onclick="location.href='my_orderlist.php'">구매내역 가기</button>
                    </div>
                </div>
            </div>
            <div class="col-12">
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
                        <div class="order_cont_box1">
                            <a class="cart_cont" href="contents_list.php">
                                <div class="cart_cate">Nature</div>
                                <h4 class="cart_tit ff_play">The Ocean Club, A Four Seasons Resort Malibu</h4>
                                <div class="cart_artist">
                                    <div class="square"><img src="img/sample_img_7.png" alt=""></div>
                                    <span class="at_name">artist nikflims</span>
                                </div>
                                <div class="cart_op cart_de"><span class="badge badge-secondary fw_600">4K</span><span class="c_reso">1920 x 1080</span></div>
                                <p class="cart_order">콘텐츠 주문번호 : 65843213854</p>
                            </a>
                            <div class="order_cont cart_price">
                                <span class="price ff_play">500,000</span>원
                            </div>
                            <div class="order_cont">
                                <p>다운로드 기간 :
                                2022.09.20</p>
                            </div>
                            <div class="order_cont">
                                <button type="button" class="btn btn-outline-primary btn_download" onclick="location.href='#'">다운로드</button>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="order_cont_box">
                            <div class="cart_thumbs video_list square rectangle">
                                <img src="img/img_sample_3.jpg" alt="">
                                <video class="video_item" muted loop>
                                    <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                                </video>   
                            </div>
                        </div>
                        <div class="order_cont_box1">
                            <a class="cart_cont" href="contents_list.php">
                                <div class="cart_cate">Nature</div>
                                <h4 class="cart_tit ff_play">The Ocean Club, A Four Seasons Resort Malibu</h4>
                                <div class="cart_artist">
                                    <div class="square"><img src="img/sample_img_2.png" alt=""></div>
                                    <span class="at_name">artist nikflims</span>
                                </div>
                                <div class="cart_op cart_de"><span class="badge badge-secondary fw_600">4K</span><span class="c_reso">1920 x 1080</span></div>
                                <p class="cart_order">콘텐츠 주문번호 : 65843213854</p>
                            </a>
                            <div class="order_cont cart_price">
                                <span class="price ff_play">500,000</span>원
                            </div>
                            <div class="order_cont">
                                <p>다운로드 기간 :
                                2022.09.20</p>
                            </div>
                            <div class="order_cont">
                                <button type="button" class="btn btn-outline-primary btn_download" onclick="location.href='#'">다운로드</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-lg-6">
                <div class="info_box">
                    <div class="info_tit fw_600">결제정보</div>
                    <ul class="list_style_1">
                        <li>
                            <span>결제일시</span>
                            <p>2022.08.05 14:21:44</p>
                        </li>
                        <li>
                            <span>결제상태</span>
                            <p>결제완료 or 결제취소</p>
                        </li>
                        <li>
                            <span>구매내역</span>
                            <p>2개</p>
                        </li>
                        <li>
                            <span>콘텐츠 총 금액</span>
                            <p>450,000원</p>
                        </li>
                        <li>
                            <span>부가세</span>
                            <p>45,000원</p>
                        </li>
                        <li>
                            <span>총 결제 금액</span>
                            <p>495,000원</p>
                        </li>
                        <li>
                            <span>결제수단</span>
                            <p>카드결제</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="info_box">
                    <div class="info_tit fw_600">고객정보</div>
                    <ul class="list_style_1">
                        <li>
                            <span>내국인 or 외국인</span>
                            <p>내국인</p>
                        </li>
                        <li>
                            <span>국적</span>
                            <p>대한민국</p>
                        </li>
                        <li>
                            <span>이름</span>
                            <p>홍길동</p>
                        </li>
                        <li>
                            <span>연락처</span>
                            <p>010-1234-5678</p>
                        </li>
                        <li>
                            <span>이메일</span>
                            <p>email@email.com</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>