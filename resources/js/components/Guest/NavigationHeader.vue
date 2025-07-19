<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <nav class="bg-white shadow-sm">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 justify-between">
                <div class="flex items-center">
                    <div class="flex flex-shrink-0 items-center">
                        <svg class="h-8 w-8 text-indigo-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M19 4h-1V3c0-.55-.45-1-1-1s-1 .45-1 1v1H8V3c0-.55-.45-1-1-1s-1 .45-1 1v1H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2zm-7 5h5v5h-5v-5z"
                            />
                        </svg>
                        <span class="ml-2 text-xl font-bold text-gray-900">Eventry</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="hidden md:ml-6 md:flex md:space-x-8">
                        <Link
                            :href="route('home')"
                            :class="[
                                route().current('home')
                                    ? 'border-b-2 border-indigo-500 text-gray-900'
                                    : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700',
                                'inline-flex items-center px-1 pt-1 text-sm font-medium border-b-2',
                            ]"
                        >
                            Home
                        </Link>
                        <Link
                            :href="route('browse-events')"
                            :class="[
                                route().current('browse-events')
                                    ? 'border-b-2 border-indigo-500 text-gray-900'
                                    : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700',
                                'inline-flex items-center px-1 pt-1 text-sm font-medium border-b-2',
                            ]"
                        >
                            Browse Events
                        </Link>
                        <a
                            href="#"
                            :class="[
                                route().current('home')
                                    ? 'border-b-2 border-indigo-500 text-gray-900'
                                    : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700',
                                'inline-flex items-center px-1 pt-1 text-sm font-medium border-b-2',
                            ]"
                        >
                            Create Event
                        </a>
                        <a
                            href="#"
                            :class="[
                                route().current('home')
                                    ? 'border-b-2 border-indigo-500 text-gray-900'
                                    : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700',
                                'inline-flex items-center px-1 pt-1 text-sm font-medium border-b-2',
                            ]"                        >
                            My Events
                        </a>
                    </div>
                </div>
                <div class="flex items-center">
                    <button class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">Sign In</button>
                </div>
            </div>
        </div>
    </nav>
</template>

<style scoped></style>
