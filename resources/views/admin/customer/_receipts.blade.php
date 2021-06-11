<div class="d-flex justify-content-between align-items-start flex-wrap my-0">
    <!--begin::Title-->
    <h2 class="fw-bold fs-2 my-1">收支</h2>
    <!--end::Title-->
    <!--begin::Controls-->
    <div class="d-flex my-1">
        <a class="btn btn-primary btn-sm" href="{{ admin_route('receipts.index') }}"><i class="feather icon-plus"></i>录入收支</a>
    </div>
    <!--end::Controls-->
</div>
@if ($receipts->count())
<div class="card receipts">
    <div class="card-body py-1">
        <div class="markdown-body editormd-html-preview">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <td scope="col">收支类型</td>
                        <td scope="col">所属合同</td>
                        <td scope="col">日期</td>
                        <td scope="col">金额</td>
                        <td scope="col">支付方式</td>
                        <td scope="col">票据类型</td>
                        <td scope="col">备注</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($receipts as $receipt)
                    <tr>
                        <td>
                            @if ($receipt['type'] == 1)
                            <span class="badge badge-success">收入</span>
                            @else
                            <span class="badge badge-warning">支出</span>
                            @endif
                        </td>
                        <td><a href="{{ admin_route('contracts.show',[$receipt['crm_contract_id']]) }}"># {{$receipt['crm_contract_id']}}</a></td>
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
@else
<x-blank_tips>
    <x-slot name="title">
        本客户目前没有收支款项
    </x-slot>
    您可以点击右上方添加收支按钮<br>来快速录入收支
</x-blank_tips>
@endif
