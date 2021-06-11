<div class="card user_info">
    <!--开始::销售信息主体-->
    <div class="card-body d-flex flex-center flex-column p-5">
        <!--开始::头像-->
        <div class="symbol symbol-65px symbol-circle mb-1">
            <img src="{{$adminUser->avatar!=null ? '/storage/'.$adminUser->avatar : config('admin.default_avatar')}}"
                alt="image">
            <div
                class="bg-success position-absolute h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3">
            </div>
        </div>
        <!--结束::头像-->
        <!--开始::姓名-->
        <a href="#" class="fs-1 text-gray-800 text-hover-primary fw-boldest mb-1">{{$adminUser->name}}</a>
        <!--结束::姓名-->
        <!--开始::律所-->
        <div class="fs-5 fw-bold text-gray-400 mb-5">所属销售</div>
        <!--结束::律所-->

        <!--开始::更换销售-->
        @if ($ifrole )
        {!! $Change !!}
        @endif
        <!--结束::更换销售-->
        <div class="col-md-12 share">
            @foreach ($shares_user as $shares_item)
            <span class="text-primary avatar"><img alt="{{$shares_item->name}}"
                    src="{{$shares_item->avatar ? '/storage/'.$shares_item->avatar : config('admin.default_avatar')}}"/></span>
            @endforeach
            @if ($ifrole )
            {!! $Share !!}
            @endif
        </div>
    </div>
    <!--结束::销售信息主体-->
</div>
