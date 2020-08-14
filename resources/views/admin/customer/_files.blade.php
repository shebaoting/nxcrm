<div class="markdown-body editormd-html-preview">
    <div class="upload_go btn btn-primary"><i class="feather icon-plus"></i><a
            href="{{ route('attachments.create',['customer_id'=>$customer['id']]) }}">上传附件</a>
    </div>

    <div class="row receipts">

        @foreach ($attachments as $attachment)
        @if ($attachment['electronic'] === 0)
        @foreach (json_decode($attachment['files']) as $attachment_img)
        <div class="col-md-2 col-sm-2 col-12 file_list">
            <div>
                <a href="/uploads/{{$attachment_img}}" target="_blank">
                    <img
                        src="/static/filesicon/{{substr(strrchr($attachment_img, '.'), 1)}}.png" />
                    <p>{{basename($attachment_img)}}</p>
                </a>
            </div>
        </div>
        @endforeach
        @endif
        @endforeach

    </div>
</div>