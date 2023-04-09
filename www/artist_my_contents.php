<?php
$title = "콘텐츠 관리";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$detail = lang("detail", $_lang, "artist_my_contents");
$approve_status = lang("approve_status", $_lang, "artist_my_contents");
$approve1 = lang("approve1", $_lang, "artist_my_contents");
$approve2 = lang("approve2", $_lang, "artist_my_contents");
$approve3 = lang("approve3", $_lang, "artist_my_contents");
$show = lang("show", $_lang, "artist_my_contents");
$hide = lang("hide", $_lang, "artist_my_contents");
$type = lang("type", $_lang, "artist_my_contents");
$wdate = lang("wdate", $_lang, "artist_my_contents");
$adate = lang("adate", $_lang, "artist_my_contents");
$whole = lang("whole", $_lang, "order");
$category = lang("category", $_lang, "contents");
$name = lang("name", $_lang, "contents_upload");
$sale_price = lang("sale_price", $_lang, "contents_upload");
$resolution = lang("resolution", $_lang, "contents");
$search_txt = lang("search_txt", $_lang, "artists");
$search_txt2 = lang("search_txt2", $_lang, "artists");
$reset = lang("reset", $_lang, "calc");
$num = lang("num", $_lang, "notice");
$detail2 = lang("detail", $_lang, "calc");
$manage = lang("manage", $_lang, "calc");
$del = lang("del", $_lang, "order");

if($member_info['idx'] < 1) {
    p_alert('로그인 후 이용가능한 서비스입니다.', '/');
    exit;
}
if($member_info['mt_level'] != 5) {
    p_alert('아티스트만 접근가능한 서비스입니다.', '/');
    exit;
}

$_get_txt = "ct_status=".$_GET['ct_status']."&ct_show=".$_GET['ct_show']."&search_txt=".$_GET['search_txt']."&pg=";
$n_limit = 10;
$pg = $_GET['pg'];

$query = "select contents_t.*, c1.ct_name as ct_cate, c2.ct_name as ct_cate2 
        from contents_t
        left join category_t c1 on c1.idx = contents_t.ct_cate_idx
        left join category_t c2 on c2.idx = contents_t.ct_cate_idx2
        where mt_idx = ".$member_info['idx']." ";
if($_GET['search_txt']) {
    if($_GET['sel_search']=="all") {
        $where_query .= " and (instr(c1.ct_name, '".$_GET['search_txt']."') or instr(c2.ct_name, '".$_GET['search_txt']."') or instr(ct_title, '".$_GET['search_txt']."') or instr(ct_resolution, '".$_GET['search_txt']."')  or instr(ct_price, '".$_GET['search_txt']."'))";
    } else {
        if($_GET['sel_search'] == "ct_name") {
            $where_query .= " and (instr(c1.ct_name, '".$_GET['search_txt']."') or instr(c2.ct_name, '".$_GET['search_txt']."'))";
        } else {
            $where_query .= " and instr(".$_GET['sel_search'].", '".$_GET['search_txt']."')";
        }
    }
    $_where = " and ";
}
if($_GET['ct_status']) {
    $where_query .= " and ct_status = ".$_GET['ct_status'];
}
if($_GET['ct_show']) {
    $where_query .= " and ct_show = '".$_GET['ct_show']."'";
}
$row_cnt = $DB->count_query($query.$where_query);
$couwt_query = $row_cnt;
$counts = $couwt_query;
$n_page = ceil($couwt_query / $n_limit);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;
$counts = $counts - (($pg - 1) * $n_limit);

unset($list);
$sql_query = $query.$where_query." order by contents_t.ct_wdate desc limit ".$n_from.", ".$n_limit;
$list = $DB->select_query($sql_query);
?>

<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="wr_tit2">
                    <h2><?=$detail?></h2>
                </div>
            </div>
            <div class="col-12">
                <div class="content_pg_wr content_pg_wr2" <?=($_lang == "en") ? 'style="justify-content: normal;"' : '' ?>>
                    <div class="btn_group_wrap">
                        <div class="group_wr">
                            <label><?=$approve_status?></label>
                            <div class="btn-group btn-group-toggle <?=($_lang == "en") ? 'mr-4' : 'mr-5' ?>" data-toggle="buttons">
                                <label class="btn btn-outline-primary <?=($_GET['ct_status'] == "") ? 'active' : '' ?> <?=($_lang == "en") ? 'pl-3 pr-3' : '' ?>">
                                    <input type="radio" name="options" id="option9" <?=($_GET['ct_status'] == "") ? 'checked' : '' ?> onclick="chk_status('', '<?=$_GET['ct_show']?>')"> <?=$whole?>
                                </label>
                                <label class="btn btn-outline-primary <?=($_GET['ct_status'] == "1") ? 'active' : '' ?>">
                                    <input type="radio" name="options" id="option1" <?=($_GET['ct_status'] == "1") ? 'checked' : '' ?> onclick="chk_status(1, '<?=$_GET['ct_show']?>')"> <?=$approve1?>
                                </label>
                                <label class="btn btn-outline-primary <?=($_GET['ct_status'] == "2") ? 'active' : '' ?>">
                                    <input type="radio" name="options" id="option2" <?=($_GET['ct_status'] == "2") ? 'checked' : '' ?> onclick="chk_status(2, '<?=$_GET['ct_show']?>')"> <?=$approve2?>
                                </label>
                                <label class="btn btn-outline-primary <?=($_GET['ct_status'] == "3") ? 'active' : '' ?>">
                                    <input type="radio" name="options" id="option3" <?=($_GET['ct_status'] == "3") ? 'checked' : '' ?> onclick="chk_status(3, '<?=$_GET['ct_show']?>')"> <?=$approve3?>
                                </label>
                            </div>  
                        </div>
                        <div class="group_wr">
                            <label>노출</label>
                            <div class="btn-group btn-group-toggle <?=($_lang == "en") ? 'mr-4' : 'mr-5' ?>" data-toggle="buttons">
                                <label class="btn btn-outline-primary <?=($_GET['ct_show'] == "") ? 'active' : '' ?>">
                                    <input type="radio" name="options" id="option9" <?=($_GET['ct_show'] == "") ? 'checked' : '' ?> onclick="chk_status('<?=$_GET['ct_status']?>', '')"> <?=$whole?>
                                </label>
                                <label class="btn btn-outline-primary <?=($_GET['ct_show'] == "Y") ? 'active' : '' ?>">
                                    <input type="radio" name="options" id="option1" <?=($_GET['ct_show'] == "Y") ? 'checked' : '' ?> onclick="chk_status('<?=$_GET['ct_status']?>', 'Y')"> <?=$show?>
                                </label>
                                <label class="btn btn-outline-primary <?=($_GET['ct_show'] == "N") ? 'active' : '' ?>">
                                    <input type="radio" name="options" id="option2" <?=($_GET['ct_show'] == "N") ? 'checked' : '' ?> onclick="chk_status('<?=$_GET['ct_status']?>', 'N')"> <?=$hide?>
                                </label>
                            </div>  
                        </div>
                    </div>
                    <form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>">
                    <input type="hidden" name="ct_status" value="<?=$_GET['ct_status']?>"/>
                    <input type="hidden" name="ct_show" value="<?=$_GET['ct_show']?>"/>
                    <div class="wr_form wr_form2 d-flex align-items-center">
                        <div class="wr_form_cont d-flex mr-4">
                            <div class="form-group form-group_1 form_select form_l">
                                <select class="form-control" id="sel_search" name="sel_search" aria-placeholder="<?=$type?>" <?=($_lang == "en") ? 'style="width: 120px;"' : '' ?>>
                                    <option value="all" selected><?=$type?></option>
                                    <option value="ct_name"><?=$category?></option>
                                    <option value="ct_title"><?=$name?></option>
                                    <option value="ct_resolution"><?=$resolution?></option>
                                    <option value="ct_price"><?=$sale_price?></option>
                                </select>
                            </div>  
                            <div class="form-group form-group_1 form_r" <?=($_lang == "en") ? 'style="margin-left: 3rem;"' : '' ?>>
                                <label for="search_txt" class="search_label_1"><?=$search_txt?> <span class="hide_text"><?=$search_txt2?></span></label>
                                <input type="text" class="form-control" id="search_txt" name="search_txt" value="<?=$_GET['search_txt']?>" >
                                <button class="btn btn-link btn_sch btn_sch_1" type="submit"><img src="img/ic_sub_search.png" alt="검색"> </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-dark btn-sm btn_reset"><img src="img/ic_reset.png" alt=""> <?=$reset?></button>
                    </div>
                    </form>
                </div>
                
                <div class="table-responsive-xl">
                    <table class="table history_list my_contents_list text-center">
                        <thead>
                            <tr>
                                <th scope="col"><?=$num?></th>
                                <th scope="col"><?=$approve_status?></th>
                                <th scope="col" class="my_cont_cate"><?=$category?></th>
                                <th scope="col" class="my_cont_name"><?=$name?></th>
                                <th scope="col"><?=$resolution?></th>
                                <th scope="col"><?=$sale_price?></th>
                                <th scope="col"><?=$wdate?></th>
                                <th scope="col"><?=$adate?></th>
                                <th scope="col"><?=$show?></th>
                                <th scope="col" class="my_cont_set"><?=$manage?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <? if($list) {
                            foreach ($list as $row) {
                                if($row['ct_status'] == 1) {
                                    $ct_status = "승인대기";
                                } else if($row['ct_status'] == 2) {
                                    $ct_status = "승인완료";
                                } else{
                                    $ct_status = "승인반려";
                                }
                        ?>
                            <tr>
                                <td><?=$counts?></td>
                                <td><?=$ct_status?></td>
                                <td class="my_cont_cate"><?=$row['ct_cate']?> > <?=$row['ct_cate2']?></td>
                                <td class="text_hidden my_cont_name"><?=$row['ct_title']?></td>
                                <td><?=$row['ct_resolution']?></td>
                                <td><?=number_format($row['ct_price'])?>원</td>
                                <td><?=DateType($row['ct_wdate'])?></td>
                                <td><?=DateType($row['ct_acdate'])?></td>
                                <td><?=$row['ct_show']?></td>
                                <td class="my_cont_set">
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-primary btn-sm mr-4" onclick="location.href='/artist_my_contents_detail.php?ct_idx=<?=$row['idx']?>&<?=$_get_txt?>'"><?=$detail2?></button>
                                        <button type="button" class="btn btn-secondary btn-sm" onclick="delete_contents(<?=$row['idx']?>)"><img src="img/ic_del.png" alt=""> <?=$del?></button>
                                    </div>
                                </td>
                            </tr>
                    <?
                            $counts--;
                        }
                    }
                    ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-12 my-5">
                <?
                if($n_page>1) {
                    echo page_listing2($pg, $n_page, $_SERVER['PHP_SELF']."?".$_get_txt);
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        <? if($_GET['sel_search']) { ?>$('#sel_search').val('<?=$_GET['sel_search']?>');<? } ?>
    });

    function chk_status(status, show) {
        location.replace("/artist_my_contents.php?ct_status="+status+"&ct_show="+show+"&sel_search=<?=$_GET['sel_search']?>&search_txt=<?=$_GET['search_txt']?>");
    }

    function delete_contents(idx) {
        if(confirm("정말로 콘텐츠를 삭제하시겠습니까?")) {
            $.ajax({
                type: 'post',
                url: '/models/mypage/member.php',
                dataType: 'json',
                data: {type: "delete", idx: idx},
                success: function (d, s) {
                    alert(d['msg']);
                    location.reload();
                },
                cache: false
            });
        }
    }
</script>

<? include_once("./inc/tail.php"); ?>