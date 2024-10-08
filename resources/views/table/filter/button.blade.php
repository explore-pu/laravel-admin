<div class="btn-group mr-2">
    <button type="button" class="btn btn-sm btn-default {{ $btn_class }}">
        <input type="checkbox" class="d-none"><i class="fas fa-filter"></i><span class="d-none d-md-inline-block">&nbsp;&nbsp;{{ trans('admin.filter') }}</span>
    </button>

    @if($scopes->isNotEmpty())
    <div class="btn-group">
        <button type="button" class="btn btn-sm btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
        </button>
        <div class="dropdown-menu">
            @foreach($scopes as $scope)
                {!! $scope->render() !!}
            @endforeach
            <div class="dropdown-divider"></div>
            <a href="{{ $cancel }}" class="dropdown-item">{{ trans('admin.cancel') }}</a>
        </div>
    </div>
    @endif
</div>

<script>
var $btn = $('.{{ $btn_class }}');
var $filter = $('#{{ $filter_id }}');

$btn.unbind('click').click(function (e) {
    if ($filter.is(':visible')) {
        $filter.addClass('d-none');
    } else {
        $filter.removeClass('d-none');
    }
});
</script>
