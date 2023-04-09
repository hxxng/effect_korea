<?php
$title = "검색어 입력 완료";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$result_ment = lang("result", $_lang, "search");
$contents = lang("contents", $_lang, "search");
$artist = lang("artist", $_lang, "nav");
$search_x = lang("search_x", $_lang, "artists");

$_get_txt = "search_txt=".$_GET['search_txt']."&pg=";
$n_limit = 16;
$pg = $_GET['pg'];

$query = "select * from member_t where instr(mt_nickname, '".$_GET['search_txt']."') and mt_level = 5 and mt_login_status = 'Y'";
$row_cnt = $DB->count_query($query);
$couwt_query = $row_cnt[0];
$counts = $couwt_query;
$n_page = ceil($couwt_query / $n_limit);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;
$counts = $counts - (($pg - 1) * $n_limit);

unset($list);
$sql_query = $query." order by mt_nickname limit ".$n_from.", ".$n_limit;
$list = $DB->select_query($sql_query);
?>
<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-12 my-5">
                <div class="wr_tit2">
                    <h2>'<?=$_GET['search_txt']?>' <?=$result_ment?></h2>
                    <ul class="t_menu">
                        <li><a href="/search_result_contents.php?search_txt=<?=$_GET['search_txt']?>"><?=$contents?></a></li>
                        <li class="t_active"><a href="/search_result_artist.php?search_txt=<?=$_GET['search_txt']?>"><?=$artist?></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?if($list) { ?>
        <div class="at_list row row-cols-2 row-cols-xl-4 row-cols-lg-3">
            <?
            foreach ($list as $row) {
            ?>
            <div class="col">
                <a href="artist_detail.php?mt_idx=<?=$row['idx']?>">
                    <div class="at_box">
                        <div class="at_cr_img square"><img src="<? if($row['mt_image']) echo $ct_img_url."/".$row['mt_image']; else echo $ct_member_no_img_url;?>" alt=""></div>
                        <h4 class="at_name fw_500"><?=$row['mt_nickname']?></h4>
                        <p class="at_txt"><?=$row['mt_introduce']?></p>
                    </div>
                </a>
            </div>
        <?
            }
        ?>
        </div>
        <?
        } else {
        ?>
        <div class="row">
            <div class="col-12">
                <div class="result_none fc_gray">
                    <img src="img/result_img.png" alt="">
                    <p class="fs_18"><?=$search_x?></p>
                </div>
            </div>
        </div>
        <?
        }

        if($n_page>1) {
            echo page_listing2($pg, $n_page, $_SERVER['PHP_SELF']."?".$_get_txt);
        }
        ?>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>