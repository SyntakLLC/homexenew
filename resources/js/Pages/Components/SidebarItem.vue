<template>
    <div>
        <a
            :href="route(this.href)"
            :class="
                route().current(this.href)
                    ? 'bg-gray-200 text-gray-900'
                    : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100'
            "
            class="text-gray-600 hover:text-gray-900 hover:bg-gray-100 group flex items-center px-2 py-2 text-base leading-5 font-medium rounded-md sm:hidden flex-row"
            aria-current="page">
            <div class="flex-row">
                <svg
                    class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6 inline-flex"
                    :class="route().current(this.href) ? 'text-gray-900' : ''"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    aria-hidden="true">
                    <slot name="svg_path" />
                </svg>
                <inertia-link href="#" class="inline-flex">
                    {{ this.text }}
                </inertia-link>
            </div>
        </a>
        <a
            :href="route(this.href)"
            class="text-gray-700 hover:text-gray-900 hover:bg-gray-100 group flex items-center px-2 py-2 text-sm font-medium rounded-md hidden sm:block"
            :class="
                route().current(this.href)
                    ? 'bg-gray-200 text-gray-900'
                    : 'text-gray-700 hover:text-gray-900 hover:bg-gray-100'
            ">
            <div class="flex-row">
                <svg
                    class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6 inline-flex"
                    :class="route().current(this.href) ? 'text-gray-900' : ''"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <slot name="svg_path" />
                </svg>
                <inertia-link href="#" class="inline-flex">
                    {{ this.text }}
                </inertia-link>
            </div>
        </a>
    </div>
</template>

<script>
    export default {
        name: 'SidebarItem',
        props: ['text', 'href'],
    };
</script>

<style scoped></style>
