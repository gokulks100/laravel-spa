
<script setup>
    import { Head, Link, useForm } from '@inertiajs/vue3';

    const props = defineProps({
        value:Boolean
    })
</script>
<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <slot name="logo" />
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
        <div class="mt-6" v-if="value">
            Don't have any account Yet?<Link :href="route('register')" class="ml-2 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" style="color: #337CCF;">Register</Link>
        </div>
        <div class="mt-6" v-if="!value">
            Already have an account?<Link :href="route('login')" class="ml-2 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" style="color: #337CCF;">Sign in</Link>
        </div>

    </div>
</template>
