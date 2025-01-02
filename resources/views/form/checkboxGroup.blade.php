<div {!! admin_attrs($group_attrs) !!} id="{{ $column }}">
    <label for="@id" class="{{$viewClass['label']}}">{{ $label }}</label>
    <div class="{{$viewClass['field']}}" id="@id">
        @foreach($options as $option => $label)
            @if(is_string($label))
                {!! $inline ? admin_color('<span class="icheck-%s">') : admin_color('<div class="radio icheck-%s">') !!}
                <input type="checkbox" id="@id" name="{{ $name }}[]" value="{{ $option }}" class="{{ $class }}"
                    {{ false !== array_search($option, array_filter($value ?? [])) || ($value === null && in_array($option, $checked)) ?'checked':'' }}
                    {!! $attributes !!} />
                <label for="@id" class="my-1">&nbsp;{{ $label }}&nbsp;&nbsp;</label>
                {!! $inline ? '</span>' :  '</div>' !!}
            @endif
        @endforeach
        <hr class="my-2">

        @foreach($options as $group => $labels)
            @if(is_array($labels))
                <div class="row group">
                    <div class="col-md-2 border-right">
                        <span class="icheck-@color">
                            <input type="checkbox" id="@id" class="{{ $checkAllClass }}"/>
                            <label for="@id" class="my-1">&nbsp;{{ $group }}&nbsp;&nbsp;</label>
                        </span>
                    </div>
                    <div class="col-md-10">
                        @foreach($labels as $option => $label)
                            {!! $inline ? admin_color('<span class="icheck-%s">') : admin_color('<div class="radio icheck-%s">') !!}
                            <input type="checkbox" id="@id" name="{{ $name }}[]" value="{{ $option }}" class="{{ $class }} children"
                                {{ false !== array_search($option, array_filter($value ?? [])) || ($value === null && in_array($option, $checked)) ?'checked':'' }}
                                {!! $attributes !!} />
                            <label for="@id" class="my-1">&nbsp;{{ $label }}&nbsp;&nbsp;</label>
                            {!! $inline ? '</span>' :  '</div>' !!}
                        @endforeach
                    </div>
                </div>

                <hr class="my-2">
            @endif
        @endforeach
        <input type="hidden" name="{{ $name }}[]">
        @include('admin::form.error')
        @include('admin::form.help-block')
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var related_field = JSON.parse('{!! $relatedField !!}');

        if (related_field.length > 0) {
            var related = $('.field-' + related_field[0]);
            checkRelated(related);

            related.change(function () {
                checkRelated(this);
            });

            function checkRelated(roles) {
                var data_fileds = [];
                $.each($(roles).find('option:selected'), function (key, val) {
                    let push = $(val).data(related_field[1]);
                    let data_field = related_field[1];
                    if (data_field.length > 1) {
                        push = $(val).data(data_field);
                    }
                    data_fileds.push(push);
                });

                $('{{ $selector }}:disabled').prop('checked', false).attr({'disabled' : false});
                $.each($('{{ $selector }}'), function (k, v) {
                    if ($.inArray(parseInt($(v).val()), data_fileds.flat()) !== -1) {
                        $(v).prop('checked', true).attr({'disabled' : true});
                    }
                    checkGroup(v);
                });
            }
        }

        $.each($('#{{ $column }} .row {{ $selector }}'), function() {
            checkGroup(this);
        });

        $('.{{ $checkAllClass }}').change(function () {
            $(this).parents('.row:first').find('{{ $selector }}:not(:disabled)').prop('checked', this.checked);
        });

        $('{{ $selector }}').change(function () {
            if ($(this).hasClass('children')) {
                checkGroup(this);
            }
        });

        function checkGroup(field) {
            var group_fields = $(field).parents('.row.group:first');
            var fields = group_fields.find('{{ $selector }}').length;
            var checked_fields = group_fields.find('{{ $selector }}:checked').length;
            var disabled_fields = group_fields.find('{{ $selector }}:disabled').length;
            group_fields.find('.{{ $checkAllClass }}').prop('checked', checked_fields === fields);

            if ($(field).prop('disabled') && disabled_fields === fields) {
                group_fields.find('.{{ $checkAllClass }}').prop('disabled', true);
            } else {
                group_fields.find('.{{ $checkAllClass }}').prop('disabled', false);
            }
        }
    });
</script>
