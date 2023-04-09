<?php
$title = "장바구니";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="wr_tit">
                    <h2 class="h2_tit">장바구니</h2>
                </div>
            </div>
            <div class="col-12 col-xl-8">
                <div class="cart_hd d-flex justify-content-between align-items-center">
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
                <ul class="cart_list">
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                            <label class="form-check-label" for="defaultCheck2">
                                <div class="chkbox">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                            </label>
                        </div>
                        <div class="cart_cont_box">
                            <div class="cart_thumbs video_list square rectangle">
                                <img src="img/img_sample_1.jpg" alt="">
                                <video class="video_item" muted loop>
                                    <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                                </video>   
                            </div>
                            <a class="cart_cont" href="contents_list.php">
                                <div class="cart_cate">Nature</div>
                                <h4 class="cart_tit ff_play">The Ocean Club, A Four Seasons Resort Malibu</h4>
                                <div class="cart_artist">
                                    <div class="square"><img src="img/sample_img_7.png" alt=""></div>
                                    <span class="at_name">artist nikflims</span>
                                </div>
                                <div class="cart_de d-flex justify-content-between">
                                    <div class="cart_op"><span class="badge badge-secondary fw_600">4K</span><span class="c_reso">1920 x 1080</span></div>
                                    <div class="cart_price"><span class="price ff_play">500,000</span>원</div>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                            <label class="form-check-label" for="defaultCheck2">
                                <div class="chkbox">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                            </label>
                        </div>
                        <div class="cart_cont_box">
                            <div class="cart_thumbs video_list square rectangle">
                                <img src="img/img_sample_3.jpg" alt="">
                                <video class="video_item" muted loop>
                                    <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                                </video>   
                            </div>
                            <a class="cart_cont" href="contents_list.php">
                                <div class="cart_cate">Nature</div>
                                <h4 class="cart_tit ff_play">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h4>
                                <div class="cart_artist">
                                    <div class="square"><img src="img/sample_img_2.png" alt=""></div>
                                    <span class="at_name">artist nikflims</span>
                                </div>
                                <div class="cart_de d-flex justify-content-between">
                                    <div class="cart_op"><span class="badge badge-secondary fw_600">4K</span><span class="c_reso">1920 x 1080</span></div>
                                    <div class="cart_price"><span class="price ff_play">500,000</span>원</div>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                            <label class="form-check-label" for="defaultCheck2">
                                <div class="chkbox">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                            </label>
                        </div>
                        <div class="cart_cont_box">
                            <div class="cart_thumbs video_list square rectangle">
                                <img src="img/img_sample_11.jpg" alt="">
                                <video class="video_item" muted loop>
                                    <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                                </video>   
                            </div>
                            <a class="cart_cont" href="contents_list.php">
                                <div class="cart_cate">Nature</div>
                                <h4 class="cart_tit ff_play">The Ocean Club, A Four Seasons Resort Malibu</h4>
                                <div class="cart_artist">
                                    <div class="square"><img src="img/sample_img_3.png" alt=""></div>
                                    <span class="at_name">artist nikflims</span>
                                </div>
                                <div class="cart_de d-flex justify-content-between">
                                    <div class="cart_op"><span class="badge badge-secondary fw_600">4K</span><span class="c_reso">1920 x 1080</span></div>
                                    <div class="cart_price"><span class="price ff_play">500,000</span>원</div>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                            <label class="form-check-label" for="defaultCheck2">
                                <div class="chkbox">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                            </label>
                        </div>
                        <div class="cart_cont_box">
                            <div class="cart_thumbs video_list square rectangle">
                                <img src="img/img_sample_12.jpg" alt="">
                                <video class="video_item" muted loop>
                                    <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                                </video>   
                            </div>
                            <a class="cart_cont" href="contents_list.php">
                                <div class="cart_cate">Nature</div>
                                <h4 class="cart_tit ff_play">The Ocean Club, A Four Seasons Resort Malibu</h4>
                                <div class="cart_artist">
                                    <div class="square"><img src="img/sample_img_4.png" alt=""></div>
                                    <span class="at_name">artist nikflims</span>
                                </div>
                                <div class="cart_de d-flex justify-content-between">
                                    <div class="cart_op"><span class="badge badge-secondary fw_600">4K</span><span class="c_reso">1920 x 1080</span></div>
                                    <div class="cart_price"><span class="price ff_play">500,000</span>원</div>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                            <label class="form-check-label" for="defaultCheck2">
                                <div class="chkbox">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                            </label>
                        </div>
                        <div class="cart_cont_box">
                            <div class="cart_thumbs video_list square rectangle">
                                <img src="img/img_sample_13.jpg" alt="">
                                <video class="video_item" muted loop>
                                    <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                                </video>   
                            </div>
                            <a class="cart_cont" href="contents_list.php">
                                <div class="cart_cate">Nature</div>
                                <h4 class="cart_tit ff_play">The Ocean Club, A Four Seasons Resort Malibu</h4>
                                <div class="cart_artist">
                                    <div class="square"><img src="img/sample_img_5.png" alt=""></div>
                                    <span class="at_name">artist nikflims</span>
                                </div>
                                <div class="cart_de d-flex justify-content-between">
                                    <div class="cart_op"><span class="badge badge-secondary fw_600">4K</span><span class="c_reso">1920 x 1080</span></div>
                                    <div class="cart_price"><span class="price ff_play">500,000</span>원</div>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>
                <div class="cart_btm">
                    <button type="button" class="btn btn-outline-secondary tp_btn" onclick="location.href='index.php'">메인화면으로 가기</button>
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <div class="cart_side sticky-top">
                    <div class="cart_side_box">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="cart_select">선택된 콘텐츠</p>
                            <p>2개</p>
                        </div>
                        <hr class="hr2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="cart_sum fw_600">총 금액</div>
                            <div class="cart_price"><span class="price ff_play">500,000</span>원</div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="location.href='order.php'">구매하기</button>
                    </div>
                    <p class="cart_txt">* 총 결제금액은 환율에 따라 변경될 수 있습니다.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>