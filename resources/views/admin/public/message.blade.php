<ul class="nav navbar-nav">
    <li class="dropdown dropdown-notification nav-item">
        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown" aria-expanded="true"><i
                class="ficon feather icon-bell"></i>
            @if ($count)
            <span class="badge badge-pill badge-primary badge-up">{{$count}}</span>
            @endif

        </a>
        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right ">
            <li class="dropdown-menu-header">
                <div class="dropdown-header m-0 p-2">
                    <h3 class="white">{{$count}} 条消息</h3>
                    <span class="grey darken-2">请及时阅读您的消息</span>
                </div>
            </li>
            <li class="scrollable-container media-list ps ps--active-y">

                @foreach($notifications as $notification)
                <a href="{{admin_route('message.show',['id' => $notification->id])}}">
                    <div class="media d-flex align-items-start">
                        <div class="media-left"><i class="feather icon-battery font-medium-5 primary mr-1"></i></div>
                        <div class="media-body">
                            <h6 class="primary media-heading">客户合同即将到期</h6>
                            <small class="notification-text">
                                {{$notification->data['customer_name']}}
                            </small>
                        </div><small>
                            <time class="media-meta"
                                datetime="2015-06-11T18:29:20+08:00">{{$notification->data['expiretime']}}</time></small>
                    </div>
                </a>
                @endforeach



                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 0px; height: 254px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 184px;"></div>
                </div>
            </li>
            @if ($count)
            <li class="dropdown-menu-footer">
                <form id="showall" action="{{admin_route('message.showall')}}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="dropdown-item p-1 text-center">全部标记为已读</button>
            </form>
            </li>
            @endif


        </ul>
    </li>
</ul>

<script>
    Dcat.ready(function () {
        // ajax表单提交
        $('#showall').form({
            validate: true,
        });
    });
</script>
