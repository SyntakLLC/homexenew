<template>
    <div>
        <Link
            v-if="item.href !== 'spark.portal'"
            :href="route(item.href)"
            :class="[
                route().current(item.current)
                    ? 'secondary-fill-sidebar-item-active-text'
                    : route().current(item.altCurrent)
                    ? 'secondary-fill-sidebar-item-active-text'
                    : 'secondary-fill-sidebar-item-inactive-text',
                'group secondary-fill-sidebar-item-text-styling',
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
                        ? 'text-brand-400'
                        : route().current(item.altCurrent)
                        ? 'text-brand-400'
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
                    ? 'secondary-fill-sidebar-item-active-text'
                    : route().current(item.altCurrent)
                    ? 'secondary-fill-sidebar-item-active-text'
                    : 'secondary-fill-sidebar-item-inactive-text',
                'group secondary-fill-sidebar-item-text-styling',
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
                        ? 'text-brand-400'
                        : route().current(item.altCurrent)
                        ? 'text-brand-400'
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
