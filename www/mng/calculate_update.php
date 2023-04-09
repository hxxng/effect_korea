<?
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

if($_POST['act']=='update') {
    if($_POST['ct_status'] != 1) {
        unset($arr_query);
        $arr_query = array(
            "ct_status" => $_POST['ct_status'],
            "ct_ridate" => $_POST['ct_ridate'],
            "ct_memo" => $_POST['ct_memo'],
            "ct_udate" => "now()",
        );
        if($_POST['ct_status'] == 3) {
            $arr_query['ct_ridate'] = $_POST['ct_ridate'];
        }
        $query = "select * from calculate_t where idx = ".$_POST['idx'];
        $row = $DB->fetch_assoc($query);
        if($row) {
            $DB->update_query("calculate_t", $arr_query, "mt_idx = ".$_POST['mt_idx']." and ct_status = ".$row['ct_status']);
        }

        unset($arr_query);
        $arr_query = array(
            "mt_idx" => $_POST['mt_idx'],
            "ct_rdate" => $row['ct_rdate'],
            "ct_ridate" => $_POST['ct_ridate'],
            "ct_price" => $_POST['ct_price'],
            "ot_sum_price" => $_POST['ot_sum_price'],
            "ot_pay_price" => $_POST['ot_pay_price'],
            "ot_membership_price" => $_POST['ot_membership_price'],
            "ct_comm_sum_price" => $_POST['ct_comm_sum_price'],
            "ct_service_comm" => $_POST['ct_service_comm'],
            "ct_pay_comm" => $_POST['ct_pay_comm'],
            "ct_etc_comm" => $_POST['ct_etc_comm'],
        );

        $query = "select * from calculate_sum_t where mt_idx = ".$_POST['mt_idx']." and ct_rdate = '".$row['ct_rdate']."'";
        $row2 = $DB->fetch_assoc($query);
        if($row2) {
            $arr_query['cst_udate'] = "now()";
            $DB->update_query("calculate_sum_t", $arr_query, "idx = ".$row2['idx']);
        } else {
            $arr_query['cst_wdate'] = "now()";
            $DB->insert_query("calculate_sum_t", $arr_query);
        }
    }

    p_alert("변경 내용으로 저장되었습니다!");
} else if($_POST['act']=='delete') {
    if($_POST['idx']) {
        $query = "select * from calculate_t where idx = ".$_POST['idx'];
        $row = $DB->fetch_assoc($query);
        if($row) {
            $DB->del_query('calculate_t', " mt_idx = ".$row['mt_idx']." and ct_status = ".$row['ct_status']." and ct_rdate = '".$row['ct_rdate']."'");
            $DB->del_query('calculate_sum_t', " mt_idx = ".$row['mt_idx']." and ct_rdate = '".$row['ct_rdate']."'");
            echo json_encode(array("result" => "ok", "msg" => "삭제되었습니다."));
        } else {
            echo json_encode(array("result" => "false", "msg" => "처리할 수 없습니다."));
        }
    } else {
        echo json_encode(array("result" => "false", "msg" => "처리할 수 없습니다."));
    }
} else if($_POST['act']=='pc_modal') {  //모달 창
if($_POST['idx']) $row = $DB->fetch_query("select * from member_t where idx='".$_POST['idx']."'");
?>
<div class="modal-header">
    <h5 class="modal-title" id="staticBackdropLabel">정산계좌 <? if($row['mt_account_status'] == 'Y') { ?><span style="color: blue;">인증완료</span><? } ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body p-2">
    <form name="f_product_category">
        <input type="hidden" name="act" value="">
        <ul class="list-group list-group-flush">
            <li class="list-group-item" style="padding: 0 1.25rem;border-top: 0;">
                <div class="form-group row align-items-center mb-0">
                    <label class="col-sm-4 col-form-label">은행명</label>
                    <div class="col-sm-8">
                        <span><?=$row['mt_bank']?></span>
                    </div>
                </div>
            </li>
            <li class="list-group-item" style="padding: 0 1.25rem;">
                <div class="form-group row align-items-center mb-0">
                    <label class="col-sm-4 col-form-label">은행계좌</label>
                    <div class="col-sm-8">
                        <span><?=$row['mt_account']?></span>
                    </div>
                </div>
            </li>
            <li class="list-group-item" style="padding: 0 1.25rem;">
                <div class="form-group row align-items-center mb-0">
                    <label class="col-sm-4 col-form-label">계좌주</label>
                    <div class="col-sm-8">
                        <span><?=$row['mt_account_name']?></span>
                    </div>
                </div>
            </li>
        </ul>
        <p class="mt-3 text-center">
            <input type="button" value="닫기" data-dismiss="modal" aria-label="Close" class="btn btn-outline-secondary mx-2" />
        </p>
    </form>
</div>
<?php
}

include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>