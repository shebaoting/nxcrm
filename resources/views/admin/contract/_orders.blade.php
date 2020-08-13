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
                <td scope="col">合计</td>
            </tr>
        </thead>
        <tbody>
            @foreach (json_decode($contract['order']) as $order_content)
            <tr>
                <td>{{$order_content->prodname}}</td>
                <td>{{$order_content->prodprice}}</td>
                <td>{{$order_content->executionprice}}</td>
                <td>{{$order_content->quantity}}</td>
                <td>
                    @switch($order_content->unit)
                    @case(1)
                    套
                    @break

                    @case(2)
                    个
                    @break

                    @case(3)
                    件
                    @break

                    @case(4)
                    张
                    @break

                    @case(5)
                    次
                    @break

                    @default
                    条
                    @endswitch
                </td>
                <td>{{$order_content->quantity * $order_content->executionprice}} 元</td>
            </tr>
            @endforeach
        </tbody>
    </table>







</div>