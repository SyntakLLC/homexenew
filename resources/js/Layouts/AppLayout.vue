<template>
    <div>
        <div class="h-full flex min-h-screen">
            <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
            <transition
                enter-active-class="transition-opacity ease-linear duration-300"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="transition-opacity ease-linear duration-300"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0">
                <div v-show="showingNavigationDropdown">
                    <div
                        class="fixed inset-0 flex z-40 lg:hidden"
                        role="dialog"
                        aria-modal="true">
                        <div
                            class="fixed inset-0 bg-gray-600 bg-opacity-75"
                            aria-hidden="true"></div>

                        <transition
                            enter-active-class="transition ease-in-out duration-300 transform"
                            enter-from-class="-translate-x-full"
                            enter-to-class="translate-x-0"
                            leave-active-class="transition ease-in-out duration-300 transform"
                            leave-from-class="translate-x-0"
                            leave-to-class="-translate-x-full">
                            <div
                                class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-white">
                                <div class="absolute top-0 right-0 -mr-12 pt-2">
                                    <button
                                        @click="
                                            showingNavigationDropdown = false
                                        "
                                        type="button"
                                        class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                                        <span class="sr-only"
                                            >Close sidebar</span
                                        >
                                        <!-- Heroicon name: outline/x -->
                                        <svg
                                            class="h-6 w-6 text-white"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            aria-hidden="true">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <div
                                    class="flex-shrink-0 flex items-center px-4">
                                    <img
                                        class="h-16 w-auto"
                                        :src="asset('images/logo.gif')"
                                        alt="Homexe"
                                        style="border-radius: 20px" />
                                </div>
                                <div class="mt-5 flex-1 h-0 overflow-y-auto">
                                    <nav class="px-2">
                                        <div class="space-y-1">
                                            <!-- Current: "bg-gray-100 text-gray-900", Default: "text-gray-600 hover:text-gray-900 hover:bg-gray-50" -->
                                            <SidebarItem
                                                href="dashboard"
                                                text="Dashboard">
                                                <template #svg_path>
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                                </template>
                                            </SidebarItem>

                                            <SidebarItem
                                                href="appointment.index"
                                                text="Appointments">
                                                <template #svg_path>
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </template>
                                            </SidebarItem>

                                            <SidebarItem
                                                href="listing.index"
                                                text="Listings">
                                                <template #svg_path>
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                                </template>
                                            </SidebarItem>

                                            <SidebarItem
                                                href="client.index"
                                                text="Clients">
                                                <template #svg_path>
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                                </template>
                                            </SidebarItem>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </transition>

                        <div class="flex-shrink-0 w-14" aria-hidden="true">
                            <!-- Dummy element to force sidebar to shrink to fit close icon -->
                        </div>
                    </div>
                </div>
            </transition>

            <!-- Static sidebar for desktop -->
            <div class="hidden lg:flex lg:flex-shrink-0">
                <div
                    class="flex flex-col w-64 border-gray-200 pt-5 pb-4 bg-gray-100"
                    style="background-color: #f9f9f9">
                    <div class="flex items-center flex-shrink-0 px-6">
                        <img
                            class="h-16 w-auto"
                            :src="asset('images/logo.gif')"
                            alt="Homexe"
                            style="border-radius: 20px" />
                    </div>
                    <!-- Sidebar component, swap this element with another sidebar if you like -->
                    <div class="mt-6 h-0 flex-1 flex flex-col overflow-y-auto">
                        <!-- User account dropdown -->
                        <AccountButton
                            :showing-profile-dropdown="
                                showingProfileDropdown
                            " />

                        <!-- Navigation -->
                        <nav class="px-3 mt-6">
                            <div class="space-y-1">
                                <!-- Current: "bg-gray-200 text-gray-900", Default: "text-gray-700 hover:text-gray-900 hover:bg-gray-50" -->
                                <SidebarItem href="dashboard" text="Dashboard">
                                    <template #svg_path>
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </template>
                                </SidebarItem>

                                <SidebarItem
                                    href="appointment.index"
                                    text="Appointments">
                                    <template #svg_path>
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </template>
                                </SidebarItem>

                                <SidebarItem
                                    href="listing.index"
                                    text="Listings">
                                    <template #svg_path>
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </template>
                                </SidebarItem>

                                <SidebarItem href="client.index" text="Clients">
                                    <template #svg_path>
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </template>
                                </SidebarItem>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Main column -->
            <div class="flex flex-col w-0 flex-1 overflow-hidden">
                <!-- Search header -->
                <div
                    class="relative z-10 flex-shrink-0 flex h-16 bg-white border-b border-gray-200 lg:hidden">
                    <!-- Sidebar toggle, controls the 'sidebarOpen' sidebar state. -->
                    <button
                        type="button"
                        @click="showingNavigationDropdown = true"
                        class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-purple-500 lg:hidden">
                        <span class="sr-only">Open sidebar</span>
                        <!-- Heroicon name: outline/menu-alt-1 -->
                        <svg
                            class="h-6 w-6"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            aria-hidden="true">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                    </button>
                    <div
                        class="flex-1 flex justify-between px-4 sm:px-6 lg:px-8">
                        <div class="flex-1 flex"></div>
                        <div class="flex items-center">
                            <!-- Profile dropdown -->
                            <div class="ml-3 relative">
                                <div>
                                    <button
                                        @click="
                                            showingProfileDropdown =
                                                !showingProfileDropdown
                                        "
                                        type="button"
                                        class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
                                        id="user-menu-button"
                                        aria-expanded="false"
                                        aria-haspopup="true">
                                        <span class="sr-only"
                                            >Open user menu</span
                                        >
                                        <img
                                            class="h-8 w-8 rounded-full"
                                            :src="
                                                $page.props.user
                                                    .profile_photo_url
                                            "
                                            alt="" />
                                    </button>
                                </div>

                                <transition
                                    enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95">
                                    <div
                                        v-show="showingProfileDropdown"
                                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-200 focus:outline-none"
                                        role="menu"
                                        aria-orientation="vertical"
                                        aria-labelledby="user-menu-button"
                                        tabindex="-1">
                                        <div class="py-1" role="none">
                                            <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                            <DropdownListItem
                                                text="View profile"
                                                href="profile.show" />
                                        </div>
                                        <div class="py-1" role="none">
                                            <a
                                                @click="
                                                    $inertia.post(
                                                        route('logout'),
                                                    )
                                                "
                                                href="#"
                                                class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                                role="menuitem"
                                                tabindex="-1"
                                                id="user-menu-item-5"
                                                >Logout</a
                                            >
                                        </div>
                                    </div>
                                </transition>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="w-full h-full bg-gray-100"
                    style="background-color: #f9f9f9">
                    <div class="max-w-7xl mx-auto">
                        <slot />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue';
    import JetApplicationMark from '@/Jetstream/ApplicationMark.vue';
    import JetBanner from '@/Jetstream/Banner.vue';
    import JetDropdown from '@/Jetstream/Dropdown.vue';
    import JetDropdownLink from '@/Jetstream/DropdownLink.vue';
    import JetNavLink from '@/Jetstream/NavLink.vue';
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue';
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import DropdownListItem from '../Pages/Components/DropdownListItem';
    import SidebarItem from '../Pages/Components/SidebarItem';
    import AccountButton from '../Pages/Components/AccountButton';

    export default defineComponent({
        props: ['user'],

        components: {
            AccountButton,
            SidebarItem,
            DropdownListItem,
            Head,
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            Link,
        },

        data() {
            return {
                showingNavigationDropdown: false,
                showingProfileDropdown: false,
            };
        },

        methods: {
            logout() {
                this.$inertia.post(route('logout'));
            },
        },
    });
</script>
