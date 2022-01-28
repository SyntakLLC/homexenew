<template>
    <div>
        <Link
            v-if="item.href !== 'spark.portal'"
            :href="route(item.href)"
            :class="[
                route().current(item.current)
                    ? 'sidebar-item-active-text'
                    : route().current(item.altCurrent)
                    ? 'sidebar-item-active-text'
                    : 'sidebar-item-inactive-text',
                'group sidebar-item-text-styling',
            ]"
            :aria-current="
                route().current(item.current)
                    ? 'page'
                    : route().current(item.altCurrent)
                    ? 'page'
                    : undefined
            ">
            <component
                :is="item.icon"
                :class="[
                    route().current(item.current)
                        ? 'text-white'
                        : route().current(item.altCurrent)
                        ? 'text-white'
                        : 'text-gray-400 group-hover:text-gray-500',
                    'mx-3 flex-shrink-0 h-6 w-6',
                ]"
                aria-hidden="true" />
            {{ item.name }}
        </Link>

        <!-- Inertia links do not work with the billing portal -->
        <a
            v-else
            :href="route('spark.portal')"
            :class="[
                route().current(item.current)
                    ? 'sidebar-item-active-text'
                    : route().current(item.altCurrent)
                    ? 'sidebar-item-active-text'
                    : 'sidebar-item-inactive-text',
                'group sidebar-item-text-styling',
            ]"
            :aria-current="
                route().current(item.current)
                    ? 'page'
                    : route().current(item.altCurrent)
                    ? 'page'
                    : undefined
            ">
            <component
                :is="item.icon"
                :class="[
                    route().current(item.current)
                        ? 'text-white'
                        : route().current(item.altCurrent)
                        ? 'text-white'
                        : 'text-gray-400 group-hover:text-gray-500',
                    'mx-3 flex-shrink-0 h-6 w-6',
                ]"
                aria-hidden="true" />
            {{ item.name }}
        </a>
    </div>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3';

    export default {
        components: {
            Link,
        },
        props: ['item'],
    };
</script>
