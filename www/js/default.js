var eng_num = /[^a-zA-Z0-9_-]/g;
var eng_kor = /[^a-zA-Zㄱ-ㅎ가-힣]/g;
var eng_kor_num = /[^a-zA-Zㄱ-ㅎ가-힣0-9]/g;
var num = /[^0-9]/g;
var eng = /[^a-zA-Z]/g;
var kor = /[ㄱ-ㅎ가-힣]/g;
var email = /[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i; ;
var emailf = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
var password = /^.*(?=.{6,20})(?=.*[0-9])(?=.*[a-zA-Z]).*$/;
var space = /\s/g;

$(document).ready(function () {
	$(document).on("keyup", "input:text[numberOnly]", function() {$(this).val( $(this).val().replace(/[^0-9]/gi,"") );});
	$(document).on("keyup", "input:text[datetimeOnly]", function() {$(this).val( $(this).val().replace(/[^0-9:\-]/gi,"") );});
});

function del(url) {
	if(confirm("정말 삭제하시겠습니까? 삭제된 자료는 복구되지 않습니다.")) {
		hidden_ifrm.location.href = url;
	}
}

function retire(url) {
	if(confirm("정말 탈퇴하시겠습니까?")) {
		hidden_ifrm.location.href = url;
	}
}

function update_confirm(txt, url) {
	if(confirm(txt)) {
		hidden_ifrm.location.href = url;
	}
}

function comma_num(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function setCookie(cName, cValue, cDay) {
	var expire = new Date();
	expire.setDate(expire.getDate() + cDay);
	cookies = cName + '=' + escape(cValue) + '; path=/ ';
	if(typeof cDay != 'undefined') cookies += ';expires=' + expire.toGMTString() + ';';
	document.cookie = cookies;
}

function get_text_length(str, obj) {
	var len = 0;

	for(var i = 0;i < str.length;i++) {
		if(escape(str.charAt(i)).length==6) {
			len++;
		}
		len++;
	}

	if(len>0) {
		$(obj).html(len);
	}

	return false;
}

function f_checkbox_all(obj) {
	$('input:checkbox[name="'+obj+'[]"]').each(function() {
		if($(this).prop('checked')==true) {
			$(this).prop('checked', false);
		} else {
			$(this).prop('checked', true);
		}
	});

	return false;
}

function f_checkbox_all2(obj) {
	$('input:checkbox[id^="'+obj+'"]').each(function() {
		if($("#chk_all").prop("checked") == true) {
			$(this).prop('checked', true);
		} else {
			$(this).prop('checked', false);
		}
	});

	return false;
}

function getCookie(cName) {
	cName = cName + '=';
	var cookieData = document.cookie;
	var start = cookieData.indexOf(cName);
	var cValue = '';
	if(start != -1){
		start += cName.length;
		var end = cookieData.indexOf(';', start);
		if(end == -1)end = cookieData.length;
		cValue = cookieData.substring(start, end);
	}
	return unescape(cValue);
}

function popup(url, wval, hval, tval, lval) {
	window.open(url,'popup','height='+hval+',width='+wval+',top='+tval+',left='+lval+',menubar=no,scrollbars=no,status=yes');
}

function gourl(url){
	if(url!= "") window.open(url);
}

var sel_files = [];

function f_format(format) {
	var html = "<option value='' selected=''>선택</option>";
	if(format == "4K" || format == "FHD" || format == "Drone" || format == "Time lapse" || format == "+6K" || format == "QHD" || format == "HD") {
		html += '<option value="mp4">mp4</option><option value="mov">mov</option>';
	} else if(format == "LUT") {
		html += '<option value="Cube LUT">Cube LUT</option><option value="drx">drx</option><option value="dpx">dpx</option><option value="zip">zip</option>';
	} else if(format == "Transition" || format == "Motion") {
		html += '<option value="prfpset">prfpset</option><option value="mogrt">mogrt</option><option value="zip">zip</option>';
	} else if(format == "Subtitle template") {
		html += '<option value="mogrt">mogrt</option><option value="zip">zip</option><option value="psd">psd</option>';
	} else if(format == "image" || format == "photo") {
		html += '<option value="jpg">jpg</option><option value="jpeg">jpeg</option><option value="png">png</option><option value="raw">raw</option><option value="HEIF">HEIF</option><option value="HEIC">HEIC</option>';
	} else if(format == "2D illustration") {
		html += '<option value="ai">ai</option><option value="eps">eps</option><option value="svg">svg</option><option value="psd">psd</option><option value="indd">indd</option>';
	} else if(format == "3D illustration") {
		html += '<option value="ai">ai</option><option value="eps">eps</option><option value="svg">svg</option><option value="psd">psd</option><option value="indd">indd</option><option value="zip">zip</option>';
	}
	return html;
}
