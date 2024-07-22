<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{config('elegant-utils.admin.title')}} | {{ trans('admin.login') }}</title>
    <link rel="icon" href="/vendor/laravel-admin/img/favicon.ico">

    <link rel="stylesheet" href="{{ admin_asset("vendor/laravel-admin/css/fontawesome-free/css/all.min.css") }}">
    <link rel="stylesheet" href="{{ admin_asset("vendor/laravel-admin/css/icheck-bootstrap/icheck-bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ admin_asset("vendor/laravel-admin/css/admin-lte/adminlte.min.css") }}">

    <script src="{{ admin_asset("vendor/laravel-admin/js/jquery/jquery.min.js") }}"></script>
</head>
<body class="text-sm row vh-100 overflow-hidden">

    <div class="col d-none d-md-block" {!! admin_login_page_backgroud() !!}></div>

    <div class="col d-flex justify-content-center align-items-center bg-light">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ admin_url('/') }}"><b>{{config('elegant-utils.admin.name')}}</b></a>
            </div>

            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">{{ trans('admin.login') }}</p>

                    <form action="{{ admin_url('login') }}" method="post">
                        <div class="form-group">
                            @if($errors->has(config('elegant-utils.admin.auth.field.username')))
                                @foreach($errors->get(config('elegant-utils.admin.auth.field.username')) as $message)
                                    <label class="col-form-label text-danger">
                                        <i class="fas fa-times-circle-o"></i>{{$message}}
                                    </label>
                                    <br>
                                @endforeach
                            @endif
                            <div class="input-group mb-3">
                                <input type="text" class="form-control " placeholder="{{ trans('admin.' . config('elegant-utils.admin.auth.field.username')) }}" name="{{ config('elegant-utils.admin.auth.field.username') }}" value="{{ old(config('elegant-utils.admin.auth.field.username')) }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            @if($errors->has(config('elegant-utils.admin.auth.field.password')))
                                @foreach($errors->get(config('elegant-utils.admin.auth.field.password')) as $message)
                                    <label class="col-form-label text-danger">
                                        <i class="fas fa-times-circle-o"></i>{{$message}}
                                    </label>
                                    <br>
                                @endforeach
                            @endif
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="{{ trans('admin.' . config('elegant-utils.admin.auth.field.password')) }}" name="{{ config('elegant-utils.admin.auth.field.password') }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-@color">
                                    <input type="checkbox" id="remember" name="remember" value="1" {{ (!old(config('elegant-utils.admin.auth.field.username')) || old('remember')) ? 'checked' : '' }}>
                                    <label for="remember">
                                        {{ trans('admin.remember_me') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-4">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-@color btn-block">
                                    {{ trans('admin.login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('form input[name=username]').focus();
        });
    </script>
</body>
</html>
