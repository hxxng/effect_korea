<?php
$title = "콘텐츠 상세";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="upload_pg">
        <div class="go_back"><a href="#" onclick="history.back();"><img src="img/arrow_left.png" alt=""> 이전</a></div>
        <div class="d-flex justify-content-between align-items-center upload_pg_tit">
            <h2>콘텐츠 상세</h2>
            <div class="upload_pg_img">
                <img src="img/ic_upload2.png" alt="">
            </div>
        </div>
        <div class="upload_box">
            <p class="c_txt"><span class="fc_rd">*</span> 필수 입력 항목</p>

            <hr class="hr">

            <ul class="list_style_1 list_pa list_pa1">
                <li>
                    <span>등록일</span>
                    <p>2022.01.01</p>
                </li>
                <li>
                    <span>승인상태</span>
                    <p>승인완료</p>
                </li>
                <li>
                    <span>승인일</span>
                    <p>2022.01.01</p>
                </li>
            </ul>

            <div class="form-group">
                <label for="exampleFormControlSelect1">노출</label>
                <select class="form-control" id="exampleFormControlSelect1" aria-placeholder="선택해주세요.">
                <option>노출 안함 (N)</option>
                <option>노출 (Y)</option>
                </select>
            </div>
            
            <hr class="hr">
            
            <h3 class="fw_700">기본정보</h3>

            <ul class="list_style_1 list_pa list_pa1">
                <li>
                    <span>컨텐츠명 <span class="fc_rd">*</span></span>
                    <p>컨텐츠명입니다.</p>
                </li>
                <li>
                    <span>카테고리 <span class="fc_rd">*</span></span>
                    <p>영상 > 4K</p>
                </li>
                <li>
                    <span>포맷 <span class="fc_rd">*</span></span>
                    <p>MOV</p>
                </li>
            </ul>

            <hr class="hr">
            
            <h3 class="fw_700">상세정보</h3>
            
            <ul class="list_style_1 list_pa list_pa1">
                <li>
                    <span>프레임레이트</span>
                    <p>25.00</p>
                </li>
                <li>
                    <span>콘텐츠 재생시간</span>
                    <p>00:00:00</p>
                </li>
                <li>
                    <span>파일 크기</span>
                    <p>10MB</p>
                </li>
                <li>
                    <span>카테고리 필터링 <span class="fc_rd">*</span></span>
                    <p>자연, 인물</p>
                </li>
                <li>
                    <span>컨텐츠 설명</span>
                    <p>컨텐츠설명입니다. 컨텐츠설명입니다.컨텐츠설명입니다.컨텐츠설명입니다.컨텐츠설명입니다.컨텐츠설명입니다.</p>
                </li>
                <li>
                    <span>에디토리얼</span>
                    <p>선택안함</p>
                </li>
            </ul>

            <hr class="hr">
            
            <h3 class="fw_700">업로드</h3>
            
            <div class="contents_thumb">
                <label>대표 썸네일 <span class="fc_rd">*</span></label>
                <div class="contents_thumb_img square"><img src="img/img_sample_1.jpg" alt=""></div>
            </div>

            <div class="file_upload">
                <label>파일 업로드 <span class="fc_rd">*</span></label>
                <div class="file_upload_box">
                    <label class="file_upload_btn position-relative mb-0">
                        <div class="position-absolute file_upload_b">
                            <p class="file_name fw_600">nature.mp4</p>
                        </div>
                    </label>
                    <div class="file_attention">
                        <h4 class="fw_600">주의사항</h4>
                        <ol>
                            <li>파일은 정해진 크기와 확장자로 업로드 합니다.</li>
                            <li>악성코드가 포함된 파일을 발견시 제지를 받을 수 있습니다.</li>
                            <li>콘텐츠는 제3자의 저작권을 침해하지 않도록 주의의무를 다하여야 합니다. 이를 위반할 경우 모든 책임은 업로드 회원에게 있습니다</li>
                        </ol>
                    </div>
                </div>
            </div>

            <ul class="list_style_1 list_pa list_pa1">
                <li>
                    <span>해상도 <span class="fc_rd">*</span></span>
                    <p>4K</p>
                </li>
            </ul>
            

            <hr class="hr hr_m">

            <h3 class="fw_700">호환프로그램</h3>
            
            <div class="prg_select">
                <div class="prg_box prg_box1 on">
                    <img src="img/ic_premiere.png" alt="">
                    <p>프리미어 프로</p>
                </div>
            </div>

            <hr class="hr">

            <h3 class="fw_700">판매가격</h3>

            <ul class="list_style_1 list_pa list_pa1">
                <li>
                    <span>판매가격 <span class="fc_rd">*</span></span>
                    <p>123,000원</p>
                </li>
            </ul>
                  
        </div>
        <div class="d-flex mp_btn1">
            <button type="button" class="btn btn-secondary form_l" onclick="location.href='artist_my_contents.php'">목록</button>
            <button type="button" class="btn btn-primary form_r" onclick="location.href='#'">확인</button>
        </div>
    </div>
</div>


<? include_once("./inc/tail.php"); ?>