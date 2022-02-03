<template>
    <!--
        This example requires updating your template:
    
        ```
        <html class="h-full">
        <body class="h-full">
        ```
      -->
    <main
        class="min-h-screen min-w-screen bg-cover bg-top sm:bg-top"
        style="
            background-image: url('https://images.unsplash.com/photo-1520923642038-b4259acecbd7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2238&q=80');
        ">
        <div
            class="max-w-7xl mx-auto px-4 py-16 text-center sm:px-6 sm:py-24 lg:px-8 lg:py-48">
            <p
                class="text-sm font-semibold text-white text-opacity-50 uppercase tracking-wide">
                Welcome
            </p>
            <h1
                class="mt-2 text-4xl font-extrabold text-white tracking-tight sm:text-5xl">
                Homexe.win
            </h1>
            <p class="mt-2 text-lg font-medium text-white text-opacity-50">
                Proceeed to the dashboard by clicking the button below.
            </p>
            <div class="mt-6">
                <a
                    :href="route('dashboard')"
                    class="mr-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-black text-opacity-75 bg-white bg-opacity-75 sm:hover:bg-opacity-50">
                    Dashboard
                </a>
                <a
                    :href="route('register')"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-black text-opacity-75 bg-white bg-opacity-75 sm:hover:bg-opacity-50">
                    Register
                </a>
            </div>
        </div>
    </main>
</template>

<script>
    import { defineComponent } from 'vue';
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            Link,
        },

        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        },
    });
</script>
