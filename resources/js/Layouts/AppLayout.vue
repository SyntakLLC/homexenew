<template>
    <sidebar-layout :navigation="navigation">
        <template v-slot:app-layout>
            <slot name="page-header" />
            <slot />
        </template>
    </sidebar-layout>
</template>

<script>
    import {
        BriefcaseIcon,
        HomeIcon,
        UsersIcon,
        CogIcon,
        ViewGridIcon,
    } from '@heroicons/vue/outline';
    import SidebarLayout from '@/Layouts/SidebarLayout.vue';

    const navigation = [
        {
            name: 'Dashboard',
            href: 'dashboard',
            icon: HomeIcon,
            current: 'dashboard',
            altCurrent: 'dashboard',
        },
        {
            name: 'Appointments',
            href: 'appointment.index',
            icon: BriefcaseIcon,
            current: 'appointment.index',
            altCurrent: 'appointment.index',
        },
        {
            name: 'Listings',
            href: 'listing.index',
            icon: ViewGridIcon,
            current: 'listing.index',
            altCurrent: 'listing.index',
        },
        {
            name: 'Clients',
            href: 'client.index',
            icon: UsersIcon,
            current: 'client.index',
            altCurrent: 'client.index',
        },
        // {
        //     name: 'Settings',
        //     href: 'profile.show',
        //     icon: CogIcon,
        //     current: 'profile.show',
        //     altCurrent: 'profile.show',
        // },
    ];

    export default {
        components: {
            SidebarLayout,
        },
        setup() {
            return {
                navigation,
            };
        },
    };
</script>
