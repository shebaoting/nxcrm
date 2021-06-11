<div class="files">
    <div class="d-flex justify-content-between align-items-start flex-wrap my-0">
        <!--begin::Title-->
        <h2 class="fw-bold fs-2 my-1">文件</h2>
        <!--end::Title-->
        <!--begin::Controls-->
        <div class="d-flex my-1">
            <a class="btn btn-primary btn-sm" href="{{ admin_route('attachments.create',[
                    'customer_id'=>$customer['id'],
                    'batch_id'=>0,
                    'contract_id'=>0,
                    'case_id'=>0,
                    'electronic'=>0
                    ]) }}"><i class="feather icon-plus"></i>上传文件</a>
        </div>
        <!--end::Controls-->
    </div>

    <div class="row">
        @if ($attachments->count())
        @foreach ($attachments as $attachment)
        {{-- @if ($attachment['electronic'] === 0) --}}
        @foreach (json_decode($attachment['files']) as $attachment_img)

        <div class="col-3 col-sm-3 col-md-3 mb-1">
            <div class="card h-100 file_list">
                <div class="card-body d-flex justify-content-center text-center flex-column py-2">
                    <a href="/storage/{{$attachment_img}}" target="_blank">
                        <div class="symbol symbol-60px mb-2">
                            <img src="/static/filesicon/{{substr(strrchr($attachment_img, '.'), 1)}}.png" alt="">
                        </div>
                        <div class="fs-5 fw-boldest mb-2">{{basename($attachment_img)}}</div>
                    </a>
                    <div class="fw-bold text-gray-400">{{$attachment['created_at']}}</div>
                </div>
            </div>
        </div>
        @endforeach
        {{-- @endif --}}
        @endforeach
        @else
        <x-blank_tips>
            <x-slot name="title">
                本客户目前没有上传任何资料
            </x-slot>
            您可以点击右上方上传文件按钮<br>来上传本客户的相关文件
        </x-blank_tips>
        @endif
    </div>
    </div>
