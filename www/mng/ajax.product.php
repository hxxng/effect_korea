<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

if($_POST['act']=='change_status'){	//상품 상태값 변경 
	$DB->update_query('product_t', array('pt_sale_now'=>$_POST['pt_sale_now']),  "idx='".$_POST['idx']."'");
	echo json_encode(array('result' => '_ok', 'msg'=>'변경 되었습니다.'));	
}

if($_POST['act']=='pc_view'){  //카테고리 노출 상태값 변경
    $DB->update_query('product_category_t', array('pc_view'=>$_POST['pc_view']), "idx='".$_POST['pc_idx']."'");
    echo json_encode(array('result' => '_ok', 'msg'=>'변경 되었습니다.'));
}

if($_POST['act']=='pc_del'){   //카테고리 삭제
    if($_POST['pc_idx']) {
        $DB->del_query('category_t', 'idx = '.$_POST['pc_idx']);
        $DB->del_query('category_t', 'ct_p_idx = '.$_POST['pc_idx']);
        echo json_encode(array('result' => '_ok', 'msg'=>'삭제되었습니다.'));
    } else {
        echo json_encode(array('result' => 'false', 'msg'=>'삭제할 수 없습니다.'));
    }
}

if($_POST['act']=='pc_update'){    //등록 및 수정
    if(!$_POST['ct_name_m'] || !$_POST['ct_orderby_m']){
        echo json_encode(array('result' => '_false', 'msg'=>'빈값이 있습니다.'));
        exit;    
    }

    if($_POST['ct_idx_m']){
        $where_is = " idx !='".$_POST['ct_idx_m']."' and (ct_name='".$_POST['ct_name_m']."')";

        $row = $DB->fetch_assoc("select * from category_t where idx = ".$_POST['ct_idx_m']);
    }else{
        $where_is = " (ct_name='".$_POST['ct_name_m']."')";
    }
    $count = $DB->fetch_query("select count(0) as cnt from category_t where ".$where_is);
    if($count['cnt']> 0 ) {
        echo json_encode(array('result' => '_false', 'msg'=>'중복된 이름이 있습니다.'));
        exit;    
    }

    $set_arr = array(
        'ct_name' => $_POST['ct_name_m'],
        'ct_orderby' => $_POST['ct_orderby_m'],
    );
    if($_POST['act2'] == "write") {
        $set_arr['ct_p_idx'] = $_POST['ct_idx_m'];
    }

    if($_POST['act2'] == "update"){
        $set_arr['ct_udate'] = "now()";
        $DB->update_query('category_t', $set_arr, "idx='".$_POST['ct_idx_m']."'");
    }else{
        if($_POST['ct_idx_m']) {
            $set_arr['ct_level'] = 1;
        } else {
            $set_arr['ct_level'] = 0;
        }
        $set_arr['ct_wdate'] = "now()";
        $DB->insert_query('category_t', $set_arr);
    }
    echo json_encode(array('result' => '_ok', 'msg'=>'저장되었습니다.'));
}
if($_POST['type']=='pc_modal'):  //모달 창
    if($_POST['idx']) $row = $DB->fetch_query("select * from category_t where idx='".$_POST['idx']."'");
    if($_POST['act'] == "new") {
        $title = "신규등록";
    } else if($_POST['act'] == "write") {
        $title = "추가";
    } else {
        $title = "수정";
    }
?>
	<div class="modal-header">
		<h5 class="modal-title" id="staticBackdropLabel"><?=$title?></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
    <form name="f_product_category">
    <input type="hidden" name="act" value="pc_update">
	<input type="hidden" name="act2" value="<?=$_POST['act']?>" />
	<input type="hidden" name="ct_idx_m" id="ct_idx_m" value="<?=$row['idx']?>" />
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <div class="form-group row align-items-center mb-0">
                    <label class="col-sm-4 col-form-label">카테고리명 <i class="mdi mdi-circle-medium text-danger"></i></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="ct_name_m" id="ct_name_m" value="<? if($_POST['act'] != "write" && $_POST['act'] != "new") echo $row['ct_name']?>">
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-group row align-items-center mb-0">
                    <label class="col-sm-4 col-form-label">출력순위 <i class="mdi mdi-circle-medium text-danger"></i></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="ct_orderby_m" id="ct_orderby_m" numberOnly="" value="<? if($_POST['act'] != "write" && $_POST['act'] != "new") echo $row['ct_orderby']?>">
                    </div>
                </div>
            </li>
        </ul>
        <p class="p-3 mt-3 text-center">
            <input type="button" value="취소" data-dismiss="modal" aria-label="Close" class="btn btn-outline-secondary mx-2" />
            <input type="button" value="저장" onclick="product_category_update()" class="btn btn-primary mx-2" />
        </p>
	</form>
	</div>                
<?php

endif;
?>