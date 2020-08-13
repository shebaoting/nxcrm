<div class="content-body" id="app">
    <div class="row customer_content">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="metric-content">
                                {{-- 头部合同标题等信息 --}}
                                @include('admin.contract._top')
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class=" card" style=";padding:.25rem .4rem .4rem">
                        <ul class="nav nav-tabs " role="tablist">
                            <li class="nav-item">
                                <a href="#tab_receipts" class="nav-link active" data-toggle="tab">收款</a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab_events" class="nav-link" data-toggle="tab">跟进</a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab_orders" class="nav-link" data-toggle="tab">订单</a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab_electronics" class="nav-link" data-toggle="tab">电子档</a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab_files" class="nav-link" data-toggle="tab">附件</a>
                            </li>

                            <li class="nav-item pull-right header"></li>
                        </ul>

                        <div class="tab-content" style="">
                            <div class="tab-pane active" id="tab_receipts">
                                {{-- 收款信息 --}}
                                @include('admin.contract._receipts')
                            </div>

                            <div class="tab-pane" id="tab_events">
                                {{-- 跟进信息 --}}
                                @include('admin.contract._events')
                            </div>

                            <div class="tab-pane" id="tab_orders">
                                {{-- 订单信息 --}}
                                @include('admin.contract._orders')
                            </div>

                            <div class="tab-pane" id="tab_electronics">
                                {{-- 电子档信息 --}}
                                @include('admin.contract._electronics')
                            </div>

                            <div class="tab-pane" id="tab_files">
                                {{-- 附件信息 --}}
                                @include('admin.contract._files')
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card total">
                {{-- 预期收入 --}}
                @include('admin.contract._total')
            </div>
        </div>
    </div>
</div>
