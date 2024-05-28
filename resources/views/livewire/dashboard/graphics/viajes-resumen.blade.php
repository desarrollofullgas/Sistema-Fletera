<div wire:ignore class="py-2 px-3 flex flex-col justify-center" x-data="{labels:@entangle('labels'),data:@entangle('data'),
    setData(){
      var myChart = echarts.init(document.getElementById('chart-viajes'));
      var option = {
        color:['#C71919'],
        title:{
            text:'Viajes mensuales',
            textStyle:{
                color:'#9CA3AF'
            }
        },
        tooltip: {
          trigger: 'axis',
          axisPointer: {
            type: 'shadow'
          }
        },
        grid: {
          left: '2%',
          right: '3%',
          bottom: '2%',
          containLabel: true
        },
        xAxis: [
          {
            type: 'category',
            data: this.labels,
            axisLabel:{
                rotate:90
            },
            axisTick: {
              alignWithLabel: true
            }
          }
        ],
        yAxis: [
          {
            type: 'value'
          }
        ],
        series: [
          {
            name: 'Viajes',
            type: 'bar',
            barWidth: '80%',
            data: this.data,
          },
        ],
        
      };
      myChart.setOption(option);
    },
    init(){
        this.setData();
        Livewire.on('updateChartViajes',()=>{
            this.setData();
        });
    }
}">
    <div>
        {{-- <x-label value="{{__('Seleccionar mes')}}"/> --}}
        <x-input type="month" wire:model='monthInput' wire:change='updateData()'/>
    </div>
    <br>
    <div id="chart-viajes" class="w-72 md:w-[600px] lg:w-[800px] xl:w-[1000px] h-96 m-auto"></div>
  </div>
