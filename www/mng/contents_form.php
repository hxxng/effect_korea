<?
include "./head_inc.php";
require $_SERVER['DOCUMENT_ROOT'].'/lib/aws/vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$bucket = 'bucket';

$s3 = Aws\S3\S3Client::factory(
    array(
        'endpoint' => 'https://kr.object.ncloudstorage.com',
        'version' => 'latest',
        'region' => 'ap-northeast-2', //한국
        'credentials' => array(
            'key' => 'key',
            'secret' => 'secret',
        )
    )
);

$chk_menu = "1";

$query = "select a1.*, a1.idx as ct_idx, (SELECT mt_nickname FROM member_t WHERE idx=mt_idx) as mt_nickname from contents_t a1 where a1.idx = '".$_GET['ct_idx']."'";
$row = $DB->fetch_query($query);

$_act = $_GET['act'];
if($_act == "input") {
    $title = "업로드";
} else {
    $title = "상세";
}
if($_GET['ct_type'] == 1) {
    $list_url_t = "contents_video_list.php";
    $chk_sub_menu = '4';
} else {
    $list_url_t = "contents_template_list.php";
    $chk_sub_menu = '5';
}
include "./head_menu_inc.php";

$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&ct_show=".$_GET['ct_show']."&ct_cate_idx=".$_GET['ct_cate_idx']."&pg=".$_GET['pg'];
?>
<style>
    /* 드롭 반응 */
    .dropBox.active {
        background: #eee;
    }
</style>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">콘텐츠 <?=$title?></h4>
                        <p class="card-description">
                            Chrome 사용을 권장합니다. 이외의 브라우저 또는 Chrome 하위버전으로 접속 할 경우 페이지가 깨져 보일 수 있습니다.
                        </p>
                        <form method="post" name="frm_form" id="frm_form" action="./contents_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" enctype="multipart/form-data">
                            <input type="hidden" name="act" id="act" value="<?=$_act?>" />
                            <input type="hidden" name="idx" id="idx" value="<?=$row['idx']?>" />
                            <input type="hidden" name="ct_type" id="ct_type" value="<?=$_GET['ct_type']?>" />

                            <div class="form-group row">
                                <div class="card-body">
                                    <p class="mb-0"></p>
                                    <ul class="list-group list-group-flush">
                                        <?if($_act != "input") { ?>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">등록일</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <span><?=DateType($row['ct_wdate'],4)?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <? } ?>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">아티스트</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="hidden" name="mt_idx" value="<?=$row['mt_idx']?>" />
                                                        <span><?if($_act == "input" || $row['mt_nickname'] == "") { echo 'effect korea'; } else echo $row['mt_nickname']?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?if($_act != "input") { ?>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">노출</label>
                                                <div class="col-sm-2">
                                                    <div class="input-group">
                                                        <select class="form-control custom-select" id="ct_show" name="ct_show">
                                                            <option value="Y">노출</option>
                                                            <option value="N">노출안함</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <? } ?>
                                        <h4 class="card-title mt-4">기본정보</h4>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">컨텐츠명 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <input type="text" name="ct_title" value="<?=$row['ct_title']?>" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">컨텐츠 설명</label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <input type="text" name="ct_contents" value="<?=$row['ct_contents']?>" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_keyword" class="col-sm-2 col-form-label">검색 키워드</label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <?
                                                        if($row['ct_idx']) {
                                                            $query = "select * from contents_keyword_t where ct_idx = " . $row['ct_idx'];
                                                            $keyword = $DB->select_query($query);
                                                            if ($keyword) {
                                                                foreach ($keyword as $row_k) {
                                                                    $txt .= $row_k['ct_korean'] . " ";
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <input type="text" name="ct_keyword" value="<?=$txt?>" id="ct_keyword" class="form-control" placeholder="검색 키워드 입력(공백으로 구분, 최대 5개)"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">카테고리 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                                <div class="col-sm-2">
                                                    <div class="input-group">
                                                        <select name="ct_cate_idx" id="ct_cate_idx" class="form-control">
                                                            <option value="" selected="">선택</option>
                                                            <?
                                                            $query = "select * from category_t where ct_level = 0 order by ct_orderby";
                                                            $category1 = $DB->select_query($query);
                                                            if($category1) {
                                                                foreach ($category1 as $cate1) {
                                                            ?>
                                                                <option value="<?=$cate1['idx']?>"><?=$cate1['ct_name']?></option>
                                                            <?
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="input-group">
                                                        <select name="ct_cate_idx2" id="ct_cate_idx2" class="form-control">
                                                            <option value="" selected="">선택</option>
                                                            <?
                                                            if($row['ct_cate_idx']) {
                                                                $query = "select * from category_t where ct_p_idx = ".$row['ct_cate_idx']." order by ct_orderby";
                                                                $category2 = $DB->select_query($query);
                                                                if($category2) {
                                                                    foreach ($category2 as $cate2) {
                                                                        ?>
                                                                        <option value="<?=$cate2['idx']?>"><?=$cate2['ct_name']?></option>
                                                                        <?
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">포맷 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                                <div class="col-sm-2">
                                                    <div class="input-group">
                                                        <select name="ct_format" id="ct_format" class="form-control">
                                                            <option value="" selected="">선택</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <h4 class="card-title mt-4">상세정보</h4>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">프레임레이트</label>
                                                <div class="col-sm-2">
                                                    <select name="ct_framerate" id="ct_framerate" class="form-control">
                                                        <?= $arr_framerate_option ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <?
                                        $time = explode(":", $row['ct_playtime'])
                                        ?>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">컨텐츠 재생시간</label>
                                                <div class="col-sm-1 input-group">
                                                    <input type="text" class="form-control col-sm-10" numberonly="" value="<?=$time['0']?>" name="ct_time_hour"/><span class="form-control-plaintext col-sm-2 ml-3">:</span>
                                                </div>
                                                <div class="col-sm-1 input-group">
                                                    <input type="text" class="form-control col-sm-10" numberonly="" value="<?=$time['1']?>" name="ct_time_min"/><span class="form-control-plaintext col-sm-2 ml-3">:</span>
                                                </div>
                                                <div class="col-sm-1 input-group">
                                                    <input type="text" class="form-control col-sm-10" numberonly="" value="<?=$time['2']?>" name="ct_time_sec"/><span class="form-control-plaintext col-sm-2 ml-3"></span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">파일 크기</label>
                                                <div class="col-sm-2">
                                                    <input type="text" id="ct_size" name="ct_size" value="<?=$row['ct_size']?>" readonly class="form-control-plaintext" />
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_filter" class="col-sm-2 col-form-label" id="filtering_category">필터링 카테고리(중복선택가능) </label>
                                                <div class="col-sm-3">
                                                    <input type="hidden" id="ct_filter" name="ct_filter" value="<?=$row['ct_filter']?>"/>
                                                    <?
                                                    foreach($arr_filter as $key => $val) {
                                                        if($key>0) {
                                                            $filter = explode(",", $row['ct_filter']);
                                                            foreach ($filter as $f_row) {
                                                                if($key == $f_row) {
                                                                    $chk = "Y";
                                                                    break;
                                                                } else {
                                                                    $chk = "N";
                                                                }
                                                            }
                                                    ?>
                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input type="checkbox" id="<?=$key?>" name="filter" value="<?=$key?>" <?=$chk == "Y" ? 'checked=""' : ''?> class="custom-control-input">
                                                            <label class="custom-control-label" for="<?=$key?>"><?=$val?></label>
                                                        </div>
                                                    <?
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">에디토리얼</label>
                                                <div class="col-sm-3">
                                                    <div class="custom-control custom-checkbox custom-control-inline">
                                                        <input type="hidden" name="ct_editorial" id="ct_editorial" value="<?=$row['ct_editorial']?>"/>
                                                        <input type="checkbox" id="editorial" value="<?=$row['ct_editorial']?>" <?=$row['ct_editorial'] == "Y" ? 'checked=""' : ''?> class="custom-control-input">
                                                        <label class="custom-control-label" for="editorial"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">독점콘텐츠</label>
                                                <div class="col-sm-3">
                                                    <div class="custom-control custom-checkbox custom-control-inline">
                                                        <input type="hidden" name="ct_exclusive" id="ct_exclusive" value="<?=$row['ct_exclusive']?>"/>
                                                        <input type="checkbox" id="exclusive" value="<?=$row['ct_exclusive']?>" <?=$row['ct_exclusive'] == "Y" ? 'checked=""' : ''?> class="custom-control-input">
                                                        <label class="custom-control-label" for="exclusive"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">대표 썸네일 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="ct_image" id="ct_image" value="<?=$row['ct_image']?>" accept=".jpeg, .jpg, .png, .gif" class="d-none">
                                                    <input type="hidden" name="ct_image_on" id="ct_image_on" value="<?=$row['ct_image']?>" class="form-control">

                                                    <label for="ct_image" class="plus-input-small" style="width: 140px;height: 140px;line-height: 140px;"><i class="mdi mdi-plus"></i></label>
                                                    <label class="plus-input-small <? if($row['ct_image']) echo ''; else echo 'd-none';?>" id="ct_image_box" style="width: 140px;height: 140px;border: none;">
                                                        <?if($_GET['act'] != "input") {?><img onclick="f_popup_image('<?=$row['idx']?>')" src='<?=$ct_img_url."/".$row['ct_image']."?cache=".time()?>' style="width: 140px;height: 140px;"><?}?>
                                                        <!-- <i class="mdi mdi-close" style="position: relative;bottom: 165px;left: 58px;color:red;cursor: pointer;font-size: 20px;" onclick="del_img('<?=$row['ct_idx']?>', 'image', '<?=$row['ct_image']?>')"></i> -->
                                                    </label>
                                                    <div class="input-group">
                                                        <small id="select_category_help" class="form-text text-muted">
                                                            * 16:9비율(최소크기 : 297px * 167px) 이미지 확장자로 등록해주세요.
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item <? if(!$row['ct_preview']) echo 'd-none';?>" id="preview_area">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">미리보기 영상 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="ct_preview" id="ct_preview" value="<?=$row['ct_preview']?>" accept=".mp4" class="d-none">
                                                    <input type="hidden" name="ct_preview_on" id="ct_preview_on" value="<?=$row['ct_preview']?>" class="form-control">

                                                    <label for="ct_preview" class="plus-input-small" style="width: 140px;height: 140px;line-height: 140px;"><i class="mdi mdi-plus"></i></label>
                                                    <label class="plus-input-small <? if($row['ct_preview']) echo ''; else echo 'd-none';?>" id="ct_preview_box" style="width: 140px;height: 140px;border: none;">
                                                        <?if($_GET['act'] != "input") {?>
                                                        <video controls width="300" height="100%">
                                                            <source src="<?=$ct_audio_url."/preview/".$row['ct_preview']."?cache=".time()?>" type="video/mp4">
                                                        </video>
                                                        <?}?>
                                                    </label>
                                                    <div class="input-group">
                                                        <small id="select_category_help" class="form-text text-muted">
                                                            * 16:9비율(최소크기 : 297px * 167px)<br>
                                                            * mp4 확장자만 업로드 가능합니다. (15초 이내로 등록해주세요.)
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">업로드 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="ct_file" id="ct_file" value="<?=$row['ct_file']?>" accept=".jpeg, .jpg, .png, .gif" class="d-none">
                                                    <input type="hidden" name="ct_file_on" id="ct_file_on" value="<?=$row['ct_file']?>" class="form-control">

                                                    <label for="ct_file" class="plus-input-small dropBox" style="width: 300px;height: 140px;line-height: 140px;"><span>이곳에 파일을 드롭해주세요.</span></label>
                                                    <label class="plus-input-small mr-5" id="ct_file_box" style="width: 300px;height: 140px;
                                                    <? if($row['ct_file']) echo ''; else echo 'display: none;';?>">
                                                        <?
                                                        if($row['ct_file']) {
                                                            $key = $row['ct_file'];
                                                            $cmd = $s3->getCommand('GetObject', [
                                                                'Bucket' => $bucket,
                                                                'Key' => $key
                                                            ]);
                                                            $request = $s3->createPresignedRequest($cmd, '+20 minutes');
                                                            $presignedUrl = (string)$request->getUri();
                                                        }

                                                        if($_GET['ct_type'] == 1 && $_GET['act'] != "input") {
                                                        ?>
                                                            <video controls width="300" height="100%">
                                                                <source src="<?=$presignedUrl?>" type="video/<?=$row['ct_format']?>">
                                                            </video>
                                                            <!-- <i class="mdi mdi-close" style="position: relative;bottom: 165px;left: 135px;color:red;cursor: pointer;font-size: 20px;" onclick="del_img('<?=$row['ct_idx']?>', 'image', '<?=$row['ct_file']?>')"></i> -->
                                                        <?
                                                        } else if($_GET['ct_type'] == 2 && $_GET['act'] != "input") {
                                                        ?>
                                                            <img onclick="f_popup_image2('<?=$row['idx']?>')" src='<?=$presignedUrl?>' style="width: 100%;height: 100%;">
                                                        <?
                                                        }
                                                        ?>
                                                    </label>
                                                    <div class="mt-3">
                                                        <b>주의사항</b>
                                                        <small id="select_category_help" class="form-text text-muted">
                                                            1. 파일은 정해진 크기와 확장자로 업로드 합니다.<br/>
                                                            2. 악성코드가 포함된 파일을 발견시 제지를 받을 수 있습니다.<br/>
                                                            3. 콘텐츠는 제3자의 저작권을 침해하지 않도록 주의의무를 다하여야 합니다.<br/>
                                                            이를 위반할 경우 모든 책임은 업로드 회원에게 있습니다.
                                                        </small>
                                                    </div>
                                                    <?
                                                    if($_GET['act'] != "input") {
                                                    ?>
                                                    <div class="mt-3">
                                                        <a href="<?=$presignedUrl?>" download=""><button type="button" class="btn btn-primary">다운로드</button></a>
                                                    </div>
                                                    <? } ?>
                                                    <div class="input-group">
                                                    <small id="select_category_help" class="form-text text-muted">
                                                        * 16:9비율(최소크기 : 297px * 167px)
                                                    </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label class="col-sm-2 col-form-label">해상도 (중복선택불가)</label>
                                                <div class="col-sm-10">
                                                    <input type="hidden" value="<?=$row['ct_resolution']?>" id="ct_resolution" name="ct_resolution" />
                                                    <div class="btn-group" role="group" aria-label="ct_resolution">
                                                        <button type="button" onclick="f_ct_resolution('6K+');" id="f_ct_resolution_btn1" class="btn btn-outline-secondary <? if($row['ct_resolution']=='6K+') { ?> btn-info text-white<? } ?>">6K+</button>
                                                        <button type="button" onclick="f_ct_resolution('4K');" id="f_ct_resolution_btn2" class="btn btn-outline-secondary <? if($row['ct_resolution']=='4K') { ?> btn-info text-white<? } ?>">4K</button>
                                                        <button type="button" onclick="f_ct_resolution('QHD');" id="f_ct_resolution_btn3" class="btn btn-outline-secondary <? if($row['ct_resolution']=='QHD') { ?> btn-info text-white<? } ?>">QHD</button>
                                                        <button type="button" onclick="f_ct_resolution('FHD');" id="f_ct_resolution_btn4" class="btn btn-outline-secondary <? if($row['ct_resolution']=='FHD') { ?> btn-info text-white<? } ?>">FHD</button>
                                                        <button type="button" onclick="f_ct_resolution('HD');" id="f_ct_resolution_btn5" class="btn btn-outline-secondary <? if($row['ct_resolution']=='HD') { ?> btn-info text-white<? } ?>">HD</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_filter" class="col-sm-2 col-form-label">호환프로그램 (중복선택가능)</label>
                                                <div class="col-sm-10">
                                                    <input type="hidden" id="ct_program" name="ct_program" value="<?=$row['ct_program']?>"/>
                                                    <?
                                                    foreach($arr_program as $key => $val) {
                                                    if($key>0) {
                                                    $program = explode(",", $row['ct_program']);
                                                    foreach ($program as $p_row) {
                                                        if($key == $p_row) {
                                                            $chk = "Y";
                                                            break;
                                                        } else {
                                                            $chk = "N";
                                                        }
                                                    }
                                                    ?>
                                                    <div class="custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" id="program<?=$key?>" name="program" value="<?=$key?>" <?=$chk == "Y" ? 'checked=""' : ''?> class="custom-control-input">
                                                        <label class="custom-control-label" for="program<?=$key?>">
                                                            <?
                                                            if($key == 1) {
                                                                $url = 'ic_premiere.png';
                                                            } else if($key == 2) {
                                                                $url = 'ic_aftereffect.png';
                                                            } else if($key == 3) {
                                                                $url = 'ic_davinci.png';
                                                            } else if($key == 4) {
                                                                $url = 'ic_vegas.png';
                                                            } else if($key == 5) {
                                                                $url = 'ic_finalcut.png';
                                                            } else if($key == 6) {
                                                                $url = 'ic_illustrator.png';
                                                            } else if($key == 7) {
                                                                $url = 'ic_photoshop.png';
                                                            } else {
                                                                $url = 'ic_indesign.png';
                                                            }
                                                            ?>
                                                            <img src="<?=STATIC_HTTP."/images"."/".$url?>" style="width: 50px;height: 50px;">
                                                        </label>
                                                    </div>
                                                    <?
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group row align-items-center mb-0">
                                                <label for="ct_title" class="col-sm-2 col-form-label">판매가격 <i class="mdi mdi-circle-medium text-danger"></i></label>
                                                <div class="col-sm-2">
                                                    <div class="input-group">
                                                        <input type="text" name="ct_price" id="ct_price" value="<?=$row['ct_price']?>" class="form-control" numberonly="" maxlength="10">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">원</span>
                                                        </div>
                                                        <small id="select_category_help" class="form-text text-danger">
                                                            1,000원이상 200,000원이하로 입력해 주세요.
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="fixed-bottom product_form">
                                <p class="p-3 mt-3 text-center">
                                    <input type="button" value="목록" onclick="location.href='<?=$list_url_t."?".$_get_txt?>'" class="btn btn-outline-secondary mx-2" />
                                    <input type="submit" value="저장" class="btn btn-info" />
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#ct_show").val("<?=$row['ct_show']?>");
            if("<?=$_act?>" == "input") {
                $("#ct_framerate").val("24");
            } else {
                $("#ct_framerate").val("<?=$row['ct_framerate']?>");
            }

            $("#ct_cate_idx").val("<?=$row['ct_cate_idx']?>");
            if("<?=$row['ct_cate_idx2']?>" != "") {
                $("#ct_cate_idx2").val("<?=$row['ct_cate_idx2']?>");
            }

            var html = f_format($("#ct_cate_idx2 option:checked").text());
            $("#ct_format").html(html);
            $("#ct_format").val("<?=$row['ct_format']?>");
            $("#ct_file").attr("accept", ".<?=$row['ct_format']?>");

            // var extension = f_extension($("#ct_cate_idx2 option:checked").text());
            // $("#ct_file").attr("accept", extension);

            if($("#editorial").is(":checked") == true) {
                $("#ct_editorial").val("Y");
            } else {
                $("#ct_editorial").val("N");
            }
            if($("#exclusive").is(":checked") == true) {
                $("#ct_exclusive").val("Y");
            } else {
                $("#ct_exclusive").val("N");
            }
        });
        function frm_form_chk(f) {
            if(f.ct_title.value=="") {
                alert("컨텐츠명을 입력해주세요.");
                f.ct_title.focus();
                return false;
            }
            if(f.ct_cate_idx.value=="") {
                alert("카테고리 1차분류를 선택해주세요.");
                return false;
            }
            if(f.ct_cate_idx2.value=="") {
                alert("카테고리 2차분류를 선택해주세요.");
                return false;
            }
            if(f.ct_format.value=="") {
                alert("포맷을 선택해주세요.");
                return false;
            }
            if(f.ct_cate_idx2.value!="12"&&f.ct_cate_idx2.value!="14"&&f.ct_cate_idx2.value!="15"&&f.ct_cate_idx2.value!="16") {
                var v = '';
                var c = 0;
                for (var i = 0; i < $("input[name=filter]:checkbox").length; i++) {
                    if ($("input[name=filter]:checkbox")[i].checked == true) {
                        if (c > 0) v = v + ",";
                        v = v + $("input[name=filter]:checkbox")[i].value;
                        c++;
                    }
                }
                if (c < 1) {
                    alert("필터링 카테고리를 하나 이상 선택해주세요.");
                    return false;
                } else {
                    $("#ct_filter").val(v);
                }
            }
            if(f.ct_image.value=="" && f.ct_image_on.value=="") {
                alert("대표 썸네일을 등록해주세요.");
                return false;
            }
            if(f.ct_cate_idx2.value==14||f.ct_cate_idx2.value==15) {
                if(f.ct_preview.value=="" && f.ct_preview_on.value=="") {
                    alert("미리보기 영상을 등록해주세요.");
                    f.ct_preview.focus();
                    return false;
                }
            }
            if(f.ct_file.value=="" && f.ct_file_on.value=="") {
                alert("업로드할 파일을 등록해주세요.");
                return false;
            }
            if(f.ct_price.value=="") {
                alert("판매가격을 입력해주세요.");
                f.ct_price.focus();
                return false;
            } else {
                if(f.ct_price.value < 1000 || f.ct_price.value > 200000) {
                    alert("판매가격은 1,000원이상 200,000원이하로 입력해 주세요.");
                    f.ct_price.focus();
                    return false;
                }
            }
            var v = '' ;
            var c = 0;
            for (var i = 0; i < $("input[name=program]:checkbox").length; i++) {
                if ($( "input[name=program]:checkbox")[i].checked == true) {
                    if (c > 0) v = v + "," ;
                    v = v + $("input[name=program]:checkbox")[i].value;
                    c++;
                }
            }
            $("#ct_program").val(v);

            $('#splinner_modal').modal('show');
        }
        const dropZone = document.querySelector(".dropBox");
        const $title = document.querySelector(".dropBox span");
        var $file = document.getElementById("ct_file");

        var toggleClass = function(className) {
            var list = ["dragenter", "dragleave", "dragover", "drop"]

            for (var i = 0; i < list.length; i++) {
                if (className === list[i]) {
                    dropZone.classList.add("active")
                } else {
                    dropZone.classList.remove("active")
                }
            }
        }

        var showFiles = function(files) {
            $title.innerHTML = ""
            for(var i = 0, len = files.length; i < len; i++) {
                $title.innerHTML += files[i].name+"<br>";
            }
        }

        var selectFile = function(files) {
            // input file 영역에 드랍된 파일들로 대체
            $file.files = files
            showFiles($file.files)
        }

        // $file.addEventListener("change", function(e) {
        //     showFiles(e.target.files)
        // })

        // 드래그한 파일이 최초로 진입했을 때
        dropZone.addEventListener("dragenter", function(e) {
            e.stopPropagation()
            e.preventDefault()

            toggleClass("dragenter")
        })

        // 드래그한 파일이 dropZone 영역을 벗어났을 때
        dropZone.addEventListener("dragleave", function(e) {
            e.stopPropagation()
            e.preventDefault()

            toggleClass("dragleave")
        })

        // 드래그한 파일이 dropZone 영역에 머물러 있을 때
        dropZone.addEventListener("dragover", function(e) {
            e.stopPropagation()
            e.preventDefault()

            toggleClass("dragover")
        })

        // 드래그한 파일이 드랍되었을 때
        dropZone.addEventListener("drop", function(e) {
            e.preventDefault()

            toggleClass("drop")

            var files = e.dataTransfer && e.dataTransfer.files

            if (files != null) {
                if (files.length < 1) {
                    alert("폴더 업로드 불가")
                    return false;
                }
                selectFile(files)
            } else {
                alert("ERROR")
            }
        })

        $('#ct_image').on('change', function(e) {
            var target_id = e.target.id;
            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);

            filesArr.forEach(function(f) {
                if(!f.type.match("image.*")) {
                    alert("확장자는 이미지 확장자만 가능합니다.");
                    return;
                }

                sel_files.push(f);

                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#"+target_id+"_box").removeClass('d-none');
                    $("#"+target_id+"_box").css('border', 'none');
                    $("#"+target_id+"_box").html('<img src="'+e.target.result+'" style="width: 100%;height: 100%;" /><i class="mdi mdi-close" style="position: relative;bottom: 165px;left: 58px;color:red;cursor: pointer;font-size: 20px;" onclick="del_img2('+target_id+')"></i>')
                }
                reader.readAsDataURL(f);
            });
        });
        $('#ct_preview').on('change', function(e) {
            var target_id = e.target.id;
            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);

            filesArr.forEach(function(f) {
                sel_files.push(f);

                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#"+target_id+"_box").removeClass('d-none');
                    $("#"+target_id+"_box").css('border', 'none');
                    $("#"+target_id+"_box").html('<video src="'+e.target.result+'" style="width: 100%;height: 100%;" />');
                }
                reader.readAsDataURL(f);
            });
        });
        $('#ct_file').on('change', function(e) {
            var target_id = e.target.id;
            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);

            filesArr.forEach(function(f) {
                sel_files.push(f);

                var reader = new FileReader();
                reader.onload = function(e) {
                    $title.innerHTML = f.name+"<br>";
                }
                reader.readAsDataURL(f);

                var size = f.size;
                size = size / 1024 / 1024;
                $("#ct_size").val(size.toFixed(1)+"MB");
            });
        });
        $('#ct_file').on('click', function(e) {
            if($("#ct_format").val() == "") {
                alert("포맷을 선택해주세요.");
                return false;
            } else {
                $("#ct_file").attr("accept", "."+$("#ct_format").val());
            }
        });
        function del_img(id, num) {
            if(confirm("이미지를 삭제하시겠습니까?\n※삭제한 이미지는 복구할 수 없습니다.")) {
                var file_name = id.substring(0,10);
                $.ajax({
                    type: 'post',
                    url: './product_update.php',
                    dataType: 'json',
                    data: {act: 'del_img', idx: $("#pt_idx").val(), name: $(file_name+"_on").val(), num: num},
                    success: function (d, s) {
                        if(d['result'] == "_ok") {
                            alert(d['msg']);
                            location.reload();
                        }
                    },
                    cache: false
                });
            }
        }
        function f_popup_image(idx) {
            $.post('./contents_update.php', {act: 'popup_image', idx: idx}, function (data) {
                if(data) {
                    $('#modal-default-content').html(data);

                    $('#product-swiper').slick({
                        dots: true,
                        infinite: false,
                        speed: 300,
                        variableWidth: true,
                        slidesToShow: 1,
                    });

                    $('#modal-default').modal();
                }
            });

            return false;
        }
        function f_popup_image2(idx) {
            $.post('./contents_update.php', {act: 'popup_image2', idx: idx}, function (data) {
                if(data) {
                    $('#modal-default-content').html(data);

                    $('#product-swiper').slick({
                        dots: true,
                        infinite: false,
                        speed: 300,
                        variableWidth: true,
                        slidesToShow: 1,
                    });

                    $('#modal-default').modal();
                }
            });

            return false;
        }
        $("#ct_cate_idx2").on("change", function() {
            var html = f_format($("#ct_cate_idx2 option:checked").text());
            $("#ct_format").html(html);
            if($("#ct_cate_idx2").val()==14||$("#ct_cate_idx2").val()==15) {
                $("#preview_area").removeClass("d-none");
                $("#filtering_category").html("필터링 카테고리(중복선택가능) ");
            } else {
                if($("#ct_cate_idx2").val()==12||$("#ct_cate_idx2").val()==16) {
                    $("#filtering_category").html("필터링 카테고리(중복선택가능) ");
                } else {
                    $("#filtering_category").html($("#filtering_category").text()+" <i class='mdi mdi-circle-medium text-danger'></i>");
                }
                $("#preview_area").addClass("d-none");
            }
            // var extension = f_extension($("#ct_cate_idx2 option:checked").text());
            // $("#ct_file").attr("accept", extension);
        });
        $("#editorial").on("click", function() {
            if($("#editorial").is(":checked") == true) {
                $("#ct_editorial").val("Y");
            } else {
                $("#ct_editorial").val("N");
            }
        });
        $("#exclusive").on("click", function() {
            if($("#exclusive").is(":checked") == true) {
                $("#ct_exclusive").val("Y");
            } else {
                $("#ct_exclusive").val("N");
            }
        });
        $("#ct_cate_idx").on("change", function() {
            $.ajax({
                type: 'post',
                url: './contents_update.php',
                dataType: 'json',
                data: {act: "get_category", idx: $("#ct_cate_idx").val()},
                success: function (d, s) {
                    if(d['result'] == "ok") {
                        $("#ct_cate_idx2").html(d['data']);
                        $("#ct_format").html('');
                    }
                },
                cache: false
            });
        });
    </script>
<?
include "./foot_inc.php";
?>