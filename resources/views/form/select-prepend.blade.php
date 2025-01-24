<select class="form-control {{$class}}" id="@id" name="{{$name}}">
    @foreach($options as $select => $option)
        <option value="{{$select}}" {{ isset($value) && $select == $value ? 'selected' : '' }}>{{$option}}</option>
    @endforeach
</select>
