<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

if($_POST['act']=='wish'){
    if($_SESSION['_mt_idx'] < 1){    
        echo json_encode(array('result' => '_false', 'msg' => '로그인이 필요한 기능입니다.'));
        exit;
    }

    $table = ($_POST['table']=='content') ? 'wish_contents_t' : 'wish_artist_t';

    //찜하기
    $field = ($_POST['table']=='content') ? 'ct' : 'at';
    $row = $DB->fetch_query("select idx, w".$field."_status from ".$table." where ".$field."_idx=".$_POST['wish_idx']." and mt_idx=".$_SESSION['_mt_idx']);
    $set_arr = array();    
    if($row['idx'] > 0){
        if($row["w".$field."_status"]=='Y'){
            $set_arr = array('w'.$field.'_status'=>'N');
        }else{
            $set_arr = array('w'.$field.'_status'=>'Y');
        }
        $DB->update_query($table, $set_arr, 'idx='.$row['idx']);
    }else{
        $set_arr['mt_idx'] = $_SESSION['_mt_idx'];        
        $set_arr[$field.'_idx'] = $_POST['wish_idx'];
        $set_arr['w'.$field.'_status'] = 'Y';
        $set_arr['w'.$field.'_wdate'] = date('Y-m-d H:i:s');
        $DB->insert_query($table, $set_arr);
    }
    echo json_encode(array('result' => '_ok'));
}


?>