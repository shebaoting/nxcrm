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
    .bncard-list li.active {
    border-color: {{Admin::color()->primary()}};
    cursor: default;
    }
    .bncard-list li.active .o-checked {
    display: block;
    }
    .bncard-list li .o-checked {
    display: none;
    position: absolute;
    top: -3px;
    right: -1px;
    font-size: 22px;
    font-weight: 700;
    color: {{Admin::color()->primary()}};
    }
</style>
<div class="share_list">
    <ul class="bncard-list clearfix">
        @php
          $Customer = App\Models\Customer::find($id);
          $shares = array_column($Customer->shares_user()->get()->toArray(), 'id');
        @endphp

        @if ($Customer->admin_users)
        @foreach (App\Models\Admin_user::with(['roles'])->where('id', '!=', $Customer->admin_users->id)->get() as $item_user)
        <li userid="{{$item_user->id}}" class="{{in_array($item_user->id,$shares) ? 'active' : '' }}">
            <div class="media mbm">
                <div class="pull-left">
                    <img class="img" src="
                    {{$item_user->avatar ? '/uploads/'.$item_user->avatar : '/static/img/logo.png' }}" alt="">
                </div>
                <div class="media-body">
                    <div class="media-heading bncard-title">{{$item_user->name}}</div>
                    <div class="fss">手机 · {{$item_user->mobile}}</div>
                    <div class="fss ellipsis" title="{{$item_user->name}}">
                        @foreach ($item_user->roles as $user_roles)
                        {{$user_roles['name']}}
                        @endforeach
                    </div>
                </div>
            </div> <i class="o-checked fa fa-check-square"></i>
        </li>
        @endforeach
        @endif

    </ul>
</div>
<div class="box-footer row" style="display: flex">
    <div class="col-md-12">

        <form action="{{ route('shares.store') }}" method="post">
            {{ csrf_field() }}
            <input name="customer" type="hidden" value="{{$id}}">
            <input name="user" class="userarray" type="hidden" value="">
            <button type="submit" class="btn btn-primary pull-right"><i class="feather icon-save"></i> 提交</button>
          </form>
    </div>
</div>


<script>
    Dcat.ready(function () {
        var $liebiao = $(".bncard-list > li");
        var $user = $(".userarray");
        for (var i = 0; i < $liebiao.length; i++) {
            $liebiao[i].onclick = function () {
                $(this).toggleClass("active");
                var $active = $(".bncard-list > .active");
                var $userarray = [];
                $active.map(function (key, value) {
                    $userarray[key] = Number($(value).attr("userid"));
                })
                console.log($userarray);
                $user.attr("value", $userarray);
            }
        }
    });
</script>
