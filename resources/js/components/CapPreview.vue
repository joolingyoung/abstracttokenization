<template>
<div class="row">
    <div class="col-xs-12 col-sm-4">
        <div class="card">
            <div class="card-title blue remove-list-height">
                <h5>Ownership Allocation for {{query.name}}</h5>
            </div>
            <div class="card-content">
                <pie-chart type="captable" :cap="query.captables ? query.captables : ''" :data="data" @done="done"></pie-chart>
            </div>
        </div>
        <p>Has your cap table changed?</p>
            <uploads-component
                title="Upload New Cap Table"
                action="/files"
                elname="file"
                scope="private"
                field="fund-cap-property"
                path="/ownership/"
                multi="no"
                section="captable"
                type="text"
                refresh="true"
                v-if="type === 'fund'">
            </uploads-component>
            <uploads-component
                title="Upload New Cap Table"
                action="/files"
                elname="file"
                scope="private"
                field="cap-property"
                path="/ownership/"
                multi="no"
                section="captable"
                type="text"
                refresh="true"
                v-else>
            </uploads-component>
    </div>
    <div class="col-xs-12 col-sm-8">
        <div class="card">
            <div class="card-title blue">
                <h5>Investor Cap Table</h5>
            </div>
            <table class="rwd-table">
                <tbody>
                    <tr class="head-row">
                        <th>Investor Name</th>
                        <!-- <th>Entity Name if Applicable</th> -->
                        <th>% Held</th>
                        <!-- <th>Digital Securities Held</th>
                                <th>Price Per</th>
                                <th>Value</th> -->
                    </tr>
                    <tr v-for="(a, i) in shares" :key="i">
                        <td>
                            <div class="custom-label" :style="[a.color ? {'background': a.color} : {'background':'#eee'}]"></div>
                            {{ a.investor }}
                        </td>
                        <td>{{ a.held }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row margin-top-m">
            <!-- <div class="col-xs-12 col-sm-6">
                <div class="btn full-width">PDF</div>
            </div> -->
            <div class="col-xs-3 col-sm-3 col-md-offset-3">
                <a :href="'/investor-servicing/cap-table/download/'+type+'/'+id"><!-- {{$id}} -->
                    <div class="btn full-width">CSV</div>
                </a>
            </div>
            <div class="col-xs-12 col-sm-6">
                <a :href="'/investor-servicing/cap-table/export/'+type+'/'+id"><!-- {{$type}}/{{$id}} -->
                    <div class="btn full-width">Export All Data</div>
                </a>
            </div>
        </div>
    </div>

</div>
</template>

<script>
export default {
    props: ['id', 'type', 'cap', 'data'],
    data() {
        return {
            query: [],
            shares: []
        }
    },
    created() {
        this.query = JSON.parse(this.data);
        console.log(this.type)
    },
    methods: {
        table(a, c) {
            if (a) {
                let d = []
                a.map(function (x, i) {
                    if (x[1] !== '') {
                        let z = {
                            investor: x[0],
                            held: (x[1] * 100).toFixed(2) + '%',
                            color: c[i]
                        }
                        d.push(z)
                    }
                });
                this.shares = d;
            }
        },
        done(c) {
            let a = this.query ? JSON.parse(this.query.captables).original.response.rows : '';
            this.table(a, c.colors)
        }
    }
}
</script>

<style scoped>
.custom-label {
    height: 10px;
    width: 10px;
    background: #000;
    float: left;
    margin-right: 10px;
    margin-top: 5px;
}
</style>
