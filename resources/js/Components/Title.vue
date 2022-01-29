<template>
    <p
        class="h-8 font-semibold"
        style="font-size: 1.6875rem; line-height: 2.125rem">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot></slot></span>
    </p>
</template>

<script>
    import { defineComponent } from 'vue';

    export default defineComponent({
        props: ['value'],
    });
</script>
