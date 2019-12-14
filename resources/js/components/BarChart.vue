<template>
  <div>
   <bar-chart class="bar" :options="options" :data="chartData"></bar-chart>
  </div>
</template>

<script>
import BarChart from "../libs/BarChart.js";
export default {
  name: "Pie",
  props: ['data', 'type'],
  components: {
    BarChart
  },
  data: () => ({
    chartData: {},
    maxHistoricDistribution: 0,
    options: {}
  }),
  created () {
    var self = this
    if (this.type === 'distribution') {
      if (this.data && this.data !== null) {
        let d = JSON.parse(this.data);
        let i = d && d != null ? JSON.parse(d.investment) : null
        let o = d && d != null ? JSON.parse(d.distributions) : null

        let labels = []
        let vs = []
        let colors = []


        o.map(function (x) {
          labels.push(x.name)
          let t = self.cleanData(x.amount)
          t = typeof t === 'string' ? parseFloat(t) : t
          self.getMaxHistoricDistribution(t)
          vs.push(t);
          colors.push(self.dynamicColors());
        });

        let a = {
          labels: labels,
          datasets: [{
            backgroundColor: '#4d73be',
            data: vs
          }]
        }
        this.chartData = a


        let stepSize = self.getStepSize(this.maxHistoricDistribution / 5)
        let max = self.getMaxValue(stepSize, this.maxHistoricDistribution)
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
                  max,
                  stepSize,
                  // Include a dollar sign in the ticks
                  callback: function(value, index, values) {
                      return `$ ${ self.convertToCurrencyFormat(value) }`;
                  }
                }
            }]
          }
        }
      }
    } else if (this.type === 'manual') {
        let a = {
          labels: ['December','January','February','March','April','May'],
          datasets: [{
            label: ['Distribution Amount'],
            backgroundColor: ['#4d73be', '#4d73be', '#4d73be', '#4d73be', '#4d73be', '#4d73be'],
            data: [22000, 21800, 21200, 22900, 21930, 23000]
          }]
        }
        this.chartData = a
    } else {
        let d = JSON.parse(this.data);
        let a = {
          labels: d.labels,
          datasets: [{
            label: [],
            backgroundColor: '#4d73be',
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
 .bar{
   max-width: 400px;
   height: auto;
 }
</style>

