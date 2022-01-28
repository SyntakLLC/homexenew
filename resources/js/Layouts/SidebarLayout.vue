<template>
    <div class="max-h-screen flex items-stretch overflow-hidden">
        <sidebar
            :navigation="navigation"
            :sidebarOpen="sidebarOpen"
            appTitle="Notably">
        </sidebar>

        <!--         <secondary-fill-sidebar
            :navigation="navigation"
            :sidebarOpen="sidebarOpen"
            appTitle="Notably">
            <template v-slot:app-title>
                <span
                    class="underline decoration-4 decoration-brand-400 underline-offset-4"
                    >Notedl</span
                >y
            </template>
        </secondary-fill-sidebar> -->

        <!--         <icon-only-sidebar
            :navigation="navigation"
            :sidebarOpen="sidebarOpen"
            appTitle="Notably">
            <template v-slot:app-title> Notedly </template>
        </icon-only-sidebar> -->

        <!-- Stage -->
        <div
            class="flex-grow flex-shrink flex flex-col flex-shrink-0 overflow-y-scroll relative max-w-full">
            <!-- Mobile header -->
            <div
                class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white border-b border-gray-200 md:hidden">
                <button
                    type="button"
                    class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-brand-400 lg:hidden"
                    @click="sidebarOpen = true">
                    <span class="sr-only">Open sidebar</span>
                    <MenuAlt1Icon class="h-6 w-6" aria-hidden="true" />
                </button>
                <div class="flex-1 flex justify-end px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-end">
                        <!-- Profile dropdown -->
                        <user-icon-with-menu class="ml-3" />
                    </div>
                </div>
            </div>

            <main class="flex-1">
                <div class="max-w-7xl mx-auto py-6 bg-white">
                    <div>
                        <div
                            class="py-4 px-4 sm:px-8 lg:px-10 grid relative gap-y-10">
                            <slot name="app-layout" />
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
    import { ref } from 'vue';
    import UserIconWithMenu from '@/Components/UserIconWithMenu.vue';
    import SecondaryFillSidebar from '@/Components/sidebar/SecondaryFillSidebar.vue';
    import IconOnlySidebar from '@/Components/sidebar/IconOnlySidebar.vue';
    import Sidebar from '@/Components/sidebar/Sidebar.vue';
    import { Link } from '@inertiajs/inertia-vue3';
    import { MenuAlt1Icon } from '@heroicons/vue/outline';

    export default {
        components: {
            MenuAlt1Icon,
            UserIconWithMenu,
            Link,
            SecondaryFillSidebar,
            IconOnlySidebar,
            Sidebar,
        },
        props: ['navigation'],
        setup() {
            const sidebarOpen = ref(false);

            return {
                sidebarOpen,
            };
        },
    };
</script>
