<template>
    <a
        :href="route('appointment.show', appointment)"
        class="flex overflow-hidden flex-col flex-grow flex-shrink-0 p-0 m-0 bg-white rounded-md cursor-pointer shadow-sm"
        style="min-height: 242px; min-width: 200px">
        <div
            class="flex overflow-hidden flex-col justify-center items-center w-full px-6 h-32">
            <span class="w-full text-2xl font-medium mt-2">{{
                appointment.title
            }}</span>
            <span class="w-full text-lg text-left pt-2 text-gray-700 truncate"
                >{{ appointment.lead_name }} •
                {{ formatAppointmentDate() ?? ' ' }}</span
            >
        </div>
        <div
            class="flex overflow-x-hidden flex-col flex-grow px-6 pt-0 pb-6"
            style="place-content: space-between flex-end; min-height: 104px">
            <div class="flex flex-col justify-end pt-4 w-full">
                <div class="flex flex-col items-stretch pb-0 w-full">
                    <button
                        class="inline-flex justify-center items-center py-0 px-5 m-0 h-10 text-center normal-case rounded-md border border-gray-300 border-solid appearance-none select-none truncate hover:border-gray-500 hover:text-gray-900"
                        aria-hidden="false"
                        type="button"
                        style="
                            outline: none;
                            min-width: 120px;
                            transition: background-color 40ms ease 0s,
                                box-shadow 40ms ease 0s;
                        ">
                        <span
                            class="text-sm font-medium leading-5 whitespace-no-wrap"
                            >Learn More</span
                        >
                    </button>
                </div>
            </div>
        </div>
    </a>
</template>

<script>
    import moment from 'moment';

    export default {
        name: 'DealCard',
        props: ['appointment', 'leads'],
        methods: {
            formatAppointmentDate() {
                return moment(this.appointment.start).format('MMM DD, YYYY');
            },
        },
    };
</script>

<style scoped></style>
