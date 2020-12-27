<div class="markdown-body editormd-html-preview">
    <div class="upload_go btn btn-primary"><i class="feather icon-plus"></i><a
            href="{{ route('attachments.create',['invoice_id'=>$invoice['id'],'customer_id'=>$customer['id'],'electronic'=>1]) }}">上传电子档</a>
    </div>

    <div class="row receipts">

        @foreach ($attachments as $attachment)
        @if ($attachment['electronic'] === 1)
        @foreach (json_decode($attachment['files']) as $attachment_img)

        <div class="col-md-6 col-sm-6 col-12 img_list">
            <div class="img-thumbnail"><a href="/storage/{{$attachment_img}}"
                    target="_blank"><img src="/storage/{{$attachment_img}}" /></a></div>
        </div>
        @endforeach
        @endif
        @endforeach

    </div>
</div>
