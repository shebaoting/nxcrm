@php
$ifrole = Admin::user()->isRole('administrator') || (Admin::user()->id == $adminUser['id']);
@endphp
<div class="content-body" id="app">
    <div class="row customer_content">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    {{-- 头部合同标题等信息 --}}
                    @include('admin.customer._top')
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class=" card bottom_body" style=";padding:.25rem .4rem .4rem">
                        <ul class="nav nav-tabs " role="tablist">
                            <li class="nav-item">
                                <a href="#tab_events" class="nav-link active" data-toggle="tab">跟进</a>
                            </li>
                            <li class="nav-item {{ active_class(if_route('dcat.admin.customers.show'),'','hide') }}">
                                <a href="#tab_contracts" class="nav-link" data-toggle="tab">合同</a>
                            </li>
                            <li class="nav-item {{ active_class(if_route('dcat.admin.customers.show'),'','hide') }}">
                                <a href="#tab_receipts" class="nav-link" data-toggle="tab">收支</a>
                            </li>
                            <li class="nav-item {{ active_class(if_route('dcat.admin.customers.show'),'','hide') }}">
                                <a href="#tab_invoices" class="nav-link" data-toggle="tab">票据</a>
                            </li>
                            <li class="nav-item {{ active_class(if_route('dcat.admin.customers.show'),'','hide') }}">
                                <a href="#tab_orders" class="nav-link" data-toggle="tab">订单</a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab_files" class="nav-link" data-toggle="tab">附件</a>
                            </li>

                            <li class="nav-item pull-right header"></li>
                        </ul>

                        <div class="tab-content" style="">
                            <div class="tab-pane active" id="tab_events">
                                {{-- 跟进信息 --}}
                                @include('admin.customer._events')
                            </div>
                            <div class="tab-pane" id="tab_contracts">
                                {{-- 合同信息 --}}
                                @include('admin.customer._contracts')
                            </div>
                            <div class="tab-pane" id="tab_receipts">
                                {{-- 收支信息 --}}
                                @include('admin.customer._receipts')
                            </div>
                            <div class="tab-pane" id="tab_invoices">
                                {{-- 票据信息 --}}
                                @include('admin.customer._invoices')
                            </div>
                            <div class="tab-pane" id="tab_orders">
                                {{-- 订单信息 --}}
                                @include('admin.customer._orders')
                            </div>
                            <div class="tab-pane" id="tab_files">
                                {{-- 附件信息 --}}
                                @include('admin.customer._files')
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-3">
            {{-- 所属销售信息 --}}
            @include('admin.customer._users')

            {{-- 联系人信息 --}}
            @include('admin.customer._contacts')
        </div>

    </div>
</div>
