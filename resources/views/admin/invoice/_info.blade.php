<div class="row invoice_info" style="color:#666">
    <div class="col-md-4 col-sm-3 col-12"><i class="feather icon-credit-card"></i>发票抬头：
        <span class="copy" data-clipboard-text="{{$invoice['title']}}" title="点击复制">{{$invoice['title']}}</span>
    </div>
    <div class="col-md-4 col-sm-3 col-12"><i class="feather icon-clipboard"></i>发票类型：
        <span class="copy" data-clipboard-text="{{$invoice['type']}}" title="点击复制">{{$invoice['type']}}</span>
    </div>
    <div class="col-md-4 col-sm-3 col-12"><i class="feather icon-user-check"></i>抬头类型：
        <span class="copy" data-clipboard-text="{{$invoice['title_type']}}" title="点击复制">{{$invoice['title_type']}}</span>
    </div>
    <div class="col-md-4 col-sm-3 col-12"><i class="feather icon-credit-card"></i>开&nbsp;&nbsp;户&nbsp;&nbsp;行：
        <span class="copy" data-clipboard-text="{{$invoice['bank_name']}}" title="点击复制">{{$invoice['bank_name']}}</span>
    </div>
    <div class="col-md-4 col-sm-3 col-12"><i class="feather icon-credit-card"></i>开户账号：
        <span class="copy" data-clipboard-text="{{$invoice['bank_account']}}" title="点击复制">{{$invoice['bank_account']}}</span>
    </div>
    <div class="col-md-4 col-sm-3 col-12"><i class="feather icon-credit-card"></i>电 话：
        <span class="copy" data-clipboard-text="{{$invoice['phone']}}" title="点击复制">{{$invoice['phone']}}</span>
    </div>
    <div class="col-md-12 col-sm-12 col-12"><i class="feather icon-credit-card"></i>开票地址：
        <span class="copy" data-clipboard-text="{{$invoice['address']}}" title="点击复制">{{$invoice['address']}}</span>
    </div>
</div>
<script>
    Dcat.ready(function () {
        new ClipboardJS('.copy');
    });
</script>
