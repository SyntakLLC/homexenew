<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-700">
                {{ this.title }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-600">
                {{ this.subtitle }}
            </p>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
            <dl class="sm:divide-y sm:divide-gray-200">
                <slot name="questions" />
            </dl>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'subtitle'],
    };
</script>
