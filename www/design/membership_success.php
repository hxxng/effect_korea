<?php
$title = "회원권 결제 완료";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="order_box order_box1">
                    <lottie-player src="img/lottie_success.json" class="lottie" background="transparent"  speed="1" autoplay loop></lottie-player>
                    <div class="order_success">
                        <div class="success_tit fw_600">
                            회원권 구매가 완료되었습니다.
                            <br>
                            결제한 회원권은 
                            <br class="mobile">
                            <span class="fc_blue1">[월간 베이직]</span> 입니다.
                        </div>
                        <p>유효기간은 2023.04.21까지 입니다.</p>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="location.href='index.php'">확인</button>
                </div>
                <div class="m_order_detail">
                    <div class="m_detail_box info_box">
                        <div class="membership_cont">
                            <p class="m_name fc_blue1 fw_600"><img src="img/ic_check.png" alt=""> 이용가능 콘텐츠</p>
                            <p class="m_sub">HD영상무제한, 모션, 트랜지션, LUT, 2D 일러스트</p>
                        </div>
                        <div class="membership_cont">
                            <p class="m_name fc_blue1 fw_600"><img src="img/ic_check.png" alt=""> 다운로드 한정</p>
                            <p class="m_sub">4K, 드론, 타임랩스, 3D 일러스트 제외 <strong>모든 콘텐츠 무제한</strong></p>
                        </div>
                        <div class="membership_cont">
                            <p class="m_name fc_blue1 fw_600"><img src="img/ic_check.png" alt=""> 이용가능 콘텐츠</p>
                            <p class="m_sub">무제한</p>
                        </div>
                    </div>
                    <div class="m_detail_box info_box">
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
                                <span>결제 금액</span>
                                <p>30,000원</p>
                            </li>
                            <li>
                                <span>결제수단</span>
                                <p>카드결제</p>
                            </li>
                        </ul>
                    </div>
                    <div class="member_caution">
                        <p class="caution fw_600"><img src="img/ic_caution.png" alt=""> 유의사항</p>
                        <p>1. 구매자의 실수, 변심 등에 대한 구독권 환불은 어렵습니다.</p>
                        <p>2. 구독권 구매 후 문제 발생시 고객센터로 문의 주시기 바랍니다.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<? include_once("./inc/tail.php"); ?>