<template>
    <app-layout>
        <div class="px-4 pt-12 pb-12 leading-6 text-gray-900">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2
                        class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                        Appointments
                    </h2>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4"></div>
            </div>

            <div
                class="grid gap-5 w-full text-gray-900"
                style="
                    place-items: stretch;
                    grid-template-columns: repeat(
                        auto-fill,
                        minmax(200px, 1fr)
                    );
                ">
                <div
                    class="flex gap-4 my-8 leading-6 text-gray-900 grid grid-cols-1 sm:grid-cols-2">
                    <div
                        v-for="appointment in this.appointments"
                        :key="appointment.uuid">
                        <DealCard
                            :appointment="appointment"
                            :leads="this.leads" />
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '../../Layouts/AppLayout';
    import moment from 'moment';
    import DealCard from '../Components/DealCard';
    export default {
        name: 'Index',
        components: { DealCard, AppLayout },
        props: ['appointments', 'leads'],
    };
</script>

<style scoped></style>
