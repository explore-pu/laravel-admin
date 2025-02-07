<div class="{{ $element }} w-100" style="height: {{ $height }}px"></div>
<script require="echarts" @script>
    const myChart = echarts.init($(this)[0]);
    {!! $scripts !!}
</script>
