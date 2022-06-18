<div class="d-flex justify-content-between align-items-start flex-wrap my-0">
    <!--begin::Title-->
    <h2 class="fw-bold fs-2 my-1">票据</h2>
    <!--end::Title-->
    <!--begin::Controls-->
    <div class="d-flex my-1">
        <a class="btn btn-primary btn-sm" href="{{ admin_route('invoices.index') }}"><i class="feather icon-plus"></i>录入票据</a>
    </div>
    <!--end::Controls-->
</div>
@if ($invoices->count())
<div class="card receipts">
    <div class="card-body py-1">
        <div class="markdown-body editormd-html-preview">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <td scope="col">票据类型</td>
                        <td scope="col">票据状态</td>
                        <td scope="col">开票金额</td>
                        <td scope="col">开票日期</td>
                        <td scope="col">抬头类型</td>
                        <td scope="col">抬头名称</td>
                        <td scope="col">所属合同</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                    <tr>
                        <td>
                            @switch($invoice['type'])
                            @case(1)
                            <span class="badge badge-primary">普票</span>
                            @break
                            @case(2)
                            <span class="badge badge-success">专票</span>
                            @break
                            @default
                            <span class="badge badge-info">收据</span>
                            @endswitch
                        </td>
                        <td>
                            @switch($invoice['state'])
                            @case(0)
                            <span class="badge badge-light">未开票</span>
                            @break
                            @case(1)
                            <span class="badge badge-info">已开票</span>
                            @break
                            @case(2)
                           <span class="badge badge-success">已领取</span>
                            @break
                            @case(3)
                            <span class="badge badge-danger">已驳回</span>
                            @break
                            @default
                            <span class="badge badge-dark">已作废</span>
                            @endswitch
                        </td>
                        <td>{{$invoice['money']}} 元</td>
                        <td>{{$invoice['created_at']}}</td>
                        <td>
                            @switch($invoice['title_type'])
                            @case(1)
                            单位
                            @break
                            @case(2)
                            个人
                            @break
                            @default
                            其他
                            @endswitch
                        </td>
                        <td>{{$invoice['title']}}</td>
                        <td><a href="{{ admin_route('contracts.show',[$invoice['crm_contract_id']]) }}"># {{$invoice['crm_contract_id']}}</a></td>
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
        本客户目前没有票据记录
    </x-slot>
    您可以点击右上方添加票据按钮<br>来快速录入票据
</x-blank_tips>
@endif
