<template>
    <app-layout>
        <template v-slot:page-header>
            <div class="sm:flex sm:items-center">
                <div class="flex-grow pt-2">
                    <Title class="leading-none sm:truncate">
                        Estimated Income: ${{
                            numberWithCommas(
                                this.chartData[
                                    this.chartData.length - 1
                                ].toFixed(2),
                            )
                        }}
                    </Title>
                    <p class="normal-secondary-text pt-2">
                        Keep up the progress!
                    </p>
                </div>
            </div>
        </template>

        <template v-slot:default>
            <responsive-two-column-layout>
                <template v-slot:main-column>
                    <div class="rounded-border p-8">
                        <LineChart
                            :datasets="[
                                {
                                    backgroundColor: '#1470C4',
                                    data: this.chartData,
                                },
                            ]"
                            :labels="returnMonthList()" />
                    </div>

                    <div
                        class="flex gap-4 my-8 leading-6 text-gray-900 grid grid-cols-1 sm:grid-cols-2">
                        <DetailCard
                            title="Calls today"
                            :detail="this.call_num_of_today + ' calls today'" />
                        <DetailCard
                            title="Calls this week"
                            :detail="
                                this.call_num_of_week + ' calls this week'
                            " />
                        <DetailCard
                            title="Calls this month"
                            :detail="
                                this.call_num_of_month + ' calls this month'
                            " />
                        <DetailCard
                            title="Number of calling days"
                            :detail="
                                returnNumberOfSetDays(this.calls) +
                                ' calling days'
                            " />
                        <DetailCard
                            title="Appointments today"
                            :detail="
                                this.appt_num_of_today + ' appointments today'
                            " />
                        <DetailCard
                            title="Appointments this week"
                            :detail="
                                this.appt_num_of_week +
                                ' appointments this week'
                            " />
                        <DetailCard
                            title="Appointments this month"
                            :detail="
                                this.appt_num_of_month +
                                ' appointments this month'
                            " />
                        <DetailCard
                            title="Signed"
                            :detail="
                                returnNumberOfSignedContracts() + ' signed'
                            " />
                    </div>
                </template>

                <template v-slot:secondary-column>
                    <div
                        class="flex gap-4 mb-4 leading-6 text-gray-900 grid grid-cols-1">
                        <DetailCard
                            title="Conversion rate"
                            :detail="
                                returnConversionRate() +
                                ' calls per appointment'
                            "
                            button-text="View transactions"
                            :button-link="this.route('client.index')" />
                        <DetailCard
                            title="Average daily calls"
                            :detail="
                                numberWithCommas(
                                    returnDailyCallCount(0).toFixed(2),
                                ) + ' calls'
                            "
                            button-text="View listings"
                            :button-link="this.route('listing.index')" />
                    </div>
                </template>
            </responsive-two-column-layout>
        </template>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import LineChart from './LineChart';
    import DetailCard from './Components/DetailCard.vue';
    import Title from '@/Components/Title.vue';
    import ResponsiveTwoColumnLayout from '@/Components/ResponsiveTwoColumnLayout.vue';
    import moment from 'moment';

    export default {
        components: {
            AppLayout,
            LineChart,
            DetailCard,
            Title,
            ResponsiveTwoColumnLayout,
        },

        props: [
            'propCalls',
            'propAppts',
            'chartData',
            'users',
            'user',
            'call_total_num',
            'call_num_of_today',
            'call_num_of_week',
            'call_num_of_month',
            'appt_total_num',
            'appt_num_of_today',
            'appt_num_of_week',
            'appt_num_of_month',
        ],

        data() {
            return {
                calls: Object.values(this.propCalls),
                appointments: Object.values(this.propAppts),
            };
        },

        methods: {
            // returns the number of days there was an element in the set
            returnNumberOfSetDays(set) {
                var datesArrays = [];
                set.forEach((item) => {
                    datesArrays.push(
                        moment(item.created_at).format('MM-DD-YYYY'),
                    );
                });
                return datesArrays.filter(this.onlyUnique).length;
            },

            // # of appointment with 100% signed contract
            returnNumberOfSignedContracts() {
                return this.appointments.filter(
                    (appt) => appt.odds_of_conversion === '1',
                ).length;
            },

            // calculates the user's average daily call count
            returnDailyCallCount(month, user) {
                let now = moment().subtract(month, 'months');

                let your_date = moment('2021-11-28');
                let num_of_days = now.diff(your_date, 'days') + 1;

                try {
                    return Math.abs(
                        this.calls.filter((call) => {
                            return moment(call.created_at).isBefore(now);
                        }).length / num_of_days,
                    );
                } catch {
                    return Math.abs(this.calls.length / num_of_days);
                }
            },
            // shifts the month list so the current month is first
            returnMonthList() {
                var months = [
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
                ];

                let now = moment().format('MMMM');
                let n = months.indexOf(now.toString()) + 1;
                months = this.arrayRotate(months, false, n);

                return months;
            },

            // divides the calls by appointments, and if there are no appointments, returns 0
            returnConversionRate() {
                let usersCalls = this.calls.length;
                let usersAppts = this.appointments.length;
                if (usersAppts === 0) return 0;

                var conversionRate = usersCalls / usersAppts;
                if (this.appointments.length === 0) {
                    conversionRate = 0;
                }

                return this.numberWithCommas(conversionRate.toFixed(2));
            },

            // rotates an array n times
            arrayRotate(arr, reverse, n) {
                if (reverse) {
                    for (let i = 0; i < n; i++) {
                        arr.unshift(arr.pop());
                    }
                } else {
                    for (let i = 0; i < n; i++) {
                        arr.push(arr.shift());
                    }
                }
                return arr;
            },

            numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            },

            onlyUnique(value, index, self) {
                return self.indexOf(value) === index;
            },
        },
    };
</script>
