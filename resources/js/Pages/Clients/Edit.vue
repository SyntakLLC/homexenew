<template>
    <app-layout>
        <div class="px-4 pt-12 pb-12 leading-6 text-gray-900">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2
                        class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                        {{ this.client.name }}
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
                        <form @submit.prevent="submit">
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
                                                v-model="updateClientForm.name"
                                                type="text"
                                                name="first-name"
                                                id="first-name"
                                                autocomplete="given-name"
                                                class="mt-1 focus:ring-brand-400 focus:border-brand-400 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label
                                                for="phone"
                                                class="block text-sm font-medium text-gray-700">
                                                Phone
                                            </label>
                                            <input
                                                v-model="
                                                    updateClientForm.phoneNumber
                                                "
                                                type="text"
                                                name="phone"
                                                id="phone"
                                                class="mt-1 focus:ring-brand-400 focus:border-brand-400 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-4">
                                            <label
                                                for="email-address"
                                                class="block text-sm font-medium text-gray-700">
                                                Email address
                                            </label>
                                            <input
                                                v-model="updateClientForm.email"
                                                type="text"
                                                name="email-address"
                                                id="email-address"
                                                autocomplete="email"
                                                class="mt-1 focus:ring-brand-400 focus:border-brand-400 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        </div>

                                        <div
                                            class="col-span-6 sm:col-span-6 lg:col-span-2">
                                            <label
                                                for="city"
                                                class="block text-sm font-medium text-gray-700">
                                                GCI %
                                            </label>
                                            <input
                                                v-model="updateClientForm.gci"
                                                type="text"
                                                name="city"
                                                id="city"
                                                autocomplete="address-level2"
                                                class="mt-1 focus:ring-brand-400 focus:border-brand-400 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
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
                                                    updateClientForm.clientType
                                                "
                                                id="status"
                                                name="status"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-brand-400 focus:border-brand-400 sm:text-sm">
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
                                                    updateClientForm.status
                                                "
                                                id="status"
                                                name="status"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-brand-400 focus:border-brand-400 sm:text-sm">
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
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-400 hover:bg-brand-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-400">
                                        {{
                                            updateClientForm.recentlySuccessful
                                                ? 'Updated'
                                                : updateClientForm.processing
                                                ? 'Updating...'
                                                : 'Update'
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
        name: 'Edit',
        components: { AppLayout },
        props: ['user', 'client'],
        data() {
            return {
                updateClientForm: this.$inertia.form({
                    clientId: this.client.uuid,
                    name: this.client.name,
                    phoneNumber: this.client.phone,
                    email: this.client.email,
                    status: this.client.status,
                    clientType: this.client.client_type,
                    salesPrice: this.client.sales_price,
                    address: this.client.address,
                    closingDate: this.client.closing_date,
                    capped: this.client.capped,
                    gci: this.client.gci,
                }),
            };
        },

        methods: {
            submit() {
                this.updateClientForm.put(
                    this.route('client.update', this.client),
                );
            },
            // altSubmit() {
            //     console.log(this.client);
            //     this.$inertia.put(this.route('client.update', this.client), {
            //         name: 'JJ',
            //     });
            // },
        },
    };
</script>

<style scoped></style>
