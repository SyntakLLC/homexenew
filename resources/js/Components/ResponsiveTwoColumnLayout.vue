<template>
    <div class="grid grid-cols-1 gap-6 lg:grid-flow-col-dense lg:grid-cols-3">
        <!-- Primary column -->
        <div class="lg:col-start-1 lg:col-span-2">
            <!-- Primary column -->
            <section
                aria-labelledby="primary-heading"
                class="min-w-0 flex-1 h-full flex flex-col lg:order-last">
                <h1 id="primary-heading" class="sr-only">
                    {this.primaryHeading}
                </h1>

                <!-- Your content -->
                <slot name="main-column" />
            </section>
        </div>

        <!-- Secondary column (hidden on smaller screens) -->
        <aside class="w-full bg-white overflow-y-auto">
            <div
                class="w-full h-full rounded-lg lg:px-4 flex flex-col space-y-4">
                <!-- Your content -->
                <slot name="secondary-column" />
            </div>
        </aside>
    </div>
</template>

<script>
    import { defineComponent } from 'vue';

    export default defineComponent({
        props: ['primaryHeading'],
    });
</script>
