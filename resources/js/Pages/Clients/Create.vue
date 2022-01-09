<!-- <template>
    <app-layout>
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
                                                class="mt-1 focus:ring-brand-400 focus:border-brand-400 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
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
                                                class="mt-1 focus:ring-brand-400 focus:border-brand-400 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
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
                                                v-model="createClientForm.gci"
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
                                                Client or Buyer
                                            </label>

                                            <select
                                                v-model="
                                                    createClientForm.clientType
                                                "
                                                id="status"
                                                name="status"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-brand-400 focus:border-brand-400 sm:text-sm">
                                                <option>Client</option>
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

<style scoped></style> -->

<template>
    <app-layout>
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
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="bg-white">
                                <form-helper
                                    :data="form"
                                    :submit="submit"
                                    :validations="validations">
                                    <template v-slot="{ loading, v$ }">
                                        <div
                                            class="grid grid-cols-6 gap-6 mb-6 px-4 py-5 sm:p-6">
                                            <input-group
                                                class="col-span-6 sm:col-span-3"
                                                :disabled="loading"
                                                id="name"
                                                v-model="form.name"
                                                label="Name"
                                                :validator="v$.form.name" />

                                            <input-group
                                                class="col-span-6 sm:col-span-3"
                                                :disabled="loading"
                                                id="phone-number"
                                                v-model="form.phoneNumber"
                                                :mask="'### ### ####'"
                                                label="Phone Number"
                                                :validator="
                                                    v$.form.phoneNumber
                                                " />

                                            <input-group
                                                class="col-span-6 sm:col-span-4"
                                                :disabled="loading"
                                                id="email"
                                                v-model="form.email"
                                                label="Email"
                                                :validator="v$.form.email" />

                                            <input-group
                                                class="col-span-6 sm:col-span-6 lg:col-span-2"
                                                :disabled="loading"
                                                id="gci"
                                                v-model="form.gci"
                                                :mask="'###'"
                                                label="GCI %"
                                                :validator="v$.form.gci" />

                                            <select-group
                                                class="col-span-6 sm:col-span-6 lg:col-span-2"
                                                :disabled="loading"
                                                v-model="form.clientType"
                                                id="client-type"
                                                label="Client Type"
                                                :validator="v$.form.clientType"
                                                :options="[
                                                    {
                                                        value: 'Listing',
                                                        label: 'Listing',
                                                    },
                                                    {
                                                        value: 'Buyer',
                                                        label: 'Buyer',
                                                    },
                                                ]" />

                                            <select-group
                                                class="col-span-6 sm:col-span-6 lg:col-span-2"
                                                :disabled="loading"
                                                v-model="form.status"
                                                id="status"
                                                label="Status"
                                                :validator="v$.form.status"
                                                :options="[
                                                    {
                                                        value: 'Signed',
                                                        label: 'Signed',
                                                    },
                                                    {
                                                        value: 'Contract',
                                                        label: 'Contract',
                                                    },
                                                    {
                                                        value: 'Closed',
                                                        label: 'Closed',
                                                    },
                                                ]" />
                                        </div>
                                        <div
                                            class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                            <button-component
                                                color="primary"
                                                type="submit"
                                                :loading="loading"
                                                text="Save" />
                                        </div>
                                    </template>
                                </form-helper>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '../../Layouts/AppLayout';
    import ClientCard from '../Components/ClientCard';
    import moment from 'moment';
    import FormHelper from '@/Components/utils/FormHelper';
    import AddressInput from '@/Components/ui/AddressInput/AddressInput';

    import InputGroup from '@/Components/ui/InputGroup/InputGroup';
    import ButtonComponent from '@/Components/ui/Button/ButtonComponent';
    import DatePicker from '@/Components/ui/DatePicker/DateInput';
    import SelectGroup from '@/Components/ui/Select/SelectGroup';

    import { helpers, required, maxLength } from '@vuelidate/validators';

    export default {
        name: 'Create',
        components: {
            ClientCard,
            AppLayout,
            FormHelper,
            InputGroup,
            ButtonComponent,
            DatePicker,
            SelectGroup,
            AddressInput,
        },
        props: ['user'],
        data() {
            return {
                form: {
                    name: '',
                    phoneNumber: null,
                    email: '',
                    gci: null,
                    clientType: 'Listing',
                    status: 'Contract',
                },
                validations: {
                    form: {
                        // name 6-3, phone number 6-3, email 6-4, gci 6 6 2, clientType 6 3 2, status 6 3 2
                        name: {
                            required: helpers.withMessage(
                                'This field is required',
                                required,
                            ),
                        },
                        phoneNumber: {
                            required: helpers.withMessage(
                                'This field is required',
                                required,
                            ),
                        },
                        email: {
                            required: helpers.withMessage(
                                'This field is required',
                                required,
                            ),
                        },
                        gci: {
                            required: helpers.withMessage(
                                'This field is required',
                                required,
                            ),
                        },
                        clientType: {},
                        status: {},
                    },
                },
            };
        },
        methods: {
            submit() {
                this.$inertia.post(this.route('client.store', this.form));
            },
        },
    };
</script>

<style scoped></style>
