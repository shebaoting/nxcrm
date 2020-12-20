@if($user)
<li class="dropdown dropdown-user nav-item">
    <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
        <div class="user-nav d-sm-flex d-none">
            <span class="user-name text-bold-600">{{ $user->name }}</span>
            <span class="user-status"><i class="fa fa-circle text-success"></i> {{ trans('admin.online') }}</span>
        </div>
        <span>
            <img class="round" src="{{ $user->getAvatar() }}" alt="avatar" height="40" width="40" />
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <a href="javascript:void(0)" class="dropdown-item"
            onclick="javascript:window.location.href='/admin/auth/setting'">
            <i class="feather icon-user"></i> {{ trans('admin.setting') }}
        </a>
        <div class="dropdown-divider"></div>
        @if (Admin::user()->isAdministrator())
        @if (admin_section('isadmin', false))
        <a href="javascript:void(0)" class="dropdown-item" onclick="javascript:window.location.href='/admin'">
            <i class="feather icon-layers"></i> {{ trans('admin.home') }}
        </a>
        <div class="dropdown-divider"></div>
        @else
        <a href="javascript:void(0)" class="dropdown-item" onclick="javascript:window.location.href='/admin/settings/setting'">
            <i class="feather icon-layers"></i> {{ trans('admin.admin_setting') }}
        </a>
        <div class="dropdown-divider"></div>
        @endif

        @endif

        <a class="dropdown-item" href="{{ admin_url('auth/logout') }}">
            <i class="feather icon-power"></i> {{ trans('admin.logout') }}
        </a>
    </div>
</li>


@endif
