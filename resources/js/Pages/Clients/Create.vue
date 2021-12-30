<template>
    <app-layout title="Clients">
        <div class="px-4 pt-12 pb-12 leading-6 text-gray-900">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2
                        class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                        New Client
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
                                createClientForm.post('/create-client')
                            ">
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label
                                                for="first-name"
                                                class="block text-sm font-medium text-gray-700">
                                                Name
                                            </label>
                                            <input
                                                v-model="createClientForm.name"
                                                type="text"
                                                name="first-name"
                                                id="first-name"
                                                autocomplete="given-name"
                                                class="mt-1 focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label
                                                for="phone"
                                                class="block text-sm font-medium text-gray-700">
                                                Phone
                                            </label>
                                            <input
                                                v-model="createClientForm.phone"
                                                type="text"
                                                name="phone"
                                                id="phone"
                                                class="mt-1 focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-4">
                                            <label
                                                for="email-address"
                                                class="block text-sm font-medium text-gray-700">
                                                Email address
                                            </label>
                                            <input
                                                v-model="createClientForm.email"
                                                type="text"
                                                name="email-address"
                                                id="email-address"
                                                autocomplete="email"
                                                class="mt-1 focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        </div>

                                        <div
                                            class="col-span-6 sm:col-span-6 lg:col-span-2">
                                            <label
                                                for="city"
                                                class="block text-sm font-medium text-gray-700">
                                                GCI %
                                            </label>
                                            <input
                                                v-model="createClientForm.gci"
                                                type="text"
                                                name="city"
                                                id="city"
                                                autocomplete="address-level2"
                                                class="mt-1 focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        </div>

                                        <div
                                            class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label
                                                for="region"
                                                class="block text-sm font-medium text-gray-700">
                                                Listing or Buyer
                                            </label>

                                            <select
                                                v-model="
                                                    createClientForm.clientType
                                                "
                                                id="status"
                                                name="status"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                                <option>Listing</option>
                                                <option>Buyer</option>
                                            </select>
                                        </div>

                                        <div
                                            class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label
                                                for="postal-code"
                                                class="block text-sm font-medium text-gray-700">
                                                Status
                                            </label>

                                            <select
                                                v-model="
                                                    createClientForm.status
                                                "
                                                id="status"
                                                name="status"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                                <option>Signed</option>
                                                <option>Contract</option>
                                                <option>Closed</option>
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
                                            createClientForm.recentlySuccessful
                                                ? 'Saved'
                                                : createClientForm.processing
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
    export default {
        name: 'Create',
        components: { AppLayout },
        props: ['user'],
        data() {
            return {
                createClientForm: this.$inertia.form({
                    userId: this.user.id,
                    userName: this.user.name,
                    name: '',
                    phone: '',
                    email: '',
                    status: '',
                    clientType: '',
                    gci: '',
                }),
            };
        },
    };
</script>

<style scoped></style>
