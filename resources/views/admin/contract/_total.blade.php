<div class="card-header">
    <div>
        <h4 class="card-title">预期收入</h4>
    </div>
</div>

<div class="box-body">

    <h2>{{$contract['total']}} <span style="font-size: 12px">元</span></h2>
    <span class="sale"><i class="feather icon-credit-card"></i>销售费用：{{$contract['salesexpenses']}}
        元</span>

    <span class="time"><i class="feather icon-clipboard"></i>合同期限：{{$contract['signdate']}} ~
        {{$contract['expiretime']}}</span>
    <span class="time"><i class="feather icon-paperclip"></i>签署日期：{{$contract['signdate']}}</span>
</div>