<?php
$title = "아티스트";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="artist_pg_hd">
        <div class="at_bg_slider">
            <div class="at_bg swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><div class="img square"><img src="/img/sample_img_1.png" alt=""></div></div>
                    <div class="swiper-slide"><div class="img square"><img src="/img/sample_img_2.png" alt=""></div></div>
                    <div class="swiper-slide"><div class="img square"><img src="/img/sample_img_3.png" alt=""></div></div>
                    <div class="swiper-slide"><div class="img square"><img src="/img/sample_img_4.png" alt=""></div></div>
                    <div class="swiper-slide"><div class="img square"><img src="/img/sample_img_5.png" alt=""></div></div>
                </div>
            </div>
        </div>
        <div class="filter">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="artist_hd_wr d-flex justify-content-between align-items-center">
                            <div class="hd_tit hd_tit2">
                                <h2 class="ff_play">TOP ARTISTS</h2>
                                <p>이펙트코리아의 아티스트가 되어주세요.</p>
                                <button type="button" class="btn btn-outline-secondary tp_btn tp_btn_1" onclick="location.href='signup_artist1.php'">아티스트 회원 되기<img src="img/arrow_right_2.png" alt=""></button>
                            </div>
                            <div class="carousel_slider">
                                <div thumbsSlider="" class="carousel swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide"><div class="img square"><img src="/img/sample_img_1.png" alt=""></div></div>
                                        <div class="swiper-slide"><div class="img square"><img src="/img/sample_img_2.png" alt=""></div></div>
                                        <div class="swiper-slide"><div class="img square"><img src="/img/sample_img_3.png" alt=""></div></div>
                                        <div class="swiper-slide"><div class="img square"><img src="/img/sample_img_4.png" alt=""></div></div>
                                        <div class="swiper-slide"><div class="img square"><img src="/img/sample_img_5.png" alt=""></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="wr_tit1 d-flex justify-content-between align-items-end">
                    <h2 class="ff_play">ARTIST</h2>
                    <div class="form-group form-group_1 sch_input_wrap">
                        <label for="extInput" class="search_label">검색어 <span class="hide_text">입력</span></label>
                        <input type="text" class="form-control" id="textInput">
                        <button class="btn btn-link btn_sch btn_sch_1"><img src="img/ic_sub_search.png" alt="검색"> </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="at_list row row-cols-2 row-cols-xl-4 row-cols-lg-3">
            <div class="col">
                <a href="artist_detail.php">
                    <div class="at_box">
                        <div class="at_cr_img square"><img src="img/sample_img_1.png" alt=""></div>
                        <h4 class="at_name fw_500">아티스트 닉네임</h4>
                        <p class="at_txt">아티스트의 자기소개 내용입니다. 품으며, 따뜻한 사람은 속에서 보라. 얼음과 군영과 것은 힘차게 전인 칼이다. 가장 끓는 피고 이것이다.트고, 우는 찾아다녀도…</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="artist_detail.php">
                    <div class="at_box">
                        <div class="at_cr_img square"><img src="img/sample_img_2.png" alt=""></div>
                        <h4 class="at_name fw_500">아티스트 닉네임</h4>
                        <p class="at_txt">아티스트의 자기소개 내용입니다. 품으며, 따뜻한 사람은 속에서 보라. 얼음과 군영과 것은 힘차게 전인 칼이다. 가장 끓는 피고 이것이다.트고, 우는 찾아다녀도…</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="artist_detail.php">
                    <div class="at_box">
                        <div class="at_cr_img square"><img src="img/sample_img_3.png" alt=""></div>
                        <h4 class="at_name fw_500">아티스트 닉네임</h4>
                        <p class="at_txt">아티스트의 자기소개 내용입니다. 품으며, 따뜻한 사람은 속에서 보라. 얼음과 군영과 것은 힘차게 전인 칼이다. 가장 끓는 피고 이것이다.트고, 우는 찾아다녀도…</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="artist_detail.php">
                    <div class="at_box">
                        <div class="at_cr_img square"><img src="img/sample_img_4.png" alt=""></div>
                        <h4 class="at_name fw_500">아티스트 닉네임</h4>
                        <p class="at_txt">아티스트의 자기소개 내용입니다. 품으며, 따뜻한 사람은 속에서 보라. 얼음과 군영과 것은 힘차게 전인 칼이다. 가장 끓는 피고 이것이다.트고, 우는 찾아다녀도…</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="artist_detail.php">
                    <div class="at_box">
                        <div class="at_cr_img square"><img src="img/sample_img_5.png" alt=""></div>
                        <h4 class="at_name fw_500">아티스트 닉네임</h4>
                        <p class="at_txt">아티스트의 자기소개 내용입니다. 품으며, 따뜻한 사람은 속에서 보라. 얼음과 군영과 것은 힘차게 전인 칼이다. 가장 끓는 피고 이것이다.트고, 우는 찾아다녀도…</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="artist_detail.php">
                    <div class="at_box">
                        <div class="at_cr_img square"><img src="img/sample_img_6.png" alt=""></div>
                        <h4 class="at_name fw_500">아티스트 닉네임</h4>
                        <p class="at_txt">아티스트의 자기소개 내용입니다. 품으며, 따뜻한 사람은 속에서 보라. 얼음과 군영과 것은 힘차게 전인 칼이다. 가장 끓는 피고 이것이다.트고, 우는 찾아다녀도…</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="artist_detail.php">
                    <div class="at_box">
                        <div class="at_cr_img square"><img src="img/sample_img_7.png" alt=""></div>
                        <h4 class="at_name fw_500">아티스트 닉네임</h4>
                        <p class="at_txt">아티스트의 자기소개 내용입니다. 품으며, 따뜻한 사람은 속에서 보라. 얼음과 군영과 것은 힘차게 전인 칼이다. 가장 끓는 피고 이것이다.트고, 우는 찾아다녀도…</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="artist_detail.php">
                    <div class="at_box">
                        <div class="at_cr_img square"><img src="img/sample_img_8.png" alt=""></div>
                        <h4 class="at_name fw_500">아티스트 닉네임</h4>
                        <p class="at_txt">아티스트의 자기소개 내용입니다. 품으며, 따뜻한 사람은 속에서 보라. 얼음과 군영과 것은 힘차게 전인 칼이다. 가장 끓는 피고 이것이다.트고, 우는 찾아다녀도…</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="artist_detail.php">
                    <div class="at_box">
                        <div class="at_cr_img square"><img src="img/sample_img_1.png" alt=""></div>
                        <h4 class="at_name fw_500">아티스트 닉네임</h4>
                        <p class="at_txt">아티스트의 자기소개 내용입니다. 품으며, 따뜻한 사람은 속에서 보라. 얼음과 군영과 것은 힘차게 전인 칼이다. 가장 끓는 피고 이것이다.트고, 우는 찾아다녀도…</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="artist_detail.php">
                    <div class="at_box">
                        <div class="at_cr_img square"><img src="img/sample_img_2.png" alt=""></div>
                        <h4 class="at_name fw_500">아티스트 닉네임</h4>
                        <p class="at_txt">아티스트의 자기소개 내용입니다. 품으며, 따뜻한 사람은 속에서 보라. 얼음과 군영과 것은 힘차게 전인 칼이다. 가장 끓는 피고 이것이다.트고, 우는 찾아다녀도…</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="artist_detail.php">
                    <div class="at_box">
                        <div class="at_cr_img square"><img src="img/sample_img_3.png" alt=""></div>
                        <h4 class="at_name fw_500">아티스트 닉네임</h4>
                        <p class="at_txt">아티스트의 자기소개 내용입니다. 품으며, 따뜻한 사람은 속에서 보라. 얼음과 군영과 것은 힘차게 전인 칼이다. 가장 끓는 피고 이것이다.트고, 우는 찾아다녀도…</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="artist_detail.php">
                    <div class="at_box">
                        <div class="at_cr_img square"><img src="img/sample_img_4.png" alt=""></div>
                        <h4 class="at_name fw_500">아티스트 닉네임</h4>
                        <p class="at_txt">아티스트의 자기소개 내용입니다. 품으며, 따뜻한 사람은 속에서 보라. 얼음과 군영과 것은 힘차게 전인 칼이다. 가장 끓는 피고 이것이다.트고, 우는 찾아다녀도…</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="artist_detail.php">
                    <div class="at_box">
                        <div class="at_cr_img square"><img src="img/sample_img_5.png" alt=""></div>
                        <h4 class="at_name fw_500">아티스트 닉네임</h4>
                        <p class="at_txt">아티스트의 자기소개 내용입니다. 품으며, 따뜻한 사람은 속에서 보라. 얼음과 군영과 것은 힘차게 전인 칼이다. 가장 끓는 피고 이것이다.트고, 우는 찾아다녀도…</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="artist_detail.php">
                    <div class="at_box">
                        <div class="at_cr_img square"><img src="img/sample_img_6.png" alt=""></div>
                        <h4 class="at_name fw_500">아티스트 닉네임</h4>
                        <p class="at_txt">아티스트의 자기소개 내용입니다. 품으며, 따뜻한 사람은 속에서 보라. 얼음과 군영과 것은 힘차게 전인 칼이다. 가장 끓는 피고 이것이다.트고, 우는 찾아다녀도…</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="artist_detail.php">
                    <div class="at_box">
                        <div class="at_cr_img square"><img src="img/sample_img_7.png" alt=""></div>
                        <h4 class="at_name fw_500">아티스트 닉네임</h4>
                        <p class="at_txt">아티스트의 자기소개 내용입니다. 품으며, 따뜻한 사람은 속에서 보라. 얼음과 군영과 것은 힘차게 전인 칼이다. 가장 끓는 피고 이것이다.트고, 우는 찾아다녀도…</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="artist_detail.php">
                    <div class="at_box">
                        <div class="at_cr_img square"><img src="img/sample_img_8.png" alt=""></div>
                        <h4 class="at_name fw_500">아티스트 닉네임</h4>
                        <p class="at_txt">아티스트의 자기소개 내용입니다. 품으며, 따뜻한 사람은 속에서 보라. 얼음과 군영과 것은 힘차게 전인 칼이다. 가장 끓는 피고 이것이다.트고, 우는 찾아다녀도…</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    var swiper = new Swiper(".carousel", {
        loop: true,
        slidesPerView: 1,
        grabCursor: true,
        effect: "creative",
        creativeEffect: {
          prev: {
            translate: ["-50%", 0, -200],
          },
          next: {
            translate: ["50%", 0, -200],
          },
        },
    });
    var swiper2 = new Swiper(".at_bg", {
        spaceBetween: 10,
        thumbs: {
          swiper: swiper,
        },
    });
</script>

<? include_once("./inc/tail.php"); ?>