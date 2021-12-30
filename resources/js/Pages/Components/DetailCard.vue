<template>
    <div
        class="flex relative flex-col w-full text-gray-900 bg-white rounded-lg shadow-sm"
        style="min-height: 179px">
        <div class="flex flex-col flex-auto">
            <div
                class="py-5 px-8 text-sm font-semibold leading-5 text-gray-800">
                {{ this.title }}
            </div>
            <div class="py-0 px-8">
                <div class="text-2xl font-semibold leading-8">
                    <span class="">{{ this.detail }}</span>
                </div>
            </div>
        </div>

        <div class="h-10 w-10" />

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
        name: 'DetailCard',

        props: ['title', 'detail', 'buttonText', 'buttonLink'],
    };
</script>

<style scoped></style>
