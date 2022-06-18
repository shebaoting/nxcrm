<div class="card">
    <div class="customer-top card-body pt-9 pb-0">
        <div class="d-flex flex-wrap flex-sm-nowrap" style="margin-bottom: 6rem!important;">

            <div class="flex-grow-1 top-right">
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-25">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center mb-25">
                            <a href="#" class="text-gray-800 text-hover-primary fs-1 fw-boldest me-3">{{$customer['name']}}
                            </a>
                            <span
                                class="badge text-primary fw-boldest me-auto px-1 py-1" style="background-color: {{Admin::color()->alpha('primary', 0.1)}}">#{{$customer['id']}}</span>
                        </div>
                    </div>
                    @if ($adminUser)
                    <div class="d-flex mb-25">
                        @include('admin.customer._operation_buttons')
                    </div>
                    @endif
                </div>

<!--开始::自定义字段开始-->
<div class="row mb-2 text-gray-400 ml-0">
    @if ($customer['fields'])
    @php
    $customer_fields = json_decode($customer['fields'],true);
    @endphp
    @foreach ($customerfields as $field)
    @php
    $field_options = json_decode($field['options'],true);
    @endphp
    <div class="col-md-4 col-sm-4 col-12 pl-25 mb-1">
        <i class="fa {{$field['icon']}} mr-50"></i>{{$field['name']}}:

        @if (in_array($field['type'],['select','radio']))


        {{isset($customer_fields[$field['field']]) ? $field_options[$customer_fields[$field['field']]]:''}}


        @elseif (in_array($field['type'],['checkbox','multipleSelect']))
        @foreach ($customer_fields[$field['field']] as $key => $value)
        @if ($value)
        {{$field_options[$value]}}
        @endif
        @endforeach
        @else
        @isset($customer_fields[$field['field']])
        {{$customer_fields[$field['field']]}}
        @endisset
        @endif


    </div>
    @endforeach
    @endif
</div>
<!--开始::自定义字段结束-->

                <div class="d-flex flex-wrap justify-content-start">
                    <!--begin::Budget-->
                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-50 px-1 me-3">
                        <div class="fs-6 fw-boldest text-gray-700">{{$customer['created_at']->diffForHumans()}}</div>
                        <div class="text-gray-400">添加时间</div>
                    </div>
                    <!--end::Budget-->
                    <!--begin::Budget-->
                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-50 px-1 me-3">
                        <div class="fs-6 fw-boldest text-gray-700">{{$customer['updated_at']->diffForHumans()}}</div>
                        <div class="text-gray-400">最后更新</div>
                    </div>
                    <!--end::Budget-->
                </div>


            </div>
        </div>

    </div>
</div>
