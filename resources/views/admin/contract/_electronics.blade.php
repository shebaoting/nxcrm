<div class="markdown-body editormd-html-preview">
    <div class="upload_go btn btn-primary"><i class="feather icon-plus"></i><a
            href="{{ route('attachments.create',['customer_id'=>$customer['id'],'contract_id'=>$contract['id'],'electronic'=>1]) }}">上传电子档</a>
    </div>

    <div class="row receipts">

        @foreach ($attachments as $attachment)
        @if ($attachment['electronic'] === 1)
        @foreach (json_decode($attachment['files']) as $attachment_img)

        <div class="col-md-3 col-sm-3 col-12 img_list">
            <div class="img-thumbnail"><a href="/uploads/{{$attachment_img}}"
                    target="_blank"><img src="/uploads/{{$attachment_img}}" /></a></div>
        </div>
        @endforeach
        @endif
        @endforeach

    </div>
</div>