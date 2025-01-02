<ul class="{{$viewClass['field']}}">
    @foreach($options as $group => $label)
        <li>
            {!! $inline ? admin_color('<span class="icheck-%s">') : admin_color('<div class="radio icheck-%s">') !!}
            <input type="checkbox" id="@id" name="{{ $name }}[]" value="{{ $label['id'] }}" class="{{ $class }} checkbox-tree"
                {{ false !== array_search($label['id'], array_filter($value ?? [])) || ($value === null && in_array($label['id'], $checked)) ?'checked':'' }}
                {!! $attributes !!} />
            <label for="@id" class="my-1">&nbsp;{{ $label['title'] }}&nbsp;&nbsp;</label>
            {!! $inline ? '</span>' :  '</div>' !!}
            <div class="my-2"></div>
            @if(!empty($label['children']))
                @include('admin::form.treeChildren', ['options' => $label['children']])
            @endif
        </li>
    @endforeach
    <input type="hidden" name="{{ $name }}[]">
    @include('admin::form.error')
    @include('admin::form.help-block')
</ul>
