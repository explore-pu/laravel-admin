<div {!! admin_attrs($group_attrs) !!}>
    <label class="{{$viewClass['label']}}">{{$label}}</label>
    <div class="{{$viewClass['field']}}">
        <div class="card card-solid card-default m-0 bg-light">
            <!-- /.card-header -->
            <div class="card-body py-2 px-4 text-muted">
                {!! $value !!}&nbsp;
            </div><!-- /.card-body -->
        </div>
        @include('admin::form.help-block')
    </div>
</div>
