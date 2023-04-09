	<!-- 헤더 시작 -->    
<body>    
    <div class="container-fluid header_wrap">
        <div class="row">
            <div class="col-12">
                <header id="header">
                    <div class="header_left">                        
                        <figure class="header_logo">
                            <a href="index.php"><img src="img/logo.png" alt="판로인로고"></a>
                        </figure>                        
                    </div>                    
                    <div class="header_right">
                        <ul class="lnb">
                            <li class="btn_submenu">
                                <a href="contents_list.php">영상<img src="img/arrow_down.png"></a>
                                <nav class="submenu_list">
                                    <ul>
                                        <li><a href="contents_list.php"><span>4K</span></a></li>
                                        <li><a href="contents_list.php"><span>FHD</span></a> </li>
                                        <li><a href="contents_list.php"><span>Drone</span></a> </li>
                                        <li><a href="contents_list.php"><span>Time lapse</span></a> </li>
                                    </ul>
                                </nav>
                            </li>
                            <li class="btn_submenu">
                                <a href="contents_list.php">템플릿<img src="img/arrow_down.png"></a>
                                <nav class="submenu_list">
                                    <ul>
                                        <li><a href="contents_list.php"><span>LUT</span></a></li>
                                        <li><a href="contents_list.php"><span>Transition</span></a> </li>
                                        <li><a href="contents_list.php"><span>Motion</span></a> </li>
                                        <li><a href="contents_list.php"><span>Subtitle template</span></a> </li>
                                        <li><a href="contents_list.php"><span>2D illustration</span></a> </li>
                                        <li><a href="contents_list.php"><span>3D illustration</span></a> </li>
                                        <li><a href="contents_list.php"><span>Image</span></a> </li>
                                    </ul>
                                </nav>
                            </li>
                            <li>
                                <a href="artists.php">아티스트</a>
                            </li>
                        </ul>
                        <span class="btns_wrap">
                            <div class="text-white btn_submenu">
                                <div class="btn_my"><img src="img/flag_kor.png" class="mr-2" alt="한국어"> 공드리<img src="img/arrow_down.png"></div>
                                <nav class="submenu_list">
                                    <ul>
                                        <li><a href="my_subscription.php"><span>마이페이지</span></a></li>
                                        <li><a href="my_orderlist.php"><span>구매내역</span></a> </li>                                        
                                        <li><a href="my_like.php"><span>즐겨찾기</span></a> </li>
                                        <li><a href="artist_my_calc.php"><span>정산신청</span></a> </li>
                                        <li><a href="#"><span>로그아웃</span></a> </li>
                                    </ul>
                                </nav>
                            </div>
                            <button class="btn btn-link btn_cart position-relative" type="button" onclick="location.href='cart.php'">
                                <span class="badge badge-primary cart_badge">99</span>
                                <img src="img/ic_cart.png" alt="장바구니">
                            </button>
                            <button class="btn btn-link btn_notice" type="button" data-toggle="modal" data-target="#notice">
                                <img src="img/ic_notice.png" alt="알림">
                            </button>
                            <button class="btn btn-link" type="button" data-toggle="modal" data-target="#sch_modal">
                                <img src="img/ic_search.png" alt="검색하기">
                            </button>
                            <!-- <button class="btn btn-link text-white" type="button">
                                로그인
                            </button> -->
                        </span>
                    </div>        
                </header>
            </div>
        </div>        
    </div>
        <!-- 모바일 헤더 (메인) -->
    <div class="container-fluid mobile_wrap mobile_mainheader_wrap">
        <div class="mobile_header_left">
            <a href="index.php" class="logo"><img src="img/logo.png" alt="홈으로가기"></a>
        </div>        
        <div class="mobile_header_right">
            <button class="btn btn-link" type="button" data-toggle="modal" data-target="#sch_modal">
                <img src="img/ic_sub_search.png" style="margin-bottom: -1px;" alt="검색하기">
            </button>
            <button class="btn btn-link btn_sideMenu" type="button">
                <img src="img/ic_sub_hamburger.png" alt="메뉴열기">
            </button>
        </div>
    </div>
        <!-- 모바일 헤더 (서브) -->
    <div class="container-fluid mobile_wrap mobile_subheader_wrap d-none">
        <div class="mobile_header_left">
            <button class="btn btn-link" type="button" data-toggle="modal" data-target="#sch_modal">
                <img src="img/ic_sub_back.png" style="margin-bottom: -1px;" alt="뒤로가기">
            </button>
            <button class="btn btn-link" type="button" onclick="location.href='index.php'">
                <img src="img/ic_sub_home.png" alt="홈으로 가기">
            </button>
        </div>
        
        <p class="fs_15"><?= $title ?></p>
        <div class="mobile_header_right">
            <button class="btn btn-link" type="button" data-toggle="modal" data-target="#sch_modal">
                <img src="img/ic_sub_search.png" style="margin-bottom: -1px;" alt="검색하기">
            </button>
            <button class="btn btn-link btn_sideMenu" type="button">
                <img src="img/ic_sub_hamburger.png" alt="메뉴열기">
            </button>
        </div>
    </div>
    <!-- 헤더 끝 -->

    <div class="modal fade sch_modal" id="sch_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">            
            <div class="modal-content mt-n55 bg-transparent">       
            <div class="btn_close" data-dismiss="modal"><img src="img/ic_x.png" alt="닫기"></div>         
                <div class="container row justify-content-center no-gutters">
                    <div class="col-lg-5 col-sm-7 col-12">                        
                        <form action="">
                            <div class="d-flex sch_input_wrap pb-sm-15 pb-05">                                
                                <input type="text" class=" sch_input oultline-0 w-100" placeholder="검색어 입력">                                
                                <ul class="sch_related_wrap">
                                    <li class="sch_related_li">
                                        <a href="#">고양이</a>
                                    </li>
                                    <li class="sch_related_li">
                                        <a href="#">고양이 뛰어노는</a>
                                    </li>
                                    <li class="sch_related_li">
                                        <a href="#">고양이 집</a>
                                    </li>
                                    <li class="sch_related_li">
                                        <a href="#">고양이 타워</a>
                                    </li>
                                    <li class="sch_related_li">
                                        <a href="#">고양이 동물</a>
                                    </li>
                                </ul>
                                <button class="btn btn-link btn_sch"><img src="img/ic_search_sm.png" alt="검색"> </button>
                            </div>
                            <ul class="popular_sch_word">
                                <li><a href="#" class="fw_700"><img src="img/ic_popular.png"> 인기검색어</a></li>
                                <li><a href="#">#고양이</a></li>
                                <li><a href="#">#강아지</a></li>
                                <li><a href="#">#햄스터</a></li>
                                <li><a href="#">#콜라</a></li>                               
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid sideMenu_wrap px-0 pt-lg-5">
        <div class="row no-gutters sideMenu">
            <div class="col-12">
                <div class="closed">
                    <img src="https://palroin.com//design/img/modal_close.png" alt="닫기">
                </div>
            </div>
            <div class="col-12">
                <nav class="shortcut">
                    <button class="btn btn-link btn_cart position-relative" type="button" onclick="location.href='cart.php'">
                        <span class="badge badge-primary cart_badge">99</span>
                        <img src="img/ic_cart.png" alt="장바구니">
                    </button>
                    <button class="btn btn-link btn_notice" type="button" data-toggle="modal" data-target="#notice">
                        <img src="img/ic_notice.png" alt="알림">
                    </button>
                </nav>
                <ul class="lnb">
                    <li class="lnb_item btn_submenu on">
                        <div class="lnb_link" href="contents_list.php">영상<img src="img/arrow_down.png"></div>
                        <nav class="submenu_list">
                            <ul>
                                <li class="on"><a href="contents_list.php"><span>4K</span></a></li>
                                <li><a href="contents_list.php"><span>FHD</span></a> </li>
                                <li><a href="contents_list.php"><span>Drone</span></a> </li>
                                <li><a href="contents_list.php"><span>Time lapse</span></a> </li>
                            </ul>
                        </nav>
                    </li>
                    <li class="lnb_item btn_submenu">
                        <div class="lnb_link" href="contents_list.php">템플릿<img src="img/arrow_down.png"></div>
                        <nav class="submenu_list">
                            <ul>
                                <li><a href="contents_list.php"><span>LUT</span></a></li>
                                <li><a href="contents_list.php"><span>Transition</span></a> </li>
                                <li><a href="contents_list.php"><span>Motion</span></a> </li>
                                <li><a href="contents_list.php"><span>Subtitle template</span></a> </li>
                                <li><a href="contents_list.php"><span>2D illustration</span></a> </li>
                                <li><a href="contents_list.php"><span>3D illustration</span></a> </li>
                                <li><a href="contents_list.php"><span>Image</span></a> </li>
                            </ul>
                        </nav>
                    </li>
                    <li class="lnb_item">
                        <a class="lnb_link" href="artists.php">아티스트</a>
                    </li>
                    <li class="lnb_item btn_submenu">
                        <div class="lnb_link" href="new.php">마이페이지<img src="img/arrow_down.png"></div>
                        <nav class="submenu_list">
                            <ul>
                                <li><a href="my_subscription.php"><span>마이페이지</span></a></li>
                                <li><a href="my_orderlist.php"><span>구매내역</span></a> </li>
                                <li><a href="my_like.php"><span>즐겨찾기</span></a> </li>
                                <li><a href="artist_my_calc.php"><span>정산신청</span></a> </li>
                                <li><a href="#"><span>로그아웃</span></a> </li>
                            </ul>
                        </nav>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row no-gutters dimmed">

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="notice" >
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-md">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">알림</h5>
                <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
                    <img src="img/ic_x.png" alt="닫기">
                </button>
            </div>
            <div class="modal-body">
                <ul class="notice_wrap">
                    <li class="notice_item not_reading">
                        <div class="notice_ic">
                            <i class="bi bi-upload"></i>
                        </div>
                        <div class="notice_text">
                            <h2 class="h2">‘판매자’님의 ‘콘텐츠’가 업로드 되었습니다. 관리자 승인까지 7일정도 소요됩니다.</h2>
                            <p class="date">2022/02/15 15:00</p>
                        </div>
                    </li>
                    <li class="notice_item">
                        <div class="notice_ic">
                            <i class="bi bi-download"></i>
                        </div>
                        <div class="notice_text">
                            <h2 class="h2">‘구독권종류’가 구매되었습니다.</h2>
                            <p class="date">2022/02/15 15:00</p>
                        </div>
                    </li>
                    <li class="notice_item">
                        <div class="notice_ic">
                            <i class="bi bi-exclamation-circle"></i>
                        </div>
                        <div class="notice_text">
                            <h2 class="h2">‘판매자’님의 ‘콘텐츠’가 ‘사유’로 거절되었습니다.</h2>
                            <p class="date">2022/02/15 15:00</p>
                        </div>
                    </li>
                    <li class="notice_item">
                        <div class="notice_ic">
                            <i class="bi bi-patch-check"></i>
                        </div>
                        <div class="notice_text">
                            <h2 class="h2">이펙트코리아 회원가입을 환영합니다!</h2>
                            <p class="date">2022/02/15 15:00</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-outline-secondary mr-3">모두읽음</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">확인</button>
            </div>
            </div>
        </div>
    </div>