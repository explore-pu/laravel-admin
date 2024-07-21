<div class="card card-@color card-outline">

    <div class="card-header">

        <div class="btn-group">
            <button class="btn btn-@color btn-sm {{ $id }}-tree-tools" data-action="expand" title="{{ trans('admin.expand') }}">
                <i class="fas fa-plus-square"></i>
                <span class="d-none d-md-inline-block">&nbsp;{{ trans('admin.expand') }}</span>
            </button>
            <button class="btn btn-@color btn-sm {{ $id }}-tree-tools" data-action="collapse" title="{{ trans('admin.collapse') }}">
                <i class="fas fa-minus-square"></i>
                <span class="d-none d-md-inline-block">&nbsp;{{ trans('admin.collapse') }}</span>
            </button>
        </div>

        @if(($useSave && !$trashed) || ($useSave && $trashed && !$requestTrashed))
        <div class="btn-group">
            <button class="btn btn-@color btn-sm {{ $id }}-save" title="{{ trans('admin.save') }}">
                <i class="fas fa-save"></i>
                <span class="d-none d-md-inline-block">&nbsp;{{ trans('admin.save') }}</span>
            </button>
        </div>
        @endif

        @if($trashed && $requestTrashed)
            <div class="btn-group">
                <a href="{{ $url }}" class="btn btn-default btn-sm {{ $id }}-cancel" title="{{ trans('cancel') }}">
                    <i class="fas fa-times"></i>
                    <span class="d-none d-md-inline-block">&nbsp;{{ trans('admin.cancel') }}</span>
                </a>
            </div>
        @endif

        @if($trashed && !$requestTrashed)
            <div class="btn-group">
                <a href="{{ $url }}?&_scope_=trashed" class="btn btn-success btn-sm {{ $id }}-trashed" title="{{ trans('trashed') }}">
                    <i class="fas fa-trash"></i>
                    <span class="d-none d-md-inline-block">&nbsp;{{ trans('admin.trashed') }}</span>
                </a>
            </div>
        @endif

        <div class="btn-group">
            {!! $tools !!}
        </div>

        @if($useCreate)
        <div class="btn-group float-right">
            <a class="btn btn-success btn-sm" href="{{ url($path) }}/create">
                <i class="fas fa-save"></i>
                <span class="d-none d-md-inline-block">&nbsp;{{ trans('admin.new') }}</span>
            </a>
        </div>
        @endif

    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <div class="dd" id="{{ $id }}">
            <ol class="dd-list">
                @foreach(Admin::menuGroup() as $index => $group)
                    @if($index !== 1)
                        <p class="nav-header m-0">{{ $group }}</p>
                    @endif

                    @foreach($items as $branch)
                        @if($index === $branch['group'])
                            @include($branchView, $branch)
                        @endif
                    @endforeach
                @endforeach
            </ol>
        </div>
    </div>
    <!-- /.card-body -->
</div>

<script require="nestable">
    $('#{{ $id }}').nestable(@json($options));

    $('.{{ $id }}-save').click(function () {
        var serialize = $('#{{ $id }}').nestable('serialize');
        $.post('{{ $url }}', {
            _order: JSON.stringify(serialize)
        },
        function(data){
            $.admin.reload('{{ trans('admin.save_succeeded') }}');
        });
    });

    $('.{{ $id }}-tree-tools').on('click', function(e){
        var action = $(this).data('action');
        if (action === 'expand') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse') {
            $('.dd').nestable('collapseAll');
        }
    });
</script>
