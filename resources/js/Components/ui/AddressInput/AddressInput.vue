<template>
    <div class="grid grid-cols-6 gap-6 row-gap-5">
        <template v-if="!showForm">
            <div class="col-span-6">
                <div class="flex justify-between">
                    <label
                        for="address-autocomplete"
                        class="block text-sm font-medium leading-5 text-gray-700">
                        Search Address
                    </label>
                    <span class="text-sm leading-5 text-gray-500">
                        Required
                    </span>
                </div>

                <div class="mt-1 relative rounded-md">
                    <vue-google-autocomplete
                        :enable-geolocation="true"
                        required
                        :id="id + 'address-autocomplete'"
                        :classname="autocompleteClasses"
                        placeholder="Start typing the address"
                        v-on:placechanged="addressSelected">
                    </vue-google-autocomplete>
                </div>
            </div>
        </template>

        <template v-if="showForm">

            <div class="col-span-6">
                <input-group
                    :id="id + '-street1'"
                    :validator="validator.form['address.street1']"
                    label="Address line 1"
                    :disabled="disabled"
                    v-model="address.street1" />
            </div>

            <div class="col-span-6">
                <input-group
                    :id="id + '-street2'"
                    :validator="validator.form['address.street2']"
                    label="Address line 2"
                    corner-hint="Optional"
                    :disabled="disabled"
                    v-model="address.street2" />
            </div>

            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <input-group
                    :id="id + '-city'"
                    :validator="validator.form['address.city']"
                    label="City"
                    :disabled="disabled"
                    v-model="address.city" />
            </div>

            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                <select-group
                    :id="id + '-state'"
                    :validator="validator.form['address.state']"
                    v-model="address.state"
                    v-if="address.country === 'US'"
                    label="State"
                    :disabled="disabled"
                    :options="statesOptions" />

                <input-group
                    id="id + '-state'"
                    label="State/Province"
                    v-if="address.country !== 'US'"
                    :validator="validator.form['address.state']"
                    v-model="address.state"
                    :disabled="disabled" />
            </div>

            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                <input-group
                    :id="id + '-zip'"
                    :validator="validator.form['address.postal_code']"
                    :disabled="disabled"
                    label="Postal code"
                    :mask="'#####'"
                    v-model="address.postal_code" />
            </div>
        </template>
    </div>
</template>

<script>
    import VueGoogleAutocomplete from 'vue-google-autocomplete';
    import InputGroup from '@/Components/ui/InputGroup/InputGroup';
    import SelectGroup from '@/Components/ui/Select/SelectGroup';
    import countries from '@/Components/countries';
    import states from '@/Components/us_states';
    import { markRaw } from 'vue';

    export default {
        props: ['id', 'modelValue', 'validator', 'disabled'],
        components: { SelectGroup, InputGroup, VueGoogleAutocomplete },
        data() {
            return {
                address: this.modelValue,
                showForm: false,
                noErrorClasses:
                    'outline-none border py-3 px-4 bg-white text-base leading-tight block rounded-md transition duration-150 ease-in-out block w-full placeholder-gray-400 focus:border-brand-500 border-gray-300 focus:ring focus:ring-brand-500 focus:ring-opacity-50',
                disabledClasses:
                    'outline-none border py-3 px-4 bg-white text-base leading-tight block rounded-md transition duration-150 ease-in-out block w-full placeholder-gray-400 bg-gray-100 border-gray-300 cursor-not-allowed text-gray-400',
                errorClasses:
                    'outline-none border py-3 px-4 bg-white text-base leading-tight block rounded-md transition duration-150 ease-in-out block w-full placeholder-gray-400 border-red-300 text-red-900 placeholder-red-400 focus:border-red-300 focus:ring focus:ring-red-300 focus:ring-opacity-50 pr-10',
            };
        },
        methods: {
            addressSelected(addressData, places) {
                let placesData = markRaw(places);
                let country = placesData.address_components.filter((p) => {
                    return p.types.includes('country');
                })[0].short_name;

                let address = {
                    street1:
                        addressData.street_number + ' ' + addressData.route,
                    street2: '',
                    city: addressData.locality,
                    state: addressData.administrative_area_level_1,
                    postal_code: addressData.postal_code,
                    country: country,
                    latitude: addressData.latitude,
                    longitude: addressData.longitude,
                };

                this.showForm = true;

                this.$emit('update:modelValue', address);
            },
        },
        computed: {
            countryOptions() {
                return countries.map((c) => {
                    return { label: c.name, value: c.code };
                });
            },
            statesOptions() {
                return states.map((c) => {
                    return { label: c.name, value: c.code };
                });
            },
            autocompleteClasses() {
                if (this.disabled) {
                    return this.disabledClasses;
                }

                return this.noErrorClasses;
            },
        },
        mounted() {},
        created() {},
        setup() {
            return {};
        },
        watch: {
            address: function (newValue, oldValue) {
                this.$emit('update:modelValue', newValue);
            },
            modelValue: function (newValue, oldValue) {
                this.address = newValue;
            },
        },
    };
</script>

<style lang="scss" scoped></style>
