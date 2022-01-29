<template>
    <app-layout>
        <template v-slot:page-header>
            <div class="sm:flex sm:items-center">
                <div class="flex-grow pt-2">
                    <Title class="leading-none sm:truncate"> Profile </Title>
                </div>

                <div class="flex items-center flex-shrink-0 space-x-6"></div>
            </div>
        </template>

        <template v-slot:default>
            <div>
                <div class="max-w-7xl mx-auto">
                    <div
                        v-if="
                            $page.props.jetstream.canUpdateProfileInformation
                        ">
                        <update-profile-information-form
                            :user="$page.props.user" />

                        <jet-section-border />
                    </div>

                    <div v-if="$page.props.jetstream.canUpdatePassword">
                        <update-password-form class="mt-10 sm:mt-0" />

                        <jet-section-border />
                    </div>

                    <div
                        v-if="
                            $page.props.jetstream
                                .canManageTwoFactorAuthentication
                        ">
                        <two-factor-authentication-form class="mt-10 sm:mt-0" />

                        <jet-section-border />
                    </div>

                    <logout-other-browser-sessions-form
                        :sessions="sessions"
                        class="mt-10 sm:mt-0" />

                    <template
                        v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                        <jet-section-border />

                        <delete-user-form class="mt-10 sm:mt-0" />
                    </template>
                </div>
            </div>
        </template>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
    import JetSectionBorder from '@/Jetstream/SectionBorder.vue';
    import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
    import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
    import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
    import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';
    import Title from '@/Components/Title';

    export default defineComponent({
        props: ['sessions'],

        components: {
            AppLayout,
            DeleteUserForm,
            JetSectionBorder,
            LogoutOtherBrowserSessionsForm,
            TwoFactorAuthenticationForm,
            UpdatePasswordForm,
            UpdateProfileInformationForm,
            Title,
        },
    });
</script>
