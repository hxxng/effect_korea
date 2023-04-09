<?php
$title = "공지사항";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="con_wrap">
        <h2 class="h2_tit">공지사항</h2>

        <ul class="list-unstyled bo_list mt-3    pb-2">
            <li class="media bo_list_hd text-center   fs_17 ">
                <div class="w-100 media-body row mx-0 justify-content-between align-items-center flex-nowrap">
                    <div class=" post_info col-lg-1 col-auto d-none d-sm-block">번호</div>
                    <div class="col-lg-9 col-auto     flex-fill  fw_400 text-left">제목</div>
                    <div class="bo_date fw_400 text-center">작성일</div>
                </div>
            </li>
            <li class="media text-center border-bottom">
                <a href="./notice_detail.php" class="w-100 media-body row mx-0 justify-content-between align-items-center flex-nowrap">
                    <div class="post_info col-lg-1 col-auto d-none d-sm-block">155</div>
                    <div class="col-lg-9 col-auto text_hidden  text-left flex-fill "><span class="line_text">공지사항 게시판을 알려드립니다. 공지사항 게시판을 알려드립니다. 공지사항 게시판을 알려드립니다 공지사항 게시판을 알려드립니다. 공지사항 게시판을 알려드립니다. 공지사항 게시판을 알려드립니다.</span></div>
                    <div class=" bo_date col-auto">2022.06.25</div>
                </a>
            </li>
            <li class="media text-center border-bottom">
                <a href="./notice_detail.php" class="w-100 media-body row mx-0 justify-content-between align-items-center flex-nowrap">
                    <div class="post_info col-lg-1 col-auto d-none d-sm-block">155</div>
                    <div class="col-lg-9 col-auto text_hidden   flex-fill text-left"><span class="line_text ">공지사항 게시판을 알려드립니다. 공지사항 게시판을 알려드립니다. 공지사항 게시판을 알려드립니다 공지사항 게시판을 알려드립니다. 공지사항 게시판을 알려드립니다. 공지사항 게시판을 알려드립니다.</span></div>
                    <div class=" bo_date  col-auto">2022.06.25</div>
                </a>
            </li>

        </ul>


        <nav aria-label="Page navigation ">
            <ul class="pagination mt-5">
                <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li>
            </ul>
        </nav>
    </div>

</div>

<? include_once("./inc/tail.php"); ?>