<template>
    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-800">
            {{ this.question }}
        </dt>
        <dd class="mt-1 text-sm text-gray-600 sm:mt-0 sm:col-span-2">
            {{ this.answer }}
        </dd>
    </div>
</template>

<script>
    export default {
        name: 'DescriptionListItem',
        props: ['question', 'answer'],
    };
</script>

<style scoped></style>
