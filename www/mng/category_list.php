<?php
include "./head_inc.php";
$chk_menu = '1';
$chk_sub_menu = '2';
include "./head_menu_inc.php";

$_get_txt = "pg=";

$n_limit = $n_limit_num = 15;
$pg = $_GET['pg'];
$_colspan_txt = "5";

$query = "
    select *, a1.idx as ct_idx from category_t a1
";
$query_count = "
    select count(*) from category_t a1
";

$row_cnt = $DB->fetch_query($query_count);
$couwt_query = $row_cnt[0];
$counts = $couwt_query;
$n_page = ceil($couwt_query / $n_limit_num);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;
$counts = $counts - (($pg - 1) * $n_limit_num);

unset($list);
$sql_query = $query." order by IF(ISNULL(ct_p_idx),  idx, ct_p_idx), ct_level, ct_orderby limit ".$n_from.", ".$n_limit;
$list = $DB->select_query($sql_query);
?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">카테고리 관리</h4>
                        <div class="card-description float-right">
                            <input type="button" class="btn btn-info" value="신규등록" onclick="f_view_category('', 'new')"/>
                        </div>
                        <p class="card-description">
                            LEVEL : 1차분류(0), 2차분류(1)<br />
                            카테고리 분류 삭제시 하위 분류 포함 한 콘텐츠 전체 삭제 및 노출되지 않으니 주의바랍니다.
                        </p>

                        <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th style="width: 40%">
                                카테고리명
                            </th>
                            <th class="text-center">
                                LEVEL
                            </th>
                            <th class="text-center">
                                출력순위
                            </th>
                            <th class="text-center" style="width: 20%">
                                관리
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            if($list) {
                                foreach($list as $row) {
                        ?>
                        <tr>
                            <td style="<? if($row['pc_depth'] == 1) { echo 'text-indent:30px;'; } if($row['pc_depth'] == 2) { echo 'text-indent:70px;'; } ?>" >
                                <? if($row['ct_level'] > 0) { echo '└'; }?>
                                <?=$row['ct_name']?>
                            </td>
                            <td class="text-center">
                                <?=$row['ct_level']?>
                            </td>
                            <td class="text-center">
                                <?=$row['ct_orderby']?>
                            </td>
                            <td class="text-center">
                                <?
                                if($row['ct_level'] == 0) {
                                ?>
                                <input type="button" class="btn btn-outline-info btn-sm" value="추가" onclick="f_view_category('<?=$row['ct_idx'];?>', 'write')" />
                                <?
                                }
                                ?>
                                <input type="button" class="btn btn-outline-primary btn-sm" value="수정" onclick="f_view_category('<?=$row['ct_idx'];?>', 'update')" />
                                <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="product_category_del('<?php echo $row['idx'];?>');" />
                            </td>
                        </tr>
                        <?
                                    $counts--;
                                }
                            } else {
                        ?>
                        <tr>
                            <td colspan="<?=$_colspan_txt?>" class="text-center"><b>자료가 없습니다.</b></td>
                        </tr>
                        <?
                            }
                        ?>
                        </tbody>
                        </table>
                        <?
                            if($n_page>1) {
                                echo page_listing($pg, $n_page, $_SERVER['PHP_SELF']."?".$_get_txt);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
$(document).ready(function() {
    $('select[name=pc_view').on('change', function(e) {		//컨텐츠 카테고리 노출여부 변경
        var pc_view = $(this).val();
        var pc_idx = $(this).parent().parent().find('#chk_all').val();
        $.ajax({
            type : 'post',
            url : './ajax.product.php',
            dataType : 'json',
            data : { act : 'pc_view', pc_view : pc_view, pc_idx : pc_idx},
            success : function(d, s){
                alert(d.msg);
            },
            cache : false
        });
    });
});

function product_category_del(idx){	//컨텐츠 카테고리 삭제
	if(confirm("정말로 삭제 시겠습니까?")) {
		$.ajax({
            type : 'post',
            url : './ajax.product.php',
            dataType : 'json',
            data : { act : 'pc_del', pc_idx : idx},
            success : function(d, s){
                alert(d.msg);
                if(d.result=='_ok')	location.reload();
            },
            cache : false
        });
	}
}

function product_category_update(){		//컨텐츠 카테고리 등록 및 수정
    if($("#ct_name_m").val() == "" || $("#ct_orderby_m").val() == "") {
        alert("필수값을 입력해주세요.");
        return false;
    }
	$.ajax({
		type : 'post',
		url : './ajax.product.php',
		dataType : 'json',
		data : $("form[name=f_product_category]").serialize(),
		success : function(d, s){
			alert(d.msg);
			if(d.result=='_ok')	location.reload();
		},
		cache : false
	});
}

function f_view_category(idx, act, depth){		//모달창
	$.post('./ajax.product.php', {type: 'pc_modal', idx: idx, act:act}, function (data) {
	if(data){
			$('#modal-default-content').html(data);
			$('#modal-default-size').css('max-width', '500px');
			$('#modal-default').addClass('modal-dialog-centered');
			$('#modal-default').addClass('modal-dialog-scrollable');
			$('#modal-default').modal();			
		}
	});
	return false;
}

</script>
<?
	include "./foot_inc.php";
?>