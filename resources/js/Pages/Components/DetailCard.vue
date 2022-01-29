<template>
    <div
        class="flex relative flex-col w-full text-gray-900 bg-white rounded-border">
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

        <div
            v-if="this.buttonText"
            class="flex-none border-t border-gray-300 border-solid rounded-b-lg">
            <div class="flex justify-end py-2 px-6">
                <Link
                    :href="this.buttonLink"
                    class="inline-flex overflow-visible justify-center items-center p-0 m-0 text-center text-blue-800 normal-case bg-white appearance-none cursor-pointer select-none focus:text-blue-800 focus:no-underline hover:text-blue-800 hover:no-underline"
                    type="button"
                    style="outline: none">
                    <span class="text-sm font-medium leading-5">{{
                        this.buttonText
                    }}</span>
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3';

    export default {
        name: 'DetailCard',

        props: ['title', 'detail', 'buttonText', 'buttonLink'],

        components: {
            Link,
        },
    };
</script>

<style scoped></style>
