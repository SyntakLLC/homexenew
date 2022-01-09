<template>
    <div
        class="flex relative flex-col w-full text-gray-900 bg-white rounded-lg shadow-sm"
        style="min-height: 179px">
        <!-- Copied Notification -->
        <div
            aria-live="assertive"
            class="fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start">
            <div
                class="w-full flex flex-col items-center space-y-4 sm:items-end">
                <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->
                <transition
                    enter-active-class="transform ease-out duration-300 transition"
                    enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                    enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                    leave-active-class="transition ease-in duration-100"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0">
                    <div
                        v-if="this.showCopyNotification"
                        class="max-w-xs w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
                        <div class="p-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <CheckCircleIcon
                                        class="h-6 w-6 text-green-400"
                                        aria-hidden="true" />
                                </div>
                                <div class="ml-3 w-0 flex-1 pt-0.5">
                                    <p
                                        class="text-sm font-medium text-gray-900">
                                        Copied!
                                    </p>
                                </div>
                                <div class="ml-4 flex-shrink-0 flex">
                                    <button
                                        @click="show = false"
                                        class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                                        <span class="sr-only">Close</span>
                                        <XIcon
                                            class="h-5 w-5"
                                            aria-hidden="true" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
        </div>

        <!-- Rest of code -->
        <div class="flex flex-row items-center justify-center">
            <div class="px-4">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-10 w-10 p-2 bg-brand-400 rounded-full self-center text-white"
                    viewBox="0 0 20 20"
                    fill="currentColor">
                    <path
                        fill-rule="evenodd"
                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd" />
                </svg>
            </div>

            <div class="flex flex-col flex-auto">
                <div
                    class="pt-5 pb-2 text-sm font-semibold leading-5 text-gray-500">
                    GCI: {{ this.gci }}% • {{ this.clientType }}
                </div>
                <div class="py-0">
                    <div class="text-2xl font-semibold leading-0 flex flex-col">
                        <span class="">{{ this.clientName }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="h-10 w-10" />

        <div class="flex-none border-t border-gray-300 border-solid">
            <div>
                <div class="-mt-px flex divide-x divide-gray-200">
                    <div class="w-0 flex-1 flex">
                        <a
                            class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-2 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg">
                            <MailIcon
                                class="w-5 h-5 text-gray-400"
                                aria-hidden="true" />
                            <span class="ml-3 p-2 cursor-pointer truncate">
                                {{ this.email }}
                            </span>
                        </a>
                    </div>
                    <div class="-ml-px w-0 flex-1 flex">
                        <a
                            class="relative w-0 flex-1 inline-flex items-center justify-center py-2 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg">
                            <PhoneIcon
                                class="w-5 h-5 text-gray-400"
                                aria-hidden="true" />
                            <span class="ml-3 p-2 cursor-pointer truncate">
                                {{ this.phone }}
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

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
    import { MailIcon, PhoneIcon } from '@heroicons/vue/solid';
    import { CheckCircleIcon } from '@heroicons/vue/outline';
    import { XIcon } from '@heroicons/vue/solid';

    export default {
        name: 'ListingCard',
        components: {
            MailIcon,
            PhoneIcon,
            CheckCircleIcon,
            XIcon,
        },

        props: [
            'gci',
            'clientName',
            'buttonText',
            'buttonLink',
            'status',
            'clientType',
            'email',
            'phone',
        ],

        data() {
            return {
                showCopyNotification: false,
            };
        },
    };
</script>

<style scoped></style>
