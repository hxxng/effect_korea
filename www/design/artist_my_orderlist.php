<?php
$title = "아티스트 구매내역";

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
                    <li><a href="artist_my_subscription.php">구독현황</a></li>
                    <li class="t_active"><a href="artist_my_orderlist.php">구매내역</a></li>
                    <li><a href="artist_my_like.php">즐겨찾기</a></li>
                </ul> 
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="member_caution">
                    <p class="caution fw_600"><img src="img/ic_caution.png" alt=""> 구매일자로부터 2주간 다운로드 가능합니다.</p>
                </div>
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
                        <span class="px-1 pt-n05 ">~</span>
                        <div class="form-group calendar">
                            <input type="text" class="form-control" id="datepicker2" placeholder="yyyy.mm.dd">
                            <i class="ic_calendar"><img src="img/ic_calendar.png" alt="캘린더"></i>
                        </div>
                    </section>
                </div>
                
                <div class="mp_order_chk d-flex justify-content-between align-items-center mb-5">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            <div class="chkbox">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            전체
                        </label>
                    </div>
                    <button type="button" class="cart_del"><img src="img/ic_del.png" alt="">선택 삭제</button>
                </div>
                <div class="mp_order">
                    <div class="order_hd mp_order_hd">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label mp_chk_label_wr" for="defaultCheck1">
                                <div class="chkbox">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="mp_chk_label">
                                    <span class="fw_500 order_hd_fs">2022.08.09</span><span class="order_hd_fs2">(주문번호: 123456789)</span>
                                </div>
                            </label>
                        </div>
                        <button type="button" class="mp_detail" onclick="location.href='artist_my_orderlist_detail.php';">상세보기<img src="img/arrow_right.png" alt=""></button>
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
                                <div class="order_cont mp_down_cont">
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
                                <div class="order_cont mp_down_cont">
                                    <button type="button" class="btn btn-outline-primary btn_download" onclick="location.href='#'">다운로드</button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="mp_order">
                    <div class="order_hd mp_order_hd">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label mp_chk_label_wr" for="defaultCheck1">
                                <div class="chkbox">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="mp_chk_label">
                                    <span class="fw_500 order_hd_fs">2022.07.10</span><span class="order_hd_fs2">(주문번호: 123456789)</span>
                                </div>
                            </label>
                        </div>
                        <button type="button" class="mp_detail" onclick="location.href='artist_my_orderlist_detail.php';">상세보기<img src="img/arrow_right.png" alt=""></button>
                    </div>
                    <ul class="order_list">
                        <li>
                            <div class="order_cont_box">
                                <div class="cart_thumbs video_list square rectangle">
                                    <img src="img/img_sample_13.jpg" alt="">
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
                                    2022.07.24</p>
                                </div>
                                <div class="order_cont mp_down_cont">
                                    <button type="button" class="btn btn-secondary btn_down_exp fc_dgray" onclick="location.href='#'">다운 가능 기간 만료</button>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="order_cont_box">
                                <div class="cart_thumbs video_list square rectangle">
                                    <img src="img/img_sample_14.jpg" alt="">
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
                                    2022.07.24</p>
                                </div>
                                <div class="order_cont mp_down_cont">
                                    <button type="button" class="btn btn-secondary btn_down_exp fc_dgray" onclick="location.href='#'">다운 가능 기간 만료</button>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="order_cont_box">
                                <div class="cart_thumbs video_list square rectangle">
                                    <img src="img/img_sample_15.jpg" alt="">
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
                                    2022.07.24</p>
                                </div>
                                <div class="order_cont mp_down_cont">
                                    <button type="button" class="btn btn-secondary btn_down_exp fc_dgray" onclick="location.href='#'">다운 가능 기간 만료</button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
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