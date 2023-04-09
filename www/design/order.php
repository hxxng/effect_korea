<?php
$title = "결제하기";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="wr_tit">
                    <h2 class="h2_tit">결제하기</h2>
                </div>
            </div>
            <div class="col-12 col-xl-8">
                <div class="order_hd d-flex justify-content-between align-items-center">
                    <p class="fw_500">콘텐츠 정보</p>
                    <button type="button" class="cart_del"><img src="img/ic_modify.png" alt="">장바구니 수정하기</button>
                </div>
                <ul class="cart_list">
                    <li>
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
                                <p class="cart_order">콘텐츠 주문번호 : 65843213854</p>
                            </a>
                        </div>
                    </li>
                    <li>
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
                                <p class="cart_order">콘텐츠 주문번호 : 65843213854</p>
                            </a>
                        </div>
                    </li>
                </ul>
                <div class="order_btm">
                    <div class="order_customer">
                        <div class="customer_tit fw_600">고객정보</div>
                        <div class="customer_radio">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    <div class="chkbox radio">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    내국인
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                <label class="form-check-label" for="exampleRadios2">
                                    <div class="chkbox radio">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    외국인
                                </label>
                            </div>
                        </div>
                        <div class="customer_info">
                            <div class="form-group form-group_1">
                                <label for="exampleFormControlSelect1" class="on">국적</label>
                                <select class="form-control" id="exampleFormControlSelect1" aria-placeholder="선택">
                                    <option value="" disabled selected>선택</option>
                                    <option>a</option>
                                    <option>b</option>
                                    <option>c</option>
                                    <option>d</option>
                                    <option>e</option>
                                </select>
                            </div> 
                            <div class="find_name d-flex justify-content-between">
                                <div class="form-group form-group_1 form_l">
                                    <label for="extInput">이름</label>
                                    <input type="text" class="form-control" id="textInput">
                                </div>
                                <div class="form-group form-group_1 form_r">
                                    <label for="extInput">성</label>
                                    <input type="text" class="form-control" id="textInput">
                                </div>
                            </div>
                            <div class="form_tel d-flex">
                                <div class="form-group form-group_1 form_l">
                                    <label for="exampleFormControlSelect1" class="on">국제번호</label>
                                    <select class="form-control" id="exampleFormControlSelect1" aria-placeholder="선택">
                                        <option value="" disabled selected>선택</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div> 
                                <div class="form-group form-group_1 form_r">
                                    <label for="extInput">연락처('-' 없이 숫자만 입력)</label>
                                    <input type="text" class="form-control" id="textInput">
                                </div>
                            </div>
                            <div class="form-group form-group_1">
                                <label for="extInput">이메일</label>
                                <input type="text" class="form-control" id="textInput">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <div class="cart_side sticky-top">
                    <div class="cart_side_box">
                        <ul class="cart_side_list">
                            <li>
                                <p class="cart_select">선택된 콘텐츠</p>
                                <p>2개</p>
                            </li>
                            <li>
                                <p class="cart_select">콘텐츠 총 금액</p>
                                <div class="cart_price"><span class="price ff_play">900,000</span>원</div>
                            </li>
                            <li>
                                <p class="cart_select">부가세</p>
                                <div class="cart_price"><span class="price ff_play">100,000</span>원</div>
                            </li>
                        </ul>
                        <hr class="hr2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="cart_sum fw_600">총 금액</div>
                            <div class="cart_price"><span class="price ff_play">500,000</span>원</div>
                        </div>
                        <hr class="hr2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label d-flex" for="defaultCheck1">
                                <div class="chkbox chkbox-md">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <p>회원가입을 통해 이용약관, 개인정보 방침, 라이선스 약관에 동의합니다.</p>
                            </label>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="location.href='order_success.php'">결제하기</button>
                    </div>
                    <p class="cart_txt">* 총 결제금액은 환율에 따라 변경될 수 있습니다.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>