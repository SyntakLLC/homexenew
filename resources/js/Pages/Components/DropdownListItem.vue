<template>
    <a
        :href="route(this.href)"
        class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
        role="menuitem"
        tabindex="-1"
        :class="route().current(this.href) ? 'bg-gray-100 text-gray-900' : ''"
        >{{ this.text }}</a
    >
</template>

<script>
    export default {
        name: 'DropdownListItem',
        props: ['text', 'href'],
    };
</script>

<style scoped></style>
