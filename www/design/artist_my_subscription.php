<?php
$title = "아티스트 구독현황";

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
                    <li><a href="artist_my.php">홈</a></li>
                    <li class="t_active"><a href="artist_my_subscription.php">구독현황</a></li>
                    <li><a href="artist_my_orderlist.php">구매내역</a></li>
                    <li><a href="artist_my_like.php">즐겨찾기</a></li>
                </ul> 
            </div>
        </div>
    </div>
    <div class="container">
        <!-- 회원권 구독후 -->
        <div class="row">
            <div class="col-12">
                <div class="subsc_grid">
                    <div class="subsc_box position-relative d-flex justify-content-between align-items-center">
                        <div class="subsc_text">
                            <div class="subsc_tit1 fw_600"><span>월간 베이직</span><div class="badge_ing">이용중</div></div>
                            <p class="subsc_sub1">유효기간 : 2023.04.24</p>
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_md">회원권 상세</button>
                    </div>
                    <div class="subsc_box position-relative d-flex justify-content-between align-items-center">
                        <div class="subsc_text">
                            <p class="subsc_sub2">이용가능 콘텐츠</p>
                            <p class="subsc_tit2 fw_600">전체</p>
                        </div>
                        <div class="mp_img"><img src="img/mp_img02.png" alt=""></div>
                    </div>
                    <div class="subsc_box position-relative d-flex justify-content-between align-items-center">
                        <div class="subsc_text">
                            <p class="subsc_sub2">다운로드 한정</p>
                            <p class="subsc_tit2 fw_600">무제한</p>
                        </div>
                        <div class="mp_img"><img src="img/mp_img03.png" alt=""></div>
                        <div class="position-absolute m_tooltip sub_tt">4K, 드론, 타임랩스, 3D 일러스트 제외</div>
                    </div>
                    <div class="subsc_box position-relative d-flex justify-content-between align-items-center">
                        <div class="subsc_text">
                            <p class="subsc_sub2">사용가능 범위</p>
                            <p class="subsc_tit2 fw_600">제한 없음</p>
                        </div>
                        <div class="mp_img"><img src="img/mp_img04.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 회원권 구독후 끝 -->
        
        <!-- 회원권 구독전 -->
        <!-- <div class="row">
            <div class="col-12">
                <div class="mp_none fc_gray">
                    <img src="img/img_attention.png" alt="">
                    <p class="fs_18">이용중인 회원권이 없습니다.</p>
                    <button type="button" class="btn btn-outline-primary" onclick="location.href='membership.php';">회원권 구독하기</button>
                </div>
            </div>
        </div>  -->
        <!-- 회원권 구독전 끝 -->
           
        <div class="row">
            <div class="col-12">
                <div class="subsc_history">
                    <div class="sub_tit fw_600">회원권 결제내역</div>
                    <hr class="hr">

                    <!-- 회원권 결제내역 -->
                    <div class="d-xl-flex d-block date_wrap">
                        <div class="btn-group btn-group-toggle mr-5 btn_group_grid" data-toggle="buttons">
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="options" id="option1"> 3일
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="options" id="option2"> 5일
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="options" id="option3"> 7일
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="options" id="option4"> 15일
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="options" id="option5"> 30일
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="options" id="option6"> 60일
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="options" id="option7"> 90일
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="options" id="option8"> 120일
                            </label>
                            <label class="btn btn-outline-primary active btn_self">
                                <input type="radio" name="options" id="option9" checked> 직접입력
                            </label>
                        </div>            
                        <section class="calendar_wrap on">
                            <div class="form-group calendar">
                                <input type="text" class="form-control" id="datepicker" placeholder="yyyy.mm.dd">
                                <i class="ic_calendar"><img src="img/ic_calendar.png" alt="캘린더"></i>
                            </div>
                            <span class="px-1 pt-n05">~</span>
                            <div class="form-group calendar">
                                <input type="text" class="form-control" id="datepicker2" placeholder="yyyy.mm.dd">
                                <i class="ic_calendar"><img src="img/ic_calendar.png" alt="캘린더"></i>
                            </div>
                        </section>
                    </div>
                    <div class="table-responsive-lg">
                        <table class="table history_list text-center">
                            <thead>
                                <tr>
                                <th scope="col">구매일자</th>
                                <th scope="col">회원권유형</th>
                                <th scope="col">결제방법</th>
                                <th scope="col">결제금액</th>
                                <th scope="col">결제상태</th>
                                <th scope="col">다운로드잔여횟수</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>2021.01.01<br>(~21.02.01까지)</td>
                                <td>월간 베이직</td>
                                <td>카드결제</td>
                                <td>1,000,000원</td>
                                <td>결제완료</td>
                                <td>무제한</td>
                                </tr>
                                <tr>
                                <td>2020.12.30</td>
                                <td>연간 베이직</td>
                                <td>카드결제</td>
                                <td>1,000,000원</td>
                                <td>결제완료</td>
                                <td>무제한</td>
                                </tr>
                                <tr>
                                <td>2020.12.30</td>
                                <td>연간 프리미엄</td>
                                <td>카드결제</td>
                                <td>1,000,000원</td>
                                <td>결제완료</td>
                                <td>무제한</td>
                                </tr>
                                <tr>
                                <td>2020.12.30</td>
                                <td>월간 베이직</td>
                                <td>카드결제</td>
                                <td>1,000,000원</td>
                                <td>결제완료</td>
                                <td>무제한</td>
                                </tr>
                                <tr>
                                <td>2020.12.30</td>
                                <td>월간 베이직</td>
                                <td>카드결제</td>
                                <td>1,000,000원</td>
                                <td>결제완료</td>
                                <td>무제한</td>
                                </tr>
                                <tr>
                                <td>2020.12.30</td>
                                <td>월간 베이직</td>
                                <td>카드결제</td>
                                <td>1,000,000원</td>
                                <td>결제완료</td>
                                <td>무제한</td>
                                </tr>
                                <tr>
                                <td>2020.12.30</td>
                                <td>월간 베이직</td>
                                <td>카드결제</td>
                                <td>1,000,000원</td>
                                <td>결제완료</td>
                                <td>무제한</td>
                                </tr>
                                <tr>
                                <td>2020.12.30</td>
                                <td>월간 베이직</td>
                                <td>카드결제</td>
                                <td>1,000,000원</td>
                                <td>결제완료</td>
                                <td>무제한</td>
                                </tr>
                                <tr>
                                <td>2020.12.30</td>
                                <td>월간 베이직</td>
                                <td>카드결제</td>
                                <td>1,000,000원</td>
                                <td>결제완료</td>
                                <td>무제한</td>
                                </tr>
                                <tr>
                                <td>2020.12.30</td>
                                <td>월간 베이직</td>
                                <td>카드결제</td>
                                <td>1,000,000원</td>
                                <td>결제완료</td>
                                <td>무제한</td>
                                </tr>
                                <tr>
                                <td>2020.12.30</td>
                                <td>월간 베이직</td>
                                <td>카드결제</td>
                                <td>1,000,000원</td>
                                <td>결제완료</td>
                                <td>무제한</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- 회원권 결제내역 끝 -->

                    <!-- 회원권 결제내역 없음 -->
                    <!-- <div class="mp_none fc_gray">
                        <img src="img/img_attention.png" alt="">
                        <p class="fs_18 mb-0">결제 내역이 없습니다.</p>
                    </div> -->
                    <!-- 결제내역 없음 끝 -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 회원권 상세 모달 -->
<div class="modal fade" id="modal_md" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-md">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">회원권 상세</h5>
            <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
                <img src="img/ic_x.png" alt="닫기">
            </button>
        </div>
        <div class="modal-body">
            <ul class="list_style_1 member_detail">
                <li>
                    <span>주문번호</span>
                    <p>123456</p>
                </li>
                <li>
                    <span>구매일자</span>
                    <p>2021.01.01 (~21.02.01까지)</p>
                </li>
                <li>
                    <span>회원권</span>
                    <p>월간 베이직</p>
                </li>
                <li>
                    <span>이용가능 콘텐츠</span>
                    <p>HD영상무제한, 모션, 트랜지션, LUT, 2D 일러스트</p>
                </li>
                <li>
                    <span>다운로드 한정</span>
                    <p>4K, 드론, 타임랩스, 3D 일러스트 제외 모든 콘텐츠 무제한</p>
                </li>
                <li>
                    <span>사용가능범위</span>
                    <p>무제한</p>
                </li>
                <li>
                    <span>결제방법</span>
                    <p>카드결제</p>
                </li>
                <li>
                    <span>결제금액</span>
                    <p>1,000,000원</p>
                </li>
                <li>
                    <span>결제상태</span>
                    <p>결제완료</p>
                </li>
            </ul>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary mr-3" onclick="location.href='membership.php';">회원권 변경</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">확인</button>
        </div>
        </div>
    </div>
</div>

<script>
    $(".btn_group_grid .btn").on("click",function(){
        $(".date_wrap .calendar_wrap").removeClass("on");
    })
    $(".btn_self").on("click",function(){
        $(".date_wrap .calendar_wrap").addClass("on");
    })
</script>


<? include_once("./inc/tail.php"); ?>