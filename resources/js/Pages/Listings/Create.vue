<template>
    <app-layout title="Listings">
        <div class="px-4 pt-12 pb-12 leading-6 text-gray-900">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2
                        class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                        New Listing
                    </h2>
                </div>
            </div>

            <div class="py-8 sm:mt-0">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3
                                class="text-lg font-medium leading-6 text-gray-900">
                                Basic Information
                            </h3>
                            <p class="mt-1 text-sm text-gray-600">
                                You can always edit this information later.
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form
                            @submit.prevent="
                                createListingForm.post('/create-listing')
                            ">
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6">
                                            <label
                                                for="street-address"
                                                class="block text-sm font-medium text-gray-700"
                                                >Street address</label
                                            >
                                            <input
                                                v-model="
                                                    createListingForm.address
                                                "
                                                type="text"
                                                name="street-address"
                                                id="street-address"
                                                autocomplete="street-address"
                                                class="mt-1 focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label
                                                for="price"
                                                class="block text-sm font-medium text-gray-700">
                                                Price
                                            </label>

                                            <div
                                                class="mt-1 flex rounded-md shadow-sm">
                                                <span
                                                    class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                                    $
                                                </span>
                                                <input
                                                    v-model="
                                                        createListingForm.price
                                                    "
                                                    type="number"
                                                    name="price"
                                                    id="price"
                                                    class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-primary focus:border-primary sm:text-sm border-gray-300"
                                                    placeholder="www.example.com" />
                                            </div>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label
                                                for="date"
                                                class="block text-sm font-medium text-gray-700">
                                                Listing Date
                                            </label>
                                            <input
                                                v-model="createListingForm.date"
                                                type="date"
                                                name="date"
                                                id="date"
                                                autocomplete="family-name"
                                                class="mt-1 focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label
                                                for="status"
                                                class="block text-sm font-medium text-gray-700">
                                                Status
                                            </label>
                                            <select
                                                v-model="
                                                    createListingForm.status
                                                "
                                                id="status"
                                                name="status"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                                <option>Active</option>
                                                <option>Pending</option>
                                                <option>Sold</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button
                                        type="submit"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                        {{
                                            createListingForm.recentlySuccessful
                                                ? 'Saved'
                                                : createListingForm.processing
                                                ? 'Saving...'
                                                : 'Save'
                                        }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '../../Layouts/AppLayout';
    import ListingCard from '../Components/ListingCard';
    import moment from 'moment';
    export default {
        name: 'Create',
        components: { ListingCard, AppLayout },
        props: ['user'],
        data() {
            return {
                createListingForm: this.$inertia.form({
                    address: '',
                    price: 0.0,
                    date: new Date(),
                    status: 'Active',
                    userId: this.user.id,
                    userName: this.user.name,
                }),
            };
        },
    };
</script>

<style scoped></style>
