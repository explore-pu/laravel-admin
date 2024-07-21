<div class="card card-@color card-outline">
    <div class="card-header">
        <h3 class="card-title">Available Utils</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
    </div>

    <div class="card-body">
        <ul class="products-list product-list-in-card">
            @foreach($utils as $util)
            <li class="item">
                <div class="product-img">
                    <i class="{{$util['icon']}} fa-2x ext-icon"></i>
                </div>
                <div class="product-info">
                    <a href="{{ $util['link'] }}" target="_blank" class="product-title">
                        {{ $util['name'] }}
                    </a>
                    @if($util['installed'])
                        <span class="float-right installed"><i class="fas fa-check"></i></span>
                    @endif
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="card-footer text-center">
        <a href="https://github.com/laravel-admin-utils" target="_blank" class="uppercase">View All Utils</a>
    </div>
</div>
