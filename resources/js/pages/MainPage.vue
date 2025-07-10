<script setup lang="ts">
import { computed, ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import EventCard from '@/components/EventCard.vue';
import { Event } from '@/types/event';

interface Props {
    events: Event[];
}

const props = defineProps<Props>();
const searchQuery = ref('');
const searchLocation = ref('');

// Filter events based on search queries
const filteredEvents = computed(() => {
    if (!searchQuery.value && !searchLocation.value) return props.events;

    return props.events.filter((event) => {
        const matchesTitle =
            event.title.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            event.description.toLowerCase().includes(searchQuery.value.toLowerCase());

        const matchesLocation =
            !searchLocation.value ||
            event.city.toLowerCase().includes(searchLocation.value.toLowerCase()) ||
            event.country.toLowerCase().includes(searchLocation.value.toLowerCase());

        return matchesTitle && matchesLocation;
    });
});

</script>

<template>
    <Head title="Events" />

    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
        <!-- Header with Add Event button and search -->
        <div class="mb-2 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">


            <div class="flex w-full flex-col gap-2 sm:w-auto sm:flex-row">
                <div class="relative w-full sm:w-64">
                    <Input v-model="searchQuery" placeholder="Search events..." class="pr-8" />
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="absolute top-1/2 right-3 h-4 w-4 -translate-y-1/2 transform text-muted-foreground"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <div class="relative w-full sm:w-48">
                    <Input v-model="searchLocation" placeholder="Filter by location" class="pr-8" />
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="absolute top-1/2 right-3 h-4 w-4 -translate-y-1/2 transform text-muted-foreground"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                        />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>
        </div>
        <!-- Results count -->
        <p class="text-sm text-muted-foreground">Showing {{ filteredEvents.length }} {{ filteredEvents.length === 1 ? 'event' : 'events' }}</p>

        <!-- Grid of event cards -->
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            <EventCard
                v-for="event in filteredEvents"
                :key="event.id"
                :event="event"
                @edit="(event) => console.log('Edit event', event)"
                @delete="(event) => console.log('Delete event', event)"
            />
        </div>

        <!-- Empty state -->
        <div v-if="filteredEvents.length === 0" class="flex flex-col items-center justify-center py-12">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="mb-4 h-12 w-12 text-muted-foreground"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                />
            </svg>
            <h3 class="text-lg font-medium">No events found</h3>
            <p class="mt-1 text-sm text-muted-foreground">Try adjusting your search or create a new event.</p>
        </div>
    </div>
</template>

<style scoped>

</style>
