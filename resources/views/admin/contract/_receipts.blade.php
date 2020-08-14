<div class="markdown-body editormd-html-preview">

    <div class="upload_go btn btn-primary"><i class="feather icon-plus"></i><a
            href="{{ route('receipts.create',['contract_id'=>$contract['id']]) }}">增加收款</a>
    </div>


    <div class="row receipts">
        <div class="col-md-4 col-sm-4 col-12 receipts-left">
            <p class="mbm">
                <span class="xco ffmy">￥</span><span class="xco fsh">{{$accepts}}</span>
            </p>
            <span>已收款</span>
        </div>
        <div class="col-md-4 col-sm-4 col-12 receipts-center">

            <p class="mbm">
                <span class="fsh xwb">
                    {{$percentage = round($accepts/$contract['total']*100,2)}}%</span>
            </p>
            <span>收款进度</span>
        </div>
        <div class="col-md-4 col-sm-4 col-12 receipts-right">
            <p class="mbm">

                <span class="ffmy">￥</span><span
                    class="fsh">{{$contract['total'] - $accepts}}</span>
            </p>
            <span>待收款</span>
        </div>

        <div class="col-md-12 col-sm-12 col-12" style="margin:20px 0">
            <div class="progress" style="height: 20px;">
                <div class="progress-bar" role="progressbar"
                    style="width: {{$percentage}}%;" aria-valuenow="{{$percentage}}"
                    aria-valuemin="0" aria-valuemax="100">{{$percentage}}%</div>
            </div>
        </div>


        <div class="col-md-12 col-sm-12 col-12" style="margin:20px 0">
            <table class="table table-striped">
                <thead>
                    <tr class="meter_head">
                        <td>收款日期</td>
                        <td>收款金额</td>
                        <td>支付方式</td>
                        <td>票据类型</td>
                        <td>备注</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($receipts as $receipt)
                    <tr>
                        <td>{{$receipt['updated_at']}}</td>
                        <td>{{$receipt['receive']}} 元</td>
                        <td>
                            @switch($receipt['paymethod'])
                            @case(1)
                            银行转账
                            @break

                            @case(2)
                            微信
                            @break

                            @case(3)
                            支付宝
                            @break

                            @default
                            现金
                            @endswitch

                        </td>
                        <td>
                            @switch($receipt['billtype'])
                            @case(1)
                            收据
                            @break

                            @case(2)
                            发票
                            @break

                            @default
                            其他
                            @endswitch

                        </td>
                        <td>{{$receipt['remark']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>






    </div>




</div>