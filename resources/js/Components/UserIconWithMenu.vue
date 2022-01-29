<template>
    <Menu as="div" class="z-50 relative">
        <div>
            <MenuButton
                class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                <span class="sr-only">Open user menu</span>
                <img
                    class="h-10 w-10 rounded-full"
                    :src="
                        'https://ui-avatars.com/api/?name=' +
                        $page.props.user.name.replace(' ', '+') +
                        '&color=eaf1f9&background=1470C4'
                    "
                    :alt="$page.props.user.name" />
            </MenuButton>
        </div>
        <transition
            enter-active-class="transition ease-out duration-100"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
            <MenuItems
                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-200 focus:outline-none">
                <div class="py-1">
                    <MenuItem v-slot="{ active }">
                        <Link :href="route('profile.show')">
                            <a
                                :class="[
                                    active
                                        ? 'bg-gray-100 text-gray-900'
                                        : 'text-gray-700',
                                    'block px-4 py-2 text-sm',
                                ]"
                                >View profile</a
                            >
                        </Link>
                    </MenuItem>
                </div>
                <div class="py-1">
                    <MenuItem v-slot="{ active }">
                        <a
                            :href="route('spark.portal')"
                            :class="[
                                active
                                    ? 'bg-gray-100 text-gray-900'
                                    : 'text-gray-700',
                                'block px-4 py-2 text-sm',
                            ]"
                            >Billing</a
                        >
                    </MenuItem>
                </div>
                <div class="py-1">
                    <MenuItem v-slot="{ active }">
                        <Link>
                            <a
                                @click="this.$inertia.post(route('logout'))"
                                :class="[
                                    active
                                        ? 'bg-gray-100 text-gray-900'
                                        : 'text-gray-700',
                                    'block px-4 py-2 text-sm',
                                ]">
                                Logout
                            </a>
                        </Link>
                    </MenuItem>
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3';
    import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';

    export default {
        props: ['people'],
        components: {
            Menu,
            MenuButton,
            MenuItem,
            MenuItems,
            Link,
        },
    };
</script>
