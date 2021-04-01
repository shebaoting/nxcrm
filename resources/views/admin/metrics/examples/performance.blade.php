<style>
    .performance {overflow: hidden;}
    .performance .progress-bar {
        background-color: #6259ca;
        border-radius: 10px;
    }

    .performance .ht-6 {
        height: 6px;
    }

    .performance .progress {
        display: flex;
        height: 6px;
        overflow: hidden;
        font-size: .65625rem;
        background-color: #f0f0ff;
        border-radius: 3px;
    }

</style>


<div class="card-body performance">


    @foreach ($programs as $k => $v)

@php
if ($v) {
   $value = intval(($dailydata[$k]/$v)*100);
   $value1 = intval((intval($dailydata[$k])/intval($v))*100);
}else {
   $value = 0;
   $value1 = 0;
}
@endphp


    @if ($k == 'add_contract')
    <div class="row mt-1">
        <div class="col-5">
            <span class="">新增合同数</span>
        </div>
        <div class="col-4 my-auto">
            <div class="progress ht-6 my-auto">
                <div class="progress-bar ht-6" role="progressbar" style="width: {{$value}}%" aria-valuenow="15"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="col-3">
            <div class="d-flex">
                <span class="tx-13"><i class="text-success fe fe-arrow-up"></i><b>{{$value}}%</b></span>
            </div>
        </div>
    </div>
    @elseif ($k == 'add_customer')
    <div class="row mt-1">
        <div class="col-5">
            <span class="">新增客户</span>
        </div>
        <div class="col-4 my-auto">
            <div class="progress ht-6 my-auto">
                <div class="progress-bar ht-6" role="progressbar" style="width: {{$value}}%" aria-valuenow="15"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="col-3">
            <div class="d-flex">
                <span class="tx-13"><i class="text-success fe fe-arrow-up"></i><b>{{$value}}%</b></span>
            </div>
        </div>
    </div>
    @elseif ($k == 'add_opportunity')
    <div class="row mt-1">
        <div class="col-5">
            <span class="">新增商机</span>
        </div>
        <div class="col-4 my-auto">
            <div class="progress ht-6 my-auto">
                <div class="progress-bar ht-6" role="progressbar" style="width: {{$value}}%" aria-valuenow="15"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="col-3">
            <div class="d-flex">
                <span class="tx-13"><i class="text-success fe fe-arrow-up"></i><b>{{$value}}%</b></span>
            </div>
        </div>
    </div>
    @elseif ($k == 'add_receipt_sum')
    <div class="row mt-1">
        <div class="col-5">
            <span class="">新增收款金额</span>
        </div>
        <div class="col-4 my-auto">
            <div class="progress ht-6 my-auto">
                <div class="progress-bar ht-6" role="progressbar" style="width: {{$value1}}%" aria-valuenow="15"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="col-3">
            <div class="d-flex">
                <span class="tx-13"><i class="text-success fe fe-arrow-up"></i><b>{{$value1}}%</b></span>
            </div>
        </div>
    </div>
    @elseif ($k == 'add_opportunity_sum')
    <div class="row mt-1">
        <div class="col-5">
            <span class="">新增商机金额</span>
        </div>
        <div class="col-4 my-auto">
            <div class="progress ht-6 my-auto">
                <div class="progress-bar ht-6" role="progressbar" style="width: {{$value1}}%" aria-valuenow="15"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="col-3">
            <div class="d-flex">
                <span class="tx-13"><i class="text-success fe fe-arrow-up"></i><b>{{$value1}}%</b></span>
            </div>
        </div>
    </div>
    @elseif ($k == 'add_contract_sum')
    <div class="row mt-1">
        <div class="col-5">
            <span class="">新增合同金额</span>
        </div>
        <div class="col-4 my-auto">
            <div class="progress ht-6 my-auto">
                <div class="progress-bar ht-6" role="progressbar" style="width: {{$value1}}%" aria-valuenow="15"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="col-3">
            <div class="d-flex">
                <span class="tx-13"><i class="text-success fe fe-arrow-up"></i><b>{{$value1}}%</b></span>
            </div>
        </div>
    </div>
    @else
    <div class="row mt-1">
        <div class="col-5">
            <span class="">新增客户</span>
        </div>
        <div class="col-4 my-auto">
            <div class="progress ht-6 my-auto">
                <div class="progress-bar ht-6" role="progressbar" style="width: 25%" aria-valuenow="15"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="col-3">
            <div class="d-flex">
                <span class="tx-13"><i class="text-success fe fe-arrow-up"></i><b>241.75%</b></span>
            </div>
        </div>
    </div>
    @endif

    @endforeach




</div>
