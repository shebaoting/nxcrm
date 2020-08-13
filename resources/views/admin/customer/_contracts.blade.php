<div class="markdown-body editormd-html-preview">
    <div class="upload_go btn btn-primary"><i class="feather icon-plus"></i><a
            href="{{ route('contracts.create',$customer['id']) }}">添加合同</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <td scope="col">合同号</td>
                <td scope="col">合同标题</td>
                <td scope="col">签署时间</td>
                <td scope="col">到期时间</td>
                <td scope="col">合同金额</td>
                <td scope="col">合同状态</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($contracts as $contract)
            <tr>
                <td>{{$contract['id']}}</td>
                <td>{{$contract['title']}}</td>
                <td>{{$contract['signdate']}}</td>
                <td>{{$contract['expiretime']}}</td>
                <td>{{$contract['total']}}</td>
                <td>
                    @switch($contract['status'])
                    @case(1)
                    未开始
                    @break
                    @case(2)
                    执行中
                    @break
                    @case(3)
                    正常结束
                    @break
                    @default
                    意外终止
                    @endswitch
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>







</div>