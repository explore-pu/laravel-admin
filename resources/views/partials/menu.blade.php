@if(Auth::user()->canSeeMenu($item))
    @if(!isset($item['children']))
        <li class="nav-item">
            @if(url()->isValidUrl($item['uri']))
                <a href="{{ $item['uri'] }}" target="_blank" class="nav-link">
                    <i class="nav-icon {{$item['icon']}}"></i>
                    <p>{{ admin_trans($item['title']) }}</p>
                </a>
            @else
                 <a href="{{ admin_url($item['uri']) }}" class="nav-link">
                     <i class="nav-icon {{$item['icon']}}"></i>
                     <p>{{ admin_trans($item['title']) }}</p>
                 </a>
            @endif
        </li>
    @else
        <li class="nav-item has-treeview">
            <a href="javaScript:void(0);" class="nav-link">
                <i class="nav-icon {{ $item['icon'] }}" ></i>
                <p>
                    {{ admin_trans($item['title']) }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @foreach($item['children'] as $item)
                    @include('admin::partials.menu', $item)
                @endforeach
            </ul>
        </li>
    @endif
@endif
