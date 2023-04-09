<?
	if($_SESSION['_mt_level'] < 8 && $_SERVER['PHP_SELF'] != "./login.php") {
		alert("관리자만 접근할 수 있습니다.", "./login.php");
	}
?>

<? if($chk_ckeditor=="Y") { ?>
<!--<script src="//cdn.ckeditor.com/4.14.0/standard-all/ckeditor.js"></script>-->
<script src="../lib/ckeditor/ckeditor.js"></script>
<? } ?>

<div class="container-scroller">
	<!-- 상단바 시작 -->
	<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
		<div class="navbar-brand-wrapper d-flex justify-content-center">
			<div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
				<a class="navbar-brand brand-logo" href="./">
					<img src="<?=STATIC_HTTP?>/images/logo_dark.png" alt="logo" style="width:auto;height:30px;" />
				</a>
				<a class="navbar-brand brand-logo-mini" href="./">
					<img src="<?=CDN_HTTP?>/images/logo_dark.png" alt="logo" />
				</a>
				<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize"> <span class="mdi mdi-sort-variant"></span></button>
			</div>
		</div>
		<div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
			<ul class="navbar-nav navbar-nav-right">
				<li class="nav-item nav-profile dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown"><span class="nav-profile-name"><?=$_SESSION['_mt_name']?> 님 반갑습니다.</span></a>
					<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
						<a href="../" class="dropdown-item" target="_blank"> <i class="mdi mdi-home text-primary"></i> 홈페이지</a>
						<a href="./logout.php" class="dropdown-item"> <i class="mdi mdi-logout text-primary"></i> 로그아웃</a>
					</div>
				</li>
			</ul>
			<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas"> <span class="mdi mdi-menu"></span></button>
		</div>
	</nav>
	<!-- 상단바 끝 -->

	<div class="container-fluid page-body-wrapper">
		<!-- 왼쪽메뉴 시작 -->
		<nav class="sidebar sidebar-offcanvas" id="sidebar">
			<ul class="nav">
                <li class="nav-item<? if($chk_menu=='11') { ?> active<? } ?>">
                    <a class="nav-link" href="index.php">
                        <i class="mdi mdi-home-outline menu-icon"></i>
                        <span class="menu-title">홈</span>
                    </a>
                </li>
                <li class="nav-item<? if($chk_menu=='0') { ?> active<? } ?>">
                    <a class="nav-link" data-toggle="collapse" href="#member" aria-expanded="<? if($chk_menu=='0') { ?>true<? } else { ?>false<? } ?>" aria-controls="member">
                        <i class="mdi mdi-account-card-details-outline menu-icon"></i>
                        <span class="menu-title">회원관리</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse<? if($chk_menu=='0') { ?> show<? } ?>" id="member">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='0' && $chk_sub_menu=='1') { ?> active<? } ?>" href="./member_list.php">일반회원관리</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='0' && $chk_sub_menu=='2') { ?> active<? } ?>" href="./artist_approve_list.php">아티스트승인관리</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='0' && $chk_sub_menu=='3') { ?> active<? } ?>" href="./artist_list.php">아티스트회원관리</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='0' && $chk_sub_menu=='4') { ?> active<? } ?>" href="./member_retire_list.php">탈퇴회원관리</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item<? if($chk_menu=='1') { ?> active<? } ?>">
                    <a class="nav-link" data-toggle="collapse" href="#contents" aria-expanded="<? if($chk_menu=='1') { ?>true<? } else { ?>false<? } ?>" aria-controls="contents">
                        <i class="mdi mdi-account-card-details-outline menu-icon"></i>
                        <span class="menu-title">콘텐츠관리</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse<? if($chk_menu=='1') { ?> show<? } ?>" id="contents">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='1' && $chk_sub_menu=='1') { ?> active<? } ?>" href="./main_category_list.php">대표카테고리관리</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='1' && $chk_sub_menu=='2') { ?> active<? } ?>" href="./category_list.php">카테고리관리</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='1' && $chk_sub_menu=='3') { ?> active<? } ?>" href="./contents_approve_list.php">콘텐츠승인관리</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='1' && $chk_sub_menu=='4') { ?> active<? } ?>" href="./contents_video_list.php">영상콘텐츠</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='1' && $chk_sub_menu=='5') { ?> active<? } ?>" href="./contents_template_list.php">템플릿콘텐츠</a></li>
                        </ul>
                    </div>
                </li>
				<li class="nav-item<? if($chk_menu=='2') { ?> active<? } ?>">
					<a class="nav-link" data-toggle="collapse" href="#banner" aria-expanded="<? if($chk_menu=='2') { ?>true<? } else { ?>false<? } ?>" aria-controls="banner">
						<i class="mdi mdi-bullhorn-outline menu-icon"></i>
							<span class="menu-title">배너관리</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="collapse<? if($chk_menu=='2') { ?> show<? } ?>" id="banner">
						<ul class="nav flex-column sub-menu">
							<li class="nav-item"> <a class="nav-link<? if($chk_menu=='2' && $chk_sub_menu=='1') { ?> active<? } ?>" href="./banner_main_list.php">메인배너관리</a></li>
							<li class="nav-item"> <a class="nav-link<? if($chk_menu=='2' && $chk_sub_menu=='2') { ?> active<? } ?>" href="./banner_ads1_list.php">광고배너1관리</a></li>
							<li class="nav-item"> <a class="nav-link<? if($chk_menu=='2' && $chk_sub_menu=='3') { ?> active<? } ?>" href="./banner_ads2_list.php">광고배너2관리</a></li>
							<li class="nav-item"> <a class="nav-link<? if($chk_menu=='2' && $chk_sub_menu=='4') { ?> active<? } ?>" href="./logo_form.php">로고관리</a></li>
						</ul>
					</div>
				</li>
				<li class="nav-item<? if($chk_menu=='3') { ?> active<? } ?>">
					<a class="nav-link" data-toggle="collapse" href="#menu_order" aria-expanded="<? if($chk_menu=='3') { ?>true<? } else { ?>false<? } ?>" aria-controls="review">
						<i class="mdi mdi-account-edit-outline menu-icon"></i>
							<span class="menu-title">판매/매출현황</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="collapse<? if($chk_menu=='3') { ?> show<? } ?>" id="menu_order">
						<ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='3' && $chk_sub_menu=='1') { ?> active<? } ?>" href="./sales_membership_list.php">회원권</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='3' && $chk_sub_menu=='2') { ?> active<? } ?>" href="./sales_contents_list.php">콘텐츠</a></li>
						</ul>
					</div>
				</li>
                <li class="nav-item<? if($chk_menu=='4') { ?> active<? } ?>">
                    <a class="nav-link" href="./calculate_list.php">
                        <i class="mdi mdi-coin-outline menu-icon"></i>
                        <span class="menu-title">정산내역</span>
                    </a>
                </li>
                <li class="nav-item<? if($chk_menu=='5') { ?> active<? } ?>">
                    <a class="nav-link" data-toggle="collapse" href="#menu_event" aria-expanded="<? if($chk_menu=='6') { ?>true<? } else { ?>false<? } ?>" aria-controls="customer_service_center">
                        <i class="mdi mdi-phone-outline menu-icon"></i>
                        <span class="menu-title">고객센터</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse<? if($chk_menu=='5') { ?> show<? } ?>" id="menu_event">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='5' && $chk_sub_menu=='1') { ?> active<? } ?>" href="./notice_list.php">공지사항</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='5' && $chk_sub_menu=='2') { ?> active<? } ?>" href="./faq_list.php">자주묻는질문</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='5' && $chk_sub_menu=='3') { ?> active<? } ?>" href="./popup_list.php">팝업관리</a></li>
                        </ul>
                    </div>
                </li>
				<li class="nav-item<? if($chk_menu=='6') { ?> active<? } ?>">
					<a class="nav-link" data-toggle="collapse" href="#setting" aria-expanded="<? if($chk_menu=='6') { ?>true<? } else { ?>false<? } ?>" aria-controls="setting">
						<i class="mdi mdi-settings-outline menu-icon"></i>
							<span class="menu-title">설정</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="collapse<? if($chk_menu=='6') { ?> show<? } ?>" id="setting">
						<ul class="nav flex-column sub-menu">
							<li class="nav-item"> <a class="nav-link<? if($chk_menu=='6' && $chk_sub_menu=='1') { ?> active<? } ?>" href="./searchtxt_list.php">인기검색어설정</a></li>
							<li class="nav-item"> <a class="nav-link<? if($chk_menu=='6' && $chk_sub_menu=='2') { ?> active<? } ?>" href="./terms_form.php">약관관리</a></li>
							<li class="nav-item"> <a class="nav-link<? if($chk_menu=='6' && $chk_sub_menu=='3') { ?> active<? } ?>" href="./setting_form.php">설정</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</nav>
		<!-- 왼쪽메뉴 끝 -->

		<div class="main-panel">