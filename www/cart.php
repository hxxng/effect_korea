<?php
$title = "장바구니";

include_once("./inc/head.php");
include_once("./inc/nav.php");

$_lang = $_SESSION['_lang'];
$cart = lang("cart", $_lang, "cart");
$go_btn = lang("go_btn", $_lang, "cart");
$select_content = lang("select_content", $_lang, "cart");
$sum = lang("sum", $_lang, "cart");
$info1 = lang("info1", $_lang, "cart");
$whole = lang("whole", $_lang, "order");
$select_del = lang("select_del", $_lang, "order");
$order_btn = lang("order_btn", $_lang, "artists");

//로그인체크
if($member_info['idx'] < 1) {
    p_alert('로그인 후 이용가능한 서비스입니다.', '/');
    exit;
}

$query = "select * from cart_t where mt_idx = ".$_SESSION['_mt_idx']." and ct_select = 0 and ct_direct != 1 and ct_status = 0 order by ct_wdate desc";
$list = $DB->select_query($query);

if($_SESSION['_lang'] == "en") {
    $url = 'https://quotation-api-cdn.dunamu.com/v1/forex/recent?codes=FRX.KRWUSD';
    $result = get_exchange_rate($url);
    $data = json_decode($result,true);
    $data = $data[0];

    $_provider = $data['provider'];

    $_buying = $data['cashBuyingPrice'];
    $_selling = $data['cashSellingPrice'];
    $_ttselling = $data['ttSellingPrice'];
    $_ttbuyling = $data['ttBuyingPrice'];
    $_usd = $data['basePrice'];
    $_openusd = $data['openingPrice'];
    $_chusd = $data['changePrice'];
    $_openusd_o = $_usd - $_openusd;
    $_openusd_op = ($_chusd/$_usd)*100;
    $_openusd = round($_openusd,2);

    $dollar = sprintf('%0.2f',$_usd);
}
?>

<form name="frmcartlist" id="frmcartlist" method="post" action="/models/cart_model.php" onsubmit="return frmcart_check(this);">
<input type="hidden" name="type" value="cart_update">
<input type="hidden" name="membership" id="membership">
<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="wr_tit">
                    <h2 class="h2_tit"><?=$cart?></h2>
                </div>
            </div>
            <div class="col-12 col-xl-8">
                <div class="cart_hd d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="chk_all" onclick="f_checkbox_all2('defaultCheck');set_info();">
                        <label class="form-check-label" for="chk_all">
                            <div class="chkbox">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <?=$whole?>
                        </label>
                    </div>
                    <button type="button" class="cart_del" onclick="cart_del();"><img src="img/ic_del.png" alt=""><?=$select_del?></button>
                </div>
                <ul class="cart_list">
                    <?
                    if($list) {
                        foreach ($list as $row) {
                            $query = "select *, (SELECT ct_name FROM category_t WHERE idx=ct_cate_idx2) as ct_name, 
                                    (SELECT mt_nickname FROM member_t WHERE idx=mt_idx) as mt_nickname, (SELECT mt_image FROM member_t WHERE idx=mt_idx) as mt_image 
                                    from contents_t 
                                    where idx = ".$row['ct_idx']." and ct_status = 2 and ct_show = 'Y'";
                            $content = $DB->fetch_assoc($query);
                            if($content) {
                                if($content['mt_image']) {
                                    $mt_image = $ct_img_url."/".$content['mt_image'];
                                } else {
                                    $mt_image = $ct_member_no_img_url;
                                }
                    ?>
                        <li>
                            <div class="form-check">
                                <?
                                if($_SESSION['_lang'] == "en") {
                                ?>
                                    <input type="hidden" id="idx_<?=$row['idx']?>" value="<?=$content['ct_price'] / $dollar?>"/>
                                <?
                                } else {
                                ?>
                                    <input type="hidden" id="idx_<?=$row['idx']?>" value="<?=$content['ct_price']?>"/>
                                <?
                                }
                                ?>
                                <input class="form-check-input" type="checkbox" value="<?=$row['idx']?>" id="defaultCheck<?=$row['idx']?>" name="chk_box[]" onclick="set_info();">
                                <label class="form-check-label" for="defaultCheck<?=$row['idx']?>">
                                    <div class="chkbox">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                </label>
                            </div>
                            <div class="cart_cont_box">
                                <div class="cart_thumbs video_list square rectangle">
                                    <img src="<?=$ct_img_url."/".$content['ct_image']?>" alt="">
                                </div>
                                <a class="cart_cont" href="/contents_list.php?ct_type=<?=$content['ct_type']?>&ct_idx=<?=$content['ct_cate_idx2']?>&idx=<?=$content['idx']?>">
                                    <div class="cart_cate"><?=$content['ct_name']?></div>
                                    <h4 class="cart_tit ff_play"><?=$content['ct_title']?></h4>
                                    <div class="cart_artist">
                                        <div class="square"><img src="<?=$mt_image?>" alt=""></div>
                                        <span class="at_name"><?=$content['mt_nickname']?></span>
                                    </div>
                                    <div class="cart_de d-flex justify-content-between">
                                        <div class="cart_op"><span class="badge badge-secondary fw_600"><?=$content['ct_resolution']?></span><span class="c_reso"><?=$arr_resolution2[$content['ct_resolution']]?></span></div>
                                        <?
                                        if($_SESSION['_lang'] == "en") {
                                        ?>
                                        <div class="cart_price">$<span class="price ff_play"><?=number_format($content['ct_price'] / $dollar,2)?></span></div>
                                        <?
                                            $DB->update_query("cart_t", array("pt_price" => number_format($content['ct_price'] / $dollar,2), "ct_price" => number_format($content['ct_price'] / $dollar,2)), "idx = ".$row['idx']);
                                        } else {
                                        ?>
                                        <div class="cart_price"><span class="price ff_play"><?=number_format($content['ct_price'])?></span>원</div>
                                        <?
                                        }
                                        ?>
                                    </div>
                                </a>
                            </div>
                        </li>
                    <?
                            } else {
                                //컨텐츠 없을때 장바구니에서 삭제
                                $DB->del_query("cart_t", " ct_idx = ".$row['ct_idx']." and ct_select = 0 and ct_direct != 1 and ct_status = 0 ");
                            }
                        }
                    }
                    ?>
                </ul>
                <div class="cart_btm">
                    <button type="button" class="btn btn-outline-secondary tp_btn" onclick="location.href='index.php'"><?=$go_btn?></button>
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <div class="cart_side sticky-top">
                    <div class="cart_side_box">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="cart_select"><?=$select_content?></p>
                            <p id="count">0개</p>
                        </div>
                        <hr class="hr2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="cart_sum fw_600"><?=$sum?></div>
                            <div class="cart_price"><?if($_SESSION['_lang']=="en") echo "$";?><span class="price ff_play" id="sum">0</span><?if($_SESSION['_lang']!="en") echo "원";?></div>
                        </div>
                        <button type="submit" class="btn btn-primary"><?=$order_btn?></button>
                    </div>
                    <p class="cart_txt"><?=$info1?></p>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

<script>
    function set_info() {
        var cnt = 0;
        var sum = 0;
        if("<?=$_SESSION['_lang']?>" == "en") {
            $('input:checkbox[id^="defaultCheck"]').each(function() {
                if($(this).prop("checked") == true) {
                    sum += parseFloat($("#idx_"+$(this).val()).val());
                    cnt++;
                }
            });
            $("#sum").text(comma_num(sum.toFixed(2)));
        } else {
            $('input:checkbox[id^="defaultCheck"]').each(function() {
                if($(this).prop("checked") == true) {
                    sum += parseInt($("#idx_"+$(this).val()).val());
                    cnt++;
                }
            });
            $("#sum").text(comma_num(sum));
        }
        $("#count").text(cnt+"개");
    }

    function cart_del() {
        var idx = "";
        $('input:checkbox[id^="defaultCheck"]').each(function() {
            if($(this).prop("checked") == true) {
                idx += $(this).val()+",";
            }
        });
        $.ajax({
            type: 'post',
            url: './models/cart_model.php',
            dataType: 'json',
            data: {type: "delete", idx_arr: idx},
            success: function (r) {
                alert(r['msg']);
                location.reload();
            },
        });
    }

    function frmcart_check(f){
        var cnt = 0;
        var idx = "";
        $('input:checkbox[id^="defaultCheck"]').each(function() {
            if($(this).prop("checked") == true) {
                cnt++;
                idx += $(this).val()+",";
            }
        });
        if(cnt == 0) {
            alert("결제할 콘텐츠를 선택해주세요.");
            return false;
        }
        var chk = chk_membership(idx);
        if(chk == 1) {
            $('#membership').val('membership');
            $.ajax({
                type: 'post',
                url: '/models/cart_model.php',
                dataType: 'json',
                data: $("#frmcartlist").serialize(),
                success: function (d, s) {
                    if (d.result == '_ok') {
                        $("#modal_sm1").modal("show");
                    } else {
                        alert(d.msg);
                    }
                },
                cache: false
            });
            return false;
        } else if(chk == 2) {
            $("#modal_sm2").modal("show");
            return false;
        } else {
            return true;
        }
    }

    var result = 3;
    function chk_membership(idx) {
        $.ajax({
            type: 'post',
            url: '/models/cart_model.php',
            dataType: 'json',
            async: false,
            data: {type: "chk_membership2", ct_idx: idx},
            success: function (d, s) {
                if (d.result == '_ok') {
                    result = 1;
                } else if (d.result == '_false2') {
                    result = 2;
                } else {
                    result = 3;
                }
            },
            cache: false
        });
        return result;
    }
</script>

<? include_once("./inc/tail.php"); ?>