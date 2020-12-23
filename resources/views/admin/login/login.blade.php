<link rel="stylesheet" href="/static/css/login.css">
<style>
.login_main {
  position: relative;
  display: flex;
  align-items: center;
  min-height: 100vh;
  flex-direction: row;
  align-items: stretch;
  background: url(/uploads/{{admin_setting('logobg', '/static/img/bg-auth1.jpg')}}) center;
  background-size: cover;
  margin: 0;
}
</style>
<div class="row login_main">
    <div class="col-md-3 col-sm-3 col-12 ">
        <div class="login-page">

            <div class="auth-brand text-center text-lg-left">
                <img src="/uploads/{!! admin_setting('logo', public_path().'/static/img/logo.png') !!}" width="35"> &nbsp;{!! admin_setting('crmname', 'NXCRM客户管理系统') !!}
            </div>

            <div class="login-box">
                <div class="login-logo mb-2">
                    <h4 class="mt-0">Sign In</h4>
                    <p class="login-box-msg mt-1 mb-1">{{ __('admin.welcome_back') }}</p>
                </div>
                <div class="card">
                    <div class="card-body login-card-body">

                        <form id="login-form" method="POST" action="{{ admin_url('auth/login') }}">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                            <fieldset class="form-label-group form-group position-relative has-icon-left">
                                <input
                                        type="text"
                                        class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                                        name="username"
                                        placeholder="{{ trans('admin.username') }}"
                                        value="{{ old('username') }}"
                                        required
                                        autofocus
                                >

                                <div class="form-control-position">
                                    <i class="feather icon-user"></i>
                                </div>

                                <label for="email">{{ trans('admin.username') }}</label>

                                <div class="help-block with-errors"></div>
                                @if($errors->has('username'))
                                    <span class="invalid-feedback text-danger" role="alert">
                                                    @foreach($errors->get('username') as $message)
                                            <span class="control-label" for="inputError"><i class="feather icon-x-circle"></i> {{$message}}</span><br>
                                        @endforeach
                                                </span>
                                @endif
                            </fieldset>

                            <fieldset class="form-label-group form-group position-relative has-icon-left">
                                <input
                                        minlength="5"
                                        maxlength="20"
                                        id="password"
                                        type="password"
                                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                        name="password"
                                        placeholder="{{ trans('admin.password') }}"
                                        required
                                        autocomplete="current-password"
                                >

                                <div class="form-control-position">
                                    <i class="feather icon-lock"></i>
                                </div>
                                <label for="password">{{ trans('admin.password') }}</label>

                                <div class="help-block with-errors"></div>
                                @if($errors->has('password'))
                                    <span class="invalid-feedback text-danger" role="alert">
                                                    @foreach($errors->get('password') as $message)
                                            <span class="control-label" for="inputError"><i class="feather icon-x-circle"></i> {{$message}}</span><br>
                                        @endforeach
                                                    </span>
                                @endif

                            </fieldset>
                            <div class="form-group d-flex justify-content-between align-items-center">
                                <div class="text-left">
                                    <fieldset class="checkbox">
                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                            <input id="remember" name="remember"  value="1" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="vs-checkbox">
                                                                <span class="vs-checkbox--check">
                                                                  <i class="vs-icon feather icon-check"></i>
                                                                </span>
                                                            </span>
                                            <span> {{ trans('admin.remember_me') }}</span>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right login-btn">

                                {{ __('admin.login') }}
                                &nbsp;
                                <i class="feather icon-arrow-right"></i>
                            </button>
                        </form>

                    </div>
                </div>
            </div>

{{-- <style>
    .qrcode_main {text-align: center; position: absolute; bottom: 100px}
    .qrcode {width: 100px;}
</style>

<div class="qrcode_main">
    <p>扫码获取用户名密码</p>
    <img class="qrcode" src="/static/img/qrcode.jpg" alt="">
</div> --}}


        </div>
    </div>
    <div class="col-md-9 col-sm-9 col-12 auth-fluid-right">
            <div class="auth-user-testimonial">
                <h2 class="mb-3">Stay Hungry, Stay Foolish!</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i>你如果出色地完成了某件事，那你应该再做一些其他的精彩事儿。不要在前一件事上徘徊太久，想想接下来该做什么... <i class="mdi mdi-format-quote-close"></i>
                </p>
                <p>
                    - 乔布斯
                </p>
            </div> <!-- end auth-user-testimonial-->
    </div>
</div>



<script>
    Dcat.ready(function () {
        // ajax表单提交
        $('#login-form').form({
            validate: true,
        });
    });
</script>
