<script>
    import useVuelidate from '@vuelidate/core';
    import { h } from 'vue';

    export default {
        setup: () => ({ v$: useVuelidate() }),
        validationConfig: {
            $lazy: true,
        },
        props: {
            submit: {
                required: true,
            },
            validations: {
                required: true,
            },
            data: {
                required: true,
            },
            errorBag: {
                required: false,
                default: null,
            },
        },
        data() {
            return {
                form: this.data,
                loading: false,
                errors: {},
            };
        },
        validations() {
            return { form: this.rules };
        },
        methods: {
            async onSubmit() {
                this.errors = {};

                this.v$.$reset();
                this.v$.$touch();

                const isFormCorrect = await this.v$.$validate();

                if (!isFormCorrect) return;

                if (!this.loading) {
                    this.loading = true;

                    try {
                        let response = await this.submit();

                        this.$emit('form-submit-success', response);
                        this.$emit('dismiss');

                        this.loading = false;
                    } catch (e) {
                        this.$emit('form-submit-fail');

                        await this.setErrors(e.data.errors);
                    }
                }
            },
            objectMap(object, mapFn) {
                return Object.keys(object).reduce(function (result, key) {
                    result[key] = mapFn(object[key], key);
                    return result;
                }, {});
            },
            async setErrors(errors) {
                // this.errors = await this.prepareErrors(errors, {});
                this.errors = errors;

                this.v$.$reset();
                this.v$.$touch();

                this.loading = false;
            },
            async prepareErrors(returnedErrors, preparedErrors) {
                let parts = '';
                for (const property in returnedErrors) {
                    parts = property.split('.');

                    if (parts.length > 1) {
                        let newKey = parts.shift();
                        let newJoinedKey = parts.join('.');
                        let result = await this.prepareErrors(
                            { [newJoinedKey]: returnedErrors[property] },
                            {},
                        );
                        preparedErrors = {
                            ...preparedErrors,
                            ...{
                                [newKey]: {
                                    ...preparedErrors[newKey],
                                    ...result,
                                },
                            },
                        };
                    } else {
                        preparedErrors = {
                            ...preparedErrors,
                            [property]: returnedErrors[property],
                        };
                    }
                }
                return preparedErrors;
            },
        },

        created() {
            let _this = this;

            this.$watch(
                () => this.inertiaErrors,
                (newVal, oldVal) => {
                    const inertiaErrorKeys = Object.keys(newVal);

                    if (inertiaErrorKeys.length) {
                        let errors = inertiaErrorKeys.reduce((errors, key) => {
                            errors[key] = [newVal[key]];
                            return errors;
                        }, {});

                        _this.setErrors(errors);
                    }
                },
            );
        },

        computed: {
            inertiaErrors() {
                return this.errorBag
                    ? this.$page.props.errors.hasOwnProperty(this.errorBag)
                        ? this.$page.props.errors[this.errorBag]
                        : {}
                    : this.$page.props.errors;
            },
            rules() {
                let _this = this;
                let rules = this.objectMap(
                    this.validations.form,
                    function (v, key) {
                        return {
                            ...v,
                            server: {
                                $message() {
                                    // `this` is not yet available in latest release
                                    return _this.errors[key];
                                },
                                $validator() {
                                    // `this` is not yet available in latest release
                                    return !_this.errors[key];
                                },
                            },
                            //$autoDirty: true,
                        };
                    },
                );

                return rules;
            },
        },

        render() {
            let _this = this;

            return h(
                'form',
                {
                    onSubmit: function ($event) {
                        $event.preventDefault();
                        return _this.onSubmit();
                    },
                },
                this.$slots.default({
                    loading: this.loading,
                    v$: this.v$,
                }),
            );
        },
    };
</script>
