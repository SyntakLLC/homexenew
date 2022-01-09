<template>
    <app-layout>
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
                                                class="col-span-6 sm:col-span-2"
                                                :disabled="loading"
                                                id="price"
                                                v-model="form.price"
                                                placeholder="0.00"
                                                :mask="'#*.##'"
                                                label="Price"
                                                :validator="v$.form.price" />

                                            <date-picker
                                                class="col-span-6 sm:col-span-2"
                                                :disabled="loading"
                                                v-model="form.date"
                                                id="date"
                                                label="Listing Date"
                                                :validator="v$.form.date" />

                                            <select-group
                                                class="col-span-6 sm:col-span-2"
                                                :disabled="loading"
                                                v-model="form.status"
                                                id="status"
                                                label="Status"
                                                :validator="v$.form.status"
                                                :options="[
                                                    {
                                                        value: 'Active',
                                                        label: 'Active',
                                                    },
                                                    {
                                                        value: 'Pending',
                                                        label: 'Pending',
                                                    },
                                                    {
                                                        value: 'Sold',
                                                        label: 'Sold',
                                                    },
                                                ]" />

                                            <address-input
                                                class="col-span-6"
                                                :disabled="loading"
                                                id="address"
                                                v-model="form.address"
                                                label="Street address"
                                                :validator="v$" />
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
    import ListingCard from '../Components/ListingCard';
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
            ListingCard,
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
                    address: {
                        street1: '',
                        street2: '',
                        city: '',
                        state: '',
                        postal_code: '',
                        country: 'US',
                        latitude: '',
                        longitude: '',
                    },
                    price: null,
                    date: new Date().toJSON().slice(0, 10).replace(/-/g, '-'),
                    status: 'Active',
                    userId: this.user.id,
                    userName: this.user.name,
                },
                validations: {
                    form: {
                        'address.street1': {
                            maxLength: helpers.withMessage(
                                'This field cannot exceed 255 characters',
                                maxLength(255),
                            ),
                        },
                        'address.street2': {
                            maxLength: helpers.withMessage(
                                'This field cannot exceed 255 characters',
                                maxLength(255),
                            ),
                        },
                        'address.city': {
                            maxLength: helpers.withMessage(
                                'This field cannot exceed 255 characters',
                                maxLength(255),
                            ),
                        },
                        'address.state': {
                            maxLength: helpers.withMessage(
                                'This field cannot exceed 255 characters',
                                maxLength(255),
                            ),
                        },
                        'address.postal_code': {
                            maxLength: helpers.withMessage(
                                'This field cannot exceed 255 characters',
                                maxLength(255),
                            ),
                        },
                        'address.country': {
                            maxLength: helpers.withMessage(
                                'This field cannot exceed 255 characters',
                                maxLength(255),
                            ),
                        },
                        price: {
                            required: helpers.withMessage(
                                'This field is required',
                                required,
                            ),
                        },
                        date: {},
                        status: {},
                    },
                },
            };
        },
        methods: {
            submit() {
                this.$inertia.post(this.route('listing.store', this.form));
            },
        },
    };
</script>

<style scoped></style>
