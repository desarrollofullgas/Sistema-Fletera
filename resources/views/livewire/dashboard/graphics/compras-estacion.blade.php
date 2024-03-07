<div wire:ignore class="py-2 px-3 flex flex-col justify-center" x-data="{ labels:@entangle('labels'),groups:@entangle('groups'),dataGroups:@entangle('dataGroups'),
setDataChartUser(){
    var dom = document.getElementById('chart-estacion');
    var myChart = echarts.init(dom, null, {
    renderer: 'canvas',
    useDirtyRect: false
    });
    var app = {};
    var option;
    option = {
        color: ['rgba(243, 147,0, 0.7)'],
        title:{
            text:'Total de combustible de viajes (lts)',
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
        xAxis: {
            data: this.labels,
            axisLabel: {
                rotate: 90
            },
        },
        yAxis: {},
        dataGroupId: '',
        animationDurationUpdate: 300,
        series: {
            type: 'bar',
            id: 'viajes',
            data: this.groups,
            universalTransition: {
            enabled: true,
            divideShape: 'clone'
            },
        }
    };
    const drilldownData = this.dataGroups;
    myChart.on('click', function (event) {
       
    if (event.data) {
        var subData = drilldownData.find(function (data) {
        return data.dataGroupId == event.data.groupId;
        });
        //console.log(event.data,subData);
        if (!subData) {
        return;
        }
        myChart.setOption({
        xAxis: {
            data: subData.data.map(function (item) {
            return item[0];
            })
        },
        series: {
            type: 'bar',
            id: 'viajes',
            dataGroupId: subData.dataGroupId,
            data: subData.data.map(function (item) {
            return item[1];
            }),
            universalTransition: {
            enabled: true,
            divideShape: 'clone'
            }
        },
        graphic: [
            {
            type: 'text',
            left: 50,
            top: 33,
            style: {
                text: 'Back',
                fontSize: 18,
                fill:'#9CA3AF',
            },
            onclick: function () {
                myChart.setOption(option);
            }
            }
        ]
        });
    }
    });


    if (option && typeof option === 'object') {
    myChart.setOption(option);
    }

    window.addEventListener('resize', myChart.resize);
},
init(){
    this.setDataChartUser();
    Livewire.on('updateChartCompra',() => {
        //console.log(this.dataGroups);
        this.setDataChartUser();
    });
}
    
}">
    <div>
        {{-- <x-label value="{{__('Seleccionar mes')}}"/> --}}
        <x-input type="month" wire:model='monthInput' wire:change='updateData()'/>
    </div>
    <br>
    <div id="chart-estacion" class="w-72 md:w-[600px] lg:w-[500px] xl:w-[850px] h-96 m-auto"></div>
  </div>
