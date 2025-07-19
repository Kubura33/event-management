<script setup lang="ts">
import EventCardV2 from '@/components/EventCardV2.vue';
import { Event } from '@/types/event';

const props = defineProps<{ events: Event[] }>();
</script>

<template>
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Upcoming Events</h2>
            <div class="flex items-center">
                <span class="mr-2 text-sm text-gray-500">Sort by:</span>
                <select class="rounded-md border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option>Date: Newest</option>
                    <option>Date: Oldest</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Event Card 1 -->
            <EventCardV2 :event="event" v-for="event in events" :key="event.id" />
        </div>
    </div>
</template>

<style scoped>

</style>
