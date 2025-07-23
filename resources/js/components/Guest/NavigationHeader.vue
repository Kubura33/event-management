<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <nav class="bg-white shadow-sm">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 justify-between">
                <div class="flex items-center">
                    <div class="flex flex-shrink-0 items-center">
                        <img src="/ventry-logo-no-bg.png" class="h-16 w-16" />
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
                    <Link :href="route('login')" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">Sign In</Link>
                </div>
            </div>
        </div>
    </nav>
</template>

<style scoped></style>
