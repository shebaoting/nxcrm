<div class="card-header">
    <div>
        <h4 class="card-title">预期收入</h4>
    </div>
</div>

<div class="box-body">

    <h2>{{$contract['total'] - $contract['salesexpenses']}} <span style="font-size: 12px">元</span></h2>
    <span class="sale"><i class="feather icon-credit-card"></i>合同金额：{{$contract['total']}}
        元</span>
    <span class="sale"><i class="feather icon-credit-card"></i>商务支出：{{$contract['salesexpenses']}}
        元</span>
</div>
