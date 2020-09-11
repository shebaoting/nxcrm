<div class="content-body" id="app">
    <div class="row customer_content">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="line-height:30px">发票编号：{{strtotime($invoice['created_at'])}}
                            </h3>
                            <div class="pull-right"></div>
                        </div>
                        <div class="card-body">
                            <div class="metric-content">
                                {{-- 头部发票信息等信息 --}}
                                @include('admin.invoice._top')
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="line-height:30px">发票信息</h3>
                            <div class="pull-right"></div>
                        </div>


                        <div class="card-body">
                            <div class="metric-content">
                                {{-- 头部发票信息等信息 --}}
                                @include('admin.invoice._info')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="line-height:30px">邮寄地址</h3>
                            <div class="pull-right"></div>
                        </div>


                        <div class="card-body">
                            <div class="metric-content">
                                {{-- 头部发票信息等信息 --}}
                                @include('admin.invoice._mail')
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
                                <a href="#tab_electronics" class="nav-link active" data-toggle="tab">发票电子档</a>
                            </li>

                            <li class="nav-item pull-right header"></li>
                        </ul>

                        <div class="tab-content" style="">
                            <div class="tab-pane active" id="tab_electronics">
                                {{-- 跟进信息 --}}
                                @include('admin.invoice._electronics')
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-3">
            <div class="card total">
                {{-- 合同开票状态 --}}
                @include('admin.invoice._contract')
            </div>

                {{-- 修改发票状态开始 --}}
                <div class="card add_contacts">
                    @include('admin.invoice._state')
                </div>
                {{-- 修改发票状态结束 --}}

        </div>

    </div>
</div>
