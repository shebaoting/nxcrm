<div class="markdown-body editormd-html-preview">
    <div class="upload_go btn btn-primary"><i class="feather icon-plus"></i><a
            href="{{ route('contracts.edit',$contract['id']) }}">修改订单</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <td scope="col">服务内容</td>
                <td scope="col">标准价</td>
                <td scope="col">成交价</td>
                <td scope="col">数量</td>
                <td scope="col">单位</td>
                {{-- <td scope="col">合计</td> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order_content)
            <tr>
                <td>{{App\Models\CrmProduct::find($order_content->crm_product_id)->name}}</td>
                {{-- 标准价，在合同添加页面获取到标准价以后，这里的判断就可以删除了 --}}
                <td>{{(!empty($order_content->prodprice))?($order_content->prodprice):0}}</td>
                <td>{{$order_content->executionprice}}</td>
                <td>{{$order_content->quantity}}</td>
                <td>
                   {{App\Models\CrmProduct::find($order_content->crm_product_id)->unit}}
                </td>
                {{-- <td>{{$order_content->quantity * $order_content->executionprice}} 元</td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
