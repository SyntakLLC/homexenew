<template>
    <div class="px-3 mt-2 relative inline-block text-left">
        <div style="background-color: #f9f9f9">
            <button
                @click="showingProfileDropdown = !showingProfileDropdown"
                type="button"
                class="group w-full rounded-md px-3.5 py-2 text-sm text-left font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-purple-500"
                id="options-menu-button"
                aria-expanded="false"
                aria-haspopup="true">
                <span
                    class="flex w-full justify-between items-center hover:bg-gray-200">
                    <span
                        class="flex min-w-0 items-center justify-between space-x-3">
                        <img
                            class="w-10 h-10 bg-gray-300 flex-shrink-0"
                            style="border-radius: 15px"
                            :src="$page.props.user.profile_photo_url"
                            alt="" />
                        <span class="flex-1 flex flex-col min-w-0">
                            <span
                                class="text-gray-900 text-sm font-medium truncate"
                                >{{ $page.props.user.name }}</span
                            >
                            <span class="text-gray-500 text-sm truncate">{{
                                $page.props.user.email
                            }}</span>
                        </span>
                    </span>
                    <!-- Heroicon name: solid/selector -->
                    <svg
                        class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true">
                        <path
                            fill-rule="evenodd"
                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
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
                class="z-10 mx-3 origin-top absolute right-0 left-0 mt-1 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-200 focus:outline-none"
                role="menu"
                aria-orientation="vertical"
                aria-labelledby="options-menu-button"
                tabindex="-1">
                <div class="py-1" role="none">
                    <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                    <DropdownListItem text="View profile" href="profile.show" />
                </div>
                <div class="py-1" role="none">
                    <a
                        @click="$inertia.post(route('logout'))"
                        href="#"
                        class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                        role="menuitem"
                        tabindex="-1"
                        id="options-menu-item-5"
                        >Logout</a
                    >
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    import DropdownListItem from './DropdownListItem';
    export default {
        name: 'AccountButton',
        components: { DropdownListItem },
        props: ['showingProfileDropdown'],
    };
</script>

<style scoped></style>
