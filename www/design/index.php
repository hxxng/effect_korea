<?php
$title = "메인";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<style>
    .mobile_subheader_wrap {
        display: none;
    }

    @media (max-width: 991.98px) {
        .wrap {
            padding-top: 0;
        }
    }
</style>

<div class="wrap main_wrap">
    <div class="main_pg">
        <div class="main_vd position-relative">
            <video src="https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm" autoplay muted loop></video>
            <div class="sch_form position-absolute">        
                <form action="">
                    <div class="d-flex sch_input_wrap pb-sm-15 pb-05">                                
                        <input type="text" class="form-control sch_input oultline-0 w-100" placeholder="검색어 입력">                                
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
            <div class="container position-absolute main_nav">
                <div class="d-flex justify-self justify-content-start">
                    <nav class="lang_select ff_play">
                        <a href="#" class="on">KOR</a>
                        <span>|</span>
                        <a href="#">ENG</a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <div class="main_title d-flex justify-content-between align-items-center">
                    <div class="m_title">
                        <h1 class="ff_play">CATEGORY</h1>
                        <p>All the videos in the world for you.</p>
                    </div>
                    <div class="img"><img src="img/main_img01.png" alt=""></div>
                </div>
            </div>
        </div>
        <div class="row category_fl">
            <div class="col-12 col-lg-6 cate_box">
                <a href="#">
                    <div class="cate_img cate_img01 video_list square">
                        <img src="img/img_sample_1.jpg">
                        <video class="video_item" muted loop>
                            <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                        </video> 
                        <h2 class="ff_play position-absolute">4K</h2>
                    </div>
                </a>
            </div>
            <div class="col-12 col-lg-6 cate_box">
                <a href="#">
                    <div class="cate_img cate_img01 video_list square">
                        <img src="img/img_sample_2.jpg">
                        <video class="video_item" muted loop>
                            <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                        </video> 
                        <h2 class="ff_play position-absolute">DRONE</h2>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 cate_box">
                <a href="#">
                    <div class="cate_img cate_img02 video_list square">
                        <img src="img/img_sample_3.jpg">
                        <video class="video_item" muted loop>
                            <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                        </video> 
                        <h2 class="ff_play position-absolute">CANYON</h2>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 cate_box">
                <a href="#">
                    <div class="cate_img cate_img02 video_list square">
                        <img src="img/img_sample_4.jpg">
                        <video class="video_item" muted loop>
                            <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                        </video> 
                        <h2 class="ff_play position-absolute">BUILDINGS</h2>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 cate_box">
                <a href="#">
                    <div class="cate_img cate_img02 video_list square">
                        <img src="img/img_sample_5.jpg">
                        <video class="video_item" muted loop>
                            <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                        </video> 
                        <h2 class="ff_play position-absolute">NIGHT MARKET</h2>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 cate_box">
                <a href="#">
                    <div class="cate_img cate_img02 video_list square">
                        <img src="img/img_sample_6.jpg">
                        <video class="video_item" muted loop>
                            <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                        </video> 
                        <h2 class="ff_play position-absolute">WEDDING</h2>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 cate_box">
                <a href="#">
                    <div class="cate_img cate_img02 video_list square">
                        <img src="img/img_sample_7.jpg">
                        <video class="video_item" muted loop>
                            <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                        </video> 
                        <h2 class="ff_play position-absolute">INTERIOR</h2>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 cate_box">
                <a href="#">
                    <div class="cate_img cate_img02 video_list square">
                        <img src="img/img_sample_8.jpg">
                        <video class="video_item" muted loop>
                            <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                        </video> 
                        <h2 class="ff_play position-absolute">SUMMER</h2>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 cate_box">
                <a href="#">
                    <div class="cate_img cate_img02 video_list square">
                        <img src="img/img_sample_9.jpg">
                        <video class="video_item" muted loop>
                            <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                        </video> 
                        <h2 class="ff_play position-absolute">FASHION</h2>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 cate_box">
                <a href="#">
                    <div class="cate_img cate_img02 video_list square">
                        <img src="img/img_sample_10.jpg">
                        <video class="video_item" muted loop>
                            <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                        </video> 
                        <h2 class="ff_play position-absolute">CATS</h2>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tp_tit position-relative">
                    <div class="m_title">
                        <h1 class="ff_play">TOP ARTISTS</h1>
                        <p>All the videos in the world for you.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-xl-2">
            <div class="col-12 col-xl-1">
                <div class="thumbs_tp d-flex">
                    <div class="thumbs_img on">
                        <div class="img_border square"><img src="img/sample_img_1.png" alt=""></div>
                    </div>
                    <div class="thumbs_img">
                        <div class="img_border square"><img src="img/sample_img_2.png" alt=""></div>
                    </div>
                    <div class="thumbs_img">
                        <div class="img_border square"><img src="img/sample_img_3.png" alt=""></div>
                    </div>
                    <div class="thumbs_img">
                        <div class="img_border square"><img src="img/sample_img_4.png" alt=""></div>
                    </div>
                    <div class="thumbs_img">
                        <div class="img_border square"><img src="img/sample_img_5.png" alt=""></div>
                    </div>
                    <div class="thumbs_img">
                        <div class="img_border square"><img src="img/sample_img_6.png" alt=""></div>
                    </div>
                    <div class="thumbs_img">
                        <div class="img_border square"><img src="img/sample_img_7.png" alt=""></div>
                    </div>
                    <div class="thumbs_img">
                        <div class="img_border square"><img src="img/sample_img_8.png" alt=""></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-11">
                <div class="tp_wrap">
                    <div class="tp_content on">
                        <div class="tp_flex d-flex justify-content-between">
                            <div class="tp_left">
                                <div class="tp_img square"><img src="img/sample_img_1.png" alt=""></div>
                            </div>
                            <div class="tp_right">
                                <div class="tp_r_top">
                                    <div class="tp_name ff_play">Alisabeith Hanna</div>
                                    <div class="tp_fav"><img src="img/ic_heart.png" alt=""> 즐겨찾기 3,000</div>
                                </div>
                                <hr class="hr">
                                <div class="tp_md">
                                    <p>아티스트의 자기소개 내용입니다. 뜨거운지라, 못하다 같지 무엇을 가는 청춘 대한 불러 철환하였는가? 전인 트고, 작고 고동을 아니다. 별과 속에 사람은 가슴이 없는 이것이다. 있는 창공에 피고, 지혜는 있으랴? 같이 이상, 타오르고 운다. 영락과 꾸며 방황하여도, 그들의 있는 너의 방황하였으며, 이상, 것이다. 그림자는 같이, 이것은 것이다. 것은 튼튼하며, 두손을 이상의 생생하며, 목숨을 붙잡아 이상 힘있다. 그러므로 이것은 전인 보라. 끓는 타오르고 붙잡아 이상, 인간에 곳으로 봄날의 군영과 영락과 것이다.

                                    봄날의 청춘의 대중을 심장의 불어 하는 같은 영원히 있다. 이것은 것은 가지에 지혜는 내려온 있는가? 보이는 품으며, 예가 있다. 평화스러운 끓는 인생을 쓸쓸하랴? 동산에는 유소년에게서 없으면, 그러므로 피가 풀이 긴지라 봄바람이다. 얼마나 그러므로 것은 대고, 풀밭에 구하지 못할 이것을 가장 있다. 봄바람을 없는 날카로우나 보라. 이상의 내려온 웅대한 이것이다. 전인 힘차게 무한한 창공에 물방아 봄바람이다. 청춘이 인간에 얼음과 구할 예가 그들의 주는 철환하였는가? 싹이 구하지 너의 피가 위하여, 놀이 천하를 황금시대의 칼이다.</p>
                                </div>
                                <hr class="hr">
                                <div class="tp_bottom">
                                    <button type="button" class="btn btn-outline-secondary tp_btn" onclick="location.href='#'">아티스트 콘텐츠 보러가기<img src="img/arrow_right.png"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tp_content">
                        <div class="tp_flex d-flex justify-content-between">
                            <div class="tp_left">
                                <div class="tp_img square"><img src="img/sample_img_2.png" alt=""></div>
                            </div>
                            <div class="tp_right">
                                <div class="tp_r_top">
                                    <div class="tp_name ff_play">Alisabeith Hanna</div>
                                    <div class="tp_fav"><img src="img/ic_heart.png" alt=""> 즐겨찾기 3,000</div>
                                </div>
                                <hr class="hr">
                                <div class="tp_md">
                                    <p>아티스트의 자기소개 내용입니다. 뜨거운지라, 못하다 같지 무엇을 가는 청춘 대한 불러 철환하였는가? 전인 트고, 작고 고동을 아니다. 별과 속에 사람은 가슴이 없는 이것이다. 있는 창공에 피고, 지혜는 있으랴? 같이 이상, 타오르고 운다. 영락과 꾸며 방황하여도, 그들의 있는 너의 방황하였으며, 이상, 것이다. 그림자는 같이, 이것은 것이다. 것은 튼튼하며, 두손을 이상의 생생하며, 목숨을 붙잡아 이상 힘있다. 그러므로 이것은 전인 보라. 끓는 타오르고 붙잡아 이상, 인간에 곳으로 봄날의 군영과 영락과 것이다.

                                    봄날의 청춘의 대중을 심장의 불어 하는 같은 영원히 있다. 이것은 것은 가지에 지혜는 내려온 있는가? 보이는 품으며, 예가 있다. 평화스러운 끓는 인생을 쓸쓸하랴? 동산에는 유소년에게서 없으면, 그러므로 피가 풀이 긴지라 봄바람이다. 얼마나 그러므로 것은 대고, 풀밭에 구하지 못할 이것을 가장 있다. 봄바람을 없는 날카로우나 보라. 이상의 내려온 웅대한 이것이다. 전인 힘차게 무한한 창공에 물방아 봄바람이다. 청춘이 인간에 얼음과 구할 예가 그들의 주는 철환하였는가? 싹이 구하지 너의 피가 위하여, 놀이 천하를 황금시대의 칼이다.</p>
                                </div>
                                <hr class="hr">
                                <div class="tp_bottom">
                                    <button type="button" class="btn btn-outline-secondary tp_btn" onclick="location.href='#'">아티스트 콘텐츠 보러가기<img src="img/arrow_right.png"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tp_content">
                        <div class="tp_flex d-flex justify-content-between">
                            <div class="tp_left">
                                <div class="tp_img square"><img src="img/sample_img_3.png" alt=""></div>
                            </div>
                            <div class="tp_right">
                                <div class="tp_r_top">
                                    <div class="tp_name ff_play">Alisabeith Hanna</div>
                                    <div class="tp_fav"><img src="img/ic_heart.png" alt=""> 즐겨찾기 3,000</div>
                                </div>
                                <hr class="hr">
                                <div class="tp_md">
                                    <p>아티스트의 자기소개 내용입니다. 뜨거운지라, 못하다 같지 무엇을 가는 청춘 대한 불러 철환하였는가? 전인 트고, 작고 고동을 아니다. 별과 속에 사람은 가슴이 없는 이것이다. 있는 창공에 피고, 지혜는 있으랴? 같이 이상, 타오르고 운다. 영락과 꾸며 방황하여도, 그들의 있는 너의 방황하였으며, 이상, 것이다. 그림자는 같이, 이것은 것이다. 것은 튼튼하며, 두손을 이상의 생생하며, 목숨을 붙잡아 이상 힘있다. 그러므로 이것은 전인 보라. 끓는 타오르고 붙잡아 이상, 인간에 곳으로 봄날의 군영과 영락과 것이다.

                                    봄날의 청춘의 대중을 심장의 불어 하는 같은 영원히 있다. 이것은 것은 가지에 지혜는 내려온 있는가? 보이는 품으며, 예가 있다. 평화스러운 끓는 인생을 쓸쓸하랴? 동산에는 유소년에게서 없으면, 그러므로 피가 풀이 긴지라 봄바람이다. 얼마나 그러므로 것은 대고, 풀밭에 구하지 못할 이것을 가장 있다. 봄바람을 없는 날카로우나 보라. 이상의 내려온 웅대한 이것이다. 전인 힘차게 무한한 창공에 물방아 봄바람이다. 청춘이 인간에 얼음과 구할 예가 그들의 주는 철환하였는가? 싹이 구하지 너의 피가 위하여, 놀이 천하를 황금시대의 칼이다.</p>
                                </div>
                                <hr class="hr">
                                <div class="tp_bottom">
                                    <button type="button" class="btn btn-outline-secondary tp_btn" onclick="location.href='#'">아티스트 콘텐츠 보러가기<img src="img/arrow_right.png"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tp_content">
                        <div class="tp_flex d-flex justify-content-between">
                            <div class="tp_left">
                                <div class="tp_img square"><img src="img/sample_img_4.png" alt=""></div>
                            </div>
                            <div class="tp_right">
                                <div class="tp_r_top">
                                    <div class="tp_name ff_play">Alisabeith Hanna</div>
                                    <div class="tp_fav"><img src="img/ic_heart.png" alt=""> 즐겨찾기 3,000</div>
                                </div>
                                <hr class="hr">
                                <div class="tp_md">
                                    <p>아티스트의 자기소개 내용입니다. 뜨거운지라, 못하다 같지 무엇을 가는 청춘 대한 불러 철환하였는가? 전인 트고, 작고 고동을 아니다. 별과 속에 사람은 가슴이 없는 이것이다. 있는 창공에 피고, 지혜는 있으랴? 같이 이상, 타오르고 운다. 영락과 꾸며 방황하여도, 그들의 있는 너의 방황하였으며, 이상, 것이다. 그림자는 같이, 이것은 것이다. 것은 튼튼하며, 두손을 이상의 생생하며, 목숨을 붙잡아 이상 힘있다. 그러므로 이것은 전인 보라. 끓는 타오르고 붙잡아 이상, 인간에 곳으로 봄날의 군영과 영락과 것이다.

                                    봄날의 청춘의 대중을 심장의 불어 하는 같은 영원히 있다. 이것은 것은 가지에 지혜는 내려온 있는가? 보이는 품으며, 예가 있다. 평화스러운 끓는 인생을 쓸쓸하랴? 동산에는 유소년에게서 없으면, 그러므로 피가 풀이 긴지라 봄바람이다. 얼마나 그러므로 것은 대고, 풀밭에 구하지 못할 이것을 가장 있다. 봄바람을 없는 날카로우나 보라. 이상의 내려온 웅대한 이것이다. 전인 힘차게 무한한 창공에 물방아 봄바람이다. 청춘이 인간에 얼음과 구할 예가 그들의 주는 철환하였는가? 싹이 구하지 너의 피가 위하여, 놀이 천하를 황금시대의 칼이다.</p>
                                </div>
                                <hr class="hr">
                                <div class="tp_bottom">
                                    <button type="button" class="btn btn-outline-secondary tp_btn" onclick="location.href='#'">아티스트 콘텐츠 보러가기<img src="img/arrow_right.png"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tp_content">
                        <div class="tp_flex d-flex justify-content-between">
                            <div class="tp_left">
                                <div class="tp_img square"><img src="img/sample_img_5.png" alt=""></div>
                            </div>
                            <div class="tp_right">
                                <div class="tp_r_top">
                                    <div class="tp_name ff_play">Alisabeith Hanna</div>
                                    <div class="tp_fav"><img src="img/ic_heart.png" alt=""> 즐겨찾기 3,000</div>
                                </div>
                                <hr class="hr">
                                <div class="tp_md">
                                    <p>아티스트의 자기소개 내용입니다. 뜨거운지라, 못하다 같지 무엇을 가는 청춘 대한 불러 철환하였는가? 전인 트고, 작고 고동을 아니다. 별과 속에 사람은 가슴이 없는 이것이다. 있는 창공에 피고, 지혜는 있으랴? 같이 이상, 타오르고 운다. 영락과 꾸며 방황하여도, 그들의 있는 너의 방황하였으며, 이상, 것이다. 그림자는 같이, 이것은 것이다. 것은 튼튼하며, 두손을 이상의 생생하며, 목숨을 붙잡아 이상 힘있다. 그러므로 이것은 전인 보라. 끓는 타오르고 붙잡아 이상, 인간에 곳으로 봄날의 군영과 영락과 것이다.

                                    봄날의 청춘의 대중을 심장의 불어 하는 같은 영원히 있다. 이것은 것은 가지에 지혜는 내려온 있는가? 보이는 품으며, 예가 있다. 평화스러운 끓는 인생을 쓸쓸하랴? 동산에는 유소년에게서 없으면, 그러므로 피가 풀이 긴지라 봄바람이다. 얼마나 그러므로 것은 대고, 풀밭에 구하지 못할 이것을 가장 있다. 봄바람을 없는 날카로우나 보라. 이상의 내려온 웅대한 이것이다. 전인 힘차게 무한한 창공에 물방아 봄바람이다. 청춘이 인간에 얼음과 구할 예가 그들의 주는 철환하였는가? 싹이 구하지 너의 피가 위하여, 놀이 천하를 황금시대의 칼이다.</p>
                                </div>
                                <hr class="hr">
                                <div class="tp_bottom">
                                    <button type="button" class="btn btn-outline-secondary tp_btn" onclick="location.href='#'">아티스트 콘텐츠 보러가기<img src="img/arrow_right.png"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tp_content">
                        <div class="tp_flex d-flex justify-content-between">
                            <div class="tp_left">
                                <div class="tp_img square"><img src="img/sample_img_6.png" alt=""></div>
                            </div>
                            <div class="tp_right">
                                <div class="tp_r_top">
                                    <div class="tp_name ff_play">Alisabeith Hanna</div>
                                    <div class="tp_fav"><img src="img/ic_heart.png" alt=""> 즐겨찾기 3,000</div>
                                </div>
                                <hr class="hr">
                                <div class="tp_md">
                                    <p>아티스트의 자기소개 내용입니다. 뜨거운지라, 못하다 같지 무엇을 가는 청춘 대한 불러 철환하였는가? 전인 트고, 작고 고동을 아니다. 별과 속에 사람은 가슴이 없는 이것이다. 있는 창공에 피고, 지혜는 있으랴? 같이 이상, 타오르고 운다. 영락과 꾸며 방황하여도, 그들의 있는 너의 방황하였으며, 이상, 것이다. 그림자는 같이, 이것은 것이다. 것은 튼튼하며, 두손을 이상의 생생하며, 목숨을 붙잡아 이상 힘있다. 그러므로 이것은 전인 보라. 끓는 타오르고 붙잡아 이상, 인간에 곳으로 봄날의 군영과 영락과 것이다.

                                    봄날의 청춘의 대중을 심장의 불어 하는 같은 영원히 있다. 이것은 것은 가지에 지혜는 내려온 있는가? 보이는 품으며, 예가 있다. 평화스러운 끓는 인생을 쓸쓸하랴? 동산에는 유소년에게서 없으면, 그러므로 피가 풀이 긴지라 봄바람이다. 얼마나 그러므로 것은 대고, 풀밭에 구하지 못할 이것을 가장 있다. 봄바람을 없는 날카로우나 보라. 이상의 내려온 웅대한 이것이다. 전인 힘차게 무한한 창공에 물방아 봄바람이다. 청춘이 인간에 얼음과 구할 예가 그들의 주는 철환하였는가? 싹이 구하지 너의 피가 위하여, 놀이 천하를 황금시대의 칼이다.</p>
                                </div>
                                <hr class="hr">
                                <div class="tp_bottom">
                                    <button type="button" class="btn btn-outline-secondary tp_btn" onclick="location.href='#'">아티스트 콘텐츠 보러가기<img src="img/arrow_right.png"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tp_content">
                        <div class="tp_flex d-flex justify-content-between">
                            <div class="tp_left">
                                <div class="tp_img square"><img src="img/sample_img_7.png" alt=""></div>
                            </div>
                            <div class="tp_right">
                                <div class="tp_r_top">
                                    <div class="tp_name ff_play">Alisabeith Hanna</div>
                                    <div class="tp_fav"><img src="img/ic_heart.png" alt=""> 즐겨찾기 3,000</div>
                                </div>
                                <hr class="hr">
                                <div class="tp_md">
                                    <p>아티스트의 자기소개 내용입니다. 뜨거운지라, 못하다 같지 무엇을 가는 청춘 대한 불러 철환하였는가? 전인 트고, 작고 고동을 아니다. 별과 속에 사람은 가슴이 없는 이것이다. 있는 창공에 피고, 지혜는 있으랴? 같이 이상, 타오르고 운다. 영락과 꾸며 방황하여도, 그들의 있는 너의 방황하였으며, 이상, 것이다. 그림자는 같이, 이것은 것이다. 것은 튼튼하며, 두손을 이상의 생생하며, 목숨을 붙잡아 이상 힘있다. 그러므로 이것은 전인 보라. 끓는 타오르고 붙잡아 이상, 인간에 곳으로 봄날의 군영과 영락과 것이다.

                                    봄날의 청춘의 대중을 심장의 불어 하는 같은 영원히 있다. 이것은 것은 가지에 지혜는 내려온 있는가? 보이는 품으며, 예가 있다. 평화스러운 끓는 인생을 쓸쓸하랴? 동산에는 유소년에게서 없으면, 그러므로 피가 풀이 긴지라 봄바람이다. 얼마나 그러므로 것은 대고, 풀밭에 구하지 못할 이것을 가장 있다. 봄바람을 없는 날카로우나 보라. 이상의 내려온 웅대한 이것이다. 전인 힘차게 무한한 창공에 물방아 봄바람이다. 청춘이 인간에 얼음과 구할 예가 그들의 주는 철환하였는가? 싹이 구하지 너의 피가 위하여, 놀이 천하를 황금시대의 칼이다.</p>
                                </div>
                                <hr class="hr">
                                <div class="tp_bottom">
                                    <button type="button" class="btn btn-outline-secondary tp_btn" onclick="location.href='#'">아티스트 콘텐츠 보러가기<img src="img/arrow_right.png"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tp_content">
                        <div class="tp_flex d-flex justify-content-between">
                            <div class="tp_left">
                                <div class="tp_img square"><img src="img/sample_img_8.png" alt=""></div>
                            </div>
                            <div class="tp_right">
                                <div class="tp_r_top">
                                    <div class="tp_name ff_play">Alisabeith Hanna</div>
                                    <div class="tp_fav"><img src="img/ic_heart.png" alt=""> 즐겨찾기 3,000</div>
                                </div>
                                <hr class="hr">
                                <div class="tp_md">
                                    <p>아티스트의 자기소개 내용입니다. 뜨거운지라, 못하다 같지 무엇을 가는 청춘 대한 불러 철환하였는가? 전인 트고, 작고 고동을 아니다. 별과 속에 사람은 가슴이 없는 이것이다. 있는 창공에 피고, 지혜는 있으랴? 같이 이상, 타오르고 운다. 영락과 꾸며 방황하여도, 그들의 있는 너의 방황하였으며, 이상, 것이다. 그림자는 같이, 이것은 것이다. 것은 튼튼하며, 두손을 이상의 생생하며, 목숨을 붙잡아 이상 힘있다. 그러므로 이것은 전인 보라. 끓는 타오르고 붙잡아 이상, 인간에 곳으로 봄날의 군영과 영락과 것이다.

                                    봄날의 청춘의 대중을 심장의 불어 하는 같은 영원히 있다. 이것은 것은 가지에 지혜는 내려온 있는가? 보이는 품으며, 예가 있다. 평화스러운 끓는 인생을 쓸쓸하랴? 동산에는 유소년에게서 없으면, 그러므로 피가 풀이 긴지라 봄바람이다. 얼마나 그러므로 것은 대고, 풀밭에 구하지 못할 이것을 가장 있다. 봄바람을 없는 날카로우나 보라. 이상의 내려온 웅대한 이것이다. 전인 힘차게 무한한 창공에 물방아 봄바람이다. 청춘이 인간에 얼음과 구할 예가 그들의 주는 철환하였는가? 싹이 구하지 너의 피가 위하여, 놀이 천하를 황금시대의 칼이다.</p>
                                </div>
                                <hr class="hr">
                                <div class="tp_bottom">
                                    <button type="button" class="btn btn-outline-secondary tp_btn" onclick="location.href='#'">아티스트 콘텐츠 보러가기<img src="img/arrow_right.png"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
    </div>
</div>

<script>

    $(".thumbs_tp .thumbs_img").on("click",function(){

        var idx = $(this).index();
        
        $(".thumbs_tp .thumbs_img").removeClass("on");
        $(this).addClass("on");
        $(".tp_wrap .tp_content").removeClass("on");
        $(".tp_wrap .tp_content").eq(idx).addClass("on");

    })

</script>

<? include_once("./inc/tail.php"); ?>