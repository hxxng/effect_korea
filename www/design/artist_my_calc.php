<?php
$title = "정산내역";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="wr_tit2">
                    <h2>정산내역</h2>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="calc_box calc_box1 d-flex justify-content-between">
                    <div class="calc_content calc_content1">
                        <h4>정산예정금액</h4>
                        <div class="p_wr">
                            <p class="p1">* 50,000원 이상부터 정산 신청가능합니다.</p>
                            <p class="p1">* 송금 수수료 n% 제외 후 입금됩니다.</p>
                        </div>
                    </div>
                    <div class="calc_content calc_pr_cont">
                        <p class="calc_price fw_600">333,000원</p>
                        <button type="button" class="btn btn-sm btn-primary">정산신청</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="calc_box calc_box2 d-flex justify-content-between">
                    <div class="calc_content calc_content1">
                        <h4>정산계좌<div class="badge_ing">인증완료</div></h4>
                        <p class="bank">신한은행 110-123-45678 홍길동</p>
                    </div>
                    <div class="calc_content calc_content1 calc_btn_wr">
                        <button type="button" class="btn btn-sm btn-secondary"><img src="img/ic_modify.png" alt="" onclick="location.href='artist_my_account1.php'"> 정산계좌변경</button>
                        <button type="button" class="btn btn-sm btn-secondary mt-2"><img src="img/ic_del.png" alt=""> 정산계좌삭제</button>
                    </div>
                </div>
                <!-- 정산계좌 등록없음 -->
                <!-- <div class="calc_box calc_box2 d-flex align-items-center justify-content-between">
                    <div class="calc_content calc_content1">
                        <h4>정산계좌<div class="badge_ing">인증완료</div></h4>
                    </div>
                    <div class="calc_content calc_content1 calc_btn_wr">
                        <button type="button" class="btn btn-sm btn-secondary"><img src="img/ic_plus.png" alt="" onclick="location.href='artist_my_account1.php'"> 정산계좌등록</button>
                    </div>
                </div> -->
                <!-- 정산계좌 등록없음 끝 -->
            </div>
            <div class="col-12">
                <div class="calc_box calc_box_b">
                    <div class="d-md-flex align-items-end">
                        <div class="group_wr">
                            <label>정산상태</label>
                            <div class="btn-group btn-group-toggle btn_group_grid3 mr-5" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="options" id="option9" checked> 전체
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="options" id="option1"> 정산중
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="options" id="option2"> 정산신청
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="options" id="option3"> 정산완료
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="options" id="option3"> 취소
                                </label>
                            </div>  
                        </div>
                        <div class="form-group form-group_1 fg_1">
                            <label for="extInput" class="search_label_1">주문번호<span class="hide_text">로 검색</span></label>
                            <input type="text" class="form-control" id="textInput">
                            <button class="btn btn-link btn_sch btn_sch_1"><img src="img/ic_sub_search.png" alt="검색"> </button>
                        </div>
                    </div>
                    <div class="d-xl-flex align-items-end d-block date_wrap date_wrap2">
                        <div class="group_wr">
                            <label>조회기간</label>
                            <div class="btn-group btn-group-toggle mr-5 btn_group_grid2" data-toggle="buttons">
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
                        </div>        
                        <section class="calendar_wrap on">
                            <div class="form-group calendar">
                                <input type="text" class="form-control" id="datepicker" placeholder="yyyy.mm.dd">
                                <i class="ic_calendar"><img src="img/ic_calendar.png" alt="캘린더"></i>
                            </div>
                            <span class="px-1 pt-n05 ">~</span>
                            <div class="form-group calendar">
                                <input type="text" class="form-control" id="datepicker2" placeholder="yyyy.mm.dd">
                                <i class="ic_calendar"><img src="img/ic_calendar.png" alt="캘린더"></i>
                            </div>
                        </section>
                    </div>
                    <hr class="hr">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn_reset btn_reset1"><img src="img/ic_reset.png" alt=""> 초기화</button>
                        <button type="button" class="btn btn-primary btn_calc_sch">검색</button>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="table-responsive-xl">
                    <table class="table history_list my_contents_list my_contents_list1 text-center">
                        <thead>
                            <tr>
                            <th scope="col">번호</th>
                            <th scope="col" class="my_cont_num">콘텐츠 주문번호</th>
                            <th scope="col">결제일</th>
                            <th scope="col">결제구분</th>
                            <th scope="col" class="my_cont_cate">카테고리</th>
                            <th scope="col" class="my_cont_pr">결제금액(부가세포함)</th>
                            <th scope="col">수수료 합계</th>
                            <th scope="col">정산예정금액</th>
                            <th scope="col">정산완료일</th>
                            <th scope="col">정산상태</th>
                            <th scope="col">관리</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>10</td>
                            <td class="my_cont_num">123456789</td>
                            <td>2021.01.01</td>
                            <td>회원권</td>
                            <td class="my_cont_cate">영상 > 4K</td>
                            <td class="my_cont_pr">100,000원</td>
                            <td>10,000원</td>
                            <td>10,000원</td>
                            <td> </td>
                            <td>정산중</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" onclick="location.href='artist_my_calc_detail.php'">상세</button>
                            </td>
                            </tr>
                            <tr>
                            <td>9</td>
                            <td class="my_cont_num">123456789</td>
                            <td>2021.01.01</td>
                            <td>회원권</td>
                            <td class="my_cont_cate">영상 > FHD</td>
                            <td class="my_cont_pr">100,000원</td>
                            <td>10,000원</td>
                            <td>10,000원</td>
                            <td> </td>
                            <td>정산중</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" onclick="location.href='artist_my_calc_detail.php'">상세</button>
                            </td>
                            </tr>
                            <tr>
                            <td>8</td>
                            <td class="my_cont_num">123456789</td>
                            <td>2021.01.01</td>
                            <td>회원권</td>
                            <td class="my_cont_cate">영상 > DRONE</td>
                            <td class="my_cont_pr">100,000원</td>
                            <td>10,000원</td>
                            <td>10,000원</td>
                            <td> </td>
                            <td>정산신청</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" onclick="location.href='artist_my_calc_detail.php'">상세</button>
                            </td>
                            </tr>
                            <tr>
                            <td>7</td>
                            <td class="my_cont_num">123456789</td>
                            <td>2021.01.01</td>
                            <td>회원권</td>
                            <td class="my_cont_cate">영상 > Time lapse</td>
                            <td class="my_cont_pr">100,000원</td>
                            <td>10,000원</td>
                            <td>10,000원</td>
                            <td> </td>
                            <td>정산신청</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" onclick="location.href='artist_my_calc_detail.php'">상세</button>
                            </td>
                            </tr>
                            <tr>
                            <td>6</td>
                            <td class="my_cont_num">123456789</td>
                            <td>2021.01.01</td>
                            <td>회원권</td>
                            <td class="my_cont_cate">영상 > LUT</td>
                            <td class="my_cont_pr">100,000원</td>
                            <td>10,000원</td>
                            <td>10,000원</td>
                            <td> </td>
                            <td>정산신청</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" onclick="location.href='artist_my_calc_detail.php'">상세</button>
                            </td>
                            </tr>
                            <tr>
                            <td>5</td>
                            <td class="my_cont_num">123456789</td>
                            <td>2021.01.01</td>
                            <td>회원권</td>
                            <td class="my_cont_cate">영상 > Transition</td>
                            <td class="my_cont_pr">100,000원</td>
                            <td>10,000원</td>
                            <td>10,000원</td>
                            <td>2021.01.01</td>
                            <td>정산완료</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" onclick="location.href='artist_my_calc_detail.php'">상세</button>
                            </td>
                            </tr>
                            <tr>
                            <td>4</td>
                            <td class="my_cont_num">123456789</td>
                            <td>2021.01.01</td>
                            <td>회원권</td>
                            <td class="my_cont_cate">영상 > Motion</td>
                            <td class="my_cont_pr">100,000원</td>
                            <td>10,000원</td>
                            <td>10,000원</td>
                            <td>2021.01.01</td>
                            <td>정산완료</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" onclick="location.href='artist_my_calc_detail.php'">상세</button>
                            </td>
                            </tr>
                            <tr>
                            <td>3</td>
                            <td class="my_cont_num">123456789</td>
                            <td>2021.01.01</td>
                            <td>회원권</td>
                            <td class="my_cont_cate">영상 > Subtitle box</td>
                            <td class="my_cont_pr">100,000원</td>
                            <td>10,000원</td>
                            <td>10,000원</td>
                            <td>2021.01.01</td>
                            <td>정산완료</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" onclick="location.href='artist_my_calc_detail.php'">상세</button>
                            </td>
                            </tr>
                            <tr>
                            <td>2</td>
                            <td class="my_cont_num">123456789</td>
                            <td>2021.01.01</td>
                            <td>회원권</td>
                            <td class="my_cont_cate">영상 > Illustration</td>
                            <td class="my_cont_pr">100,000원</td>
                            <td>10,000원</td>
                            <td>10,000원</td>
                            <td>2021.01.01</td>
                            <td>정산완료</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" onclick="location.href='artist_my_calc_detail.php'">상세</button>
                            </td>
                            </tr>
                            <tr>
                            <td>1</td>
                            <td class="my_cont_num">123456789</td>
                            <td>2021.01.01</td>
                            <td>회원권</td>
                            <td class="my_cont_cate">영상 > Image</td>
                            <td class="my_cont_pr">100,000원</td>
                            <td>10,000원</td>
                            <td>10,000원</td>
                            <td>2021.01.01</td>
                            <td>정산완료</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" onclick="location.href='artist_my_calc_detail.php'">상세</button>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="col-12 my-5">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li>
                    </ul>
                </nav>             
            </div>
        </div>
    </div>
</div>

<script>
    $(".btn_group_grid2 .btn").on("click",function(){
        $(".date_wrap .calendar_wrap").removeClass("on");
    })
    $(".btn_self").on("click",function(){
        $(".date_wrap .calendar_wrap").addClass("on");
    })
</script>

<? include_once("./inc/tail.php"); ?>