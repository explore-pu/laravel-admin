<div class="btn-group float-right mr-2">
    <a href="{{ $all }}" target="_blank" class="btn btn-sm btn-default" title="{{ trans('admin.export') }}">
        <i class="fas fa-download"></i>
        <span class="d-none d-md-inline-block"> {{ trans('admin.export') }}</span>
    </a>
    <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right" role="menu">
        <a href="{{ $all }}" target="_blank" class="dropdown-item">{{ trans('admin.all') }}</a>
        <a href="{{ $page }}" target="_blank" class="dropdown-item">{{ trans('admin.current_page') }}</a>
        <a href="{{ $selected }}" target="_blank" class='{{ $name }} dropdown-item d-none'>{{ trans('admin.selected_rows') }}</a>
    </ul>
</div>

<script selector=".{{ $name }}">
    $(this).click(function (e) {
        e.preventDefault();
        var rows = $.admin.table.selected().join();
        if (!rows) {
            return false;
        }
        var href = $(this).attr('href').replace('__rows__', rows);
        location.href = href;
    });

    var $btn = $(this);

    $.admin.on('table-select', function (e, num) {
        if (num > 0) {
            $btn.removeClass('d-none');
        } else {
            $btn.addClass('d-none');
        }
    });
</script>
