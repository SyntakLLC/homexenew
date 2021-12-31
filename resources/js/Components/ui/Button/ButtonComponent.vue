<template>
    <button
        @click="click"
        :disabled="loading || disabled"
        :type="type"
        :class="[
            { 'shadow-none': loading || disabled },
            padding,
            fontSize,
            leading,
            rounded,
            colors,
            'inline-flex items-center justify-center border font-medium focus:outline-none focus:ring-2 focus:ring-offset-2',
        ]">
        <template v-if="loading">
            <icon-component
                icon="loading"
                :class="[iconSize, 'mr-2 -ml-0.5 absolute']" />
        </template>

        <div
            :class="[
                'flex items-center',
                { 'flex-row-reverse': iconPosition === 'right' },
                { 'opacity-0': loading },
            ]">
            <component
                v-if="icon"
                :is="typeof icon === 'string' ? IconComponent : icon"
                :class="[
                    iconSize,
                    iconColor,
                    iconPosition === 'left' ? 'mr-2 -ml-0.5' : 'ml-2 -mr-0.5',
                ]"
                :name="typeof icon === 'string' ? icon : null"
                aria-hidden="true" />

            <span class="truncate inline-block">{{ text }}</span>
        </div>
    </button>
</template>

<script>
    import IconComponent from '../../icon/Icon.vue';

    export default {
        emits: ['click', 'disabled-click'],
        props: {
            /**
             * Button Text
             */
            text: {
                required: true,
                type: String,
            },
            /**
             * HTML type attribute of button. Accepted values are "button", "submit", and "reset".
             * @values button, submit, reset
             */
            type: {
                required: false,
                type: String,
                default: 'button',
                validator: (prop) =>
                    ['button', 'submit', 'reset'].includes(prop),
            },
            /**
             * Pre-defined size styles. Accepted values are "xs", "sm", "base", "lg", and "xl".
             * @values xs, sm, base, lg, xl
             */
            size: {
                required: false,
                type: String,
                default: 'base',
                validator: (prop) =>
                    ['xs', 'sm', 'base', 'lg', 'xl'].includes(prop),
            },
            /**
             * Pre-defined color styles. Accepted values are "primary", "secondary", "white", "naked", and "danger".
             * @values primary, secondary, white, naked, danger
             */
            color: {
                required: false,
                type: String,
                default: 'white',
                validator: (prop) =>
                    [
                        'primary',
                        'secondary',
                        'white',
                        'naked',
                        'danger',
                    ].includes(prop),
            },
            /**
             * If set to true, the button will display a loading spinner instead of its contents.
             */
            loading: {
                required: false,
                type: Boolean,
                default: false,
            },
            /**
             * Whether this action is non-interactive.
             */
            disabled: {
                required: false,
                type: Boolean,
                default: false,
            },
            iconName: {
                required: false,
            },
            icon: {
                required: false,
            },
            iconPosition: {
                required: false,
            },
        },
        components: { IconComponent },
        data() {
            return {};
        },
        methods: {
            click() {
                return !this.loading && !this.disabled
                    ? this.$emit('click')
                    : this.$emit('disabled-click');
            },
        },
        computed: {
            padding() {
                switch (this.size) {
                    case 'xs':
                        return 'px-2.5 py-1.5';
                    case 'sm':
                        return 'px-3 py-2';
                    case 'base':
                        return 'px-4 py-2';
                    case 'lg':
                        return 'px-4 py-2.5';
                    case 'xl':
                        return 'px-6 py-3';
                }
            },
            fontSize() {
                switch (this.size) {
                    case 'xs':
                        return 'text-xs';
                    case 'sm':
                        return 'text-sm';
                    case 'base':
                        return 'text-sm';
                    case 'lg':
                        return 'text-base';
                    case 'xl':
                        return 'text-base';
                }
            },
            leading() {
                switch (this.size) {
                    case 'sm':
                        return 'leading-4';
                    default:
                        return 'leading-normal';
                }
            },
            rounded() {
                switch (this.size) {
                    case 'xs':
                        return 'rounded';
                    default:
                        return 'rounded-md';
                }
            },
            colors() {
                if (this.loading || this.disabled) {
                    return 'bg-gray-100 border-gray-300 cursor-not-allowed text-gray-400 shadow-none';
                } else {
                    switch (this.color) {
                        case 'primary':
                            return 'text-white bg-brand-600 hover:bg-brand-700 border-transparent shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-brand-100 focus:ring-brand-500';
                        case 'secondary':
                            return 'text-brand-800 bg-brand-100 hover:bg-brand-200 border-transparent focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-brand-50 focus:ring-brand-700';
                        case 'white':
                            return 'text-gray-700 bg-white hover:bg-gray-50 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-brand-100 focus:ring-brand-500';
                        case 'naked':
                            return 'text-gray-700 bg-white hover:bg-gray-50 border-transparent focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-brand-100 focus:ring-brand-500';
                        case 'danger':
                            return 'text-white bg-red-600 hover:bg-red-700 border-transparent shadow-sm focus:shadow-none focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-50 focus:ring-red-700';
                    }
                }
            },
            iconSize() {
                switch (this.size) {
                    case 'xs':
                        return 'h-4 w-4';
                    case 'sm':
                        return 'h-4 w-4';
                    case 'base':
                        return 'h-5 w-5';
                    case 'lg':
                        return 'h-5 w-5';
                    case 'xl':
                        return 'h-5 w-5';
                }
            },
            iconColor() {
                if (this.loading || this.disabled) {
                    return 'text-gray-400';
                } else {
                    switch (this.color) {
                        case 'primary':
                            return 'text-brand-400';
                        case 'secondary':
                            return 'text-brand-600';
                        case 'white':
                            return 'text-gray-400';
                        case 'naked':
                            return 'text-gray-400';
                        case 'danger':
                            return 'text-white';
                    }
                }
            },
        },
        mounted() {},
        created() {},
        setup() {
            return {
                IconComponent,
            };
        },
    };
</script>

<style lang="scss" scoped></style>
