<div class="content-body" id="app">
    <div class="row customer_content">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row" style="width: 100%;">
                                <div class="col-md-8">
                                    <div class="metric-content">
                                        {{-- 头部合同标题等信息 --}}
                                        @include('admin.opportunity._top')
                                    </div>
                                </div>

                                <div class="col-md-4 tools">
                                    <span><a href="{{ route('opportunitys.edit',$opportunity['id']) }}"><i
                                                class="feather icon-edit-2"></i></a></span>
                                    {{-- <span><a href="{{ route('opportunitys.destroy',$opportunity['id']) }}"><i
                                        class="feather icon-x"></i></a></span> --}}
                                </div>
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
                                <a href="#tab_events" class="nav-link active" data-toggle="tab">跟进</a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab_files" class="nav-link" data-toggle="tab">附件</a>
                            </li>
                            <li class="nav-item pull-right header"></li>
                        </ul>

                        <div class="tab-content" style="">

                            <div class="tab-pane active" id="tab_events">
                                {{-- 跟进信息 --}}
                                @include('admin.opportunity._events')
                            </div>

                            <div class="tab-pane" id="tab_files">
                                {{-- 附件信息 --}}
                                @include('admin.opportunity._files')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card total">
                {{--预期收入 --}}
                @include('admin.opportunity._total')
            </div>
            {{--联系人信息 --}}
            @include('admin.opportunity._contact')
        </div>
    </div>
</div>
