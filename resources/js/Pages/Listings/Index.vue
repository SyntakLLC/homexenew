<template>
    <app-layout title="Listings">
        <div class="px-4 pt-12 pb-12 leading-6 text-gray-900">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2
                        class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                        Listings
                    </h2>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <button
                        type="button"
                        class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        <a :href="route('listing.create')">New</a>
                    </button>
                </div>
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
                    <div v-for="listing in this.listings">
                        <ListingCard
                            :price="listing.price"
                            :status="listing.status"
                            :address="listing.address"
                            button-text="Edit"
                            :button-link="
                                this.route('listing.edit', listing)
                            " />
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '../../Layouts/AppLayout';
    import ListingCard from '../Components/ListingCard.vue';
    export default {
        name: 'Index',
        components: { ListingCard, AppLayout },
        props: ['listings'],
    };
</script>

<style scoped></style>
