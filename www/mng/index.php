<?
	include "./head_inc.php";
	$chk_menu = '11';
	include "./head_menu_inc.php";
?>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<div class="content-wrapper">
    <form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" onsubmit="return frm_search_chk(this);">
            <li class="list-group-item">
                <div class="form-group row align-items-center mb-0">
                    <label for="pt_option_chk" class="col-sm-1 col-form-label">검색기간</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            <div class="btn-group mr-4" role="group" aria-label="select_category">
                                <button type="button" onclick="f_order_search_date_range('4', '<?=date('Y-m-d', strtotime("-6 days"))?>', '<?=date('Y-m-d')?>');" id="f_order_search_date_range4" class="btn btn-outline-secondary btn-sm c_pt_selling_date_range">7일</button>
                                <button type="button" onclick="f_order_search_date_range('5', '<?=date('Y-m-d', strtotime("-14 days"))?>', '<?=date('Y-m-d')?>');" id="f_order_search_date_range5" class="btn btn-outline-secondary btn-sm c_pt_selling_date_range">15일</button>
                                <button type="button" onclick="f_order_search_date_range('6', '<?=date('Y-m-d', strtotime("-29 days"))?>', '<?=date('Y-m-d')?>');" id="f_order_search_date_range6" class="btn btn-outline-secondary btn-sm c_pt_selling_date_range">30일</button>
                                <button type="button" onclick="f_order_search_date_range('7', '<?=date('Y-m-d', strtotime("-59 days"))?>', '<?=date('Y-m-d')?>');" id="f_order_search_date_range7" class="btn btn-outline-secondary btn-sm c_pt_selling_date_range">60일</button>
                                <button type="button" onclick="f_order_search_date_range('8', '<?=date('Y-m-d', strtotime("-89 days"))?>', '<?=date('Y-m-d')?>');" id="f_order_search_date_range8" class="btn btn-outline-secondary btn-sm c_pt_selling_date_range">90일</button>
                                <button type="button" onclick="f_order_search_date_range('9', '<?=date('Y-m-d', strtotime("-119 days"))?>', '<?=date('Y-m-d')?>');" id="f_order_search_date_range9" class="btn btn-outline-secondary btn-sm c_pt_selling_date_range">120일</button>
                            </div>
                            <input type="date" name="sel_search_sdate" id="sel_search_sdate" value="<?=$_GET['sel_search_sdate']?>" class="form-control datepicker" /> <span class="m-2">~</span> <input type="date" name="sel_search_edate" id="sel_search_edate" value="<?=$_GET['sel_search_edate']?>" class="form-control" />
                            <input type="submit" class="btn btn-primary ml-2" id="search_btn" value="검색" />
                        </div>
                    </div>
                </div>
            </li>
        <p>&nbsp;</p>
    </form>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">일일방문자</h4>
                    <div id="chartContainer1" style="height: 300px; width: 100%;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">회원가입수</h4>
                    <div id="chartContainer2" style="height: 300px; width: 100%;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">각 회원권 구독횟수</h4>
                    <div id="chartContainer3" style="height: 300px; width: 100%;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">콘텐츠 판매 매출</h4>
                    <div id="chartContainer4" style="height: 300px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function frm_search_chk(f) {
        init();
    }
    $(document).ready(function(){
        init();
    });

    function init(){
        chart1();
        chart2();
        chart3();
        chart4();
    }

    function getToday(){
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);

        var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

        return today;
    }

    function get_visitor_cnt(){
        var data = "";
        $.ajax({
            type: 'post',
            url: './ajax.index.php',
            dataType: 'json',
            async: false,
            data: {type: 'get_visitor_cnt', sdate: $("#sel_search_sdate").val(), edate: $("#sel_search_edate").val()},
            success: function (d, s) {
                if (d['result'] == "_ok") {
                    data = d['data'];
                }
            },
            cache: false
        });
        return data;
    }

    function get_join_cnt(){
        var data = "";
        $.ajax({
            type: 'post',
            url: './ajax.index.php',
            dataType: 'json',
            async: false,
            data: {type: 'get_join_cnt', sdate: $("#sel_search_sdate").val(), edate: $("#sel_search_edate").val()},
            success: function (d, s) {
                if (d['result'] == "_ok") {
                    data = d['data'];
                }
            },
            cache: false
        });
        return data;
    }

    function get_buy_cnt(){
        var data = "";
        $.ajax({
            type: 'post',
            url: './ajax.index.php',
            dataType: 'json',
            async: false,
            data: {type: 'get_buy_cnt'},
            success: function (d, s) {
                if (d['result'] == "_ok") {
                    data = d['data'];
                }
            },
            cache: false
        });
        return data;
    }

    function get_ot_price(){
        var data = "";
        $.ajax({
            type: 'post',
            url: './ajax.index.php',
            dataType: 'json',
            async: false,
            data: {type: 'get_ot_price'},
            success: function (d, s) {
                if (d['result'] == "_ok") {
                    data = d['data'];
                }
            },
            cache: false
        });
        return data;
    }

    function chart1() {
        var data = get_visitor_cnt();
        var chart1 = new CanvasJS.Chart("chartContainer1", {
            type: "column",
            legend: {
                horizontalAlign: "right", // left, center ,right
                verticalAlign: "top",  // top, center, bottom
                fontSize: 15,
            },
            dataPointWidth: 30,
            axisY:{
                gridThickness: 0,
                includeZero: true,
                valueFormatString: "#,##0.##",
                suffix: "명",
            },
            animationEnabled: true,
            data: [
                {
                    color: "#f2a8c3",
                    type: "column",
                    toolTipContent: "<span style='\"'color: {color};'\"'>{label}</span> : <strong>{y}명</strong>",
                    dataPoints: data
                }
            ]
        });
        chart1.render();
    }

    function chart2() {
        var data = get_join_cnt();
        var chart2 = new CanvasJS.Chart("chartContainer2", {
            type: "column",
            legend: {
                horizontalAlign: "right", // left, center ,right
                verticalAlign: "top",  // top, center, bottom
                fontSize: 15,
            },
            dataPointWidth: 30,
            axisY:{
                gridThickness: 0,
                includeZero: true,
                valueFormatString: "#,##0.##",
                suffix: "명",
            },
            animationEnabled: true,
            data: [
                {
                    color: "#3fc0f0",
                    type: "column",
                    toolTipContent: "<span style='\"'color: {color};'\"'>{label}</span> : <strong>{y}명</strong>",
                    dataPoints: data
                }
            ]
        });
        chart2.render();
    }

    function chart3() {
        var data = get_buy_cnt();
        var chart3 = new CanvasJS.Chart("chartContainer3", {
            type: "column",
            legend: {
                horizontalAlign: "right", // left, center ,right
                verticalAlign: "top",  // top, center, bottom
                fontSize: 15,
            },
            dataPointWidth: 30,
            axisY:{
                gridThickness: 0,
                includeZero: true,
                valueFormatString: "#,##0.##",
                suffix: "건",
            },
            animationEnabled: true,
            data: [
                {
                    color: "#f2a8c3",
                    type: "column",
                    toolTipContent: "<span style='\"'color: {color};'\"'>{label}</span> : <strong>{y}건</strong>",
                    dataPoints: data
                }
            ]
        });
        chart3.render();
    }

    function chart4() {
        var data = get_ot_price();
        var chart4 = new CanvasJS.Chart("chartContainer4", {
            type: "column",
            legend: {
                horizontalAlign: "right", // left, center ,right
                verticalAlign: "top",  // top, center, bottom
                fontSize: 15,
            },
            dataPointWidth: 30,
            axisY:{
                gridThickness: 0,
                includeZero: true,
                valueFormatString: "#,##0.##",
                suffix: "원",
            },
            animationEnabled: true,
            data: [
                {
                    color: "#3fc0f0",
                    type: "column",
                    toolTipContent: "<span style='\"'color: {color};'\"'>{label}</span> : <strong>{y}원</strong>",
                    dataPoints: data
                }
            ]
        });
        chart4.render();
    }

</script>
<!-- 메인 끝 -->
<?
	include "./foot_inc.php";
?>