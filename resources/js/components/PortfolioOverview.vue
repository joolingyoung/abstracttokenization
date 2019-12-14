<template>
    <div>
        <pie-chart :cap="data" :data="data" @done="done"></pie-chart>
        <div class="margin-top-m">
            <div v-for="(item, i) in portfolios" :key="i" class="percent-row">
                <div class="color-mark" :style="[{'background': item.color}]"></div>
                <div class="item-label">{{ item.name }}</div>
                <div class="item-value">
                {{ item.value.toFixed(2) }}%
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['data'],
    data() {
        return {
            portfolios: []
        }
    },
    methods: {
        done(colors) {
            const parsedData = JSON.parse(this.data).original.response.rows;
            let i = 0;
            for (let key in parsedData) {
                const row = {
                    name: parsedData[key][0],
                    value: parsedData[key][1] * 100,
                    color: colors.colors[i++]
                }
                this.portfolios.push(row);
            }
        }
    }
}
</script>

<style scoped>
    .color-mark {
        height: 10px;
        width: 10px;
        background: #000;
        margin-right: 10px;
        margin-top: 5px;
        display: inline-block;
    }
    .percent-row {
        display: flex;
        padding: 10px;
        width: 300px;
    }

    .item-label {
        white-space: nowrap;
        overflow: hidden;
        flex: 1;
    }
    .item-value {
        width: 45px;
    }
</style>
