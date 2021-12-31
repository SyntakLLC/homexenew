<template>
	<DatePicker :modelValue="modelValue"
				v-on:update:modelValue="updateDate"
				:input-debounce="inputDebounce"
				:popover="{visibility: 'focus'}"
				:update-on-input="false"
				:is-required="isRequired"
				:masks="{input: format}"
				:model-config="modelConfig"
				:min-date="minDate"
				:max-date="maxDate">
		<template v-slot="{ inputValue, inputEvents, togglePopover }">
			<input-group :modelValue="inputValue"
						 :id="id"
						 :label="label"
						 :placeholder="placeholder"
						 :corner-hint="cornerHint"
						 :disabled="disabled"
						 :validator="validator"
						 :mask="mask"
						 v-on="inputEvents"/>
		</template>
	</DatePicker>
</template>

<script>
import {DatePicker} from "v-calendar";
import InputGroup from "@/Components/ui/InputGroup/InputGroup";

export default {
    props: {
        modelValue: {},
        isRequired: {
            required: false,
            type: Boolean,
            default: false,
        },
        format: {
            required: false,
            default: "MM/DD/YYYY",
            comment: "https://vcalendar.io/format-parse-dates.html",
        },
        mask: {
            required: false,
            default: "##/##/####",
        },
        validator: {
            required: false,
            default: null,
        },
        disabled: {
            required: false,
            default: false,
        },
        placeholder: {
            required: false,
            default: "MM/DD/YYYY",
        },
        label: {
            required: false,
            default: "Date",
        },
        id: {
            required: false,
            default: "date",
        },
        inputDebounce: {
            required: false,
            default: 500,
        },
        minDate: {
            required: false,
            default: null,
        },
        cornerHint: {
            required: false,
            default: null,
        },
        maxDate: {
            required: false,
            default: null,
        },
        modelConfig: {
            required: false,
            default: function () {
                return {
                    type: "string",
                    mask: "YYYY-MM-DD",
                };
            },
        },
    },
    components: {InputGroup, DatePicker},
    data() {
        return {};
    },
    methods: {
        updateDate(date) {
            this.$emit("update:modelValue", date);
        },
    },
    computed: {},
    mounted() {
    },
    created() {
    },
    setup() {
        return {};
    },
};
</script>

<style lang="scss" scoped>

</style>