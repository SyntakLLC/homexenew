<template>
    <app-layout>
        <template v-slot:page-header>
            <div class="sm:flex sm:items-center">
                <div class="flex-grow pt-2">
                    <Title class="leading-none sm:truncate">
                        Transactions
                    </Title>
                </div>

                <div class="flex items-center flex-shrink-0 space-x-6">
                    <a
                        :href="route('client.create')"
                        class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-brand-400 hover:bg-brand-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-400"
                        >New</a
                    >
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
                    <div v-for="client in this.clients" :key="client.uuid">
                        <ClientCard
                            :gci="client.gci"
                            :clientType="client.client_type"
                            :clientName="client.name"
                            :phone="formatPhoneNumber(client.phone)"
                            :email="client.email"
                            button-text="Edit"
                            :button-link="this.route('client.edit', client)" />
                    </div>
                </div>
            </div>
        </template>
    </app-layout>
</template>

<script>
    import AppLayout from '../../Layouts/AppLayout';
    import ClientCard from '../Components/ClientCard';
    import Title from '@/Components/Title';
    export default {
        name: 'Index',

        components: {
            ClientCard,
            AppLayout,
            Title,
        },

        props: ['clients'],

        methods: {
            formatPhoneNumber(phoneNumberString) {
                var cleaned = ('' + phoneNumberString).replace(/\D/g, '');
                var match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);
                if (match) {
                    return '(' + match[1] + ') ' + match[2] + '-' + match[3];
                }
                return null;
            },
        },
    };
</script>

<style scoped></style>
