<?php
$title = "콘텐츠 관리";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="wr_tit2">
                    <h2>콘텐츠 상세</h2>
                </div>
            </div>
            <div class="col-12">
                <div class="content_pg_wr content_pg_wr2">
                    <div class="btn_group_wrap">
                        <div class="group_wr">
                            <label>승인상태</label>
                            <div class="btn-group btn-group-toggle mr-5" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="options" id="option9" checked> 전체
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="options" id="option1"> 승인대기
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="options" id="option2"> 승인완료
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="options" id="option3"> 승인반려
                                </label>
                            </div>  
                        </div>
                        <div class="group_wr">
                            <label>노출</label>
                            <div class="btn-group btn-group-toggle mr-5" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="options" id="option9" checked> 전체
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="options" id="option1"> 노출
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="options" id="option2"> 노출안함
                                </label>
                            </div>  
                        </div>
                    </div>
                    <div class="wr_form wr_form2 d-flex align-items-center">
                        <div class="wr_form_cont d-flex mr-4">
                            <div class="form-group form-group_1 form_select form_l">
                                <select class="form-control" id="exampleFormControlSelect1" aria-placeholder="분류">
                                    <option value="" disabled selected>분류</option>
                                    <option>1</option>
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
                        <button type="button" class="btn btn-outline-dark btn-sm btn_reset"><img src="img/ic_reset.png" alt=""> 초기화</button>
                    </div>  
                </div>
                
                <div class="table-responsive-xl">
                    <table class="table history_list my_contents_list text-center">
                        <thead>
                            <tr>
                            <th scope="col">번호</th>
                            <th scope="col">승인상태</th>
                            <th scope="col" class="my_cont_cate">카테고리</th>
                            <th scope="col" class="my_cont_name">콘텐츠명</th>
                            <th scope="col">해상도</th>
                            <th scope="col">판매가격</th>
                            <th scope="col">등록일</th>
                            <th scope="col">승인일</th>
                            <th scope="col">노출</th>
                            <th scope="col" class="my_cont_set">관리</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>10</td>
                            <td>승인대기</td>
                            <td class="my_cont_cate">영상 > 4K</td>
                            <td class="text_hidden my_cont_name">UNIVERSAL TEXT INTRO video</td>
                            <td>4K</td>
                            <td>100,000원</td>
                            <td>2021.01.01</td>
                            <td> </td>
                            <td> </td>
                            <td class="my_cont_set">
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary btn-sm mr-4" onclick="location.href='artist_my_contents_detail.php'">상세</button>
                                    <button type="button" class="btn btn-secondary btn-sm"><img src="img/ic_del.png" alt=""> 삭제</button>
                                </div>
                            </td>
                            </tr>
                            <tr>
                            <td>9</td>
                            <td>승인대기</td>
                            <td class="my_cont_cate">영상 > 4K</td>
                            <td class="text_hidden my_cont_name">UNIVERSAL TEXT INTRO video</td>
                            <td>4K</td>
                            <td>100,000원</td>
                            <td>2021.01.01</td>
                            <td> </td>
                            <td> </td>
                            <td class="my_cont_set">
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary btn-sm mr-4" onclick="location.href='artist_my_contents_detail.php'">상세</button>
                                    <button type="button" class="btn btn-secondary btn-sm"><img src="img/ic_del.png" alt=""> 삭제</button>
                                </div>
                            </td>
                            </tr>
                            <tr>
                            <td>8</td>
                            <td>승인대기</td>
                            <td class="my_cont_cate">영상 > 4K</td>
                            <td class="text_hidden my_cont_name">UNIVERSAL TEXT INTRO video nation …</td>
                            <td>4K</td>
                            <td>100,000원</td>
                            <td>2021.01.01</td>
                            <td>2021.01.04</td>
                            <td>Y</td>
                            <td class="my_cont_set">
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary btn-sm mr-4" onclick="location.href='artist_my_contents_detail.php'">상세</button>
                                    <button type="button" class="btn btn-secondary btn-sm"><img src="img/ic_del.png" alt=""> 삭제</button>
                                </div>
                            </td>
                            </tr>
                            <tr>
                            <td>7</td>
                            <td>승인대기</td>
                            <td class="my_cont_cate">영상 > 4K</td>
                            <td class="text_hidden my_cont_name">UNIVERSAL TEXT INTRO video</td>
                            <td>4K</td>
                            <td>100,000원</td>
                            <td>2021.01.01</td>
                            <td>2021.01.04</td>
                            <td>Y</td>
                            <td class="my_cont_set">
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary btn-sm mr-4" onclick="location.href='artist_my_contents_detail.php'">상세</button>
                                    <button type="button" class="btn btn-secondary btn-sm"><img src="img/ic_del.png" alt=""> 삭제</button>
                                </div>
                            </td>
                            </tr>
                            <tr>
                            <td>6</td>
                            <td>승인대기</td>
                            <td class="my_cont_cate">영상 > 4K</td>
                            <td class="text_hidden my_cont_name">UNIVERSAL TEXT INTRO video</td>
                            <td>4K</td>
                            <td>100,000원</td>
                            <td>2021.01.01</td>
                            <td>2021.01.04</td>
                            <td>N</td>
                            <td class="my_cont_set">
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary btn-sm mr-4" onclick="location.href='artist_my_contents_detail.php'">상세</button>
                                    <button type="button" class="btn btn-secondary btn-sm"><img src="img/ic_del.png" alt=""> 삭제</button>
                                </div>
                            </td>
                            </tr>
                            <tr>
                            <td>5</td>
                            <td>승인대기</td>
                            <td class="my_cont_cate">영상 > 4K</td>
                            <td class="text_hidden my_cont_name">UNIVERSAL TEXT INTRO video</td>
                            <td>4K</td>
                            <td>100,000원</td>
                            <td>2021.01.01</td>
                            <td>2021.01.04</td>
                            <td>Y</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary btn-sm mr-4" onclick="location.href='artist_my_contents_detail.php'">상세</button>
                                    <button type="button" class="btn btn-secondary btn-sm"><img src="img/ic_del.png" alt=""> 삭제</button>
                                </div>
                            </td>
                            </tr>
                            <tr>
                            <td>4</td>
                            <td>승인대기</td>
                            <td class="my_cont_cate">영상 > 4K</td>
                            <td class="text_hidden my_cont_name">UNIVERSAL TEXT INTRO video</td>
                            <td>4K</td>
                            <td>100,000원</td>
                            <td>2021.01.01</td>
                            <td>2021.01.04</td>
                            <td> </td>
                            <td class="my_cont_set">
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary btn-sm mr-4" onclick="location.href='artist_my_contents_detail.php'">상세</button>
                                    <button type="button" class="btn btn-secondary btn-sm"><img src="img/ic_del.png" alt=""> 삭제</button>
                                </div>
                            </td>
                            </tr>
                            <tr>
                            <td>3</td>
                            <td>승인대기</td>
                            <td class="my_cont_cate">영상 > 4K</td>
                            <td class="text_hidden my_cont_name">UNIVERSAL TEXT INTRO video</td>
                            <td>4K</td>
                            <td>100,000원</td>
                            <td>2021.01.01</td>
                            <td>2021.01.04</td>
                            <td>Y</td>
                            <td class="my_cont_set">
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary btn-sm mr-4" onclick="location.href='artist_my_contents_detail.php'">상세</button>
                                    <button type="button" class="btn btn-secondary btn-sm"><img src="img/ic_del.png" alt=""> 삭제</button>
                                </div>
                            </td>
                            </tr>
                            <tr>
                            <td>2</td>
                            <td>승인대기</td>
                            <td class="my_cont_cate">영상 > 4K</td>
                            <td class="text_hidden my_cont_name">UNIVERSAL TEXT INTRO video</td>
                            <td>4K</td>
                            <td>100,000원</td>
                            <td>2021.01.01</td>
                            <td>2021.01.04</td>
                            <td>N</td>
                            <td class="my_cont_set">
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary btn-sm mr-4" onclick="location.href='artist_my_contents_detail.php'">상세</button>
                                    <button type="button" class="btn btn-secondary btn-sm"><img src="img/ic_del.png" alt=""> 삭제</button>
                                </div>
                            </td>
                            </tr>
                            <tr>
                            <td>1</td>
                            <td>승인대기</td>
                            <td class="my_cont_cate">영상 > 4K</td>
                            <td class="text_hidden my_cont_name">UNIVERSAL TEXT INTRO video</td>
                            <td>4K</td>
                            <td>100,000원</td>
                            <td>2021.01.01</td>
                            <td>2021.01.04</td>
                            <td>N</td>
                            <td class="my_cont_set">
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary btn-sm mr-4" onclick="location.href='artist_my_contents_detail.php'">상세</button>
                                    <button type="button" class="btn btn-secondary btn-sm"><img src="img/ic_del.png" alt=""> 삭제</button>
                                </div>
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

<? include_once("./inc/tail.php"); ?>