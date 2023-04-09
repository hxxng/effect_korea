$(document).ready(function(){
    //Date picker
    $( "#datepicker" ).datepicker({
        changeMonth: true,
        dayNames: ['월요일', '화요일', '수요일', '목요일', '금요일', '토요일', '일요일'],
        dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'],
        monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
        monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        showButtonPanel: true,
        currentText: '오늘',
        closeText: '닫기',
        dateFormat: "yy.mm.dd",
        nextText: '다음 달',
        prevText: '이전 달'
    });
    $('#datepicker').datepicker();
    $( "#datepicker2" ).datepicker({
        changeMonth: true,
        dayNames: ['월요일', '화요일', '수요일', '목요일', '금요일', '토요일', '일요일'],
        dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'],
        monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
        monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        showButtonPanel: true,
        currentText: '오늘',
        closeText: '닫기',
        dateFormat: "yy.mm.dd",
        nextText: '다음 달',
        prevText: '이전 달'
    });
    var currentDate = new Date();
    $('#datepicker2').datepicker();

    //라인인풋
    $('.form-group_1 input, .form-group_1 textarea').each(function(){
        
        if( $(this).val() == ''){
            $(this).siblings('label').removeClass('on')
        }else{
            $(this).siblings('label').addClass('on')
        }    
    });        
    
    $('.form-group_1 input, .form-group_1 textarea').focus(function(){
        $(this).siblings('label').addClass('on')
    });
    
    $('.form-group_1 input, .form-group_1 textarea').blur(function(){
        if( $(this).val() == ''){
            $(this).siblings('label').removeClass('on')
        }else{
            
        }
    });
	$('.form-group_1 input, .form-group_1 textarea').keyup(function() {
		$(this).siblings('label').addClass('on');
	});

    //검색어 입력했을때 관련검색어 창 드롭다운
    $('.sch_input').focus(function(){
        if($(this).val() == ''){
            $('.sch_related_wrap').hide();    
        }else{
            $('.sch_related_wrap').show();
        }
    });
    $('.sch_input').keyup(function(){        
        if($(this).val() == ''){
            $('.sch_related_wrap').hide();    
        }else{
            $('.sch_related_wrap').show();
        }
    });
    $('.sch_input').blur(function(){
        $('.sch_related_wrap').hide();
    });

    //사이드 메뉴 클릭이벤트
    $('.btn_sideMenu').on('click',function(){
        $('.sideMenu_wrap').fadeIn();
        $('.sideMenu_wrap .dimmed').fadeIn();
        $('.sideMenu').stop().animate({
            'right':0
        });
        $('.sideMenu .closed').on('click',function(){
            $('.sideMenu_wrap').fadeOut();
            $('.sideMenu_wrap .dimmed').fadeOut();
            $('.sideMenu').stop().animate({
                'right':-$('.sideMenu').outerWidth()
            }); 
        });
        $('.sideMenu_wrap .dimmed').on('click',function(){
            $('.sideMenu_wrap').fadeOut();
            $(this).fadeOut();
            $('.sideMenu').stop().animate({
                'right':-$('.sideMenu').outerWidth()
            }); 
        });

    });

    //사이드메뉴 2차메뉴 오픈
    $('.btn_submenu').on('click',function(){
        $(this).toggleClass('on')
    });
    

    //휴대폰 번호 입력 후 다음으로 포커싱
    $(".phoneNum_input_first").on("change", function(){
        $(this).next('.phoneNum_input_middle').focus();
    });
    $('.input_phoneNum input').keyup (function () {
        var charLimit = $(this).attr("maxlength");
        console.log(charLimit);
        if (this.value.length >= charLimit) {
            console.log(this.value.length);
            $(this).next('.phoneNum_input_end').focus();
            return false;
        }
    });

	//헤더 투명
	if($(window).scrollTop() < 50){
		$(".mobile_mainheader_wrap, .header_wrap").css({
			'background-color':'rgba(18,18,18,0)'
		});
	}else{
		$(".mobile_mainheader_wrap, .header_wrap").css({
			'background-color':'rgba(18,18,18,1)'
		});
	}
	$(window).scroll(function(){
		if($(window).scrollTop() < 50){
			$(".mobile_mainheader_wrap, .header_wrap").css({
				'background-color':'rgba(18,18,18,0)'
			});
		}else{
			$(".mobile_mainheader_wrap, .header_wrap").css({
				'background-color':'rgba(18,18,18,1)'
			});
		}
	});


    //스크롤 내리면 헤더 숨김(모바일은 적용x)
    $(function(){
        let didScroll;
        let lastScrollTop = 0;
        let delta = 5;
        let navbarHeight = $('.header_wrap').outerHeight();

        $(window).scroll(function(){
            didScroll = true;
        });

        setInterval(function(){
            if (didScroll){
                hasScrolled();
                didScroll = false;
            }
        },250);

        function hasScrolled(){
            var st = $(this).scrollTop();
            if($(window).width() > 991){
                if(Math.abs(lastScrollTop - st) <= delta ){
                    return;
                }if(st > lastScrollTop && st > navbarHeight){
                    $('.header_wrap').slideUp('fast');
                }else{
                    if(st + $(window).height() < $(document).height()){
                        $('.header_wrap').slideDown('fast');
                    }
                }
                lastScrollTop = st;
            }
        }
    });
});
