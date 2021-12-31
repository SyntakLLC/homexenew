<template>
    <component :is="component" />
</template>

<script>
    import { defineAsyncComponent } from 'vue';

    export default {
        props: {
            icon: {
                required: true,
            },
        },
        components: {},
        data() {
            return {};
        },
        methods: {},
        computed: {
            component() {
                if (
                    typeof this.icon === 'string' ||
                    this.icon instanceof String
                ) {
                    return defineAsyncComponent(() =>
                        import(`./icons/${this.icon}.vue`),
                    );
                }

                return this.icon;
            },
        },
    };
</script>
