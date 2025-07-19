<script setup lang="ts">

import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:flex lg:items-center lg:justify-between">
                <div class="lg:w-1/2">
                    <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">
                        Discover Amazing Events
                    </h1>
                    <p class="mt-3 max-w-md text-lg text-indigo-100 sm:text-xl md:mt-5">
                        Find and join the best events in your area or create your own.
                    </p>
                    <div class="mt-8 flex">
                        <div class="inline-flex rounded-md shadow">
                            <Link :href="route('browse-events')" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50">
                                Browse Events
                            </Link>
                        </div>
                        <div class="ml-3 inline-flex rounded-md shadow">
                            <Link :href="route('login')" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-800 hover:bg-indigo-900">
                                Create Event
                            </Link>
                        </div>
                    </div>
                </div>
                <div class="mt-10 lg:mt-0 lg:w-1/2 flex justify-center">
                    <svg class="h-64 w-64 text-indigo-200" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 4h-1V3c0-.55-.45-1-1-1s-1 .45-1 1v1H8V3c0-.55-.45-1-1-1s-1 .45-1 1v1H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2zm-7 5h5v5h-5v-5z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
