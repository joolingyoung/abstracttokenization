<template>
<div>
    <pie-chart class="pie" :data="chartData" :options="options" :height="height" :styles="{position: 'relative', margin: '0 auto'}"></pie-chart>
</div>
</template>

<script>
import PieChart from "../libs/PieChart.js";
export default {
    name: "Pie",
    props: ['data', 'type', 'cap'],
    components: {
        PieChart
    },
    data() {
        return {
            dataArr: [],
            chartData: {
                labels: ["Not Enough Data"],
                datasets: [{
                    label: "Data One",
                    backgroundColor: ["#D9D9D9"],
                    data: [100]
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                }
            },
            height: 300,
        };
    },
    created() {
        if (this.data && this.data != 'null') {
            let vals = JSON.parse(this.data)
            if (this.type === 'capital stack') {
                let a = {
                    labels: ["Common Equity", "Mezzanine Debt", "Preferred Equity", "Senior Debt"],
                    datasets: [{
                        label: "Capital Stack",
                        backgroundColor: ["#FFC91C", "#AC9862", "#BFBFBF", "#D9D9D9"],
                        data: [this.cleanData(vals['common-equity']), this.cleanData(vals['mezzanine-debt']), this.cleanData(vals['preferred-equity']), this.cleanData(vals['senior-debt'])]
                    }]
                }
                this.chartData = a
            } else if (this.type === 'captable' && this.cap === '') {
                let a = {
                    labels: [vals.fn + ' ' + vals.ln, vals.fn1 + ' ' + vals.ln1, vals.fn2 + ' ' + vals.ln2],
                    datasets: [{
                        label: "Cap Table",
                        backgroundColor: ["#FFC91C", "#AC9862", "#BFBFBF", "#D9D9D9"],
                        data: [this.cleanData(vals.ow), this.cleanData(vals.ow1), this.cleanData(vals.ow2)]
                    }]
                }
                this.chartData = a
            } else if (this.cap !== '') {
                let labels = []
                let vs = []
                let colors = []
                let o = JSON.parse(this.cap)
                if (o) {
                    let x = o.original.response.rows
                    if (x != 'null' || x != '') {
                        let arr = []
                        for (let r in x) {
                            if (x[r]) {
                                let row = []
                                for (let c in x[r]) {
                                    if (c < 2) {
                                        row.push(x[r][c])
                                    }
                                }
                                arr.push(row)
                            }
                        }
                        var self = this
                        arr.map(function (x, i) {
                            labels.push(x[0])
                            vs.push(self.cleanData(x[1]))
                            colors.push(self.dynamicColors())
                        });

                        let a = {
                            labels: labels,
                            datasets: [{
                                label: "Cap Table",
                                backgroundColor: colors,
                                data: vs
                            }]
                        }
                        this.height = labels.length * 30 + 100
                        this.chartData = a
                        this.$emit("done", {
                            colors: colors,
                            data: vs
                        });
                    }
                }
            }
        }
    },
    methods: {
        dynamicColors() {
            let r = Math.floor(Math.random() * 255);
            let g = Math.floor(Math.random() * 255);
            let b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        },
        cleanData(e) {
            if (e == 'null' || !e) {
                return 0;
            } else if (isNaN(e) === false) {
                return (e * 100).toFixed(2)
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
};
</script>

<style>
.pie {
    max-width: 300px;
    height: auto;
    position: relative;
}
</style>
