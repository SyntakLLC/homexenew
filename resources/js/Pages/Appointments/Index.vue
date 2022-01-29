<template>
    <app-layout>
        <template v-slot:page-header>
            <div class="sm:flex sm:items-center">
                <div class="flex-grow pt-2">
                    <Title class="leading-none sm:truncate">
                        Appointments
                    </Title>
                </div>
            </div>
        </template>

        <template v-slot:default>
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
                    class="flex gap-4 leading-6 text-gray-900 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                    <div
                        v-for="appointment in this.appointments"
                        :key="appointment.uuid">
                        <DealCard
                            :appointment="appointment"
                            :leads="this.leads" />
                    </div>
                </div>
            </div>
        </template>
    </app-layout>
</template>

<script>
    import AppLayout from '../../Layouts/AppLayout';
    import moment from 'moment';
    import DealCard from '../Components/DealCard';
    import Title from '@/Components/Title';
    export default {
        name: 'Index',

        components: {
            DealCard,
            AppLayout,
            Title,
        },

        props: ['appointments', 'leads'],
    };
</script>

<style scoped></style>
