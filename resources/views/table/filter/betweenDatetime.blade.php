<div class="form-group">
    <label>{{$label}}</label>
    <div class="row">
        <div class="input-group col">
            <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                    </span>
            </div>
            <input
                type="text"
                class="form-control"
                id="{{$id['start']}}"
                placeholder="{{$label}}"
                name="{{$name['start']}}"
                value="{{ request()->input("{$column}.start", \Illuminate\Support\Arr::get($value, 'start')) }}"
                autocomplete="off"
            />
        </div>

        <div class="input-group col">
            <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                    </span>
            </div>
            <input
                type="text"
                class="form-control"
                id="{{$id['end']}}"
                placeholder="{{$label}}"
                name="{{$name['end']}}"
                value="{{ request()->input("{$column}.end", \Illuminate\Support\Arr::get($value, 'end')) }}"
                autocomplete="off"
            />
        </div>
    </div>
</div>
