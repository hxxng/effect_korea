<?php
$title = "콘텐츠 업로드";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="upload_pg">
        <div class="go_back"><a href="#" onclick="history.back();"><img src="img/arrow_left.png" alt=""> 이전</a></div>
        <div class="d-flex justify-content-between align-items-center upload_pg_tit">
            <h2>콘텐츠 업로드</h2>
            <div class="upload_pg_img">
                <img src="img/ic_upload2.png" alt="">
            </div>
        </div>
        <div class="upload_box">
            <p class="c_txt"><span class="fc_rd">*</span> 필수 입력 항목</p>

            <hr class="hr">

            <h3 class="fw_700">기본정보</h3>

            <div class="form-group">
                <label>컨텐츠명 <span class="fc_rd">*</span></label>
                <input type="text" class="form-control" placeholder="컨텐츠명 입력">
            </div>
            
            <div class="form-group">
                <label class="d-flex justify-content-between">
                    <p>컨텐츠설명</p>
                    <p class="contents_lm">0/100</p>
                </label>
                <textarea class="form-control" placeholder="컨텐츠설명 입력"></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <div class="form-group mr-5">
                    <label for="exampleFormControlSelect1">카테고리(대분류) <span class="fc_rd">*</span></label>
                    <select class="form-control" id="exampleFormControlSelect1" aria-placeholder="선택해주세요.">
                    <option>영상</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    </select>
                </div>     
                <div class="form-group">
                    <label for="exampleFormControlSelect1">카테고리(중분류) <span class="fc_rd">*</span></label>
                    <select class="form-control" id="exampleFormControlSelect1" aria-placeholder="선택해주세요.">
                    <option>4K</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    </select>
                </div>     
            </div>
            
            <div class="form-group">
                <label for="exampleFormControlSelect1">포맷 <span class="fc_rd">*</span></label>
                <select class="form-control" id="exampleFormControlSelect1" aria-placeholder="선택해주세요.">
                <option value="" disabled selected>선택</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                </select>
            </div>
            
            <hr class="hr">
            
            <h3 class="fw_700">상세정보</h3>

            <div class="upload_detail_wr">
                <div class="form-group mr-5">
                    <label for="exampleFormControlSelect1">프레임레이트</label>
                    <select class="form-control" id="exampleFormControlSelect1" aria-placeholder="선택해주세요.">
                    <option value="" disabled selected>선택</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>콘텐츠 재생시간</label>
                    <div class="upload_p_time">
                        <input type="number" class="form-control" placeholder="0"><span>:</span><input type="number" class="form-control" placeholder="0"><span>:</span><input type="number" class="form-control" placeholder="0">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>파일크기</label>
                <input class="form-control" type="text" placeholder="164MB" readonly>
            </div>
                    
            <div class="form-group filter_chk_group">
                <label>필터링 카테고리(중복선택가능) <span class="fc_rd">*</span></label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        자연
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                    <label class="form-check-label" for="defaultCheck2">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        운동
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck3">
                    <label class="form-check-label" for="defaultCheck3">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        인물
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck4">
                    <label class="form-check-label" for="defaultCheck4">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        사회
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck5">
                    <label class="form-check-label" for="defaultCheck5">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        건축물
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck6">
                    <label class="form-check-label" for="defaultCheck6">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        기술
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck7">
                    <label class="form-check-label" for="defaultCheck7">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        음식
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck8">
                    <label class="form-check-label" for="defaultCheck8">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        여행
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck9">
                    <label class="form-check-label" for="defaultCheck9">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        애니메이션
                    </label>
                </div>
            </div>
            
            <div class="form-group filter_chk_group">
                <label>에디토리얼</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck10">
                    <label class="form-check-label" for="defaultCheck10">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        에디토리얼
                    </label>
                </div>
            </div>
            
            <hr class="hr">
            
            <h3 class="fw_700">업로드</h3>
            
            <div class="contents_thumb">
                <label>대표 썸네일 <span class="fc_rd">*</span></label>
                <label class="thumb_upload_btn" for="thumb_upload_input"></label>
                <input type="file" id="thumb_upload_input" hidden>
                <p>* 권장 사이즈는 596px X 332px 입니다. (최대 00MB)</p>
            </div>

            <div class="file_upload">
                <label>파일 업로드 <span class="fc_rd">*</span></label>
                <div class="file_upload_box">
                    <label class="file_upload_btn position-relative" for="file_upload_input">
                        <div class="position-absolute file_upload_b">
                            <img src="img/upload_img.png" alt="">
                            <p>파일을 끌어 당겨서 첨부해 주세요.</p>
                        </div>
                    </label>
                    <input type="file" id="file_upload_input" hidden>
                    <div class="file_attention">
                        <h4 class="fw_600">주의사항</h4>
                        <ol>
                            <li>파일은 정해진 크기와 확장자로 업로드 합니다.</li>
                            <li>악성코드가 포함된 파일을 발견시 제지를 받을 수 있습니다.</li>
                            <li>콘텐츠는 제3자의 저작권을 침해하지 않도록 주의의무를 다하여야 합니다. 이를 위반할 경우 모든 책임은 업로드 회원에게 있습니다</li>
                        </ol>
                    </div>
                </div>
                <p>* 카테고리 이미지, Illustrator 는 이미지 확장자로 등록 가능합니다.</p>
                <p>* 권장 사이즈는 0000px X 000px 입니다. (최대 00MB)</p>
                <p>* 그 외의 카테고리는 00MB 이하의 영상으로 등록해 주세요.</p>
            </div>

            <div class="form-group filter_chk_group">
                <label>해상도 (중복선택불가)</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="" id="radio1">
                    <label class="form-check-label" for="radio1">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        6K+
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="" id="radio1">
                    <label class="form-check-label" for="radio1">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        4K
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="" id="radio1">
                    <label class="form-check-label" for="radio1">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        QHD
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="" id="radio1">
                    <label class="form-check-label" for="radio1">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        FHD
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="" id="radio1">
                    <label class="form-check-label" for="radio1">
                        <div class="chkbox">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        HD
                    </label>
                </div>
            </div>

            <hr class="hr">

            <h3 class="fw_700">호환프로그램 (중복선택가능)</h3>
            
            <div class="prg_select">
                <div class="prg_box square on">
                    <button type="button" class="">
                        <img src="img/ic_premiere.png" alt="">
                        <p>프리미어 프로</p>
                    </button>
                </div>
                <div class="prg_box square">
                    <button type="button" class="">
                        <img src="img/ic_aftereffect.png" alt="">
                        <p>애프터 이펙트</p>
                    </button>
                </div>
                <div class="prg_box square">
                    <button type="button" class="">
                        <img src="img/ic_davinci.png" alt="">
                        <p>다빈치 리졸브</p>
                    </button>
                </div>
                <div class="prg_box square">
                    <button type="button" class="">
                        <img src="img/ic_vegas.png" alt="">
                        <p>베가스 프로</p>
                    </button>
                </div>
                <div class="prg_box square">
                    <button type="button" class="">
                        <img src="img/ic_finalcut.png" alt="">
                        <p>파이널 컷 프로</p>
                    </button>
                </div>
                <div class="prg_box square">
                    <button type="button" class="">
                        <img src="img/ic_photoshop_b.png" alt="">
                        <p>포토샵</p>
                    </button>
                </div>
                <div class="prg_box square">
                    <button type="button" class="">
                        <img src="img/ic_illustrator.png" alt="">
                        <p>일러스트레이터</p>
                    </button>
                </div>
                <div class="prg_box square">
                    <button type="button" class="">
                        <img src="img/ic_indesign.png" alt="">
                        <p>인디자인</p>
                    </button>
                </div>
            </div>

            <hr class="hr">

            <h3 class="fw_700">판매가격</h3>

            
            <div class="form-group">
                <label>가격 <span class="fc_rd">*</span></label>
                <div class="d-flex align-items-center">
                    <input type="number" class="form-control border-danger" placeholder="0"><p class="upload_price ml-4">원</p>
                </div>
                <small class="form-text text-danger"><img class="mr-2" src="img/ic_label_danger.png">1,000원 이상 200,000원 이하로 입력해주세요.</small>                       
            </div>
        </div>
        <div class="d-flex mp_btn1">
            <button type="button" class="btn btn-secondary form_l" onclick="location.href='artist_my_contents.php'">목록</button>
            <button type="button" class="btn btn-primary form_r" onclick="location.href='#'">등록하기</button>
        </div>
    </div>
</div>

<script>
    $(".prg_box").on("click",function(){
        $(this).toggleClass("on");
    })
</script>

<? include_once("./inc/tail.php"); ?>