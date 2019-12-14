<template>
  <div>
   <line-chart class="line" :options="options" :data="chartData"></line-chart>
  </div>
</template>

<script>
import LineChart from "../libs/LineChart.js";
export default {
  name: "line-chart-component",
  props: ['data', 'type'],
  components: {
    LineChart
  },
  data: () => ({
    chartData: {},
    maxHistoricDistribution: 0,
    options: {}
  }),
  created () {
    var self = this
    let d = JSON.parse(this.data);
    let a = {
        labels: d.labels,
        datasets: [{
        label: [],
        borderColor: '#4d73be',
        data: d.values
        }]
    }
    this.chartData = a
    this.options = {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
        display: false,
        },
        tooltips: {
        enabled: true,
        callbacks: {
            label: ((tooltipItems, data) => {
            return `${tooltipItems.yLabel}`
            })
        }
        },
        scales: {
        yAxes: [{
            ticks: {
                min: 0,
                // Include a dollar sign in the ticks
                callback: function(value, index, values) {

                    return `$ ${ self.convertToCurrencyFormat(value) }`;
                }
            }
        }]
        }
    }
    //4d73be
  },
  methods: {
    dynamicColors () {
       let r = Math.floor(Math.random() * 255);
       let g = Math.floor(Math.random() * 255);
       let b = Math.floor(Math.random() * 255);
       return "rgb(" + r + "," + g + "," + b + ")";
    },
    getMaxHistoricDistribution(distribution) {
      if( this.maxHistoricDistribution < distribution ) {
        this.maxHistoricDistribution = distribution
      }
    },
    getStepSize(maxDistribution) {
      maxDistribution = parseInt(maxDistribution)
      var digitLength = `${maxDistribution}`.length
      var unit = Math.pow(10, digitLength - 1)

      return unit * parseInt( maxDistribution / unit )
    },
    getMaxValue(stepSize, estimated) {
      return stepSize * ( parseInt( estimated / stepSize ) + 1 )
    },
    convertToCurrencyFormat(amount) {
      return amount.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    },
    cleanData(e){
      if (e == 'null' || !e) {
        return 0;
      } else if (isNaN(e) === false) {
        return (e).toFixed(2)
      } else if (e.indexOf('%') > -1) {
        return parseInt(e.replace(/\/%/g, ''))
      } else if (e.indexOf('percent') > -1) {
        return parseInt(e.replace(/\/percent/g, ''))
      } else if (typeof e === 'string') {
        return 1;
      } else {
        return 1;
      }
    }
  }
}
</script>
<style>
 .line{
   max-width: 400px;
   height: auto;
 }
</style>

