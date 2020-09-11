<div class="card-header">
    <div>
        <h4 class="card-title">发票状态</h4>
    </div>
</div>

<div class="box-body">

    <h2 class="state{{$invoice['state']}}">
        @if ($invoice['state']==1)
        已开票
        @elseif ($invoice['state']==2)
        已领取
        @elseif ($invoice['state']==3)
        已驳回
        @elseif ($invoice['state']==4)
        已作废
        @else
        未开票
        @endif
    </h2>
    <span class="sale"><i class="feather icon-credit-card"></i>所属合同：{{$contract['title']}}</span>

    <span class="time"><i class="feather icon-clipboard"></i>此合同已开票：{{$invoice_sum}}元</span>
    <span class="time"><i class="feather icon-paperclip"></i>此合同已收款：{{$receipt_sum}}元</span>
</div>
