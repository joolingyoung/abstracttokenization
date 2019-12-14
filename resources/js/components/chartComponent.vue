<template>
    <div class="chart">
        <Progress vertical :percent="25" />
        <Progress vertical :percent="35" status="active" />
        <Progress vertical :percent="28" />
        <Progress vertical :percent="49" />
        <!-- <Progress vertical :percent="25" hide-info /> -->
    </div>
</template>
<style>
.chart{
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 150px;
}
</style>
