<div class="row invoice_info" style="color:#666">
    <div class="col-md-3 col-sm-3 col-12"><i class="feather icon-credit-card"></i>收件人：
        <span class="copy" data-clipboard-text="{{$invoice['contact_name']}}" title="点击复制">{{$invoice['contact_name']}}</span>
    </div>
    <div class="col-md-3 col-sm-3 col-12"><i class="feather icon-clipboard"></i>联系电话：
        <span class="copy" data-clipboard-text="{{$invoice['contact_phone']}}" title="点击复制">{{$invoice['contact_phone']}}</span>
    </div>
    <div class="col-md-6 col-sm-3 col-12"><i class="feather icon-user-check"></i>邮寄地址：
        <span class="copy" data-clipboard-text="{{$invoice['contact_address']}}" title="点击复制">{{$invoice['contact_address']}}</span>
    </div>
</div>
<script>
    Dcat.ready(function () {
        new ClipboardJS('.copy');
    });
</script>
