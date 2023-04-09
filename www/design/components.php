<?php
include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
	<div class="square rectangle" style="width:400px">
		<video class="video_item" muted mute loop autoplay controls playsinline>
			<source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
		</video>
	</div>
    <!-- <div class="container-fluid px-0">
        <div class="row no-gutters">
            <div class="col-12">                
                <video class="video_item" muted loop autoplay controls >
                    <source src='img/video_main_compressed.mp4' type='video/mp4'/>
                    <source src='img/video_main_compressed.webm' type='video/webm'/>
                </video>
            </div>
        </div>
    </div> -->
    <div class="container">    
        <div class="row">          
            <div class="col-12 my-5">				
                <!-- <figure class="ic_glass_wrap">
                    <img src="img/triangle.png" style="bottom:20px; left:-20px;">
                    <div class="ic_glass"></div>
                </figure>
                <figure class="ic_glass_wrap ic_glass_wrap_sm">
                    <img src="img/ic_chart.png">
                    <div class="ic_glass"></div>
                </figure> -->

                <h3 class="d-block my-5 text-primary">썸네일</h3>   
                <!-- video_list 의 style="width:500px"은 지우고 사용해주세요.-->
                <div class="video_list square rectangle" style="width:500px">
                    <h4 class="d-block mt-5 mb-3 text-white-50">썸네일 비율로 줄어듬 .square.rectangle</h4>
                        
                    <img src="img/img_sample_1.jpg">
                    <video class="video_item" muted loop>
                        <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                    </video>                        
                </div>          
                <div class="video_list square" style="width:500px">
                    <h4 class="d-block mt-5 mb-3 text-white-50">정방형 비율로 줄어듬 .square</h4>
                    <img src="img/img_sample_1.jpg">
                    <video class="video_item" muted loop>
                        <source src='https://upload.wikimedia.org/wikipedia/commons/transcoded/1/1c/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm/Joy_%26_Heron_-_Animated_CGI_Spot_by_Passion_Pictures.webm.480p.vp9.webm' type='video/mp4'/>
                    </video>                        
                </div>
            </div>
            <div class="col-12 my-5">
                <h3 class="d-block my-5 text-primary">줄바꿈</h3>
                <h4 class="d-block mt-5 mb-3 text-white-50">줄바꿈 한 줄</h4>
                <p class="text_hidden">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias ea nemo veniam facere illum? Ipsum animi tenetur placeat modi reprehenderit nemo id cum esse. Nesciunt explicabo quam veritatis earum eius.</p>
                
                <h4 class="d-block mt-5 mb-3 text-white-50">줄바꿈 두 줄</h4>
                <p class="text_hidden2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias ea nemo veniam facere illum? Ipsum animi tenetur placeat modi reprehenderit nemo id cum esse. Nesciunt explicabo quam veritatis earum eius. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vitae ratione quasi earum ipsa officia nulla perferendis esse dolorem fugit sunt tempora modi, aliquam cum obcaecati fuga illo rerum error facere.</p>

            </div>
            <div class="col-12 my-5">
                <h3 class="d-block my-5 text-primary">팝업</h3>
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_sm">팝업 스몰</button>
                <!-- Modal -->
                <div class="modal fade" id="modal_sm" tabindex="-1" >
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-sm">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
                                <img src="img/ic_x.png" alt="닫기">
                            </button>
                        </div>
                        <div class="modal-body">
                            <lottie-player src="img/lottie_success.json" loop autoplay style="width:156px; margin:0 auto;"></lottie-player>
                            <lottie-player src="img/lottie_warning.json" loop autoplay style="width:156px; margin:0 auto;" speed="2"></lottie-player>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">닫기</button>
                            <button type="button" class="btn btn-primary">확인</button>
                        </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_md">팝업 미디엄</button>
                <!-- Modal -->
                <div class="modal fade" id="modal_md" >
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-md">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">팝업 미디엄</h5>
                            <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
                                <img src="img/ic_x.png" alt="닫기">
                            </button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">닫기</button>
                            <button type="button" class="btn btn-primary">확인</button>
                        </div>
                        </div>
                    </div>
                </div>
                
            </div>   
            <div class="col-12 my-5">
                <h3 class="d-block my-5 text-primary">타이틀</h3>

                <h1 class="h1">h1</h1>
                <h2 class="h2">h2</h2>
                <h3 class="h3">h3</h3>
                <h4 class="h4">h4</h4>
                <h5 class="h5">h5</h5>
                <h6 class="h6">h6</h6>
            </div>
            <div class="col-12 my-5">
                <h3 class="d-block my-5 text-primary">폰트 패밀리</h3>
                <p>기본 폰트 <b>프리텐다드</b></p>
                <p class="ff_play">
                    Play 폰트 <b>.ff_play</b>
                </p>                
            </div>
            <div class="col-12 my-5">
                <h3 class="d-block my-5 text-primary">구분선</h3>
                <hr class="hr">
            </div>
            <div class="col-12 my-5">
                <h3 class="d-block my-5 text-primary">폰트 두께</h3>
                <p class="fw_100">.fw_100</p>
                <p class="fw_200">.fw_200</p>
                <p class="fw_300">.fw_300</p>
                <p class="fw_400">.fw_400</p>
                <p class="fw_500">.fw_500</p>
                <p class="fw_600">.fw_600</p>
                <p class="fw_700">.fw_700</p>
                <p class="fw_800">.fw_800</p>
                <p class="fw_900">.fw_900</p>
            </div>
            <div class="col-12 my-5">
                <h3 class="d-block my-5 text-primary">폰트 사이즈</h3>
                <p class="fs_8">.fs_8</p>
                <p class="fs_9">.fs_9</p>
                <p class="fs_10">.fs_10</p>
                <p class="fs_11">.fs_11</p>
                <p class="fs_12">.fs_12</p>
                <p class="fs_13">.fs_13</p>
                <p class="fs_14">.fs_14</p>
                <p class="fs_15">.fs_15</p>
                <p class="fs_16">.fs_16</p>
                <p class="fs_17">.fs_17</p>
                <p class="fs_18">.fs_18</p>
                <p class="fs_19">.fs_19</p>
                <p class="fs_20">.fs_20</p>
                <p class="fs_21">.fs_21</p>
                <p class="fs_22">.fs_22</p>
                <p class="fs_23">.fs_23</p>
                <p class="fs_24">.fs_24</p>
                <p class="fs_25">.fs_25</p>
                <p class="fs_26">.fs_26</p>
                <p class="fs_27">.fs_27</p>
                <p class="fs_28">.fs_28</p>
                <p class="fs_29">.fs_29</p>
                <p class="fs_30">.fs_30</p>
                <p class="fs_31">.fs_31</p>
                <p class="fs_32">.fs_32</p>
                <p class="fs_33">.fs_33</p>
                <p class="fs_34">.fs_34</p>
                <p class="fs_35">.fs_35</p>
                <p class="fs_36">.fs_36</p>
                <p class="fs_37">.fs_37</p>
                <p class="fs_38">.fs_38</p>
                <p class="fs_39">.fs_39</p>
                <p class="fs_40">.fs_40</p>
                <p class="fs_41">.fs_41</p>
                <p class="fs_42">.fs_42</p>
                <p class="fs_43">.fs_43</p>
                <p class="fs_44">.fs_44</p>
                <p class="fs_45">.fs_45</p>
                <p class="fs_46">.fs_46</p>
                <p class="fs_47">.fs_47</p>
                <p class="fs_48">.fs_48</p>
                <p class="fs_49">.fs_49</p>
                <p class="fs_50">.fs_50</p>
                <p class="fs_51">.fs_51</p>
                <p class="fs_52">.fs_52</p>
            </div>
            <div class="col-12 my-5">
                <h3 class="d-block my-5 text-primary">폰트 컬러</h3>
                <span class="fc_gray">fc_gray</span>
                <span class="fc_dgray">fc_dgray</span>
                <span class="fc_rd">fc_rd</span>
                <span class="fc_blue1">fc_blue1</span>
                
            </div>
            <div class="col-12 my-5">
                <h3 class="d-block my-5 text-primary">버튼</h3>
                <h4 class="d-block mt-5 mb-3 text-white-50">버튼 기본</h4>
                <button type="button" class="btn btn-primary">Primary</button>
                <button type="button" class="btn btn-secondary">Secondary</button>
                <button type="button" class="btn btn-success">Success</button>
                <button type="button" class="btn btn-danger">Danger</button>
                <button type="button" class="btn btn-warning">Warning</button>
                <button type="button" class="btn btn-info">Info</button>
                <button type="button" class="btn btn-light">Light</button>
                <button type="button" class="btn btn-dark">Dark</button>
                <button type="button" class="btn btn-link">Link</button>

                <h4 class="d-block mt-5 mb-3 text-white-50">버튼 아웃라인</h4>
                <button type="button" class="btn btn-outline-primary">Primary</button>
                <button type="button" class="btn btn-outline-secondary">Secondary</button>
                <button type="button" class="btn btn-outline-success">Success</button>
                <button type="button" class="btn btn-outline-danger">Danger</button>
                <button type="button" class="btn btn-outline-warning">Warning</button>
                <button type="button" class="btn btn-outline-info">Info</button>
                <button type="button" class="btn btn-outline-light">Light</button>
                <button type="button" class="btn btn-outline-dark">Dark</button>


                <h4 class="d-block mt-5 mb-3 text-white-50">버튼 스몰</h4>
                <button type="button" class="btn btn-primary btn-sm">Small button</button>
                <button type="button" class="btn btn-secondary btn-sm">Small button</button>

                <h4 class="d-block mt-5 mb-3 text-white-50">버튼 라지</h4>
                <button type="button" class="btn btn-primary btn-lg">Large button</button>
                <button type="button" class="btn btn-secondary btn-lg">Large button</button>
            </div>
            <div class="col-12 my-5">
                <h3 class="d-block my-5 text-primary">리스트 스타일</h3>
                <h4 class="d-block mt-5 mb-3 text-white-50">스타일1</h4>
                <ul class="list_style_1">
                    <li>
                        <span>답변 받으실 이메일</span>
                        <p>hong123@email.com</p>
                    </li>
                    <li>
                        <span>답변 받으실 이메일</span>
                        <p>hong123@email.com</p>
                    </li>
                    <li>
                        <span>답변 받으실 이메일</span>
                        <p>hong123@email.com</p>
                    </li>
                    <li>
                        <span>답변 받으실 이메일</span>
                        <p>hong123@email.com</p>
                    </li>
                    <li>
                        <span>답변 받으실 이메일</span>
                        <p>hong123@email.com</p>
                    </li>
                </ul>

            </div>
            <div class="col-12 my-5">
                <h3 class="d-block my-5 text-primary">폼</h3>
                <form>
                    <h4 class="d-block mt-5 mb-3 text-white-50">인풋 텍스트 라인</h4>
                    <div class="form-group form-group_1">
                        <label for="extInput">이메일<span class="hide_text">입력</span></label>
                        <input type="text" class="form-control" id="textInput">
                        <small class="form-text text-danger"><img class="mr-2" src="img/ic_label_danger.png">5~15자의 영문 소문자, 숫자로만 입력해 주세요.</small>
                        <small class="form-text text-warning"><img class="mr-2" src="img/ic_label_warning.png">1,000원이상 200,000원 이하로 입력해 주세요.</small>
                        <small class="form-text text-success"><img class="mr-2" src="img/ic_label_success.png">확인되었습니다.</small>
                    </div>

                    <h4 class="d-block mt-5 mb-3 text-white-50">셀렉트 라인</h4>                    
                    <div class="form-group form-group_1">                        
                        <select class="form-control" id="exampleFormControlSelect1" aria-placeholder="선택해주세요.">
                            <option value="" disabled selected>선택하세요.</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>  

                    <h4 class="d-block mt-5 mb-3 text-white-50">텍스트area 라인</h4>
                    <div class="form-group form-group_1">
                        <label for="extInput">이메일<span class="hide_text">입력</span></label>
                        <textarea class="form-control"></textarea>
                        <small class="form-text text-danger"><img class="mr-2" src="img/ic_label_danger.png">5~15자의 영문 소문자, 숫자로만 입력해 주세요.</small>
                        <small class="form-text text-warning"><img class="mr-2" src="img/ic_label_warning.png">1,000원이상 200,000원 이하로 입력해 주세요.</small>
                        <small class="form-text text-success"><img class="mr-2" src="img/ic_label_success.png">확인되었습니다.</small>
                    </div>

                    <h4 class="d-block mt-5 mb-3 text-white-50">인풋 텍스트</h4>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="text" class="form-control" placeholder="이메일 입력">
                        <small class="form-text text-danger"><img class="mr-2" src="img/ic_label_danger.png">5~15자의 영문 소문자, 숫자로만 입력해 주세요.</small>
                        <small class="form-text text-warning"><img class="mr-2" src="img/ic_label_warning.png">1,000원이상 200,000원 이하로 입력해 주세요.</small>
                        <small class="form-text text-success"><img class="mr-2" src="img/ic_label_success.png">확인되었습니다.</small>
                    </div>
                    

                    <h4 class="d-block mt-5 mb-3 text-white-50">텍스트 area</h4>
                    <div class="form-group">
                        <label>입력창</label>
                        <textarea class="form-control" placeholder="텍스트 입력"></textarea>
                        <small class="form-text text-danger"><img class="mr-2" src="img/ic_label_danger.png">5~15자의 영문 소문자, 숫자로만 입력해 주세요.</small>
                        <small class="form-text text-warning"><img class="mr-2" src="img/ic_label_warning.png">1,000원이상 200,000원 이하로 입력해 주세요.</small>
                        <small class="form-text text-success"><img class="mr-2" src="img/ic_label_success.png">확인되었습니다.</small>
                    </div>

                    <h4 class="d-block mt-5 mb-3 text-white-50">인풋 텍스트 에러</h4>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="text" class="form-control border-danger" placeholder="이메일 입력">
                        <small class="form-text text-danger"><img class="mr-2" src="img/ic_label_danger.png">5~15자의 영문 소문자, 숫자로만 입력해 주세요.</small>
                        <small class="form-text text-warning"><img class="mr-2" src="img/ic_label_warning.png">1,000원이상 200,000원 이하로 입력해 주세요.</small>                        
                    </div>
                    <h4 class="d-block mt-5 mb-3 text-white-50">인풋 라지 텍스트</h4>
                    <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg">
                    
                    <h4 class="d-block mt-5 mb-3 text-white-50">인풋 스몰 텍스트</h4>                    
                    <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm">
                    
                    <h4 class="d-block mt-5 mb-3 text-white-50">인풋 텍스트 readonly</h4>
                    <input class="form-control" type="text" placeholder="Readonly input here..." readonly>
                    
                    <h4 class="d-block mt-5 mb-3 text-white-50">셀렉트</h4>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Example select</label>
                        <select class="form-control" id="exampleFormControlSelect1" aria-placeholder="선택해주세요.">
                        <option value="" disabled selected>선택하세요.</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        </select>
                    </div>                    
                    <h3 class="d-block my-5 text-primary">날짜</h3>                   
                    <section class="calendar_wrap">
                        <div class="form-group calendar">
                            <input type="text" class="form-control" id="datepicker" placeholder="yyyy.mm.dd">
                            <i class="ic_calendar"><img src="img/ic_calendar.png" alt="캘린더"></i>
                        </div>
                        <span class="px-1 pt-n05">~</span>
                        <div class="form-group calendar">
                            <input type="text" class="form-control" id="datepicker2" placeholder="yyyy.mm.dd">
                            <i class="ic_calendar"><img src="img/ic_calendar.png" alt="캘린더"></i>
                        </div>
                    </section>
                    
                    <h3 class="d-block my-5 text-primary">체크박스</h3>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            <div class="chkbox">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            Default checkbox
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" disabled>
                        <label class="form-check-label" for="defaultCheck2">
                            <div class="chkbox">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            Disabled checkbox
                        </label>
                    </div>

                    <div class="form-check">
                        <h3 class="d-block my-5 text-primary">라디오</h3>
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            <div class="chkbox radio">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            Default radio
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                        <label class="form-check-label" for="exampleRadios2">
                            <div class="chkbox radio">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            Second default radio
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" disabled>
                        <label class="form-check-label" for="exampleRadios3">
                            <div class="chkbox radio">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            Disabled radio
                        </label>
                    </div>
                </form>
            </div>
            <div class="col-12 my-5">
                <h3 class="d-block my-5 text-primary">페이지네이션</h3>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li>
                    </ul>
                </nav>             
            </div>
            <div class="col-12 my-5">
                <h3 class="d-block my-5 text-primary">badge</h3>
                <span class="badge badge-primary">Primary</span>
                <span class="badge badge-secondary">Secondary</span>
                <span class="badge badge-success">Success</span>
                <span class="badge badge-danger">Danger</span>
                <span class="badge badge-warning">Warning</span>
                <span class="badge badge-info">Info</span>
                <span class="badge badge-light">Light</span>
                <span class="badge badge-dark">Dark</span>
            </div>
        </div>
    </div>
</div>
<? include_once("./inc/tail.php"); ?>