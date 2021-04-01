<style>
    .card-box img {
        position: absolute;
        bottom: -3px;
        left: -3px;
    }

    .wd-200 {
        width: 200px;
    }
.CrmPersoninfo .p-4 {
    padding: 1.5rem!important;
}
.CrmPersoninfo .img-bg {
    background: url(static/img/Stars.png);
    background-position: 100%;
    background-size: auto;
    background-repeat: no-repeat;
}
.CrmPersoninfo .mb-3, .CrmPersoninfo .my-3 {
    margin-bottom: 1rem!important;
}
</style>
<div class="card bg-primary custom-card card-box CrmPersoninfo">
    <div class="card-body p-4">
        <div class="row align-items-center">
            <div class="offset-xl-3 offset-sm-6 col-xl-8 col-sm-6 col-12 img-bg ">
                <h4 class="d-flex  mb-3">
                    <span class="font-weight-bold text-white ">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">嗨，{{Admin::user()->name}}</font>
                        </font>
                    </span>
                </h4>
                <p class="tx-white-7 mb-1">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">对未来的真正慷慨，是把一切献给现在, 努力工作吧， 骚年！</font>
                    </font>
                </p>
            </div>
            <img src="static/img/work3.png" alt="用户img" class="wd-200">
        </div>
    </div>
</div>
