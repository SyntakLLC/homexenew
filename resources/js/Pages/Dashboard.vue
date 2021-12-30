<template>
    <app-layout title="Dashboard">
        <div class="px-4">
            <div class="mt-12 mb-12 flex-col">
                <span
                    class="flex font-semibold text-sm mt-12 text-gray-500 text-center mx-auto uppercase"
                    >your estimated income</span
                >
                <span
                    class="flex font-semibold text-4xl text-gray-900 text-center mx-auto mt-2"
                    >${{
                        numberWithCommas(
                            this.returnExpectedIncome(0, this.user).toFixed(2),
                        )
                    }}</span
                >
            </div>

            <LineChart
                :datasets="this.returnChartData()"
                :labels="returnMonthList()" />

            <div
                class="flex gap-4 my-8 leading-6 text-gray-900 grid grid-cols-1 sm:grid-cols-2">
                <DetailCard
                    title="Conversion rate"
                    :detail="returnConversionRate() + ' calls per appointment'"
                    button-text="View appointments"
                    :button-link="this.route('appointment.index')" />
                <DetailCard
                    title="Average daily calls"
                    :detail="
                        numberWithCommas(returnDailyCallCount(0).toFixed(2)) +
                        ' calls'
                    " />
                <DetailCard
                    title="Calls today"
                    :detail="returnSetOfToday(this.calls) + ' calls today'"
                    button-text="Review calls"
                    :button-link="this.route('dashboard')" />
                <DetailCard
                    title="Calls this week"
                    :detail="returnSetOfWeek(this.calls) + ' calls this week'"
                    button-text="Review calls"
                    :button-link="this.route('dashboard')" />
                <DetailCard
                    title="Calls this month"
                    :detail="returnSetOfMonth(this.calls) + ' calls this month'"
                    button-text="Review calls"
                    :button-link="this.route('dashboard')" />
                <DetailCard
                    title="Number of calling days"
                    :detail="
                        returnNumberOfSetDays(this.calls) + ' calling days'
                    "
                    button-text="Review calls"
                    :button-link="this.route('dashboard')" />
                <DetailCard
                    title="Appointments today"
                    :detail="
                        returnSetOfToday(this.appointments) +
                        ' appointments today'
                    "
                    button-text="View appointments"
                    :button-link="this.route('appointment.index')" />
                <DetailCard
                    title="Appointments this week"
                    :detail="
                        returnSetOfWeek(this.appointments) +
                        ' appointments this week'
                    "
                    button-text="View appointments"
                    :button-link="this.route('appointment.index')" />
                <DetailCard
                    title="Appointments this month"
                    :detail="
                        returnSetOfMonth(this.appointments) +
                        ' appointments this month'
                    "
                    button-text="View appointments"
                    :button-link="this.route('appointment.index')" />
                <DetailCard
                    title="Signed"
                    :detail="returnNumberOfSignedContracts() + ' signed'" />
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import LineChart from './LineChart';
    import moment from 'moment';
    import DetailCard from './Components/DetailCard.vue';

    export default {
        components: {
            DetailCard,
            LineChart,
            AppLayout,
        },

        props: {
            calls: {
                default: [],
                type: Array,
            },
            appointments: {
                default: [],
                type: Array,
            },
            users: {
                default: [],
                type: Array,
            },
            user: {
                default: {},
                type: Object,
            },
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
                    (appt) =>
                        appt.odds_of_conversion === '1' &&
                        appt.user_name == this.user.name,
                ).length;
            },

            // gives THIS USER'S the number of X made today
            returnSetOfToday(set) {
                return set.filter((item) => {
                    return (
                        item.user_name === this.user.name && this.wasToday(item)
                    );
                }).length;
            },
            // gives THIS USER'S the number of X made today
            returnSetOfWeek(set) {
                return set.filter((item) => {
                    return (
                        item.user_name === this.user.name && this.wasWeek(item)
                    );
                }).length;
            },
            // gives THIS USER'S the number of X made today
            returnSetOfMonth(set) {
                return set.filter((item) => {
                    return (
                        item.user_name === this.user.name && this.wasMonth(item)
                    );
                }).length;
            },

            wasToday(item) {
                return moment(item.created_at).isSame(moment(), 'day');
            },

            wasWeek(item) {
                return moment(item.created_at).isSame(moment(), 'week');
            },

            wasMonth(item) {
                return moment(item.created_at).isSame(moment(), 'month');
            },

            // returns an array of chart data
            returnChartData() {
                var array = [];
                let colors = [
                    '#1470C450',
                    '#FDE68A50',
                    '#A7F3D050',
                    '#DDD6FE50',
                    '#FECACA50',
                    '#E5E7EB50',
                ];

                for (let i = 0; i < this.users.length; i++) {
                    var color = colors[i];
                    while (i > colors.length) {
                        color = colors[i - colors.length];
                    }

                    array = array.concat({
                        // label: this.users[i].name,
                        // fill: false,
                        // lineTension: 0,
                        backgroundColor: color,
                        data: [
                            this.returnExpectedIncome(11, this.user),
                            this.returnExpectedIncome(10, this.user),
                            this.returnExpectedIncome(9, this.user),
                            this.returnExpectedIncome(8, this.user),
                            this.returnExpectedIncome(7, this.user),
                            this.returnExpectedIncome(6, this.user),
                            this.returnExpectedIncome(5, this.user),
                            this.returnExpectedIncome(4, this.user),
                            this.returnExpectedIncome(3, this.user),
                            this.returnExpectedIncome(2, this.user),
                            this.returnExpectedIncome(1, this.user),
                            this.returnExpectedIncome(0, this.user),
                        ],
                    });
                }
                return array;
            },

            // to draw the chart, we want to show the change in expected income over time.
            // so, we need to, for each month, show the expected income based on the prior months.
            returnExpectedIncome(month, user) {
                let expectedIncomeBasedOnCalls =
                    ((this.returnDailyCallCount(month, user) * 260) / 900) *
                    5000;
                let expectedIncomeBasedOnAppts =
                    ((this.returnDailyApptCount(month, user) * 52) / 10) * 5000;
                let expectedIncome =
                    expectedIncomeBasedOnCalls + expectedIncomeBasedOnAppts;
                return expectedIncome <= 0 ? 0 : expectedIncome;
            },

            // calculates the user's average daily call count
            returnDailyCallCount(month, user) {
                let now = moment().subtract(month, 'months');
                console.log(now.format('MM DD YYYY'));
                let your_date = moment('2021-11-28');
                let num_of_days = now.diff(your_date, 'days') + 1;

                try {
                    return Math.abs(
                        this.calls.filter((call) => {
                            return (
                                call.user_name === user.name &&
                                moment(call.created_at).isBefore(now)
                            );
                        }).length / num_of_days,
                    );
                } catch {
                    return Math.abs(this.calls.length / num_of_days);
                }
            },

            // calculates the user's average daily appointment count
            returnDailyApptCount(month, user) {
                let now = moment().subtract(month, 'months');
                let your_date = moment('2021-10-05');
                let num_of_days = now.diff(your_date, 'days') + 1;

                try {
                    return Math.abs(
                        this.appointments.filter((appt) => {
                            return (
                                appt.user_name === user.name &&
                                moment(appt.created_at).isBefore(now)
                            );
                        }).length / num_of_days,
                    );
                } catch {
                    return Math.abs(this.appointments.length / num_of_days);
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
                let usersCalls = this.calls.filter(
                    (call) => call.user_name === this.user.name,
                ).length;
                let usersAppts = this.appointments.filter(
                    (appt) => appt.user_name === this.user.name,
                ).length;
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
