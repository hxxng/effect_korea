<?php
$title = "공지사항";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$notice = lang("notice",$_lang, "notice");
$num = lang("num",$_lang, "notice");
$title = lang("title",$_lang, "notice");
$w_date = lang("w_date",$_lang, "notice");

if($_SESSION['_lang'] == "kr" || $_SESSION['_lang'] == "") {
    $nt_language = 1;
} else {
    $nt_language = 2;
}

$_get_txt = "&pg=";
$n_limit = 10;
$pg = $_GET['pg'];

$query = "select * from notice_t where nt_show = 'Y' and nt_language = ".$nt_language;
$row_cnt = $DB->count_query($query);
$couwt_query = $row_cnt[0];
$counts = $couwt_query;
$n_page = ceil($couwt_query / $n_limit);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;
$counts = $counts - (($pg - 1) * $n_limit);

unset($list);
$sql_query = $query." order by nt_orderby, nt_wdate desc limit ".$n_from.", ".$n_limit;
$list = $DB->select_query($sql_query);
?>

<div class="wrap">
    <div class="con_wrap">
        <h2 class="h2_tit"><?=$notice?></h2>
        <ul class="list-unstyled bo_list mt-3 pb-2">
            <li class="media bo_list_hd text-center fs_17 ">
                <div class="w-100 media-body row mx-0 justify-content-between align-items-center flex-nowrap">
                    <div class=" post_info col-lg-1 col-auto d-none d-sm-block"><?=$num?></div>
                    <div class="col-lg-9 col-auto flex-fill  fw_400 text-left"><?=$title?></div>
                    <div class="bo_date fw_400 text-center"><?=$w_date?></div>
                </div>
            </li>
            <?
            if($list) {
                foreach ($list as $row) {
            ?>
                <li class="media text-center border-bottom">
                    <a href="/notice_detail.php?nt_idx=<?=$row['idx'].$_get_txt?>" class="w-100 media-body row mx-0 justify-content-between align-items-center flex-nowrap">
                        <div class="post_info col-lg-1 col-auto d-none d-sm-block"><?=$counts?></div>
                        <div class="col-lg-9 col-auto text_hidden  text-left flex-fill"><span class="line_text"><?=$row['nt_title']?></span></div>
                        <div class="bo_date col-auto"><?=DateType($row['nt_wdate'],1)?></div>
                    </a>
                </li>
            <?
                    $counts--;
                }
            }
            ?>
        </ul>
        <?
        if($n_page>1) {
            echo page_listing2($pg, $n_page, $_SERVER['PHP_SELF']."?".$_get_txt);
        }
        ?>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>