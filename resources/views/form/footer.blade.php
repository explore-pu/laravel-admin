<div class="card-footer row mx-0">

    <div class="col-md-{{$width['label']}}">
    </div>

    <div class="col-md-{{$width['field']}}">

        @if(in_array('submit', $buttons))
        <div class="btn-group float-right">
            <button type="submit" class="btn btn-@color">{{ trans('admin.submit') }}</button>
        </div>

        <div class="d-none d-md-inline-block float-right">
            @foreach($submit_redirects as $value => $redirect)
                @if(in_array($redirect, $checkboxes))
                    <span class="icheck-default">
                        <input id="@id" type="checkbox" class="after-submit" name="_saved" value="{{ $value }}" {{ ($default_check == $redirect) ? 'checked' : '' }}>
                        <label for="@id" class="float-right" style="margin: 5px 10px 0 0;">
                            {{ trans("admin.{$redirect}") }}
                        </label>
                    </span>
                @endif
            @endforeach
        </div>
        @endif

        @if(in_array('reset', $buttons))
        <div class="btn-group float-left">
            <button type="reset" class="btn btn-warning">{{ trans('admin.reset') }}</button>
        </div>
        @endif
    </div>
</div>
