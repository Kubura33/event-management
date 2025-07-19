<script setup lang="ts">

import { Event } from '@/types/event';
import { Link } from '@inertiajs/vue3';

defineProps<{ event: Event }>();
</script>

<template>
    <div class="event-card bg-white rounded-xl overflow-hidden shadow-md">
        <div class="md:flex">
            <div class="md:w-2/4 h-48 md:h-64 bg-gray-200 relative">
                <img :src="event.imageUrl" :alt="event.title" v-if="event.imageUrl" class="w-full h-full object-cover" />
                <svg v-else class="absolute inset-0 h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2zm16 2H4v12h16V6zM6 9h12v2H6V9zm0 4h8v2H6v-2z" />
                </svg>
                <div class="absolute top-0 right-4">
                    <span class="badge bg-indigo-600" style="top: 8px !important; right: -5px !important;">{{ event.price ? "$" + event.price : "Free"}}</span>
                </div>
            </div>
            <div class="p-5 md:w-2/4">
                <div class="flex flex-wrap justify-between items-start mb-2">
                    <h3 class="text-xl font-semibold text-gray-900">{{event.title}}</h3>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ event.date }}</span>
                    </div>
                </div>
                <p class="text-gray-600 mb-4">{{event.description}}</p>
                <div class="flex flex-wrap items-center justify-between my-auto">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            <span>New York, USA</span>
                        </div>
                        <div class="text-sm text-gray-500">
                            <span class="font-medium text-indigo-600">{{event.attendees}}</span> / {{event.capacity}} attending
                        </div>
                    </div>
                    <Link :href="route('events.show', {event: event.slug})" class="mt-2 sm:mt-0 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        View Details
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
