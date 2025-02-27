@extends('admin::index', ['header' => strip_tags($header)])

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>
                        {!! $header ?: trans('admin.title') !!}
                        <small>{!! $description ?: trans('admin.description') !!}</small>
                    </h4>
                </div>
                <div class="col-sm-6">
                    @if ($breadcrumb)
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ admin_url('/') }}"><i class="fas fa-home"></i> {{__('admin.home')}}</a></li>
                        @foreach($breadcrumb as $item)
                            @if($loop->last)
                                <li class="active breadcrumb-item">
                                    @if (\Illuminate\Support\Arr::has($item, 'icon'))
                                        <i class="fa fa-{{ $item['icon'] }}"></i>
                                    @endif
                                    {{ $item['text'] }}
                                </li>
                            @else
                                <li class="breadcrumb-item">
                                    @if (\Illuminate\Support\Arr::has($item, 'url'))
                                        <a href="{{ admin_url(\Illuminate\Support\Arr::get($item, 'url')) }}">
                                            @if (\Illuminate\Support\Arr::has($item, 'icon'))
                                                <i class="fa fa-{{ $item['icon'] }}"></i>
                                            @endif
                                            {{ $item['text'] }}
                                        </a>
                                    @else
                                        @if (\Illuminate\Support\Arr::has($item, 'icon'))
                                            <i class="fa fa-{{ $item['icon'] }}"></i>
                                        @endif
                                        {{ $item['text'] }}
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    </ol>
                    @elseif(config('admin.enable_default_breadcrumb'))
                    <ol class="breadcrumb float-sm-right" >
                        <li class="breadcrumb-item"><a href="{{ admin_url('/') }}"><i class="fas fa-home"></i> {{__('admin.home')}}</a></li>
                        @for($i = 1; $i <= count(Request::segments()); $i++)
                            <li class="breadcrumb-item">
                                {{ucfirst(Request::segment($i))}}
                            </li>
                        @endfor
                    </ol>
                    @endif
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content" id="app">
        <div class="container-fluid">

        @include('admin::partials.alerts')
        @include('admin::partials.exception')
        @include('admin::partials.toastr')

        @if($__view)
            @include($__view['view'], $__view['data'])
        @else
            {!! $__content !!}
        @endif
        </div>

    </section>
@endsection
