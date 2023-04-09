<!--입력 x-->
<div class="modal fade" id="id_alert" tabindex="-1" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-sm">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <lottie-player src="img/lottie_warning.json" class="lottie" style="width: 104px; height: 104px;" background="transparent"  speed="1" autoplay loop></lottie-player>
                <div class="sign_success">
                    <div class="success_tit"><h3 class="fw_600" id="txt">아이디를 입력해주세요.</h3></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?=$confirm?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="splinner_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="text-center">
                <div class="spinner-border m-5" role="status">
                </div>
            </div>
            <div class="text-center mb-5">
                <span class="text-secondary">처리중입니다. 잠시만 기다려주세요.<br>약간의 시간이 소요됩니다.</span>
            </div>
        </div>
    </div>
</div>