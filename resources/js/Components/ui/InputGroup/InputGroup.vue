<template>
    <div>
        <div :class="[labelContainerClasses, { '-mb-1': screenReaderOnly }]">
            <label
                :for="id"
                :class="[labelClasses, { 'sr-only': screenReaderOnly }]">
                {{ label }}
            </label>
            <span class="text-sm leading-5 text-gray-500" v-if="cornerHint">
                {{ cornerHint }}
            </span>
        </div>
        <div :class="inputContainerClasses">
            <slot name="leading-item"></slot>

            <div
                class="absolute inset-y-0 left-0 flex items-center pointer-events-none pl-3">
                <slot name="leading-icon"></slot>
            </div>

            <input
                :id="id"
                data-lpignore="true"
                :autocomplete="autocomplete"
                :value="modelValue"
                :type="type"
                v-maska="mask"
                @blur="$emit('blur')"
                @focus="$emit('focus')"
                v-on:input="$emit('update:modelValue', $event.target.value)"
                :disabled="disabled"
                :readonly="readOnly"
                :class="[
                    inputClasses,
                    {
                        'pl-7': $slots['leading-item'],
                        'pl-10': $slots['leading-icon'],
                        'pr-10': $slots['trailing-icon'],
                        'border-red-300 text-red-900 placeholder-red-400 focus:border-red-300 focus:ring focus:ring-red-300 focus:ring-opacity-50 pr-10':
                            errors.length,
                        'focus:border-brand-500 border-gray-300 focus:ring focus:ring-brand-500 focus:ring-opacity-50':
                            !errors.length,
                        inputOverrideClasses,
                        'bg-gray-100 border-gray-300 cursor-not-allowed text-gray-400':
                            disabled,
                    },
                ]"
                :placeholder="placeholder" />

            <div
                class="absolute inset-y-0 right-0 flex items-center pointer-events-none"
                :class="[errors.length ? 'pr-9' : 'pr-3']">
                <slot name="trailing-icon"></slot>
            </div>
            <template v-if="errors.length">
                <div
                    class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg
                        class="h-5 w-5 text-red-500"
                        fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </template>
        </div>

        <slot name="errors" v-bind:errors="errors">
            <p class="mt-2 text-sm text-red-600" v-if="errors.length">
                {{ errors[0] }}
            </p>
        </slot>

        <div
            v-if="comment"
            :class="{ 'mt-0': errors.length, 'mt-2': !errors.length }">
            <slot name="comment" v-bind:errors="errors">
                <p class="text-sm text-gray-600">
                    {{ comment }}
                </p>
            </slot>
        </div>
    </div>
</template>

<script>
    import { getCurrentInstance } from 'vue';

    export default {
        props: {
            modelValue: {},
            id: {
                type: String,
                required: true,
            },
            disabled: {
                type: Boolean,
                required: false,
                default: false,
            },
            placeholder: {
                type: String,
                required: false,
            },
            label: {
                type: String,
                required: true,
            },
            screenReaderOnly: {
                type: Boolean,
                required: false,
                default: false,
            },
            cornerHint: {
                type: String,
                required: false,
            },
            comment: {
                type: String,
                required: false,
            },
            type: {
                type: String,
                required: false,
                default: 'text',
            },
            /*
            :mask="'1-###'"
            */
            mask: {
                required: false,
                default: '',
            },
            inputClasses: {
                required: false,
                default:
                    'outline-none border py-3 px-4 bg-white text-base leading-tight block rounded-md transition duration-150 ease-in-out block w-full placeholder-gray-400', //updated from rounded to rounded-md
            },
            labelClasses: {
                required: false,
                default: 'block text-sm font-medium leading-5 text-gray-700',
            },
            inputContainerClasses: {
                required: false,
                default: 'mt-1 relative rounded-md', //shadow-sm
            },
            labelContainerClasses: {
                required: false,
                default: 'flex justify-between',
            },
            autocomplete: {
                required: false,
                type: String,
                default: 'off',
            },
            inputOverrideClasses: {
                type: String,
                required: false,
            },
            validator: {
                required: false,
            },
            readOnly: {
                required: false,
                default: false,
            },
        },
        components: {},
        data() {
            return {};
        },
        methods: {},
        computed: {
            errors() {
                if (!this.validator) {
                    return [];
                }
                return this.validator.$errors.map((e) => {
                    return Array.isArray(e.$message)
                        ? e.$message[0]
                        : e.$message;
                });
            },
        },
        mounted() {},
        created() {},
    };
</script>

<style lang="scss" scoped>
    .disabled {
        background-color: rgba(206, 217, 224, 0.5) !important;
        box-shadow: none !important;
        color: rgba(92, 112, 128, 0.6) !important;
        cursor: not-allowed !important;
    }
</style>
