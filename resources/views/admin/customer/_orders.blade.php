<div class="d-flex justify-content-between align-items-start flex-wrap my-0">
    <!--begin::Title-->
    <h2 class="fw-bold fs-2 my-1">订单</h2>
    <!--end::Title-->
    <!--begin::Controls-->
    <div class="d-flex my-1">
        <a class="btn btn-primary btn-sm" href="{{ admin_route('order.index') }}"><i class="feather icon-plus"></i>查看订单</a>
    </div>
    <!--end::Controls-->
</div>
@if ($orders->count())
<div class="card receipts">
    <div class="card-body py-1">
        <div class="markdown-body editormd-html-preview">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <td scope="col">产品名称</td>
                        <td scope="col">销售日期</td>
                        <td scope="col">销售单价</td>
                        <td scope="col">销售数量</td>
                        <td scope="col">所属合同</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{App\Models\CrmProduct::find($order['crm_product_id'])->name}}</td>
                        <td>{{App\Models\CrmContract::find($order['crm_contract_id'])->signdate}}</td>
                        <td>{{$order['executionprice']}}</td>
                        <td>{{$order['quantity']}} 元</td>
                        <td><a href="{{ admin_route('contracts.show',[$order['crm_contract_id']]) }}"># {{$order['crm_contract_id']}}</a></td>
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
        本客户目前没有任何订单
    </x-slot>
    您可以在此客户的合同内添加产品<br>产品会自动生成订单
</x-blank_tips>
@endif
