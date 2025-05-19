<div {!! admin_attrs($group_attrs) !!}>
    <label for="{{$id}}" class="{{$viewClass['label']}}">{{ $label }}</label>
    @foreach($options as $option => $label)
        {!! $inline ? admin_color('<span class="icheck-%s">') : admin_color('<div class="radio icheck-%s">') !!}
            <input id="@id" type="radio" name="{{$name}}" value="{{$option}}" class="minimal {{$class}}" {{ ($option == $value) || ($value === null && in_array($label, $checked)) ?'checked':'' }} {!! $attributes !!} />
            <label for="@id" class="radio-inline">&nbsp;{{$label}}&nbsp;&nbsp;
            </label>
        {!! $inline ? '</span>' :  '</div>' !!}
    @endforeach
    @include('admin::actions.form.help-block')
</div>
