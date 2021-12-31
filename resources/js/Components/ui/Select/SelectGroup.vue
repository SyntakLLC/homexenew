<template>
	<div>
		<div :class="[labelContainerClasses, { '-mb-1': screenReaderOnly }]">
			<label :for="id" :class="[labelClasses, { 'sr-only': screenReaderOnly }]">{{ label }}</label>
			<span class="text-sm leading-5 text-gray-500" v-if="cornerHint">{{ cornerHint }}</span>
		</div>

		<div :class="inputContainerClasses">
			<select :id="id"
					:value="modelValue"
					:disabled="disabled"
					:class="[
						inputClasses,
						{
							'border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring focus:ring-red-300 focus:ring-opacity-50 pr-25': errors.length,
							'focus:ring-brand-500 focus:border-brand-500 focus:ring focus:ring-opacity-50 border-gray-300': !errors.length,
							classes,
							disabled: disabled,
						},
					]"
					@change="update">
				<template v-for="option in options" :key="option.value">
					<option :value="option.value">{{ option.label }}</option>
				</template>
			</select>

			<template v-if="errors.length">
				<div class=" absolute inset-y-0 right-0 pr-9 flex items-center pointer-events-none">
					<svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
						<path fill-rule="evenodd"
							  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
							  clip-rule="evenodd"/>
					</svg>
				</div>
			</template>
		</div>

		<slot name="errors" v-bind:errors="errors">
			<p class="mt-2 text-sm text-red-600" v-if="errors.length">
				{{ errors[0] }}
			</p>
		</slot>

		<div v-if="comment" :class="{ 'mt-0': errors.length, 'mt-2': !errors.length }">
			<slot name="comment" v-bind:errors="errors">
				<p class="text-sm text-gray-600">
					{{ comment }}
				</p>
			</slot>
		</div>
	</div>
</template>

<script>
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
		classes: {
			type: String,
			required: false,
		},
		options: {
			type: Array,
			required: true,
		},
		inputClasses: {
			required: false,
			default:
				"outline-none mt-1 block bg-white border rounded-md py-3 pr-9 pl-4 leading-tight transition duration-150 ease-in text-base w-full", //updated from rounded to rounded-md
		},
		labelClasses: {
			required: false,
			default: "block text-sm font-medium leading-5 text-gray-700",
		},
		inputContainerClasses: {
			required: false,
			default: "mt-1 relative rounded-md", //shadow-sm
		},
		labelContainerClasses: {
			required: false,
			default: "flex justify-between",
		},
		validator: {
			required: false,
		},
	},
	components: {},
	data() {
		return {};
	},
	methods: {
		update(e) {
			this.$emit("update:modelValue", e.target.value);
			this.$emit("select", e.target.value);
		},
	},
	computed: {
		errors() {
			if (!this.validator) {
				return [];
			}
			return this.validator.$errors.map((e) => {
				return Array.isArray(e.$message) ? e.$message[0] : e.$message;
			});
		},
	},
	mounted() {
	},
	created() {
	},
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