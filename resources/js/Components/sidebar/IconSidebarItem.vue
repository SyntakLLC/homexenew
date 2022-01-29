<template>
    <div>
        <Link
            v-if="item.href !== 'spark.portal'"
            :href="route(item.href)"
            :class="[
                route().current(item.current)
                    ? 'icon-only-sidebar-item-active-text'
                    : route().current(item.altCurrent)
                    ? 'icon-only-sidebar-item-active-text'
                    : 'icon-only-sidebar-item-inactive-text',
                'group icon-only-sidebar-item-text-styling',
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
                class="mx-3 flex-shrink-0 h-6 w-6 hidden md:block"
                aria-hidden="true" />
            <span class="block md:hidden">{{ item.name }}</span>
        </Link>

        <!-- Inertia links do not work with the billing portal -->
        <a
            v-else
            :href="route('spark.portal')"
            :class="[
                route().current(item.current)
                    ? 'icon-only-sidebar-item-active-text'
                    : route().current(item.altCurrent)
                    ? 'icon-only-sidebar-item-active-text'
                    : 'icon-only-sidebar-item-inactive-text',
                'group icon-only-sidebar-item-text-styling',
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
                class="mx-3 flex-shrink-0 h-6 w-6 hidden md:block"
                aria-hidden="true" />
            <span class="block md:hidden">{{ item.name }}</span>
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
