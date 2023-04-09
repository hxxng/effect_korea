<?php
include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="container-fluid px-0">
        <div class="container-md px-0">
            <div class="my_page normal_member">
                <div class="user_info">
                    <div class="user_info_wrap">
                        <div class="profile mb-1">
                            <img src="./img/profile_none.png" alt="">
                            <div class="profile_step step_vvip"><i class="bi bi-stars"></i>VVIP</div>
                            <!--   
                            <div class="profile_step">SILVER</div>
                                <div class="profile_step step_gold">GOLD</div>
                                <div class="profile_step step_royal">ROYAL</div>
                                <div class="profile_step step_vip"><i class="bi bi-star-fill"></i> VIP</div>
                             -->
                        </div>
                        <strong class="fs_18">홍길동</strong>
                        <p class="fs_14 text-semidark mb-05">hong@gmail.com</p>
                        <a href="confirm_pw.php" class="fs_14 fw_500 link fc_purple">내 정보 수정</a>
                        <div class="benefits row">
                            <a href="./coupon_list.p hp" class="col-6">
                                <img src="./img/icon_coupon.png" alt="">
                                <p class="fs_14 fw_400">쿠폰</p>
                                <p clas="fs_20">1<span> 개</span></p>
                            </a>
                            <a href="./point_history.php" class="col-6">
                                <img src="./img/icon_point.png" alt="">
                                <p class="fs_14 fw_400">포인트</p>
                                <p clas="fs_20">5,000<span> P</span></p>
                            </a>
                        </div>
                        <button type="button" onclick="location.href='pr_request_list.php'" class="btn btn-outline-light btn-sm btn-block d-flex align-itmes-cneter justify-content-center">
                            <img src="./img/icon_transform.png" class="mr-05">
                            <p>홍보 회원으로 전환</p>
                        </button>
                    </div>
                </div>
                <div class="my_page_menu">
                    <ul class="menu_tit">
                        <li>
                            <img src="./img/my_menu01.png" alt="">
                            <div class="ml-1 w-100">
                                <strong>쇼핑활동</strong>
                                <ul class="menu_list row">
                                    <li class="col-6 col-md-12"><a href="./order_list.php">주문내역</a></li>
                                    <li class="col-6 col-md-12"><a href="./cancel_return_exchange_list.php">취소/교환/반품</a></li>
                                    <li class="col-6 col-md-12"><a href="./cart.php">장바구니</a></li>
                                    <li class="col-6 col-md-12"><a href="./wish_list.php">찜한 상품</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <img src="./img/my_menu02.png" alt="">
                            <div class="ml-1 w-100">
                                <strong>멤버십 활동</strong>
                                <ul class="menu_list row">
                                    <li class="col-6 col-md-12"><a href="membership_management.php">가입 멤버십 내역</a></li>
                                    <li class="col-6 col-md-12"><a href="following_influencer.php">팔로잉 인플루언서</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <img src="./img/my_menu03.png" alt="">
                            <div class="ml-1 w-100">
                                <strong>나의 정보</strong>
                                <ul class="menu_list row">
                                    <li class="col-6 col-md-12"><a href="addressbook.php">배송지 관리</a></li>
                                    <li class="col-6 col-md-12"><a href="point_history.php">포인트 내역</a></li>
                                    <li class="col-6 col-md-12"><a href="coupon_list.php">쿠폰 내역</a></li>
                                    <li class="col-6 col-md-12"><a href="review_list.php">상품 리뷰</a></li>
                                    <li class="col-6 col-md-12"><a href="inquiry_product_list.php">문의 내역</a></li>
                                    <li class="col-6 col-md-12"><a href="">로그아웃</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- 홍보회원 마이페이지 -->
            <div class="my_page pr_member">
                <div class="user_info">
                    <div class="user_info_wrap">
                        <div class="profile mb-1">
                            <img src="./img/infl_profile2.jpg" alt="">
                            <div class="profile_step bg_primary">인플루언서</div>
                        </div>
                        <strong class="fs_18">테런</strong>
                        <p class="fs_14 text-semidark mb-05">scarlett@gmail.com</p>
						
						<div class="d-flex">
	                        <a href="pr_profile.php" class="fs_14 fw_500 link text-secondary mr-1">프로필 보기</a>
	                        <a href="chatting.php" class="fs_14 fw_500 link text-darkgray">채팅보기</a>
						</div>

                        <div class="influencer_my_info row">
                            <div class="col-6">
                                <p class="fs_14 fw_400">팔로워</p>
                                <strong class="fs_20">51만</strong>
                            </div>
                            <div class="col-6">
                                <p class="fs_14">포인트</p>
                                <strong class="fs_20">71<span class="fs_14 fw_400"> %</span></strong>
                            </div>
                        </div>

                        <p class="fs_14 fw_400">포인트</p>
                        <strong class="fs_20 mb-2">41,380,000 <span class="fs_14">원</span></strong>

                        <button type="button" onclick="location.href='my_dashboard.php'" class="btn btn-outline-light btn-sm btn-block d-flex align-itmes-cneter justify-content-center">
                            <img src="./img/icon_transform.png" class="mr-05">
                            <p>일반 회원으로 전환</p>
                        </button>
                    </div>
                </div>
                <div class="my_page_menu">
                    <ul class="menu_tit">
                        <li>
                            <img src="./img/my_menu04.png" alt="">
                            <div class="ml-1">
                                <strong>판매관리</strong>
                                <ul class="menu_list row">
                                    <li class="col-6 col-md-12"><a href="./pr_request_list.php">판매자 상품 요청관리</a></li>
                                    <li class="col-6 col-md-12"><a href="./pr_item_list.php">판매 상품 목록</a></li>
                                    <li class="col-6 col-md-12"><a href="./pr_sell_history.php">판매 내역</a></li>
                                    <li class="col-6 col-md-12"><a href="./pr_collabo_history.php">협업 내역</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <img src="./img/my_menu05.png" alt="">
                            <div class="ml-1">
                                <strong>멤버십</strong>
                                <ul class="menu_list row">
                                    <li class="col-6 col-md-12"><a href="./pr_membership.php">멤버십 관리</a></li>
                                    <li class="col-6 col-md-12"><a href="./pr_member_list.php">멤버십 회원 내역</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <img src="./img/my_menu06.png" alt="">
                            <div class="ml-1">
                                <strong>정산</strong>
                                <ul class="menu_list row">
                                    <li class="col-6 col-md-12"><a href="./pr_calculate.php">정산 내역</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <img src="./img/my_menu07.png" alt="">
                            <div class="ml-1">
                                <strong>채팅</strong>
                                <ul class="menu_list row">
                                    <li class="col-6 col-md-12"><a href="./chatting.php">멤버십 채팅으로 가기</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>