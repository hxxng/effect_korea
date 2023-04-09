<?php
$title = "자주묻는 질문";

include_once("./inc/head.php");
include_once("./inc/nav.php");
?>

<div class="wrap">
    <div class="con_wrap">
        <h2 class="h2_tit">자주묻는 질문</h2>

        <div class="accordion faq_wrap  " id="faq1">
            <div class="card">
                <div class="card-header " id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn text-left d-flex  " type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <div class="d-flex align-items-center w-90">

                                <span class="d-block  fw_600">탈퇴했는데 메일을 받았습니다. 혹시 제정보가 삭제되지 않은건가요?</span>
                            </div>
                            <span class="faq_arrow"><i class="bi bi-chevron-down fs_14"></i></span>
                        </button>
                    </h2>
                </div>
                <div id="collapseOne" class="collapse hodd" aria-labelledby="headingOne" data-parent="#faq1" style="">
                    <div class="card-body d-flex">

                        <p class="wh_pre fs_15">위즈위드에서는 회원탈퇴시 고객님 정보를 삭제하여 정보가 남아있지 않습니다.

                            다만, 탈퇴 이전에 광고 및 주문관련 메일이 이미 자동메일에 설정되어 있는 경우에는 탈퇴하신 후 2~3일 정도까지는 메일을 받아보실 수 있으니 이점 양해하여 주시기 바랍니다.
                            만약 3일 이후에도 메일을 받으시는 경우 고객지원센터[T.1566.1130]로 연락주시면 확인하여 드리겠습니다.</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn text-left d-flex   collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <div class="d-flex align-items-center w-90">

                                <span class="d-block  fw_600">탈퇴했는데 메일을 받았습니다. 혹시 제정보가 삭제되지 않은건가요?</span>
                            </div>
                            <span class="faq_arrow"><i class="bi bi-chevron-down fs_14"></i></span>
                        </button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faq1" style="">
                    <div class="card-body d-flex">

                        <p class="wh_pre fs_15">위즈위드에서는 회원탈퇴시 고객님 정보를 삭제하여 정보가 남아있지 않습니다.

                            다만, 탈퇴 이전에 광고 및 주문관련 메일이 이미 자동메일에 설정되어 있는 경우에는 탈퇴하신 후 2~3일 정도까지는 메일을 받아보실 수 있으니 이점 양해하여 주시기 바랍니다.
                            만약 3일 이후에도 메일을 받으시는 경우 고객지원센터[T.1566.1130]로 연락주시면 확인하여 드리겠습니다.</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="heading3">
                    <h2 class="mb-0">
                        <button class="btn text-left d-flex   collapsed" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                            <div class="d-flex align-items-center w-90">

                                <span class="d-block  fw_600">탈퇴했는데 메일을 받았습니다. 혹시 제정보가 삭제되지 않은건가요?</span>
                            </div>
                            <span class="faq_arrow"><i class="bi bi-chevron-down fs_14"></i></span>
                        </button>
                    </h2>
                </div>
                <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#faq1" style="">
                    <div class="card-body d-flex">

                        <p class="wh_pre fs_15">위즈위드에서는 회원탈퇴시 고객님 정보를 삭제하여 정보가 남아있지 않습니다.

                            다만, 탈퇴 이전에 광고 및 주문관련 메일이 이미 자동메일에 설정되어 있는 경우에는 탈퇴하신 후 2~3일 정도까지는 메일을 받아보실 수 있으니 이점 양해하여 주시기 바랍니다.
                            만약 3일 이후에도 메일을 받으시는 경우 고객지원센터[T.1566.1130]로 연락주시면 확인하여 드리겠습니다.</p>
                    </div>
                </div>
            </div>

        </div>

        
        <nav aria-label="Page navigation ">
                    <ul class="pagination mt-5">
                        <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li>
                    </ul>
                </nav>
    </div>

</div>

<? include_once("./inc/tail.php"); ?>