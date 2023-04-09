<?php
$title = "자주묻는 질문";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$faq = lang("faq",$_lang, "notice");

if($_SESSION['_lang'] == "kr" || $_SESSION['_lang'] == "") {
    $ft_language = 1;
} else {
    $ft_language = 2;
}

$_get_txt = "&pg=";
$n_limit = 10;
$pg = $_GET['pg'];

$query = "select * from faq_t where ft_show = 'Y' and ft_language = ".$ft_language;
$row_cnt = $DB->count_query($query);
$couwt_query = $row_cnt[0];
$counts = $couwt_query;
$n_page = ceil($couwt_query / $n_limit);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;
$counts = $counts - (($pg - 1) * $n_limit);

unset($list);
$sql_query = $query." order by ft_orderby, ft_wdate desc limit ".$n_from.", ".$n_limit;
$list = $DB->select_query($sql_query);
?>

<style>
    .editor_img img {
        width: 100%;
        height: 100%;
    }
</style>

<div class="wrap">
    <div class="con_wrap">
        <h2 class="h2_tit"><?=$faq?></h2>
        <div class="accordion faq_wrap" id="faq1">
            <?
            if($list) {
                foreach ($list as $row) {
            ?>
                <div class="card">
                    <div class="card-header" id="heading<?=$counts?>">
                        <h2 class="mb-0">
                            <button class="btn text-left d-flex" type="button" data-toggle="collapse" data-target="#collapse<?=$counts?>" aria-expanded="false" aria-controls="collapse<?=$counts?>">
                                <div class="d-flex align-items-center w-90">
                                    <span class="d-block fw_600"><?=$row['ft_title']?></span>
                                </div>
                                <span class="faq_arrow"><i class="bi bi-chevron-down fs_14"></i></span>
                            </button>
                        </h2>
                    </div>
                    <div id="collapse<?=$counts?>" class="collapse hodd" aria-labelledby="heading<?=$counts?>" data-parent="#faq1" style="">
                        <div class="card-body d-flex">
                            <p class="wh_pre fs_15 editor_img" style="height: 100%;"><?=$row['ft_answer']?></p>
                        </div>
                    </div>
                </div>
            <?
                    $counts--;
                }
            }
            ?>
        </div>
        <?
        if($n_page>1) {
            echo page_listing2($pg, $n_page, $_SERVER['PHP_SELF']."?".$_get_txt);
        }
        ?>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>