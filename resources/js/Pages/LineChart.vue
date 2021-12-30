<template>
    <LineChart
        :chartData="{
            labels: this.labels,
            datasets: this.datasets,
        }" />
</template>

<script>
    import { defineComponent } from 'vue';
    import { LineChart } from 'vue-chart-3';
    import {
        Chart,
        LineController,
        ArcElement,
        Tooltip,
        CategoryScale,
        LinearScale,
        PointElement,
        LineElement,
    } from 'chart.js';
    Chart.register(
        LineController,
        ArcElement,
        Tooltip,
        CategoryScale,
        LinearScale,
        PointElement,
        LineElement,
    );

    export default {
        name: 'Home',
        components: { LineChart },
        props: {
            datasets: {
                type: Array,
                default: [
                    {
                        data: [30, 40, 60, 70, 5, 2, 20, 70, 30, 10, 15, 11],
                        backgroundColor: [
                            '#77CEFF',
                            '#0079AF',
                            '#123E6B',
                            '#97B0C4',
                            '#A5C8ED',
                            '#77CEFF',
                            '#0079AF',
                            '#123E6B',
                            '#97B0C4',
                            '#A5C8ED',
                            '#77CEFF',
                            '#0079AF',
                        ],
                    },
                ],
            },
            labels: {
                type: Array,
                default: [
                    'January',
                    'February',
                    'March',
                    'April',
                    'May',
                    'June',
                    'July',
                    'August',
                    'September',
                    'October',
                    'November',
                    'December',
                ],
            },
        },
    };
</script>
