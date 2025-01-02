<div {!! admin_attrs($group_attrs) !!} id="{{ $column }}">
    <label for="@id" class="{{$viewClass['label']}}">{{ $label }}</label>
    <ul class="{{$viewClass['field']}} list-unstyled" id="@id">
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
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $.each($('input[type="checkbox"].checkbox-tree'), function(index, input) {
            $(input).change(function () {
                if ($(this).is(':checked')) {
                    $(this).parents('.field-control').prev().prev().find('input[type="checkbox"]:not(:disabled)').prop('checked', this.checked);
                } else {
                    $(this).closest('li').find('input[type="checkbox"]:not(:disabled)').prop('checked', this.checked);

                    if ($(this).closest('li').siblings('li').find('input[type="checkbox"]:checked').length === 0
                        && $(this).closest('.field-control').prev().prev().find('input[type="checkbox"]:not(:disabled)').is(':checked')) {
                        $(this).closest('.field-control').prev().prev().find('input[type="checkbox"]:not(:disabled)').click();
                    }
                }
            });
        });

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
                });
            }
        }
    });
</script>

<style type="text/css">
    ul {
        list-style: none;
    }
    ul ul {
        padding-left: 22px;
        display: flex;
        flex-wrap: wrap;
    }
    ul:has(ul) {
        padding-left: 22px;
        display: block;
    }
</style>
