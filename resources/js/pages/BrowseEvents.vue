<script setup lang="ts">
import GuestLayout from '@/layouts/GuestLayout.vue';
import FilterEvents from '@/components/FilterEvents.vue';
import { Event } from '@/types/event';
import { usePage } from '@inertiajs/vue3';
import EventCardV2 from '@/components/EventCardV2.vue';
import { ref } from 'vue';
import EventCardList from '@/components/EventCardList.vue';

type View = 'grid' | 'list';
const props = defineProps<{ events: Event[] }>();
const page = usePage();
const events: Event[] = page.props.events.data;
const pagination = page.props.events;

const chosenView = ref<View>('grid');
</script>

<template>
    <GuestLayout>
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 py-8 text-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold">Browse Events</h1>
                <p class="mt-2 text-indigo-100">Discover and filter through thousands of events</p>
            </div>
        </div>
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                <FilterEvents />
                <div class="mt-6 lg:col-span-9 lg:mt-0">
                    <div class="mb-6 flex flex-col items-start justify-between space-y-3 sm:flex-row sm:items-center sm:space-y-0">
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-500">View:</span>
                            <div class="flex overflow-hidden rounded-md border border-gray-300">
                                <button
                                    class="view-toggle-button px-3 py-1 text-sm"
                                    :class="{ active: chosenView === 'grid' }"
                                    @click="chosenView = 'grid'"
                                    data-view="grid"
                                >
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                                        ></path>
                                    </svg>
                                </button>
                                <button
                                    class="view-toggle-button px-3 py-1 text-sm"
                                    data-view="list"
                                    :class="{ active: chosenView === 'list' }"
                                    @click="chosenView = 'list'"
                                >
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            fill-rule="evenodd"
                                            d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                            clip-rule="evenodd"
                                        ></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-2 text-sm text-gray-500">Sort by:</span>
                            <select class="rounded-md border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option>Date: Newest</option>
                                <option>Date: Oldest</option>
                                <option>Price: Low to High</option>
                                <option>Price: High to Low</option>
                                <option>Popularity</option>
                            </select>
                        </div>
                    </div>

                    <!-- Results Count -->
                    <div class="mb-4">
                        <p class="text-sm text-gray-500">Showing <span class="font-medium">24</span> events</p>
                    </div>
                    <div id="grid-view" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3" v-if="chosenView === 'grid'">
                        <EventCardV2 :event="event" v-for="event in events" :key="event.id" />
                    </div>
                    <div id="list-view" class="space-y-4" v-else-if="chosenView === 'list'">
                        <EventCardList v-for="event in events" :event="event" :key="event.id" />
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<style scoped>
.view-toggle-button {
    transition: all 0.2s ease;
}

.view-toggle-button.active {
    background-color: #4f46e5;
    color: white;
}
</style>
