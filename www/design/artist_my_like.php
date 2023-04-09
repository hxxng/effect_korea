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
                    <li><a href="artist_my_orderlist.php">구매내역</a></li>
                    <li class="t_active"><a href="artist_my_like.php">즐겨찾기</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="accordion" id="collapse_parent">
            <div class="ct_list row row-cols-2 row-cols-xl-5 row-cols-lg-4 row-cols-md-3">
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_1.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_20.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_11.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_12.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_13.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- 리스트 클릭시 -->
            <div class="row">
                <div class="col-12">
                    <div class="list_detail collapse" id="collapse" aria-labelledby="heading1" data-parent="#collapse_parent">
                        <button type="button" class="close btn_close" data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-controls="collapseExample">
                            <img src="img/ic_x.png" alt="닫기">
                        </button>
                        <div class="list_detail_wrap">
                            <div class="list_detail_video">
                                <div class="square">
                                    <video class="video_item" muted loop controls>
                                        <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                                    </video>                        
                                </div>  
                            </div>
                            <div class="detail_text cart_cont">
                                <div class="cart_cate d-flex align-items-center">
                                    <p>Nature</p>
                                    <div class="cart_icon_p"><img src="img/ic_photoshop.png" alt=""></div>
                                </div>
                                <h4 class="cart_tit ff_play">The Ocean Club, A Four Seasons Resort Malibu</h4>
                                <div class="cart_artist">
                                    <div class="square"><img src="img/sample_img_7.png" alt=""></div>
                                    <span class="at_name">artist nikflims</span>
                                </div>
                                <div class="cart_de">
                                    <div class="cart_op"><span class="badge badge-secondary fw_600">4K</span><span class="c_reso">1920 x 1080</span></div>
                                </div>
                                <hr class="hr2">
                                <ul class="detail_data">
                                    <li>
                                        <p class="f_name">Frame rate</p>
                                        <p class="f_sub">25.00</p>
                                    </li>
                                    <li>
                                        <p class="f_name">Length</p>
                                        <p class="f_sub">00:00:52</p>
                                    </li>
                                    <li>
                                        <p class="f_name">Format</p>
                                        <p class="f_sub">mp4</p>
                                    </li>
                                    <li>
                                        <p class="f_name">Size</p>
                                        <p class="f_sub">525MB</p>
                                    </li>
                                </ul>
                                <hr class="hr2">
                                <div class="d-flex justify-content-between align-items-end"> 
                                    <p class="price_name">PRICE</p>
                                    <div class="cart_price"><span class="price ff_play">500,000</span>원</div>
                                </div>
                                <div class="detail_btn d-flex">
                                    <button type="button" class="btn_cart btn_circle mr-4"><div class="ic_cart_lg"><img src="img/ic_cart.png" alt=""></div></button>
                                    <button type="button" class="btn_heart btn_circle mr-4"><div class="ic_heart_lg"><img class="off" src="img/ic_heart_lg.png" alt=""><img class="on" src="img/ic_heart_lg_b.png" alt=""></div></button>
                                    <button type="button" class="btn btn-primary">구매하기</button>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
            <!-- 리스트 클릭시 끝 -->

            <div class="ct_list row row-cols-2 row-cols-xl-5 row-cols-lg-4 row-cols-md-3">
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_14.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_15.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_16.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_17.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_18.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_19.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_20.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_1.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_11.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_12.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_13.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_14.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_15.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_16.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_17.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_18.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="ct_box" id="heading1">
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_19.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart" id="btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn on">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <p class="ct_txt">카테고리</p>
                                <p class="ct_tit fw_500">THE OCEAN CLUB, A FOUR SEASONS RESORT, MALIB…</p>
                            </div>
                        </div>
                    </div>
                </div>         
            </div>
        </div>
    </div>
</div>


<!-- 장바구니 알럿 토스트 -->
<div class="toast_cont position-fixed">
    <div class="toast toast_cart align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex align-items-center justify-content-between">
            <div class="toast_body">
                장바구니에 담겼습니다.
            </div>
            <a class="toast_for fc_blue1" href="cart.php">장바구니 가기</a>
        </div>
    </div>
</div>

<script>


    $(".side_filter li .side_filter_tit").on("click",function(){
        $(this).parents("li").toggleClass("on");
    })

    $(".m_over_btn").on("click",function(){
        $(this).toggleClass("on");
    })
    $(".btn_heart").on("click",function(){
        $(this).toggleClass("on");
    })

    $(".btn_cart").on("click",function(){

        $(".toast_cont").addClass("on");

        setTimeout(function(){
            $(".toast_cont").removeClass("on");
        },3000);

    })

</script>

<? include_once("./inc/tail.php"); ?>