<div class="row invoice_info" style="color:#666">
    <div class="col-md-4 col-sm-3 col-12"><i class="feather icon-type"></i>发票抬头：
        <span class="copy" data-clipboard-text="{{$invoice['title']}}" title="点击复制">{{$invoice['title']}}</span>
    </div>
    <div class="col-md-4 col-sm-3 col-12"><i class="feather icon-bar-chart-2"></i>发票类型：
        <span class="copy" data-clipboard-text="{{$invoice['type']}}" title="点击复制">
            @if ($invoice['type']==1)
            增值税普通发票
            @elseif ($invoice['type']==2)
            增值税专用发票
            @elseif ($invoice['type']==3)
            国税通用机打发票
            @elseif ($invoice['type']==4)
            地税通用机打发票
            @else
            收据
            @endif
        </span>
    </div>
    <div class="col-md-4 col-sm-3 col-12"><i class="feather icon-bar-chart-2"></i>抬头类型：
        <span class="copy" data-clipboard-text="{{$invoice['title_type']}}" title="点击复制">
            @if ($invoice['title_type'] == 1)
            单位
            @else
            个人
            @endif
        </span>
    </div>
    <div class="col-md-4 col-sm-3 col-12"><i class="feather icon-command"></i>开&nbsp;&nbsp;户&nbsp;&nbsp;行：
        <span class="copy" data-clipboard-text="{{$invoice['bank_name']}}" title="点击复制">{{$invoice['bank_name']}}</span>
    </div>
    <div class="col-md-4 col-sm-3 col-12"><i class="feather icon-credit-card"></i>开户账号：
        <span class="copy" data-clipboard-text="{{$invoice['bank_account']}}"
            title="点击复制">{{$invoice['bank_account']}}</span>
    </div>
    <div class="col-md-4 col-sm-3 col-12"><i class="feather icon-phone"></i>电 话：
        <span class="copy" data-clipboard-text="{{$invoice['phone']}}" title="点击复制">{{$invoice['phone']}}</span>
    </div>
    <div class="col-md-12 col-sm-12 col-12"><i class="feather icon-map-pin"></i>开票地址：
        <span class="copy" data-clipboard-text="{{$invoice['address']}}" title="点击复制">{{$invoice['address']}}</span>
    </div>
</div>
<script>
    Dcat.ready(function () {
        new ClipboardJS('.copy');
    });

</script>
