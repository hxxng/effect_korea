<?php
$title = "영상 콘텐츠리스트";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<style>
    .footer_wrap{
        margin-top: 0px;
    }
</style>

<div class="wrap wrap_flex">
    <div class="container_aside">
        <div class="mobile_filter">
            <button type="button" class="btn btn-secondary btn_filter"><img src="img/ic_filter.png" alt="">필터 열기</button>
        </div>    
        <div class="side_filter">
            <div class="filter_close"><img src="img/ic_x.png" alt="닫기"></div>
            <ul class="side_filter_list">
                <li>            
                    <div class="form-check side_filter_tit">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            <div class="chkbox chkbox-sm">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            에디토리얼
                        </label>
                    </div>
                </li>
                <li class="on">
                    <div class="side_filter_tit side_filter_tit1 d-flex justify-content-between align-items-center">
                        <p><img src="img/ic_resolution.png" alt=""> 해상도</p>
                        <div class="more">
                            <div class="more_p"><img src="img/ic_plus.png" alt=""></div>
                            <div class="more_m"><img src="img/ic_minus.png" alt=""></div>
                        </div>
                    </div>
                    <ul class="sub_filter">
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                <label class="form-check-label" for="defaultCheck2">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    6K +
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck3">
                                <label class="form-check-label" for="defaultCheck3">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    4K
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck4">
                                <label class="form-check-label" for="defaultCheck4">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    FHD(1920 x 1080)
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck5">
                                <label class="form-check-label" for="defaultCheck5">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    HD(1280 x 720)
                                </label>
                            </div>
                        </li>
                    </ul>
                </li>
                <li>
                    <div class="side_filter_tit side_filter_tit1 d-flex justify-content-between align-items-center">
                        <p><img src="img/ic_cate.png" alt=""> 카테고리</p>
                        <div class="more">
                            <div class="more_p"><img src="img/ic_plus.png" alt=""></div>
                            <div class="more_m"><img src="img/ic_minus.png" alt=""></div>
                        </div>
                    </div>
                    <ul class="sub_filter">
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck6">
                                <label class="form-check-label" for="defaultCheck6">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    6K +
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck7">
                                <label class="form-check-label" for="defaultCheck7">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    4K
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck8">
                                <label class="form-check-label" for="defaultCheck8">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    FHD(1920 x 1080)
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck9">
                                <label class="form-check-label" for="defaultCheck9">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    HD(1280 x 720)
                                </label>
                            </div>
                        </li>
                    </ul>
                </li>
                <li>
                    <div class="side_filter_tit side_filter_tit1 d-flex justify-content-between align-items-center">
                        <p><img src="img/ic_frame.png" alt=""> 프레임</p>
                        <div class="more">
                            <div class="more_p"><img src="img/ic_plus.png" alt=""></div>
                            <div class="more_m"><img src="img/ic_minus.png" alt=""></div>
                        </div>
                    </div>
                    <ul class="sub_filter">
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck10">
                                <label class="form-check-label" for="defaultCheck10">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    6K +
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck11">
                                <label class="form-check-label" for="defaultCheck11">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    4K
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck12">
                                <label class="form-check-label" for="defaultCheck12">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    FHD(1920 x 1080)
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck13">
                                <label class="form-check-label" for="defaultCheck13">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    HD(1280 x 720)
                                </label>
                            </div>
                        </li>
                    </ul>
                </li>
                <li>
                    <div class="side_filter_tit side_filter_tit1 d-flex justify-content-between align-items-center">
                        <p><img src="img/ic_playtime.png" alt=""> 재생시간</p>
                        <div class="more">
                            <div class="more_p"><img src="img/ic_plus.png" alt=""></div>
                            <div class="more_m"><img src="img/ic_minus.png" alt=""></div>
                        </div>
                    </div>
                    <ul class="sub_filter">
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck14">
                                <label class="form-check-label" for="defaultCheck14">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    6K +
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck15">
                                <label class="form-check-label" for="defaultCheck15">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    4K
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck16">
                                <label class="form-check-label" for="defaultCheck16">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    FHD(1920 x 1080)
                                </label>
                            </div>
                        </li>
                        <li>            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck17">
                                <label class="form-check-label" for="defaultCheck17">
                                    <div class="chkbox chkbox-sm">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    HD(1280 x 720)
                                </label>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="container container_content">
        <div class="row">
            <div class="col-12">
                <div class="content_pg_wr">
                    <h2 class="ff_play">4K</h2> 
                    <div class="wr_form d-flex">
                        <div class="wr_f_txt">전체 4</div>
                        <div class="form-group form-group_1 form_select form_l">
                            <select class="form-control" id="exampleFormControlSelect1" aria-placeholder="선택해주세요.">
                                <option>40개씩 보기</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>  
                        <div class="form-group form-group_1 form_r">
                            <label for="extInput" class="search_label_1">검색어 <span class="hide_text">입력</span></label>
                            <input type="text" class="form-control" id="textInput">
                            <button class="btn btn-link btn_sch btn_sch_1"><img src="img/ic_sub_search.png" alt="검색"> </button>
                        </div>
                    </div>         
                </div>
            </div>
        </div>
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                        <div class="video_list square rectangle" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse">
                            <img src="img/img_sample_20.jpg">
                            <video class="video_item" muted loop>
                                <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                            </video>                        
                        </div> 
                        <div class="m_over">
                            <div class="m_over_top d-flex align-items-center justify-content-between">
                                <p class="time">00:26</p>
                                <div class="icon">
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
                                        <div class="ic_heart"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="m_over_bottom" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn-primary btn_buy">구매하기</button>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="list_detail collapse" id="collapse2" aria-labelledby="heading1" data-parent="#collapse_parent">
                        <button type="button" class="close btn_close" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapseExample">
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
                                <h4 class="cart_tit ff_play">The Ocean Club, A Four Seasons Resort Malibu 222</h4>
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
                                    <button type="button" class="btn btn-primary btn_buy">구매하기</button>
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
                                    <button type="button" class="btn btn_cart">
                                        <div class="ic_cart"></div>
                                    </button>
                                    <button type="button" class="btn m_over_btn">
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
        <div class="row"></div>
            <div class="col-12 my-5">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li>
                    </ul>
                </nav>             
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



<!-- 구매하기 클릭 팝업 모달 -->
<!-- <div class="modal fade" id="modal_sm" tabindex="-1" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-sm">
        <div class="modal-content">
        <div class="modal-header">
        </div>
        <div class="modal-body">
            <p class="fs_18">결제 완료되었습니다.<br>다운로드를 시작합니다.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">닫기</button>
            <button type="button" class="btn btn-primary">구매내역 가기</button>
        </div>
        </div>
    </div>
</div> -->

<!-- 회원권 허용범위 초과 팝업 모달 -->
<!-- <div class="modal fade" id="modal_sm" tabindex="-1" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-sm">
        <div class="modal-content">
        <div class="modal-header">
        </div>
        <div class="modal-body">
            <p class="fs_18">회원권으로 다운로드 불가한 콘텐츠가 <br class="web">포함되어 있습니다.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary mr-3" data-dismiss="modal">확인</button>
        </div>
        </div>
    </div>
</div> -->

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


    $(".btn_filter").on("click",function(){

        $(".side_filter").toggleClass("on");

    })
    $(".filter_close").on("click",function(){
        
        $(".side_filter").removeClass("on");
    })
    
    $(".btn_cart").on("click",function(){

        $(".toast_cont").addClass("on");

        setTimeout(function(){
            $(".toast_cont").removeClass("on");
        },3000);

    })

</script>

<? include_once("./inc/tail.php"); ?>