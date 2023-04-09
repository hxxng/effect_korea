<?php
$title = "메인";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="tailor_pg position-relative">
        <div class="tailor_pg_top text-center position-absolute">
            <p class="tailored_tit fw_700 ff_play">TAILORED :</p>
            <p class="tailored_sub">주문에 따라 맞춘, 꼭 맞게 만들어진</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tailor_pg_mid text-center">
                    <h2>우리는 실제 프로듀서 출신으로 <br>클라이언트에게 믿음을 줍니다.</h2>
                    <p>크리에이티브한 기획제안, 다수 경력의 촬영감독, 전 세계 성우, 편집지, 포스트 프로덕션까지
                    <span>Tailored는 이 모든 과정을 슈퍼바이징하는 디렉터</span>입니다.</p>
                    <div class="tailor_ic_box">
                        <div class="row row-cols-2 row-cols-md-4">
                            <div class="col text-center">
                                <div class="tailor_ic"><img src="img/ic_tailor_1.png" alt=""></div>
                                <p class="ff_play fw_400">Professional Advertising</p>
                            </div>
                            <div class="col text-center">
                                <div class="tailor_ic"><img src="img/ic_tailor_2.png" alt=""></div>
                                <p class="ff_play fw_400">Customized Content</p>
                            </div>
                            <div class="col text-center">
                                <div class="tailor_ic"><img src="img/ic_tailor_3.png" alt=""></div>
                                <p class="ff_play fw_400">Global Director
                                    of Photography</p>
                            </div>
                            <div class="col text-center">
                                <div class="tailor_ic"><img src="img/ic_tailor_4.png" alt=""></div>
                                <p class="ff_play fw_400">Internal Copyright</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tailor_contact">
        <div class="tailor_contact_wrap">
            <h2 class="ff_play text-center">CONTACT</h2>
            <div class="tailor_contact_box">
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
                <div class="find_name d-flex justify-content-between">
                    <div class="form-group form-group_1 form_l">
                        <label for="extInput">회사명</label>
                        <input type="text" class="form-control" id="textInput">
                    </div>
                    <div class="form-group form-group_1 form_r">
                        <label for="extInput">직함</label>
                        <input type="text" class="form-control" id="textInput">
                    </div>
                </div>
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
                    <label for="extInput">비고</label>
                    <textarea class="form-control"></textarea>
                </div>
                <button type="button" class="btn btn-primary login_btn" onclick="location.href='#'">제출</button>
            </div>
        </div>
    </div>
</div>
                
<? include_once("./inc/tail.php"); ?>