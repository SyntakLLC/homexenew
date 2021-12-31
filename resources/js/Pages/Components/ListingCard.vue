<template>
    <div
        class="flex relative flex-col w-full text-gray-900 bg-white rounded-lg shadow-sm"
        style="min-height: 179px">
        <div class="flex flex-col flex-auto">
            <div
                class="pt-5 pb-2 px-8 text-sm font-semibold leading-5 text-gray-800">
                {{
                    '$' +
                    this.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
                }}
            </div>
            <div class="py-0 px-8">
                <div class="text-2xl font-semibold leading-0 flex flex-col">
                    <span class="">{{ this.address.street1 }}</span>
                    <div class="block pt-2">
                        <span
                            class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium"
                            :class="
                                this.status == 'Sold'
                                    ? 'bg-green-100 text-green-500'
                                    : this.status == 'Pending'
                                    ? 'bg-yellow-100 text-yellow-500'
                                    : 'bg-red-100 text-red-500'
                            ">
                            {{ this.status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="h-3 w-10" />

        <div class="flex-none border-t border-gray-300 border-solid">
            <div class="flex justify-end py-2 px-6">
                <a
                    :href="this.buttonLink"
                    class="inline-flex overflow-visible justify-center items-center p-0 m-0 text-center text-blue-800 normal-case bg-transparent appearance-none cursor-pointer select-none focus:text-blue-800 focus:no-underline hover:text-blue-800 hover:no-underline"
                    type="button"
                    style="outline: none">
                    <span class="text-sm font-medium leading-5">{{
                        this.buttonText
                    }}</span>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ListingCard',

        props: ['price', 'address', 'buttonText', 'buttonLink', 'status'],
    };
</script>

<style scoped></style>
