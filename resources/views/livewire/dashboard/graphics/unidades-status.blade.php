<div wire:ignore class="py-2 px-3 flex flex-col justify-center" x-data="{labels:@entangle('labels'),data:@entangle('data'),
    setData(){
    var myChart = echarts.init(document.getElementById('chart-unidades'));
    var option = {
        title:{
            text:'Estado de las unidades',
            padding:[0,5],
            textStyle:{
                color:'#9CA3AF'
            }
        },
        tooltip: {
        trigger: 'item'
        },
        legend: {
            type:'scroll',
            top: '5%',
            left: 'center',
        },
        series: [
        {
            type: 'pie',
            radius: ['50%', '70%'],
            avoidLabelOverlap: false,
            padAngle:3,
            itemStyle: {
            borderRadius: 10,
            },
            label: {
            show: false,
            position: 'center'
            },
            emphasis: {
            label: {
                show: true,
                fontSize: 20,
                fontWeight: 'bold'
            }
            },
            labelLine: {
            show: false
            },
            data: this.data
        }
        ]
    };
    myChart.setOption(option);
    },
    init(){
        this.setData();
    }
}">

    {{-- <div>
        <x-label value="{{__('Seleccionar mes')}}"/>
        <x-input type="month" wire:model='monthInput' wire:change='updateData()'/>
    </div>
    <br> --}}
    <div id="chart-unidades" class="w-72 h-80 m-auto"></div>
</div>
