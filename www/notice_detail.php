<?php
$title = "공지 상세";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$list_btn = lang("list_btn", $_lang, "order");

$query = "select * from notice_t where nt_show = 'Y' and idx = ".$_GET['nt_idx'];
$row = $DB->fetch_assoc($query);
if(!$row) {
    p_alert("공지사항이 존재하지 않습니다.", "./notice.php");
}
?>
<style>
    .editor_img img {
        width: 100%;
        height: 100%;
    }
</style>

<div class="wrap">
    <div class="con_wrap">
        <div class=" mt-5 pb-5 pt-3 border-bottom">
            <h3 class="fw_700"><?=$row['nt_title']?></h3>
            <p class="mt-3 fc_gray"><?=DateType($row['nt_wdate'],1)?></p>
        </div>
        <div class="border-bottom p-md-5 p-4 editor_img">
            <?=$row['nt_content']?>
        </div>
        <div class="mt-5 ">
        <p class="col-auto m-auto" style="max-width:355px"><a href="./notice.php?pg=<?=$_GET['pg']?>"><button type="button" class="btn btn-secondary btn-lg btn-block"><?=$list_btn?></button></a></p>
        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>