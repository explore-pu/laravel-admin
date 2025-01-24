<aside class="main-sidebar elevation-4 sidebar-light-{{ config('admin.theme.color') }}">
    <a href="{{ admin_url('/') }}" class="brand-link">
        <img src="{!! config('admin.logo.image') !!}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{!! config('admin.logo.text', config('admin.name')) !!}</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->avatar }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">{{ Auth::user()->name }}</div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @foreach(Auth::user()->menus() as $item)
                    @include('admin::partials.menu', $item)
                @endforeach
            </ul>
        </nav>
    </div>
</aside>
