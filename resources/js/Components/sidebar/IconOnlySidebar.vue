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
                        <div class="flex-shrink-0 flex items-center px-4"></div>
                        <div class="flex-1 h-0 overflow-y-auto">
                            <nav class="px-2">
                                <div class="space-y-1">
                                    <icon-sidebar-item
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
            class="hidden overflow-hidden flex-shrink-0 md:flex md:flex-col md:w-20 md:border-r-2 md:border-gray-100 md:pt-5 md:pb-4 min-h-screen bg-brand-0">
            <div class="pt-7 flex items-center justify-center flex-shrink-0">
                <logo class="w-1/2 h-1/2" />
            </div>
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="h-0 flex-1 flex flex-col overflow-y-auto">
                <!-- Navigation -->
                <nav class="mt-8">
                    <div class="space-y-8">
                        <Link
                            :href="route('profile.show')"
                            :class="[
                                route().current('profile.show')
                                    ? 'icon-only-sidebar-item-active-text'
                                    : 'icon-only-sidebar-item-inactive-text',
                                'group icon-only-sidebar-item-text-styling',
                            ]">
                            <img
                                class="h-8 w-8 rounded-full ml-2"
                                :src="
                                    'https://ui-avatars.com/api/?name=' +
                                    $page.props.user.name.replace(' ', '+') +
                                    '&color=eaf1f9&background=1470C4'
                                "
                                :alt="$page.props.user.name" />
                            <span class="block md:hidden">User Menu</span>
                        </Link>

                        <icon-sidebar-item
                            v-for="item in navigation"
                            :key="item.name"
                            :item="item" />

                        <a
                            @click="this.$inertia.post(route('logout'))"
                            class="cursor-pointer icon-only-sidebar-item-inactive-text group icon-only-sidebar-item-text-styling">
                            <LogoutIcon
                                class="mx-3 flex-shrink-0 h-6 w-6 hidden md:block"
                                aria-hidden="true" />
                            <span class="block md:hidden">Logout</span>
                        </a>
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
    import { XIcon, LogoutIcon } from '@heroicons/vue/outline';
    import UserIconWithMenu from '@/Components/UserIconWithMenu.vue';
    import IconSidebarItem from '@/Components/sidebar/IconSidebarItem.vue';
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
            IconSidebarItem,
            Logo,
            LogoutIcon,
            Link,
        },
        props: ['navigation', 'sidebarOpen', 'appTitle'],
    };
</script>
