@foreach($default as $action)
    {!! $action->render() !!}
@endforeach

@if(!empty($custom))
    @foreach($custom as $action)
        {!! $action->render() !!}
    @endforeach
@endif

<style>
    .dropdown-item {
        display: inline;
        padding: 0;
        margin-right: 15px;
    }
    .dropdown-item:hover {
        background: transparent;
    }
</style>
