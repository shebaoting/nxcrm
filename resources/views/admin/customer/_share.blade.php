<style>
    .bncard-list {
        min-height: 420px;
        margin-left: 0px;
        padding-left: 0px;
    }

    .bncard-list li {
        border-radius: 4px;
        float: left;
        position: relative;
        margin: 20px 0 0 20px;
        padding: 18px;
        width: 30%;
        border: 2px solid #EBEFF6;
        cursor: pointer;
    }

    .bncard-list li:hover,
    .bncard-list li.active .img {
        border-color: {{Admin::color()->primary()}};
    }

    .media:first-child {
        margin-top: 0;
    }

    .mbm {
        margin-bottom: 5px;
    }

    .media .pull-left {
        margin-right: 10px;
    }

    .pull-left {
        float: left;
    }

    .bncard-list .img {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        border: 2px solid #EBEFF6;
        line-height: 59px;
        text-align: center;
        font-size: 30px;
    }

    .media,
    .media-body {
        overflow: hidden;
        zoom: 1;
    }

    .bncard-list li .bncard-title {
        color: #58585C;
    }

    .media-heading {
        margin: 0 0 5px;
    }

    .fss {
        font-size: 12px;
        margin-bottom: 5px;
    }

    .ellipsis {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .bncard-list li .o-checked {
        display: none;
        position: absolute;
        top: -2px;
        right: -2px;
    }

</style>
<div class="share_list">
    <ul class="bncard-list clearfix">
        @foreach (Dcat\Admin\Models\Administrator::with(['roles'])->get() as $item_user)
        <li class="">
            <div class="media mbm">
                <div class="pull-left">
                    @if ($item_user->avatar)
                    <img class="img" src="/uploads/{{$item_user->avatar}}" alt="">
                    @else
                    <img class="img" src="https://cdn.learnku.com/uploads/images/201710/30/1/TrJS40Ey5k.png" alt="">
                    @endif
                </div>
                <div class="media-body">
                    <div class="media-heading bncard-title">{{$item_user->name}}</div>
                    <div class="fss">手机 · 13455667787</div>
                    <div class="fss ellipsis" title="三蛇肥,阿里巴巴">{{($item_user->roles)[0]['name']}}</div>
                </div>
            </div> <i class="o-checked"></i>
        </li>
        @endforeach
    </ul>
</div>
