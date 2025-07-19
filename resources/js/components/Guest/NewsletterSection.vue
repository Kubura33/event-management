<script setup lang="ts">

import { Input } from '@/components/ui/input';
</script>

<template>
    <div class="bg-indigo-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="lg:flex lg:items-center lg:justify-between">
                <div class="lg:w-0 lg:flex-1">
                    <h2 class="text-2xl font-extrabold tracking-tight text-white sm:text-3xl">
                        Stay updated with new events
                    </h2>
                    <p class="mt-3 max-w-3xl text-lg leading-6 text-indigo-200">
                        Subscribe to our newsletter and never miss an exciting event in your area.
                    </p>
                </div>
                <div class="mt-8 lg:mt-0 lg:ml-8">
                    <form class="sm:flex">
                        <label for="email-address" class="sr-only">Email address</label>
                        <input id="email-address" name="email-address" type="email" autocomplete="email" required class="w-full px-5 py-3 bg-white border-white focus:ring-white focus:border-white rounded-md" placeholder="Enter your email">
                        <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3 sm:flex-shrink-0">
                            <button type="submit" class="w-full flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50">
                                Subscribe
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
