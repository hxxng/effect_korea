<?
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

if($_POST['act']=='update') {
    $query = "select * from member_t where idx = ".$_POST['idx'];
    $member = $DB->fetch_assoc($query);

    if($_POST['mt_pwd'] && $_POST['mt_pwd_re']) {
        $pwd = password_hash($_POST['mt_pwd_re'], PASSWORD_DEFAULT);
    } else {
        $pwd = $member['mt_pwd'];
    }
    unset($arr_query);
    $arr_query = array(
        "mt_pwd" => $pwd,
        "mt_login_status" => $_POST['mt_login_status'],
        "mt_hp" => $_POST['mt_hp'],
        "mt_udate" => "now()",
    );

    $where_query = "idx = '".$_POST['idx']."'";
    $DB->update_query('member_t', $arr_query, $where_query);

    p_alert("변경 내용으로 저장되었습니다!");
} else if($_POST['act']=='delete') {
    if($_POST['idx']) {
        $query = "select * from member_t where idx = ".$_POST['idx'];
        $member = $DB->fetch_assoc($query);
        if($member['mt_image']){
            unlink($ct_img_dir_a."/".$member['mt_image']);
        }
        $DB->del_query('member_t', " idx = '".$_POST['idx']."'");
        $DB->del_query("calculate_sum_t", "mt_idx = ".$_POST['idx']);
        $DB->del_query("calculate_t", "mt_idx = ".$_POST['idx']);
        $DB->del_query("cart_t", "mt_idx = ".$_POST['idx']);
        $DB->del_query("membership_t", "mt_idx = ".$_POST['idx']);
        $DB->del_query("order_t", "mt_idx = ".$_POST['idx']);
        $DB->del_query("pushnotification_log_t", "op_idx = ".$_POST['idx']);
        $DB->del_query("pushnotification_read_log_t", "mt_idx = ".$_POST['idx']);
        $DB->del_query("search_log_t", "mt_idx = ".$_POST['idx']);
        $DB->del_query("send_1won_t", "mt_idx = ".$_POST['idx']);
        $DB->del_query("wish_contents_t", "mt_idx = ".$_POST['idx']);
        echo json_encode(array("result" => "ok", "msg" => "삭제되었습니다."));
    } else {
        echo json_encode(array("result" => "false", "msg" => "처리할 수 없습니다."));
    }
    //모든 기록 찾아서 삭제하기, 주문내역, 장바구니, 다운로드 기록, 고객센터 등등
} else if($_POST['act']=='retire') {
    if($_POST['idx']) {
        unset($arr_query);
        $arr_query = array(
            "mt_level" => '1',
            "mt_status" => 'N',
            "mt_login_status" => 'N',
            "mt_rdate" => "now()",
            "mt_retire_memo" => $_POST['mt_retire_memo'],
        );

        $where_query = "idx = '".$_POST['idx']."'";

        $DB->update_query('member_t', $arr_query, $where_query);

        echo json_encode(array("result" => "ok", "msg" => "탈퇴처리되었습니다."));
    } else {
        echo json_encode(array("result" => "false", "msg" => "처리할 수 없습니다."));
    }
} else if($_POST['act']=='restore') {
    if($_POST['idx']) {
        $query = "select * from member_t where idx = ".$_POST['idx'];
        $row = $DB->fetch_assoc($query);
        if($row['mt_level'] == 1){
            $mt_level = 3;
        } else {
            $mt_level = 5;
        }
        unset($arr_query);
        $arr_query = array(
            "mt_level" => $mt_level,
            "mt_status" => 'Y',
            "mt_login_status" => 'Y',
            "mt_rdate" => "0000-00-00",
            "mt_retire_memo" => "null",
            "mt_udate" => "now()",
        );

        $where_query = "idx = '".$_POST['idx']."'";

        $DB->update_query('member_t', $arr_query, $where_query);

        echo json_encode(array("result" => "ok", "msg" => "복구되었습니다."));
    } else {
        echo json_encode(array("result" => "false", "msg" => "처리할 수 없습니다."));
    }
} else if($_POST['act']=='delete_approve') {
    if($_POST['idx']) {
        unset($arr_query);
        $arr_query = array(
            "mt_approve" => '0',
            "mt_status" => 'Y',
            "mt_adate" => null,
        );

        $where_query = "idx = '".$_POST['idx']."'";

        $DB->update_query('member_t', $arr_query, $where_query);

        echo json_encode(array("result" => "ok", "msg" => "삭제되었습니다."));
    } else {
        echo json_encode(array("result" => "false", "msg" => "처리할 수 없습니다."));
    }
} else if($_POST['act']=='popup_image') {
    ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="slider" id="product-swiper">
            <?
            $query = "
					select * from member_t
					where idx = '".$_POST['idx']."'
				";
            $row = $DB->fetch_query($query);
            ?>
                <div class="m-2" style="width: 100%;"><img src="<?=$ct_img_url."/".$row['mt_image']?>" onerror="this.src='<?=$ct_member_no_img_url?>'" class="product-swipe"></div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("li.slick-active").hide();
        });
    </script>
<?
} else if($_POST['act']=='save_approve_memo') {
    if($_POST['idx']) {
        unset($arr_query);
        $arr_query = array(
            "mt_approve_memo" => $_POST['mt_approve_memo'],
            "mt_approve" => 3,
            "mt_audate" => "now()",
        );

        $where_query = "idx = '".$_POST['idx']."'";

        $DB->update_query('member_t', $arr_query, $where_query);

        $query = "select * from member_t where idx = ".$_POST['idx'];
        $member = $DB->fetch_assoc($query);

        $DB->insert_query("pushnotification_log_t", array("plt_title" => "아티스트 가입이 ‘".$_POST['mt_approve_memo']."’로 ‘거절’되었습니다.", "plt_type" => 3, "op_idx" => $member['idx'], "plt_wdate" => "now()"));

        echo json_encode(array("result" => "ok", "msg" => "승인 반려사유가 저장되었습니다!"));
    } else {
        echo json_encode(array("result" => "false", "msg" => "처리할 수 없습니다."));
    }
} else if($_POST['act']=='approve_update') {
    if($_POST['idx']) {
        unset($arr_query);
        $arr_query = array(
            "mt_approve" => $_POST['mt_approve'],
            "mt_audate" => "now()",
        );
        if($_POST['mt_approve'] == 2) {
            $arr_query['mt_level'] = 5;

            $query = "select * from member_t where idx = ".$_POST['idx'];
            $member = $DB->fetch_assoc($query);

            $DB->insert_query("pushnotification_log_t", array("plt_title" => "아티스트 가입이 ‘승인’되었습니다.", "plt_type" => 4, "op_idx" => $member['idx'], "plt_page" => "artist_my.php", "plt_wdate" => "now()"));
        }

        $where_query = "idx = '".$_POST['idx']."'";
        $DB->update_query('member_t', $arr_query, $where_query);

        p_alert("변경 내용으로 저장되었습니다!");
    }
}

include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>