<template>
    <div>
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog
                as="div"
                class="fixed inset-0 flex z-40 lg:hidden"
                @close="sidebarOpen = false">
                <TransitionChild
                    as="template"
                    enter="transition-opacity ease-linear duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="transition-opacity ease-linear duration-300"
                    leave-from="opacity-100"
                    leave-to="opacity-0">
                    <DialogOverlay
                        class="fixed inset-0 bg-gray-600 bg-opacity-75" />
                </TransitionChild>
                <TransitionChild
                    as="template"
                    enter="transition ease-in-out duration-300 transform"
                    enter-from="-translate-x-full"
                    enter-to="translate-x-0"
                    leave="transition ease-in-out duration-300 transform"
                    leave-from="translate-x-0"
                    leave-to="-translate-x-full">
                    <div
                        class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-white">
                        <TransitionChild
                            as="template"
                            enter="ease-in-out duration-300"
                            enter-from="opacity-0"
                            enter-to="opacity-100"
                            leave="ease-in-out duration-300"
                            leave-from="opacity-100"
                            leave-to="opacity-0">
                            <div class="absolute top-0 right-0 -mr-12 pt-2">
                                <button
                                    type="button"
                                    class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                    @click="sidebarOpen = false">
                                    <span class="sr-only">Close sidebar</span>
                                    <XIcon
                                        class="h-6 w-6 text-white"
                                        aria-hidden="true" />
                                </button>
                            </div>
                        </TransitionChild>
                        <div class="flex-shrink-0 flex items-center px-4">
                            <!--                             <img
                                class="h-8 w-auto"
                                src="https://tailwindui.com/img/logos/workflow-logo-purple-500-mark-gray-700-text.svg"
                                alt="Workflow"
                            /> -->
                            <!--                             <Title class="leading-none sm:truncate mb-5">
                                Notedly
                            </Title> -->
                        </div>
                        <div class="flex-1 h-0 overflow-y-auto">
                            <nav class="px-2">
                                <div class="space-y-1">
                                    <sidebar-item
                                        v-for="item in navigation"
                                        :key="item.name"
                                        :item="item" />
                                </div>
                            </nav>
                        </div>
                    </div>
                </TransitionChild>
                <div class="flex-shrink-0 w-14" aria-hidden="true">
                    <!-- Dummy element to force sidebar to shrink to fit close icon -->
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- Static sidebar for desktop -->
        <div
            class="hidden overflow-hidden flex-shrink-0 md:flex md:flex-col md:w-64 md:bg-brand-0 md:pt-5 md:pb-4 md:px-8 min-h-screen">
            <div class="pt-7 flex items-center flex-shrink-0">
                <!--                 <img
                    class="h-8 w-auto"
                    src="https://tailwindui.com/img/logos/workflow-logo-purple-500-mark-gray-700-text.svg"
                    alt="Workflow"
                /> -->
                <logo />
            </div>
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="h-0 flex-1 flex flex-col overflow-y-auto">
                <!-- Navigation -->
                <nav class="mt-8">
                    <div class="space-y-2">
                        <sidebar-item
                            v-for="item in navigation"
                            :key="item.name"
                            :item="item" />
                    </div>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
    import { ref } from 'vue';
    import Title from '@/Components/Title';
    import {
        Dialog,
        DialogOverlay,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        TransitionChild,
        TransitionRoot,
    } from '@headlessui/vue';
    import { XIcon } from '@heroicons/vue/outline';
    import UserIconWithMenu from '@/Components/UserIconWithMenu.vue';
    import SidebarItem from '@/Components/sidebar/SidebarItem.vue';
    import Logo from '@/Components/Logo.vue';
    import { Link } from '@inertiajs/inertia-vue3';

    export default {
        components: {
            Dialog,
            DialogOverlay,
            Menu,
            MenuButton,
            MenuItem,
            MenuItems,
            TransitionChild,
            TransitionRoot,
            XIcon,
            Title,
            UserIconWithMenu,
            SidebarItem,
            Link,
            Logo,
        },
        props: ['navigation', 'sidebarOpen'],
    };
</script>
