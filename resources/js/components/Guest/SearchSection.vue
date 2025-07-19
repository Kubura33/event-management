<script setup lang="ts"></script>

<template>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 rounded-lg bg-white p-4 shadow-sm md:flex-row">
            <div class="flex-grow">
                <div class="relative rounded-md shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            ></path>
                        </svg>
                    </div>
                    <input
                        type="text"
                        class="block w-full rounded-md border-gray-300 py-3 pr-12 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Search events..."
                    />
                </div>
            </div>
            <div class="flex flex-col gap-2 md:flex-row">
                <select class="block w-full rounded-md border-gray-300 py-2 pr-10 pl-3 text-base focus:border-indigo-500 focus:ring-indigo-500">
                    <option>All Categories</option>
                    <option>Music</option>
                    <option>Business</option>
                    <option>Food & Drink</option>
                    <option>Arts</option>
                    <option>Sports</option>
                </select>
                <select class="block w-full rounded-md border-gray-300 py-2 pr-10 pl-3 text-base focus:border-indigo-500 focus:ring-indigo-500">
                    <option>All Locations</option>
                    <option>New York</option>
                    <option>London</option>
                    <option>Paris</option>
                    <option>Tokyo</option>
                    <option>Sydney</option>
                </select>
                <button
                    class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none"
                >
                    Filter
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
