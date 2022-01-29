<template>
    <app-layout>
        <template v-slot:page-header>
            <div class="sm:flex sm:items-center">
                <div class="flex-grow pt-2">
                    <Title class="leading-none sm:truncate"> Listings </Title>
                </div>

                <div class="flex items-center flex-shrink-0 space-x-6">
                    <a
                        :href="route('listing.create')"
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
                    <div v-for="listing in this.listings" :key="listing.uuid">
                        <ListingCard
                            :price="listing.price"
                            :status="listing.status"
                            :address="listing.address"
                            button-text="Edit"
                            :button-link="
                                this.route('listing.edit', listing.uuid)
                            " />
                    </div>
                </div>
            </div>
        </template>
    </app-layout>
</template>

<script>
    import AppLayout from '../../Layouts/AppLayout';
    import ListingCard from '../Components/ListingCard.vue';
    import Title from '@/Components/Title';
    export default {
        name: 'Index',

        components: {
            ListingCard,
            AppLayout,
            Title,
        },

        props: ['listings'],
    };
</script>

<style scoped></style>
