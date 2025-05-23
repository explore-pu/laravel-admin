<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{ Admin::title() }} @if($header) | {{ $header }}@endif</title>
    <link rel="icon" href="/vendor/laravel-admin/img/favicon.ico">
    <script src="{{ admin_asset('vendor/laravel-admin/require.js') }}"></script>
    <script src="{{ route('require_config') }}"></script>
</head>

<body class="hold-transition {{ join(' ', config('admin.theme.layout')) }} {{ 'accent-'.config('admin.theme.color') }}">

@if($alert = config('admin.top_alert'))
    <div style="text-align: center;padding: 5px;font-size: 12px;background-color: #ffffd5;color: #ff0000;">
        {!! $alert !!}
    </div>
@endif

<div class="wrapper">
    @include('admin::partials.header')
    @include('admin::partials.sidebar')
    <div class="content-wrapper" id="pjax-container">
        {!! Admin::style() !!}
        @yield('content')
        {!! Admin::html() !!}
        {!! Admin::script() !!}
    </div>
    @include('admin::partials.footer')
</div>

</body>
</html>
