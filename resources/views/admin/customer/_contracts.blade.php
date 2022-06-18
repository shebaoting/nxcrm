<div class="d-flex justify-content-between align-items-start flex-wrap my-0">
    <!--begin::Title-->
    <h2 class="fw-bold fs-2 my-1">合同</h2>
    <!--end::Title-->
    <!--begin::Controls-->
    <div class="d-flex my-1">
        <a class="btn btn-primary btn-sm" href="{{ admin_route('contracts.create',[$customer['id']]) }}"><i class="feather icon-plus"></i>签订合同</a>
    </div>
    <!--end::Controls-->
</div>
@php
use Carbon\Carbon;
@endphp
@if ($contracts->count())
<div class="card receipts">
    <div class="card-body py-1">
        <div class="markdown-body editormd-html-preview">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <td scope="col">合同号</td>
                        <td scope="col">签署时间</td>
                        <td scope="col">到期时间</td>
                        <td scope="col">合同金额</td>
                        <td scope="col">合同状态</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contracts as $contract)
                    @php
                    if(Carbon::now() < $contract['signdate']){
                        $status = 0;
                    }elseif (Carbon::now() > $contract['expiretime']) {
                        $status = 2;
                    }else {
                        $status = 1;
                    }
                    @endphp
                    <tr>
                        <td><a href="{{ admin_route('contracts.show',[$contract['id']]) }}"># {{$contract['id']}}</a></td>
                        <td>{{$contract['signdate']}}</td>
                        <td>{{$contract['expiretime']}}</td>
                        <td>{{$contract['total']}}</td>
                        <td>
                            @switch($status)
                            @case(0)
                            <span class="badge badge-primary">未开始</span>
                            @break
                            @case(1)
                            <span class="badge badge-success">执行中</span>
                            @break
                            @case(2)
                           <span class="badge badge-danger">已结束</span>
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
    </div>
</div>
@else
<x-blank_tips>
    <x-slot name="title">
        本客户目前没有签订任何合同
    </x-slot>
    您可以点击右上方签订合同按钮<br>来快速签订合同
</x-blank_tips>
@endif
