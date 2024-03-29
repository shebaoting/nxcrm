<div class="markdown-body editormd-html-preview">

    <div class="upload_go btn btn-primary"><i class="feather icon-plus"></i><a
            href="{{ admin_route('receipts.deposit',['contract_id'=>$contract['id']]) }}">增加支出</a>
    </div>


    <div class="row receipts">
        <div class="col-md-4 col-sm-4 col-12 receipts-left">
            <p class="mbm">
                <span class="xco ffmy text-primary">￥</span><span class="xco fsh text-primary">{{$salesexpenses}}</span>
            </p>
            <span>已支出</span>
        </div>

        <div class="col-md-12 col-sm-12 col-12" style="margin:20px 0">
            <table class="table table-striped">
                <thead>
                    <tr class="meter_head">
                        <td>支出日期</td>
                        <td>支出金额</td>
                        <td>支付方式</td>
                        <td>票据类型</td>
                        <td>备注</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($receipts as $receipt)
                        @if($receipt->type !== 2)
                            @continue
                        @endif
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
