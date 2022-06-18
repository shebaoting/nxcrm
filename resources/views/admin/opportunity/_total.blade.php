<div class="card-header">
    <div>
        <h4 class="card-title">预期收入</h4>
    </div>
</div>

<div class="box-body">

    <h2>{{$opportunity['expectincome']}} <span style="font-size: 12px">元</span></h2>


    <div class="row" style="margin-top: 20px;">
        <div class="col-md-5"> <span class="sale"><i class="feather icon-credit-card"></i>成交几率：</span>
        </div>
        <div class="col-md-7">

            <div class="progress" style="height: 20px;">
                <div class="progress-bar" role="progressbar" style="width: {{$opportunity['dealchance']}}%;"
                    aria-valuenow="{{$opportunity['dealchance']}}" aria-valuemin="0" aria-valuemax="100">
                    {{$opportunity['dealchance']}}%</div>
            </div>
        </div>
    </div>


    <span class="time">
        <i class="feather icon-clipboard"></i>预计成交日：{{$opportunity['expectendtime']}}
    </span>

</div>
